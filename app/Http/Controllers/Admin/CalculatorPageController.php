<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CalculatorPage;
use App\Models\SubCategory;
use App\Models\Category;
use File;

class CalculatorPageController extends Controller
{
    public function index()
    {
        $calculatorCategory = Category::where('slug', 'LIKE', '%calculator%')->first();
        $subCategories = $calculatorCategory ? SubCategory::where('category_id', $calculatorCategory->id)->get() : collect();

        return view('admin.calculator.manager', compact('subCategories'));
    }

    // AJAX Call: जब सब-कैटेगरी बदली जाएगी तो डेटा लोड करने के लिए
    public function loadData($subCategoryId)
    {
        $subCat = SubCategory::findOrFail($subCategoryId);

        // 🚀 FIX: यहाँ से with('featuredProducts') हटा दिया है क्योंकि अब हम ऑटो-मैप कर रहे हैं
        $pageData = CalculatorPage::where('sub_category_id', $subCategoryId)->first();

        return response()->json([
            'status' => true,
            'data' => $pageData,
            'sub_category_slug' => $subCat->slug
        ]);
    }

    public function saveData(Request $request)
    {
        $subCat = SubCategory::findOrFail($request->sub_category_id);

        $page = CalculatorPage::updateOrCreate(
            ['sub_category_id' => $request->sub_category_id],
            [
                'category_id' => $subCat->category_id,
                'sub_category_slug' => $subCat->slug,
                'page_title' => $request->page_title,
                'hero_title' => $request->hero_title,
                'hero_short_desc' => $request->hero_short_desc,
                'about_title' => $request->about_title,
                'about_desc' => $request->about_desc,
                'content_title' => $request->content_title,
                'content_body' => $request->content_body,
                'product_recommendation_title' => $request->product_recommendation_title,
                'spiritual_title' => $request->spiritual_title,
                'spiritual_desc' => $request->spiritual_desc,
                'benefits_title' => $request->benefits_title,
                'benefits_desc' => $request->benefits_desc,
                'how_to_wear_title' => $request->how_to_wear_title,
                'how_to_wear_desc' => $request->how_to_wear_desc,
                'what_is_calculator_title' => $request->what_is_calculator_title,
                'what_is_calculator_desc' => $request->what_is_calculator_desc,
                'how_to_use_title' => $request->how_to_use_title,
                'how_to_use_desc' => $request->how_to_use_desc,
                'conclusion' => $request->conclusion,
                'faqs' => $request->faqs ? array_values($request->faqs) : null,
                'testimonials' => $request->testimonials ? array_values($request->testimonials) : null,
            ]
        );

        // 🖼️ Image Upload Handle logic
        $images = ['hero_banner', 'about_banner', 'spiritual_image', 'how_to_wear_image'];
        foreach ($images as $img) { // 🚀 FIX: foreach ($images as 'img') में से कोट्स हटाकर वेरिएबल $img किया
            if ($request->hasFile($img)) {
                if ($page->$img && File::exists(public_path($page->$img))) {
                    File::delete(public_path($page->$img));
                }
                $filename = time() . '_' . $img . '.' . $request->file($img)->getClientOriginalExtension();
                $request->file($img)->move(public_path('uploads/calculators'), $filename);
                $page->$img = 'uploads/calculators/' . $filename;
            }
        }
        $page->save();

        // 🚀 FIX: यहाँ से पुराना featuredProducts वाला कोड पूरी तरह हटा दिया गया है
        // क्योंकि अब प्रोडक्ट्स सीधे sub_category_id के आधार पर फ्रंटएंड पर अपने आप फेच होंगे।

        return redirect()->back()->with('success', 'Calculator Content Saved Successfully!');
    }
}
