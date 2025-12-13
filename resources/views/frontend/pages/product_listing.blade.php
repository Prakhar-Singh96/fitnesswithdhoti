@extends('frontend.layouts.app')

@section('content')

    {{-- Title Section --}}
    <div class="py-5 text-center border-bottom">
        <div class="container">
            <h1 class="font-heading fw-bold text-dark mb-2">
                {{ isset($subCategory) ? $subCategory->name : $category->name }}
            </h1>
            <p class="text-muted small mb-0" style="max-width: 600px; margin: 0 auto;">
                {{ isset($subCategory) ? $subCategory->description : $category->description }}
            </p>
            <p class="text-muted small mb-0">{{ $products->total() }} products</p>
        </div>
    </div>

    <div class="container py-5">
        <div class="row">

            {{-- SIDEBAR --}}
            <div class="col-lg-3 mb-4">
                <div class="filter-sidebar pe-lg-3">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="fw-bold mb-0 text-uppercase ls-1">Filters</h6>
                        @if (request()->has('filter') || request()->has('min_price'))
                            <a href="{{ url()->current() }}" class="text-danger x-small text-decoration-none fw-bold">Clear
                                All</a>
                        @endif
                    </div>

                    <form id="filterForm" action="" method="GET">
                        @if (request('sort'))
                            <input type="hidden" name="sort" value="{{ request('sort') }}">
                        @endif

                        @foreach ($filters as $index => $filter)
                            {{-- Price Logic (Middle Placement) --}}
                            @if ($index == 2 || ($loop->last && $index < 2))
                                <div class="filter-group border-bottom py-3">
                                    <a class="d-flex justify-content-between align-items-center text-dark text-decoration-none fw-bold mb-3"
                                        data-bs-toggle="collapse" href="#collapsePrice" role="button">
                                        Price <i class="las la-angle-down"></i>
                                    </a>

                                    <div class="collapse show" id="collapsePrice">

                                        {{-- 1. Input Boxes Row --}}
                                        <div class="d-flex align-items-center gap-2 mb-3">
                                            <div class="position-relative w-100">
                                                <span class="position-absolute text-muted small"
                                                    style="left: 8px; top: 7px;">₹</span>
                                                <input type="number" name="min_price" id="input-min"
                                                    class="price-input-box ps-3" placeholder="0"
                                                    value="{{ request('min_price') }}">
                                            </div>
                                            <span class="text-muted">-</span>
                                            <div class="position-relative w-100">
                                                <span class="position-absolute text-muted small"
                                                    style="left: 8px; top: 7px;">₹</span>
                                                <input type="number" name="max_price" id="input-max"
                                                    class="price-input-box ps-3" placeholder="Max"
                                                    value="{{ request('max_price') }}">
                                            </div>
                                            {{-- Go Button --}}
                                            <button type="submit" class="btn btn-dark btn-sm rounded-1 px-3">
                                                <i class="las la-angle-right"></i>
                                            </button>
                                        </div>

                                        {{-- 2. Range Slider --}}
                                        <div class="px-2 pb-2">
                                            <div id="price-slider"></div>
                                        </div>

                                    </div>
                                </div>
                            @endif

                            {{-- Attribute Filters --}}
                            <div class="filter-group border-bottom py-3">
                                <a class="d-flex justify-content-between align-items-center text-dark text-decoration-none fw-bold mb-2"
                                    data-bs-toggle="collapse" href="#collapse{{ $filter->id }}" role="button">
                                    {{ $filter->name }}
                                    <i class="las la-angle-down"></i>
                                </a>
                                <div class="collapse show" id="collapse{{ $filter->id }}">
                                    <div class="filter-options mt-2">
                                        @foreach ($filter->filterValues as $value)
                                            <div class="form-check mb-1 d-flex justify-content-between align-items-center">
                                                <div>
                                                    @php
                                                        $isChecked = false;
                                                        if (
                                                            request('filter') &&
                                                            isset(request('filter')[$filter->id])
                                                        ) {
                                                            $isChecked = in_array(
                                                                $value->id,
                                                                request('filter')[$filter->id],
                                                            );
                                                        }
                                                    @endphp
                                                    <input class="form-check-input filter-checkbox shadow-none"
                                                        type="checkbox" name="filter[{{ $filter->id }}][]"
                                                        value="{{ $value->id }}" id="val_{{ $value->id }}"
                                                        {{ $isChecked ? 'checked' : '' }} onchange="this.form.submit()">
                                                    <label class="form-check-label text-muted small ms-1"
                                                        for="val_{{ $value->id }}">
                                                        {{ $value->value }}
                                                    </label>
                                                </div>
                                                {{-- 🔴 COUNT SHOWING HERE --}}
                                                <span class="text-muted x-small">({{ $value->products_count }})</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </form>
                </div>
            </div>

            {{-- 🟢 PRODUCT GRID --}}
            <div class="col-lg-9">

                {{-- Toolbar --}}
                {{-- Toolbar --}}
                <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">

                    {{-- Left Side: Product Count --}}
                    <span class="text-muted small">{{ $products->total() }} products found</span>

                    {{-- Right Side: Sort Dropdown (Japam Style) --}}
                    <div class="d-flex align-items-center">
                        @php
                            $sortOptions = [
                                'newest' => 'Newest',
                                'price_asc' => 'Price: Low to High',
                                'price_desc' => 'Price: High to Low',
                            ];
                            $currentSort = request('sort', 'newest');
                            $sortLabel = $sortOptions[$currentSort] ?? 'Newest';
                        @endphp

                        <div class="dropdown">
                            <a class="text-dark fw-bold text-decoration-none dropdown-toggle small border p-2 rounded"
                                href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"
                                style="background: #fff; min-width: 160px; display: flex; justify-content: space-between; align-items: center;">
                                <span>
                                    <span class="text-muted fw-normal me-1">Sort by:</span> {{ $sortLabel }}
                                </span>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm mt-1" style="min-width: 160px;">
                                <li>
                                    <a class="dropdown-item small {{ $currentSort == 'newest' ? 'active bg-light text-dark fw-bold' : '' }}"
                                        href="{{ request()->fullUrlWithQuery(['sort' => 'newest']) }}">
                                        Newest
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item small {{ $currentSort == 'price_asc' ? 'active bg-light text-dark fw-bold' : '' }}"
                                        href="{{ request()->fullUrlWithQuery(['sort' => 'price_asc']) }}">
                                        Price: Low to High
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item small {{ $currentSort == 'price_desc' ? 'active bg-light text-dark fw-bold' : '' }}"
                                        href="{{ request()->fullUrlWithQuery(['sort' => 'price_desc']) }}">
                                        Price: High to Low
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                @if ($products->count() > 0)
                    <div class="row g-3">
                        @foreach ($products as $product)
                            <div class="col-6 col-md-4">
                                <div class="product-card h-100 position-relative">

                                    {{-- Image Link --}}
                                    <div class="img-box mb-3 position-relative overflow-hidden rounded-0">
                                        {{-- 👇 LINK UPDATE KIYA --}}
                                        <a href="{{ route('product.detail', $product->slug) }}">
                                            <img src="{{ asset($product->main_image) }}" alt="{{ $product->name }}"
                                                class="img-fluid w-100 object-fit-cover" style="aspect-ratio: 1/1;">
                                        </a>

                                        {{-- Badges --}}
                                        @if ($product->discount > 0)
                                            <span
                                                class="badge bg-danger position-absolute top-0 start-0 m-2 rounded-0 fw-normal px-2">
                                                {{ $product->discount }}% OFF
                                            </span>
                                        @endif
                                    </div>

                                    {{-- Details --}}
                                    <div class="product-info text-center">
                                        <h3 class="h6 mb-1">
                                            {{-- 👇 LINK UPDATE KIYA --}}
                                            <a href="{{ route('product.detail', $product->slug) }}"
                                                class="text-decoration-none text-dark fw-bold text-truncate d-block"
                                                style="font-family: 'Merriweather', serif;">
                                                {{ $product->name }}
                                            </a>
                                        </h3>

                                        {{-- Price --}}
                                        <div class="mb-2" style="text-align: left">
                                            <span class="fw-bold fs-6">₹{{ number_format($product->price, 0) }}</span>
                                            @if ($product->mrp_price > $product->price)
                                                <span
                                                    class="text-decoration-line-through text-muted ms-2 small">₹{{ number_format($product->mrp_price, 0) }}</span>
                                            @endif
                                        </div>

                                        {{-- Rating --}}
                                        <div class="text-warning d-flex align-items-center"
                                            style="font-size: 18px; margin-bottom: 6px;">
                                            <i class="las la-star"></i>
                                            <i class="las la-star"></i>
                                            <i class="las la-star"></i>
                                            <i class="las la-star"></i>
                                            <i class="las la-star"></i>
                                            <span class="text-muted ms-1 text-dark fw-bold">(24)</span>
                                        </div>

                                        {{-- Add to Cart --}}
                                        {{-- Add to Cart Button (Listing Page) --}}
                                        <button class="btn btn-sm btn-outline-dark rounded-0 w-100 mt-1"
                                            onclick="addToCart({{ $product->id }}, 1, 0, this)">
                                            Add to Cart
                                        </button>
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Pagination --}}
                    <div class="mt-5 d-flex justify-content-center">
                        {{ $products->links('pagination::bootstrap-5') }}
                    </div>
                @else
                    <div class="text-center py-5">
                        <div class="mb-3"><i class="las la-search fs-1 text-muted"></i></div>
                        <h4 class="h5">No products found</h4>
                        <p class="text-muted">Try removing some filters to see results.</p>
                        <a href="{{ url()->current() }}" class="btn btn-dark rounded-0 px-4">Clear Filters</a>
                    </div>
                @endif

            </div>

        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.7.0/nouislider.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // 1. Elements Select Karein
            var slider = document.getElementById('price-slider');
            var inputMin = document.getElementById('input-min');
            var inputMax = document.getElementById('input-max');

            // 2. Default Values (Agar URL me hain to wo lein, nahi to default)
            var minVal = parseInt("{{ request('min_price', 0) }}");
            var maxVal = parseInt("{{ request('max_price', 10000) }}"); // Max limit aap set kar sakte hain

            // 3. Initialize Slider
            noUiSlider.create(slider, {
                start: [minVal, maxVal || 10000], // Start handles position
                connect: true, // Beech me color bharega
                range: {
                    'min': 0,
                    'max': 20000 // Yahan apne products ka max price daal sakte hain
                },
                step: 100, // 100-100 karke badhega
                format: {
                    to: function(value) {
                        return Math.round(value);
                    },
                    from: function(value) {
                        return Number(value);
                    }
                }
            });

            // 4. Slider Drag Karne Par Input Update Karein
            slider.noUiSlider.on('update', function(values, handle) {
                var value = values[handle];
                if (handle === 0) {
                    inputMin.value = value;
                } else {
                    inputMax.value = value;
                }
            });

            // 5. Input Change Karne Par Slider Update Karein
            inputMin.addEventListener('change', function() {
                slider.noUiSlider.set([this.value, null]);
            });
            inputMax.addEventListener('change', function() {
                slider.noUiSlider.set([null, this.value]);
            });
        });
    </script>
@endsection
