<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Suyagya | Authentic Spiritual Products')</title>
    
    {{-- Favicon, Meta Tags, etc. --}}
    {{-- ... (Keep existing meta tags from original HTML) ... --}}

    {{-- 🔗 CSS Files --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    {{-- Ensure Merriweather is loaded for premium look --}}
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,opsz,wght@0,18..144,300..900;1,18..144,300..900&display=swap" rel="stylesheet">
    
    {{-- <link rel="stylesheet" href="https://suyagya.com/public/assets/css/vendors.css">
    <link rel="stylesheet" href="https://suyagya.com/public/assets/css/aiz-core.css?v=7617"> --}}

    {{-- 💡 BOOTSTRAP 5 CSS CDN (MANDATORY) --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/line-awesome/1.3.0/line-awesome/css/line-awesome.min.css">

    
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
        <main class="flex-grow-1">  {{-- <<< KEY FIX: flex-grow-1 added to <main> --}}
            @yield('content')
        </main>
        
        {{-- ⬇️ Footer --}}
        @include('frontend.includes.footer')

    </div>
    
    {{-- ⚙️ SCRIPTS --}}
    {{-- <script src="{{ asset('assets/js/vendors.js') }}"></script>
    <script src="{{ asset('assets/js/aiz-core.js') }}"></script> --}}

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>

    @yield('scripts')
</body>
</html>