<div {!! $attributesForParentDiv !!}>
    <label for="{{ $name }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
        {{ ucfirst($name) }}
    </label>
    <select id="{{ $name }}" name="{{ $name }}" wire:poll.30s.visible @disabled($selectDisableCondition)
        {{ $attributesForSelect }} wire:model.change="model"
        @change="if ($event.target.selectedIndex === $event.target.options.length - 1) { window.open('{{ route('test') }}'); $event.target.selectedIndex = 0; }; {{ $jsCodeForChangeEvent }} "
        class="bg-gray-50 border text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 {{ $errors->has($name) ? 'border-red-500 focus:ring-red-500 focus:border-red-500 bg-red-50 dark:border-red-500 dark:focus:ring-red-500 dark:focus:border-red-500 text-red-900 dark:text-red-50' : 'border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:border-gray-600 dark:focus:ring-blue-500 dark:focus:border-blue-500 text-gray-900 dark:text-white' }}"
        {{ $required ? 'required' : '' }}>
        <option>Select {{ $name }}</option>
        @foreach ($options as $option)
            <option value="{{ $option['id'] }}" {{ old($name) == $option['id'] ? 'selected' : '' }}>
                {{ ucfirst($option['name']) }}
            </option>
        @endforeach
        @if ($conditionForLastOption)
            <option class="text-white text-center bg-blue-700 tracking-wide cursor-pointer hover:bg-black">
                Create new {{ $name }}
            </option>
        @endif
    </select>
    @error($name)
        <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
    @enderror
</div>
