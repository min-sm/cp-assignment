<?php

namespace App\Livewire\Admin;

use App\Models\OrderItem;
use App\Models\User;
use Asantibanez\LivewireCharts\Facades\LivewireCharts;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Dashboard extends Component
{
    #[Layout('admin.layouts.default')]
    public function render()
    {
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

        $mostSoldProducts = OrderItem::select('product_id', DB::raw('SUM(quantity) as total_quantity'))
            ->groupBy('product_id')
            ->orderByDesc('total_quantity')
            ->with('product') // Assuming you have a relationship defined in OrderItem model
            ->limit(10) // Limit to top 10 most sold products
            ->get();

        // Initialize the column chart model
        $columnChartModel = LivewireCharts::columnChartModel()->setTitle('10 Most Sold Products');

        // dd($mostSoldProducts[0]->product->model);
        // Add each product to the chart
        foreach ($mostSoldProducts as $index => $item) {
            $columnChartModel->addColumn(
                $item->product->model,
                $item->total_quantity,
                $colorPalette[$index % count($colorPalette)]
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
        $pieChartModel = LivewireCharts::pieChartModel()->setTitle('Most Sold Categories')
            ->setAnimated(true)
            ->setType('donut')
            ->legendPositionBottom()
            ->legendHorizontallyAlignedCenter()
            ->setDataLabelsEnabled(true)
            ->setOpacity(1);

        // dd($mostSoldCategories[0]->category_name);
        // Add each category to the chart
        foreach ($mostSoldCategories as $index => $category) {
            $pieChartModel->addSlice(
                $category->category_name,
                (int)$category->total_quantity,
                $colorPalette[$index % count($colorPalette)]
            );
        }
        // $test = $pieChartModel;
        // $pieChartModel = LivewireCharts::pieChartModel()
        // ->setTitle('Test Chart')
        // ->addSlice('Slice 1', 10, '#f6ad55')
        // ->addSlice('Slice 2', 20, '#fc8181')
        // ->addSlice('Slice 3', 30, '#90cdf4');
        // dd($test, $pieChartModel);

        $customerCount = User::where('role', 'customers')->count();

        return view('admin.pages.dashboard', [
            'columnChartModel' => $columnChartModel,
            'pieChartModel' => $pieChartModel,
            'customerCount' => $customerCount,
        ]);
    }
}
