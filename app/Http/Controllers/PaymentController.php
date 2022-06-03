<?php

namespace App\Http\Controllers;

use App\Models\CandidatePayment;
use App\Models\Form;
use App\Models\Payment;
use App\Models\User;
use App\Notifications\PaymentAddingNotification;
use App\Notifications\PendingLeadNotify;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

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
    public function paymentPage()
    {
        /** @var App\Models\User $user */
        $user = Auth::user();

        if (!$user->hasRole('Student')) {
            Auth::logout();
            abort(403);
        }

        $candidateInfo = Auth::user()->candidate;
        $candidatePayment = $candidateInfo->candidatePayments;
        $paymentHistory = Payment::where('candidate_id', $candidateInfo->candidate_id)->orderByDesc('updated_at')->get();

        return view('student.payments.payments-manager')->with(['candidatePayment' => $candidatePayment, 'paymentHistory' => $paymentHistory]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * Add new payment by candidate
     */
    public function makePayment(Request $request): RedirectResponse
    {
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

        if ($validator->fails()) {
            $all_errors = null;

            foreach ($validator->errors()->messages() as $errors) {
                foreach ($errors as $error) {
                    $all_errors .= $error . "<br>";
                }
            }

            return back()->with(['error' => $all_errors, 'error_type' => 'error']);
        }

        $paymentDate = \request('paid_date');
        $candidateDetails = Auth::user()->candidate;

        $paidAmount = \request('paid_amount');
        $formType = \request('payment_category');

        $candidatePayment = Form::where('form_name', $formType)->first()->candidatesForm->where('candidate_id', $candidateDetails->candidate_id)->first()->candidatePayment;

        $referenceCode = $candidatePayment->reference_no;

        $paymentRemaining = $candidatePayment->full_price - Payment::where([['reference_no', $referenceCode], ['status', 'Approved']])->orWhere([['reference_no', $referenceCode], ['status', 'Pending']])->get()->sum('paid_amount');

        $paymentInfo = null;
        try {
            DB::transaction(function () use ($candidateDetails, $referenceCode, $candidatePayment, $paymentDate, $paidAmount, $paymentRemaining, &$paymentInfo) {
                $paymentInfo = Payment::create([
                    'candidate_id' => $candidateDetails->candidate_id,
                    'reference_no' => $referenceCode,
                    'full_amount' => $candidatePayment->full_price,
                    'paid_amount' => $paidAmount,
                    'remaining_amount' => $paymentRemaining - $paidAmount,
                    'paid_date' => $paymentDate,
                    'status' => 'Pending',
                    'candidate_payment_id' => $candidatePayment->candidate_payment_id,
                ]);

                CandidatePayment::find($candidatePayment->candidate_payment_id)->update([
                    'status' => 'Pending',
                ]);
            });
        } catch (\Throwable $e) {
            return back()->with(['error' => 'Payment Failed.', 'error_type' => 'error']);
        }

        $users = User::role('Super Admin')->get();
        Notification::sendNow($users, new PaymentAddingNotification($paymentInfo->payment_id));

        return back()->with(['success' => 'Payment Successful.']);
    }

    /**
     * @return Application|Factory|View
     * Admin Payment manager
     */
    public function paymentManager()
    {
        /** @var App\Models\User $user */
        $user = Auth::user();

        if (!$user->hasRole('Super Admin')) {
            Auth::logout();
            abort(403);
        }

        $paymentDetails = Payment::all();
        return \view('admin.payments.payments-manager')->with(['paymentDetails' => $paymentDetails]);
    }

    public function changePaymentStatus(Request $request): RedirectResponse
    {
        /** @var App\Models\User $user */
        $user = Auth::user();

        if (!$user->hasRole('Super Admin')) {
            Auth::logout();
            abort(403);
        }

        $paymentId = \request('payment_id');
        $paymentStatus = \request('status');
        $rejectReason = \request('rejectReason');

        $remainingAmount = \request('remainingAmount');
        $fullAmount = \request('fullAmount');

        $paymentInfo = Payment::find($paymentId);

        try {

            DB::transaction(function () use ($paymentInfo, $paymentId, $paymentStatus, $rejectReason, $remainingAmount, $fullAmount) {
                $approvedBalanced = $fullAmount - Payment::where([['status', 'Approved'], ['reference_no', $paymentInfo->reference_no]])->sum('paid_amount');

                $paymentInfo->update([
                    'status' => $paymentStatus,
                    'reject_reason' => $rejectReason
                ]);

                if ($paymentStatus == 'Approved') {
                    $status = ($approvedBalanced == $paymentInfo->paid_amount) ? 'Completed' : 'Partially-Paid';

                } else {
                    $pendingPayments = Payment::where([['status', 'Pending'], ['reference_no', $paymentInfo->reference_no], ['payment_id', '!=', $paymentId], ['created_at', '>', $paymentInfo->created_at]])->get();
                    $status = ($remainingAmount == $fullAmount) ? 'Rejected' : 'Partially-Paid';

                    foreach($pendingPayments as $payInfo) {
                        $payInfo->update([
                            'remaining_amount' => $payInfo->remaining_amount + $paymentInfo->paid_amount,
                        ]);
                    }
                }

                CandidatePayment::find($paymentInfo->candidate_payment_id)->update([
                    'status' => $status
                ]);
            });
        } catch (\Throwable $e) {
            dd($e);
            return back()->with(['error' => 'Payment Status Changed Failed', 'error_type' => 'error']);
        }

        return back()->with(['success' => 'Payment Status Changed']);
    }
}
