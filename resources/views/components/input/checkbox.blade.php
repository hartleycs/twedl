@props(['name', 'label' => ucfirst($name)])

<div class="mb-4">
    <label class="inline-flex items-center">
        <input type="checkbox" name="{{ $name }}" id="{{ $name }}" value="1"
               {{ $attributes->merge(['class' => 'rounded border-gray-300']) }}
               {{ old($name) ? 'checked' : '' }}>
        <span class="ml-2">{{ $label }}</span>
    </label>
    @error($name)
        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>
