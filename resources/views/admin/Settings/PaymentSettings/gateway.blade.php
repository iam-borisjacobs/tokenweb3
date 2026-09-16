<div>
    <form action="javascript:void(0)" method="POST" id="gatewayform">
        @csrf
        @method('PUT')

        <div class="row g-4">
            <!-- Header -->
            <div class="col-12">
                <div class="p-3 bg-light bg-opacity-50 border rounded-3 mb-2">
                    <h5 class="f-w-700 mb-1 text-primary">
                        <i class="fa fa-server me-1"></i> Third-Party Payment Gateway Integrations
                    </h5>
                    <p class="text-muted f-13 mb-0">Manage API credentials, public/private keys, and webhooks for credit card and cryptocurrency processors.</p>
                </div>
            </div>

            <!-- Stripe Card -->
            <div class="col-lg-6">
                <div class="card h-100 p-3 border shadow-none bg-light bg-opacity-25 rounded-3">
                    <div class="d-flex align-items-center justify-content-between mb-3 pb-2 border-bottom">
                        <div class="d-flex align-items-center gap-2">
                            <span class="badge bg-primary px-3 py-1 rounded-pill f-12"><i class="fab fa-stripe me-1"></i> Stripe</span>
                            <h6 class="f-w-700 mb-0">Stripe Payments</h6>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label f-w-600 f-13">Stripe Publishable Key</label>
                        <input type="text" name="s_p_k" class="form-control" placeholder="pk_live_..." value="{{ $settings->s_p_k }}">
                    </div>
                    <div class="mb-2">
                        <label class="form-label f-w-600 f-13">Stripe Secret Key</label>
                        <input type="password" name="s_s_k" class="form-control" placeholder="sk_live_..." value="{{ $settings->s_s_k }}">
                    </div>
                </div>
            </div>

            <!-- PayPal Card -->
            <div class="col-lg-6">
                <div class="card h-100 p-3 border shadow-none bg-light bg-opacity-25 rounded-3">
                    <div class="d-flex align-items-center justify-content-between mb-3 pb-2 border-bottom">
                        <div class="d-flex align-items-center gap-2">
                            <span class="badge bg-info px-3 py-1 rounded-pill f-12"><i class="fab fa-paypal me-1"></i> PayPal</span>
                            <h6 class="f-w-700 mb-0">PayPal Express</h6>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label f-w-600 f-13">PayPal Client ID</label>
                        <input type="text" name="pp_ci" class="form-control" placeholder="Client ID" value="{{ $settings->pp_ci }}">
                    </div>
                    <div class="mb-2">
                        <label class="form-label f-w-600 f-13">PayPal Secret Key</label>
                        <input type="password" name="pp_cs" class="form-control" placeholder="Client Secret" value="{{ $settings->pp_cs }}">
                    </div>
                </div>
            </div>

            <!-- Paystack Card -->
            <div class="col-lg-6">
                <div class="card h-100 p-3 border shadow-none bg-light bg-opacity-25 rounded-3">
                    <div class="d-flex align-items-center justify-content-between mb-3 pb-2 border-bottom">
                        <div class="d-flex align-items-center gap-2">
                            <span class="badge bg-success px-3 py-1 rounded-pill f-12">Paystack</span>
                            <h6 class="f-w-700 mb-0">Paystack Checkout</h6>
                        </div>
                    </div>
                    <div class="p-2 mb-3 bg-white border rounded-2">
                        <small class="text-muted d-block f-11">Callback URL (Configure in Paystack Dashboard):</small>
                        <code class="f-12 text-primary">{{ $settings->site_address }}/dashboard/paystackcallback</code>
                    </div>
                    <div class="mb-3">
                        <label class="form-label f-w-600 f-13">Paystack Public Key</label>
                        <input type="text" name="paystack_public_key" class="form-control" placeholder="pk_live_..." value="{{ $paystack->paystack_public_key }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label f-w-600 f-13">Paystack Secret Key</label>
                        <input type="password" name="paystack_secret_key" class="form-control" placeholder="sk_live_..." value="{{ $paystack->paystack_secret_key }}">
                    </div>
                    <div class="mb-2">
                        <label class="form-label f-w-600 f-13">Paystack Merchant Email</label>
                        <input type="email" name="paystack_email" class="form-control" placeholder="merchant@business.com" value="{{ $paystack->paystack_email }}">
                    </div>
                    <input type="hidden" name="paystack_url" value="{{ $paystack->paystack_url }}">
                </div>
            </div>

            <!-- Flutterwave Card -->
            <div class="col-lg-6">
                <div class="card h-100 p-3 border shadow-none bg-light bg-opacity-25 rounded-3">
                    <div class="d-flex align-items-center justify-content-between mb-3 pb-2 border-bottom">
                        <div class="d-flex align-items-center gap-2">
                            <span class="badge bg-warning text-dark px-3 py-1 rounded-pill f-12">Flutterwave</span>
                            <h6 class="f-w-700 mb-0">Flutterwave Standard</h6>
                        </div>
                        <a href="https://dashboard.flutterwave.com" target="_blank" class="f-11 text-muted"><i class="fa fa-external-link-alt me-1"></i> Dashboard</a>
                    </div>
                    <div class="mb-3">
                        <label class="form-label f-w-600 f-13">Flutterwave Public Key</label>
                        <input type="text" name="flw_public_key" class="form-control" placeholder="FLWPUBK_..." value="{{ $moresettings->flw_public_key }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label f-w-600 f-13">Flutterwave Secret Key</label>
                        <input type="password" name="flw_secret_key" class="form-control" placeholder="FLWSECK_..." value="{{ $moresettings->flw_secret_key }}">
                    </div>
                    <div class="mb-2">
                        <label class="form-label f-w-600 f-13">Flutterwave Secret Encryption Hash</label>
                        <input type="text" name="flw_secret_hash" class="form-control" placeholder="Secret Hash" value="{{ $moresettings->flw_secret_hash }}">
                    </div>
                </div>
            </div>

            <!-- Binance Pay Card -->
            <div class="col-12">
                <div class="card p-3 border shadow-none bg-light bg-opacity-25 rounded-3">
                    <div class="d-flex align-items-center justify-content-between mb-3 pb-2 border-bottom">
                        <div class="d-flex align-items-center gap-2">
                            <span class="badge bg-warning text-dark px-3 py-1 rounded-pill f-12"><i class="fa fa-coins me-1"></i> Binance Pay</span>
                            <h6 class="f-w-700 mb-0">Binance Merchant Pay</h6>
                        </div>
                        <a href="https://merchant.binance.com/en" target="_blank" class="f-11 text-muted"><i class="fa fa-external-link-alt me-1"></i> Merchant Portal</a>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label f-w-600 f-13">Binance API Key</label>
                            <input type="text" name="bnc_api_key" class="form-control" placeholder="Binance API Key" value="{{ $moresettings->bnc_api_key }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label f-w-600 f-13">Binance Secret Key</label>
                            <input type="password" name="bnc_secret_key" class="form-control" placeholder="Binance Secret Key" value="{{ $moresettings->bnc_secret_key }}">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Save Button -->
            <div class="col-12 mt-4 pt-2 border-top text-end">
                <button type="submit" class="btn btn-primary px-5 py-2 rounded-pill f-w-600">
                    <i class="fa fa-save me-1"></i> Save Gateway Settings
                </button>
            </div>
        </div>
    </form>
</div>
