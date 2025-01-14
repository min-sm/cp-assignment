<?php

namespace App\Livewire;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
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
        $products = Product::with(['images', 'category', 'series.brand'])
            ->when($this->search, function ($query) {
                $query->where('model', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%');
            })
            ->when($this->selectedCategory, function ($query) {
                $query->whereHas('category', function ($query) {
                    $query->where('id', $this->selectedCategory);
                });
            })
            ->when($this->selectedBrand, function ($query) {
                $query->whereHas('series.brand', function ($query) {
                    $query->where('id', $this->selectedBrand);
                });
            })
            ->when($this->sortBy, function ($query) {
                switch ($this->sortBy) {
                    case 'price_asc':
                        $query->orderBy('price', 'asc');
                        break;
                    case 'price_desc':
                        $query->orderBy('price', 'desc');
                        break;
                }
            })
            ->paginate(12);

        $categories = Category::all();
        $brands = Brand::all();

        Debugbar::info($products->items());
        return view('livewire.products-index', compact('products', 'categories', 'brands'));
    }
}
