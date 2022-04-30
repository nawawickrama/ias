$(function () {
    'use strict';

    /**
     * validation - jquery validation
     * student wizard - all steps
     */

    let form = $("#formStep1");
    form.validate({
        debug: false,
        rules: {
            //step 1
            first_name: 'required',
            sur_name: 'required',
            st_phone_no: {
                required: true,
            },
            st_dob: {
                required: true,
                date: true
            },
            sex: 'required',
            addressLine: 'required',
            city: 'required',
            state: 'required',
            zip: 'required',
            country: 'required',
            nationality: 'required',
            passport_no: 'required',
            whatsapp_no: {
                required: true,
            },

            //step 2
            guardian_title: 'required',
            guardian_firstName : 'required',
            guardian_lastName : 'required',
            guardian_email : 'required',
            guardian_phoneNo : {
                required: true,
            },
            guardian_mobileNo : {
                required: true,
            },
            relationship : 'required',
            occupation : 'required',
            homeAddress : 'required',

        }
    });
    form.children("div").steps({
        headerTag: "h2",
        bodyTag: "section",
        transitionEffect: "slideLeft",

        onStepChanging: function (event, currentIndex, newIndex) {
            form.validate().settings.ignore = ":disabled,:hidden";
            return form.valid();
        },

        onFinishing: function (event, currentIndex) {
            form.validate().settings.ignore = ":disabled";
            return form.valid();
        },

        onFinished: function (event, currentIndex) {
            const _this = this;
            _this.st_name = $('input[name="st_name"]').val();
            _this.st_phone_no = $('input[name="st_phone_no"]').val();
            _this.st_dob = $('input[name="st_dob"]').val();
            _this.sex = $('#sex').val();
            _this.blood_group = $('#st_blood_group').val();
            _this.city = $('input[name="city"]').val();
            _this.country = $('#country').val();
            _this.nationality = $('#nationality').val();
            _this.birth_place = $('input[name="birth_place"]').val();
            _this.passport_no = $('input[name="passport_no"]').val();
            _this.skype_id = $('input[name="skype_id"]').val();
            _this.whatsapp_no = $('input[name="whatsapp_no"]').val();
            _this.guardian_title = $('#guardian_title').val();
            _this.guardian_firstName = $('input[name="guardian_firstName"]').val();
            _this.guardian_lastName = $('input[name="guardian_lastName"]').val();
            _this.guardian_email = $('input[name="guardian_email"]').val();
            _this.guardian_phoneNo = $('input[name="guardian_phoneNo"]').val();
            _this.guardian_mobileNo = $('input[name="guardian_mobileNo"]').val();
            _this.relationship = $('input[name="relationship"]').val();
            _this.income = $('input[name="income"]').val();
            _this.qualification = $('input[name="qualification"]').val();
            _this.occupation = $('input[name="occupation"]').val();
            _this.homeAddress = $('#homeAddress').val();
            _this.officeAddress = $('#officeAddress').val();

            _this.currentAddress = $('#currentAddress').val();
            _this.currentCountry = $('#currentCountry').val();
            _this.currentState = $('input[name="currentState"]').val();
            _this.currentCity = $('input[name="currentCity"]').val();
            _this.CurrentPincode = $('input[name="CurrentPincode"]').val();
            _this.permanentAddress = $('#permanentAddress').val();
            _this.permanentCountry = $('#permanentCountry').val();
            _this.permanentState = $('input[name="permanentState"]').val();
            _this.permanentCity = $('input[name="permanentCity"]').val();
            _this.permanentPincode = $('input[name="permanentPincode"]').val();

            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: "/student/wizard",
                method: 'post',
                data:{
                    name: _this.st_name,
                    mobile_no: _this.st_phone_no,
                    dob: _this.st_dob,
                    gender: _this.sex,
                    blood_group: _this.blood_group,
                    city: _this.city,
                    country_id: _this.country,
                    nationality: _this.nationality,
                    birth_place: _this.birth_place,
                    passport_no: _this.passport_no,
                    skype_id: _this.skype_id,
                    whatsapp_no: _this.whatsapp_no,

                    guardian_title: _this.guardian_title,
                    guardian_firstName: _this.guardian_firstName,
                    guardian_lastName: _this.guardian_lastName,
                    guardian_email: _this.guardian_email,
                    guardian_phoneNo: _this.guardian_phoneNo,
                    guardian_mobileNo: _this.guardian_mobileNo,
                    relationship: _this.relationship,
                    income: _this.income,
                    qualification: _this.qualification,
                    occupation: _this.occupation,
                    homeAddress: _this.homeAddress,
                    officeAddress: _this.officeAddress,

                    currentAddress: _this.currentAddress,
                    currentCountry: _this.currentCountry,
                    currentState: _this.currentState,
                    currentCity: _this.currentCity,
                    CurrentPincode: _this.CurrentPincode,
                    permanentAddress: _this.permanentAddress,
                    permanentCountry: _this.permanentCountry,
                    permanentState: _this.permanentState,
                    permanentCity: _this.permanentCity,
                    permanentPincode: _this.permanentPincode,
                },
                success:function (){
                    Swal.fire({
                        position: 'top-end',
                        toast: true,
                        icon: 'success',
                        title: 'Student registered successful.',
                        showConfirmButton: false,
                        timer: 1500
                    })
                },
                error:function (response){
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        toast: true,
                        title: response.statusText,
                        showConfirmButton: false,
                        timer: 1500
                    })
                    // console.log(response)
                }
            })
        }
    });


});
