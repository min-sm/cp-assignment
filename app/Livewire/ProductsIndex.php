<?php

namespace App\Livewire;

use App\Models\Product;
use Barryvdh\Debugbar\Facades\Debugbar;
use Livewire\Component;
use Livewire\WithPagination;

class ProductsIndex extends Component
{
    use WithPagination;

    public function render()
    {
        $products = Product::with('images')->paginate(16);
        Debugbar::info($products->items());
        return view('livewire.products-index', compact('products'));
    }
}
