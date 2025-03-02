<div>
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Products
    </h2>
    @if (session('success'))
        <x-alert type="success" message="{{ session('success') }}" />
    @endif
    <div class="flex justify-end items-end mb-4 space-x-4">
        <x-button link="{{ route('admin.products.create') }}" label="Add new product" />
    </div>

    <!-- Search and Filters -->
    <div class="grid grid-cols-1 gap-4 md:grid-cols-4">
        <input type="text" wire:model.live.debounce.500ms="search" placeholder="Search products..."
            class="p-2 rounded-md border">

        <select wire:model.live="selectedCategory" class="p-2 rounded-md border">
            <option value="">All Categories</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>

        <select wire:model.live="selectedBrand" class="p-2 rounded-md border">
            <option value="">All Brands</option>
            @foreach ($brands as $brand)
                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
            @endforeach
        </select>

        <div class="flex gap-2">
            <select wire:model.live="sortField" class="flex-1 p-2 rounded-md border">
                <option value="name">Name</option>
                <option value="price">Price</option>
                <option value="created_at">Date Added</option>
            </select>
            <select wire:model.live="sortDirection" class="p-2 rounded-md border">
                <option value="asc">↑</option>
                <option value="desc">↓</option>
            </select>
        </div>
    </div>

    <div class="flex justify-end items-end my-4 space-x-4">
        <button wire:click="setViewMode('table')"
            class="px-2 py-2 rounded-md bg-blue-600 hover:bg-blue-800
                {{ $viewMode === 'table' ? 'opacity-100' : 'opacity-50' }}">
            <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-width="1.5"
                    d="M9 8h10M9 12h10M9 16h10M4.99 8H5m-.02 4h.01m0 4H5" />
            </svg>
        </button>

        <button wire:click="setViewMode('card')"
            class="px-2 py-2 rounded-md bg-green-600 hover:bg-green-800
                {{ $viewMode === 'card' ? 'opacity-100' : 'opacity-50' }}">
            <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                height="24" fill="currentColor" viewBox="0 0 24 24">
                <path fill-rule="evenodd"
                    d="M4.857 3A1.857 1.857 0 0 0 3 4.857v4.286C3 10.169 3.831 11 4.857 11h4.286A1.857 1.857 0 0 0 11 9.143V4.857A1.857 1.857 0 0 0 9.143 3H4.857Zm10 0A1.857 1.857 0 0 0 13 4.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 21 9.143V4.857A1.857 1.857 0 0 0 19.143 3h-4.286Zm-10 10A1.857 1.857 0 0 0 3 14.857v4.286C3 20.169 3.831 21 4.857 21h4.286A1.857 1.857 0 0 0 11 19.143v-4.286A1.857 1.857 0 0 0 9.143 13H4.857Zm10 0A1.857 1.857 0 0 0 13 14.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 21 19.143v-4.286A1.857 1.857 0 0 0 19.143 13h-4.286Z"
                    clip-rule="evenodd" />
            </svg>
        </button>
    </div>

    @if ($viewMode === 'table')
        <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 rtl:text-right dark:text-gray-400">
                <thead class="text-xs uppercase text-ivory bg-blue-grotto dark:bg-royal-blue">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            No
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Product model
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Image
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Brand
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Category
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Price
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Qty
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $index => $product)
                        <tr class="border-b border-gray-200 odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 dark:border-gray-700"
                            wire:key="product-{{ $product->slug }}">
                            <td class="px-6 py-4">
                                {{ ($products->currentPage() - 1) * $products->perPage() + $index + 1 }}.
                            </td>
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <a class="hover:underline"
                                    href="{{ route('admin.products.show', ['slug' => $product->slug]) }}">
                                    {{ $product->model }}
                                </a>
                            </th>
                            <td class="px-6 py-4">
                                <img src="{{ $product->images->first() ? Storage::url($product->images->first()->image_path) : asset('img/common/img-unavailable.jpg') }}"
                                    alt="{{ $product->model }}" class="object-cover w-32 h-20">
                            </td>
                            <td class="px-6 py-4">
                                {{ $product->brand->name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $product->category->name }}
                            </td>
                            <td class="px-6 py-4">
                                ${{ number_format($product->price, 2) }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $product->stock_quantity <= 0 ? 'Out of stock' : $product->stock_quantity }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-4">
                                    <a href="#"
                                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                    <div x-data="{ modalIsOpen: false }">
                                        <!-- Delete Trigger Button -->
                                        <button x-on:click="modalIsOpen = true" type="button"
                                            class="font-medium text-red-600 dark:text-red-500 hover:underline">
                                            Delete
                                        </button>

                                        <!-- Modal Overlay -->
                                        <div x-cloak x-show="modalIsOpen" x-transition.opacity.duration.200ms
                                            x-trap.inert.noscroll="modalIsOpen"
                                            x-on:keydown.esc.window="modalIsOpen = false"
                                            x-on:click.self="modalIsOpen = false"
                                            class="fixed inset-0 z-30 flex w-full items-start justify-center bg-black/20 p-4 pb-8 backdrop-blur-md lg:p-8"
                                            role="dialog" aria-modal="true" aria-labelledby="deleteModalTitle">

                                            <!-- Modal Dialog -->
                                            <div x-show="modalIsOpen"
                                                x-transition:enter="transition ease-out duration-200 delay-100 motion-reduce:transition-opacity"
                                                x-transition:enter-start="opacity-0 scale-50"
                                                x-transition:enter-end="opacity-100 scale-100"
                                                class="flex max-w-lg flex-col gap-4 overflow-hidden rounded-sm border border-red-300 bg-white text-red-600 dark:border-red-700 dark:bg-neutral-900 dark:text-red-300">

                                                <!-- Dialog Header -->
                                                <div
                                                    class="flex items-center justify-between border-b border-red-300 bg-red-50/60 p-4 dark:border-red-700 dark:bg-red-950/20">
                                                    <h3 id="deleteModalTitle"
                                                        class="font-semibold tracking-wide text-red-900 dark:text-red-100">
                                                        Confirm Deletion
                                                    </h3>
                                                    <button x-on:click="modalIsOpen = false" aria-label="close modal">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                            aria-hidden="true" stroke="currentColor" fill="none"
                                                            stroke-width="1.4" class="w-5 h-5">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                    </button>
                                                </div>

                                                <!-- Dialog Body -->
                                                <div class="px-4 py-8">
                                                    <p>Are you sure you want to delete this product? This action cannot
                                                        be undone.</p>
                                                </div>

                                                <!-- Dialog Footer -->
                                                <div
                                                    class="flex flex-col-reverse justify-between gap-2 border-t border-red-300 bg-red-50/60 p-4 dark:border-red-700 dark:bg-red-950/20 sm:flex-row sm:items-center md:justify-end">
                                                    <button x-on:click="modalIsOpen = false" type="button"
                                                        class="whitespace-nowrap rounded-sm px-4 py-2 text-center text-sm font-medium tracking-wide text-red-600 transition hover:opacity-75 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600 active:opacity-100 active:outline-offset-0 dark:text-red-300 dark:focus-visible:outline-red-600">
                                                        No, Cancel
                                                    </button>
                                                    <form method="POST"
                                                        action="{{ route('admin.products.delete', $product->id) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="whitespace-nowrap rounded-sm bg-red-600 border border-red-600 px-4 py-2 text-center text-sm font-medium tracking-wide text-white transition hover:bg-red-700 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600 active:bg-red-600 active:outline-offset-0">
                                                            Yes, Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    @if ($viewMode === 'card')
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
            @foreach ($products as $product)
                <div class="p-4 bg-white rounded-lg shadow-lg dark:bg-gray-800"
                    wire:key="product-card-{{ $product->slug }}">
                    <img src="{{ $product->images->first() ? Storage::url($product->images->first()->image_path) : asset('img/common/img-unavailable.jpg') }}"
                        alt="{{ $product->model }}" class="object-cover w-1/2 h-auto rounded-md md:h-40 md:w-full">

                    <h3 class="mt-2 text-lg font-semibold text-gray-900 dark:text-white">
                        {{ $product->model }}
                    </h3>

                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        {{ $product->category->name ?? 'No Category' }}
                    </p>

                    <p class="mt-1 text-gray-800 dark:text-gray-300">
                        {{ $product->brand->name ?? 'No Brand' }}
                    </p>

                    <div class="flex justify-between mt-4">
                        <a href="#" class="text-blue-600 dark:text-blue-400 hover:underline">Edit</a>
                        <a href="#" class="text-red-600 dark:text-red-400 hover:underline">Delete</a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <div class="flex justify-center items-center">
        {{ $products->links('vendor.livewire.flowbite') }}
    </div>

    <div wire:loading.delay.longest wire:target.except="gotoPage, nextPage, previousPage"
        class="fixed inset-x-0 top-0 z-20 h-full bg-slate-500/50">
        <div role="status" class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">
            <svg aria-hidden="true" class="w-20 h-20 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                    fill="currentColor" />
                <path
                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                    fill="currentFill" />
            </svg>
            <span class="sr-only">Loading...</span>
        </div>
    </div>
</div>
