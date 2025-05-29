@props(['name', 'label' => ucfirst($name)])

<div class="mb-4">
    <label for="{{ $name }}" class="block font-semibold mb-1">{{ $label }}</label>
    <input type="file" name="{{ $name }}" id="{{ $name }}"
           {{ $attributes->merge(['class' => 'w-full border rounded px-3 py-2']) }}>
    @error($name)
        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>
