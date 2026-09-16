@php
    $sub_link = 'https://trade.mql5.com/trade';
@endphp

@extends('layouts.dash')
@section('title', $title)

@section('content')
<div class="container-fluid mb-4">
    <!-- Header Row -->
    <div class="row align-items-center justify-content-between g-3 mb-4">
        <div class="col-sm-auto">
            <h3 class="f-w-800 text-dark mb-1" style="letter-spacing: -0.02em;">
                <i class="fa-solid fa-robot text-primary me-2"></i> Managed Trading Accounts
            </h3>
            <p class="text-muted mb-0 f-13">Automated copy trading and institutional portfolio management for your broker accounts.</p>
        </div>
        <div class="col-sm-auto d-flex align-items-center gap-2">
            <button type="button" class="btn btn-primary rounded-pill px-4 py-2 f-13 f-w-600 shadow-sm"
                data-bs-toggle="modal" data-bs-target="#submitmt4modal">
                <i class="fa-solid fa-plus me-1"></i> Connect Trading Account
            </button>
        </div>
    </div>

    <x-danger-alert />
    <x-success-alert />

    <!-- Hero Feature Card -->
    <div class="card p-4 shadow-sm border-0 mb-4" style="background: linear-gradient(135deg, rgba(99, 98, 231, 0.08) 0%, rgba(14, 165, 233, 0.08) 100%);">
        <div class="row align-items-center g-3">
            <div class="col-lg-8">
                <div class="d-flex align-items-center gap-3 mb-2">
                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center flex-shrink-0" style="width: 44px; height: 44px; font-size: 20px;">
                        <i class="fa-solid fa-chart-line"></i>
                    </div>
                    <div>
                        <h5 class="f-w-800 text-dark mb-0">{{ $settings->site_name }} Professional Account Manager</h5>
                        <small class="text-muted">Hands-free automated portfolio execution</small>
                    </div>
                </div>
                <p class="text-muted f-13 mb-0" style="max-width: 680px; line-height: 1.6;">
                    Don’t have time to trade or monitor technical chart setups? Our proprietary algorithmic and master trader management service executes high-probability positions on your connected MetaTrader account 24/5.
                </p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <button type="button" class="btn btn-primary rounded-pill px-4 py-2 f-13 f-w-600 shadow-sm"
                    data-bs-toggle="modal" data-bs-target="#submitmt4modal">
                    <i class="fa-solid fa-plug me-1"></i> Subscribe Account Now
                </button>
                <small class="text-muted d-block mt-2 f-11">Questions? Contact {{ $settings->contact_email }}</small>
            </div>
        </div>
    </div>

    <!-- Active Accounts Grid Section -->
    <div class="card p-4 shadow-sm border-0 mb-4">
        <div class="d-flex align-items-center justify-content-between mb-3 pb-2 border-bottom">
            <h5 class="f-w-700 text-dark mb-0">
                <i class="fa-solid fa-list-check text-primary me-2"></i> My Connected Accounts
            </h5>
            <span class="badge bg-light-primary text-primary px-3 py-2 rounded-pill f-12 f-w-600">
                {{ count($subscriptions) }} Account(s) Connected
            </span>
        </div>

        <div class="row g-3">
            @forelse ($subscriptions as $sub)
                <div class="col-md-6 col-xl-4">
                    <div class="card border rounded-3 p-3 h-100 shadow-none hover-shadow transition">
                        <div class="d-flex align-items-center justify-content-between mb-3 pb-2 border-bottom">
                            <div>
                                <h6 class="f-w-700 text-dark mb-0">ID: {{ $sub->mt4_id }}</h6>
                                <small class="text-muted f-11">{{ $sub->account_type }} Account</small>
                            </div>
                            @if ($sub->status == 'Active')
                                <span class="badge bg-light-success text-success px-2 py-1 rounded-pill f-11">
                                    <i class="fa-solid fa-circle-check me-1"></i> Active
                                </span>
                            @elseif ($sub->status == 'Expired')
                                <span class="badge bg-light-danger text-danger px-2 py-1 rounded-pill f-11">
                                    <i class="fa-solid fa-clock me-1"></i> Expired
                                </span>
                            @else
                                <span class="badge bg-light-warning text-warning px-2 py-1 rounded-pill f-11">
                                    <i class="fa-solid fa-spinner fa-spin me-1"></i> {{ $sub->status }}
                                </span>
                            @endif
                        </div>

                        <div class="d-flex flex-column gap-2 f-13 mb-3">
                            <div class="d-flex justify-content-between">
                                <span class="text-muted">Currency:</span>
                                <span class="f-w-600 text-dark">{{ $sub->currency }}</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="text-muted">Leverage:</span>
                                <span class="f-w-600 text-dark">{{ $sub->leverage }}</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="text-muted">Broker Server:</span>
                                <span class="f-w-600 text-dark">{{ $sub->server }}</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="text-muted">Billing Cycle:</span>
                                <span class="f-w-600 text-dark">{{ $sub->duration }}</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="text-muted">Expires:</span>
                                <span class="f-w-600 text-dark">
                                    @if (!empty($sub->end_date))
                                        {{ \Carbon\Carbon::parse($sub->end_date)->format('M d, Y') }}
                                    @else
                                        Pending Activation
                                    @endif
                                </span>
                            </div>
                        </div>

                        <div class="d-flex align-items-center justify-content-between pt-2 border-top mt-auto">
                            <button type="button" class="btn btn-outline-danger btn-sm rounded-pill px-3" onclick="cancelAccountPrompt()">
                                <i class="fa-solid fa-ban me-1"></i> Cancel
                            </button>
                            @php
                                $endAt = \Carbon\Carbon::parse($sub->end_date);
                                $remindAt = \Carbon\Carbon::parse($sub->reminded_at);
                            @endphp
                            @if (now()->isSameDay($remindAt) || $sub->status == 'Expired')
                                <a href="{{ route('renewsub', $sub->id) }}" class="btn btn-success btn-sm rounded-pill px-3">
                                    <i class="fa-solid fa-rotate me-1"></i> Renew
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="text-center py-5">
                        <div class="rounded-circle bg-light-primary text-primary d-inline-flex align-items-center justify-content-center mb-3" style="width: 56px; height: 56px; font-size: 24px;">
                            <i class="fa-solid fa-plug-circle-xmark"></i>
                        </div>
                        <h6 class="f-w-700 text-dark mb-1">No Active Trading Accounts</h6>
                        <p class="text-muted f-13 mx-auto mb-3" style="max-width: 420px;">
                            You haven't linked any MT4 or MT5 trading accounts yet. Connect your broker credentials above to begin automated management.
                        </p>
                        <button type="button" class="btn btn-primary rounded-pill px-4 py-2 f-13 f-w-600 shadow-sm"
                            data-bs-toggle="modal" data-bs-target="#submitmt4modal">
                            <i class="fa-solid fa-plus me-1"></i> Connect First Account
                        </button>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    <!-- WebTrader Embedded Terminal Card -->
    <div class="card p-4 shadow-sm border-0">
        <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-2 mb-3 pb-2 border-bottom">
            <div>
                <h5 class="f-w-700 text-dark mb-0">
                    <i class="fa-solid fa-display text-primary me-2"></i> Live WebTrader Terminal
                </h5>
                <small class="text-muted">Monitor live chart movements and active executions directly within your browser.</small>
            </div>
            <a href="{{ $sub_link }}" target="_blank" rel="noopener noreferrer" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
                <i class="fa-solid fa-up-right-from-square me-1"></i> Open in New Window
            </a>
        </div>

        <div class="rounded-3 overflow-hidden border" style="height: 650px; background: #1a1e2b;">
            <iframe src="{{ $sub_link }}" name="WebTrader" title="WebTrader Terminal" frameborder="0"
                style="display: block; border: none; height: 100%; width: 100%;"></iframe>
        </div>
    </div>
</div>

@include('user.modals')

<script>
    function cancelAccountPrompt() {
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                title: 'Cancel Managed Account?',
                text: 'To cancel automated management and disconnect your MT4/MT5 credentials, please contact support at {{ $settings->contact_email }} or submit a ticket from your dashboard.',
                icon: 'info',
                confirmButtonColor: '#6362e7',
                confirmButtonText: 'Got It'
            });
        } else {
            alert('To cancel your MT4 details, please send an email to {{ $settings->contact_email }}.');
        }
    }
</script>
@endsection
