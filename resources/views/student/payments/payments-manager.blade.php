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
                    <th>Amount (€)</th>
                    <th>Paid Amount (€)</th>
                    <th>Balance (€)</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($candidatePayment as $list)
                    @php
                        $paymentInfo = $list->payments;
                    @endphp
                    <tr>
                        <td>{{$list->payment_category}} Payment</td>
                        <td>{{$list->reference_no}}</td>
                        <td>{{date('d F Y', strtotime($list->dead_line))}}</td>
                        <td style="text-align: right">{{$list->full_price}}</td>
                        <td style="text-align: right">{{$paymentInfo->where('status', 'Approved')->sum('paid_amount')}}</td>
                        <td style="text-align: right">{{$list->full_price - $paymentInfo->where('status', 'Approved')->sum('paid_amount')}}</td>
                        <td>
                            @if($list->status == 'Not-Paid')
                                <div class="badge badge-danger">NOT-PAID</div>
                            @elseif($list->status == 'Pending')
                                <div class="badge badge-warning">PENDING</div>
                            @elseif($list->status == 'Partially-Paid')
                                <div class="badge" style="background-color: purple; color: white;">PARTIALLY-PAID</div>
                            @elseif($list->status == 'Completed')
                                <div class="badge badge-success">COMPLETED</div>
                            @elseif($list->status == 'Rejected')
                                <div class="badge badge-danger">REJECTED</div>
                            @endif
                        </td>
                        <td>
                            <button type="button" class="btn btn-warning btn-icon-text btn-sm btn-invoice" candidate_payment_id="{{$list->candidate_payment_id}}"><i
                                    class="btn-icon-prepend" data-feather="download"></i>Invoice
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <form action="{{route('invoice')}}" method="POST" id="invoiceForm">
        @csrf
        <input type="hidden" value="" name="candidate_payment_id" id="payment_id">
    </form>
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
                    <th>Paid Amount (€)</th>
                    <th>Paid Date</th>
                    <th>Status</th>
                    <th>Reason</th>
                </tr>
                </thead>
                <tbody>
                @foreach($paymentHistory as $payment)
                    @php
                        $candidatePaymentInfo = $payment->candidatePayment;
                    @endphp
                    <tr>
                        <td>{{$candidatePaymentInfo->payment_category}} Payment</td>
                        <td style="text-align: right">{{$payment->paid_amount}}</td>
                        <td>{{date('d F Y', strtotime($payment->paid_date))}}</td>
                        <td>
                            @if($payment->status === 'Pending')<span class="badge badge-warning">Pending for admin approval</span>
                            @elseif($payment->status === 'Approved')<span class="badge badge-success">Approved</span>
                            @elseif($payment->status === 'Rejected')<span class="badge badge-danger">Rejected</span>
                            @endif
                        </td>
                        <td>{{$payment->reject_reason ?? 'N/A'}}</td>
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
                                <input type="date" name="paid_date" id="" class="form-control" value="{{date('Y-m-d')}}"
                                       required>
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
                                    @foreach($candidatePayment->where('status', '!=', 'Completed') as $list)
                                        <option value="{{$list->payment_category}}">{{$list->payment_category}}Payment
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" id="makePaymentFormSubmitButton" class="btn btn-warning" disabled>Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $('#paid_amount').keyup(function () {
            if ($(this).val() > 0) {
                $('#makePaymentFormSubmitButton').removeAttr('disabled');
            } else {
                $('#makePaymentFormSubmitButton').attr('disabled', true);
            }
        });

        $('.btn-invoice').click(function () {
            let candidatePaymentId = $(this).attr('candidate_payment_id');

            $('#payment_id').val(candidatePaymentId);
            $('#invoiceForm').trigger('submit');
        });
    </script>
@endsection
