@extends('frontend.layouts.app')

@section('content')

<div class="container py-5 text-center">


<div class="mb-4">
    <i class="las la-check-circle text-success" style="font-size:100px;"></i>
</div>

<h1 class="fw-bold text-success">Order Placed Successfully!</h1>

<p class="lead">
    Thank you for your purchase.
</p>

<p>
    Order Number:
    <strong>{{ $order->order_number }}</strong>
</p>

<p>
    Amount Paid:
    <strong>₹{{ number_format($order->total_amount,2) }}</strong>
</p>

<a href="{{ route('user.orders') }}"
   class="btn btn-dark mt-3">
   View My Orders
</a>


</div>

@endsection

@section('scripts')

<script>
fbq('track', 'Purchase', {
    content_ids: [
        @foreach($order->items as $item)
            "{{ $item->product_id }}",
        @endforeach
    ],
    content_type: 'product',
    value: {{ $order->total_amount }},
    currency: 'INR'
});
</script>

@endsection
@section('scripts')
@if(session('show_referral_popup'))
{{-- SweetAlert2 Library --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            title: '<span style="color: #28a745;">🎊 Order Successful!</span>',
            html: `
                <div class="text-center">
                    <p class="mb-3">You've unlocked a special reward!</p>
                    <div class="p-3 mb-3" style="background: #fff8e1; border: 2px dashed #ffb300; border-radius: 12px;">
                        <small class="text-muted d-block mb-1 text-uppercase fw-bold" style="font-size: 10px;">Your Referral Code</small>
                        <h2 class="fw-bold text-primary mb-0" style="letter-spacing: 2px;">{{ session('show_referral_popup') }}</h2>
                    </div>
                    <p class="small text-muted mb-3">इस कोड को अपने दोस्तों के साथ शेयर करें। उनके पहले ऑर्डर पर आपको मिलेंगे <b>25 Coins</b>!</p>
                    <div class="d-flex align-items-center justify-content-center bg-light p-2 rounded-3 mb-3">
                        <i class="las la-wallet fs-4 text-warning me-2"></i>
                        <span class="small fw-bold">1 Coin = ₹1 (Next Order Discount)</span>
                    </div>
                </div>
            `,
            icon: 'success',
            confirmButtonText: '<i class="lab la-whatsapp"></i> Share on WhatsApp',
            confirmButtonColor: '#25D366',
            showCancelButton: true,
            cancelButtonText: 'Close',
            customClass: {
                popup: 'rounded-4'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                let code = "{{ session('show_referral_popup') }}";
                let shareText = `Hey! I just shopped from Suyagya. Use my code *${code}* on your purchase to get exclusive benefits! 🛍️✨\nCheck here: ${window.location.origin}`;
                window.open(`https://wa.me/?text=${encodeURIComponent(shareText)}`, '_blank');
            }
        });
    });
</script>
@endif
@endsection
