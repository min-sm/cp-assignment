<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="{{ asset('img/common/logo.png') }}" />
    <title>
        @if (View::hasSection('title'))
            @yield('title')
        @elseif(isset($title))
            {{ $title }}
        @endif
    </title>
    @if (View::hasSection('head-extras'))
        @yield('head-extras')
    @endif
    {{-- Load TailwindCSS --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/focus@3.x.x/dist/cdn.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="flex flex-col min-h-screen">
    <div class="flex flex-col flex-grow">
        <header>
            @livewire('layout.header')
        </header>
        <main class="flex-grow @if (View::hasSection('mainClass')) @yield('mainClass') @endif dark:bg-[#0f1515]">
            @if (View::hasSection('content'))
                @yield('content')
            @else
                {{ $slot }}
            @endif
        </main>
        <footer class="bg-white shadow dark:bg-gray-900">
            @include('includes.footer')
        </footer>
    </div>
    @livewireScripts
</body>

</html>
