@php
    $settings = $settings ?? \App\Models\Settings::where('id', 1)->first();
    $user = Auth::user();
    $minBalance = floatval($settings->min_trading_balance ?? 100000.00);
    $userBalance = \App\Models\Settings::getUserTotalTradingBalance($user);
    $progressPercent = $minBalance > 0 ? min(100, round(($userBalance / $minBalance) * 100, 1)) : 100;
    $remainingBalance = max(0, $minBalance - $userBalance);
@endphp

<!-- Institutional Trading Clearance Modal -->
<div class="modal fade trading-clearance-modal" id="tradingClearanceModal" tabindex="-1" aria-labelledby="tradingClearanceModalLabel" aria-hidden="true" style="z-index: 1085;">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 480px; margin: auto;">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden position-relative" style="background-color: #ffffff;">
            <!-- Top Gradient Rail -->
            <div style="height: 5px; background: linear-gradient(90deg, #f59e0b 0%, #ef4444 50%, #6362e7 100%);"></div>

            <div class="modal-header border-0 pb-0 pt-3 px-4 d-flex align-items-center justify-content-between">
                <span class="badge bg-warning bg-opacity-10 text-warning rounded-pill px-3 py-1 f-12 f-w-700 border border-warning border-opacity-25">
                    <i class="fa-solid fa-lock me-1"></i> Tier Clearance Required
                </span>
                <button type="button" class="btn-close f-12" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body px-4 py-3 text-center">
                <!-- Golden Lock Icon Emblem -->
                <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3 shadow-sm" style="width: 68px; height: 68px; background: linear-gradient(135deg, rgba(245, 158, 11, 0.15) 0%, rgba(239, 68, 68, 0.1) 100%); border: 2px solid rgba(245, 158, 11, 0.35); color: #d97706; font-size: 28px;">
                    <i class="fa-solid fa-lock"></i>
                </div>

                <h5 class="f-w-800 text-dark mb-1" style="letter-spacing: -0.02em;">
                    Trading Clearance Required
                </h5>
                <p class="text-muted f-13 mb-3" style="line-height: 1.5;">
                    Access to <strong class="text-dark" id="clearanceTargetFeature">Live Trading & Execution</strong> requires verified Tier-1 account qualification.
                </p>

                <!-- Balance Breakdown Card -->
                <div class="p-3 rounded-3 text-start mb-3" style="background: rgba(99, 98, 231, 0.04); border: 1px solid rgba(99, 98, 231, 0.12);">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <span class="text-muted f-12 fw-semibold">Required Minimum:</span>
                        <span class="f-13 f-w-800 text-dark">{{ $settings->currency ?? '$' }}{{ number_format($minBalance, 2) }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-muted f-12 fw-semibold">Your Verified Balance:</span>
                        <span class="f-13 f-w-700 text-primary">{{ $settings->currency ?? '$' }}{{ number_format($userBalance, 2) }}</span>
                    </div>

                    <!-- Progress Bar -->
                    <div class="progress rounded-pill mb-1" style="height: 7px; background-color: #e2e8f0;">
                        <div class="progress-bar rounded-pill bg-warning" role="progressbar" style="width: {{ $progressPercent }}%;" aria-valuenow="{{ $progressPercent }}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center text-muted f-11">
                        <span>{{ $progressPercent }}% qualified</span>
                        <span>Shortfall: <strong class="text-danger">{{ $settings->currency ?? '$' }}{{ number_format($remainingBalance, 2) }}</strong></span>
                    </div>
                </div>

                <p class="text-muted f-12 mb-3">
                    <i class="fa-solid fa-shield-halved text-success me-1"></i> Fund your account or synchronize your multi-chain Web3 wallet to instantly unlock real-time execution.
                </p>

                <!-- Action CTA Buttons -->
                <div class="d-grid gap-2">
                    <a href="{{ route('deposits') }}" class="btn btn-primary rounded-pill py-2 f-13 f-w-700 shadow-sm d-flex align-items-center justify-content-center gap-2">
                        <i class="fa-solid fa-wallet"></i> Deposit Funds Now
                    </a>
                    <a href="{{ route('connect.wallet') }}" class="btn btn-outline-primary rounded-pill py-2 f-13 f-w-700 d-flex align-items-center justify-content-center gap-2">
                        <i class="fa-solid fa-link"></i> Connect External Wallet
                    </a>
                </div>
            </div>

            <div class="modal-footer border-0 pt-0 pb-3 px-4 justify-content-center">
                <button type="button" class="btn btn-link text-muted f-12 text-decoration-none p-0" data-bs-dismiss="modal">
                    Close Notice
                </button>
            </div>
        </div>
    </div>
</div>

<style>
    body.dark-only .trading-clearance-modal .modal-content {
        background-color: #1a2234 !important;
        border: 1px solid rgba(255, 255, 255, 0.08) !important;
    }
    body.dark-only .trading-clearance-modal .text-dark {
        color: #f1f5f9 !important;
    }
    body.dark-only .trading-clearance-modal .progress {
        background-color: rgba(255, 255, 255, 0.1) !important;
    }
    body.dark-only .trading-clearance-modal .btn-close {
        filter: invert(1);
    }
</style>

<script>
    window.openTradingClearanceModal = function(e, featureName) {
        if (e && e.preventDefault) {
            e.preventDefault();
            e.stopPropagation();
        }
        var modalEl = document.getElementById('tradingClearanceModal');
        if (featureName) {
            var featEl = document.getElementById('clearanceTargetFeature');
            if (featEl) featEl.textContent = featureName;
        }
        if (modalEl && typeof bootstrap !== 'undefined') {
            var modal = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
            modal.show();
        }
    };
</script>
