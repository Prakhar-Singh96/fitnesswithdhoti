<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Cart;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Header ke liye categories globally available
        View::composer('frontend.includes.header', function ($view) {

            // 1. Pehle Categories aur SubCategories load karein
            $headerCategories = Category::where('status', 1)
                ->with(['subCategories' => function ($q) {
                    $q->where('status', 1);
                }])
                ->orderBy('id', 'asc')
                ->get();

            // 2. Har Category ke liye manually 4 latest products load karein
            foreach ($headerCategories as $category) {

                // 🚀 सटीक चेकिंग: अब सिर्फ वही सब-कैटेगरी कैलकुलेटर पर जाएगी जिसके स्लग में 'calculator' शब्द होगा
                foreach ($category->subCategories as $sub) {
                    if ($sub->slug == 'gemstones-calculator') {
                        // सीधे जेमस्टोन के राउट का नाम
                        $sub->custom_url = route('gemstone.calculator');
                    } elseif ($sub->slug == 'rudraksha-calculator') {
                        // सीधे रुद्राक्ष के राउट का नाम
                        $sub->custom_url = route('calculator.rudraksha');
                    } else {
                        $sub->custom_url = route('products.subcategory', [$category->slug, $sub->slug]);
                    }
                }

                $latestProducts = $category->products()
                    ->where('status', 1)
                    ->latest()
                    ->take(4)
                    ->get();

                // Blade file ke liye relation set kar rahe hain
                $category->setRelation('products', $latestProducts);
            }

            $view->with('headerCategories', $headerCategories);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // 👇 CART COUNT GLOBAL LOGIC 👇
        View::composer('*', function ($view) {
            $cartGlobalCount = 0;
            $sessionId = Session::getId();
            $userId = Auth::id();

            if ($sessionId) {
                $cartGlobalCount = Cart::where(function ($q) use ($sessionId, $userId) {
                    if ($userId) {
                        $q->where('user_id', $userId);
                    } else {
                        $q->where('session_id', $sessionId);
                    }
                })->count();
            }

            $view->with('cartGlobalCount', $cartGlobalCount);
        });
    }
}
