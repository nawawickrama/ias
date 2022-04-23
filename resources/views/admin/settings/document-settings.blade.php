@extends('layouts.dashboard.main')

@section('content')
<div class="card">
    <div class="card-header bg-primary text-white">
        <p>Document Settings</p>
    </div>
    <div class="card-body">
        <form action="" method="post">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="">Document Name :</label>
                    <input type="text" name="" id="" class="form-control">
                </div>
                <div class="form-group col-md-6">
                    <label for="">Course :</label>
                    <select name="" id="" class="form-control">
                        <option value="" selected disabled>Select...</option>
                        <option value="">STEP</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <button type="submit" class="btn btn-success btn-block">Add Document</button>
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
                        <th scope="col">Document Name</th>
                        <th scope="col">Course</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Passport Validation</td>
                        <td>STEP - Study Eligibility Program</td>
                        <td><span class="badge badge-success">Active</span></td>
                        <td>
                            <span data-toggle="tooltip" data-placement="top" title="Deactivate Document">
                                <button type="button" class="btn btn-danger btn-icon" data-toggle="modal" data-target="#modeldeact">
                                    <i data-feather="shield-off"></i>
                                </button>
                            </span>
                            <span data-toggle="tooltip" data-placement="top" title="Activate Document">
                                <button type="button" class="btn btn-success btn-icon" data-toggle="modal" data-target="#modelact">
                                    <i data-feather="shield"></i>
                                </button>
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Deactivate Modal -->
<div class="modal fade" id="modeldeact" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                Do you need to deactivate this document?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
<!-- Activate Modal -->
<div class="modal fade" id="modelact" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                Do you need to activate this document?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
@endsection