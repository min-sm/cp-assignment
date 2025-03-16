<?php

namespace App\Livewire\Admin\Products;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Serie;
use App\Repositories\ProductRepository;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Edit extends Component
{
    public $slug;
    protected ProductRepository $productRepository;
    public $selectedBrand;
    public $filteredSeries = [];

    public function boot(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
        $product = $this->productRepository->findBySlug($this->slug);
        $this->selectedBrand = $product->brand_id;
        $this->filteredSeries = Serie::where('brand_id', $this->selectedBrand)->get();
    }

    public function updatedSelectedBrand($value)
    {
        Debugbar::info($value);
        if (is_numeric($value)) {
            $this->filteredSeries = Serie::where('brand_id', $value)->get();
        } else {
            $this->filteredSeries = [];
            $this->selectedBrand = null;
        }
        Debugbar::info($this->selectedBrand, $this->filteredSeries);
    }

    #[Layout('admin.layouts.default')]

    public function render()
    {
        $product = $this->productRepository->findBySlug($this->slug);
        $categories = Cache::remember('categories', 3600, fn() => Category::all());
        $brands = Cache::remember('brands', 3600, fn() => Brand::all());

        Debugbar::info($product, $categories, $brands);
        return view('admin.products.edit', compact('product', 'categories', 'brands'));
    }
}
