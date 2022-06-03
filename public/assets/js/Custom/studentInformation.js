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
        let data = new FormData(document.getElementById('studentInformationForm'));
        formSubmit(data);
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
        let data = new FormData(document.getElementById('guardianInformationForm'));
        formSubmit(data);
    }
});

const form3 = $("#documentForm");

form3.validate({
    debug: false,

    rules: {
        formNo: 'required',
    },
    submitHandler: function() {
        let data = new FormData(document.getElementById('documentForm'));
        formSubmit(data);
    }
});

function formSubmit(element){
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: "/student/information",
        method: 'post',
        data:element,
        processData: false,
        dataType: 'json',
        contentType: false,

        success:function (){
            $('.modalForm').modal('hide');
            notify('success', 'Information update successful.');
            setTimeout(function() {
                location.reload();
            }, 3000);

        },
        error:function (response){
            let error = '';
            $('#modelb').modal('hide');
            if(response.responseJSON.errors) {
                $.each(response.responseJSON.errors, function (index, value) {
                    error += value + "<br>";
                });
            }else{
                error = response.responseJSON.message;
            }

            notify('error', error, false);
        }
    });
}

/**
 * re-upload document
 * @type {*|jQuery|HTMLElement}
 */
let fileID;
let docName;

const reUploadForm = $("#reUploadDocumentForm");

reUploadForm.validate({
    debug: false,

    rules: {
        resubmitDoc: 'required',
    },
    submitHandler: function() {

        $('#reUploadDocumentForm').trigger('submit');
    }
});

/**
 * Student Document section
 * Re-upload button click
 */
$('.btn-re-upload-doc').click(function (){

    fileID = $(this).attr('candidate-doc-id');
    docName = $(this).attr('doc-name');

    $('input[name="fileID"]').val(fileID);
    $('input[name="docName"]').val(docName);

    $('#reUploadInputField').attr('placeholder', docName +' Mandatory');
    $('#reUploadModal').modal('show');
});
