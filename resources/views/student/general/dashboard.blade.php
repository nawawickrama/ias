@extends('layouts.dashboard.main')

@section('content')
<div class="alert alert-icon-primary" role="alert">
    <p><b>Welcome to IAS College student management portal. Please always try to complete the folling task to complete the registration process.</b></p>
    <hr>
    <br>
    <p class="text-dark"><i class="link-icon text-success" data-feather="check-circle"></i> Complete your student information <a href="{{route('studentInformation')}}">here</a>.</p>
    <p class="text-dark mt-4"><i class="link-icon text-primary" data-feather="alert-circle"></i> Upload the required documents <a href="{{route('candidateDocument')}}">here</a>.</p>
    <p class="text-dark mt-4"><i class="link-icon text-danger" data-feather="x-circle"></i> Download and upload the signed AAF form <a href="#">here</a>.</p>
    <p class="text-dark mt-4"><i class="link-icon text-danger" data-feather="x-circle"></i> Download and upload the signed LGO form <a href="#">here</a>.</p>
    <p class="text-dark mt-4"><i class="link-icon text-danger" data-feather="x-circle"></i> Complete the payments <a href="#">here</a>.</p>
</div>

@endsection
