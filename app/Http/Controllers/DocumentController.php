<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\CandidateDocument;
use App\Models\CandidateRequirementList;
use App\Models\DocumentCourse;
use App\Models\PaymentCandidateRequirementList;
use App\Models\User;
use App\Notifications\DocumentStatusChangeNotification;
use App\Notifications\FormSendNotification;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DocumentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'actived', 'agent']);
    }

    /**
     * @return Application|Factory|View
     * admin dashboard pending document section
     */
    public function pendingDocument()
    {
        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('document.approve');

        if (!$permission) {
            Auth::logout();
            abort(403);
        }

        $pendingDocumentUsers = DB::table('candidates')
            ->join('candidate_documents', 'candidates.candidate_id', '=', 'candidate_documents.candidate_id')
            ->select(DB::raw('COUNT(candidate_document_id) as doc_qty'), 'candidates.candidate_id as candidate_id')
            ->groupBy('candidates.candidate_id')
            ->get();

        $documentDetails = CandidateDocument::all();
        return view('admin.documents.document-verification')->with(['documentDetails' => $documentDetails, 'pendingDocumentUsers' => $pendingDocumentUsers]);

    }

    /**
     * @param Request $request
     * @return void
     * admin dashboard doc approval model
     */
    public function getDocumentDetails(Request $request): void
    {
        $candidate_id = \request('CandidateID');
        $documentDetails = CandidateDocument::where('candidate_id', $candidate_id)->get();

        foreach ($documentDetails as $doc) {
            $doc_info = $doc->document;
            $reject = "<button type='button' class='btn btn-danger btn-icon btn-reject' data-toggle='modal' data-target='#reject' data-id='$doc->candidate_document_id'><i data-feather='shield-off'></i></button>";
            $approve = "<button type='button' class='btn btn-success btn-icon btn-approve' data-toggle='modal' data-target='#approve' data-id='$doc->candidate_document_id'><i data-feather='shield'></i></button>";
            $view = "<a class='btn btn-warning' target='_blanck' href='storage/$doc->file_path'>View Document</a>";

            if ($doc->status == 'Pending') {
                $button = "<span class='badge badge-warning'>Pending</span>";
                $action = $approve.' '.$reject;

            } elseif ($doc->status == 'Approved') {
                $button = "<span class='badge badge-success'>Approved</span>";
                $action = $reject;

            } elseif ($doc->status == 'Rejected') {
                $button = "<span class='badge badge-danger'>Rejected</span>";
                $action = $approve;

            }
            echo "
                <tr>
                    <td>$doc_info->doc_name</td>
                    <td>$button</td>
                    <td>$action $view</td>
                </tr>
            ";
        }

//        return response()->json($documentDetails);
    }

    /**
     * @param Request $request
     * admin dashboard change doc status
     */
    public function documentStatusChange(Request $request): RedirectResponse
    {

        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('document.status-change');

        if (!$permission) {
            Auth::logout();
            abort(403);
        }

        $docCanId = \request('docCanID');
        $status = \request('status');

        $fileInfo = CandidateDocument::find($docCanId);
        $candidateInfo = $fileInfo->candidate;
        $user = $candidateInfo->user;

        try{
            if($status == 1){
                DB::transaction(function () use($fileInfo, $candidateInfo){
                    $fileInfo->update([
                        'status' => 'Approved'
                    ]);

                    //check all documents are approved and mark as document completed
                    $candidateDocInfo = CandidateDocument::where('candidate_id', $candidateInfo->candidate_id);
                    if($candidateDocInfo->get() !== null && count($candidateDocInfo->where('status', '!=', 'Approved')->get()) === 0){
                        $candidateInfo->candidateRequirementList->where('requirement_list_id', '2')->first()->update([
                            'isComplete' => 'Yes'
                        ]);
                    }

                });
            }elseif($status == 0){
                $fileInfo->update([
                    'reject_reason' => ucfirst(\request('rejectReason')),
                    'status' => 'Rejected'
                ]);
            }

            //notification for student
            Notification::sendNow($user, new DocumentStatusChangeNotification($user->email, $fileInfo->document, $status));


        }catch(\Throwable $e){
            return back()->with(['error' => 'Status Change Failed.', 'error_type' => 'error']);
        }
        return back()->with('success', 'Status Changed.');

    }

    /**
     * @return Application|Factory|View
     * student panel document page
     */
    public function candidate_document(){

        /** @var App\Models\User $user */
        $user = Auth::user();

        if(!$user->hasRole('Student')){
            Auth::logout();
            abort(403);
        }

        $candidateDetails = User::find($user->id)->candidate;
        $cpfDetails = $candidateDetails->cpf;
        $documentDetails = DocumentCourse::where([['course_id', $cpfDetails->course_id], ['document_course_status', '1']])->get();

        return view('student.registration.documents')->with(['candidateDetails' => $candidateDetails, 'documentDetails' => $documentDetails]);

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
            'referenceNo' => 'required|unique:candidate_requirement_lists,reference_no',
            'formType' => 'required',
            'deadLine' => 'required',
        ]);

        if ($validator->fails()){
            $all_errors = null;

            foreach ($validator->errors()->messages() as $errors){
                foreach ($errors as $error){
                    $all_errors .= $error."<br>";
                }
            }

            return back()->with(['error' => $all_errors, 'error_type' => 'error']);
        }

        $candidate_id = \request('candidateId');
        $reference_no = \request('referenceNo');
        $formType = \request('formType');
        $deadLine = \request('deadLine');

        try {

            DB::transaction(function () use($candidate_id, $formType, $reference_no, $deadLine){
                if ($formType == 'AAF') {
                    $AAForm = CandidateRequirementList::firstOrNew(['candidate_id' => $candidate_id, 'requirement_list_id' => 3]);
                    $AAForm->reference_no = $reference_no;
                    $AAForm->dead_line = $deadLine;
                    $AAForm->save();


                    $AAFPayment = CandidateRequirementList::firstOrNew(['candidate_id' => $candidate_id, 'requirement_list_id' => 5]);
                    $AAFPayment->reference_no = $reference_no;
                    $AAFPayment->dead_line = $deadLine;
                    $AAFPayment->save();

                    $setPayment = PaymentCandidateRequirementList::firstOrNew(['crl_id' => $AAFPayment->candidate_requirement_list_id]);
                    $setPayment->form_id = 1;
                    $setPayment->candidate_id = $candidate_id;
                    $setPayment->save();



                } elseif ($formType == 'LGO') {
                    $LGOForm = CandidateRequirementList::firstOrNew(['candidate_id' => $candidate_id, 'requirement_list_id' => 4]);
                    $LGOForm->reference_no = $reference_no;
                    $LGOForm->dead_line = $deadLine;
                    $LGOForm->save();

                    $LGOPayment = CandidateRequirementList::firstOrNew(['candidate_id' => $candidate_id, 'requirement_list_id' => 6]);
                    $LGOPayment->reference_no = $reference_no;
                    $LGOPayment->dead_line = $deadLine;
                    $LGOPayment->save();

                    $setPayment = PaymentCandidateRequirementList::firstOrNew(['crl_id' => $LGOPayment->candidate_requirement_list_id]);
                    $setPayment->form_id = 2;
                    $setPayment->candidate_id = $candidate_id;
                    $setPayment->save();

                }
            });


        }catch (\Throwable $e){
//            dd($e);
            return back()->with(['error' => 'Form Send Failed.', 'error_type' => 'error']);
        }

        //send notification to candidate.
        $user = Candidate::find($candidate_id)->user;
        Notification::sendNow($user, new FormSendNotification($formType, $candidate_id));

        return back()->with(['success' => 'Form Send Successful.']);
    }

}
