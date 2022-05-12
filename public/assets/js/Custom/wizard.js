$(function () {
    'use strict';

    /**
     * validation - jquery validation
     * student wizard - all steps
     */

    const form = $("#formStep1");

    form.validate({
        debug: false,
        rules: {
            //step 1
            first_name: 'required',
            sur_name: 'required',
            mobile_no: {
                required: true,
                digits: true
            },
            dob: {
                required: true,
                date: true
            },
            gender: 'required',
            addressLine: 'required',
            city: 'required',
            state: 'required',
            zip: 'required',
            country_id: 'required',
            nationality: 'required',
            whatsapp_no: {
                required: true,
                digits: true
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

            //step3
            // img: 'required'
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



        }
    });


});
