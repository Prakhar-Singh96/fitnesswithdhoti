<?php

namespace App\Services;

use Illuminate\Support\Facades\Http; // 👈 Twilio hataya, Http client lagaya
use Illuminate\Support\Facades\Log;

class SmsService
{
    /**
     * Send OTP via MSG91
     */
    public function sendOtp($phone, $otp)
    {
        // 1. Phone Formatting (MSG91 Logic)
        // Twilio ko '+' chahiye tha, par MSG91 ko '+' NAHI chahiye.
        // Agar number "+91987..." hai to bas "91987..." chahiye.

        $cleanPhone = str_replace('+', '', $phone);

        // Safety: Agar galti se user ne bina country code ke 10 digit daale
        if (strlen($cleanPhone) == 10) {
            $cleanPhone = '91' . $cleanPhone;
        }

        try {
            // 2. MSG91 API Call
            $response = Http::post('https://control.msg91.com/api/v5/otp', [
                'template_id' => env('MSG91_TEMPLATE_ID'),
                'mobile'      => $cleanPhone,
                'authkey'     => env('MSG91_AUTH_KEY'),
                'otp'         => $otp
            ]);

            $result = $response->json();

            // Debugging ke liye log kar sakte hain (Optional)
            // Log::info("MSG91 Response: " . json_encode($result));

            // 3. Return Array (Boolean nahi)
            // MSG91 success hone par 'type' => 'success' bhejta hai
            if (isset($result['type']) && $result['type'] == 'success') {
                return [
                    'status' => true,
                    'message' => 'OTP Sent Successfully!'
                ];
            } else {
                // Agar fail hua to MSG91 ka error message pakdo
                $errorMsg = $result['message'] ?? 'SMS Sending Failed';
                Log::error("MSG91 API Error: " . $errorMsg);

                return [
                    'status' => false,
                    'message' => $errorMsg
                ];
            }

        } catch (\Exception $e) {
            Log::error("MSG91 Connection Exception: " . $e->getMessage());
            return [
                'status' => false,
                'message' => 'Server Error: Could not connect to SMS Gateway'
            ];
        }
    }
}
