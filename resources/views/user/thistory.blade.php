@extends('layouts.dash')
@section('title', $title ?? 'Performance History')

@section('content')
    <!-- Scoped Theme Tokens & Styling -->
    <style>
        .thistory-view .it-title {
            color: #0f172a !important;
            transition: color 0.2s ease;
        }
        body.dark-only .thistory-view .it-title {
            color: #ffffff !important;
        }

        .thistory-view .it-text {
            color: #334155 !important;
            transition: color 0.2s ease;
        }
        body.dark-only .thistory-view .it-text {
            color: #f1f5f9 !important;
        }

        .thistory-view .it-muted {
            color: #64748b !important;
            transition: color 0.2s ease;
        }
        body.dark-only .thistory-view .it-muted {
            color: #94a3b8 !important;
        }

        .thistory-view .terminal-card {
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            transition: all 0.25s ease;
        }
        body.dark-only .thistory-view .terminal-card {
            background-color: #1a2238;
            border-color: rgba(255, 255, 255, 0.08);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }

        .thistory-view .table-terminal thead th {
            background-color: #f8fafc;
            color: #475569;
            font-size: 11.5px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 1.5px solid #e2e8f0;
            padding: 14px 20px;
        }
        body.dark-only .thistory-view .table-terminal thead th {
            background-color: #151c30;
            color: #94a3b8;
            border-bottom-color: rgba(255, 255, 255, 0.08);
        }

        .thistory-view .table-terminal tbody td {
            padding: 16px 20px;
            vertical-align: middle;
            border-bottom: 1px solid #f1f5f9;
            font-size: 13px;
        }
        body.dark-only .thistory-view .table-terminal tbody td {
            border-bottom-color: rgba(255, 255, 255, 0.05);
        }

        .thistory-view .table-terminal tbody tr:hover td {
            background-color: rgba(99, 98, 231, 0.04);
        }
        body.dark-only .thistory-view .table-terminal tbody tr:hover td {
            background-color: rgba(99, 98, 231, 0.08);
        }
    </style>

    <div class="thistory-view">
        @php
            $totalRoi = \App\Models\Tp_Transaction::where('user', Auth::user()->id)->where('type', 'ROI')->sum('amount');
            $totalDrops = \App\Models\Tp_Transaction::where('user', Auth::user()->id)->where('type', 'ROI')->count();
        @endphp

        <!-- Page Header -->
        <div class="page-title mb-4">
            <div class="row align-items-center justify-content-between g-3">
                <div class="col-md-7">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-1 p-0 bg-transparent f-12">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="it-muted text-decoration-none">Dashboard</a></li>
                            <li class="breadcrumb-item it-muted">Portfolio & Investments</li>
                            <li class="breadcrumb-item active text-primary" aria-current="page">Performance History</li>
                        </ol>
                    </nav>
                    <h4 class="mb-1 it-title f-w-700">Trading & ROI Performance History</h4>
                    <p class="mb-0 it-muted f-13">Audit log of automated yield disbursements, trading returns, and package drop events.</p>
                </div>
                <div class="col-md-5">
                    <div class="d-flex align-items-center justify-content-md-end gap-2 flex-wrap">
                        <!-- Total Accrued ROI Chip -->
                        <div class="d-inline-flex align-items-center gap-2 px-3 py-2 rounded-3 terminal-card">
                            <div class="metric-icon-circle success" style="width: 30px; height: 30px; font-size: 13px;">
                                <i class="fa-solid fa-arrow-trend-up"></i>
                            </div>
                            <div class="text-start">
                                <span class="d-block it-muted f-10 text-uppercase f-w-600" style="letter-spacing: 0.5px;">Total Accrued ROI</span>
                                <span class="d-block text-success f-13 f-w-700">+{{ $settings->currency }}{{ number_format($totalRoi, 2) }}</span>
                            </div>
                        </div>
                        <!-- Drops Counter Chip -->
                        <div class="d-inline-flex align-items-center gap-2 px-3 py-2 rounded-3 terminal-card">
                            <div class="metric-icon-circle primary" style="width: 30px; height: 30px; font-size: 13px;">
                                <i class="fa-solid fa-bolt"></i>
                            </div>
                            <div class="text-start">
                                <span class="d-block it-muted f-10 text-uppercase f-w-600" style="letter-spacing: 0.5px;">Total Yield Drops</span>
                                <span class="d-block it-title f-13 f-w-700">{{ $totalDrops }} Events</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <x-danger-alert />
        <x-success-alert />

        <!-- Performance History Table Card -->
        <div class="terminal-card overflow-hidden mb-4">
            @if (count($t_history) > 0)
                <div class="table-responsive">
                    <table class="table table-terminal mb-0">
                        <thead>
                            <tr>
                                <th>Package / Plan</th>
                                <th>Yield Return</th>
                                <th>Transaction Type</th>
                                <th>Accrual Timestamp</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($t_history as $history)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="metric-icon-circle primary" style="width: 30px; height: 30px; font-size: 12px;">
                                                <i class="fa-solid fa-gem"></i>
                                            </div>
                                            <div>
                                                <span class="d-block it-title f-w-700">{{ $history->plan }}</span>
                                                <span class="it-muted f-11">Automated Contract Yield</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-1.5 f-13 f-w-700 d-inline-flex align-items-center gap-1">
                                            <i class="fa-solid fa-arrow-up f-10"></i>
                                            <span>+{{ $settings->currency }}{{ number_format($history->amount, 2, '.', ',') }}</span>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-2.5 py-1 f-11">
                                            {{ $history->type }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="it-text f-12 d-block">{{ \Carbon\Carbon::parse($history->created_at)->format('M d, Y') }}</span>
                                        <span class="it-muted f-11">{{ \Carbon\Carbon::parse($history->created_at)->format('h:i A') }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="p-3 border-top border-light-subtle d-flex justify-content-center">
                    {{ $t_history->links() }}
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-5 px-4">
                    <div class="metric-icon-circle neutral mx-auto mb-3" style="width: 64px; height: 64px; font-size: 26px;">
                        <i class="fa-solid fa-chart-pie it-muted"></i>
                    </div>
                    <h5 class="it-title f-w-700 mb-2">No ROI Accrual Events Recorded Yet</h5>
                    <p class="it-muted f-13 mb-4 mx-auto" style="max-width: 480px;">
                        When you activate an investment package and profits begin dropping according to your plan schedule, every payout will be recorded here in real-time.
                    </p>
                    <a href="{{ route('mplans') }}" class="btn btn-primary px-4 py-2 rounded-3 shadow-sm text-white" style="color: #ffffff !important;">
                        <i class="fa-solid fa-gem me-1 text-white"></i>Explore Investment Packages
                    </a>
                </div>
            @endif
        </div>

    </div>
@endsection
