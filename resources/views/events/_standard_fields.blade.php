{{-- Name, Description, Type, Dates, Recurrence, Appearance/Takedown --}}
<div class="mb-4">
  <label class="block font-semibold mb-1">Event Name *</label>
  <input type="text" name="name"
         value="{{ old('name', optional($event)->name) }}"
         class="w-full border rounded px-3 py-2" required>
</div>

<div class="mb-4">
  <label class="block font-semibold mb-1">Description</label>
  <textarea name="description"
            class="w-full border rounded px-3 py-2"
            rows="4">{{ old('description', optional($event)->description) }}</textarea>
</div>

<div class="mb-4">
  <label class="block font-semibold mb-1">Event Type *</label>
  <select name="event_type_id" id="event_type_id"
          class="w-full border rounded px-3 py-2" required>
    <option value="">Select a type…</option>
    @foreach($eventTypes as $type)
      <option value="{{ $type->id }}"
        {{ old('event_type_id', optional($event)->event_type_id)==$type->id ? 'selected' : '' }}>
        {{ $eventType->name }}
      </option>
    @endforeach
  </select>
</div>

<div class="mb-4">
  <label class="block font-semibold mb-1">Event Sub-Type</label>
  <select name="event_sub_type_id" id="event_sub_type_id"
          class="w-full border rounded px-3 py-2"
          {{ old('event_type_id', optional($event)->event_type_id) ? '' : 'disabled' }}>
    <option value="">Select a type first</option>
    @if(optional($event)->eventType)
      @foreach($event->eventType->subTypes as $sub)
        <option value="{{ $sub->id }}"
          {{ old('event_sub_type_id', optional($event)->event_sub_type_id)==$sub->id ? 'selected' : '' }}>
          {{ $sub->name }}
        </option>
      @endforeach
    @endif
  </select>
</div>

<div class="mb-4">
  <label class="block font-semibold mb-1">Start Date &amp; Time *</label>
  <input type="datetime-local" name="start_datetime"
         value="{{ old('start_datetime', optional($event)->start_datetime?->format('Y-m-d\TH:i')) }}"
         class="w-full border rounded px-3 py-2" required>
</div>

<div class="mb-4">
  <label class="block font-semibold mb-1">End Date &amp; Time *</label>
  <input type="datetime-local" name="end_datetime"
         value="{{ old('end_datetime', optional($event)->end_datetime?->format('Y-m-d\TH:i')) }}"
         class="w-full border rounded px-3 py-2" required>
</div>

<div class="mb-4">
  <label class="block font-semibold mb-1">Recurring?</label>
  <select name="recurrence_rule"
          class="w-full border rounded px-3 py-2">
    <option value="" {{ old('recurrence_rule', optional($event)->recurrence_rule)=='' ? 'selected' : '' }}>None</option>
    <option value="FREQ=DAILY;INTERVAL=1" {{ old('recurrence_rule', optional($event)->recurrence_rule)=='FREQ=DAILY;INTERVAL=1' ? 'selected' : '' }}>Daily</option>
    <option value="FREQ=WEEKLY;INTERVAL=1" {{ old('recurrence_rule', optional($event)->recurrence_rule)=='FREQ=WEEKLY;INTERVAL=1' ? 'selected' : '' }}>Weekly</option>
    <option value="FREQ=MONTHLY;INTERVAL=1" {{ old('recurrence_rule', optional($event)->recurrence_rule)=='FREQ=MONTHLY;INTERVAL=1' ? 'selected' : '' }}>Monthly</option>
  </select>
  <small class="text-xs text-gray-600">Choose “None” for a single event.</small>
</div>

<div class="mb-4">
  <label class="block font-semibold mb-1">Appearance Date &amp; Time</label>
  <input type="datetime-local" name="appearance_datetime"
         value="{{ old('appearance_datetime', optional($event)->appearance_datetime?->format('Y-m-d\TH:i')) }}"
         class="w-full border rounded px-3 py-2">
</div>

<div class="mb-4">
  <label class="block font-semibold mb-1">Take Down Date &amp; Time</label>
  <input type="datetime-local" name="takedown_datetime"
         value="{{ old('takedown_datetime', optional($event)->takedown_datetime?->format('Y-m-d\TH:i')) }}"
         class="w-full border rounded px-3 py-2">
</div>
