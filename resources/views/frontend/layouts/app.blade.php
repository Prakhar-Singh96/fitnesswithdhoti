<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="is-logged-in" content="{{ Auth::check() ? '1' : '0' }}">
    <title>@yield('title', 'Suyagya | Authentic Spiritual Products')</title>

    {{-- Favicon, Meta Tags, etc. --}}
    {{-- ... (Keep existing meta tags from original HTML) ... --}}

    {{-- 🔗 CSS Files --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    {{-- Ensure Merriweather is loaded for premium look --}}
    <link
        href="https://fonts.googleapis.com/css2?family=Merriweather:ital,opsz,wght@0,18..144,300..900;1,18..144,300..900&display=swap"
        rel="stylesheet">

    {{-- 💡 BOOTSTRAP 5 CSS CDN (MANDATORY) --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/line-awesome/1.3.0/line-awesome/css/line-awesome.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.7.0/nouislider.min.css" />


    {{-- 💡 Premium Custom Styles --}}
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">

    @yield('styles')
</head>

{{-- 🎨 Body uses the creamy background set in custom.css --}}

<body>
    <div class="aiz-main-wrapper d-flex flex-column" style="background-color: var(--light) !important;">

        {{-- ⬆️ Header --}}
        @include('frontend.includes.header')

        {{-- 🏠 Page Content --}}
        <main class="flex-grow-1" style="
    background-color: #f7f1de;"> {{-- <<< KEY FIX: flex-grow-1 added to <main> --}}
            @yield('content')
        </main>

        {{-- 🛒 Include Side Cart --}}
        @include('frontend.includes.side_cart')

        {{-- Footer ke upar ya body tag band hone se pehle --}}
        @include('frontend.modals.checkout_modal')


        {{-- ⬇️ Footer --}}
        @include('frontend.includes.footer')

    </div>

    {{-- ⚙️ SCRIPTS --}}
    {{-- 1. jQuery (Must be first) --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    {{-- 2. Bootstrap Bundle --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    {{-- 3. Slick Slider (Depends on jQuery) --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

    {{-- 4. Page Specific Scripts --}}
    @yield('scripts')

    {{-- 5. Custom JS (Main Logic) --}}
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    
    <script>
init__megaMenu();

function init__megaMenu() {
    const mm = document.querySelector('aside#mega-menu--mobile');
    if (mm) {

        const mm_container      = mm.querySelector('.mega__container');
        const mm_screens        = mm.querySelectorAll('.mega__screen');
        const mm_subIcons       = mm.querySelectorAll('a.btn .btn__icon');
        const mm_subLinks       = mm.querySelectorAll('a.btn[aria-label]');
        const mm_subLinks_icon  = `<svg width="4" height="7" viewBox="0 0 4 7" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3.88255 3.2234C4.03915 3.37573 4.03915 3.62204 3.88255 3.77275L0.683882 6.88575C0.52728 7.03808 0.274052 7.03808 0.119117 6.88575C-0.0358184 6.73343 -0.0374844 6.48711 0.119117 6.3364L3.03457 3.50051L0.117451 0.662992C-0.0391504 0.510664 -0.0391504 0.264347 0.117451 0.113639C0.274052 -0.0370684 0.52728 -0.0386889 0.682216 0.113639L3.88255 3.2234Z" fill="#221F20"/></svg>`;

        let mm_active_depth = parseInt(mm_container.dataset.activeDepth);

        mm_screens[0].dataset.activeMenu = true;

        // Insert SVG Icon in each btn
        mm_subLinks.forEach(item => {
            const iconSpan = item.querySelector('.btn__icon');
            if (iconSpan) iconSpan.insertAdjacentHTML("afterbegin", mm_subLinks_icon);
        });

        // Handle all back buttons in slides
        const screenBackBtns = mm.querySelectorAll('.screen-back-btn');
        screenBackBtns.forEach(backBtn => {
            backBtn.addEventListener('click', (e) => {
                if (mm_active_depth > 1) sub__handleActiveDepth(mm_screens, e, mm_container);
            });
        });

        // Handle submenu icon click
        mm_subIcons.forEach(icon => {
            icon.addEventListener('click', (e) => sub__handleActiveDepth(mm_screens, e, mm_container));
        });

        // Handle entire a.btn click
        mm_subLinks.forEach(link => {
            link.addEventListener('click', (e) => sub__handleActiveDepth(mm_screens, e, mm_container));
        });

        // Main navigation handler
        function sub__handleActiveDepth(screens, event, container) {
            const target = event.currentTarget || event.target;

            // Back button clicked
            if (target.classList.contains('screen-back-btn') || target.id == "menu-back") {
                mm_active_depth -= 1;
                mm_container.dataset.activeDepth = mm_active_depth;

                mm_screens.forEach(screen => {
                    let dft_screen_depth = parseInt(screen.dataset.menuDepth);
                    screen.dataset.activeMenu = false;
                    dft_screen_depth >= mm_active_depth ? screen.classList.remove('stacked') : null;
                    dft_screen_depth == mm_active_depth ? screen.dataset.activeMenu = true : null;
                });

            } else {
                event.preventDefault();
                event.stopPropagation();

                // Forward navigation
                mm_active_depth += 1;
                mm_container.dataset.activeDepth = mm_active_depth;

                mm_screens.forEach(screen => {
                    let dft_screen_depth = parseInt(screen.dataset.menuDepth);
                    screen.dataset.activeMenu = false;
                    dft_screen_depth < mm_active_depth ? screen.classList.add('stacked') : null;
                    dft_screen_depth == mm_active_depth ? screen.dataset.activeMenu = true : null;
                });

                // Handle Sub Menus
                let link = target.closest('a.btn') || target;
                let link_menu = link.getAttribute('aria-label');
                container.dataset.activeNav = link_menu;

                let dft_active_screen = container.querySelector('.mega__screen[data-active-menu="true"]');
                let dft_active_screen__navs = dft_active_screen.querySelectorAll('nav');
                dft_active_screen__navs.forEach(nav => { nav.classList.add('hidden'); });

                let dft_active_nav = dft_active_screen.querySelector(`nav[aria-labelledby="${link_menu}"]`);
                if (dft_active_nav) dft_active_nav.classList.remove('hidden');
            }
        }
    }
}



</script>
<script>
const menuButton = document.getElementById('menuButton');
const megaMenu = document.getElementById('mega-menu--mobile');

menuButton.addEventListener('click', () => {
  megaMenu.classList.toggle('active'); // menu open/close
  menuButton.classList.toggle('active'); // toggle button icon
});
</script>
<script>
function initFooterAccordion() {
  const headings = document.querySelectorAll('h4.footer-heading');

  headings.forEach(heading => {
    heading.addEventListener('click', () => {

      // Only for mobile screens
      if (window.innerWidth > 767) return;

      const list = heading.nextElementSibling;

      if (!list || !list.classList.contains('footer-list')) return;

      // Toggle active class
      heading.classList.toggle('active');
      list.classList.toggle('active');
    });
  });
}

initFooterAccordion();
</script>
</body>

</html>
