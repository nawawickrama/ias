@extends('layouts.dashboard.main')

@section('content')
<div class="card">
    <div class="card-header">
        <p>ASSESSMENT FORM</p>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-8">
                <p>Applying for :<em class="text-secondary">{{ $application_details->program }} course</em></p>
            </div>
            <div class="col-md-4">
                <p>Intake :<em class="text-secondary"> 2022</em></p>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">
                <p>Applicant Name :<em class="text-secondary">{{ $application_details->first_name }} {{ $application_details->sur_name }}</em></p>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">
                <p>Address :<em class="text-secondary">{{ $application_details->address }} {{ $application_details->country }}</em></p>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">
                <p>Adimission decision :</p>
            </div>
        </div>
        <form action="" method="POST" id="send-form">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="addmission" id="" value="1" checked>
                            Selected for the FK program.
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="addmission" id="" value="3">
                            Selected for the FK program with the condition.
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="addmission" id="" value="0">
                            Not selected.
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <p>This is the initial assessment result of you and this is not the admission letter. In order to receive the Admission Acceptance Form<br> (AAF), complete documents must
                        be sent to the college as per the guidelines stipulated in our official website (www iaos de). Only upon receiving the <br> complete documents the final admission decision will be made. </p>
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
                    <textarea name="comments" class="form-control" id="" cols="30" rows="5"></textarea>
                </div>
            </div>
            <input type="hidden" name="appli_id" value="{{ $application_details->candidate_id }}">
        </form>
        <hr>
        <div class="row">
            <div class="col-md-12">
                <p> As you have gained experience in the hospitality field you have good chance to go to Germany and start a career here. Also as a condition <br> to get this opportunity a langauge
                    of Al till B2 level is in need and the college offers this langauge coursework (intensive: 4 hours per day and 5 days a week). <br> Between thelanguage level of B2.1 and B2.2
                    an interview would be arranged for you with the condition that 31 level is passed <br> (IAS College internal and Goethe) and as well as good communication skill and character are shown.
                </p>
                <br>
                <p>
                    <b>Note for AAF: </b>due to lack of personal details DOB. No. Visa copy. address etc a final decision cannot be made.
                </p>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">
                <img style="height: 250px; width:270px; float:right;" src="{{url('assets/images/txt.png')}}" alt="">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <p>Datum :22.09.2021, Unterschrift/Stempel prufer(n).</p>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-3">
                <button type="button" class="btn btn-block btn-success" id="btn-email">Email Aseesment form</button>
            </div>
            <div class="col-md-3">
                <button type="button" class="btn btn-block btn-primary" id="btn-download">Download Aseesment form</button>
            </div>
        </div>
    </div>
</div>
<script>
    $('document').ready(function(){
        $('#btn-email').click(function(){
            $('#send-form').attr('action', "{{ route('email_assessment_form') }}");
            $('#send-form').submit();
        });

        $('#btn-download').click(function(){
            $('#send-form').attr('action', "{{ route('download_assessment_form') }}");
            $('#send-form').submit();
        });
    });
</script>
@endsection