@extends('admin.layouts.default')

@section('title', 'Edit {{ $brand->name }}')

@section('content')
    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Update {{ $brand->name }}</h2>
            <form action="{{ route('admin.brands.update', $brand->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <x-form.input name="name" label="Brand name" placeholder="Type brand name" :required="true"
                        class="sm:col-span-2" :value="$brand->name" />
                    <x-form.input name="description" label="Description" placeholder="Product description here"
                        element="textarea" class="sm:col-span-2" value="{{ $brand->description }}" />
                    <x-form.input name="website" label="Website" placeholder="Type brand website link" class="sm:col-span-2"
                        value="{{ $brand->website }}" />
                    {{-- @dd($brand->series) --}}
                    <div x-data="{ series: {{ $brand->series->toJson() }} }">
                        <label for="series" class="...">Series</label>
                        <button type="button"
                            @click="series.push({id: Date.now().toString(36) + Math.random().toString(36).slice(2, 4), name: '', year: ''})"
                            class="px-4 py-2 bg-blue-500 text-white rounded">
                            Add new series
                        </button>

                        <template x-for="(item, index) in series" :key="item.id">
                            <div class="grid gap-4 sm:grid-cols-3 sm:gap-6 mt-4">
                                <input :name="'series[' + index + '][id]'" :id="'series_id_' + item.id" x-model="item.id"
                                    type="hidden">
                                <div>
                                    <label :for="'series_name_' + item.id"
                                        class="block text-sm font-medium text-gray-700">Series name</label>
                                    <input :name="'series[' + index + '][name]'" :id="'series_name_' + item.id"
                                        x-model="item.name"
                                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                        placeholder="Type series name" required>
                                </div>

                                <div>
                                    <label :for="'launch_year_' + item.id"
                                        class="block text-sm font-medium text-gray-700">Launch year</label>
                                    <input :name="'series[' + index + '][year]'" :id="'launch_year_' + item.id"
                                        x-model="item.year" type="number" min="1990"
                                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                        placeholder="Enter launch year">
                                </div>

                                <div class="flex items-end">
                                    <button type="button" @click="series.splice(index, 1)"
                                        class="px-4 py-2 bg-red-500 text-white rounded">
                                        Remove
                                    </button>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
                <button type="submit"
                    class="text-white text-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm tracking-wide px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 mt-6">
                    Update
                </button>
            </form>
        </div>
    </section>
@endsection
