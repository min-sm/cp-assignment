<?php

namespace App\Livewire\Admin\Products;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Serie;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Create extends Component
{
    public $selectedBrand;
    public $filteredSeries = [];

    #[Title('Create Product')]
    #[Layout('admin.layouts.default')]

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

    public function render()
    {
        $categories = Cache::remember('categories', 3600, fn() => Category::all());
        $brands = Cache::remember('brands', 3600, fn() => Brand::all());

        return view('admin.products.create', compact('categories', 'brands'));
    }
}
