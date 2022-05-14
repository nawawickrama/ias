@extends('layouts.dashboard.main')

@section('content')
<div class="card">
    <div class="card-header bg-primary text-white">
        <p>Document Verification for LGO & AAF</p>
    </div>
    <div class="card-body">
        <div class="responsive">
            <table class="table table-bordered" id="datatable-basic">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Program</th>
                        <th scope="col">LOG / AAF</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Agent</th>
                        <th scope="col">Country</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>

                        <td>1</td>
                        <td>STEP Program</td>
                        <td>
                            <span class="badge badge-primary">LGO</span>
                        </td>
                        <td>Ayesh Nawawickrama</td>
                        <td>nawawickrama@gmail.com</td>
                        <td>Srimali Poornima</td>
                        <td>Sri Lanka</td>
                        <td>
                            <span class="badge badge-warning">Not Sent</span>
                            <span class="badge badge-primary">AAF Sent</span>
                            <span class="badge badge-success">LGO Sent</span>
                        </td>
                        <td>
                            <span data-toggle="tooltip" data-placement="top" title="Approve Document">
                                <button type="button" class="btn btn-success btn-icon" data-toggle="modal" data-target="#modelapp">
                                    <i data-feather="check-square"></i>
                                </button>
                            </span>
                            <span data-toggle="tooltip" data-placement="top" title="Reject Document">
                                <button type="button" class="btn btn-danger btn-icon" data-toggle="modal" data-target="#modelrej">
                                    <i data-feather="x-square"></i>
                                </button>
                            </span>
                            <span data-toggle="tooltip" data-placement="top" title="View Signed Document">
                                <button type="button" class="btn btn-warning btn-icon">
                                    <i data-feather="eye"></i>
                                </button>
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Approve-->
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
            <div class="row">
                    <div class="col-md-12">
                        <p>Are you sure do you need to approve this application?</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Approve</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Reject-->
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
                <div class="row">
                    <div class="col-md-12">
                        <p>Are you sure do you need to reject this application? (Please mention the reason below)</p>
                    </div>
                </div>
                <br>
                <form action="" method="post">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="">Reason :</label>
                            <textarea name="" id="" cols="30" rows="5" class="form-control"></textarea>
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