@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <x-danger-alert />
    <x-success-alert />

    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-12 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <div>
                <div class="d-flex align-items-center gap-2 mb-1">
                    <a href="{{ route('paymentview') }}" class="btn btn-outline-secondary btn-sm rounded-circle p-0 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;" title="Back to Payment Settings">
                        <i class="fa fa-arrow-left"></i>
                    </a>
                    <h3 class="f-w-700 mb-0">Edit Payment Method: {{ $method->name }}</h3>
                </div>
                <p class="text-muted mb-0 f-14 ms-md-4 ps-md-2">Update credentials, deposit/withdrawal limits, charges, and account details for this method.</p>
            </div>
            <div>
                <a href="{{ route('paymentview') }}" class="btn btn-outline-primary rounded-pill px-4 py-2 f-13 f-w-600">
                    <i class="fa fa-arrow-left me-1"></i> Back to Payment Settings
                </a>
            </div>
        </div>
    </div>

    @if ($method->name == 'USDT')
        <div class="alert alert-info alert-dismissible fade show rounded-3 mb-4" role="alert">
            <div class="d-flex align-items-center gap-2">
                <i class="fa fa-info-circle f-18"></i>
                <div class="f-13">
                    <strong>Binance Automatic USDT Withdrawals:</strong> If you use Binance as your merchant and set withdrawals to automatic, you must whitelist client IP addresses on your Binance Merchant dashboard before transactions can be dispatched.
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row justify-content-center mb-5">
        <div class="col-lg-10">
            <div class="card p-4 p-md-5 shadow-sm border">
                <form method="POST" action="{{ route('updatemethod') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{ $method->id }}">

                    <div class="row g-4">
                        <!-- Method Name -->
                        <div class="col-12">
                            <label class="form-label f-w-600 f-13">Method Name <span class="text-danger">*</span></label>
                            @php
                                $readOnlyMethods = ['Bitcoin', 'Ethereum', 'Litecoin', 'Paypal', 'Bank Transfer', 'Credit Card', 'USDT', 'BUSD'];
                            @endphp
                            @if (in_array($method->name, $readOnlyMethods))
                                <input type="text" class="form-control bg-light f-w-700" name="name" value="{{ $method->name }}" readonly>
                                <small class="text-muted f-11">System core method names cannot be renamed.</small>
                            @else
                                <input type="text" class="form-control f-w-700" name="name" value="{{ $method->name }}" required>
                            @endif

                            @if ($method->name == 'Credit Card')
                                <small class="text-muted d-block mt-1 f-11">Please ensure you have selected a credit card provider from the Payment Preferences tab.</small>
                            @endif
                        </div>

                        <!-- Minimum & Maximum Amount -->
                        <div class="col-md-6">
                            <label class="form-label f-w-600 f-13">Minimum Amount <span class="text-danger">*</span></label>
                            <input type="number" step="any" value="{{ $method->minimum }}" class="form-control" name="minimum" id="minamount" required>
                            <small class="text-muted f-11">Applies to withdrawal limits</small>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label f-w-600 f-13">Maximum Amount <span class="text-danger">*</span></label>
                            <input type="number" step="any" value="{{ $method->maximum }}" class="form-control" name="maximum" id="maxamount" required>
                            <small class="text-muted f-11">Applies to withdrawal limits</small>
                        </div>

                        <!-- Charges & Type -->
                        <div class="col-md-6">
                            <label class="form-label f-w-600 f-13">Charges Amount <span class="text-danger">*</span></label>
                            <input type="number" step="any" value="{{ $method->charges_amount }}" class="form-control" name="charges" id="charges" required>
                            <small class="text-muted f-11">Applies to withdrawal fee</small>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label f-w-600 f-13">Charges Type <span class="text-danger">*</span></label>
                            <select name="chargetype" class="form-select" required>
                                <option value="percentage" {{ $method->charges_type == 'percentage' ? 'selected' : '' }}>Percentage (%)</option>
                                <option value="fixed" {{ $method->charges_type == 'fixed' ? 'selected' : '' }}>Fixed ({{ $settings->currency }})</option>
                            </select>
                        </div>

                        <!-- Category & Logo -->
                        <div class="col-md-6">
                            <label class="form-label f-w-600 f-13">Architecture Type <span class="text-danger">*</span></label>
                            <select name="methodtype" id="methodtype" class="form-select" required>
                                <option value="currency" {{ $method->methodtype == 'currency' ? 'selected' : '' }}>Fiat Currency / Bank Transfer</option>
                                <option value="crypto" {{ $method->methodtype == 'crypto' ? 'selected' : '' }}>Cryptocurrency Wallet</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label f-w-600 f-13">Image / Logo URL (Optional)</label>
                            <input type="text" value="{{ $method->img_url }}" class="form-control" name="url" id="url" placeholder="https://...">
                        </div>

                        <!-- Bank Details (Currency) -->
                        <div class="col-md-6 currency">
                            <label class="form-label f-w-600 f-13">Bank Name</label>
                            <input type="text" value="{{ $method->bankname }}" class="form-control currinput" name="bank" id="bank">
                        </div>
                        <div class="col-md-6 currency">
                            <label class="form-label f-w-600 f-13">Account Holder Name</label>
                            <input type="text" value="{{ $method->account_name }}" class="form-control currinput" name="account_name" id="acnt_name">
                        </div>
                        <div class="col-md-6 currency">
                            <label class="form-label f-w-600 f-13">Account / IBAN Number</label>
                            <input type="text" value="{{ $method->account_number }}" class="form-control currinput" name="account_number" id="acnt_number">
                        </div>
                        <div class="col-md-6 currency">
                            <label class="form-label f-w-600 f-13">SWIFT / Routing Code</label>
                            <input type="text" value="{{ $method->swift_code }}" class="form-control currinput" name="swift" id="swift">
                        </div>

                        <!-- Crypto Details -->
                        <div class="col-12 d-none crypto">
                            <label class="form-label f-w-600 f-13">Wallet Address</label>
                            <input type="text" value="{{ $method->wallet_address }}" class="form-control cryptoinput" name="walletaddress" id="walletaddress">
                        </div>
                        <div class="col-md-6 d-none crypto">
                            <label class="form-label f-w-600 f-13">Wallet Network Type</label>
                            <input type="text" value="{{ $method->network }}" class="form-control cryptoinput" name="wallettype" id="wallettype">
                            @if ($method->name == 'USDT' or $method->name == 'BUSD')
                                <small class="text-muted d-block mt-1 f-11">Ensure network for USDT is TRC20 and BUSD is ERC20 for automatic CoinPayments processing.</small>
                            @endif
                        </div>
                        <div class="col-md-6 d-none crypto">
                            <label class="form-label f-w-600 f-13">Barcode / QR Code Image (Optional)</label>
                            <input type="file" name="barcode" class="form-control cryptoinput">
                            @if ($method->barcode)
                                <div class="mt-2">
                                    <small class="text-muted d-block f-11 mb-1">Current QR Code:</small>
                                    <img src="{{ asset('storage/photos/' . $method->barcode) }}" alt="QR Code" style="width: 70px; height: 70px; object-fit: contain;" class="border rounded p-1">
                                </div>
                            @endif
                        </div>

                        <!-- Status & Operation -->
                        <div class="col-md-6">
                            <label class="form-label f-w-600 f-13">Status <span class="text-danger">*</span></label>
                            <select name="status" class="form-select" required>
                                <option value="enabled" {{ $method->status == 'enabled' ? 'selected' : '' }}>Enabled (Active)</option>
                                <option value="disabled" {{ $method->status == 'disabled' ? 'selected' : '' }}>Disabled</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label f-w-600 f-13">Used For <span class="text-danger">*</span></label>
                            <select name="typefor" class="form-select" required>
                                <option value="both" {{ $method->type == 'both' ? 'selected' : '' }}>Both (Deposit & Withdrawal)</option>
                                <option value="deposit" {{ $method->type == 'deposit' ? 'selected' : '' }}>Deposit Only</option>
                                <option value="withdrawal" {{ $method->type == 'withdrawal' ? 'selected' : '' }}>Withdrawal Only</option>
                            </select>
                        </div>

                        <div class="col-12">
                            <label class="form-label f-w-600 f-13">Payment Note / Instructions (Optional)</label>
                            <input type="text" value="{{ $method->duration }}" class="form-control" name="note" placeholder="Payment may take up to 24 hours">
                        </div>

                        <!-- Submit Button -->
                        <div class="col-12 mt-4 pt-2 border-top d-flex justify-content-between align-items-center">
                            <a href="{{ route('paymentview') }}" class="btn btn-outline-secondary rounded-pill px-4">Cancel</a>
                            <button type="submit" class="btn btn-primary rounded-pill px-5 py-2 f-w-600">
                                <i class="fa fa-save me-1"></i> Save Changes
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@parent
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var methodtype = document.getElementById('methodtype');
        var currtype = document.querySelectorAll('.currency');
        var currinput = document.querySelectorAll('.currinput');
        var cryptotype = document.querySelectorAll('.crypto');
        var cryptoinput = document.querySelectorAll('.cryptoinput');

        function sortfields() {
            if (methodtype.value === 'currency') {
                cryptotype.forEach(function(el) { el.classList.add('d-none'); });
                currtype.forEach(function(el) { el.classList.remove('d-none'); });
                if (currinput[0]) currinput[0].setAttribute('required', '');
                if (currinput[1]) currinput[1].setAttribute('required', '');
                if (currinput[2]) currinput[2].setAttribute('required', '');
                if (cryptoinput[0]) cryptoinput[0].removeAttribute('required');
                if (cryptoinput[1]) cryptoinput[1].removeAttribute('required');
            } else {
                currtype.forEach(function(el) { el.classList.add('d-none'); });
                cryptotype.forEach(function(el) { el.classList.remove('d-none'); });
                if (cryptoinput[0]) cryptoinput[0].setAttribute('required', '');
                if (currinput[0]) currinput[0].removeAttribute('required');
                if (currinput[1]) currinput[1].removeAttribute('required');
                if (currinput[2]) currinput[2].removeAttribute('required');
            }
        }

        if (methodtype) {
            methodtype.addEventListener('change', sortfields);
            sortfields();
        }
    });
</script>
@endsection
