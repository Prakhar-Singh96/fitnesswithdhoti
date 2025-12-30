<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Banner;
use App\Models\Filter;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\ProductReview;
use App\Http\Controllers\Controller;
use App\Models\Video; // 🟢 Import Video Model

class HomeController extends Controller
{
    public function index()
    {
        // 1. Featured Products
        $featuredProducts = Product::where('status', 1)
            ->where('is_featured', 1)
            ->with('reviews')
            ->latest()
            ->take(8)
            ->get();

        // 2. Best Selling Products
        $bestSellingProducts = Product::where('status', 1)
            ->where('is_best_seller', 1)
            ->with('reviews')
            ->latest()
            ->take(8)
            ->get();

        // 3. Categories
        $categories = Category::where('status', 1)->get();

        // 4. Products (General)
        $products = Product::where('status', 1)
            ->with('reviews')
            ->latest()
            ->take(8)
            ->get();

        // 5. Purposes
        $purposeFilter = Filter::with('filterValues')
            ->where('name', 'like', '%Purpose%')
            ->first();
        $purposes = $purposeFilter ? $purposeFilter->filterValues : collect([]);

        // 🟢 6. Fetch Videos Dynamically
        $videos = Video::where('status', 1)
            ->orderBy('sort_order', 'asc')
            ->latest()
            ->get();

        // 🟢 NEW LOGIC: Specific Category Showcases
        // 1. Find "Spiritual Jewellery" Category (Adjust slug if different)
        $spiritualCat = Category::where('slug', 'spritual-jewellery')->first();
        //dd($spiritualCat);

        // 2. Define specific sub-categories slugs you want to show
        $targetSubSlugs = ['ring', 'earring', 'pendant']; // Add your real slugs here

        $showcaseSections = collect([]);

        if ($spiritualCat) {
            // Fetch SubCategories with their active products
            $showcaseSections = SubCategory::where('category_id', $spiritualCat->id)
                ->whereIn('slug', $targetSubSlugs)
                ->where('status', 1)
                ->with([
                    'category',
                    'products' => function ($q) {
                        $q->where('status', 1)
                            ->latest()
                            ->take(15); // ✅ ONLY 15 PRODUCTS
                    }
                ])
                ->get();
        }


        // 🟢 2. Fetch Approved Reviews (Customer Love)
        $reviews = ProductReview::where('status', 1) // Only Approved
            ->latest()
            ->take(10) // Show latest 10
            ->get();

        // 🟢 Fetch Active Banners
        $banners = Banner::where('status', 1)->orderBy('sort_order', 'asc')->get();

        return view('frontend.pages.home', compact(
            'banners',
            'featuredProducts',
            'bestSellingProducts',
            'categories',
            'purposes',
            'products',
            'videos',
            'showcaseSections',
            'reviews'
        ));
    }
}
