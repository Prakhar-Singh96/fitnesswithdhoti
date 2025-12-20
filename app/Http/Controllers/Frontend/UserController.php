<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function orders()
    {
        $orders = Order::where('user_id', Auth::id())->latest()->get();
        return view('frontend.pages.user.orders', compact('orders'));
    }

    // 2. ORDER DETAILS PAGE (Single Order)
    // Yahan bracket ($id) aayega kyunki hame ek specific order dekhna hai
    public function orderDetails($id)
    {
        $order = Order::with('items.product')
                      ->where('user_id', Auth::id())
                      ->findOrFail($id);

        return view('frontend.pages.user.order_details', compact('order'));
    }

    public function profile()
    {
        $user = Auth::user();
        return view('frontend.pages.user.profile', compact('user'));
    }
}
