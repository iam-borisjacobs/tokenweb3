@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Breadcrumb / Welcome Banner -->
    <div class="row mb-3 mb-md-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm p-3 p-sm-4" style="background: linear-gradient(135deg, rgba(99, 98, 231, 0.08) 0%, rgba(255, 159, 67, 0.05) 100%);">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
                    <div>
                        <h3 class="f-w-800 text-dark mb-1 f-20 f-md-24">Welcome back, {{ Auth('admin')->User()->firstName }} {{ Auth('admin')->User()->lastName }}! 👋</h3>
                        <p class="text-muted mb-0 f-13 f-md-14">Here is a comprehensive overview of {{ $settings->site_name }} performance and pending tasks today.</p>
                    </div>
                    @if (Auth('admin')->User()->type == 'Super Admin' || Auth('admin')->User()->type == 'Admin')
                        <div class="d-flex flex-wrap align-items-center gap-2 w-100 w-md-auto">
                            <a href="{{ route('mdeposits') }}" class="btn btn-outline-success btn-sm rounded-pill px-3 py-2 d-inline-flex align-items-center justify-content-center flex-fill flex-sm-grow-0" style="font-weight: 600; font-size: 13px; text-decoration: none;">
                                <i class="fa fa-arrow-down me-1.5 f-12"></i> Deposits
                            </a>
                            <a href="{{ route('mwithdrawals') }}" class="btn btn-outline-danger btn-sm rounded-pill px-3 py-2 d-inline-flex align-items-center justify-content-center flex-fill flex-sm-grow-0" style="font-weight: 600; font-size: 13px; text-decoration: none;">
                                <i class="fa fa-arrow-up me-1.5 f-12"></i> Withdrawals
                            </a>
                            <a href="{{ route('newplan') }}" class="btn btn-primary btn-sm rounded-pill px-3 py-2 d-inline-flex align-items-center justify-content-center shadow-sm flex-fill flex-sm-grow-0" style="font-weight: 600; font-size: 13px; text-decoration: none;">
                                <i class="fa fa-plus me-1.5 f-12"></i> New Plan
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <x-danger-alert />
    <x-success-alert />

    <!-- Financial Key Metrics (Row 1) -->
    <div class="row g-3 mb-4">
        <!-- Total Deposited -->
        <div class="col-sm-6 col-xl-3">
            <div class="card h-100 p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted f-12 f-w-600 text-uppercase">Total Deposited</span>
                        <h4 class="f-w-700 mt-1 mb-0 text-success">
                            @php
                                $total_dep_val = 0;
                                foreach ($total_deposited as $dep) {
                                    if (!empty($dep->count)) $total_dep_val += $dep->count;
                                }
                            @endphp
                            {{ $settings->currency }}{{ number_format($total_dep_val, 2) }}
                        </h4>
                    </div>
                    <div class="rounded-circle p-3 d-flex align-items-center justify-content-center bg-light-success text-success" style="width: 48px; height: 48px;">
                        <i class="fa fa-wallet f-18"></i>
                    </div>
                </div>
                <div class="mt-3 pt-2 border-top d-flex justify-content-between align-items-center">
                    <small class="text-muted">Processed deposits</small>
                    <a href="{{ route('mdeposits') }}" class="f-12 f-w-600 text-primary text-decoration-none">View all <i class="fa fa-angle-right ms-1"></i></a>
                </div>
            </div>
        </div>

        <!-- Pending Deposits -->
        <div class="col-sm-6 col-xl-3">
            <div class="card h-100 p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted f-12 f-w-600 text-uppercase">Pending Deposits</span>
                        <h4 class="f-w-700 mt-1 mb-0 text-warning">
                            @php
                                $pending_dep_val = 0;
                                foreach ($pending_deposited as $dep) {
                                    if (!empty($dep->count)) $pending_dep_val += $dep->count;
                                }
                            @endphp
                            {{ $settings->currency }}{{ number_format($pending_dep_val, 2) }}
                        </h4>
                    </div>
                    <div class="rounded-circle p-3 d-flex align-items-center justify-content-center bg-light-warning text-warning" style="width: 48px; height: 48px;">
                        <i class="fa fa-clock f-18"></i>
                    </div>
                </div>
                <div class="mt-3 pt-2 border-top d-flex justify-content-between align-items-center">
                    <small class="text-muted">Awaiting confirmation</small>
                    <a href="{{ route('mdeposits') }}" class="f-12 f-w-600 text-warning text-decoration-none">Review <i class="fa fa-angle-right ms-1"></i></a>
                </div>
            </div>
        </div>

        <!-- Total Withdrawn -->
        <div class="col-sm-6 col-xl-3">
            <div class="card h-100 p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted f-12 f-w-600 text-uppercase">Total Withdrawn</span>
                        <h4 class="f-w-700 mt-1 mb-0 text-danger">
                            @php
                                $total_with_val = 0;
                                foreach ($total_withdrawn as $wth) {
                                    if (!empty($wth->count)) $total_with_val += $wth->count;
                                }
                            @endphp
                            {{ $settings->currency }}{{ number_format($total_with_val, 2) }}
                        </h4>
                    </div>
                    <div class="rounded-circle p-3 d-flex align-items-center justify-content-center bg-light-danger text-danger" style="width: 48px; height: 48px;">
                        <i class="fa fa-arrow-alt-circle-up f-18"></i>
                    </div>
                </div>
                <div class="mt-3 pt-2 border-top d-flex justify-content-between align-items-center">
                    <small class="text-muted">Processed payouts</small>
                    <a href="{{ route('mwithdrawals') }}" class="f-12 f-w-600 text-primary text-decoration-none">View all <i class="fa fa-angle-right ms-1"></i></a>
                </div>
            </div>
        </div>

        <!-- Pending Withdrawals -->
        <div class="col-sm-6 col-xl-3">
            <div class="card h-100 p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted f-12 f-w-600 text-uppercase">Pending Withdrawals</span>
                        <h4 class="f-w-700 mt-1 mb-0 text-info">
                            @php
                                $pending_with_val = 0;
                                foreach ($pending_withdrawn as $wth) {
                                    if (!empty($wth->count)) $pending_with_val += $wth->count;
                                }
                            @endphp
                            {{ $settings->currency }}{{ number_format($pending_with_val, 2) }}
                        </h4>
                    </div>
                    <div class="rounded-circle p-3 d-flex align-items-center justify-content-center bg-light-info text-info" style="width: 48px; height: 48px;">
                        <i class="fa fa-hand-holding-usd f-18"></i>
                    </div>
                </div>
                <div class="mt-3 pt-2 border-top d-flex justify-content-between align-items-center">
                    <small class="text-muted">Requests in queue</small>
                    <a href="{{ route('mwithdrawals') }}" class="f-12 f-w-600 text-info text-decoration-none">Manage <i class="fa fa-angle-right ms-1"></i></a>
                </div>
            </div>
        </div>
    </div>

    <!-- Platform Operational Metrics (Row 2) -->
    <div class="row g-3 mb-4">
        <!-- Total Users -->
        <div class="col-6 col-md-3">
            <div class="card p-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-3 p-3 bg-light-primary text-primary">
                        <i class="fa fa-users f-20"></i>
                    </div>
                    <div>
                        <h3 class="f-w-700 mb-0">{{ number_format($userlist) }}</h3>
                        <p class="text-muted f-12 mb-0">Total Clients</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Active Users -->
        <div class="col-6 col-md-3">
            <div class="card p-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-3 p-3 bg-light-success text-success">
                        <i class="fa fa-user-check f-20"></i>
                    </div>
                    <div>
                        <h3 class="f-w-700 mb-0">{{ number_format($activeusers) }}</h3>
                        <p class="text-muted f-12 mb-0">Active Clients</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Blocked Users -->
        <div class="col-6 col-md-3">
            <div class="card p-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-3 p-3 bg-light-danger text-danger">
                        <i class="fa fa-user-slash f-20"></i>
                    </div>
                    <div>
                        <h3 class="f-w-700 mb-0">{{ number_format($blockeusers) }}</h3>
                        <p class="text-muted f-12 mb-0">Blocked Clients</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Investment Plans -->
        <div class="col-6 col-md-3">
            <div class="card p-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-3 p-3 bg-light-warning text-warning">
                        <i class="fa fa-cubes f-20"></i>
                    </div>
                    <div>
                        <h3 class="f-w-700 mb-0">{{ number_format($plans) }}</h3>
                        <p class="text-muted f-12 mb-0">Investment Plans</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart Analytics Section -->
    <div class="row g-3 mb-4">
        <div class="col-lg-8">
            <div class="card p-4 h-100">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h5 class="f-w-700 mb-0">Financial Analytics Overview</h5>
                        <small class="text-muted">Transaction comparison across all key platform metrics (in {{ $settings->currency }})</small>
                    </div>
                    <span class="badge bg-light-primary text-primary px-3 py-2 rounded-pill">Platform Flow</span>
                </div>
                <div style="position: relative; height: 320px;">
                    <canvas id="admiroChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card p-4 h-100 border-0 shadow-sm">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="f-w-700 mb-0 text-dark">Quick Actions</h5>
                    <span class="badge bg-light text-muted border px-2 py-1 f-11">Shortcuts</span>
                </div>
                <div class="d-flex flex-column gap-2">
                    <!-- Manage Users -->
                    <a href="{{ route('manageusers') }}" class="d-flex align-items-center justify-content-between p-3 rounded-3 border text-decoration-none bg-white hover-card-tile transition-all" style="transition: all 0.25s ease;">
                        <div class="d-flex align-items-center gap-3">
                            <div class="rounded-circle d-flex align-items-center justify-content-center bg-light-primary text-primary" style="width: 40px; height: 40px; flex-shrink: 0;">
                                <i class="fa fa-users f-15"></i>
                            </div>
                            <div>
                                <h6 class="mb-0 f-13 f-w-700 text-dark">Manage All Users</h6>
                                <span class="text-muted f-11">Accounts, balances & credentials</span>
                            </div>
                        </div>
                        <i class="fa fa-chevron-right f-12 text-muted"></i>
                    </a>

                    <!-- Investment Plans -->
                    <a href="{{ route('plans') }}" class="d-flex align-items-center justify-content-between p-3 rounded-3 border text-decoration-none bg-white hover-card-tile transition-all" style="transition: all 0.25s ease;">
                        <div class="d-flex align-items-center gap-3">
                            <div class="rounded-circle d-flex align-items-center justify-content-center bg-light-info text-info" style="width: 40px; height: 40px; flex-shrink: 0;">
                                <i class="fa fa-layer-group f-15"></i>
                            </div>
                            <div>
                                <h6 class="mb-0 f-13 f-w-700 text-dark">Investment Plans</h6>
                                <span class="text-muted f-11">Packages, durations & returns</span>
                            </div>
                        </div>
                        <i class="fa fa-chevron-right f-12 text-muted"></i>
                    </a>

                    <!-- KYC Verifications -->
                    <a href="{{ route('kyc') }}" class="d-flex align-items-center justify-content-between p-3 rounded-3 border text-decoration-none bg-white hover-card-tile transition-all" style="transition: all 0.25s ease;">
                        <div class="d-flex align-items-center gap-3">
                            <div class="rounded-circle d-flex align-items-center justify-content-center bg-light-success text-success" style="width: 40px; height: 40px; flex-shrink: 0;">
                                <i class="fa fa-id-card f-15"></i>
                            </div>
                            <div>
                                <h6 class="mb-0 f-13 f-w-700 text-dark">KYC Verifications</h6>
                                <span class="text-muted f-11">Document review & compliance</span>
                            </div>
                        </div>
                        <i class="fa fa-chevron-right f-12 text-muted"></i>
                    </a>

                    <!-- Platform Settings -->
                    <a href="{{ route('appsettingshow') }}" class="d-flex align-items-center justify-content-between p-3 rounded-3 border text-decoration-none bg-white hover-card-tile transition-all" style="transition: all 0.25s ease;">
                        <div class="d-flex align-items-center gap-3">
                            <div class="rounded-circle d-flex align-items-center justify-content-center bg-light-warning text-warning" style="width: 40px; height: 40px; flex-shrink: 0;">
                                <i class="fa fa-cog f-15"></i>
                            </div>
                            <div>
                                <h6 class="mb-0 f-13 f-w-700 text-dark">Platform Settings</h6>
                                <span class="text-muted f-11">App info, payment & email setup</span>
                            </div>
                        </div>
                        <i class="fa fa-chevron-right f-12 text-muted"></i>
                    </a>

                    <!-- Crypto Assets -->
                    <a href="{{ route('managecryptoasset') }}" class="d-flex align-items-center justify-content-between p-3 rounded-3 border text-decoration-none bg-white hover-card-tile transition-all" style="transition: all 0.25s ease;">
                        <div class="d-flex align-items-center gap-3">
                            <div class="rounded-circle d-flex align-items-center justify-content-center bg-light-danger text-danger" style="width: 40px; height: 40px; flex-shrink: 0;">
                                <i class="fa fa-coins f-15"></i>
                            </div>
                            <div>
                                <h6 class="mb-0 f-13 f-w-700 text-dark">Crypto Asset Wallets</h6>
                                <span class="text-muted f-11">Wallet addresses & swap rates</span>
                            </div>
                        </div>
                        <i class="fa fa-chevron-right f-12 text-muted"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var canvas = document.getElementById('admiroChart');
        if (!canvas) return;
        var ctx = canvas.getContext('2d');
        
        var defaultAccent = getComputedStyle(document.documentElement).getPropertyValue('--theme-default').trim() || '#6362e7';

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Deposited', 'Pending Dep', 'Withdrawn', 'Pending With', 'Total Vol'],
                datasets: [{
                    label: 'Amount ({{ $settings->currency }})',
                    data: [
                        {{ (float)($chart_pdepsoit ?? 0) }},
                        {{ (float)($chart_pendepsoit ?? 0) }},
                        {{ (float)($chart_pwithdraw ?? 0) }},
                        {{ (float)($chart_pendwithdraw ?? 0) }},
                        {{ (float)($chart_trans ?? 0) }}
                    ],
                    backgroundColor: [
                        'rgba(46, 125, 50, 0.75)',   // Processed deposit green
                        'rgba(237, 108, 2, 0.75)',  // Pending deposit amber
                        'rgba(211, 47, 47, 0.75)',   // Withdrawn red
                        'rgba(2, 136, 209, 0.75)',   // Pending withdraw blue
                        'rgba(99, 98, 231, 0.75)'    // Total indigo
                    ],
                    borderRadius: 8,
                    borderSkipped: false,
                    maxBarThickness: 45
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: '#1c2333',
                        titleFont: { size: 13 },
                        bodyFont: { size: 12 },
                        padding: 12,
                        cornerRadius: 8
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)'
                        }
                    }
                }
            }
        });
    });
</script>
@endsection
