@php
    // Define classes based on the type
    $classes =
        [
            'success' =>
                'bg-green-50 border border-green-300 text-green-800 dark:bg-gray-800 dark:text-green-400 dark:border-green-800',
            'error' =>
                'bg-red-50 border border-red-300 text-red-800 dark:bg-gray-800 dark:text-red-400 dark:border-red-800',
            // Add more types as needed
        ][$type] ??
        'bg-gray-50 border border-gray-300 text-gray-800 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-800';
@endphp

<div class="{{ $classes }} p-4 rounded-lg text-sm font-medium mb-4">
    {{ $message }}
</div>
