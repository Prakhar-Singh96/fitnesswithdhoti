<div class="calculator-results-wrapper animate__animated animate__fadeInUp">
    {{-- 🌟 Results Header --}}
    <div class="text-center mb-5 mt-4">
        <div class="d-inline-block px-4 py-2 rounded-pill mb-2" style="background: #fff8f0; border: 1px solid #7b3f27;">
            <span class="text-uppercase fw-bold small" style="color: #7b3f27; letter-spacing: 1px;">
                <i class="las la-certificate"></i> Personalized Recommendation
            </span>
        </div>
        <h2 class="fw-bold font-heading text-dark">{{ $title }}</h2>
        <p class="text-muted">Based on your planetary alignments and personal goals, we suggest the following:</p>
    </div>

    {{-- 📦 Products Grid --}}
    <div class="row g-4 justify-content-center">
        @foreach($products as $prod)
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 product-suggest-card border-0 shadow-sm overflow-hidden">
                    {{-- Product Image with Badge --}}
                    <div class="position-relative overflow-hidden" style="height: 240px; background: #f9f9f9;">
                        <img src="{{ asset($prod->main_image) }}"
                             class="w-100 h-100 object-fit-cover transition-zoom"
                             alt="{{ $prod->name }}">

                        @if($prod->discount > 0)
                            <span class="badge bg-danger position-absolute top-0 start-0 m-3 shadow-sm">
                                {{ round($prod->discount) }}% OFF
                            </span>
                        @endif

                        <div class="position-absolute bottom-0 start-0 w-100 p-2 text-center" style="background: rgba(123, 63, 39, 0.85); backdrop-filter: blur(5px);">
                            <span class="text-white fw-bold small">Highly Compatible</span>
                        </div>
                    </div>

                    {{-- Product Info --}}
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-2 text-dark font-heading">{{ $prod->name }}</h5>

                        {{-- Short Astro Benefit --}}
                        <div class="astro-benefit-box mb-3 p-2 rounded" style="background: #fdfaf4; border-left: 3px solid #7b3f27;">
                            <p class="small text-muted mb-0 italic">
                                <i class="las la-info-circle"></i>
                                {{ Str::limit($prod->astro_benefits, 80) }}
                            </p>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <span class="fs-5 fw-bold text-dark">₹{{ number_format($prod->price) }}</span>
                                @if($prod->mrp_price > $prod->price)
                                    <span class="text-muted text-decoration-line-through small ms-2">₹{{ number_format($prod->mrp_price) }}</span>
                                @endif
                            </div>
                            <div class="text-warning small">
                                <i class="las la-star"></i> 4.9/5
                            </div>
                        </div>

                        <div class="row g-2 mt-auto">
                            <div class="col-12">
                                <a href="{{ url('product/'.$prod->slug) }}" class="btn btn-dark w-100 fw-bold py-2 rounded-3 text-uppercase small">
                                    View Details & Benefits
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- 🔒 Trust Footer --}}
    <div class="mt-5 p-4 rounded-4 text-center border-dashed" style="background: #fcf8f2; border: 1px dashed #d1c1b1;">
        <h6 class="fw-bold text-dark"><i class="las la-shield-alt"></i> Why trust our calculation?</h6>
        <p class="small text-muted mb-0">Our algorithm uses real-time astronomical data from Prokerala and traditional Vedic principles to ensure that every bead suggested is in perfect harmony with your birth chart.</p>
    </div>
</div>

<style>
    .transition-zoom { transition: transform 0.5s ease; }
    .product-suggest-card:hover .transition-zoom { transform: scale(1.1); }
    .border-dashed { border-style: dashed !important; }
    .font-heading { font-family: 'Merriweather', serif; }
</style>
