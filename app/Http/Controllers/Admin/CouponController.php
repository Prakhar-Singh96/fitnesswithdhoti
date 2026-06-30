<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;

class CouponController extends Controller
{
    // 1. List Page
    public function index()
    {
        $coupons = Coupon::latest()->get();
        return view('admin.coupons.index', compact('coupons'));
    }

    // ✅ 2. Show Create Form (Ye Missing Tha)
    public function create()
    {
        $products = \App\Models\Product::where('status', 1)->get(); // सारे प्रोडक्ट्स लायें
        return view('admin.coupons.create', compact('products'));
    }

    // 3. Store Logic
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:coupons,code',
            'type' => 'required|in:fixed,percent',
            'value' => 'required|numeric',
            'cod_value' => 'required|numeric', // 👈 नया
            'expires_at' => 'nullable|date',
            'product_ids' => 'nullable|array', // 👈 नया
            'status' => 'nullable|boolean' // Optional: Status field agar ho
        ]);

        // Status checkbox handling
        $data = $request->all();
        $data['status'] = $request->has('status') ? 1 : 0;

        Coupon::create($data);

        return redirect()->route('admin.coupons.index')->with('success', 'Coupon Created Successfully');
    }

    // ✅ 4. Show Edit Form (Ye bhi Missing Tha)
    public function edit($id)
    {
        $coupon = Coupon::findOrFail($id);
        $products = \App\Models\Product::where('status', 1)->get();
        return view('admin.coupons.edit', compact('coupon', 'products'));
    }

    // 5. Update Logic
    public function update(Request $request, $id)
    {
        $coupon = Coupon::findOrFail($id);

        $request->validate([
            'code' => 'required|unique:coupons,code,' . $id, // Ignore current ID
            'type' => 'required|in:fixed,percent',
            'value' => 'required|numeric',
            'cod_value' => 'required|numeric', // 👈 नया
            'expires_at' => 'nullable|date',
            'product_ids' => 'nullable|array', // 👈 नया
        ]);

        $data = $request->all();
        $data['status'] = $request->has('status') ? 1 : 0;
        $data['product_ids'] = $request->product_ids ?? null;

        $coupon->update($data);

        return redirect()->route('admin.coupons.index')->with('success', 'Coupon Updated Successfully');
    }

    // 6. Delete Logic
    public function destroy($id)
    {
        Coupon::findOrFail($id)->delete();
        return back()->with('success', 'Coupon Deleted Successfully');
    }
}
