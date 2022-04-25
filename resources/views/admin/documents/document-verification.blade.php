@extends('layouts.dashboard.main')

@section('content')
<div class="card">
    <div class="card-header bg-primary text-white">
        <p>Filter Document</p>
    </div>
    <div class="card-body">
        <form action="" method="post">
            <div class="form-row">
                <div class="form-group col-md-8">
                    <select name="" id="" class="form-control">
                        <option value="" selected disabled>Select...</option>
                        <option value="">Pending</option>
                        <option value="">Approved</option>
                        <option value="">Rejected</option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <button type="submit" class="btn btn-block btn-success">Filter</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="card mt-4">
    <div class="card-header bg-primary text-white">
        <p>Document List</p>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="datatable-basic">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">NIC</th>
                        <th scope="col">Email</th>
                        <th scope="col">Course</th>
                        <th scope="col">Agent</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Ayesh Nawawickrama</td>
                        <td>199634603588</td>
                        <td>ayesh@prodesigner.lk</td>
                        <td>STEP</td>
                        <td>Srinmali Poornima</td>
                        <td>
                            <span class="badge badge-warning">Pending</span>
                            <span class="badge badge-success">Approved</span>
                            <span class="badge badge-danger">Rejected</span>
                        </td>
                        <td>
                            <span data-toggle="tooltip" data-placement="top" title="View Documents">
                                <button type="button" class="btn btn-dark btn-icon" data-toggle="modal" data-target="#modelact">
                                    <i data-feather="eye"></i>
                                </button>
                            </span>
                            <span data-toggle="tooltip" data-placement="top" title="View Student Information">
                                <button type="button" class="btn btn-primary btn-icon" data-toggle="modal" data-target="#modelact">
                                    <i data-feather="user"></i>
                                </button>
                            </span>
                            <span data-toggle="tooltip" data-placement="top" title="Approve Documents">
                                <button type="button" class="btn btn-success btn-icon" data-toggle="modal" data-target="#approve">
                                    <i data-feather="shield"></i>
                                </button>
                            </span>
                            <span data-toggle="tooltip" data-placement="top" title="Reject Documents">
                                <button type="button" class="btn btn-danger btn-icon" data-toggle="modal" data-target="#reject">
                                    <i data-feather="shield-off"></i>
                                </button>
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Modal approve -->
<div class="modal fade" id="approve" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure, do you want to approve this documents?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Yes</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal reject -->
<div class="modal fade" id="reject" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="form-row">
                      <div class="form-group col-md-12">
                        <label for="">Reason for rejection of documents :</label>
                        <textarea name="" id="" cols="30" rows="10" class="form-control" placeholder="write the reason here"></textarea>
                      </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Reject</button>
            </div>
        </div>
    </div>
</div>
@endsection