@component('mail::message')
# Event Approved

Hi {{ $event->user->name }},

Your event **{{ $event->name }}** has been approved and is now live.

@component('mail::button', ['url' => route('events.index')])
View your events
@endcomponent

Thanks,<br>
{{ config('app.name') }} Team
@endcomponent
