<?php

namespace App\Livewire;

use App\Models\Product;
use Barryvdh\Debugbar\Facades\Debugbar;
use Livewire\Component;
use Livewire\WithPagination;

class ProductsIndex extends Component
{
    use WithPagination;

    public $search = '';

    public function searchProducts()
    {
        $this->resetPage();
    }

    public function render()
    {
        $products = Product::with(['images', 'category', 'series.brand'])
            ->when($this->search, function ($query) {
                $query->where('model', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%');
            })
            ->paginate(16);
        Debugbar::info($products->items());
        return view('livewire.products-index', compact('products'));
    }
}
