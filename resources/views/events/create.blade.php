{{-- resources/views/events/create.blade.php --}}
<x-layouts.app>
  <div class="max-w-4xl mx-auto py-12 px-6">
    <h1 class="text-2xl font-bold mb-6">Submit an Event</h1>

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

    <form method="POST" action="{{ route('events.store') }}" enctype="multipart/form-data">
      @csrf

      {{-- Basic Info --}}
      <div class="mb-4">
        <label class="block font-semibold mb-1">Event Name</label>
        <input type="text" name="name" value="{{ old('name') }}" class="w-full border rounded px-3 py-2" required>
      </div>

      <div class="mb-4">
        <label class="block font-semibold mb-1">Description</label>
        <textarea name="description" rows="4" class="w-full border rounded px-3 py-2">{{ old('description') }}</textarea>
      </div>

      <div class="mb-4">
        <label class="block font-semibold mb-1">Event Type</label>
        <select name="event_type_id" id="event_type_id" class="w-full border rounded px-3 py-2">
          <option value="">Select a type…</option>
          @foreach($eventTypes as $eventType)
            <option value="{{ $eventType->id }}" {{ old('event_type_id') == $eventType->id ? 'selected' : '' }}>{{ $eventType->name }}</option>
          @endforeach
        </select>
      </div>

      <div class="mb-4">
        <label class="block font-semibold mb-1">Event Sub-Type</label>
        <select name="event_sub_type_id" id="event_sub_type_id" class="w-full border rounded px-3 py-2" disabled>
          <option value="">Select a type first</option>
        </select>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
        <div>
          <label class="block font-semibold mb-1">Start Date & Time</label>
          <input type="datetime-local" name="start_datetime" value="{{ old('start_datetime') }}" class="w-full border rounded px-3 py-2" required>
        </div>
        <div>
          <label class="block font-semibold mb-1">End Date & Time</label>
          <input type="datetime-local" name="end_datetime" value="{{ old('end_datetime') }}" class="w-full border rounded px-3 py-2" required>
        </div>
      </div>

      {{-- Recurrence --}}
      <div class="mb-4">
        <label class="block font-semibold mb-1">Recurring?</label>
        <select name="recurrence_rule" class="w-full border rounded px-3 py-2">
          <option value="">None</option>
          <option value="FREQ=DAILY;INTERVAL=1" {{ old('recurrence_rule') == 'FREQ=DAILY;INTERVAL=1' ? 'selected' : '' }}>Daily</option>
          <option value="FREQ=WEEKLY;INTERVAL=1" {{ old('recurrence_rule') == 'FREQ=WEEKLY;INTERVAL=1' ? 'selected' : '' }}>Weekly</option>
          <option value="FREQ=MONTHLY;INTERVAL=1" {{ old('recurrence_rule') == 'FREQ=MONTHLY;INTERVAL=1' ? 'selected' : '' }}>Monthly</option>
        </select>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
        <div>
          <label class="block font-semibold mb-1">Appear At</label>
          <input type="datetime-local" name="appearance_datetime" value="{{ old('appearance_datetime') }}" class="w-full border rounded px-3 py-2">
        </div>
        <div>
          <label class="block font-semibold mb-1">Take Down At</label>
          <input type="datetime-local" name="takedown_datetime" value="{{ old('takedown_datetime') }}" class="w-full border rounded px-3 py-2">
        </div>
      </div>

      {{-- Address --}}
      <div class="mb-4">
        <label class="block font-semibold mb-1">Venue Name</label>
        <input type="text" name="venue_name" value="{{ old('venue_name') }}" class="w-full border rounded px-3 py-2">
      </div>

      <div class="mb-4">
        <label class="block font-semibold mb-1">Address Line 1</label>
        <input type="text" name="address_line_1" value="{{ old('address_line_1') }}" class="w-full border rounded px-3 py-2" required>
      </div>

      <div class="mb-4">
        <label class="block font-semibold mb-1">Address Line 2</label>
        <input type="text" name="address_line_2" value="{{ old('address_line_2') }}" class="w-full border rounded px-3 py-2">
      </div>

      <div class="mb-4">
        <label class="block font-semibold mb-1">Town</label>
        <input type="text" name="town" value="{{ old('town') }}" class="w-full border rounded px-3 py-2">
      </div>

      <div class="mb-4">
        <label class="block font-semibold mb-1">City</label>
        <input type="text" name="city" value="{{ old('city') }}" class="w-full border rounded px-3 py-2">
      </div>

      <div class="mb-4">
        <label class="block font-semibold mb-1">State/Province</label>
        <input type="text" name="state" value="{{ old('state') }}" class="w-full border rounded px-3 py-2">
      </div>

      <div class="mb-4">
        <label class="block font-semibold mb-1">Post/Zip Code</label>
        <input type="text" name="postcode" value="{{ old('postcode') }}" class="w-full border rounded px-3 py-2">
      </div>

      <div class="mb-4">
        <label class="block font-semibold mb-1">Country</label>
        <select name="country" class="w-full border rounded px-3 py-2" required>
          <option value="">Select a country…</option>
          @foreach ($countries as $country)
            <option value="{{ $country->code }}" {{ old('country') == $country->code ? 'selected' : '' }}>{{ $country->name }}</option>
          @endforeach
        </select>
      </div>

      <div class="mb-4">
        <label class="block font-semibold mb-1">Landmark / Description</label>
        <textarea name="landmark_description" rows="3" class="w-full border rounded px-3 py-2">{{ old('landmark_description') }}</textarea>
      </div>

      {{-- Map --}}
      <div class="mb-4">
        <label class="block font-semibold mb-1">Pin Location on Map</label>
        <div id="map" class="w-full mb-4 rounded border" style="height: 400px;"></div>
        <input type="hidden" name="latitude" id="latitude" value="{{ old('latitude') }}">
        <input type="hidden" name="longitude" id="longitude" value="{{ old('longitude') }}">
      </div>

      {{-- Pricing --}}
      <div class="mb-4">
        <label class="inline-flex items-center">
          <input type="checkbox" name="is_free" id="is_free" value="1" {{ old('is_free') ? 'checked' : '' }}>
          <span class="ml-2">Free event?</span>
        </label>
      </div>

      <div id="pricing-wrapper">
        <label class="block font-semibold mb-2">Ticket Prices</label>
        <div id="pricing-rows" class="space-y-2">
          <div class="flex gap-2">
            <input type="text" name="ticket_labels[]" placeholder="e.g. General Admission"
                  class="flex-1 border rounded px-3 py-2" />
            <input type="number" name="ticket_prices[]" step="0.01" placeholder="e.g. 10.00"
                  class="w-32 border rounded px-3 py-2" />
            <button type="button" onclick="removePricingRow(this)"
                    class="text-red-600 font-semibold">&times;</button>
          </div>
        </div>
        <button type="button" onclick="addPricingRow()"
                class="mt-6 inline-block bg-yellow-300 text-black px-4 py-2 rounded font-semibold border border-black">
          + Add another price
        </button>

        <div class="mt-4">
          <label class="block font-semibold mb-1">Currency</label>
          <select name="currency" id="currency" class="w-full border rounded px-3 py-2">
            <option value="">Select currency…</option>
          </select>
        </div>
      </div>

      {{-- Other --}}
      <div class="mb-4">
        <label class="block font-semibold mb-1">Event Website</label>
        <input type="url" name="website_url" value="{{ old('website_url') }}" class="w-full border rounded px-3 py-2">
      </div>

      <div class="mb-4">
        <label class="block font-semibold mb-1">Visibility</label>
        <select name="visibility" class="w-full border rounded px-3 py-2">
          <option value="public" {{ old('visibility') == 'public' ? 'selected' : '' }}>Public</option>
          <option value="private" {{ old('visibility') == 'private' ? 'selected' : '' }}>Private</option>
        </select>
      </div>

      <div class="mb-4">
        <label class="block font-semibold mb-1">Audience Type</label>
        <select name="audience_type" class="w-full border rounded px-3 py-2">
          <option value="">Select...</option>
          @foreach(['Adults', 'Families', 'Kids', 'Students', 'Professionals', 'All Ages'] as $eventType)
            <option value="{{ $eventType }}" {{ old('audience_type') == $eventType ? 'selected' : '' }}>{{ $eventType }}</option>
          @endforeach
        </select>
      </div>

      <div class="mb-4" id="invitees-wrapper" style="display: {{ old('visibility') === 'private' ? 'block' : 'none' }}">
        <label class="block font-semibold mb-1">Invitees (comma-separated emails)</label>
        <textarea name="invitees"
            class="w-full border rounded px-3 py-2"
            rows="3">{{ old('invitees') }}</textarea>
      </div>

      <div class="mb-4">
        <label for="tags" class="block font-semibold mb-1">Tags / Categories</label>
        <small class="text-sm text-gray-500">
          You may select from approved tags or type your own. New tags require admin approval.
        </small>
        <select name="tags[]" id="tags" multiple class="w-full border rounded px-3 py-2">
          @foreach ($availableTags as $tag)
            <option value="{{ $tag->name }}"
              {{ isset($event) && $event->tags->contains('name', $tag->name) ? 'selected' : '' }}>
              {{ $tag->name }}
            </option>
          @endforeach
        </select>
      </div>

      <div class="mb-4">
        <label class="block font-semibold mb-1">Max Attendees</label>
        <input type="number" name="max_attendees" value="{{ old('max_attendees') }}" class="w-full border rounded px-3 py-2" min="1">
      </div>

      <div class="mb-4">
        <label class="block font-semibold mb-1">RSVP / Booking URL</label>
        <input type="url" name="booking_url" value="{{ old('booking_url') }}" class="w-full border rounded px-3 py-2">
      </div>

      <div class="mb-4">
        <label class="block font-semibold mb-1">Event Language</label>
        <select name="language" class="w-full border rounded px-3 py-2">
          <option value="">Select language…</option>
          @foreach(['English', 'French', 'Spanish', 'German', 'Arabic', 'Mandarin', 'Hindi', 'Other'] as $lang)
            <option value="{{ $lang }}" {{ old('language') == $lang ? 'selected' : '' }}>{{ $lang }}</option>
          @endforeach
        </select>
      </div>

      <div class="mb-4">
        <label class="block font-semibold mb-1">Event Image</label>
        <input type="file" name="image" class="w-full border rounded px-3 py-2">
      </div>

      <button type="submit" class="mt-6 bg-yellow-300 text-black px-4 py-2 rounded font-semibold border border-black">
        Submit Event
      </button>
    </form>
  </div>

  @push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

    <!-- jQuery (required for Select2) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
    <script>
      const countryToCurrency = {
        US: 'USD', GB: 'GBP', IE: 'EUR', FR: 'EUR', DE: 'EUR', IT: 'EUR',
        ES: 'EUR', NL: 'EUR', BE: 'EUR', AU: 'AUD', CA: 'CAD', NZ: 'NZD',
        IN: 'INR', JP: 'JPY', CN: 'CNY', ZA: 'ZAR', NG: 'NGN', KE: 'KES', BR: 'BRL'
      };

      const currencyNames = {
        USD: 'US Dollar', GBP: 'British Pound', EUR: 'Euro', AUD: 'Australian Dollar',
        CAD: 'Canadian Dollar', NZD: 'New Zealand Dollar', INR: 'Indian Rupee',
        JPY: 'Japanese Yen', CNY: 'Chinese Yuan', ZAR: 'South African Rand',
        NGN: 'Nigerian Naira', KES: 'Kenyan Shilling', BRL: 'Brazilian Real'
      };

      document.addEventListener('DOMContentLoaded', () => {
        const latInput = document.getElementById('latitude');
        const lngInput = document.getElementById('longitude');
        const countrySelect = document.querySelector('select[name="country"]');
        const currencySelect = document.getElementById('currency');
        const hasLatLng = latInput.value && lngInput.value;

        if (!hasLatLng) {
          ['address_line_1', 'address_line_2', 'town', 'city', 'state', 'postcode', 'country', 'venue_name'].forEach(name => {
            const el = document.querySelector(`[name="${name}"]`);
            if (el) el.value = '';
          });
        }

        const initLat = hasLatLng ? parseFloat(latInput.value) : 51.505;
        const initLng = hasLatLng ? parseFloat(lngInput.value) : -0.09;

        const map = L.map('map').setView([initLat, initLng], 13);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
          attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        let marker = L.marker([initLat, initLng], { draggable: true }).addTo(map);

        function setMarker(lat, lng) {
          marker.setLatLng([lat, lng]);
          latInput.value = lat;
          lngInput.value = lng;
          reverseGeocode(lat, lng);
        }

        function reverseGeocode(lat, lng) {
          fetch(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lng}`)
            .then(res => res.json())
            .then(data => {
              const addr = data.address || {};
              document.querySelector('[name="venue_name"]').value = addr.display_name || '';
              document.querySelector('[name="address_line_1"]').value = addr.road || addr.pedestrian || '';
              document.querySelector('[name="city"]').value = addr.city || addr.town || addr.village || '';
              document.querySelector('[name="state"]').value = addr.state || '';
              document.querySelector('[name="postcode"]').value = addr.postcode || '';
              document.querySelector('[name="country"]').value = addr.country_code ? addr.country_code.toUpperCase() : '';
              selectDefaultCurrency(addr.country_code ? addr.country_code.toUpperCase() : '');
            });
        }

        marker.on('dragend', () => {
          const pos = marker.getLatLng();
          setMarker(pos.lat, pos.lng);
        });

        map.on('click', e => {
          setMarker(e.latlng.lat, e.latlng.lng);
        });

        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(pos => {
            const lat = pos.coords.latitude;
            const lng = pos.coords.longitude;
            map.setView([lat, lng], 13);
            setMarker(lat, lng);
          });
        }

        L.Control.geocoder().addTo(map);

        // Populate all currency options
        for (const [code, name] of Object.entries(currencyNames)) {
          const option = document.createElement('option');
          option.value = code;
          option.textContent = `${code} – ${name}`;
          currencySelect.appendChild(option);
        }

        function selectDefaultCurrency(countryCode) {
          const currency = countryToCurrency[countryCode];
          if (currency) currencySelect.value = currency;
        }

        if (countrySelect) {
          countrySelect.addEventListener('change', () => {
            selectDefaultCurrency(countrySelect.value);
          });

          if (countrySelect.value) {
            selectDefaultCurrency(countrySelect.value);
          }
        }

        // Event Type → Sub-Type
        const typeSel = document.getElementById('event_type_id');
        const subSel = document.getElementById('event_sub_type_id');
        if (typeSel && subSel) {
          typeSel.addEventListener('change', async () => {
            const id = typeSel.value;
            if (!id) return subSel.innerHTML = '<option>Select a type first</option>';
            subSel.disabled = true;
            subSel.innerHTML = '<option>Loading…</option>';
            try {
              const res = await fetch(`/api/event-types/${id}/sub-types`);
              const json = await res.json();
              subSel.innerHTML = '<option value="">Select sub-type…</option>';
              json.forEach(opt => {
                const el = document.createElement('option');
                el.value = opt.id;
                el.textContent = opt.name;
                subSel.appendChild(el);
              });
              subSel.disabled = false;
            } catch {
              subSel.innerHTML = '<option>Error loading</option>';
            }
          });
        }

        const visibilitySel = document.querySelector('select[name="visibility"]');
        const inviteesWrapper = document.getElementById('invitees-wrapper');
        if (visibilitySel && inviteesWrapper) {
          visibilitySel.addEventListener('change', () => {
            inviteesWrapper.style.display = visibilitySel.value === 'private' ? 'block' : 'none';
          });
        }

        document.getElementById('is_free').addEventListener('change', togglePricingVisibility);
        togglePricingVisibility();
      });

      function removePricingRow(btn) {
        btn.closest('div').remove();
      }

      function addPricingRow() {
        const container = document.getElementById('pricing-rows');
        const freeEventCheckbox = document.getElementById('is_free');
        if (freeEventCheckbox) {
          freeEventCheckbox.checked = false;
          togglePricingVisibility();
        }

        const row = document.createElement('div');
        row.className = 'flex gap-2';
        row.innerHTML = `
          <input type="text" name="ticket_labels[]" placeholder="e.g. Group"
                class="flex-1 border rounded px-3 py-2" />
          <input type="number" name="ticket_prices[]" step="0.01" placeholder="e.g. 7.50"
                class="w-32 border rounded px-3 py-2" />
          <button type="button" onclick="removePricingRow(this)"
                class="text-red-600 font-semibold">&times;</button>
        `;
        container.appendChild(row);
      }

      function togglePricingVisibility() {
        const wrapper = document.getElementById('pricing-wrapper');
        const isFree = document.getElementById('is_free').checked;
        if (wrapper) wrapper.style.display = isFree ? 'none' : 'block';
      }

      const rejectedTags = @json(\App\Models\Tag::where('status', 'rejected')->pluck('name'));

      $('#tags').select2({
          tags: true,
          placeholder: "Select or add tags",
          width: '100%',
          tokenSeparators: [','],
      }).on('select2:select', function (e) {
          const tag = e.params.data.text.trim();
          if (rejectedTags.includes(tag)) {
              alert(`The tag "${tag}" was previously rejected and cannot be used.`);
              const selected = $(this).val().filter(t => t !== tag);
              $(this).val(selected).trigger('change');
          }
      });
    </script>
  @endpush
</x-layouts.app>
