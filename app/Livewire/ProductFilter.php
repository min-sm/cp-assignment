<?php

namespace App\Livewire;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Barryvdh\Debugbar\Facades\Debugbar;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;

class ProductFilter extends Component
{
    use WithPagination;

    /**
     * The array of brand IDs selected in the filter.
     * This is bound to the checkboxes and used for the query.
     */
    public $brands = [];

    /**
     * The array of category IDs selected in the filter.
     * This is bound to the checkboxes and used for the query.
     */
    public $categories = [];

    /**
     * The comma-separated string of brand slugs for the URL.
     * `except: ''` ensures the query param is removed when empty.
     */
    #[Url(as: 'brands', except: '')]
    public $selectedBrands = '';

    /**
     * The comma-separated string of category slugs for the URL.
     * `except: ''` ensures the query param is removed when empty.
     */
    #[Url(as: 'categories', except: '')]
    public $selectedCategories = '';


    /**
     * Runs once, when the component is first mounted.
     * It hydrates the component's state from the URL query string.
     */
    public function mount(): void
    {
        // Get the slugs from the URL string and convert them to an array of IDs
        // to pre-select the correct checkboxes.
        if (!empty($this->selectedBrands)) {
            $this->brands = Brand::whereIn('name', explode(',', $this->selectedBrands))
                ->pluck('id')->map(fn($id) => (string) $id)->toArray();
        }

        if (!empty($this->selectedCategories)) {
            $this->categories = Category::whereIn('name', explode(',', $this->selectedCategories))
                ->pluck('id')->map(fn($id) => (string) $id)->toArray();
        }
    }

    /**
     * Runs every time the `$brands` property is updated.
     * It updates the URL string based on the selected IDs.
     */
    public function updatedBrands($value): void
    {
        // When the user checks/unchecks a brand, fetch the corresponding slugs
        // and update the `selectedBrands` string for the URL.
        if (empty($value)) {
            $this->selectedBrands = '';
        } else {
            $this->selectedBrands = Brand::whereIn('id', $this->brands)->pluck('name')->map(strtolower(...))->implode(',');
        }
        $this->resetPage();
    }

    /**
     * Runs every time the `$categories` property is updated.
     * It updates the URL string based on the selected IDs.
     */
    public function updatedCategories($value): void
    {
        Debugbar::log($value);
        // When the user checks/unchecks a category, fetch the corresponding slugs
        // and update the `selectedCategories` string for the URL.
        if (empty($value)) {
            $this->selectedCategories = '';
        } else {
            $this->selectedCategories = Category::whereIn('id', $this->categories)->pluck('name')->map(strtolower(...))->implode(',');
        }
        $this->resetPage();
    }


    public function render()
    {
        $productsQuery = Product::query();

        // The query continues to use the simple array of IDs.
        if (!empty($this->brands)) {
            $productsQuery->whereIn('brand_id', $this->brands);
        }

        if (!empty($this->categories)) {
            $productsQuery->whereIn('category_id', $this->categories);
        }

        return view('product-filter', [
            'products' => $productsQuery->with('series', 'category')->paginate(12),
            'availableBrands' => Brand::all()->sortBy('name'),
            'availableCategories' => Category::all()->sortBy('name'),
        ])->extends('store.layouts.default');
    }
}
