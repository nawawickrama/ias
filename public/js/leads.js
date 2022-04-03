//email btn
$('.btn-email').click(function() {
    let email = $(this).attr('data-email');
    $('.email_form').val(email);
    $('.send-form').attr('action', '/button-mail');
    $('.send-form').submit();
});

//potential btn
$('.btn-potential').click(function() {
    let lead_id = $(this).attr('lead-id');
    $('.lead_id_form').val(lead_id);
    $('.send-form').attr('action', '/make-lead-as-potential');
    $('.send-form').submit();
});

//whatsapp btn
$('.btn-whtsapp').click(function() {
    let whtsapp = $(this).attr('lead_whatsapp');
    var url = "https://wa.me/" + whtsapp;
    window.open(url, "_blank");
});

//edit btn
$('.btn-lead-edit').click(function() {
    let lead_id = $(this).attr('lead_id');

    let lead_sur_name = $(this).attr('lead_sur_name');
    let lead_first_name = $(this).attr('lead_first_name');
    let lead_email = $(this).attr('lead_email');
    let lead_course_id = $(this).attr('lead_course_id');
    let lead_whtasapp = $(this).attr('lead_whtasapp');
    let lead_contact = $(this).attr('lead_contact');
    let lead_intake_year = $(this).attr('lead_intake_year');
    let lead_country_id = $(this).attr('lead_country_id');
    let lead_source = $(this).attr('lead_source');
    let lead_city = $(this).attr('lead_city');
    let lead_comment = $(this).attr('lead_comment');

    $('#lead_id_edit_form').val(lead_id);
    $('#edit_form_sur_name').val(lead_sur_name);
    $('#edit_form_first_name').val(lead_first_name);
    $('#edit_form_whatsapp').val(lead_whtasapp);
    $('#edit_form_contact').val(lead_contact);
    $('#edit_form_intake_year').val(lead_intake_year);
    $('#edit_form_country').val(lead_country_id);
    $('#edit_form_sourcr').val(lead_source);
    $('#edit_form_comment').val(lead_comment);
    $('#edit_form_email').val(lead_email);
    $('#edit_form_city_id').val(lead_city);
    $('#edit_form_course').val(lead_course_id);


    $('#editModel').modal('show');
});

//activity btn
$('.btn-activity-log').click(function() {
    var lead_id = $(this).attr('lead-id');

    $.ajax({
        url: '/view-lead-activity-log',
        method: 'post',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            lead_id: lead_id,
        },

        success: function(data) {
            // console.log(data);
            $('#activityContainer').html(data);
            $('#activityLog').modal('show');

        },
        error: function(error) {
            // console.log(error);

        }
    });
});

//set reminder btn
$('.btn-set-reminder').click(function() {
    let lead_id = $(this).attr('lead-id');
    $('#lead_id_set_reminder').val(lead_id);
    $('#setReminder').modal('show');
});

//cpf link email
$('.btn-cpf').click(function(){
    let random_cpf_no = $(this).attr('random-no');
    $('.random_cpf_no').val(random_cpf_no);
    $('.send-form').attr('action', "/potential-lead-cpf-send");
    $('.send-form').submit();
});
