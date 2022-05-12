@extends('layouts.dashboard.main')

@section('content')
<div class="alert alert-icon-success" role="alert">
    <i data-feather="alert-circle"></i>
    <b>Congratulations! </b> You have been selected for course in IAS College. Please download,sign and upload it. Also, make sure to make the payment before the deadline. Please find more details about payment on <a href="{{route('payments-manager')}}">payment manager</a> page.
</div>
<div class="card">
    <div class="card-header bg-primary">
        <p class="text-white">Application Acceptance Form</p>
    </div>
    <div class="card-body">
        <div class="alert alert-icon-primary" role="alert">
            <div class="row">
                <div class="col-md-4">
                    <p>Download your AAF (Application Acceptance Form) : <b><a href="#">HERE</a></b></p>
                </div>
                <div class="col-md-4">
                    <p>Payment Deadline : <b>2022 June 03</b></p>
                </div>
                <div class="col-md-4">
                    <p>Document status : <span class="badge badge-danger">Not Uploeaded</span></p>
                </div>
            </div>
        </div>
        <br>
        <form action="" method="post">
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label>Upload your scanned copy of signed AAF :</label>
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
                <div class="form-group col-md-2">
                    <button type="submit" class="btn btn-warning btn-block">Submit Document</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection