<div>
    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Add a new product</h2>
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data"
                x-data="{ selectedBrandName: '' }">
                @csrf
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <x-form.input name="model" label="Product model" placeholder="Type product model" :required="true"
                        class="sm:col-span-2" />
                    <div class="w-full">
                        <label for="brand"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Brand</label>
                        <select id="brand" name="brand" wire:model.live="selectedBrand"
                            @change="if ($event.target.selectedIndex === $event.target.options.length - 1) { window.open('{{ route('test') }}'); $event.target.selectedIndex = 0; }; selectedBrandName = $event.target.options[$event.target.selectedIndex].text;"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option>Select brand</option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}" {{ old('brand') == $brand->id ? 'selected' : '' }}>
                                    {{ ucfirst($brand->name) }}
                                </option>
                            @endforeach
                            <option
                                class="text-white text-center py-12 inline-block bg-blue-700 font-medium tracking-wide">
                                Create new brand
                            </option>
                        </select>
                    </div>
                    <div class="w-full">
                        <label for="series"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Series</label>
                        <select id="series" name="series" @disabled($selectedBrand === null)
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 disabled:opacity-50 disabled:cursor-not-allowed">
                            <option>Select series</option>
                            @foreach ($filteredSeries as $series)
                                <option value="{{ $series->id }}"
                                    {{ old('series') == $series->id ? 'selected' : '' }}>
                                    {{ ucfirst($series->name) }}
                                </option>
                            @endforeach
                            @if ($selectedBrand)
                                <option
                                    class="text-white text-center py-12 inline-block bg-blue-700 font-medium tracking-wide"
                                    x-text="'Add new series to ' + selectedBrandName"></option>
                            @endif
                        </select>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="category"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                        <select id="category" name="category" wire:poll.30s.visible
                            @change="if ($event.target.selectedIndex === $event.target.options.length - 1) { window.open('{{ route('test') }}', '_blank'); $event.target.selectedIndex = 0; }"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="" {{ old('category') == '' ? 'selected' : '' }}>Select category
                            </option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category') == $category->id ? 'selected' : '' }}>
                                    {{ ucfirst($category->name) }}
                                </option>
                            @endforeach
                            <option
                                class="text-white text-center py-12 inline-block bg-blue-700 font-medium tracking-wide">
                                Create new category</option>
                        </select>
                    </div>
                    <x-form.input name="quantity" label="Quantity" placeholder="Enter quantity" :required="true"
                        type="number" :inputAttributes="['min' => 1]" />
                    <x-form.input name="price" label="Price" placeholder="Enter price" :required="true"
                        type="number" :inputAttributes="['min' => 1]" />

                    <div class="sm:col-span-2">
                        <label for="description"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                        <textarea id="description" rows="8" name="description"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Product description here"></textarea>
                    </div>

                    <div class="sm:col-span-2">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            for="multiple_files">Upload multiple files</label>
                        <input
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                            id="multiple_files" type="file" multiple>
                    </div>

                </div>
                <button type="submit"
                    class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                    Add product
                </button>
            </form>
        </div>
    </section>
</div>
