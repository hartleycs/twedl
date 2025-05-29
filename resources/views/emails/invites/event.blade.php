@component('mail::message')
# You're Invited!

**{{ $event->name }}**  
{{ $event->start_datetime->format('d M Y, H:i') }}  

{{ $event->description }}

@component('mail::button', ['url' => $url])
View Event Details
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
