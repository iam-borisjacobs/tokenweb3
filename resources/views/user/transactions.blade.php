@extends('layouts.dash')
@section('title', $title ?? 'Account Statement & Transaction Ledger')

@section('content')
    <!-- Scoped Theme Tokens & Styling -->
    <style>
        .tx-view .it-title {
            color: #0f172a !important;
            transition: color 0.2s ease;
        }
        body.dark-only .tx-view .it-title {
            color: #ffffff !important;
        }

        .tx-view .it-text {
            color: #334155 !important;
            transition: color 0.2s ease;
        }
        body.dark-only .tx-view .it-text {
            color: #f1f5f9 !important;
        }

        .tx-view .it-muted {
            color: #64748b !important;
            transition: color 0.2s ease;
        }
        body.dark-only .tx-view .it-muted {
            color: #94a3b8 !important;
        }

        .tx-view .terminal-card {
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            transition: all 0.25s ease;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.03);
        }
        body.dark-only .tx-view .terminal-card {
            background-color: #1a2238;
            border-color: rgba(255, 255, 255, 0.08);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.25);
        }

        /* Modern Segmented Navigation Tabs */
        .tx-nav-pills {
            background-color: #f1f5f9;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 5px;
            gap: 6px;
            display: flex;
            flex-wrap: wrap;
        }
        body.dark-only .tx-nav-pills {
            background-color: #141b2d !important;
            border-color: rgba(255, 255, 255, 0.08) !important;
        }
        .tx-nav-pills .nav-item {
            margin: 0;
        }
        .tx-nav-pills .nav-link {
            border-radius: 10px !important;
            font-size: 13px !important;
            font-weight: 600 !important;
            color: #64748b !important;
            padding: 9px 18px !important;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border: none;
            background: transparent;
        }
        body.dark-only .tx-nav-pills .nav-link {
            color: #94a3b8 !important;
        }
        .tx-nav-pills .nav-link:hover {
            color: #0f172a !important;
            background-color: rgba(0, 0, 0, 0.04);
        }
        body.dark-only .tx-nav-pills .nav-link:hover {
            color: #ffffff !important;
            background-color: rgba(255, 255, 255, 0.05);
        }
        .tx-nav-pills .nav-link.active {
            color: #ffffff !important;
            background: var(--theme-gradient, linear-gradient(135deg, #2563eb 0%, #4f46e5 100%)) !important;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25) !important;
        }
        .tx-nav-pills .nav-link.active .badge {
            background-color: rgba(255, 255, 255, 0.25) !important;
            color: #ffffff !important;
        }

        /* Search Input */
        .tx-search-input {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 8px 14px 8px 36px;
            font-size: 13px;
            color: #0f172a;
            transition: all 0.2s ease;
            width: 260px;
        }
        body.dark-only .tx-search-input {
            background-color: #141b2d;
            border-color: rgba(255, 255, 255, 0.1);
            color: #f1f5f9;
        }
        .tx-search-input:focus {
            outline: none;
            border-color: var(--theme-default, #2563eb);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
            width: 300px;
        }

        /* Table Terminal Design */
        .tx-view .table-terminal thead th {
            background-color: #f8fafc;
            color: #475569;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 1.5px solid #e2e8f0;
            padding: 13px 18px;
            white-space: nowrap;
        }
        body.dark-only .tx-view .table-terminal thead th {
            background-color: #151c30;
            color: #94a3b8;
            border-bottom-color: rgba(255, 255, 255, 0.08);
        }

        .tx-view .table-terminal tbody td {
            padding: 15px 18px;
            vertical-align: middle;
            border-bottom: 1px solid #f1f5f9;
            font-size: 13px;
        }
        body.dark-only .tx-view .table-terminal tbody td {
            border-bottom-color: rgba(255, 255, 255, 0.05);
        }

        .tx-view .table-terminal tbody tr:hover td {
            background-color: rgba(99, 98, 231, 0.03);
        }
        body.dark-only .tx-view .table-terminal tbody tr:hover td {
            background-color: rgba(99, 98, 231, 0.06);
        }

        @media print {
            .page-sidebar, .page-header, .btn, .breadcrumb, .tx-nav-pills, .tx-search-box {
                display: none !important;
            }
            .page-body {
                padding: 0 !important;
                background: #fff !important;
            }
            .terminal-card {
                box-shadow: none !important;
                border: 1px solid #ccc !important;
            }
        }
    </style>

    <div class="tx-view">
        @php
            $allTransactions = collect();

            foreach ($deposits as $d) {
                $allTransactions->push((object)[
                    'id' => $d->id,
                    'category' => 'Deposit',
                    'icon' => 'fa-solid fa-arrow-down',
                    'icon_class' => 'success',
                    'flow' => 'Inflow',
                    'amount' => (float)$d->amount,
                    'amount_formatted' => '+' . $settings->currency . number_format($d->amount, 2),
                    'amount_color' => 'text-success',
                    'method' => $d->payment_mode ?? 'Deposit Gateway',
                    'status' => $d->status,
                    'narration' => 'Account Deposit Funding',
                    'created_at' => $d->created_at,
                ]);
            }

            foreach ($withdrawals as $w) {
                $allTransactions->push((object)[
                    'id' => $w->id,
                    'category' => 'Withdrawal',
                    'icon' => 'fa-solid fa-arrow-up',
                    'icon_class' => 'warning',
                    'flow' => 'Outflow',
                    'amount' => (float)$w->amount,
                    'amount_formatted' => '-' . $settings->currency . number_format($w->amount, 2),
                    'amount_color' => 'text-danger',
                    'method' => $w->payment_mode ?? 'Withdrawal Gateway',
                    'status' => $w->status,
                    'narration' => 'Capital Withdrawal Request',
                    'created_at' => $w->created_at,
                ]);
            }

            foreach ($t_history as $t) {
                $isPlan = str_contains(strtolower($t->type ?? ''), 'plan');
                $isWeb3 = str_contains(strtolower($t->type ?? ''), 'web3');
                $allTransactions->push((object)[
                    'id' => $t->id,
                    'category' => 'Others',
                    'icon' => $isPlan ? 'fa-solid fa-gem' : 'fa-solid fa-sliders',
                    'icon_class' => 'primary',
                    'flow' => $isPlan ? 'Allocation' : 'Adjustment',
                    'amount' => (float)$t->amount,
                    'amount_formatted' => ($isPlan ? '-' : '') . $settings->currency . number_format($t->amount, 2),
                    'amount_color' => $isPlan ? 'text-primary' : 'it-title',
                    'method' => $isWeb3 ? 'Web3 Connected Wallet' : 'Account Balance',
                    'status' => 'Processed',
                    'narration' => $t->plan ? $t->plan : ($t->type ?? 'System Transaction'),
                    'created_at' => $t->created_at,
                ]);
            }

            $allTransactions = $allTransactions->sortByDesc('created_at');
        @endphp

        <!-- Page Header -->
        <div class="page-title mb-4">
            <div class="row align-items-center justify-content-between g-3">
                <div class="col-md-7">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-1 p-0 bg-transparent f-12">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="it-muted text-decoration-none">Dashboard</a></li>
                            <li class="breadcrumb-item it-muted">Financial Management</li>
                            <li class="breadcrumb-item active text-primary" aria-current="page">Account Statement</li>
                        </ol>
                    </nav>
                    <h4 class="mb-1 it-title f-w-700">Account Statement & Transaction Ledger</h4>
                    <p class="mb-0 it-muted f-13">Complete institutional audit trail of all deposits, withdrawals, Web3 capital allocations, and internal transfers.</p>
                </div>
                <div class="col-md-5">
                    <div class="d-flex align-items-center justify-content-md-end gap-2 flex-wrap">
                        <button onclick="window.print()" class="btn btn-outline-secondary rounded-pill px-3 py-2 d-inline-flex align-items-center gap-2 f-13 f-w-600">
                            <i class="fa-solid fa-print"></i>
                            <span>Print Statement</span>
                        </button>
                        <a href="{{ route('deposits') }}" class="btn btn-primary rounded-pill px-3 py-2 d-inline-flex align-items-center gap-2 f-13 f-w-600 shadow-sm text-white">
                            <i class="fa-solid fa-circle-arrow-down text-white"></i>
                            <span>Deposit</span>
                        </a>
                        <a href="{{ route('withdrawalsdeposits') }}" class="btn btn-outline-primary rounded-pill px-3 py-2 d-inline-flex align-items-center gap-2 f-13 f-w-600">
                            <i class="fa-solid fa-circle-arrow-up"></i>
                            <span>Withdraw</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <x-danger-alert />
        <x-success-alert />

        <!-- Top Telemetry Metric Cards -->
        <div class="row g-3 mb-4">
            <div class="col-sm-6 col-xl-3">
                <div class="terminal-card p-3 h-100 d-flex align-items-center gap-3">
                    <div class="metric-icon-circle success" style="width: 44px; height: 44px; font-size: 18px;">
                        <i class="fa-solid fa-circle-arrow-down"></i>
                    </div>
                    <div class="overflow-hidden">
                        <span class="d-block it-muted f-11 text-uppercase f-w-600" style="letter-spacing: 0.5px;">Total Deposited</span>
                        <h5 class="mb-0 text-success f-w-700 f-18 text-truncate">+{{ $settings->currency }}{{ number_format($totalDeposited ?? 0, 2) }}</h5>
                        <small class="it-muted f-11">{{ $deposits->where('status', 'Processed')->count() }} Confirmed Inflows</small>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="terminal-card p-3 h-100 d-flex align-items-center gap-3">
                    <div class="metric-icon-circle warning" style="width: 44px; height: 44px; font-size: 18px;">
                        <i class="fa-solid fa-circle-arrow-up"></i>
                    </div>
                    <div class="overflow-hidden">
                        <span class="d-block it-muted f-11 text-uppercase f-w-600" style="letter-spacing: 0.5px;">Total Withdrawn</span>
                        <h5 class="mb-0 text-warning f-w-700 f-18 text-truncate">-{{ $settings->currency }}{{ number_format($totalWithdrawn ?? 0, 2) }}</h5>
                        <small class="it-muted f-11">{{ $withdrawals->where('status', 'Processed')->count() }} Processed Outflows</small>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="terminal-card p-3 h-100 d-flex align-items-center gap-3">
                    <div class="metric-icon-circle primary" style="width: 44px; height: 44px; font-size: 18px;">
                        <i class="fa-solid fa-cubes"></i>
                    </div>
                    <div class="overflow-hidden">
                        <span class="d-block it-muted f-11 text-uppercase f-w-600" style="letter-spacing: 0.5px;">Plan Allocations</span>
                        <h5 class="mb-0 text-primary f-w-700 f-18 text-truncate">{{ $settings->currency }}{{ number_format($totalAllocated ?? 0, 2) }}</h5>
                        <small class="it-muted f-11">{{ $t_history->count() }} Ledger Records</small>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="terminal-card p-3 h-100 d-flex align-items-center gap-3">
                    <div class="metric-icon-circle info" style="width: 44px; height: 44px; font-size: 18px;">
                        <i class="fa-solid fa-wallet"></i>
                    </div>
                    <div class="overflow-hidden">
                        <span class="d-block it-muted f-11 text-uppercase f-w-600" style="letter-spacing: 0.5px;">Liquid Balance</span>
                        <h5 class="mb-0 it-title f-w-700 f-18 text-truncate">{{ $settings->currency }}{{ number_format(Auth::user()->account_bal ?? 0, 2) }}</h5>
                        <small class="it-muted f-11">Active Trading Balance</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Transaction Ledger Container -->
        <div class="terminal-card p-4 mb-4">
            <!-- Tabs & Search Controls Header -->
            <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">
                <!-- Modern Segmented Tabs -->
                <ul class="nav nav-pills tx-nav-pills" id="statementTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="tab-all-btn" data-bs-toggle="pill" data-bs-target="#tab-all" type="button" role="tab" aria-controls="tab-all" aria-selected="true">
                            <i class="fa-solid fa-list-check f-12"></i>
                            <span>All Activity</span>
                            <span class="badge bg-secondary-subtle text-secondary rounded-pill f-10 px-2">{{ $allTransactions->count() }}</span>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="tab-deposits-btn" data-bs-toggle="pill" data-bs-target="#tab-deposits" type="button" role="tab" aria-controls="tab-deposits" aria-selected="false">
                            <i class="fa-solid fa-arrow-down text-success f-12"></i>
                            <span>Deposits</span>
                            <span class="badge bg-secondary-subtle text-secondary rounded-pill f-10 px-2">{{ $deposits->count() }}</span>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="tab-withdrawals-btn" data-bs-toggle="pill" data-bs-target="#tab-withdrawals" type="button" role="tab" aria-controls="tab-withdrawals" aria-selected="false">
                            <i class="fa-solid fa-arrow-up text-warning f-12"></i>
                            <span>Withdrawals</span>
                            <span class="badge bg-secondary-subtle text-secondary rounded-pill f-10 px-2">{{ $withdrawals->count() }}</span>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="tab-others-btn" data-bs-toggle="pill" data-bs-target="#tab-others" type="button" role="tab" aria-controls="tab-others" aria-selected="false">
                            <i class="fa-solid fa-cubes text-primary f-12"></i>
                            <span>Plans & Others</span>
                            <span class="badge bg-secondary-subtle text-secondary rounded-pill f-10 px-2">{{ $t_history->count() }}</span>
                        </button>
                    </li>
                </ul>

                <!-- Live Client-Side Search Filter -->
                <div class="position-relative tx-search-box">
                    <i class="fa-solid fa-magnifying-glass position-absolute text-muted" style="left: 12px; top: 50%; transform: translateY(-50%); font-size: 13px;"></i>
                    <input type="text" id="txLiveFilter" class="tx-search-input" placeholder="Search by amount, method, status, date...">
                </div>
            </div>

            <!-- Tab Contents -->
            <div class="tab-content" id="statementTabsContent">
                
                <!-- TAB 1: ALL ACTIVITY (Consolidated Ledger) -->
                <div class="tab-pane fade show active" id="tab-all" role="tabpanel" aria-labelledby="tab-all-btn">
                    @if($allTransactions->count() > 0)
                        <div class="table-responsive rounded-3 border">
                            <table class="table table-terminal mb-0 text-nowrap" id="tableAll">
                                <thead>
                                    <tr>
                                        <th>Transaction / Reference</th>
                                        <th>Flow & Amount</th>
                                        <th>Payment Channel / Node</th>
                                        <th>Status</th>
                                        <th>Recorded Timestamp</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($allTransactions as $item)
                                        <tr class="tx-row">
                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    <div class="metric-icon-circle {{ $item->icon_class }}" style="width: 32px; height: 32px; font-size: 13px;">
                                                        <i class="{{ $item->icon }}"></i>
                                                    </div>
                                                    <div>
                                                        <span class="d-block it-title f-w-700 f-13">{{ $item->narration }}</span>
                                                        <span class="it-muted f-11">#{{ $item->category }}-{{ str_pad($item->id, 5, '0', STR_PAD_LEFT) }} &bull; {{ $item->category }}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="f-w-700 f-14 {{ $item->amount_color }}">
                                                    {{ $item->amount_formatted }}
                                                </span>
                                                <small class="d-block it-muted f-10 text-uppercase">{{ $item->flow }}</small>
                                            </td>
                                            <td>
                                                <span class="badge bg-light bg-opacity-75 text-dark border rounded-pill px-2.5 py-1 f-11">
                                                    <i class="fa-solid fa-link text-muted me-1"></i> {{ $item->method }}
                                                </span>
                                            </td>
                                            <td>
                                                @if($item->status == 'Processed' || $item->status == 'Approved' || $item->status == 'Success')
                                                    <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2.5 py-1 f-11">
                                                        <i class="fa-solid fa-circle-check me-1"></i> Completed
                                                    </span>
                                                @elseif($item->status == 'Pending')
                                                    <span class="badge bg-warning-subtle text-warning border border-warning-subtle rounded-pill px-2.5 py-1 f-11">
                                                        <i class="fa-solid fa-clock me-1"></i> Pending
                                                    </span>
                                                @else
                                                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill px-2.5 py-1 f-11">
                                                        <i class="fa-solid fa-circle-xmark me-1"></i> {{ $item->status }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="d-block it-text f-12">{{ \Carbon\Carbon::parse($item->created_at)->format('M d, Y') }}</span>
                                                <small class="it-muted f-11">{{ \Carbon\Carbon::parse($item->created_at)->format('h:i A') }}</small>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <!-- Empty State for All Transactions -->
                        <div class="text-center py-5 px-3">
                            <div class="metric-icon-circle neutral mx-auto mb-3" style="width: 60px; height: 60px; font-size: 24px; background: rgba(100, 116, 139, 0.1);">
                                <i class="fa-solid fa-receipt text-muted"></i>
                            </div>
                            <h5 class="it-title f-w-700 mb-1">No Transactions Recorded Yet</h5>
                            <p class="it-muted f-13 mb-4 mx-auto" style="max-width: 440px;">
                                Your unified transaction ledger will record every capital deposit, withdrawal payout, and investment staking event.
                            </p>
                            <a href="{{ route('deposits') }}" class="btn btn-primary rounded-pill px-4 py-2 f-13 f-w-600 shadow-sm text-white">
                                <i class="fa-solid fa-circle-arrow-down me-1 text-white"></i> Make Your First Deposit
                            </a>
                        </div>
                    @endif
                </div>

                <!-- TAB 2: DEPOSITS -->
                <div class="tab-pane fade" id="tab-deposits" role="tabpanel" aria-labelledby="tab-deposits-btn">
                    @if($deposits->count() > 0)
                        <div class="table-responsive rounded-3 border">
                            <table class="table table-terminal mb-0 text-nowrap" id="tableDeposits">
                                <thead>
                                    <tr>
                                        <th>Deposit Reference</th>
                                        <th>Amount Deposited</th>
                                        <th>Payment Mode</th>
                                        <th>Status</th>
                                        <th>Recorded Timestamp</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($deposits as $deposit)
                                        <tr class="tx-row">
                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    <div class="metric-icon-circle success" style="width: 32px; height: 32px; font-size: 13px;">
                                                        <i class="fa-solid fa-arrow-down"></i>
                                                    </div>
                                                    <div>
                                                        <span class="d-block it-title f-w-700 f-13">Account Funding</span>
                                                        <span class="it-muted f-11">#DEP-{{ str_pad($deposit->id, 5, '0', STR_PAD_LEFT) }}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="f-w-700 text-success f-14">
                                                    +{{ $settings->currency }}{{ number_format($deposit->amount, 2) }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge bg-light bg-opacity-75 text-dark border rounded-pill px-2.5 py-1 f-11">
                                                    {{ $deposit->payment_mode }}
                                                </span>
                                            </td>
                                            <td>
                                                @if ($deposit->status == 'Processed')
                                                    <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2.5 py-1 f-11">
                                                        <i class="fa-solid fa-circle-check me-1"></i> Completed
                                                    </span>
                                                @else
                                                    <span class="badge bg-warning-subtle text-warning border border-warning-subtle rounded-pill px-2.5 py-1 f-11">
                                                        <i class="fa-solid fa-clock me-1"></i> {{ $deposit->status }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="d-block it-text f-12">{{ \Carbon\Carbon::parse($deposit->created_at)->format('M d, Y') }}</span>
                                                <small class="it-muted f-11">{{ \Carbon\Carbon::parse($deposit->created_at)->format('h:i A') }}</small>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <!-- Empty State for Deposits -->
                        <div class="text-center py-5 px-3">
                            <div class="metric-icon-circle success mx-auto mb-3" style="width: 60px; height: 60px; font-size: 24px;">
                                <i class="fa-solid fa-circle-arrow-down text-success"></i>
                            </div>
                            <h5 class="it-title f-w-700 mb-1">No Deposit Records Found</h5>
                            <p class="it-muted f-13 mb-4 mx-auto" style="max-width: 440px;">
                                You have not initiated any account funding deposits yet. Add funds using crypto, bank wire, or credit channels to begin trading.
                            </p>
                            <a href="{{ route('deposits') }}" class="btn btn-primary rounded-pill px-4 py-2 f-13 f-w-600 shadow-sm text-white">
                                <i class="fa-solid fa-plus me-1 text-white"></i> Make a Deposit Now
                            </a>
                        </div>
                    @endif
                </div>

                <!-- TAB 3: WITHDRAWALS -->
                <div class="tab-pane fade" id="tab-withdrawals" role="tabpanel" aria-labelledby="tab-withdrawals-btn">
                    @if($withdrawals->count() > 0)
                        <div class="table-responsive rounded-3 border">
                            <table class="table table-terminal mb-0 text-nowrap" id="tableWithdrawals">
                                <thead>
                                    <tr>
                                        <th>Withdrawal Reference</th>
                                        <th>Amount Requested</th>
                                        <th>Deductions & Charges</th>
                                        <th>Receiving Mode</th>
                                        <th>Status</th>
                                        <th>Recorded Timestamp</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($withdrawals as $withdrawal)
                                        <tr class="tx-row">
                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    <div class="metric-icon-circle warning" style="width: 32px; height: 32px; font-size: 13px;">
                                                        <i class="fa-solid fa-arrow-up"></i>
                                                    </div>
                                                    <div>
                                                        <span class="d-block it-title f-w-700 f-13">Disbursement Payout</span>
                                                        <span class="it-muted f-11">#WTH-{{ str_pad($withdrawal->id, 5, '0', STR_PAD_LEFT) }}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="f-w-700 text-danger f-14">
                                                    -{{ $settings->currency }}{{ number_format($withdrawal->amount, 2) }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="it-text f-13">
                                                    {{ $settings->currency }}{{ number_format($withdrawal->to_deduct ?? $withdrawal->amount, 2) }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge bg-light bg-opacity-75 text-dark border rounded-pill px-2.5 py-1 f-11">
                                                    {{ $withdrawal->payment_mode }}
                                                </span>
                                            </td>
                                            <td>
                                                @if ($withdrawal->status == 'Processed')
                                                    <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2.5 py-1 f-11">
                                                        <i class="fa-solid fa-circle-check me-1"></i> Completed
                                                    </span>
                                                @else
                                                    <span class="badge bg-warning-subtle text-warning border border-warning-subtle rounded-pill px-2.5 py-1 f-11">
                                                        <i class="fa-solid fa-clock me-1"></i> {{ $withdrawal->status }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="d-block it-text f-12">{{ \Carbon\Carbon::parse($withdrawal->created_at)->format('M d, Y') }}</span>
                                                <small class="it-muted f-11">{{ \Carbon\Carbon::parse($withdrawal->created_at)->format('h:i A') }}</small>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <!-- Empty State for Withdrawals -->
                        <div class="text-center py-5 px-3">
                            <div class="metric-icon-circle warning mx-auto mb-3" style="width: 60px; height: 60px; font-size: 24px;">
                                <i class="fa-solid fa-circle-arrow-up text-warning"></i>
                            </div>
                            <h5 class="it-title f-w-700 mb-1">No Withdrawal Records Found</h5>
                            <p class="it-muted f-13 mb-4 mx-auto" style="max-width: 440px;">
                                You have not submitted any payout requests yet. Once requested, your withdrawals and status tracking will appear here.
                            </p>
                            <a href="{{ route('withdrawalsdeposits') }}" class="btn btn-outline-primary rounded-pill px-4 py-2 f-13 f-w-600">
                                <i class="fa-solid fa-arrow-up-right-from-square me-1"></i> Request a Withdrawal
                            </a>
                        </div>
                    @endif
                </div>

                <!-- TAB 4: PLANS & OTHERS -->
                <div class="tab-pane fade" id="tab-others" role="tabpanel" aria-labelledby="tab-others-btn">
                    @if($t_history->count() > 0)
                        <div class="table-responsive rounded-3 border">
                            <table class="table table-terminal mb-0 text-nowrap" id="tableOthers">
                                <thead>
                                    <tr>
                                        <th>Transaction / Allocation</th>
                                        <th>Amount</th>
                                        <th>Plan Scope / Narration</th>
                                        <th>Channel / Funding Method</th>
                                        <th>Recorded Timestamp</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($t_history as $history)
                                        @php
                                            $isPlan = str_contains(strtolower($history->type ?? ''), 'plan');
                                            $isWeb3 = str_contains(strtolower($history->type ?? ''), 'web3');
                                        @endphp
                                        <tr class="tx-row">
                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    <div class="metric-icon-circle primary" style="width: 32px; height: 32px; font-size: 13px;">
                                                        <i class="{{ $isPlan ? 'fa-solid fa-gem' : 'fa-solid fa-sliders' }}"></i>
                                                    </div>
                                                    <div>
                                                        <span class="d-block it-title f-w-700 f-13">{{ $history->type }}</span>
                                                        <span class="it-muted f-11">#TX-{{ str_pad($history->id, 5, '0', STR_PAD_LEFT) }}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="f-w-700 f-14 {{ $isPlan ? 'text-primary' : 'it-title' }}">
                                                    {{ $isPlan ? '-' : '' }}{{ $settings->currency }}{{ number_format($history->amount, 2) }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="d-block it-text f-13 f-w-600">{{ $history->plan ?: 'General Ledger Event' }}</span>
                                                <small class="it-muted f-11">Executed via Terminal Engine</small>
                                            </td>
                                            <td>
                                                @if($isWeb3)
                                                    <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-2.5 py-1 f-11">
                                                        <i class="fa-solid fa-wallet me-1"></i> Web3 Connected Wallet
                                                    </span>
                                                @else
                                                    <span class="badge bg-light bg-opacity-75 text-dark border rounded-pill px-2.5 py-1 f-11">
                                                        <i class="fa-solid fa-building-columns me-1"></i> Account Balance
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="d-block it-text f-12">{{ \Carbon\Carbon::parse($history->created_at)->format('M d, Y') }}</span>
                                                <small class="it-muted f-11">{{ \Carbon\Carbon::parse($history->created_at)->format('h:i A') }}</small>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <!-- Empty State for Others -->
                        <div class="text-center py-5 px-3">
                            <div class="metric-icon-circle primary mx-auto mb-3" style="width: 60px; height: 60px; font-size: 24px;">
                                <i class="fa-solid fa-cubes text-primary"></i>
                            </div>
                            <h5 class="it-title f-w-700 mb-1">No Internal Staking Allocations Found</h5>
                            <p class="it-muted f-13 mb-4 mx-auto" style="max-width: 440px;">
                                When you activate investment packages or deploy capital across automated logistics and commodity contracts, records will appear here.
                            </p>
                            <a href="{{ route('mplans') }}" class="btn btn-primary rounded-pill px-4 py-2 f-13 f-w-600 shadow-sm text-white">
                                <i class="fa-solid fa-gem me-1 text-white"></i> Explore Investment Plans
                            </a>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>

    <!-- Client-Side Search and URL Tab Sync Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Live Search across active table rows
            var searchInput = document.getElementById('txLiveFilter');
            if (searchInput) {
                searchInput.addEventListener('keyup', function() {
                    var query = this.value.toLowerCase().trim();
                    var activeTab = document.querySelector('.tab-pane.active');
                    if (!activeTab) return;
                    
                    var rows = activeTab.querySelectorAll('tbody tr.tx-row');
                    rows.forEach(function(row) {
                        var text = row.textContent.toLowerCase();
                        if (text.indexOf(query) > -1) {
                            row.style.display = '';
                        } else {
                            row.style.display = 'none';
                        }
                    });
                });
            }

            // Sync URL hash with tabs
            var hash = window.location.hash;
            if (hash) {
                var triggerEl = document.querySelector('#statementTabs button[data-bs-target="' + hash + '"]');
                if (triggerEl && typeof bootstrap !== 'undefined' && bootstrap.Tab) {
                    var tab = new bootstrap.Tab(triggerEl);
                    tab.show();
                }
            }

            // Clean search when switching tabs
            var tabButtons = document.querySelectorAll('#statementTabs button[data-bs-toggle="pill"]');
            tabButtons.forEach(function(btn) {
                btn.addEventListener('shown.bs.tab', function(e) {
                    if (searchInput) {
                        searchInput.value = '';
                        var allRows = document.querySelectorAll('tbody tr.tx-row');
                        allRows.forEach(function(row) { row.style.display = ''; });
                    }
                });
            });
        });
    </script>
@endsection
