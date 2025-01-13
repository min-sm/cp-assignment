<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Session;
use Livewire\Component;

class ProductCard extends Component
{
    public $product;

    public function setCategorySession($categoryId)
    {
        Session::flash('category_id', $categoryId);
        return redirect()->route('products');
    }

    // Set brand session
    public function setBrandSession($brandId)
    {
        Session::flash('brand_id', $brandId);
        return redirect()->route('products');
    }
    public function render()
    {
        return view('livewire.product-card');
    }
}
