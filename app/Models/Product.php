<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;
    use HasSlug;

    protected $fillable = [
        'model',
        'slug',
        'series_id',
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
                if (!$model->series) {
                    return $model->model;
                }

                return $model->series->brand->name . ' ' . $model->model;
            })
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate(false);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
