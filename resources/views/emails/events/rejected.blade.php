@component('mail::message')
# Event Rejected

Hi {{ $event->user->name }},

We’re sorry, but your event **{{ $event->name }}** was not approved.

**Reason:**  
{{ $event->vetting_comments }}

If you’d like to revise and resubmit, please update your submission.

Thanks,<br>
{{ config('app.name') }} Team
@endcomponent
