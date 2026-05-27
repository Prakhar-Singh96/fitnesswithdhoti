<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalculatorPage extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'sub_category_id',
        'sub_category_slug',
        'page_title',
        'hero_title',
        'hero_short_desc',
        'hero_banner',
        'about_title',
        'about_desc',
        'about_banner',
        'content_title',
        'content_body',
        'product_recommendation_title',
        'spiritual_title',
        'spiritual_desc',
        'spiritual_image',
        'benefits_title',
        'benefits_desc',
        'how_to_wear_title',
        'how_to_wear_desc',
        'how_to_wear_image',
        'what_is_calculator_title',
        'what_is_calculator_desc',
        'how_to_use_title',
        'how_to_use_desc',
        'testimonials',
        'faqs',
        'conclusion'
    ];

    protected $casts = [
        'testimonials' => 'array',
        'faqs' => 'array'
    ];
}
