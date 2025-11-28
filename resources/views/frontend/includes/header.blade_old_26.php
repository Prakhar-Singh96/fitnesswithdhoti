<header class="sticky-top z-1020 shadow-sm" style="background-color: var(--primary) !important;">

    {{-- ⭐️ Top Bar - Language, Currency, Seller Links --}}
    <div class="top-navbar d-none d-lg-block border-bottom"
        style="background-color: var(--light) !important;">
        <div class="container-fluid px-3">
            <div class="d-flex justify-content-between align-items-center py-1">

                <div class="d-flex align-items-center">
                    {{-- Language switcher --}}
                    <div class="dropdown me-3" id="lang-change">
                        <a href="javascript:void(0)" class="dropdown-toggle text-soft-light small"
                            data-bs-toggle="dropdown" data-bs-display="static">
                            <span>English</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-start bg-light" style="--bs-bg-opacity: .9;">
                            {{-- ... (Language Dropdown content) ... --}}
                        </ul>
                    </div>

                    {{-- Currency Switcher --}}
                    <div class="dropdown" id="currency-change">
                        <a href="javascript:void(0)" class="dropdown-toggle text-soft-light small"
                            data-bs-toggle="dropdown" data-bs-display="static">
                            Indian Rupee
                        </a>
                        <ul class="dropdown-menu dropdown-menu-start bg-light" style="--bs-bg-opacity: .9;">
                            {{-- ... (Currency Dropdown content) ... --}}
                        </ul>
                    </div>
                </div>

                <div class="d-flex align-items-center">
                    <a href="{{ url('shops/create') }}" class="text-soft-light small pe-3 border-end">Become a Seller
                        !</a>
                    <a href="{{ url('seller/login') }}" class="text-soft-light small ps-3">Login to Seller</a>
                </div>
            </div>
        </div>
    </div>

    {{-- 🏠 Logo and Main Nav Bar --}}
    <nav class="navbar navbar-expand-lg py-0">
        <div class="container-fluid px-3">

            {{-- Mobile Toggle Button --}}
            <button class="navbar-toggler p-0" type="button" data-bs-toggle="collapse" data-bs-target="#mainMenu"
                aria-controls="mainMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            {{-- Logo --}}
            <a class="navbar-brand py-2 me-lg-4" href="{{ url('/') }}">
                <img src="https://suyagya.com/public/uploads/all/ackLS169wFEfhj8jfhnb0SGblGIHug1XfDCg7WIs.webp"
                    alt="Suyagya" height="50">
            </a>

            {{-- Collapse/Main Menu Links --}}
            <div class="collapse navbar-collapse justify-content-start" id="mainMenu">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 main-nav-list">

                    {{-- 1. PRODUCTS (MEGA MENU ON HOVER) --}}
                    <li class="nav-item dropdown mega-parent">
                        <a class="nav-link fs-13 fw-bold text-white header_menu_links dropdown-toggle" href="#"
                            id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Products
                            {{-- <i class="las la-angle-down text-white ms-1"></i> --}}
                        </a>

                        {{-- 👇 यह Mega Menu Dropdown का HTML है --}}
                        <div class="dropdown-menu mega-menu border-0 shadow" aria-labelledby="navbarDropdown">
                            <div class="mega-bg container-fluid p-4" style="background-color: var(--light) !important;">
                                <div class="row g-3 text-center mega-grid">

                                    {{-- 🟢 MEGA MENU CATEGORY ITEMS (Replace with your full list) 🟢 --}}
                                    @php
                                        $categories = [
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
                                                'slug' => 'bracelet-ye8hk',
                                                'name' => 'Bracelet',
                                                'image' => 'ffsSJvJ3mMxG1ZALWyFjioFM5Wde66p91GnBcKYa.webp',
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
                                        <div class="col-6 col-sm-4 col-md-3 col-xl-1-5"> {{-- col-xl-1-5 for 8 columns on large screens --}}
                                            <a href="https://suyagya.com/category/{{ $category['slug'] }}"
                                                class="mega-item d-flex flex-column align-items-center">
                                                <div class="mega-icon mb-2">
                                                    <img src="https://suyagya.com/public/uploads/all/{{ $category['image'] }}"
                                                        alt="{{ $category['name'] }}" class="img-fluid"
                                                        onerror="this.src='{{ asset('assets/img/placeholder.jpg') }}'">
                                                </div>
                                                <span class="small fw-semibold text-dark">{{ $category['name'] }}</span>
                                            </a>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </li>

                    {{-- 2. Direct Nav Links --}}
                    <li class="nav-item"><a href="{{ url('category/shankh-wszyo') }}"
                            class="nav-link fs-13 fw-bold text-white header_menu_links">Shankh</a></li>
                    <li class="nav-item"><a href="{{ url('category/shivling-egajb') }}"
                            class="nav-link fs-13 fw-bold text-white header_menu_links">Shivling</a></li>
                    <li class="nav-item"><a href="{{ url('category/Karungali-jOkLt') }}"
                            class="nav-link fs-13 fw-bold text-white header_menu_links">Karungali</a></li>
                    <li class="nav-item"><a href="{{ url('category/jap-mala-9y6fr') }}"
                            class="nav-link fs-13 fw-bold text-white header_menu_links">Jap Mala</a></li>
                </ul>
            </div>

            {{-- User/Cart/Login Block (Pushed to the right) --}}
            <div class="nav-action-icons d-flex align-items-center">

                {{-- 🔥 Search Icon --}}
                <div class="nav-search-icon me-3">
                    <a href="javascript:void(0);" onclick="toggleSearch()" title="Search">
                        <i class="las la-search"></i>
                    </a>
                </div>

                {{-- 🛒 Cart Icon --}}
                <div class="nav-cart-box dropdown me-3">
                    <a href="#" id="cartDropdown" data-bs-toggle="dropdown" aria-expanded="false" title="Cart">
                        <i class="las la-shopping-cart"></i>
                        <span class="fw-bold">Rs 0</span>
                        <span class="small">(<span class="cart-count">0</span>)</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end p-3 bg-light">
                        <li class="text-muted small">Your Cart is empty</li>
                    </ul>
                </div>

                {{-- 👤 Login Icon --}}
                <div class="nav-user-auth">
                    <a href="javascript:void(0);" onclick="showLoginModal()" title="Login">
                        <i class="las la-user-circle"></i>
                    </a>
                </div>

            </div>
        </div>
    </nav>
    <div class="header-search-bar bg-light p-3 shadow-sm" style="display: none;">
        <div class="container">
            <form action="{{ url('/search') }}" method="GET" class="d-flex">
                <input type="text" name="keyword" class="form-control" placeholder="Search spiritual items...">
                <button class="btn btn-primary ms-2">Search</button>
            </form>
        </div>
    </div>
</header>
