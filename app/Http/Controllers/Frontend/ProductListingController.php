<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Filter;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Services\BigShipService;
use App\Http\Controllers\Controller;

class ProductListingController extends Controller
{
    // 🟢 HELPER: Get Dynamic Filters & Counts based on context
    private function getDynamicFilters($categoryId = null, $subCategoryId = null)
    {
        return Filter::whereHas('filterValues.products', function ($q) use ($categoryId, $subCategoryId) {
            // Sirf wo Filters laayein jo Active Products se jude hain
            $q->where('status', 1);
            if ($categoryId) $q->where('category_id', $categoryId);
            if ($subCategoryId) $q->where('sub_category_id', $subCategoryId);
        })
            ->with(['filterValues' => function ($q) use ($categoryId, $subCategoryId) {
                // Filter Values ko bhi filter karein (Jo is category me available hain)
                $q->whereHas('products', function ($sq) use ($categoryId, $subCategoryId) {
                    $sq->where('status', 1);
                    if ($categoryId) $sq->where('category_id', $categoryId);
                    if ($subCategoryId) $sq->where('sub_category_id', $subCategoryId);
                })
                    // Har Value ka Product Count nikalein
                    ->withCount(['products' => function ($sq) use ($categoryId, $subCategoryId) {
                        $sq->where('status', 1);
                        if ($categoryId) $sq->where('category_id', $categoryId);
                        if ($subCategoryId) $sq->where('sub_category_id', $subCategoryId);
                    }]);
            }])
            ->get();
    }

    // 🟢 HELPER: Apply User Selected Filters (Logic same as before)
    private function applyFilters($query, $request)
    {
        if ($request->filled('min_price') && $request->filled('max_price')) {
            $query->whereBetween('price', [$request->min_price, $request->max_price]);
        }

        if ($request->filled('filter')) {
            foreach ($request->filter as $filterId => $valueIds) {
                if (!empty($valueIds)) {
                    $query->whereHas('filterValues', function ($q) use ($valueIds) {
                        $q->whereIn('filter_values.id', $valueIds);
                    });
                }
            }
        }

        if ($request->filled('sort')) {
            if ($request->sort == 'price_asc') $query->orderBy('price', 'asc');
            elseif ($request->sort == 'price_desc') $query->orderBy('price', 'desc');
            else $query->latest();
        } else {
            $query->latest();
        }

        return $query;
    }

    // 1. Category Page
    public function categoryProducts(Request $request, $slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        // Products Query
        $query = Product::where('category_id', $category->id)->where('status', 1);
        $this->applyFilters($query, $request);
        $products = $query->paginate(12)->withQueryString();

        // ⚡ Get Dynamic Filters for this Category
        $filters = $this->getDynamicFilters($category->id, null);

        return view('frontend.pages.product_listing', compact('category', 'products', 'filters'));
    }

    // 2. SubCategory Page
    public function subCategoryProducts(Request $request, $cat_slug, $sub_slug)
    {
        $category = Category::where('slug', $cat_slug)->firstOrFail();
        $subCategory = SubCategory::where('slug', $sub_slug)->where('category_id', $category->id)->firstOrFail();

        // Products Query
        $query = Product::where('sub_category_id', $subCategory->id)->where('status', 1);
        $this->applyFilters($query, $request);
        $products = $query->paginate(12)->withQueryString();

        // ⚡ Get Dynamic Filters for this SubCategory
        $filters = $this->getDynamicFilters(null, $subCategory->id);

        return view('frontend.pages.product_listing', compact('category', 'subCategory', 'products', 'filters'));
    }

    public function productDetail($slug)
    {
        $product = Product::where('slug', $slug)->where('status', 1)->firstOrFail();

        // Related products logic (Optional)
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4)->get();

        return view('frontend.pages.product_detail', compact('product', 'relatedProducts'));
    }

    public function searchListing(Request $request)
    {
        $queryTerm = $request->get('q');

        // Base Query (Search by name)
        $query = Product::where('status', 1)
            ->where('name', 'like', "%{$queryTerm}%");

        // Apply Filters (Existing helper function)
        $this->applyFilters($query, $request);

        $products = $query->paginate(12)->withQueryString();

        // Filters load karne ke liye dummy empty category pass kar sakte hain ya custom logic
        // Yahan hum simply saare filters load kar rahe hain
        $filters = Filter::with('filterValues')->get();

        // Dummy category object for view compatibility
        $category = (object)['name' => "Search Results for: '$queryTerm'", 'description' => ''];

        return view('frontend.pages.product_listing', compact('category', 'products', 'filters'));
    }

    public function checkPincode($pincode)
    {
        // Warehouse Details
        $pickupPin = '110019';
        $weight = 0.5;
        $price = 999;

        $bigship = new BigShipService();
        $result = $bigship->checkServiceability($pickupPin, $pincode, $weight, $price);

        if ($result['status']) {

            // 🔥 TAT (Days) se Date calculate karein
            $days = (int) $result['days'];

            // Date Format: "Dec 15, 2025"
            $date = now()->addDays($days)->format('M d, Y');

            return response()->json([
                'status' => true,
                'date'   => $date,
                'days'   => $days, // Debug ke liye
                'message' => 'Delivery by ' . $date
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Service not available.'
            ]);
        }
    }
}
