<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $isAdmin ? 'New Order' : 'Order Confirmed' }}</title>
    <style>
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; background-color: #f6f6f6; margin: 0; padding: 0; }
        table { border-collapse: collapse; width: 100%; }
        .main-table { max-width: 600px; margin: 20px auto; background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border: 1px solid #e5e5e5; }
        .header { background-color: #7b3f27; padding: 30px; text-align: center; border-bottom: 3px solid #c09867; }
        .content { padding: 30px; }
        .greeting { font-size: 16px; color: #333333; line-height: 1.5; margin-bottom: 20px; }
        .info-box { background-color: #fdfaf4; border-left: 4px solid #c09867; padding: 15px; margin-bottom: 25px; }
        .info-text { font-size: 14px; color: #555555; margin: 5px 0; }
        .section-title { font-size: 15px; font-weight: bold; color: #7b3f27; text-transform: uppercase; letter-spacing: 0.5px; border-bottom: 2px solid #f5f0e6; padding-bottom: 5px; margin-top: 25px; margin-bottom: 15px; }
        .item-th { background-color: #fafafa; color: #7b3f27; font-size: 12px; font-weight: bold; text-transform: uppercase; padding: 12px 10px; border-bottom: 2px solid #eaddca; }
        .item-td { padding: 12px 10px; border-bottom: 1px solid #eeeeee; font-size: 14px; color: #444444; }
        .summary-table { width: 100%; margin-top: 15px; background-color: #fffdf9; border: 1px solid #f1e0c5; border-radius: 6px; }
        .summary-td { padding: 10px 15px; font-size: 14px; color: #555555; }
        .address-box { background-color: #fafafa; border: 1px solid #eeeeee; padding: 15px; border-radius: 6px; font-size: 14px; color: #555555; line-height: 1.5; }
        .footer { background-color: #fafafa; padding: 20px; text-align: center; font-size: 12px; color: #888888; border-top: 1px solid #eeeeee; }
        .footer a { color: #7b3f27; text-decoration: none; font-weight: bold; margin: 0 8px; }
    </style>
</head>
<body>

<table width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="#f6f6f6">
    <tr>
        <td>
            {{-- 📦 मुख्य कंटेनर टेबल (फ्लेक्सबॉक्स की जगह अब केवल शुद्ध HTML टेबल टेबल) --}}
            <table class="main-table" cellpadding="0" cellspacing="0" border="0" align="center" width="600">

                {{-- 🎨 हेडर और ब्रांड लोगो --}}
                <tr>
                    <td class="header">
                        <img src="https://suyagya.com/assets/img/logo.png" alt="Suyagya Logo" width="130" style="display: block; margin: 0 auto 10px auto; max-width: 130px;">
                        <h2 style="color: #ffffff; font-size: 22px; margin: 0; font-weight: bold;">
                            {{ $isAdmin ? 'New Order Notification' : 'Your Order is Confirmed!' }}
                        </h2>
                    </td>
                </tr>

                {{-- 📝 कंटेंट बॉडी --}}
                <tr>
                    <td class="content">
                        <p class="greeting">Hi <b>{{ $isAdmin ? 'Admin' : ($order->shipping_address['name'] ?? 'Customer') }}</b>,</p>

                        @if($isAdmin)
                            <p class="info-text" style="font-size:15px; margin-bottom: 20px;">A new order has been successfully captured on the website. Below are the execution and billing details:</p>
                        @else
                            <p class="info-text" style="font-size:15px; margin-bottom: 20px;">Thank you for your purchase from Suyagya Store! Your spiritual items are now being prepared for safe shipment.</p>
                        @endif

                        {{-- 📊 ऑर्डर्स की मुख्य जानकारी --}}
                        <div class="info-box">
                            <p class="info-text"><strong>Order ID:</strong> #{{ $order->order_number }}</p>
                            <p class="info-text"><strong>Date & Time:</strong> {{ $order->created_at->format('d M Y, h:i A') }}</p>
                            <p class="info-text"><strong>Payment Mode:</strong> {{ strtoupper($order->payment_method) }}</p>
                        </div>

                        {{-- 📦 प्रोडक्ट्स की तालिका --}}
                        <div class="section-title">Items Ordered</div>
                        <table width="100%" cellpadding="0" cellspacing="0" border="0">
                            <thead>
                                <tr>
                                    <th class="item-th" align="left">Product Description</th>
                                    <th class="item-th" align="center" width="50">Qty</th>
                                    <th class="item-th" align="right" width="100">Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->items as $item)
                                <tr>
                                    <td class="item-td" align="left">
                                        <span style="font-weight: bold; color: #222222;">{{ $item->product_name }}</span>
                                        @if($item->is_siddh)
                                            <span style="display: block; font-size: 11px; color: #b7791f; margin-top: 2px;">★ Siddh Energization Enabled</span>
                                        @endif
                                        @if($item->ring_size)
                                            <span style="display: block; font-size: 11px; color: #666666;">Size: {{ $item->ring_size }}</span>
                                        @endif
                                    </td>
                                    <td class="item-td" align="center" style="font-weight: bold;">{{ $item->quantity }}</td>
                                    <td class="item-td" align="right" style="font-weight: bold;">₹{{ number_format($item->total_price, 2) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{-- 📊 फुलप्रूफ प्राइस ब्रेकडाउन (टेबल-बेस्ड ताकि आउटलुक में न फटे) --}}
                        <div class="section-title">Billing Summary</div>
                        <table class="summary-table" cellpadding="0" cellspacing="0" border="0">
                            <tr>
                                <td class="summary-td" align="left" style="font-size: 15px; font-weight: bold; color: #7b3f27; border-bottom: 1px solid #f1e0c5;">Grand Total Value:</td>
                                <td class="summary-td" align="right" style="font-size: 15px; font-weight: bold; color: #7b3f27; border-bottom: 1px solid #f1e0c5;">₹{{ number_format($order->total_amount, 2) }}</td>
                            </tr>

                            @if($order->is_partial)
                                <tr>
                                    <td class="summary-td" align="left" style="color: #28a745; font-weight: bold; padding-top: 12px;">✓ Advance Paid Online:</td>
                                    <td class="summary-td" align="right" style="color: #28a745; font-weight: bold; padding-top: 12px;">- ₹{{ number_format($order->total_amount - $order->balance_amount, 2) }}</td>
                                </tr>
                                <tr>
                                    <td class="summary-td" align="left" style="color: #dc3545; font-weight: bold; padding-bottom: 12px;">⚠ Cash to Pay at Delivery (COD Balance):</td>
                                    <td class="summary-td" align="right" style="color: #dc3545; font-weight: bold; padding-bottom: 12px;">₹{{ number_format($order->balance_amount, 2) }}</td>
                                </tr>
                            @else
                                <tr>
                                    <td class="summary-td" align="left" style="color: #28a745; font-weight: bold; padding: 12px 15px;">Payment Status:</td>
                                    <td class="summary-td" align="right" style="color: #28a745; font-weight: bold; padding: 12px 15px;">{{ $order->payment_status == 'paid' ? 'FULLY PAID (PREPAID)' : strtoupper($order->payment_status) }}</td>
                                </tr>
                            @endif
                        </table>

                        @if($order->is_partial && !$isAdmin)
                            <p style="font-size: 12px; color: #666666; margin-top: 10px; font-style: italic; text-align: center;">
                                * नोट: डिलीवरी पार्टनर को पार्सल हैंडओवर लेते समय केवल कूरियर बैलेंस <b>₹{{ number_format($order->balance_amount) }}/-</b> का ही नकद भुगतान करें।
                            </p>
                        @endif

                        {{-- 🏠 डिलीवरी पता कार्ड --}}
                        <div class="section-title">Delivery Details</div>
                        <div class="address-box">
                            <strong style="color: #333333; font-size: 15px;">{{ $order->shipping_address['name'] ?? '' }}</strong><br>
                            {{ $order->shipping_address['address_line1'] ?? '' }}<br>
                            {{ $order->shipping_address['city'] ?? '' }}, {{ $order->shipping_address['state'] ?? '' }} - {{ $order->shipping_address['pincode'] ?? '' }}<br>
                            <strong>Phone:</strong> +91 {{ $order->shipping_address['phone'] ?? '' }}<br>
                            <strong>Email:</strong> {{ $order->shipping_address['email'] ?? 'N/A' }}
                        </div>

                        {{-- ✍️ सुयज्ञ टीम सिग्नेचर --}}
                        <div style="margin-top: 35px; padding-top: 20px; border-top: 1px solid #f5f0e6; font-size: 14px; color: #555555;">
                            Warm regards,<br>
                            <span style="font-weight: bold; color: #7b3f27; font-size: 15px; display: block; margin-top: 4px;">Suyagya Support Team</span>
                        </div>

                    </td>
                </tr>

                {{-- 🔔 फुटर --}}
                <tr>
                    <td class="footer">
                        <div style="margin-bottom: 12px;">
                            <a href="https://suyagya.com">Website</a> |
                            <a href="https://suyagya.com/my-account">Track Order</a> |
                            <a href="https://suyagya.com/blogs">Blogs</a>
                        </div>
                        <p class="footer-note">
                            &copy; {{ date('Y') }} <b>Suyagya Store</b>. All rights reserved.<br>
                            For any queries, contact us at <a href="mailto:support@suyagya.com" style="font-weight: normal; margin:0;">support@suyagya.com</a>
                        </p>
                    </td>
                </tr>

            </table>
        </td>
    </tr>
</table>

</body>
</html>
