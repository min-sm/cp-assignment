@extends('layouts.default')

@section('title', 'Products')

@section('content')
    @livewire('products-index', ['filters' => $request])
@endsection
