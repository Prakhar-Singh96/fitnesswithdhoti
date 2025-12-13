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

    public function profile()
    {
        $user = Auth::user();
        return view('frontend.pages.user.profile', compact('user'));
    }
}
