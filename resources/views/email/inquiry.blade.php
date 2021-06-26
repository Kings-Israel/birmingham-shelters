@component('mail::message')
Hello, in response to your inquiry: <br>
<h5>Your Inquiry:</h5>
@component('mail::panel')
{{ $inquiry }}
@endcomponent
<h5>Response:</h5>
@component('mail::panel')
{{ $reply }}
@endcomponent

Regards,<br>
{{ config('app.name') }}
@endcomponent
