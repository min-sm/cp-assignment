@extends('layouts.auth')

@section('title', 'Register')

@section('content')

    <div
        class="block max-w-sm w-full p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <img src="{{ asset('img/common/logo.png') }}" alt="logo" class="w-32 mx-auto mb-4 rounded-md shadow-sm">
        <p class="text-lg font-semibold text-center text-gray-700 dark:text-gray-300 mb-8">
            Welcome
        </p>
        <form class="max-w-sm mx-auto" action="/register" method="POST">
            @csrf

            <x-form.input name="name" label="Your name" placeholder="John Doe" :required="true" />

            <x-form.input name="email" type="email" label="Your email" placeholder="john@doe.com" :required="true" />

            <x-form.password name="password" label="Your password" />

            <x-form.password name="confirm-password" label="Confirm password" />

            <div class="flex items-center justify-center my-4">
                <div class="h-px bg-gray-300 flex-grow"></div>
                <span class="px-4 text-gray-500">or</span>
                <div class="h-px bg-gray-300 flex-grow"></div>
            </div>

            <x-auth.social-auth-buttons title="Register using social networks" />

            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Submit
            </button>
        </form>

        <div class="text-sm text-center text-gray-600 dark:text-gray-400 mt-4 ">
            <p class="mb-2">
                Already have an account? <a href="{{ route('login') }}"
                    class="text-blue-600 hover:underline dark:text-blue-400">Login</a>
            </p>
            <a href="{{ route('home') }}" class="hover:underline hover:text-blue-600 dark:hover:text-blue-400">Continue
                as guest</a>
        </div>
    </div>

@endsection
