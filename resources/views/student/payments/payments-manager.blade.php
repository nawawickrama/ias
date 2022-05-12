@extends('layouts.dashboard.main')

@section('content')
<div class="alert alert-icon-danger" role="alert">
    <i data-feather="alert-circle"></i>
    <b>Attention ! </b> Please make sure to write down the referance number in your payment slip before hand it over to the bank.
</div>
<div class="card">
    <div class="card-header bg-primary">
        <div class="row">
            <div class="col-md-10">
                <p>Payment Manager</p>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-warning btn-icon-text btn-block" data-toggle="modal" data-target="#modelpayment"><i class="btn-icon-prepend" data-feather="upload"></i>Add Payment</button>
            </div>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="row">Course</th>
                    <th>Referance Number</th>
                    <th>Deadline</th>
                    <th>Amount</th>
                    <th>Paid Amount</th>
                    <th>Balance</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>AAF (Application Acceptance Form)</td>
                    <td>42432GGR</td>
                    <th>2022 Jan 03</th>
                    <th>400 Euro</th>
                    <th>250 Euro</th>
                    <th>150 Euro</th>
                    <th><span class="badge badge-primary">Partially Paid</span></th>
                    <th>
                        <button type="button" class="btn btn-warning btn-icon-text btn-sm"><i class="btn-icon-prepend" data-feather="download"></i>Invoice</button>
                    </th>
                </tr>
                <tr>
                    <td>Learn German Online</td>
                    <td>42432GGR</td>
                    <th>2022 Jan 03</th>
                    <th>400 Euro</th>
                    <th>250 Euro</th>
                    <th>150 Euro</th>
                    <th><span class="badge badge-success">Fully Paid</span></th>
                    <th>
                        <button type="button" class="btn btn-warning btn-icon-text btn-sm"><i class="btn-icon-prepend" data-feather="download"></i>Invoice</button>
                    </th>
                </tr>
                </tr>
                <tr>
                    <td>Learn German Online</td>
                    <td>42432GGR</td>
                    <th>2022 Jan 03</th>
                    <th>400 Euro</th>
                    <th>250 Euro</th>
                    <th>150 Euro</th>
                    <th><span class="badge badge-danger">Not Paid</span></th>
                </tr>
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
                    <th>Course</th>
                    <th>Paid Amount</th>
                    <th>Paid Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>AAF (Application Acceptance Form)</td>
                    <th>400 Euro</th>
                    <th>2022 Jan 03</th>
                    <th><span class="badge badge-primary">Pending for admin approval</span></th>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modelpayment" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add a payment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">  
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="">Paid Date</label>
                            <input type="date" name="" id="" class="form-control">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="">Paid Amount</label>
                            <input type="number" name="" id="" class="form-control">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-warning">Save</button>
            </div>
        </div>
    </div>
</div>
@endsection