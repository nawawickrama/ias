<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Password;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'actived', 'agent',]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        /** @var App\Models\User $user */
        $user = Auth::user();

        //make permission

        if($user->hasRole('Student')){

            //Candidate information status
            $candidateInfo = $user->candidate;
            $guardianInfo = $candidateInfo->guardian;
            $isCompleteStudentInfo = ($candidateInfo->isComplete === 'Yes' && $guardianInfo->isComplete === 'Yes') ? 1 : 0;

            //Candidate document status
            $documentCourse = $candidateInfo->cpf->course->documents;
            $candidateDocumentStatus = $candidateInfo->documents->whereIn('status', ['Pending', 'Rejected']);
            $isDocumentsComplete = (count($candidateDocumentStatus) === 0) ? 1 : 0;

            //Candidate form status
            $candidateAAFStatus = $candidateInfo->forms->where('form_id', 1)->first();
            $isAAFComplete = (isset($candidateAAFStatus) && $candidateAAFStatus->status === 'Approved') ? 1 : 0;

            $candidateLGOStatus = $candidateInfo->forms->where('form_id', 2)->first();
            $isLGOComplete = (isset($candidateLGOStatus) && $candidateLGOStatus->status === 'Approved') ? 1 : 0;

            //Candidate payment status
            $candidateCheckPayment = $candidateInfo->candidatePayments;
            $candidatePayment = $candidateInfo->candidatePayments->whereIn('status', ['Not-Paid', 'Partially-Paid', 'Pending', 'Rejected']);
            $isPaymentComplete = (count($candidatePayment) === 0) ? 1 : 0;


            return view('student.general.dashboard')->with(['documentCourse' => $documentCourse, 'candidateCheckPayment' => $candidateCheckPayment, 'isCompleteStudentInfo' => $isCompleteStudentInfo, 'isDocumentsComplete' => $isDocumentsComplete, 'isAAFComplete' => $isAAFComplete, 'isLGOComplete' => $isLGOComplete, 'isPaymentComplete' => $isPaymentComplete]);
        }

        return view('admin.general.home');
    }
}
