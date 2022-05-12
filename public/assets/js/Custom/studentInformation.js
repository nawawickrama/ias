const form1 = $("#studentInformationForm");

form1.validate({
    debug: false,

    rules: {
        formNo: 'required',
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
        }
    },
    submitHandler: function() {
        formSubmit();
    }
});

const form2 = $("#guardianInformationForm");

form2.validate({
    debug: false,

    rules: {
        formNo: 'required',
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
    },
    submitHandler: function() {
        formSubmit();
    }
});

function formSubmit(){
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: "/student/information",
        method: 'post',
        data:new FormData(document.getElementById("studentInformationForm")),
        processData: false,
        dataType: 'json',
        contentType: false,

        success:function (){
            $('#modelb').modal('hide');
            notify('success', 'Student registered successful');
            setTimeout(function() {
                location.replace('/student/pending-verification');
            }, 3000);

        },
        error:function (response){
            let error = '';
            $('#modelb').modal('hide');

            $.each(response.responseJSON.errors, function (index, value){
                error += value+"<br>";
            });

            notify('error', error, false);
        }
    });
}
