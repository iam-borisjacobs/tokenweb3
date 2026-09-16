@extends('layouts.app')

@section('content')
<div class="container-fluid py-2">
    <!-- Header Section -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-3 mb-md-4">
        <div>
            <div class="d-flex align-items-center gap-2 mb-1 flex-wrap">
                <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 px-2 py-1 rounded-pill f-11 f-w-700">
                    <i class="fa-solid fa-money-bill-transfer me-1"></i> Payout Management
                </span>
                <span class="text-muted f-12">• Real-time Liquidity</span>
            </div>
            <h3 class="f-w-800 text-dark mb-1 f-20 f-md-24">Manage Client Withdrawals</h3>
            <p class="text-muted mb-0 f-12 f-md-13">Review payout requests, verify destination wallet credentials, and execute disbursements.</p>
        </div>
        <div class="d-flex align-items-center gap-2 flex-wrap">
            <button type="button" class="btn btn-outline-secondary rounded-pill px-3 py-1 py-md-2 f-12 f-w-600" onclick="window.location.reload();">
                <i class="fa-solid fa-rotate me-1"></i> Refresh
            </button>
            <span class="badge bg-primary text-white px-3 py-1 py-md-2 rounded-pill f-12 shadow-sm">
                <i class="fa-solid fa-list-check me-1"></i> Total: {{ count($withdrawals) }} Records
            </span>
        </div>
    </div>

    <x-danger-alert />
    <x-success-alert />

    <!-- Executive KPI Metrics Ribbon -->
    @php
        $totalVol = $withdrawals->sum('amount');
        $pendingWithdrawals = $withdrawals->where('status', '!=', 'Processed');
        $pendingCount = $pendingWithdrawals->count();
        $pendingVol = $pendingWithdrawals->sum('amount');
        $processedWithdrawals = $withdrawals->where('status', 'Processed');
        $processedCount = $processedWithdrawals->count();
        $processedVol = $processedWithdrawals->sum('amount');
        $totalDeductions = $withdrawals->sum('to_deduct') ?: $totalVol;
    @endphp

    <div class="row g-2 g-md-3 mb-3 mb-md-4">
        <!-- Total Requested Volume -->
        <div class="col-6 col-lg-3">
            <div class="card border shadow-sm h-100 p-2 p-sm-3 mb-0" style="border-radius: 14px;">
                <div class="d-flex align-items-center justify-content-between mb-1 mb-sm-2">
                    <span class="text-muted f-11 f-w-600 text-truncate">Total Requested</span>
                    <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center flex-shrink-0" style="width: 32px; height: 32px; font-size: 13px;">
                        <i class="fa-solid fa-wallet"></i>
                    </div>
                </div>
                <h4 class="f-w-800 text-dark mb-1 text-truncate" style="font-size: clamp(14px, 3.8vw, 20px);" title="{{ $settings->currency }}{{ number_format($totalVol, 2) }}">
                    {{ $settings->currency }}{{ number_format($totalVol, 2) }}
                </h4>
                <div class="d-flex align-items-center gap-1 text-muted f-10 text-truncate">
                    <span class="f-w-700 text-primary">{{ count($withdrawals) }}</span> requests
                </div>
            </div>
        </div>

        <!-- Pending Review -->
        <div class="col-6 col-lg-3">
            <div class="card border shadow-sm h-100 p-2 p-sm-3 mb-0" style="border-radius: 14px;">
                <div class="d-flex align-items-center justify-content-between mb-1 mb-sm-2">
                    <span class="text-muted f-11 f-w-600 text-truncate">Pending Approvals</span>
                    <div class="rounded-circle bg-warning bg-opacity-10 text-warning d-flex align-items-center justify-content-center flex-shrink-0" style="width: 32px; height: 32px; font-size: 13px;">
                        <i class="fa-solid fa-hourglass-half"></i>
                    </div>
                </div>
                <h4 class="f-w-800 text-warning mb-1 text-truncate" style="font-size: clamp(14px, 3.8vw, 20px);" title="{{ $settings->currency }}{{ number_format($pendingVol, 2) }}">
                    {{ $settings->currency }}{{ number_format($pendingVol, 2) }}
                </h4>
                <div class="d-flex align-items-center gap-1 text-muted f-10 text-truncate">
                    <span class="badge bg-warning text-dark px-2 py-0.5 rounded-pill f-10 f-w-700">{{ $pendingCount }} Action Required</span>
                </div>
            </div>
        </div>

        <!-- Successfully Processed -->
        <div class="col-6 col-lg-3">
            <div class="card border shadow-sm h-100 p-2 p-sm-3 mb-0" style="border-radius: 14px;">
                <div class="d-flex align-items-center justify-content-between mb-1 mb-sm-2">
                    <span class="text-muted f-11 f-w-600 text-truncate">Paid Out (Settled)</span>
                    <div class="rounded-circle bg-success bg-opacity-10 text-success d-flex align-items-center justify-content-center flex-shrink-0" style="width: 32px; height: 32px; font-size: 13px;">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>
                </div>
                <h4 class="f-w-800 text-success mb-1 text-truncate" style="font-size: clamp(14px, 3.8vw, 20px);" title="{{ $settings->currency }}{{ number_format($processedVol, 2) }}">
                    {{ $settings->currency }}{{ number_format($processedVol, 2) }}
                </h4>
                <div class="d-flex align-items-center gap-1 text-muted f-10 text-truncate">
                    <span class="f-w-700 text-success">{{ $processedCount }}</span> disbursed
                </div>
            </div>
        </div>

        <!-- Net Deductions Sum -->
        <div class="col-6 col-lg-3">
            <div class="card border shadow-sm h-100 p-2 p-sm-3 mb-0" style="border-radius: 14px;">
                <div class="d-flex align-items-center justify-content-between mb-1 mb-sm-2">
                    <span class="text-muted f-11 f-w-600 text-truncate">Total Deducted</span>
                    <div class="rounded-circle bg-info bg-opacity-10 text-info d-flex align-items-center justify-content-center flex-shrink-0" style="width: 32px; height: 32px; font-size: 13px;">
                        <i class="fa-solid fa-receipt"></i>
                    </div>
                </div>
                <h4 class="f-w-800 text-dark mb-1 text-truncate" style="font-size: clamp(14px, 3.8vw, 20px);" title="{{ $settings->currency }}{{ number_format($totalDeductions, 2) }}">
                    {{ $settings->currency }}{{ number_format($totalDeductions, 2) }}
                </h4>
                <div class="d-flex align-items-center gap-1 text-muted f-10 text-truncate">
                    <span>Including fees</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Card Container -->
    <div class="card border shadow-sm mb-4" style="border-radius: 16px; overflow: hidden;">
        <!-- Filter Tabs & Quick Controls -->
        <div class="card-header border-bottom py-3 px-3 px-md-4" style="background: transparent;">
            <div class="d-flex flex-column flex-md-row align-items-stretch align-items-md-center justify-content-between gap-2.5">
                <!-- Status Filter Buttons (Full-width on mobile) -->
                <div class="btn-group btn-group-sm w-100 w-md-auto" role="group" id="withdrawalStatusFilter" style="display: flex;">
                    <button type="button" class="btn btn-outline-primary active py-2 px-2 px-md-3 f-11 f-md-12 f-w-600 flex-fill text-center" onclick="filterWithdrawals('all', this)">
                        All Requests <span class="badge bg-primary ms-1">{{ count($withdrawals) }}</span>
                    </button>
                    <button type="button" class="btn btn-outline-warning py-2 px-2 px-md-3 f-11 f-md-12 f-w-600 text-dark flex-fill text-center" onclick="filterWithdrawals('Pending', this)">
                        Pending <span class="badge bg-warning text-dark ms-1">{{ $pendingCount }}</span>
                    </button>
                    <button type="button" class="btn btn-outline-success py-2 px-2 px-md-3 f-11 f-md-12 f-w-600 flex-fill text-center" onclick="filterWithdrawals('Processed', this)">
                        Processed <span class="badge bg-success ms-1">{{ $processedCount }}</span>
                    </button>
                </div>

                <!-- Mobile Instant Search (Visible on mobile only) -->
                <div class="d-md-none w-100 mt-1">
                    <div class="position-relative">
                        <input type="text" class="form-control form-control-sm rounded-pill ps-4 py-2 f-12" id="mobileSearchWithdrawals" placeholder="🔍 Search client, ID, amount, method..." onkeyup="searchMobileWithdrawals(this.value)">
                    </div>
                </div>

                <div class="d-none d-md-flex align-items-center gap-2">
                    <small class="text-muted f-12"><i class="fa-solid fa-shield-halved text-success me-1"></i> End-to-end Audited Ledger</small>
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            <!-- 1. DESKTOP VIEW: High-Density DataTables (>= 768px) -->
            <div class="d-none d-md-block table-responsive p-3">
                <table id="ShipTable" class="table table-hover align-middle mb-0" style="width: 100%;">
                    <thead>
                        <tr>
                            <th class="ps-3" style="width: 70px;">ID</th>
                            <th>Client Profile</th>
                            <th>Requested</th>
                            <th>To Deduct</th>
                            <th>Payment Method</th>
                            <th>Status</th>
                            <th>Created Date</th>
                            <th class="text-end pe-3" style="width: 120px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($withdrawals as $withdrawal)
                            @php
                                $userName = $withdrawal->duser->name ?? 'Unknown User';
                                $userEmail = $withdrawal->duser->email ?? 'No email associated';
                                $userInitial = strtoupper(substr($userName, 0, 1));
                                $mode = strtolower($withdrawal->payment_mode ?? '');
                            @endphp
                            <tr>
                                <td class="ps-3">
                                    <span class="badge bg-light text-muted border px-2 py-1 font-monospace f-11">
                                        #{{ $withdrawal->id }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="rounded-circle text-white d-flex align-items-center justify-content-center f-12 f-w-800 shadow-sm flex-shrink-0" 
                                             style="width: 36px; height: 36px; background: linear-gradient(135deg, #6366f1 0%, #4338ca 100%);">
                                            {{ $userInitial }}
                                        </div>
                                        <div style="line-height: 1.3;">
                                            <h6 class="mb-0 f-13 f-w-700 text-dark">{{ $userName }}</h6>
                                            <small class="text-muted f-11">{{ $userEmail }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="f-w-800 text-dark f-14">{{ $settings->currency }}{{ number_format($withdrawal->amount, 2) }}</span>
                                </td>
                                <td>
                                    <span class="f-w-600 text-muted f-13">{{ $settings->currency }}{{ number_format($withdrawal->to_deduct ?? $withdrawal->amount, 2) }}</span>
                                </td>
                                <td>
                                    @if(str_contains($mode, 'usdt') || str_contains($mode, 'tether'))
                                        <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-2 py-1 rounded-pill f-11">
                                            <i class="fa-solid fa-coins me-1"></i> USDT
                                        </span>
                                    @elseif(str_contains($mode, 'btc') || str_contains($mode, 'bitcoin'))
                                        <span class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25 px-2 py-1 rounded-pill f-11">
                                            <i class="fa-brands fa-bitcoin me-1"></i> Bitcoin
                                        </span>
                                    @elseif(str_contains($mode, 'ltc') || str_contains($mode, 'litecoin'))
                                        <span class="badge bg-info bg-opacity-10 text-info border border-info border-opacity-25 px-2 py-1 rounded-pill f-11">
                                            <i class="fa-solid fa-litecoin-sign me-1"></i> Litecoin
                                        </span>
                                    @elseif(str_contains($mode, 'eth') || str_contains($mode, 'ethereum'))
                                        <span class="badge bg-purple bg-opacity-10 text-purple border border-purple border-opacity-25 px-2 py-1 rounded-pill f-11" style="color: #7c3aed; background-color: rgba(124, 58, 237, 0.1);">
                                            <i class="fa-brands fa-ethereum me-1"></i> Ethereum
                                        </span>
                                    @elseif(str_contains($mode, 'bank'))
                                        <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 px-2 py-1 rounded-pill f-11">
                                            <i class="fa-solid fa-building-columns me-1"></i> Bank Transfer
                                        </span>
                                    @else
                                        <span class="badge bg-light text-dark border px-2 py-1 rounded-pill f-11">
                                            <i class="fa-solid fa-wallet me-1"></i> {{ $withdrawal->payment_mode ?? 'Default' }}
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    @if ($withdrawal->status == 'Processed')
                                        <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-3 py-1 rounded-pill f-11 f-w-700">
                                            <i class="fa-solid fa-circle-check me-1"></i> Processed
                                        </span>
                                    @else
                                        <span class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25 px-3 py-1 rounded-pill f-11 f-w-700">
                                            <i class="fa-solid fa-clock me-1"></i> {{ $withdrawal->status ?? 'Pending' }}
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <span class="text-dark f-12 f-w-600">{{ \Carbon\Carbon::parse($withdrawal->created_at)->format('M d, Y h:i A') }}</span>
                                        <small class="text-muted f-11">{{ \Carbon\Carbon::parse($withdrawal->created_at)->diffForHumans() }}</small>
                                    </div>
                                </td>
                                <td class="text-end pe-3">
                                    <a href="{{ route('processwithdraw', $withdrawal->id) }}" 
                                       class="btn btn-sm btn-primary rounded-pill px-3 py-1 f-12 f-w-700 shadow-sm d-inline-flex align-items-center gap-1" 
                                       title="View Details & Process Payout">
                                        <i class="fa-solid fa-arrow-up-right-from-square f-10"></i>
                                        <span>Review</span>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-5">
                                    <div class="py-4">
                                        <div class="rounded-circle bg-light text-muted d-inline-flex align-items-center justify-content-center mb-3" style="width: 64px; height: 64px;">
                                            <i class="fa-solid fa-inbox f-28"></i>
                                        </div>
                                        <h6 class="f-w-700 text-dark mb-1">No Client Withdrawal Requests Found</h6>
                                        <p class="text-muted f-12 mb-0">Incoming payout requests from clients will automatically populate here.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- 2. MOBILE VIEW: Tailored Mobile Card Feed (< 768px) -->
            <div class="d-md-none p-3" id="mobileWithdrawalCardsContainer">
                @forelse ($withdrawals as $withdrawal)
                    @php
                        $userName = $withdrawal->duser->name ?? 'Unknown User';
                        $userEmail = $withdrawal->duser->email ?? 'No email associated';
                        $userInitial = strtoupper(substr($userName, 0, 1));
                        $mode = strtolower($withdrawal->payment_mode ?? '');
                        $isProcessed = ($withdrawal->status == 'Processed');
                    @endphp
                    <div class="mobile-withdrawal-card card border shadow-sm p-3 mb-3 rounded-3" 
                         data-status="{{ $withdrawal->status }}" 
                         data-search="{{ strtolower($userName . ' ' . $userEmail . ' ' . $withdrawal->id . ' ' . $withdrawal->payment_mode . ' ' . $withdrawal->amount) }}">
                        <!-- Top Row: Client Avatar, Name & Status -->
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <div class="d-flex align-items-center gap-2">
                                <div class="rounded-circle text-white d-flex align-items-center justify-content-center f-11 f-w-800 flex-shrink-0" 
                                     style="width: 32px; height: 32px; background: linear-gradient(135deg, #6366f1 0%, #4338ca 100%);">
                                    {{ $userInitial }}
                                </div>
                                <div style="line-height: 1.25;">
                                    <h6 class="mb-0 f-13 f-w-700 text-dark">{{ $userName }}</h6>
                                    <small class="text-muted f-10">{{ $userEmail }}</small>
                                </div>
                            </div>
                            <span class="badge bg-light text-muted border font-monospace f-10">#{{ $withdrawal->id }}</span>
                        </div>

                        <!-- Amount & Status Box -->
                        <div class="d-flex align-items-center justify-content-between p-2 rounded-2 mb-2 amount-status-box" style="background: rgba(99, 98, 231, 0.05); border: 1px solid rgba(99, 98, 231, 0.1);">
                            <div>
                                <small class="text-muted f-9 d-block font-weight-bold text-uppercase">Requested Payout</small>
                                <span class="f-w-800 text-dark f-16">{{ $settings->currency }}{{ number_format($withdrawal->amount, 2) }}</span>
                            </div>
                            <div class="text-end">
                                <small class="text-muted f-9 d-block font-weight-bold text-uppercase">Status</small>
                                @if ($isProcessed)
                                    <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-2 py-0.5 rounded-pill f-10 f-w-700">
                                        <i class="fa-solid fa-circle-check me-1"></i> Processed
                                    </span>
                                @else
                                    <span class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25 px-2 py-0.5 rounded-pill f-10 f-w-700">
                                        <i class="fa-solid fa-clock me-1"></i> Pending
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Details Row: Channel & Date -->
                        <div class="d-flex align-items-center justify-content-between mb-2 f-11 text-muted">
                            <div>
                                <span class="badge bg-light text-dark border px-2 py-0.5 rounded-pill f-10">
                                    <i class="fa-solid fa-wallet me-1 text-primary"></i> {{ $withdrawal->payment_mode ?? 'Default' }}
                                </span>
                            </div>
                            <div class="f-10 text-muted">
                                <i class="fa-regular fa-clock me-1"></i> {{ \Carbon\Carbon::parse($withdrawal->created_at)->format('M d, Y h:i A') }}
                            </div>
                        </div>

                        <!-- Action Button Row (Full-width touch target) -->
                        <div class="pt-2 border-top">
                            <a href="{{ route('processwithdraw', $withdrawal->id) }}" 
                                class="btn btn-sm btn-primary w-100 rounded-pill py-2 f-12 f-w-700 shadow-sm d-flex align-items-center justify-content-center gap-2"
                                title="Review Payout Destination & Details">
                                <i class="fa-solid fa-arrow-up-right-from-square f-11"></i>
                                <span>Review & Process Payout</span>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-4 text-muted">
                        <i class="fa-solid fa-inbox f-32 mb-2 d-block"></i>
                        <p class="mb-0 f-13">No withdrawal requests found.</p>
                    </div>
                @endforelse
                <div id="mobileNoResultsWithdrawal" class="text-center py-4 text-muted d-none">
                    <p class="mb-0 f-12">No withdrawals match your search or filter.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var currentWithdrawalFilter = 'all';

    function filterWithdrawals(status, btn) {
        currentWithdrawalFilter = status;
        var buttons = document.querySelectorAll('#withdrawalStatusFilter button');
        buttons.forEach(b => b.classList.remove('active'));
        btn.classList.add('active');

        // 1. Filter Desktop DataTables
        if ($.fn.DataTable && $.fn.DataTable.isDataTable('#ShipTable')) {
            var table = $('#ShipTable').DataTable();
            if (status === 'all') {
                table.column(5).search('').draw();
            } else {
                table.column(5).search(status).draw();
            }
        }

        // 2. Filter Mobile Cards
        applyMobileWithdrawalFilters();
    }

    function searchMobileWithdrawals(query) {
        applyMobileWithdrawalFilters();
    }

    function applyMobileWithdrawalFilters() {
        var query = (document.getElementById('mobileSearchWithdrawals')?.value || '').toLowerCase().trim();
        var cards = document.querySelectorAll('.mobile-withdrawal-card');
        var visibleCount = 0;

        cards.forEach(card => {
            var status = card.getAttribute('data-status');
            var searchData = card.getAttribute('data-search') || '';

            var statusMatch = (currentWithdrawalFilter === 'all') || (status === currentWithdrawalFilter);
            var searchMatch = !query || searchData.includes(query);

            if (statusMatch && searchMatch) {
                card.style.display = '';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });

        var noResults = document.getElementById('mobileNoResultsWithdrawal');
        if (noResults) {
            noResults.classList.toggle('d-none', visibleCount > 0);
        }
    }
</script>
@endsection
