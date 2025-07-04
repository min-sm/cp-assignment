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
    public array $brands = [];

    /**
     * The array of category IDs selected in the filter.
     * This is bound to the checkboxes and used for the query.
     */
    public array $categories = [];

    public array $sorting = ["price" => "default", "model" => "default"];

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

    #[Url(as: 'sort', except: '')]
    public $sortBy = "";

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

        $this->parseSortBy();
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
            $this->selectedBrands = Brand::whereIn('id', $this->brands)->pluck('name')->map(fn($name) => strtolower($name))->implode(',');
        }
        $this->resetPage();
    }

    /**
     * Runs every time the `$categories` property is updated.
     * It updates the URL string based on the selected IDs.
     */
    public function updatedCategories($value): void
    {
        // When the user checks/unchecks a category, fetch the corresponding slugs
        // and update the `selectedCategories` string for the URL.
        if (empty($value)) {
            $this->selectedCategories = '';
        } else {
            $this->selectedCategories = Category::whereIn('id', $this->categories)->pluck('name')->map("strtolower")->implode(',');
        }
        $this->resetPage();
    }

    public function clickSortOption($field)
    {
        // If the field is not a valid sorting key, do nothing.
        if (!array_key_exists($field, $this->sorting)) {
            return;
        }

        // The core logic to cycle through the states
        $this->sorting[$field] = match ($this->sorting[$field]) {
            'default' => 'asc',
            'asc' => 'desc',
            'desc' => 'default', // Cycle back to default
        };

        $this->sortBy = collect($this->sorting)->map(function ($value, $key) {
            return $value === 'asc' ? $key
                : ($value === 'desc' ? "-$key"
                    : null);
        })->filter()->implode(',');
        $this->resetPage();

        // After sorting, you would typically re-query your data.
        // For example:
        // $this->resetPage(); // If using pagination
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

        $sorting = $this->sorting ?? ['price' => 'default', 'model' => 'default'];

        // Check if both are 'default'
        if ($sorting['price'] === 'default' && $sorting['model'] === 'default') {
            $productsQuery->orderBy('id');
        } else {
            // Apply sorting for each valid field
            foreach ($sorting as $field => $direction) {
                if (in_array($field, ['price', 'model']) && in_array($direction, ['asc', 'desc'])) {
                    $productsQuery->orderBy($field, $direction);
                }
            }
        }

        return view('product-filter', [
            'products' => $productsQuery->with('series', 'category')->paginate(12),
            'availableBrands' => Brand::all()->sortBy('name'),
            'availableCategories' => Category::all()->sortBy('name'),
        ])->extends('store.layouts.default');
    }

    public function parseSortBy()
    {
        $validKeys = ['price', 'model'];

        // set to default
        $this->sorting = [
            'price' => 'default',
            'model' => 'default',
        ];

        $parts = explode(',', $this->sortBy);

        foreach ($parts as $part) {
            $part = trim($part);

            if ($part === '') continue;

            if (str_starts_with($part, '-')) {
                $key = substr($part, 1);
                if (in_array($key, $validKeys)) {
                    $this->sorting[$key] = 'desc';
                }
            } else {
                $key = $part;
                if (in_array($key, $validKeys)) {
                    $this->sorting[$key] = 'asc';
                }
            }
        }
    }
}
