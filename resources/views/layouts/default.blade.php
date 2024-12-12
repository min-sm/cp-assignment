<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('head-extras')
    {{-- blade-formatter-disable --}}
    <style type="text/tailwindcss">
        .wrapper {
            @apply mx-auto p-4 max-w-screen-xl
        }
    </style>
    {{-- blade-formatter-enable --}}
    {{-- Load TailwindCSS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])


</head>

<body>
    <div>
        <header>
            @include('includes.header')
        </header>
        <div>
            @yield('content')
        </div>
        <footer>
            @include('includes.footer')
        </footer>
    </div>
</body>

</html>
