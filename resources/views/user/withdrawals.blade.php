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

        /* Notice Modal Sleek Styling */
        #withdrawdisabled .modal-content {
            background-color: #ffffff;
            border: 1px solid #e2e8f0 !important;
            border-radius: 20px !important;
            overflow: hidden;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.25) !important;
        }
        body.dark-only #withdrawdisabled .modal-content {
            background: #141c2e !important;
            border-color: rgba(255, 255, 255, 0.1) !important;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.65) !important;
        }

        #withdrawdisabled .modal-header {
            padding: 18px 24px;
            background: rgba(0, 0, 0, 0.02);
            border-bottom: 1px solid #eef2f6 !important;
        }
        body.dark-only #withdrawdisabled .modal-header {
            background: rgba(255, 255, 255, 0.02);
            border-bottom-color: rgba(255, 255, 255, 0.07) !important;
        }

        #withdrawdisabled .modal-body {
            padding: 24px;
        }
        #withdrawdisabled .modal-footer {
            padding: 16px 24px;
            background: rgba(0, 0, 0, 0.02);
            border-top: 1px solid #eef2f6 !important;
        }
        body.dark-only #withdrawdisabled .modal-footer {
            background: rgba(255, 255, 255, 0.02);
            border-top-color: rgba(255, 255, 255, 0.07) !important;
        }

        @media (max-width: 576px) {
            #withdrawdisabled .modal-dialog {
                margin: 0.75rem auto;
                max-width: calc(100% - 1.25rem);
            }
            #withdrawdisabled .modal-body {
                padding: 14px 15px !important;
            }
            #withdrawdisabled .modal-header {
                padding: 13px 15px !important;
            }
            #withdrawdisabled .modal-footer {
                padding: 11px 15px !important;
            }
        }

        /* Notice Alert Banner */
        .notice-amber-card {
            background: linear-gradient(135deg, rgba(245, 158, 11, 0.12) 0%, rgba(217, 119, 6, 0.05) 100%);
            border: 1px solid rgba(245, 158, 11, 0.35) !important;
            border-radius: 12px;
            padding: 13px 15px;
            position: relative;
        }
        body.dark-only .notice-amber-card {
            background: linear-gradient(135deg, rgba(245, 158, 11, 0.16) 0%, rgba(217, 119, 6, 0.08) 100%);
            border-color: rgba(245, 158, 11, 0.35) !important;
        }
        .notice-amber-card p {
            font-size: 12px;
            line-height: 1.5;
        }

        /* Support Channel Interactive Cards */
        .support-channel-tile {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 14px;
            border-radius: 12px;
            text-decoration: none !important;
            transition: all 0.22s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            cursor: pointer;
            gap: 12px;
        }
        .support-channel-tile:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.12);
        }
        .support-channel-tile:active {
            transform: scale(0.985);
        }

        .tile-left-content {
            display: flex;
            align-items: center;
            gap: 12px;
            min-width: 0;
        }

        .tile-title {
            font-size: 12.5px;
            font-weight: 600;
            line-height: 1.3;
            letter-spacing: 0.1px;
        }

        .tile-subtitle {
            font-size: 10.5px;
            line-height: 1.3;
            margin-top: 1px;
            opacity: 0.85;
        }

        .tile-badge {
            padding: 3.5px 9px !important;
            font-size: 10px !important;
            font-weight: 600 !important;
            display: inline-flex !important;
            align-items: center !important;
            gap: 5px !important;
            border-radius: 9999px !important;
            flex-shrink: 0;
            transition: all 0.2s ease;
        }

        /* WhatsApp Tile */
        .support-channel-tile.tile-wa {
            background: rgba(37, 211, 102, 0.08);
            border: 1px solid rgba(37, 211, 102, 0.28);
        }
        .support-channel-tile.tile-wa:hover {
            background: rgba(37, 211, 102, 0.16);
            border-color: #25D366;
            box-shadow: 0 6px 18px rgba(37, 211, 102, 0.22);
        }
        .support-channel-tile.tile-wa .tile-badge {
            background-color: #25D366 !important;
            color: #ffffff !important;
            box-shadow: 0 2px 8px rgba(37, 211, 102, 0.35);
        }

        /* Telegram Tile */
        .support-channel-tile.tile-tg {
            background: rgba(34, 158, 217, 0.08);
            border: 1px solid rgba(34, 158, 217, 0.28);
        }
        .support-channel-tile.tile-tg:hover {
            background: rgba(34, 158, 217, 0.16);
            border-color: #229ED9;
            box-shadow: 0 6px 18px rgba(34, 158, 217, 0.22);
        }
        .support-channel-tile.tile-tg .tile-badge {
            background-color: #229ED9 !important;
            color: #ffffff !important;
            box-shadow: 0 2px 8px rgba(34, 158, 217, 0.4);
            font-weight: 700;
        }

        /* Ticket Tile */
        .support-channel-tile.tile-ticket {
            background: rgba(99, 98, 231, 0.08);
            border: 1px solid rgba(99, 98, 231, 0.28);
        }
        .support-channel-tile.tile-ticket:hover {
            background: rgba(99, 98, 231, 0.16);
            border-color: #6362e7;
            box-shadow: 0 6px 18px rgba(99, 98, 231, 0.22);
        }
        .support-channel-tile.tile-ticket .tile-badge {
            background: linear-gradient(135deg, #6362e7 0%, #4f46e5 100%) !important;
            color: #ffffff !important;
            box-shadow: 0 2px 8px rgba(99, 98, 231, 0.35);
        }

        .tile-icon-bubble {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            color: #ffffff;
            font-size: 14px;
        }

        @media (max-width: 576px) {
            .modal-warning-icon {
                width: 30px !important;
                height: 30px !important;
                font-size: 12px !important;
            }
            .modal-main-title {
                font-size: 13.5px !important;
            }
            .modal-sub-title {
                font-size: 10px !important;
            }
            .notice-amber-card {
                padding: 11px 13px !important;
                border-radius: 10px !important;
                margin-bottom: 11px !important;
            }
            .notice-amber-card p {
                font-size: 11px !important;
                line-height: 1.45 !important;
                margin-bottom: 6px !important;
            }
            .notice-amber-card .sec-note {
                font-size: 10px !important;
                padding-top: 6px !important;
            }
            .support-channel-tile {
                padding: 8px 11px !important;
                border-radius: 10px !important;
                gap: 8px !important;
            }
            .tile-left-content {
                gap: 10px !important;
            }
            .tile-icon-bubble {
                width: 27px !important;
                height: 27px !important;
                border-radius: 7px !important;
                font-size: 12px !important;
            }
            .tile-title {
                font-size: 11.5px !important;
            }
            .tile-subtitle {
                display: none !important;
            }
            .tile-badge {
                padding: 2.5px 7px !important;
                font-size: 9px !important;
                gap: 3px !important;
            }
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
                        @php
                            $waUrl = $settings->getWhatsAppUrl("Hello, I need assistance regarding withdrawal processing on {$settings->site_name}.");
                            $tgUrl = $settings->getTelegramUrl();
                        @endphp
                        <div class="d-flex flex-wrap justify-content-center align-items-center gap-2">
                            @if($waUrl)
                                <a href="{{ $waUrl }}" target="_blank" rel="noopener noreferrer" 
                                   class="btn btn-sm px-3 py-2 rounded-3 text-white shadow-sm d-inline-flex align-items-center"
                                   style="background-color: #25D366 !important; border-color: #22bf5b !important; color: #ffffff !important; font-weight: 600; gap: 7px;">
                                    <i class="fa-brands fa-whatsapp text-white f-14"></i>
                                    <span>WhatsApp</span>
                                </a>
                            @endif
                            @if($tgUrl)
                                <a href="{{ $tgUrl }}" target="_blank" rel="noopener noreferrer" 
                                   class="btn btn-sm px-3 py-2 rounded-3 text-white shadow-sm d-inline-flex align-items-center"
                                   style="background-color: #229ED9 !important; border-color: #1f8ec4 !important; color: #ffffff !important; font-weight: 600; gap: 7px;">
                                    <i class="fa-brands fa-telegram text-white f-14"></i>
                                    <span>Telegram</span>
                                </a>
                            @endif
                            <a href="{{ route('support') }}" class="btn btn-primary px-4 py-2 rounded-3 shadow-sm text-white d-inline-flex align-items-center" style="color: #ffffff !important; font-weight: 600; gap: 7px;">
                                <i class="fa-solid fa-headset me-1 text-white"></i>Contact Support
                            </a>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>

        @php
            $waUrl = $settings->getWhatsAppUrl("Hello, I need assistance regarding withdrawal processing on {$settings->site_name}.");
            $tgUrl = $settings->getTelegramUrl();
        @endphp

        <!-- Withdrawal Disabled Modal -->
        <div id="withdrawdisabled" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static">
            <div class="modal-dialog modal-dialog-centered" style="max-width: 530px;">
                <div class="modal-content shadow-lg border-0">
                    <!-- Modal Header -->
                    <div class="modal-header d-flex align-items-center justify-content-between border-bottom pb-3">
                        <div class="d-flex align-items-center" style="gap: 11px;">
                            <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0 modal-warning-icon" 
                                 style="width: 34px; height: 34px; background: rgba(245, 158, 11, 0.15); color: #f59e0b; border: 1px solid rgba(245, 158, 11, 0.35);">
                                <i class="fa-solid fa-triangle-exclamation f-14"></i>
                            </div>
                            <div>
                                <h5 class="modal-title it-title f-w-700 f-15 mb-0 modal-main-title">Withdrawal Notice</h5>
                                <span class="it-muted f-11 d-block modal-sub-title">Institutional Qualification Required</span>
                            </div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="opacity: 0.7;"></button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body py-3">
                        <!-- High-Contrast Notice Card -->
                        <div class="notice-amber-card mb-3">
                            <div class="d-flex align-items-center mb-2" style="gap: 6px;">
                                <span class="badge rounded-pill text-uppercase px-2.5 py-1 f-10 f-w-700" 
                                      style="background: rgba(245, 158, 11, 0.25); color: #f59e0b; border: 1px solid rgba(245, 158, 11, 0.45); letter-spacing: 0.5px;">
                                    <i class="fa-solid fa-shield-halved me-1"></i> Ineligible Wallet Notice
                                </span>
                            </div>
                            <p class="mb-2 it-text">
                                Your wallet is currently ineligible. Eligible wallets must record over $50,000 in transaction volume and be listed or affiliated with the company.
                                <br><br>
                                Your funds remain 100% secured. For assistance, please contact the official administrator or our 24/7 Customer Support Desk.
                            </p>
                        </div>

                        <!-- Instructions Prompt -->
                        <div class="d-flex align-items-center justify-content-between mb-2.5 px-1">
                            <span class="f-11 f-w-700 it-title text-uppercase" style="letter-spacing: 0.4px;">Direct Priority Channels:</span>
                            <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 f-10 px-2.5 py-1 rounded-pill d-inline-flex align-items-center" style="gap: 5px;">
                                <span class="rounded-circle bg-success" style="width: 5px; height: 5px; display: inline-block;"></span>
                                <span>Live Support Online</span>
                            </span>
                        </div>

                        <!-- 3 Responsive Channel Action Cards -->
                        <div class="d-flex flex-column" style="gap: 8px;">
                            <!-- WhatsApp Channel -->
                            <a href="{{ $waUrl }}" target="_blank" rel="noopener noreferrer" class="support-channel-tile tile-wa">
                                <div class="tile-left-content">
                                    <div class="tile-icon-bubble" style="background-color: #25D366; box-shadow: 0 3px 8px rgba(37, 211, 102, 0.3);">
                                        <i class="fa-brands fa-whatsapp"></i>
                                    </div>
                                    <div class="text-start min-w-0">
                                        <div class="tile-title" style="color: #25D366;">WhatsApp Live Chat</div>
                                        <div class="it-muted tile-subtitle">Instant 1-on-1 chat with official support desk</div>
                                    </div>
                                </div>
                                <span class="badge rounded-pill tile-badge flex-shrink-0">
                                    <span>Chat Now</span>
                                    <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                </span>
                            </a>

                            <!-- Telegram Channel -->
                            <a href="{{ $tgUrl }}" target="_blank" rel="noopener noreferrer" class="support-channel-tile tile-tg">
                                <div class="tile-left-content">
                                    <div class="tile-icon-bubble" style="background-color: #229ED9; box-shadow: 0 3px 8px rgba(34, 158, 217, 0.3);">
                                        <i class="fa-brands fa-telegram"></i>
                                    </div>
                                    <div class="text-start min-w-0">
                                        <div class="tile-title" style="color: #229ED9;">Telegram VIP Desk</div>
                                        <div class="it-muted tile-subtitle">Encrypted priority verification & OTC desk</div>
                                    </div>
                                </div>
                                <span class="badge rounded-pill tile-badge flex-shrink-0">
                                    <span>Connect</span>
                                    <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                </span>
                            </a>

                            <!-- Support Ticket Channel -->
                            <a href="{{ route('support') }}" class="support-channel-tile tile-ticket">
                                <div class="tile-left-content">
                                    <div class="tile-icon-bubble" style="background: linear-gradient(135deg, #6362e7 0%, #4f46e5 100%); box-shadow: 0 3px 8px rgba(99, 98, 231, 0.3);">
                                        <i class="fa-solid fa-ticket-simple" style="font-size: 13px;"></i>
                                    </div>
                                    <div class="text-start min-w-0">
                                        <div class="tile-title text-primary">Submit Support Ticket</div>
                                        <div class="it-muted tile-subtitle">Official inquiry form with email status updates</div>
                                    </div>
                                </div>
                                <span class="badge rounded-pill tile-badge flex-shrink-0">
                                    <span>Open Form</span>
                                    <i class="fa-solid fa-arrow-right"></i>
                                </span>
                            </a>
                        </div>
                    </div>

                    <!-- Modal Footer -->
                    <div class="modal-footer border-top d-flex align-items-center justify-content-between py-2.5 px-3 px-sm-4">
                        <div class="d-flex align-items-center it-muted f-11" style="gap: 7px;">
                            <i class="fa-solid fa-lock text-success f-11"></i>
                            <span class="d-none d-sm-inline">Institutional Security • </span>
                            <span>24/7 Concierge</span>
                        </div>
                        <button type="button" class="btn btn-secondary btn-sm px-3 py-1.5 rounded-pill f-11 f-w-600 shadow-xs" data-bs-dismiss="modal">
                            Close Notice
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
