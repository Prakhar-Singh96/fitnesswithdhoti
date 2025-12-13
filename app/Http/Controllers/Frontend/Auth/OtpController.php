<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class OtpController extends Controller
{
    // 1. Send OTP
    public function sendOtp(Request $request)
    {
        $request->validate([
            'phone' => 'required|numeric|digits:10'
        ]);

        $phone = $request->phone;

        // Generate Random OTP
        $otp = rand(1000, 9999);

        // Save OTP in Cache for 5 minutes (Key: otp_9876543210)
        Cache::put('otp_' . $phone, $otp, 300);

        // 🔴 REAL PROJECT MEIN YAHAN SMS API CODE AAYEGA
        // Filhal hum Log file me OTP dekh lenge testing ke liye
        Log::info("OTP for {$phone} is: {$otp}");

        return response()->json([
            'status' => true,
            'message' => 'OTP Sent Successfully! (Check Log for code)',
            // 'dev_otp' => $otp // Testing ke liye frontend pe bhej sakte ho, production me hata dena
        ]);
    }

    // 2. Verify OTP & Login/Register
    public function loginWithOtp(Request $request)
    {
        $request->validate([
            'phone' => 'required|numeric',
            'otp' => 'required|numeric'
        ]);

        $phone = $request->phone;
        $otp = $request->otp;

        // Check Cached OTP
        $cachedOtp = Cache::get('otp_' . $phone);

        if ($cachedOtp && $cachedOtp == $otp) {

            // ✅ Find or Create User (Auto Registration)
            $user = User::firstOrCreate(
                ['phone' => $phone],
                [
                    'name' => 'User ' . substr($phone, -4), // Default Name
                    'email' => null,
                    'password' => null
                ]
            );

            // 🔥 Manually Login User
            Auth::login($user);

            // Clear OTP from cache
            Cache::forget('otp_' . $phone);

            return response()->json(['status' => true, 'message' => 'Login Successful!']);
        }

        return response()->json(['status' => false, 'message' => 'Invalid OTP!'], 401);
    }

    // 3. Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
