{{-- resources/views/events/edit.blade.php --}}
<x-layouts.app>
  <div class="max-w-4xl mx-auto py-12 px-6">
    <h1 class="text-2xl font-bold mb-6">Edit Event</h1>

    @if ($errors->any())
      <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
        <strong>Whoops!</strong> Please fix the following issues:
        <ul class="mt-2 list-disc list-inside">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form method="POST" action="{{ route('events.update', $event) }}" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      {{-- Venue Name --}}
      <div class="mb-4">
        <label class="block font-semibold mb-1">Venue Name</label>
        <input type="text" name="venue_name"
               value="{{ old('venue_name', $event->venue_name) }}"
               class="w-full border rounded px-3 py-2">
      </div>

      {{-- Postcode Lookup --}}
      <div class="mb-4">
        <label class="block font-semibold mb-1">Postcode (optional)</label>
        <div class="flex gap-2">
          <input type="text" id="postcode" name="postcode"
                 value="{{ old('postcode', $event->postcode) }}"
                 class="flex-1 border rounded px-3 py-2">
          <button type="button" onclick="lookupAddress()"
                  class="px-4 py-2 bg-blue-600 text-white rounded">
            Lookup
          </button>
        </div>
      </div>

      {{-- Address Suggestions --}}
      <div class="mb-4" id="address-suggestions" style="display:none">
        <label class="block font-semibold mb-1">Select Address</label>
        <select name="location_address" id="address"
                class="w-full border rounded px-3 py-2">
          <option value="{{ $event->location_address }}">{{ $event->location_address }}</option>
        </select>
      </div>

      {{-- Map Picker --}}
      <div class="mb-4">
        <label class="block font-semibold mb-1">Pin Location on Map</label>
        <div id="map" class="w-full mb-4 rounded border" style="height: 400px;"></div>
        <input type="hidden" name="latitude" id="latitude" value="{{ old('latitude', $event->latitude ?? 51.505) }}">
        <input type="hidden" name="longitude" id="longitude" value="{{ old('longitude', $event->longitude ?? -0.09) }}">
      </div>

      {{-- Landmark --}}
      <div class="mb-4">
        <label class="block font-semibold mb-1">Landmark / Nearby Description</label>
        <textarea name="landmark_description"
                  class="w-full border rounded px-3 py-2"
                  rows="3">{{ old('landmark_description', $event->landmark_description) }}</textarea>
      </div>

      {{-- Submit --}}
      <button type="submit"
              class="mt-6 inline-block bg-yellow-300 text-black px-4 py-2 rounded font-semibold border border-black">
        Update Event
      </button>
    </form>
  </div>

  @push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

    <script>
      document.addEventListener('DOMContentLoaded', () => {
        const latInput = document.getElementById('latitude');
        const lngInput = document.getElementById('longitude');
        const initLat = parseFloat(latInput.value);
        const initLng = parseFloat(lngInput.value);

        const map = L.map('map').setView([initLat, initLng], 13);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
          attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        const marker = L.marker([initLat, initLng], { draggable: true }).addTo(map);
        marker.on('dragend', () => {
          const { lat, lng } = marker.getLatLng();
          latInput.value = lat;
          lngInput.value = lng;
        });

        L.Control.geocoder({ defaultMarkGeocode: false })
          .on('markgeocode', e => {
            const c = e.geocode.center;
            marker.setLatLng(c);
            map.setView(c, 15);
            latInput.value = c.lat;
            lngInput.value = c.lng;
          })
          .addTo(map);
      });

      function lookupAddress() {
        const pc = document.getElementById('postcode').value.trim();
        if (!pc) return alert('Please enter a postcode');
        fetch(`https://nominatim.openstreetmap.org/search?postalcode=${encodeURIComponent(pc)}&format=json&addressdetails=1`)
          .then(r => r.json())
          .then(data => {
            const sel = document.getElementById('address');
            sel.innerHTML = '';
            if (!data.length) return alert('No addresses found');
            data.forEach(loc => sel.add(new Option(loc.display_name, loc.display_name)));
            document.getElementById('address-suggestions').style.display = 'block';
          })
          .catch(() => alert('Lookup failed'));
      }
    </script>
  @endpush
</x-layouts.app>
