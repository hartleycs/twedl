@props([
    'label' => '',
    'name',
    'type' => 'text',
    'required' => false,
    'value' => old($name),
    'placeholder' => '',
])

<div class="mb-4">
    @if($label)
        <label for="{{ $name }}" class="block font-semibold mb-1">
            {{ $label }}{{ $required ? ' *' : '' }}
        </label>
    @endif
    <input
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $name }}"
        value="{{ $value }}"
        placeholder="{{ $placeholder }}"
        @if($required) required @endif
        {{ $attributes->merge(['class' => 'w-full border rounded px-3 py-2 '.($errors->has($name) ? 'border-red-500' : '')]) }}
    >
    @error($name)
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>
