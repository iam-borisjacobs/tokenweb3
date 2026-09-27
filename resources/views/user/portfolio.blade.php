@extends('layouts.dash')
@section('title', $title ?? 'My Portfolio & Connected Wallets')

@section('content')
<style>
    .portfolio-page-header .breadcrumb-link,
    .portfolio-page-header .breadcrumb-muted {
        color: #64748b !important;
    }
    body.dark-only .portfolio-page-header .breadcrumb-link,
    body.dark-only .portfolio-page-header .breadcrumb-muted {
        color: #94a3b8 !important;
    }
    .portfolio-page-header .page-title-text {
        color: #0f172a !important;
    }
    body.dark-only .portfolio-page-header .page-title-text {
        color: #ffffff !important;
    }
    .portfolio-page-header .page-subtitle-text {
        color: #64748b !important;
    }
    body.dark-only .portfolio-page-header .page-subtitle-text {
        color: #94a3b8 !important;
    }

    .portfolio-hero-card {
        background: var(--theme-gradient, linear-gradient(135deg, #1e1b4b 0%, #2563eb 50%, #4f46e5 100%)) !important;
        border-radius: 16px;
        box-shadow: 0 10px 25px rgba(37, 99, 235, 0.2);
    }
    .portfolio-wallet-card {
        background-color: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.03);
    }
    .portfolio-empty-card {
        background-color: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.03);
    }
    body.dark-only .portfolio-empty-card {
        background-color: #151c30 !important;
        border: 1px solid rgba(255, 255, 255, 0.08) !important;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.25) !important;
    }
    .wallet-empty-icon-circle {
        width: 68px !important;
        height: 68px !important;
        min-width: 68px !important;
        max-width: 68px !important;
        border-radius: 50% !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        font-size: 28px !important;
        background: rgba(245, 158, 11, 0.12) !important;
        color: #d97706 !important;
        border: 1.5px solid rgba(245, 158, 11, 0.28) !important;
        margin: 0 auto 16px auto !important;
        box-shadow: 0 4px 12px rgba(245, 158, 11, 0.12) !important;
        flex-shrink: 0 !important;
    }
    body.dark-only .wallet-empty-icon-circle {
        background: rgba(245, 158, 11, 0.15) !important;
        color: #fbbf24 !important;
        border-color: rgba(245, 158, 11, 0.35) !important;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.3) !important;
    }
    .portfolio-wallet-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 28px rgba(0, 0, 0, 0.08);
        border-color: #cbd5e1;
    }
    body.dark-only .portfolio-wallet-card {
        background-color: #151c30 !important;
        border: 1px solid rgba(255, 255, 255, 0.08) !important;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.25) !important;
    }
    body.dark-only .portfolio-wallet-card:hover {
        border-color: rgba(99, 98, 231, 0.45) !important;
        box-shadow: 0 12px 30px rgba(99, 98, 231, 0.15) !important;
    }
    .wallet-avatar-box {
        width: 52px;
        height: 52px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        flex-shrink: 0;
    }
    body.dark-only .wallet-avatar-box {
        background: #1e2742;
        border-color: rgba(255, 255, 255, 0.1);
    }
    .wallet-tech-box {
        background: rgba(248, 250, 252, 0.85);
        border: 1px solid #e2e8f0;
    }
    body.dark-only .wallet-tech-box {
        background: rgba(26, 34, 56, 0.75) !important;
        border-color: rgba(255, 255, 255, 0.06) !important;
    }
    .tech-icon-sm {
        width: 28px;
        height: 28px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(99, 98, 231, 0.08);
        flex-shrink: 0;
        font-size: 12px;
    }
    body.dark-only .tech-icon-sm {
        background: rgba(255, 255, 255, 0.05);
    }
    .wallet-alloc-box {
        background: rgba(248, 250, 252, 0.85);
        border: 1px solid #e2e8f0;
    }
    body.dark-only .wallet-alloc-box {
        background: rgba(26, 34, 56, 0.6) !important;
        border-color: rgba(255, 255, 255, 0.08) !important;
    }
    body.dark-only .portfolio-wallet-card .text-dark {
        color: #f1f5f9 !important;
    }
    body.dark-only .portfolio-wallet-card .progress {
        background: rgba(255, 255, 255, 0.1) !important;
    }
    body.dark-only .portfolio-wallet-card .border-top {
        border-color: rgba(255, 255, 255, 0.08) !important;
    }
    .wallet-bal-text {
        color: #2563eb !important;
    }
    body.dark-only .wallet-bal-text {
        color: #60a5fa !important;
    }
    .pulse-beacon {
        display: inline-block;
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background-color: #22c55e;
        box-shadow: 0 0 0 rgba(34, 197, 94, 0.4);
        animation: pulseBeacon 2s infinite;
    }
    @keyframes pulseBeacon {
        0% {
            box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.7);
        }
        70% {
            box-shadow: 0 0 0 6px rgba(34, 197, 94, 0);
        }
        100% {
            box-shadow: 0 0 0 0 rgba(34, 197, 94, 0);
        }
    }
