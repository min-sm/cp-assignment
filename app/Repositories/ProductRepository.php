<?php

namespace App\Repositories;

use App\Models\Product;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class ProductRepository
{
    /**
     * Find a product by slug.
     */
    public function findBySlug(string $slug): ?Product
    {
        return Product::withCommonRelations()
            ->bySlug($slug)
            ->firstOrFail();
    }

    /**
     * Get products with optional filtering and sorting.
     */
    public function getProducts(array $filters = [], string $sortField = 'created_at', string $sortDirection = 'desc', int $perPage = 12): LengthAwarePaginator
    {
        Debugbar::info('$filters[\'brand\']', $filters['brand'] == true);
        return Product::withCommonRelations()
            ->search($filters['search'] ?: null)
            ->byCategory($filters['category'] ?: null)
            ->byBrand($filters['brand'] ?: null)
            ->inStock($filters['in_stock'] ?? false)
            ->applySorting($filters['sortBy'] ?? null)
            ->when(
                empty($filters['sortBy']),
                fn($q) => $q->orderBy($sortField, $sortDirection)
            )
            ->paginate($perPage);
    }

    /**
     * Get related products based on category and brand.
     */
    public function getRelatedProducts(Product $product, int $limit = 4)
    {
        $products = collect();
        $excludeIds = [$product->id];

        // 1. Same category and brand
        $sameCategoryAndBrand = Product::withCommonRelations()
            ->byCategory($product->category_id)
            ->byBrand($product->brand_id)
            ->excludeIds($excludeIds)
            ->inStock()
            ->take($limit)
            ->get();

        $products = $products->merge($sameCategoryAndBrand);
        $excludeIds = array_merge($excludeIds, $products->pluck('id')->toArray());
        $remaining = $limit - $products->count();

        // 2. Same category (if needed)
        if ($remaining > 0) {
            $sameCategory = Product::withCommonRelations()
                ->byCategory($product->category_id)
                ->excludeIds($excludeIds)
                ->inStock()
                ->take($remaining)
                ->get();

            $products = $products->merge($sameCategory);
            $excludeIds = array_merge($excludeIds, $sameCategory->pluck('id')->toArray());
            $remaining = $limit - $products->count();
        }

        // 3. Same brand (if needed)
        if ($remaining > 0) {
            $sameBrand = Product::withCommonRelations()
                ->byBrand($product->series->brand_id)
                ->excludeIds($excludeIds)
                ->inStock()
                ->take($remaining)
                ->get();

            $products = $products->merge($sameBrand);
        }
        return $products;
    }
}
