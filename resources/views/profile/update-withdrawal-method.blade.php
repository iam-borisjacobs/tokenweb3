<form method="post" action="javascript:void(0)" id="updatewithdrawalinfo">
    @csrf
    @method('PUT')
    
    <!-- Sub-Card 1: Fiat Bank Account -->
    <div class="settings-subcard">
        <div class="settings-subcard-header">
            <h5 class="settings-subcard-title">
                <i class="fa fa-university text-primary f-18"></i>
                <span>Direct Bank Wire / Fiat Account</span>
            </h5>
            <span class="badge bg-primary-subtle text-primary border border-primary" style="font-size: 11px;">Wire / ACH / SEPA</span>
        </div>

        <div class="row g-3 g-md-4">
            <div class="col-12 col-md-6">
                <label class="form-label-custom">Bank Name</label>
                <div class="input-group-custom">
                    <i class="fa fa-building input-icon"></i>
                    <input type="text" name="bank_name" value="{{ Auth::user()->bank_name }}" class="form-control form-control-custom" placeholder="e.g. JPMorgan Chase, Barclays, DBS">
                </div>
            </div>

            <div class="col-12 col-md-6">
                <label class="form-label-custom">Account Holder Name</label>
                <div class="input-group-custom">
                    <i class="fa fa-user input-icon"></i>
                    <input type="text" name="account_name" value="{{ Auth::user()->account_name }}" class="form-control form-control-custom" placeholder="Full name on bank account">
                </div>
            </div>

            <div class="col-12 col-md-6">
                <label class="form-label-custom">Account Number / IBAN</label>
                <div class="input-group-custom">
                    <i class="fa fa-hashtag input-icon"></i>
                    <input type="text" name="account_no" value="{{ Auth::user()->account_number }}" class="form-control form-control-custom" placeholder="Bank account or IBAN number">
                </div>
            </div>

            <div class="col-12 col-md-6">
                <label class="form-label-custom">SWIFT / BIC Code</label>
                <div class="input-group-custom">
                    <i class="fa fa-globe input-icon"></i>
                    <input type="text" name="swiftcode" value="{{ Auth::user()->swift_code }}" class="form-control form-control-custom" placeholder="8 or 11 character SWIFT code">
                </div>
            </div>
        </div>
    </div>

    <!-- Sub-Card 2: Cryptocurrency Payout Addresses -->
    <div class="settings-subcard">
        <div class="settings-subcard-header">
            <h5 class="settings-subcard-title">
                <i class="fa fa-coins text-warning f-18"></i>
                <span>Cryptocurrency Payout Addresses</span>
            </h5>
            <span class="badge bg-warning-subtle text-warning border border-warning" style="font-size: 11px;">Automated Liquidity</span>
        </div>

        <div class="row g-3 g-md-4">
            <!-- Bitcoin -->
            <div class="col-12 col-md-6">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <label class="form-label-custom mb-0">Bitcoin (BTC)</label>
                    <span class="badge" style="background: rgba(245, 158, 11, 0.15); color: #f59e0b; border: 1px solid rgba(245, 158, 11, 0.3); font-size: 10.5px;">BTC Native</span>
                </div>
                <div class="input-group-custom">
                    <i class="fab fa-bitcoin input-icon" style="color: #f59e0b;"></i>
                    <input type="text" name="btc_address" value="{{ Auth::user()->btc_address }}" class="form-control form-control-custom font-monospace" placeholder="1... or bc1... address">
                </div>
                <small class="text-muted f-11 mt-1 d-block">Destination wallet address for automated Bitcoin payouts.</small>
            </div>

            <!-- Ethereum -->
            <div class="col-12 col-md-6">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <label class="form-label-custom mb-0">Ethereum (ETH)</label>
                    <span class="badge" style="background: rgba(99, 98, 231, 0.15); color: #818cf8; border: 1px solid rgba(99, 98, 231, 0.3); font-size: 10.5px;">ERC-20</span>
                </div>
                <div class="input-group-custom">
                    <i class="fab fa-ethereum input-icon" style="color: #818cf8;"></i>
                    <input type="text" name="eth_address" value="{{ Auth::user()->eth_address }}" class="form-control form-control-custom font-monospace" placeholder="0x... address">
                </div>
                <small class="text-muted f-11 mt-1 d-block">Destination wallet address for automated Ethereum payouts.</small>
            </div>

            <!-- Litecoin -->
            <div class="col-12 col-md-6">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <label class="form-label-custom mb-0">Litecoin (LTC)</label>
                    <span class="badge" style="background: rgba(148, 163, 184, 0.15); color: #94a3b8; border: 1px solid rgba(148, 163, 184, 0.3); font-size: 10.5px;">LTC Native</span>
                </div>
                <div class="input-group-custom">
                    <i class="fa fa-coins input-icon" style="color: #94a3b8;"></i>
                    <input type="text" name="ltc_address" value="{{ Auth::user()->ltc_address }}" class="form-control form-control-custom font-monospace" placeholder="L... or ltc1... address">
                </div>
                <small class="text-muted f-11 mt-1 d-block">Destination wallet address for automated Litecoin payouts.</small>
            </div>

            <!-- USDT TRC20 -->
            <div class="col-12 col-md-6">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <label class="form-label-custom mb-0">Tether (USDT.TRC20)</label>
                    <span class="badge" style="background: rgba(16, 185, 129, 0.15); color: #10b981; border: 1px solid rgba(16, 185, 129, 0.3); font-size: 10.5px;">TRC-20 (Tron)</span>
                </div>
                <div class="input-group-custom">
                    <i class="fa fa-dollar-sign input-icon" style="color: #10b981;"></i>
                    <input type="text" name="usdt_address" value="{{ Auth::user()->usdt_address }}" class="form-control form-control-custom font-monospace" placeholder="T... address">
                </div>
                <small class="text-muted f-11 mt-1 d-block">Low-fee USDT TRC20 destination wallet address.</small>
            </div>
        </div>
    </div>

    <!-- Submit Button -->
    <div class="mt-2">
        <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill font-weight-600" id="btnSaveWithdrawal">
            <i class="fa fa-check-circle me-2"></i> Save Withdrawal Preferences
        </button>
    </div>
</form>

<script>
    document.getElementById('updatewithdrawalinfo').addEventListener('submit', function(e) {
        e.preventDefault();
        var btn = document.getElementById('btnSaveWithdrawal');
        var originalText = btn.innerHTML;
        btn.innerHTML = '<i class="fa fa-spinner fa-spin me-2"></i> Saving...';
        btn.disabled = true;

        $.ajax({
            url: "{{ route('updateacount') }}",
            type: 'POST',
            data: $('#updatewithdrawalinfo').serialize(),
            success: function(response) {
                btn.innerHTML = originalText;
                btn.disabled = false;
                if (response.status === 200) {
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Saved!',
                            text: response.success,
                            timer: 2500,
                            showConfirmButton: false,
                            toast: true,
                            position: 'top-end'
                        });
                    } else {
                        alert(response.success);
                    }
                }
            },
            error: function(xhr) {
                btn.innerHTML = originalText;
                btn.disabled = false;
                var errMessage = 'Failed to save withdrawal info. Please try again.';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errMessage = xhr.responseJSON.message;
                }
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: errMessage
                    });
                } else {
                    alert(errMessage);
                }
            }
        });
    });
</script>
