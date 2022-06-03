<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\CandidateForm;
use App\Models\CandidatePayment;
use App\Models\Form;
use App\Models\SubForm;
use App\Models\User;
use App\Notifications\FormSendNotification;
use App\Notifications\FormStatusChangeNotification;
use App\Notifications\FormSubmitNotification;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class FormController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'actived', 'agent']);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * Upload candidate forms like AAF and LGO
     */
    public function submitForm(Request $request)
    {
        /**@var App\Models\User $user */
        $user = Auth::user();

        if (!$user->hasRole('Student')) {
            Auth::logout();
            abort(403);
        }

        $request->validate([
            'file' => 'required|mimes:pdf,jpeg,jpg,png|max:10240',
            'formType' => 'required'
        ]);

        $formType = \request('formType');

        //delete old file
        $fileCheck = CandidateForm::where([['candidate_id', $user->candidate->candidate_id], ['form_id', \request('formType') === 'AAF' ? 1 : 2], ['status', '!=', 'Not-Uploaded']])->first();
        if(isset($fileCheck)){
            Storage::disk('public')->delete($fileCheck->file_path);
        }

        try {
            $extension = $request->file('file')->getClientOriginalExtension();
            $name = $user->candidate->candidate_id . '_' . $formType . '_' . time() . '.' . $extension;
            $fill_path = $request->file('file')->storeAs('student_form', $name, 'public');

            $formCreate = CandidateForm::firstOrNew(['candidate_id' => $user->candidate->candidate_id, 'form_id' => \request('formType') === 'AAF' ? 1 : 2]);
            $formCreate->file_path = $fill_path;
            $formCreate->status = 'Pending';
            $formCreate->reject_reason = NULL;
            $formCreate->submit_date = date('Y-m-d H:i:s');
            $formCreate->save();

        } catch (\Throwable $e) {
//            dd($e);
            return back()->with(['error' => 'Form Uploaded Failed', 'error_type' => 'error']);
        }

        //Notification
        $users = User::role('Super Admin')->get();
        Notification::sendNow($users, new FormSubmitNotification($formType, $user->candidate->candidate_id));

        return back()->with(['success' => 'Form Uploaded Successful']);
    }

    /**
     * @return Application|Factory|View
     * Admin dashboard AAF and LGO status change page
     */
    public function formStatusPage(){

        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('form.status-change');

        if (!$permission) {
            Auth::logout();
            abort(403);
        }

        $forms = CandidateForm::where('status', '!=', 'Not-Uploaded')->orderByDesc('created_at')->get();
        return view('admin.selected.verify-lgo-aaf')->with(['forms' => $forms]);
    }

    /**
     * @param Request $request
     * admin dashboard change form status
     */
    public function formStatusChange(Request $request): RedirectResponse
    {

        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('form.status-change');

        if (!$permission) {
            Auth::logout();
            abort(403);
        }

        $formId = \request('candiFormID');
        $status = \request('status');

        $fileInfo = CandidateForm::find($formId);
        $candidateInfo = $fileInfo->candidate;
        $user = $candidateInfo->user;

        try {
            if ($status == 1) {
                DB::transaction(function () use ($fileInfo, $candidateInfo) {
                    $fileInfo->update([
                        'status' => 'Approved',
                        'reject_reason' => NULL,
                        'isComplete' => 'Yes'
                    ]);

                });

            } elseif ($status == 0) {
                $fileInfo->update([
                    'reject_reason' => ucfirst(\request('rejectReason')),
                    'status' => 'Rejected'
                ]);
            }

        } catch (\Throwable $e) {
            return back()->with(['error' => 'Status Change Failed.', 'error_type' => 'error']);
        }

        //notification for student
        Notification::sendNow($user, new FormStatusChangeNotification($fileInfo->form, ($status == 1) ? 'Approved' : 'Rejected'));

        return back()->with('success', 'Status Changed.');

    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * Send AAF Or LGO for candidate from admin end
     */
    public function sendFormToCandidate(Request $request): RedirectResponse
    {

        $validator = Validator::make($request->all(), [
            'candidateId' => 'required',
            'referenceNo' => 'required|unique:candidate_forms,reference_no',
            'formType' => 'required',
            'deadLine' => 'required',
        ]);

        if ($validator->fails()) {
            $all_errors = null;

            foreach ($validator->errors()->messages() as $errors) {
                foreach ($errors as $error) {
                    $all_errors .= $error . "<br>";
                }
            }

            return back()->with(['error' => $all_errors, 'error_type' => 'error']);
        }

        $candidate_id = \request('candidateId');
        $reference_no = \request('referenceNo');
        $formType = \request('formType');
        $deadLine = \request('deadLine');

        try {
            DB::transaction(function () use ($candidate_id, $formType, $reference_no, $deadLine) {

                $formInfo = Form::where('form_name', $formType)->first();

                $form = CandidateForm::create([
                    'reference_no' => $reference_no,
                    'dead_line' => $deadLine,
                    'candidate_id' => $candidate_id,
                    'form_id' => $formInfo->form_id,
                    'full_amount' => $formInfo->payment,
                    'status' => 'Not-Uploaded',
                ]);

                $candidatePayment = CandidatePayment::create([
                    'payment_category' => $formType,
                    'reference_no' => $reference_no,
                    'candidate_id' => $candidate_id,
                    'candidate_form_id' => $form->candidate_form_id,
                    'full_price' => $formInfo->payment,
                    'dead_line' => $deadLine,
                ]);


                if ($formType === 'AAF') {
                    $cpfDetails = Candidate::find($candidate_id)->cpf;
                    $subForm = SubForm::where([['course_id', $cpfDetails->course_id], ['form_id', $formInfo->form_id]])->first();

                    CandidateForm::find($form->candidate_form_id)->update([
                        'sub_form_id' => $subForm->sub_form_id,
                        'full_amount' => \request('coz_price') ?? $subForm->price,
                    ]);

                    CandidatePayment::find($candidatePayment->candidate_payment_id)->update([
                        'full_price' => \request('coz_price') ?? $subForm->price,
                    ]);
                }

            });


        } catch (\Throwable $e) {
            return back()->with(['error' => 'Form Send Failed.', 'error_type' => 'error']);
        }

        //send notification to candidate.
        $user = Candidate::find($candidate_id)->user;
        Notification::sendNow($user, new FormSendNotification($formType, $candidate_id));

        return back()->with(['success' => 'Form Send Successful.']);
    }
}
