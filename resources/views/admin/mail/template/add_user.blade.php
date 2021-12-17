@component('mail::message')
# Welcome to IAS College.

Your Password: {{ $date }}
Login Page: {{ config('app.url') }}

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
