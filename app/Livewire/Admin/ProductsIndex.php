<?php

namespace App\Livewire\Admin;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Barryvdh\Debugbar\Facades\Debugbar;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class ProductsIndex extends Component
{
    use WithPagination;

    public $viewMode = 'table';
    public $search = '';
    public $selectedCategory = null;
    public $selectedBrand = null;
    public $sortField = 'created_at';
    public $sortDirection = 'desc';

    // Reset pagination when any search/filter changes
    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function updatingSelectedCategory()
    {
        $this->resetPage();
    }
    public function updatingSelectedBrand()
    {
        $this->resetPage();
    }
    public function updatingSortField()
    {
        $this->resetPage();
    }
    public function updatingSortDirection()
    {
        $this->resetPage();
    }

    #[Layout('admin.layouts.default')]
    public function render()
    {
        return view('admin.products.index', [
            'products' => $this->products,
            'categories' => Category::all(),
            'brands' => Brand::all(),
        ]);
    }

    #[Computed]
    public function products()
    {
        return Product::with(['images', 'category', 'series.brand'])
            ->when($this->search, fn($q) => $q->where('model', 'like', '%' . $this->search . '%'))
            ->when($this->selectedCategory, fn($q) => $q->where('category_id', $this->selectedCategory))
            ->when($this->selectedBrand, fn($q) => $q->whereHas(
                'series',
                fn($q) =>
                $q->where('brand_id', $this->selectedBrand)
            ))
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(12);
    }

    public function setViewMode($mode)
    {
        $this->viewMode = $mode;
    }
}
