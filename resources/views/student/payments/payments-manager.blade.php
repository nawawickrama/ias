@extends('layouts.dashboard.main')

@section('content')
    <div class="alert alert-icon-danger" role="alert">
        <i data-feather="alert-circle"></i>
        <b>Attention ! </b> Please make sure to write down the referance number in your payment slip before hand it over
        to the bank.
    </div>
    <div class="card">
        <div class="card-header bg-primary">
            <div class="row">
                <div class="col-md-10">
                    <p>Payment Manager</p>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-warning btn-icon-text btn-block" data-toggle="modal"
                            data-target="#modelpayment"><i class="btn-icon-prepend" data-feather="upload"></i>Add
                        Payment
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th scope="row">Category</th>
                    <th>Reference Number</th>
                    <th>Deadline</th>
                    <th>Amount (£)</th>
                    <th>Paid Amount (£)</th>
                    <th>Balance (£)</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($requirementList as $list)
                    @php
                        $PCRLDetails = \App\Models\PaymentCandidateRequirementList::where('crl_id', $list->candidate_requirement_list_id)->first();
                        $formDetails = $PCRLDetails->form;
                        $paymentDetails = $PCRLDetails->payment;
                        $paid_amount = $paymentDetails->where('status', 'Approved')->sum('paid_amount');
                        $balance_amount = $formDetails->payment - $paid_amount;
                    @endphp
                    <tr>
                        <td>{{$list->name}}</td>
                        <td>{{$list->reference_no}}</td>
                        <td>{{date('d F Y', strtotime($list->dead_line))}}</td>
                        <td style="text-align: right">{{$formDetails->payment}}</td>
                        <td style="text-align: right">{{$paid_amount}}</td>
                        <td style="text-align: right">{{$balance_amount}}</td>
                        <td>
                            @if(count($paymentDetails) == 0)<span class="badge badge-danger">Not Paid</span>
                            @elseif($formDetails->payment == $paid_amount)<span class="badge badge-success">Payment Completed</span>
                            @elseif($paid_amount != 0 && $formDetails->payment > $paid_amount)<span class="badge badge-warning">Partially Completed</span>
                            @elseif($paymentDetails->where('status', 'Pending')->sum('paid_amount') > 0)<span class="badge badge-primary">Payment Pending</span>
                            @else<span class="badge badge-danger">Not Paid</span>@endif
                        </td>
                        <td>
                            <button type="button" class="btn btn-warning btn-icon-text btn-sm"><i
                                    class="btn-icon-prepend" data-feather="download"></i>Invoice
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="card mt-4">
        <div class="card-header bg-primary">
            <div class="row">
                <div class="col-md-10">
                    <p>Payment History</p>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Category</th>
                    <th>Paid Amount (£)</th>
                    <th>Paid Date</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                @foreach($paymentHistory as $payment)
                    <tr>
                        <td>{{$payment->form_type}} Payment</td>
                        <td style="text-align: right" >{{$payment->paid_amount}}</td>
                        <td>{{date('d F Y', strtotime($payment->paid_date))}}</td>
                        <td @if($payment->status === 'Rejected') colspan="2" @endif>
                            @if($payment->status === 'Pending')<span class="badge badge-warning">Pending for admin approval</span>
                            @elseif($payment->status === 'Approved')<span class="badge badge-success">Approved</span>
                            @elseif($payment->status === 'Rejected')<span class="badge badge-danger">Rejected</span>
                            @endif
                        </td>
                        @if($payment->status === 'Rejected')
                            <td>{{$payment->reject_reason}}</td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modelpayment" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add a payment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('make-payment')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="">Paid Date</label>
                                <input type="date" name="paid_date" id="" class="form-control" value="{{date('Y-m-d')}}" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="">Paid Amount</label>
                                <input type="number" name="paid_amount" id="paid_amount" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="">Payment Category</label>
                                <select name="payment_category" id="" required>
                                    <option value="" selected disabled>Select Category</option>
                                    @foreach($requirementList as $list)
                                        <option value="{{$list->requirement_list_id}}">{{$list->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" id="makePaymentFormSubmitButton" class="btn btn-warning" disabled>Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $('#paid_amount').keyup(function (){
            if($(this).val() > 0){
                $('#makePaymentFormSubmitButton').removeAttr('disabled');
            }else{
                $('#makePaymentFormSubmitButton').attr('disabled', true);
            }
        });
    </script>
@endsection
