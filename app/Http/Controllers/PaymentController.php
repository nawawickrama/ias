<?php

namespace App\Http\Controllers;

use App\Models\CandidateRequirementList;
use App\Models\Form;
use App\Models\Payment;
use App\Models\RequirementList;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'actived', 'agent']);
    }

    /**
     * @return Application|Factory|View
     * Candidate Dashboard Payment manager page
     */
    public function paymentPage(){
        /** @var App\Models\User $user */
        $user = Auth::user();

        if (!$user->hasRole('Student')) {
            Auth::logout();
            abort(403);
        }

        $candidate_id = Auth::user()->candidate->candidate_id;

        $requirementList = DB::table('candidate_requirement_lists')
                            ->join('requirement_lists', 'requirement_lists.requirement_list_id', '=', 'candidate_requirement_lists.requirement_list_id')
                            ->join('candidates', 'candidates.candidate_id', '=', 'candidate_requirement_lists.candidate_id')
                            ->select('requirement_lists.*', 'candidate_requirement_lists.*')
                            ->where([['candidates.candidate_id', $candidate_id], ['type', 'Payment']])
                            ->get();

        $paymentHistory = Payment::where('candidate_id', $candidate_id)->get();
        return view('student.payments.payments-manager')->with(['requirementList' => $requirementList, 'paymentHistory' => $paymentHistory]);
    }


    /**
     * @param Request $request
     * @return RedirectResponse
     * Add new payment by candidate
     */
    public function makePayment(Request $request): RedirectResponse{
        /** @var App\Models\User $user */
        $user = Auth::user();

        if (!$user->hasRole('Student')) {
            Auth::logout();
            abort(403);
        }

        $validator = Validator::make($request->all(), [
           'paid_date' => 'required|date',
           'paid_amount' => 'required|numeric|gt:0',
           'payment_category' => 'required',
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

        $paymentDate = \request('paid_date');
        $candidateDetails = Auth::user()->candidate;

        $paidAmount = \request('paid_amount');
        $formType = \request('payment_category') == '5' ? 'AAF' : 'LGO';

//        $referenceCode = CandidateRequirementList::where([['candidate_id', $candidateDetails->candidate_id], ['requirement_list_id' => '']])
        $fullPayment = Form::where('form_name', $formType)->first()->payment;

        if($formType == 'AAF'){
            $referenceCode = RequirementList::where([['name', 'AAF Payment'], ['type', 'Payment']])->first()->candidateConnection->where('candidate_id', $candidateDetails->candidate_id)->first()->reference_no;
            $pcrlDetails = $candidateDetails->pcrlInfo->where('form_id', '1')->first();
        }else{
            $referenceCode = RequirementList::where([['name', 'LGO Payment'], ['type', 'Payment']])->first()->candidateConnection->where('candidate_id', $candidateDetails->candidate_id)->first()->reference_no;
            $pcrlDetails = $candidateDetails->pcrlInfo->where('form_id', '2')->first();
        }


        try {
            Payment::create([
                'paid_amount' => $paidAmount,
                'form_type' => $formType,
                'pcrl_id'=> $pcrlDetails->pcrl_id,
                'candidate_id' => $candidateDetails->candidate_id ,
                'full_payment' => $fullPayment,
                'status'  => 'Pending',
                'reference_no' => $referenceCode
            ]);
        }catch (\Throwable $e){
            return back()->with(['error' => 'Payment Failed.', 'error_type' => 'error']);
        }

        return back()->with(['success' => 'Payment Successful.']);
    }

    //admin
    public function paymentManager(){
        /** @var App\Models\User $user */
        $user = Auth::user();

        if (!$user->hasRole('Super Admin')) {
            Auth::logout();
            abort(403);
        }

        $paymentDetails = Payment::all();
        return \view('admin.payments.payments-manager')->with(['paymentDetails' => $paymentDetails]);
    }
}
