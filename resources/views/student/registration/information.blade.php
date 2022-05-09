@extends('layouts.dashboard.main')

@section('content')
<div class="alert alert-icon-primary" role="alert">
    <i data-feather="alert-circle"></i>
    <b>TIP :</b> Please complete all the required fields. Once you fill all the details, you will get a success message.
</div>
<div class="card">
    <div class="card-header bg-primary">
        <div class="row">
            <div class="col md-8">
                <p class="text-white">Basic Information</p>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-warning btn-icon-text btn-block" data-toggle="modal" data-target="#modelb"><i class="btn-icon-prepend" data-feather="edit"></i>Edit Details</button>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-3">
                <p><b>Name :</b> Ayesh Nawawickrama</p>
            </div>
            <div class="col-md-3">
                <p><b>Surname :</b> Bernadge</p>
            </div>
            <div class="col-md-3">
                <p><b>Date of Birth :</b> 1996 December 11</p>
            </div>
            <div class="col-md-3">
                <p><b>Mobile Number :</b> 0779389533</p>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-3">
                <p><b>Address Line :</b> 137/1 Malpeththawa</p>
            </div>
            <div class="col-md-3">
                <p><b>City :</b> Ambalantota</p>
            </div>
            <div class="col-md-3">
                <p><b>State/Province/Region :</b> South Province</p>
            </div>
            <div class="col-md-3">
                <p><b>Zip Code :</b> 82100</p>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-3">
                <p><b>Country :</b> 137/1 Malpeththawa</p>
            </div>
            <div class="col-md-3">
                <p><b>Nationality :</b> Ambalantota</p>
            </div>
            <div class="col-md-3">
                <p><b>Passport Number :</b> South Province</p>
            </div>
            <div class="col-md-3">
                <p><b>WhatsApp Number :</b> 82100</p>
            </div>
        </div>
    </div>
</div>
<div class="card mt-4">
    <div class="card-header bg-primary">
        <div class="row">
            <div class="col md-8">
                <p class="text-white">Gurdian Information</p>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-warning btn-icon-text btn-block" data-toggle="modal" data-target="#modelg"><i class="btn-icon-prepend" data-feather="edit"></i>Edit Details</button>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-3">
                <p><b>Title :</b> Mr.</p>
            </div>
            <div class="col-md-3">
                <p><b>First Name :</b> Nadie</p>
            </div>
            <div class="col-md-3">
                <p><b>Last Name :</b> Rohana Bernadge</p>
            </div>
            <div class="col-md-3">
                <p><b>Email Address :</b> nadier@slt.net.lk</p>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-3">
                <p><b>Home Phone Number :</b> 0472225164</p>
            </div>
            <div class="col-md-3">
                <p><b>Mobile Number :</b> 0779389533</p>
            </div>
            <div class="col-md-3">
                <p><b>Relationship :</b> Father</p>
            </div>
            <div class="col-md-3">
                <p><b>Occupation :</b> Senior Engineer</p>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-12">
                <p><b>Recidance Address :</b> 137/1 Malpeththawa, Ambalantota, Sri Lanka</p>
            </div>
        </div>
    </div>
</div>
<!-- Modal basic -->
<div class="modal fade" id="modelb" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Basic Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="">Course you have been applied for :<span class="text-danger">*</span></label>
                            <input type="text" name="courseId" class="form-control" id="" value="STEP" disabled>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="">First Name :<span class="text-danger">*</span></label>
                            <input type="text" name="first_name" id="" class="form-control" value="" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="">Surname :<span class="text-danger">*</span></label>
                            <input type="text" name="sur_name" id="" class="form-control" value="" required>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="">Mobile Number :<span class="text-danger">*</span></label>
                            <input type="text" name="mobile_no" id="" class="form-control" value="">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="">Date of Birth :<span class="text-danger">*</span></label>
                            <input type="date" name="dob" id="" class="form-control" value="">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="">Sex :<span class="text-danger">*</span></label>
                            <select name="gender" id="sex">
                                <option value="" selected disabled>Select...</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="">Address Line :<span class="text-danger">*</span></label>
                            <input type="text" name="addressLine" id="" class="form-control" value="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">City :<span class="text-danger">*</span></label>
                            <input type="text" name="city" id="" class="form-control" value="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">State / Province / Region :<span class="text-danger">*</span></label>
                            <input type="text" name="state" id="" class="form-control" value="">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="">Zip Code :<span class="text-danger">*</span></label>
                            <input type="text" name="zip" id="" class="form-control" value="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Country :<span class="text-danger">*</span></label>
                            <select name="country_id" id="country">
                                <option value="" selected disabled>Select...</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Nationality :<span class="text-danger">*</span></label>
                            <select name="nationality" id="nationality">
                                <option value="" selected disabled>Select...</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <label for="">Passport No :</label>
                            <input type="text" name="passport_no" id="" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Whatsapp Number :<span class="text-danger">*</span></label>
                            <input type="text" name="whatsapp_no" id="" class="form-control">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-warning">Save</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Gurdian -->
<div class="modal fade" id="modelg" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Gurdian Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
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
                            <label for="">Occupation :<span class="text-danger">*</span></label>
                            <input type="text" name="occupation" id="" class="form-control">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="">Home Address :<span class="text-danger">*</span></label>
                            <textarea name="homeAddress" id="homeAddress" cols="30" rows="5" class="form-control"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-warning">Save</button>
            </div>
        </div>
    </div>
</div>
@endsection