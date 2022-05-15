<?php

namespace App\Http\Controllers;

use App\Models\CandidateForm;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
    public function submitForm(Request $request): RedirectResponse
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

        try {
            $extension = $request->file('file')->getClientOriginalExtension();
            $name = $user->candidate->candidate_id . '_AAF' . time() . '.' . $extension;
            $fill_path = $request->file('file')->storeAs('student_form', $name, 'public');

            CandidateForm::create([
                'candidate_id' => $user->candidate->candidate_id,
                'form_id' => \request('formType') === 'AAF' ? 1 : 2,
                'file_path' =>$fill_path,
            ]);

        }catch (\Throwable $e){
            dd($e);
            return back()->with(['error' => 'Form Uploaded Failed', 'error_type' => 'error']);
        }

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

        $forms = CandidateForm::orderByDesc('created_at')->get();
        return view('admin.selected.verify-lgo-aaf')->with(['forms' => $forms]);
    }

    /**
     * @param Request $request
     * admin dashboard change form status
     */
    public function formStatusChange(Request $request)
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

        try{
            if($status == 1){
                DB::transaction(function () use($fileInfo, $candidateInfo){
                    $fileInfo->update([
                        'status' => 'Approved',
                        'reject_reason' => NULL,
                        'isComplete' => 'Yes'
                    ]);

                });

            }elseif($status == 0){
                $fileInfo->update([
                    'reject_reason' => ucfirst(\request('rejectReason')),
                    'status' => 'Rejected'
                ]);
            }

            //notification for student
//            Notification::sendNow($user, new DocumentStatusChangeNotification($user->email, $fileInfo->document, $status));


        }catch(\Throwable $e){
            return back()->with(['error' => 'Status Change Failed.', 'error_type' => 'error']);
        }
        return back()->with('success', 'Status Changed.');

    }
}
