@extends('layouts.dashboard.main')

@section('content')
<div class="card">
    <div class="card-header bg-primary">
        <div class="row">
            <div class="col-md-10">
                <p class="text-white">Submit Documents</p>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-warning btn-icon-text btn-block" data-toggle="modal" data-target="#modelupd"><i class="btn-icon-prepend" data-feather="upload"></i>Submit Documents</button>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr class="bg-dark">
                        <th class="text-white">ID</th>
                        <th class="text-white">Document Name</th>
                        <th class="text-white">Status</th>
                        <th class="text-white">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td scope="row">1</td>
                        <td>National Identity Card</td>
                        <td><span class="badge badge-warning">Not submitted</span></td>
                        <td>No action needed</td>
                    </tr>
                    <tr>
                        <td scope="row">2</td>
                        <td>Copy of Passport</td>
                        <td><span class="badge badge-primary">Pending for approval</span></td>
                        <td>No action needed</td>
                    </tr>
                    <tr>
                        <td scope="row">3</td>
                        <td>Birth Certificate</td>
                        <td><span class="badge badge-danger">Rejected</span> Reason : Unclear document</td>
                        <td>
                            <button type="submit" class="btn btn-sm btn-warning">Re-submit document</button>
                        </td>
                    </tr>
                    <tr>
                        <td scope="row">4</td>
                        <td>Copy of Passport</td>
                        <td><span class="badge badge-success">Approved</span></td>
                        <td>No action needed</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modelupd" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Submit Documents</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-icon-danger" role="alert"><i data-feather="alert-circle"></i><b>WARNING :</b> Please fill all the required <a href="{{route('information')}}">student information</a> before submit the documents.</div>
                <form action="" method="post">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>Scanned copy of your national identity card :</label>
                            <input type="file" name="img[]" class="file-upload-default">
                            <div class="input-group col-xs-12">
                                <input type="text" class="form-control file-upload-info" disabled="" placeholder="Upload pdf">
                                <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>Scanned copy of your passport :</label>
                            <input type="file" name="img[]" class="file-upload-default">
                            <div class="input-group col-xs-12">
                                <input type="text" class="form-control file-upload-info" disabled="" placeholder="Upload pdf">
                                <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                </span>
                            </div>
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