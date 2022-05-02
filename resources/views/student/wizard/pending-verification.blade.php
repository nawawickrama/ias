@extends('layouts.dashboard.main')

@section('content')
<div class="alert alert-success" role="alert">
  <h4 class="alert-heading">Detils Succesfully Submited</h4>
  <p>Your details succesfully submited and pending for admin verification.You will be informed via protal and email once the documents reviewed. Stay connect with us.</p>
  <p class="mb-0">Thanks, <br> Management, IAS College</p>
</div>
<div class="card mt-4">
  <div class="card-header bg-primary text-white">
    <p>Document Progress</p>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Document Name</th>
            <th scope="col">Status</th>
            <th scope="col">Comments</th>
            <th scope="col">Admin Status</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">1</th>
            <td>Passport</td>
            <td>Submited</td>
            <td></td>
            <td><span class="badge badge-primary">Pending for admin approval</span></td>
            <td></td>
          </tr>
          <tr>
            <th scope="row">2</th>
            <td>National Identity Card</td>
            <td>Submited</td>
            <td></td>
            <td><span class="badge badge-success">Approved</span></td>
            <td></td>
          </tr>
          <tr>
            <th scope="row">2</th>
            <td>Driving License</td>
            <td>Submited</td>
            <td>The document is not clear</td>
            <td><span class="badge badge-danger">Rejected</span></td>
            <td>
              <button type="submit" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#resubmit">Resubmit</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="resubmit" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Resubmit Document</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="post">
          <div class="form-row">
            <div class="form-group col-md-12">
              <label>Upload Document</label>
              <input type="file" name="gg" class="file-upload-default">
              <div class="input-group col-xs-12">
                <input type="text" class="form-control file-upload-info" disabled="">
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
        <button type="button" class="btn btn-primary">Submit</button>
      </div>
    </div>
  </div>
</div>
@endsection