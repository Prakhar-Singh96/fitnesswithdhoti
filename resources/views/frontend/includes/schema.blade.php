{{-- ================= PRODUCT PAGE ADVANCED CONNECTED GRAPH SCHEMA ================= --}}
@if (Route::is('product.detail') && isset($product))
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@graph": [
            {
                "@type": "Product",
                "@id": "{!! url()->current() !!}#product",
                "name": {!! json_encode($product->name, JSON_UNESCAPED_SLASHES) !!},
                "image": [
                    @php
                        $allImages = [];
                        if (!empty($product->main_image ?? $product->product_main_image)) {
                            $allImages[] = asset($product->main_image ?? $product->product_main_image);
                        }
                        if (!empty($product->images)) {
                            foreach ($product->images as $img) {
                                // अगर $img एक एरे है तो 'image' की निकालो, नहीं तो डायरेक्ट स्ट्रिंग लो
                                $allImages[] = asset($img['image'] ?? $img);
                            }
                        }
                        // डुप्लीकेट यूआरएल हटाओ
                        $allImages = array_unique($allImages);
                    @endphp
                    @foreach(array_values($allImages) as $index => $imageUrl)
                        "{!! $imageUrl !!}"{{ $index < count($allImages) - 1 ? ',' : '' }}
                    @endforeach
                ],
                "description": {!! json_encode(Str::limit(strip_tags($product->description), 160), JSON_UNESCAPED_SLASHES) !!},
                "sku": {!! json_encode($product->sku ?? 'SUY-'.$product->id, JSON_UNESCAPED_SLASHES) !!},
                "brand": {
                    "@type": "Brand",
                    "name": "Suyagya"
                },
                "offers": {
                    "@type": "Offer",
                    "url": "{!! url()->current() !!}",
                    "priceCurrency": "INR",
                    "price": "{!! number_format((float)$product->price, 2, '.', '') !!}",
                    "availability": "{{ $product->quantity > 0 ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock' }}",
                    "itemCondition": "https://schema.org/NewCondition"
                },
                {{-- 🚀 ब्रह्मास्त्र फिक्स: लारेवेल ई-कॉमर्स थीम के सटीक वेरिएबल्स (reviews_count या rating) को चेक करने का फुलप्रूफ लॉजिक --}}
                @if(
                    (isset($product->reviews_count) && $product->reviews_count > 0) ||
                    (isset($product->num_of_reviews) && $product->num_of_reviews > 0) ||
                    (isset($product->reviews) && count($product->reviews) > 0)
                )
                "aggregateRating": {
                    "@type": "AggregateRating",
                    "ratingValue": "{!! $product->rating ?? $product->ratings_average ?? '4.4' !!}",
                    "reviewCount": "{!! $product->reviews_count ?? $product->num_of_reviews ?? count($product->reviews) !!}"
                },
                @endif
                @if(!empty($product->faq_content))
                "mainEntity": {
                    "@id": "{!! url()->current() !!}#faq"
                }
                @endif
            }
            @if(!empty($product->faq_content))
            ,{
                "@type": "FAQPage",
                "@id": "{!! url()->current() !!}#faq",
                "mainEntity": [
                    @foreach($product->faq_content as $index => $faq)
                    {
                        "@type": "Question",
                        {{-- 🚀 फिक्स: यहाँ JSON_UNESCAPED_UNICODE जोड़ दिया है ताकि डैश (\u2014) सीधा हिंदी/नॉर्मल टेक्स्ट में दिखे --}}
                        "name": {!! json_encode($faq['question'], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!},
                        "acceptedAnswer": {
                            "@type": "Answer",
                            "text": {!! json_encode(strip_tags($faq['answer']), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
                        }
                    }{{ $index < count($product->faq_content) - 1 ? ',' : '' }}
                    @endforeach
                ]
            }
            @endif
        ]
    }
    </script>
@endif


{{-- ================= CATEGORY / SUBCATEGORY VALIDATED GRAPH SCHEMA ================= --}}
@if (Route::is('products.category') || Route::is('products.subcategory'))
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@graph": [
            {
                "@type": "BreadcrumbList",
                "itemListElement": [
                    {
                        "@type": "ListItem",
                        "position": 1,
                        "name": "Home",
                        "item": "{{ url('/') }}"
                    }
                    @if(isset($category))
                    ,{
                        "@type": "ListItem",
                        "position": 2,
                        "name": {!! json_encode($category->name, JSON_UNESCAPED_SLASHES) !!},
                        "item": "{{ route('products.category', $category->slug) }}"
                    }
                    @endif
                    @if(Route::is('products.subcategory') && isset($subCategory))
                    ,{
                        "@type": "ListItem",
                        "position": 3,
                        "name": {!! json_encode($subCategory->name, JSON_UNESCAPED_SLASHES) !!},
                        "item": "{{ url()->current() }}"
                    }
                    @endif
                ]
            },
            {
                "@type": "CollectionPage",
                "name": {!! json_encode(isset($subCategory) ? $subCategory->name : ($category->name ?? 'Collection'), JSON_UNESCAPED_SLASHES) !!},
                "url": "{{ url()->current() }}",
                "description": {!! json_encode(isset($subCategory) ? ($subCategory->meta_description ?? '') : ($category->meta_description ?? ''), JSON_UNESCAPED_SLASHES) !!},
                "mainEntity": {
                    "@type": "ItemList",
                    "numberOfItems": {{ isset($products) ? count($products) : 0 }},
                    "itemListElement": [
                        @if(isset($products) && count($products) > 0)
                            @foreach($products as $index => $prod)
                            {
                                "@type": "ListItem",
                                "position": {{ $index + 1 }},
                                "image": "{!! asset($prod->main_image ?? $prod->product_main_image) !!}",
                                "name": {!! json_encode($prod->name, JSON_UNESCAPED_SLASHES) !!},
                                "url": "{!! route('product.detail', $prod->slug ?? $prod->id) !!}"
                            }{{ $index < count($products) - 1 ? ',' : '' }}
                            @endforeach
                        @endif
                    ]
                }
            }
        ]
    }
    </script>
