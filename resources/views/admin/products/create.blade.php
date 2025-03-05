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
                    <livewire:components.form.select-dropdown name="brand" :options="$brands" :required="true"
                        attributesForParentDiv="class=w-full"
                        jsCodeForChangeEvent="selectedBrandName = $event.target.options[$event.target.selectedIndex].text;" />
                    <livewire:components.form.select-dropdown name="series" :options="[]"
                        attributesForParentDiv="class=w-full" :selectDisableCondition="true" :conditionForLastOption="false" />
                    <livewire:components.form.select-dropdown name="category" :options="$categories" :required="true"
                        attributesForParentDiv="class=sm:col-span-2" />
                    <x-form.input name="quantity" label="Quantity" placeholder="Enter quantity" :required="true"
                        type="number" :inputAttributes="['min' => 1]" />
                    <x-form.input name="price" label="Price" placeholder="Enter price" :required="true"
                        type="number" :inputAttributes="['min' => 1]" />

                    <div class="sm:col-span-2">
                        <label for="description"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                        <textarea id="description" rows="8" name="description"
                            class="block p-2.5 w-full text-sm rounded-lg border focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:focus:ring-blue-500 dark:focus:border-blue-500 {{ $errors->has('description')
                                ? 'bg-red-50 border-red-500 text-red-900 placeholder-red-700 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500'
                                : 'bg-gray-50 border-gray-300 text-gray-900 dark:text-white dark:placeholder-gray-400 dark:border-gray-600' }}"
                            placeholder="Product description here">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="sm:col-span-2">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            for="files">Upload multiple files</label>
                        <input
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                            id="files" type="file" name="files[]" multiple>
                    </div>

                </div>
                <button type="submit"
                    class="text-white text-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm tracking-wide px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 mt-6">
                    Add product
                </button>
            </form>
        </div>
    </section>
</div>
