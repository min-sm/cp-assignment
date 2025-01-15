@props(['product'])

<div
    class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 flex flex-col">
    <a href="{{ route('product.show', ['slug' => $product->slug]) }}">
        <img class="w-full h-48 object-cover p-8 rounded-t-lg"
            src="{{ $product->images->first() ? asset('img/products/' . $product->slug . '/' . $product->images->first()->filename) : asset('img/common/img-unavailable.jpg') }}"
            alt="{{ $product->model }} image" />
    </a>
    <div class="px-5 pb-5 flex flex-col flex-grow">
        <a href="{{ route('product.show', ['slug' => $product->slug]) }}">
            <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">
                {{ Str::words($product->model, 7, '...') }}
            </h5>
        </a>
        <div class="flex justify-between">
            <h6>
                <form action="{{ route('products.filter') }}" method="POST" class="inline">
                    @csrf
                    <input type="hidden" name="filter_type" value="category">
                    <input type="hidden" name="category_id" value="{{ $product->category->id }}">
                    <button type="submit" class="hover:text-blue-600">
                        {{ $product->category->name }}
                    </button>
                </form>
            </h6>
            <h6>
                <form action="{{ route('products.filter') }}" method="POST" class="inline">
                    @csrf
                    <input type="hidden" name="filter_type" value="brand">
                    <input type="hidden" name="brand_id" value="{{ $product->series->brand->id }}">
                    <button type="submit" class="hover:text-blue-600">
                        {{ explode(' ', $product->series->brand->name)[0] }}
                    </button>
                </form>
            </h6>
        </div>
        <p class="mb-3 mt-2 font-normal text-gray-700 dark:text-gray-400 flex-grow">
            {{ Str::words($product->description, 15, '...') }}
        </p>
        <div class="flex items-center justify-between">
            <span class="text-xl xl:text-3xl font-bold text-gray-900 dark:text-white">${{ $product->price }}</span>
            <a href="{{ route('product.show', ['slug' => $product->slug]) }}"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-1.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Details
            </a>
        </div>
    </div>
</div>
