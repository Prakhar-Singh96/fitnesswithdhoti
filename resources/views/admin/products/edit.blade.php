@extends('admin.layout.layout')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold py-3 mb-0"><span class="text-muted fw-light">Product /</span> Edit Product</h4>
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Back</a>
        </div>

        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') {{-- 👈 Important for Updates --}}

            <div class="row">
                {{-- LEFT COLUMN --}}
                <div class="col-xl-8 col-lg-7">

                    {{-- Basic Info --}}
                    <div class="card mb-4">
                        <h5 class="card-header">Product Information</h5>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Product Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ old('name', $product->name) }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Slug</label>
                                <input type="text" class="form-control" id="slug" name="slug"
                                    value="{{ old('slug', $product->slug) }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Description</label>
                                <textarea class="form-control" id="editor" name="description" rows="5">{{ old('description', $product->description) }}</textarea>
                            </div>
                        </div>
                    </div>

                    {{-- Images --}}
                    <div class="card mb-4">
                        <h5 class="card-header">Product Images</h5>
                        <div class="card-body">
                            {{-- Main Image Preview --}}
                            @if ($product->main_image)
                                <div class="mb-2">
                                    <img src="{{ asset($product->main_image) }}" width="100" class="rounded border p-1">
                                </div>
                            @endif
                            <div class="mb-4 border p-3 rounded">
                                <label class="form-label fw-bold">Update Main Image</label>
                                <input type="file" class="form-control mb-2" name="main_image">
                                <input type="text" class="form-control form-control-sm" name="main_image_alt"
                                    value="{{ old('main_image_alt', $product->main_image_alt) }}" placeholder="Alt Text">
                            </div>

                            <hr>

                            {{-- Existing Gallery Images (Show & Delete option) --}}
                            @if ($product->images->count() > 0)
                                <label class="form-label fw-bold">Existing Gallery Images</label>
                                <div class="row g-2 mb-3">
                                    @foreach ($product->images as $img)
                                        {{-- Har image ke div ko ek unique ID de rahe hain taaki delete hone par gayab kar sakein --}}
                                        <div class="col-3 position-relative" id="db_gallery_img_{{ $img->id }}">
                                            <img src="{{ asset($img->image) }}" class="w-100 rounded border">

                                            {{-- 👇 Yahan humne <a> tag hata diya aur button laga diya --}}
                                            <button type="button"
                                                class="btn btn-danger btn-xs position-absolute top-0 end-0 m-1 p-0 px-1"
                                                onclick="deleteExistingImage({{ $img->id }})">
                                                ×
                                            </button>
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            {{-- Add New Gallery Images --}}
                            <div class="mb-3">
                                <label class="form-label fw-bold">Add More Gallery Images</label>
                                <input type="file" class="form-control" name="gallery_images[]" multiple>
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
                                                {{-- 👇 YAHAN UPDATE KIYA HAI --}}
                                                <input class="form-check-input" type="checkbox" name="filter_values[]"
                                                    value="{{ $value->id }}" id="filter_{{ $value->id }}"
                                                    {{ $product->filterValues->contains($value->id) ? 'checked' : '' }}>

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

                    {{-- Pricing --}}
                    <div class="card mb-4">
                        <h5 class="card-header">Pricing & Inventory</h5>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">MRP Price (₹)</label>
                                <input type="number" class="form-control" id="mrp_price" name="mrp_price"
                                    step="0.01" value="{{ old('mrp_price', $product->mrp_price) }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Discount (%)</label>
                                {{-- 👇 step="0.01" add kiya gaya hai --}}
                                <input type="number" class="form-control" id="discount" name="discount"
                                    min="0" max="100" step="0.01"
                                    value="{{ old('discount', isset($product) ? $product->discount : 0) }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Selling Price (₹) <span class="text-danger">*</span></label>
                                {{-- 👇 Yahan se 'readonly' hata diya gaya hai --}}
                                <input type="number" class="form-control" id="price" name="price" step="0.01"
                                    value="{{ old('price', isset($product) ? $product->price : '') }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Quantity</label>
                                <input type="number" class="form-control" name="quantity"
                                    value="{{ old('quantity', $product->quantity) }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">SKU</label>
                                <input type="text" class="form-control" name="sku"
                                    value="{{ old('sku', $product->sku) }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Weight (kg)</label>
                                <input type="text" class="form-control" name="weight"
                                    value="{{ old('weight', $product->weight) }}">
                            </div>
                        </div>
                    </div>

                    {{-- Marketing --}}
                    <div class="card mb-4">
                        <h5 class="card-header">Marketing & Add-ons</h5>
                        <div class="card-body">
                            {{-- Timer --}}
                            {{-- <div class="mb-3">
                                <label class="form-label">Offer Ends At (Currently)</label>
                                <input type="text" class="form-control mb-2" value="{{ $product->offer_end_time }}"
                                    readonly>
                                <label class="small text-muted">Add Hours to extend:</label>
                                <input type="number" class="form-control" name="offer_hours" placeholder="e.g. 12">
                            </div>

                            <hr> --}}

                            {{-- Siddh --}}
                            <div class="form-check form-switch mb-2">
                                <input class="form-check-input" type="checkbox" id="is_siddh_enabled"
                                    name="is_siddh_enabled" value="1"
                                    {{ $product->is_siddh_enabled ? 'checked' : '' }}>
                                <label class="form-check-label fw-bold" for="is_siddh_enabled">Enable Siddh
                                    Version?</label>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Extra Price (₹)</label>
                                <input type="number" class="form-control" name="siddh_price"
                                    value="{{ old('siddh_price', $product->siddh_price) }}">
                            </div>
                        </div>
                    </div>

                    {{-- Shipping --}}
                    <div class="card mb-4">
                        <h5 class="card-header">EMI</h5>
                        <div class="card-body">
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" id="emi_available" name="emi_available"
                                    value="1" {{ $product->emi_available ? 'checked' : '' }}>
                                <label class="form-check-label" for="emi_available">EMI Available?</label>
                            </div>
                            {{-- <div class="mb-3">
                                <label class="form-label">Delivery Days</label>
                                <input type="number" class="form-control" name="delivery_days"
                                    value="{{ old('delivery_days', $product->delivery_days) }}">
                            </div> --}}
                        </div>
                    </div>

                    {{-- Organization --}}
                    <div class="card mb-4">
                        <h5 class="card-header">Organization</h5>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Category</label>
                                <select class="form-select" name="category_id" id="category_id" required>
                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat->id }}"
                                            {{ $product->category_id == $cat->id ? 'selected' : '' }}>
                                            {{ $cat->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Sub Category</label>
                                <select class="form-select" name="sub_category_id" id="sub_category_id">
                                    {{-- JS will load this, but for edit we can pre-populate if needed --}}
                                    <option value="{{ $product->sub_category_id }}" selected>
                                        {{ $product->subCategory->name ?? 'Select' }}</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <select class="form-select" name="status">
                                    <option value="1" {{ $product->status == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ $product->status == 0 ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Update Product</button>
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
        // 1. Auto Slug
        document.getElementById('name').addEventListener('input', function() {
            // Edit page me hum slug ko auto-update nahi karte taaki SEO kharab na ho
            // Lekin agar aap chahte hain to uncomment kar sakte hain:

            /*
            let slug = this.value.toLowerCase().replace(/[^a-z0-9\s-]/g, '').replace(/\s+/g, '-').replace(/-+/g, '-');
            document.getElementById('slug').value = slug;
            */
        });

        // 2. AJAX SubCategory Loader
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

        // ===============================================
        // 3. LOGIC FOR NEW IMAGES (DataTransfer)
        // ===============================================
        const dt = new DataTransfer();

        function handleFiles(files) {
            const container = document.getElementById('gallery-preview-container');
            const input = document.getElementById('gallery-input');

            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                let isDuplicate = false;

                // Check duplicates
                for (let j = 0; j < dt.files.length; j++) {
                    if (dt.files[j].name === file.name && dt.files[j].size === file.size) {
                        isDuplicate = true;
                        break;
                    }
                }

                if (!isDuplicate) {
                    dt.items.add(file);
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const fileId = file.name.replace(/[^a-zA-Z0-9]/g, '') + file.lastModified;

                        // 🟢 UPDATE 2: Added Alt Text Input in the HTML string
                        const html = `
                        <div class="col-md-6" id="preview-${fileId}">
                            <div class="d-flex align-items-center border p-2 rounded position-relative bg-white">
                                <img src="${e.target.result}" width="60" height="60" class="object-fit-cover rounded me-3">
                                <div class="flex-grow-1">
                                    <small class="text-muted d-block text-truncate" style="max-width: 150px;">${file.name}</small>

                                    {{-- New Image Alt Input --}}
                                    <input type="text" name="gallery_alts[]" class="form-control form-control-sm mt-1" placeholder="Enter Alt Text">

                                    <span class="badge bg-label-success mt-1">New</span>
                                </div>
                                <button type="button" class="btn btn-danger btn-sm ms-2 p-1" onclick="removeNewFile('${file.name}', '${fileId}')">
                                    <i class="bx bx-x fs-5"></i>
                                </button>
                            </div>
                        </div>`;

                        container.insertAdjacentHTML('beforeend', html);
                    }
                    reader.readAsDataURL(file);
                }
            }
            input.files = dt.files;
        }

        function removeNewFile(fileName, fileId) {
            const input = document.getElementById('gallery-input');
            const newDt = new DataTransfer();
            for (let i = 0; i < dt.files.length; i++) {
                if (dt.files[i].name !== fileName) newDt.items.add(dt.files[i]);
            }
            dt.items.clear();
            for (let i = 0; i < newDt.files.length; i++) dt.items.add(newDt.files[i]);
            input.files = dt.files;
            document.getElementById('preview-' + fileId).remove();
        }

        // ===============================================
        // 4. LOGIC FOR EXISTING DB IMAGES (AJAX DELETE)
        // ===============================================
        function deleteExistingImage(id) {
            if (confirm('Are you sure you want to permanently delete this image?')) {
                $.ajax({
                    url: "{{ url('admin/delete-gallery-image') }}/" + id,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            $('#db_gallery_img_' + id).fadeOut(300, function() {
                                $(this).remove();
                            });
                        } else {
                            alert('Error deleting image.');
                        }
                    },
                    error: function() {
                        alert('Something went wrong!');
                    }
                });
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
