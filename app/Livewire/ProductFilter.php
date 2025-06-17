<?php

namespace App\Livewire;

use App\Livewire\UrlConverters\SlugArrayUrlConverter;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Barryvdh\Debugbar\Facades\Debugbar;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url; // The magic attribute!

class ProductFilter extends Component
{
    use WithPagination;

    // The #[Url] attribute syncs this property with the query string.
    // as: 'b' shortens the URL to ?b[]=... instead of ?brands[]=...
    // except: [] removes the key from the URL if it's an empty array.
    #[Url(as: 'b', except: [])]
    public $brands = [];

    #[Url(as: 'c', except: [])]
    public $categories = [];

    public function render()
    {
        Debugbar::info("welcome", $this->brands, $this->categories, "goodbye");
        // Start the query
        $productsQuery = Product::query();

        // If brands filter is not empty, apply a whereIn clause
        if (!empty($this->brands)) {
            $productsQuery->whereIn('brand_id', $this->brands);
        }

        // If categories filter is not empty, apply a whereIn clause
        if (!empty($this->categories)) {
            $productsQuery->whereIn('category_id', $this->categories);
        }

        return view('product-filter', [
            'products' => $productsQuery->with('series', 'category')->paginate(12),
            'availableBrands' => Brand::all()->sort(),
            //'availableBrands' => Product::distinct()->pluck('brand_id')->sort(),
            //'availableCategories' => Product::distinct()->pluck('category_id')->sort(),
            'availableCategories' => Category::all()->sort(),
        ])->extends('store.layouts.default');
    }

    // This function runs when any of the public properties are updated.
    // We use it to reset pagination back to the first page.
    public function updating($key): void
    {
        Debugbar::info($this->brands, $this->categories, $key);
        if (in_array($key, ['brands', 'categories'])) {
            $this->resetPage();
        }
    }
}
