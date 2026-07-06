@extends('frontend.layouts.app')

@section('styles')
<style>
    /* ✨ Vardhiyas Privacy Policy Page Styles */
    .privacy-header {
        background-color: #f9f9f9;
        padding: 50px 0;
        text-align: center;
        margin-bottom: 40px;
        border-bottom: 1px solid #eaeaea;
    }

    .privacy-header h1 {
        font-family: 'Inter', sans-serif;
        font-weight: 700;
        color: #222;
        font-size: 28px;
        letter-spacing: 0.5px;
    }

    .privacy-content {
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

    .policy-text {
        color: #4a4a4a;
        font-size: 14px;
        line-height: 1.7;
        margin-bottom: 15px;
    }

    .policy-text strong {
        color: #222;
    }

    .custom-list {
        list-style: none;
        padding-left: 0;
        margin-bottom: 20px;
    }

    .custom-list li {
        position: relative;
        padding-left: 20px;
        margin-bottom: 10px;
        color: #4a4a4a;
        font-size: 14px;
        line-height: 1.6;
    }

    .custom-list li::before {
        content: '•';
        position: absolute;
        left: 0;
        color: #222;
        font-size: 20px;
        line-height: 1;
        top: -2px;
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

    .last-updated {
        font-size: 0.85rem;
        color: #888;
        margin-bottom: 30px;
    }

    .grievance-box {
        background-color: #fcfcfc;
        border: 1px solid #eaeaea;
        padding: 20px;
        border-radius: 6px;
        margin-top: 15px;
    }
</style>
@endsection

@section('content')

{{-- 📜 Header --}}
<section class="privacy-header">
    <div class="container">
        <h1>Privacy Policy</h1>
    </div>
</section>

<div class="container pb-5">

    <div class="privacy-content">

        <p class="policy-text">
            Vardhiyas ("we/us/our") respects the privacy of our customers and users of our website ("you"). Our practices and procedures in relation to the collection and use of your data/information have been set out below in this privacy policy. This privacy policy will familiarize you with the manner in which we may collect, use, share, transfer and disclose your data/information.
        </p>

        <p class="policy-text">
            We collect only the information necessary for our business purposes such as to provide you with services, complete your order or to contact you regarding the status of your order.
        </p>

        <p class="policy-text">
            For the purpose of this privacy policy, sensitive personal data or information of a person ("SPDI") is as defined under the Information Technology Act 2000 ("IT Act") and the Information Technology (Reasonable Security Practices and Procedures and Sensitive Personal Information) Rules 2011 ("SPDI Rules"). Please note that usage of the term Personal Information in this Privacy Policy includes Sensitive Personal Data or Information, wherever appropriate and/or mandated under the IT Act and the SPDI Rules.
        </p>

        <ul class="custom-list">
            <li>We do not store your credit card or online bank account information.</li>
            <li>We will not rent or sell your name or personal information.</li>
            <li>We utilize "cookies" to help recognize you as a repeat visitor and to track traffic patterns on our site. This information is completely anonymous. We use this information only to improve the user-friendliness and functionality of our website.</li>
        </ul>

        <p class="policy-text">
            By providing your consent to this privacy policy, you agree to the collection, use and transfer of your personal information as set out in this privacy policy. We reserve the right to update this privacy policy at any time. Updates to our privacy policy will be sent to the email address that you have provided us.
        </p>

        <h2 class="section-title">COLLECTION OF PERSONAL INFORMATION</h2>
        <p class="policy-text">
            We collect personal information from you when you provide it to us. For example, if you purchase a product from us, we may collect your name, mailing address, telephone number and email address. If you sign up to receive a newsletter, we will collect your email address. If you take advantage of special services offered by us, we may collect other personal information about you. We use your personal information for internal purposes such as processing and keeping you informed of your order. We reserve the right to collect general demographic and other anonymous information that does not personally identify you. This information is not associated with your personally identifiable information and cannot be linked to you personally. The information we collect also includes your shipping address, and billing address.
        </p>
        <p class="policy-text">
            You represent that the personal information you provide from time to time is correct and updated and you have all the rights, permissions and consents to provide the same.
        </p>

        <h2 class="section-title">USE AND PROCESSING OF PERSONAL INFORMATION</h2>
        <p class="policy-text mb-2">The personal information collected by us may be used for a number of purposes connected with our business operations which may include the following:</p>
        <ul class="custom-list">
            <li>To deal with requests, enquiries and complaints, customer services and related activities;</li>
            <li>To respond to your queries and fulfil your requests for information regarding our products and services;</li>
            <li>To customize our offerings for you;</li>
            <li>To analyse user trends and help improve our offerings;</li>
            <li>To notify you about our new products or services and for sending you important information regarding our products or services;</li>
            <li>For legitimate business purposes; and</li>
            <li>To respond to judicial process and for providing information to law enforcement agencies or as permitted by law.</li>
        </ul>

        <h2 class="section-title">DISCLOSURE OF PERSONAL INFORMATION</h2>
        <p class="policy-text">
            Under no circumstances do we rent, trade or share your personal information that we have collected with any other company for their marketing purposes without your consent. We reserve the right to communicate your personal information to any third party that makes a legally compliant request for its disclosure. Otherwise, we will not disclose your name, address and other information which identifies you personally to any third party without your consent. However, in case of a situation wherein we are obliged to comply with law or a statutory obligation or a legal process, we would be compelled to provide information about a customer. We may also disclose or transfer your personal information to another third party as a part of reorganization or a sale of the assets or our business to such third party. Such third party will have the right to continue to use the personal information provided to us. We may also share your personal information with our group companies, affiliates and third parties for the purposes set out under this privacy policy.
        </p>

        <ul class="custom-list mt-3">
            <li><strong>Why are COOKIES important:</strong> We use cookies and other technologies such as pixel tags and clear gifs to store certain types of information each time you visit any page on our website. Cookies enable this website to recognize the information you have consented to give to this website and help us determine what portions of this website are most appropriate for your professional needs. We may also use cookies to serve advertising banners to you. These banners may be served by us or by a third party on our behalf. These cookies will not contain any personal information.</li>
            <li class="mt-3"><strong>OPT OUT of setting website cookie on users' browsers:</strong> Whether you want your web browser to accept cookies or not is up to you. If you have not changed your computer's settings, most likely your browser already accepts cookies. If you choose to decline cookies, you may not be able to fully experience all features of the website. You can also delete your browser cookies or disable them entirely. But this may significantly impact your experience with our website and may make parts of our website non-functional or inaccessible. We recommend that you leave them turned on.</li>
            <li class="mt-3"><strong>NPI advertising:</strong> We use third-party service providers to serve ads on our behalf across the internet and sometimes on this site. They may collect anonymous information about your visits to our website, and your interaction with our products and services. They may also use information about your visits to this and other websites to target advertisements for goods and services. This anonymous information is collected through the use of a pixel tag, which is industry standard technology used by most major websites. No personally identifiable information is collected or used in this process. They do not know the name, phone number, address, email address, or any personally identifying information about the user.</li>
        </ul>

        <h2 class="section-title">INFORMATION PROVIDER'S RIGHTS</h2>
        <p class="policy-text">
            You have the right to withdraw your consent for SPDI provided at any time by sending an e-mail to us at <a href="mailto:support@vardhiyas.com" class="link-highlight">support@vardhiyas.com</a>, in accordance with the terms of this privacy policy. However, please note that withdrawal of consent will not be retrospective in nature and shall be applicable prospectively. In case you do not provide your information or consent for usage of SPDI or subsequently withdraw your consent for usage of the SPDI so collected, we reserve the right to discontinue the services for which the said SPDI was sought.
        </p>
        <p class="policy-text">
            You may write to us at <a href="mailto:support@vardhiyas.com" class="link-highlight">support@vardhiyas.com</a> to access, review, modify or correct your SPDI or withdraw your consent to provide SPDI. However, we are not responsible for the authenticity of the SPDI provided by you.
        </p>
        <p class="policy-text">
            You agree and acknowledge that certain data or information may not be corrected or is prohibited to be modified as required under any applicable law, law enforcement requests or under any judicial proceedings. In respect to such data or information, the aforementioned rights will not be available.
        </p>

        <h2 class="section-title">SECURITY PRACTICES AND PROCEDURES</h2>
        <p class="policy-text">
            We use reasonable security measures, to safeguard and protect your SPDI. We may enter into agreements with third parties (in or outside of India) to store your information or data. These third parties may have their own security standards to safeguard your information or data and we will, on a commercial reasonable basis, require such third parties to adopt reasonable security standards to safeguard your information or data. Notwithstanding anything contained in this privacy policy or elsewhere, we shall not be held responsible for any loss, damage or misuse of your data or information, if such loss, damage or misuse is attributable to a Force Majeure Event. A "Force Majeure Event" shall mean any event that is beyond our reasonable control and shall include, without limitation, sabotage, fire, flood, explosion, acts of God, civil commotion, strikes or industrial action of any kind, riots, insurrection, war, acts of government, computer hacking, unauthorized access to computer data and storage device, computer crashes, breach of security and encryption, etc.
        </p>

        <h2 class="section-title">GRIEVANCE REDRESSAL</h2>
        <p class="policy-text">
            Any discrepancies and grievances with respect to processing of SPDI shall be informed to the designated Grievance Officer under the IT Act as mentioned below:
        </p>

        <div class="grievance-box">
            <div class="row">
                <div class="col-4 col-md-3 fw-bold text-dark">Name</div>
                <div class="col-8 col-md-9 text-muted">: <span class="text-dark">Support Team</span></div>

                <div class="col-4 col-md-3 fw-bold text-dark mt-2">Designation</div>
                <div class="col-8 col-md-9 text-muted mt-2">: <span class="text-dark">Customer Support Head</span></div>

                <div class="col-4 col-md-3 fw-bold text-dark mt-2">Email ID</div>
                <div class="col-8 col-md-9 text-muted mt-2">: <a href="mailto:support@vardhiyas.com" class="link-highlight">support@vardhiyas.com</a></div>
            </div>
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
</div>

@endsection
