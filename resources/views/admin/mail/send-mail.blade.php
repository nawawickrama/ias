@extends('layouts.dashboard.main')

@section('content')
<div class="card">
    <div class="card-header">
        <p>Send Email</p>
    </div>
    <div class="card-body">
        <form action="">
            <div class="form-row">
                <div class="form-group col-md-8">
                    <input type="text" name="" id="" placeholder="Subject" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <input type="text" name="" id="" value="nawawickrama@gmail.com" class="form-control" disabled>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <textarea placeholder="Type your message here" name="" id="" cols="30" rows="20" class="form-control"></textarea>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <button type="submit" class="btn btn-success btn-block">Send email</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
