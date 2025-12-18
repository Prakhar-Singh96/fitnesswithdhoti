<div class="modal fade" id="checkoutModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 overflow-hidden" style="border-radius: 16px;">

            {{-- Header --}}
            <div class="modal-header border-bottom-0 pb-0 pt-3 px-4">
                <div class="d-flex align-items-center">
                    <h6 class="modal-title fw-bold" id="modalTitle" style="font-size: 16px;">Secure Checkout</h6>
                </div>
                <button type="button" class="btn-close bg-light rounded-circle p-2" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            <div class="modal-body px-4 pb-4 pt-2">

                {{-- =================================== --}}
                {{-- 🔴 STEP 1: LOGIN (Guest Only) --}}
                {{-- =================================== --}}
                <div id="step_login" style="display: none;">
                    <div class="mt-2">
                        <h5 class="fw-bold mb-1">Login to continue</h5>
                        <p class="text-muted small mb-4">Enter your mobile number to verify details</p>

                        <div class="form-floating mb-3">
                            <input type="tel" id="chk_mobile" class="form-control rounded-3"
                                placeholder="Mobile Number" maxlength="10">
                            <label for="chk_mobile" class="text-muted">Enter Mobile Number</label>
                        </div>

                        {{-- OTP Section --}}
                        <div id="chk_otp_box" style="display: none;">
                            <div class="form-floating mb-3">
                                <input type="text" id="chk_otp" class="form-control rounded-3 letter-spacing-2"
                                    placeholder="OTP">
                                <label for="chk_otp">Enter OTP</label>
                            </div>
                            <button type="button" class="btn btn-dark w-100 py-3 rounded-3 fw-bold mb-3"
                                onclick="verifyCheckoutOtp()">
                                VERIFY OTP
                            </button>
                        </div>

                        <button type="button" id="btn_send_otp"
                            class="btn btn-warning w-100 py-3 rounded-3 fw-bold text-white"
                            style="background-color: #ff6f00; border: none;" onclick="sendCheckoutOtp()">
                            CONTINUE
                        </button>
                    </div>
                </div>

                {{-- =================================== --}}
                {{-- 🟢 STEP 2: ADDRESS (Auto Detect) --}}
                {{-- =================================== --}}
                <div id="step_address" style="display: none;">

                    {{-- User Info Header --}}
                    <div class="bg-light p-2 rounded-3 mb-4 d-flex align-items-center justify-content-between border">
                        <div class="d-flex align-items-center">
                            <div class="bg-white p-2 rounded-circle border me-2">
                                <i class="las la-user text-muted"></i>
                            </div>
                            <div style="line-height: 1.2;">
                                <small class="text-muted x-small d-block">LOGGED IN AS</small>
                                <span class="fw-bold text-dark small" id="user_phone_display">
                                    {{ Auth::user()->phone ?? 'User' }}
                                </span>
                            </div>
                        </div>
                        <i class="las la-check-circle text-success fs-4"></i>
                    </div>

                    {{-- A. Saved Address List --}}
                    <div id="saved_address_list"
                        style="{{ Auth::check() && Auth::user()->addresses->count() > 0 ? '' : 'display:none;' }}">

                        {{-- ✅ Yahan Include karein taaki Page Load par bhi dikhe --}}
                        @if (Auth::check())
                            @include('frontend.includes.checkout_address_list', [
                                'addresses' => Auth::user()->addresses,
                            ])
                        @endif

                    </div>

                    {{-- B. New Address Form (Agar koi address nahi hai to ye by default dikhega) --}}
                    <div id="new_address_form"
                        style="{{ Auth::check() && Auth::user()->addresses->count() > 0 ? 'display:none;' : '' }}">

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="fw-bold mb-0">Add New Address</h6>
                            @if (Auth::check() && Auth::user()->addresses->count() > 0)
                                <button type="button" class="btn btn-sm btn-link text-decoration-none"
                                    onclick="$('#new_address_form').slideUp(); $('#saved_address_list').slideDown();">
                                    Cancel
                                </button>
                            @endif
                        </div>

                        {{-- Pincode --}}
                        <div class="form-floating mb-3">
                            <input type="tel" id="chk_pincode" class="form-control rounded-3 fw-bold"
                                placeholder="Pincode" maxlength="6" onkeyup="fetchCheckoutCityState()">
                            <label for="chk_pincode">Pincode *</label>
                            <small id="chk_pincode_msg"
                                class="position-absolute top-50 end-0 translate-middle-y me-3 fw-bold x-small"></small>
                        </div>

                        {{-- Expanded Fields --}}
                        <div id="address_expanded" style="display: none;">
                            <div class="row g-2 mb-3">
                                <div class="col-6">
                                    <input type="text" id="chk_city" class="form-control bg-light border-0 small"
                                        placeholder="City" readonly>
                                </div>
                                <div class="col-6">
                                    <input type="text" id="chk_state" class="form-control bg-light border-0 small"
                                        placeholder="State" readonly>
                                </div>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" id="chk_house" class="form-control rounded-3"
                                    placeholder="House No">
                                <label>Flat, House no., Building *</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" id="chk_area" class="form-control rounded-3" placeholder="Area">
                                <label>Area, Street, Sector *</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" id="chk_name" class="form-control rounded-3"
                                    placeholder="Name" value="{{ Auth::user()->name ?? '' }}">
                                <label>Full Name *</label>
                            </div>

                            <div class="mb-4">
                                <label class="d-block x-small fw-bold text-muted text-uppercase mb-2">Save As</label>
                                <div class="d-flex gap-2">
                                    <input type="radio" class="btn-check" name="addr_type" id="home"
                                        value="home" checked>
                                    <label class="btn btn-outline-secondary btn-sm px-3 rounded-pill"
                                        for="home">Home</label>

                                    <input type="radio" class="btn-check" name="addr_type" id="work"
                                        value="work">
                                    <label class="btn btn-outline-secondary btn-sm px-3 rounded-pill"
                                        for="work">Work</label>
                                </div>
                            </div>

                            <button type="button" class="btn btn-warning w-100 py-3 rounded-3 fw-bold text-white"
                                style="background-color: #ff6f00; border: none;" onclick="saveAndContinue()">
                                SAVE & CONTINUE
                            </button>
                        </div>
                    </div>

                </div>

                {{-- =================================== --}}
                {{-- 💰 STEP 3: PAYMENT --}}
                {{-- =================================== --}}
                <div id="step_payment" style="display: none;">

                    {{-- Product Snippet --}}
                    <div class="d-flex align-items-center bg-light p-2 rounded border mb-4">
                        <img id="summ_img" src="" width="45" height="45"
                            class="rounded border me-3">
                        <div class="flex-grow-1">
                            <h6 class="mb-0 fw-bold small text-truncate" style="max-width: 180px;" id="summ_name">...
                            </h6>
                            <small class="text-muted x-small" id="summ_qty">Qty: 1</small>
                        </div>
                        <div class="text-end">
                            <span class="fw-bold text-dark" id="summ_total">₹0</span>
                        </div>
                    </div>

                    <h6 class="fw-bold mb-3">Select Payment Method</h6>

                    {{-- 👇👇 YAHAN CHANGE HUA HAI 👇👇 --}}
                    {{-- Action Hataya, onsubmit lagaya --}}
                    <form id="finalPaymentForm" onsubmit="event.preventDefault(); processPayment();">
                        @csrf
                        <input type="hidden" name="buy_mode" id="final_buy_mode">
                        <input type="hidden" name="product_id" id="final_product_id">
                        <input type="hidden" name="quantity" id="final_quantity">
                        <input type="hidden" name="is_siddh" id="final_is_siddh">
                        <input type="hidden" name="address_id" id="final_address_id">

                        {{-- Razorpay --}}
                        <label class="d-flex align-items-center p-3 mb-2 border rounded-3 cursor-pointer bg-white"
                            onclick="$('.pay-radio').prop('checked', false); $('#rzp').prop('checked', true);">
                            <input type="radio" class="form-check-input me-3 pay-radio" name="payment_method"
                                id="rzp" value="RAZORPAY" checked>
                            <div class="flex-grow-1">
                                <span class="fw-bold d-block small">UPI / Cards / Netbanking</span>
                                <small class="text-success x-small fw-bold">Extra 10% OFF</small>
                            </div>
                            <img src="https://cdn.razorpay.com/static/assets/logo/payment.svg" height="16">
                        </label>

                        {{-- COD --}}
                        <label class="d-flex align-items-center p-3 mb-4 border rounded-3 cursor-pointer bg-white"
                            onclick="$('.pay-radio').prop('checked', false); $('#cod').prop('checked', true);">
                            <input type="radio" class="form-check-input me-3 pay-radio" name="payment_method"
                                id="cod" value="COD">
                            <div class="flex-grow-1">
                                <span class="fw-bold d-block small">Cash on Delivery</span>
                                <small class="text-muted x-small">Pay using Cash/UPI</small>
                            </div>
                        </label>

                        {{-- 👇 ID Add kiya button me taaki JS ise control kare --}}
                        <button type="submit" id="btn_place_order"
                            class="btn btn-dark w-100 py-3 rounded-3 fw-bold text-uppercase fs-6">
                            Place Order
                        </button>
                    </form>
                    {{-- 👆 Form Ends Here --}}

                </div>

            </div>
        </div>
    </div>
</div>
