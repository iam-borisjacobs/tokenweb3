<div>
    <!-- Page Header & Action Bar -->
    <div class="row mb-4">
        <div class="col-12 d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3">
            <div>
                <h3 class="f-w-700 mb-1">
                    <i class="fa fa-wallet text-primary me-2"></i> Fund Trading Wallet
                </h3>
                <p class="text-muted mb-0 f-13">Add funds to your master trading pool for MT4/MT5 copy trading account provisioning.</p>
            </div>
            <div>
                <a href="{{ route('tsettings') }}" class="btn btn-outline-primary btn-sm rounded-pill px-3">
                    <i class="fa fa-arrow-left me-1"></i> Back to Trading Settings
                </a>
            </div>
        </div>
    </div>

    <x-danger-alert />
    <x-success-alert />

    <div class="row justify-content-center">
        <div class="col-lg-8 col-xl-6">
            <div class="card p-4 shadow-sm border-0">
                @if (!$toPay)
                    <form wire:submit.prevent="setToPay">
                        <div class="text-center mb-4">
                            <div class="rounded-circle bg-light-primary text-primary d-inline-flex align-items-center justify-content-center mb-2" style="width: 52px; height: 52px; font-size: 22px;">
                                <i class="fa fa-dollar-sign"></i>
                            </div>
                            <h5 class="f-w-700 text-dark mb-1">Enter Deposit Amount</h5>
                            <p class="text-muted f-12 mb-0">Specify the USD value you wish to credit to the trading pool.</p>
                        </div>

                        <div class="mb-4">
                            <label class="form-label f-w-600 f-13">Amount (USD) <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 fw-bold">$</span>
                                <input type="number" step="any" wire:model.defer="amount" class="form-control border-start-0" placeholder="e.g. 500.00" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label f-w-600 f-13">Payment Method</label>
                            <div class="d-flex justify-content-center">
                                <div class="p-3 bg-light rounded-3 text-center border border-primary d-inline-flex align-items-center gap-3 px-4 shadow-sm" style="cursor: pointer;">
                                    <img src="{{ asset('dash/tether-usdt-logo.png') }}" alt="Tether USDT" style="width: 30px; height: 30px;">
                                    <div class="text-start">
                                        <div class="f-w-700 text-dark mb-0">Tether (USDT)</div>
                                        <small class="text-muted f-11">TRC20 / ERC20 Network</small>
                                    </div>
                                    <i class="fa fa-check-circle text-primary ms-2 f-18"></i>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary rounded-pill py-2 f-w-600 shadow-sm">
                                <i class="fa fa-arrow-right me-1"></i> Continue to Payment
                            </button>
                        </div>
                    </form>
                @else
                    <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom">
                        <h6 class="f-w-700 text-dark mb-0">Payment Instructions</h6>
                        <button type="button" class="btn btn-outline-secondary btn-sm rounded-pill px-3" wire:click="unSetToPay">
                            <i class="fa fa-arrow-left me-1"></i> Change Amount
                        </button>
                    </div>

                    <div class="p-3 bg-light rounded-3 text-center mb-4">
                        <span class="text-muted f-12 d-block mb-1">Please transfer exactly:</span>
                        <h3 class="f-w-800 text-primary mb-2">${{ number_format((float)$amount, 2) }} {{ $method }}</h3>
                        <span class="badge bg-light-warning text-warning px-3 py-1 rounded-pill f-11">
                            Awaiting Transfer Confirmation
                        </span>
                    </div>

                    <div class="mb-4">
                        <label class="form-label f-w-600 f-13">Recipient Wallet Address</label>
                        <div class="input-group">
                            <input type="text" class="form-control font-monospace f-12 bg-white" id="destWalletAddress" value="{{ $walletAddress }}" readonly>
                            <button class="btn btn-outline-primary" type="button" onclick="copyWalletAddress()">
                                <i class="fa fa-copy me-1"></i> Copy
                            </button>
                        </div>
                        <small class="text-muted f-11 mt-1 d-block">
                            Send only {{ $method }} to this address. Sending any other asset may result in permanent loss.
                        </small>
                    </div>

                    <form wire:submit.prevent="completePayment">
                        <div class="d-grid">
                            <button type="submit" class="btn btn-success rounded-pill py-2 f-w-600 shadow-sm">
                                <i class="fa fa-check-circle me-1"></i> I Have Completed This Payment
                            </button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    function copyWalletAddress() {
        var input = document.getElementById('destWalletAddress');
        if (input) {
            input.select();
            input.setSelectionRange(0, 99999);
            navigator.clipboard.writeText(input.value).then(function() {
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Copied!',
                        text: 'Wallet address copied to clipboard.',
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 2000
                    });
                } else {
                    alert('Wallet address copied to clipboard.');
                }
            });
        }
    }
</script>
