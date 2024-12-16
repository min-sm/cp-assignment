@extends('layouts.auth')

@section('title', 'Register')

@section('content')

    <div
        class="block max-w-sm w-full p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <img src="{{ asset('img/logo.png') }}" alt="logo" class="w-32 mx-auto mb-4 rounded-md shadow-sm">
        <p class="text-lg font-semibold text-center text-gray-700 dark:text-gray-300 mb-8">
            Log in
        </p>
        <form class="max-w-sm mx-auto" action="/login" method="POST">
            @csrf

            <x-form.input name="email" type="email" label="Your email" placeholder="john@doe.com" :required="true" />

            <x-form.password name="password" label="Your password" />

            <div class="flex items-start mb-5">
                <div class="flex items-center h-5">
                    <input id="remember" type="checkbox" value="" name="remember"
                        class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800" />
                </div>
                <label for="remember" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Remember me</label>
            </div>

            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Submit
            </button>
        </form>

        <p class="text-sm text-center text-gray-600 dark:text-gray-400 mt-4">
            Don't have an account? <a href="{{ route('register') }}"
                class="text-blue-600 hover:underline dark:text-blue-400">Register</a>
        </p>
    </div>

@endsection
