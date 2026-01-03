<script type="application/ld+json">
{{-- 🔥 1. PRODUCT PAGE SCHEMA (Only on Product Detail Route) --}}
@if(Route::is('product.detail') && isset($product))
{
  "@context": "https://schema.org/",
  "@type": "Product",
  "name": "{{ $product->name }}",
  "image": [
    "{{ asset($product->main_image) }}"
    @if($product->images && count($product->images) > 0)
        @foreach($product->images as $img)
            ,"{{ asset($img['image']) }}"
        @endforeach
    @endif
   ],
  "description": "{{ Str::limit(strip_tags($product->description), 160) }}",
  "sku": "{{ $product->sku ?? $product->id }}",
  "brand": {
    "@type": "Brand",
    "name": "Suyagya"
  },
  "offers": {
    "@type": "Offer",
    "url": "{{ url()->current() }}",
    "priceCurrency": "INR",
    "price": "{{ $product->price }}",
    "priceValidUntil": "{{ date('Y-12-31') }}",
    "itemCondition": "https://schema.org/NewCondition",
    "availability": "{{ $product->quantity > 0 ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock' }}",
    "seller": {
      "@type": "Organization",
      "name": "Suyagya"
    }
  },
  @if(isset($totalReviews) && $totalReviews > 0)
  "aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "{{ $averageRating }}",
    "reviewCount": "{{ $totalReviews }}"
  }
  @endif
}

{{-- 📂 2. CATEGORY PAGE SCHEMA --}}
@elseif(Route::is('products.category') || Route::is('products.subcategory'))
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [{
    "@type": "ListItem",
    "position": 1,
    "name": "Home",
    "item": "{{ url('/') }}"
  }
  @if(isset($category))
  ,{
    "@type": "ListItem",
    "position": 2,
    "name": "{{ $category->name }}",
    "item": "{{ url()->current() }}"
  }
  @endif
  ]
}

{{-- 🏠 3. HOME PAGE SCHEMA --}}
@elseif(request()->path() == '/' || Route::is('home'))
{
  "@context": "https://schema.org",
  "@type": "Organization",
  "name": "Suyagya",
  "url": "{{ url('/') }}",
  "logo": "{{ asset('assets/images/logo.png') }}",
  "contactPoint": {
    "@type": "ContactPoint",
    "telephone": "+91-7692005006",
    "contactType": "customer service"
  },
  "sameAs": [
    "https://www.facebook.com/suyagya",
    "https://www.instagram.com/suyagya"
  ]
},
{
  "@context": "https://schema.org",
  "@type": "WebSite",
  "name": "Suyagya",
  "url": "{{ url('/') }}",
  "potentialAction": {
    "@type": "SearchAction",
    "target": "{{ url('/search?q={search_term_string}') }}",
    "query-input": "required name=search_term_string"
  }
}
@endif
</script>

{{-- ❓ 4. FAQ SCHEMA --}}
@php
    $pageFaqs = [];
    // Only show Product FAQs on Product Detail Page
    if(Route::is('product.detail') && isset($product) && !empty($product->faq_content)) {
        $pageFaqs = $product->faq_content;
    }
    // Only show Brand FAQs on Home Page
    elseif((request()->path() == '/' || Route::is('home')) && isset($homeSettings) && !empty($homeSettings->faq_content)) {
        $pageFaqs = $homeSettings->faq_content;
    }
@endphp

@if(!empty($pageFaqs) && count($pageFaqs) > 0)
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    @foreach($pageFaqs as $index => $faq)
    {
      "@type": "Question",
      "name": "{{ $faq['question'] }}",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "{{ strip_tags($faq['answer']) }}"
      }
    }{{ $index < count($pageFaqs) - 1 ? ',' : '' }}
    @endforeach
  ]
}
</script>
@endif
