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
                <form action="">
                    <div class="form-row">
                        <p class="font-weight-bold">Select the program</p>
                    </div>
                    <div class="form-row mt-2">
                        <div class="form-check col-md-12">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="radio1" id="" value="checkedValue" checked>
                                STEP (Study Eligibility Program) is a Pre-bachelors program for students who completed their 12 yrs of Schooling
                            </label>
                        </div>
                        <div class="form-check col-md-12">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="radio1" id="" value="checkedValue">
                                E-STEP (English -Study Eligibility Program) is a Pre-bachelors program for students who completed their 12 yrs of Schooling
                            </label>
                        </div>
                        <div class="form-check col-md-12">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="radio1" id="" value="checkedValue">
                                MEP (Master Eligibility Program) is Pre- Master program for students who wish to start their Masters In Germany
                            </label>
                        </div>
                        <div class="form-check col-md-12">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="radio1" id="" value="checkedValue">
                                PAP (PAP is a Preparation program for being a registered Nurse in Germany).
                            </label>
                        </div>
                        <div class="form-check col-md-12">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="radio1" id="" value="checkedValue">
                                GVET Vocational Training
                            </label>
                        </div>
                        <div class="form-check col-md-12">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="radio1" id="" value="checkedValue">
                                Direct job apply
                            </label>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="">Which Field</label>
                            <input type="text" class="form-control" name="" id="" aria-describedby="helpId" placeholder="">
                        </div>
                    </div>
                    <div class="form-row mt-4">
                        <p class="font-weight-bold">Personal Details</p>
                    </div>
                    <div class="form-row mt-2">
                        <div class="form-group col-md-6">
                            <label>First Name :</label>
                            <input type="text" class="form-control" name="" id="" aria-describedby="helpId" value="Ayesh">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Surname : </label>
                            <input type="text" class="form-control" name="" id="" aria-describedby="helpId" placeholder="">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="">Sex :</label>
                            <select class="form-control" name="" id="">
                                <option disabled selected>Select</option>
                                <option>Male</option>
                                <option>Female</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Date of birth : </label>
                            <input type="date" class="form-control" name="" id="" aria-describedby="helpId" placeholder="">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Nationality / Nationalities required :</label>
                            <input type="text" class="form-control" name="" id="" aria-describedby="helpId" placeholder="">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Country / State : </label>
                            <input type="text" class="form-control" name="" id="" aria-describedby="helpId" placeholder="">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Telephone number (with ISD code) :</label>
                            <input type="text" class="form-control" name="" id="" aria-describedby="helpId" placeholder="">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Email :</label>
                            <input type="text" class="form-control" name="" id="" aria-describedby="helpId" placeholder="">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="">Address :</label>
                            <input type="text" class="form-control" name="" id="" aria-describedby="helpId" placeholder="Address Line 1">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" name="" id="" aria-describedby="helpId" placeholder="City">
                        </div>
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" name="" id="" aria-describedby="helpId" placeholder="State / Province / Region">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" name="" id="" aria-describedby="helpId" placeholder="Zip / Postal code">
                        </div>
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" name="" id="" aria-describedby="helpId" placeholder="Country">
                        </div>
                    </div>
                    <div class="form-row mt-4">
                        <p class="font-weight-bold">Educational Background</p>
                    </div>
                    <div class="form-row mt-2">
                        <div class="form-group col-md-4">
                            <label for="">Secondary Schooling :</label>
                            <select class="form-control" name="" id="">
                                <option disabled selected>Select</option>
                                <option>O Level</option>
                                <option>10 Years</option>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="">From :</label>
                            <input type="number" class="form-control" name="" id="" aria-describedby="helpId" placeholder="">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="">To :</label>
                            <input type="number" class="form-control" name="" id="" aria-describedby="helpId" placeholder="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Overall Result Percentage (%)</label>
                            <input type="number" class="form-control" name="" id="" aria-describedby="helpId" placeholder="">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="">Higher Secondary Schooling :</label>
                            <select class="form-control" name="" id="">
                                <option disabled selected>Select</option>
                                <option>A Level</option>
                                <option>12 Years</option>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="">From :</label>
                            <input type="number" class="form-control" name="" id="" aria-describedby="helpId" placeholder="">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="">To :</label>
                            <input type="number" class="form-control" name="" id="" aria-describedby="helpId" placeholder="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Overall Result Percentage (%)</label>
                            <input type="number" class="form-control" name="" id="" aria-describedby="helpId" placeholder="">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-check col-md-12">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="" id="" value="checkedValue">
                                Vocational Training?
                            </label>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="">Field of the vocational training</label>
                            <input type="text" class="form-control" name="" id="" aria-describedby="helpId" placeholder="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Year of completion</label>
                            <input type="text" class="form-control" name="" id="" aria-describedby="helpId" placeholder="">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="">Overall Result Percentage (%)</label>
                            <input type="text" class="form-control" name="" id="" aria-describedby="helpId" placeholder="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Duration of the vocational training (Months)</label>
                            <input type="text" class="form-control" name="" id="" aria-describedby="helpId" placeholder="">
                        </div>
                    </div>
                    <div class="form-row mt-4">
                        <p class="font-weight-bold">Bachelors</p>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="">Name of the university :</label>
                            <input type="text" class="form-control" name="" id="" aria-describedby="helpId" placeholder="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Major subject :</label>
                            <input type="text" class="form-control" name="" id="" aria-describedby="helpId" placeholder="">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="">Years of the degree program</label>
                            <input type="text" class="form-control" name="" id="" aria-describedby="helpId" placeholder="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Overall result percentage (%)</label>
                            <input type="text" class="form-control" name="" id="" aria-describedby="helpId" placeholder="">
                        </div>
                    </div>
                    <div class="form-row mt-4">
                        <p class="font-weight-bold">Masters</p>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="">Name of the university :</label>
                            <input type="text" class="form-control" name="" id="" aria-describedby="helpId" placeholder="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Major subject :</label>
                            <input type="text" class="form-control" name="" id="" aria-describedby="helpId" placeholder="">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="">Years of the degree program :</label>
                            <input type="text" class="form-control" name="" id="" aria-describedby="helpId" placeholder="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Overall result percentage (%) :</label>
                            <input type="text" class="form-control" name="" id="" aria-describedby="helpId" placeholder="">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-check col-md-12">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="" id="" value="checkedValue">
                                Working experience?
                            </label>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="">Name of the field that you work :</label>
                            <input type="text" class="form-control" name="" id="" aria-describedby="helpId" placeholder="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">How many years of experience? :</label>
                            <input type="text" class="form-control" name="" id="" aria-describedby="helpId" placeholder="">
                        </div>
                    </div>
                    <div class="form-row mt-4">
                        <p class="font-weight-bold">Language proficiency & other details</p>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="">German language proficiency (please include certified copies of certificates) Have your learnt German? :</label>
                            <br>
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="radio2" id="" value="checkedValue"> Yes
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="radio2" id="" value="checkedValue"> No
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="">Which level? :</label>
                            <br>
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="radio3" id="" value="checkedValue"> A1
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="radio3" id="" value="checkedValue"> A2
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="radio3" id="" value="checkedValue"> B1
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="radio3" id="" value="checkedValue"> B2
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="radio3" id="" value="checkedValue"> C1
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="radio3" id="" value="checkedValue"> C2
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
                                    <input class="form-check-input" type="checkbox" name="check1" id="" value="checkedValue"> Agent / Educational Consultancy
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" name="check1" id="" value="checkedValue"> Facebook Advertiesments
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" name="check1" id="" value="checkedValue"> Promotional Email
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="">Name of the agent or education consultancy (If you know IAS college from agent or education consultancy) :</label>
                            <input type="text" class="form-control" name="" id="" aria-describedby="helpId" placeholder="">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="">If you wish to provide any further reasons for your application, please use the comment box :</label>
                            <textarea type="text" class="form-control" name="" id="" aria-describedby="helpId" placeholder="" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <p>Declaration

                                I confirm that to the best of my knowledge the information I have provided on this form is true, complete and accurate. I am aware that intentionally or negligently providing false information constitutes an administrative offence and may lead to exclusion from the admissions procedure or – if discovered at a later date – to the cancellation of my admission or enrollment. I confirm that I have read the admission information for my desired course from the IAS College GmbH Homepage. <br><br>

                                In the case this application is sent to uni‐assist, I hereby confirm that I have read and accept the general terms and conditions (AGB) provided by uni‐assist e.V. on www.uni-assist.de/agb/. <br><br>

                                Please Note - All information provided herein will be stored and processed by the college/university. They are fully subject to the data protection regulations currently in effect. By clicking the submit button below, you confirm your agreement with these terms. <br><br>

                                Once you are selected for admission, you are required to substantiate with certified copies and translations (German or English) of your certificates. Important: All certificates must be Notary attested.</p>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" name="check1" id="" value="checkedValue"> I agree to all terms and conditions
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
@endsection