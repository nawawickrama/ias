@extends('layouts.front.main')

@section('content')
    <div class="container">
        <div class="row mt-4">
            <div class="card col-md-12">
                <div class="card-header">
                    <img src="https://iaos.de/wp-content/uploads/2019/03/logo.png" class="rounded mx-auto d-block" alt="...">
                    <p class="text-center mt-2">IAS College - Candidate Profile Form (CPF)</p>
                </div>
                <di class="card-body">

                    <form action="{{ route('cpf_post') }}" method="POST" id="form-data">
                        @csrf
                        <div class="form-row">
                            <p class="font-weight-bold">Select the program</p>
                        </div>
                        <div class="form-row mt-2">
                            @foreach ($course_details as $course)
                                <div class="form-check col-md-12">
                                    <label class="form-check-label  @error('course_id') text-danger @enderror">
                                        <input type="radio" class="form-check-input program-radio" name="course_id" id=""
                                            course-code="{{ $course->course_code }}" value="{{ $course->course_id }}"
                                            @if (old('course_id') ?? $lead_details->lead_couse_id ?? '' == $course->course_id) {{ 'checked' }} @endif>
                                        {{ $course->course_code }} - {{ $course->course_description }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <div class="form-row" id='job_field'>
                            <div class="form-group col-md-12">
                                <label for="">Which Field</label>
                                <input type="text" class="form-control @error('job_feild') is-invalid @enderror"
                                    name="job_feild" id="which_job" aria-describedby="helpId" placeholder=""
                                    value="{{ old('job_feild') }}">
                                @error('job_feild')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row mt-4">
                            <p class="font-weight-bold">Personal Details</p>
                        </div>
                        <div class="form-row mt-2">
                            <div class="form-group col-md-6">
                                <label>First Name :</label>
                                <input type="text" class="form-control @error('first_name') is-invalid @enderror"
                                    name="first_name" id="" aria-describedby="helpId" value="{{ old('first_name') ?? $lead_details->lead_first_name ?? '' }}">
                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                            <div class="form-group col-md-6">
                                <label>Surname : </label>
                                <input type="text" class="form-control @error('sur_name') is-invalid @enderror"
                                    name="sur_name" id="" aria-describedby="helpId" placeholder=""
                                    value="{{ old('sur_name') ?? $lead_details->lead_sur_name ?? ''}}">
                                @error('sur_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="">Sex :</label>
                                <select class="form-control @error('sex') is-invalid @enderror" name="sex" id="">
                                    <option selected disabled>Select</option>
                                    <option value="1" @if (old('sex') != null && old('sex') == 1) {{ 'selected' }} @endif>Male</option>
                                    <option value="0" @if (old('sex') != null && old('sex') == 0) {{ 'selected' }} @endif>Female</option>
                                </select>
                                @error('sex')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label>Date of birth : </label>
                                <input type="date" class="form-control @error('dob') is-invalid @enderror" name="dob" id=""
                                    aria-describedby="helpId" placeholder="" value="{{ old('dob') }}">
                                @error('dob')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>Nationality / Nationalities:</label>
                                <input type="text" class="form-control @error('nationality') is-invalid @enderror"
                                    name="nationality" id="" aria-describedby="helpId" placeholder=""
                                    value="{{ old('nationality') }}">
                                @error('nationality')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Telephone number (with ISD code) :</label>
                                <input type="number" class="form-control @error('telephone') is-invalid @enderror"
                                    name="telephone" id="" aria-describedby="helpId" placeholder="Country Code & number"
                                    value="{{ old('telephone') ?? $lead_details->lead_contact ?? ''}}">
                                @error('telephone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label>Email :</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                    id="" aria-describedby="helpId" placeholder="" value="{{ old('email') ?? $lead_details->lead_email ?? ''}}">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="">Address :</label>
                                <input type="text" class="form-control @error('address') is-invalid @enderror"
                                    name="address" id="" aria-describedby="helpId" placeholder="Address Line 1"
                                    value="{{ old('address') }}">
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control @error('city') is-invalid @enderror" name="city"
                                    id="" aria-describedby="helpId" placeholder="City" value="{{ old('city') ?? $lead_details->lead_city ?? ''}}">
                                @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control @error('province') is-invalid @enderror"
                                    name="province" id="" aria-describedby="helpId" placeholder="State / Province / Region"
                                    value="{{ old('province') }}">
                                @error('province')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control @error('zip') is-invalid @enderror" name="zip" id=""
                                    aria-describedby="helpId" placeholder="Zip / Postal code" value="{{ old('zip') }}">
                                @error('zip')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <select name="country" id="country"
                                    class="js-example-basic-single w-100 @error('country') is-invalid @enderror">
                                    <option selected disabled>Select Country</option>
                                    @foreach ($country as $cou)
                                        <option value="{{ $cou->id }}" @if (old('country') ?? $lead_details->lead_country_id ?? '' == $cou->id) {{ 'selected' }} @endif>
                                            {{ $cou->nicename }}</option>
                                    @endforeach
                                </select>
                                @error('country')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row mt-4">
                            <p class="font-weight-bold">Educational Background</p>
                        </div>
                        <div class="form-row mt-2">
                            <div class="form-group col-md-4">
                                <label for="">Secondary Schooling :</label>
                                <select class="form-control @error('secondary_school') is-invalid @enderror"
                                    name="secondary_school" id="">
                                    <option disabled selected>Select</option>
                                    <option value="O level" @if (old('secondary_school') == 'O level') {{ 'selected' }} @endif>O Level</option>
                                    <option value="10 years" @if (old('secondary_school') == '10 years') {{ 'selected' }} @endif>10 Years</option>
                                </select>
                                @error('secondary_school')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-2">
                                <label for="">From :</label>
                                <input type="number" name="sec_from"
                                    class="form-control @error('sec_from') is-invalid @enderror" id=""
                                    aria-describedby="helpId" placeholder="" value="{{ old('sec_from') }}">
                                @error('sec_from')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-2">
                                <label for="">To :</label>
                                <input type="number" name="sec_to"
                                    class="form-control @error('sec_to') is-invalid @enderror" id=""
                                    aria-describedby="helpId" placeholder="" value="{{ old('sec_to') }}">
                                @error('sec_to')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="">Overall Result Percentage (%)</label>
                                <input type="number" name="sec_result"
                                    class="form-control @error('sec_result') is-invalid @enderror" id=""
                                    aria-describedby="helpId" placeholder="" value="{{ old('sec_result') }}">
                                @error('sec_result')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="">Higher Secondary Schooling :</label>
                                <select name="higher_sec_school"
                                    class="form-control @error('higher_sec_school') is-invalid @enderror" id="">
                                    <option disabled selected>Select</option>
                                    <option value="A level" @if (old('higher_sec_school') == 'A level') {{ 'selected' }} @endif>A Level</option>
                                    <option value="12 years" @if (old('higher_sec_school') == '12 years') {{ 'selected' }} @endif>12 Years</option>
                                </select>
                                @error('higher_sec_school')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-2">
                                <label for="">From :</label>
                                <input type="number" name="higher_from"
                                    class="form-control @error('higher_from') is-invalid @enderror" id=""
                                    aria-describedby="helpId" placeholder="" value="{{ old('higher_from') }}">
                                @error('higher_from')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-2">
                                <label for="">To :</label>
                                <input type="number" name="higher_to"
                                    class="form-control @error('higher_to') is-invalid @enderror" id=""
                                    aria-describedby="helpId" placeholder="" value="{{ old('higher_to') }}">
                                @error('higher_to')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="">Overall Result Percentage (%)</label>
                                <input type="number" name="higher_result"
                                    class="form-control @error('higher_result') is-invalid @enderror" id=""
                                    aria-describedby="helpId" placeholder="" value="{{ old('higher_result') }}">
                                @error('higher_result')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-check col-md-12">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="v_training_tick"
                                        id="vocational_check_box" value="1" @if (old('v_training_tick') == 1) {{ 'checked' }} @endif>
                                    Vocational Training?
                                </label>
                            </div>
                        </div>
                        <div id="vocational_fields">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="">Field of the vocational training</label>
                                    <input type="text" name="v_field"
                                        class="form-control @error('v_field') is-invalid @enderror" id="vocational"
                                        aria-describedby="helpId" placeholder="" value="{{ old('v_field') }}">
                                    @error('v_field')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Year of completion</label>
                                    <input type="number" name="v_complete_year"
                                        class="form-control @error('v_complete_year') is-invalid @enderror" id=""
                                        aria-describedby="helpId" placeholder="" value="{{ old('v_complete_year') }}">
                                    @error('v_complete_year')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="">Overall Result Percentage (%)</label>
                                    <input type="number" name="v_result"
                                        class="form-control @error('v_result') is-invalid @enderror" id=""
                                        aria-describedby="helpId" placeholder="" value="{{ old('v_result') }}">
                                    @error('v_result')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Duration of the vocational training (Months)</label>
                                    <input type="number" name="v_duration"
                                        class="form-control @error('v_duration') is-invalid @enderror" id=""
                                        aria-describedby="helpId" placeholder="" value="{{ old('v_duration') }}">
                                    @error('v_duration')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-row mt-4">
                            <p class="font-weight-bold">Bachelors</p>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="">Name of the university :</label>
                                <input type="text" name="b_uni" class="form-control @error('b_uni') is-invalid @enderror"
                                    id="" aria-describedby="helpId" placeholder="" value="{{ old('b_uni') }}">
                                @error('b_uni')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Major subject :</label>
                                <input type="text" name="b_major_sub"
                                    class="form-control @error('b_major_sub') is-invalid @enderror" id=""
                                    aria-describedby="helpId" placeholder="" value="{{ old('b_major_sub') }}">
                                @error('b_major_sub')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="">Years of the degree program</label>
                                <input type="number" name="b_year"
                                    class="form-control @error('b_year') is-invalid @enderror" id=""
                                    aria-describedby="helpId" placeholder="" value="{{ old('b_year') }}">
                                @error('b_year')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Overall result percentage (%)</label>
                                <input type="number" name="b_result"
                                    class="form-control @error('b_result') is-invalid @enderror" id=""
                                    aria-describedby="helpId" placeholder="" value="{{ old('b_result') }}">
                                @error('b_result')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row mt-4">
                            <p class="font-weight-bold">Masters</p>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="">Name of the university :</label>
                                <input type="text" class="form-control @error('m_uni') is-invalid @enderror" name="m_uni"
                                    id="" aria-describedby="helpId" placeholder="" value="{{ old('m_uni') }}">
                                @error('m_uni')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Major subject :</label>
                                <input type="text" name="m_major_sub"
                                    class="form-control @error('m_major_sub') is-invalid @enderror" id=""
                                    aria-describedby="helpId" placeholder="" value="{{ old('m_major_sub') }}">
                                @error('m_major_sub')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="">Years of the degree program</label>
                                <input type="number" name="m_year"
                                    class="form-control @error('m_year') is-invalid @enderror" id=""
                                    aria-describedby="helpId" placeholder="" value="{{ old('m_year') }}">
                                @error('m_year')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Overall result percentage (%)</label>
                                <input type="number" name="m_result"
                                    class="form-control @error('m_result') is-invalid @enderror" id=""
                                    aria-describedby="helpId" placeholder="" value="{{ old('m_result') }}">
                                @error('m_result')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-check col-md-12">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="w_experience_tick"
                                        id="expirience_box" value="1" @if (old('w_experience_tick') == 1) checked @endif>
                                    Working experience?
                                </label>
                            </div>
                        </div>
                        <div id="expirience_field">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="">Name of the field that you work :</label>
                                    <input name="w_exp_field" type="text"
                                        class="form-control @error('w_exp_field') is-invalid @enderror"
                                        id="expirience_text" aria-describedby="helpId" placeholder=""
                                        value="{{ old('w_exp_field') }}">
                                    @error('w_exp_field')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">How many years of experience? :</label>
                                    <input type="number" class="form-control @error('w_year') is-invalid @enderror"
                                        name="w_year" id="" aria-describedby="helpId" placeholder=""
                                        value="{{ old('w_year') }}">
                                    @error('w_year')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-row mt-4">
                            <p class="font-weight-bold">Language proficiency & other details</p>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="">German language proficiency (please include certified copies of certificates)
                                    Have your learnt German? :</label>
                                <br>
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label @error('german_language') text-danger @enderror">
                                        <input class="form-check-input Ge_lang" type="radio" name="german_language"
                                            id="Ge_lang_yes" value="1" @if (old('german_language') == 1) {{ 'checked' }} @endif> Yes
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label @error('german_language') text-danger @enderror">
                                        <input class="form-check-input Ge_lang" type="radio" name="german_language"
                                            id="Ge_lang_no" value="0" @if (old('german_language') == 0 && old('german_language') != null) {{ 'checked' }} @endif> No
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-row" id="ge_level_field">
                            <div class="form-group col-md-12">
                                <label for="">Which level? :</label>
                                <br>
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label @error('german_level') text-danger @enderror">
                                        <input type="radio" name="german_level" class="form-check-input" id="" value="A1"
                                            @if (old('german_level') == 'A1') {{ 'checked' }} @endif> A1
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label @error('german_level') text-danger @enderror">
                                        <input class="form-check-input" type="radio" name="german_level" id="" value="A2"
                                            @if (old('german_level') == 'A2') {{ 'checked' }} @endif> A2
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label @error('german_level') text-danger @enderror">
                                        <input class="form-check-input" type="radio" name="german_level" id="" value="B1"
                                            @if (old('german_level') == 'B1') {{ 'checked' }} @endif> B1
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label @error('german_level') text-danger @enderror">
                                        <input class="form-check-input" type="radio" name="german_level" id="" value="B2"
                                            @if (old('german_level') == 'B2') {{ 'checked' }} @endif> B2
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label @error('german_level') text-danger @enderror">
                                        <input class="form-check-input" type="radio" name="german_level" id="" value="C1"
                                            @if (old('german_level') == 'C1') {{ 'checked' }} @endif> C1
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label @error('german_level') text-danger @enderror">
                                        <input class="form-check-input" type="radio" name="german_level" id="" value="C2"
                                            @if (old('german_level') == 'C2') {{ 'checked' }} @endif> C2
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="">How did you come to know about IAS College? :</label>
                                <br>
                                @isset($reference_no)
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label @error('how_to_know') text-danger @enderror">
                                            <input class="form-check-input how_to_know" type="radio" name="how_to_know" checked
                                                value="Agent/Educational Consultancy"> Agent /
                                            Educational Consultancy
                                        </label>
                                    </div>
                                @endisset

                                @if (!isset($reference_no))
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label @error('how_to_know') text-danger @enderror">
                                            <input class="form-check-input how_to_know" type="radio" name="how_to_know"
                                                id="" value="Facebook Advertiesments" @if (old('how_to_know') == 'Facebook Advertiesments') {{ 'checked' }} @endif> Facebook
                                            Advertiesments

                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label @error('how_to_know') text-danger @enderror">
                                            <input class="form-check-input how_to_know" type="radio" name="how_to_know"
                                                id="" value="Promotional Email" @if (old('how_to_know') == 'Promotional Email') {{ 'checked' }} @endif> Promotional Email
                                        </label>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-row" id="agent_field">
                            @isset($reference_no)
                                <div class="form-group col-md-12">
                                    <label for="">Name of the agent or education consultancy (If you know IAS college from agent
                                        or education consultancy) :</label>
                                    @php
                                        $agent_name = $agent_details->user;
                                    @endphp
                                    <select name="agent_id" id="agent_text"
                                        class="form-control @error('agent_id') is-invalid @enderror" readonly>
                                        <option value="{{ $agent_details->agent_id }}">{{ $agent_name->name }}</option>
                                    </select>

                                    @error('agent_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            @endisset
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="">If you wish to provide any further reasons for your application, please use
                                    the comment box :</label>
                                <textarea type="text" class="form-control @error('comment') is-invalid @enderror"
                                    name="comment" id="" aria-describedby="helpId" placeholder=""
                                    rows="5">{{ old('comment') }}</textarea>
                                @error('comment')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <p>Declaration

                                    I confirm that to the best of my knowledge the information I have provided on this form
                                    is true, complete and accurate. I am aware that intentionally or negligently providing
                                    false information constitutes an administrative offence and may lead to exclusion from
                                    the admissions procedure or – if discovered at a later date – to the cancellation of my
                                    admission or enrollment. I confirm that I have read the admission information for my
                                    desired course from the IAS College GmbH Homepage. <br><br>

                                    In the case this application is sent to uni‐assist, I hereby confirm that I have read
                                    and accept the general terms and conditions (AGB) provided by uni‐assist e.V. on
                                    www.uni-assist.de/agb/. <br><br>

                                    Please Note - All information provided herein will be stored and processed by the
                                    college/university. They are fully subject to the data protection regulations currently
                                    in effect. By clicking the submit button below, you confirm your agreement with these
                                    terms. <br><br>

                                    Once you are selected for admission, you are required to substantiate with certified
                                    copies and translations (German or English) of your certificates. Important: All
                                    certificates must be Notary attested.</p>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label  @error('agree') text-danger @enderror">
                                        <input class="form-check-input" type="checkbox" name="agree" id="aggree"
                                            value="I agree to all terms and conditions" required> I agree to all terms and
                                        conditions
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <button type="submit" class="btn btn-primary btn-block btn-submit">Submit
                                    Application</button>
                            </div>
                        </div>
                    </form>
                </di>
            </div>
        </div>
    </div>

    <script>
        $('document').ready(function() {
            v_training();
            experience();
            ge_lang();
            program();


        });

        $('.program-radio').change(function() {
            program();
        });

        $('#vocational_check_box').change(function() {
            v_training();
        });

        $('#expirience_box').change(function() {
            experience();
        });

        $('.Ge_lang').change(function() {
            ge_lang();
        });

        $('#country').change(function() {
            let country = $(this).val();
            $.ajax({
                url: "{{ route('country_agent') }}",
                type: "POST",
                data: {
                    country: country,
                    _token: "{{ csrf_token() }}",
                },
                success: function(data) {
                    $('#agent_text').html(data);
                    // console.log(data);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });


        // function check_for_hide() {
        //     $('#job_field').hide();
        //     $('#vocational_fields').hide();
        //     $('#expirience_field').hide();
        //     $('#agent_field').hide();
        //     $('#ge_level_field').hide();
        // };

        function program() {
            let select_direct = $('input[name="course_id"]:checked').attr('course-code');
            // alert(select_direct);

            if (select_direct == 'Direct job') {
                $('#job_field').slideDown();
                $('#which_job').focus();
                $('#which_job').attr('required', true);
            } else {
                $('#job_field').slideUp();
                $('#which_job').attrRemove('required');
            }
        };

        function v_training() {
            let select_vocational = $('#vocational_check_box').prop('checked');
            // let select_vocational = $('input[name="v_training_tick"]:checked').val();
            // alert(select_vocational);

            if (select_vocational) {
                $('#vocational_fields').slideDown();
                $('#vocational').focus();
            } else {
                $('#vocational_fields').slideUp();
            }
        };

        function experience() {
            // let select_expirience = $('#expirience_box').prop('checked');
            let select_expirience = $('input[name="w_experience_tick"]:checked').val();
            // alert(select_expirience);

            if (select_expirience) {
                $('#expirience_field').slideDown();
                $('#expirience_text').focus();
            } else {
                $('#expirience_field').slideUp();
            }
        };

        function ge_lang() {
            let ge_lan = $('#Ge_lang_yes').prop('checked');

            if (ge_lan) {
                $('#ge_level_field').slideDown();
            } else {
                $('#ge_level_field').slideUp();
            }
        };
    </script>
    @include('sweetalert::alert')
@endsection
