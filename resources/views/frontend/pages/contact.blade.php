@extends('frontend.layouts.app')

@section('content')
    {{-- 1. HERO BANNER --}}
    <div class="position-relative w-100">
        {{-- 🖥️ DESKTOP BANNER: बड़ी स्क्रीन पर दिखेगा, मोबाइल (md से छोटी स्क्रीन) पर छिप जाएगा --}}
        <div class="d-none d-md-block">
            <img src="{{ asset('assets/img/contact.png') }}" alt="Contact Banner Desktop" class="w-100 object-fit-cover"
                style="height: 600px; object-position: center top;">
        </div>

        {{-- 📱 MOBILE BANNER: सिर्फ मोबाइल स्क्रीन पर दिखेगा, डेस्कटॉप पर छिप जाएगा ($600x600 के लिए बेस्ट फिट) --}}
        <div class="d-block d-md-none">
            <img src="{{ asset('assets/img/contact-mobile.png') }}" alt="Contact Banner Mobile" class="w-100 object-fit-cover"
                style="height: 400px; object-position: center;">
        </div>
    </div>

    <div class="container py-5">
        <div class="row g-5 align-items-center">

            {{-- 2. LEFT: ADDRESS INFO --}}
            <div class="col-lg-6">
                <h3 class="mb-4" style="font-family: 'Merriweather', serif; color: #233446;">Reach Us Directly</h3>

                <div class="mb-4">
                    <h6 class="fw-bold text-uppercase small text-muted mb-2" style="letter-spacing: 1px;">Office Address
                    </h6>
                    <p class="text-dark fw-semibold mb-1" style="font-size: 1.1rem;">Vardhiyas</p>
                    <p class="text-muted mb-1">K-348/7, Saurabh Vihar, Jaitpur, near Vijay Modern Public School,</p>
                    <p class="text-muted mb-1">Badarpur, DELHI,</p>
                    <p class="text-muted mb-1">Delhi, India - 110044.</p>
                </div>

                <div class="mb-4 border-top pt-3">
                    <p class="mb-2"><strong class="text-dark">Email Id:</strong> <a href="mailto:info@suyagya.com"
                            class="text-decoration-none text-muted">support@vardhiyas.com</a></p>
                    <p class="mb-1"><strong class="text-dark">Phone no:</strong> <a href="tel:+919870271533"
                            class="text-decoration-none text-muted">+91 9870 271 533</a></p>
                </div>
            </div>

            {{-- 3. RIGHT: GOOGLE MAP LOCATION --}}
            <div class="col-lg-6">
                {{-- 🚀 FIX: लाइव गूगल मैप का ओरिजिनल वर्किंग एम्बेड कोड --}}
                <div class="w-100 shadow-sm border rounded overflow-hidden" style="height: 350px;">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3506.0304794889544!2d77.31870897601316!3d28.50873068969094!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390ce74391ff7bab%3A0x58793a881312222b!2sVARDHIYAS!5e0!3m2!1sen!2sin!4v1783335815987!5m2!1sen!2sin"
                        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
@endsection
