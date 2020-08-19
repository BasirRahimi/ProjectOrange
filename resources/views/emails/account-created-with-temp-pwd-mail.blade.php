@component('mail::message')
# Welcome to Project Orange

This is your temporary password:

**{{$tempPassword}}**

Please change it when you [log in]({{ config('app.url') }}).

Thanks,<br>
{{ config('app.name') }}
@endcomponent
