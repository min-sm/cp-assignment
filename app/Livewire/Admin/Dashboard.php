<?php

namespace App\Livewire\Admin;

use App\Models\OrderItem;
use Asantibanez\LivewireCharts\Facades\LivewireCharts;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Dashboard extends Component
{
    #[Layout('admin.layouts.default')]
    public function render()
    {
        $mostSoldProducts = OrderItem::select('product_id', DB::raw('SUM(quantity) as total_quantity'))
            ->groupBy('product_id')
            ->orderByDesc('total_quantity')
            ->with('product') // Assuming you have a relationship defined in OrderItem model
            ->limit(10) // Limit to top 10 most sold products
            ->get();

        // Initialize the column chart model
        $columnChartModel = LivewireCharts::columnChartModel()->setTitle('Most Sold Products');

        // Color palette options - choose one approach
        $colorPalette = [
            '#f6ad55', // Orange
            '#fc8181', // Red
            '#90cdf4', // Blue
            '#68d391', // Green
            '#f687b3', // Pink
            '#9ae6b4', // Light green
            '#e9d8fd', // Lavender
            '#fbb6ce', // Light pink
            '#c3dafe', // Light blue
            '#faf089'  // Yellow
        ];

        // Add each product to the chart
        foreach ($mostSoldProducts as $index => $item) {
            $columnChartModel->addColumn(
                $item->product->model, // Product name
                $item->total_quantity, // Quantity sold
                $colorPalette[$index % count($colorPalette)] // Cycle through color palette
            );
        }

        // Get most sold categories data (your existing query)
        $mostSoldCategories = OrderItem::select('categories.name as category_name', DB::raw('SUM(order_items.quantity) as total_quantity'))
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->groupBy('categories.name')
            ->orderByDesc('total_quantity')
            ->get();

        // Initialize the pie chart model
        $pieChartModel = LivewireCharts::pieChartModel()
            ->setTitle('Most Sold Categories')
            ->setAnimated(true)
            ->setType('donut')
            ->legendPositionBottom()
            ->legendHorizontallyAlignedCenter()
            ->setDataLabelsEnabled(true)
            ->setOpacity(1);

        // Color palette for categories
        $categoryColors = [
            '#b01a1b', // Red
            '#2563eb', // Blue
            '#16a34a', // Green
            '#9333ea', // Purple
            '#f97316', // Orange
            '#eab308', // Yellow
            '#14b8a6', // Teal
            '#ec4899', // Pink
            '#8b5cf6', // Indigo
            '#64748b', // Slate
            '#d41b2c', // Dark Red
            '#3b82f6', // Light Blue
            '#22c55e', // Light Green
            '#a855f7', // Light Purple
            '#f59e0b', // Dark Orange
            '#10b981'  // Emerald
        ];

        // Add each category to the chart
        foreach ($mostSoldCategories as $index => $category) {
            $pieChartModel->addSlice(
                $category->category_name,         // Category name
                $category->total_quantity,        // Total quantity sold
                $colorPalette[$index % count($colorPalette)] // Cycle through color palette
            );
        }

        return view('admin.pages.dashboard', [
            'columnChartModel' => $columnChartModel,
            'pieChartModel' => $pieChartModel
        ]);
    }
}
