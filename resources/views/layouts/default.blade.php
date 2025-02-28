<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="{{ asset('img/common/logo.png') }}" />
    <title>@yield('title')</title>
    @yield('head-extras')
    {{-- Load TailwindCSS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="flex flex-col min-h-screen">
    <div class="flex flex-col flex-grow">
        <header>
            {{-- @include('includes.header') --}}
            @livewire('layout.header')
        </header>
        <main class="flex-grow @yield('mainClass') dark:bg-[#0f1515]">
            @yield('content')
        </main>
        <footer class="bg-white shadow dark:bg-gray-900">
            @include('includes.footer')
        </footer>
    </div>
    @livewireScripts
</body>

</html>
