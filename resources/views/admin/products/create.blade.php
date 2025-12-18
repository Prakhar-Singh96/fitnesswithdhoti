@extends('admin.layout.layout')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold py-3 mb-0"><span class="text-muted fw-light">Product /</span> Add Product</h4>
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Back</a>
        </div>

        {{-- 👇 2. ERROR MESSAGE BLOCK (YAHAN LAGAYEIN) 👇 --}}
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible" role="alert">
                <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">Oops! Something went wrong.</h6>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        {{-- 👆 YAHAN KHATAM --}}

        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                {{-- LEFT COLUMN --}}
                <div class="col-xl-8 col-lg-7">

                    {{-- Basic Info --}}
                    <div class="card mb-4">
                        <h5 class="card-header">Product Information</h5>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Product Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Slug</label>
                                <input type="text" class="form-control" id="slug" name="slug" readonly>
                            </div>
                            {{-- Description Field Update --}}
                            <div class="mb-3">
                                <label class="form-label fw-bold">Description (Rich Text)</label>
                                {{-- ID 'editor' is important here --}}
                                <textarea class="form-control" id="editor" name="description" rows="5">{{ old('description') }}</textarea>
                            </div>
                        </div>
                    </div>

                    {{-- Images --}}
                    <div class="card mb-4">
                        <h5 class="card-header">Product Images</h5>
                        <div class="card-body">

                            {{-- Main Image --}}
                            <div class="mb-4 border p-3 rounded">
                                <label class="form-label fw-bold">Main Image <span class="text-danger">*</span></label>
                                <input type="file" class="form-control mb-2" name="main_image" required>
                                <input type="text" class="form-control form-control-sm" name="main_image_alt"
                                    placeholder="Alt Text for Main Image (SEO)">
                            </div>

                            <hr>

                            {{-- Gallery Images Section --}}
                            <div class="mb-3">
                                <label class="form-label fw-bold">Gallery Images</label>

                                {{-- Custom "Add Images" Button acting as trigger --}}
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <label for="gallery-input" class="btn btn-outline-primary btn-sm">
                                        <i class="bx bx-plus me-1"></i> Add Images
                                    </label>
                                    {{-- Hidden File Input --}}
                                    <input type="file" id="gallery-input" name="gallery_images[]" multiple
                                        style="display: none;" onchange="handleFiles(this.files)">
                                </div>

                                {{-- Container where previews will appear --}}
                                <div id="gallery-preview-container" class="row g-3">
                                    {{-- JS will insert preview items here --}}
                                </div>

                                <div class="form-text text-muted mt-2">Images added here will be uploaded when you save the
                                    product.</div>
                            </div>
                        </div>
                    </div>

                    {{-- Filters / Attributes --}}
                    <div class="card mb-4">
                        <h5 class="card-header">Filters / Attributes</h5>
                        <div class="card-body">
                            @foreach ($filters as $filter)
                                <div class="mb-3">
                                    <label class="form-label fw-bold">{{ $filter->name }}</label>
                                    <div class="d-flex flex-wrap gap-2">
                                        @foreach ($filter->filterValues as $value)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="filter_values[]"
                                                    value="{{ $value->id }}" id="filter_{{ $value->id }}">
                                                <label class="form-check-label" for="filter_{{ $value->id }}">
                                                    {{ $value->value }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="mb-3 mt-4">
                            <div class="form-check form-switch mb-2">
                                <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured"
                                    value="1"
                                    {{ old('is_featured', isset($product) ? $product->is_featured : 0) ? 'checked' : '' }}>
                                <label class="form-check-label fw-bold" for="is_featured">Mark as Featured Product</label>
                            </div>

                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="is_best_seller" name="is_best_seller"
                                    value="1"
                                    {{ old('is_best_seller', isset($product) ? $product->is_best_seller : 0) ? 'checked' : '' }}>
                                <label class="form-check-label fw-bold" for="is_best_seller">Mark as Best Selling</label>
                            </div>
                        </div>
                    </div>

                    {{-- SEO --}}
                    <div class="card mb-4">
                        <h5 class="card-header">SEO Meta</h5>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Meta Title</label>
                                <input type="text" class="form-control" name="meta_title">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Meta Description</label>
                                <textarea class="form-control" name="meta_description"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">OG Image</label>
                                <input type="file" class="form-control" name="og_image">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- RIGHT COLUMN --}}
                <div class="col-xl-4 col-lg-5">

                    {{-- Pricing & Stock --}}
                    <div class="card mb-4">
                        <h5 class="card-header">Pricing & Inventory</h5>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">MRP Price (₹) <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="mrp_price" name="mrp_price"
                                    step="0.01" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Discount (%)</label>
                                <input type="number" class="form-control" id="discount" name="discount"
                                    min="0" max="100" step="0.01" value="0">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Selling Price (₹) <span class="text-danger">*</span></label>
                                {{-- 👇 readonly hata diya --}}
                                <input type="number" class="form-control" id="price" name="price" step="0.01"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Quantity <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="quantity" value="1" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">SKU</label>
                                <input type="text" class="form-control" name="sku">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Weight (kg)</label>
                                <input type="text" class="form-control" name="weight">
                            </div>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <h5 class="card-header">Marketing & Add-ons</h5>
                        <div class="card-body">

                            {{-- 🕒 Offer Timer --}}
                            {{-- <div class="mb-3">
                                <label class="form-label">Offer Duration (Hours)</label>
                                <input type="number" class="form-control" name="offer_hours"
                                    placeholder="e.g. 12 or 24">
                                <div class="form-text">Leave empty to disable timer.</div>
                            </div>

                            <hr> --}}

                            {{-- 🕉️ Siddh Version --}}
                            <div class="form-check form-switch mb-2">
                                {{-- Edit page par 'checked' condition lagana mat bhulna --}}
                                <input class="form-check-input" type="checkbox" id="is_siddh_enabled"
                                    name="is_siddh_enabled" value="1">
                                <label class="form-check-label fw-bold" for="is_siddh_enabled">Enable Siddh
                                    Version?</label>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Extra Price for Siddh (₹)</label>
                                <input type="number" class="form-control" name="siddh_price" placeholder="e.g. 100">
                            </div>

                        </div>
                    </div>

                    <div class="card mb-4">
                        <h5 class="card-header">EMI</h5>
                        <div class="card-body">

                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" id="emi_available" name="emi_available"
                                    value="1"
                                    {{ old('emi_available', $product->emi_available ?? 0) ? 'checked' : '' }}>
                                <label class="form-check-label" for="emi_available">Available on EMI?</label>
                            </div>

                            {{-- <div class="mb-3">
                                <label for="delivery_days" class="form-label">Estimated Delivery Days</label>
                                <input type="number" class="form-control" id="delivery_days" name="delivery_days"
                                    value="{{ old('delivery_days', $product->delivery_days ?? 7) }}" min="1">
                                <div class="form-text">Enter the number of days it takes to deliver (e.g., 5).</div>
                            </div> --}}

                        </div>
                    </div>

                    {{-- Categories --}}
                    <div class="card mb-4">
                        <h5 class="card-header">Organization</h5>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Category <span class="text-danger">*</span></label>
                                <select class="form-select" name="category_id" id="category_id" required>
                                    <option value="" selected disabled>Select Category</option>
                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Sub Category</label>
                                <select class="form-select" name="sub_category_id" id="sub_category_id">
                                    <option value="">Select Sub Category</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <select class="form-select" name="status">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Publish Product</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script>
        // Auto Slug
        document.getElementById('name').addEventListener('input', function() {
            let slug = this.value.toLowerCase().replace(/[^a-z0-9\s-]/g, '').replace(/\s+/g, '-').replace(/-+/g,
                '-');
            document.getElementById('slug').value = slug;
        });

        // AJAX SubCategory Loader
        $('#category_id').change(function() {
            let catId = $(this).val();
            let subCatSelect = $('#sub_category_id');

            subCatSelect.html('<option value="">Loading...</option>');

            $.ajax({
                url: "{{ url('admin/get-subcategories') }}/" + catId,
                type: 'GET',
                success: function(data) {
                    subCatSelect.html('<option value="">Select Sub Category</option>');
                    $.each(data, function(key, val) {
                        subCatSelect.append('<option value="' + val.id + '">' + val.name +
                            '</option>');
                    });
                }
            });
        });

        // Global DataTransfer object to hold files
        const dt = new DataTransfer();

        function handleFiles(files) {
            const container = document.getElementById('gallery-preview-container');
            const input = document.getElementById('gallery-input');

            // Loop through new files and add them to DataTransfer
            for (let i = 0; i < files.length; i++) {
                const file = files[i];

                // Prevent duplicates (optional check by name/size)
                let isDuplicate = false;
                for (let j = 0; j < dt.files.length; j++) {
                    if (dt.files[j].name === file.name && dt.files[j].size === file.size) {
                        isDuplicate = true;
                        break;
                    }
                }

                if (!isDuplicate) {
                    dt.items.add(file);

                    // Create Preview Element
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        // Generate unique ID for this item based on file name (sanitized)
                        const fileId = file.name.replace(/[^a-zA-Z0-9]/g, '');

                        const html = `
                        <div class="col-md-6" id="preview-${fileId}">
                            <div class="d-flex align-items-center border p-2 rounded position-relative bg-white">
                                <img src="${e.target.result}" width="60" height="60" class="object-fit-cover rounded me-3">
                                <div class="flex-grow-1">
                                    <small class="text-muted d-block text-truncate" style="max-width: 150px;">${file.name}</small>
                                    <input type="text" name="gallery_alts[]" class="form-control form-control-sm mt-1" placeholder="Alt Text">
                                </div>
                                <button type="button" class="btn btn-danger btn-sm ms-2 p-1" onclick="removeFile('${file.name}', '${fileId}')" style="line-height: 1;">
                                    <i class="bx bx-x fs-5"></i>
                                </button>
                            </div>
                        </div>
                    `;
                        container.insertAdjacentHTML('beforeend', html);
                    }
                    reader.readAsDataURL(file);
                }
            }

            // Update the input files property
            input.files = dt.files;
        }

        function removeFile(fileName, fileId) {
            const input = document.getElementById('gallery-input');
            const container = document.getElementById('gallery-preview-container');

            // Create a new DataTransfer to filter out the removed file
            const newDt = new DataTransfer();

            for (let i = 0; i < dt.files.length; i++) {
                if (dt.files[i].name !== fileName) {
                    newDt.items.add(dt.files[i]);
                }
            }

            // Update global dt and input
            dt.items.clear();
            for (let i = 0; i < newDt.files.length; i++) {
                dt.items.add(newDt.files[i]);
            }

            input.files = dt.files;

            // Remove the visual element
            const elementToRemove = document.getElementById(`preview-${fileId}`);
            if (elementToRemove) {
                elementToRemove.remove();
            }
        }

        // 2. Initialize CKEditor on the textarea
        ClassicEditor.create(document.querySelector('#editor'), {
                toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote'],
                heading: {
                    options: [{
                            model: 'paragraph',
                            title: 'Paragraph',
                            class: 'ck-heading_paragraph'
                        },
                        {
                            model: 'heading1',
                            view: 'h1',
                            title: 'Heading 1',
                            class: 'ck-heading_heading1'
                        },
                        {
                            model: 'heading2',
                            view: 'h2',
                            title: 'Heading 2',
                            class: 'ck-heading_heading2'
                        },
                        {
                            model: 'heading3',
                            view: 'h3',
                            title: 'Heading 3',
                            class: 'ck-heading_heading2'
                        },
                        {
                            model: 'heading4',
                            view: 'h4',
                            title: 'Heading 4',
                            class: 'ck-heading_heading4'
                        }
                    ]
                }
            })
            .catch(error => {
                console.error(error);
            });

        // Price Calculation Logic
        const mrpInput = document.getElementById('mrp_price');
        const discountInput = document.getElementById('discount');
        const priceInput = document.getElementById('price');

        // Flag to prevent recursive loop
        let isCalculating = false;

        // 1. MRP ya Discount change hone par -> Selling Price nikalo
        function calculatePriceFromDiscount() {
            if (isCalculating) return; // Agar pehle se calculate ho rha hai to ruk jao
            isCalculating = true;

            const mrp = parseFloat(mrpInput.value) || 0;
            const discount = parseFloat(discountInput.value) || 0;

            // Formula: Price = MRP - (MRP * Discount / 100)
            let sellingPrice = mrp - (mrp * discount / 100);

            // Negative price protection
            if (sellingPrice < 0) sellingPrice = 0;

            // Update Price Input (Fixed to 2 decimals)
            priceInput.value = sellingPrice.toFixed(2);

            isCalculating = false;
        }

        // 2. Selling Price change hone par -> Discount nikalo
        function calculateDiscountFromPrice() {
            if (isCalculating) return;
            isCalculating = true;

            const mrp = parseFloat(mrpInput.value) || 0;
            const price = parseFloat(priceInput.value) || 0;

            if (mrp > 0) {
                // Formula: Discount = ((MRP - Price) / MRP) * 100
                let discountPercent = ((mrp - price) / mrp) * 100;

                // Boundary checks
                if (discountPercent < 0) discountPercent = 0;
                // if(discountPercent > 100) discountPercent = 100;

                // Update Discount Input (Fixed to 2 decimals)
                discountInput.value = discountPercent.toFixed(2);
            }
            isCalculating = false;
        }

        // Events
        if (mrpInput && discountInput && priceInput) {

            // MRP badalne par Price update karein (Discount constant rahega)
            mrpInput.addEventListener('input', function() {
                if (discountInput.value && parseFloat(discountInput.value) > 0) {
                    calculatePriceFromDiscount();
                } else if (priceInput.value) {
                    calculateDiscountFromPrice();
                }
            });

            // Discount badalne par Price update
            discountInput.addEventListener('input', calculatePriceFromDiscount);

            // Price badalne par Discount update
            priceInput.addEventListener('input', calculateDiscountFromPrice);
        }
    </script>
@endsection
