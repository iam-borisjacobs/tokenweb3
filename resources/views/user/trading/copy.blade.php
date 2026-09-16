@extends('layouts.dash')
@section('title', 'Institutional Copy Trading')

@section('content')
<div class="container-fluid py-3">
    <!-- Header Banner -->
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
        <div>
            <div class="d-flex align-items-center gap-2 mb-1">
                <span class="badge bg-purple bg-opacity-10 text-purple border border-purple border-opacity-25 px-2 py-1 rounded-pill f-11 f-w-700" style="color: #7c3aed; background-color: rgba(124, 58, 237, 0.1);">
                    <i class="fa-solid fa-medal me-1"></i> VERIFIED MASTER TRADERS
                </span>
                @if($isLocked)
                    <span class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25 px-2 py-1 rounded-pill f-11 f-w-700">
                        <i class="fa-solid fa-lock me-1"></i> Clearance Required
                    </span>
                @endif
            </div>
            <h4 class="f-w-800 text-dark mb-1">Institutional Copy Trading</h4>
            <p class="text-muted f-13 mb-0">Mirror audited high-frequency strategies from top-tier institutional asset managers in real-time.</p>
        </div>

        <div class="d-flex flex-wrap align-items-center gap-2">
            <a href="{{ route('aitrading') }}" class="btn btn-outline-secondary rounded-pill px-3 py-2 f-13 f-w-600">
                <i class="fa-solid fa-robot me-1"></i> AI Trading Bots
            </a>
            <a href="{{ route('mplans') }}" class="btn btn-primary rounded-pill px-3 py-2 f-13 f-w-700 shadow-sm">
                <i class="fa-solid fa-layer-group me-1"></i> Investment Plans
            </a>
        </div>
    </div>

    @if($isLocked)
    <!-- Institutional Clearance Banner -->
    <div class="card border-0 mb-4 text-white p-3 shadow-sm" style="background: linear-gradient(135deg, #1e1b4b 0%, #312e81 50%, #4338ca 100%); border-radius: 14px;">
        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
            <div class="d-flex align-items-center gap-3">
                <div class="rounded-circle bg-warning bg-opacity-20 d-flex align-items-center justify-content-center text-warning flex-shrink-0" style="width: 44px; height: 44px; font-size: 20px;">
                    <i class="fa-solid fa-shield-halved"></i>
                </div>
                <div>
                    <h6 class="text-white f-w-700 mb-1 f-14">Copy Trading Clearance Status: <span class="text-warning">Restricted</span></h6>
                    <p class="text-white text-opacity-80 f-12 mb-0">
                        Copying verified master trader portfolios requires qualified capital of <strong>{{ $settings->currency }}{{ number_format($settings->min_trading_balance, 2) }}</strong>. Your qualified balance is <strong>{{ $settings->currency }}{{ number_format($userTotalBalance, 2) }}</strong>.
                    </p>
                </div>
            </div>
            <div class="d-flex gap-2 flex-shrink-0">
                <button type="button" class="btn btn-warning text-dark rounded-pill px-3 py-2 f-12 f-w-700" onclick="window.openTradingClearanceModal(event, 'Copy Trading')">
                    <i class="fa-solid fa-unlock me-1"></i> Request Clearance
                </button>
                <a href="{{ route('deposits') }}" class="btn btn-outline-light rounded-pill px-3 py-2 f-12 f-w-600">
                    <i class="fa-solid fa-wallet me-1"></i> Deposit
                </a>
            </div>
        </div>
    </div>
    @endif

    <!-- Global Statistics Ribbon -->
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="card border shadow-sm h-100 p-3 mb-0" style="border-radius: 12px;">
                <small class="text-muted f-11 d-block mb-1">Active Copiers</small>
                <h5 class="f-w-800 text-dark mb-0 f-18">14,290+</h5>
                <small class="text-success f-10"><i class="fa-solid fa-arrow-trend-up me-1"></i>+12% this month</small>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border shadow-sm h-100 p-3 mb-0" style="border-radius: 12px;">
                <small class="text-muted f-11 d-block mb-1">Total Mirrored AUM</small>
                <h5 class="f-w-800 text-primary mb-0 f-18">$48.2 Million</h5>
                <small class="text-muted f-10">Audited custody balance</small>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border shadow-sm h-100 p-3 mb-0" style="border-radius: 12px;">
                <small class="text-muted f-11 d-block mb-1">Average Win Rate</small>
                <h5 class="f-w-800 text-success mb-0 f-18">91.4%</h5>
                <small class="text-muted f-10">Last 90 days rolling</small>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border shadow-sm h-100 p-3 mb-0" style="border-radius: 12px;">
                <small class="text-muted f-11 d-block mb-1">Latency SLA</small>
                <h5 class="f-w-800 text-dark mb-0 f-18">&lt; 15 ms</h5>
                <small class="text-success f-10"><i class="fa-solid fa-bolt me-1"></i>Ultra low slippage</small>
            </div>
        </div>
    </div>

    <!-- Filter Category Tabs -->
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-outline-primary active py-2 px-3 f-12" onclick="filterTraders('all', this)">All Master Traders</button>
            <button type="button" class="btn btn-outline-primary py-2 px-3 f-12" onclick="filterTraders('crypto', this)">Crypto Alphas</button>
            <button type="button" class="btn btn-outline-primary py-2 px-3 f-12" onclick="filterTraders('forex', this)">Forex Titans</button>
            <button type="button" class="btn btn-outline-primary py-2 px-3 f-12" onclick="filterTraders('arbitrage', this)">Low Drawdown</button>
        </div>
        <span class="text-muted f-12">Showing 6 Verified Institutional Leads</span>
    </div>

    <!-- Master Traders Cards Grid -->
    <div class="row g-4 mb-4" id="tradersGrid">
        <!-- Trader 1 -->
        <div class="col-md-6 col-lg-4 trader-card-item" data-cat="forex">
            <div class="card border shadow-sm h-100 mb-0" style="border-radius: 16px;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="d-flex align-items-center gap-3">
                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center f-w-800" style="width: 48px; height: 48px; font-size: 18px;">
                                AV
                            </div>
                            <div>
                                <h6 class="f-w-700 text-dark mb-0 f-15">Alexander Vance <i class="fa-solid fa-circle-check text-primary f-12" title="KYC & Performance Verified"></i></h6>
                                <small class="text-muted f-11">Apex Quantum FX • 6 yrs exp</small>
                            </div>
                        </div>
                        <span class="badge bg-success bg-opacity-10 text-success rounded-pill f-11 f-w-700 px-2 py-1">+342.8%</span>
                    </div>

                    <div class="d-flex gap-1 mb-3">
                        <span class="badge bg-light text-muted border f-10">EUR/USD</span>
                        <span class="badge bg-light text-muted border f-10">GBP/USD</span>
                        <span class="badge bg-light text-muted border f-10">HFT Scalp</span>
                    </div>

                    <div class="row g-2 text-center py-2 mb-3 bg-light rounded-3">
                        <div class="col-4 border-end">
                            <small class="text-muted f-10 d-block">Win Rate</small>
                            <span class="f-w-700 text-dark f-13">94.2%</span>
                        </div>
                        <div class="col-4 border-end">
                            <small class="text-muted f-10 d-block">Max DD</small>
                            <span class="f-w-700 text-success f-13">4.1%</span>
                        </div>
                        <div class="col-4">
                            <small class="text-muted f-10 d-block">Copiers</small>
                            <span class="f-w-700 text-dark f-13">1,842</span>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted f-11">AUM: <strong>$6,420,000</strong></span>
                        <span class="text-muted f-11">Risk Score: <span class="badge bg-success f-10">2 / 10</span></span>
                    </div>

                    <button type="button" class="btn btn-primary w-100 py-2 rounded-pill f-13 f-w-700 shadow-sm"
                            onclick="{{ $isLocked ? "window.openTradingClearanceModal(event, 'Copy Alexander Vance')" : "openCopyModal('Alexander Vance', 342.8, 94.2)" }}">
                        @if($isLocked)<i class="fa-solid fa-lock me-1"></i>@endif Copy Portfolio
                    </button>
                </div>
            </div>
        </div>

        <!-- Trader 2 -->
        <div class="col-md-6 col-lg-4 trader-card-item" data-cat="crypto">
            <div class="card border shadow-sm h-100 mb-0" style="border-radius: 16px;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="d-flex align-items-center gap-3">
                            <div class="rounded-circle bg-warning text-dark d-flex align-items-center justify-content-center f-w-800" style="width: 48px; height: 48px; font-size: 18px; background: #fbbf24;">
                                ER
                            </div>
                            <div>
                                <h6 class="f-w-700 text-dark mb-0 f-15">Elena Rostova <i class="fa-solid fa-circle-check text-primary f-12" title="KYC & Performance Verified"></i></h6>
                                <small class="text-muted f-11">Alpha Momentum Crypto • 4 yrs</small>
                            </div>
                        </div>
                        <span class="badge bg-success bg-opacity-10 text-success rounded-pill f-11 f-w-700 px-2 py-1">+288.4%</span>
                    </div>

                    <div class="d-flex gap-1 mb-3">
                        <span class="badge bg-light text-muted border f-10">BTC</span>
                        <span class="badge bg-light text-muted border f-10">ETH</span>
                        <span class="badge bg-light text-muted border f-10">Momentum</span>
                    </div>

                    <div class="row g-2 text-center py-2 mb-3 bg-light rounded-3">
                        <div class="col-4 border-end">
                            <small class="text-muted f-10 d-block">Win Rate</small>
                            <span class="f-w-700 text-dark f-13">91.8%</span>
                        </div>
                        <div class="col-4 border-end">
                            <small class="text-muted f-10 d-block">Max DD</small>
                            <span class="f-w-700 text-warning f-13">6.8%</span>
                        </div>
                        <div class="col-4">
                            <small class="text-muted f-10 d-block">Copiers</small>
                            <span class="f-w-700 text-dark f-13">2,190</span>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted f-11">AUM: <strong>$8,910,000</strong></span>
                        <span class="text-muted f-11">Risk Score: <span class="badge bg-primary f-10">3 / 10</span></span>
                    </div>

                    <button type="button" class="btn btn-primary w-100 py-2 rounded-pill f-13 f-w-700 shadow-sm"
                            onclick="{{ $isLocked ? "window.openTradingClearanceModal(event, 'Copy Elena Rostova')" : "openCopyModal('Elena Rostova', 288.4, 91.8)" }}">
                        @if($isLocked)<i class="fa-solid fa-lock me-1"></i>@endif Copy Portfolio
                    </button>
                </div>
            </div>
        </div>

        <!-- Trader 3 -->
        <div class="col-md-6 col-lg-4 trader-card-item" data-cat="arbitrage">
            <div class="card border shadow-sm h-100 mb-0" style="border-radius: 16px;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="d-flex align-items-center gap-3">
                            <div class="rounded-circle text-white d-flex align-items-center justify-content-center f-w-800" style="width: 48px; height: 48px; font-size: 18px; background: #059669;">
                                MC
                            </div>
                            <div>
                                <h6 class="f-w-700 text-dark mb-0 f-15">Marcus Chen <i class="fa-solid fa-circle-check text-primary f-12" title="KYC & Performance Verified"></i></h6>
                                <small class="text-muted f-11">Hyperion Arbitrage • 8 yrs</small>
                            </div>
                        </div>
                        <span class="badge bg-success bg-opacity-10 text-success rounded-pill f-11 f-w-700 px-2 py-1">+194.5%</span>
                    </div>

                    <div class="d-flex gap-1 mb-3">
                        <span class="badge bg-light text-muted border f-10">Cross-Venue</span>
                        <span class="badge bg-light text-muted border f-10">Delta Neutral</span>
                    </div>

                    <div class="row g-2 text-center py-2 mb-3 bg-light rounded-3">
                        <div class="col-4 border-end">
                            <small class="text-muted f-10 d-block">Win Rate</small>
                            <span class="f-w-700 text-dark f-13">97.4%</span>
                        </div>
                        <div class="col-4 border-end">
                            <small class="text-muted f-10 d-block">Max DD</small>
                            <span class="f-w-700 text-success f-13">1.8%</span>
                        </div>
                        <div class="col-4">
                            <small class="text-muted f-10 d-block">Copiers</small>
                            <span class="f-w-700 text-dark f-13">3,410</span>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted f-11">AUM: <strong>$14,250,000</strong></span>
                        <span class="text-muted f-11">Risk Score: <span class="badge bg-success f-10">1 / 10</span></span>
                    </div>

                    <button type="button" class="btn btn-primary w-100 py-2 rounded-pill f-13 f-w-700 shadow-sm"
                            onclick="{{ $isLocked ? "window.openTradingClearanceModal(event, 'Copy Marcus Chen')" : "openCopyModal('Marcus Chen', 194.5, 97.4)" }}">
                        @if($isLocked)<i class="fa-solid fa-lock me-1"></i>@endif Copy Portfolio
                    </button>
                </div>
            </div>
        </div>

        <!-- Trader 4 -->
        <div class="col-md-6 col-lg-4 trader-card-item" data-cat="commodities">
            <div class="card border shadow-sm h-100 mb-0" style="border-radius: 16px;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="d-flex align-items-center gap-3">
                            <div class="rounded-circle text-white d-flex align-items-center justify-content-center f-w-800" style="width: 48px; height: 48px; font-size: 18px; background: #ea580c;">
                                SJ
                            </div>
                            <div>
                                <h6 class="f-w-700 text-dark mb-0 f-15">Sarah Jenkins <i class="fa-solid fa-circle-check text-primary f-12"></i></h6>
                                <small class="text-muted f-11">Macro Commodities Fund • 5 yrs</small>
                            </div>
                        </div>
                        <span class="badge bg-success bg-opacity-10 text-success rounded-pill f-11 f-w-700 px-2 py-1">+164.2%</span>
                    </div>

                    <div class="d-flex gap-1 mb-3">
                        <span class="badge bg-light text-muted border f-10">Gold</span>
                        <span class="badge bg-light text-muted border f-10">Crude Oil</span>
                        <span class="badge bg-light text-muted border f-10">Silver</span>
                    </div>

                    <div class="row g-2 text-center py-2 mb-3 bg-light rounded-3">
                        <div class="col-4 border-end">
                            <small class="text-muted f-10 d-block">Win Rate</small>
                            <span class="f-w-700 text-dark f-13">88.6%</span>
                        </div>
                        <div class="col-4 border-end">
                            <small class="text-muted f-10 d-block">Max DD</small>
                            <span class="f-w-700 text-success f-13">5.2%</span>
                        </div>
                        <div class="col-4">
                            <small class="text-muted f-10 d-block">Copiers</small>
                            <span class="f-w-700 text-dark f-13">940</span>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted f-11">AUM: <strong>$4,120,000</strong></span>
                        <span class="text-muted f-11">Risk Score: <span class="badge bg-primary f-10">3 / 10</span></span>
                    </div>

                    <button type="button" class="btn btn-primary w-100 py-2 rounded-pill f-13 f-w-700 shadow-sm"
                            onclick="{{ $isLocked ? "window.openTradingClearanceModal(event, 'Copy Sarah Jenkins')" : "openCopyModal('Sarah Jenkins', 164.2, 88.6)" }}">
                        @if($isLocked)<i class="fa-solid fa-lock me-1"></i>@endif Copy Portfolio
                    </button>
                </div>
            </div>
        </div>

        <!-- Trader 5 -->
        <div class="col-md-6 col-lg-4 trader-card-item" data-cat="crypto">
            <div class="card border shadow-sm h-100 mb-0" style="border-radius: 16px;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="d-flex align-items-center gap-3">
                            <div class="rounded-circle text-white d-flex align-items-center justify-content-center f-w-800" style="width: 48px; height: 48px; font-size: 18px; background: #6366f1;">
                                VT
                            </div>
                            <div>
                                <h6 class="f-w-700 text-dark mb-0 f-15">Viktor Thorne <i class="fa-solid fa-circle-check text-primary f-12"></i></h6>
                                <small class="text-muted f-11">Deep Neural Scalper • 7 yrs</small>
                            </div>
                        </div>
                        <span class="badge bg-success bg-opacity-10 text-success rounded-pill f-11 f-w-700 px-2 py-1">+412.0%</span>
                    </div>

                    <div class="d-flex gap-1 mb-3">
                        <span class="badge bg-light text-muted border f-10">SOL</span>
                        <span class="badge bg-light text-muted border f-10">AVAX</span>
                        <span class="badge bg-light text-muted border f-10">AI Neural</span>
                    </div>

                    <div class="row g-2 text-center py-2 mb-3 bg-light rounded-3">
                        <div class="col-4 border-end">
                            <small class="text-muted f-10 d-block">Win Rate</small>
                            <span class="f-w-700 text-dark f-13">89.1%</span>
                        </div>
                        <div class="col-4 border-end">
                            <small class="text-muted f-10 d-block">Max DD</small>
                            <span class="f-w-700 text-warning f-13">8.4%</span>
                        </div>
                        <div class="col-4">
                            <small class="text-muted f-10 d-block">Copiers</small>
                            <span class="f-w-700 text-dark f-13">2,820</span>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted f-11">AUM: <strong>$9,840,000</strong></span>
                        <span class="text-muted f-11">Risk Score: <span class="badge bg-warning text-dark f-10">4 / 10</span></span>
                    </div>

                    <button type="button" class="btn btn-primary w-100 py-2 rounded-pill f-13 f-w-700 shadow-sm"
                            onclick="{{ $isLocked ? "window.openTradingClearanceModal(event, 'Copy Viktor Thorne')" : "openCopyModal('Viktor Thorne', 412.0, 89.1)" }}">
                        @if($isLocked)<i class="fa-solid fa-lock me-1"></i>@endif Copy Portfolio
                    </button>
                </div>
            </div>
        </div>

        <!-- Trader 6 -->
        <div class="col-md-6 col-lg-4 trader-card-item" data-cat="crypto">
            <div class="card border shadow-sm h-100 mb-0" style="border-radius: 16px;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="d-flex align-items-center gap-3">
                            <div class="rounded-circle text-white d-flex align-items-center justify-content-center f-w-800" style="width: 48px; height: 48px; font-size: 18px; background: #0284c7;">
                                DK
                            </div>
                            <div>
                                <h6 class="f-w-700 text-dark mb-0 f-15">David Kim <i class="fa-solid fa-circle-check text-primary f-12"></i></h6>
                                <small class="text-muted f-11">ETH DeFi Staking & Yield • 5 yrs</small>
                            </div>
                        </div>
                        <span class="badge bg-success bg-opacity-10 text-success rounded-pill f-11 f-w-700 px-2 py-1">+210.6%</span>
                    </div>

                    <div class="d-flex gap-1 mb-3">
                        <span class="badge bg-light text-muted border f-10">ETH</span>
                        <span class="badge bg-light text-muted border f-10">Lido</span>
                        <span class="badge bg-light text-muted border f-10">Layer 2</span>
                    </div>

                    <div class="row g-2 text-center py-2 mb-3 bg-light rounded-3">
                        <div class="col-4 border-end">
                            <small class="text-muted f-10 d-block">Win Rate</small>
                            <span class="f-w-700 text-dark f-13">93.0%</span>
                        </div>
                        <div class="col-4 border-end">
                            <small class="text-muted f-10 d-block">Max DD</small>
                            <span class="f-w-700 text-success f-13">3.5%</span>
                        </div>
                        <div class="col-4">
                            <small class="text-muted f-10 d-block">Copiers</small>
                            <span class="f-w-700 text-dark f-13">1,290</span>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted f-11">AUM: <strong>$4,830,000</strong></span>
                        <span class="text-muted f-11">Risk Score: <span class="badge bg-success f-10">2 / 10</span></span>
                    </div>

                    <button type="button" class="btn btn-primary w-100 py-2 rounded-pill f-13 f-w-700 shadow-sm"
                            onclick="{{ $isLocked ? "window.openTradingClearanceModal(event, 'Copy David Kim')" : "openCopyModal('David Kim', 210.6, 93.0)" }}">
                        @if($isLocked)<i class="fa-solid fa-lock me-1"></i>@endif Copy Portfolio
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal: Configure Copy Trading -->
<div class="modal fade" id="configureCopyModal" tabindex="-1" aria-labelledby="configureCopyLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 480px;">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 16px;">
            <div class="modal-header border-bottom py-3 px-4">
                <div class="d-flex align-items-center gap-2">
                    <i class="fa-solid fa-clone text-primary f-18"></i>
                    <h6 class="modal-title f-w-700 text-dark mb-0 f-15" id="configureCopyLabel">Mirror Master Trader</h6>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="p-3 bg-light rounded-3 mb-3">
                    <div class="d-flex justify-content-between mb-1">
                        <span class="text-muted f-12">Selected Master:</span>
                        <strong class="text-dark f-12" id="copyTraderName">Alexander Vance</strong>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="text-muted f-12">Historical ROI / Win Rate:</span>
                        <span class="text-success f-w-700 f-12" id="copyTraderStats">+342.8% • 94.2%</span>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label f-12 f-w-600 text-muted mb-1">Allocation Capital ($)</label>
                    <div class="input-group">
                        <span class="input-group-text f-12">{{ $settings->currency }}</span>
                        <input type="number" step="any" min="100" class="form-control f-12" id="copyAmount" value="5000" placeholder="5000.00">
                    </div>
                    <small class="text-muted f-11">Available Balance: {{ $settings->currency }}{{ number_format(Auth::user()->account_bal, 2) }}</small>
                </div>

                <div class="mb-3">
                    <label class="form-label f-12 f-w-600 text-muted mb-1">Stop Copy Loss Protection</label>
                    <select class="form-select f-12">
                        <option value="5">Stop if drawdown reaches 5%</option>
                        <option value="10" selected>Stop if drawdown reaches 10%</option>
                        <option value="15">Stop if drawdown reaches 15%</option>
                    </select>
                </div>

                <button type="button" class="btn btn-primary w-100 py-2 rounded-pill f-13 f-w-700 shadow-sm" onclick="confirmCopyTrading()">
                    <i class="fa-solid fa-play me-1"></i> Confirm & Start Mirroring
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function filterTraders(cat, btn) {
        var buttons = btn.parentElement.querySelectorAll('button');
        buttons.forEach(b => b.classList.remove('active'));
        btn.classList.add('active');

        var items = document.querySelectorAll('.trader-card-item');
        items.forEach(it => {
            if (cat === 'all' || it.getAttribute('data-cat') === cat) {
                it.style.display = '';
            } else {
                it.style.display = 'none';
            }
        });
    }

    function openCopyModal(name, roi, winrate) {
        document.getElementById('copyTraderName').innerText = name;
        document.getElementById('copyTraderStats').innerText = '+' + roi + '% • ' + winrate + '%';
        var m = new bootstrap.Modal(document.getElementById('configureCopyModal'));
        m.show();
    }

    function confirmCopyTrading() {
        var amt = document.getElementById('copyAmount').value;
        var name = document.getElementById('copyTraderName').innerText;
        var modalEl = document.getElementById('configureCopyModal');
        var modalInstance = bootstrap.Modal.getInstance(modalEl);
        if (modalInstance) modalInstance.hide();

        if (window.toastr) {
            toastr.success(`Successfully connected portfolio to ${name} with allocation of $${amt}!`);
        } else {
            alert(`Successfully connected portfolio to ${name}!`);
        }
    }
</script>
@endsection
