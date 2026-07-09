@extends('frontend.layouts.app')

@section('title', 'Suyagya | Authentic Spiritual Products')

@section('content')


    <h1 class="seo-h1">Fitness With Dhoti - Premium Mens Clothing | T-Shirts, Jeans & Shirts</h1>


    {{-- 🖼️ 2. HERO SLIDER SECTION (OPTIMIZED FOR NO-LAYOUT-SHIFT & SPEED) --}}
    <section class="home-banner-area">
        <div class="container-fluid px-0">
            <div class="row g-0">
                <div class="col-12">

                    <div id="heroSlider">
                        @if (isset($banners) && count($banners) > 0)
                            @foreach ($banners as $index => $banner)
                                <div>
                                    <a href="{{ $banner->link ?? '#' }}" class="d-block w-100 position-relative"
                                        style="background: #e0d4c3; min-height: 700px;">
                                        <picture>
                                            {{-- 📱 MOBILE IMAGE: 400x400 के हिसाब से width और height सेट कर दी --}}
                                            @if ($banner->mobile_image)
                                                <source media="(max-width: 767px)"
                                                    srcset="{{ asset($banner->mobile_image) }}" width="400"
                                                    height="400">
                                            @endif

                                            {{-- 💻 DESKTOP IMAGE (Default) --}}
                                            @if ($banner->desktop_image)
                                                <img class="bnanner-img w-100 img-fluid"
                                                    src="{{ asset($banner->desktop_image) }}"
                                                    alt="Suyagya Premium Spiritual Banner" width="1920" height="700"
                                                    fetchpriority="{{ $index == 0 ? 'high' : 'low' }}"
                                                    loading="{{ $index == 0 ? 'eager' : 'lazy' }}"
                                                    decoding="{{ $index == 0 ? 'sync' : 'async' }}">
                                            @endif
                                        </picture>
                                    </a>
                                </div>
                            @endforeach
                        @else
                            {{-- Fallback --}}
                            <div>
                                <img src="https://placehold.co/1920x700?text=Welcome+to+Suyagya" class="w-100 bnanner-img"
                                    width="1920" height="700">
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </section>

    {{-- 💎 1. MATCH THE MOOD SCROLL SECTION WITH BUTTONS --}}
    <section class="py-4 bg-white position-relative overflow-hidden" style="background: linear-gradient(180deg, rgba(223, 206, 205, 1), rgb(255, 221, 221) 100%);">
        <div class="container-fluid px-3 px-md-4 position-relative">

            {{-- Section Heading --}}
            <div class="text-center mb-4">
                <h2 class="fw-bold mb-1" style="color: #222f3e; font-size: 24px;">Match The Mood</h2>
                <p class="text-muted small mb-0">Everyday Bestsellers</p>
            </div>

            {{-- Slider Wrapper for Buttons --}}
            <div class="mood-slider-wrapper position-relative">

                {{-- Left Scroll Button --}}
                <button class="mood-scroll-btn left-btn" id="moodScrollLeft" aria-label="Scroll Left">
                    <i class="las la-angle-left"></i> {{-- LineAwesome icon --}}
                </button>

                {{-- Horizontal Scroll Container --}}
                <div class="mood-scroll-container" id="moodScrollContainer">
                    @foreach ($categories as $category)
                        <div class="mood-scroll-item">
                            <div class="mood-category-item">
                                <a href="{{ url('category/' . $category['slug']) }}"
                                    class="d-block position-relative overflow-hidden text-decoration-none">

                                    {{-- Cover Image --}}
                                    <img src="{{ asset($category->cover_image) }}" alt="{{ $category['name'] }}"
                                        class="w-100 object-fit-cover mood-img">

                                    {{-- Dark Gradient Overlay & Text --}}
                                    <div
                                        class="mood-overlay position-absolute bottom-0 start-0 w-100 d-flex flex-column justify-content-end text-center pb-3">
                                        <span class="text-white small text-uppercase fw-semibold mood-subtext">
                                            Explore
                                        </span>
                                        <h3 class="text-white text-uppercase fw-bolder mb-0 mood-title">
                                            {{ $category['name'] }}
                                        </h3>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Right Scroll Button --}}
                <button class="mood-scroll-btn right-btn" id="moodScrollRight" aria-label="Scroll Right">
                    <i class="las la-angle-right"></i>
                </button>

            </div>

        </div>
    </section>

    {{-- 🛍️ NEW ARRIVALS (NOBERO SQUARE STYLE) --}}
    <section class="py-5 bg-white" style="background: linear-gradient(180deg, rgb(255 221 221), rgba(233, 212, 192, 1) 100%);">
        <div class="container-fluid px-3 px-md-5">

            {{-- Section Heading --}}
            <div class="text-center mb-4 pb-2">
                <h2 class="fw-bold m-0" style="color: #2c3e50; font-size: 22px;">New Arrivals</h2>
            </div>

            {{-- Grid Layout: Desktop pe 6, Tablet pe 4, Mobile pe 2 boxes ek line mein --}}
            <div class="row g-3 g-md-4 justify-content-center">

                {{-- Product Loop --}}
                @foreach ($newArrivalProducts->take(12) as $product)
                    <div class="col-6 col-md-3 col-lg-2">
                        <a href="{{ route('product.detail', $product->slug) }}" class="text-decoration-none collection-link">
                            <div class="collection-item-wrapper text-center">

                                {{-- Light Grey SQUARE Image Box (1:1 Ratio) --}}
                                <div class="collection-img-box position-relative rounded-3 overflow-hidden mb-2">

                                    {{-- Product Main Image --}}
                                    <img src="{{ asset($product->main_image) }}"
                                         alt="{{ $product->name }}"
                                         class="w-100 h-100 object-fit-cover transition-transform"
                                         loading="lazy">
                                         {{-- style="mix-blend-mode: multiply; padding: 10px;"> Padding taki kapde edges se thoda andar rahein --}}

                                    {{-- Top Right Plus Icon (White border, transparent inside) --}}
                                    <div class="position-absolute top-0 end-0 m-2">
                                        <div class="plus-icon-circle rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="las la-plus"></i>
                                        </div>
                                    </div>

                                </div>

                                {{-- Product Name Only (No Price) --}}
                                <h6 class="text-dark mb-0 fw-semibold collection-title text-truncate px-1" style="font-size: 13px;">
                                    {{ $product->name }}
                                </h6>
                            </div>
                        </a>
                    </div>
                @endforeach

                @if ($newArrivalProducts->count() == 0)
                    <div class="col-12 text-center text-muted">No new arrivals found.</div>
                @endif

            </div>

            {{-- View All Button --}}
            @if ($newArrivalProducts->count() > 0)
                <div class="text-center mt-4">
                    <a href="{{ route('products.all_collection') }}?type=newArrival"
                       class="btn btn-outline-dark rounded-pill px-4 py-2 fw-bold" style="font-size: 13px;">
                        View all New Arrivals
                    </a>
                </div>
            @endif

        </div>
    </section>

    {{-- 🛒 3. FEATURED PRODUCTS (DYNAMIC) --}}
    <section class="py-5" style="background: linear-gradient(180deg, rgba(233, 212, 192, 1), rgba(255, 255, 255, 1) 92%);">
        <div class="container-fluid px-3 px-md-5">

            {{-- Title mimicking the image --}}
            <div class="text-center mb-4 pb-2">
                <h2 class="fw-bold m-0 text-dark" style="font-size: 22px; font-family: 'Inter', sans-serif;">Feature Product</h2>
                <p class="text-muted small mt-1">Handpicked for you</p>
            </div>

            <div class="position-relative px-md-3">
                <div class="featured-slider-dhoti" id="featuredDhotiSlider">

                    @foreach ($featuredProducts as $product)
                        <div class="px-2 h-100">
                            <div class="featured-dhoti-card h-100">

                                {{-- Top Image Box with Padding --}}
                                <div class="img-box">
                                    {{-- Heart Icon --}}
                                    <button class="btn-wishlist" onclick="toggleWishlist({{ $product->id }}, this)">
                                        @php
                                            $isInWishlist = Auth::check() && \App\Models\Wishlist::where('user_id', Auth::id())->where('product_id', $product->id)->exists();
                                        @endphp
                                        <i class="{{ $isInWishlist ? 'las la-heart text-danger' : 'lar la-heart text-muted' }}" style="font-size: 16px;"></i>
                                    </button>

                                    {{-- Rating Badge --}}
                                    @php
                                        $avgRating = 0;
                                        $reviewCount = 0;
                                        if ($product->relationLoaded('reviews') && $product->reviews) {
                                            $avgRating = $product->reviews->avg('rating');
                                            $reviewCount = $product->reviews->count();
                                        }
                                    @endphp
                                    <div class="rating-tag-featured">
                                        <i class="las la-star text-warning me-1" style="font-size: 13px;"></i>
                                        <span class="text-dark">{{ number_format($avgRating, 1) }}</span> <span class="text-muted fw-normal mx-1">|</span> <span class="text-muted fw-normal">{{ $reviewCount }}</span>
                                    </div>

                                    {{-- Image --}}
                                    <a href="{{ route('product.detail', $product->slug) }}" class="d-block w-100">
                                        <img src="{{ asset($product->main_image) }}"
                                             alt="{{ $product->name }}"
                                             class="w-100 object-fit-cover">
                                    </a>
                                </div>

                                {{-- Bottom Text Content --}}
                                <div class="card-body-custom">
                                    <a href="{{ route('product.detail', $product->slug) }}" class="text-decoration-none text-dark d-block text-truncate mb-2 fw-semibold" style="font-size: 13px;">
                                        {{ $product->name }}
                                    </a>

                                    <div class="d-flex align-items-center gap-2 mb-1">
                                        <span class="fw-bold text-dark" style="font-size: 15px;">₹{{ number_format($product->price) }}</span>
                                        @if ($product->mrp_price > $product->price)
                                            <span class="text-muted text-decoration-line-through" style="font-size: 12px;">₹{{ number_format($product->mrp_price) }}</span>
                                            @php $discAmount = $product->mrp_price - $product->price; @endphp
                                            <span class="fw-bold" style="color: #00b894; font-size: 12px;">₹{{ number_format($discAmount) }} OFF</span>
                                        @endif
                                    </div>

                                    <p class="mb-0 mt-auto" style="font-size: 10px; color: #8c7ae6;">Lowest price in last 30 days</p>
                                </div>

                            </div>
                        </div>
                    @endforeach

                </div>
            </div>

            {{-- View All Button --}}
            <div class="text-center mt-5">
                <a href="{{ route('products.all_collection') }}?type=featured" class="btn btn-outline-dark px-4 py-2 fw-bold" style="border-radius: 4px; font-size: 13px;">
                    Shop All Products
                </a>
            </div>

        </div>
    </section>

    {{-- 🛒 3. Best Selling PRODUCTS (DYNAMIC) --}}
    <section class="py-3 featured-products-section" style="background-color: #ffffff">
        <div class="container">

            {{-- Heading --}}
            <div class="d-flex justify-content-center mb-5">
                <div class="fancy-heading-box">
                    <h2 class="m-0">Best Selling Products</h2>
                </div>
            </div>

            {{-- Product Grid --}}
            <div class="row g-4">

                @foreach ($bestSellingProducts as $product)
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="product-card-minimal">

                            {{-- Image Area --}}
                            <div class="img-box">
                                @if ($product->discount > 0)
                                    <span class="badge bg-danger text-white position-absolute top-0 start-0 m-2 fw-bold"
                                        style="z-index: 2;">
                                        {{ round($product->discount) }}% OFF
                                    </span>
                                @endif
                                <button class="btn-wishlist" onclick="toggleWishlist({{ $product->id }}, this)">
                                    @php
                                        // Check if user has liked this product (Optimization Tip: Load this via logic later, abhi simple check)
                                        $isInWishlist =
                                            Auth::check() &&
                                            \App\Models\Wishlist::where('user_id', Auth::id())
                                                ->where('product_id', $product->id)
                                                ->exists();
                                    @endphp
                                    <i class="{{ $isInWishlist ? 'las la-heart text-danger' : 'lar la-heart' }} fs-5"></i>
                                </button>
                                <a href="{{ route('product.detail', $product->slug) }}">
                                    <img src="{{ asset($product->main_image) }}"
                                        alt="{{ $product->main_image_alt ?? $product->name }}" width="600"
                                        height="600" loading="lazy">
                                </a>
                                {{-- 🎥 Video Play Button Overlay (Image ke upar) --}}
                                @if ($product->youtube_link)
                                    {{-- 👇 CLASSES CHANGED: bottom-0 end-0 m-2 --}}
                                    <div class="video-overlay-icon position-absolute bottom-0 end-0 m-2"
                                        style="z-index: 3;">
                                        <a href="javascript:void(0);" data-bs-toggle="modal"
                                            data-bs-target="#videoModal{{ $product->id }}"
                                            class="text-white text-decoration-none shadow-lg d-flex align-items-center justify-content-center"
                                            style="background: rgba(220, 53, 69, 0.9); width: 40px; height: 40px; border-radius: 50%; border: 2px solid #fff;">
                                            <i class="las la-play fs-4"></i>
                                        </a>
                                    </div>

                                    {{-- Modal for this specific product (Shorts Optimized) --}}
                                    <div class="modal fade" id="videoModal{{ $product->id }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" style="max-width: 380px;">
                                            <div class="modal-content bg-transparent border-0">
                                                <div class="modal-header border-0 p-0 justify-content-end mb-2">
                                                    <button type="button" class="btn-close btn-close-white"
                                                        data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body p-0">
                                                    <div class="ratio"
                                                        style="--bs-aspect-ratio: 177.77%; background: #000; border-radius: 15px; overflow: hidden;">
                                                        <iframe src="{{ $product->youtube_link }}" title="Video"
                                                            allowfullscreen></iframe>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            {{-- Details Area --}}
                            <div class="product-details text-start">
                                <a href="{{ route('product.detail', $product->slug) }}"
                                    class="text-decoration-none text-dark fw-bold text-truncate d-block"
                                    style="font-family: 'Merriweather', serif;">
                                    {{ $product->name }}
                                </a>

                                <div class="d-flex align-items-center rating-row">
                                    @php
                                        // ✅ Safe Logic: Check karein ki reviews exist karte hain ya nahi
                                        $avgRating = 0;
                                        $reviewCount = 0;

                                        if ($product->relationLoaded('reviews') && $product->reviews) {
                                            $avgRating = $product->reviews->avg('rating');
                                            $reviewCount = $product->reviews->count();
                                        }

                                        $fullStars = round($avgRating);
                                    @endphp

                                    <span class="stars text-warning">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $fullStars)
                                                <i class="las la-star"></i>
                                            @else
                                                <i class="lar la-star"></i>
                                            @endif
                                        @endfor
                                    </span>

                                    <span class="review-count text-muted small ms-1">({{ $reviewCount }})</span>
                                </div>

                                <div class="price-row">
                                    <span class="price-current">₹{{ number_format($product->price) }}</span>
                                    @if ($product->mrp_price > $product->price)
                                        <span class="price-old">₹{{ number_format($product->mrp_price) }}</span>
                                    @endif
                                </div>

                                {{-- @if ($product->quantity > 0)

                                    <button class="btn btn-earthy" onclick="addToCart({{ $product->id }}, 1, 0, this)"
                                        data-id="{{ $product->id }}" data-name="{{ $product->name }}"
                                        data-price="{{ $product->price }}">
                                        Add to Cart
                                    </button>
                                @else
                                    <button class="btn btn-secondary w-100 disabled"
                                        style="cursor: not-allowed; background: #d60808; border: none;">
                                        Out of Stock
                                    </button>
                                @endif --}}
                            </div>

                        </div>
                    </div>
                @endforeach

                @if ($bestSellingProducts->count() == 0)
                    <div class="col-12 text-center text-muted">No bestSelling products found.</div>
                @endif

            </div>

            {{-- View All --}}
            <div class="text-center mt-5">
                <a href="{{ route('products.all_collection') }}?type=best-selling"
                    class="btn btn-view-all rounded-pill px-4 py-2">
                    View all Best Selling
                </a>
            </div>

        </div>
    </section>


    {{-- 🛒 4. video-feed-section (Placeholder for next section) --}}
    {{-- 🎥 EXPLORE VIDEO FEED SECTION (WITH SLICK NAVIGATION ARROWS) --}}
    <section class="py-4 video-feed-section" style="background: linear-gradient(180deg, rgba(255, 255, 255, 1), rgba(213, 202, 154, 1) 98%); position: relative;">
        <div class="container-fluid px-4 position-relative">

            <div class="d-flex justify-content-center mb-4">
                <div class="fancy-heading-box">
                    <h2 class="m-0">Explore Feed</h2>
                </div>
            </div>

            <div class="video-slider-container px-md-4"> {{-- साइड्स में स्पेस दिया ताकि बटन परफेक्ट अलाइन हों --}}
                <div class="video-carousel" id="suyagyaVideoFeedCarousel">

                    {{-- 🟢 Check if videos exist --}}
                    @if (isset($videos) && $videos->count() > 0)
                        @foreach ($videos as $video)
                            <div class="px-2">
                                <div class="video-card">
                                    <div class="video-wrapper">

                                        {{-- ✅ VIDEO TAG --}}
                                        <video loop playsinline preload="none" muted class="the-video"
                                            poster="{{ asset($video->image) }}">
                                            <source src="{{ asset($video->video) }}" type="video/mp4">
                                        </video>

                                        {{-- Sound Toggle --}}
                                        <button class="btn-sound-toggle" type="button" title="Unmute">
                                            <i class="las la-volume-mute"></i>
                                        </button>

                                        {{-- Default Overlay --}}
                                        <div class="video-overlay-default">
                                            <div class="play-icon-circle">
                                                <i class="las la-play"></i>
                                            </div>
                                            <h5 class="video-title">{{ $video->title }}</h5>
                                        </div>

                                        {{-- Buy Now Overlay --}}
                                        <div class="video-overlay-hover">
                                            @php
                                                $link = $video->link;
                                                if (!Str::startsWith($link, ['http://', 'https://'])) {
                                                    $link = url($link);
                                                }
                                            @endphp
                                            <a href="{{ $link }}" class="btn btn-buy-now-video w-100">
                                                Buy Now <i class="las la-arrow-right ms-1"></i>
                                            </a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center w-100 py-4">
                            <p class="text-muted">No videos available at the moment.</p>
                        </div>
                    @endif

                </div>

                {{-- 🎮 कस्टमाइज्ड लेफ्ट-राइट एरो नेविगेशन बटन्स --}}
                @if (isset($videos) && $videos->count() > 0)
                    <button class="video-feed-nav-btn video-prev" id="video-feed-prev" aria-label="Previous Slide">
                        <i class="las la-angle-left"></i>
                    </button>
                    <button class="video-feed-nav-btn video-next" id="video-feed-next" aria-label="Next Slide">
                        <i class="las la-angle-right"></i>
                    </button>
                @endif

            </div>

        </div>
    </section>


    <section class="py-3 favourites-section" style="background: linear-gradient(180deg, rgba(213, 202, 154, 1), rgba(241, 232, 208, 1) 97%);">
        <div class="container">

            {{-- 1. Minimal Heading --}}
            <div class="text-center mb-4 pb-2">
                <h2 class="fw-bold m-0" style="color: #2c3e50; font-size: 24px;">Fitness With Dhoti Favourites</h2>
                <p class="text-muted small mt-1">Our most loved clothing collections</p>
            </div>

            {{-- 2. Masonry Grid Layout --}}
            <div class="favourites-grid">

                {{-- TOP ROW WRAPPER --}}
                <div class="row g-3">

                    {{-- LEFT COLUMN --}}
                    <div class="col-lg-8">

                        {{-- 1. Wide Image (Top Left) - Rudraksha Jap Mala --}}
                        <div class="fav-card wide mb-3">
                            {{-- Using your uploaded image: image_08a5ae.jpg --}}
                            <img src="{{ asset('uploads/home/fav/tees.webp') }}" class="img-fluid"
                                alt="Rudraksh Jap Mala">
                            <div class="fav-content">
                                <h3>Tees Collection</h3>
                                <a href="{{ url('category/rudraksh/tees') }}" class="btn btn-fav-shop">Shop
                                    now</a>
                            </div>
                        </div>

                        {{-- Row for 2 Small Images --}}
                        <div class="row g-3">
                            <div class="col-md-6">
                                {{-- 2. Small Image (Middle Left 1) - Tiger Eye Stone --}}
                                <div class="fav-card standard">
                                    {{-- Using your uploaded image: image_08406c.jpg --}}
                                    <img src="{{ asset('uploads/home/fav/shorts.webp') }}" class="img-fluid"
                                        alt="Tiger Eye Stone">
                                    <div class="fav-content">
                                        <h3>Shorts Collections</h3>
                                        <a href="{{ url('category/rashi-bracelet') }}" class="btn btn-fav-shop">Shop
                                            now</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                {{-- 3. Small Image (Middle Left 2) - Black Stone --}}
                                <div class="fav-card standard">
                                    {{-- Using your uploaded image: image_09214d.jpg --}}
                                    <img src="{{ asset('uploads/home/fav/shirts.jpg') }}" class="img-fluid"
                                        alt="Black Stone">
                                    <div class="fav-content">
                                        <h3>Shirts Collections</h3>
                                        <a href="{{ url('category/stone-jewellery') }}" class="btn btn-fav-shop">Shop
                                            now</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    {{-- RIGHT COLUMN --}}
                    <div class="col-lg-4">
                        {{-- 4. Tall Image (Right Side) - Rashi Bracelet --}}
                        <div class="fav-card tall h-100">
                            {{-- Using your uploaded image: image_aeee28.jpg --}}
                            <img src="{{ asset('uploads/home/fav/printed-tees.webp') }}" class="img-fluid"
                                alt="Rashi Bracelet" style="object-fit: cover; height: 100%;">
                            <div class="fav-content">
                                <h3>Printed-tees Mala</h3>
                                <a href="{{ url('category/karungali/karungali-mala') }}" class="btn btn-fav-shop">Shop
                                    now</a>
                            </div>
                        </div>
                    </div>

                </div>
                {{-- END TOP ROW --}}

                {{-- BOTTOM ROW --}}
                <div class="row g-3 mt-0">

                    {{-- 1. Small Image (Left) - Rose Product --}}
                    <div class="col-md-4">
                        <div class="fav-card standard">
                            {{-- Using your uploaded image: image_08a246.png --}}
                            <img src="{{ asset('uploads/home/fav/co-ords.webp') }}" class="img-fluid"
                                alt="Rose Product">
                            <div class="fav-content">
                                <h3>Co-ords Collection</h3>
                                <a href="{{ url('category/pooja-items/shankh') }}" class="btn btn-fav-shop">Shop now</a>
                            </div>
                        </div>
                    </div>

                    {{-- 2. Wide Image (Right) - Murti Collection (Using existing/placeholder or you can upload one) --}}
                    <div class="col-md-8">
                        <div class="fav-card wide">
                            {{-- Using your uploaded image: image_390489.jpg (Collage) as a banner --}}
                            <img src="{{ asset('uploads/home/fav/joggers.webp') }}" class="img-fluid"
                                alt="Suyagya Collection">
                            <div class="fav-content">
                                <h3>Joggers Collection</h3>
                                <a href="{{ url('category/spritual-idols') }}" class="btn btn-fav-shop">Shop now</a>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>

    <div class="all-catagorys">
        {{-- ✨ 6. DYNAMIC SUB-CATEGORY SHOWCASE SECTIONS ✨ --}}
        {{-- ✨ DYNAMIC CATEGORY SHOWCASE SECTIONS (Ring, Earring, Pendant) ✨ --}}
        {{-- ✨ DYNAMIC CATEGORY SHOWCASE SECTIONS ✨ --}}
        @if (isset($showcaseSections) && $showcaseSections->count() > 0)
            @foreach ($showcaseSections as $section)
                @if ($section->products->count() > 0)
                    <section class="py-3 category-showcase-section" style="background: linear-gradient(180deg, rgba(241, 232, 208, 1), rgba(255, 248, 230, 1) 100%);">
                        <div class="container-fluid px-4">

                            {{-- 1. Heading --}}
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h2 class="h3 fw-bold text-dark m-0">
                                    {{ $section->category->name }} {{ $section->name }}
                                </h2>
                                <a href="{{ route('products.subcategory', ['cat_slug' => $section->category->slug, 'sub_slug' => $section->slug]) }}"
                                    class="btn btn-outline-dark rounded-pill px-4">
                                    View all
                                </a>
                            </div>

                            <div class="row g-3">


                                {{-- 3. RIGHT SIDE: PRODUCTS GRID --}}
                                <div class="col-lg-12 col-12">
                                    {{-- Use 'row' for proper grid alignment of products --}}
                                    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-6 g-3">
                                        <div class="col">
                                            <div class="category-banner-card h-100 position-relative overflow-hidden rounded-3"
                                                style="min-height: 300px; background-color: #e0d4c3;">
                                                {{-- Added min-height & bg-color --}}

                                                {{-- Image Logic: Check if image exists, else show placeholder --}}
                                                @php
                                                    $bannerImage = $section->image
                                                        ? asset($section->image)
                                                        : 'https://placehold.co/300x500/e0d4c3/555?text=' .
                                                            urlencode($section->name);
                                                @endphp

                                                <img src="{{ $bannerImage }}" alt="{{ $section->name }}"
                                                    class="img-fluid w-100 h-100 object-fit-cover banner-img">

                                                <div class="banner-content position-absolute bottom-0 start-0 p-3 w-100 text-white"
                                                    style="background: linear-gradient(to top, rgba(0,0,0,0.7), transparent);">
                                                    <h3 class="h4 fw-bold mb-0">{{ $section->name }}<br>Collection</h3>
                                                </div>
                                            </div>
                                        </div>
                                        @foreach ($section->products as $product)
                                            <div class="col"> {{-- Auto column width based on row-cols classes above --}}
                                                <div
                                                    class="product-card-standard h-100 border rounded-3 overflow-hidden bg-white shadow-sm">

                                                    {{-- Image --}}
                                                    <div class="card-img-wrapper position-relative bg-light"
                                                        style="aspect-ratio: 1/1;">
                                                        @if ($product->discount > 0)
                                                            <span
                                                                class="badge bg-danger text-white position-absolute top-0 start-0 m-2 fw-bold"
                                                                style="z-index: 2;">
                                                                {{ round($product->discount) }}% OFF
                                                            </span>
                                                        @endif

                                                        <a href="{{ route('product.detail', $product->slug) }}"
                                                            class="d-block w-100 h-100">
                                                            <img src="{{ asset($product->main_image) }}"
                                                                alt="{{ $product->main_image_alt ?? $product->name }}"
                                                                class="w-100 h-100 object-fit-cover">
                                                        </a>
                                                    </div>

                                                    {{-- Info --}}
                                                    <div class="p-3 text-start">
                                                        <h6 class="product-title mb-1 text-truncate fw-bold"
                                                            style="font-size: 14px;">
                                                            <a href="{{ route('product.detail', $product->slug) }}"
                                                                class="text-dark text-decoration-none">
                                                                {{ $product->name }}
                                                            </a>
                                                        </h6>

                                                        {{-- ⭐ Dynamic Rating Logic Start ⭐ --}}
                                                        @php
                                                            $avgRating = $product->reviews->avg('rating') ?? 0; // Average nikalo
                                                            $reviewCount = $product->reviews->count(); // Total reviews count karo
                                                            $fullStars = floor($avgRating); // Pura sitara (e.g. 4.5 -> 4)
                                                            $halfStar = $avgRating - $fullStars >= 0.5; // Adha sitara check
                                                            $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0); // Khali sitare
                                                        @endphp

                                                        <div class="mb-2 text-warning small">
                                                            {{-- Full Stars --}}
                                                            @for ($i = 0; $i < $fullStars; $i++)
                                                                <i class="las la-star"></i>
                                                            @endfor

                                                            {{-- Half Star --}}
                                                            @if ($halfStar)
                                                                <i class="las la-star-half-alt"></i>
                                                            @endif

                                                            {{-- Empty Stars --}}
                                                            @for ($i = 0; $i < $emptyStars; $i++)
                                                                <i class="lar la-star"></i>
                                                            @endfor

                                                            {{-- Review Count --}}
                                                            <span class="text-muted ms-1">({{ $reviewCount }})</span>
                                                        </div>
                                                        {{-- ⭐ Dynamic Rating Logic End ⭐ --}}

                                                        <div class="mb-2">
                                                            <span
                                                                class="fw-bold text-dark">₹{{ number_format($product->price) }}</span>
                                                            @if ($product->mrp_price > $product->price)
                                                                <span
                                                                    class="text-muted text-decoration-line-through small ms-2">
                                                                    ₹{{ number_format($product->mrp_price) }}
                                                                </span>
                                                            @endif
                                                        </div>

                                                        {{-- <button class="btn btn-earthy w-100 btn-sm"
                                                            onclick="addToCart({{ $product->id }}, 1, 0, this)"
                                                            data-id="{{ $product->id }}"
                                                            data-name="{{ $product->name }}"
                                                            data-price="{{ $product->price }}">
                                                            Add to cart
                                                        </button> --}}
                                                    </div>

                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>

                            </div>
                        </div>
                    </section>
                @endif
            @endforeach
        @endif
    </div>
    {{-- 👥 CUSTOMER REVIEWS SECTION (TEXT-ONLY PREMIUM SLIDER FORMAT) --}}
    <section class="py-5 testimonial-section" style="background-color: #fff8e6; position: relative;">
        <div class="container position-relative px-md-5">

            <div class="d-flex justify-content-center mb-5">
                <div class="fancy-heading-box">
                    <h2 class="m-0">Customer Love</h2>
                </div>
            </div>

            <div class="testimonial-slider-container">
                <div class="testimonial-slider" id="suyagyaCustomerReviewsSlider">
                    @if (isset($reviews) && $reviews->count() > 0)
                        @foreach ($reviews as $review)
                            {{-- 🚀 फिक्स: अब इमेज की पाबंदी हटा दी है, सारे रिव्यूज नीट एंड क्लीन दिखेंगे --}}
                            <div class="testimonial-slide-item">
                                <div class="premium-review-card text-only-card shadow-sm">

                                    {{-- 📝 कार्ड का हिस्सा: शुद्ध टेक्स्ट कंटेंट --}}
                                    <div class="review-body-box">
                                        <div class="text-warning small mb-2">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <i class="las la-star"></i>
                                            @endfor
                                        </div>

                                        @if ($review->title)
                                            <h6 class="review-card-title text-truncate">{{ $review->title }}</h6>
                                        @endif

                                        <p class="review-card-text">
                                            "{{ $review->review }}"
                                        </p>

                                        <div class="review-card-author">
                                            - {{ $review->display_name }}
                                        </div>
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center w-100 py-4">
                            <p class="text-muted">No reviews yet.</p>
                        </div>
                    @endif
                </div>

                {{-- 🎮 कस्टमाइज्ड सुंदर लेफ्ट-राइट नेविगेशन बटन्स --}}
                @if (isset($reviews) && $reviews->count() > 0)
                    <button class="review-slider-btn r-prev" id="review-slider-prev" aria-label="Previous Reviews">
                        <i class="las la-angle-left"></i>
                    </button>
                    <button class="review-slider-btn r-next" id="review-slider-next" aria-label="Next Reviews">
                        <i class="las la-angle-right"></i>
                    </button>
                @endif
            </div>

        </div>
    </section>

    {{-- ================= BLOG SECTION WITH VIEW ALL BUTTON ================= --}}
    <section class="py-5 blog-section" style="background: linear-gradient(180deg, rgba(255, 248, 230, 1) 26%, rgba(225, 247, 254, 1) 100%);">
        <div class="container">

            {{-- Heading --}}
            <div class="d-flex justify-content-center mb-5">
                <div class="fancy-heading-box text-center">
                    <h2 class="m-0 fw-bold" style="font-family: 'Merriweather', serif;">Blogs</h2>
                    <div class="heading-underline mx-auto mt-2" style="width: 60px; height: 3px; background: #c09867;">
                    </div>
                </div>
            </div>

            <div class="row g-4 justify-content-center">

                @if ($blogs->count() > 0)
                    @foreach ($blogs as $blog)
                        <div class="col-md-6 col-lg-4">
                            <div class="blog-card h-100 bg-white rounded shadow-sm overflow-hidden border-0 hover-lift">

                                {{-- Image Wrapper --}}
                                <div class="blog-img-wrapper position-relative overflow-hidden" style="height: 220px;">
                                    {{-- 🚀 स्पेलिंग फिक्स: Knowlege को सुधारकर Knowledge कर दिया है --}}
                                    <span
                                        class="blog-tag position-absolute top-0 start-0 m-3 px-3 py-1 bg-white text-dark rounded-pill fw-bold small shadow-sm"
                                        style="z-index: 10;">
                                        Knowledge
                                    </span>

                                    <a href="{{ route('blogs.show', $blog->slug) }}" class="d-block h-100 w-100">
                                        <img src="{{ asset($blog->main_image) }}"
                                            alt="{{ $blog->img_alt ?? $blog->title }}"
                                            class="img-fluid w-100 h-100 object-fit-cover transition-zoom">
                                    </a>
                                </div>

                                {{-- Content --}}
                                <div class="blog-content p-4">
                                    <small class="text-muted mb-2 d-block">
                                        <i class="las la-calendar me-1"></i> {{ $blog->created_at->format('d M, Y') }}
                                    </small>

                                    <h3 class="blog-title mb-3" style="font-size: 18px; line-height: 1.4;">
                                        <a href="{{ route('blogs.show', $blog->slug) }}"
                                            class="text-decoration-none text-dark fw-bold hover-primary">
                                            {{ Str::limit($blog->title, 55) }}
                                        </a>
                                    </h3>

                                    <p class="blog-desc text-muted small mb-4" style="line-height: 1.6;">
                                        {{ Str::limit(strip_tags($blog->content), 100) }}
                                    </p>

                                    <a href="{{ route('blogs.show', $blog->slug) }}"
                                        class="read-more-btn text-uppercase fw-bold text-warning text-decoration-none small">
                                        Read more <i class="las la-arrow-right ms-1"></i>
                                    </a>
                                </div>

                            </div>
                        </div>
                    @endforeach

                    {{-- 🚀 बटन फिक्स: सारे ब्लॉग कार्ड्स खत्म होने के बाद नीचे सेंटर में View All बटन --}}
                    <div class="col-12 text-center mt-5">
                        <a href="{{ route('blogs.index') }}" class="btn btn-view-all-blogs px-5 py-3 shadow-sm">
                            View All Blogs <i class="las la-arrow-right ms-2" style="font-size: 14px;"></i>
                        </a>
                    </div>
                @else
                    <div class="col-12 text-center py-5">
                        <p class="text-muted">No blogs found at the moment.</p>
                    </div>
                @endif

            </div>
        </div>
    </section>

    @php
        $faqs = $homeSettings->faq_content ?? [];
        $chunks = array_chunk($faqs, ceil(count($faqs) / 2));
        $leftFaqs = $chunks[0] ?? [];
        $rightFaqs = $chunks[1] ?? [];
    @endphp

    @if (count($faqs) > 0)
        <section class="py-5 faq-section" style="background: linear-gradient(180deg, rgba(225, 247, 254, 1), rgba(146, 175, 183, 1) 100%);">
            <div class="container">

                {{-- 1. Fancy Heading --}}
                <div class="d-flex justify-content-center mb-5">
                    <div class="fancy-heading-box"
                        style="background-color: #4b6b6e1f; border: 1px solid #7a97a5;">
                        <h2 class="m-0 font-heading fw-bold">FAQs</h2>
                    </div>
                </div>

                <div class="row">
                    {{-- Left Column --}}
                    <div class="col-lg-6 mb-3 mb-lg-0">
                        @include('frontend.includes.faq_accordion', [
                            'faqs' => $leftFaqs,
                            'idSuffix' => 'home_left',
                        ])
                    </div>

                    {{-- Right Column --}}
                    <div class="col-lg-6">
                        @include('frontend.includes.faq_accordion', [
                            'faqs' => $rightFaqs,
                            'idSuffix' => 'home_right',
                        ])
                    </div>
                </div>

            </div>
        </section>
    @endif

    @include('frontend.includes.brand_story', [
        'storyTitle' => $homeSettings->story_title ?? 'Suyagya - India\'s Best Spiritual Jewelry Brand',
        'storyContent' => $homeSettings->story_content ?? '',
    ])
@endsection
