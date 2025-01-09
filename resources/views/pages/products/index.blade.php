@extends('layouts.default')

@section('title', 'Products')

@section('content')
    <x-products.grid :products="$products" />
    <div class="container">
        <h1>Products</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Model</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Stock Quantity</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->model }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->stock_quantity }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination Links -->
        {{ $products->links() }}
    </div>
@endsection
