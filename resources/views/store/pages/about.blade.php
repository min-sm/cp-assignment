@extends('layouts.default')

@section('title', 'About Us')

@section('content')

    <div class="max-w-screen-xl mx-auto p-4" x-data="{}">

        <div class="sm:flex items-center max-w-screen-xl">
            <div class="sm:w-1/2 p-10">
                <div class="image object-center text-center">
                    <img src="{{ asset('img/about/about.png') }}">
                </div>
            </div>
            <div class="sm:w-1/2 p-5">
                <div class="text">
                    <span class="text-gray-500 border-b-2 border-indigo-600 uppercase">About us</span>
                    <h2 class="my-4 font-bold text-3xl  sm:text-4xl ">About <span class="text-indigo-600">Our Company</span>
                    </h2>
                    <p class="text-gray-700">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid, commodi
                        doloremque, fugiat illum magni minus nisi nulla numquam obcaecati placeat quia, repellat tempore
                        voluptatum.
                    </p>
                </div>
            </div>
        </div>

        <div class="my-5">
            <p class="text-3xl font-semibold text-gray-900 dark:text-white text-center mb-2">Explore Our Categories</p>
            <p class="text-center text-gray-900 dark:text-white">Discover the wide range of product categories available at
                our store, designed to meet all your needs.</p>
        </div>
        <div class="grid grid-cols-3 grid-rows-4 gap-5">
            <!-- Laptops -->
            <div class="col-span-2 row-span-2 bg-slate-200 rounded relative overflow-hidden group h-64"
                x-data="{ isHovered: false }" @mouseenter="isHovered = true" @mouseleave="isHovered = false">
                <img src="{{ asset('img/about/laptops.jpg') }}" alt="Laptops"
                    class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                <div x-show="isHovered" x-transition.opacity
                    class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center text-white text-xl font-bold">
                    Laptops
                </div>
            </div>

            <!-- Adapters -->
            <div class="col-start-3 bg-slate-200 rounded relative overflow-hidden group h-32" x-data="{ isHovered: false }"
                @mouseenter="isHovered = true" @mouseleave="isHovered = false">
                <img src="{{ asset('img/about/adapters.jpg') }}" alt="Adapters"
                    class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                <div x-show="isHovered" x-transition.opacity
                    class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center text-white text-xl font-bold">
                    Adapters
                </div>
            </div>

            <!-- Screens -->
            <div class="row-span-3 col-start-3 row-start-2 bg-slate-200 rounded relative overflow-hidden group h-96"
                x-data="{ isHovered: false }" @mouseenter="isHovered = true" @mouseleave="isHovered = false">
                <img src="{{ asset('img/about/screens.jpg') }}" alt="Screens"
                    class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                <div x-show="isHovered" x-transition.opacity
                    class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center text-white text-xl font-bold">
                    Screens
                </div>
            </div>

            <!-- Batteries -->
            <div class="row-span-2 row-start-3 bg-slate-200 rounded relative overflow-hidden group h-full"
                x-data="{ isHovered: false }" @mouseenter="isHovered = true" @mouseleave="isHovered = false">
                <img src="{{ asset('img/about/batteries.jpg') }}" alt="Batteries"
                    class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                <div x-show="isHovered" x-transition.opacity
                    class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center text-white text-xl font-bold">
                    Batteries
                </div>
            </div>

            <!-- Keyboards -->
            <div class="row-start-3 bg-slate-200 rounded relative overflow-hidden group h-32" x-data="{ isHovered: false }"
                @mouseenter="isHovered = true" @mouseleave="isHovered = false">
                <img src="{{ asset('img/about/keyboards.jpg') }}" alt="Keyboards"
                    class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                <div x-show="isHovered" x-transition.opacity
                    class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center text-white text-xl font-bold">
                    Keyboards
                </div>
            </div>

            <!-- Mice -->
            <div class="col-start-2 row-start-4 bg-slate-200 rounded relative overflow-hidden group h-32"
                x-data="{ isHovered: false }" @mouseenter="isHovered = true" @mouseleave="isHovered = false">
                <img src="{{ asset('img/about/mice.jpg') }}" alt="Mice"
                    class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                <div x-show="isHovered" x-transition.opacity
                    class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center text-white text-xl font-bold">
                    Mice
                </div>
            </div>
        </div>
    </div>


@endsection
