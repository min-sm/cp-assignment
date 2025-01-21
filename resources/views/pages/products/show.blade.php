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
                        <img :src="mainImage" alt="Product" class="w-full h-auto rounded-lg shadow-md mb-4">

                        <!-- Thumbnails -->
                        <div class="flex gap-4 py-4 justify-center overflow-x-auto">
                            @forelse ($product->images as $image)
                                <img src="{{ asset('img/products/' . $product->slug . '/' . $image->filename) }}"
                                    alt="Thumbnail"
                                    class="size-16 sm:size-20 object-cover rounded-md cursor-pointer opacity-60 hover:opacity-100 transition duration-300"
                                    @click="mainImage = '{{ asset('img/products/' . $product->slug . '/' . $image->filename) }}'">
                            @empty
                                <p class="text-gray-500 italic">No additional images available</p>
                            @endforelse
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

                        <!-- Quantity Input -->
                        <div class="mb-6">
                            <label for="quantity" class="block text-sm font-medium text-gray-700 mb-1">Quantity:</label>
                            <input type="number" id="quantity" name="quantity" min="1" value="1"
                                class="w-12 text-center rounded-md border-gray-300  shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <!-- Buttons -->
                        <div class="flex space-x-4 mb-6" wire:ignore.self>
                            @livewire('button', ['product' => $product])
                        </div>

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
