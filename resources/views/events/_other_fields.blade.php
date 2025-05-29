{{-- Website, Pricing, Visibility, Invitees, Age, Accessibility, Tags, Image --}}
<div class="mb-4">
  <label class="block font-semibold mb-1">Event Website</label>
  <input type="url" name="website_url"
         value="{{ old('website_url', optional($event)->website_url) }}"
         class="w-full border rounded px-3 py-2">
</div>

<div class="mb-4">
  <label class="inline-flex items-center space-x-2">
    <input type="checkbox" name="is_free" value="1"
      {{ old('is_free', optional($event)->is_free)?'checked':'' }}>
    <span>Free event?</span>
  </label>
</div>

<div class="mb-4">
  <label class="block font-semibold mb-1">Price (£)</label>
  <input type="number" step="0.01" name="price"
         value="{{ old('price', optional($event)->price) }}"
         class="w-full border rounded px-3 py-2">
</div>

<div class="mb-4">
  <label class="block font-semibold mb-1">Event Visibility *</label>
  <select name="visibility" class="w-full border rounded px-3 py-2" required>
    <option value="public" {{ old('visibility', optional($event)->visibility)=='public'?'selected':'' }}>Public</option>
    <option value="private"{{ old('visibility', optional($event)->visibility)=='private'?'selected':'' }}>Private</option>
  </select>
</div>

<div class="mb-4">
  <label class="block font-semibold mb-1">Invitees (comma-separated emails)</label>
  <textarea name="invitees" rows="3"
            class="w-full border rounded px-3 py-2">{{ old('invitees', optional($event)->invitees) }}</textarea>
</div>

<div class="mb-4">
  <label class="inline-flex items-center space-x-2">
    <input type="checkbox" name="age_restricted" value="1"
      {{ old('age_restricted', optional($event)->age_restricted)?'checked':'' }}>
    <span>Age restricted?</span>
  </label>
</div>

<div class="mb-4">
  <label class="block font-semibold mb-1">Accessibility Information</label>
  <textarea name="accessibility_info" rows="2"
            class="w-full border rounded px-3 py-2">{{ old('accessibility_info', optional($event)->accessibility_info) }}</textarea>
</div>

<div class="mb-4">
  <label class="block font-semibold mb-1">Tags (comma-separated)</label>
  <input type="text" name="tags"
         value="{{ old('tags', optional($event)->tags) }}"
         class="w-full border rounded px-3 py-2">
</div>

<div class="mb-4">
  <label class="block font-semibold mb-1">Event Image (optional)</label>
  <input type="file" name="image" class="w-full border rounded px-3 py-2">
</div>
