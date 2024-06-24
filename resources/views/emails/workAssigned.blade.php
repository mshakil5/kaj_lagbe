@component('mail::message')
Hello {{ $emailData['staffname'] }},

You have been assigned a new work item.

## Details:
- **Name:** {{ $emailData['firstname'] }}
- **Phone:** {{ $emailData['phone'] }}
- **Address:** {{ $emailData['address1'] }}, {{ $emailData['address2'] }}, {{ $emailData['address3'] }}, {{ $emailData['town'] }}, {{ $emailData['postcode'] }}

Please log in to your account to view more details.

Thanks,<br>
{{ config('app.name') }}
@endcomponent