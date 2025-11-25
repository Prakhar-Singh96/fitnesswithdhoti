@extends('frontend.layouts.app')

@section('title', 'Suyagya | Authentic Rudraksh & Gemstones')

@section('content')

    {{-- ⭐️ Hero Banner (High Impact Single Banner) --}}
    <section>
        {{-- ... (Your updated Hero Banner HTML from previous step) ... --}}
    </section>

    {{-- 💎 Featured Categories (Keep original logic, it will use new CSS) --}}
    <div class="home-banner-area mb-3">
        <div class="container">
            {{-- ... (Your existing Featured Categories HTML) ... --}}
        </div>
    </div>
    
    {{-- 🛒 Best Selling Products (Use new clean structure) --}}
    <section class="mb-4 mt-5">
        <div class="container">
            <div class="text-center mb-4">
                <h2 class="fw-700 fs-28" style="color: var(--primary);">
                    Explore Our Bestsellers
                </h2>
                <p class="text-muted fs-16">Authentic products trusted by over 50,000 customers.</p>
            </div>
            
            <div class="p-3 rounded-2 border" style="background-color: var(--white);">
                {{-- ... (Your existing Best Selling Products Carousel HTML) ... --}}
            </div>
            <div class="text-center mt-4">                                               
                <a class="fs-14 fw-700 text-reset" href="https://suyagya.com/category/Best-Selling-dbeYI" 
                   style="color: var(--primary) !important; border-bottom: 2px solid var(--secondary-base);">
                   View All Products &gt;
                </a>                                           
            </div>
        </div>
    </section>
    
    {{-- 🎥 Product Videos Section --}}
    <section class="mb-4 mt-4" style="background-color: var(--soft-light);">
         {{-- ... (Your existing Product Videos HTML) ... --}}
    </section>
    
    {{-- 🛡️ Lab Certification Section --}}
    <section class="lab-certification-section">
         {{-- ... (Your existing Lab Certified HTML) ... --}}
    </section>
    
    {{-- 🌟 Shop By Purpose/Stones Sections --}}
    {{-- ... (Your existing Shop By Purpose/Stones HTML) ... --}}

    {{-- 💬 Customer Reviews --}}
    <section>
         {{-- ... (Your existing Customer Reviews HTML) ... --}}
    </section>

    {{-- 💡 Our Facilities --}}
    <section class="pt-4 mb-4" style="background-color: var(--soft-light);">
         {{-- ... (Your existing Facilities HTML) ... --}}
    </section>

@endsection

@section('scripts')
    {{-- Load specific scripts for home page, like carousel initialization scripts if needed --}}
    {{-- ... (Your existing JS snippets for loading sections via AJAX) ... --}}
@endsection