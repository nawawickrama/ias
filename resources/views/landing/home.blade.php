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
                    <form action="{{ route('reg_candi') }}" method="POST">
                        @csrf
                        <div class="form-row">
                            <p class="font-weight-bold">Select the program</p>
                        </div>
                        <div class="form-row mt-2">
                            <div class="form-check col-md-12">
                                <label class="form-check-label">
                                    <input type="radio"
                                        class="form-check-input program-radio @error('project') is-invalid @enderror"
                                        name="project" id="" value="STEP" @if (old('project') != null && old('project') == 'STEP') {{ 'checked' }} @endif>
                                    @error('project')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    STEP (Study Eligibility Program) is a Pre-bachelors program for students who completed
                                    their 12 yrs of Schooling
                                </label>
                            </div>
                            <div class="form-check col-md-12">
                                <label class="form-check-label">
                                    <input type="radio"
                                        class="form-check-input program-radio @error('project') is-invalid @enderror"
                                        name="project" id="" value="E-STEP" @if (old('project') != null && old('project') == 'E-STEP') {{ 'checked' }} @endif>
                                    @error('project')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    E-STEP (English -Study Eligibility Program) is a Pre-bachelors program for students who
                                    completed their 12 yrs of Schooling
                                </label>
                            </div>
                            <div class="form-check col-md-12">
                                <label class="form-check-label">
                                    <input type="radio"
                                        class="form-check-input program-radio @error('project') is-invalid @enderror"
                                        name="project" id="" value="MEP" @if (old('project') != null && old('project') == 'MEP') {{ 'checked' }} @endif>
                                    @error('project')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    MEP (Master Eligibility Program) is Pre- Master program for students who wish to start
                                    their Masters In Germany
                                </label>
                            </div>
                            <div class="form-check col-md-12">
                                <label class="form-check-label">
                                    <input type="radio"
                                        class="form-check-input program-radio @error('project') is-invalid @enderror"
                                        name="project" id="" value="PAP" @if (old('project') != null && old('project') == 'PAP') {{ 'checked' }} @endif>
                                    @error('project')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    PAP (PAP is a Preparation program for being a registered Nurse in Germany).
                                </label>
                            </div>
                            <div class="form-check col-md-12">
                                <label class="form-check-label">
                                    <input type="radio"
                                        class="form-check-input program-radio @error('project') is-invalid @enderror"
                                        name="project" id="" value="GVET" @if (old('project') != null && old('project') == 'GVET') {{ 'checked' }} @endif>
                                    @error('project')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    GVET Vocational Training
                                </label>
                            </div>
                            <div class="form-check col-md-12">
                                <label class="form-check-label">
                                    <input type="radio"
                                        class="form-check-input program-radio @error('project') is-invalid @enderror"
                                        name="project" id="direct_job" value="Direct job" @if (old('project') != null && old('project') == 'Direct job') {{ 'checked' }} @endif>
                                    @error('project')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    Direct job apply
                                </label>
                            </div>
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
                                    name="first_name" id="" aria-describedby="helpId" value="{{ old('first_name') }}">
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
                                    value="{{ old('sur_name') }}">
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
                                    <option disabled selected>Select</option>
                                    <option value="1" @if (old('sex') == 1) {{ 'selected' }} @endif>Male</option>
                                    <option value="0" @if (old('sex') == 0) {{ 'selected' }} @endif>Female</option>
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
                            <div class="form-group col-md-6">
                                <label>Nationality / Nationalities required :</label>
                                <input type="text" class="form-control @error('nationality') is-invalid @enderror"
                                    name="nationality" id="" aria-describedby="helpId" placeholder=""
                                    value="{{ old('nationality') }}">
                                @error('nationality')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label>Country / State : </label>
                                <input type="text" class="form-control @error('state') is-invalid @enderror" name="state"
                                    id="" aria-describedby="helpId" placeholder="" value="{{ old('state') }}">
                                @error('state')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Telephone number (with ISD code) :</label>
                                <input type="text" class="form-control @error('telephone') is-invalid @enderror"
                                    name="telephone" id="" aria-describedby="helpId" placeholder=""
                                    value="{{ old('telephone') }}">
                                @error('telephone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label>Email :</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                    id="" aria-describedby="helpId" placeholder="" value="{{ old('email') }}">
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
                                    id="" aria-describedby="helpId" placeholder="City" value="{{ old('city') }}">
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
                                <input type="text" class="form-control @error('country') is-invalid @enderror"
                                    name="country" id="" aria-describedby="helpId" placeholder="Country"
                                    value="{{ old('country') }}">
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
                                <input type="number" class="form-control @error('sec_from') is-invalid @enderror"
                                    name="sec_from" id="" aria-describedby="helpId" placeholder=""
                                    value="{{ old('sec_from') }}">
                                @error('sec_from')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-2">
                                <label for="">To :</label>
                                <input type="number" class="form-control @error('sec_to') is-invalid @enderror"
                                    name="sec_to" id="" aria-describedby="helpId" placeholder=""
                                    value="{{ old('sec_to') }}">
                                @error('sec_to')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="">Overall Result Percentage (%)</label>
                                <input type="number" class="form-control @error('sec_result') is-invalid @enderror"
                                    name="sec_result" id="" aria-describedby="helpId" placeholder=""
                                    value="{{ old('sec_result') }}">
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
                                <select class="form-control @error('higher_sec_school') is-invalid @enderror"
                                    name="higher_sec_school" id="">
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
                                <input type="number" class="form-control @error('highter_from') is-invalid @enderror"
                                    name="highter_from" id="" aria-describedby="helpId" placeholder=""
                                    value="{{ old('highter_from') }}">
                                @error('highter_from')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-2">
                                <label for="">To :</label>
                                <input type="number" class="form-control @error('highter_to') is-invalid @enderror"
                                    name="highter_to" id="" aria-describedby="helpId" placeholder=""
                                    value="{{ old('highter_to') }}">
                                @error('highter_to')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="">Overall Result Percentage (%)</label>
                                <input type="number" class="form-control @error('highter_result') is-invalid @enderror"
                                    name="highter_result" id="" aria-describedby="helpId" placeholder=""
                                    value="{{ old('highter_result') }}">
                                @error('highter_result')
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
                                        id="vocational_check_box" value="1`" @if(old('v_training_tick') == 1) {{ 'checked' }} @endif>
                                    Vocational Training?
                                </label>
                            </div>
                        </div>
                        <div id="vocational_fields">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="">Field of the vocational training</label>
                                    <input type="text" class="form-control @error('v_field') is-invalid @enderror"
                                        name="v_field" id="vocational" aria-describedby="helpId" placeholder=""
                                        value="{{ old('v_field') }}">
                                    @error('v_field')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Year of completion</label>
                                    <input type="text" class="form-control @error('v_complete_year') is-invalid @enderror"
                                        name="v_complete_year" id="" aria-describedby="helpId" placeholder=""
                                        value="{{ old('v_complete_year') }}">
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
                                    <input type="text" class="form-control @error('v_result') is-invalid @enderror"
                                        name="v_result" id="" aria-describedby="helpId" placeholder=""
                                        value="{{ old('v_result') }}">
                                    @error('v_result')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Duration of the vocational training (Months)</label>
                                    <input type="text" class="form-control @error('v_duration') is-invalid @enderror"
                                        name="v_duration" id="" aria-describedby="helpId" placeholder=""
                                        value="{{ old('v_duration') }}">
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
                                <input type="text" class="form-control @error('b_uni') is-invalid @enderror" name="b_uni"
                                    id="" aria-describedby="helpId" placeholder="" value="{{ old('b_uni') }}">
                                @error('b_uni')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Major subject :</label>
                                <input type="text" class="form-control @error('b_major_sub') is-invalid @enderror"
                                    name="b_major_sub" id="" aria-describedby="helpId" placeholder=""
                                    value="{{ old('b_major_sub') }}">
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
                                <input type="text" class="form-control @error('b_year') is-invalid @enderror" name="b_year"
                                    id="" aria-describedby="helpId" placeholder="" value="{{ old('b_year') }}">
                                @error('b_year')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Overall result percentage (%)</label>
                                <input type="text" class="form-control @error('b_result') is-invalid @enderror"
                                    name="b_result" id="" aria-describedby="helpId" placeholder=""
                                    value="{{ old('b_result') }}">
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
                                <input type="text" class="form-control @error('m_major_sub') is-invalid @enderror"
                                    name="m_major_sub" id="" aria-describedby="helpId" placeholder=""
                                    value="{{ old('m_major_sub') }}">
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
                                <input type="text" class="form-control @error('m_year') is-invalid @enderror" name="m_year"
                                    id="" aria-describedby="helpId" placeholder="" value="{{ old('m_year') }}">
                                @error('m_year')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Overall result percentage (%)</label>
                                <input type="text" class="form-control @error('m_result') is-invalid @enderror"
                                    name="m_result" id="" aria-describedby="helpId" placeholder=""
                                    value="{{ old('m_result') }}">
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
                                        id="expirience_box" value="1" @if(old('w_experience_tick') == 1) {{ 'checked' }} @endif>
                                    Working experience?
                                </label>
                            </div>
                        </div>
                        <div id="expirience_field">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="">Name of the field that you work :</label>
                                    <input type="text" class="form-control @error('w_exp_field') is-invalid @enderror"
                                        name="w_exp_field" id="expirience_text" aria-describedby="helpId" placeholder=""
                                        value="{{ old('w_exp_field') }}">
                                    @error('w_exp_field')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">How many years of experience? :</label>
                                    <input type="text" class="form-control @error('first_name') is-invalid @enderror"
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
                                    <label class="form-check-label">
                                        <input class="form-check-input Ge_lang" type="radio" name="german_language"
                                            id="Ge_lang_yes" value="1" @if (old('german_language') == 1) {{ 'checked' }} @endif> Yes
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label">
                                        <input class="form-check-input Ge_lang" type="radio" name="german_language"
                                            id="Ge_lang_no" value="0" @if (old('german_language') == 0) {{ 'checked' }} @endif> No
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-row" id="ge_level_field">
                            <div class="form-group col-md-12">
                                <label for="">Which level? :</label>
                                <br>
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label">
                                        <input class="form-check-input @error('german_level') is-invalid @enderror"
                                            type="radio" name="german_level" id="" value="A1" @if (old('german_level') == 'A1') {{ 'checked' }} @endif> A1
                                        @error('german_level')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label">
                                        <input class="form-check-input @error('german_level') is-invalid @enderror"
                                            type="radio" name="german_level" id="" value="A2" @if (old('german_level') == 'A2') {{ 'checked' }} @endif> A2
                                        @error('german_level')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label">
                                        <input class="form-check-input @error('german_level') is-invalid @enderror"
                                            type="radio" name="german_level" id="" value="B1" @if (old('german_level') == 'B1') {{ 'checked' }} @endif> B1
                                        @error('german_level')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label">
                                        <input class="form-check-input @error('german_level') is-invalid @enderror"
                                            type="radio" name="german_level" id="" value="B2" @if (old('german_level') == 'B2') {{ 'checked' }} @endif> B2
                                        @error('german_level')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label">
                                        <input class="form-check-input @error('german_level') is-invalid @enderror"
                                            type="radio" name="german_level" id="" value="C1" @if (old('german_level') == 'C1') {{ 'checked' }} @endif> C1
                                        @error('german_level')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label">
                                        <input class="form-check-input @error('german_level') is-invalid @enderror"
                                            type="radio" name="german_level" id="" value="C2" @if (old('german_level') == 'C2') {{ 'checked' }} @endif> C2
                                        @error('german_level')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="">How did you know about IAS College? :</label>
                                <br>
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label">
                                        <input class="form-check-input @error('how_to_know') is-invalid @enderror"
                                            type="checkbox" name="how_to_know[]" id="agent_check_box"
                                            value="Agent/Educational Consultancy" @if (old('how_to_know') == 'Agent/Educational Consultancy') {{ 'checked' }} @endif> Agent /
                                        Educational Consultancy
                                        @error('how_to_know')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="how_to_know[]" id=""
                                            value="Facebook Advertiesments" @if (old('how_to_know') == 'Facebook Advertiesments') {{ 'checked' }} @endif> Facebook
                                        Advertiesments
                                        @error('how_to_know')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="how_to_know[]" id=""
                                            value="Promotional Email" @if (old('how_to_know') == "Promotional Email") {{ 'checked' }} @endif> Promotional Email
                                        @error('how_to_know')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-row" id="agent_field">
                            <div class="form-group col-md-12">
                                <label for="">Name of the agent or education consultancy (If you know IAS college from agent
                                    or education consultancy) :</label>
                                <input type="text" class="form-control @error('agent_name') is-invalid @enderror"
                                    name="agent_name" id="agent_text" aria-describedby="helpId" placeholder=""
                                    value="{{ old('agent_name') }}">
                                @error('agent_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
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
                                    <label class="form-check-label">
                                        <input class="form-check-input @error('agree') is-invalid @enderror"
                                            type="checkbox" name="agree" id="" value="I agree to all terms and conditions"
                                            required> I agree to all terms and conditions
                                        @error('agree')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <button type="submit" class="btn btn-primary btn-block">Submit Application</button>
                            </div>
                        </div>
                    </form>
                </di>
            </div>
        </div>
    </div>

    <script>
        $('document').ready(() => {
            $('#job_field').hide();
            $('#vocational_fields').hide();
            $('#expirience_field').hide();
            $('#agent_field').hide();
            $('#ge_level_field').hide();
            

            $('.program-radio').change(() => {
                program();
            });

            $('#vocational_check_box').change(() => {
                v_training();
            });

            $('#expirience_box').change(() => {
                experience();
            });

            $('#agent_check_box').change(() => {
                agent();
            });

            $('.Ge_lang').change(() => {
                ge_lang();
            });
        });

        function v_training() {
            let select_vocational = $('#vocational_check_box').prop('checked');
            if (select_vocational) {
                $('#vocational_fields').slideDown();
                $('#vocational').focus();
            } else {
                $('#vocational_fields').slideUp();
            }
        };

        function program() {
            var select_direct = $('#direct_job').prop('checked');
            // alert(select_direct);
                if (select_direct) {
                    $('#job_field').slideDown();
                    $('#which_job').focus();
                    $('#which_job').attr('required', true);
                } else {
                    $('#job_field').slideUp();
                    $('#which_job').attrRemove('required');
                }
        };

        function experience() {
            let select_expirience = $('#expirience_box').prop('checked');

            if (select_expirience) {
                $('#expirience_field').slideDown();
                $('#expirience_text').focus();
            } else {
                $('#expirience_field').slideUp();
            }
        };

        function agent(){
            let select_agent = $('#agent_check_box').prop('checked');

            if (select_agent) {
                $('#agent_field').slideDown();
                $('#agent_text').focus();
                $('#agent_text').attr('required', true);
            } else {
                $('#agent_field').slideUp();
                $('#agent_text').attrRemove('required');
            }
        };

        function ge_lang(){
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
