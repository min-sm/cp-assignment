<div class="container p-4 mx-auto">
    <!-- Add a loading indicator for better UX -->
    <div wire:loading.delay.longest
        class="fixed top-0 bottom-0 left-0 right-0 z-50 flex flex-col items-center justify-center w-full h-screen overflow-hidden bg-gray-700 opacity-75">
        <div class="w-12 h-12 mb-4 ease-linear border-4 border-t-4 border-gray-200 rounded-full loader"></div>
        <h2 class="text-xl font-semibold text-center text-white">Loading...</h2>
    </div>

    <h1 class="mb-6 text-3xl font-bold">Our Products</h1>

    <!-- Filter Section -->
    <div class="flex mb-6 space-x-4">
        <!-- Brands Dropdown -->
        <x-store.filter-dropdown title="Brands" :items="$availableBrands" wireModel="brands" />

        <!-- Categories Dropdown -->
        <x-store.filter-dropdown title="Categories" :items="$availableCategories" wireModel="categories" />
    </div>

    <!-- Product Grid -->
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
        @forelse ($products as $product)
            <div class="p-4 border rounded-lg shadow-sm">
                <h2 class="text-lg font-bold">{{ $product->name }}</h2>
                <p class="text-sm text-gray-500">{{ $product->brand->name }}</p>
                <p class="inline-block px-2 py-1 mt-2 text-sm text-gray-700 bg-gray-200 rounded-full">
                    {{ $product->category->name }}</p>
                <p class="mt-4 text-xl font-semibold">${{ $product->price }}</p>
            </div>
        @empty
            <div class="text-center text-gray-500 col-span-full">
                <p>No products match your current selection.</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-8">
        {{ $products->links() }}
    </div>
</div>
