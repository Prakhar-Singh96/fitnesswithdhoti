<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserAddress;
use App\Models\Order;
use App\Models\OrderItem;
use Razorpay\Api\Api;
use App\Models\PaymentSetting;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $addresses = UserAddress::where('user_id', $userId)->get();

        // Cart Items bhi chahiye Order Summary ke liye
        $cartItems = Cart::with('product')->where('user_id', $userId)->get();

        // Agar cart khali hai to wapas bhej do (Sirf tab jab Direct Buy na ho raha ho)
        // Note: Direct buy ke liye hum modal use kar rahe hain, isliye ye page load nahi hoga
        if ($cartItems->isEmpty()) {
            return redirect()->route('products.search_listing')->with('error', 'Your cart is empty.');
        }

        return view('frontend.pages.checkout', compact('addresses', 'cartItems'));
    }

    public function saveAddress(Request $request)
    {
        $request->validate([
            'pincode' => 'required',
            'city' => 'required',
            'state' => 'required',
            'address_line1' => 'required',
            'name' => 'required',
            'phone' => 'required'
        ]);

        UserAddress::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'phone' => $request->phone,
            'pincode' => $request->pincode,
            'city' => $request->city,
            'state' => $request->state,
            'address_line1' => $request->address_line1,
            'type' => $request->address_type ?? 'home'
        ]);

        return redirect()->back()->with('success', 'Address Saved Successfully');
    }

    // New AJAX Function
    public function saveAddressAjax(Request $request)
    {
        $request->validate([
            'pincode' => 'required',
            'address_line1' => 'required',
            'name' => 'required',
            //'phone' => 'required'
        ]);

        $user = Auth::user();

        // 2. 🔥 Phone Number Logic (Main Fix)
        // Agar form se number aya hai to wo lo, nahi to User Profile se utha lo
        $phoneToSave = $request->phone;

        if (empty($phoneToSave)) {
            $phoneToSave = $user->phone;
        }

        $address = UserAddress::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'phone' => $phoneToSave, // ✅ Ab yahan sahi number jayega
            'pincode' => $request->pincode,
            'city' => $request->city,
            'state' => $request->state,
            'address_line1' => $request->address_line1,
            'type' => $request->type
        ]);

        return response()->json(['status' => true, 'address_id' => $address->id]);
    }

    // 🔥 MAIN ORDER LOGIC (Handles Both Cart & Direct Buy)
    public function placeOrder(Request $request)
    {
        $user = Auth::user();

        // -----------------------------
        // 1. ADDRESS HANDLING
        // -----------------------------
        $addressId = $request->address_id;

        if ($request->new_address_flag == '1' || !$addressId) {

            // Validation
            $request->validate([
                'new_pincode' => 'required',
                'new_address' => 'required',
                'new_name' => 'required',
                'new_phone' => 'required'
            ]);

            // Save New Address
            $newAddress = UserAddress::create([
                'user_id' => $user->id,
                'name' => $request->new_name,
                'phone' => $request->new_phone,
                'pincode' => $request->new_pincode,
                'city' => $request->new_city,
                'state' => $request->new_state,
                'address_line1' => $request->new_address,
                'type' => $request->addr_type ?? 'home' // Default Home if null
            ]);

            $finalAddress = $newAddress;
        } else {
            $finalAddress = UserAddress::findOrFail($addressId);
        }

        // -----------------------------
        // 2. PREPARE ORDER ITEMS & CALCULATE TOTAL
        // -----------------------------
        $orderItemsData = [];
        $totalAmount = 0;

        if ($request->buy_mode == 'direct') {
            // 🔥 DIRECT BUY LOGIC
            $product = Product::findOrFail($request->product_id);
            $qty = $request->quantity;
            $isSiddh = $request->is_siddh ?? 0; // Default 0

            // Price Calculation
            $price = $product->price;
            if ($isSiddh == 1) {
                $price += $product->siddh_price;
            }

            $totalAmount = $price * $qty;

            // Prepare Data
            $orderItemsData[] = [
                'product_id' => $product->id,
                'product_name' => $product->name,
                'quantity' => $qty,
                'price' => $price,
                'is_siddh' => $isSiddh // ✅ Database Column ke hisab se
            ];
        } else {
            // 🛒 CART BUY LOGIC
            $cartItems = Cart::with('product')->where('user_id', $user->id)->get();

            if ($cartItems->isEmpty()) {
                return response()->json(['status' => false, 'message' => 'Cart is empty!']);
            }

            foreach ($cartItems as $item) {
                $price = $item->product->price;
                $isSiddh = $item->is_siddh;

                if ($isSiddh == 1) {
                    $price += $item->product->siddh_price;
                }

                $totalAmount += $price * $item->quantity;

                $orderItemsData[] = [
                    'product_id' => $item->product_id,
                    'product_name' => $item->product->name,
                    'quantity' => $item->quantity,
                    'price' => $price,
                    'is_siddh' => $isSiddh // ✅ Database Column ke hisab se
                ];
            }
        }

        // -----------------------------
        // 3. CREATE ORDER IN DATABASE
        // -----------------------------
        $order = Order::create([
            'order_number' => 'ORD-' . strtoupper(Str::random(10)),
            'user_id' => $user->id,
            'shipping_address' => $finalAddress->toArray(), // ✅ Array pass karein, Model Cast handle karega
            'total_amount' => $totalAmount,
            'payment_method' => $request->payment_method,
            'status' => 'pending',
            'payment_status' => 'pending'
        ]);

        // -----------------------------
        // 4. SAVE ORDER ITEMS
        // -----------------------------
        foreach ($orderItemsData as $itemData) {
            // $order->items() relation use karke save karein
            $order->items()->create($itemData);
        }

        // -----------------------------
        // 5. PAYMENT HANDLING (Razorpay vs COD)
        // -----------------------------

        // ✅ RAZORPAY LOGIC
        if ($request->payment_method == 'RAZORPAY') {

            // 1. Get Keys from Admin Settings Table
            $paymentSetting = PaymentSetting::first();

            if (!$paymentSetting || !$paymentSetting->key_id) {
                return response()->json(['status' => false, 'message' => 'Payment Gateway Not Configured']);
            }

            $apiKey = $paymentSetting->key_id;
            $apiSecret = $paymentSetting->key_secret;

            // 2. Initialize Razorpay API
            $api = new Api($apiKey, $apiSecret);

            // 3. Create Razorpay Order
            $rzpOrder = $api->order->create([
                'receipt'         => (string) $order->id,
                'amount'          => $totalAmount * 100, // Amount in Paise
                'currency'        => 'INR',
                'payment_capture' => 1
            ]);

            // 4. Return JSON for Frontend Popup
            return response()->json([
                'status' => 'razorpay',
                'key' => $apiKey,
                'amount' => $totalAmount * 100,
                'currency' => 'INR',
                'name' => 'Suyagya Store',
                'description' => 'Order #' . $order->order_number,
                'image' => asset('assets/img/logo.png'),
                'order_id' => $order->id,        // Local DB ID
                'rzp_order_id' => $rzpOrder['id'], // Razorpay Order ID
                'prefill' => [
                    'name' => $user->name,
                    'email' => $user->email, // Email agar null hai to handle karein
                    'contact' => $user->phone
                ]
            ]);
        }

        // ✅ COD LOGIC
        else {
            // Cart Clear karein agar Cart Mode tha
            if ($request->buy_mode == 'cart') {
                Cart::where('user_id', $user->id)->delete();
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Order Placed Successfully via COD!'
            ]);
        }
    }

    // 🔍 Check Address by Pincode
    public function checkAddressByPincode($pincode)
    {
        $userId = Auth::id();

        // Is user ka koi address hai is pincode par? (Latest wala uthao)
        $existingAddress = UserAddress::where('user_id', $userId)
            ->where('pincode', $pincode)
            ->latest()
            ->first();

        if ($existingAddress) {
            return response()->json([
                'status' => true,
                'found' => true,
                'data' => $existingAddress
            ]);
        }

        return response()->json(['status' => true, 'found' => false]);
    }

    // 🟢 VERIFY PAYMENT API (Updated)
    public function verifyPayment(Request $request)
    {
        $setting = PaymentSetting::first();
        $api = new Api($setting->key_id, $setting->key_secret);

        try {
            // 1. Signature Verify karein
            // Note: Keys ke naam exact yehi hone chahiye
            $attributes = [
                'razorpay_order_id' => $request->razorpay_order_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_signature' => $request->razorpay_signature
            ];

            $api->utility->verifyPaymentSignature($attributes);

            // 2. Agar Verify ho gaya -> Database Update
            $order = Order::findOrFail($request->order_id);

            // Payment Status Paid Mark karein
            $order->update([
                'payment_status' => 'paid',
                'transaction_id' => $request->razorpay_payment_id,
                'status' => 'processing' // Optional: Pending se Processing kar dein
            ]);

            // 3. Empty Cart (Agar pehle nahi kiya tha)
            Cart::where('user_id', Auth::id())->delete();

            return response()->json(['status' => true, 'message' => 'Payment Verified']);

        } catch (\Exception $e) {
            // ❌ Verification Failed
            return response()->json([
                'status' => false,
                'message' => 'Payment Verification Failed: ' . $e->getMessage()
            ]);
        }
    }

    // 🔄 AJAX: Fetch User Data & Addresses after Login
    public function getUserCheckoutData()
    {
        $user = Auth::user();
        $addresses = $user->addresses;

        // Render HTML from the new partial file
        $html = view('frontend.includes.checkout_address_list', compact('addresses'))->render();

        return response()->json([
            'status' => true,
            'user_name' => $user->name,
            'user_phone' => $user->phone,
            'has_address' => $addresses->count() > 0,
            'html' => $html
        ]);
    }
}
