@props([
    'href' => '#',
    'color' => 'blue', // Default color
    'class' => '',
])

@php
    $baseClasses =
        'inline-flex items-center px-2.5 py-1 sm:px-5 sm:py-2.5 mb-2 text-sm font-medium text-white rounded-lg focus:outline-none focus:ring-4 me-2 transition-colors duration-200 truncate';

    $colorStyles = [
        'blue' => 'bg-blue-700 hover:bg-blue-800 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800',
        'yellow' => 'bg-yellow-400 hover:bg-yellow-500 focus:ring-yellow-300 dark:focus:ring-yellow-900',
        'red' => 'bg-red-700 hover:bg-red-800 focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900',
    ];

    $buttonClasses = $baseClasses . ' ' . ($colorStyles[$color] ?? $colorStyles['blue']);
@endphp

<a href="{{ $href }}" {{ $attributes->merge(['class' => $buttonClasses . ' ' . $class]) }}
    @if ($attributes->has('wire:click')) x-data @endif>
    {{ $slot }}
</a>
