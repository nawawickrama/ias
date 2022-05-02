@php
    if(Session::has('success')){
        toast('Successful!','success')->timerProgressBar()->width('300px');
        Session::forget('success');
    }

    if(Session::has('error')){
        toast(session::get('error'),session::get('error_type'))->timerProgressBar()->autoClose(7000);
        Session::forget('error');
        Session::forget('error_type');
    }
@endphp


<script>
    /**
     *
     * @param icon
     * @param msg
     */
    function notify(icon, msg){
       const Toast = Swal.mixin({
            toast: true,
            position: 'top',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: icon,
            title: msg
        })
    }
</script>
