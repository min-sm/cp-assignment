<?php

namespace App\Livewire\Admin\Products;

use App\Models\Product;
use App\Repositories\ProductRepository;
use Barryvdh\Debugbar\Facades\Debugbar;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Show extends Component
{
    public $slug;
    protected ProductRepository $productRepository;

    public function boot(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    #[Layout('admin.layouts.default')]

    public function render()
    {
        $product = $this->productRepository->findBySlug($this->slug);

        Debugbar::info($product);
        return view('admin.products.show', compact('product'));
    }
}
