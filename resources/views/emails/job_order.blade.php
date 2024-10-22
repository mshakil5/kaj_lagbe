@component('mail::message')

**Category:** {{ $array['category_name'] }} <br>
**Name:** {{ $array['firstname'] }} <br>
**Email:** {{ $array['email'] }}  <br>
**Phone:** {{ $array['phone'] }}  <br>
**Address:** {{ $array['address1'] }}  {{ $array['address2'] }}  {{ $array['address3'] }},  {{ $array['town'] }}  {{ $array['postcode'] }}  
**Message:** {{ $array['message'] }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
