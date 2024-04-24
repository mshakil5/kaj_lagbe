@component('mail::message')
# Thank you for sending  message

**Name:** {{ $array['firstname'] }} {{ $array['lastname'] }}  
**Email:** {{ $array['email'] }}  
**Message:** {{ $array['message'] }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
