<?php

namespace App\Livewire;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Repositories\ProductRepository;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Http\Request;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ProductsIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $selectedCategory = '';
    public $selectedBrand = '';
    public $sortBy = '';
    public $filters;
    protected ProductRepository $productRepository;

    public function boot(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function mount($filters = [])
    {
        $this->filters = $filters ?? [];
        if (!empty($this->filters)) {
            if ($this->filters['filter_type'] == "category") {
                $this->selectedCategory = $this->filters['category_id'];
            } else if ($this->filters['filter_type'] == "brand") {
                $this->selectedBrand = $this->filters['brand_id'];
            }
        }
        Debugbar::info($this->filters);
        Debugbar::info($this->selectedCategory);
        Debugbar::info($this->selectedBrand);
    }

    public function searchProducts()
    {
        $this->resetPage();
    }

    public function render()
    {
        $products = $this->productRepository->getProducts([
            'search' => $this->search,
            'category' => $this->selectedCategory,
            'brand' => $this->selectedBrand,
            'sortBy' => $this->sortBy,
            'in_stock' => true,
        ]);

        $categories = Category::all();
        $brands = Brand::all();

        Debugbar::info($products->map(fn($product) => $product->id));
        return view('livewire.products-index', compact('products', 'categories', 'brands'));
    }
}
