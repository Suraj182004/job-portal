@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-blue-400 dark:border-blue-500 text-start text-base font-medium text-blue-700 dark:text-blue-300 bg-blue-50 dark:bg-blue-900/50 focus:outline-none focus:text-blue-800 dark:focus:text-blue-200 focus:bg-blue-100 dark:focus:bg-blue-900 focus:border-blue-700 dark:focus:border-blue-300 transition duration-150 ease-in-out'
            : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-white/90 dark:text-gray-300 hover:text-white dark:hover:text-white hover:bg-blue-700/20 dark:hover:bg-gray-700 hover:border-blue-300 dark:hover:border-gray-600 focus:outline-none focus:text-white dark:focus:text-white focus:bg-blue-700/30 dark:focus:bg-gray-700 focus:border-blue-400 dark:focus:border-blue-500 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
