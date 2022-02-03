@extends('layouts.dashboard.main')

@section('content')
<div class="card">
    <div class="card-header bg-primary text-white">
        <p>Profile</p>
    </div>
    <div class="card-body">
        <form action="">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="">Name :</label>
                    <input type="text" name="" id="" class="form-control">
                </div>
                <div class="form-group col-md-6">
                    <label for="">Email :</label>
                    <input type="text" name="" id="" class="form-control">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="">New Password :</label>
                    <input type="password" name="" id="" class="form-control">
                </div>
                <div class="form-group col-md-6">
                    <label for="">Confirm New Password :</label>
                    <input type="password" name="" id="" class="form-control">
                </div>
            </div>
        </form>
    </div>
</div>
@endsection