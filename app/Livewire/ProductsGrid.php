<?php

namespace App\Livewire;

use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Component;
use Livewire\WithPagination;

class ProductsGrid extends Component
{
    use WithPagination;

    public $products; // Array of product items
    public $pass;
    public $pagination; // Array of pagination data
    
    public function mount($products)
    {
        $this->products = $products;
    }

    public function render()
    {
        return view('livewire.products-grid', [
            'products' => $this->products,
        ]);
    }
}
