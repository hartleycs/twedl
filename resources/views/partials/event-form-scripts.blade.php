<script>
document.addEventListener('DOMContentLoaded', () => {
  //
  // Event Type → Sub-Type
  //
  const typeSel = document.getElementById('event_type_id'),
        subSel  = document.getElementById('event_sub_type_id');

  if (typeSel) {
    typeSel.addEventListener('change', async () => {
      const typeId = typeSel.value;
      subSel.innerHTML = '<option value="">Loading…</option>';
      subSel.disabled = true;

      if (!typeId) {
        subSel.innerHTML = '<option value="">Select type first</option>';
        return;
      }

      const res = await fetch(`/api/event-types/${typeId}/sub-types`);
      const items = await res.json();

      subSel.innerHTML = '<option value="">Select sub-type…</option>';
      items.forEach(({ id, name }) => {
        const opt = document.createElement('option');
        opt.value = id;
        opt.textContent = name;
        subSel.appendChild(opt);
      });
      subSel.disabled = false;
    });
  }

  //
  // Country → State → Postcode
  //
  const countrySel  = document.getElementById('country_select'),
        stateSel    = document.getElementById('state_select'),
        postcodeSel = document.getElementById('postcode_select');

  const reset = (el, txt) => {
    el.innerHTML = `<option value="">${txt}</option>`;
    el.disabled = true;
  };

  if (countrySel) {
    countrySel.addEventListener('change', async () => {
      const code = countrySel.value;
      reset(stateSel, 'Loading…');
      reset(postcodeSel, 'Select state first');
      try {
        const res = await fetch(`/api/countries/${code}/states`);
        const states = await res.json();
        stateSel.innerHTML = '<option value="">Select a state…</option>';
        states.forEach(s => {
          const opt = document.createElement('option');
          opt.value = s.code;
          opt.textContent = s.name;
          stateSel.appendChild(opt);
        });
        stateSel.disabled = false;
      } catch (e) {
        reset(stateSel, 'Error loading states');
      }
    });

    stateSel?.addEventListener('change', async () => {
      const code = stateSel.value;
      reset(postcodeSel, 'Loading…');
      try {
        const res = await fetch(`/api/states/${code}/postcodes`);
        const pcs = await res.json();
        postcodeSel.innerHTML = '<option value="">Select a postcode…</option>';
        pcs.forEach(p => {
          const opt = document.createElement('option');
          opt.value = p;
          opt.textContent = p;
          postcodeSel.appendChild(opt);
        });
        postcodeSel.disabled = false;
      } catch (e) {
        reset(postcodeSel, 'Error loading postcodes');
      }
    });
  }

  //
  // Leaflet Map Picker
  //
  const lat = parseFloat("{{ old('latitude', $event->latitude ?? '51.505') }}"),
        lng = parseFloat("{{ old('longitude', $event->longitude ?? '-0.09') }}");

  const map = L.map('map').setView([lat, lng], 13);
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap'
  }).addTo(map);

  const marker = L.marker([lat, lng], { draggable: true }).addTo(map);
  marker.on('dragend', () => {
    const { lat, lng } = marker.getLatLng();
    document.getElementById('latitude').value = lat;
    document.getElementById('longitude').value = lng;
  });
});
</script>
