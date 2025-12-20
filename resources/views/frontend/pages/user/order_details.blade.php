@extends('frontend.layouts.app')

@section('content')
    <div class="container py-5">

        {{-- Back Button --}}
        <div class="mb-4">
            <a href="{{ route('user.orders') }}" class="text-decoration-none text-dark fw-bold">
                <i class="las la-arrow-left"></i> Back to Orders
            </a>
        </div>

        <div class="row">
            <div class="col-lg-8">

                {{-- Order Items --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 fw-bold">Order Items</h5>
                    </div>
                    <div class="card-body">
                        @foreach ($order->items as $item)
                            <div class="d-flex align-items-center mb-3 pb-3 border-bottom">
                                <div class="me-3">
                                    {{-- Product Image (Fallback if null) --}}
                                    <img src="{{ asset($item->product->main_image ?? 'assets/img/placeholder.jpg') }}"
                                        width="80" class="rounded border">
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1 fw-bold">{{ $item->product_name }}</h6>
                                    <p class="text-muted small mb-0">Qty: {{ $item->quantity }}</p>
                                    @if ($item->is_siddh)
                                        <span class="badge bg-warning text-dark x-small">Siddh Enabled</span>
                                    @endif
                                </div>
                                <div class="text-end">
                                    <p class="fw-bold mb-0">₹{{ number_format($item->price, 2) }}</p>
                                </div>
                            </div>
                        @endforeach

                        <div class="d-flex justify-content-between pt-2">
                            <h5 class="fw-bold">Total</h5>
                            <h5 class="fw-bold text-primary">₹{{ number_format($order->total_amount, 2) }}</h5>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-lg-4">

                {{-- Order Info --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <h6 class="fw-bold mb-3">Order Summary</h6>
                        <p class="mb-1"><strong>Order ID:</strong> #{{ $order->id }}</p>
                        <p class="mb-1"><strong>Date:</strong> {{ date('d M Y', strtotime($order->created_at)) }}</p>
                        <p class="mb-1">
                            <strong>Payment:</strong>
                            <span class="badge {{ $order->payment_status == 'paid' ? 'bg-success' : 'bg-warning' }}">
                                {{ strtoupper($order->payment_status) }}
                            </span>
                        </p>
                        @if ($order->transaction_id)
                            <p class="mb-1 text-break"><strong>Txn ID:</strong> {{ $order->transaction_id }}</p>
                        @endif
                    </div>
                </div>

                {{-- 🚚 ORDER TRACKING TIMELINE --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 fw-bold">Order Status</h5>
                    </div>
                    <div class="card-body">

                        {{-- Tracking Info Header --}}
                        @if ($order->status != 'cancelled')
                            <div class="mb-4">
                                @if ($order->expected_delivery_date)
                                    <p class="mb-1 text-muted">Estimated Delivery by:</p>
                                    <h5 class="text-success fw-bold">
                                        {{ date('d M Y', strtotime($order->expected_delivery_date)) }}
                                    </h5>
                                @endif

                                @if ($order->awb_number)
                                    <div
                                        class="alert alert-light border d-flex justify-content-between align-items-center mt-3">
                                        <div>
                                            <small class="text-muted d-block">Courier Partner</small>
                                            <strong>{{ $order->courier_name ?? 'BigShip' }}</strong>
                                        </div>
                                        <div>
                                            <small class="text-muted d-block">Tracking ID (AWB)</small>
                                            <strong>{{ $order->awb_number }}</strong>
                                        </div>
                                        {{-- Agar direct link hai to button dikhayein --}}
                                        @if ($order->tracking_url)
                                            <a href="{{ $order->tracking_url }}" target="_blank"
                                                class="btn btn-sm btn-dark">Track Live</a>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        @endif

                        {{-- STATUS PROGRESS BAR --}}
                        @if ($order->status == 'cancelled')
                            <div class="alert alert-danger text-center">
                                <i class="las la-times-circle fs-2"></i>
                                <h5 class="mt-2">This Order has been Cancelled</h5>
                            </div>
                        @else
                            <div class="track-container">
                                <div class="track-line"></div>

                                {{-- 1. Order Placed --}}
                                <div class="track-step active">
                                    <div class="icon"><i class="las la-clipboard-check"></i></div>
                                    <div class="text">Order Placed</div>
                                    <div class="date">{{ date('d M', strtotime($order->created_at)) }}</div>
                                </div>

                                {{-- 2. Processing --}}
                                <div
                                    class="track-step {{ in_array($order->status, ['processing', 'shipped', 'delivered']) ? 'active' : '' }}">
                                    <div class="icon"><i class="las la-cog"></i></div>
                                    <div class="text">Processing</div>
                                </div>

                                {{-- 3. Shipped --}}
                                <div
                                    class="track-step {{ in_array($order->status, ['shipped', 'delivered']) ? 'active' : '' }}">
                                    <div class="icon"><i class="las la-shipping-fast"></i></div>
                                    <div class="text">Shipped</div>
                                    @if ($order->awb_number)
                                        <div class="date small text-muted">On the way</div>
                                    @endif
                                </div>

                                {{-- 4. Delivered --}}
                                <div class="track-step {{ $order->status == 'delivered' ? 'active' : '' }}">
                                    <div class="icon"><i class="las la-box-open"></i></div>
                                    <div class="text">Delivered</div>
                                </div>
                            </div>
                        @endif

                    </div>
                </div>

                {{-- Shipping Address --}}
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h6 class="fw-bold mb-3">Shipping Address</h6>
                        {{-- Check if shipping_address is array or object (JSON cast in model) --}}
                        @php
                            $addr = is_array($order->shipping_address)
                                ? $order->shipping_address
                                : json_decode($order->shipping_address, true);
                        @endphp

                        @if ($addr)
                            <p class="mb-1 fw-bold">{{ $addr['name'] ?? 'N/A' }}</p>
                            <p class="mb-1">{{ $addr['address_line1'] ?? '' }}</p>
                            <p class="mb-1">{{ $addr['city'] ?? '' }}, {{ $addr['state'] ?? '' }} -
                                {{ $addr['pincode'] ?? '' }}</p>
                            <p class="mb-0">Phone: {{ $addr['phone'] ?? '' }}</p>
                        @else
                            <p class="text-muted">Address not available</p>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