</style>

<!-- Page Header -->
<div class="page-title portfolio-page-header mb-4">
    <div class="row align-items-center justify-content-between g-3">
        <div class="col-md-7">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-1 p-0 bg-transparent f-12">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="breadcrumb-link text-decoration-none">Dashboard</a></li>
                    <li class="breadcrumb-item breadcrumb-muted">Asset Management</li>
                    <li class="breadcrumb-item active text-primary" aria-current="page">My Portfolio</li>
                </ol>
            </nav>
            <h4 class="mb-1 page-title-text f-w-700">My Portfolio & Connected Wallets</h4>
            <p class="mb-0 page-subtitle-text f-13">View your decentralized wallet holdings, synchronized assets, and custody status in real time.</p>
        </div>
        <div class="col-md-5">
            <div class="d-flex align-items-center justify-content-md-end gap-2 flex-wrap">
                <a href="{{ route('connect.wallet') }}" class="btn btn-primary rounded-pill px-3 py-2 d-inline-flex align-items-center gap-2 f-13 f-w-600 shadow-sm">
                    <i class="fa-solid fa-plus text-white"></i>
                    <span>Connect New Wallet</span>
                </a>
                <a href="{{ route('deposits') }}" class="btn btn-outline-secondary rounded-pill px-3 py-2 d-inline-flex align-items-center gap-2 f-13 f-w-600">
                    <i class="fa-solid fa-circle-arrow-down text-success"></i>
                    <span>Deposit</span>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Portfolio Hero Banner -->
