<div class="row g-3 mb-4">
    <!-- Slot Card -->
    <div class="col-md-4">
        <div class="card p-3 shadow-sm border-0 rounded-3 h-100">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 46px; height: 46px; background: rgba(245, 158, 11, 0.12); color: #f59e0b; font-size: 18px;">
                        <i class="fa-solid fa-layer-group"></i>
                    </div>
                    <div>
                        <span class="text-muted f-12 f-w-600 d-block mb-0">Trading Slots</span>
                        <h4 class="f-w-800 text-dark mb-0">
                            {{ ($myaccount && !empty($myaccount['trading_account_slot'])) ? $myaccount['trading_account_slot'] : '0' }}
                        </h4>
                    </div>
                </div>
                <button type="button" class="btn btn-outline-primary btn-sm rounded-pill px-3 py-1 f-12 f-w-600" data-bs-toggle="modal" data-bs-target="#buySlotModal">
                    <i class="fa-solid fa-cart-plus me-1"></i> Buy Slot
                </button>
            </div>
        </div>
    </div>

    <!-- Buy Slot Modal -->
    <div class="modal fade" id="buySlotModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header border-bottom pb-3">
                    <h5 class="modal-title f-w-700 text-dark">
                        <i class="fa-solid fa-cart-plus text-primary me-2"></i> Purchase Trading Slots
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <livewire:admin.buy-slot />
                </div>
            </div>
        </div>
    </div>

    <!-- Wallet Balance Card -->
    <div class="col-md-4">
        <div class="card p-3 shadow-sm border-0 rounded-3 h-100">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 46px; height: 46px; background: rgba(99, 98, 231, 0.12); color: #6362e7; font-size: 18px;">
                        <i class="fa-solid fa-wallet"></i>
                    </div>
                    <div>
                        <span class="text-muted f-12 f-w-600 d-block mb-0">Wallet Balance</span>
                        <h4 class="f-w-800 text-primary mb-0">
                            ${{ ($myaccount && !empty($myaccount['wallet_balance'])) ? number_format($myaccount['wallet_balance'], 2, '.') : '0.00' }}
                        </h4>
                    </div>
                </div>
                <a href="{{ route('tra.pay') }}" class="btn btn-primary btn-sm rounded-pill px-3 py-1 f-12 f-w-600 shadow-sm">
                    <i class="fa-solid fa-plus me-1"></i> Topup
                </a>
            </div>
        </div>
    </div>

    <!-- Subscriber Accounts Card -->
    <div class="col-md-4">
        <div class="card p-3 shadow-sm border-0 rounded-3 h-100">
            <div class="d-flex align-items-center gap-3">
                <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 46px; height: 46px; background: rgba(16, 185, 129, 0.12); color: #10b981; font-size: 18px;">
                    <i class="fa-solid fa-users"></i>
                </div>
                <div>
                    <span class="text-muted f-12 f-w-600 d-block mb-0">Subscriber Accounts</span>
                    <h4 class="f-w-800 text-success mb-0">
                        {{ (!empty($data['data']) && is_countable($data['data'])) ? count($data['data']) : '0' }}
                    </h4>
                </div>
            </div>
        </div>
    </div>
</div>
