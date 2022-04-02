@extends('layouts.student-dashboard.main')

@section('content')
<div class="card">
    <div class="card-header bg-primary text-white">
        <p>Student Registration</p>
    </div>
    <div class="card-body">
        <div id="wizard">
            <h2>Basic Information</h2>
            <section>
                <form action="" method="post">
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="">Name :</label>
                            <input type="text" name="" id="" class="form-control">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="">Mobile Number :</label>
                            <input type="text" name="" id="" class="form-control">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="">Date of Birth :</label>
                            <input type="date" name="" id="" class="form-control">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="">Mobile Number :</label>
                            <select name="" id="">
                                <option value="" selected disabled>Select...</option>
                                <option value="">Male</option>
                                <option value="">Female</option>
                                <option value="">Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="">Blood Group :</label>
                            <select name="" id="">
                                <option value="" selected disabled>Select...</option>
                                <option value="">A</option>
                                <option value="">B</option>
                                <option value="">O+</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="">City :</label>
                            <input type="text" name="" id="" class="form-control">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="">Country :</label>
                            <select name="" id="">
                                <option value="" selected disabled>Select...</option>
                                <option value="">Sri Lanka</option>
                                <option value="">India</option>
                                <option value="">Bangladesh</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="">Nationality :</label>
                            <select name="" id="">
                                <option value="" selected disabled>Select...</option>
                                <option value="">Sri Lanka</option>
                                <option value="">India</option>
                                <option value="">Bangladesh</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="">Birth Place :</label>
                            <input type="text" name="" id="" class="form-control">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="">Passport No :</label>
                            <input type="text" name="" id="" class="form-control">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="">Skype ID :</label>
                            <input type="date" name="" id="" class="form-control">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="">Whatsapp Number :</label>
                            <input type="date" name="" id="" class="form-control">
                        </div>
                    </div>
                </form>
            </section>

            <h2>Gurdian Information</h2>
            <section>
                <form action="" method="post">
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="">Title :</label>
                            <select name="" id="">
                                <option value="" selected disabled>Select...</option>
                                <option value="">Mr</option>
                                <option value="">Ms</option>
                                <option value="">Mrs</option>
                                <option value="">Dr</option>
                                <option value="">Prof</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="">First Name :</label>
                            <input type="text" name="" id="" class="form-control">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="">Last Name :</label>
                            <input type="text" name="" id="" class="form-control">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="">Email Address :</label>
                            <input type="email" name="" id="" class="form-control">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="">Phone Number :</label>
                            <input type="text" name="" id="" class="form-control">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="">Mobile Number :</label>
                            <input type="text" name="" id="" class="form-control">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="">Relationship :</label>
                            <input type="text" name="" id="" class="form-control">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="">Income :</label>
                            <input type="text" name="" id="" class="form-control">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="">Qualification :</label>
                            <input type="text" name="" id="" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Occupation :</label>
                            <input type="text" name="" id="" class="form-control">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="">Home Address :</label>
                            <textarea name="" id="" cols="30" rows="5" class="form-control"></textarea>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Office Address :</label>
                            <textarea name="" id="" cols="30" rows="5" class="form-control"></textarea>
                        </div>
                    </div>
                </form>
            </section>

            <h2>Address Verification</h2>
            <section>
                <form action="" method="post">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-row">
                                <h4>Current Address</h4>
                                <hr>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="">Address Line :</label>
                                    <textarea name="" id="" cols="30" rows="5" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="">Country :</label>
                                    <select name="" id="">
                                        <option value="" selected disabled>Select...</option>
                                        <option value="">Sri Lanka</option>
                                        <option value="">India</option>
                                        <option value="">Bangladesh</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">State :</label>
                                    <input type="text" name="" id="" class="form-control">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="">City :</label>
                                    <input type="text" name="" id="" class="form-control">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Pincode :</label>
                                    <input type="text" name="" id="" class="form-control">
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
                                    <label for="">Address Line :</label>
                                    <textarea name="" id="" cols="30" rows="5" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="">Country :</label>
                                    <select name="" id="">
                                        <option value="" selected disabled>Select...</option>
                                        <option value="">Sri Lanka</option>
                                        <option value="">India</option>
                                        <option value="">Bangladesh</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">State :</label>
                                    <input type="text" name="" id="" class="form-control">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="">City :</label>
                                    <input type="text" name="" id="" class="form-control">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Pincode :</label>
                                    <input type="text" name="" id="" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </section>
            <h2>Process Progress</h2>
            <section>
                <div class="alert alert-success" role="alert">
                    <h4 class="alert-heading">Well done!</h4>
                    <p>You have succesfully submited your personal details. We will review and approve it as soon as possible.</p>
                    <hr>
                    <p class="mb-0">Please stay touched with the website and email. <br>Thanks <br>IAS College.</p>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection