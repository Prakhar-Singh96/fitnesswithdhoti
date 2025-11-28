@extends('frontend.layouts.app')

@section('title', 'Suyagya | Authentic Spiritual Products')

@section('content')

    {{-- Note: We rely on Slick Carousel JS being loaded from vendors.js or CDN --}}

    {{-- 💎 1. CATEGORY SCROLL SECTION (Astrotalk Style Scrollbar) --}}
    <section class="py-4 bg-white shadow-sm">
        <div class="container-fluid px-0" style="width: 80%;">
            {{-- <h4 class="text-dark fw-bold mb-4 ps-3">Shop by Category</h4> --}}
            <!-- FIXED Category Carousel -->
            <div class="w-100 position-relative">
                <div id="categoryScroll" class="category-slider d-flex align-items-center">
                    @php
                        $categories = [
                            [
                                'slug' => 'bracelet-ye8hk',
                                'name' => 'Bracelet',
                                'image' => 'ffsSJvJ3mMxG1ZALWyFjioFM5Wde66p91GnBcKYa.webp',
                            ],
                            [
                                'slug' => 'rudraksh-fdfhq',
                                'name' => 'Rudraksh',
                                'image' => 'Ndy2huteC3obeeQi5d25FrrRzRBPsFZsEjMmOlVd.webp',
                            ],
                            [
                                'slug' => 'shankh-wszyo',
                                'name' => 'Shankh',
                                'image' => 'aw7qmny1N9MCZJTmkHZEMqiyVVAKDLyJIGRfyr5d.webp',
                            ],
                            [
                                'slug' => 'shivling-egajb',
                                'name' => 'Shivling',
                                'image' => 'nXeS978jtHPfIhRviyTwGTOBmG18Hmvis7mxMX3X.webp',
                            ],
                            [
                                'slug' => 'jap-mala-9y6fr',
                                'name' => 'Jap Mala',
                                'image' => 'xMTDcif2LKDtwUmSq51DNbJzCz6DdY270fxdOTI8.webp',
                            ],
                            [
                                'slug' => 'locket-onhxb',
                                'name' => 'Locket',
                                'image' => '27qYrkUA00xhmKkgOaEeTkaGY55NhmcSLRbBINsX.webp',
                            ],
                            [
                                'slug' => 'shri-yantra-gtc8a',
                                'name' => 'Shri Yantra',
                                'image' => 'IdWIF4SLMU1dXDg6UsG4xcZZaaPmFM4rQr5IqCry.webp',
                            ],
                            [
                                'slug' => 'ghode-ki-naal-xlntt',
                                'name' => 'Ghode ki naal',
                                'image' => 'rFaHG50n8fGdKWCWN59oRf8IIWIV4hP8gCwb4FRx.webp',
                            ],
                            [
                                'slug' => 'mala-verbp',
                                'name' => 'Mala',
                                'image' => 'EE6mOpKPCJoQEhFSNLNJb3LQXzrJuZh8sDSz7Grp.webp',
                            ],
                            [
                                'slug' => 'ganesh-murti-dvi86',
                                'name' => 'Ganesh Murti',
                                'image' => 'v1ElnysR53OkrAwJ39ukSjAupymEiSEFYNt0XcvD.webp',
                            ],
                            [
                                'slug' => 'combos-buqpk',
                                'name' => 'Combos',
                                'image' => 'APJc1cSKcRKSQT4Vtq6sreUk58ZiJqYTTrmHGKyI.webp',
                            ],
                            [
                                'slug' => 'karungali-joklt',
                                'name' => 'Karungali',
                                'image' => 'dREBkpFHOVw6qL7uHp4MAEgjg6m6IGYZl6W87HE7.webp',
                            ],
                            [
                                'slug' => 'stone-uenmt',
                                'name' => 'Stone',
                                'image' => 'PfR4fHfvONlbBL1nmGyFbR55XNZiQOgR5EFHIcl7.webp',
                            ],
                            [
                                'slug' => 'purpose-0i83s',
                                'name' => 'Purpose',
                                'image' => 'afI4d3gXsFY5yNNVTLtUZenp9n4s0Ya6P94PIfBQ.webp',
                            ],
                            [
                                'slug' => 'best-selling-dbeyi',
                                'name' => 'Best Selling',
                                'image' => 'uNcdnWENlJ2Eu0pUxbuqkFSYmtL8lmgaRfIzjyet.webp',
                            ],
                        ];
                    @endphp

                    @foreach ($categories as $category)
                        <div class="carousel-box px-2">
                            <div class="category-scroll-item text-center">
                                <a class="d-block" href="{{ url('category/' . $category['slug']) }}">
                                    <div class="mega-icon mx-auto mb-2">
                                        <img src="https://suyagya.com/public/uploads/all/{{ $category['image'] }}"
                                            class="img-fluid" alt="{{ $category['name'] }}">
                                    </div>
                                    <span class="small fw-semibold text-dark">{{ $category['name'] }}</span>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <!-- END FIXED Carousel -->
        </div>
    </section>


    {{-- 🖼️ 2. HERO SLIDER SECTION --}}
    <section class="home-banner-area">
        <div class="container-fluid px-0">
            <div class="row g-0">
                <div class="col-12">

                    <div id="heroSlider">

                        <div>
                            <a href="https://suyagya.com/product/nazar-suraksha-bracelet">
                                <picture>
                                    <source media="(max-width: 767px)"
                                        srcset="https://suyagya.com/public/uploads/all/ofSDhistEjW75KY59JyQOtElcTG0WkTPZedsCPo2.png">
                                    <img class="bnanner-img"
                                        src="https://suyagya.com/public/uploads/all/j3tGiPFZFheIeifq04xYeZYW4T0bh4RYV4r5q3Zh.png"
                                        alt="">
                                </picture>
                            </a>
                        </div>

                        <div>
                            <a href="https://suyagya.com/category/ganesh-murti-dvi86">
                                <picture>
                                    <source media="(max-width: 767px)"
                                        srcset="https://suyagya.com/public/uploads/all/YyewO5EV4262WcUl5cRRCeQ2irWztcNA0OaQL11L.webp">
                                    <img class="bnanner-img"
                                        src="https://suyagya.com/public/uploads/all/eG4tkW28ENgmXPNZU2kbUvam92JyXouszv4rCmg9.png"
                                        alt="">
                                </picture>
                            </a>
                        </div>

                        <div>
                            <a href="#">
                                <picture>
                                    <source media="(max-width: 767px)"
                                        srcset="https://suyagya.com/public/uploads/all/VHPZZDPmVu9szDlipJBZlpNOhyFcQXxlpHDlUBpx.png">
                                    <img class="bnanner-img"
                                        src="https://suyagya.com/public/uploads/all/hFmzW4POb7yUYKmjax4LwhHOl9IIHRauDCZ49CEI.webp"
                                        alt="">
                                </picture>
                            </a>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </section>


    {{-- 🛒 3. BEST SELLING PRODUCTS (Placeholder for next section) --}}
    <section class="py-5 featured-products-section" style="background-color: var(--light)">
        {{-- Container now uses max-width: 1400px from CSS --}}
        <div class="container">

            {{-- Heading --}}
            <div class="d-flex justify-content-center mb-5">
                <div class="fancy-heading-box">
                    <h2 class="m-0">Featured Products</h2>
                </div>
            </div>

            {{-- Product Grid --}}
            <div class="row g-4">

                @for ($i = 1; $i <= 8; $i++)
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="product-card-minimal">

                            {{-- Image Area (Full Width & Height via CSS) --}}
                            <div class="img-box">
                                <span class="badge-sale">Sale</span>
                                <button class="btn-wishlist">
                                    <i class="las la-heart"></i>
                                </button>
                                <a href="#">
                                    {{-- Image is now set to object-fit: cover in CSS to fill the box --}}
                                    <img src="https://prinjal.com/cdn/shop/files/02_Detail_copy.jpg?v=1711632938&width=550"
                                        alt="Product Name">
                                </a>
                            </div>

                            {{-- Details Area --}}
                            <div class="product-details text-start">
                                <a href="#" class="product-title">Rudraksha Capping Silver Mala...</a>

                                <div class="d-flex align-items-center rating-row">
                                    <span class="stars">
                                        <i class="las la-star"></i>
                                        <i class="las la-star"></i>
                                        <i class="las la-star"></i>
                                        <i class="las la-star"></i>
                                        <i class="las la-star-half-alt"></i>
                                    </span>
                                    <span class="review-count">(178 reviews)</span>
                                </div>

                                <div class="price-row">
                                    <span class="price-current">Rs. 11,600</span>
                                    <span class="price-old">Rs. 15,400</span>
                                </div>

                                <button class="btn btn-earthy">
                                    {{ $i % 2 == 0 ? 'Add to cart' : 'Choose' }}
                                </button>
                            </div>

                        </div>
                    </div>
                @endfor

            </div>

            {{-- View All --}}
            <div class="text-center mt-5">
                <a href="#" class="btn btn-view-all rounded-pill px-4 py-2">View all products</a>
            </div>

        </div>
    </section>

    {{-- 🛒 4. video-feed-section (Placeholder for next section) --}}
    <section class="py-5 video-feed-section" style="background-color: #f7f1de;;">
        <div class="container-fluid px-4">

            <div class="d-flex justify-content-center mb-4">
                <div class="fancy-heading-box">
                    <h2 class="m-0">Explore Feed</h2>
                </div>
            </div>

            <div class="video-slider-container">
                <div class="video-carousel">

                    @php
                        $videos = [
                            [
                                'title' => 'Only Rudraksha',
                                'link' => url('category/rudraksh'),
                                'src' => 'https://www.w3schools.com/html/mov_bbb.mp4',
                                // 👇 पोस्टर (Image) जो वीडियो चलने से पहले दिखेगी
                                'image' =>
                                    'https://prinjal.com/cdn/shop/files/02_Detail_copy.jpg?v=1711632938&width=550',
                            ],
                            [
                                'title' => 'All Products',
                                'link' => url('products'),
                                'src' => 'https://www.w3schools.com/html/movie.mp4',
                                'image' =>
                                    'https://prinjal.com/cdn/shop/files/Karungali_Beads_Silver_Mala.jpg?v=1750912937&width=550',
                            ],
                            [
                                'title' => 'Karungali Mala',
                                'link' => '#',
                                'src' => 'https://www.w3schools.com/html/mov_bbb.mp4',
                                'image' => 'https://prinjal.com/cdn/shop/files/SNA69347-min.jpg?v=1752742164&width=550',
                            ],
                            [
                                'title' => 'Rudraksha Bracelets',
                                'link' => '#',
                                'src' => 'https://www.w3schools.com/html/movie.mp4',
                                'image' => 'https://prinjal.com/cdn/shop/files/SNA69239-min.jpg?v=1745405791&width=550',
                            ],
                            [
                                'title' => 'Rudraksha Mala',
                                'link' => '#',
                                'src' => 'https://www.w3schools.com/html/mov_bbb.mp4',
                                'image' => 'https://prinjal.com/cdn/shop/files/SNA69051-min.jpg?v=1744891596&width=550',
                            ],
                            [
                                'title' => 'Murti Collection',
                                'link' => '#',
                                'src' => 'https://www.w3schools.com/html/movie.mp4',
                                'image' =>
                                    'https://prinjal.com/cdn/shop/files/HanumanSilverIdol.png?v=1744016339&width=550',
                            ],
                            [
                                'title' => 'New Arrivals',
                                'link' => '#',
                                'src' => 'https://www.w3schools.com/html/mov_bbb.mp4',
                                'image' => 'https://prinjal.com/cdn/shop/files/SNA68975-min.jpg?v=1744880852&width=550',
                            ],
                        ];
                    @endphp

                    @foreach ($videos as $video)
                        <div class="px-2">
                            <div class="video-card">
                                <div class="video-wrapper">

                                    {{-- ✅ VIDEO TAG: 'poster' attribute shows the image first --}}
                                    <video loop playsinline preload="none" muted class="the-video"
                                        poster="{{ $video['image'] }}">
                                        <source src="{{ $video['src'] }}" type="video/mp4">
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
                                        <h5 class="video-title">{{ $video['title'] }}</h5>
                                    </div>

                                    {{-- Buy Now Overlay --}}
                                    <div class="video-overlay-hover">
                                        <a href="{{ $video['link'] }}" class="btn btn-buy-now-video w-100">
                                            Buy Now <i class="las la-arrow-right ms-1"></i>
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>

        </div>
    </section>


    <section class="py-5 favourites-section" style="background-color: #f7f1de;">
        <div class="container">

            {{-- 1. Fancy Heading --}}
            <div class="d-flex justify-content-center mb-5">
                <div class="fancy-heading-box">
                    <h2 class="m-0">Suyagya Favourites</h2>
                </div>
            </div>

            {{-- 2. Masonry Grid Layout --}}
            <div class="favourites-grid">

                {{-- TOP ROW WRAPPER --}}
                <div class="row g-3">

                    {{-- LEFT COLUMN (Contains 1 Wide Image + 2 Small Images) --}}
                    <div class="col-lg-8">

                        {{-- 1. Wide Image (Top Left) --}}
                        <div class="fav-card wide mb-3">
                            <img src="https://prinjal.com/cdn/shop/files/02_Detail_copy.jpg?v=1711632938"
                                class="img-fluid" alt="Rudraksha Mala">
                            <div class="fav-content">
                                <h3>Rudraksha Mala</h3>
                                <a href="#" class="btn btn-fav-shop">Shop now</a>
                            </div>
                        </div>

                        {{-- Row for 2 Small Images --}}
                        <div class="row g-3">
                            <div class="col-md-6">
                                {{-- 2. Small Image (Middle Left 1) --}}
                                <div class="fav-card standard">
                                    <img src="https://prinjal.com/cdn/shop/files/SNA69239-min.jpg?v=1745405791"
                                        class="img-fluid" alt="Bracelets">
                                    <div class="fav-content">
                                        <h3>Rudraksha Bracelets</h3>
                                        <a href="#" class="btn btn-fav-shop">Shop now</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                {{-- 3. Small Image (Middle Left 2) --}}
                                <div class="fav-card standard">
                                    <img src="https://prinjal.com/cdn/shop/files/SNA69051-min.jpg?v=1744891596"
                                        class="img-fluid" alt="Pendant">
                                    <div class="fav-content">
                                        <h3>Rudraksha Pendant</h3>
                                        <a href="#" class="btn btn-fav-shop">Shop now</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    {{-- RIGHT COLUMN (Contains 1 Tall Image) --}}
                    <div class="col-lg-4">
                        {{-- 4. Tall Image (Right Side) --}}
                        <div class="fav-card tall h-100">
                            <img src="https://prinjal.com/cdn/shop/files/Karungali_Beads_Silver_Mala.jpg?v=1750912937"
                                class="img-fluid" alt="Karungali Mala">
                            <div class="fav-content">
                                <h3>Karungali Mala</h3>
                                <a href="#" class="btn btn-fav-shop">Shop now</a>
                            </div>
                        </div>
                    </div>

                </div>
                {{-- END TOP ROW --}}

                {{-- BOTTOM ROW (Layout: 1 Small + 1 Wide) --}}
                <div class="row g-3 mt-0">

                    {{-- 1. Small Image (Left) --}}
                    <div class="col-md-4">
                        <div class="fav-card standard">
                            <img src="https://prinjal.com/cdn/shop/files/02_Detail_3172df1f-7ec7-447a-8345-581cdee4798f.jpg?v=1711690744"
                                class="img-fluid" alt="Adiyogi">
                            <div class="fav-content">
                                <h3>Adiyogi Pendant</h3>
                                <a href="#" class="btn btn-fav-shop">Shop now</a>
                            </div>
                        </div>
                    </div>

                    {{-- 2. Merged Wide Image (Right - Replaces 2 small divs) --}}
                    <div class="col-md-8">
                        <div class="fav-card wide">
                            {{-- यहाँ अपनी पसंद की चौड़ी इमेज लगाएं --}}
                            <img src="https://prinjal.com/cdn/shop/files/HanumanSilverIdol.png?v=1744016339"
                                class="img-fluid" alt="Murti Collection">
                            <div class="fav-content">
                                <h3>Murti Collection</h3>
                                <a href="#" class="btn btn-fav-shop">Shop now</a>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>

    <section class="py-5 energy-section" style="background-color: #f7f1de;">
        <div class="container">

            {{-- 1. Fancy Heading --}}
            <div class="d-flex justify-content-center mb-5">
                <div class="fancy-heading-box">
                    <h2 class="m-0">Choose Energy You Want to Attract</h2>
                </div>
            </div>

            {{-- 2. Energy Icons Grid --}}
            {{-- 'justify-content-center' keeps them centered if less than 8 on smaller screens --}}
            <div class="row g-4 justify-content-center">
                @php
                    $energies = [
                        // Wealth का आइकन आपने नहीं भेजा, इसलिए मैंने एक प्लेसहोल्डर लगा दिया है।
                        // कृपया इसे अपने Wealth आइकन के पाथ से बदलें।
                        ['name' => 'Wealth', 'icon' => asset('assets/img/icons/wealth.png')],

                        // बाकी आइकन आपके द्वारा भेजे गए हैं। कृपया इनका सही पाथ जाँच लें।
                        ['name' => 'Love', 'icon' => asset('assets/img/icons/love.png')],
                        ['name' => 'Health', 'icon' => asset('assets/img/icons/health.png')],
                        ['name' => 'Luck', 'icon' => asset('assets/img/icons/luck.png')],
                        ['name' => 'Protection', 'icon' => asset('assets/img/icons/protection.png')],
                        ['name' => 'Peace', 'icon' => asset('assets/img/icons/peace.png')],
                        ['name' => 'Courage', 'icon' => asset('assets/img/icons/courage.png')],
                        ['name' => 'Balance', 'icon' => asset('assets/img/icons/balance.png')],
                    ];
                @endphp

                @foreach ($energies as $energy)
                    {{-- Custom class 'col-lg-custom-8' for 8 items in a row on large screens --}}
                    <div class="col-6 col-sm-4 col-md-3 col-lg-custom-8">
                        <a href="#" class="energy-card text-decoration-none d-block text-center">

                            {{-- Icon Circle Wrapper --}}
                            <div class="icon-wrapper mb-3 mx-auto">
                                {{-- The Icon Image --}}
                                <img src="{{ $energy['icon'] }}" alt="{{ $energy['name'] }}" class="img-fluid">
                            </div>

                            {{-- Title --}}
                            <h5 class="energy-title">{{ $energy['name'] }}</h5>
                        </a>
                    </div>
                @endforeach
            </div>

        </div>
    </section>

    <section class="py-5 category-showcase-section" style="background-color: #f7f1de;">
        <div class="container-fluid px-4">

            {{-- 1. Heading --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="h3 fw-bold text-dark m-0">Original Karungali Beads Jewellery</h2>
                <a href="{{ url('category/karungali-joklt') }}" class="btn btn-outline-dark rounded-pill px-4">View
                    all</a>
            </div>

            <div class="row g-3">

                {{-- 2. LEFT SIDE: CATEGORY BANNER (Fixed) --}}
                <div class="col-lg-2 d-none d-lg-block">
                    {{-- Note: Changed to col-lg-2 to give more space to products --}}
                    <div class="category-banner-card h-100">
                        <img src="https://prinjal.com/cdn/shop/files/Karungali_Beads_Silver_Mala.jpg?v=1750912937"
                            alt="Karungali Jewellery" class="img-fluid banner-img">
                        <div class="banner-content">
                            <h3>Karungali<br>Jewellery</h3>
                        </div>
                    </div>
                </div>

                {{-- 3. RIGHT SIDE: 5 PRODUCTS ROW --}}
                <div class="col-lg-10 col-12">

                    {{-- Slider Wrapper --}}
                    <div class="category-product-slider">

                        @php
                            $products = [
                                [
                                    'name' => 'Karungali Silver Mala',
                                    'price' => '7,150',
                                    'old' => '8,150',
                                    'img' =>
                                        'https://prinjal.com/cdn/shop/files/Karungali_Beads_Silver_Mala.jpg?v=1750912937',
                                ],
                                [
                                    'name' => 'Karungali Om Beads',
                                    'price' => '12,350',
                                    'old' => '13,400',
                                    'img' => 'https://prinjal.com/cdn/shop/files/02_Detail_copy.jpg?v=1711632938',
                                ],
                                [
                                    'name' => 'Om Namah Shivaya',
                                    'price' => '10,550',
                                    'old' => '11,700',
                                    'img' => 'https://prinjal.com/cdn/shop/files/SNA69239-min.jpg?v=1745405791',
                                ],
                                [
                                    'name' => 'Damru Mala',
                                    'price' => '13,000',
                                    'old' => '15,200',
                                    'img' => 'https://prinjal.com/cdn/shop/files/SNA69051-min.jpg?v=1744891596',
                                ],
                                [
                                    'name' => 'Jay Shree Ram',
                                    'price' => '10,400',
                                    'old' => '11,400',
                                    'img' => 'https://prinjal.com/cdn/shop/files/HanumanSilverIdol.png?v=1744016339',
                                ],
                                [
                                    'name' => 'Simple Mala',
                                    'price' => '5,000',
                                    'old' => '6,500',
                                    'img' => 'https://prinjal.com/cdn/shop/files/SNA68975-min.jpg?v=1744880852',
                                ],
                            ];
                        @endphp

                        @foreach ($products as $product)
                            <div class="px-2">
                                <div class="product-card-standard h-100 border rounded-3 overflow-hidden">

                                    {{-- Image --}}
                                    <div class="card-img-wrapper position-relative bg-light" style="aspect-ratio: 1/1;">
                                        <span
                                            class="badge bg-light text-dark position-absolute top-0 start-0 m-2 fw-bold border">Sale</span>
                                        <button class="btn-wishlist-small position-absolute top-0 end-0 m-2"><i
                                                class="las la-heart"></i></button>
                                        <a href="#" class="d-block w-100 h-100">
                                            <img src="{{ $product['img'] }}" alt="{{ $product['name'] }}"
                                                class="w-100 h-100 object-fit-cover">
                                        </a>
                                    </div>

                                    {{-- Info --}}
                                    <div class="p-3 text-start">
                                        <h6 class="product-title mb-1 text-truncate"
                                            style="font-size: 14px; font-weight: 600;">{{ $product['name'] }}</h6>

                                        <div class="mb-2 text-warning" style="font-size: 12px;">
                                            <i class="las la-star"></i><i class="las la-star"></i><i
                                                class="las la-star"></i><i class="las la-star"></i><i
                                                class="las la-star"></i>
                                            <span class="text-muted ms-1">88 reviews</span>
                                        </div>

                                        <div class="mb-3">
                                            <span class="fw-bold text-dark">Rs. {{ $product['price'] }}</span>
                                            <span class="text-muted text-decoration-line-through small ms-2">Rs.
                                                {{ $product['old'] }}</span>
                                        </div>

                                        <button class="btn btn-add-cart w-100 text-white"
                                            style="background-color: #C19A6B;">Add to cart</button>
                                    </div>

                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="ratings-bar-section">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8">

                    <div class="ratings-content py-4">
                        <h3 class="text-white fw-bold m-0 mb-2">Join Over 50,000 Happy Customers.</h3>

                        <div class="d-flex justify-content-center align-items-center gap-2">
                            {{-- Stars --}}
                            <div class="stars-row">
                                <i class="las la-star"></i>
                                <i class="las la-star"></i>
                                <i class="las la-star"></i>
                                <i class="las la-star"></i>
                                <i class="las la-star-half-alt"></i>
                            </div>

                            {{-- Text --}}
                            <span class="text-white fw-600 fs-16">Rated 4.7/5 1,500 Reviews</span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <section class="py-5 testimonial-section" style="background-color: #f7f1de;">
        <div class="container">

            {{-- 1. Heading --}}
            <div class="d-flex justify-content-center mb-5">
                <div class="fancy-heading-box">
                    <h2 class="m-0">Customer Love</h2>
                </div>
            </div>

            {{-- 2. Testimonial Slider --}}
            <div class="testimonial-slider-container">
                <div class="testimonial-slider">

                    @php
                        // Demo Data for 6-7 Testimonials
                        $reviews = [
                            [
                                'name' => 'Archita',
                                'review' =>
                                    'I got the rose quartz pendant and bracelet set from a friend as a gift. Wore them solely because they look pretty, but I actually started to feel more positive and calm after a few days.',
                                'tagline' => 'Great product!',
                                'img' => 'https://prinjal.com/cdn/shop/files/02_Detail_copy.jpg?v=1711632938', // Replace with review image
                            ],
                            [
                                'name' => 'Rahul Sharma',
                                'review' =>
                                    'The Rudraksha Mala is absolutely authentic. I can feel the energy. The silver capping is done very neatly. Highly recommended for anyone looking for genuine products.',
                                'tagline' => 'Authentic & Powerful',
                                'img' => 'https://prinjal.com/cdn/shop/files/SNA69239-min.jpg?v=1745405791',
                            ],
                            [
                                'name' => 'Sneha Kapoor',
                                'review' =>
                                    'Ordered the Karungali bracelet. The quality is top-notch and the delivery was super fast. It looks very stylish with western wear too!',
                                'tagline' => 'Stylish & Spiritual',
                                'img' =>
                                    'https://prinjal.com/cdn/shop/files/Karungali_Beads_Silver_Mala.jpg?v=1750912937',
                            ],
                            [
                                'name' => 'Vikram Singh',
                                'review' =>
                                    'I bought the Hanuman Idol for my car dashboard. The detailing is intricate and beautiful. It gives me a sense of protection while driving.',
                                'tagline' => 'Beautiful Craftsmanship',
                                'img' => 'https://prinjal.com/cdn/shop/files/HanumanSilverIdol.png?v=1744016339',
                            ],
                            [
                                'name' => 'Priya Desai',
                                'review' =>
                                    'The Rose Quartz bracelet helped me find balance. I love the packaging and the little note that came with it. Will order again!',
                                'tagline' => 'Amazing Packaging',
                                'img' => 'https://prinjal.com/cdn/shop/files/SNA69051-min.jpg?v=1744891596',
                            ],
                            [
                                'name' => 'Amit Verma',
                                'review' =>
                                    'Genuine products at a reasonable price. The customer support team helped me choose the right Mukhi Rudraksha for my needs.',
                                'tagline' => 'Excellent Support',
                                'img' =>
                                    'https://prinjal.com/cdn/shop/files/02_Detail_3172df1f-7ec7-447a-8345-581cdee4798f.jpg?v=1711690744',
                            ],
                        ];
                    @endphp

                    @foreach ($reviews as $review)
                        <div class="px-3"> {{-- Spacing between cards --}}
                            <div class="testimonial-card">
                                <div class="row g-0 h-100">

                                    {{-- Left: Text Content --}}
                                    <div
                                        class="col-md-7 col-12 d-flex flex-column justify-content-center p-4 text-content">
                                        {{-- Stars --}}
                                        <div class="mb-3 text-warning">
                                            <i class="las la-star"></i><i class="las la-star"></i><i
                                                class="las la-star"></i><i class="las la-star"></i><i
                                                class="las la-star"></i>
                                        </div>

                                        {{-- Review Text --}}
                                        <p class="review-text mb-3">
                                            "{{ $review['review'] }}"
                                        </p>

                                        {{-- Tagline & Name --}}
                                        <h6 class="fw-bold text-dark mb-1">{{ $review['tagline'] }}</h6>
                                        <p class="text-muted small m-0 fw-600">- {{ $review['name'] }}</p>
                                    </div>

                                    {{-- Right: Image --}}
                                    <div class="col-md-5 col-12">
                                        <div class="review-img-wrapper h-100">
                                            <img src="{{ $review['img'] }}" alt="Customer Review" class="img-fluid">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>

        </div>
    </section>

    <section class="py-5 blog-section" style="background-color: #f7f1de;">
        <div class="container">

            {{-- 1. Heading --}}
            <div class="d-flex justify-content-center mb-5">
                <div class="fancy-heading-box">
                    <h2 class="m-0">Blogs</h2>
                </div>
            </div>

            {{-- 2. Blog Cards Row --}}
            <div class="row g-4 justify-content-center">

                @php
                    // Demo Blog Data - REPLACE IMAGES WITH YOUR OWN
                    $blogs = [
                        [
                            'title' => 'The Divine Power of Lord Shiva',
                            'tag' => 'Spiritual Knowledge',
                            // 👇 अपनी शिव जी की इमेज का लिंक यहाँ डालें
                            'img' => 'https://placehold.co/600x400/E8E8E8/333333?text=Lord+Shiva+Temple',
                            'desc' =>
                                'Discover the immense power and symbolism behind Lord Shiva, the destroyer and transformer in the Holy Trinity. Understand his role in the cosmic cycle.',
                        ],
                        [
                            'title' => 'Why We Worship Lord Ganesha First',
                            'tag' => 'Vedic Rituals',
                            // 👇 अपनी गणेश जी की इमेज का लिंक यहाँ डालें
                            'img' => 'https://placehold.co/600x400/E8E8E8/333333?text=Lord+Ganesha+Idol',
                            'desc' =>
                                'Understand the significance of invoking Lord Ganesha, the remover of obstacles, before any new beginning to ensure success and prosperity.',
                        ],
                        [
                            'title' => 'The Significance of Navratri & Maa Durga',
                            'tag' => 'Festivals & Deities',
                            // 👇 अपनी माँ दुर्गा की इमेज का लिंक यहाँ डालें
                            'img' => 'https://placehold.co/600x400/E8E8E8/333333?text=Maa+Durga',
                            'desc' =>
                                'Explore the nine divine forms of Goddess Durga worshipped during Navratri and their unique spiritual significance in empowering the soul.',
                        ],
                    ];
                @endphp

                @foreach ($blogs as $blog)
                    <div class="col-md-6 col-lg-4">
                        <div class="blog-card h-100">

                            {{-- Image & Tag Wrapper --}}
                            <div class="blog-img-wrapper">
                                <span class="blog-tag">{{ $blog['tag'] }}</span>
                                <a href="#" class="d-block h-100">
                                    <img src="{{ $blog['img'] }}" alt="{{ $blog['title'] }}" class="img-fluid">
                                </a>
                            </div>

                            {{-- Card Content --}}
                            <div class="blog-content">
                                <h3 class="blog-title">
                                    <a href="#" class="text-decoration-none text-dark">{{ $blog['title'] }}</a>
                                </h3>
                                <p class="blog-desc">{{ $blog['desc'] }}</p>
                                <a href="#" class="read-more-btn">
                                    Read more <i class="las la-arrow-right ms-1"></i>
                                </a>
                            </div>

                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>

    <section class="py-5 faq-section" style="background-color: #f7f1de;"> {{-- Earthy Background --}}
        <div class="container">

            {{-- 1. Fancy Heading (Light Box on Dark BG) --}}
            <div class="d-flex justify-content-center mb-5">
                <div class="fancy-heading-box" style="background-color: #FFFBF2;">
                    <h2 class="m-0">FAQs</h2>
                </div>
            </div>

            <div class="row">
                @php
                    $faqs = [
                        [
                            'q' => 'What makes Suyagya jewelry unique?',
                            'a' =>
                                'Our jewelry is handcrafted using authentic beads and 92.5 sterling silver, ensuring spiritual energy and durability.',
                        ],
                        [
                            'q' => 'Are Suyagya Rudraksha beads genuine and certified?',
                            'a' =>
                                'Yes, every Rudraksha bead is lab-tested and comes with an authenticity certificate.',
                        ],
                        [
                            'q' => 'Can I buy jewelry for kids and women too?',
                            'a' =>
                                'Absolutely! We have a wide range of lightweight and adjustable designs suitable for everyone.',
                        ],
                        [
                            'q' => 'Why does the color of Rudraksha & Silver change?',
                            'a' =>
                                'Silver naturally oxidizes over time, and Rudraksha may darken due to body oils, which is a natural process.',
                        ],
                        [
                            'q' => 'Is Suyagya’s silver capping made of genuine silver?',
                            'a' => 'Yes, we strictly use 92.5 Sterling Silver for all our capping and chains.',
                        ],
                        [
                            'q' => 'Why is Suyagya better than other brands?',
                            'a' =>
                                'We prioritize spiritual authenticity, premium craftsmanship, and verified materials over mass production.',
                        ],
                        [
                            'q' => 'How do Karungali and Black Rudraksha differ?',
                            'a' =>
                                'While both Karungali and Black Rudraksha have protective spiritual qualities, Karungali is a type of sacred wood, offering durability and natural energy, whereas Black Rudraksha is a bead from the Rudraksha tree, prized for its unique metaphysical benefits.',
                        ],
                        [
                            'q' => 'Why wear Karungali by Suyagya?',
                            'a' =>
                                'Our Karungali is sourced from mature ebony trees and crafted to retain its natural electromagnetic properties.',
                        ],
                    ];
                @endphp

                {{-- Left Column (First Half) --}}
                <div class="col-lg-6">
                    <div class="accordion" id="faqAccordionLeft">
                        @foreach (array_slice($faqs, 0, 4) as $key => $faq)
                            <div class="faq-item mb-3">
                                <h2 class="accordion-header" id="headingL{{ $key }}">
                                    <button class="accordion-button collapsed faq-btn" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseL{{ $key }}"
                                        aria-expanded="false">
                                        {{ $faq['q'] }}
                                    </button>
                                </h2>
                                <div id="collapseL{{ $key }}" class="accordion-collapse collapse"
                                    data-bs-parent="#faqAccordionLeft">
                                    <div class="accordion-body faq-answer">
                                        {{ $faq['a'] }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Right Column (Second Half) --}}
                <div class="col-lg-6">
                    <div class="accordion" id="faqAccordionRight">
                        @foreach (array_slice($faqs, 4) as $key => $faq)
                            <div class="faq-item mb-3">
                                <h2 class="accordion-header" id="headingR{{ $key }}">
                                    <button class="accordion-button collapsed faq-btn" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseR{{ $key }}"
                                        aria-expanded="false">
                                        {{ $faq['q'] }}
                                    </button>
                                </h2>
                                <div id="collapseR{{ $key }}" class="accordion-collapse collapse"
                                    data-bs-parent="#faqAccordionRight">
                                    <div class="accordion-body faq-answer">
                                        {{ $faq['a'] }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>

        </div>
    </section>

    <section class="py-5 brand-story-section" style="background-color: #FFFBF2;">
        <div class="container">

            <div class="accordion" id="brandStoryAccordion">
                <div class="accordion-item bg-transparent border-0 border-bottom border-dark">

                    {{-- 1. The Clickable Header --}}
                    <h2 class="accordion-header" id="headingStory">
                        <button class="accordion-button collapsed bg-transparent shadow-none text-dark fw-bold fs-5 px-0"
                            type="button" data-bs-toggle="collapse" data-bs-target="#collapseStory"
                            aria-expanded="false" aria-controls="collapseStory">
                            Suyagya - India's Best Spiritual Jewelry Brand
                        </button>
                    </h2>

                    {{-- 2. The Expandable Content (Text from Image 1) --}}
                    <div id="collapseStory" class="accordion-collapse collapse" aria-labelledby="headingStory"
                        data-bs-parent="#brandStoryAccordion">
                        <div class="accordion-body px-0 pt-4 brand-story-content text-secondary">

                            <p>At Suyagya, we celebrate the age-old art of jewelry-making while interweaving it with
                                contemporary designs that resonate with today's generation. Our collections are a medley of
                                tradition, spirituality, and modernity.</p>

                            <h4 class="mt-4 text-dark fw-bold">1. Men Jewelry Collection</h4>
                            <p>For the modern man who values tradition, our Men Jewelry Collection strikes the perfect
                                balance between style and spirituality.</p>
                            <ul>
                                <li><strong>Rudraksha Mala:</strong> Embrace the spiritual essence with our authentic
                                    Rudraksha Malas.</li>
                                <li><strong>Rudraksha Pendant:</strong> A symbol of spirituality and wellbeing, our
                                    Rudraksha Pendants meld authenticity with style.</li>
                                <li><strong>Adiyogi Pendant:</strong> Celebrate the essence of spiritual awakening with our
                                    intricately designed Adiyogi Pendants.</li>
                                <li><strong>Rudraksha Bracelet:</strong> Infuse your everyday style with a touch of divinity
                                    with our range of Rudraksha bracelets.</li>
                            </ul>

                            <h4 class="mt-4 text-dark fw-bold">2. Women Jewelry Collection</h4>
                            <p>Elegance, tradition, and style converge in our Women Jewelry Collection, catering to the
                                multifaceted women of today.</p>
                            <ul>
                                <li><strong>Necklace Set for Women:</strong> From ornate sets for special occasions to
                                    minimalistic designs for daily wear.</li>
                                <li><strong>Women Mangalsutra:</strong> A symbol of marital bliss, our Mangalsutras blend
                                    tradition with modern designs.</li>
                                <li><strong>Women Bracelets:</strong> A melange of tradition and contemporary designs,
                                    perfect for gracing a woman's delicate wrist.</li>
                                <li><strong>Anklets for Women:</strong> Adorn your feet with our range of silver anklets,
                                    from traditional ghungroo designs to contemporary styles.</li>
                            </ul>

                            <h4 class="mt-4 text-dark fw-bold">3. Kids Jewelry Collection</h4>
                            <p>Cherish the innocent milestones of childhood with our endearing Kids Jewelry Collection.</p>
                            <ul>
                                <li><strong>Baby Bracelet:</strong> Gentle, safe, and crafted with love, our baby bracelets
                                    are perfect keepsakes.</li>
                                <li><strong>Kids Nazariya:</strong> Let every tiny step jingle with joy with our traditional
                                    and skin-friendly Nazariyas.</li>
                            </ul>

                            <h4 class="mt-4 text-dark fw-bold">4. Stone Malas & Bracelets</h4>
                            <p>Discover the natural beauty and craftsmanship of our Stone Mala Collection, featuring
                                intricately designed malas crafted from high-quality natural stones.</p>
                            <ul>
                                <li><strong>Karungali Stone Mala:</strong> Made from Ebony Wood (Karungali), these malas
                                    exude bold elegance.</li>
                                <li><strong>Sphatik Stone Mala:</strong> Featuring Crystal Beads (Sphatik), these malas
                                    offer a sleek and polished look.</li>
                            </ul>

                            <h3 class="mt-5 text-dark fw-bold">The Suyagya Promise: Unwavering Quality, Authenticity, and
                                Trust</h3>

                            <h5 class="mt-3 text-dark fw-bold">1. Uncompromised Quality:</h5>
                            <p>Every jewelry piece at Suyagya undergoes rigorous quality checks to ensure it stands true to
                                the high standards we've set for ourselves.</p>

                            <h5 class="mt-3 text-dark fw-bold">2. Authenticity Assured:</h5>
                            <p>With the flood of counterfeit products in the market, we understand the concerns about
                                authenticity. At Suyagya, our promise is genuine, and so are our products.</p>

                            <h5 class="mt-3 text-dark fw-bold">3. Features Tailored for You:</h5>
                            <p>At Suyagya, customization is at the heart of what we do. Recognizing the uniqueness of every
                                individual.</p>

                            <h5 class="mt-3 text-dark fw-bold">4. Building Trust, One Piece at a Time:</h5>
                            <p>Trust is the cornerstone of Suyagya's ethos. And we strive, day in and day out, to fortify
                                this trust.</p>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>


@endsection

@section('scripts')
    {{-- Initialization script for the carousel --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script>
        $(document).ready(function() {
            // Initialize Category Scroll Carousel
            $('#categoryScroll').slick({
                slidesToShow: 8,
                slidesToScroll: 2,
                infinite: false,
                arrows: true,
                dots: false,
                speed: 500,
                variableWidth: false,
                responsive: [{
                        breakpoint: 1200,
                        settings: {
                            slidesToShow: 7
                        }
                    },
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 5
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 4
                        }
                    },
                    {
                        breakpoint: 576,
                        settings: {
                            slidesToShow: 3
                        }
                    },
                ]
            });

            $('#heroSlider').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 1500,
                infinite: true,
                arrows: false, // Hide Previous & Next buttons
                dots: false
            });
        });
    </script>
@endsection
