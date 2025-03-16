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
                        <label for="brand" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Brand
                        </label>
                        <select id="brand" name="brand" wire:poll.30s.visible wire:model.change="selectedBrand"
                            @change="if ($event.target.selectedIndex === $event.target.options.length - 1) { window.open('{{ route('admin.brands.create') }}'); $event.target.selectedIndex = 0; }; selectedBrandName = $event.target.options[$event.target.selectedIndex].text;"
                            class="bg-gray-50 border text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 {{ $errors->has('brand') ? 'border-red-500 focus:ring-red-500 focus:border-red-500 bg-red-50 dark:border-red-500 dark:focus:ring-red-500 dark:focus:border-red-500 text-red-900 dark:text-red-50' : 'border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:border-gray-600 dark:focus:ring-blue-500 dark:focus:border-blue-500 text-gray-900 dark:text-white' }}"
                            required>
                            <option>Select brand</option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}" {{ old('brand') == $brand->id ? 'selected' : '' }}>
                                    {{ ucfirst($brand->name) }}
                                </option>
                            @endforeach
                            <option
                                class="text-white text-center bg-blue-700 tracking-wide cursor-pointer hover:bg-black">
                                Create new brand
                            </option>
                        </select>
                        @error('brand')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="w-full">
                        <label for="series"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Series</label>
                        <select id="series" name="series" wire:poll.30s.visible @disabled($selectedBrand === null)
                            class="bg-gray-50 border text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 {{ $errors->has('series') ? 'border-red-500 focus:ring-red-500 focus:border-red-500 bg-red-50 dark:border-red-500 dark:focus:ring-red-500 dark:focus:border-red-500 text-red-900 dark:text-red-50' : 'border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:border-gray-600 dark:focus:ring-blue-500 dark:focus:border-blue-500 text-gray-900 dark:text-white' }}">
                            <option value="">Select series</option>
                            @foreach ($filteredSeries as $series)
                                <option value="{{ $series->id }}"
                                    {{ old('series') == $series->id ? 'selected' : '' }}>
                                    {{ ucfirst($series->name) }}
                                </option>
                            @endforeach
                            @if ($selectedBrand)
                                <option value=""
                                    class="text-white text-center bg-blue-700 tracking-wide cursor-pointer"
                                    x-text="'Add new series to ' + selectedBrandName"></option>
                            @endif
                        </select>
                        @error('series')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="sm:col-span-2">
                        <label for="category"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                        <select id="category" name="category"
                            class="bg-gray-50 border text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 {{ $errors->has('category') ? 'border-red-500 focus:ring-red-500 focus:border-red-500 bg-red-50 dark:border-red-500 dark:focus:ring-red-500 dark:focus:border-red-500 text-red-900 dark:text-red-50' : 'border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:border-gray-600 dark:focus:ring-blue-500 dark:focus:border-blue-500 text-gray-900 dark:text-white' }}"
                            required>
                            <option value="">Select category
                            </option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category') == $category->id ? 'selected' : '' }}>
                                    {{ ucfirst($category->name) }}
                                </option>
                            @endforeach
                        </select>
                        @error('category')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <x-form.input name="quantity" label="Quantity" placeholder="Enter quantity" :required="true"
                        type="number" :inputAttributes="['min' => 1]" />
                    <x-form.input name="price" label="Price" placeholder="Enter price" :required="true"
                        type="number" :inputAttributes="['min' => 1]" />
                    <x-form.input name="description" label="Description" placeholder="Product description here"
                        :required="false" element="textarea" class="sm:col-span-2" />
                    <x-form.input name="files[]" label="Upload multiple files" type="file" :inputAttributes="['multiple' => true]"
                        class="sm:col-span-2" />

                </div>
                <button type="submit"
                    class="text-white text-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm tracking-wide px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 mt-6">
                    Add product
                </button>
            </form>
        </div>
    </section>
</div>
