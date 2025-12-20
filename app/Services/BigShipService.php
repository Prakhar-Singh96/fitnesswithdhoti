<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class BigShipService
{
    protected $baseUrl = 'https://api.bigship.in/';
    protected $email = 'tptcworld@gmail.com'; // .env file se lein
    protected $password = 'PassWord@4321'; // .env file se lein
    protected $access_key = '6e5c54156c2a2b495608f10d8d99ddc76cd0566ac91135608f3b11e0685705be';

    // 1. Login & Get Token
    public function getToken()
    {
        // Cache for 11 hours (Kyuki token 12 hours valid rehta hai)
        return Cache::remember('bigship_token', 39600, function () {

            // 🔥 1. Payload update (user_name instead of email)
            $response = Http::post("{$this->baseUrl}api/login/user", [
                'user_name'  => $this->email, // Doc ke hisab se 'user_name'
                'password'   => $this->password,
                'access_key' => $this->access_key
            ]);

            $data = $response->json();

            // Debugging: Agar ab bhi error aaye to response dekhein
            if (!$response->successful() || !isset($data['data']['token'])) {
                // dd('BigShip Login Error:', $data); // Uncomment for debugging
                return null;
            }

            // 🔥 2. Token ab 'data' key ke andar hai
            return $data['data']['token'];
        });
    }

    // 2. Check Rates & Delivery Time (Updated for api/calculator)
    // 2. Check Rates & Delivery Time
    public function checkServiceability($pickupPin, $destPin, $weight, $price)
    {
        $token = $this->getToken();

        if (!$token) {
            return ['status' => false, 'message' => 'Authentication Failed'];
        }

        // 🔥 Payload (Data Types ko Cast kiya hai taaki API reject na kare)
        $payload = [
            "shipment_category" => "B2C",
            "payment_type"      => "COD",
            "pickup_pincode"    => (int) $pickupPin,      // Integer zaroori hai
            "destination_pincode" => (int) $destPin,      // Integer zaroori hai
            "shipment_invoice_amount" => (float) $price,  // Float/Decimal zaroori hai
            "risk_type"         => "",
            "box_details"       => [
                [
                    "each_box_dead_weight" => (float) $weight,
                    "each_box_length" => 10,
                    "each_box_width"  => 10,
                    "each_box_height" => 10,
                    "box_count"       => 1
                ]
            ]
        ];

        // 🔥 FIX URL: 'api/calculator' sahi endpoint hai
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Content-Type'  => 'application/json'
        ])->post("{$this->baseUrl}api/calculator", $payload);

        if ($response->successful()) {
            $data = $response->json();

            // Check if data exists and is not empty
            if (isset($data['data']) && is_array($data['data']) && count($data['data']) > 0) {

                // Couriers list ko collect karein
                $couriers = collect($data['data']);

                // 🔥 Sort by TAT (Time) - Jiska TAT sabse kam ho (Fastest)
                $fastest = $couriers->sortBy('tat')->first();

                if ($fastest) {
                    return [
                        'status' => true,
                        'days'   => $fastest['tat'], // Return Days (e.g., 3)
                        'courier' => $fastest['courier_name'],
                        'price'  => $fastest['total_shipping_charges'],
                        'message' => 'Available'
                    ];
                }
            }
        }

        // Error checking (Optional: Log response to see why it failed)
        // \Log::error('BigShip Error: ' . $response->body());

        return ['status' => false, 'message' => 'Service not available.'];
    }

    // 3. Track Shipment Function (Updated as per BigShip Docs)
    public function trackShipment($awbNumber)
    {
        $token = $this->getToken();

        if (!$token) {
            return ['status' => false, 'message' => 'Authentication Failed'];
        }

        // 🔥 API Call: /api/tracking
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Content-Type'  => 'application/json'
        ])->get("{$this->baseUrl}api/tracking", [
            'tracking_type' => 'awb',      // Hum AWB use kar rahe hain
            'tracking_id'   => $awbNumber  // User ka input
        ]);

        if ($response->successful()) {
            $result = $response->json();

            // Check if API returned success: true
            if (isset($result['success']) && $result['success'] == true) {
                return [
                    'status' => true,
                    'data' => $result['data'] // Isme 'order_detail' aur 'scan_histories' dono hain
                ];
            }
        }

        return ['status' => false, 'message' => 'No tracking history found for this AWB.'];
    }

    // ================= NEW FUNCTIONS FOR LOGISTIC MODULE =================

    // 4. Get Warehouse List
    public function getWarehouses()
    {
        $token = $this->getToken();
        $response = Http::withHeaders(['Authorization' => 'Bearer ' . $token])
                        ->get("{$this->baseUrl}api/warehouse/get/list?page_index=1&page_size=50");
        return $response->json()['data']['result_data'] ?? [];
    }

    // 5. Add Single Order (Create Order)
    // 5. Add Single Order (Fixed Product, Name & Document Logic)
    public function addSingleOrder($order, $warehouseId, $weight, $dimensions)
    {
        $token = $this->getToken();
        $addr = is_array($order->shipping_address) ? $order->shipping_address : json_decode($order->shipping_address, true);

        // 🔥 FIX 1: Name Validation Logic
        // BigShip ko Last Name min 3 chars chahiye.
        // Agar naam single hai (e.g. "Prakhar"), to Last Name empty hoga.
        // Hum Last Name mein bhi First Name daal denge ya "Customer" likh denge.
        $fullName = trim($addr['name']);
        $parts = explode(' ', $fullName, 2);
        $firstName = $parts[0];
        $lastName = isset($parts[1]) ? $parts[1] : $firstName; // Agar last name nahi hai to first name hi use karo

        // Agar ab bhi Last Name 3 chars se chhota hai (e.g. "Om"), to padding lagao
        if (strlen($lastName) < 3) {
            $lastName .= "   "; // Spaces add karke length badhao
        }

        $isCOD = $order->payment_method == 'COD';
        $totalValue = (float) $order->total_amount;

        // 🔥 FIX 2: Dynamic Products Logic (Loop through items)
        $productList = [];

        // Items load karein
        if($order->relationLoaded('items')){
             $items = $order->items;
        } else {
             $items = $order->items()->get();
        }

        foreach ($items as $item) {
            $productPrice = (float) $item->price;

            $productList[] = [
                "product_category" => "Others",
                "product_sub_category" => "General",
                // Name ko limit karein taaki API error na de
                "product_name" => substr($item->product_name ?? 'Item', 0, 40),
                "product_quantity" => (int) $item->quantity,
                "each_product_invoice_amount" => $productPrice,
                "each_product_collectable_amount" => $isCOD ? $productPrice : 0,
                "hsn" => ""
            ];
        }

        // Payload Construct
        $payload = [
            "shipment_category" => "b2c",
            "warehouse_detail" => [
                "pickup_location_id" => (int)$warehouseId,
                "return_location_id" => (int)$warehouseId
            ],
            "consignee_detail" => [
                "first_name" => $firstName,
                "last_name" => trim($lastName), // Trim spaces
                "company_name" => "Personal",
                "contact_number_primary" => substr($addr['phone'], -10),
                "email_id" => $order->user->email ?? "support@suyagya.com",
                "consignee_address" => [
                    "address_line1" => substr($addr['address_line1'], 0, 50),
                    "address_line2" => "",
                    "pincode" => (string)$addr['pincode']
                ]
            ],
            "order_detail" => [
                "invoice_date" => now()->format('Y-m-d\TH:i:s.000\Z'),
                "invoice_id" => $order->order_number,
                "payment_type" => $isCOD ? "COD" : "Prepaid",
                "shipment_invoice_amount" => $totalValue,
                "total_collectable_amount" => $isCOD ? $totalValue : 0,
                "box_details" => [
                    [
                        "each_box_dead_weight" => (float)$weight,
                        "each_box_length" => (int)$dimensions['length'],
                        "each_box_width" => (int)$dimensions['width'],
                        "each_box_height" => (int)$dimensions['height'],
                        "each_box_invoice_amount" => $totalValue,
                        "each_box_collectable_amount" => $isCOD ? $totalValue : 0,
                        "box_count" => 1,
                        "product_details" => $productList // ✅ Ab asli products jayenge
                    ]
                ],
                "ewaybill_number" => "",
                // 🔥 FIX 3: Document Detail Added
                "document_detail" => [
                    "invoice_document_file" => "",
                    "ewaybill_document_file" => ""
                ]
            ]
        ];

        // API Call
        $response = Http::withHeaders(['Authorization' => 'Bearer ' . $token, 'Content-Type' => 'application/json'])
                        ->post("{$this->baseUrl}api/order/add/single", $payload);

        // Debugging Code (Sirf tab chalega jab error aayega)
        if (!$response->successful()) {
             dd($response->json(), $payload);
        }

        return $response->json();
    }

    // 6. Get Shipping Rates (Courier List Fetch)
    public function getShippingRates($systemOrderId)
    {
        $token = $this->getToken();
        $response = Http::withHeaders(['Authorization' => 'Bearer ' . $token])
                        ->get("{$this->baseUrl}api/order/shipping/rates", [
                            'shipment_category' => 'B2C',
                            'system_order_id'   => $systemOrderId
                        ]);

        return $response->json()['data'] ?? [];
    }

    // 7. Manifest Order (Final Ship)
    public function manifestOrder($systemOrderId, $courierId)
    {
        $token = $this->getToken();
        $response = Http::withHeaders(['Authorization' => 'Bearer ' . $token, 'Content-Type' => 'application/json'])
                        ->post("{$this->baseUrl}api/order/manifest/single", [
                            "system_order_id" => (int)$systemOrderId,
                            "courier_id" => (int)$courierId
                        ]);
        return $response->json();
    }

    // 8. Get Shipment Data (1=AWB, 2=Label)
    public function getShipmentData($systemOrderId, $type = 1)
    {
        $token = $this->getToken();
        $response = Http::withHeaders(['Authorization' => 'Bearer ' . $token])
                        ->post("{$this->baseUrl}api/shipment/data?shipment_data_id={$type}&system_order_id={$systemOrderId}");
        return $response->json();
    }

    // 9. Cancel Order
    public function cancelOrder($awbNumber)
    {
        $token = $this->getToken();
        $response = Http::withHeaders(['Authorization' => 'Bearer ' . $token, 'Content-Type' => 'application/json'])
                        ->put("{$this->baseUrl}api/order/cancel", [(string)$awbNumber]);
        return $response->json();
    }
}
