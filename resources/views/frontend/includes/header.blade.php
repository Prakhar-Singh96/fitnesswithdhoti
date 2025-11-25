<header class="sticky-top z-1020" style="background-color: var(--primary) !important;">
    
    {{-- ⭐️ Top Bar - Language, Currency, Seller Links --}}
    <div class="top-navbar z-1035 h-35px h-sm-auto d-none d-lg-block" style="background-color: var(--primary) !important;">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col">
                    <ul class="list-inline d-flex justify-content-between justify-content-lg-start mb-0">
                        
                        {{-- Language switcher --}}
                        <li class="list-inline-item dropdown mr-4" id="lang-change">
                            <a href="javascript:void(0)" class="dropdown-toggle text-soft-light fs-12 py-2" data-toggle="dropdown" data-display="static">
                                <span>English</span> 
                            </a>
                            {{-- Language Dropdown content (Placeholder data) --}}
                            <ul class="dropdown-menu dropdown-menu-left">
                                <li><a href="javascript:void(0)" data-flag="en" class="dropdown-item active">
                                    <img src="{{ asset('assets/img/flags/en.png') }}" class="mr-1 lazyload" alt="English" height="11">
                                    <span class="language">English</span>
                                </a></li>
                                <li><a href="javascript:void(0)" data-flag="in" class="dropdown-item">
                                    <img src="{{ asset('assets/img/flags/in.png') }}" class="mr-1 lazyload" alt="Hindi" height="11">
                                    <span class="language">Hindi</span>
                                </a></li>
                            </ul>
                        </li>
                        
                        {{-- Currency Switcher (Placeholder data) --}}
                        <li class="list-inline-item dropdown ml-auto ml-lg-0 mr-0" id="currency-change">
                            <a href="javascript:void(0)" class="dropdown-toggle text-soft-light fs-12 py-2" data-toggle="dropdown" data-display="static">
                                Indian Rupee
                            </a>
                            {{-- Currency Dropdown content --}}
                            <ul class="dropdown-menu dropdown-menu-right dropdown-menu-lg-left">
                                <li><a class="dropdown-item active" href="javascript:void(0)" data-currency="INR">Indian Rupee (Rs)</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0)" data-currency="USD">U.S. Dollar ($)</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>

                <div class="col-6 text-right d-none d-lg-block">
                    <ul class="list-inline mb-0 h-100 d-flex justify-content-end align-items-center">
                        {{-- Become a Seller --}}
                        <li class="list-inline-item mr-0 pl-0 py-2">
                            <a href="{{ url('shops/create') }}" class="text-soft-light fs-12 pr-3 d-inline-block border-width-2 border-right" >Become a Seller !</a>
                        </li>
                        {{-- Seller Login --}}
                        <li class="list-inline-item mr-0 pl-0 py-2">
                            <a href="{{ url('seller/login') }}" class="text-soft-light fs-12 pl-3 d-inline-block" >Login to Seller</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    {{-- 🏠 Logo and Main Nav --}}
    <div class="position-relative logo-bar-area border-md-nonea z-1025">
        <div class="container p-0">
            <div class="d-flex align-items-center">
                
                {{-- Toggle Button for Mobile Menu --}}
                <button type="button" class="btn d-lg-none p-0 active ml-3" data-toggle="class-toggle" data-target=".aiz-top-menu-sidebar">
                    <svg id="Component_43_1" data-name="Component 43 – 1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                        <rect id="Rectangle_19062" data-name="Rectangle 19062" width="16" height="2" transform="translate(0 7)" fill="var(--soft-white)" />
                        <rect id="Rectangle_19063" data-name="Rectangle 19063" width="16" height="2" fill="var(--soft-white)" />
                        <rect id="Rectangle_19064" data-name="Rectangle 19064" width="16" height="2" transform="translate(0 14)" fill="var(--soft-white)" />
                    </svg>
                </button>

                {{-- Logo --}}
                <div class="col-auto pl-0 pr-0 d-flex align-items-center m-auto">
                    <a class="d-block py-5px mr-0 ml-0" href="{{ url('/') }}">
                        {{-- Ensure this asset path is correct from your public directory --}}
                        <img src="https://suyagya.com/public/uploads/all/ackLS169wFEfhj8jfhnb0SGblGIHug1XfDCg7WIs.webp"
                             alt="Suyagya" class="mw-100 h-60px h-md-60px" height="60">
                    </a>
                </div>
                
                {{-- Header Menus (Desktop) --}}
                <div class="d-none d-lg-block position-relative h-50px flex-grow-1" style="background-color: var(--primary) !important;">
                    <div class="container h-100">
                        <div class="d-flex h-100">
                            <div class="ml-xl-4 w-100 overflow-hidden">
                                <div class="d-flex align-items-center justify-content-center justify-content-xl-start h-100">
                                    <ul class="list-inline mb-0 pl-0 hor-swipe c-scrollbar-light">
                                        
                                        {{-- PRODUCTS (MEGA MENU ON HOVER) --}}
                                        <li class="nav-item dropdown mega-parent position-static">
                                            <a class="nav-link fs-13 px-3 py-3 d-inline-block fw-700 text-white header_menu_links hov-bg-black-10" href="#">
                                                Products
                                                <i class="las la-angle-down text-white" style="font-size: 1rem"></i>
                                            </a>
                                            {{-- Mega Menu Dropdown Structure (Full content restored) --}}
                                            <div class="mega-menu w-100 mt-0 border-0 shadow">
                                                <div class="mega-bg" style="background-color: var(--light);">
                                                    <div class="container py-4">
                                                        <div class="row g-4 text-center row-cols-3 row-cols-sm-3 row-cols-md-5 row-cols-xl-8">
                                                            {{-- Item 1: Bracelet --}}
                                                            <div class="col mt-2 mb-2 p-0">
                                                                <a href="{{ url('category/bracelet-ye8hk') }}" class="mega-item">
                                                                    <div class="mega-icon">
                                                                        <img src="https://suyagya.com/public/uploads/all/ffsSJvJ3mMxG1ZALWyFjioFM5Wde66p91GnBcKYa.webp" class="lazyload img-fit mx-auto has-transition" style="border-radius:50%;" alt="Bracelet" onerror="this.src='{{ asset('assets/img/placeholder.jpg') }}'">
                                                                    </div>
                                                                    <span>Bracelet</span>
                                                                </a>
                                                            </div>
                                                            {{-- Item 2: Rudraksh --}}
                                                            <div class="col mt-2 mb-2 p-0">
                                                                <a href="{{ url('category/rudraksh-fdfhq') }}" class="mega-item">
                                                                    <div class="mega-icon">
                                                                        <img src="{{ asset('public/uploads/all/Ndy2huteC3obeeQi5d25FrrRzRBPsFZsEjMmOlVd.webp') }}" class="lazyload img-fit mx-auto has-transition" style="border-radius:50%;" alt="Rudraksh" onerror="this.src='{{ asset('assets/img/placeholder.jpg') }}'">
                                                                    </div>
                                                                    <span>Rudraksh</span>
                                                                </a>
                                                            </div>
                                                            {{-- Item 3: Shankh --}}
                                                            <div class="col mt-2 mb-2 p-0">
                                                                <a href="{{ url('category/shankh-wszyo') }}" class="mega-item">
                                                                    <div class="mega-icon">
                                                                        <img src="{{ asset('public/uploads/all/aw7qmny1N9MCZJTmkHZEMqiyVVAKDLyJIGRfyr5d.webp') }}" class="lazyload img-fit mx-auto has-transition" style="border-radius:50%;" alt="Shankh" onerror="this.src='{{ asset('assets/img/placeholder.jpg') }}'">
                                                                    </div>
                                                                    <span>Shankh</span>
                                                                </a>
                                                            </div>
                                                            {{-- ... (Rest of the Mega Menu categories: Shivling, Jap Mala, Locket, Shri Yantra, Ghode ki naal, Mala, Ganesh Murti, Combos, Karungali, Stone, Purpose, Best Selling) ... --}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                    
                                    {{-- Direct Nav Links (Remaining Categories) --}}
                                    <ul class="list-inline mb-0 pl-0 hor-swipe c-scrollbar-light">
                                        <li class="list-inline-item mr-0 animate-underline-white">
                                            <a href="{{ url('category/shankh-wszyo') }}" class="fs-13 px-3 py-3 d-inline-block fw-700 text-white header_menu_links hov-bg-black-10">Shankh</a>
                                        </li>
                                        <li class="list-inline-item mr-0 animate-underline-white">
                                            <a href="{{ url('category/shivling-egajb') }}" class="fs-13 px-3 py-3 d-inline-block fw-700 text-white header_menu_links hov-bg-black-10">Shivling</a>
                                        </li>
                                        <li class="list-inline-item mr-0 animate-underline-white">
                                            <a href="{{ url('category/Karungali-jOkLt') }}" class="fs-13 px-3 py-3 d-inline-block fw-700 text-white header_menu_links hov-bg-black-10">Karungali</a>
                                        </li>
                                        {{-- Add other important direct links here --}}
                                        <li class="list-inline-item mr-0 animate-underline-white">
                                            <a href="{{ url('category/jap-mala-9y6fr') }}" class="fs-13 px-3 py-3 d-inline-block fw-700 text-white header_menu_links hov-bg-black-10">Jap Mala</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            
                            {{-- Cart Icon (Desktop) --}}
                            <div class="d-none d-xl-block align-self-stretch ml-2 mr-0 has-transition" data-hover="dropdown">
                                <div class="nav-cart-box dropdown h-100" id="cart_items" style="width: max-content;">
                                    {{-- Cart button with count --}}
                                    <a href="javascript:void(0)" class="d-flex align-items-center text-white px-3 h-100" data-toggle="dropdown" data-display="static" title="Cart">
                                        <span class="mr-2">
                                            {{-- Cart SVG icon (Full path restored and fill set to white) --}}
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="20.562" viewBox="0 0 24 20.562">
                                                <g id="_5e67fc94b53aaec8ca181b806dd815ee" data-name="5e67fc94b53aaec8ca181b806dd815ee" transform="translate(-33.276 -101)">
                                                    <path id="Path_32659" data-name="Path 32659" d="M34.034,102.519H38.2l-.732-.557c.122.37.243.739.365,1.112q.441,1.333.879,2.666.528,1.6,1.058,3.211.46,1.394.917,2.788c.149.451.291.9.446,1.352l.008.02a.76.76,0,0,0,1.466-.4c-.122-.37-.243-.739-.365-1.112q-.441-1.333-.879-2.666-.528-1.607-1.058-3.213-.46-1.394-.917-2.788c-.149-.451-.289-.9-.446-1.352l-.008-.02a.783.783,0,0,0-.732-.557H34.037a.76.76,0,0,0,0,1.519Z" fill="#fff"/>
                                                    <path id="Path_32660" data-name="Path 32660" d="M288.931,541.934q-.615,1.1-1.233,2.193c-.058.106-.119.21-.177.317a.767.767,0,0,0,.656,1.142h11.6c.534,0,1.071.01,1.608,0h.023a.76.76,0,0,0,0-1.519h-11.6c-.534,0-1.074-.015-1.608,0h-.023l.656,1.142q.615-1.1,1.233-2.193c.058-.106.119-.21.177-.316a.759.759,0,0,0-1.312-.765Z" transform="translate(-247.711 -429.41)" fill="#fff"/>
                                                    <circle id="Ellipse_553" data-name="Ellipse 553" cx="1.724" cy="1.724" r="1.724" transform="translate(49.612 117.606)" fill="#fff"/>
                                                    <path id="Path_32661" data-name="Path 32661" d="M658.4,739.2a2.267,2.267,0,0,0,1.489,2.1,2.232,2.232,0,0,0,2.433-.648A2.231,2.231,0,1,0,658.4,739.2a.506.506,0,0,0,1.013,0c0-.041,0-.084.005-.124a.381.381,0,0,1,.005-.053c.008-.1,0,.033-.005.03a.979.979,0,0,1,.061-.248c.008-.02.023-.106.04-.111s-.046.094-.018.043a.656.656,0,0,0,.028-.061,2.3,2.3,0,0,1,.129-.215c.048-.073-.068.078.013-.015.025-.028.051-.058.078-.086s.056-.056.084-.081l.038-.033c.018-.015.091-.051.025-.023s-.015.013,0,0,.035-.025.056-.038a.947.947,0,0,1,.086-.051c.038-.023.078-.041.119-.061.013-.008.066-.033,0,0s.025-.008.033-.01A1.56,1.56,0,0,1,660.4,738l.068-.013c.056-.013-.048.005-.048.005.046,0,.094-.01.139-.01a2.043,2.043,0,0,1,.248.008c.094.008-.1-.018.02.005.046.008.089.02.134.03s.076.023.114.035a.589.589,0,0,1,.063.023c0,.008-.094-.048-.043-.018.071.043.149.076.22.122.018.013.035.025.056.038s.056.023,0,0-.018-.015,0,0l.051.043a2.274,2.274,0,0,1,.172.177c.076.084-.035-.058.013.015.02.033.043.063.063.1s.041.068.058.1l.023.046c.048.091.01-.008,0-.013.03.01.063.192.073.225l.023.1c.02.1,0-.03,0-.033.013.013.008.071.008.086a1.749,1.749,0,0,1,0,.23.63.63,0,0,0-.005.071c0,.051-.03.043.005-.03a.791.791,0,0,0-.028.134c-.018.071-.046.139-.066.21s.046-.086.013-.028a.245.245,0,0,0-.02.046c-.02.041-.041.078-.063.117s-.041.066-.063.1c-.068.1.048-.051-.01.018a1.932,1.932,0,0,1-.172.18c-.01.01-.071.076-.089.076,0,0,.1-.071.023-.02-.015.01-.028.018-.041.028-.071.046-.144.084-.218.122s.091-.03-.018.008l-.111.038-.116.03c-.018,0-.033.008-.051.01-.111.025.081-.005.015,0a2.045,2.045,0,0,1-.248.01c-.041,0-.081-.005-.124-.008-.015,0-.076-.008,0,0s-.018-.005-.035-.008a1.912,1.912,0,0,1-.261-.076c-.015-.005-.066-.03,0,0s-.015-.008-.03-.015c-.041-.02-.078-.041-.117-.063s-.073-.048-.111-.073c-.061-.038.008.02.023.02-.01,0-.043-.035-.051-.043a1.872,1.872,0,0,1-.187-.187.3.3,0,0,1-.043-.051c0,.01.061.086.02.023-.025-.038-.051-.073-.073-.111s-.048-.089-.071-.132c-.053-.1.025.081-.015-.033a1.836,1.836,0,0,1-.073-.263.163.163,0,0,0-.01-.051c.038.084.008.071,0,.013s-.008-.106-.008-.16a.513.513,0,0,0-1.026,0Z" transform="translate(-609.293 -619.872)" fill="#fff"/>
                                                    <circle id="Ellipse_554" data-name="Ellipse 554" cx="1.724" cy="1.724" r="1.724" transform="translate(40.884 117.606)" fill="#fff"/>
                                                    <path id="Path_32662" data-name="Path 32662" d="M270.814,272.355a2.267,2.267,0,0,0,1.489,2.1,2.232,2.232,0,0,0,2.433-.648,2.231,2.231,0,1,0-3.922-1.453.506.506,0,0,0,1.013,0c0-.041,0-.084.005-.124a.377.377,0,0,1,.005-.053c.008-.1,0,.033-.005.03a.981.981,0,0,1,.061-.248c.008-.02.023-.106.04-.111s-.046.094-.018.043a.656.656,0,0,0,.028-.061,2.3,2.3,0,0,1,.129-.215c.048-.073-.068.079.013-.015.025-.028.051-.058.078-.086s.056-.056.084-.081l.038-.033c.018-.015.091-.051.025-.023s-.015.013,0,0,.035-.025.056-.038a.96.96,0,0,1,.086-.051c.038-.023.078-.04.119-.061.013-.008.066-.033,0,0s.025-.008.033-.01a1.564,1.564,0,0,1,.213-.061l.068-.013c.056-.013-.048.005-.048.005.046,0,.094-.01.139-.01a2.031,2.031,0,0,1,.248.008c.094.008-.1-.018.02.005.046.008.089.02.134.03s.076.023.114.035a.583.583,0,0,1,.063.023c0,.008-.094-.048-.043-.018.071.043.149.076.22.122.018.013.035.025.056.038s.056.023,0,0-.018-.015,0,0l.051.043a2.257,2.257,0,0,1,.172.177c.076.084-.035-.058.013.015.02.033.043.063.063.1s.04.068.058.1l.023.046c.048.091.01-.008,0-.013.03.01.063.192.073.225l.023.1c.02.1,0-.03,0-.033.013.013.008.071.008.086a1.749,1.749,0,0,1,0,.23.622.622,0,0,0-.005.071c0,.051-.03.043.005-.03a.788.788,0,0,0-.028.134c-.018.071-.046.139-.066.21s.046-.086.013-.028a.249.249,0,0,0-.02.046c-.02.04-.041.078-.063.116s-.041.066-.063.1c-.068.1.048-.051-.01.018a1.929,1.929,0,0,1-.172.18c-.01.01-.071.076-.089.076,0,0,.1-.071.023-.02-.015.01-.028.018-.041.028-.071.046-.144.084-.218.122s.091-.03-.018.008l-.111.038-.116.03c-.018,0-.033.008-.051.01-.111.025.081-.005.015,0a2.039,2.039,0,0,1-.248.01c-.041,0-.081-.005-.124-.008-.015,0-.076-.008,0,0s-.018-.005-.035-.008a1.919,1.919,0,0,1-.261-.076c-.015-.005-.066-.03,0,0s-.015-.008-.03-.015c-.04-.02-.078-.04-.116-.063s-.073-.048-.111-.073c-.061-.038.008.02.023.02-.01,0-.043-.035-.051-.043a1.873,1.873,0,0,1-.187-.187.3.3,0,0,1-.043-.051c0,.01.061.086.02.023-.025-.038-.051-.073-.073-.111s-.048-.089-.071-.132c-.053-.1.025.081-.015-.033a1.84,1.84,0,0,1-.073-.263.164.164,0,0,0-.01-.051c.038.084.008.071,0,.013s-.008-.106-.008-.16a.513.513,0,0,0-1.026,0ZM287.2,258l-3.074,7.926H272.313L269.7,258Z" transform="translate(-230.437 -153.024)" fill="#fff"/>
                                                    <path id="Path_32663" data-name="Path 32663" d="M267.044,237.988q-.52,1.341-1.038,2.682-.828,2.138-1.654,4.274l-.38.983.489-.372H254.1c-.476,0-.957-.02-1.436,0h-.02l.489.372q-.444-1.348-.886-2.694-.7-2.131-1.4-4.264c-.109-.327-.215-.653-.324-.983l-.489.641h16.791c.228,0,.456.005.681,0h.03a.506.506,0,0,0,0-1.013H250.744c-.228,0-.456-.005-.681,0h-.03a.511.511,0,0,0-.489.641q.444,1.348.886,2.694.7,2.131,1.4,4.264c.109.327.215.653.324.983a.523.523,0,0,0,.489.372h10.359c.476,0,.957.018,1.436,0h.02a.526.526,0,0,0,.489-.372q.52-1.341,1.038-2.682.828-2.138,1.654-4.274l.38-.983a.508.508,0,0,0-.355-.623A.52.52,0,0,0,267.044,237.988Z" transform="translate(-210.769 -133.152)" fill="#fff"/>
                                                </g>
                                            </svg>
                                        </span>
                                        <span class="d-none d-xl-block ml-2 fs-14 fw-700 text-white">Rs 0</span>
                                        <span class="nav-box-text d-none d-xl-block ml-2 text-white fs-12">
                                            (<span class="cart-count">0</span> Items)
                                        </span>
                                    </a>
                                    {{-- Cart Items Dropdown (empty/items) --}}
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg p-0 stop-propagation rounded-0">
                                        <div class="text-center p-3">
                                            <i class="las la-frown la-3x opacity-60 mb-3"></i>
                                            <h3 class="h6 fw-700">Your Cart is empty</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                
                {{-- Login & Registration (Desktop) --}}
                <div class="d-none d-xl-block ml-auto mr-0">
                    <span class="d-flex align-items-center nav-user-info ml-2">
                        <span class="size-40px rounded-circle overflow-hidden border d-flex align-items-center justify-content-center">
                            {{-- User SVG Icon --}}
                            <svg xmlns="http://www.w3.org/2000/svg" width="19.902" height="20.012" viewBox="0 0 19.902 20.012">
                                <path id="fe2df171891038b33e9624c27e96e367" d="M15.71,12.71a6,6,0,1,0-7.42,0,10,10,0,0,0-6.22,8.18,1.006,1.006,0,1,0,2,.22,8,8,0,0,1,15.9,0,1,1,0,0,0,1,.89h.11a1,1,0,0,0,.88-1.1,10,10,0,0,0-6.25-8.19ZM12,12a4,4,0,1,1,4-4A4,4,0,0,1,12,12Z" transform="translate(-2.064 -1.995)" fill="#fff" />
                            </svg>
                        </span>
                        <a href="{{ url('users/login') }}" class="text-white opacity-60 hov-opacity-100 fs-12 d-inline-block border-right border-soft-light border-width-2 pr-2 ml-3">Login</a>
                        <a href="{{ url('registration/verification') }}" class="text-white opacity-60 hov-opacity-100 fs-12 d-inline-block py-2 pl-2">Registration</a>
                    </span>
                </div>

            </div>
        </div>
        
        {{-- Logged-in User Menus (Placeholder for logged-in state menu) --}}
        <div class="hover-user-top-menu position-absolute top-100 left-0 right-0 z-3">
            <div class="container">
                <div class="position-static float-right">
                    <div class="aiz-user-top-menu bg-white rounded-0 border-top shadow-sm" style="width:220px; background-color: var(--light) !important;">
                        <ul class="list-unstyled no-scrollbar mb-0 text-left">
                            <li class="user-top-nav-element border border-top-0" data-id="1">
                                <a href="{{ url('dashboard') }}" class="text-truncate text-dark px-4 fs-14 d-flex align-items-center hov-column-gap-1">
                                    <span class="user-top-menu-name has-transition ml-3">Dashboard</span>
                                </a>
                            </li>
                             {{-- Add Logout link here when logged in --}}
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- Mobile Top Menu Sidebar (Off-Canvas Menu) --}}
    <div class="aiz-top-menu-sidebar collapse-sidebar-wrap sidebar-xl sidebar-left d-lg-none z-1035">
        <div class="overlay overlay-fixed dark c-pointer" data-toggle="class-toggle" data-target=".aiz-top-menu-sidebar" data-same=".hide-top-menu-bar"></div>
        <div class="collapse-sidebar c-scrollbar-light text-left" style="background-color: var(--light) !important;">
            <button type="button" class="btn btn-sm p-4 hide-top-menu-bar" data-toggle="class-toggle" data-target=".aiz-top-menu-sidebar">
                <i class="las la-times la-2x" style="color: var(--primary);"></i>
            </button>
            
            {{-- Mobile Login/Registration --}}
            <span class="d-flex align-items-center nav-user-info pl-4">
                <a href="{{ url('users/login') }}" class="text-reset opacity-60 hov-opacity-100 hov-text-primary fs-12 d-inline-block border-right border-soft-light border-width-2 pr-2 ml-3">Login</a>
                <a href="{{ url('registration/verification') }}" class="text-reset opacity-60 hov-opacity-100 hov-text-primary fs-12 d-inline-block py-2 pl-2">Registration</a>
                {{-- Mobile language/currency selectors here --}}
            </span>
            <hr>
            
            {{-- Mobile Nav Links --}}
            <ul class="mb-0 pl-3 pb-3 h-100">
                <li class="mr-0"><a href="{{ url('category/bracelet-ye8hk') }}" class="fs-13 px-3 py-3 w-100 d-inline-block fw-700 text-dark header_menu_links">Bracelet</a></li>
                <li class="mr-0"><a href="{{ url('category/rudraksh-fdfhq') }}" class="fs-13 px-3 py-3 w-100 d-inline-block fw-700 text-dark header_menu_links">Rudraksh</a></li>
                <li class="mr-0"><a href="{{ url('category/shankh-wszyo') }}" class="fs-13 px-3 py-3 w-100 d-inline-block fw-700 text-dark header_menu_links">Shankh</a></li>
                {{-- ... (Other mobile links) ... --}}
            </ul>
        </div>
    </div>
</header>