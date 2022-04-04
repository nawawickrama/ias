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
                            <div class="form-group col-md-3">
                                <label for="">Blood Group :<span class="text-danger">*</span></label>
                                <select name="st_blood_group" id="st_blood_group">
                                    <option value="" selected disabled>Select...</option>
                                    <option value="O+">O+</option>
                                    <option value="O-">O-</option>
                                    <option value="A+">A+</option>
                                    <option value="A-">A-</option>
                                    <option value="B+">B+</option>
                                    <option value="B-">B-</option>
                                    <option value="AB+">AB+</option>
                                    <option value="AB-">AB-</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">City :<span class="text-danger">*</span></label>
                                <input type="text" name="city" id="" class="form-control">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">Country :<span class="text-danger">*</span></label>
                                <select name="country" id="country">
                                    <option value="" selected disabled>Select...</option>
                                    @foreach($countries as $country)
                                        <option value="{{$country->id}}">{{$country->id}} - {{$country->iso3}} - {{$country->nicename}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3">
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
                            <div class="form-group col-md-3">
                                <label for="">Birth Place :<span class="text-danger">*</span></label>
                                <input type="text" name="birth_place" id="" class="form-control">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">Passport No :<span class="text-danger">*</span></label>
                                <input type="text" name="passport_no" id="" class="form-control">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">Skype ID :<span class="text-danger">*</span></label>
                                <input type="text" name="skype_id" id="" class="form-control">
                            </div>
                            <div class="form-group col-md-3">
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
                                <label for="">Income :<span class="text-danger">*</span></label>
                                <input type="text" name="income" id="" class="form-control">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="">Qualification :<span class="text-danger">*</span></label>
                                <input type="text" name="qualification" id="" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Occupation :<span class="text-danger">*</span></label>
                                <input type="text" name="occupation" id="" class="form-control">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="">Home Address :<span class="text-danger">*</span></label>
                                <textarea name="homeAddress" id="homeAddress" cols="30" rows="5" class="form-control"></textarea>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Office Address :<span class="text-danger">*</span></label>
                                <textarea name="officeAddress" id="officeAddress" cols="30" rows="5" class="form-control"></textarea>
                            </div>
                        </div>

                    </section>

                    <h2>Address Verification</h2>
                    <section>

                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-row">
                                    <h4>Current Address</h4>
                                    <hr>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="">Address Line :<span class="text-danger">*</span></label>
                                        <textarea name="currentAddress" id="currentAddress" cols="30" rows="5" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="">Country :<span class="text-danger">*</span></label>
                                        <select name="currentCountry" id="currentCountry">
                                            <option value="" selected disabled>Select...</option>
                                            @foreach($countries as $country)
                                                <option value="{{$country->id}}">{{$country->nicename}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="">State :<span class="text-danger">*</span></label>
                                        <input type="text" name="currentState" id="" class="form-control">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="">City :<span class="text-danger">*</span></label>
                                        <input type="text" name="currentCity" id="" class="form-control">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="">Pincode :<span class="text-danger">*</span></label>
                                        <input type="text" name="CurrentPincode" id="" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-row">
                                    <h4>Permanent Address</h4>
                                    <hr>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="">Address Line :<span class="text-danger">*</span></label>
                                        <textarea name="permanentAddress" id="permanentAddress" cols="30" rows="5" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="">Country :<span class="text-danger">*</span></label>
                                        <select name="permanentCountry" id="permanentCountry">
                                            <option value="" selected disabled>Select...</option>
                                            @foreach($countries as $country)
                                                <option value="{{$country->id}}">{{$country->nicename}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="">State :<span class="text-danger">*</span></label>
                                        <input type="text" name="permanentState" id="" class="form-control">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="">City :<span class="text-danger">*</span></label>
                                        <input type="text" name="permanentCity" id="" class="form-control">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="">Pincode :<span class="text-danger">*</span></label>
                                        <input type="text" name="permanentPincode" id="" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </section>
                    <h2>Process Progress</h2>
                    <section>
                        <div class="alert alert-success" role="alert">
                            <h4 class="alert-heading">Well done! &#128079;</h4>
                            <p>You have succesfully submited your personal details. We will review and approve it as
                                soon as possible.</p>
                            <hr>
                            <p class="mb-0">Please stay touched with the website and email. <br>Thanks <br>IAS College.
                            </p>
                        </div>
                    </section>
                </div>
            </form>
        </div>
    </div>
@endsection
