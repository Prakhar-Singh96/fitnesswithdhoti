@extends('frontend.layouts.app')

{{-- ⚡ 1. डायनेमिक पेज मेटा टाइटल --}}
@section('title', $pageData->page_title)
@section('styles')
    <style>
        :root {
            --calc-brown: #7b3f27;
            --calc-light: #fdfaf4;
        }

        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('{{ asset('assets/img/rudraksha-bg.jpg') }}');
            background-size: cover;
            background-position: center;
            min-height: 500px;
            display: flex;
            align-items: center;
            color: white;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            padding: 30px;
        }

        .btn-toggle {
            background: #fff;
            color: #000;
            border: none;
            padding: 10px 25px;
            border-radius: 30px;
            font-weight: bold;
            transition: 0.3s;
        }

        .btn-toggle.active {
            background: var(--calc-brown);
            color: #fff;
        }

        .form-control,
        .form-select {
            border-radius: 10px;
            height: 50px;
            border: 1px solid #ddd;
        }

        .btn-calculate {
            background: var(--calc-brown);
            color: white;
            border-radius: 10px;
            padding: 15px;
            font-weight: 800;
            text-transform: uppercase;
            width: 100%;
            border: none;
        }

        .info-section {
            background-color: var(--calc-light);
        }

        .brown-section {
            background-color: var(--calc-brown);
            color: white;
        }

        .feature-card img {
            width: 80px;
            margin-bottom: 15px;
        }

        .product-suggest-card {
            border: 1px solid #eee;
            border-radius: 15px;
            background: white;
            transition: 0.3s;
            height: 100%;
        }

        .product-suggest-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        /* 🎨 PREMIUM MINI CALCULATOR SLIDER STYLING */
        .calculator-product-slick-wrap {
            margin: 0 -10px; /* साइड गैप बैलेंस करने के लिए */
        }

        /* स्लिक का सिंगल कार्ड रैपर */
        .slider-card-slide {
            padding: 10px;
            height: auto;
        }

        /* 🎯 छोटा और फिक्स्ड साइज कार्ड (Small Size Layout) */
        .calc-product-mini-card {
            background: #ffffff;
            border: 1px solid #f0e6d6;
            border-radius: 12px;
            padding: 16px;
            text-align: center;
            height: 380px; /* फिक्स्ड हाइट ताकि सारे कार्ड्स एक बराबर दिखें */
            display: flex !important;
            flex-direction: column;
            justify-content: space-between;
            transition: all 0.3s ease;
        }

        .calc-product-mini-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(123, 63, 39, 0.1) !important;
            border-color: var(--calc-brown);
        }

        /* इमेज होल्डर */
        .card-img-holder {
            height: 130px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 12px;
        }

        .mini-prod-img {
            max-height: 100%;
            max-width: 100%;
            object-fit: contain;
            margin: 0 auto;
        }

        /* टाइटल छोटा किया */
        .mini-prod-title {
            font-size: 14px !important;
            font-weight: 700;
            color: #333;
            line-height: 1.4;
            margin-bottom: 8px;
            height: 40px; /* 2 लाइनों के लिए स्पेस लॉक */
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }

        /* एस्ट्रो बेनिफिट्स लिस्ट */
        .mini-benefits-list {
            text-align: left;
            font-size: 11px;
            color: #666;
            padding-left: 15px;
            margin-bottom: 15px;
            height: 60px; /* साइज कंट्रोल */
            overflow: hidden;
        }

        .mini-benefits-list li {
            margin-bottom: 2px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis; /* लंबी लाइन होने पर डॉट-डॉट आ जाएगा */
        }

        /* छोटा व्यू बटन */
        .btn-mini-view {
            background-color: var(--calc-brown);
            color: white !important;
            border: none;
            border-radius: 6px;
            padding: 8px 15px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            text-decoration: none;
            width: 100%;
            transition: background 0.2s;
        }

        .btn-mini-view:hover {
            background-color: #5d2f1c;
        }

        /* 🎮 कस्टमाइज्ड लेफ्ट-राइट एरो बटन्स स्टाइल */
        .slider-nav-btn {
            position: absolute;
            top: 55%;
            transform: translateY(-50%);
            width: 40px;
            height: 40px;
            background-color: #fff;
            border: 1px solid #7b3f27;
            color: #7b3f27;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            cursor: pointer;
            z-index: 10;
            transition: all 0.2s;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }

        .slider-nav-btn:hover {
            background-color: #7b3f27;
            color: #fff;
        }

        .prev-btn { left: 0px; }
        .next-btn { right: 0px; }

        /* मोबाइल पर एरो बटन्स को हाइड करके डॉट्स को सेन्टर रखेंगे */
        @media (max-width: 767px) {
            .slider-nav-btn { display: none !important; }
            .calc-product-mini-card { height: 360px; }
        }
    </style>
