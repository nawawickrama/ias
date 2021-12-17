@extends('layouts.dashboard.main')

@section('content')
<div class="card">
    <div class="card-header">
        <p>SMTP SETTINGS</p>
    </div>
    <div class="card-body">
        <form action="{{ route('set_smtp') }}" method="POST">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="">Host :</label>
                    <input type="text" name="host" id="" class="form-control" value="{{ isset($smtp_setting) ? $smtp_setting->MAIL_HOST : '' }}">
                </div>
                <div class="form-group col-md-6">
                    <label for="">Port :</label>
                    <input type="number" name="port" id="" class="form-control" value="{{ isset($smtp_setting) ? $smtp_setting->MAIL_PORT : '' }}">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="">Username :</label>
                    <input type="text" name="uname" id="" class="form-control" value="{{ isset($smtp_setting) ? $smtp_setting->MAIL_USERNAME : '' }}">
                </div>
                <div class="form-group col-md-6">
                    <label for="">Password :</label>
                    <input type="password" name="pword" id="" class="form-control" value="{{ isset($smtp_setting) ? $smtp_setting->MAIL_PASSWORD : '' }}">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <button type="submit" class="btn btn-success btn-block">Save Settings</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection