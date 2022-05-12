@extends('layouts.dashboard.main')

@section('content')
    @if($candidateDetails->isComplete === 'Yes' && $guardianDetails->isComplete === 'Yes')
        <div class="alert alert-icon-success" role="alert">
            <i data-feather="check-circle"></i>
            <b>TIP :</b> Please complete all the required fields. Once you fill all the details, you will get a success message.
        </div>
    @else
        <div class="alert alert-icon-primary" role="alert">
            <i data-feather="alert-circle"></i>
            <b>TIP :</b> Please complete all the required fields. Once you fill all the details, you will get a success message.
        </div>
    @endif

<div class="card">
    <div class="card-header bg-primary">
        <div class="row">
            <div class="col md-8">
                <p class="text-white">Basic Information</p>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-warning btn-icon-text btn-block" data-toggle="modal" data-target="#modelb"><i class="btn-icon-prepend" data-feather="edit"></i>Edit Details</button>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-3">
                <p><b>Name :</b> {{$candidateDetails->first_name}}</p>
            </div>
            <div class="col-md-3">
                <p><b>Surname :</b> {{$candidateDetails->sur_name}}</p>
            </div>
            <div class="col-md-3">
                <p><b>Date of Birth :</b> {{date('d F Y', strtotime($candidateDetails->dob))}}</p>
            </div>
            <div class="col-md-3">
                <p><b>Mobile Number :</b> {{$candidateDetails->telephone}}</p>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-3">
                <p><b>Address :</b> {{$candidateDetails->address}}</p>
            </div>
            <div class="col-md-3">
                <p><b>City :</b> {{$candidateDetails->city}}</p>
            </div>
            <div class="col-md-3">
                <p><b>State/Province/Region :</b> {{$candidateDetails->state}}</p>
            </div>
            <div class="col-md-3">
                <p><b>Zip Code :</b> {{$candidateDetails->zipcode}}</p>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-3">
                <p><b>Country :</b> {{$candidateDetails->countryInfo->nicename}}</p>
            </div>
            <div class="col-md-3">
                <p><b>Nationality :</b> {{$candidateDetails->nationalityInfo->nicename}}</p>
            </div>
            <div class="col-md-3">
                <p><b>Passport Number :</b> {{$candidateDetails->passport_no ?? 'N/A'}}</p>
            </div>
            <div class="col-md-3">
                <p><b>WhatsApp Number :</b> {{$candidateDetails->whatsapp_no ?? 'N/A'}}</p>
            </div>
        </div>
    </div>
</div>
<div class="card mt-4">
    <div class="card-header bg-primary">
        <div class="row">
            <div class="col md-8">
                <p class="text-white">Guardian Information</p>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-warning btn-icon-text btn-block" data-toggle="modal" data-target="#modelg"><i class="btn-icon-prepend" data-feather="edit"></i>Edit Details</button>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-3">
                <p><b>Title :</b>{{ $guardianDetails->guardian_title ?? 'N/A' }}</p>
            </div>
            <div class="col-md-3">
                <p><b>First Name :</b> {{ $guardianDetails->guardian_firstName ?? 'N/A' }}</p>
            </div>
            <div class="col-md-3">
                <p><b>Last Name :</b> {{ $guardianDetails->guardian_lastName ?? 'N/A' }}</p>
            </div>
            <div class="col-md-3">
                <p><b>Email Address :</b> {{ $guardianDetails->guardian_email ?? 'N/A' }}</p>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-3">
                <p><b>Home Phone Number :</b> {{ $guardianDetails->guardian_phoneNo ?? 'N/A' }}</p>
            </div>
            <div class="col-md-3">
                <p><b>Mobile Number :</b> {{ $guardianDetails->guardian_mobileNo ?? 'N/A' }}</p>
            </div>
            <div class="col-md-3">
                <p><b>Relationship :</b> {{ $guardianDetails->relationship ?? 'N/A' }}</p>
            </div>
            <div class="col-md-3">
                <p><b>Occupation :</b> {{ $guardianDetails->occupation ?? 'N/A' }}</p>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-12">
                <p><b>Residence Address :</b> {{ $guardianDetails->home_address ?? 'N/A' }}</p>
            </div>
        </div>
    </div>
</div>

@include('student.registration.modals')

@endsection
