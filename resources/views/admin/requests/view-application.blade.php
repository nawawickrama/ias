@extends('layouts.dashboard.main')

@section('content')
    <div class="card">
        <div class="card-header bg-primary text-white">
            <p>Application view</p>
        </div>
        <div class="card-body">
            <form action="">
                <div class="form-row">
                    <p class="font-weight-bold">Select the program</p>
                </div>
                <hr>
                <div class="form-row mt-2">
                    <div class="form-check col-md-12">
                        <p>Selected Program : <em class="text-secondary">{{ $program->course_code }}</em></p>
                    </div>
                </div>
                @if ($program->course_code == 'Direct job')
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <p>Which Field : <em class="text-secondary">{{ $cpf_details->job_feild }}</em></p>
                        </div>
                    </div>
                @endif
                <div class="form-row mt-4">
                    <p class="font-weight-bold">Personal Details</p>
                </div>
                <hr>
                <div class="form-row mt-2">
                    <div class="form-group col-md-6">
                        <p>First Name : <em class="text-secondary">{{ $candidate->first_name }}</em></p>
                    </div>
                    <div class="form-group col-md-6">
                        <p>Surname : <em class="text-secondary">{{ $candidate->sur_name }}</em></p>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <p>Sex : <em class="text-secondary">@php
                            $sex = $candidate->sex;
                            if ($sex == 0) {
                                echo 'Female';
                            } else {
                                echo 'Male';
                            }
                        @endphp</em></p>
                    </div>
                    <div class="form-group col-md-6">
                        <p>Date of birth : <em class="text-secondary">@php echo date('F j, Y',strtotime($candidate->dob)); @endphp</em></p>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <p>Nationality required : <em
                                class="text-secondary">{{ $nationality }}</em></p>
                    </div>
                    <div class="form-group col-md-6">
                        <p>Country / State : <em class="text-secondary">{{ $country }}</em></p>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <p>Telephone number (with ISD code) : <em
                                class="text-secondary">{{ $candidate->telephone }}</em></p>
                    </div>
                    <div class="form-group col-md-6">
                        <p>Email : <em class="text-secondary">{{ $candidate->email }}</em></p>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <p>Address : <em class="text-secondary">{{ $candidate->address }}, {{$country}}</em></p>
                    </div>
                </div>

                @php
                    $sec_school = $cpf_details->sec_sch;
                @endphp
                @if (count($sec_school) > 0)
                    <div class="form-row mt-4">
                        <p class="font-weight-bold">Educational Background</p>
                    </div>
                    <hr>
                    @foreach ($sec_school as $sch)
                        <div class="form-row mt-2">
                            <div class="form-group col-md-4">
                                <p>{{ $sch->sec_edu_type }} Schooling : <em
                                        class="text-secondary">{{ $sch->years_level }}</em></p>
                            </div>
                            <div class="form-group col-md-2">
                                <p>Duration : <em class="text-secondary">{{ $sch->duration }}</em></p>
                            </div>

                            <div class="form-group col-md-4">
                                <p>Overall Result Percentage (%) : <em
                                        class="text-secondary">{{ $sch->result_percentage }}</em></p>
                            </div>
                        </div>
                    @endforeach
                @endif

                @php
                    $vacational = $cpf_details->vocational_t;
                @endphp
                @isset($vacational)
                    <div class="form-row mt-4">
                        <p class="font-weight-bold">Vocational Training</p>
                    </div>
                    <hr>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <p>Field of the vocational training : <em class="text-secondary">{{ $vacational->field }}</em>
                            </p>
                        </div>
                        <div class="form-group col-md-6">
                            <p>Year of completion : <em class="text-secondary">{{ $vacational->complete_year }}</em></p>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <p>Overall Result Percentage (%) : <em
                                    class="text-secondary">{{ $vacational->result_percentage }}</em></p>
                        </div>
                        <div class="form-group col-md-6">
                            <p>Duration of the vocational training (Months) : <em
                                    class="text-secondary">{{ $vacational->duration }}</em></p>
                        </div>
                    </div>
                @endisset

                @php
                    $higher_edu = $cpf_details->higher_edu;
                @endphp
                @if (count($higher_edu) > 0)
                    @foreach ($higher_edu as $h_edu)
                        <div class="form-row mt-4">
                            <p class="font-weight-bold">{{ $h_edu->higher_edu_type }}</p>
                        </div>
                        <hr>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <p>Name of the university : <em class="text-secondary">{{ $h_edu->university }}</em></p>
                            </div>
                            <div class="form-group col-md-6">
                                <p>Major subject : <em class="text-secondary">{{ $h_edu->major_subject }}</em></p>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <p>Years of the degree program : <em class="text-secondary">{{ $h_edu->year }}</em></p>
                            </div>
                            <div class="form-group col-md-6">
                                <p>Overall Result Percentage (%) : <em
                                        class="text-secondary">{{ $h_edu->result_percentage }}</em></p>
                            </div>
                        </div>
                    @endforeach
                @endif

                @php
                    $work_exp = $cpf_details->work_exp;
                @endphp
                @if (count($work_exp) > 0)
                    <div class="form-row mt-4">
                        <p class="font-weight-bold">Working Experience</p>
                    </div>
                    <hr>
                    @foreach ($work_exp as $exp)
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <p>Name of the field that you work : <em class="text-secondary">{{ $exp->field }}</em>
                                </p>
                            </div>
                            <div class="form-group col-md-6">
                                <p>Years of experience : <em class="text-secondary">{{ $exp->duration }}</em></p>
                            </div>
                        </div>
                    @endforeach
                @endif

                <div class="form-row mt-4">
                    <p class="font-weight-bold">Language proficiency & other details</p>
                </div>
                <hr>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <p>German language proficiency (please include certified copies of certificates) Have your learnt
                            German? : <em class="text-secondary">@php
                                $ge_lang = $cpf_details->ge_lang;
                                if ($ge_lang == 1) {
                                    echo 'Yes';
                                } else {
                                    echo 'No';
                                }
                            @endphp</em></p>
                    </div>
                </div>
                @if ($ge_lang == 1)
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <p>Which level? : <em class="text-secondary">{{ $cpf_details->ge_lang_level }}</em></p>
                        </div>
                    </div>
                @endif

                <div class="form-row">
                    <div class="form-group col-md-12">
                        <p>How did you know about IAS College? : <em class="text-secondary">
                                {{ $cpf_details->how_to_know }}
                            </em></p>
                    </div>
                </div>
                @if ($cpf_details->how_to_know == 'Agent/Educational Consultancy')
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            @php
                                if($cpf_details->agent_id != NULL) $agent_info = App\Models\Agent::find($cpf_details->agent_id)->user;
                            @endphp
                            <p>Name of the agent or education consultancy (If you know IAS college from agent or education
                                consultancy) : <em class="text-secondary">{{ $agent_info->name ?? 'N/A' }}</em></p>
                        </div>
                    </div>
                @endif
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <p>If you wish to provide any further reasons for your application, please use the comment box : <em
                                class="text-secondary">{{ $cpf_details->comment }}</em></p>
                    </div>
                </div>
                <hr>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <p>Declaration

                            I confirm that to the best of my knowledge the information I have provided on this form is true,
                            complete and accurate. I am aware that intentionally or negligently providing false information
                            constitutes an administrative offence and may lead to exclusion from the admissions procedure or
                            – if discovered at a later date – to the cancellation of my admission or enrollment. I confirm
                            that I have read the admission information for my desired course from the IAS College GmbH
                            Homepage. <br><br>

                            In the case this application is sent to uni‐assist, I hereby confirm that I have read and accept
                            the general terms and conditions (AGB) provided by uni‐assist e.V. on www.uni-assist.de/agb/.
                            <br><br>

                            Please Note - All information provided herein will be stored and processed by the
                            college/university. They are fully subject to the data protection regulations currently in
                            effect. By clicking the submit button below, you confirm your agreement with these terms.
                            <br><br>

                            Once you are selected for admission, you are required to substantiate with certified copies and
                            translations (German or English) of your certificates. Important: All certificates must be
                            Notary attested.</p>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <p>I agree to all terms and conditions : <em class="text-secondary">Yes</em></p>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
