<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\FilterController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Frontend\SearchController;
use App\Http\Controllers\Admin\FilterValueController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Frontend\Auth\OtpController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Frontend\ProductListingController;
use App\Http\Controllers\Frontend\ReviewController;
use App\Http\Controllers\Admin\Auth\LoginController as AdminLoginController;
use App\Http\Controllers\Seller\Auth\LoginController as SellerLoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('frontend.pages.home');
});

// Product Listing Pages
// 1. Category Page (e.g. /category/rudraksha)
Route::get('/category/{slug}', [ProductListingController::class, 'categoryProducts'])->name('products.category');

// 2. SubCategory Page (e.g. /category/rudraksha/mala)
Route::get('/category/{cat_slug}/{sub_slug}', [ProductListingController::class, 'subCategoryProducts'])->name('products.subcategory');

Route::get('/product/{slug}', [ProductListingController::class, 'productDetail'])->name('product.detail');

// Full Search Results Page (Product Listing jaisa)
Route::get('/search', [ProductListingController::class, 'searchListing'])->name('products.search_listing');

Route::get('/ajax-search', [SearchController::class, 'ajaxSearch'])->name('search.ajax');

Route::get('/check-pincode-delivery/{pincode}', [ProductListingController::class, 'checkPincode']);

// Cart Routes
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/update-quantity', [CartController::class, 'updateQuantity'])->name('cart.update.qty');
// Side Cart Quantity Update
Route::post('/cart/update-quantity-side', [CartController::class, 'updateSideCartQty']);
Route::get('/cart/side-cart-html', [CartController::class, 'getSideCartHtml']);

Route::post('/reviews/submit', [ReviewController::class, 'store'])->name('reviews.store');
Route::get('/reviews/filter', [ReviewController::class, 'filterReviews'])->name('reviews.filter');

// OTP Login Routes
Route::post('/send-otp', [OtpController::class, 'sendOtp'])->name('send.otp');
Route::post('/login-with-otp', [OtpController::class, 'loginWithOtp'])->name('login.otp');

// --- AUTHENTICATED USER ROUTES ---
Route::middleware(['auth'])->group(function () {

    // 1. Logout
    Route::post('/logout', [OtpController::class, 'logout'])->name('logout');

    // 2. User Profile & Orders
    Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::get('/my-orders', [UserController::class, 'orders'])->name('user.orders');

    // 3. Checkout Actions
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/save-address', [CheckoutController::class, 'saveAddress'])->name('checkout.save_address');
    Route::post('/checkout/place-order', [CheckoutController::class, 'placeOrder'])->name('checkout.place_order');
    Route::post('/checkout/save-address-ajax', [CheckoutController::class, 'saveAddressAjax'])->name('checkout.save_address_ajax');
    // Check if user already has address with this pincode
    Route::get('/checkout/check-address/{pincode}', [CheckoutController::class, 'checkAddressByPincode']);
    Route::post('/checkout/verify-payment', [CheckoutController::class, 'verifyPayment'])->name('checkout.verify_payment');
});

// --- ADMIN ROUTES ---
Route::prefix('admin')->name('admin.')->group(function () {

    // ==== LOGIN ROUTES ====
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login-submit', [AdminLoginController::class, 'login'])->name('login.submit');


    // ==== PROTECTED ADMIN ROUTES (SUPERADMIN ONLY) ====
    Route::middleware(['admin'])->group(function () {

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        Route::resource('categories', CategoryController::class);
        Route::resource('subcategories', SubCategoryController::class);
        Route::resource('products', ProductController::class);
        Route::resource('filters', FilterController::class);
        Route::resource('orders', OrderController::class);
        Route::resource('customers', CustomerController::class);
        Route::resource('filter-values', FilterValueController::class);
        // AJAX Routes for Product Page
        Route::get('get-subcategories/{categoryId}', [ProductController::class, 'getSubCategories']);
        Route::delete('delete-gallery-image/{id}', [ProductController::class, 'deleteGalleryImage']);

        // 💳 Payment Settings Routes
        Route::get('/payment-settings', [App\Http\Controllers\Admin\PaymentController::class, 'index'])->name('payment.settings');
        Route::post('/payment-settings/update', [App\Http\Controllers\Admin\PaymentController::class, 'update'])->name('payment.update');

        Route::post('/logout', [AdminLoginController::class, 'logout'])->name('logout');
    });
});

// --- SELLER ROUTES ---
Route::prefix('seller')->name('seller.')->group(function () {

    // Login Page
    Route::get('/login', [SellerLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login-submit', [SellerLoginController::class, 'login'])->name('login.submit');

    // Protected Routes (केवल Sellers के लिए)
    Route::middleware(['auth'])->group(function () {
        // यहाँ हम Controller के अंदर ही चेक कर रहे हैं, लेकिन Middleware भी लगा सकते हैं
        Route::get('/dashboard', function () {
            if (auth()->user()->user_type !== 'seller') {
                abort(403);
            }
            return view('seller.dashboard');
        })->name('dashboard');

        Route::post('/logout', [SellerLoginController::class, 'logout'])->name('logout');
    });
});
