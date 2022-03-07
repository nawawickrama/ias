@component('mail::message')
# {{ $subject }}

This is your CPF link:

@component('mail::button', ['url' =>  $link ])
CPF Link
@endcomponent

<small><i>
if button is not working please click this link: <a href="{{ $link }}">{{ $link }}</a>
</i></small>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
