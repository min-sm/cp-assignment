@extends('layouts.default')

@section('title', 'Home')

@section('content')



    <div id="default-carousel" class="relative w-full" data-carousel="slide">
        <!-- Carousel wrapper -->
        <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
            <!-- Item 1 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="{{ asset('img/homepage/slider-1.jpg') }}" class="absolute inset-0 w-full h-full object-cover"
                    alt="...">
            </div>
            <!-- Item 2 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="{{ asset('img/homepage/slider-2.jpg') }}" class="absolute inset-0 w-full h-full object-cover"
                    alt="...">
            </div>
            <!-- Item 3 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="{{ asset('img/homepage/slider-3.jpg') }}" class="absolute inset-0 w-full h-full object-cover"
                    alt="...">
            </div>
            <!-- Item 4 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="{{ asset('img/homepage/slider-4.jpg') }}" class="absolute inset-0 w-full h-full object-cover"
                    alt="...">
            </div>
            <!-- Item 5 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="{{ asset('img/homepage/slider-5.jpg') }}" class="absolute inset-0 w-full h-full object-cover"
                    alt="...">
            </div>
        </div>
        <!-- Slider indicators -->
        <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
            <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1"
                data-carousel-slide-to="0"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2"
                data-carousel-slide-to="1"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3"
                data-carousel-slide-to="2"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 4"
                data-carousel-slide-to="3"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 5"
                data-carousel-slide-to="4"></button>
        </div>
        <!-- Slider controls -->
        <button type="button"
            class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
            data-carousel-prev>
            <span
                class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 1 1 5l4 4" />
                </svg>
                <span class="sr-only">Previous</span>
            </span>
        </button>
        <button type="button"
            class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
            data-carousel-next>
            <span
                class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 9 4-4-4-4" />
                </svg>
                <span class="sr-only">Next</span>
            </span>
        </button>
    </div>

    <div class="max-w-screen-xl mx-auto p-4 pb-0 mt-8">
        <p class="text-3xl font-semibold text-gray-900 dark:text-white">Popular right now</p>
    </div>
    <!-- Products Grid -->
    <x-products.grid :products="$products" />

    <div class="max-w-screen-xl mx-auto p-4">
        <section class="text-gray-600 body-font">
            <div class="container px-5 py-24 mx-auto">
                <h1 class="text-3xl font-medium title-font dark:text-white text-gray-900 mb-12 text-center">Testimonials</h1>
                <div class="flex flex-wrap -m-4">
                    <div class="p-4 md:w-1/2 w-full">
                        <div class="h-full bg-white border border-gray-200 shadow dark:bg-gray-800 dark:border-gray-700 p-8 rounded">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                class="block w-5 h-5 text-gray-400 mb-4" viewBox="0 0 975.036 975.036">
                                <path
                                    d="M925.036 57.197h-304c-27.6 0-50 22.4-50 50v304c0 27.601 22.4 50 50 50h145.5c-1.9 79.601-20.4 143.3-55.4 191.2-27.6 37.8-69.399 69.1-125.3 93.8-25.7 11.3-36.8 41.7-24.8 67.101l36 76c11.6 24.399 40.3 35.1 65.1 24.399 66.2-28.6 122.101-64.8 167.7-108.8 55.601-53.7 93.7-114.3 114.3-181.9 20.601-67.6 30.9-159.8 30.9-276.8v-239c0-27.599-22.401-50-50-50zM106.036 913.497c65.4-28.5 121-64.699 166.9-108.6 56.1-53.7 94.4-114.1 115-181.2 20.6-67.1 30.899-159.6 30.899-277.5v-239c0-27.6-22.399-50-50-50h-304c-27.6 0-50 22.4-50 50v304c0 27.601 22.4 50 50 50h145.5c-1.9 79.601-20.4 143.3-55.4 191.2-27.6 37.8-69.4 69.1-125.3 93.8-25.7 11.3-36.8 41.7-24.8 67.101l35.9 75.8c11.601 24.399 40.501 35.2 65.301 24.399z">
                                </path>
                            </svg>
                            <p class="leading-relaxed mb-6 dark:text-white text-gray-800">The retail store exceeded my expectations! Staff was
                                knowledgeable and patient, helping me find the perfect laptop. Great selection and excellent
                                service.</p>
                            <a class="inline-flex items-center">
                                <img alt="testimonial" src="{{ asset('img/homepage/testimonial-1.jpg') }}"
                                    class="w-12 h-12 rounded-full flex-shrink-0 object-cover object-center">
                                <span class="flex-grow flex flex-col pl-4">
                                    <span class="title-font font-medium dark:text-white text-gray-900">Holden Caulfield</span>
                                    <span class="text-gray-500 text-sm">UI DEVELOPER</span>
                                </span>
                            </a>
                        </div>
                    </div>
                    <div class="p-4 md:w-1/2 w-full">
                        <div class="h-full bg-white border border-gray-200 shadow dark:bg-gray-800 dark:border-gray-700 p-8 rounded">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                class="block w-5 h-5 text-gray-400 mb-4" viewBox="0 0 975.036 975.036">
                                <path
                                    d="M925.036 57.197h-304c-27.6 0-50 22.4-50 50v304c0 27.601 22.4 50 50 50h145.5c-1.9 79.601-20.4 143.3-55.4 191.2-27.6 37.8-69.399 69.1-125.3 93.8-25.7 11.3-36.8 41.7-24.8 67.101l36 76c11.6 24.399 40.3 35.1 65.1 24.399 66.2-28.6 122.101-64.8 167.7-108.8 55.601-53.7 93.7-114.3 114.3-181.9 20.601-67.6 30.9-159.8 30.9-276.8v-239c0-27.599-22.401-50-50-50zM106.036 913.497c65.4-28.5 121-64.699 166.9-108.6 56.1-53.7 94.4-114.1 115-181.2 20.6-67.1 30.899-159.6 30.899-277.5v-239c0-27.6-22.399-50-50-50h-304c-27.6 0-50 22.4-50 50v304c0 27.601 22.4 50 50 50h145.5c-1.9 79.601-20.4 143.3-55.4 191.2-27.6 37.8-69.4 69.1-125.3 93.8-25.7 11.3-36.8 41.7-24.8 67.101l35.9 75.8c11.601 24.399 40.501 35.2 65.301 24.399z">
                                </path>
                            </svg>
                            <p class="leading-relaxed mb-6 dark:text-white text-gray-800">Amazing shopping experience! The store's atmosphere was
                                welcoming, and the team provided expert advice. I left with a fantastic laptop and a smile.
                            </p>
                            <a class="inline-flex items-center">
                                <img alt="testimonial" src="{{ asset('img/homepage/testimonial-2.jpg') }}"
                                    class="w-12 h-12 rounded-full flex-shrink-0 object-cover object-center">
                                <span class="flex-grow flex flex-col pl-4">
                                    <span class="title-font font-medium dark:text-white text-gray-900">Alper Kamu</span>
                                    <span class="text-gray-500 text-sm">LOCAL BUSINESS OWNER</span>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
