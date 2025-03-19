@extends('admin.layouts.default')

@section('title', 'Change password')

@section('content')

    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Change password
    </h2>
    @if (session('success'))
        <x-alert type="success" message="{{ session('success') }}" />
    @endif
    @if (session('error'))
        <x-alert type="error" message="{{ session('error') }}" />
    @endif
    <form method="POST" action="{{ route('admin.update', auth()->user()->id) }}" class="max-w-xs mx-auto space-y-5">
        @csrf
        @method('PUT')

        <x-form.password name="password" label="New password" :required="true" class="mb-5" />

        <x-form.password name="password_confirmation" label="Confirm password" :required="true" class="mb-5" />

        <button type="submit"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Submit
        </button>
    </form>

@endsection
