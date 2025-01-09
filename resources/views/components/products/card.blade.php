@props(['product'])

<div
    class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 flex flex-col">
    <a href="#">
        <img class="w-full h-48 object-cover p-8 rounded-t-lg" src="{{ asset($product['image']) }}" alt="product image" />
    </a>
    <div class="px-5 pb-5 flex flex-col flex-grow">
        <a href="#">
            <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">
                {{ Str::words($product['model'], 7, '...') }}
            </h5>
        </a>
        <p class="mb-3 mt-2 font-normal text-gray-700 dark:text-gray-400 flex-grow">
            {{ Str::words($product['description'], 15, '...') }}
        </p>
        <div class="flex items-center justify-between">
            <span class="text-3xl font-bold text-gray-900 dark:text-white">{{ $product['price'] }}</span>
            <a href="#"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Add to cart
            </a>
        </div>
    </div>
</div>
