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
            $headerCategories = Category::with(['subCategories', 'products' => function ($q) {
                $q->latest()->take(4); // Load only 4 latest products for the menu
            }])
                ->where('status', 1)
                ->get();

            $view->with('headerCategories', $headerCategories);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // 👇 CART COUNT GLOBAL LOGIC (Yahan Add Karein) 👇
        View::composer('*', function ($view) {
            $cartGlobalCount = 0;
            $sessionId = Session::getId();
            $userId = Auth::id();

            // Sirf tab count karein agar session ho
            if ($sessionId) {
                $cartGlobalCount = Cart::where(function($q) use ($sessionId, $userId) {
                    if ($userId) {
                        $q->where('user_id', $userId);
                    } else {
                        $q->where('session_id', $sessionId);
                    }
                })->count();
            }

            // 'cartGlobalCount' variable ab har blade file me milega
            $view->with('cartGlobalCount', $cartGlobalCount);
        });
    }
}
