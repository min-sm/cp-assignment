@extends('layouts.default')

@section('title', 'Products')

@section('content')
    <div class="max-w-screen-xl mx-auto p-4">
        <p class="text-3xl font-semibold text-gray-900 dark:text-white">Order History</p>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto mt-4">
            <table class="min-w-full bg-white border border-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border-b">No</th> <!-- New Column: No (Order Index) -->
                        <th class="px-4 py-2 border-b">Order ID</th>
                        <th class="px-4 py-2 border-b">Status</th>
                        <th class="px-4 py-2 border-b">Image</th>
                        <th class="px-4 py-2 border-b">Item</th>
                        <th class="px-4 py-2 border-b">Qty</th>
                        <th class="px-4 py-2 border-b">Subtotal</th>
                        <th class="px-4 py-2 border-b">Total Cost</th>
                        <th class="px-4 py-2 border-b">Payment Method</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $orderIndex = 1; // Initialize the order index counter
                    @endphp
                    @forelse ($orders as $order)
                        @php
                            $itemCount = count($order->orderItems);
                        @endphp
                        @foreach ($order->orderItems as $index => $item)
                            <tr>
                                @if ($index === 0)
                                    <td class="px-4 py-2 border-b text-center" rowspan="{{ $itemCount }}">
                                        {{ $orderIndex }}</td> <!-- Order Index -->
                                    <td class="px-4 py-2 border-b text-center" rowspan="{{ $itemCount }}">
                                        {{ $order->id }}</td>
                                    <td class="px-4 py-2 border-b text-center" rowspan="{{ $itemCount }}">
                                        {{ ucfirst($order->status) }}</td>
                                @endif
                                <td class="border-b relative h-24">
                                    <img src="{{ $item->product->images->first() ? asset('img/products/' . $item->product->slug . '/' . $item->product->images->first()->filename) : asset('img/common/img-unavailable.jpg') }}"
                                        alt="{{ $item->product->name }}"
                                        class="absolute top-0 left-0 w-full h-full object-cover">
                                </td> <!-- New Column: Image -->
                                <td class="px-4 py-2 border-b">{{ $item->product->model }}</td> <!-- Item Name -->
                                <td class="px-4 py-2 border-b text-center">{{ $item->quantity }}</td>
                                <!-- New Column: Qty -->
                                <td class="px-4 py-2 border-b text-center">${{ $item->quantity * $item->price }}</td>
                                <!-- Subtotal -->
                                @if ($index === 0)
                                    <td class="px-4 py-2 border-b text-center" rowspan="{{ $itemCount }}">
                                        ${{ $order->total_amount }}</td>
                                    <td class="px-4 py-2 border-b text-center" rowspan="{{ $itemCount }}">
                                        {{ ucfirst($order->payment_method) }}</td>
                                @endif
                            </tr>
                        @endforeach
                        @php
                            $orderIndex++; // Increment the order index for the next order
                        @endphp
                    @empty
                        <tr>
                            <td colspan="9" class="px-4 py-2 border-b text-center">No orders found.</td>
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
