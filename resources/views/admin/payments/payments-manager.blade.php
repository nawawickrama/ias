@extends('layouts.dashboard.main')

@section('content')
    <div class="card">
        <div class="card-header bg-primary text-white">
            <p>Payments Manager</p>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="datatable-basic">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Candidate</th>
                        <th scope="col">Payment Category</th>
                        <th scope="col">Ref No</th>
                        <th scope="col">Paid Date</th>
                        <th scope="col">Total Fee (£)</th>
                        <th scope="col">Paid Amount (£)</th>
                        <th scope="col">Balance (£)</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($paymentDetails as $key => $payment)
                        @php
                            $candidateInfo = $payment->candidate;
                            $candidatePaymentInfo = $payment->candidatePayment;
                        @endphp
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$candidateInfo->first_name}} {{$candidateInfo->sur_name}}</td>
                            <td>@if($candidatePaymentInfo->payment_category === 'LGO')<span class="badge"
                                                                                            style="background-color:purple; color: white">LGO FORM</span> @elseif($candidatePaymentInfo->payment_category === 'AAF')
                                    <span class="badge badge-primary">AA FORM</span>@endif</td>
                            <td>{{$payment->reference_no}}</td>
                            <td>{{date('d F Y', strtotime($payment->paid_date))}}</td>
                            <td style="text-align: right">{{$payment->full_amount}}</td>
                            <td style="text-align: right">{{$payment->paid_amount}}</td>
                            <td style="text-align: right">{{$payment->remaining_amount}}</td>
                            <td>
                                @if($payment->status == 'Pending')<span
                                    class="badge badge-warning">Pending Verification</span>
                                @elseif($payment->status == 'Approved')<span class="badge badge-success">Approved</span>
                                @elseif($payment->status == 'Rejected')<span class="badge badge-danger">Rejected</span>
                                @endif
                            </td>
                            <td>
                            <span data-toggle="tooltip" data-placement="top" title="Approve Payment">
                                <button type="button" class="btn btn-success btn-icon btn-form-submit"
                                        data-toggle="modal" data-target="#modelapp" payment_id="{{$payment->payment_id}}" remainingAmount="{{$payment->full_amount - $payment->paid_amount}}" fullAmount="{{$payment->full_amount}}">
                                    <i data-feather="check-square"></i>
                                </button>
                            </span>
                                <span data-toggle="tooltip" data-placement="top" title="Reject Payment">
                                <button type="button" class="btn btn-warning btn-icon btn-form-submit"
                                        data-toggle="modal" data-target="#modelrej"  payment_id="{{$payment->payment_id}}" remainingAmount="{{$payment->full_amount - $payment->paid_amount}}" fullAmount="{{$payment->full_amount}}">
                                    <i data-feather="x-square"></i>
                                </button>
                            </span>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Approve -->
    <div class="modal fade" id="modelapp" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{route('change-payment-status')}}" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirmation</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure, do you want to approve this payment?
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="payment_id" value="" class="payment_Id">
                        <input type="hidden" name="status" value="Approved">
                        <input type="hidden" name="remainingAmount" value="" class="remainingAmount">
                        <input type="hidden" name="fullAmount" value="" class="fullAmount">

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Yes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Modal Reject -->
    <div class="modal fade" id="modelrej" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <form action="{{route('change-payment-status')}}" method="post">
            @csrf
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirmation</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure, do you want to reject this payment?</p>
                        <label>
                            <textarea class="form-control" cols="60" rows="6" name="rejectReason" required></textarea>
                        </label>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="payment_id" value="" class="payment_Id">
                        <input type="hidden" name="status" value="Rejected">
                        <input type="hidden" name="remainingAmount" value="" class="remainingAmount">
                        <input type="hidden" name="fullAmount" value="" class="fullAmount">

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Yes</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        $('.btn-form-submit').click(function (){
             let payment_id = $(this).attr('payment_id');
             let remainingAmount = $(this).attr('remainingAmount');
             let fullAmount = $(this).attr('fullAmount');
            
             $('.payment_Id').val(payment_id);
             $('.remainingAmount').val(remainingAmount);
             $('.fullAmount').val(fullAmount);
        });
    </script>
@endsection
