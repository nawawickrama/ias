notification();
indicator();
notificationCount();

/**
 * Main notification panel
 */
function notification() {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "/ajax/notification",
        method: 'POST',
        success: function (response) {
            $('#notificationPanel').html(response);
            feather.replace();

        },error:function (error){
            console.log(error.responseJSON.exception);
        }
    });
}

/**
 * Main notification count
 */
function notificationCount() {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "/ajax/notification-count",
        method: 'POST',
        success: function (response) {
            $('.notify-count').text(response.count);

            if(response.count > 0){
                $('.notify').removeClass('d-none');
            }

        }
    });
}

/**
 * Sidebar number indication
 */
function indicator() {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "/ajax/pending",
        type: 'POST',
        dataType: "json",
        success: function(data) {
            let options = ['pendingCPF', 'pendingLeads', 'potentialStudent', 'pendingDocument'];
            options.forEach(function (value, index,){

                if (value.length > 0) {
                    $('.text-header-'+value).text(data[value]);
                    $('.'+value).removeClass('invisible');
                } else {
                    $('.text-header-'+value).text('');
                    $('.'+value).addClass('invisible');
                }
            })
        }

    });
}

setInterval(() => {
    notification()
    indicator()
    notificationCount()
}, 10000)
