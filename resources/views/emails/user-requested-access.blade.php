@component('mail::message')
# A new user is requesting access

Name: {{$user->honorific}} {{$user->name}} {{$user->surname}}
<br>
Email: {{$user->email}}
<br>
Company: @if($user->company) {{$user->company}} @else Not given @endif
<br>
<br>
Please [log in]({{ config('app.url') }}) to grant access.
<br>
<br>
Thanks,<br>
{{ config('app.name') }}
@endcomponent
