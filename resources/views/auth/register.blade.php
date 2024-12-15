<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    {{-- Load TailwindCSS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- AlpineJS --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="grid place-items-center h-screen bg-gray-100">
    <div
        class="block max-w-sm w-full p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <form class="max-w-sm mx-auto" action="/register" method="POST">
            @csrf

            <x-form.input name="name" label="Your name" placeholder="John Doe" :required="true" />

            <x-form.input name="email" type="email" label="Your email" placeholder="john@doe.com"
                :required="true" />

            <x-form.password name="password" label="Your password" />

            <x-form.password name="confirm-password" label="Confirm password" />

            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Submit
            </button>
        </form>
    </div>
</body>

</html>