@endsection

@section('content')



    {{-- ⚡ 2. डायनेमिक हीरो बैनर बैकग्राउंड और टाइटल्स --}}
    <section class="hero-section py-5"
        style="background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('{{ asset($pageData->hero_banner) }}'); background-size: cover; background-position: center; min-height: 500px; display: flex; align-items: center; color: white;">
        <div class="container">
            <div class="text-center mb-5">
                <h1 class="display-5 fw-bold font-heading">{{ $pageData->hero_title }}</h1>
                <p class="lead">{{ $pageData->hero_short_desc }}</p>
            </div>

            {{-- कैलकुलेटर का फॉर्म कोड (Same रहेगा) --}}
            <div class="mx-auto" style="max-width: 850px;">
                <div class="text-center mb-4">
                    <div class="d-inline-flex bg-white rounded-pill p-1 shadow-sm">
                        <button class="btn-toggle active" id="btn-birth" onclick="switchTab('birth')">By Birth</button>
                        <button class="btn-toggle" id="btn-purpose" onclick="switchTab('purpose')">By Purpose</button>
                    </div>
                </div>

                <div class="glass-card shadow-lg">
                    <form id="rudrakshaForm">
                        @csrf
                        <input type="hidden" name="method" id="calc_method" value="birth">

                        {{-- 📍 1. सुधार: कोआर्डिनेट्स के लिए हिडन इनपुट्स --}}
                        <input type="hidden" name="lat" id="lat">
                        <input type="hidden" name="lng" id="lng">

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="small fw-bold mb-1">Full Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Enter your name"
                                    required>
                            </div>

                            {{-- 🎯 Purpose Dropdown (Visible only in Purpose Mode) --}}
                            <div class="col-md-6" id="purpose_div" style="display:none;">
                                <label class="small fw-bold mb-1">Your Main Goal</label>
                                <select name="purpose" class="form-select">
                                    <option value="">Select Purpose</option>
                                    <option value="Business">Business & Career Growth</option>
                                    <option value="Wealth">Wealth & Prosperity</option>
                                    <option value="Health">Health & Protection</option>
                                    <option value="Education">Concentration & Education</option>
                                    <option value="Love">Love & Marriage</option>
                                </select>
                            </div>

                            {{-- 📅 Birth Details (Needed for both modes in your refined logic) --}}
                            <div class="col-md-6">
                                <label class="small fw-bold mb-1">Date of Birth</label>
                                <input type="date" name="dob" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="small fw-bold mb-1">Time of Birth</label>
                                <input type="time" name="tob" class="form-control" required>
                            </div>
                            <div class="col-md-12 position-relative">
                                <label class="small fw-bold mb-1">Place of Birth</label>
                                <input type="text" name="place" id="place_search" class="form-control"
                                    placeholder="Start typing your city..." autocomplete="off" required>
                                <div id="location_status" class="small mt-1"></div>
                            </div>

                            <div class="col-12 mt-4">
                                <button type="submit" class="btn-calculate" id="submitBtn">Know your Rudraksha</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    {{-- 🛑 3. रिजल्ट बॉक्स (सिर्फ कैलकुलेशन के बाद दिखेगा) --}}
    <div id="calculator-result" class="container py-5" style="display:none;"></div>

    <section class="about-section py-5"
        style="background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('{{ asset($pageData->about_banner) }}'); background-size: cover; background-position: center; min-height: 500px; display: flex; align-items: center; color: white;">
        <div class="container">
            <div class="col-md-6 ps-lg-5">
                <h2 class="fw-bold mb-4 font-heading text-white">{{ $pageData->about_title }}</h2>

                {{-- 🚀 FIX: class को text-white-50 किया ताकि डार्क बैकग्राउंड पर सुंदर और साफ़ दिखे --}}
                {{-- 🚀 FIX: {!! !!} का यूज़ किया ताकि CKEditor के पैराग्राफ (<p>) टैग्स सही से रेंडर हों --}}
                <div class="text-white-50">
                    {!! $pageData->about_desc !!}
                </div>
            </div>
        </div>
    </section>

    {{-- ⚡ 5. What is & How to Use (100% डायनेमिक डेटाबेस से) --}}
    <section class="py-5 info-section" style="background-color: #fdfaf4; text-align:center">
        <div class="container">
                <h3 class="fw-bold mb-3 font-heading">{{ $pageData->what_is_calculator_title }}</h3>
                <div class="text-muted">{!! $pageData->what_is_calculator_desc !!}</div>
        </div>
    </section>

    {{-- 🎁 4. मुख्य कैटेगरी के सारे प्रोडक्ट्स (PREMIUM 4-COLUMN CAROUSEL SLIDER) --}}
    @if ($categoryProducts->count() > 0)
        <section class="py-5 bg-white overflow-hidden">
            <div class="container position-relative px-md-5"> {{-- साइड्स में स्पेस दिया ताकि बटन सुंदर दिखें --}}

                {{-- 📝 डायनामिक सेक्शन टाइटल --}}
                <h2 class="text-center fw-bold mb-5 font-heading text-dark">{{ $pageData->product_recommendation_title }}</h2>

                {{-- 🚀 स्लिक कैरोसेल मुख्य कंटेनर (ग्रिड हटा दिया है ताकि JS परफेक्ट चले) --}}
                <div id="calculatorProductsSlider" class="calculator-product-slick-wrap">
                    @foreach ($categoryProducts as $prod)
                        <div class="slider-card-slide">
                            <div class="calc-product-mini-card shadow-sm">
                                <div class="card-img-holder">
                                    <img src="{{ asset($prod->product_main_image) }}" alt="{{ $prod->name }}" class="mini-prod-img">
                                </div>
                                <div class="card-info-holder">
                                    <h4 class="mini-prod-title">{{ $prod->name }}</h4>
                                    <ul class="mini-benefits-list">
                                        @foreach (array_slice(explode(',', $prod->astro_benefits), 0, 3) as $benefit) {{-- मैक्सिमम 3 मुख्य लाभ ही दिखाएंगे --}}
                                            <li>{{ trim($benefit) }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                <a href="{{ url('product/' . $prod->slug) }}" class="btn-mini-view mt-auto">View Product</a>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- 🎮 कस्टम लेफ्ट-राइट नेविगेशन बटन्स (मक्खन जैसी यूआई) --}}
                <button class="slider-nav-btn prev-btn" id="calc-slider-prev" aria-label="Previous">
                    <i class="las la-angle-left"></i>
                </button>
                <button class="slider-nav-btn next-btn" id="calc-slider-next" aria-label="Next">
                    <i class="las la-angle-right"></i>
                </button>

            </div>
        </section>
    @endif

    {{-- ⚡ 5. What is & How to Use (100% डायनेमिक डेटाबेस से) --}}
    <section class="py-5 info-section" style="background-color: #fdfaf4; text-align:center">
        <div class="container">
            <h3 class="fw-bold mb-3 font-heading">{{ $pageData->how_to_use_title }}</h3>
            <div class="text-muted">{!! $pageData->how_to_use_desc !!}</div>
        </div>
    </section>

    {{-- ⚡ 6. Detailed About Section (100% डायनेमिक डेटाबेस से) --}}
    {{-- <section class="py-5 bg-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 mb-4 mb-md-0">
                    <img src="{{ asset($pageData->about_banner) }}" class="img-fluid rounded shadow">
                </div>
                <div class="col-md-6 ps-lg-5">
                    <h2 class="fw-bold mb-4 font-heading">{{ $pageData->about_title }}</h2>
                    <div class="text-muted">{!! $pageData->about_desc !!}</div>
                </div>
            </div>
        </div>
    </section> --}}

    {{-- ⚡ 7. Spiritual Significance & Benefits (100% डायनेमिक डेटाबेस से) --}}
    {{-- <section class="py-5 info-section" style="background-color: #fdfaf4;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 pe-lg-5">
                    <h2 class="fw-bold mb-4 font-heading">{{ $pageData->spiritual_title }}</h2>
                    <div class="text-muted">{!! $pageData->spiritual_desc !!}</div>
                    <h3 class="fw-bold mt-4 mb-3 font-heading">{{ $pageData->benefits_title }}</h3>
                    <div class="text-muted">{!! $pageData->benefits_desc !!}</div>
                </div>
                <div class="col-md-6 mt-4 mt-md-0">
                    <img src="{{ asset($pageData->spiritual_image) }}" class="img-fluid rounded shadow">
                </div>
            </div>
        </div>
    </section> --}}

    <section class="info-section py-5" style="background-color: #7b3f27; color: white;">
        <div class="container">
            <div class="row align-items-top">
                <div class="col-md-7 pe-lg-5">
                    <h2 class="fw-bold mb-4 font-heading text-white">{{ $pageData->spiritual_title }}</h2>
                    <div class="text-white-50">{!! $pageData->spiritual_desc !!}</div>
                </div>
                <div class="col-md-5 mt-4 mt-md-0">
                    <img src="{{ asset($pageData->spiritual_image) }}" class="img-fluid rounded shadow">
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 info-section" style="background-color: #fdfaf4; text-align:center">
        <div class="container">
            <h3 class="fw-bold mb-3 font-heading">{{ $pageData->benefits_title }}</h3>
            <div class="text-muted">{!! $pageData->benefits_desc !!}</div>
        </div>
    </section>

    {{-- ⚡ 8. How to Wear Section & Conclusion (100% डायनेमिक डेटाबेस से) --}}
    <section class="brown-section py-5" style="background-color: #7b3f27; color: white;">
        <div class="container">
            <div class="row align-items-top">
                <div class="col-md-7 pe-lg-5">
                    <h2 class="fw-bold mb-4 font-heading text-white">{{ $pageData->how_to_wear_title }}</h2>
                    <div class="text-white-50">{!! $pageData->how_to_wear_desc !!}</div>
                </div>
                <div class="col-md-5 mt-4 mt-md-0">
                    <img src="{{ asset($pageData->how_to_wear_image) }}" class="img-fluid rounded shadow">
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 info-section" style="background-color: #fdfaf4; text-align:center">
        <div class="container">
            <h3 class="fw-bold mb-3 font-heading">Conclusion</h3>
            <div class="text-muted">{!! $pageData->conclusion !!}</div>
        </div>
    </section>

    {{-- <div class="mt-4 border-top pt-3 text-white-50">{!! $pageData->conclusion !!}</div> --}}

    {{-- ⚡ 9. FAQs Section Repeater Loop (100% डायनेमिक डेटाबेस से) --}}
    @if (!empty($pageData->faqs))
        <section class="py-5 bg-white">
            <div class="container">
                <h2 class="text-center fw-bold mb-5">Frequently Asked Questions</h2>
                <div class="accordion accordion-flush mx-auto" id="faqCalc" style="max-width: 800px;">
                    @foreach ($pageData->faqs as $index => $faq)
                        <div class="accordion-item border mb-3 rounded overflow-hidden">
                            <h2 class="accordion-header">
                                <button class="accordion-button fw-bold {{ $index > 0 ? 'collapsed' : '' }}"
                                    data-bs-toggle="collapse" data-bs-target="#q-{{ $index }}">
                                    {{ $faq['question'] }}
                                </button>
                            </h2>
                            <div id="q-{{ $index }}"
                                class="accordion-collapse collapse {{ $index == 0 ? 'show' : '' }}"
                                data-bs-parent="#faqCalc">
                                <div class="accordion-body text-muted">
                                    {{ $faq['answer'] }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

@endsection

@section('scripts')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

    <script>
        function switchTab(mode) {
            $('.btn-toggle').removeClass('active');
            $('#btn-' + mode).addClass('active');
            $('#calc_method').val(mode);
            if (mode === 'purpose') {
                $('#purpose_div').fadeIn();
            } else {
                $('#purpose_div').hide();
            }
        }

        $(document).ready(function() {
            // 📍 Nominatim Autocomplete Logic
            $("#place_search").autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: "https://nominatim.openstreetmap.org/search",
                        dataType: "json",
                        data: {
                            q: request.term,
                            format: "json",
                            addressdetails: 1,
                            limit: 5
                        },
                        success: function(data) {
                            response($.map(data, function(item) {
                                return {
                                    label: item.display_name,
                                    value: item.display_name,
                                    lat: item.lat,
                                    lon: item.lon
                                };
                            }));
                        }
                    });
                },
                minLength: 3, // 3 अक्षर टाइप करने पर सजेशन आएंगे
                select: function(event, ui) {
                    // जब यूजर लिस्ट से सेलेक्ट करे
                    $('#lat').val(ui.item.lat);
                    $('#lng').val(ui.item.lon);
                    $('#place_search').css('border-color', '#28a745');
                    $('#location_status').html(
                        '<span class="text-success"><i class="las la-check"></i> Location Selected</span>'
                    );
                }
            });
        });

        // 🚀 MASTER SLIDER INITIALIZATION (PERFECT 4-COLUMN CAROUSEL WITH CUSTOM ARROWS)
        if (typeof $ !== 'undefined' && $.fn.slick) {

            // पहले अगर कोई पुराना इंस्टेंस फंसा हो तो उसे डिस्ट्रॉय कर दो सुरक्षा के लिए
            if ($('#calculatorProductsSlider').hasClass('slick-initialized')) {
                $('#calculatorProductsSlider').slick('unslick');
            }

            $('#calculatorProductsSlider').slick({
                slidesToShow: 4,          // 💻 डेस्कटॉप/लैपटॉप पर एक बार में पूरे 4 प्रोडक्ट्स दिखेंगे!
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 3500,
                infinite: true,
                dots: false,               // नीचे नेविगेशन डॉट्स भी रहेंगे
                arrows: true,             // एरो चालू करो
                prevArrow: $('#calc-slider-prev'), // 👈 हमारे बनाए हुए कस्टम लेफ्ट बटन को यहाँ लिंक करो
                nextArrow: $('#calc-slider-next'), // 👈 हमारे बनाए हुए कस्टम राइट बटन को यहाँ लिंक करो
                responsive: [
                    {
                        breakpoint: 1200, // मीडियम स्क्रीन्स / टैबलेट्स के लिए 3 प्रोडक्ट्स
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 991,  // छोटे टैबलेट्स के लिए 2 प्रोडक्ट्स
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 575,  // 📱 प्योर मोबाइल पर एकदम सटीक 1 छोटा प्रोडक्ट दिखेगा
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            arrows: false // मोबाइल पर सिर्फ स्वाइप और डॉट्स चलेंगे
                        }
                    }
                ]
            });
        }

        // Form Submission
        $('#rudrakshaForm').on('submit', async function(e) {
            e.preventDefault();

            const lat = $('#lat').val();
            const lng = $('#lng').val();

            if (!lat || !lng) {
                alert("Please select a city from the dropdown suggestions.");
                return;
            }

            const btn = $('#submitBtn');
            btn.prop('disabled', true).text('Grahon ki ganana ho rahi hai...');

            $.ajax({
                url: "{{ route('rudraksha.recommendation') }}",
                type: "POST",
                data: $(this).serialize(),
                success: function(res) {
                    if (res.status) {
                        $('#calculator-result').html(res.html).fadeIn();
                        btn.prop('disabled', false).text('Know your Rudraksha');
                        $('html, body').animate({
                            scrollTop: $("#calculator-result").offset().top - 100
                        }, 800);
                    }
                },
                error: function(xhr) {
                    alert('Calculation failed. Please try again.');
                    btn.prop('disabled', false).text('Know your Rudraksha');
                }
            });
        });
    </script>

    <style>
        /* Dropdown लिस्ट को सुंदर बनाने के लिए */
        .ui-autocomplete {
            z-index: 9999 !important;
            border-radius: 10px;
            padding: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border: none;
            max-width: 400px;
        }

        .ui-menu-item {
            padding: 8px;
            border-bottom: 1px solid #f4f4f4;
        }

        .ui-state-active {
            background: var(--calc-brown) !important;
            border: none !important;
            color: white !important;
        }
    </style>
@endsection
