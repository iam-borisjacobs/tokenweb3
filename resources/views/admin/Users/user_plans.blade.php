@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <x-danger-alert />
    <x-success-alert />

    <!-- Top Header -->
    <div class="row mb-4 align-items-center justify-content-between g-3">
        <div class="col-md-7">
            <div class="d-flex align-items-center gap-2 mb-1">
                <a href="{{ route('viewuser', $user->id) }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3 py-1 f-12">
                    <i class="fa-solid fa-arrow-left me-1"></i> Back to {{ $user->name }}
                </a>
            </div>
            <h3 class="f-w-800 text-dark mb-1">
                <i class="fa-solid fa-chart-pie text-primary me-2"></i> {{ $user->name }}'s Investment Plans
            </h3>
            <p class="text-muted mb-0 f-13">Audit, extend, activate, or terminate client investment packages.</p>
        </div>
        <div class="col-md-auto">
            <span class="badge bg-light-primary text-primary rounded-pill px-3 py-2 f-12 f-w-600">
                <i class="fa-solid fa-layer-group me-1"></i> {{ count($plans) }} Total Plan{{ count($plans) === 1 ? '' : 's' }}
            </span>
        </div>
    </div>

    <!-- Plans Table Card -->
    <div class="card p-4 shadow-sm border-0 rounded-3 mb-5">
        <div class="d-flex align-items-center justify-content-between pb-3 mb-3 border-bottom">
            <h5 class="f-w-700 text-dark mb-0">Subscribed Investment Packages</h5>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th class="f-12 f-w-700">Plan Name</th>
                        <th class="f-12 f-w-700">Invested Amount</th>
                        <th class="f-12 f-w-700">Duration</th>
                        <th class="f-12 f-w-700">Status</th>
                        <th class="f-12 f-w-700">Started On</th>
                        <th class="f-12 f-w-700">Maturity / Expiration</th>
                        <th class="f-12 f-w-700 text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($plans as $plan)
                        <tr>
                            <td>
                                <div class="f-w-700 text-dark f-14">
                                    <i class="fa-solid fa-gem text-primary me-1"></i> {{ $plan->dplan->name ?? 'Standard Plan' }}
                                </div>
                                <small class="text-muted f-11">ID: #PLN-{{ $plan->id }}</small>
                            </td>
                            <td>
                                <span class="f-w-800 text-primary f-14">
                                    {{ $settings->currency }}{{ number_format($plan->amount, 2) }}
                                </span>
                            </td>
                            <td class="f-13 text-muted">
                                <i class="fa-regular fa-clock me-1"></i> {{ $plan->inv_duration ?? 'N/A' }}
                            </td>
                            <td>
                                @if ($plan->active == 'yes')
                                    <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-1 f-11 f-w-600">
                                        <i class="fa-solid fa-circle-check me-1"></i> Active
                                    </span>
                                @else
                                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill px-3 py-1 f-11 f-w-600">
                                        <i class="fa-solid fa-circle-xmark me-1"></i> Expired / Inactive
                                    </span>
                                @endif
                            </td>
                            <td class="text-muted f-12 text-nowrap">
                                {{ $plan->created_at ? \Carbon\Carbon::parse($plan->created_at)->format('M d, Y • h:i A') : 'N/A' }}
                            </td>
                            <td class="text-muted f-12 text-nowrap">
                                {{ $plan->expire_date ? \Carbon\Carbon::parse($plan->expire_date)->format('M d, Y • h:i A') : 'N/A' }}
                            </td>
                            <td class="text-end">
                                <div class="d-flex align-items-center justify-content-end gap-1">
                                    @if ($plan->active == 'yes')
                                        <a href="{{ route('markas', ['id' => $plan->id, 'status' => 'expired']) }}" class="btn btn-outline-warning btn-sm rounded-pill px-2 py-1 f-11" title="Mark as expired">
                                            <i class="fa-solid fa-hourglass-end me-1"></i> Expire
                                        </a>
                                    @else
                                        <a href="{{ route('markas', ['id' => $plan->id, 'status' => 'yes']) }}" class="btn btn-outline-success btn-sm rounded-pill px-2 py-1 f-11" title="Mark as active">
                                            <i class="fa-solid fa-play me-1"></i> Activate
                                        </a>
                                    @endif

                                    <a href="{{ route('deleteplan', $plan->id) }}" class="btn btn-outline-danger btn-sm rounded-pill px-2 py-1 f-11" onclick="return confirm('Are you sure you want to delete this plan?');" title="Delete Plan">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="fa-solid fa-box-open f-32 mb-2 d-block text-muted opacity-50"></i>
                                This user does not have any active or past investment plans.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
