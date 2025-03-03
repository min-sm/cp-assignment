<?php

namespace App\Livewire\Admin\Products;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
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

    #[Title('All products')]
    #[Layout('admin.layouts.default')]
    public function render()
    {
        $categories = Cache::remember('categories', 3600, fn() => Category::all());
        $brands = Cache::remember('brands', 3600, fn() => Brand::all());

        return view('admin.products.index', [
            'products' => $this->products,
            'categories' => $categories,
            'brands' => $brands,
        ]);
    }

    #[Computed]
    public function products()
    {
        return Product::withCommonRelations()
            ->when($this->search, fn($q) => $q->where('model', 'like', "%{$this->search}%"))
            ->when($this->selectedCategory, fn($q) => $q->forCategory($this->selectedCategory))
            ->when($this->selectedBrand, fn($q) => $q->forBrand($this->selectedBrand))
            ->sortedBy($this->sortField, $this->sortDirection)
            ->paginate(12);
    }

    public function setViewMode($mode)
    {
        $this->viewMode = $mode;
    }
}
