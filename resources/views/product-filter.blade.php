<div class="container p-4 mx-auto">
    <!-- Add a loading indicator for better UX -->
    <div wire:loading.delay.longest class="fixed top-0 bottom-0 left-0 right-0 z-50 flex flex-col items-center justify-center w-full h-screen overflow-hidden bg-gray-700 opacity-75">
        <div class="w-12 h-12 mb-4 ease-linear border-4 border-t-4 border-gray-200 rounded-full loader"></div>
        <h2 class="text-xl font-semibold text-center text-white">Loading...</h2>
    </div>

    <h1 class="mb-6 text-3xl font-bold">Our Products</h1>

    <!-- Filter Section -->
    <div class="flex mb-6 space-x-4">
        <!-- Brands Dropdown -->
        <div x-data="{ open: false }" class="relative">
            <button @click="open = !open" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Brands <span class="ml-2">▾</span>
            </button>
            <div x-show="open" @click.away="open = false"
                 class="absolute z-10 w-56 p-4 mt-2 bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5"
                 style="display: none;">
                <h3 class="mb-2 text-sm font-semibold text-gray-900">Filter by Brand</h3>
                <div class="space-y-2">
                    @foreach ($availableBrands as $brand)
                        <div class="flex items-center">
                            <input wire:model.live="brands" type="checkbox" value="{{ $brand->id }}" id="brand_{{ $loop->index }}"
                                   class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                            <label for="brand_{{ $loop->index }}" class="ml-3 text-sm text-gray-600">{{ $brand->name }}</label>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Categories Dropdown -->
        <div x-data="{ open: false }" class="relative">
            <button @click="open = !open" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Categories <span class="ml-2">▾</span>
            </button>
            <div x-show="open" @click.away="open = false"
                 class="absolute z-10 w-56 p-4 mt-2 bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5"
                 style="display: none;">
                <h3 class="mb-2 text-sm font-semibold text-gray-900">Filter by Category</h3>
                <div class="space-y-2">
                    @foreach ($availableCategories as $category)
                        <div class="flex items-center">
                            <input wire:model.live="categories" type="checkbox" value="{{ $category->id }}" id="cat_{{ $loop->index }}"
                                   class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                            <label for="cat_{{ $loop->index }}" class="ml-3 text-sm text-gray-600">{{ $category->name }}</label>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Product Grid -->
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
        @forelse ($products as $product)
            <div class="p-4 border rounded-lg shadow-sm">
                <h2 class="text-lg font-bold">{{ $product->name }}</h2>
                <p class="text-sm text-gray-500">{{ $product->brand->name }}</p>
                <p class="inline-block px-2 py-1 mt-2 text-sm text-gray-700 bg-gray-200 rounded-full">{{ $product->category->name }}</p>
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
