@extends('layouts.dash')
@section('title', 'Dashboard Overview')

@section('content')
@php
    $isDemo = request()->get('mode') === 'demo';
    $demoBal = 88140.00;
    $btcPrice = 110000;
    $btcEquiv = Auth::user()->account_bal > 0 ? number_format(Auth::user()->account_bal / $btcPrice, 6) : '0.011569';
@endphp

<!-- Page Title & Hero Header -->
<div class="container-fluid mb-4">
    <div class="row align-items-center justify-content-between g-3">
        <div class="col-sm-auto">
            <h3 class="f-w-800 text-dark mb-1" style="letter-spacing: -0.02em;">Welcome back, {{ Auth::user()->name }}!</h3>
            <p class="text-muted mb-0 f-13">Your investment dashboard overview</p>
        </div>
        <div class="col-sm-auto d-flex align-items-center gap-2">
            <a href="{{ route('connect.wallet') }}" class="btn btn-primary rounded-pill px-3 py-2 d-inline-flex align-items-center gap-2 f-13 f-w-600 shadow-sm">
                <i class="fa-solid fa-link"></i>
                <span>Connect Wallet</span>
            </a>
            
        </div>
    </div>
</div>




    
<style>
    .web3-vault-card {
        background: linear-gradient(145deg, #f8fafc 0%, #eef2ff 100%);
        border: 1px solid rgba(99, 102, 241, 0.22);
        border-radius: 14px;
        padding: 14px 15px;
        cursor: pointer;
        transition: all 0.28s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }
    body.dark-only .web3-vault-card {
        background: linear-gradient(145deg, rgba(28, 36, 68, 0.85) 0%, rgba(15, 21, 46, 0.95) 100%);
        border: 1px solid rgba(99, 102, 241, 0.35);
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.4), inset 0 1px 0 rgba(255, 255, 255, 0.1);
    }
    .web3-vault-card:hover {
        transform: translateY(-2px);
        border-color: #6366f1 !important;
        box-shadow: 0 12px 28px -4px rgba(99, 102, 241, 0.35) !important;
    }
    .web3-vault-card:hover .transition-arrow {
        transform: translateX(4px);
    }
    .transition-arrow {
        transition: transform 0.2s ease;
    }
    .pulse-beacon {
        width: 7px;
        height: 7px;
        background-color: #10b981;
        border-radius: 50%;
        display: inline-block;
        box-shadow: 0 0 0 2px rgba(16, 185, 129, 0.35);
        animation: beaconPulse 2s infinite;
    }
    @keyframes beaconPulse {
        0% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7); }
        70% { box-shadow: 0 0 0 6px rgba(16, 185, 129, 0); }
        100% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
    }
    .avatar-circle-sm {
        width: 26px;
        height: 26px;
        border-radius: 50%;
        background-color: #ffffff;
        border: 2px solid #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.15);
        overflow: hidden;
    }
    body.dark-only .avatar-circle-sm {
        background-color: #1a2238;
        border-color: #1e293b;
    }
    .vault-btn-pill {
        background: rgba(99, 102, 241, 0.14);
        border: 1px solid rgba(99, 102, 241, 0.28);
        color: #4f46e5;
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        transition: all 0.2s ease;
    }
    body.dark-only .vault-btn-pill {
        background: rgba(99, 102, 241, 0.22);
        border-color: rgba(99, 102, 241, 0.45);
        color: #c7d2fe;
    }
    .web3-vault-card:hover .vault-btn-pill {
        background: #4f46e5;
        color: #ffffff;
        border-color: #4f46e5;
        box-shadow: 0 3px 10px rgba(79, 70, 229, 0.4);
    }
    body.dark-only .vault-amount {
        color: #ffffff !important;
        text-shadow: 0 2px 10px rgba(99, 102, 241, 0.25);
    }
