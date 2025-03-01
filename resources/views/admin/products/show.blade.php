<div>
    <div class="overflow-hidden px-3 py-5 mx-auto my-8 max-w-2xl bg-white rounded-xl shadow-md md:px-6">
        <h1 class="pb-3 mb-6 text-2xl font-bold text-gray-800 border-b">Product Details</h1>

        <div class="space-y-6">
            <!-- Product Information -->
            <div class="p-2.5 bg-gray-50 rounded-lg shadow-sm">
                <div
                    class="flex flex-col justify-between items-start py-2 space-y-1 border-b border-gray-200 md:space-y-0 md:flex-row md:items-center">
                    <p class="font-medium text-gray-600">Model:</p>
                    <p class="w-auto font-semibold text-gray-800 md:w-3/4 md:text-right">
                        {{ $product->model }}</p>
                </div>

                <div
                    class="flex flex-col justify-between items-start py-2 space-y-1 border-b border-gray-200 md:space-y-0 md:flex-row md:items-center">
                    <p class="font-medium text-gray-600">Brand:</p>
                    <p class="w-auto font-semibold text-gray-800 md:w-3/4 md:text-right">
                        {{ $product->brand->name }}</p>
                </div>

                <div
                    class="flex flex-col justify-between items-start py-2 space-y-1 border-b border-gray-200 md:space-y-0 md:flex-row md:items-center">
                    <p class="font-medium text-gray-600">Series:</p>
                    <p class="w-auto font-semibold text-gray-800 md:w-3/4 md:text-right">
                        {{ $product->series->name ?? 'None' }}</p>
                </div>

                <div
                    class="flex flex-col justify-between items-start py-2 space-y-1 border-b border-gray-200 md:space-y-0 md:flex-row md:items-center">
                    <p class="font-medium text-gray-600">Category:</p>
                    <p class="w-auto font-semibold text-gray-800 md:w-3/4 md:text-right">
                        {{ $product->category->name }}</p>
                </div>
            </div>

            <!-- Description -->
            <div class="p-5 bg-gray-50 rounded-lg shadow-sm">
                <p class="mb-2 font-medium text-gray-600">Description:</p>
                <p class="leading-relaxed text-gray-800">{{ $product->description }}</p>
            </div>

            <!-- Price and Quantity -->
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div class="p-4 bg-blue-50 rounded-lg shadow-sm">
                    <div class="flex justify-between items-center">
                        <p class="font-medium text-gray-600">Price:</p>
                        <p class="text-xl font-bold text-blue-600">${{ $product->price }}</p>
                    </div>
                </div>

                <div class="p-4 bg-blue-50 rounded-lg shadow-sm">
                    <div class="flex justify-between items-center">
                        <p class="font-medium text-gray-600">Quantity:</p>
                        @if ($product->stock_quantity > 0)
                            <p class="font-bold text-green-600">{{ $product->stock_quantity }}</p>
                        @else
                            <p class="font-bold text-red-500">Out of stock</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Images -->
            <div class="p-5 bg-gray-50 rounded-lg shadow-sm">
                <p class="mb-4 font-medium text-gray-600">Images:</p>

                <!-- Carousel wrapper -->

                @if (isset($product->images[0]))
                    <div id="indicators-carousel" class="relative w-full" data-carousel="static">
                        <!-- Carousel wrapper -->
                        <div class="overflow-hidden relative h-56 rounded-lg md:h-96">
                            @foreach ($product->images as $image)
                                <div class="hidden duration-700 ease-in-out" data-carousel-item="active">
                                    <img src="{{ Storage::url($image->image_path) }}"
                                        class="block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2"
                                        alt="...">
                                </div>
                            @endforeach
                        </div>
                        <!-- Slider indicators -->
                        <div
                            class="flex absolute bottom-5 left-1/2 z-30 space-x-3 -translate-x-1/2 rtl:space-x-reverse">
                            @foreach ($product->images as $image)
                                <button type="button" class="w-3 h-3 rounded-full"
                                    aria-label="Slide {{ $image->id + 1 }}"
                                    data-carousel-slide-to="{{ $image->id }}"></button>
                            @endforeach
                        </div>
                        <!-- Slider controls -->
                        <button type="button"
                            class="flex absolute top-0 z-30 justify-center items-center px-4 h-full cursor-pointer start-0 group focus:outline-none"
                            data-carousel-prev>
                            <span
                                class="inline-flex justify-center items-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                                <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M5 1 1 5l4 4" />
                                </svg>
                                <span class="sr-only">Previous</span>
                            </span>
                        </button>
                        <button type="button"
                            class="flex absolute top-0 z-30 justify-center items-center px-4 h-full cursor-pointer end-0 group focus:outline-none"
                            data-carousel-next>
                            <span
                                class="inline-flex justify-center items-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                                <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 9 4-4-4-4" />
                                </svg>
                                <span class="sr-only">Next</span>
                            </span>
                        </button>
                    </div>
                @else
                    <div>
                        <p class="text-center">No images uploaded yet!</p>
                    </div>
                @endif
            </div>

            <div class="flex justify-between">
                <x-button-link href="{{ route('about') }}">Edit</x-button-link>
                <x-button-link href="{{ route('product.show', ['slug' => $product->slug]) }}" color="yellow">View on
                    store</x-button-link>
                <x-button-link href="{{ route('about') }}" color="red">Delete</x-button-link>
                <div x-data="{ modalIsOpen: false }">
                    <button x-on:click="modalIsOpen = true" type="button"
                        class="whitespace-nowrap rounded-sm bg-black border border-black px-4 py-2 text-center text-sm font-medium tracking-wide text-neutral-100 transition hover:opacity-75 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black active:opacity-100 active:outline-offset-0 dark:bg-white dark:border-white dark:text-black dark:focus-visible:outline-white">Open
                        Modal</button>
                    <div x-cloak x-show="modalIsOpen" x-transition.opacity.duration.200ms
                        x-trap.inert.noscroll="modalIsOpen" x-on:keydown.esc.window="modalIsOpen = false"
                        x-on:click.self="modalIsOpen = false"
                        class="fixed inset-0 z-30 flex w-full items-start justify-center bg-black/20 p-4 pb-8 backdrop-blur-md lg:p-8"
                        role="dialog" aria-modal="true" aria-labelledby="defaultModalTitle">
                        <!-- Modal Dialog -->
                        <div x-show="modalIsOpen"
                            x-transition:enter="transition ease-out duration-200 delay-100 motion-reduce:transition-opacity"
                            x-transition:enter-start="opacity-0 scale-50" x-transition:enter-end="opacity-100 scale-100"
                            class="flex max-w-lg flex-col gap-4 overflow-hidden rounded-sm border border-neutral-300 bg-white text-neutral-600 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-300">
                            <!-- Dialog Header -->
                            <div
                                class="flex items-center justify-between border-b border-neutral-300 bg-neutral-50/60 p-4 dark:border-neutral-700 dark:bg-neutral-950/20">
                                <h3 id="defaultModalTitle"
                                    class="font-semibold tracking-wide text-neutral-900 dark:text-white">Special Offer
                                </h3>
                                <button x-on:click="modalIsOpen = false" aria-label="close modal">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true"
                                        stroke="currentColor" fill="none" stroke-width="1.4" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                            <!-- Dialog Body -->
                            <div class="px-4 py-8">
                                <p>As a token of appreciation, we have an exclusive offer just for you. Upgrade your
                                    account now to unlock premium features and enjoy a seamless experience.</p>
                            </div>
                            <!-- Dialog Footer -->
                            <div
                                class="flex flex-col-reverse justify-between gap-2 border-t border-neutral-300 bg-neutral-50/60 p-4 dark:border-neutral-700 dark:bg-neutral-950/20 sm:flex-row sm:items-center md:justify-end">
                                <button x-on:click="modalIsOpen = false" type="button"
                                    class="whitespace-nowrap rounded-sm px-4 py-2 text-center text-sm font-medium tracking-wide text-neutral-600 transition hover:opacity-75 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black active:opacity-100 active:outline-offset-0 dark:text-neutral-300 dark:focus-visible:outline-white">Remind
                                    me later</button>
                                <button x-on:click="modalIsOpen = false" type="button"
                                    class="whitespace-nowrap rounded-sm bg-black border border-black px-4 py-2 text-center text-sm font-medium tracking-wide text-neutral-100 transition hover:opacity-75 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black active:opacity-100 active:outline-offset-0 dark:bg-white dark:border-white dark:text-black dark:focus-visible:outline-white">Upgrade
                                    Now</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product ID -->
            <div class="text-sm text-right text-gray-500">
                Product ID: {{ $product->id }}
            </div>
        </div>
    </div>
</div>
