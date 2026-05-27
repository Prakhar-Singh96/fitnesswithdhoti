@extends('admin.layout.layout')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Calculator /</span> Dynamic Page Manager
        </h4>

        {{-- 🛑 TOP DROP-DOWNS CARD --}}
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Select Calculator Category</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold" for="main_category">Main Category</label>
                        <select id="main_category" class="form-select border-primary">
                            <option value="calculator" selected>Calculator Manager</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold" for="sub_category_select">Calculator Type
                            (Sub-Category)</label>
                        <select id="sub_category_select" name="sub_category_id" class="form-select border-warning" required>
                            <option value="">-- Choose Sub Category (e.g. Rudraksh, Gemstone) --</option>
                            @foreach ($subCategories as $sub)
                                <option value="{{ $sub->id }}">{{ $sub->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        {{-- ⏳ LOADING SPINNER --}}
        <div id="calculator-loader" class="text-center my-5" style="display: none;">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading Content...</span>
            </div>
            <h6 class="mt-2 text-primary">Fetching configurations...</h6>
        </div>

        {{-- 📝 MAIN FORM CONTAINER (Initially Hidden) --}}
        <form id="calculatorForm" action="{{ route('admin.calculator.save') }}" method="POST" enctype="multipart/form-data"
            style="display: none;">
            @csrf
            <input type="hidden" name="sub_category_id" id="hidden_sub_cat_id">

            <div class="row">
                {{-- LEFT SIDE FIELDS --}}
                <div class="col-xl-8 col-lg-7 col-md-12">

                    {{-- 1. HERO SECTION --}}
                    <div class="card mb-4">
                        <div class="card-header bg-label-primary py-3">
                            <h5 class="mb-0 text-primary">1. Hero Section Settings</h5>
                        </div>
                        <div class="card-body pt-3">
                            <div class="mb-3">
                                <label class="form-label">Page Meta Title</label>
                                <input type="text" name="page_title" class="form-control"
                                    placeholder="e.g. Free Rudraksha Calculator | Find Your Perfect Match">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Hero Banner Main Title</label>
                                <input type="text" name="hero_title" class="form-control"
                                    placeholder="e.g. Rudraksha Calculator">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Hero Short Description</label>
                                <textarea name="hero_short_desc" class="form-control" rows="3"
                                    placeholder="Enter details below to receive a personalized..."></textarea>
                            </div>
                        </div>
                    </div>

                    {{-- 2. WHAT IS CALCULATOR & HOW TO USE --}}
                    <div class="card mb-4">
                        <div class="card-header bg-label-secondary py-3">
                            <h5 class="mb-0 text-secondary">2. Calculator Explanation Content</h5>
                        </div>
                        <div class="card-body pt-3">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">What is Calculator Title</label>
                                    <input type="text" name="what_is_calculator_title" class="form-control"
                                        placeholder="e.g. What is a Rudraksha Calculator?">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">How to Use Calculator Title</label>
                                    <input type="text" name="how_to_use_title" class="form-control"
                                        placeholder="e.g. How to use this Calculator?">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">What is Calculator Description</label>
                                <textarea name="what_is_calculator_desc" id="what_is_calculator_desc" class="form-control text-editor"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">How to Use Calculator Description</label>
                                <textarea name="how_to_use_desc" id="how_to_use_desc" class="form-control text-editor"></textarea>
                            </div>
                        </div>
                    </div>

                    {{-- 3. ABOUT SECTION --}}
                    <div class="card mb-4">
                        <div class="card-header bg-label-info py-3">
                            <h5 class="mb-0 text-info">3. Detailed About Section</h5>
                        </div>
                        <div class="card-body pt-3">
                            <div class="mb-3">
                                <label class="form-label">About Section Title</label>
                                <input type="text" name="about_title" class="form-control"
                                    placeholder="e.g. Astrotalk's Divine Rudraksha Calculator">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">About Full Content</label>
                                <textarea name="about_desc" id="about_desc" class="form-control text-editor"></textarea>
                            </div>
                        </div>
                    </div>

                    {{-- 4. SPIRITUAL & BENEFITS SECTION --}}
                    <div class="card mb-4">
                        <div class="card-header bg-label-dark py-3">
                            <h5 class="mb-0 text-dark">4. Spiritual Significance & Benefits</h5>
                        </div>
                        <div class="card-body pt-3">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Spiritual Significance Title</label>
                                    <input type="text" name="spiritual_title" class="form-control"
                                        placeholder="e.g. Spiritual significance of wearing Rudraksha">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Benefits Section Title</label>
                                    <input type="text" name="benefits_title" class="form-control"
                                        placeholder="e.g. Benefits of Rudraksha">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Spiritual Description</label>
                                <textarea name="spiritual_desc" id="spiritual_desc" class="form-control text-editor"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Benefits Description</label>
                                <textarea name="benefits_desc" id="benefits_desc" class="form-control text-editor"></textarea>
                            </div>
                        </div>
                    </div>

                    {{-- 5. HOW TO WEAR & CONCLUSION --}}
                    <div class="card mb-4">
                        <div class="card-header bg-label-warning py-3">
                            <h5 class="mb-0 text-warning">5. Rituals & Closing Statement</h5>
                        </div>
                        <div class="card-body pt-3">
                            <div class="mb-3">
                                <label class="form-label">How to Wear Title</label>
                                <input type="text" name="how_to_wear_title" class="form-control"
                                    placeholder="e.g. How to wear Rudraksha properly?">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">How to Wear Description</label>
                                <textarea name="how_to_wear_desc" id="how_to_wear_desc" class="form-control text-editor"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Conclusion / Closing Summary</label>
                                <textarea name="conclusion" id="conclusion" class="form-control text-editor"></textarea>
                            </div>
                        </div>
                    </div>

                    {{-- 6. DYNAMIC REPEATERS (TESTIMONIALS & FAQS) --}}
                    <div class="card mb-4">
                        <div class="card-header bg-label-success py-3">
                            <h5 class="mb-0 text-success">6. Testimonials & FAQs Settings</h5>
                        </div>
                        <div class="card-body pt-3">
                            <h6 class="fw-bold mb-2 text-dark"><i class="bx bx-user-voice me-1"></i>Testimonials</h6>
                            <div id="testimonials-wrapper" class="mb-4">
                            </div>
                            <button type="button" class="btn btn-sm btn-outline-primary mb-4"
                                onclick="addTestimonialRow()">
                                <i class="bx bx-plus me-1"></i>Add New Testimonial
                            </button>

                            <hr class="my-4">

                            <h6 class="fw-bold mb-2 text-dark"><i class="bx bx-help-circle me-1"></i>Frequently Asked
                                Questions</h6>
                            <div id="faqs-wrapper" class="mb-3">
                            </div>
                            <button type="button" class="btn btn-sm btn-outline-primary" onclick="addFaqRow()">
                                <i class="bx bx-plus me-1"></i>Add New FAQ
                            </button>
                        </div>
                    </div>

                </div>

                {{-- RIGHT SIDE FIELDS (BANNERS, RECOMENDATIONS) --}}
                <div class="col-xl-4 col-lg-5 col-md-12">

                    {{-- AUTOMATIC AUTO-MAPPING CONFIG --}}
                    <div class="card mb-4 border-2 border-warning">
                        <div class="card-header bg-warning py-3">
                            <h5 class="mb-0 text-white"><i class="bx bx-git-merge me-1"></i>Auto Product Section</h5>
                        </div>
                        <div class="card-body pt-3">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Product Recommendation Title</label>
                                <input type="text" name="product_recommendation_title"
                                    class="form-control border-warning" placeholder="e.g. Type of Rudraksha">
                            </div>
                            <div class="alert alert-sm bg-label-warning text-dark mb-0 style-small shadow-none">
                                <i class="bx bx-info-circle me-1"></i> <strong>Note:</strong> इस सब-कैटेगरी से जुड़े सभी
                                लाइव प्रोडक्ट्स ऑटोमैटिकली फ्रंटएंड ग्रिड पर इनके इमेज, लिंक्स और फ़ायदों के साथ सिंक हो
                                जाएंगे।
                            </div>
                        </div>
                    </div>

                    {{-- IMAGE UPLOADS CARDS --}}
                    <div class="card mb-4">
                        <div class="card-header bg-label-danger py-3">
                            <h5 class="mb-0 text-danger"><i class="bx bx-image-add me-1"></i>Media & Banners</h5>
                        </div>
                        <div class="card-body pt-3">

                            <div class="mb-4">
                                <label class="form-label fw-semibold">Hero Background Banner (1920x400 px)</label>
                                <input type="file" name="hero_banner" class="form-control mb-2"
                                    onchange="previewImage(this, 'hero_preview')">
                                <img id="hero_preview" src="" class="img-fluid rounded border d-none"
                                    style="max-height: 120px;">
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-semibold">About Side Banner</label>
                                <input type="file" name="about_banner" class="form-control mb-2"
                                    onchange="previewImage(this, 'about_preview')">
                                <img id="about_preview" src="" class="img-fluid rounded border d-none"
                                    style="max-height: 120px;">
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-semibold">Spiritual Significance Image</label>
                                <input type="file" name="spiritual_image" class="form-control mb-2"
                                    onchange="previewImage(this, 'spiritual_preview')">
                                <img id="spiritual_preview" src="" class="img-fluid rounded border d-none"
                                    style="max-height: 120px;">
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">How to Wear Guide Image</label>
                                <input type="file" name="how_to_wear_image" class="form-control mb-2"
                                    onchange="previewImage(this, 'wear_preview')">
                                <img id="wear_preview" src="" class="img-fluid rounded border d-none"
                                    style="max-height: 120px;">
                            </div>

                        </div>
                    </div>

                    {{-- GLOBAL SAVE BUTTON CARD --}}
                    <div class="card card-action mb-4 position-sticky" style="top: 20px;">
                        <div class="card-body text-center">
                            <p class="small text-muted">Review all configurations before deployment to live production
                                environment.</p>
                            <button type="submit" class="btn btn-primary btn-lg w-100 shadow"><i
                                    class="bx bx-save me-1"></i>Save All Config</button>
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    {{-- CKEditor CDN ताकि रीच टेक्स्ट एडिटर एकदम मक्खन चले --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script>

    <script>
        let editors = {};

        // CKEditor इनिशियलाइज़ करने का आसान हेल्पर
        function initEditor(selector, fieldName) {
            ClassicEditor.create(document.querySelector(selector), {
                    toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote',
                        '|', 'undo', 'redo'
                    ]
                })
                .then(editor => {
                    editors[fieldName] = editor;
                })
                .catch(error => {
                    console.error(error);
                });
        }

        $(document).ready(function() {
            // सभी टेक्स्ट एरिया को CKEditor में कन्वर्ट करो
            initEditor('#what_is_calculator_desc', 'what_is_calculator_desc');
            initEditor('#how_to_use_desc', 'how_to_use_desc');
            initEditor('#about_desc', 'about_desc');
            initEditor('#spiritual_desc', 'spiritual_desc');
            initEditor('#benefits_desc', 'benefits_desc');
            initEditor('#how_to_wear_desc', 'how_to_wear_desc');
            initEditor('#conclusion', 'conclusion');

            // 🚀 MAIN DYNAMIC AJAX LOGIC
            $('#sub_category_select').on('change', function() {
                var subCatId = $(this).val();
                if (!subCatId) {
                    $('#calculatorForm').fadeOut();
                    return;
                }

                $('#calculatorForm').hide();
                $('#calculator-loader').show();

                $.ajax({
                    url: '/admin/calculator-manager/load/' + subCatId,
                    type: 'GET',
                    success: function(res) {
                        $('#calculator-loader').hide();
                        $('#calculatorForm').fadeIn();
                        $('#hidden_sub_cat_id').val(subCatId);

                        // अगर पहले से डेटाबेस में एंट्री है
                        if (res.status && res.data) {
                            var d = res.data;
                            $('input[name="page_title"]').val(d.page_title);
                            $('input[name="hero_title"]').val(d.hero_title);
                            $('textarea[name="hero_short_desc"]').val(d.hero_short_desc);
                            // 🚀 FIX: ये लाइन गायब थी, इसे अब ऐड कर दिया है!
                            $('input[name="about_title"]').val(d.about_title);
                            $('input[name="product_recommendation_title"]').val(d
                                .product_recommendation_title);
                            $('input[name="spiritual_title"]').val(d.spiritual_title);
                            $('input[name="benefits_title"]').val(d.benefits_title);
                            $('input[name="how_to_wear_title"]').val(d.how_to_wear_title);
                            $('input[name="what_is_calculator_title"]').val(d
                                .what_is_calculator_title);
                            $('input[name="how_to_use_title"]').val(d.how_to_use_title);

                            // Editors Data Populate
                            if (editors['what_is_calculator_desc']) editors[
                                'what_is_calculator_desc'].setData(d
                                .what_is_calculator_desc || '');
                            if (editors['how_to_use_desc']) editors['how_to_use_desc'].setData(d
                                .how_to_use_desc || '');
                            if (editors['about_desc']) editors['about_desc'].setData(d
                                .about_desc || '');
                            if (editors['spiritual_desc']) editors['spiritual_desc'].setData(d
                                .spiritual_desc || '');
                            if (editors['benefits_desc']) editors['benefits_desc'].setData(d
                                .benefits_desc || '');
                            if (editors['how_to_wear_desc']) editors['how_to_wear_desc']
                                .setData(d.how_to_wear_desc || '');
                            if (editors['conclusion']) editors['conclusion'].setData(d
                                .conclusion || '');

                            // Image Previews Sync
                            handleImgPreview(d.hero_banner, 'hero_preview');
                            handleImgPreview(d.about_banner, 'about_preview');
                            handleImgPreview(d.spiritual_image, 'spiritual_preview');
                            handleImgPreview(d.how_to_wear_image, 'wear_preview');

                            // Testimonials & FAQs Render
                            renderTestimonials(d.testimonials);
                            renderFaqs(d.faqs);
                        } else {
                            // फ्रेश फॉर्म (Reset All)
                            $('#calculatorForm')[0].reset();
                            Object.keys(editors).forEach(key => editors[key].setData(''));
                            $('.img-fluid').addClass('d-none').attr('src', '');
                            $('#testimonials-wrapper').html('');
                            $('#faqs-wrapper').html('');
                        }
                    },
                    error: function() {
                        $('#calculator-loader').hide();
                        alert('Failed to retrieve settings for selected category.');
                    }
                });
            });
        });

        // इमेज प्रिव्यू हैंडलर
        function handleImgPreview(path, imgElementId) {
            var el = $('#' + imgElementId);
            if (path) {
                el.attr('src', '/' + path).removeClass('d-none');
            } else {
                el.addClass('d-none').attr('src', '');
            }
        }

        function previewImage(input, previewId) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#' + previewId).attr('src', e.target.result).removeClass('d-none');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        // 🎁 REPEATER DOM BUILDERS
        let faqIndex = 0;

        function addFaqRow(q = '', a = '') {
            let row = `
        <div class="faq-item border rounded p-3 mb-2 bg-light position-relative" id="faq-row-${faqIndex}">
            <button type="button" class="btn-close text-danger position-absolute end-0 top-0 m-2 btn-sm" onclick="$('#faq-row-${faqIndex}').remove()"></button>
            <div class="mb-2 mt-1">
                <input type="text" name="faqs[${faqIndex}][question]" class="form-control form-control-sm" placeholder="Question" value="${q}" required>
            </div>
            <div>
                <textarea name="faqs[${faqIndex}][answer]" class="form-control form-control-sm" rows="2" placeholder="Answer..." required>${a}</textarea>
            </div>
        </div>`;
            $('#faqs-wrapper').append(row);
            faqIndex++;
        }

        let tIndex = 0;

        function addTestimonialRow(name = '', role = '', review = '') {
            let row = `
        <div class="t-item border rounded p-3 mb-2 bg-light position-relative" id="t-row-${tIndex}">
            <button type="button" class="btn-close text-danger position-absolute end-0 top-0 m-2 btn-sm" onclick="$('#t-row-${tIndex}').remove()"></button>
            <div class="row g-2 mt-1 mb-2">
                <div class="col-6">
                    <input type="text" name="testimonials[${tIndex}][name]" class="form-control form-control-sm" placeholder="User Name" value="${name}" required>
                </div>
                <div class="col-6">
                    <input type="text" name="testimonials[${tIndex}][role]" class="form-control form-control-sm" placeholder="Location/Role (e.g. Delhi)" value="${role}">
                </div>
            </div>
            <div>
                <textarea name="testimonials[${tIndex}][review]" class="form-control form-control-sm" rows="2" placeholder="Review Content..." required>${review}</textarea>
            </div>
        </div>`;
            $('#testimonials-wrapper').append(row);
            tIndex++;
        }

        function renderTestimonials(arr) {
            $('#testimonials-wrapper').html('');
            if (arr && arr.length > 0) {
                arr.forEach(item => addTestimonialRow(item.name, item.role, item.review));
            }
        }

        function renderFaqs(arr) {
            $('#faqs-wrapper').html('');
            if (arr && arr.length > 0) {
                arr.forEach(item => addFaqRow(item.question, item.answer));
            }
        }
    </script>

    <style>
        /* Sneat UI Adjustments */
        .bg-label-primary {
            background-color: #e7e7ff !important;
            color: #696cff !important;
        }

        .bg-label-secondary {
            background-color: #ebeef1 !important;
            color: #8592a3 !important;
        }

        .bg-label-info {
            background-color: #d7f5fc !important;
            color: #03c3ec !important;
        }

        .bg-label-success {
            background-color: #e1fbae !important;
            color: #71dd37 !important;
        }

        .bg-label-danger {
            background-color: #ffe5e5 !important;
            color: #ff3e1d !important;
        }

        .bg-label-dark {
            background-color: #eceef1 !important;
            color: #233446 !important;
        }

        .bg-label-warning {
            background-color: #fff2d6 !important;
            color: #ffab00 !important;
        }

        .ck-editor__editable {
            min-height: 140px !important;
            max-height: 300px !important;
        }

        .btn-close {
            font-size: 0.75rem;
        }
    </style>
@endsection
