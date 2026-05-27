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

    {{-- 🎁 4. मुख्य कैटेगरी के सारे प्रोडक्ट्स (Type of Rudraksha / Gemstone Grid) --}}
    @if ($categoryProducts->count() > 0)
        <section class="py-5 bg-white">
            <div class="container text-center">
                {{-- 📝 डेटाबेस से आया डायनामिक सेक्शन टाइटल --}}
                <h2 class="fw-bold mb-4 font-heading">{{ $pageData->product_recommendation_title }}</h2>
                <div class="row g-4 justify-content-center">
                    @foreach ($categoryProducts as $prod)
                        <div class="col-md-4 col-sm-6">
                            <div
                                class="product-suggest-card p-4 shadow-sm text-center h-100 d-flex flex-column justify-content-between">
                                <div>
                                    <img src="{{ asset($prod->product_main_image) }}" alt="{{ $prod->name }}"
                                        class="img-fluid rounded mb-3" style="max-height: 180px; object-fit: contain;">
                                    <h4 class="fw-bold font-heading text-dark h5 mb-3">{{ $prod->name }}</h4>
                                    <ul class="text-start small text-muted ps-3 mb-4">
                                        @foreach (explode(',', $prod->astro_benefits) as $benefit)
                                            <li class="mb-1">{{ trim($benefit) }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                <a href="{{ url('product/' . $prod->slug) }}"
                                    class="btn btn-calculate py-2 btn-sm mt-auto">View Product</a>
                            </div>
                        </div>
                    @endforeach
                </div>
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
