@extends('layouts.default')

@section('title', $product->model)

@section('content')
    <p>{{ $product->slug }}</p>
@endsection
