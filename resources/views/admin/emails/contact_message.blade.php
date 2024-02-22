@component('mail::message')


<p>{{$array['message']}}</p>

From <br>
{{$array['name']}} {{$array['name']}} <br>
Thanks,<br>
{{ config('app.name') }}
@endcomponent