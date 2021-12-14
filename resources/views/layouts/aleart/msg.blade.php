@php
    if(Session::has('success')){
        toast('Successful!','success');
    }

    if(Session::has('error')){
        toast(session::get('error'),session::get('error_type'));
    }
@endphp