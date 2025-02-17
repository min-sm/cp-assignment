@props(['name', 'label', 'type' => 'text', 'placeholder' => '', 'required' => false])

<div {{ $attributes }}>
    <label for="{{ $name }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
        {{ $label }}
    </label>
    <input type="{{ $type }}" id="{{ $name }}" name="{{ $name }}" value="{{ old($name) }}"
        placeholder="{{ $placeholder }}" {{ $required ? 'required' : '' }}
        {{ $attributes->merge([
            'class' =>
                'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                            focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5
                            dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                            dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 ' .
                ($errors->has($name)
                    ? 'bg-red-50 border-red-500 text-red-900
                            placeholder-red-700 dark:text-red-500 dark:placeholder-red-500
                            dark:border-red-500'
                    : ''),
        ]) }} />
    @error($name)
        <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
    @enderror
</div>
