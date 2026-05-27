<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\CalculatorPage;
use App\Models\SubCategory;
use App\Services\ProkeralaService;

class RudrakshaCalculatorController extends Controller
{
    protected $prokeralaService;

    public function __construct(ProkeralaService $prokeralaService)
    {
        $this->prokeralaService = $prokeralaService;
    }

    // 🚀 1. पूरा पेज लोड करने के लिए (यूजर को सब पहले से दिखेगा)
    public function index($slug = 'rudraksha-calculator')
    {
        // 1. एडमिन पैनल से भरा हुआ सारा का सारा डेटा सिंगल क्वेरी में निकालो
        $pageData = CalculatorPage::where('sub_category_slug', $slug)->first();

        // 💡 अगर एडमिन ने इस स्लग का डेटा अभी तक सेव नहीं किया है, तो सेफ साइड के लिए 404 दिखा दो या रिटर्न करो
        if (!$pageData) {
            abort(404, 'Calculator configurations not found for this category.');
        }

        // 2. 🚀 फिक्स: रुद्राक्ष कैटेगरी को सेफ तरीके से ढूंढें (LIKE %rudraksh% से स्पेलिंग मिस्टेक नहीं होगी)
        $rudrakshaCategory = \App\Models\Category::where('slug', 'LIKE', '%rudraksh%')->first();

        // अगर डेटाबेस में रुद्राक्ष कैटेगरी मिल गई तो उसकी ID लो, नहीं तो फॉलबैक रखो
        $rudrakshaId = $rudrakshaCategory ? $rudrakshaCategory->id : $pageData->category_id;

        // 3. 🚀 चैलेंज फिक्स: अब ग्रिड में हमेशा सिर्फ और सिर्फ रुद्राक्ष कैटेगरी के ही प्रोडक्ट्स आएंगे
        $categoryProducts = Product::where('status', 1)
            ->where('category_id', $rudrakshaId) // 👈 यहाँ हमेशा रुद्राक्ष की ID ही जाएगी
            ->orderBy('sort_order', 'asc')
            ->get();

        // 5. व्यू पर डेटा भेजें
        return view('frontend.pages.rudraksha-calculator', compact('pageData', 'categoryProducts'));
    }

    // 🚀 2. सिर्फ कैलकुलेटर का रिजल्ट देने के लिए (बटन दबाने के बाद)
    public function getRecommendation(Request $request)
    {
        $method = $request->method; // birth or purpose
        $products = collect();
        $purpose = $request->purpose;

        $rudrakshaCategory = \App\Models\Category::where('slug', 'LIKE', '%rudraksh%')->first();
        $rudrakshaId = $rudrakshaCategory ? $rudrakshaCategory->id : null;

        try {
            $astroData = $this->prokeralaService->getFullAstroData($request->all());
            $rashi = $astroData['rashi'] ?? null;

            if ($method == 'birth') {
                $products = Product::where('status', 1)
                    ->where('category_id', $rudrakshaId)
                    ->where('astro_rashi', 'LIKE', '%' . $rashi . '%')
                    ->take(4)->get();

                $title = "Recommended Rudraksha for " . ($rashi ?? 'your') . " Rashi";
            } else {
                $products = Product::where('status', 1)
                    ->where('category_id', $rudrakshaId)
                    ->where('astro_rashi', 'LIKE', '%' . $rashi . '%')
                    ->where(function ($q) use ($purpose) {
                        $q->where('purpose', 'LIKE', '%' . $purpose . '%')
                          ->orWhere('astro_benefits', 'LIKE', '%' . $purpose . '%');
                    })
                    ->get();

                $title = "Best Rudraksha for " . ($rashi ?? '') . " Rashi to achieve " . $purpose;
            }
        } catch (\Exception $e) {
            \Log::error("Rudraksha Calculator Error: " . $e->getMessage());
        }

        // स्मार्ट फॉलबैक
        if ($products->isEmpty() && $purpose) {
            $products = Product::where('status', 1)
                ->where('category_id', $rudrakshaId)
                ->where(function ($q) use ($purpose) {
                    $q->where('purpose', 'LIKE', '%' . $purpose . '%')
                      ->orWhere('astro_benefits', 'LIKE', '%' . $purpose . '%');
                })
                ->take(4)->get();
            $title = "Recommended Rudraksha for " . $purpose;
        }

        if ($products->isEmpty()) {
            $products = Product::where('status', 1)
                ->where('category_id', $rudrakshaId)
                ->where('is_best_seller', 1)
                ->take(4)->get();
            $title = "Our Most Trusted Universal Rudraksha";
        }

        return response()->json([
            'status' => true,
            'title' => $title,
            'html'   => view('frontend.includes.rudraksha_results_grid', compact('products', 'title'))->render()
        ]);
    }
}
