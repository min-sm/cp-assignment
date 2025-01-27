@extends('layouts.default')

@section('title', 'Products')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-6">Order History</h1>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border-b">Order ID</th>
                        <th class="px-4 py-2 border-b">Status</th>
                        <th class="px-4 py-2 border-b">Items</th>
                        <th class="px-4 py-2 border-b">Subtotal</th>
                        <th class="px-4 py-2 border-b">Total Cost</th>
                        <th class="px-4 py-2 border-b">Payment Method</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                        <tr>
                            <td class="px-4 py-2 border-b text-center">{{ $order->id }}</td>
                            <td class="px-4 py-2 border-b text-center">{{ ucfirst($order->status) }}</td>
                            <td class="px-4 py-2 border-b">
                                <ul>
                                    @foreach ($order->orderItems as $item)
                                        <li class="flex items-center space-x-4">
                                            <img src="{{ $item->product->images->first() ? asset('img/products/' . $item->product->slug . '/' . $item->product->images->first()->filename) : asset('img/common/img-unavailable.jpg') }}"
                                                alt="{{ $item->product->name }}" class="w-12 h-12 object-cover">
                                            <div>
                                                <p>{{ $item->product->name }}</p>
                                                <p class="text-sm text-gray-500">Quantity: {{ $item->quantity }}</p>
                                                <p class="text-sm text-gray-500">${{ $item->price }}</p>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                            <td class="px-4 py-2 border-b text-center">
                                <ul>
                                    @foreach ($order->orderItems as $item)
                                        <li class="flex items-center space-x-4">
                                            <span class="text-sm text-gray-500">
                                                {{ $item->quantity * $item->price }}
                                            </span>
                                        </li>
                                    @endforeach
                                </ul>
                                {{-- ${{ $order->orderItems->sum(fn($item) => $item->price * $item->quantity) }} --}}
                            </td>
                            <td class="px-4 py-2 border-b text-center">${{ $order->total_amount }}</td>
                            <td class="px-4 py-2 border-b text-center">{{ ucfirst($order->payment_method) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-2 border-b text-center">No orders found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination Links -->
        <div class="mt-6">
            {{ $orders->links() }}
        </div>
    </div>

@endsection
