@extends('frontend.layouts.app')

@section('styles')
<style>
    /* ✨ Vardhiyas Terms Page Styles */
    .terms-header {
        background-color: #f9f9f9;
        padding: 50px 0;
        text-align: center;
        margin-bottom: 40px;
        border-bottom: 1px solid #eaeaea;
    }

    .terms-header h1 {
        font-family: 'Inter', sans-serif;
        font-weight: 700;
        color: #222;
        font-size: 28px;
        letter-spacing: 0.5px;
    }

    .terms-content {
        max-width: 900px;
        margin: 0 auto;
    }

    .section-title {
        font-family: 'Inter', sans-serif;
        font-weight: 700;
        font-size: 1.1rem;
        color: #111;
        margin-bottom: 15px;
        margin-top: 35px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .terms-text {
        color: #4a4a4a;
        font-size: 14px;
        line-height: 1.7;
        margin-bottom: 15px;
    }

    .terms-text strong {
        color: #222;
    }

    .terms-list {
        list-style-type: decimal;
        padding-left: 20px;
        color: #4a4a4a;
        font-size: 14px;
        line-height: 1.7;
        margin-bottom: 20px;
    }

    .terms-list li {
        margin-bottom: 10px;
    }

    .contact-footer {
        background-color: #111;
        color: #fff;
        padding: 40px;
        border-radius: 8px;
        text-align: center;
        margin-top: 50px;
    }

    .contact-footer a { color: #fff; text-decoration: underline; }

    .last-updated {
        font-size: 0.85rem;
        color: #888;
        margin-bottom: 30px;
    }
</style>
@endsection

@section('content')

{{-- 📜 Header Section --}}
<section class="terms-header">
    <div class="container">
        <h1>Terms of Service</h1>
    </div>
</section>

<div class="container pb-5">

    <div class="terms-content">

        <div class="last-updated fw-bold">
            OVERVIEW
        </div>

        <p class="terms-text">
            This website is operated by Vardhiyas. Throughout the site, the terms "we", "us" and "our" refer to Vardhiyas. Vardhiyas offers this website, including all information, tools, and services available from this site to you, the user, conditioned upon your acceptance of all terms, conditions, policies, and notices stated here.
        </p>

        <p class="terms-text">
            By visiting our site and/or purchasing something from us, you engage in our "Service" and agree to be bound by the following terms and conditions ("Terms of Service", "Terms"), including those additional terms and conditions and policies referenced herein and/or available by hyperlink.
        </p>

        <p class="terms-text">
            Any new features or tools which are added to the current store shall also be subject to the Terms of Service. You can review the most current version of the Terms of Service at any time on this page.
        </p>

        <h2 class="section-title">SECTION 1 - ONLINE STORE TERMS</h2>
        <p class="terms-text">
            By agreeing to these Terms of Service, you represent that you are at least the age of majority in your state or province of residence. You may not use our products for any illegal or unauthorized purpose nor may you, in the use of the Service, violate any laws in your jurisdiction (including but not limited to copyright laws).
        </p>

        <h2 class="section-title">SECTION 2 - GENERAL CONDITIONS</h2>
        <p class="terms-text">
            We reserve the right to refuse service to anyone for any reason at any time. You understand that your content (not including credit card information), may be transferred unencrypted and involve (a) transmissions over various networks; and (b) changes to conform and adapt to technical requirements of connecting networks or devices.
        </p>

        <h2 class="section-title">SECTION 3 - ACCURACY, COMPLETENESS AND TIMELINESS OF INFORMATION</h2>
        <p class="terms-text">
            We are not responsible if information made available on this site is not accurate, complete or current. The material on this site is provided for general information only and should not be relied upon or used as the sole basis for making decisions without consulting primary, more accurate, more complete or more timely sources of information.
        </p>

        <h2 class="section-title">SECTION 4 - MODIFICATIONS TO THE SERVICE AND PRICES</h2>
        <p class="terms-text">
            Prices for our products are subject to change without notice. We reserve the right at any time to modify or discontinue the Service (or any part or content thereof) without notice at any time.
        </p>

        <h2 class="section-title">SECTION 5 - PRODUCTS OR SERVICES</h2>
        <p class="terms-text">
            Certain products or services may be available exclusively online through the website. These products or services may have limited quantities and are subject to return or exchange only according to our Return Policy.
        </p>
        <p class="terms-text">
            We have made every effort to display as accurately as possible the colors and images of our products that appear at the store. We cannot guarantee that your computer monitor's display of any color will be accurate.
        </p>

        <h2 class="section-title">SECTION 6 - ACCURACY OF BILLING AND ACCOUNT INFORMATION</h2>
        <p class="terms-text">
            We reserve the right to refuse any order you place with us. We may, in our sole discretion, limit or cancel quantities purchased per person, per household or per order. You agree to provide current, complete, and accurate purchase and account information for all purchases made at our store.
        </p>

        <h2 class="section-title">SECTION 7 - OPTIONAL TOOLS</h2>
        <p class="terms-text">
            We may provide you with access to third-party tools over which we neither monitor nor have any control nor input. You acknowledge and agree that we provide access to such tools "as is" and "as available" without any warranties, representations or conditions of any kind.
        </p>

        <h2 class="section-title">SECTION 8 - THIRD-PARTY LINKS</h2>
        <p class="terms-text">
            Certain content, products, and services available via our Service may include materials from third-parties. Third-party links on this site may direct you to third-party websites that are not affiliated with us. We are not responsible for examining or evaluating the content or accuracy.
        </p>

        <h2 class="section-title">SECTION 9 - USER COMMENTS, FEEDBACK AND OTHER SUBMISSIONS</h2>
        <p class="terms-text">
            If, at our request, you send certain specific submissions or without a request from us you send creative ideas, suggestions, proposals, plans, or other materials, you agree that we may, at any time, without restriction, edit, copy, publish, distribute, translate and otherwise use in any medium any comments that you forward to us.
        </p>

        <h2 class="section-title">SECTION 10 - PERSONAL INFORMATION</h2>
        <p class="terms-text">
            Your submission of personal information through the store is governed by our Privacy Policy.
        </p>

        <h2 class="section-title">SECTION 11 - ERRORS, INACCURACIES AND OMISSIONS</h2>
        <p class="terms-text">
            Occasionally there may be information on our site or in the Service that contains typographical errors, inaccuracies or omissions that may relate to product descriptions, pricing, promotions, offers, product shipping charges, transit times and availability. We reserve the right to correct any errors.
        </p>

        <h2 class="section-title">SECTION 12 - PROHIBITED USES</h2>
        <p class="terms-text">In addition to other prohibitions as set forth in the Terms of Service, you are prohibited from using the site or its content:</p>
        <ul class="terms-list">
            <li>For any unlawful purpose;</li>
            <li>To solicit others to perform or participate in any unlawful acts;</li>
            <li>To violate any international, federal, provincial or state regulations, rules, laws, or local ordinances;</li>
            <li>To infringe upon or violate our intellectual property rights or the intellectual property rights of others;</li>
            <li>To submit false or misleading information;</li>
            <li>To upload or transmit viruses or any other type of malicious code.</li>
        </ul>

        <h2 class="section-title">SECTION 13 - DISCLAIMER OF WARRANTIES; LIMITATION OF LIABILITY</h2>
        <p class="terms-text">
            We do not guarantee, represent or warrant that your use of our service will be uninterrupted, timely, secure or error-free. In no case shall Vardhiyas, our directors, officers, employees, affiliates, agents, contractors, interns, suppliers, service providers or licensors be liable for any injury, loss, claim, or any direct, indirect, incidental, punitive, special, or consequential damages of any kind.
        </p>

        <h2 class="section-title">SECTION 14 - INDEMNIFICATION</h2>
        <p class="terms-text">
            You agree to indemnify, defend and hold harmless Vardhiyas and our parent, subsidiaries, affiliates, partners, officers, directors, agents, contractors, licensors, service providers, subcontractors, suppliers, interns and employees, harmless from any claim or demand.
        </p>

        <h2 class="section-title">SECTION 15 - GOVERNING LAW</h2>
        <p class="terms-text">
            These Terms of Service and any separate agreements whereby we provide you Services shall be governed by and construed in accordance with the laws of India.
        </p>

        <h2 class="section-title">SECTION 16 - CONTACT INFORMATION</h2>
        <p class="terms-text">
            Questions about the Terms of Service should be sent to us at <strong>support@vardhiyas.com</strong>.
        </p>

        <hr class="my-5" style="border-color: #ddd;">

        {{-- 📞 Contact Footer --}}
        <div class="contact-footer">
            <h3 class="fw-bold mb-2" style="font-size: 1.2rem;">Need Assistance?</h3>
            <p class="mb-4" style="color: rgba(255,255,255,0.7);">We are here to help you with any queries regarding our terms.</p>
            <div class="d-flex justify-content-center gap-4 flex-wrap">
                <div>
                    <i class="las la-envelope fs-4 mb-1"></i><br>
                    <a href="mailto:support@vardhiyas.com">support@vardhiyas.com</a>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
