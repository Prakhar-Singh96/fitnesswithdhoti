<header class="sticky-top z-1020 shadow-sm" style="background-color: var(--light) !important;">

    {{-- ⭐️ Top Bar - Language, Currency, Seller Links --}}
    {{-- Top bar background color changed to match the light tone in the example --}}
    <div class="top-navbar d-none d-lg-block border-bottom" style="background-color: var(--light) !important;">
        <div class="container-fluid px-3">
            <div class="d-flex justify-content-between align-items-center py-1">

                <div class="d-flex align-items-center">
                    {{-- Language switcher --}}
                    <div class="dropdown me-3" id="lang-change">
                        {{-- Text color is dark, not light --}}
                        <a href="javascript:void(0)" class="dropdown-toggle text-dark small" data-bs-toggle="dropdown"
                            data-bs-display="static">
                            <span style="color: var(--dark);">English</span>
                        </a>
                        {{-- ... (Dropdown Content) ... --}}
                    </div>

                    {{-- Currency Switcher --}}
                    <div class="dropdown" id="currency-change">
                        <a href="javascript:void(0)" class="dropdown-toggle text-dark small" data-bs-toggle="dropdown"
                            data-bs-display="static">
                            <span style="color: var(--dark);">Currency</span>
                        </a>
                        {{-- ... (Dropdown Content) ... --}}
                    </div>
                </div>

                <div class="d-flex align-items-center">
                    <a href="{{ url('shops/create') }}" class="text-dark small pe-3 border-end">Become a seller!</a>
                    <a href="{{ url('seller/login') }}" class="text-dark small ps-3">Login to Seller</a>
                </div>
            </div>
        </div>
    </div>

    {{-- 🏠 Logo and Main Nav Bar --}}
    {{-- Golden Border is correctly placed at the bottom of the whole header, handled by CSS --}}
    <nav class="navbar navbar-expand-lg py-0">
        <div class="container-fluid px-3">

            {{-- Logo --}}
            <a class="navbar-brand py-2 me-lg-5" href="{{ url('/') }}">
                <img src="https://suyagya.com/public/uploads/all/ackLS169wFEfhj8jfhnb0SGblGIHug1XfDCg7WIs.webp"
                    alt="Suyagya" height="50">
            </a>

            {{-- Collapse/Main Menu Links --}}
            <div class="collapse navbar-collapse justify-content-start" id="mainMenu">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 main-nav-list">

                    {{-- 1. Products Dropdown (Keep structure for future Mega Menu) --}}
                    <li class="nav-item dropdown mega-parent me-3">
                        <a class="nav-link text-dark dropdown-toggle" href="#" id="productsDropdown"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Products
                        </a>
                        {{-- 🔴 Empty Dropdown: As requested, we will leave the content empty here --}}
                        <div class="dropdown-menu mega-menu border-0 shadow w-100" aria-labelledby="productsDropdown">
                            <div class="mega-bg container-fluid px-5 py-3"
                                style="background-color: var(--light) !important;">
                                <div class="row text-center mega-grid">

                                    @foreach ($headerCategories as $category)
                                        <div class="col-3 mb-2">
                                            <a href="{{ route('products.category', $category->slug) }}"
                                                class="d-flex flex-column align-items-center text-decoration-none">

                                                <div class="mega-icon">
                                                    <img src="{{ asset($category->icon_image) }}"
                                                        alt="{{ $category->name }}" class="rounded-circle"
                                                        onerror="this.src='{{ asset('assets/img/placeholder.jpg') }}'">
                                                </div>

                                                <span class="small fw-bold text-dark mt-2">
                                                    {{ $category->name }}
                                                </span>
                                            </a>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </li>

                    {{-- 🟢 DYNAMIC CATEGORIES & SUB-CATEGORIES LOOP --}}
                    @foreach ($headerCategories as $category)
                        {{-- Check: Agar SubCategories hain toh Dropdown banega --}}
                        @if ($category->subCategories->count() > 0)
                            <li class="nav-item dropdown hover-dropdown me-3">
                                {{-- Main Category Name --}}
                                <a class="nav-link text-dark dropdown-toggle fw-bold"
                                    href="{{ route('products.category', $category->slug) }}"
                                    id="catDrop{{ $category->id }}" role="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    {{ $category->name }}
                                </a>

                                {{-- Sub-Category List (Japam Style List) --}}
                                <ul class="dropdown-menu border-0 shadow-sm rounded-0 p-0"
                                    aria-labelledby="catDrop{{ $category->id }}">
                                    @foreach ($category->subCategories as $sub)
                                        <li>
                                            <a class="dropdown-item py-2 px-3 border-bottom text-muted"
                                                href="{{ route('products.subcategory', [$category->slug, $sub->slug]) }}">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <span>{{ $sub->name }}</span>
                                                    <i class="las la-angle-right small"></i>
                                                </div>
                                            </a>
                                        </li>
                                    @endforeach

                                    {{-- 'View All' Link at bottom --}}
                                    <li>
                                        <a class="dropdown-item py-2 px-3 fw-bold text-primary bg-light"
                                            href="{{ route('products.category', $category->slug) }}">
                                            View All {{ $category->name }}
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @else
                            {{-- Agar SubCategory nahi hai toh Direct Link banega --}}
                            <li class="nav-item me-3">
                                <a href="{{ route('products.category', $category->slug) }}"
                                    class="nav-link text-dark fw-bold">
                                    {{ $category->name }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>

            {{-- 3. ICON ACTION BLOCK (Astrotalk Style) --}}
            <div class="d-flex align-items-center nav-action-icons ms-auto">

                {{-- 🔥 1. Search Icon --}}
                <div class="nav-search-icon ms-2">
                    <a href="javascript:void(0);" onclick="toggleSearch()" title="Search">
                        <i class="las la-search"></i>
                    </a>
                </div>

                {{-- 👤 2. Account Icon --}}
                <div class="nav-user-auth ms-4">
                    <a href="javascript:void(0);" onclick="showLoginModal()" title="Account">
                        <i class="las la-user-circle"></i>
                    </a>
                </div>

                {{-- ⭐ 3. Wishlist/Favorite Icon --}}
                <div class="nav-wishlist-icon ms-4">
                    <a href="{{ url('/wishlists') }}" title="Wishlist" class="position-relative">
                        <i class="las la-heart"></i>
                    </a>
                </div>

                {{-- 🛒 4. Cart Icon (Shopping Bag style from Astrotalk) --}}
                <div class="nav-cart-box ms-4">
                    <a href="#" title="Cart">
                        <i class="las la-shopping-bag"></i>
                    </a>
                </div>

            </div>

            {{-- Mobile Toggle Button (Hidden on Desktop) --}}
            <button class="navbar-toggler p-0 d-lg-none" type="button" data-bs-toggle="collapse"
                data-bs-target="#mainMenu" aria-controls="mainMenu" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>
</header>