@endif


{{-- ================= HOME PAGE ADVANCED CONNECTED GRAPH SCHEMA ================= --}}
@if (Route::is('home') || request()->path() === '/')
    @php
        // 🚀 ऑन-द-स्पॉट होम पेज के FAQs निकालो बिना किसी नीचे वाले ब्लॉक पर निर्भर रहे
        $homeFaqs = (isset($homeSettings) && !empty($homeSettings->faq_content)) ? $homeSettings->faq_content : [];
    @endphp
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@graph": [
            {
                "@type": "Organization",
                "@id": "{{ url('/') }}#organization",
                "name": "Suyagya",
                "url": "{{ url('/') }}",
                "logo": {
                    "@type": "ImageObject",
                    "url": "{{ asset('assets/images/logo.png') }}"
                },
                "contactPoint": {
                    "@type": "ContactPoint",
                    "telephone": "+91-7692005006",
                    "contactType": "customer service"
                },
                "sameAs": [
                    "https://www.facebook.com/mysuyagya",
                    "https://www.instagram.com/mysuyagya/reels/"
                ]
            },
            {
                "@type": "WebSite",
                "@id": "{{ url('/') }}#website",
                "name": "Suyagya",
                "url": "{{ url('/') }}",
                "publisher": {
                    "@id": "{{ url('/') }}#organization"
                }
            }
            {{-- 🚀 लाइव फिक्स: अब $homeFaqs सीधे डेटाबेस से रेंडर होगा बिना अटके --}}
            @if(!empty($homeFaqs))
            ,{
                "@type": "FAQPage",
                "@id": "{{ url('/') }}#faq",
                "mainEntity": [
                    @foreach($homeFaqs as $index => $faq)
                    {
                        "@type": "Question",
                        "name": {!! json_encode(trim($faq['question']), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!},
                        "acceptedAnswer": {
                            "@type": "Answer",
                            "text": {!! json_encode(trim(str_replace(["\r", "\n"], " ", strip_tags($faq['answer']))), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
                        }
                    }{{ $index < count($homeFaqs) - 1 ? ',' : '' }}
                    @endforeach
                ]
            }
            @endif
        ]
    }
    </script>
@endif


{{-- ================= SINGLE BLOG DETAIL ADVANCED GRAPH SCHEMA ================= --}}
@if (Route::is('blogs.show') && isset($blog))
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@graph": [
            {
                "@type": "BlogPosting",
                "@id": "{!! url()->current() !!}#article",
                "headline": {!! json_encode($blog->title, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!},
                "image": [
                    "{!! asset($blog->main_image) !!}"
                ],
                "datePublished": "{{ $blog->created_at->toIso8601String() }}",
                "dateModified": "{{ $blog->updated_at->toIso8601String() }}",
                "author": {
                    "@type": "Organization",
                    "name": "Suyagya",
                    "url": "{{ url('/') }}"
                },
                "publisher": {
                    "@type": "Organization",
                    "name": "Suyagya",
                    "logo": {
                        "@type": "ImageObject",
                        "url": "{{ asset('assets/images/logo.png') }}"
                    }
                },
                "description": {!! json_encode($blog->meta_description ?? Str::limit(strip_tags($blog->content), 160), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!},
                "mainEntityOfPage": "{!! url()->current() !!}"
                @if(!empty($blog->faqs))
                ,"mainEntity": {
                    "@id": "{!! url()->current() !!}#faq"
                }
                @endif
            }
            @if(!empty($blog->faqs))
            ,{
                "@type": "FAQPage",
                "@id": "{!! url()->current() !!}#faq",
                "mainEntity": [
                    @foreach($blog->faqs as $index => $faq)
                    {
                        "@type": "Question",
                        "name": {!! json_encode($faq['question'], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!},
                        "acceptedAnswer": {
                            "@type": "Answer",
                            "text": {!! json_encode(strip_tags($faq['answer']), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
                        }
                    }{{ $index < count($blog->faqs) - 1 ? ',' : '' }}
                    @endforeach
                ]
            }
            @endif
        ]
    }
    </script>
@endif

{{-- ================= BLOG LISTING PAGE ADVANCED AI SCHEMA (FINAL CLEAN) ================= --}}
@if (Route::is('blogs.index') && isset($blogs))
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@graph": [
            {
                "@type": "BreadcrumbList",
                "itemListElement": [
                    {
                        "@type": "ListItem",
                        "position": 1,
                        "name": "Home",
                        "item": "{{ url('/') }}"
                    },
                    {
                        "@type": "ListItem",
                        "position": 2,
                        "name": "Blogs",
                        "item": "{{ url()->current() }}"
                    }
                ]
            },
            {
                "@type": "Blog",
                "@id": "{!! url()->current() !!}#blog-hub",
                "name": "Suyagya Spiritual & Gemstone Blogs",
                "url": "{!! url()->current() !!}",
                "description": "Read latest articles on Rudraksha, Gemstones, and spirituality. Gain knowledge and insights from our experts.",
                "publisher": {
                    "@type": "Organization",
                    "name": "Suyagya",
                    "logo": {
                        "@type": "ImageObject",
                        "url": "{{ asset('assets/images/logo.png') }}"
                    }
                },
                "mainEntity": {
                    "@type": "ItemList",
                    "numberOfItems": {{ count($blogs) }},
                    "itemListElement": [
                        @foreach($blogs as $index => $b)
                        {
                            "@type": "ListItem",
                            "position": {{ $index + 1 }},
                            "url": "{!! route('blogs.show', $b->slug ?? $b->id) !!}",
                            "name": {!! json_encode($b->title, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!},
                            "image": "{!! asset($b->main_image ?? $b->og_image) !!}",
                            "headline": {!! json_encode($b->title, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!},
                            "datePublished": "{{ \Carbon\Carbon::parse($b->created_at)->toIso8601String() }}"
                        }{{ $index < count($blogs) - 1 ? ',' : '' }}
                        @endforeach
                    ]
                }
            }
        ]
    }
    </script>
@endif


{{-- ================= FAQ SCHEMA ================= --}}
@php
    $pageFaqs = [];

    if (Route::is('product.detail') && isset($product) && !empty($product->faq_content)) {
        $pageFaqs = $product->faq_content;
    } elseif (
        (Route::is('home') || request()->path() === '/') &&
        isset($homeSettings) &&
        !empty($homeSettings->faq_content)
    ) {
        $pageFaqs = $homeSettings->faq_content;
    } elseif (Route::is('frontend.faq')) {
        // 1. Home Page Settings (Brand FAQs) add karein
        if (isset($homeSettings) && !empty($homeSettings->faq_content)) {
            foreach ($homeSettings->faq_content as $h_faq) {
                $pageFaqs[] = ['question' => $h_faq['question'], 'answer' => $h_faq['answer']];
            }
        }

        // 2. General FAQs (Shipping, Returns, etc.) add karein
        if (isset($generalFaqs)) {
            foreach ($generalFaqs as $g_faq) {
                $pageFaqs[] = ['question' => $g_faq->question, 'answer' => $g_faq->answer];
            }
        }

        // 3. Product FAQs add karein
        if (isset($productsWithFaqs)) {
            foreach ($productsWithFaqs as $p_prod) {
                if (!empty($p_prod->faq_content)) {
                    foreach ($p_prod->faq_content as $p_faq) {
                        $pageFaqs[] = ['question' => $p_faq['question'], 'answer' => $p_faq['answer']];
                    }
                }
            }
        }
    }
@endphp

{{-- ================= GENERAL FAQ SCHEMA (EXCLUDING HOME & PRODUCT) ================= --}}
@if (!empty($pageFaqs) && !Route::is('product.detail') && !Route::is('home') && request()->path() !== '/')
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "FAQPage",
        "mainEntity": [
            @foreach($pageFaqs as $index => $faq)
            {
                "@type": "Question",
                "name": {!! json_encode($faq['question'], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!},
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": {!! json_encode(strip_tags($faq['answer']), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
                }
            }{{ $index < count($pageFaqs) - 1 ? ',' : '' }}
            @endforeach
        ]
    }
    </script>
@endif
