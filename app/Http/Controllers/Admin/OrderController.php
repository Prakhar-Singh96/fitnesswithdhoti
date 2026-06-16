<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use App\Models\ReferralCoupon;
use App\Models\WalletTransaction;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Saare orders latest pehle layenge
        $orders = Order::with('user')->latest()->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Admin side se order create karne ki zarurat kam padti hai
        return abort(404);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Not needed for now
    }

    /**
     * Display the specified resource.
     * Isme hum Order ki details aur Update Form dikhayenge
     */
    public function show(string $id)
    {
        $order = Order::with(['items.product', 'user'])->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Hum 'show' page par hi edit ka option denge, alag page ki zarurat nahi
        return abort(404);
    }

    /**
     * Update the specified resource in storage.
     * 🟢 MAIN LOGIC: Status Update + Tracking Info
     */
    public function update(Request $request, string $id)
    {
        $order = Order::findOrFail($id);
        $oldStatus = $order->status; // पुराना स्टेटस याद रखें

        // 1. Basic Validation
        $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,cancelled',
            'payment_status' => 'required|in:pending,paid,failed',
        ]);

        $data = [
            'status' => $request->status,
            'payment_status' => $request->payment_status,
        ];

        // 2. 🚚 Tracking Logic: Agar Status 'Shipped' hai, to details zaroori hain
        if ($request->status == 'shipped') {

            $request->validate([
                'awb_number' => 'required|string',
                'courier_name' => 'required|string',
            ], [
                'awb_number.required' => 'Tracking ID (AWB) is required when marking as Shipped.',
                'courier_name.required' => 'Courier Name is required when marking as Shipped.'
            ]);

            $data['awb_number'] = $request->awb_number;
            $data['courier_name'] = $request->courier_name;
            // अगर ट्रैकिंग यूआरएल खाली है तो डिफ़ॉल्ट इंडिया पोस्ट या सेफ फॉलबैक यूआरएल दे दो भाई
            $data['tracking_url'] = $request->tracking_url;
            $data['expected_delivery_date'] = $request->expected_delivery_date;
        }

        // 🚀 REFERRAL REWARD LOGIC: अगर स्टेटस 'delivered' हो रहा है
        if ($request->status == 'delivered' && $oldStatus != 'delivered') {
            if ($order->refer_code_used && $order->cashback_status != 'referral_paid') {
                $refCoupon = ReferralCoupon::where('code', $order->refer_code_used)->first();

                if ($refCoupon && $refCoupon->user_id != $order->user_id) {
                    $referrer = $refCoupon->user;

                    DB::transaction(function () use ($referrer, $order, &$data) {
                        $referrer->increment('wallet_balance', 25);

                        WalletTransaction::create([
                            'user_id' => $referrer->id,
                            'order_id' => $order->id,
                            'amount' => 25,
                            'type' => 'credit',
                            'description' => 'Referral Bonus for Order #' . $order->order_number
                        ]);

                       $data['cashback_status'] = 'referral_paid';
                    });
                }
            }
        }

        // 3. Update Database
        $order->update($data);

        // 🚀 4. AUTOMATED WHATSAPP TRIGGER: अगर स्टेटस अभी-अभी 'shipped' हुआ है!
        if ($request->status == 'shipped' && $oldStatus != 'shipped') {
            $this->sendOrderTrackingWhatsApp($order->id);
        }

        return redirect()->back()->with('success', 'Order Status Updated and Tracking Notification Sent!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = Order::findOrFail($id);

        // Pehle items delete karein (Agar cascade delete DB me nahi hai to)
        $order->items()->delete();

        // Phir order delete karein
        $order->delete();

        return redirect()->route('admin.orders.index')->with('success', 'Order Deleted Successfully!');
    }

    private function sendOrderTrackingWhatsApp($orderId)
    {
        try {
            $order = Order::find($orderId);
            if (!$order) return;

            // शिपिंग एड्रेस पार्सर
            $shippingAddress = is_string($order->shipping_address)
                ? json_decode($order->shipping_address, true)
                : $order->shipping_address;

            if (empty($shippingAddress) || !isset($shippingAddress['phone'])) {
                return;
            }

            // फोन नंबर को साफ़ करके 91 फ़ॉर्मैट में लाएं
            $customerPhone = preg_replace('/[^0-9]/', '', $shippingAddress['phone']);
            if (strlen($customerPhone) === 10) {
                $customerPhone = '91' . $customerPhone;
            }

            // क्रेडेंशियल्स
            $endpointUrl = "https://messaginghub.solutions/relaybridge/api/v1/meta/6a2cfb3f8c93be1e2a1edb90/messages";
            $apiKey = "4388e9f3e6984c89af1aaa57e82b53a7";

            $customerName = $shippingAddress['name'] ?? 'Customer';
            $orderNumber = $order->order_number;
            $trackingId = $order->awb_number;
            $trackingLink = $order->tracking_url ?? 'https://www.indiapost.gov.in/';

            // 🚀 स्वीकृत टेम्पलेट (order_tracking) के 4 वेरिएबल्स का सटीक पेलोड एरे
            $payload = [
                "messaging_product" => "whatsapp",
                "recipient_type"    => "individual",
                "to"                => $customerPhone,
                "type"              => "template",
                "template"          => [
                    "name"     => "order_tracking", // 👈 आपका ट्रैकिंग टेम्पलेट नाम
                    "language" => [
                        "code" => "en"
                    ],
                    "components" => [
                        [
                            "type" => "body",
                            "parameters" => [
                                [
                                    "type" => "text",
                                    "text" => $customerName // 👈 {{1}} - Hi {{1}}
                                ],
                                [
                                    "type" => "text",
                                    "text" => $orderNumber // 👈 {{2}} - Your order with order ID {{2}}
                                ],
                                [
                                    "type" => "text",
                                    "text" => $trackingId // 👈 {{3}} - Tracking ID: {{3}}
                                ],
                                [
                                    "type" => "text",
                                    "text" => $trackingLink // 👈 {{4}} - track your shipment here: {{4}}
                                ]
                            ]
                        ]
                    ]
                ]
            ];

            // लारेवेल एचटीटीपी पोस्ट रिक्वेस्ट (बैकग्राउंड फ़ायरिंग)
            $response = \Illuminate\Support\Facades\Http::withHeaders([
                "X-API-KEY"    => $apiKey,
                "Content-Type" => "application/json"
            ])->post($endpointUrl, $payload);

            if ($response->successful()) {
                \Log::info("WhatsApp Tracking Notification Sent Automatically to Order #{$orderNumber}");
            } else {
                \Log::error("WhatsApp Tracking API Failed: " . $response->body());
            }

        } catch (\Exception $e) {
            \Log::error('WhatsApp Shipped Notification Exception: ' . $e->getMessage());
        }
    }
}
