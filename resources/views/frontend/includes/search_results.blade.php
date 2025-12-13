<div class="container-fluid px-0">
    <div class="row g-0">

        {{-- LEFT COLUMN: TABS & CONTENT --}}
        <div class="col-lg-8 border-end position-relative">

            {{-- 1. TABS HEADER --}}
            <div class="d-flex border-bottom px-4 pt-3 pb-0 mb-3" id="search-tabs">
                <div class="pb-2 border-bottom border-dark border-2 fw-bold text-dark me-4 cursor-pointer tab-btn active" data-target="#tab-products">
                    Products ({{ $products->count() }})
                </div>
                <div class="pb-2 text-muted me-4 cursor-pointer tab-btn" data-target="#tab-collections">
                    Collections ({{ $collections->count() }})
                </div>
                <div class="pb-2 text-muted cursor-pointer tab-btn" data-target="#tab-pages">
                    Pages ({{ $pages->count() }})
                </div>
            </div>

            {{-- 2. TAB CONTENT AREA --}}
            <div class="px-4 pb-4" style="min-height: 250px;">

                {{-- A. PRODUCTS TAB --}}
                <div id="tab-products" class="search-tab-content">
                    @if($products->count() > 0)
                        <div class="row g-3">
                            @foreach($products as $product)
                                <div class="col-12">
                                    <a href="{{ route('product.detail', $product->slug) }}" class="d-flex align-items-center text-decoration-none text-dark search-item-card p-2 rounded hover-bg-light">
                                        <div class="flex-shrink-0 me-3" style="width: 60px; height: 60px;">
                                            <img src="{{ asset($product->main_image) }}" class="w-100 h-100 object-fit-cover rounded border" alt="{{ $product->name }}">
                                        </div>
                                        <div>
                                            <h6 class="mb-1 fw-bold text-dark small">{{ $product->name }}</h6>
                                            <div class="small">
                                                <span class="fw-bold">₹{{ number_format($product->price) }}</span>
                                                @if($product->mrp_price > $product->price)
                                                    <span class="text-decoration-line-through text-muted ms-1" style="font-size: 0.8em;">₹{{ number_format($product->mrp_price) }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted small mt-3">No products found for "{{ $query }}"</p>
                    @endif
                </div>

                {{-- B. COLLECTIONS TAB (Hidden by default) --}}
                {{-- B. COLLECTIONS TAB (Categories + SubCategories) --}}
                <div id="tab-collections" class="search-tab-content" style="display: none;">
                    @if($collections->count() > 0)
                        <div class="row g-3">
                            @foreach($collections as $item)
                                <div class="col-12">
                                    <a href="{{ $item->url }}" class="d-flex align-items-center text-decoration-none text-dark search-item-card p-2 rounded hover-bg-light">

                                        {{-- Icon Box --}}
                                        <div class="flex-shrink-0 me-3" style="width: 50px; height: 50px; background: #f8f8f8; display: flex; align-items: center; justify-content: center; border-radius: 5px; border: 1px solid #eee;">

                                            @if($item->image)
                                                {{-- Category Image --}}
                                                <img src="{{ asset($item->image) }}" class="w-100 h-100 object-fit-cover rounded" onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                                                <i class="las la-boxes fs-3 text-muted" style="display: none;"></i>
                                            @else
                                                {{-- Default Icon for SubCategory or Missing Image --}}
                                                <i class="las la-tags fs-3 text-muted"></i>
                                            @endif

                                        </div>

                                        {{-- Name & Type --}}
                                        <div>
                                            <h6 class="mb-0 fw-bold text-dark small">{{ $item->name }}</h6>
                                            <span class="text-muted x-small text-uppercase" style="font-size: 10px;">{{ $item->type }}</span>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted small mt-3">No collections found matching "{{ $query }}"</p>
                    @endif
                </div>

                {{-- C. PAGES TAB --}}
                <div id="tab-pages" class="search-tab-content" style="display: none;">
                    <p class="text-muted small mt-3">No pages found matching "{{ $query }}"</p>
                </div>

            </div>

            {{-- 3. VIEW ALL LINK (Bottom) --}}
            <div class="px-4 pb-3">
                <a href="{{ route('products.search_listing') }}?q={{ $query }}" class="btn btn-outline-dark w-100 rounded-0 btn-sm">
                    View all search results <i class="las la-arrow-right ms-1"></i>
                </a>
            </div>
        </div>

        {{-- RIGHT COLUMN: SUGGESTIONS --}}
        <div class="col-lg-4 bg-light">
            <div class="p-4 h-100">
                <h6 class="fw-bold text-dark border-bottom pb-2 mb-3 small">Suggestions</h6>
                <ul class="list-unstyled mb-0">
                    @foreach($suggestions as $sug)
                        <li class="mb-2">
                            <a href="{{ route('products.search_listing') }}?q={{ $sug }}" class="text-decoration-none text-muted d-block py-1 hover-text-dark small">
                                {!! preg_replace('/(' . $query . ')/i', '<strong class="text-dark">$1</strong>', $sug) !!}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

    </div>
</div>

<script>
    // Simple Tab Switcher Logic inside the loaded view
    $('.tab-btn').on('click', function() {
        // Remove active class from all tabs
        $('.tab-btn').removeClass('border-bottom border-dark border-2 fw-bold text-dark active').addClass('text-muted');

        // Add active class to clicked tab
        $(this).removeClass('text-muted').addClass('border-bottom border-dark border-2 fw-bold text-dark active');

        // Hide all contents
        $('.search-tab-content').hide();

        // Show target content
        $($(this).data('target')).show();
    });
</script>
