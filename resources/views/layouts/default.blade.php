<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>@yield('title')</title>
    @include('includes.head')
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
