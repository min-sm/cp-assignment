@extends('admin.layouts.default')

@section('title', 'Create new admin')

@section('content')

    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Create new admin
    </h2>
    @if (session('success'))
        <x-alert type="success" message="{{ session('success') }}" />
    @endif
    @if (session('error'))
        <x-alert type="error" message="{{ session('error') }}" />
    @endif

    <form method="POST" action="{{ route('admin.store') }}" class="max-w-xs mx-auto space-y-5">
        @csrf
        <x-form.input name="name" label="Name" placeholder="Full name" :required="true" />
        <x-form.input name="email" label="Email" placeholder="Enter email address" type="email" :required="true" />
        <x-form.input name="phone_number" label="Phone number" placeholder="Enter phone number" type="tel" />
        <x-form.input name="address" label="Address" placeholder="Enter your address here" element="textarea" />
        <x-form.password name="password" label="Your password" />
        <x-form.password name="confirm-password" label="Confirm password" />
        <button type="submit"
            class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm py-2.5">Create</button>
    </form>


@endsection
