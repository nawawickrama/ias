@extends('layouts.dashboard.main')

@section('content')

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>
<div class="card">
    <div class="card-header bg-primary text-white">
        <p>Student Registration</p>
    </div>
    <div class="card-body">
        <form action="" method="post" id="formStep1">
            <div id="wizard">
                <h2>Basic Information</h2>
                <section>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="">Course you have been applied for :<span class="text-danger">*</span></label>
                            <input type="text" name="course" id="" class="form-control bg-white" value="STEP - Study Eligibility Program" disabled>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="">Name :<span class="text-danger">*</span></label>
                            <input type="text" name="st_name" id="" class="form-control" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="">Mobile Number :<span class="text-danger">*</span></label>
                            <input type="text" name="st_phone_no" id="" class="form-control">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="">Date of Birth :<span class="text-danger">*</span></label>
                            <input type="date" name="st_dob" id="" class="form-control">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="">Sex :<span class="text-danger">*</span></label>
                            <select name="sex" id="sex">
                                <option value="" selected disabled>Select...</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="">Address Line :<span class="text-danger">*</span></label>
                            <input type="text" name="addressline" id="" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">City :<span class="text-danger">*</span></label>
                            <input type="text" name="city" id="" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">State / Province / Region :<span class="text-danger">*</span></label>
                            <input type="text" name="spr" id="" class="form-control">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="">Zip Code :<span class="text-danger">*</span></label>
                            <input type="text" name="zip" id="" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Country :<span class="text-danger">*</span></label>
                            <select name="country" id="country">
                                <option value="" selected disabled>Select...</option>
                                @foreach($countries as $country)
                                <option value="{{$country->id}}">{{$country->id}} - {{$country->iso3}} - {{$country->nicename}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Nationality :<span class="text-danger">*</span></label>
                            <select name="nationality" id="nationality">
                                <option value="" selected disabled>Select...</option>
                                @foreach($countries as $country)
                                <option value="{{$country->id}}">{{$country->nicename}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <label for="">Passport No :<span class="text-danger">*</span></label>
                            <input type="text" name="passport_no" id="" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Whatsapp Number :<span class="text-danger">*</span></label>
                            <input type="text" name="whatsapp_no" id="" class="form-control">
                        </div>
                    </div>
                </section>

                <h2>Guardian Information</h2>
                <section>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="">Title :<span class="text-danger">*</span></label>
                            <select name="guardian_title" id="guardian_title">
                                <option value="" selected disabled>Select...</option>
                                <option value="Mr">Mr</option>
                                <option value="Ms">Ms</option>
                                <option value="Mrs">Mrs</option>
                                <option value="Dr">Dr</option>
                                <option value="Prof">Prof</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="">First Name :<span class="text-danger">*</span></label>
                            <input type="text" name="guardian_firstName" id="" class="form-control">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="">Last Name :<span class="text-danger">*</span></label>
                            <input type="text" name="guardian_lastName" id="" class="form-control">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="">Email Address :<span class="text-danger">*</span></label>
                            <input type="email" name="guardian_email" id="" class="form-control">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="">Phone Number :<span class="text-danger">*</span></label>
                            <input type="text" name="guardian_phoneNo" id="" class="form-control">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="">Mobile Number :<span class="text-danger">*</span></label>
                            <input type="text" name="guardian_mobileNo" id="" class="form-control">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="">Relationship :<span class="text-danger">*</span></label>
                            <input type="text" name="relationship" id="" class="form-control">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="">Occupation :<span class="text-danger">*</span></label>
                            <input type="text" name="occupation" id="" class="form-control">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="">Home Address :<span class="text-danger">*</span></label>
                            <textarea name="homeAddress" id="homeAddress" cols="30" rows="5" class="form-control"></textarea>
                        </div>
                    </div>

                </section>

                <h2>Document Verification</h2>
                <section>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>Upload all the documents</label>
                            <input type="file" name="img[]" class="file-upload-default">
                            <div class="input-group col-xs-12">
                                <input type="text" class="form-control file-upload-info bg-white" disabled="" placeholder="Upload Image">
                                <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                </span>
                            </div>
                        </div>
                        <div class="form-check col-md-12">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="document" id="" value="checkedValue" checked>
                                Passport
                            </label>
                        </div>
                        <div class="form-check col-md-12">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="document" id="" value="checkedValue" checked>
                                Birth Certificate
                            </label>
                        </div>
                        <div class="form-check col-md-12">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="document" id="" value="checkedValue" checked>
                                APF
                            </label>
                        </div>
                        <div class="form-check col-md-12">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="document" id="" value="checkedValue" checked>
                                Passport
                            </label>
                        </div>
                    </div>
                </section>
            </div>
        </form>
    </div>
</div>
@endsection