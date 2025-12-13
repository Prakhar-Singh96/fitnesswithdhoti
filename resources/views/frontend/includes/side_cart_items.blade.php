@if(isset($cartItems) && $cartItems->count() > 0)
    <div class="list-group list-group-flush">
        @foreach($cartItems as $item)
            @php
                $price = $item->product->price + ($item->is_siddh ? $item->product->siddh_price : 0);
            @endphp
            <div class="list-group-item p-3 border-bottom-0 border-top">
                <div class="d-flex align-items-center">
                    {{-- Image --}}
                    <img src="{{ asset($item->product->main_image) }}" class="rounded border me-3" width="70" height="70" style="object-fit: cover;">

                    {{-- Info --}}
                    <div class="flex-grow-1">
                        <h6 class="fw-bold mb-1 text-truncate small text-dark" style="max-width: 180px;">{{ $item->product->name }}</h6>

                        @if($item->is_siddh)
                            <span class="badge bg-warning text-dark x-small mb-1" style="font-size: 10px;">Siddh / Energized</span>
                        @endif

                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <span class="fw-bold text-dark small">₹{{ number_format($price) }}</span>

                            {{-- Qty --}}
                            <div class="input-group input-group-sm" style="width: 80px;">
                                <button class="btn btn-outline-secondary px-1" onclick="updateSideCartQty({{ $item->id }}, 'minus')">-</button>
                                <input type="text" class="form-control text-center px-0 bg-white border-secondary" value="{{ $item->quantity }}" readonly style="font-size: 12px;">
                                <button class="btn btn-outline-secondary px-1" onclick="updateSideCartQty({{ $item->id }}, 'plus')">+</button>
                            </div>
                        </div>
                    </div>

                    {{-- Delete --}}
                    <button class="btn btn-link text-danger ms-1 p-0" onclick="removeFromSideCart({{ $item->id }})">
                        <i class="las la-trash-alt"></i>
                    </button>
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="text-center py-5 mt-5">
        <div class="mb-3">
            <img src="https://cdn-icons-png.flaticon.com/512/11329/11329060.png" width="80" class="opacity-50">
        </div>
        <h6 class="text-muted fw-bold">Your Cart is Empty</h6>
        <p class="text-muted x-small mb-4">Looks like you haven't added anything yet.</p>
        <button class="btn btn-warning btn-sm fw-bold text-white" data-bs-dismiss="offcanvas" style="background-color: #ff6f00; border:none;">
            Start Shopping
        </button>
    </div>
@endif
