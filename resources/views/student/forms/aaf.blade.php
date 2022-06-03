@extends('layouts.dashboard.main')

@section('content')
    <div class="alert alert-icon-success" role="alert">
        <i data-feather="alert-circle"></i>
        <b>Congratulations! </b> You have been selected for course in IAS College. Please download,sign and upload it.
        Also, make sure to make the payment before the deadline. Please find more details about payment on <a
            href="{{route('payments-manager')}}">payment manager</a> page.
    </div>
    <div class="card">
        <div class="card-header bg-primary">
            <p class="text-white">Application Acceptance Form</p>
        </div>
        <div class="card-body">
            <div class="alert alert-icon-primary" role="alert">
                <div class="row">
                    <div class="col-md-4">
                        <form action="{{route('downloadForm')}}" method="post" id="form-download-aaf" target="_blank">
                            @csrf
                            <input type="hidden" name="form_type" value="AAF">
                            <p>Download your AAF (Application Acceptance Form) : <b><a href="javascript:" id="btn-download-aaf">HERE</a></b></p>
                        </form>
                    </div>
                    <div class="col-md-4">
                        <p>Payment Deadline : <b>{{date('d F Y', strtotime($affAccess->dead_line))}}</b></p>
                    </div>
                    <div class="col-md-4">
                        <p>Document status :
                            @if($affAccess->status === 'Not-Uploaded')<span class="badge badge-danger">Not Uploaded</span>
                            @elseif($affAccess->status === 'Rejected') <span class="badge badge-danger">Rejected</span>
                            @elseif($affAccess->status === 'Approved') <span class="badge badge-success">Approved</span>
                            @elseif($affAccess->status === 'Pending') <span class="badge badge-warning">Pending</span>
                            @endif
                        </p>
                    </div>
                </div>
            </div>
            @if((isset($affAccess) && $affAccess->status === 'Rejected'))
                <div class="alert alert-danger" role="alert">
                    <i data-feather="alert-circle"></i>
                    Rejected Reason : {{$affAccess->reject_reason}}
                </div>
            @endif
            <br>
            <form action="{{route('submitAAForm')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label>Upload your scanned copy of signed AAF :</label>
                        <input type="file" name="file" class="file-upload-default">
                        <div class="input-group col-xs-12">
                            <input type="text" class="form-control file-upload-info @error('file') is-invalid @endif"
                                   disabled=""
                                   placeholder="Upload pdf, png, jpeg or jpg" @if($affAccess->status === 'Approved' || $affAccess->status === 'Pending') {{'disabled'}} @endif>
                            <span class="input-group-append">
                            <button class="file-upload-browse btn btn-primary"
                                    type="button" @if($affAccess->status === 'Approved' || $affAccess->status === 'Pending') {{'disabled'}} @endif>Browse</button>
                        </span>
                            @error('file')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-2">
                        <input type="hidden" name="formType" value="AAF">
                        <button type="submit" class="btn btn-warning btn-block">Submit Document</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        $('#btn-download-aaf').click(function (){
             $('#form-download-aaf').trigger('submit');
        });
    </script>
@endsection
