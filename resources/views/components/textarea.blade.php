@props(['disabled' => false])

<textarea {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'rounded-md shadow-sm border-gray-300 dark:border-gray-600 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-20 dark:bg-neutral-dark-bg dark:text-text-dark transition-colors duration-fast']) !!}></textarea>
