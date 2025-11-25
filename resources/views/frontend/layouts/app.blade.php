<!DOCTYPE html>
<html lang="en">
<head>
    {{-- Original Meta Tags --}}
    <meta name="google-site-verification" content="ZU8dRZ4KsKSmGfLDvMQdXF0RwTy1bhlntgjx5eizGQg">
    <meta name="csrf-token" content="ZRLnKpe13V6DuKagNiY8vZGCJOQeA3MsyZhfAHTM">
    <meta name="app-url" content="//suyagya.com/">
    <meta name="file-base-url" content="//suyagya.com/public/">
    <title>@yield('title', 'Suyagya | Authentic Spiritual Products')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, follow">
    <meta name="description" content="Discover genuine Rudraksh, Amethyst, Rose Quartz, Pyrite &amp; Karungli Mala at Suyagya.com. Shop premium spiritual jewelry &amp; gemstones today!" />
    {{-- ... (Other Meta Tags) ... --}}

    {{-- Favicon - Uses original absolute URL --}}
    <link rel="icon" href="https://suyagya.com/public/uploads/all/ldwxbUQJHrGK2n9hHdZiWcKTtDdIOD2NRj4oMb0l.webp">
    
    {{-- Google Fonts - Merriweather for premium look --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,opsz,wght@0,18..144,300..900;1,18..144,300..900&display=swap" rel="stylesheet">
    
    {{-- 🔗 Existing CSS Files (Kept, but overridden by custom.css) --}}
    <link rel="stylesheet" href="https://suyagya.com/public/assets/css/vendors.css">
    <link rel="stylesheet" href="https://suyagya.com/public/assets/css/aiz-core.css">
    
    {{-- 💡 PREMIUM CUSTOM STYLES (Your Redesign Logic Here) --}}
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}"> 
    
    @yield('styles')

    {{-- Third-Party Scripts (Meta Pixel, Google Tag, etc.) --}}
    {{-- ... (Keep existing script tags before closing head) ... --}}
    <script> var AIZ = AIZ || {}; AIZ.data = { csrf: 'ZRLnKpe13V6DuKagNiY8vZGCJOQeA3MsyZhfAHTM' }; /* ... AIZ.local data */ </script>
</head>

<body id="font">
    <div class="aiz-main-wrapper d-flex flex-column bg-white" style="background-color: var(--light) !important;">
        
        {{-- ⬆️ Header --}}
        @include('frontend.includes.header')

        {{-- 🏠 Page Content --}}
        <main>
            @yield('content')
        </main>
        
        {{-- ⬇️ Footer --}}
        @include('frontend.includes.footer')

    </div>
    
    {{-- ⚙️ SCRIPTS (Use original URLs or asset() for custom files) --}}
    <script src="https://suyagya.com/public/assets/js/vendors.js"></script>
    <script src="https://suyagya.com/public/assets/js/aiz-core.js?v=1709"></script>
    {{-- 💡 Custom JavaScript --}}
    <script src="{{ asset('assets/js/custom.js') }}"></script>

    @yield('scripts')
    {{-- ... (Other modal/tracking scripts) ... --}}
    
    <script defer src="https://static.cloudflareinsights.com/beacon.min.js/vcd15cbe7772f49c399c6a5babf22c1241717689176015" ... crossorigin="anonymous"></script>
</body>
</html>