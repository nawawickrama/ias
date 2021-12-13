@extends('layouts.dashboard.main')

@section('content')
<div class="card">
    <div class="card-header">
        <p>SMTP SETTINGS</p>
    </div>
    <div class="card-body">
        <form action="">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="">Host :</label>
                    <input type="text" name="" id="" class="form-control">
                </div>
                <div class="form-group col-md-6">
                    <label for="">Port :</label>
                    <input type="number" name="" id="" class="form-control">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="">Username :</label>
                    <input type="text" name="" id="" class="form-control">
                </div>
                <div class="form-group col-md-6">
                    <label for="">Password :</label>
                    <input type="password" name="" id="" class="form-control">
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