@extends('layouts.dash')
@section('title', $title ?? 'Withdraw Funds')

@section('content')
    <!-- Scoped Theme Tokens & Styling -->
    <style>
        .withdrawals-view .it-title {
            color: #0f172a !important;
            transition: color 0.2s ease;
        }
        body.dark-only .withdrawals-view .it-title {
            color: #ffffff !important;
        }

        .withdrawals-view .it-text {
            color: #334155 !important;
            transition: color 0.2s ease;
        }
        body.dark-only .withdrawals-view .it-text {
            color: #f1f5f9 !important;
        }

        .withdrawals-view .it-muted {
            color: #64748b !important;
            transition: color 0.2s ease;
        }
        body.dark-only .withdrawals-view .it-muted {
            color: #94a3b8 !important;
        }

        .withdrawals-view .terminal-card {
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            transition: all 0.25s ease;
        }
        body.dark-only .withdrawals-view .terminal-card {
            background-color: #1a2238;
            border-color: rgba(255, 255, 255, 0.08);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }

        .withdrawals-view .withdraw-card {
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 24px;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .withdrawals-view .withdraw-card:hover {
            transform: translateY(-3px);
            border-color: #6362e7;
            box-shadow: 0 10px 24px rgba(99, 98, 231, 0.14);
        }
        body.dark-only .withdrawals-view .withdraw-card {
            background-color: #1a2238;
            border-color: rgba(255, 255, 255, 0.08);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }
        body.dark-only .withdrawals-view .withdraw-card:hover {
            border-color: rgba(99, 98, 231, 0.6);
            background-color: #1e2742;
        }

        .withdrawals-view .spec-box {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 14px 16px;
            margin-bottom: 20px;
        }
        body.dark-only .withdrawals-view .spec-box {
            background-color: #151c30;
            border-color: rgba(255, 255, 255, 0.07);
        }

        .withdrawals-view .spec-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 7px 0;
            border-bottom: 1px dashed rgba(148, 163, 184, 0.2);
            font-size: 12.5px;
        }
        .withdrawals-view .spec-row:last-child {
            border-bottom: none;
        }

        .withdrawals-view .btn-withdraw-action {
            background: linear-gradient(135deg, #6362e7 0%, #4f46e5 100%);
            border: none;
            color: #ffffff !important;
            font-weight: 700;
            font-size: 13.5px;
            border-radius: 10px;
            padding: 11px 20px;
            transition: all 0.2s ease;
        }
        .withdrawals-view .btn-withdraw-action:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 18px rgba(99, 98, 231, 0.35);
            color: #ffffff !important;
        }
    </style>

    <div class="withdrawals-view">
        <!-- Page Header -->
        <div class="page-title mb-4">
            <div class="row align-items-center justify-content-between g-3">
                <div class="col-md-7">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-1 p-0 bg-transparent f-12">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="it-muted text-decoration-none">Dashboard</a></li>
                            <li class="breadcrumb-item it-muted">Wallet & Funds</li>
                            <li class="breadcrumb-item active text-primary" aria-current="page">Withdraw Funds</li>
                        </ol>
                    </nav>
                    <h4 class="mb-1 it-title f-w-700">Request a Withdrawal</h4>
                    <p class="mb-0 it-muted f-13">Choose your preferred payout method to transfer capital to your verified external wallet or bank.</p>
                </div>
                <div class="col-md-5">
                    <div class="d-flex align-items-center justify-content-md-end gap-2 flex-wrap">
                        <!-- Available Withdrawable Balance Chip -->
                        <div class="d-inline-flex align-items-center gap-2 px-3 py-2 rounded-3 terminal-card">
                            <div class="metric-icon-circle primary" style="width: 30px; height: 30px; font-size: 13px;">
                                <i class="fa-solid fa-wallet"></i>
                            </div>
                            <div class="text-start">
                                <span class="d-block it-muted f-10 text-uppercase f-w-600" style="letter-spacing: 0.5px;">Withdrawable Balance</span>
                                <span class="d-block it-title f-13 f-w-700">{{ $settings->currency }}{{ number_format(Auth::user()->account_bal, 2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <x-danger-alert />
        <x-success-alert />

        <!-- Withdrawal Methods Grid -->
        <div class="row g-4 mb-4">
            @forelse ($wmethods as $method)
                @php
                    $mName = strtolower($method->name);
                    $iconClass = 'fa-solid fa-wallet';
                    if (str_contains($mName, 'bitcoin') || str_contains($mName, 'btc')) {
                        $iconClass = 'fa-brands fa-bitcoin';
                    } elseif (str_contains($mName, 'ethereum') || str_contains($mName, 'eth')) {
                        $iconClass = 'fa-brands fa-ethereum';
                    } elseif (str_contains($mName, 'usdt') || str_contains($mName, 'tether')) {
                        $iconClass = 'fa-solid fa-coins';
                    } elseif (str_contains($mName, 'bank')) {
                        $iconClass = 'fa-solid fa-building-columns';
                    }
                @endphp
                <div class="col-xl-4 col-lg-6 col-12">
                    <div class="withdraw-card h-100">
                        <div>
                            <!-- Header: Method Name & Duration Badge -->
                            <div class="d-flex align-items-start justify-content-between mb-3">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="metric-icon-circle primary" style="width: 42px; height: 42px; font-size: 18px;">
                                        <i class="{{ $iconClass }}"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-0 it-title f-w-700 f-16">{{ $method->name }}</h5>
                                        <span class="it-muted f-11 d-block"><i class="fa-regular fa-clock me-1"></i>{{ $method->duration }}</span>
                                    </div>
                                </div>
                                <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill f-11 px-2.5 py-1">
                                    Verified
                                </span>
                            </div>

                            <!-- Specification Breakdown Box -->
                            <div class="spec-box">
                                <div class="spec-row">
                                    <span class="it-muted"><i class="fa-solid fa-arrow-down-short-wide me-1.5 text-primary"></i>Minimum Payout</span>
                                    <span class="it-title f-w-700">{{ $settings->currency }}{{ number_format($method->minimum, 2) }}</span>
                                </div>
                                <div class="spec-row">
                                    <span class="it-muted"><i class="fa-solid fa-arrow-up-wide-short me-1.5 text-info"></i>Maximum Payout</span>
                                    <span class="it-title f-w-700">{{ $settings->currency }}{{ number_format($method->maximum, 2) }}</span>
                                </div>
                                <div class="spec-row">
                                    <span class="it-muted"><i class="fa-solid fa-percent me-1.5 text-warning"></i>Processing Fee</span>
                                    <span class="it-title f-w-700">
                                        @if ($method->charges_type == 'percentage')
                                            {{ $method->charges_amount }}%
                                        @else
                                            {{ $settings->currency }}{{ number_format($method->charges_amount, 2) }}
                                        @endif
                                    </span>
                                </div>
                                <div class="spec-row">
                                    <span class="it-muted"><i class="fa-solid fa-bolt me-1.5 text-success"></i>Settlement Time</span>
                                    <span class="text-success f-w-700">{{ $method->duration }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Action Button -->
                        <div>
                            @if ($settings->enable_with == 'false')
                                <button class="btn btn-outline-secondary w-100 py-2.5 rounded-3 d-flex align-items-center justify-content-center gap-2 f-13 f-w-600"
                                        data-bs-toggle="modal" data-bs-target="#withdrawdisabled">
                                    <i class="fa-solid fa-ban text-danger"></i>
                                    <span>Withdrawals Paused</span>
                                </button>
                            @else
                                <form action="{{ route('withdrawamount') }}" method="POST">
                                    @csrf
                                    <input type="hidden" value="{{ $method->name }}" name="method">
                                    <button type="submit" class="btn btn-withdraw-action w-100 d-flex align-items-center justify-content-center gap-2 shadow-sm">
                                        <i class="fa-solid fa-arrow-up-right-from-square text-white f-12"></i>
                                        <span class="text-white">Request {{ $method->name }} Payout</span>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <!-- Empty State -->
                <div class="col-12">
                    <div class="terminal-card text-center py-5 px-4">
                        <div class="metric-icon-circle neutral mx-auto mb-3" style="width: 64px; height: 64px; font-size: 26px;">
                            <i class="fa-solid fa-money-bill-transfer it-muted"></i>
                        </div>
                        <h5 class="it-title f-w-700 mb-2">No Withdrawal Methods Available</h5>
                        <p class="it-muted f-13 mb-4 mx-auto" style="max-width: 480px;">
                            There are currently no withdrawal channels enabled for your region. Please contact our 24/7 client support desk for manual payout processing.
                        </p>
                        <a href="{{ route('support') }}" class="btn btn-primary px-4 py-2 rounded-3 shadow-sm text-white" style="color: #ffffff !important;">
                            <i class="fa-solid fa-headset me-1 text-white"></i>Contact Client Support
                        </a>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Withdrawal Disabled Modal -->
        <div id="withdrawdisabled" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content terminal-card border-0 shadow">
                    <div class="modal-header border-bottom border-light-subtle pb-3">
                        <div class="d-flex align-items-center gap-2">
                            <div class="metric-icon-circle warning" style="width: 32px; height: 32px; font-size: 14px;">
                                <i class="fa-solid fa-triangle-exclamation"></i>
                            </div>
                            <h5 class="modal-title it-title f-w-700 f-16">Withdrawal Notice</h5>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body py-4">
                        <p class="it-muted f-13 mb-0">
                            Withdrawal processing is temporarily paused for routine ledger audit and network maintenance. Your funds remain 100% secure. Please check back shortly or contact our 24/7 support desk for priority resolution.
                        </p>
                    </div>
                    <div class="modal-footer border-top border-light-subtle pt-3">
                        <button type="button" class="btn btn-secondary btn-sm px-3 rounded-3" data-bs-dismiss="modal">Close</button>
                        <a href="{{ route('support') }}" class="btn btn-primary btn-sm px-3 rounded-3 text-white" style="color: #ffffff !important;">
                            <i class="fa-solid fa-headset me-1 text-white"></i>Contact Support
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
