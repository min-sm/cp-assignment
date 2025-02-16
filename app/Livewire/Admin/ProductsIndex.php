<?php

namespace App\Livewire\Admin;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Barryvdh\Debugbar\Facades\Debugbar;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class ProductsIndex extends Component
{
    use WithPagination;

    public $viewMode = 'table'; // Default to table view

    #[Layout('admin.layouts.default')]
    public function render()
    {
        $categories = Category::all();
        $brands = Brand::all();
        $products = Product::with(['images', 'category', 'series.brand'])->paginate(12);

        Debugbar::info($products);
        return view('admin.products.index', compact('products', 'categories', 'brands'));
    }

    public function setViewMode($mode)
    {
        $this->viewMode = $mode;
    }
}
