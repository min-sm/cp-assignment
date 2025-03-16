<?php

namespace App\Models;

use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;
    use HasSlug;
    use SoftDeletes;

    protected $fillable = [
        'model',
        'slug',
        'series_id',
        'brand_id',
        'category_id',
        'description',
        'price',
        'stock_quantity',
    ];

    public function series(): BelongsTo
    {
        return $this->belongsTo(Serie::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(function ($model) {
                return $model->brand->name . ' ' . $model->model;
            })
            ->saveSlugsTo('slug');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Scope: Apply common eager loading relationships
     */
    public function scopeWithCommonRelations(Builder $query): Builder
    {
        return $query->with(['images', 'category', 'series.brand']);
    }

    /**
     * Scope: Filter by search term on model and description
     */
    public function scopeSearch(Builder $query, ?string $search): Builder
    {
        if (!$search) {
            return $query;
        }

        return $query->where(function ($q) use ($search) {
            $q->where('model', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%');
        });
    }

    /**
     * Scope: Filter by category ID
     */
    public function scopeByCategory(Builder $query, ?int $categoryId): Builder
    {
        if (!$categoryId) {
            return $query;
        }

        return $query->where('category_id', $categoryId);
    }

    /**
     * Scope: Filter by brand ID
     */
    public function scopeByBrand(Builder $query, ?int $brandId): Builder
    {
        Debugbar::info('$brandId', $brandId);
        if (!$brandId) {
            return $query;
        }

        return $query->whereHas('series', function ($q) use ($brandId) {
            $q->where('brand_id', $brandId);
        });
    }

    /**
     * Scope: Filter by in-stock status
     */
    public function scopeInStock(Builder $query, bool $inStock = true): Builder
    {
        if (!$inStock) {
            return $query;
        }

        return $query->where('stock_quantity', '>', 0);
    }

    /**
     * Scope: Apply sorting based on a string key
     */
    public function scopeApplySorting(Builder $query, ?string $sortBy): Builder
    {
        if (!$sortBy) {
            return $query;
        }

        switch ($sortBy) {
            case 'price_asc':
                return $query->orderBy('price', 'asc');
            case 'price_desc':
                return $query->orderBy('price', 'desc');
            case 'newest':
                return $query->orderBy('created_at', 'desc');
            case 'oldest':
                return $query->orderBy('created_at', 'asc');
            default:
                return $query;
        }
    }

    /**
     * Scope: Exclude specific product IDs
     */
    public function scopeExcludeIds(Builder $query, array $ids): Builder
    {
        if (empty($ids)) {
            return $query;
        }

        return $query->whereNotIn('id', $ids);
    }

    /**
     * Scope: Find by slug
     */
    public function scopeBySlug(Builder $query, string $slug): Builder
    {
        return $query->where('slug', $slug);
    }
}
