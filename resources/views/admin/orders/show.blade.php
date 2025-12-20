@extends('admin.layout.layout')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex justify-content-between mb-4">
        <h4 class="fw-bold">Order Details: #{{ $order->order_number }}</h4>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">Back</a>
    </div>

    <div class="row">
        {{-- LEFT SIDE: Products & Info --}}
        <div class="col-md-8">
            <div class="card mb-4">
                <h5 class="card-header">Ordered Items</h5>
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->items as $item)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset($item->product->main_image ?? '') }}" width="50" class="rounded me-2">
                                        {{ $item->product_name }}
                                        @if($item->is_siddh) <span class="badge bg-warning ms-1">Siddh</span> @endif
                                    </div>
                                </td>
                                <td>₹{{ number_format($item->price) }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>₹{{ number_format($item->price * $item->quantity) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Shipping Address --}}
            <div class="card">
                <h5 class="card-header">Shipping Details</h5>
                <div class="card-body">
                    @php
                        $addr = is_array($order->shipping_address) ? $order->shipping_address : json_decode($order->shipping_address, true);
                    @endphp
                    <p><strong>Name:</strong> {{ $addr['name'] ?? '' }}</p>
                    <p><strong>Phone:</strong> {{ $addr['phone'] ?? '' }}</p>
                    <p><strong>Address:</strong> {{ $addr['address_line1'] ?? '' }}, {{ $addr['city'] ?? '' }}, {{ $addr['state'] ?? '' }} - {{ $addr['pincode'] ?? '' }}</p>
                </div>
            </div>
        </div>

        {{-- RIGHT SIDE: Status Update --}}
        <div class="col-md-4">
            <div class="card mb-4">
                <h5 class="card-header">Update Status</h5>
                <div class="card-body">
                    <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- Order Status --}}
                        <div class="mb-3">
                            <label class="form-label">Order Status</label>
                            <select name="status" class="form-select" id="orderStatus" onchange="toggleTracking(this.value)">
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped (Dispatched)</option>
                                <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </div>

                        {{-- Payment Status --}}
                        <div class="mb-3">
                            <label class="form-label">Payment Status</label>
                            <select name="payment_status" class="form-select">
                                <option value="pending" {{ $order->payment_status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="paid" {{ $order->payment_status == 'paid' ? 'selected' : '' }}>Paid</option>
                                <option value="failed" {{ $order->payment_status == 'failed' ? 'selected' : '' }}>Failed</option>
                            </select>
                        </div>

                        {{-- 🚚 Tracking Details (Hidden by default, shown via JS) --}}
                        <div id="trackingBox" style="display: {{ $order->status == 'shipped' || old('status') == 'shipped' ? 'block' : 'none' }}; border:1px solid #ddd; padding:10px; border-radius:5px; background:#f9f9f9;" class="mb-3">
                            <h6 class="text-primary mb-3">Tracking Information</h6>

                            <div class="mb-2">
                                <label class="small fw-bold">Courier Name *</label>
                                <input type="text" name="courier_name" class="form-control form-control-sm"
                                       value="{{ old('courier_name', $order->courier_name) }}" placeholder="e.g. BigShip / BlueDart">
                            </div>

                            <div class="mb-2">
                                <label class="small fw-bold">AWB / Tracking ID *</label>
                                <input type="text" name="awb_number" class="form-control form-control-sm"
                                       value="{{ old('awb_number', $order->awb_number) }}" placeholder="e.g. 123456789">
                            </div>

                            <div class="mb-2">
                                <label class="small fw-bold">Tracking URL (Optional)</label>
                                <input type="text" name="tracking_url" class="form-control form-control-sm"
                                       value="{{ old('tracking_url', $order->tracking_url) }}" placeholder="https://...">
                            </div>

                            <div class="mb-2">
                                <label class="small fw-bold">Expected Delivery</label>
                                <input type="date" name="expected_delivery_date" class="form-control form-control-sm"
                                       value="{{ old('expected_delivery_date', $order->expected_delivery_date) }}">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Update Order</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Simple Script to Toggle Tracking Fields --}}
<script>
    function toggleTracking(status) {
        const box = document.getElementById('trackingBox');
        if (status === 'shipped') {
            box.style.display = 'block';
        } else {
            box.style.display = 'none';
        }
    }
</script>
@endsection
