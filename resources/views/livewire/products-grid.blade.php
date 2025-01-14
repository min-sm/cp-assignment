<div class="max-w-screen-xl mx-auto p-4">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach ($products as $product)
            @livewire('product-card', ['product' => $product], key($product->id))
        @endforeach
    </div>

    <div class="flex justify-center items-center">
        {{ $products->links() }} <!-- Pagination links -->
    </div>
</div>
