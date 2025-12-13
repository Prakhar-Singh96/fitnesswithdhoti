@extends('frontend.layouts.app')

@section('title', $product->name . ' | Suyagya')

@section('styles')
    <style>
        /* ✨ PREMIUM DESIGN STYLES */
        :root {
            --primary-orange: #ff6f00;
            --text-dark: #222;
            --bg-cream: #fffbf2;
        }
    </style>
@endsection


@section('content')

    {{-- Breadcrumb --}}
    <div class="py-2 border-bottom mb-4">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 small">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-muted text-decoration-none">Home</a>
                    </li>
                    <li class="breadcrumb-item active text-dark">{{ $product->name }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container pb-5">
        <div class="row g-lg-5">

            {{-- ========================== --}}
            {{-- 🖼️ LEFT SIDE: IMAGE GALLERY --}}
            {{-- ========================== --}}
            <div class="col-lg-6 mb-4">
                <div class="sticky-top" style="top: 100px; z-index: 1;">

                    {{-- 1. Main Big Slider (Yeh ab Slider hai, static image nahi) --}}
                    <div class="product-main-slider">
                        {{-- First Image --}}
                        <div><img src="{{ asset($product->main_image) }}"></div>
                        {{-- Gallery Images --}}
                        @if ($product->images->count() > 0)
                            @foreach ($product->images as $img)
                                <div><img src="{{ asset($img->image) }}"></div>
                            @endforeach
                        @endif
                    </div>

                    {{-- 2. Thumbnail Navigation (Niche wala slider) --}}
                    <div class="product-thumb-slider">
                        {{-- Same images here for navigation --}}
                        <div><img src="{{ asset($product->main_image) }}"></div>
                        @if ($product->images->count() > 0)
                            @foreach ($product->images as $img)
                                <div><img src="{{ asset($img->image) }}"></div>
                            @endforeach
                        @endif
                    </div>

                </div>
            </div>

            {{-- ========================== --}}
            {{-- 📝 RIGHT SIDE: PRODUCT INFO --}}
            {{-- ========================== --}}
            <div class="col-lg-6">

                {{-- Title --}}
                <h1 class="fw-bold font-heading mb-2 text-dark" style="font-size: 1.8rem; line-height: 1.3;">
                    {{ $product->name }}
                </h1>

                {{-- Rating --}}
                <div class="d-flex align-items-center mb-3">
                    <div class="text-warning small me-2">
                        <i class="las la-star"></i><i class="las la-star"></i><i class="las la-star"></i><i
                            class="las la-star"></i><i class="las la-star-half-alt"></i>
                    </div>
                    <span class="text-muted small border-start ps-2">4.8 (24 Reviews)</span>
                </div>

                {{-- Price --}}
                <div class="mb-3 d-flex align-items-baseline">

                    <input type="hidden" id="base_price" value="{{ $product->price }}">

                    {{-- 👇 YAHAN ID MISSING THI, ISE UPDATE KAREIN 👇 --}}
                    <span class="fs-2 fw-bold text-dark me-2">
                        ₹<span id="display_price">{{ number_format($product->price) }}</span>
                    </span>

                    @if ($product->mrp_price > $product->price)
                        <span
                            class="text-decoration-line-through text-muted fs-5">₹{{ number_format($product->mrp_price) }}</span>
                        <span class="text-danger fw-bold ms-3 bg-danger-subtle px-2 py-1 rounded small">
                            Save ₹{{ number_format($product->mrp_price - $product->price) }}
                        </span>
                    @endif
                </div>

                {{-- 🕒 1. COUNTDOWN TIMER (Only if exists and future date) --}}
                <div class="offer-timer-box mb-4 p-2 border border-danger rounded d-inline-block bg-light">
                    <span class="text-danger fw-bold small me-2">Offer ends in:</span>
                    <span id="countdown" class="fw-bold text-dark" style="min-width: 100px; display: inline-block;">
                        Loading...
                    </span>
                </div>

                {{-- EMI Widget (Japam Style) --}}
                @if ($product->emi_available && $product->price > 500)
                    @php
                        $emiPrice = ceil($product->price / 3); // Simple 3 Month Logic
                    @endphp
                    <div class="emi-box border rounded p-2 mb-4 d-flex align-items-center bg-white"
                        style="max-width: 400px;">
                        <span class="badge bg-success me-2" style="font-size: 10px;">NEW</span>
                        <div class="flex-grow-1" style="font-size: 13px;">
                            or <strong>₹{{ $emiPrice }}/month</strong> (3 months)
                            <span class="badge bg-warning text-dark ms-1" style="font-size: 10px;">0% Interest</span>
                            <div class="text-muted" style="font-size: 11px;">UPI & Cards Accepted | No Extra Cost</div>
                        </div>
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/e1/UPI-Logo-vector.svg/1200px-UPI-Logo-vector.svg.png"
                            height="15" alt="UPI" class="opacity-50">
                    </div>
                @endif

                {{-- 🕉️ 2. SIDDH VERSION ADD-ON --}}
                @if ($product->is_siddh_enabled)
                    <div class="siddh-box p-3 border rounded mb-4" style="background-color: #fcf8f2;">
                        <div class="form-check d-flex align-items-center">
                            <input class="form-check-input me-3" type="checkbox" id="siddh_check"
                                style="width: 25px; height: 25px; cursor: pointer;">
                            <div>
                                <label class="form-check-label fw-bold text-dark cursor-pointer" for="siddh_check">
                                    Get Siddh Product for Just ₹{{ number_format($product->siddh_price, 0) }}
                                </label>
                                <small class="d-block text-muted">Energized with mantras for better results.</small>
                            </div>
                            <img src="https://www.pngitem.com/pimgs/m/508-5087146_om-symbol-png-transparent-png.png"
                                width="30" class="ms-auto opacity-50">
                        </div>
                    </div>
                @endif

                <input type="hidden" name="is_siddh" id="input_is_siddh" value="0">
                {{-- Buttons --}}
                @if ($product->quantity > 0)

                    {{-- 1. Quantity Selector --}}
                    <div class="mb-4">
                        <label class="fw-bold small mb-2 d-block">Quantity</label>
                        <div class="input-group" style="width: 140px;">
                            <button class="btn btn-outline-secondary btn-sm rounded-0" type="button"
                                onclick="updateQty('minus')">
                                <i class="las la-minus"></i>
                            </button>

                            <input type="text" id="qty_input" name="quantity"
                                class="form-control text-center border-secondary fs-6 fw-bold" value="1" min="1"
                                max="{{ $product->quantity }}" readonly>

                            <button class="btn btn-outline-secondary btn-sm rounded-0" type="button"
                                onclick="updateQty('plus')">
                                <i class="las la-plus"></i>
                            </button>
                        </div>

                        {{-- Low Stock Warning (Optional) --}}
                        @if ($product->quantity < 5)
                            <small class="text-danger fw-bold mt-1 d-block">
                                <i class="las la-exclamation-circle"></i> Only {{ $product->quantity }} left in stock!
                            </small>
                        @endif
                    </div>

                    {{-- Hidden Input for Siddh Logic (Jo pehle lagaya tha) --}}
                    <input type="hidden" name="is_siddh" id="input_is_siddh" value="0">

                    {{-- 2. Buttons (Enabled) --}}
                    <div class="d-flex gap-3 mb-4">
                        {{-- Detail Page Add to Cart --}}
                        <button class="btn btn-warning w-50 py-3 fw-bold text-dark text-uppercase shadow-sm fs-6"
                            style="border: 2px solid #ffc107;" data-id="{{ $product->id }}"
                            onclick="addToCartFromDetail(this)">
                            Add to Cart
                        </button>
                        <button class="btn btn-dark w-50 py-3 fw-bold text-uppercase shadow-sm fs-6"
                            data-id="{{ $product->id }}" onclick="openDirectCheckout(this)">
                            Buy Now
                        </button>
                    </div>
                @else
                    {{-- ❌ 3. OUT OF STOCK UI --}}
                    <div class="alert alert-danger border-0 d-flex align-items-center mb-4" role="alert"
                        style="background-color: #ffe5e5; color: #cc0000;">
                        <i class="las la-ban fs-3 me-2"></i>
                        <div>
                            <h6 class="fw-bold mb-0">Out of Stock</h6>
                            <small>This item is currently unavailable.</small>
                        </div>
                    </div>

                    {{-- Disabled Buttons --}}
                    <div class="d-flex gap-3 mb-4 opacity-50">
                        <button class="btn btn-secondary w-100 py-3 fw-bold text-uppercase" disabled>
                            Sold Out
                        </button>
                    </div>

                @endif

                {{-- Delivery Checker --}}
                {{-- 🚚 DELIVERY CHECKER (Reference Style) --}}
                {{-- 🚚 DELIVERY CHECKER --}}
                <div class="delivery-check-box mb-3">
                    <h6 class="fw-bold small mb-2 d-flex align-items-center">
                        <i class="las la-truck fs-4 me-2 text-danger"></i>
                        <span style="color: #000;">Get estimated delivery date</span>
                    </h6>
                    <small class="text-muted d-block mb-2" style="font-size: 11px;">Prepaid orders are delivered on
                        priority.</small>

                    <div class="input-group mb-3">
                        <span class="input-group-text bg-white border-end-0"><i
                                class="las la-map-marker text-muted"></i></span>

                        {{-- Input Field --}}
                        <input type="text" class="form-control border-start-0 border-secondary ps-0"
                            placeholder="Enter your pincode" id="pincodeInput" maxlength="6" style="box-shadow: none;">

                        {{-- Button --}}
                        <button class="btn text-white fw-bold px-4" style="background-color: #198754;" type="button"
                            onclick="checkDelivery()">Check</button>
                    </div>

                    {{-- Result Area (Fixed to include the missing span) --}}
                    <div id="deliveryResult" class="small fw-bold mt-2 mb-2" style="display:none;">
                        Free Delivery by <span id="deliveryDate"></span>
                    </div>

                    {{-- Offers inside box --}}
                    <div class="d-flex justify-content-between align-items-center mt-3 pt-2">
                        <div class="d-flex align-items-center">
                            <i class="las la-gift fs-3 me-2 text-dark"></i>
                            <div style="line-height: 1.2;">
                                <div class="fw-bold text-dark" style="font-size: 12px;">FREE Gift worth ₹499</div>
                                <div class="text-muted" style="font-size: 10px;">on all prepaid orders</div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="las la-shipping-fast fs-3 me-2 text-dark"></i>
                            <div style="line-height: 1.2;">
                                <div class="fw-bold text-dark" style="font-size: 12px;">FREE Shipping</div>
                                <div class="text-muted" style="font-size: 10px;">on all orders</div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- 🛡️ TRUST BADGE FOOTER (Green Box) --}}
                {{-- 🛡️ TRUST BADGE FOOTER (Green Box) --}}
                <div class="secure-box d-flex align-items-center justify-content-between p-3 rounded mb-3"
                    style="background-color: #e8f5e9; border: 1px solid #c8e6c9;">

                    {{-- Left Text --}}
                    <div class="d-flex align-items-center">
                        <i class="las la-check-circle fs-3 text-success me-2"></i>
                        <div style="line-height: 1.2;">
                            <div class="fw-bold text-dark" style="font-size: 13px;">100% Secure</div>
                            <div class="text-dark" style="font-size: 12px;">Payment Guarantee</div>
                        </div>
                    </div>

                    {{-- Right Payment Icons --}}
                    <div class="payment-icons d-flex align-items-center gap-4 flex-wrap justify-content-end">

                        {{-- Google Pay --}}
                        <img src="https://upload.wikimedia.org/wikipedia/commons/f/f2/Google_Pay_Logo.svg" height="20"
                            alt="GPay" title="Google Pay">

                        {{-- PhonePe --}}
                        <img src="https://upload.wikimedia.org/wikipedia/commons/7/71/PhonePe_Logo.svg" height="20"
                            alt="PhonePe" title="PhonePe">

                        {{-- Paytm --}}
                        <img src="https://upload.wikimedia.org/wikipedia/commons/2/24/Paytm_Logo_%28standalone%29.svg"
                            height="15" alt="Paytm" title="Paytm">

                        {{-- UPI --}}
                        <img src="https://upload.wikimedia.org/wikipedia/commons/e/e1/UPI-Logo-vector.svg" height="20"
                            alt="UPI" title="UPI">

                        {{-- Visa --}}
                        <img src="https://upload.wikimedia.org/wikipedia/commons/5/5e/Visa_Inc._logo.svg" height="12"
                            alt="Visa" title="Visa">

                        {{-- Mastercard --}}
                        <img src="https://upload.wikimedia.org/wikipedia/commons/2/2a/Mastercard-logo.svg" height="20"
                            alt="Mastercard" title="Mastercard">

                        {{-- RuPay --}}
                        <img src="https://upload.wikimedia.org/wikipedia/commons/c/cb/Rupay-Logo.png" height="20"
                            alt="RuPay" title="RuPay">

                    </div>
                </div>

                <div class="need-help-box mt-4 text-center p-4 rounded">

                    {{-- Heading with lines --}}
                    <div class="d-flex align-items-center justify-content-center mb-4">
                        <span class="line-separator flex-grow-1"></span>
                        <span class="mx-3 text-muted fw-bold small text-uppercase" style="letter-spacing: 1px;">Need Help
                            ?</span>
                        <span class="line-separator flex-grow-1"></span>
                    </div>

                    {{-- WhatsApp Button --}}
                    <a href="https://wa.me/919870271533" target="_blank"
                        class="btn btn-outline-warning w-100 mb-3 d-flex align-items-center justify-content-center fw-bold text-dark help-btn">
                        <i class="lab la-whatsapp fs-4 text-success me-2"></i> WhatsApp Support
                    </a>

                    {{-- Email Button --}}
                    <a href="mailto:support@suyagya.com"
                        class="btn btn-outline-warning w-100 mb-3 d-flex align-items-center justify-content-center fw-bold text-dark help-btn">
                        <i class="las la-envelope fs-4 text-dark me-2"></i> Email to our Support
                    </a>

                    {{-- Timing Text --}}
                    <small class="text-muted d-block mt-2" style="font-size: 11px;">(Mon to Sat 10 AM to 5 PM)</small>

                </div>

                {{-- 📄 PRODUCT DETAILS ACCORDION (New Section) --}}
                <div class="accordion accordion-flush mt-4" id="productDetailsAccordion">

                    {{-- 1. Description --}}
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold text-dark" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapseDescription">
                                <i class="las la-leaf me-2 fs-5"></i> Description
                            </button>
                        </h2>
                        <div id="collapseDescription" class="accordion-collapse collapse"
                            data-bs-parent="#productDetailsAccordion">
                            <div class="accordion-body text-muted small" style="line-height: 1.6;">
                                {!! $product->description !!}
                            </div>
                        </div>
                    </div>

                    {{-- 2. How To Wear & Recharge --}}
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold text-dark" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapseHowToWear">
                                <i class="las la-hand-holding-heart me-2 fs-5"></i> How To Wear & Recharge
                            </button>
                        </h2>
                        <div id="collapseHowToWear" class="accordion-collapse collapse"
                            data-bs-parent="#productDetailsAccordion">
                            <div class="accordion-body text-muted small" style="line-height: 1.6;">
                                <p>The energies of the stones are better realized when worn on your <strong>DOMINANT
                                        HAND</strong>. Example: If you're a right handed person, then wear on the right
                                    hand.</p>
                                <p>To recharge your wearable, please place it overnight on a <a href="#"
                                        class="text-dark text-decoration-underline">Selenite plate</a>. Selenite recharges
                                    the energies of the stone.</p>
                                <p>When you receive the wearable for the first time, submerge in a salt water solution for a
                                    day to absorb any negative energies and after cleansing, gently wash with tap water and
                                    pat try with a dry cloth to wear for the first time.</p>
                            </div>
                        </div>
                    </div>

                    {{-- 3. Got Questions? --}}
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold text-dark" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapseQuestions">
                                <i class="las la-comment-dots me-2 fs-5"></i> Got Questions?
                            </button>
                        </h2>
                        <div id="collapseQuestions" class="accordion-collapse collapse"
                            data-bs-parent="#productDetailsAccordion">
                            <div class="accordion-body text-muted small" style="line-height: 1.6;">
                                <p>We are here for you. If you have any questions related to our products, website, or your
                                    order - please <a href="{{ url('/contact-us') }}"
                                        class="text-dark text-decoration-underline">contact us</a>.</p>
                                <p>We try and resolve all queries within a day.</p>
                            </div>
                        </div>
                    </div>

                    {{-- 4. Delivery and Shipping --}}
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold text-dark" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapseDelivery">
                                <i class="las la-truck me-2 fs-5"></i> Delivery and Shipping
                            </button>
                        </h2>
                        <div id="collapseDelivery" class="accordion-collapse collapse"
                            data-bs-parent="#productDetailsAccordion">
                            <div class="accordion-body text-muted small" style="line-height: 1.6;">
                                <p><strong>We offer free delivery on all orders over ₹299.</strong> We pay from our pocket
                                    for getting the product delivered to you. In fact, we lose a lot of money if your
                                    delivery doesn't happen and the product is returned to us.</p>
                                <p>So when you place your order, please provide complete address and accept the order when
                                    the courier partner comes for delivery.</p>
                                <p><strong>For Prepaid orders:</strong> There is no order verification time. We will ship
                                    your order within 1 day and we will try to get it delivered to you within 4-5 days.</p>
                                <p><strong>For Cash on Delivery orders:</strong> Please expect 1-2 days for order
                                    verification, and another day for processing, and a few more days for delivery. In
                                    total, you should have your product within 1 week.</p>
                            </div>
                        </div>
                    </div>

                    {{-- 5. Returns & Replacement --}}
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold text-dark" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapseReturns">
                                <i class="las la-undo-alt me-2 fs-5"></i> Returns & Replacement
                            </button>
                        </h2>
                        <div id="collapseReturns" class="accordion-collapse collapse"
                            data-bs-parent="#productDetailsAccordion">
                            <div class="accordion-body text-muted small" style="line-height: 1.6;">
                                <p>We offer a 7-day return policy for all our products. If you are not satisfied with your
                                    purchase, you can return it within 7 days of delivery for a full refund or replacement.
                                    Please ensure the product is unused and in its original packaging.</p>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        // 🔄 1. SYNCED SLIDER SETUP (Updated)
        $('.product-main-slider').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: true, // ✅ Change: Main Image par arrows dikhao
            fade: true,
            asNavFor: '.product-thumb-slider',
            prevArrow: '<button type="button" class="slick-prev custom-arrow main-prev"><i class="las la-angle-left"></i></button>',
            nextArrow: '<button type="button" class="slick-next custom-arrow main-next"><i class="las la-angle-right"></i></button>'
        });

        $('.product-thumb-slider').slick({
            slidesToShow: 5,
            slidesToScroll: 1,
            asNavFor: '.product-main-slider',
            dots: false,
            centerMode: false,
            focusOnSelect: true,
            arrows: false // ✅ Change: Niche wale slider se arrows hata diye (Clean look)
        });


        function checkDelivery() {
            const pincode = document.getElementById('pincodeInput').value;
            const resultBox = document.getElementById('deliveryResult');
            const dateSpan = document.getElementById('deliveryDate');

            if (pincode.length === 6) {

                // Show Loading State
                dateSpan.innerText = "Checking...";
                resultBox.style.display = 'block';
                resultBox.className = "small text-muted fw-bold mt-2";

                // 🔥 Call Backend Route (BigShip Integrated)
                $.ajax({
                    url: "/check-pincode-delivery/" + pincode,
                    type: "GET",
                    success: function(response) {

                        if (response.status) {
                            // ✅ Success: Show the Date from API
                            dateSpan.innerText = response.date;

                            // Green Style
                            resultBox.className = "small text-success fw-bold mt-2";

                            // Optional: Show "Fast" tag if delivery is within 3 days
                            if (response.days <= 3) {
                                dateSpan.innerHTML +=
                                    " <span class='badge bg-success ms-2' style='font-size:10px;'>⚡ FAST</span>";
                            }
                        } else {
                            // ❌ Error: Not Serviceable
                            resultBox.className = "small text-danger fw-bold mt-2";
                            resultBox.innerText = response.message; // "Service not available"
                        }
                    },
                    error: function() {
                        resultBox.className = "small text-danger fw-bold mt-2";
                        resultBox.innerText = "Unable to fetch delivery date.";
                    }
                });

            } else {
                alert('Please enter valid 6 digit pincode');
                resultBox.style.display = 'none';
            }
        }

        // 🕒 1. FAKE DAILY TIMER (Midnight Countdown)
        const timerDisplay = document.getElementById('countdown');

        if (timerDisplay) {
            function startDailyTimer() {
                // Abhi ka time lo
                const now = new Date();

                // Aaj raat 12 baje ka time set karo (End of Day)
                const midnight = new Date();
                midnight.setHours(24, 0, 0, 0);

                // Time difference nikalo
                let diff = midnight - now;

                // Agar calculation me koi gadbad ho to 12 ghante jod do (Safe side)
                if (diff < 0) {
                    diff = diff + (24 * 60 * 60 * 1000);
                }

                // Hours, Minutes, Seconds calculate karo
                const h = Math.floor((diff / (1000 * 60 * 60)) % 24);
                const m = Math.floor((diff / (1000 * 60)) % 60);
                const s = Math.floor((diff / 1000) % 60);

                // Double digits me dikhao (e.g., 05 instead of 5)
                const hh = (h < 10) ? "0" + h : h;
                const mm = (m < 10) ? "0" + m : m;
                const ss = (s < 10) ? "0" + s : s;

                timerDisplay.innerHTML = `${hh} hr : ${mm} min : ${ss} sec`;
            }

            // Har second update karo
            setInterval(startDailyTimer, 1000);
            startDailyTimer(); // Page load hote hi run karo
        }

        // 🕉️ 2. SIDDH PRICE UPDATE LOGIC
        const siddhCheck = document.getElementById('siddh_check');
        const displayPrice = document.getElementById('display_price');
        const basePrice = parseFloat(document.getElementById('base_price').value);
        const siddhPrice = parseFloat("{{ $product->siddh_price ?? 0 }}");
        const inputSiddh = document.getElementById('input_is_siddh');

        if (siddhCheck) {
            siddhCheck.addEventListener('change', function() {
                if (this.checked) {
                    // Price badhao
                    let newPrice = basePrice + siddhPrice;
                    displayPrice.innerText = newPrice.toLocaleString('en-IN');
                    inputSiddh.value = 1; // Form ke liye
                } else {
                    // Price wapas normal
                    displayPrice.innerText = basePrice.toLocaleString('en-IN');
                    inputSiddh.value = 0; // Form ke liye
                }
            });
        }

        // 📦 QUANTITY HANDLER
        function updateQty(action) {
            const input = document.getElementById('qty_input');
            let currentVal = parseInt(input.value);
            const maxStock = parseInt(input.getAttribute('max'));

            if (action === 'plus') {
                if (currentVal < maxStock) {
                    input.value = currentVal + 1;
                } else {
                    alert('Maximum stock limit reached!');
                }
            } else if (action === 'minus') {
                if (currentVal > 1) {
                    input.value = currentVal - 1;
                }
            }
        }
    </script>
@endsection
