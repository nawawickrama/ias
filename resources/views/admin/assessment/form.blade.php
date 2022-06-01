@extends('layouts.dashboard.main')

@section('content')
    <div class="card">
        <div class="card-header bg-primary text-white">
            <p>ASSESSMENT FORM</p>
        </div>
        @php
            $candidate_info = $cpf_details->candidate;
            $program = $cpf_details->course;
        @endphp
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <p>Applying for :<em
                            class="text-secondary">{{ $program->course_code }} @if ($program->course_code == 'Direct job')
                                ({{ $cpf_details->job_field }}) @endif</em>
                    </p>
                </div>
                <div class="col-md-4">
                    <p>Intake :<em class="text-secondary"> {{ $cpf_details->year ?? date('Y') }}</em></p>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <p>Applicant Name :<em class="text-secondary">{{ $candidate_info->first_name }}
                            {{ $candidate_info->sur_name }}</em></p>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <p>Address :<em class="text-secondary">{{ $candidate_info->address }}
                            {{ $candidate_info->country }}</em></p>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <p>Admission decision :</p>
                </div>
            </div>
            <form action="" method="POST" id="send-form">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="addmission" id="addmission_form"
                                       value="1">
                                Selected for the {{ $program->course_code }} @if ($program->course_code == 'Direct job')
                                    ({{ $cpf_details->job_field }}) @endif program.
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="addmission" id="addmission_form"
                                       value="3">
                                Selected for the {{ $program->course_code }} @if ($program->course_code == 'Direct job')
                                    ({{ $cpf_details->job_field }}) @endif program with the
                                condition.
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="addmission" id="addmission_form"
                                       value="0">
                                Not selected.
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p>This is the initial assessment result of you and this is not the admission letter. In order
                            to
                            receive the Admission Acceptance Form<br> (AAF), complete documents must
                            be sent to the college as per the guidelines stipulated in our official website (www iaos
                            de).
                            Only upon receiving the <br> complete documents the final admission decision will be made.
                        </p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <p>Comments :</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <textarea name="comments" class="form-control" id="comments_form" cols="30" rows="5"></textarea>
                    </div>
                </div>
                <input type="hidden" name="appli_id" value="{{ $cpf_details->cpf_id }}">
            </form>
            <hr>
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
                                echo date('d.m.Y');
                            }
                        @endphp, Unterschrift/Stempel prufer(n).</p>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-3">
                    <button type="button" class="btn btn-block btn-success" id="btn-email"
                            cpf_id="{{ $cpf_details->cpf_id }}">Email Assessment form
                    </button>
                </div>
                <div class="col-md-3">
                    <button type="button" class="btn btn-block btn-primary" id="btn-download">Download Assessment
                        form
                    </button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('document').ready(function () {
            $('#btn-email').click(function () {
                let comment_info = $('#comments_form').val()
                let cpf_id = $(this).attr('cpf_id');
                // let addmission_info = $('#addmission_form').val();
                let addmission_info = $('input[name="addmission"]:checked').val();

                $('#appli_id').val(cpf_id);
                $('#comments').val(comment_info);
                $('#addmission').val(addmission_info);

                $('#ModalEmail').modal('show');
            });

            $('#btn-download').click(function () {
                $('#send-form').attr('action', "{{ route('download_assessment_form') }}");
                $('#send-form').submit();
            });
        });
    </script>

    <!-- Modal Email -->
    <div class="modal fade" id="ModalEmail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Email Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('email_assessment_form') }}" method="POST">
                    <div class="modal-body">
                        @csrf
                        <label>Send this assessment form to :</label>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="email_method" id="" value="1"
                                       required>
                                Student
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="email_method" id="" value="2"
                                       required>
                                Agent
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="email_method" id="" value="3"
                                       required>
                                Both
                            </label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" value="" id="appli_id" name="appli_id">
                        <input type="hidden" value="" id="comments" name="comments">
                        <input type="hidden" value="" id="addmission" name="addmission">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Send Email</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
