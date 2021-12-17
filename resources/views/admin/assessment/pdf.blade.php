@extends('layouts.front.main')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <img src="https://iaos.de/wp-content/uploads/2019/03/logo.png" class="rounded mx-auto d-block" alt="..." style="float :right;">
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
            <div class="row">
                <div class="col-md-8">
                    <p>Applying for :<em class="text-secondary"> {{ $program }} course</em></p>
                </div>
                <div class="col-md-4">
                    <p>Intake :<em class="text-secondary"> 2022</em></p>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <p>Applicant Name :<em class="text-secondary"> {{ $name }}</em></p>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <p>Address :<em class="text-secondary">{{ $address }}</em></p>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <p>Adimission decision :</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="checkbox1" id="" value="1" @if($adimssion == 1){{ 'checked' }} @endif>
                            Selected for the FK program.
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="checkbox1" id="" value="3" @if($adimssion == 3){{ 'checked' }} @endif>
                            Selected for the FK program with the condition.
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="checkbox1" id="" value="0" @if($adimssion == 2){{ 'checked' }} @endif>
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
                    <textarea name="" class="form-control" id="" cols="30" rows="5">{{ $comment_institute }}</textarea>
                </div>
            </div>
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
                    <img style="height: 300px; width:270px; float:right;" src="{{url('assets/images/txt.png')}}" alt="">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <p>Datum :22.09.2021, Unterschrift/Stempel prufer(n).</p>
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