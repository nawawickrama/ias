<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\CandidateDocument;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class DocumentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'actived', 'agent']);
    }

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

    public function getDocumentDetails(Request $request)
    {
        $candidate_id = \request('CandidateID');
        $documentDetails = CandidateDocument::where('candidate_id', $candidate_id)->get();

        foreach ($documentDetails as $doc) {
            $doc_info = $doc->document;
            $reject = "<button type='button' class='btn btn-danger btn-icon btn-reject' data-toggle='modal' data-target='#reject' data-id='$doc->candidate_document_id'><i data-feather='shield-off'></i></button>";
            $approve = "<button type='button' class='btn btn-success btn-icon btn-approve' data-toggle='modal' data-target='#approve' data-id='$doc->candidate_document_id'><i data-feather='shield'></i></button>";
            $view = "<a class='btn btn-warning btn-icon' target='_blanck' href='storage/$doc->file_path'><i data-feather='eye'></i></a>";

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

    public function documentStatusChange(Request $request){

        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('document.status-change');

        if (!$permission) {
            Auth::logout();
            abort(403);
        }

        $docCanId = \request('docCanID');
        $status = \request('status');

        try{

            if($status == 1){
                CandidateDocument::find($docCanId)->update([
                    'status' => 'Approved'
                ]);
            }elseif($status == 0){
                CandidateDocument::find($docCanId)->update([
                    'reject_reason' => \request('rejectReason'),
                    'status' => 'Rejected'
                ]);
            }

        }catch(\Throwable $e){
            return back()->with(['error' => 'Status Change Failed.', 'error_type' => 'error']);
        }
        return back()->with('success', 'Status Changed.');

    }
}