<div class="card border-0 mb-4 portfolio-hero-card text-white">
    <div class="card-body p-4 p-md-5">
        <div class="row align-items-center justify-content-between g-4">
            <div class="col-lg-7">
                <div class="d-flex align-items-center gap-2 mb-2">
                    <span class="badge bg-white bg-opacity-20 text-white rounded-pill px-3 py-1 f-11 f-w-600">
                        <i class="fa-solid fa-shield-halved me-1"></i> Multi-Chain Vault
                    </span>
                    <span class="badge bg-success bg-opacity-30 text-white rounded-pill px-3 py-1 f-11 f-w-600">
                        ● Synchronized & Active
                    </span>
                </div>
                <small class="text-white text-opacity-80 f-12 text-uppercase f-w-600 d-block mb-1" style="letter-spacing: 0.5px;">Combined Synchronized Balance</small>
                <h1 class="f-w-800 text-white mb-2" style="font-size: 2.8rem; letter-spacing: -0.02em;">
                    {{ $settings->currency }}{{ number_format($totalWalletBal ?? 0, 2) }}
                </h1>
                <p class="text-white text-opacity-85 f-13 mb-0" style="max-width: 540px;">
                    Aggregate valuation of all decentralized Web3 wallets currently authorized on your account terminal. Balance updates are verified with end-to-end cryptographic proofs.
                </p>
            </div>
            <div class="col-lg-5">
                <div class="p-3.5 rounded-3" style="background: rgba(0, 0, 0, 0.22); border: 1px solid rgba(255, 255, 255, 0.15); backdrop-filter: blur(8px);">
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-1 pb-2 mb-2 border-bottom border-white border-opacity-15">
                        <span class="text-white text-opacity-80 f-12">Connected Wallets:</span>
                        <span class="f-w-700 text-white f-13">{{ ($userWallets ?? collect())->count() }} {{ \Illuminate\Support\Str::plural('Wallet', ($userWallets ?? collect())->count()) }}</span>
                    </div>
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-1 pb-2 mb-2 border-bottom border-white border-opacity-15">
                        <span class="text-white text-opacity-80 f-12">Encryption Protocol:</span>
                        <span class="f-w-700 text-white f-13">AES-256 / Hardware Vault</span>
                    </div>
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-1">
                        <span class="text-white text-opacity-80 f-12">Last Sync Timestamp:</span>
                        <span class="f-w-700 text-white f-13">{{ now()->format('M d, Y - h:i A') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Wallets Section Header -->
<div class="d-flex align-items-center justify-content-between mb-3">
    <div>
        <h5 class="f-w-700 text-dark mb-0">Connected Wallets List</h5>
        <small class="text-muted f-12">Individual breakdown of linked wallets and their respective balances</small>
    </div>
    <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-1.5 f-12 f-w-700">
        {{ ($userWallets ?? collect())->count() }} Active
    </span>
</div>

@if(!empty($userWallets) && $userWallets->count() > 0)
    <div class="row g-3 mb-4">
        @foreach($userWallets as $w)
            @php
                $provider = strtolower(trim($w->wallet_provider ?? ''));
                $iconUrl = null;
                if (isset($walletTypes)) {
                    $matched = $walletTypes->get($provider);
                    if (!$matched) {
                        $matched = $walletTypes->first(function($wt, $k) use ($provider) {
                            return str_contains($provider, (string)$k) || str_contains((string)$k, $provider);
                        });
                    }
                    if ($matched && !empty($matched->icon_url)) {
                        $iconUrl = $matched->icon_url;
                    }
                }
                if (!$iconUrl) {
                    if (str_contains($provider, 'metamask')) {
                        $iconUrl = asset('assets/wallet-types/icons/1NS1POo31VhHeJuQOv2IOgLwI6jAe8KK6QG2WLPI.png');
                    } elseif (str_contains($provider, 'trust')) {
                        $iconUrl = asset('assets/wallet-types/icons/kxF43fXtB3B0m0C8Tz5ZZ3ckEYwKZFHCVJOh1BVr.png');
                    }
                }
                $balVal = floatval($w->balance);
                $totalVal = floatval($totalWalletBal ?? 0);
                $pct = $totalVal > 0 ? round(($balVal / $totalVal) * 100, 1) : 0;
            @endphp
            <div class="col-lg-6 col-12">
                <div class="portfolio-wallet-card p-4 h-100 d-flex flex-column justify-content-between">
                    <div class="w-100">
                        <!-- Card Top Bar: Provider and Balance by the side -->
                        <div class="d-flex align-items-start justify-content-between gap-2 mb-3">
                            <div class="d-flex align-items-center gap-2">
                                <div class="wallet-avatar-box">
                                    @if($iconUrl)
                                        <img src="{{ $iconUrl }}" alt="{{ $w->wallet_provider }}" style="width: 32px; height: 32px; object-fit: contain;" onerror="this.outerHTML='<i class=\'fa-solid fa-wallet text-primary f-20\'></i>'">
                                    @else
                                        <i class="fa-solid fa-wallet text-primary f-20"></i>
                                    @endif
                                </div>
                                <div>
                                    <div class="d-flex align-items-center gap-2 mb-1 flex-wrap">
                                        <h6 class="f-w-700 text-dark mb-0 f-16">{{ $w->wallet_provider }}</h6>
                                        <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill f-10 px-2 py-0.5 text-nowrap">
                                            <span class="pulse-beacon me-1"></span> Live Sync
                                        </span>
                                    </div>
                                    <small class="text-muted f-11">
                                        Connected {{ $w->created_at ? $w->created_at->diffForHumans() : 'recently' }} &bull; Multi-Chain EVM
                                    </small>
                                </div>
                            </div>
                            <!-- Balance Displayed Prominently By The Side -->
                            <div class="text-end flex-shrink-0">
                                <small class="text-muted f-11 text-uppercase d-block f-w-600">Vault Valuation</small>
                                <div class="f-w-800 text-dark f-18 text-nowrap wallet-bal-text">
                                    {{ $settings->currency }}{{ number_format($w->balance, 2) }}
                                </div>
                                <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill f-10 px-2 py-0.5 f-w-600 text-nowrap">
                                    {{ $pct }}% of Total Assets
                                </span>
                            </div>
                        </div>

                        <!-- Micro Allocation Progress Bar -->
                        <div class="wallet-alloc-box p-2.5 rounded-3 mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-1 f-11">
                                <span class="text-muted f-w-500">Portfolio Share Allocation</span>
                                <span class="f-w-700 text-dark">{{ $pct }}% of Liquid Total</span>
                            </div>
                            <div class="progress" style="height: 6px; border-radius: 999px;">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: {{ min(100, max(5, $pct)) }}%; border-radius: 999px;" aria-valuenow="{{ $pct }}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>

                        <!-- Technical Details Grid (4 items) -->
                        <div class="wallet-tech-box p-3 rounded-3 mb-3">
                            <div class="row g-2">
                                <div class="col-6 col-xl-3">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="tech-icon-sm text-primary">
                                            <i class="fa-solid fa-server"></i>
                                        </div>
                                        <div class="overflow-hidden">
                                            <span class="text-muted d-block f-10 text-uppercase f-w-600">Gateway Node</span>
                                            <span class="text-dark f-w-600 font-monospace f-11 text-truncate d-block">{{ $w->ip_address ?? '127.0.0.1' }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-xl-3">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="tech-icon-sm text-success">
                                            <i class="fa-solid fa-shield-halved"></i>
                                        </div>
                                        <div class="overflow-hidden">
                                            <span class="text-muted d-block f-10 text-uppercase f-w-600">Custody Model</span>
                                            <span class="text-dark f-w-600 f-11 text-truncate d-block">AES-256 Segregated</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-xl-3">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="tech-icon-sm text-info">
                                            <i class="fa-solid fa-key"></i>
                                        </div>
                                        <div class="overflow-hidden">
                                            <span class="text-muted d-block f-10 text-uppercase f-w-600">Auth Status</span>
                                            <span class="text-success f-w-600 f-11 text-truncate d-block">
                                                <i class="fa-solid fa-circle-check me-0.5"></i> Authenticated
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-xl-3">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="tech-icon-sm text-warning">
                                            <i class="fa-solid fa-chart-line"></i>
                                        </div>
                                        <div class="overflow-hidden">
                                            <span class="text-muted d-block f-10 text-uppercase f-w-600">Yield Routing</span>
                                            <span class="text-dark f-w-600 f-11 text-truncate d-block">
                                                @if($balVal > 0)
                                                    <span class="text-primary f-w-700">Staking Ready</span>
                                                @else
                                                    <span class="text-muted">Unfunded</span>
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Footer Action Bar -->
                    <div class="w-100 d-flex align-items-center justify-content-between flex-wrap gap-2 pt-3 border-top mt-2">
                        <div class="d-flex align-items-center gap-2">
                            <i class="fa-solid fa-shield-halved text-success f-13"></i>
                            <span class="text-muted f-11">
                                Non-Custodial Isolated Vault
                            </span>
                        </div>
                        <a href="{{ route('mplans') }}?method=Connected+Wallet" class="btn btn-sm btn-primary rounded-pill px-3 py-1.5 f-11 f-w-600 d-inline-flex align-items-center gap-2 shadow-sm text-nowrap">
                            <span>Invest from Wallet</span>
                            <i class="fa-solid fa-arrow-right f-10"></i>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@else
    <!-- Empty State -->
    <div class="card border portfolio-empty-card text-center p-5 mb-4">
        <div class="d-flex justify-content-center w-100">
            <div class="wallet-empty-icon-circle">
                <i class="fa-solid fa-wallet"></i>
            </div>
        </div>
        <h5 class="f-w-700 text-dark mb-1">No Wallets Connected Yet</h5>
        <p class="text-muted f-13 mx-auto mb-4" style="max-width: 440px;">
            Connect your cryptocurrency wallet to securely track holdings, automate institutional yield allocations, and monitor your combined decentralized portfolio.
        </p>
        <div>
            <a href="{{ route('connect.wallet') }}" class="btn btn-primary rounded-pill px-4 py-2 f-13 f-w-600 shadow-sm">
                <i class="fa-solid fa-plus me-1 text-white"></i> Connect Your Wallet Now
            </a>
        </div>
    </div>
@endif

<!-- Security & Best Practice Notice -->
<div class="card border shadow-sm portfolio-wallet-card mb-4">
    <div class="card-body p-4 d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
        <div class="d-flex align-items-center gap-3">
            <div class="rounded-3 d-flex align-items-center justify-content-center text-primary" style="width: 46px; height: 46px; font-size: 22px; background: rgba(99, 98, 231, 0.12);">
                <i class="fa-solid fa-lock"></i>
            </div>
            <div>
                <h6 class="f-w-700 text-dark mb-1 f-14">Non-Custodial Architecture & Asset Sovereignty</h6>
                <p class="text-muted f-12 mb-0" style="max-width: 680px;">
                    In accordance with our strict post-2022 security governance, client assets remain protected under end-to-end cryptographic isolation. We never commingle client funds or hold centralized unilateral control over authorized wallets.
                </p>
            </div>
        </div>
        <div>
            <a href="{{ route('connect.wallet') }}" class="btn btn-outline-primary rounded-pill px-3 py-2 f-12 f-w-600 text-nowrap">
                <i class="fa-solid fa-link me-1"></i> Connect Another
            </a>
        </div>
    </div>
</div>
@endsection
