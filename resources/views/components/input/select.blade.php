@props([
    'label' => '',
    'name',
    'required' => false,
    'options' => [],
    'value' => old($name),
])

<div class="mb-4">
    @if($label)
        <label for="{{ $name }}" class="block font-semibold mb-1">
            {{ $label }}{{ $required ? ' *' : '' }}
        </label>
    @endif
    <select
        name="{{ $name }}"
        id="{{ $name }}"
        @if($required) required @endif
        {{ $attributes->merge(['class' => 'w-full border rounded px-3 py-2 '.($errors->has($name) ? 'border-red-500' : '')]) }}
    >
        @foreach($options as $key => $label)
            <option value="{{ $key }}" {{ $value == $key ? 'selected' : '' }}>
                {{ $label }}
            </option>
        @endforeach
    </select>
    @error($name)
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>
