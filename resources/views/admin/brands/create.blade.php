@extends('admin.layouts.default')

@section('title', 'Dashboard')

@section('content')
    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Add a new brand</h2>
            <form action="{{ route('admin.brands.store') }}" method="POST">
                @csrf
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <x-form.input name="name" label="Brand name" placeholder="Type brand name" :required="true"
                        class="sm:col-span-2" />
                    <x-form.input name="description" label="Description" placeholder="Product description here"
                        element="textarea" class="sm:col-span-2" />
                    <x-form.input name="website" label="Website" placeholder="Type brand website link"
                        class="sm:col-span-2" />
                    <div class="sm:col-span-2">
                        <label for="series"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Series</label>
                        <button>Add new series</button>
                        <div class="grid gap-4 sm:grid-cols-3 sm:gap-6">
                            <x-form.input name="series_name" label="Series name" placeholder="Type series name"
                                :required="true" />
                            <x-form.input name="launch_year" label="Launch year" placeholder="Enter launch year"
                                type="number" :inputAttributes="['min' => 1990]" />
                            <button>remove</button>
                        </div>
                    </div>
                </div>
                <button type="submit"
                    class="text-white text-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm tracking-wide px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 mt-6">
                    Add new brand
                </button>
            </form>
        </div>
    </section>
@endsection
