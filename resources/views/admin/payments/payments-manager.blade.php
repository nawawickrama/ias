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
                        <th scope="col">Student</th>
                        <th scope="col">Application</th>
                        <th scope="col">Ref No</th>
                        <th scope="col">Paid Date</th>
                        <th scope="col">Paid Amount</th>
                        <th scope="col">Balance</th>
                        <th scope="col">Total Fee</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td scope="row">1</td>
                        <td>Ayesh Nawawickrama</td>
                        <td><span class="badge badge-primary">LGO</span></td>
                        <td>GDND2002</td>
                        <td>2022 Jan 21</td>
                        <td>2000 Euro</td>
                        <td>200 Euro</td>
                        <td>2200 Euro</td>
                        <td><span class="badge badge-primary">Pending Verification</span></td>
                        <td>
                            <span data-toggle="tooltip" data-placement="top" title="Approve Payment">
                                <button type="button" class="btn btn-success btn-icon btn-form-submit" data-toggle="modal" data-target="#modelapp">
                                    <i data-feather="check-square"></i>
                                </button>
                            </span>
                            <span data-toggle="tooltip" data-placement="top" title="Reject Payment">
                                <button type="button" class="btn btn-warning btn-icon btn-form-submit" data-toggle="modal" data-target="#modelrej">
                                    <i data-feather="x-square"></i>
                                </button>
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Approve -->
<div class="modal fade" id="modelapp" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
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
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Yes</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Approve -->
<div class="modal fade" id="modelrej" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                Are you sure, do you want to reject this payment?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Yes</button>
            </div>
        </div>
    </div>
</div>
@endsection