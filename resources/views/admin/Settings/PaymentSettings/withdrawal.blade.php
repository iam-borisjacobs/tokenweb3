<div>
    <form action="javascript:void(0)" method="POST" id="paypreform">
        @csrf
        @method('PUT')

        <div class="row g-4">
            <div class="col-12">
                <div class="p-3 bg-light bg-opacity-50 border rounded-3 mb-2">
                    <h5 class="f-w-700 mb-1 text-primary">
                        <i class="fa fa-sliders me-1"></i> Deposit & Withdrawal Automation Preferences
                    </h5>
                    <p class="text-muted f-13 mb-0">Specify how transactions are processed, approval workflows, minimum thresholds, and third-party gateway routes.</p>
                </div>
            </div>

            <!-- Deposit Workflow -->
            <div class="col-md-6">
                <label class="form-label f-w-600 f-13">Deposit Processing Mode</label>
                <select name="deposit_option" class="form-select">
                    <option value="manual" {{ $settings->deposit_option == 'manual' ? 'selected' : '' }}>Manual (Admin confirms after proof upload)</option>
                    <option value="auto" {{ $settings->deposit_option == 'auto' ? 'selected' : '' }}>Automatic (Instant credit via payment gateway/IPN)</option>
                </select>
                <small class="text-muted f-11">Current setting: <strong>{{ ucfirst($settings->deposit_option) }}</strong></small>
            </div>

            <!-- Withdrawal Workflow -->
            <div class="col-md-6">
                <label class="form-label f-w-600 f-13">Withdrawal Processing Mode</label>
                <select name="withdrawal_option" class="form-select">
                    <option value="manual" {{ $settings->withdrawal_option == 'manual' ? 'selected' : '' }}>Manual (Admin reviews and marks processed)</option>
                    <option value="auto" {{ $settings->withdrawal_option == 'auto' ? 'selected' : '' }}>Automatic (Automated payout via CoinPayments/Binance)</option>
                </select>
                <small class="text-muted f-11">Current setting: <strong>{{ ucfirst($settings->withdrawal_option) }}</strong></small>
            </div>

            <!-- Minimum Deposit -->
            <div class="col-md-6">
                <label class="form-label f-w-600 f-13">Global Minimum Deposit Amount</label>
                <div class="input-group">
                    <span class="input-group-text bg-light f-w-600">{{ $settings->currency }}</span>
                    <input class="form-control" type="number" step="any" name="minamt" value="{{ $moresettings->minamt }}" required>
                </div>
                <small class="text-muted f-11">The absolute lowest amount an investor can submit for deposit.</small>
            </div>

            <!-- USDT Automated Merchant -->
            <div class="col-md-6">
                <label class="form-label f-w-600 f-13">Automated USDT Merchant Gateway</label>
                <select name="merchat" class="form-select">
                    <option value="Coinpayment" {{ $settings->auto_merchant_option == 'Coinpayment' ? 'selected' : '' }}>CoinPayments</option>
                    <option value="Binance" {{ $settings->auto_merchant_option == 'Binance' ? 'selected' : '' }}>Binance Pay</option>
                </select>
                <small class="text-muted f-11">
                    Ensure API keys are configured under the Gateways / CoinPayments tab. Note: Website currency must be USD for Binance.
                </small>
            </div>

            <!-- Balance Deduction Timing -->
            <div class="col-md-6">
                <label class="form-label f-w-600 f-13">Balance Deduction Timing on Withdrawal</label>
                <select name="deduction_option" class="form-select">
                    <option value="userRequest" {{ $settings->deduction_option == 'userRequest' ? 'selected' : '' }}>Deduct immediately upon user request submission</option>
                    <option value="AdminApprove" {{ $settings->deduction_option == 'AdminApprove' ? 'selected' : '' }}>Deduct only when admin reviews & approves request</option>
                </select>
                <small class="text-muted f-11">Prevents double-spending by locking funds immediately if set to Request.</small>
            </div>

            <!-- Credit Card Gateway Provider -->
            <div class="col-md-6">
                <label class="form-label f-w-600 f-13">Credit / Debit Card Provider</label>
                <select name="credit_card_provider" class="form-select">
                    <option value="Paystack" {{ $settings->credit_card_provider == 'Paystack' ? 'selected' : '' }}>Paystack</option>
                    <option value="Flutterwave" {{ $settings->credit_card_provider == 'Flutterwave' ? 'selected' : '' }}>Flutterwave</option>
                    <option value="Stripe" {{ $settings->credit_card_provider == 'Stripe' ? 'selected' : '' }}>Stripe</option>
                </select>
                <small class="text-muted f-11">Default provider activated when an investor chooses Credit/Debit card checkout.</small>
            </div>

            <!-- Save Button -->
            <div class="col-12 mt-4 pt-2 border-top">
                <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill f-w-600">
                    <i class="fa fa-save me-1"></i> Save Payment Preferences
                </button>
            </div>
        </div>
    </form>
</div>
