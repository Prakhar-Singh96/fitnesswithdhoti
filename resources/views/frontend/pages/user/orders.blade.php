@extends('frontend.layouts.app')

@section('content')

<div class="container py-5">
    <div class="row">

        {{-- Sidebar --}}
        <div class="col-lg-3 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="fw-bold mb-3">My Account</h5>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2">
                            <a href="{{ route('user.profile') }}" class="text-decoration-none text-dark">
                                <i class="las la-user me-2"></i> Profile
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ route('user.orders') }}" class="text-decoration-none text-primary fw-bold">
                                <i class="las la-shopping-bag me-2"></i> My Orders
                            </a>
                        </li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-link text-danger text-decoration-none p-0">
                                    <i class="las la-sign-out-alt me-2"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- Order List --}}
        <div class="col-lg-9">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold">My Order History</h5>
                </div>
                <div class="card-body">

                    @if($orders->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Date</th>
                                        <th>Total</th>
                                        <th>Payment</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $order)
                                        <tr>
                                            <td>
                                                <span class="fw-bold text-primary">#{{ $order->id }}</span>
                                                <br>
                                                <small class="text-muted">{{ $order->order_number }}</small>
                                            </td>
                                            <td>{{ date('d M Y', strtotime($order->created_at)) }}</td>
                                            <td>₹{{ number_format($order->total_amount, 2) }}</td>

                                            {{-- Payment Status Column --}}
                                            <td>
                                                @if($order->payment_status == 'paid')
                                                    <span class="badge bg-success">PAID</span>
                                                    @if($order->transaction_id)
                                                        <div style="font-size: 10px; margin-top: 2px;">
                                                            TXN: {{ Str::limit($order->transaction_id, 10) }}
                                                        </div>
                                                    @endif
                                                @else
                                                    <span class="badge bg-warning text-dark">PENDING</span>
                                                @endif
                                            </td>

                                            {{-- Order Status Column --}}
                                            <td>
                                                @php
                                                    $statusColor = 'secondary';
                                                    if($order->status == 'pending') $statusColor = 'warning text-dark';
                                                    if($order->status == 'processing') $statusColor = 'info text-white';
                                                    if($order->status == 'shipped') $statusColor = 'primary';
                                                    if($order->status == 'delivered') $statusColor = 'success';
                                                    if($order->status == 'cancelled') $statusColor = 'danger';
                                                @endphp
                                                <span class="badge bg-{{ $statusColor }} text-uppercase">
                                                    {{ $order->status }}
                                                </span>
                                            </td>

                                            <td>
                                                {{-- View Details Button --}}
                                                <a href="{{ route('user.order_details', $order->id) }}"
                                                   class="btn btn-sm btn-outline-dark rounded-pill">
                                                    View Details
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <h4>No orders yet!</h4>
                            <a href="{{ url('/') }}" class="btn btn-primary px-4 rounded-pill">Start Shopping</a>
                        </div>
                    @endif

                </div>
            </div>
        </div>

    </div>
</div>

@endsection
