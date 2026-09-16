@extends('layouts.dash')
@section('title', $title ?? 'Investment Packages')

@section('content')
    <style>
        .invest-page-header .breadcrumb-link,
        .invest-page-header .breadcrumb-muted {
            color: #64748b !important;
        }
        body.dark-only .invest-page-header .breadcrumb-link,
        body.dark-only .invest-page-header .breadcrumb-muted {
            color: #94a3b8 !important;
        }
        .invest-page-header .page-title-text {
            color: #0f172a !important;
        }
        body.dark-only .invest-page-header .page-title-text {
            color: #ffffff !important;
        }
        .invest-page-header .page-subtitle-text {
            color: #64748b !important;
        }
        body.dark-only .invest-page-header .page-subtitle-text {
            color: #94a3b8 !important;
        }
        .invest-page-header .header-balance-card {
            background-color: #ffffff !important;
            border: 1px solid #e2e8f0 !important;
        }
        body.dark-only .invest-page-header .header-balance-card {
            background-color: #151c30 !important;
            border-color: rgba(255, 255, 255, 0.08) !important;
        }
        .invest-page-header .header-balance-label {
            color: #64748b !important;
        }
        body.dark-only .invest-page-header .header-balance-label {
            color: #94a3b8 !important;
        }
        .invest-page-header .header-balance-val {
            color: #0f172a !important;
        }
        body.dark-only .invest-page-header .header-balance-val {
            color: #ffffff !important;
        }
        .invest-page-header .header-active-plans-btn {
            border-color: #cbd5e1 !important;
            color: #334155 !important;
            background-color: transparent !important;
        }
        body.dark-only .invest-page-header .header-active-plans-btn {
            border-color: rgba(255, 255, 255, 0.12) !important;
            color: #cbd5e1 !important;
        }
    </style>

    <!-- Page Header -->
    <div class="page-title invest-page-header mb-4">
        <div class="row align-items-center justify-content-between g-3">
            <div class="col-md-7">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-1 p-0 bg-transparent f-12">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="breadcrumb-link text-decoration-none">Dashboard</a></li>
                        <li class="breadcrumb-item breadcrumb-muted">Portfolio & Investments</li>
                        <li class="breadcrumb-item active text-primary" aria-current="page">Explore Packages</li>
                    </ol>
                </nav>
                <h4 class="mb-1 page-title-text f-w-700">Explore & Join Investment Packages</h4>
                <p class="mb-0 page-subtitle-text f-13">Choose an investment package, configure your capital allocation, and activate automated yields.</p>
            </div>
            <div class="col-md-5">
                <div class="d-flex align-items-center justify-content-md-end gap-2 flex-wrap">
                    <!-- Available Balance Chip -->
                    <div class="d-inline-flex align-items-center gap-2 px-3 py-2 rounded-3 header-balance-card">
                        <div class="metric-icon-circle primary" style="width: 28px; height: 28px; font-size: 12px;">
                            <i class="fa-solid fa-wallet"></i>
                        </div>
                        <div class="text-start">
                            <span class="d-block header-balance-label f-11 text-uppercase f-w-600" style="letter-spacing: 0.5px;">Account Balance</span>
                            <span class="d-block header-balance-val f-13 f-w-700">{{ $settings->currency }}{{ number_format(Auth::user()->account_bal, 2) }}</span>
                        </div>
                        <a href="{{ route('deposits') }}" class="btn btn-xs btn-primary rounded-pill ms-2 px-2 py-1 f-11 f-w-600 text-nowrap text-white" style="color: #ffffff !important;">
                            <i class="fa-solid fa-plus me-1 text-white"></i>Deposit
                        </a>
                    </div>
                    <!-- Connected Web3 Wallet Chip -->
                    @if (isset($userWallets) && $userWallets->count() > 0)
                        <div class="d-inline-flex align-items-center gap-2 px-3 py-2 rounded-3 header-balance-card">
                            <div class="metric-icon-circle success" style="width: 28px; height: 28px; font-size: 12px; background: rgba(16, 185, 129, 0.15); color: #10b981;">
                                <i class="fa-solid fa-link"></i>
                            </div>
                            <div class="text-start">
                                <span class="d-block header-balance-label f-11 text-uppercase f-w-600" style="letter-spacing: 0.5px;">Connected Wallet</span>
                                <span class="d-block header-balance-val f-13 f-w-700 text-success">{{ $settings->currency }}{{ number_format($totalWalletBal, 2) }}</span>
                            </div>
                            <a href="{{ route('portfolio') }}" class="btn btn-xs btn-outline-secondary rounded-pill ms-2 px-2 py-1 f-11 f-w-600 text-nowrap">
                                <i class="fa-solid fa-arrow-right me-1"></i>View
                            </a>
                        </div>
                    @endif
                    <!-- Active Plans Link -->
                    <a href="{{ route('myplans', 'All') }}" class="btn btn-outline-secondary btn-sm rounded-3 d-inline-flex align-items-center gap-2 f-12 py-2 px-3 header-active-plans-btn">
                        <i class="fa-solid fa-layer-group text-primary"></i>
                        <span>Active Packages</span>
                        <span class="badge bg-primary text-white rounded-pill ms-1 px-2 py-1 f-10">
                            {{ \App\Models\User_plans::where('user', Auth::user()->id)->where('active', 'yes')->count() }}
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Livewire Investment Component -->
    <livewire:user.investment-plan :paymentMethod="request('method', 'Account Balance')" />

@endsection
