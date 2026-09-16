@extends('layouts.dash')
@section('title', $title)

@section('content')
<div class="container-fluid mb-4">
    <!-- Header Row -->
    <div class="row align-items-center justify-content-between g-3 mb-4">
        <div class="col-sm-auto d-flex align-items-center gap-3">
            <a href="{{ route('myplans', 'All') }}" class="btn btn-outline-primary btn-sm rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;" title="Back to My Plans">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <div>
                <h3 class="f-w-800 text-dark mb-1" style="letter-spacing: -0.02em;">
                    {{ $plan->dplan->name }} Plan Details
                </h3>
                <div class="d-flex align-items-center gap-2">
                    <span class="text-muted f-13">Package Reference #INV-{{ $plan->id }}</span>
                    <span class="text-muted f-12">&bull;</span>
                    @if ($plan->active == 'yes')
                        <span class="badge bg-light-success text-success px-2 py-1 rounded-pill f-11">
                            <i class="fa-solid fa-circle-check me-1"></i> Active
                        </span>
                    @elseif($plan->active == 'expired')
                        <span class="badge bg-light-danger text-danger px-2 py-1 rounded-pill f-11">
                            <i class="fa-solid fa-clock me-1"></i> Expired
                        </span>
                    @else
                        <span class="badge bg-light-warning text-warning px-2 py-1 rounded-pill f-11">
                            <i class="fa-solid fa-pause me-1"></i> Inactive
                        </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-sm-auto">
            @if ($settings->should_cancel_plan && $plan->active == 'yes')
                <button type="button" class="btn btn-outline-danger rounded-pill px-4 py-2 f-13 f-w-600 shadow-sm"
                    data-bs-toggle="modal" data-bs-target="#cancelPlanModal">
                    <i class="fa-solid fa-ban me-1"></i> Cancel this Plan
                </button>
            @endif
        </div>
    </div>

    <x-danger-alert />
    <x-success-alert />

    <!-- Plan Performance Overview Cards -->
    <div class="row g-3 mb-4">
        <!-- Invested Amount -->
        <div class="col-sm-6 col-xl-3">
            <div class="card p-3 shadow-sm border-0 h-100">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted f-12 f-w-600 text-uppercase">Invested Capital</span>
                    <div class="rounded-circle bg-light-primary text-primary d-flex align-items-center justify-content-center" style="width: 38px; height: 38px; font-size: 16px;">
                        <i class="fa-solid fa-sack-dollar"></i>
                    </div>
                </div>
                <h4 class="f-w-800 text-dark mb-0">{{ $settings->currency }}{{ number_format($plan->amount, 2) }}</h4>
                <small class="text-muted f-11 mt-1 d-block">Initial deposit commitment</small>
            </div>
        </div>

        <!-- Profit Earned -->
        <div class="col-sm-6 col-xl-3">
            <div class="card p-3 shadow-sm border-0 h-100">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted f-12 f-w-600 text-uppercase">Yield Earned</span>
                    <div class="rounded-circle bg-light-success text-success d-flex align-items-center justify-content-center" style="width: 38px; height: 38px; font-size: 16px;">
                        <i class="fa-solid fa-chart-line"></i>
                    </div>
                </div>
                <h4 class="f-w-800 text-success mb-0">+{{ $settings->currency }}{{ number_format($plan->profit_earned, 2) }}</h4>
                <small class="text-muted f-11 mt-1 d-block">Accumulated ROI credits</small>
            </div>
        </div>

        <!-- Total Return -->
        <div class="col-sm-6 col-xl-3">
            <div class="card p-3 shadow-sm border-0 h-100">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted f-12 f-w-600 text-uppercase">Expected Total</span>
                    <div class="rounded-circle bg-light-info text-info d-flex align-items-center justify-content-center" style="width: 38px; height: 38px; font-size: 16px;">
                        <i class="fa-solid fa-calculator"></i>
                    </div>
                </div>
                <h4 class="f-w-800 text-dark mb-0">
                    @if ($settings->return_capital)
                        {{ $settings->currency }}{{ number_format($plan->amount + $plan->profit_earned, 2) }}
                    @else
                        {{ $settings->currency }}{{ number_format($plan->profit_earned, 2) }}
                    @endif
                </h4>
                <small class="text-muted f-11 mt-1 d-block">{{ $settings->return_capital ? 'Principal + Profit' : 'Profit only' }}</small>
            </div>
        </div>

        <!-- Duration & Interval -->
        <div class="col-sm-6 col-xl-3">
            <div class="card p-3 shadow-sm border-0 h-100">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted f-12 f-w-600 text-uppercase">Yield Interval</span>
                    <div class="rounded-circle bg-light-warning text-warning d-flex align-items-center justify-content-center" style="width: 38px; height: 38px; font-size: 16px;">
                        <i class="fa-solid fa-hourglass-half"></i>
                    </div>
                </div>
                <h4 class="f-w-800 text-dark mb-0">{{ $plan->dplan->increment_interval }}</h4>
                <small class="text-muted f-11 mt-1 d-block">Duration: {{ $plan->dplan->expiration }}</small>
            </div>
        </div>
    </div>

    <!-- Plan Parameters & Timeline Grid -->
    <div class="card p-4 shadow-sm border-0 mb-4">
        <h5 class="f-w-700 text-dark mb-3 pb-2 border-bottom">
            <i class="fa-solid fa-circle-info text-primary me-2"></i> Investment Contract Details
        </h5>
        <div class="row g-3">
            <div class="col-sm-6 col-lg-3">
                <div class="p-3 bg-light rounded-3">
                    <small class="text-muted d-block mb-1 f-12">Return Rate</small>
                    <span class="f-w-700 text-dark f-14">
                        {{ $plan->dplan->increment_type == 'Fixed' ? $settings->currency : '' }}{{ $plan->dplan->increment_amount }}{{ $plan->dplan->increment_type == 'Percentage' ? '%' : '' }}
                    </span>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="p-3 bg-light rounded-3">
                    <small class="text-muted d-block mb-1 f-12">Yield Range</small>
                    <span class="f-w-700 text-dark f-14">
                        {{ $plan->dplan->minr }}% - {{ $plan->dplan->maxr }}%
                    </span>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="p-3 bg-light rounded-3">
                    <small class="text-muted d-block mb-1 f-12">Contract Start Date</small>
                    <span class="f-w-700 text-dark f-14">
                        {{ $plan->created_at->toDayDateTimeString() }}
                    </span>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="p-3 bg-light rounded-3">
                    <small class="text-muted d-block mb-1 f-12">Maturity / Expiration</small>
                    <span class="f-w-700 text-dark f-14">
                        {{ \Carbon\Carbon::parse($plan->expire_date)->toDayDateTimeString() }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Transactions / Profit Yield History -->
    <div class="card p-4 shadow-sm border-0">
        <div class="d-flex align-items-center justify-content-between mb-3 pb-2 border-bottom">
            <h5 class="f-w-700 text-dark mb-0">
                <i class="fa-solid fa-clock-rotate-left text-primary me-2"></i> Profit Payout History
            </h5>
            <span class="text-muted f-12">Total {{ $transactions->total() }} recorded payout(s)</span>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="f-12 f-w-700">Type</th>
                        <th class="f-12 f-w-700">Timestamp</th>
                        <th class="f-12 f-w-700 text-end">Yield Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transactions as $history)
                        <tr>
                            <td>
                                <span class="badge bg-light-success text-success px-2 py-1 rounded-pill f-11">
                                    <i class="fa-solid fa-arrow-down me-1"></i> Profit Credit
                                </span>
                            </td>
                            <td class="f-13 text-muted">
                                {{ $history->created_at->toDayDateTimeString() }}
                            </td>
                            <td class="text-end f-w-700 text-success f-14">
                                +{{ $settings->currency }}{{ number_format($history->amount, 2) }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center py-5 text-muted">
                                <i class="fa-solid fa-receipt f-32 mb-2 d-block opacity-50"></i>
                                No profit distributions recorded for this plan yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($transactions->hasPages())
            <div class="mt-4 d-flex justify-content-center">
                {{ $transactions->links() }}
            </div>
        @endif
    </div>
</div>

<!-- Cancel Plan Confirmation Modal -->
@if ($settings->should_cancel_plan && $plan->active == 'yes')
    <div class="modal fade" id="cancelPlanModal" tabindex="-1" aria-labelledby="cancelPlanModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header">
                    <h5 class="modal-title f-w-700 text-danger" id="cancelPlanModalLabel">
                        <i class="fa-solid fa-triangle-exclamation me-2"></i> Confirm Plan Cancellation
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center p-4">
                    <div class="rounded-circle bg-light-danger text-danger d-inline-flex align-items-center justify-content-center mb-3" style="width: 54px; height: 54px; font-size: 22px;">
                        <i class="fa-solid fa-ban"></i>
                    </div>
                    <h6 class="f-w-700 text-dark mb-2">Cancel {{ $plan->dplan->name }} Plan?</h6>
                    <p class="text-muted f-13 mb-0">
                        Are you sure you want to terminate this active investment contract? Ongoing yield generation will stop immediately according to platform cancellation terms.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">Keep Plan Active</button>
                    <a href="{{ route('cancelplan', $plan->id) }}" class="btn btn-danger rounded-pill px-4 shadow-sm">
                        <i class="fa-solid fa-check me-1"></i> Yes, Cancel Plan
                    </a>
                </div>
            </div>
        </div>
    </div>
@endif
@endsection
