<div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md">
    <!-- Dashboard Header with better spacing and emphasis -->
    <div class="flex justify-between items-center mb-8">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
            Dashboard
        </h2>
        <div class="text-sm text-gray-500 dark:text-gray-400">
            Last updated: {{ now()->format('M d, Y h:i A') }}
        </div>
    </div>

    <!-- Stats Cards with improved styling and readability -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Customers Card -->
        <div class="rounded-lg overflow-hidden shadow-sm">
            <div class="p-4 bg-gradient-to-r from-amber-200 to-yellow-400">
                <p class="text-4xl font-bold text-gray-800">{{ $customerCount }}</p>
                <p class="text-gray-700 font-medium mt-2">{{ Str::plural('Customer', $customerCount) }}</p>
            </div>
            <div class="bg-white dark:bg-gray-700 p-3">
                <div class="flex items-center text-sm">
                    <svg class="h-4 w-4 text-gray-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">
                        </path>
                    </svg>
                    <span class="dark:text-gray-200">Total Registered</span>
                </div>
            </div>
        </div>

        <!-- Sales Card -->
        <div class="rounded-lg overflow-hidden shadow-sm">
            <div class="p-4 bg-gradient-to-r from-blue-200 to-cyan-200">
                <p class="text-4xl font-bold text-gray-800">${{ $completedOrdersTotalAmount }}</p>
                <p class="text-gray-700 font-medium mt-2">Total Sales</p>
            </div>
            <div class="bg-white dark:bg-gray-700 p-3">
                <div class="flex items-center text-sm">
                    <svg class="h-4 w-4 text-gray-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span class="dark:text-gray-200">Completed Orders</span>
                </div>
            </div>
        </div>

        <!-- Pending Orders Card -->
        <div class="rounded-lg overflow-hidden shadow-sm">
            <div class="p-4 bg-gradient-to-r from-violet-200 to-pink-200">
                <p class="text-4xl font-bold text-gray-800">{{ $pendingOrdersCount }}</p>
                <p class="text-gray-700 font-medium mt-2">{{ Str::plural('Pending Order', $pendingOrdersCount) }}</p>
            </div>
            <div class="bg-white dark:bg-gray-700 p-3">
                <div class="flex items-center text-sm">
                    <svg class="h-4 w-4 text-gray-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 2a8 8 0 100 16 8 8 0 000-16zm0 14a6 6 0 110-12 6 6 0 010 12zm-1-5a1 1 0 011-1h2a1 1 0 110 2h-2a1 1 0 01-1-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span class="dark:text-gray-200">Awaiting Processing</span>
                </div>
            </div>
        </div>

        <!-- Shipped Orders Card -->
        <div class="rounded-lg overflow-hidden shadow-sm">
            <div class="p-4 bg-gradient-to-r from-lime-400 to-lime-500">
                <p class="text-4xl font-bold text-gray-800">{{ $shippedOrdersCount }}</p>
                <p class="text-gray-700 font-medium mt-2">{{ Str::plural('Shipped Order', $shippedOrdersCount) }}</p>
            </div>
            <div class="bg-white dark:bg-gray-700 p-3">
                <div class="flex items-center text-sm">
                    <svg class="h-4 w-4 text-gray-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z">
                        </path>
                        <path
                            d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1v-5h2v5a1 1 0 001 1h.05a2.5 2.5 0 014.9 0H19a1 1 0 001-1V9a.5.5 0 00-.5-.5H18V5a1 1 0 00-1-1H3z">
                        </path>
                    </svg>
                    <span class="dark:text-gray-200">In Transit</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Chart with proper card styling -->
    <div class="bg-white dark:bg-gray-700 rounded-lg shadow-sm p-4 mb-8">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Sales Performance</h3>
            {{-- <div class="flex space-x-2">
                <button
                    class="px-3 py-1 text-xs bg-gray-200 dark:bg-gray-600 rounded-md dark:text-gray-200">Weekly</button>
                <button class="px-3 py-1 text-xs bg-blue-500 text-white rounded-md">Monthly</button>
                <button
                    class="px-3 py-1 text-xs bg-gray-200 dark:bg-gray-600 rounded-md dark:text-gray-200">Yearly</button>
            </div> --}}
        </div>
        <div class="h-80">
            <livewire:livewire-column-chart key="{{ $columnChartModel->reactiveKey() }}" :column-chart-model="$columnChartModel" />
        </div>
    </div>

    <!-- Two Chart Section with card styling -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Pie Chart Card -->
        <div class="bg-white dark:bg-gray-700 rounded-lg shadow-sm p-4">
            <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-4">Order Distribution</h3>
            <div class="h-80">
                <livewire:livewire-pie-chart key="{{ $pieChartModel->reactiveKey() }}" :pie-chart-model="$pieChartModel" />
            </div>
        </div>

        <!-- Low Stock Chart Card -->
        <div class="bg-white dark:bg-gray-700 rounded-lg shadow-sm p-4">
            <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-4">Inventory Alert</h3>
            <div class="h-80">
                <livewire:livewire-column-chart key="{{ $lowStockChart->reactiveKey() }}" :column-chart-model="$lowStockChart" />
            </div>
        </div>
    </div>
</div>
