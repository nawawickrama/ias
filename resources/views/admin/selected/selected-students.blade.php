@extends('layouts.dashboard.main')

@section('content')
<div class="card">
    <div class="card-header bg-primary text-white">
        <p>Selected Students</p>
    </div>
    <div class="card-body">
        <div class="responsive">
            <table class="table table-bordered" id="datatable-basic">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Program</th>
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
                            <span data-toggle="tooltip" data-placement="top" title="Send Learn German Online (LGO) Form">
                                <button type="button" class="btn btn-primary btn-icon" data-toggle="modal" data-target="#modellgo">
                                    <i data-feather="check-square"></i>
                                </button>
                            </span>
                            <span data-toggle="tooltip" data-placement="top" title="Send Application Acceptance Form (AAF)">
                                <button type="button" class="btn btn-success btn-icon" data-toggle="modal" data-target="#modelaaf">
                                    <i data-feather="check-square"></i>
                                </button>
                            </span>
                            <span data-toggle="tooltip" data-placement="top" title="Login As This Student">
                                <button type="button" class="btn btn-danger btn-icon">
                                    <i data-feather="user"></i>
                                </button>
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Lgo-->
<div class="modal fade" id="modellgo" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmation - LGO</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="">Reference :</label>
                            <input type="text" name="" id="" class="form-control">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="">Deadline :</label>
                            <input type="date" name="" id="" class="form-control">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Send it</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal AAF-->
<div class="modal fade" id="modelaaf" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmation - AAF</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="">Reference :</label>
                            <input type="text" name="" id="" class="form-control">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="">Deadline :</label>
                            <input type="date" name="" id="" class="form-control">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Send it</button>
            </div>
        </div>
    </div>
</div>
@endsection
