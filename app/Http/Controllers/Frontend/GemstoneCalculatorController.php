<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\CalculatorPage;
use App\Models\SubCategory;
use App\Services\ProkeralaService;

class GemstoneCalculatorController extends Controller
{
    protected $prokeralaService;

    public function __construct(ProkeralaService $prokeralaService)
    {
        $this->prokeralaService = $prokeralaService;
    }

    // 🚀 1. पूरा जेमस्टोन पेज लोड करने के लिए
    public function index($slug = 'gemstones-calculator')
    {
        // एडमिन पैनल से जेमस्टोन कैलकुलेटर का डेटा निकालो
        $pageData = CalculatorPage::where('sub_category_slug', $slug)->first();

        if (!$pageData) {
            abort(404, 'Gemstone Calculator configurations not found.');
        }

        // 🎯 फ़िक्स: जेमस्टोन कैटेगरी को सेफ तरीके से ढूंढें
        $gemstoneCategory = \App\Models\Category::where('slug', 'LIKE', '%gemstones%')->first();
        $gemstoneId = $gemstoneCategory ? $gemstoneCategory->id : $pageData->category_id;

        // 🎯 सिर्फ जेmstone कैटेगरी के ही प्रोडक्ट्स ग्रिड में हमेशा दिखेंगे
        $categoryProducts = Product::where('status', 1)
            ->where('category_id', $gemstoneId)
            ->orderBy('sort_order', 'asc')
            ->take(3)->get();


        return view('frontend.pages.gemstone-calculator', compact('pageData', 'categoryProducts'));
    }

    // 🚀 2. जेमस्टोन कैलकुलेटर का रिजल्ट देने के लिए (AJAX)
    public function getRecommendation(Request $request)
    {
        $method = $request->method; // birth or purpose
        $products = collect();
        $purpose = $request->purpose;

        $gemstoneCategory = \App\Models\Category::where('slug', 'LIKE', '%gemstones%')->first();
        $gemstoneId = $gemstoneCategory ? $gemstoneCategory->id : null;

        try {
            $astroData = $this->prokeralaService->getFullAstroData($request->all());
            $rashi = $astroData['rashi'] ?? null;

            if ($method == 'birth') {
                $products = Product::where('status', 1)
                    ->where('category_id', $gemstoneId)
                    ->where('astro_rashi', 'LIKE', '%' . $rashi . '%')
                    ->take(4)->get();

                $title = "Recommended Gemstone for " . ($rashi ?? 'your') . " Rashi";
            } else {
                $products = Product::where('status', 1)
                    ->where('category_id', $gemstoneId)
                    ->where('astro_rashi', 'LIKE', '%' . $rashi . '%')
                    ->where(function ($q) use ($purpose) {
                        $q->where('purpose', 'LIKE', '%' . $purpose . '%')
                          ->orWhere('astro_benefits', 'LIKE', '%' . $purpose . '%');
                    })
                    ->get();

                $title = "Best Gemstone for " . ($rashi ?? '') . " Rashi to achieve " . $purpose;
            }
        } catch (\Exception $e) {
            \Log::error("Gemstone Calculator Error: " . $e->getMessage());
        }

        // स्मार्ट फॉलबैक
        if ($products->isEmpty() && $purpose) {
            $products = Product::where('status', 1)
                ->where('category_id', $gemstoneId)
                ->where(function ($q) use ($purpose) {
                    $q->where('purpose', 'LIKE', '%' . $purpose . '%')
                      ->orWhere('astro_benefits', 'LIKE', '%' . $purpose . '%');
                })
                ->take(4)->get();
            $title = "Recommended Gemstone for " . $purpose;
        }

        if ($products->isEmpty()) {
            $products = Product::where('status', 1)
                ->where('category_id', $gemstoneId)
                ->where('is_best_seller', 1)
                ->take(1)->get();
            $title = "Our Most Trusted Universal Gemstone";
        }

        return response()->json([
            'status' => true,
            'title' => $title,
            'html'   => view('frontend.includes.gemstone_results_grid', compact('products', 'title'))->render()
        ]);
    }
}
