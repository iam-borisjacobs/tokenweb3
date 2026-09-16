@extends('layouts.dash')
@section('title', $title)

@section('content')
<div class="container-fluid mb-4">
    <!-- Header Row -->
    <div class="row align-items-center justify-content-between g-3 mb-4">
        <div class="col-sm-auto">
            <h3 class="f-w-800 text-dark mb-1" style="letter-spacing: -0.02em;">
                <i class="fa-solid fa-satellite-dish text-primary me-2"></i> Trade Signal Subscriptions
            </h3>
            <p class="text-muted mb-0 f-13">Receive institutional trading setups, entry prices, stop losses, and take profits directly on Telegram.</p>
        </div>
        <div class="col-sm-auto">
            @if (!$subscription)
                <button type="button" class="btn btn-primary rounded-pill px-4 py-2 f-13 f-w-600 shadow-sm"
                    data-bs-toggle="modal" data-bs-target="#subscribeSignalModal">
                    <i class="fa-solid fa-bell me-1"></i> Subscribe to Signals
                </button>
            @endif
        </div>
    </div>

    <x-danger-alert />
    <x-success-alert />

    <div class="row justify-content-center">
        <div class="col-lg-8">
            @if (!$subscription)
                <div class="card p-5 shadow-sm border-0 text-center">
                    <div class="rounded-circle bg-light-primary text-primary d-inline-flex align-items-center justify-content-center mb-3" style="width: 64px; height: 64px; font-size: 28px;">
                        <i class="fa-solid fa-tower-broadcast"></i>
                    </div>
                    <h5 class="f-w-800 text-dark mb-2">No Active Signal Subscription</h5>
                    <p class="text-muted f-13 mx-auto mb-4" style="max-width: 480px; line-height: 1.6;">
                        You currently do not have access to our VIP signal channel. Subscribe today to receive high-win-rate Forex, Crypto, and Commodity trade alerts straight to your devices.
                    </p>
                    <div>
                        <button type="button" class="btn btn-primary rounded-pill px-4 py-2 f-13 f-w-600 shadow-sm"
                            data-bs-toggle="modal" data-bs-target="#subscribeSignalModal">
                            <i class="fa-solid fa-cart-shopping me-1"></i> Choose Subscription Plan
                        </button>
                    </div>
                </div>
            @else
                <div class="card p-4 shadow-sm border-0">
                    <div class="d-flex align-items-center justify-content-between mb-3 pb-2 border-bottom">
                        <div class="d-flex align-items-center gap-3">
                            <div class="rounded-circle bg-light-success text-success d-flex align-items-center justify-content-center" style="width: 44px; height: 44px; font-size: 20px;">
                                <i class="fa-solid fa-circle-check"></i>
                            </div>
                            <div>
                                <h5 class="f-w-800 text-dark mb-0">{{ $subscription->subscription }} Signal Package</h5>
                                <small class="text-muted">Subscription Active & Verified</small>
                            </div>
                        </div>
                        <span class="badge bg-light-success text-success px-3 py-2 rounded-pill f-12 f-w-600">
                            Active
                        </span>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-sm-6">
                            <div class="p-3 bg-light rounded-3">
                                <small class="text-muted d-block mb-1 f-12">Amount Paid</small>
                                <h4 class="f-w-800 text-dark mb-0">{{ $settings->currency }}{{ number_format($subscription->amount_paid, 2) }}</h4>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="p-3 bg-light rounded-3">
                                <small class="text-muted d-block mb-1 f-12">Expires On</small>
                                <h5 class="f-w-700 text-dark mb-0">{{ \Carbon\Carbon::parse($subscription->expired_at)->format('M d, Y - h:i A') }}</h5>
                                <small class="text-danger f-11">
                                    {{ \Carbon\Carbon::parse($subscription->expired_at)->diffForHumans() }}
                                </small>
                            </div>
                        </div>
                    </div>

                    @if (now()->greaterThanOrEqualTo(\Carbon\Carbon::parse($subscription->reminded_at)) || now()->greaterThanOrEqualTo(\Carbon\Carbon::parse($subscription->expired_at)))
                        <div class="p-3 bg-light-warning rounded-3 d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-3">
                            <div>
                                <div class="f-w-700 text-dark mb-0">Subscription Renewal Due</div>
                                <small class="text-muted">Your signal access is expiring soon. Renew now to avoid missing daily alerts.</small>
                            </div>
                            <button type="button" class="btn btn-warning rounded-pill px-4 py-2 f-13 f-w-600 text-dark shadow-sm"
                                data-bs-toggle="modal" data-bs-target="#renewSignalModal">
                                <i class="fa-solid fa-rotate me-1"></i> Renew Access
                            </button>
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Subscribe Modal -->
<div class="modal fade" id="subscribeSignalModal" tabindex="-1" aria-labelledby="subscribeSignalModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header">
                <h5 class="modal-title f-w-700" id="subscribeSignalModalLabel">
                    <i class="fa-solid fa-satellite-dish text-primary me-2"></i> Subscribe to Trade Signals
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <livewire:user.subscribe-to-signal />
            </div>
        </div>
    </div>
</div>

<!-- Renew Signal Modal -->
@if ($subscription)
    <div class="modal fade" id="renewSignalModal" tabindex="-1" aria-labelledby="renewSignalModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header">
                    <h5 class="modal-title f-w-700" id="renewSignalModalLabel">
                        <i class="fa-solid fa-rotate text-primary me-2"></i> Renew Signal Subscription
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center p-4">
                    <div class="rounded-circle bg-light-primary text-primary d-inline-flex align-items-center justify-content-center mb-3" style="width: 54px; height: 54px; font-size: 22px;">
                        <i class="fa-solid fa-receipt"></i>
                    </div>
                    @php
                        $fee = ($subscription->subscription == 'Monthly') 
                            ? $set->signal_monthly_fee 
                            : (($subscription->subscription == 'Quarterly') ? $set->signal_monthly_fee : $set->signal_yearly_fee);
                    @endphp
                    <h5 class="f-w-800 text-dark mb-1">{{ $settings->currency }}{{ number_format($fee, 2) }}</h5>
                    <p class="text-muted f-13 mb-0">
                        This renewal amount will be deducted directly from your account balance. Would you like to proceed?
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                    <a href="{{ route('renewsignals') }}" class="btn btn-primary rounded-pill px-4 shadow-sm">
                        <i class="fa-solid fa-check me-1"></i> Confirm & Renew
                    </a>
                </div>
            </div>
        </div>
    </div>
@endif
@endsection
