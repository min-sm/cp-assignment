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

        <div x-data="{ open: false }" class="relative">
            <button @click="open = !open"
                class="flex items-center justify-between w-full p-3 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                something
                <svg class="w-6 h-6 text-gray-800 dark:text-gray-500" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m8 10 4 4 4-4" />
                </svg>
            </button>

            {{-- Dropdown Panel --}}
            <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-1"
                class="absolute z-10 w-56 pt-4 mt-2 bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5"
                style="display: none;">

                <h3 class="mb-2 text-sm font-semibold text-gray-900 px-4">Sort by</h3>

                <ul>
                    <li wire:click="clickSortOption('price')"
                        class="flex items-center justify-between hover:bg-gray-200 rounded-b-md py-2 px-4 cursor-pointer">
                        <span class="text-sm text-gray-600">
                            Price
                        </span>

                        <span>
                            <div>
                                <svg class="w-4 h-4 {{ ($sorting['price'] ?? 'default') === 'asc' ? 'text-gray-800' : 'text-gray-400' }}"
                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m16 14-4-4-4 4" />
                                </svg>
                                <svg class="w-4 h-4 {{ ($sorting['price'] ?? 'default') === 'desc' ? 'text-gray-800' : 'text-gray-400' }}"
                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m8 10 4 4 4-4" />
                                </svg>
                            </div>
                        </span>
                    </li>
                    <li wire:click="clickSortOption('model')"
                        class="flex items-center justify-between hover:bg-gray-200 py-2 px-4 cursor-pointer">
                        <span class="text-sm text-gray-600">
                            Model
                        </span>

                        <span>
                            <div>
                                <svg class="w-4 h-4 {{ ($sorting['model'] ?? 'default') === 'asc' ? 'text-gray-800' : 'text-gray-400' }}"
                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m16 14-4-4-4 4" />
                                </svg>
                                <svg class="w-4 h-4 {{ ($sorting['model'] ?? 'default') === 'desc' ? 'text-gray-800' : 'text-gray-400' }}"
                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m8 10 4 4 4-4" />
                                </svg>
                            </div>
                        </span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Product Grid -->
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
        @forelse ($products as $product)
            <div class="p-4 border rounded-lg shadow-sm">
                <h2 class="text-lg font-bold">{{ $product->name }}</h2>
                <p class="text-sm text-gray-500">{{ $product->brand->name }}</p>
                <p class="inline-block px-2 py-1 mt-2 text-sm text-gray-700 bg-gray-200 rounded-full">
                    {{ $product->category->name }}</p>
                <p class="mt-4 text-xl font-semibold">${{ number_format($product->price, 2) }}</p>
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
