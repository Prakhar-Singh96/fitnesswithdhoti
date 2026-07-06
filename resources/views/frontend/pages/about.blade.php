@extends('frontend.layouts.app')

@section('content')

{{-- 1. HERO BANNER --}}
<div class="position-relative w-100">

    {{-- Dark Overlay for better text readability --}}
    <div class="position-absolute top-0 start-0 w-100 h-100"
         style="background: linear-gradient(to bottom, rgba(0,0,0,0.3), rgba(0,0,0,0.7)); z-index: 1;"></div>

    {{-- 💻 DESKTOP BANNER --}}
    <div class="d-none d-md-block">
        <img src="{{ asset('assets/img/aboutus.png') }}" alt="Vardhiyas About Banner" class="w-100 object-fit-cover" style="height: 600px; object-position: center top;">
    </div>

    {{-- 📱 MOBILE BANNER --}}
    <div class="d-block d-md-none">
        <img src="{{ asset('assets/img/about-mobile.png') }}" alt="Vardhiyas About Mobile" class="w-100 object-fit-cover" style="height: 450px; object-position: center;">
    </div>

    {{-- Text Content --}}
    <div class="position-absolute top-50 start-50 translate-middle text-center text-white w-100 px-3" style="z-index: 2;">

    </div>
</div>

{{-- 2. GOLD STRIP --}}
<div class="py-4 text-center text-white" style="background-color: #111111;">
    <div class="container">
        <h3 class="mb-1 fw-bold text-uppercase" style="letter-spacing: 2px; color: #c09867;">Vardhiyas: Crafting Confidence</h3>
        <p class="mb-0" style="font-size: 15px; opacity: 0.8;">A commitment to impeccable fits, premium fabrics, and timeless style.</p>
    </div>
</div>

{{-- 3. VISION & SHOP/STUDIO IMAGE --}}
<div class="container py-5 mt-3">
    <div class="row align-items-center g-5">
        <div class="col-lg-6">
            <h2 class="mb-4 fw-bold" style="color: #222; font-family: 'Merriweather', serif;">A Vision Woven in Threads</h2>
            <p class="text-muted" style="line-height: 1.8; font-size: 15px;">
                Vardhiyas is more than just a clothing brand; it is a celebration of modern masculinity. We operate under values that prioritize exceptional craftsmanship, innovative designs, and strict attention to detail above all else.
            </p>
            <p class="text-muted" style="line-height: 1.8; font-size: 15px;">
                Today, Vardhiyas stands as a testament to premium everyday wear. Our core remains rooted in providing high-quality essentials, from impeccably tailored shirts and relaxed joggers to durable denim and classic t-shirts.
            </p>
            <p class="text-muted fw-semibold" style="line-height: 1.8; font-size: 15px; color: #444 !important;">
                We are dedicated to building Vardhiyas into the most trusted name in men's fashion, ensuring every stitch speaks of elegance and longevity.
            </p>
        </div>
        <div class="col-lg-6">
            {{-- Replace with your Boutique/Studio/Fabric Image --}}
            <div class="position-relative p-2" style="border: 1px solid #eee; border-radius: 8px;">
                <img src="{{ asset('assets/img/shopImage.png') }}" alt="Vardhiyas Studio" class="img-fluid rounded shadow-sm w-100 grayscale-img">
            </div>
        </div>
    </div>
</div>

{{-- 4. TEAM IMAGE --}}
<div class="container py-4 mb-3">
    <div class="row">
        <div class="col-12">
            <div class="text-center mb-4">
                <h3 class="fw-bold" style="color: #222; font-family: 'Merriweather', serif;">The Team Behind The Seams</h3>
                <div class="mx-auto mt-2" style="width: 50px; height: 3px; background-color: #c09867;"></div>
            </div>
            {{-- Replace with Team Image --}}
            <img src="{{ asset('assets/img/teamImage.png') }}" alt="The Vardhiyas Team" class="img-fluid rounded shadow w-100">
        </div>
    </div>
</div>

{{-- 5. VISION & MISSION TEXT --}}
<div class="container py-5 text-center mb-4" style="max-width: 800px;">
    <div class="mb-5 p-4 rounded-3" style="background-color: #f9f9f9; border-top: 3px solid #c09867;">
        <h3 class="mb-3 fw-bold text-uppercase" style="color: #222; font-family: 'Merriweather', serif; font-size: 22px; letter-spacing: 1px;">Our Vision</h3>
        <p class="text-muted mb-0" style="line-height: 1.8; font-size: 15px;">
            We believe that clothing is more than just fabric; it is an expression of your identity and ambition.
            Our vision is to design premium, accessible, and stylish apparel that empowers modern men to step out with confidence in their everyday journeys.
        </p>
    </div>

    <div class="p-4 rounded-3" style="background-color: #f9f9f9; border-top: 3px solid #111;">
        <h3 class="mb-3 fw-bold text-uppercase" style="color: #222; font-family: 'Merriweather', serif; font-size: 22px; letter-spacing: 1px;">Our Mission</h3>
        <p class="text-muted mb-0" style="line-height: 1.8; font-size: 15px;">
            At the core of our mission is the desire to redefine wardrobe essentials. We want to shatter the myth that high-quality fashion has to be uncomfortable or overpriced.
            We believe every day is an opportunity to look your absolute best, and your wardrobe must effortlessly reflect that.
        </p>
    </div>
</div>

<style>
    .grayscale-img {
        filter: grayscale(100%);
        transition: filter 0.5s ease-in-out;
    }
    .grayscale-img:hover {
        filter: grayscale(0%);
    }
</style>

@endsection
