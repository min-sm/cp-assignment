<?php

namespace App\Livewire\Admin;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Asantibanez\LivewireCharts\Facades\LivewireCharts;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;
use Asantibanez\LivewireCharts\Models\PieChartModel;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class Dashboard extends Component
{
    #[Layout('admin.layouts.default')]
    public function render()
    {
        $colorPalette = $this->getColorPalette();

        $columnChartModel = $this->getMostSoldProductsChart($colorPalette);
        $pieChartModel = $this->getMostSoldCategoriesChart($colorPalette);
        $lowStockChart = $this->getLowStockProductsChart($colorPalette);

        $customerCount = User::where('role', 'customers')->count();
        $completedOrdersTotalAmount = Order::where('status', 'completed')->sum('total_amount');
        $pendingOrdersCount = Order::where('status', 'pending')->count();
        $shippedOrdersCount = Order::where('status', 'shipped')->count();

        return view('admin.pages.dashboard', [
            'columnChartModel' => $columnChartModel,
            'pieChartModel' => $pieChartModel,
            'customerCount' => $customerCount,
            'completedOrdersTotalAmount' => $completedOrdersTotalAmount,
            'pendingOrdersCount' => $pendingOrdersCount,
            'lowStockChart' => $lowStockChart,
            'shippedOrdersCount' => $shippedOrdersCount,
        ]);
    }

    private function getColorPalette(): array
    {
        return [
            '#f6ad55', // Orange
            '#fc8181', // Red
            '#90cdf4', // Blue
            '#68d391', // Green
            '#f687b3', // Pink
            '#9ae6b4', // Light green
            '#e9d8fd', // Lavender
            '#fbb6ce', // Light pink
            '#c3dafe', // Light blue
            '#faf089',  // Yellow
        ];
    }

    private function getMostSoldProductsChart(array $colorPalette): ColumnChartModel
    {
        $mostSoldProducts = OrderItem::select('product_id', DB::raw('SUM(quantity) as total_quantity'))
            ->groupBy('product_id')
            ->orderByDesc('total_quantity')
            ->with('product')
            ->limit(10)
            ->get();

        $columnChartModel = LivewireCharts::columnChartModel()
            ->setTitle('10 Most Sold Products')
            ->setHorizontal();

        foreach ($mostSoldProducts as $index => $item) {
            $columnChartModel->addColumn(
                $item->product->model,
                $item->total_quantity,
                $colorPalette[$index % count($colorPalette)]
            );
        }

        return $columnChartModel;
    }

    private function getMostSoldCategoriesChart(array $colorPalette): PieChartModel
    {
        $mostSoldCategories = OrderItem::select('categories.name as category_name', DB::raw('SUM(order_items.quantity) as total_quantity'))
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->groupBy('categories.name')
            ->orderByDesc('total_quantity')
            ->get();

        $pieChartModel = LivewireCharts::pieChartModel()
            ->setTitle('Most Sold Categories')
            ->setAnimated(true)
            ->setType('donut')
            ->legendPositionBottom()
            ->legendHorizontallyAlignedCenter()
            ->setDataLabelsEnabled(true)
            ->setOpacity(1);

        foreach ($mostSoldCategories as $index => $category) {
            $pieChartModel->addSlice(
                $category->category_name,
                (int)$category->total_quantity,
                $colorPalette[$index % count($colorPalette)]
            );
        }

        return $pieChartModel;
    }

    private function getLowStockProductsChart(array $colorPalette): ColumnChartModel
    {
        $lowStockProducts = Product::orderBy('stock_quantity', 'asc')->limit(5)->get();

        $lowStockChart = LivewireCharts::columnChartModel()
            ->setTitle('Products that are low in stock');

        foreach ($lowStockProducts as $index => $product) {
            $lowStockChart->addColumn(
                $product->model,
                $product->stock_quantity,
                $colorPalette[$index % count($colorPalette)]
            );
        }

        return $lowStockChart;
    }
}
