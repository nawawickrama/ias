<?php

namespace App\Http\Controllers;

use App\Models\CandidateRequirementList;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'actived', 'agent']);
    }

    public function paymentPage(){
        /** @var App\Models\User $user */
        $user = Auth::user();

        if (!$user->hasRole('Student')) {
            Auth::logout();
            abort(403);
        }

        return $candidateInfo = Auth::user()->candidate->candidateRequirementList->candidate;
//        $requiredPayment = $candidateInfo->candidateRequirementList->requirementListItems->where('type', 'Payment')->get();

        return view('student.payments.payments-manager')->with(['requiredPayment' => $requiredPayment]);
    }
}
