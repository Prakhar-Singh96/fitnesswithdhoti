@extends('frontend.layouts.app')

@section('title', 'Our Latest Blogs & Insights | Fitness with Dhoti')

@section('styles')
<style>
    /* 🖼️ Main Banner Container */
    .blog-banner-container {
        width: 100%;
        position: relative;
        overflow: hidden;
        background-color: #000; /* Loading के समय काला दिखेगा */
    }

    /* 📱 Picture Tag & Image Styling */
    .blog-banner-picture {
        display: block;
        width: 100%;
    }

    .blog-banner-img {
        width: 100%;
        height: auto; /* Height auto रहेगी ताकि रेश्यो न बिगड़े */
        display: block;
        object-fit: cover; /* यह पक्का करेगा कि इमेज डब्बे में सही फिट हो */
    }

    /* 🖊️ Floating Text Overlay (If needed over image) */
    .banner-text-overlay {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 10;
        color: white;
        text-align: center;
        width: 100%;
        padding: 0 20px;
        /* अगर आपकी इमेज में टेक्स्ट पहले से है, तो इसे 'display: none' कर दें */
        display: block;
    }

    /* 💻 Responsive Adjustments */
    @media (min-width: 768px) {
        /* Desktop Ratio: 1920x400 */
        .blog-banner-img {
            max-height: 400px;
        }
    }

    @media (max-width: 767px) {
        /* Mobile Ratio: 483x273 */
        .blog-banner-img {
            max-height: 273px;
        }
        .banner-text-overlay h1 {
            font-size: 1.8rem !important;
            margin-bottom: 5px;
        }
        .banner-text-overlay p {
            font-size: 0.9rem;
        }
    }

    /* Blog Grid hover effects */
    .hover-lift { transition: transform 0.3s ease, box-shadow 0.3s ease; }
    .hover-lift:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
</style>
@endsection

@section('content')

{{-- 🚀 1. Banner Section: Uses Picture tag for specific images --}}
<section class="blog-banner-container">

    <picture class="blog-banner-picture">
        {{-- मोबाइल के लिए इमेज (483x273) - जब स्क्रीन 767px से छोटी हो --}}
        <source media="(max-width: 767px)" srcset="{{ asset('assets/img/blog-banner-mobile.png') }}">

        {{-- डेस्कटॉप के लिए इमेज (1920x400) - जब स्क्रीन बड़ी हो --}}
        <source media="(min-width: 768px)" srcset="{{ asset('assets/img/blog-banner.png') }}">

        {{-- Fallback image (Default): डेस्कटॉप वाली ही रखें --}}
        <img src="{{ asset('assets/img/blog-banner.png') }}"
             alt="Vedic Rituals, Gemstones & Rudraksha Wisdom"
             class="blog-banner-img">
    </picture>
</section>

{{-- 2. Blog Grid --}}
<section class="py-5" style="background-color: #ffff;">
    <div class="container">
        <div class="row g-4">
            @foreach($blogs as $blog)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm hover-lift">
                        {{-- Image --}}
                        <div class="overflow-hidden position-relative" style="height: 220px;">
                            <a href="{{ route('blogs.show', $blog->slug) }}">
                                <img src="{{ asset($blog->main_image) }}"
                                     alt="{{ $blog->img_alt ?? $blog->title }}"
                                     class="img-fluid w-100 h-100 object-fit-cover transition-zoom">
                            </a>
                        </div>

                        {{-- Content --}}
                        <div class="card-body p-4">
                            <div class="small text-muted mb-2">
                                <i class="las la-calendar"></i> {{ $blog->created_at->format('d M, Y') }}
                            </div>
                            <h5 class="card-title fw-bold font-heading">
                                <a href="{{ route('blogs.show', $blog->slug) }}" class="text-dark text-decoration-none">
                                    {{ Str::limit($blog->title, 55) }}
                                </a>
                            </h5>
                            <p class="card-text text-muted small">
                                {{-- HTML strip karke sirf text dikhayenge --}}
                                {{ Str::limit(strip_tags($blog->content), 100) }}
                            </p>
                        </div>

                        {{-- Footer Button --}}
                        <div class="card-footer bg-white border-0 p-4 pt-0">
                            <a href="{{ route('blogs.show', $blog->slug) }}" class="text-primary fw-bold text-decoration-none text-uppercase small">
                                Read More <i class="las la-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination Links --}}
        <div class="mt-5 d-flex justify-content-center">{{ $blogs->links('pagination::bootstrap-5') }}</div>
    </div>
</section>

<style>
    .hover-lift { transition: transform 0.3s ease, box-shadow 0.3s ease; }
    .hover-lift:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
    .transition-zoom { transition: transform 0.5s ease; }
    .card:hover .transition-zoom { transform: scale(1.05); }
</style>

@endsection
