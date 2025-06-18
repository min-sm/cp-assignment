@extends('store.layouts.default')

@section('title', 'History')

@section('content')
    <div class="max-w-screen-xl p-4 mx-auto mb-2">
        <p class="text-3xl font-semibold text-gray-900 dark:text-white">Order History</p>

        @if (session('success'))
            <x-alert type="success" message="{{ session('success') }}" />
        @endif

        <div class="mt-4 overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border-b w-0.5">No</th>
                        <th class="px-4 py-2 border-b">Order ID</th>
                        <th class="px-4 py-2 border-b">Status</th>
                        <th class="px-4 py-2 border-b">Image</th>
                        <th class="px-4 py-2 border-b">Item</th>
                        <th class="px-4 py-2 border-b">Qty</th>
                        <th class="px-4 py-2 border-b">Subtotal</th>
                        <th class="px-4 py-2 border-b">Total Cost</th>
                        <th class="px-4 py-2 border-b">Payment Method</th>
                        <th class="px-4 py-2 border-b">Order Date</th>
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
                                    <td class="px-4 py-2 text-right border-b" rowspan="{{ $itemCount }}">
                                        {{ $orderIndex }}</td>
                                    <td class="px-4 py-2 text-right border-b" rowspan="{{ $itemCount }}">
                                        {{ $order->id }}</td>
                                    <td class="px-4 py-2 text-center border-b" rowspan="{{ $itemCount }}">
                                        @if ($order->status === 'pending')
                                            <span
                                                class="px-3 py-1 text-sm font-medium text-blue-800 bg-blue-200 rounded-full me-2 dark:bg-blue-900 dark:text-blue-300">
                                                Pending
                                            </span>
                                        @elseif($order->status === 'completed')
                                            <span
                                                class="px-3 py-1 text-sm font-medium text-green-800 bg-green-200 rounded-full me-2 dark:bg-green-900 dark:text-green-300">
                                                Completed
                                            </span>
                                        @elseif($order->status === 'shipped')
                                            <span
                                                class="px-3 py-1 text-sm font-medium text-yellow-800 bg-yellow-200 rounded-full me-2 dark:bg-yellow-900 dark:text-yellow-300">
                                                Shipped
                                            </span>
                                        @else
                                            <span
                                                class="px-3 py-1 text-sm font-medium text-gray-800 bg-gray-200 rounded-full me-2 dark:bg-gray-700 dark:text-gray-300">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        @endif
                                    </td>
                                @endif
                                <td class="relative h-24 border-b">
                                    <img src="{{ $item->product->images->first() ? Storage::url($item->product->images->first()->image_path) : asset('img/common/img-unavailable.jpg') }}"
                                        alt="{{ $item->product->model }}"
                                        class="absolute top-0 left-0 object-cover w-full h-full">
                                </td>
                                <td class="px-4 py-2 text-center border-b"><a
                                        href="{{ route('product.show', ['slug' => $item->product->slug]) }}"
                                        class="hover:text-blue-600">{{ $item->product->model }}</a>
                                </td>
                                <td class="px-4 py-2 text-right border-b">{{ $item->quantity }}</td>
                                <td class="px-4 py-2 text-right border-b">
                                    ${{ number_format($item->quantity * $item->price, 2) }}</td>
                                <!-- Subtotal -->
                                @if ($index === 0)
                                    <td class="px-4 py-2 text-right border-b" rowspan="{{ $itemCount }}">
                                        ${{ number_format($order->total_amount, 2) }}</td>
                                    <td class="px-4 py-2 text-center border-b" rowspan="{{ $itemCount }}">
                                        {{ $order->payment_method }}</td>
                                    <td class="px-4 py-2 text-right border-b" rowspan="{{ $itemCount }}">
                                        {{ $order->created_at->diffForHumans() }}</td>
                                @endif
                            </tr>
                        @endforeach
                        @php
                            $orderIndex++; // Increment the order index for the next order
                        @endphp
                    @empty
                        <tr>
                            <td colspan="10" class="px-4 py-2 text-center border-b">No orders found.</td>
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
