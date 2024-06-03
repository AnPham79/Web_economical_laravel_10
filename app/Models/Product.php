<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Contracts\Database\Query\Builder as QueryBuilder;

class Product extends Model
{
    use HasFactory;

    public $fillable = [
        'product_name',
        'product_slug_name',
        'product_short_description',
        'product_description',
        'product_regular_price',
        'product_percent_sale',
        'product_SKU',
        'product_quantity',
        'product_image',
        'category_id'
    ];

    public function thumbnails()
    {
        return $this->hasMany(Thumbnail::class, 'product_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeFilter(Builder | QueryBuilder $query, $filter)
    {
        return $query->when(isset($filter['search']), function($query, $search) {
            $query->where('product_name', 'like', '%' . $search . '%');
        })->when(isset($filter['min_regular_price']), function($query, $min_regular_price) {
            $query->where('product_regular_price', '>=', $min_regular_price);
        })->when(isset($filter['max_regular_price']), function($query, $max_regular_price) {
            $query->where('product_regular_price', '<=', $max_regular_price);
        })->when(isset($filter['product_sale_status']) && $filter['product_sale_status'] === 'on_sale', function($query) {
            $query->where('product_percent_sale', '>', 0);
        })->when(isset($filter['product_sale_status']) && $filter['product_sale_status'] === 'none_sale', function($query) {
            $query->where('product_percent_sale', '=', null);
        });
    }

}
