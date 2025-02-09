@extends('layouts.default')

@section('title', 'About Us')

@section('content')

    <div class="max-w-screen-xl mx-auto p-4">
        <div class="grid grid-cols-3 grid-rows-4 gap-5 bg-slate-500">
            <div class="col-span-2 row-span-2 bg-slate-200 rounded">
                <img src="{{ asset('img/about/laptops.jpg') }}" alt="Laptops" class="h-full object-cover">
            </div>
            <div class="col-start-3 bg-slate-200 rounded">
                <img src="{{ asset('img/about/adapters.jpg') }}" alt="Adapters">
            </div>
            <div class="row-span-3 col-start-3 row-start-2 bg-slate-200 rounded">
                <img src="{{ asset('img/about/screens.jpg') }}" alt="Screens" class="h-full object-cover">
            </div>
            <div class="row-span-2 row-start-3 bg-slate-200 rounded">
                <img src="{{ asset('img/about/batteries.jpg') }}" alt="Batteries">
            </div>
            <div class="row-start-3 bg-slate-200 rounded">
                <img src="{{ asset('img/about/keyboards.jpg') }}" alt="Keyboards" class="h-full object-cover">
            </div>
            <div class="col-start-2 row-start-4 bg-slate-200 rounded">
                <img src="{{ asset('img/about/mice.jpg') }}" alt="Mice" class="h-full object-cover">
            </div>
        </div>
    </div>


@endsection
