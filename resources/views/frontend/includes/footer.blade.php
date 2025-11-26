{{-- ⭐️ FOOTER SECTION START --}}

{{-- Footer Top Bar (Using Primary Maroon Background) --}}
<section class="py-5 footer-top-section" style="background-color: var(--primary) !important; color: var(--soft-light);">
    <div class="container">
        <div class="row">
            
            {{-- 1. 🏢 Logo, Company Info & Contact --}}
            <div class="col-lg-4 col-md-6 mb-4 mb-lg-0 footer-col-info">
                <div class="logo-area mb-3">
                    {{-- Replace with your actual Logo/Text --}}
                    <h3 style="color: var(--secondary-base); font-size: 1.5rem; font-weight: 700;">SUYAGYA</h3>
                    <p class="small" style="color: var(--soft-light);">Discover authentic spiritual products.</p>
                </div>
                
                {{-- Contact Details (Using your original source data) --}}
                <div class="contact-details small">
                    <p class="mb-1 fw-bold" style="color: var(--secondary-base);">Suyagya Pvt. Ltd.</p>
                    
                    <p class="mb-1">
                        <i class="las la-map-marker-alt me-2" style="color: var(--secondary-base);"></i>
                        J-3/356, DDA, Kalkaji, New Delhi - 110019. INDIA
                    </p>
                    
                    <p class="mb-1">
                        <i class="las la-phone me-2" style="color: var(--secondary-base);"></i>
                        +91 9716 77 1960 
                    </p>
                    
                    <p class="mb-1">
                        <i class="las la-envelope me-2" style="color: var(--secondary-base);"></i>
                        <a href="mailto:support@suyagya.com" class="text-soft-light" style="text-decoration: none;">support@suyagya.com</a>
                    </p>
                    
                    <p class="mt-3">
                        <span class="fw-bold" style="color: var(--secondary-base);">Working Hours:</span> Mon-Sat, 10 AM - 6 PM
                    </p>
                </div>
            </div>

            {{-- 2. 🔗 Quick Links --}}
            <div class="col-lg-2 col-md-6 mb-4 mb-lg-0">
                <h4 class="footer-heading mb-3" style="color: var(--white); font-weight: 600;">Quick Links</h4>
                <ul class="footer-list small">
                    <li><a href="{{ url('track-your-order') }}" class="text-soft-light">Track Your Order</a></li>
                    <li><a href="{{ url('shops/create') }}" class="text-soft-light">Become a Seller</a></li>
                    <li><a href="{{ url('category/best-selling-dbeyi') }}" class="text-soft-light">Best Sellers</a></li>
                    <li><a href="{{ url('contact-us') }}" class="text-soft-light">Contact Us</a></li>
                    <li><a href="{{ url('about-us') }}" class="text-soft-light">About Us</a></li>
                    <li><a href="{{ url('blogs') }}" class="text-soft-light">Blogs</a></li>
                    <li><a href="{{ url('faqs') }}" class="text-soft-light">FAQs</a></li>
                </ul>
            </div>

            {{-- 3. 📜 Policies --}}
            <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                <h4 class="footer-heading mb-3" style="color: var(--white); font-weight: 600;">Policies</h4>
                <ul class="footer-list small">
                    <li><a href="{{ url('refund-policy') }}" class="text-soft-light">Refund and Cancellations</a></li>
                    <li><a href="{{ url('terms') }}" class="text-soft-light">Terms and Conditions</a></li>
                    <li><a href="{{ url('shipping-policy') }}" class="text-soft-light">Shipping Policy</a></li>
                    <li><a href="{{ url('privacy-policy') }}" class="text-soft-light">Privacy Policy</a></li>
                </ul>
            </div>

            {{-- 4. 💌 Offers & Social Media --}}
            <div class="col-lg-3 col-md-6">
                <h4 class="footer-heading mb-3" style="color: var(--white); font-weight: 600;">Get our exclusive offers</h4>
                <p class="small mb-2">Get Exclusive Coupons in your mailbox</p>
                
                {{-- Email Subscription Input (Simplified placeholder) --}}
                <form class="d-flex mb-4">
                    <input type="email" placeholder="Email" class="form-control me-2" style="background: var(--hov-primary); border: 1px solid var(--secondary-base); color: var(--white);">
                    <button type="submit" class="btn btn-sm" style="background-color: var(--secondary-base); color: var(--primary); font-weight: bold;">
                        <i class="las la-arrow-right"></i>
                    </button>
                </form>

                {{-- Social Icons (Aligned to the left like the example) --}}
                <div class="social-icons">
                    <a href="https://www.facebook.com/mysuyagya" target="_blank" class="social-icon-btn facebook me-2"><i class="lab la-facebook-f"></i></a>
                    <a href="https://www.instagram.com/mysuyagya/reels/" target="_blank" class="social-icon-btn instagram me-2"><i class="lab la-instagram"></i></a>
                    <a href="https://x.com/MySuyagya" target="_blank" class="social-icon-btn twitter me-2"><i class="lab la-twitter"></i></a>
                    <a href="https://www.youtube.com/@MySuyagya" target="_blank" class="social-icon-btn youtube me-2"><i class="lab la-youtube"></i></a>
                    {{-- LinkedIn --}}
                    <a href="#" target="_blank" class="social-icon-btn linkedin me-2"><i class="lab la-linkedin-in"></i></a>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- Footer Bottom: Copyright --}}
<footer class="py-3" style="background-color: #2e120f; color: var(--soft-light);">
    <div class="container text-center small">
        © 2025. Suyagya. All Rights Reserved to Suyagya Private Limited
        
        {{-- Optional: Back to top button --}}
        <a href="#top" class="back-to-top-btn" style="position: absolute; right: 20px; bottom: 10px; color: var(--secondary-base); text-decoration: none;">
            <i class="las la-arrow-up"></i>
        </a>
    </div>
</footer>

{{-- ⭐️ FOOTER SECTION END --}}

{{-- Note: Mobile Footer Accordions (d-lg-none) are excluded here for simplicity 
       but should be placed if required by your application logic. --}}
