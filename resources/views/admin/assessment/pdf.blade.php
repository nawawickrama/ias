@extends('layouts.front.main')

@section('content')
    <script>
        window.print();
    </script>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <img src="https://iaos.de/wp-content/uploads/2019/03/logo.png" class="rounded mx-auto d-block"
                            alt="..." style="float :right;">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="text-center">
                            <br>
                            <u>Fachkrafte (FK)-Assessment Form</u>
                        </h3>
                    </div>
                </div>
                <br>
                <br>
                <hr>
                @php
                    $candidate_info = $cpf_details->candidate;
                    $program = $cpf_details->course;
                @endphp
                <div class="row">
                    <div class="col-md-8">
                        <p>Applying for :<em class="text-secondary"> {{ $program->course_code }} @if ($program->course_code == 'Direct job') ({{ $cpf_details->job_field }}) @endif
                                course</em></p>
                    </div>
                    <div class="col-md-4">
                        <p>Intake :<em class="text-secondary"> 2022</em></p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <p>Applicant Name :<em class="text-secondary"> {{ $candidate_info->first_name }}
                                {{ $candidate_info->sur_name }}</em></p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <p>Address :<em class="text-secondary">{{ $candidate_info->address }}</em></p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <p>Adimission decision :
                            @php
                                if ($cpf_details->application_status == 1) {
                                    echo "Selected for the $program->course_code program.";
                                } elseif ($cpf_details->application_status == 3) {
                                    echo "Selected for the $program->course_code program with the condition.";
                                } elseif ($cpf_details->application_status == 0) {
                                    echo 'Not selected.';
                                }
                            @endphp
                        </p>
                    </div>
                </div><br>


                <div class="row">
                    <div class="col-md-12">
                        <p>This is the initial assessment result of you and this is not the admission letter. In order to
                            receive the Admission Acceptance Form<br> (AAF), complete documents must
                            be sent to the college as per the guidelines stipulated in our official website (www iaos de).
                            Only upon receiving the <br> complete documents the final admission decision will be made. </p>
                    </div>
                </div>
                <hr>
                @if ($cpf_details->comment_institute)
                    <div class="row">
                        <div class="col-md-12">
                            <p>Comments :</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <textarea name="" class="form-control" id="" cols="30" rows="5"
                                readonly>{{ $cpf_details->comment_institute }}</textarea>
                        </div>
                    </div>
                    <hr>
                @endif


                <div class="row">
                    <div class="col-md-12">
                        <img style="height: 250px; width:270px;" src="{{ url('assets/images/txt.png') }}" alt="">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p>Datum :@php
                            if ($cpf_details->status_date != null) {
                                echo $cpf_details->status_date;
                            } else {
                                echo date('Y-m-d');
                            }
                        @endphp, Unterschrift/Stempel prufer(n).</p>
                    </div>
                </div>
                <hr>
                <div class="row mt-4">
                    <div class="col-md-12">
                        <p class="text-center">
                            <u>IAS college GmbH | Maria-Geoppert-Str. 1 | 23562 Luebeck, Germany <br> www.iaos.de </u>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
