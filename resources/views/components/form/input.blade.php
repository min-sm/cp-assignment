@props([
    'name',
    'label',
    'type' => 'text',
    'placeholder' => '',
    'required' => false,
    'value' => '',
    'inputAttributes' => [],
    'element' => 'input',
    'inputClass' => '',
    'rows' => 8,
])

<div {{ $attributes }}>
    <label for="{{ preg_replace('/\[\]$/', '', $name) }}"
        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
        {{ $label }}
    </label>

    @if ($element === 'input')
        @php
            if ($type === 'file') {
                $defaultClass =
                    'block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400';
            } else {
                $defaultClass =
                    'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500';
            }
            $errorClass = $errors->has($name)
                ? 'bg-red-50 border-red-500 text-red-900 placeholder-red-700 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500'
                : '';
        @endphp
        <input type="{{ $type }}" id="{{ preg_replace('/\[\]$/', '', $name) }}" name="{{ $name }}"
            value="{{ old($name, $value) }}" placeholder="{{ $placeholder }}" {{ $required ? 'required' : '' }}
            @foreach ($inputAttributes as $attribute => $value)
                {{ $attribute }}="{{ $value }}" @endforeach
            class="{{ $defaultClass }} {{ $errorClass }} {{ $inputClass }}" />
    @elseif($element === 'textarea')
        @php
            $defaultClass =
                'block p-2.5 w-full text-sm rounded-lg border focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:focus:ring-blue-500 dark:focus:border-blue-500 bg-gray-50 border-gray-300 text-gray-900 dark:text-white dark:placeholder-gray-400 dark:border-gray-600';
            $errorClass = $errors->has($name)
                ? 'bg-red-50 border-red-500 text-red-900 placeholder-red-700 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500'
                : '';
        @endphp
        <textarea id="{{ $name }}" name="{{ $name }}" rows="{{ $rows }}"
            placeholder="{{ $placeholder }}" {{ $required ? 'required' : '' }}
            @foreach ($inputAttributes as $attribute => $value)
                {{ $attribute }}="{{ $value }}" @endforeach
            class="{{ $defaultClass }} {{ $errorClass }} {{ $inputClass }}">{{ old($name, $value) }}</textarea>
    @endif

    @error($name)
        <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
    @enderror
</div>
