<!-- Act only according to that maxim whereby you can, at the same time, will that it should become a universal law. - Immanuel Kant -->

@props(['title', 'items', 'wireModel'])

<div x-data="{ open: false }" {{ $attributes->merge(['class' => 'relative']) }}>
    {{-- Button to open the dropdown --}}
    <button @click="open = !open"
        class="flex items-center justify-between w-full p-3 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        {{ $title }}
        <svg class="w-6 h-6 text-gray-800 dark:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
            width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m8 10 4 4 4-4" />
        </svg>
    </button>

    {{-- Dropdown Panel --}}
    <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-1"
        class="absolute z-10 w-56 p-4 mt-2 bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5"
        style="display: none;">

        <h3 class="mb-2 text-sm font-semibold text-gray-900">Filter by {{ $title }}</h3>

        <div class="space-y-2">
            @forelse ($items as $item)
                <div class="flex items-center">
                    <input wire:model.live="{{ $wireModel }}" type="checkbox" value="{{ $item->id }}"
                        id="{{ Str::slug($wireModel) }}_{{ $item->id }}"
                        class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">

                    <label for="{{ Str::slug($wireModel) }}_{{ $item->id }}" class="ml-3 text-sm text-gray-600">
                        {{ $item->name }}
                    </label>
                </div>
            @empty
                <p class="text-sm text-gray-500">No {{ Str::lower($title) }} available.</p>
            @endforelse
        </div>
    </div>
</div>
