<!-- Modal basic -->
<div class="modal fade modalForm" id="modelb" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Basic Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post" id="studentInformationForm">
                @csrf
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="">Course you have been applied for :<span class="text-danger">*</span></label>
                            <select name="courseId" lass="form-control bg-white" id="" readonly>
                                <option value="{{$coursesDetails->course_id}}"
                                        selected>{{$coursesDetails->course_code.' '.$coursesDetails->course_name}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="">First Name :<span class="text-danger">*</span></label>
                            <input type="text" name="first_name" id="" class="form-control"
                                   value="{{ $candidateDetails->first_name }}">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="">Surname :<span class="text-danger">*</span></label>
                            <input type="text" name="sur_name" id="" class="form-control"
                                   value="{{ $candidateDetails->sur_name }}" required>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="">Mobile Number :<span class="text-danger">*</span></label>
                            <input type="text" name="mobile_no" id="" class="form-control"
                                   value="{{ $candidateDetails->telephone }}">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="">Date of Birth :<span class="text-danger">*</span></label>
                            <input type="date" name="dob" id="" class="form-control"
                                   value="{{ $candidateDetails->dob }}">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="">Sex :<span class="text-danger">*</span></label>
                            <select name="gender" id="sex">
                                <option value="" selected disabled>Select...</option>
                                <option value="1" @if($candidateDetails->sex === 1) {{'selected'}} @endif>Male
                                </option>
                                <option value="0" @if($candidateDetails->sex === 0) {{'selected'}} @endif>Female
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        @php
                            $address = explode(",",$candidateDetails->address);
                        @endphp
                        <div class="form-group col-md-4">
                            <label for="">Address Line 1 :<span class="text-danger">*</span></label>
                            <input type="text" name="addressLine" id="" class="form-control"
                                   value="{{ $address[0] }}">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">City :<span class="text-danger">*</span></label>
                            <input type="text" name="city" id="" class="form-control"
                                   value="{{ $candidateDetails->city }}">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">State / Province / Region :<span class="text-danger">*</span></label>
                            <input type="text" name="state" id="" class="form-control"
                                   value="{{$candidateDetails->state}}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="">Zip Code :<span class="text-danger">*</span></label>
                            <input type="text" name="zip" id="" class="form-control"
                                   value="{{$candidateDetails->zipcode}}">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Country :<span class="text-danger">*</span></label>
                            <select name="country_id" id="country">
                                <option value="" selected disabled>Select...</option>
                                @foreach($countries as $country)
                                    <option
                                        value="{{$country->id}}" @if($candidateDetails->country == $country->id) {{'selected'}} @endif>{{$country->iso3}}
                                        - {{$country->nicename}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Nationality :<span class="text-danger">*</span></label>
                            <select name="nationality" id="nationality">
                                <option value="" selected disabled>Select...</option>
                                @foreach($countries as $country)
                                    <option
                                        value="{{$country->id}}" @if($candidateDetails->nationality == $country->id) {{'selected'}} @endif>{{$country->iso3}}
                                        - {{$country->nicename}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <label for="">Passport No :</label>
                            <input type="text" name="passport_no" id="" class="form-control"
                                   value="{{$candidateDetails->passport_no}}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Whatsapp Number :<span class="text-danger">*</span></label>
                            <input type="text" name="whatsapp_no" id="" class="form-control"
                                   value="{{$candidateDetails->whatsapp_no}}">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-warning">Save</button>
                </div>
                <input type="hidden" name="formNo" value="1">
            </form>
        </div>
    </div>
</div>

<!-- Modal Guardian -->
<div class="modal fade modalForm" id="modelg" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Gurdian Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post" id="guardianInformationForm">
                @csrf
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="guardian_title">Title :<span class="text-danger">*</span></label>
                            <select name="guardian_title" id="guardian_title">
                                <option value="" selected disabled>Select...</option>
                                <option value="Mr" @if(isset($guardianDetails->guardian_title) && $guardianDetails->guardian_title === 'Mr') {{'selected'}} @endif>Mr</option>
                                <option value="Ms" @if(isset($guardianDetails->guardian_title) && $guardianDetails->guardian_title === 'Ms') {{'selected'}} @endif>Ms</option>
                                <option value="Mrs" @if(isset($guardianDetails->guardian_title) && $guardianDetails->guardian_title === 'Mrs') {{'selected'}} @endif>Mrs</option>
                                <option value="Dr" @if(isset($guardianDetails->guardian_title) && $guardianDetails->guardian_title === 'Dr') {{'selected'}} @endif>Dr</option>
                                <option value="Prof" @if(isset($guardianDetails->guardian_title) && $guardianDetails->guardian_title === 'Prof') {{'selected'}} @endif>Prof</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="guardian_firstName">First Name :<span class="text-danger">*</span></label>
                            <input type="text" name="guardian_firstName" id="" class="form-control" value="{{$guardianDetails->guardian_firstName ?? ''}}">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="guardian_lastName">Last Name :<span class="text-danger">*</span></label>
                            <input type="text" name="guardian_lastName" id="" class="form-control" value="{{$guardianDetails->guardian_lastName ?? ''}}">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="guardian_email">Email Address :<span class="text-danger">*</span></label>
                            <input type="email" name="guardian_email" id="" class="form-control" value="{{$guardianDetails->guardian_email ?? ''}}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="guardian_phoneNo">Phone Number :<span class="text-danger">*</span></label>
                            <input type="text" name="guardian_phoneNo" id="" class="form-control" value="{{$guardianDetails->guardian_phoneNo ?? ''}}">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="guardian_mobileNo">Mobile Number :<span class="text-danger">*</span></label>
                            <input type="text" name="guardian_mobileNo" id="" class="form-control" value="{{$guardianDetails->guardian_mobileNo ?? ''}}">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="relationship">Relationship :<span class="text-danger">*</span></label>
                            <input type="text" name="relationship" id="" class="form-control" value="{{$guardianDetails->relationship ?? ''}}">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="occupation">Occupation :<span class="text-danger">*</span></label>
                            <input type="text" name="occupation" id="" class="form-control" value="{{$guardianDetails->occupation ?? ''}}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="homeAddress">Home Address :<span class="text-danger">*</span></label>
                            <textarea name="homeAddress" id="homeAddress" cols="30" rows="5"
                                      class="form-control">{{$guardianDetails->home_address ?? ''}}</textarea>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-warning">Save</button>
                </div>
                <input type="hidden" name="formNo" value="2">
            </form>
        </div>
    </div>
</div>
