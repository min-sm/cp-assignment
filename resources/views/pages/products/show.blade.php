@extends('layouts.default')

@section('title', $product->model)

@section('content')
    <div class="max-w-screen-xl mx-auto p-4">
        <div>
            <div class="container mx-auto px-4 py-8">
                <div class="flex flex-wrap -mx-4">
                    <!-- Product Images -->
                    <div class="w-full md:w-1/2 px-4 mb-8" x-data="{ mainImage: '{{ $product->images->first() ? asset('img/products/' . $product->slug . '/' . $product->images->first()->filename) : asset('img/common/img-unavailable.jpg') }}' }">
                        <!-- Main Image -->
                        <div class="w-full h-64 sm:h-80 md:h-96 lg:h-112 xl:h-128 relative">
                            <img :src="mainImage" alt="Product"
                                class="w-full h-full object-cover rounded-lg shadow-md mb-4">
                        </div>

                        <!-- Thumbnails -->
                        <div class="flex gap-4 py-4 justify-center overflow-x-auto">
                            @foreach ($product->images as $image)
                                <img src="{{ asset('img/products/' . $product->slug . '/' . $image->filename) }}"
                                    alt="Thumbnail"
                                    class="size-16 sm:size-20 object-cover rounded-md cursor-pointer opacity-60 hover:opacity-100 transition duration-300"
                                    @click="mainImage = '{{ asset('img/products/' . $product->slug . '/' . $image->filename) }}'">
                            @endforeach
                        </div>
                    </div>

                    <!-- Product Details -->
                    <div class="w-full md:w-1/2 px-4">
                        <h2 class="text-3xl font-bold mb-2">{{ $product->model }}</h2>
                        <p class="text-gray-600 mb-4">SKU: WH1000XM4</p>
                        <div class="mb-4">
                            <span class="text-2xl font-bold mr-2">${{ $product->price }}</span>
                        </div>
                        <p class="text-gray-700 mb-6">{{ $product->description }}</p>

                        @livewire('button', ['product' => $product])

                        <!-- Key Features -->
                        <div>
                            <h3 class="text-lg font-semibold mb-2">Key Features:</h3>
                            <ul class="list-disc list-inside text-gray-700">
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
