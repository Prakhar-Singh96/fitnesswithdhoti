{{-- ================= PRODUCT PAGE SCHEMA ================= --}}
@if(Route::is('product.detail') && isset($product))
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Product",
  "name": @json($product->name),
  "image": [
    @json(asset($product->main_image))
    @if(!empty($product->images))
      @foreach($product->images as $img)
        ,@json(asset($img['image']))
      @endforeach
    @endif
  ],
  "description": @json(Str::limit(strip_tags($product->description), 160)),
  "sku": @json($product->sku ?? $product->id),
  "brand": {
    "@type": "Brand",
    "name": "Suyagya"
  },
  "offers": {
    "@type": "Offer",
    "url": @json(url()->current()),
    "priceCurrency": "INR",
    "price": @json($product->price),
    "availability": "{{ $product->quantity > 0 ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock' }}",
    "itemCondition": "https://schema.org/NewCondition"
  }
}
</script>
@endif


{{-- ================= CATEGORY / SUBCATEGORY BREADCRUMB ================= --}}
@if(Route::is('products.category') || Route::is('products.subcategory'))
<script type="application/ld+json">
{
  "@context": "https://schema.org",
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
      "name": @json($category->name),
      "item": "{{ url()->current() }}"
    }
    @endif
  ]
}
</script>
@endif


{{-- ================= HOME PAGE SCHEMA ================= --}}
@if(Route::is('home') || request()->path() === '/')
<script type="application/ld+json">
[
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
    "url": "{{ url('/') }}"
  }
]
</script>
@endif


{{-- ================= FAQ SCHEMA ================= --}}
@php
  $pageFaqs = [];

  if(Route::is('product.detail') && isset($product) && !empty($product->faq_content)) {
      $pageFaqs = $product->faq_content;
  } elseif((Route::is('home') || request()->path() === '/') && isset($homeSettings) && !empty($homeSettings->faq_content)) {
      $pageFaqs = $homeSettings->faq_content;
  }
@endphp

@if(!empty($pageFaqs))
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    @foreach($pageFaqs as $index => $faq)
    {
      "@type": "Question",
      "name": @json($faq['question']),
      "acceptedAnswer": {
        "@type": "Answer",
        "text": @json(strip_tags($faq['answer']))
      }
    }{{ $index < count($pageFaqs) - 1 ? ',' : '' }}
    @endforeach
  ]
}
</script>
@endif
