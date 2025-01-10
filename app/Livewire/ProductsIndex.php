<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ProductsIndex extends Component
{
    use WithPagination;

    public function render()
    {
        $products = Product::paginate(16);
        return view('livewire.products-index', compact('products'));
    }
}
