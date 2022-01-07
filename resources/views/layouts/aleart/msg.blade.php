@php
    if(Session::has('success')){
        toast('Successful!','success')->timerProgressBar()->width('300px');
        Session::forget('success');
    }

    if(Session::has('error')){
        toast(session::get('error'),session::get('error_type'))->timerProgressBar()->autoClose(10000);
        Session::forget('error');
        Session::forget('error_type');
    }
@endphp