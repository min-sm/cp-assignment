<div>
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Products
    </h2>
    <div class="flex justify-end space-x-4 mb-4">
        <button wire:click="setViewMode('table')"
            class="px-4 py-2 rounded-md text-white bg-blue-600 hover:bg-blue-700 
                {{ $viewMode === 'table' ? 'opacity-100' : 'opacity-50' }}">
            Table View
        </button>

        <button wire:click="setViewMode('card')"
            class="px-4 py-2 rounded-md text-white bg-green-600 hover:bg-green-700
                {{ $viewMode === 'card' ? 'opacity-100' : 'opacity-50' }}">
            Card View
        </button>
    </div>

    @if ($viewMode === 'table')
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-ivory uppercase bg-blue-grotto dark:bg-royal-blue ">
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
                        <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200"
                            wire:key="product-{{ $product->slug }}">
                            <td class="px-6 py-4">
                                {{ ($products->currentPage() - 1) * $products->perPage() + $index + 1 }}.
                            </td>
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $product->model }}
                            </th>
                            <td class="px-6 py-4">
                                <img src="{{ $product->images->first() ? Storage::url($product->images->first()->image_path) : asset('img/common/img-unavailable.jpg') }}"
                                    alt="{{ $product->model }}" class="w-32 h-20 object-cover">
                            </td>
                            <td class="px-6 py-4">
                                {{ $product->series->brand->name }}
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
                                    <a href="#"
                                        class="font-medium text-red-600 dark:text-red-500 hover:underline">Delete</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    @if ($viewMode === 'card')
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($products as $product)
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-4"
                    wire:key="product-card-{{ $product->slug }}">
                    <img src="{{ $product->images->first() ? Storage::url($product->images->first()->image_path) : asset('img/common/img-unavailable.jpg') }}"
                        alt="{{ $product->model }}" class="w-full h-40 object-cover rounded-md">

                    <h3 class="mt-2 text-lg font-semibold text-gray-900 dark:text-white">
                        {{ $product->model }}
                    </h3>

                    <p class="text-gray-600 dark:text-gray-400 text-sm">
                        {{ $product->category->name ?? 'No Category' }}
                    </p>

                    <p class="text-gray-800 dark:text-gray-300 mt-1">
                        {{ $product->series->brand->name ?? 'No Brand' }}
                    </p>

                    <div class="mt-4 flex justify-between">
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
</div>
