@component('mail::message')
# Dear {{ $organisation->owner->name }}

Hurray! Your organisation has been created.<br>
Name: {{ $organisation->name }}<br>
Trial End At: {{ $organisation->trial_end }}<br>

Regards.
@endcomponent