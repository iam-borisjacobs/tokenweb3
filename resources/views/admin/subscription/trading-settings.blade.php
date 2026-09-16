@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <x-danger-alert />
    <x-success-alert />

    <!-- Top Header -->
    <div class="row mb-4 align-items-center justify-content-between g-3">
        <div class="col-md-7">
            <h3 class="f-w-800 text-dark mb-1">
                <i class="fa-solid fa-tower-broadcast text-primary me-2"></i> Master Trading Accounts
            </h3>
            <p class="text-muted mb-0 f-13">Configure copytrade strategy providers and manage master account deployment.</p>
        </div>
        <div class="col-md-auto d-flex align-items-center gap-2">
            <button type="button" class="btn btn-primary rounded-pill px-4 py-2 f-13 f-w-700 shadow-sm" data-bs-toggle="modal" data-bs-target="#masterModal">
                <i class="fa-solid fa-plus me-1"></i> Add Master Account
            </button>
        </div>
    </div>

    <!-- Master Statistics Row -->
    @include('admin.subscription.master.statistics')

    <!-- Guidelines Alert -->
    <div class="alert alert-light border border-info-subtle shadow-sm rounded-3 p-3 mb-4 d-flex align-items-center gap-3">
        <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 40px; height: 40px; background: rgba(14, 165, 233, 0.12); color: #0284c7; font-size: 18px;">
            <i class="fa-solid fa-circle-info"></i>
        </div>
        <div class="f-13 text-muted">
            <strong class="text-dark">Expiration Notice:</strong>
            Master accounts are permanently decommissioned after 10 days of expiration if not renewed in time.
        </div>
    </div>

    <!-- Master Accounts Table Card -->
    <div class="card p-4 shadow-sm border-0 rounded-3 mb-5">
        <div class="d-flex align-items-center justify-content-between pb-3 mb-3 border-bottom">
            <h5 class="f-w-700 text-dark mb-0">Registered Master Providers</h5>
            <span class="badge bg-light-primary text-primary rounded-pill px-3 py-1 f-12 f-w-600">
                {{ count($accounts) }} Total Account{{ count($accounts) === 1 ? '' : 's' }}
            </span>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th class="f-12 f-w-700">Account ID</th>
                        <th class="f-12 f-w-700">Account Name</th>
                        <th class="f-12 f-w-700">Type / Server</th>
                        <th class="f-12 f-w-700">Credentials</th>
                        <th class="f-12 f-w-700">Deployment</th>
                        <th class="f-12 f-w-700">Active Period</th>
                        <th class="f-12 f-w-700 text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($accounts as $item)
                        <tr>
                            <td>
                                <span class="badge bg-light text-dark border font-monospace px-2 py-1 rounded-pill f-12">
                                    #{{ $item['login'] }}
                                </span>
                            </td>
                            <td>
                                <div class="f-w-700 text-dark f-14">{{ $item['account_name'] }}</div>
                            </td>
                            <td>
                                <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle rounded-pill px-2 py-1 f-11">
                                    {{ $item['account_type'] }}
                                </span>
                                <small class="text-muted d-block f-11 mt-1">{{ $item['server'] }}</small>
                            </td>
                            <td>
                                <div class="font-monospace f-12 text-muted">
                                    Pass: <span class="text-dark f-w-600">{{ $item['password'] }}</span>
                                </div>
                            </td>
                            <td>
                                @if ($item['deployment_status'] == 'Deployed')
                                    <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2 py-1 f-11 f-w-600">
                                        <i class="fa-solid fa-circle-check me-1"></i> Deployed
                                    </span>
                                @else
                                    <span class="badge bg-warning-subtle text-warning border border-warning-subtle rounded-pill px-2 py-1 f-11 f-w-600">
                                        <i class="fa-solid fa-clock me-1"></i> {{ $item['deployment_status'] }}
                                    </span>
                                @endif
                            </td>
                            <td>
                                <div class="f-11 text-muted">
                                    <div>Started: {{ \Carbon\Carbon::parse($item['start_date'])->format('M d, Y') }}</div>
                                    @if (now()->greaterThanOrEqualTo(\Carbon\Carbon::parse($item['end_date'])))
                                        <div class="text-danger f-w-600">
                                            Expired: {{ \Carbon\Carbon::parse($item['end_date'])->format('M d, Y') }}
                                        </div>
                                    @else
                                        <div>Expires: {{ \Carbon\Carbon::parse($item['end_date'])->format('M d, Y') }}</div>
                                    @endif
                                </div>
                            </td>
                            <td class="text-end">
                                <div class="d-flex align-items-center justify-content-end gap-1 flex-wrap">
                                    @if (now()->greaterThanOrEqualTo(\Carbon\Carbon::parse($item['end_date'])))
                                        <button type="button" class="btn btn-info btn-sm rounded-pill px-2 py-1 f-11 text-white" data-bs-toggle="modal" data-bs-target="#renewModal{{ $item['id'] }}">
                                            <i class="fa-solid fa-rotate me-1"></i> Renew
                                        </button>
                                    @endif

                                    <button type="button" class="btn btn-outline-secondary btn-sm rounded-pill px-2 py-1 f-11" data-bs-toggle="modal" data-bs-target="#strategyModal{{ $item['id'] }}" title="Update Strategy">
                                        <i class="fa-solid fa-sliders me-1"></i> Strategy
                                    </button>

                                    <button type="button" class="btn btn-outline-danger btn-sm rounded-pill px-2 py-1 f-11" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $item['id'] }}" title="Delete Master">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>

                                    @include('admin.subscription.master.delete-master')
                                    @include('admin.subscription.master.renew-master')
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="fa-solid fa-tower-broadcast f-32 mb-2 d-block text-muted opacity-50"></i>
                                No master trading accounts configured yet. Click "Add Master Account" above.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @include('admin.subscription.master.create-master')
</div>
@endsection
