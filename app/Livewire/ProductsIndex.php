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
        $products = Product::withCommonRelations()
            ->when($this->search, fn($q) => $q->where('model', 'like', "%{$this->search}%")
                ->orWhere('description', 'like', "%{$this->search}%"))
            ->when($this->selectedCategory, fn($q) => $q->forCategory($this->selectedCategory))
            ->when($this->selectedBrand, fn($q) => $q->forBrand($this->selectedBrand))
            ->when($this->sortBy, function ($q) {
                match ($this->sortBy) {
                    'price_asc' => $q->sortedBy('price', 'asc'),
                    'price_desc' => $q->sortedBy('price', 'desc'),
                    default => $q
                };
            })
            ->inStock()
            ->paginate(12);

        return view('livewire.products-index', [
            'products' => $products,
            'categories' => Category::all(),
            'brands' => Brand::all()
        ]);
    }
}
