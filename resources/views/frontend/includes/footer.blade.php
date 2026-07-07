{{-- Footer Section (Modern Dark / Universal Clothing Brand Style) --}}
<style>
    /* Custom CSS for Footer Page */

    /* 1. Footer Background Color (Universal Dark) */
    .footer-main-section {
        /* background-color: #0c0112 !important; Deep Dark Grey / Black */
        color: #FFFFFF;
        padding-top: 60px;
        padding-bottom: 50px;
        font-family: 'Inter', sans-serif;
        /* Modern clean font */
        background: linear-gradient(180deg, rgba(92, 134, 154, 1), rgba(57, 86, 100, 1) 95%);
    }

    /* 2. Heading and Text Colors */
    .footer-heading {
        color: #FFFFFF !important;
        font-weight: 600;
        margin-bottom: 25px;
        font-size: 1rem;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    /* 3. Link Styling (Quick Links, Policies) */
    .footer-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .footer-list li {
        margin-bottom: 12px;
    }

    .footer-list a {
        color: rgba(255, 255, 255, 0.7) !important;
        text-decoration: none;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }

    .footer-list a:hover {
        color: #FFFFFF !important;
        padding-left: 5px;
        /* Subtle hover effect */
    }

    /* 4. Logo/Brand and Contact Info Styling */
    .footer-brand-info p,
    .footer-brand-info address {
        color: rgba(255, 255, 255, 0.7);
        font-size: 0.9rem;
        line-height: 1.6;
        margin-bottom: 8px;
    }

    /* 5. Input Field Styling (Newsletter) */
    .footer-input-group {
        border-bottom: 1px solid rgba(255, 255, 255, 0.3);
        padding-bottom: 5px;
    }

    .footer-input-group input {
        background-color: transparent;
        border: none;
        color: #FFFFFF;
        height: 40px;
        padding: 0;
        box-shadow: none;
    }

    .footer-input-group input:focus {
        background-color: transparent;
        color: #FFFFFF;
        box-shadow: none;
        outline: none;
    }

    .footer-input-group input::placeholder {
        color: rgba(255, 255, 255, 0.5);
    }

    .footer-input-group button {
        color: #FFFFFF;
        background: transparent;
        border: none;
        font-size: 1.2rem;
    }

    /* 6. Social Icons */
    .footer-social-icons {
        margin-top: 25px;
        gap: 15px;
    }

    .social-icon-btn {
        display: flex !important;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background-color: rgba(255, 255, 255, 0.05);
        color: #FFFFFF;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .social-icon-btn:hover {
        background-color: #FFFFFF;
        color: #111111;
        transform: translateY(-3px);
    }

    .social-icon-btn svg {
        width: 45%;
        height: 45%;
        fill: currentColor;
    }

    /* 7. Copyright Bar */
    .footer-copyright-bar {
        /* background-color: #000000; */
        color: rgba(255, 255, 255, 0.5);
        padding: 8px 0;
        font-size: 0.8rem;
        letter-spacing: 0.5px;
        background: linear-gradient(193deg, rgb(3 31 44), rgb(120 127 131) 95%);
    }

    /* Top Trust Banner Styling */
    .trust-banner {
        /* background-color: #f9f9f9; */
        /* border-top: 1px solid #eee; */
        /* border-bottom: 1px solid #eee; */
        background: linear-gradient(180deg, rgba(146, 175, 183, 1), rgba(92, 134, 154, 1) 100%);
    }

    .trust-icon {
        font-size: 2.2rem;
        color: #ffffff;
        margin-bottom: 10px;
    }

    .trust-banner .text-dark {
        --bs-text-opacity: 1;
        color: rgb(235 238 241) !important;
    }

    .trust-banner .text-muted {
        --bs-text-opacity: 1;
        color: rgb(255 255 255 / 75%) !important;
    }
</style>

{{-- 🏆 Trust Badges Banner --}}
<section class="py-5 trust-banner">
    <div class="container">
        <div class="row text-center g-4">

            {{-- 1. Free Shipping --}}
            <div class="col-6 col-md-3">
                <div><i class="las la-truck trust-icon"></i></div>
                <h6 class="fw-bold text-dark mb-1">Free Shipping</h6>
                <small class="text-muted">On all prepaid orders</small>
            </div>

            {{-- 2. Easy Returns --}}
            <div class="col-6 col-md-3">
                <div><i class="las la-exchange-alt trust-icon"></i></div>
                <h6 class="fw-bold text-dark mb-1">7 Days Return</h6>
                <small class="text-muted">Easy exchange policy</small>
            </div>

            {{-- 3. Secure Payments --}}
            <div class="col-6 col-md-3">
                <div><i class="las la-lock trust-icon"></i></div>
                <h6 class="fw-bold text-dark mb-1">Secure Checkout</h6>
                <small class="text-muted">100% encrypted payments</small>
            </div>

            {{-- 4. Premium Quality --}}
            <div class="col-6 col-md-3">
                <div><i class="las la-gem trust-icon"></i></div>
                <h6 class="fw-bold text-dark mb-1">Premium Quality</h6>
                <small class="text-muted">Finest fabrics & materials</small>
            </div>

        </div>
    </div>
</section>

{{-- ⬛ Main Dark Footer --}}
<footer class="footer-main-section">
    <div class="container">
        <div class="row">

            {{-- 1. 🏢 Brand & Contact Info --}}
            <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                <div class="d-flex flex-column">
                    <div class="footer-logo mb-4">
                        {{-- Logo Image --}}
                        <img src="{{ asset('assets/img/fitnessfooter.png') }}"
                            alt="Suyagya Logo" style="height: 66px;">
                    </div>
                    <div class="footer-brand-info">
                        <p class="mb-3">Redefining modern men's fashion with premium quality apparel designed for
                            everyday comfort.</p>

                        <p class="mb-1"><i class="las la-envelope me-2"></i> <a href="mailto:support@vardhiyas.com"
                                class="text-white text-decoration-none">support@fitnesswithdhoti.com</a></p>
                        <p class="mb-1"><i class="las la-phone me-2"></i> +91 98702 71533 </p>
                        <p class="mt-3 small" style="opacity: 0.6;">Mon - Sat, 10 AM - 6 PM</p>
                    </div>
                </div>
            </div>

            {{-- 2. 🔗 Quick Links (RESTORED PURANE LINKS) --}}
            <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                <h4 class="footer-heading">Quick Links</h4>
                <ul class="footer-list">
                    <li><a href="{{ route('track.order') }}">Track Your Order</a></li>
                    <li><a href="{{ route('contact') }}">Contact Us</a></li>
                    <li><a href="{{ route('about') }}">About Us</a></li>
                    <li><a href="{{ route('frontend.faq') }}">FAQs</a></li>
                    <li><a href="{{ route('blogs.index') }}">Blogs</a></li>
                </ul>
            </div>

            {{-- 3. 📜 Policies (RESTORED PURANE LINKS) --}}
            <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                <h4 class="footer-heading">Policies</h4>
                <ul class="footer-list">
                    <li><a href="{{ route('refund.policy') }}">Refund & Cancellation</a></li>
                    <li><a href="{{ route('terms.conditions') }}">Terms & Conditions</a></li>
                    <li><a href="{{ route('support.policy') }}">Support Policy</a></li>
                    <li><a href="{{ route('privacy.policy') }}">Privacy Policy</a></li>
                </ul>
            </div>

            {{-- 4. 💌 Newsletter & Social --}}
            <div class="col-lg-3 col-md-6">
                <h4 class="footer-heading">Join The Club</h4>
                <p class="small mb-3" style="color: rgba(255,255,255,0.7);">Sign up for exclusive offers, original
                    stories, events and more.</p>

                {{-- Minimalist Newsletter Input --}}
                <div class="footer-input-group d-flex mb-4">
                    <input type="email" placeholder="Enter your email"
                        class="form-control bg-transparent text-white border-0 shadow-none px-0">
                    <button type="submit" class="btn px-2">
                        <i class="las la-arrow-right"></i>
                    </button>
                </div>

                {{-- Social Icons --}}
                <div class="footer-social-icons d-flex">
                    <a href="#" target="_blank" aria-label="Facebook" class="social-icon-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path
                                d="M15.12,5.32H17V2.14A26.11,26.11,0,0,0,14.26,2C11.54,2,9.68,3.66,9.68,6.7V9.32H6.61v3.56H9.68V22h3.68V12.88h3.06l.46-3.56H13.36V7.05C13.36,6,13.64,5.32,15.12,5.32Z">
                            </path>
                        </svg>
                    </a>
                    <a href="#" target="_blank" aria-label="Instagram" class="social-icon-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path
                                d="M12,2A10,10,0,0,0,2,12a10,10,0,0,0,10,10,10,10,0,0,0,10-10A10,10,0,0,0,12,2Zm3.47,1.86a1.44,1.44,0,1,1-1.44,1.44,1.44,1.44,0,0,1,1.44-1.44ZM12,6.5A5.5,5.5,0,1,1,6.5,12,5.5,5.5,0,0,1,12,6.5ZM12,8.5a3.5,3.5,0,1,0,3.5,3.5A3.5,3.5,0,0,0,12,8.5Z">
                            </path>
                        </svg>
                    </a>
                </div>
            </div>

        </div>
    </div>
</footer>

{{-- Footer Bottom: Copyright Bar --}}
<div class="footer-copyright-bar">
    <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center">
        <div class="mb-2 mb-md-0">
            © {{ date('Y') }} Vardhiyas. All Rights Reserved.
        </div>
        <div>
            {{-- Optional: Payment method icons can go here --}}
            <i class="lab la-cc-visa fs-3 mx-1"></i>
            <i class="lab la-cc-mastercard fs-3 mx-1"></i>
            <i class="lab la-cc-amex fs-3 mx-1"></i>
        </div>
    </div>
</div>
