<?php

namespace App\Models;

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
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate(false);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function scopeWithCommonRelations($query)
    {
        return $query->with(['images', 'category', 'series.brand']);
    }

    public function scopeForCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    public function scopeForBrand($query, $brandId)
    {
        return $query->whereHas('series', function ($q) use ($brandId) {
            $q->where('brand_id', $brandId);
        });
    }

    public function scopeInStock($query)
    {
        return $query->where('stock_quantity', '>', 0);
    }

    public function scopeExcludeIds($query, array $ids)
    {
        return $query->whereNotIn('id', $ids);
    }

    public function scopeSortedBy($query, $field, $direction)
    {
        return $query->orderBy($field, $direction);
    }

    public function getRelatedProducts(int $limit = 4): Collection
    {
        $query = Product::query()
            ->inStock()
            ->where('id', '!=', $this->id);

        return $query->where(function ($q) {
            $q->where('category_id', $this->category_id)
                ->whereHas('series', fn($q) => $q->where('brand_id', $this->brand_id));
        })
            ->orWhere(function ($q) {
                $q->where('category_id', $this->category_id)
                    ->excludeIds(
                        Product::whereHas('series', fn($q) => $q->where('brand_id', $this->brand_id))
                            ->pluck('id')
                    );
            })
            ->orWhereHas('series', fn($q) => $q->where('brand_id', $this->brand_id))
            ->limit($limit)
            ->get();
    }
}
