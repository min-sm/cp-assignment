@extends('store.layouts.default')

@section('title', $product->model)

@section('content')
    <div class="max-w-screen-xl p-4 mx-auto">
        <div>
            <div class="container px-4 py-8 mx-auto">
                <div class="flex flex-wrap -mx-4">
                    <!-- Product Images -->
                    <div class="w-full px-4 mb-8 md:w-1/2" x-data="{ mainImage: '{{ $product->images->first() ? Storage::url($product->images->first()->image_path) : asset('img/common/img-unavailable.jpg') }}' }">
                        <!-- Main Image -->
                        <div class="relative w-full h-64 sm:h-80 md:h-96 lg:h-112 xl:h-128">
                            <img :src="mainImage" alt="Product"
                                class="object-cover w-full h-full mb-4 rounded-lg shadow-md">
                        </div>

                        <!-- Thumbnails -->
                        <div class="flex justify-center gap-4 py-4 overflow-x-auto">
                            @foreach ($product->images as $image)
                                <img src="{{ Storage::url($image->image_path) }}" alt="Thumbnail"
                                    class="object-cover transition duration-300 rounded-md cursor-pointer size-16 sm:size-20 opacity-60 hover:opacity-100"
                                    @click="mainImage = '{{ Storage::url($image->image_path) }}'">
                            @endforeach
                        </div>
                    </div>

                    <!-- Product Details -->
                    <div class="w-full px-4 md:w-1/2">
                        <h2 class="mb-2 text-3xl font-bold">{{ $product->model }}</h2>
                        <p class="mb-4 text-gray-600">SKU: WH1000XM4</p>
                        <div class="mb-4">
                            <span class="mr-2 text-2xl font-bold">${{ $product->price }}</span>
                        </div>
                        <p class="mb-6 text-gray-700">{{ $product->description }}</p>

                        @livewire('button', ['product' => $product])

                        <!-- Key Features -->
                        <div>
                            <h3 class="mb-2 text-lg font-semibold">Key Features:</h3>
                            <ul class="text-gray-700 list-disc list-inside">
                                <li>Industry-leading noise cancellation</li>
                                <li>30-hour battery life</li>
                                <li>Touch sensor controls</li>
                                <li>Speak-to-chat technology</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <x-products.grid :products="$products" />
    </div>
@endsection
