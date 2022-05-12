const form = $("#studentInformationForm");

form.validate({
    debug: false,

    rules: {
        formNo: 1,
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
                $('#modelb').modal('hide');
                notify('error', response.erros.message);
            }
        });


    }
});
