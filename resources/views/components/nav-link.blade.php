@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-blue-400 dark:border-blue-500 text-sm font-medium leading-5 text-white dark:text-white focus:outline-none focus:border-blue-500 transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-white/80 dark:text-gray-300 hover:text-white dark:hover:text-white hover:border-white/30 dark:hover:border-gray-500 focus:outline-none focus:text-white dark:focus:text-white focus:border-white/30 dark:focus:border-gray-500 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
