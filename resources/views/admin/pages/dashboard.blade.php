<div>
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Dashboard
    </h2>
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