</style>

    <!-- Top Row: 2 Featured Large Cards (Account Balance & Connected Wallets Vault - Open & Spread) -->
    <div class="row g-3 mb-3">
        <!-- 1. Connected Wallets Vault Card (Open & Spread Across Desktop) -->
        <div class="col-lg-6 col-12">
            <div class="card h-100 shadow-sm border position-relative overflow-hidden" style="border-radius: 14px;">
                <div class="card-body p-4 d-flex flex-column justify-content-between">
                    <div>
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="d-flex align-items-center gap-2">
                                <div class="rounded-3 bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center" style="width: 42px; height: 42px; font-size: 18px;">
                                    <i class="fa-solid fa-link"></i>
                                </div>
                                <div>
                                    <h6 class="f-w-700 text-dark mb-0 f-14">Connected Wallets Vault</h6>
                                    <small class="text-muted f-11">Synchronized external multi-chain assets</small>
                                </div>
                            </div>
                            <span class="badge bg-light-success text-success rounded-pill f-11 px-3 py-1.5">
                                <span class="pulse-beacon me-1"></span> Live Sync
                            </span>
                        </div>

                        <div class="f-w-800 text-dark mb-2 vault-amount" style="font-size: 2.2rem; letter-spacing: -0.02em; line-height: 1.1;">
                            {{ $settings->currency }}{{ number_format($totalWalletBal ?? 0, 2) }}
                        </div>

                        <div class="d-flex flex-wrap align-items-center gap-2 mb-3">
                            <!-- Overlapping Brand Avatars -->
                            <div class="d-flex align-items-center">
                                @php $shownCount = 0; @endphp
                                @foreach(($userWallets ?? collect())->take(4) as $uw)
                                    @php
                                        $prov = strtolower(trim($uw->wallet_provider ?? ''));
                                        $uIcon = null;
                                        if (isset($walletTypes)) {
                                            $m = $walletTypes->get($prov);
                                            if (!$m) {
                                                $m = $walletTypes->first(function($wt, $k) use ($prov) {
                                                    return str_contains($prov, (string)$k) || str_contains((string)$k, $prov);
                                                });
                                            }
                                            if ($m && !empty($m->icon_url)) {
                                                $uIcon = $m->icon_url;
                                            }
                                        }
                                        if (!$uIcon) {
                                            if (str_contains($prov, 'metamask')) {
                                                $uIcon = asset('assets/wallet-types/icons/1NS1POo31VhHeJuQOv2IOgLwI6jAe8KK6QG2WLPI.png');
                                            } elseif (str_contains($prov, 'trust')) {
                                                $uIcon = asset('assets/wallet-types/icons/kxF43fXtB3B0m0C8Tz5ZZ3ckEYwKZFHCVJOh1BVr.png');
                                            } elseif (str_contains($prov, 'coinbase')) {
                                                $uIcon = asset('assets/wallet-types/icons/fW86jwztjOyUCIiaf8XX7bAmxPx2BCwtRMy9RK5Z.jpg');
                                            } elseif (str_contains($prov, 'bakkt')) {
                                                $uIcon = asset('assets/wallet-types/icons/yRqNYjy782hPVqJXhrvKuYqMe9FcnJegeSzDO5Ok.png');
                                            }
                                        }
                                    @endphp
                                    <div class="avatar-circle-sm d-flex align-items-center justify-content-center bg-white border" style="width: 28px; height: 28px; z-index: {{ 4 - $shownCount }}; margin-left: {{ $shownCount > 0 ? '-8px' : '0' }}; overflow: hidden;" title="{{ $uw->wallet_provider }}">
                                        @if($uIcon)
                                            <img src="{{ $uIcon }}" alt="{{ $uw->wallet_provider }}" style="width: 20px; height: 20px; object-fit: contain;" onerror="this.outerHTML='<i class=\'fa-solid fa-wallet text-warning f-11\'></i>'">
                                        @else
                                            <i class="fa-solid fa-wallet text-primary f-11"></i>
                                        @endif
                                    </div>
                                    @php $shownCount++; @endphp
                                @endforeach
                            </div>
                            <span class="badge bg-primary bg-opacity-15 text-primary rounded-pill f-11 px-2.5 py-1 f-w-700">
                                {{ ($userWallets ?? collect())->count() }} {{ \Illuminate\Support\Str::plural('Wallet', ($userWallets ?? collect())->count()) }} Connected
                            </span>
                            <span class="text-muted f-11 ms-auto">
                                <i class="fa-solid fa-shield-check text-success me-1"></i> End-to-End Encrypted
                            </span>
                        </div>
                    </div>

                    <div class="d-flex gap-2 pt-2 border-top">
                        <button type="button" class="btn btn-primary flex-fill rounded-pill py-2 f-13 f-w-600 shadow-sm" data-bs-toggle="modal" data-bs-target="#walletsBreakdownModal">
                            <i class="fa-solid fa-list-check me-1"></i> Wallets Breakdown
                        </button>
                        <a href="{{ route('connect.wallet') }}" class="btn btn-outline-primary flex-fill rounded-pill py-2 f-13 f-w-600">
                            <i class="fa-solid fa-plus me-1"></i> Connect Another
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- 2. Account Balance Card -->
        <div class="col-lg-6 col-12">
            <div class="card h-100 shadow-sm border">
                <div class="card-body p-4 d-flex flex-column justify-content-between">
                    <div>
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="d-flex align-items-center gap-2">
                                <div class="rounded-3 bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center" style="width: 42px; height: 42px; font-size: 18px;">
                                    <i class="fa-solid fa-wallet"></i>
                                </div>
                                <div>
                                    <h6 class="f-w-700 text-dark mb-0 f-14">Account Balance</h6>
                                    <small class="text-muted f-11">Your available trading funds</small>
                                </div>
                            </div>
                            <span class="badge bg-light-success text-success rounded-pill f-11 px-3 py-1.5">
                                <span class="pulse-beacon me-1"></span> Active Trading
                            </span>
                        </div>

                        <div class="f-w-800 text-dark mb-2" style="font-size: 2.2rem; letter-spacing: -0.02em; line-height: 1.1;">
                            {{ $settings->currency }}{{ number_format($isDemo ? $demoBal : Auth::user()->account_bal, 2, '.', ',') }}
                        </div>

                        <div class="d-flex flex-wrap align-items-center gap-2 mb-3">
                            <span class="badge bg-warning text-dark f-11 px-2.5 py-1 rounded-pill">
                                <i class="fa-brands fa-bitcoin me-1"></i> {{ $btcEquiv }} BTC
                            </span>
                            <span class="badge badge-subtle-neutral f-11 px-2.5 py-1 rounded-pill">
                                <i class="fa-solid fa-circle-check text-success me-1"></i> Available
                            </span>
                            @if(Auth::user()->account_verify == 'Verified')
                                <span class="badge bg-success text-white f-11 px-2.5 py-1 rounded-pill">
                                    <i class="fa-solid fa-circle-check me-1"></i> Verified
                                </span>
                            @else
                                <span class="badge bg-danger text-white f-11 px-2.5 py-1 rounded-pill">
                                    <i class="fa-solid fa-circle-xmark me-1"></i> Unverified
                                </span>
                            @endif
                            <span class="text-muted f-11 ms-auto">
                                <i class="fa-regular fa-clock me-1"></i> {{ now()->format('M d, Y h:i A') }}
                            </span>
                        </div>
                    </div>

                    <div class="d-flex gap-2 pt-2 border-top">
                        <a href="{{ route('deposits') }}" class="btn btn-outline-primary flex-fill rounded-pill py-2 f-13 f-w-600">
                            <i class="fa-solid fa-circle-plus me-1"></i> Deposit
                        </a>
                        <a href="{{ route('withdrawalsdeposits') }}" class="btn btn-outline-secondary flex-fill rounded-pill py-2 f-13 f-w-600">
                            <i class="fa-solid fa-arrow-up-right-from-square me-1"></i> Withdraw
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 4 Secondary Metric Cards (Side-by-Side with Side Icons) -->
    <div class="row g-3 mb-4">
        <!-- Total Profit -->
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card h-100 shadow-sm border">
                <div class="card-body p-3 d-flex align-items-center justify-content-between">
                    <div class="d-flex flex-column justify-content-between h-100">
                        <span class="f-w-600 text-muted f-12 mb-1">Total Profit</span>
                        <h4 class="f-w-800 text-dark mb-1">
                            {{ $settings->currency }}{{ number_format(Auth::user()->roi, 2, '.', ',') }}
                        </h4>
                        <div class="f-11 text-muted">
                            <i class="fa-regular fa-calendar-days me-1"></i> Last period
                        </div>
                    </div>
                    <div class="metric-icon-circle primary flex-shrink-0 ms-2" style="width: 46px; height: 46px; font-size: 18px;">
                        <i class="fa-solid fa-dollar-sign"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Deposit -->
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card h-100 shadow-sm border">
                <div class="card-body p-3 d-flex align-items-center justify-content-between">
                    <div class="d-flex flex-column justify-content-between h-100">
                        <span class="f-w-600 text-muted f-12 mb-1">Total Deposit</span>
                        <h4 class="f-w-800 text-dark mb-1">
                            {{ $settings->currency }}{{ number_format($deposited, 2, '.', ',') }}
                        </h4>
                        <div class="f-11 text-muted">
                            <i class="fa-regular fa-calendar-days me-1"></i> All time
                        </div>
                    </div>
                    <div class="metric-icon-circle success flex-shrink-0 ms-2" style="width: 46px; height: 46px; font-size: 18px;">
                        <i class="fa-solid fa-arrow-down"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Withdrawal -->
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card h-100 shadow-sm border">
                <div class="card-body p-3 d-flex align-items-center justify-content-between">
                    <div class="d-flex flex-column justify-content-between h-100">
                        <span class="f-w-600 text-muted f-12 mb-1">Total Withdrawal</span>
                        <h4 class="f-w-800 text-dark mb-1">
                            {{ $settings->currency }}{{ number_format($total_withdrawal, 2, '.', ',') }}
                        </h4>
                        <div class="f-11 text-muted">
                            <i class="fa-regular fa-calendar-days me-1"></i> All time
                        </div>
                    </div>
                    <div class="metric-icon-circle info flex-shrink-0 ms-2" style="width: 46px; height: 46px; font-size: 18px;">
                        <i class="fa-solid fa-arrow-up"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bonus -->
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card h-100 shadow-sm border">
                <div class="card-body p-3 d-flex align-items-center justify-content-between">
                    <div class="d-flex flex-column justify-content-between h-100">
                        <span class="f-w-600 text-muted f-12 mb-1">Bonus</span>
                        <h4 class="f-w-800 text-dark mb-1">
                            {{ $settings->currency }}{{ number_format(Auth::user()->bonus, 2, '.', ',') }}
                        </h4>
                        <div class="f-11 text-muted">
                            <i class="fa-regular fa-calendar-days me-1"></i> All time
                        </div>
                    </div>
                    <div class="metric-icon-circle warning flex-shrink-0 ms-2" style="width: 46px; height: 46px; font-size: 18px;">
                        <i class="fa-solid fa-gift"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Identity Verification Card Banner -->
    <div class="card border shadow-sm mb-4">
        <div class="card-body p-3 d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
            <div class="d-flex align-items-center gap-3">
                <div class="rounded-3 d-flex align-items-center justify-content-center text-primary" style="width: 44px; height: 44px; font-size: 20px; background: rgba(99, 98, 231, 0.12);">
                    <i class="fa-solid fa-shield-halved"></i>
                </div>
                <div>
                    <h6 class="f-w-700 text-dark mb-0 f-14">Identity Verification</h6>
                    <small class="text-muted f-12">
                        @if(Auth::user()->account_verify == 'Verified')
                            Your account is fully verified. All features and higher limits are enabled.
                        @else
                            Complete verification to access all trading features and increase withdrawal limits.
                        @endif
                    </small>
                </div>
            </div>
            <div>
                <a href="{{ route('account.verify') }}" class="btn btn-primary rounded-pill px-3 py-2 f-12 f-w-600">
                    <span>View Details</span> <i class="fa-solid fa-chevron-down ms-1 f-10"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="container-fluid">
    @if(!empty($mod['trading_section']))
    <!-- Live / Demo Trading Account Banner -->
    <div class="card border-0 mb-4 shadow-sm text-white" id="liveTradingAccountBanner" style="{{ $isDemo ? 'background: linear-gradient(135deg, #059669 0%, #10b981 100%);' : 'background: var(--theme-gradient, linear-gradient(135deg, #4f46e5 0%, #3b82f6 100%)) !important;' }} border-radius: 14px;">
        <div class="card-body p-4 d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
            <div class="d-flex align-items-center gap-3">
                <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 52px; height: 52px; font-size: 24px; background: rgba(255, 255, 255, 0.22); color: #ffffff;">
                    <i class="fa-solid fa-graduation-cap"></i>
                </div>
                <div>
                    <h5 class="f-w-700 text-white mb-1">{{ $isDemo ? 'Demo Trading Account' : 'Live Trading Account' }}</h5>
                    <div class="f-13 text-white text-opacity-75">
                        Demo Balance: <strong class="text-white">{{ $settings->currency }}{{ number_format($demoBal, 2, '.', ',') }}</strong>
                    </div>
                </div>
            </div>
            <div>
                @if($isDemo)
                    <a href="{{ route('dashboard') }}" class="btn btn-light rounded-pill px-4 py-2 f-13 f-w-700 text-dark shadow-sm">
                        <i class="fa-solid fa-right-left me-1"></i> Switch to Live Trading
                    </a>
                @else
                    <a href="{{ route('dashboard') }}?mode=demo" class="btn btn-light rounded-pill px-4 py-2 f-13 f-w-700 text-dark shadow-sm">
                        <i class="fa-solid fa-play me-1"></i> Switch to Demo Trading
                    </a>
                @endif
            </div>
        </div>
    </div>
    @endif

    <!-- Quick Action 4-Card Pills -->
    <div class="row g-3 mb-4">
        @if(!empty($mod['trading_section']))
        <div class="col-6 col-md-3">
            <a href="{{ route('dashboard') }}?mode=demo" class="card h-100 border text-center text-decoration-none shadow-sm p-3 hover-card-tile position-relative">
                <span class="badge bg-success position-absolute top-0 end-0 m-2 f-10">FREE</span>
                <i class="fa-solid fa-graduation-cap text-success f-26 mb-2"></i>
                <div class="f-w-700 text-dark f-13">Demo Trade</div>
            </a>
        </div>
        @else
        <div class="col-6 col-md-3">
            <a href="{{ route('portfolio') }}" class="card h-100 border text-center text-decoration-none shadow-sm p-3 hover-card-tile position-relative">
                <i class="fa-solid fa-briefcase text-primary f-26 mb-2"></i>
                <div class="f-w-700 text-dark f-13">My Portfolio</div>
            </a>
        </div>
        @endif
        <div class="col-6 col-md-3">
            <a href="{{ route('deposits') }}" class="card h-100 border text-center text-decoration-none shadow-sm p-3 hover-card-tile">
                <i class="fa-solid fa-circle-plus text-primary f-26 mb-2"></i>
                <div class="f-w-700 text-dark f-13">Deposit</div>
            </a>
        </div>
        <div class="col-6 col-md-3">
            <a href="{{ route('withdrawalsdeposits') }}" class="card h-100 border text-center text-decoration-none shadow-sm p-3 hover-card-tile">
                <i class="fa-solid fa-arrow-up text-info f-26 mb-2"></i>
                <div class="f-w-700 text-dark f-13">Withdraw</div>
            </a>
        </div>
        <div class="col-6 col-md-3">
            <a href="{{ route('connect.wallet') }}" class="card h-100 border text-center text-decoration-none shadow-sm p-3 hover-card-tile">
                <i class="fa-solid fa-link text-warning f-26 mb-2"></i>
                <div class="f-w-700 text-dark f-13">Connect Wallet</div>
            </a>
        </div>
    </div>

    @if(!empty($mod['trading_section']))
    <!-- Market Overview & Interactive Trading Section -->
    <div id="wb-market-section" class="mb-4">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <h5 class="f-w-700 text-dark mb-0">Market Overview</h5>
            <a href="{{ route('tradinghistory') }}" class="text-primary f-12 f-w-600 text-decoration-none">
                View History &rarr;
            </a>
        </div>

        <!-- Quotes Bar -->
        <div class="d-flex align-items-center gap-2 overflow-auto pb-2 mb-3" style="white-space: nowrap;">
            <div class="badge badge-subtle-neutral px-3 py-2 rounded-3 f-12">
                EUR/USD <strong class="text-muted ms-1">1.0842</strong>
            </div>
            <div class="badge badge-subtle-neutral px-3 py-2 rounded-3 f-12">
                GBP/USD <strong class="text-muted ms-1">1.2915</strong>
            </div>
            <div class="badge badge-subtle-neutral px-3 py-2 rounded-3 f-12">
                AAPL <strong class="text-success ms-1">195.10</strong>
            </div>
            <div class="badge badge-subtle-neutral px-3 py-2 rounded-3 f-12">
                TSLA <strong class="text-success ms-1">850.20</strong>
            </div>
        </div>

        <!-- Chart + Quick Trade Row -->
        <div class="row g-3">
            <!-- TradingView Candlestick Chart (Col-lg-8) -->
            <div class="col-lg-8">
                <div class="card border shadow-sm h-100" style="min-height: 520px; overflow: hidden;">
                    <div class="tradingview-widget-container" style="height: 100%; width: 100%;">
                        <div id="tradingview_chart_embed" style="height: 520px; width: 100%;"></div>
                        <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
                        <script type="text/javascript">
                            function loadTradingView() {
                                var isDark = document.body.classList.contains('dark-only') || document.documentElement.classList.contains('dark-only');
                                new TradingView.widget({
                                    "autosize": true,
                                    "symbol": "BINANCE:BTCUSDT",
                                    "interval": "30",
                                    "timezone": "Etc/UTC",
                                    "theme": isDark ? "dark" : "light",
                                    "style": "1",
                                    "locale": "en",
                                    "toolbar_bg": isDark ? "#191f2d" : "#ffffff",
                                    "enable_publishing": false,
                                    "allow_symbol_change": true,
                                    "container_id": "tradingview_chart_embed"
                                });
                            }
                            if (typeof TradingView !== 'undefined') {
                                loadTradingView();
                            } else {
                                window.addEventListener('load', loadTradingView);
                            }
                        </script>
                    </div>
                </div>
            </div>

            <!-- Quick Trade Widget (Col-lg-4) -->
            <div class="col-lg-4">
                <div class="card border shadow-sm h-100">
                    <div class="card-header border-0 text-white p-3" style="background: linear-gradient(135deg, #6362e7 0%, #3b82f6 100%); border-radius: 12px 12px 0 0;">
                        <div class="d-flex align-items-center gap-2 mb-1">
                            <i class="fa-solid fa-bolt f-18"></i>
                            <h6 class="m-0 f-w-700 text-white">Quick Trade</h6>
                        </div>
                        <small class="text-white text-opacity-80 f-11">Start a new trade instantly or explore plans.</small>
                    </div>

                    @php
                        $isTradingLocked = $settings->isTradingLockedForUser(Auth::user());
                    @endphp
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <span class="f-w-700 text-dark f-13">Place a Trade</span>
                            @if($isTradingLocked)
                                <span class="badge bg-warning text-dark rounded-pill f-10"><i class="fa-solid fa-lock me-1"></i> Clearance Required</span>
                            @else
                                <span class="badge bg-primary rounded-pill f-10">Live Execution</span>
                            @endif
                        </div>

                        @if($isTradingLocked)
                        <div class="alert alert-warning py-2 px-3 f-11 rounded-3 mb-3 d-flex align-items-center gap-2 border-0" style="background: rgba(245, 158, 11, 0.12); color: #b45309;">
                            <i class="fa-solid fa-shield-halved f-14 flex-shrink-0"></i>
                            <div>Institutional clearance required (Min: {{ $settings->currency }}{{ number_format($settings->min_trading_balance, 2) }}). <a href="javascript:void(0)" onclick="window.openTradingClearanceModal(event, 'Quick Trade Execution')" class="fw-bold text-decoration-underline" style="color: #b45309;">View details</a></div>
                        </div>
                        @endif

                        <!-- Buy / Sell Toggle Tabs -->
                        <div class="d-grid grid-columns-2 gap-2 mb-3" style="display: grid; grid-template-columns: 1fr 1fr;">
                            <button type="button" class="btn btn-success py-2 f-12 f-w-700" id="btnTabBuy" onclick="setTradeTab('buy')">BUY</button>
                            <button type="button" class="btn btn-outline-danger py-2 f-12 f-w-700" id="btnTabSell" onclick="setTradeTab('sell')">SELL</button>
                        </div>

                        <form action="{{ route('mplans') }}" method="GET" id="tradeForm">
                            <div class="mb-3">
                                <label class="form-label f-12 f-w-600 text-muted mb-1">Asset / Pair</label>
                                <select class="form-select f-12" id="tradePair">
                                    <option value="BTCUSDT">Bitcoin (BTC / USDT)</option>
                                    <option value="ETHUSDT">Ethereum (ETH / USDT)</option>
                                    <option value="SOLUSDT">Solana (SOL / USDT)</option>
                                    <option value="EURUSD">EUR / USD</option>
                                    <option value="TSLA">Tesla Inc. (TSLA)</option>
                                    <option value="AAPL">Apple Inc. (AAPL)</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <label class="form-label f-12 f-w-600 text-muted mb-0">Order Amount</label>
                                    <small class="text-primary f-11 cursor-pointer" onclick="document.getElementById('tradeAmount').value='{{ Auth::user()->account_bal }}'">Max: {{ $settings->currency }}{{ number_format(Auth::user()->account_bal, 2) }}</small>
                                </div>
                                <div class="input-group">
                                    <span class="input-group-text f-12">{{ $settings->currency }}</span>
                                    <input type="number" step="any" min="10" class="form-control f-12" id="tradeAmount" placeholder="100.00" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label f-12 f-w-600 text-muted mb-1">Leverage Multiplier</label>
                                <div class="d-flex gap-1">
                                    <button type="button" class="btn btn-sm btn-outline-secondary flex-fill f-11">1x</button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary flex-fill f-11">5x</button>
                                    <button type="button" class="btn btn-sm btn-primary flex-fill f-11">10x</button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary flex-fill f-11">25x</button>
                                </div>
                            </div>

                            @if($isTradingLocked)
                            <button type="button" class="btn btn-warning w-100 py-2 f-13 f-w-700 shadow-sm text-dark" id="btnTradeSubmit" onclick="window.openTradingClearanceModal(event, 'Quick Trade Execution')">
                                <i class="fa-solid fa-lock me-1"></i> BUY BTC/USDT (Locked)
                            </button>
                            @else
                            <button type="submit" class="btn btn-success w-100 py-2 f-13 f-w-700 shadow-sm" id="btnTradeSubmit">
                                <i class="fa-solid fa-arrow-up me-1"></i> BUY BTC/USDT
                            </button>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var currentTab = 'buy';
    function setTradeTab(type) {
        currentTab = type;
        var buyBtn = document.getElementById('btnTabBuy');
        var sellBtn = document.getElementById('btnTabSell');
        var submitBtn = document.getElementById('btnTradeSubmit');
        var pair = document.getElementById('tradePair').value;
        var isLocked = {{ $isTradingLocked ? 'true' : 'false' }};

        if (type === 'buy') {
            buyBtn.className = 'btn btn-success py-2 f-12 f-w-700';
            sellBtn.className = 'btn btn-outline-danger py-2 f-12 f-w-700';
            if (isLocked) {
                submitBtn.className = 'btn btn-warning w-100 py-2 f-13 f-w-700 shadow-sm text-dark';
                submitBtn.innerHTML = '<i class="fa-solid fa-lock me-1"></i> BUY ' + pair + ' (Locked)';
            } else {
                submitBtn.className = 'btn btn-success w-100 py-2 f-13 f-w-700 shadow-sm';
                submitBtn.innerHTML = '<i class="fa-solid fa-arrow-up me-1"></i> BUY ' + pair;
            }
        } else {
            sellBtn.className = 'btn btn-danger py-2 f-12 f-w-700';
            buyBtn.className = 'btn btn-outline-success py-2 f-12 f-w-700';
            if (isLocked) {
                submitBtn.className = 'btn btn-warning w-100 py-2 f-13 f-w-700 shadow-sm text-dark';
                submitBtn.innerHTML = '<i class="fa-solid fa-lock me-1"></i> SELL ' + pair + ' (Locked)';
            } else {
                submitBtn.className = 'btn btn-danger w-100 py-2 f-13 f-w-700 shadow-sm';
                submitBtn.innerHTML = '<i class="fa-solid fa-arrow-down me-1"></i> SELL ' + pair;
            }
        }
    }

    document.getElementById('tradePair')?.addEventListener('change', function() {
        setTradeTab(currentTab);
    });
