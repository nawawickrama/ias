@component('mail::message')
# Welcome to IAS College

Your login password is <b>{{ $data }}</b><br>

@component('mail::button', ['url' => config('app.url')])
Sign in
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
