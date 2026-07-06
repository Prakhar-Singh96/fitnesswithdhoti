@extends('frontend.layouts.app')

@section('styles')
<style>
    /* ✨ Vardhiyas Policy Page Styles */
    .policy-header {
        background-color: #f9f9f9;
        padding: 50px 0;
        text-align: center;
        margin-bottom: 40px;
        border-bottom: 1px solid #eaeaea;
    }

    .policy-header h1 {
        font-family: 'Inter', sans-serif;
        font-weight: 700;
        color: #222;
        font-size: 28px;
        letter-spacing: 0.5px;
    }

    .policy-section {
        margin-bottom: 45px;
    }

    .policy-title {
        font-family: 'Inter', sans-serif;
        font-weight: 700;
        font-size: 1.1rem;
        color: #111;
        margin-bottom: 15px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .policy-text {
        color: #4a4a4a;
        font-size: 15px;
        line-height: 1.7;
        margin-bottom: 15px;
    }

    .custom-list {
        list-style: none;
        padding-left: 0;
    }

    .custom-list li {
        position: relative;
        padding-left: 20px;
        margin-bottom: 10px;
        color: #4a4a4a;
        font-size: 15px;
        line-height: 1.6;
    }

    /* Small dark dot for bullets */
    .custom-list li::before {
        content: '•';
        position: absolute;
        left: 0;
        color: #222;
        font-size: 20px;
        line-height: 1;
        top: -2px;
    }

    /* Info Box Note */
    .note-box {
        background-color: #fcfcfc;
        border-left: 4px solid #7b7b7b;
        padding: 15px 20px;
        font-size: 14px;
        color: #555;
        margin-top: 15px;
        margin-bottom: 25px;
    }

    .link-highlight {
        color: #1a73e8;
        text-decoration: none;
        font-weight: 500;
    }

    .link-highlight:hover {
        text-decoration: underline;
    }

    /* Minimalist Contact Footer */
    .contact-footer {
        background-color: #111;
        color: #fff;
        padding: 40px;
        border-radius: 8px;
        text-align: center;
        margin-top: 50px;
    }
    .contact-footer a { color: #fff; text-decoration: underline; }
</style>
@endsection

@section('content')

{{-- 📜 Header --}}
<section class="policy-header">
    <div class="container">
        <h1>Shipping & Returns / Exchanges</h1>
    </div>
</section>

<div class="container pb-5" style="max-width: 900px;">

    <div class="d-flex gap-4 mb-5 text-muted small fw-bold">
        <a href="#return-exchange" class="text-decoration-none text-dark">RETURN / EXCHANGE</a>
        <a href="{{ route('track.order') }}" class="text-decoration-none text-dark">TRACK ORDER</a>
    </div>

    {{-- 7-Days Free Return & Exchanges --}}
    <div class="policy-section" id="return-exchange">
        <h3 class="policy-title">7-Days Free Return & Exchanges</h3>
        <ul class="custom-list">
            <li>Vardhiyas products are eligible for return / exchange within <strong>7 days of delivery</strong>.</li>
            <li>There are NO CHARGES to exchange the products. It's on us!</li>
        </ul>
        <p class="policy-text mt-3">
            To initiate Return / Exchange, you can <a href="{{ route('contact') }}" class="link-highlight">raise the request here</a>.
        </p>
    </div>

    {{-- Offline Store Exchange Policy --}}
    <div class="policy-section">
        <h3 class="policy-title">Offline Store Exchange Policy</h3>
        <ul class="custom-list">
            <li>Products purchased from Vardhiyas offline stores are eligible for exchange within <strong>15 days of purchase</strong>.</li>
            <li>No returns or refunds are applicable for offline store purchases.</li>
        </ul>
    </div>

    {{-- Same-Day Refund / Exchange Process --}}
    <div class="policy-section">
        <h3 class="policy-title">Same-Day Refund / Exchange Process</h3>
        <ul class="custom-list">
            <li>Once the return / exchange request is verified by our support team, reverse pickup will be initiated within 24 hours.</li>
            <li>The product will be picked up by our courier partner within the next 1-2 days.</li>
            <li>As soon as the product is picked up, <strong>the refund / exchange will be initiated on the same day</strong>.</li>
        </ul>

        <div class="note-box">
            <strong>Note:</strong> The courier can refuse the pickup if the original tags are not intact OR where it's obvious that the item has been worn, washed, or soiled.
        </div>

        <p class="policy-text mb-1"><strong>Prepaid Returns:</strong> The entire amount will be refunded back to your original payment mode.</p>
        <p class="policy-text"><strong>Cash On Delivery:</strong> The refund will be initiated to the bank account that is provided by you at the time of raising the request.</p>
    </div>

    {{-- Self-Ship Process --}}
    <div class="policy-section">
        <h3 class="policy-title">Self-Ship Process</h3>
        <ul class="custom-list">
            <li>If the reverse pickup service to your pin code is not available, we would ask you to self-ship the product back to Vardhiyas.</li>
            <li>Please pack the items securely to prevent any loss or damage during transit. All items must be in unused condition with all original tags attached.</li>
        </ul>
        <p class="policy-text mt-3">
            • Courier the product(s) to the address: <strong>K-348/7, Saurabh Vihar, Jaitpur, near Vijay Modern Public School, Badarpur, DELHI, Delhi, India - 110044.</strong>.
        </p>
        <p class="policy-text">
            Within 48 hours of receiving the product(s), the complete amount + INR 100 (in lieu of courier charges) will be refunded to your bank account.
        </p>
    </div>

    {{-- Exchange For Something Else --}}
    <div class="policy-section">
        <h3 class="policy-title">Exchange For Something Else</h3>
        <p class="policy-text">
            You can also exchange original product with a different product. If the value of the replacement product exceeds that of the previously purchased product, you can pay just the difference. Else if it's less, the same can be refunded to you as a gift card or to your bank account.
        </p>
    </div>

    {{-- Refund Issues --}}
    <div class="policy-section">
        <p class="policy-text mb-2">What should I do if I do not receive my refund?</p>
        <ul class="custom-list">
            <li>We will update you via email / sms once the refund is initiated.</li>
            <li>Bank refunds for prepaid orders will take 5-7 business days.</li>
            <li>If you face any issues, please <a href="{{ route('contact') }}" class="link-highlight">reach us out here</a> and our support team will help you out.</li>
        </ul>
    </div>

    <hr class="my-5" style="border-color: #ddd;">

    {{-- SHIPPING POLICY --}}
    <div class="policy-section">
        <h3 class="policy-title mb-4" style="font-size: 1.3rem;">SHIPPING</h3>

        <h4 class="fw-bold mb-2" style="font-size: 1rem;">Shipping Rates</h4>
        <ul class="custom-list mb-4">
            <li>We offer free shipping across India for all prepaid orders. For COD orders, a nominal charge is applicable depending on the location.</li>
        </ul>

        <h4 class="fw-bold mb-2" style="font-size: 1rem;">Order Processing</h4>
        <ul class="custom-list mb-4">
            <li>We strive to fulfill orders as soon as you place them. In most cases, your order will be expected to be dispatched within 1-2 business days. Our business days are Monday-Saturday.</li>
        </ul>

        <h4 class="fw-bold mb-2" style="font-size: 1rem;">Shipping Time</h4>
        <ul class="custom-list mb-4">
            <li>For most serviceable pin codes, we try to deliver within 5 days. There could be a possible delay of 2-3 business days in delivery. However, you will be able to track your package using a unique tracking link that we will email/SMS you after your order is sent to our delivery partner.</li>
        </ul>

        <h4 class="fw-bold mb-2" style="font-size: 1rem;">Order Tracking</h4>
        <ul class="custom-list">
            <li>You'll receive a tracking number from us in your inbox as soon as it ships! Orders can be tracked in real-time via this link - <a href="{{ route('track.order') }}" class="link-highlight">Track Order</a></li>
        </ul>
    </div>

    {{-- 📞 Contact Footer --}}
    <div class="contact-footer">
        <h3 class="fw-bold mb-2" style="font-size: 1.2rem;">Still have questions?</h3>
        <p class="mb-4" style="color: rgba(255,255,255,0.7);">Our support team is here to help you.</p>
        <div class="d-flex justify-content-center gap-4 flex-wrap">
            <div>
                <i class="las la-envelope fs-4 mb-1"></i><br>
                <a href="mailto:support@vardhiyas.com">support@vardhiyas.com</a>
            </div>
        </div>
    </div>

</div>

@endsection
