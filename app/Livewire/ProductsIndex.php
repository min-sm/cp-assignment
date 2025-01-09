<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class ProductsIndex extends Component
{
    public function render()
    {
        $products = Product::paginate(16);
        return view('livewire.products-index', compact('products'));
    }
}
