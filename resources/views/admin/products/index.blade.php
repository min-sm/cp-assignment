<div>
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Products
    </h2>
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
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $index => $product)
                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200"
                        wire:key="product-{{ $product->slug }}">
                        <td class="px-6 py-4">
                            {{ $index + 1 }}.
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
                            <a href="#"
                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="flex justify-center items-center">
    </div>
    {{ $products->links('vendor.livewire.flowbite') }}
</div>
