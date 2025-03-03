<?php

namespace App\Livewire\Admin\Products;

use App\Models\Product;
use Barryvdh\Debugbar\Facades\Debugbar;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Show extends Component
{
    public $slug;

    #[Layout('admin.layouts.default')]

    public function render()
    {
        $product = Product::withCommonRelations()
            ->where('slug', $this->slug)
            ->firstOrFail();

        return view('admin.products.show', compact('product'));
    }
}
