<div>
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Dashboard
    </h2>
    <div>
        <div class="grid grid-cols-4 gap-4">
            <div class="rounded py-2 px-2 space-y-4 bg-gradient-to-r from-amber-200 to-yellow-400">
                <p class="text-4xl font-medium">{{ $customerCount }}</p>
                <p>customers</p>
            </div>
            <div class="rounded py-2 px-2 space-y-4 bg-teal-300">
                <p class="text-4xl font-medium">$5000</p>
                <p>Total Sales</p>
            </div>
            <div class="rounded py-2 px-2 space-y-4 bg-pink-300">
                <p class="text-4xl font-medium">$5000</p>
                <p>Total Sales</p>
            </div>
            <div class="rounded py-2 px-2 space-y-4 bg-sky-300">
                <p class="text-4xl font-medium">$5000</p>
                <p>Total Sales</p>
            </div>
        </div>
    </div>
    <div class="h-96 my-4">
        <livewire:livewire-column-chart key="{{ $columnChartModel->reactiveKey() }}" :column-chart-model="$columnChartModel" />
    </div>

    <div class="grid grid-cols-2 gap-2 my-4">
        <div class="h-96"> {{-- make these to look like cards or something --}}
            <livewire:livewire-pie-chart key="{{ $pieChartModel->reactiveKey() }}" :pie-chart-model="$pieChartModel" />
        </div>
        <div class="h-96">
            <livewire:livewire-pie-chart key="{{ $pieChartModel->reactiveKey() }}" :pie-chart-model="$pieChartModel" />
        </div>
    </div>
</div>
