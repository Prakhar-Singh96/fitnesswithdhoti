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
}
