@component('mail::message')
# Callback Request

A callback request has been received from:

**Name:** {{ $userData['name'] }}
<br>
**Email:** {{ $userData['email'] }}
<br>
**Phone:** {{ $userData['phone'] }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
