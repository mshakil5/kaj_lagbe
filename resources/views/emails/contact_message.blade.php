@component('mail::message')


<p>{{$array['message']}}</p>

From <br>
{{$array['firstname']}} {{$array['lastname']}} <br>
Thanks,<br>
{{ config('app.name') }}
@endcomponent