</script>
</div>
@endif

<!-- Modal: Connected Wallets Breakdown -->
<div class="modal fade" id="walletsBreakdownModal" tabindex="-1" aria-labelledby="walletsBreakdownLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 500px;">
        <div class="modal-content shadow-lg border-0" style="border-radius: 16px;">
            <div class="modal-header border-bottom py-3 px-4">
                <div class="d-flex align-items-center gap-2">
                    <div class="rounded-3 bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center" style="width: 38px; height: 38px; font-size: 17px;">
                        <i class="fa-solid fa-wallet"></i>
                    </div>
                    <div>
                        <h6 class="modal-title f-w-700 text-dark mb-0 f-15" id="walletsBreakdownLabel">Connected Wallets Breakdown</h6>
                        <small class="text-muted f-11">Individual balances synchronized with your account</small>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <!-- Total Wallets Summary Header -->
                <div class="card border-0 mb-3 text-white p-3 shadow-sm" style="background: var(--theme-gradient, linear-gradient(135deg, #4f46e5 0%, #2563eb 100%)) !important; border-radius: 12px;">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <small class="text-white text-opacity-75 f-11 text-uppercase f-w-600 d-block">Combined Wallets Balance</small>
                            <h3 class="f-w-800 text-white mb-0 mt-1">{{ $settings->currency }}{{ number_format($totalWalletBal ?? 0, 2) }}</h3>
                        </div>
                        <div class="text-end">
                            <span class="badge bg-white bg-opacity-20 text-white rounded-pill px-3 py-1 f-11">
                                <i class="fa-solid fa-shield-halved me-1"></i> {{ ($userWallets ?? collect())->count() }} Synchronized
                            </span>
                        </div>
                    </div>
                </div>

                @if(!empty($userWallets) && $userWallets->count() > 0)
                    <div class="d-flex flex-column gap-2 mb-3">
                        @foreach($userWallets as $w)
                            @php
                                $wProv = strtolower(trim($w->wallet_provider ?? ''));
                                $wIcon = null;
                                if (isset($walletTypes)) {
                                    $matched = $walletTypes->get($wProv);
                                    if (!$matched) {
                                        $matched = $walletTypes->first(function($wt, $k) use ($wProv) {
                                            return str_contains($wProv, (string)$k) || str_contains((string)$k, $wProv);
                                        });
                                    }
                                    if ($matched && !empty($matched->icon_url)) {
                                        $wIcon = $matched->icon_url;
                                    }
                                }
                                if (!$wIcon) {
                                    if (str_contains($wProv, 'metamask')) {
                                        $wIcon = asset('assets/wallet-types/icons/1NS1POo31VhHeJuQOv2IOgLwI6jAe8KK6QG2WLPI.png');
                                    } elseif (str_contains($wProv, 'trust')) {
                                        $wIcon = asset('assets/wallet-types/icons/kxF43fXtB3B0m0C8Tz5ZZ3ckEYwKZFHCVJOh1BVr.png');
                                    } elseif (str_contains($wProv, 'coinbase')) {
                                        $wIcon = asset('assets/wallet-types/icons/fW86jwztjOyUCIiaf8XX7bAmxPx2BCwtRMy9RK5Z.jpg');
                                    } elseif (str_contains($wProv, 'bakkt')) {
                                        $wIcon = asset('assets/wallet-types/icons/yRqNYjy782hPVqJXhrvKuYqMe9FcnJegeSzDO5Ok.png');
                                    }
                                }
                            @endphp
                            <div class="p-3 rounded-3 border bg-light bg-opacity-50 d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center bg-white border shadow-sm flex-shrink-0" style="width: 44px; height: 44px; overflow: hidden;">
                                        @if($wIcon)
                                            <img src="{{ $wIcon }}" alt="{{ $w->wallet_provider }}" style="width: 28px; height: 28px; object-fit: contain;" onerror="this.outerHTML='<i class=\'fa-solid fa-wallet text-primary f-18\'></i>'">
                                        @else
                                            <i class="fa-solid fa-wallet text-primary f-18"></i>
                                        @endif
                                    </div>
                                    <div>
                                        <div class="f-w-700 text-dark f-13">{{ $w->wallet_provider }}</div>
                                        <small class="text-muted f-11">
                                            <span class="pulse-dot-green me-1"></span> Synchronized {{ $w->created_at ? $w->created_at->diffForHumans() : 'recently' }}
                                        </small>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <div class="f-w-800 text-dark f-15">
                                        {{ $settings->currency }}{{ number_format($w->balance, 2) }}
                                    </div>
                                    <span class="badge bg-light-success text-success f-10 rounded-pill">Active</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-4 px-3 bg-light bg-opacity-25 rounded-3 border mb-3">
                        <i class="fa-solid fa-wallet text-muted f-28 mb-2 d-block"></i>
                        <h6 class="f-w-700 text-dark mb-1">No Wallets Connected</h6>
                        <p class="text-muted f-12 mb-3">Connect your cryptocurrency wallet to start tracking and earning rewards.</p>
                        <a href="{{ route('connect.wallet') }}" class="btn btn-sm btn-primary rounded-pill px-4">
                            Connect Wallet Now
                        </a>
                    </div>
                @endif
            </div>
            <div class="modal-footer border-top py-2 px-4 d-flex justify-content-between">
                <a href="{{ route('connect.wallet') }}" class="btn btn-link text-primary p-0 f-12 text-decoration-none">
                    <i class="fa-solid fa-plus me-1"></i> Connect Another Wallet
                </a>
                <button type="button" class="btn btn-secondary btn-sm rounded-pill px-3" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Multi-Slide Welcome & Wallet Connect Onboarding Modal Component -->
@include('user.components.welcome_modal')
@endsection
