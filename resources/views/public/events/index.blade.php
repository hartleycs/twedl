{{-- resources/views/public/events/index.blade.php --}}
<x-layouts.app>
  <div class="max-w-4xl mx-auto py-12 px-6">
    <h1 class="text-2xl font-bold mb-6">Discover Events</h1>

    <form method="GET" action="{{ route('public.events.index') }}"
          class="mb-8 grid grid-cols-1 md:grid-cols-2 gap-4">
      {{-- Event Type --}}
      <div>
        <label class="block font-semibold mb-1">Type</label>
        <select name="type" id="filter_type" class="w-full border rounded px-3 py-2">
          <option value="">All types</option>
          @foreach($eventTypes as $type)
            <option value="{{ $type->id }}"
              {{ request('type') == $type->id ? 'selected' : '' }}>
              {{ $type->name }}
            </option>
          @endforeach
        </select>
      </div>

      {{-- Event Sub-Type --}}
      <div>
        <label class="block font-semibold mb-1">Sub-Type</label>
        <select name="subtype" id="filter_subtype"
                class="w-full border rounded px-3 py-2" disabled>
          <option value="">All sub-types</option>
          @foreach($eventSubTypes as $sub)
            <option value="{{ $sub->id }}"
              {{ request('subtype') == $sub->id ? 'selected' : '' }}>
              {{ $sub->name }}
            </option>
          @endforeach
        </select>
      </div>

      {{-- Date From --}}
      <div>
        <label class="block font-semibold mb-1">From</label>
        <input type="date" name="from" value="{{ request('from') }}"
               class="w-full border rounded px-3 py-2">
      </div>

      {{-- Date To --}}
      <div>
        <label class="block font-semibold mb-1">To</label>
        <input type="date" name="to" value="{{ request('to') }}"
               class="w-full border rounded px-3 py-2">
      </div>

      {{-- Location + Radius --}}
      <div class="md:col-span-2">
        <label class="block font-semibold mb-1">Location Radius</label>
        <div class="flex gap-2 items-center">
          <button type="button" id="detect_location"
                  class="px-3 py-2 bg-blue-200 rounded hover:bg-blue-300">
            Use my location
          </button>
          <input type="number" name="radius" min="1" step="1"
                 value="{{ request('radius', 5) }}"
                 class="w-20 border rounded px-2 py-1">
          <span>km</span>
          <input type="hidden" name="lat" id="filter_lat"  value="{{ request('lat') }}">
          <input type="hidden" name="lng" id="filter_lng"  value="{{ request('lng') }}">
        </div>
      </div>

      {{-- Town or City --}}
      <div>
        <label for="city" class="block font-semibold mb-1">Town / City</label>
        <input type="text"
              name="city"
              id="city"
              value="{{ request('city') }}"
              class="w-full border rounded px-3 py-2"
              placeholder="e.g. Bridgetown, London, etc.">
      </div>

      {{-- Submit --}}
      <div class="md:col-span-2 text-right">
        <button type="submit"
                class="mt-6 inline-block bg-yellow-300 text-black px-4 py-2 rounded font-semibold border border-black">
          Search
        </button>
      </div>
    </form>

    {{-- Instructional Message --}}
    @if(isset($message))
      <div class="mb-6 p-4 bg-yellow-100 border border-yellow-300 text-yellow-800 rounded">
        {{ $message }}
      </div>
    @endif

    {{-- Only show events if a search was submitted --}}
    @if(request()->hasAny(['type', 'subtype', 'from', 'to', 'radius', 'lat', 'lng', 'city', 'audience_type']))
      @if($events->count())
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          @foreach($events as $e)
            <div class="p-4 border rounded shadow-sm">
              <h2 class="text-lg font-semibold">{{ $e->name }}</h2>
              <p class="text-sm text-gray-600">
                {{ $e->start_datetime->format('M j, Y g:ia') }}
                &ndash;
                {{ $e->end_datetime->format('M j, Y g:ia') }}
              </p>
              <p class="text-sm">
                {{ $e->eventType->name }}
                @if($e->eventSubType)
                  / {{ $e->eventSubType->name }}
                @endif
              </p>
              <p class="text-sm">{{ $e->location_address }}</p>
              @php $invite = $e->invites->first(); @endphp
              @if($invite)
                <a href="{{ route('invites.show', $invite->token) }}" class="text-blue-600 hover:underline">
                  View details →
                </a>
              @endif
            </div>
          @endforeach
        </div>

        <div class="mt-6">
          {{ $events->links() }}
        </div>
      @else
        <p class="text-center text-gray-600">No events found matching those criteria.</p>
      @endif
    @endif
  </div>

  @push('scripts')
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const typeSel = document.getElementById('filter_type');
      const subSel  = document.getElementById('filter_subtype');

      typeSel.addEventListener('change', async function() {
        const typeId = this.value;
        subSel.disabled = true;
        subSel.innerHTML = '<option>Loading…</option>';

        if (!typeId) {
          subSel.innerHTML = '<option value="">All sub-types</option>';
          return;
        }

        try {
          const resp = await fetch(`/api/event-types/${typeId}/sub-types`);
          const subs = await resp.json();

          subSel.innerHTML = '<option value="">All sub-types</option>';
          subs.forEach(s => {
            const opt = document.createElement('option');
            opt.value = s.id;
            opt.textContent = s.name;
            if (s.id == {{ request('subtype') ?? 'null' }}) {
              opt.selected = true;
            }
            subSel.append(opt);
          });
          subSel.disabled = false;
        } catch (err) {
          console.error(err);
          subSel.innerHTML = '<option value="">Error loading</option>';
        }
      });

      document.getElementById('detect_location')
        .addEventListener('click', () => {
          if (!navigator.geolocation) {
            return alert('Geolocation not supported');
          }
          navigator.geolocation.getCurrentPosition(pos => {
            document.getElementById('filter_lat').value = pos.coords.latitude;
            document.getElementById('filter_lng').value = pos.coords.longitude;
            alert('Location detected!');
          }, () => {
            alert('Failed to detect location');
          });
        });
    });
  </script>
  @endpush
</x-layouts.app>
