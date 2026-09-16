@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <div>
                <h3 class="f-w-700 mb-1">Active Investments</h3>
                <p class="text-muted mb-0 f-14">Monitor and manage all active client investment packages currently yielding returns.</p>
            </div>
            <div>
                <a href="{{ route('plans') }}" class="btn btn-outline-primary btn-sm rounded-pill px-3">
                    <i class="fa fa-layer-group me-1"></i> Investment Plans
                </a>
            </div>
        </div>
    </div>

    <x-danger-alert />
    <x-success-alert />

    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table id="ShipTable" class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Client Name</th>
                                    <th>Investment Plan</th>
                                    <th>Amount Invested</th>
                                    <th>Duration</th>
                                    <th>ROI Earned</th>
                                    <th>Start Date</th>
                                    <th>Expiration Date</th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($plans as $plan)
                                    <tr>
                                        <td>
                                            @if ($plan->duser)
                                                <div class="d-flex align-items-center gap-2">
                                                    <div class="rounded-circle bg-light-primary text-primary d-flex align-items-center justify-content-center f-w-700" style="width: 34px; height: 34px; font-size: 13px;">
                                                        {{ strtoupper(substr($plan->duser->name ?? 'U', 0, 1)) }}
                                                    </div>
                                                    <div>
                                                        <a href="{{ route('user.plans', $plan->duser->id) }}" class="f-w-600 text-decoration-none text-dark">
                                                            {{ $plan->duser->name }}
                                                        </a>
                                                        <small class="text-muted d-block f-11">{{ $plan->duser->email }}</small>
                                                    </div>
                                                </div>
                                            @else
                                                <span class="badge bg-light text-muted border">Deleted Client</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge bg-light-primary text-primary px-3 py-1 rounded-pill f-12 f-w-600">
                                                {{ $plan->dplan->name ?? 'Deleted Plan' }}
                                            </span>
                                        </td>
                                        <td class="f-w-700 text-dark">
                                            {{ $settings->currency }}{{ number_format($plan->amount) }}
                                        </td>
                                        <td>
                                            <span class="badge bg-light text-dark border">
                                                <i class="fa fa-clock text-muted me-1"></i> {{ $plan->inv_duration ?? 'N/A' }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="f-w-700 text-success">
                                                {{ $settings->currency }}{{ number_format($plan->profit_earned ?? 0, 2) }}
                                            </span>
                                        </td>
                                        <td class="text-muted f-12">
                                            {{ $plan->created_at ? $plan->created_at->toDayDateTimeString() : 'N/A' }}
                                        </td>
                                        <td class="text-muted f-12">
                                            {{ !empty($plan->expire_date) ? \Carbon\Carbon::parse($plan->expire_date)->toDayDateTimeString() : 'N/A' }}
                                        </td>
                                        <td class="text-end">
                                            <div class="dropdown">
                                                <button class="btn btn-outline-secondary btn-sm rounded-pill px-3 dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Action
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                                                    @if ($plan->duser)
                                                        <li>
                                                            <a class="dropdown-item f-13 py-2" href="{{ route('user.plans', $plan->duser->id) }}">
                                                                <i class="fa fa-eye text-primary me-2"></i> Client Plans
                                                            </a>
                                                        </li>
                                                    @endif
                                                    <li>
                                                        <a class="dropdown-item f-13 py-2 text-danger" href="{{ route('deleteplan', $plan->id) }}" onclick="return confirm('Are you sure you want to delete this active investment record?');">
                                                            <i class="fa fa-trash me-2"></i> Delete
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center py-5 text-muted">
                                            <i class="fa fa-chart-pie f-40 text-muted mb-2 d-block"></i>
                                            <p class="mb-0">No active client investments found.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
