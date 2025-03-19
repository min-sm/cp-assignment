<div>
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Orders
    </h2>
    @if (session('success'))
        <x-alert type="success" message="{{ session('success') }}" />
    @endif
    @if (session('error'))
        <x-alert type="error" message="{{ session('error') }}" />
    @endif
    {{-- @dd($orders[0]->orderItems); --}}
    <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
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
                @forelse ($orders as $i => $order)
                    @php
                        $itemCount = count($order->orderItems);
                    @endphp
                    @foreach ($order->orderItems as $index => $item)
                        <tr>
                            @if ($index === 0)
                                <td class="px-4 py-2 border-b text-right" rowspan="{{ $itemCount }}">
                                    {{ ($orders->currentPage() - 1) * $orders->perPage() + $i + 1 }}.</td>
                                <td class="px-4 py-2 border-b text-right" rowspan="{{ $itemCount }}">
                                    {{ $order->id }}</td>
                                <td class="px-4 py-2 border-b text-center" rowspan="{{ $itemCount }}">
                                    <div class="flex flex-col items-start space-y-2">
                                        @php
                                            $statusClasses = [
                                                'pending' => [
                                                    'input' =>
                                                        'text-blue-600 focus:ring-blue-500 dark:focus:ring-blue-600',
                                                    'label' =>
                                                        'bg-blue-200 text-blue-800 dark:bg-blue-900 dark:text-blue-300',
                                                ],
                                                'completed' => [
                                                    'input' =>
                                                        'text-green-600 focus:ring-green-500 dark:focus:ring-green-600',
                                                    'label' =>
                                                        'bg-green-200 text-green-800 dark:bg-green-900 dark:text-green-300',
                                                ],
                                                'shipped' => [
                                                    'input' =>
                                                        'text-yellow-600 focus:ring-yellow-500 dark:focus:ring-yellow-600',
                                                    'label' =>
                                                        'bg-yellow-200 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300',
                                                ],
                                            ];
                                        @endphp

                                        @foreach (['pending', 'completed', 'shipped'] as $status)
                                            <div class="flex items-center">
                                                <input type="radio"
                                                    id="status-{{ $order->id }}-{{ $status }}"
                                                    name="status-{{ $order->id }}" value="{{ $status }}"
                                                    wire:change="updateOrderStatus({{ $order->id }}, '{{ $status }}')"
                                                    class="w-4 h-4 bg-gray-100 border-gray-300 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 {{ $statusClasses[$status]['input'] }}"
                                                    {{ $order->status === $status ? 'checked' : '' }}>
                                                <label for="status-{{ $order->id }}-{{ $status }}"
                                                    class="ms-2 text-sm font-medium rounded-full px-3 py-1 {{ $statusClasses[$status]['label'] }}">
                                                    {{ ucfirst($status) }}
                                                </label>
                                            </div>
                                        @endforeach

                                        {{-- @if (!array_key_exists($order->status, $statusColors))
                                            <div class="flex items-center">
                                                <input type="radio"
                                                    id="status-{{ $order->id }}-{{ $order->status }}"
                                                    name="status-{{ $order->id }}" value="{{ $order->status }}"
                                                    class="w-4 h-4 text-gray-600 bg-gray-100 border-gray-300 focus:ring-gray-500 dark:focus:ring-gray-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                                    checked>
                                                <label for="status-{{ $order->id }}-{{ $order->status }}"
                                                    class="ms-2 text-sm font-medium rounded-full px-3 py-1 bg-gray-200 text-gray-800 dark:bg-gray-700 dark:text-gray-300">
                                                    {{ ucfirst($order->status) }}
                                                </label>
                                            </div>
                                        @endif --}}
                                    </div>
                                </td>
                            @endif
                            <td class="border-b relative h-24">
                                <img src="{{ $item->product->images->first() ? Storage::url($item->product->images->first()->image_path) : asset('img/common/img-unavailable.jpg') }}"
                                    alt="{{ $item->product->model }}"
                                    class="absolute top-0 left-0 w-full h-full object-cover">
                            </td>
                            <td class="px-4 py-2 text-center border-b"><a
                                    href="{{ route('product.show', ['slug' => $item->product->slug]) }}"
                                    class="hover:text-blue-600">{{ $item->product->model }}</a>
                            </td>
                            <td class="px-4 py-2 border-b text-right">{{ $item->quantity }}</td>
                            <td class="px-4 py-2 border-b text-right">
                                ${{ number_format($item->quantity * $item->price, 2) }}</td>
                            <!-- Subtotal -->
                            @if ($index === 0)
                                <td class="px-4 py-2 border-b text-right" rowspan="{{ $itemCount }}">
                                    ${{ number_format($order->total_amount, 2) }}</td>
                                <td class="px-4 py-2 border-b text-center" rowspan="{{ $itemCount }}">
                                    {{ $order->payment_method }}</td>
                                <td class="px-4 py-2 border-b text-right" rowspan="{{ $itemCount }}">
                                    {{ $order->created_at->diffForHumans() }}</td>
                            @endif
                        </tr>
                    @endforeach
                @empty
                    <tr>
                        <td colspan="10" class="px-4 py-2 border-b text-center">No orders found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="flex justify-center items-center">
            {{ $orders->links('vendor.livewire.flowbite') }}
        </div>
    </div>
</div>
