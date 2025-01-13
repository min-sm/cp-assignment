@props(['products'])

<div class="max-w-screen-xl mx-auto p-4">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach ($products as $product)
            {{-- <x-products.card :product="$product" /> --}}
            @livewire('products-index', ['product' => $product])
        @endforeach
    </div>

    <div class="flex justify-center items-center">
        {{ $slot }}
    </div>
</div>
