<?php

namespace App\Models;

use App\Models\Category;
use App\Models\FilterValue;
use App\Models\SubCategory;
use App\Models\ProductImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [

        'category_id',
        'sub_category_id',

        'name',
        'slug',
        'description',

        'mrp_price',
        'discount',
        'price',
        'quantity',

        'main_image',
        'main_image_alt',

        'offer_end_time',
        'is_siddh_enabled',
        'siddh_price',

        'meta_title',
        'meta_description',
        'meta_keywords',

        'og_title',
        'og_description',
        'og_image',

        'sku',
        'weight',

        'status',

        'delivery_days',
        'emi_available'
    ];

    protected $casts = [
        'offer_end_time' => 'datetime', // Date object me convert karega
        'is_siddh_enabled' => 'boolean',

        // 🆕 New Casts
        'emi_available' => 'boolean', // 1 ko true, 0 ko false samjhega
        'delivery_days' => 'integer'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function filterValues()
    {
        return $this->belongsToMany(FilterValue::class, 'product_filter', 'product_id', 'filter_value_id');
    }
}
