@extends('layouts.dashboard.main')

@section('content')
<div class="alert alert-icon-primary" role="alert">
    <p><b>Welcome to IAS College student management portal. Please always try to complete the following task to complete the registration process.</b></p>
    <hr>
    <br>
    <p class="text-dark">@if($isCompleteStudentInfo)<i class="link-icon text-success" data-feather="check-circle"></i> Completed student information. @else <i class="link-icon text-danger" data-feather="x-circle"></i> Complete your student information <a href="{{route('studentInformation')}}">here</a>.@endif</p>
    <p class="text-dark mt-4">@if($isDocumentsComplete)<i class="link-icon text-success" data-feather="check-circle"></i> Completed upload required documents. @else<i class="link-icon text-danger" data-feather="x-circle"></i> Upload the required documents <a href="{{route('candidateDocument')}}">here</a>.@endif</p>
    <p class="text-dark mt-4">@if($isAAFComplete)<i class="link-icon text-success" data-feather="check-circle"></i> Completed AA Form @else<i class="link-icon text-danger" data-feather="x-circle"></i> Download and upload the signed AAF form <a href="{{route('aaf')}}">here</a>.@endif</p>
    <p class="text-dark mt-4">@if($isLGOComplete)<i class="link-icon text-success" data-feather="check-circle"></i> Completed LGO Form @else<i class="link-icon text-danger" data-feather="x-circle"></i> Download and upload the signed LGO form <a href="{{route('lgo')}}">here</a>.@endif</p>
    @if(count($candidateCheckPayment) > 0)<p class="text-dark mt-4">@if($isPaymentComplete)<i class="link-icon text-success" data-feather="check-circle"></i> Completed Payments @else<i class="link-icon text-danger" data-feather="x-circle"></i> Complete the payments <a href="{{route('payments-manager')}}">here</a>.@endif</p>@endif
</div>

@endsection
