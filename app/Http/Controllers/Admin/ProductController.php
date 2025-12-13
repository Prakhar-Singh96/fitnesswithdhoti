<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Filter;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    // 1. List Products
    public function index()
    {
        // Eager load category and subcategory for performance
        $products = Product::with(['category', 'subCategory'])->latest()->get();
        return view('admin.products.index', compact('products'));
    }

    // 2. Show Create Form
    public function create()
    {
        $categories = Category::where('status', 1)->get();
        $subCategories = SubCategory::where('status', 1)->get();

        // Filters with their values (For Filter Selection)
        $filters = Filter::with('filterValues')->get();

        return view('admin.products.create', compact('categories', 'subCategories', 'filters'));
    }

    // 3. Store Product Logic
    public function store(Request $request)
    {
        // A. Validation
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug',
            'category_id' => 'required|exists:categories,id',
            'mrp_price' => 'required|numeric|min:0',
            'price' => 'nullable|numeric|min:0',
            // Discount ab optional ho sakta hai, agar nahi diya to 0 manenge
            'discount' => 'nullable|numeric|min:0|max:100',
            'quantity' => 'required|integer',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            // Gallery Images
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        try {
            DB::beginTransaction(); // Transaction start (Rollback if error)

            // B. Save Product Basic Info
            $data = $request->except(['main_image', 'gallery_images', 'filter_values']);

            // --- 💡 INTELLIGENT PRICE CALCULATION ---
            $mrp = $request->mrp_price;
            $inputPrice = $request->price;       // User ne jo Selling Price dala
            $inputDiscount = $request->discount; // User ne jo Discount dala

            // Case A: User ne Selling Price dala hai
            if ($request->filled('price') && $mrp > 0) {
                $sellingPrice = $inputPrice;
                // Calculate Discount % automatically: ((MRP - SP) / MRP) * 100
                $calculatedDiscount = (($mrp - $sellingPrice) / $mrp) * 100;
                $discount = $calculatedDiscount;
            }
            // Case B: User ne Selling Price nahi dala, par Discount dala hai
            elseif ($request->filled('discount')) {
                $discount = $inputDiscount;
                // Calculate Price automatically: MRP - (MRP * Discount%)
                $sellingPrice = $mrp - ($mrp * $discount / 100);
            }
            // Case C: Kuch nahi dala (Default)
            else {
                $sellingPrice = $mrp;
                $discount = 0;
            }

            // Final values set karein
            $data['price'] = round($sellingPrice, 2);
            $data['discount'] = round($discount, 2);

            // Main Image Upload (Using Helper)
            $data['main_image'] = uploadImage($request, 'main_image', 'uploads/products/main');
            $data['og_image'] = uploadImage($request, 'og_image', 'uploads/products/og');

            // 🕒 1. Timer Logic
            // Admin form me 'offer_hours' name ka input hoga (e.g., 12)
            // if ($request->filled('offer_hours')) {
            //     // Abhi ke time me utne ghante jod do
            //     $data['offer_end_time'] = now()->addHours($request->offer_hours);
            // }

            // 🕉️ 2. Siddh Logic
            $data['is_siddh_enabled'] = $request->has('is_siddh_enabled') ? 1 : 0;
            $data['siddh_price'] = $request->siddh_price ?? 0;

            // Inside store() and update() methods
            $data['emi_available'] = $request->has('emi_available') ? 1 : 0;
            // $data['delivery_days'] = $request->input('delivery_days', 7);

            $product = Product::create($data);

            // C. Save Gallery Images with Alt Text
            if ($request->hasFile('gallery_images')) {
                $alts = $request->gallery_alts ?? []; // Alt texts ka array

                foreach ($request->file('gallery_images') as $index => $file) {
                    $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('uploads/products/gallery'), $filename);

                    ProductImage::create([
                        'product_id' => $product->id,
                        'image' => 'uploads/products/gallery/' . $filename,
                        'alt' => $alts[$index] ?? null, // Save corresponding alt text
                    ]);
                }
            }

            // D. Sync Filters (Many-to-Many)
            // Form se filter_values array aayega (e.g., [1, 5, 8])
            if ($request->has('filter_values')) {
                $product->filterValues()->sync($request->filter_values);
            }

            DB::commit(); // Save Everything
            return redirect()->route('admin.products.index')->with('success', 'Product created successfully!');
        } catch (\Exception $e) {
            DB::rollback(); // Undo if something goes wrong
            return back()->withErrors(['error' => 'Something went wrong: ' . $e->getMessage()]);
        }
    }

    // 4. Show Edit Form
    public function edit($id)
    {
        $product = Product::with(['images', 'filterValues'])->findOrFail($id);
        $categories = Category::where('status', 1)->get();
        $subCategories = SubCategory::where('category_id', $product->category_id)->get(); // Load relevant subcategories
        $filters = Filter::with('filterValues')->get();

        // Get selected filter values as array
        $selectedFilters = $product->filterValues->pluck('id')->toArray();

        return view('admin.products.edit', compact('product', 'categories', 'subCategories', 'filters', 'selectedFilters'));
    }

    // 5. Update Product
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug,' . $id,
            'category_id' => 'required|exists:categories,id',
            'mrp_price' => 'required|numeric|min:0',
            'price' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0|max:100',
        ]);

        try {
            DB::beginTransaction();

            $data = $request->except(['main_image', 'gallery_images', 'filter_values']);

            // --- 💡 INTELLIGENT PRICE CALCULATION ---
            $mrp = $request->mrp_price;
            $inputPrice = $request->price;       // User ne jo Selling Price dala
            $inputDiscount = $request->discount; // User ne jo Discount dala

            // Case A: User ne Selling Price dala hai
            if ($request->filled('price') && $mrp > 0) {
                $sellingPrice = $inputPrice;
                // Calculate Discount % automatically: ((MRP - SP) / MRP) * 100
                $calculatedDiscount = (($mrp - $sellingPrice) / $mrp) * 100;
                $discount = $calculatedDiscount;
            }
            // Case B: User ne Selling Price nahi dala, par Discount dala hai
            elseif ($request->filled('discount')) {
                $discount = $inputDiscount;
                // Calculate Price automatically: MRP - (MRP * Discount%)
                $sellingPrice = $mrp - ($mrp * $discount / 100);
            }
            // Case C: Kuch nahi dala (Default)
            else {
                $sellingPrice = $mrp;
                $discount = 0;
            }

            // Final values set karein
            $data['price'] = round($sellingPrice, 2);
            $data['discount'] = round($discount, 2);
            // -----------------------------------------

            // Main Image Update
            if ($request->hasFile('main_image')) {
                deleteImage($product->main_image);
                $data['main_image'] = uploadImage($request, 'main_image', 'uploads/products/main');
            }
            if ($request->hasFile('og_image')) {
                deleteImage($product->og_image);
                $data['og_image'] = uploadImage($request, 'og_image', 'uploads/products/og');
            }

            // 🕒 1. Timer Logic
            // Admin form me 'offer_hours' name ka input hoga (e.g., 12)
            // if ($request->filled('offer_hours')) {
            //     // Abhi ke time me utne ghante jod do
            //     $data['offer_end_time'] = \Carbon\Carbon::now()->addHours($request->offer_hours);
            // }

            // 🕉️ 2. Siddh Logic
            $data['is_siddh_enabled'] = $request->has('is_siddh_enabled') ? 1 : 0;
            $data['siddh_price'] = $request->siddh_price ?? 0;

            // Inside store() and update() methods
            $data['emi_available'] = $request->has('emi_available') ? 1 : 0;
            // $data['delivery_days'] = $request->input('delivery_days', 7);

            $product->update($data);

            // Gallery Update (Add New ones)
            // if ($request->hasFile('gallery_images')) {
            //     foreach ($request->file('gallery_images') as $file) {
            //         $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            //         $file->move(public_path('uploads/products/gallery'), $filename);

            //         ProductImage::create([
            //             'product_id' => $product->id,
            //             'image' => 'uploads/products/gallery/' . $filename
            //         ]);
            //     }
            // }
            // 🟢 3. UPDATE EXISTING GALLERY ALT TEXTS
            if ($request->has('existing_alts')) {
                foreach ($request->existing_alts as $imageId => $altText) {
                    ProductImage::where('id', $imageId)->update(['alt' => $altText]);
                }
            }

            // 🟢 4. UPLOAD NEW GALLERY IMAGES WITH ALT TEXT
            if ($request->hasFile('gallery_images')) {
                $newAlts = $request->gallery_alts ?? []; // New images ke alt texts

                foreach ($request->file('gallery_images') as $index => $file) {
                    $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('uploads/products/gallery'), $filename);

                    ProductImage::create([
                        'product_id' => $product->id,
                        'image' => 'uploads/products/gallery/' . $filename,
                        'alt' => $newAlts[$index] ?? null, // Index match karke alt save karein
                    ]);
                }
            }

            // Sync Filters
            if ($request->has('filter_values')) {
                $product->filterValues()->sync($request->filter_values);
            } else {
                $product->filterValues()->detach(); // Remove all if none selected
            }

            DB::commit();
            return redirect()->route('admin.products.index')->with('success', 'Product updated successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors(['error' => 'Update failed: ' . $e->getMessage()]);
        }
    }

    // 6. Delete Product
    public function destroy($id)
    {
        $product = Product::with('images')->findOrFail($id);

        // Delete Main Image
        deleteImage($product->main_image);
        deleteImage($product->og_image);

        // Delete Gallery Images
        foreach ($product->images as $img) {
            deleteImage($img->image);
            $img->delete();
        }

        $product->delete(); // Filters pivot table automatically handles cleanup via DB constraints usually, or manually detach

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully!');
    }

    function getSubCategories($categoryId)
    {
        $subs = SubCategory::where('category_id', $categoryId)->where('status', 1)->get();
        return response()->json($subs);
    }

    function deleteGalleryImage($id)
    {
        $img = ProductImage::findOrFail($id);
        deleteImage($img->image);
        $img->delete();
        return response()->json(['success' => true]);
    }
}
