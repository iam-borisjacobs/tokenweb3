@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <x-danger-alert />
    <x-success-alert />

    <!-- Header -->
    <div class="row mb-4 align-items-center justify-content-between g-3">
        <div class="col-md-7">
            <h3 class="f-w-800 text-dark mb-1">
                <i class="fa-solid fa-handshake text-primary me-2"></i> Affiliate & Conversion Agents
            </h3>
            <p class="text-muted mb-0 f-13">Track conversion agents and their affiliated downline clients.</p>
        </div>
        <div class="col-md-auto">
            <span class="badge bg-light-primary text-primary rounded-pill px-3 py-2 f-12 f-w-600">
                <i class="fa-solid fa-users me-1"></i> {{ count($agents) }} Registered Agent{{ count($agents) === 1 ? '' : 's' }}
            </span>
        </div>
    </div>

    <!-- Table Card -->
    <div class="card p-4 shadow-sm border-0 rounded-3 mb-5">
        <div class="d-flex align-items-center justify-content-between pb-3 mb-3 border-bottom">
            <h5 class="f-w-700 text-dark mb-0">Agent Performance Directory</h5>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th class="f-12 f-w-700">Agent Name</th>
                        <th class="f-12 f-w-700">Email Address</th>
                        <th class="f-12 f-w-700">Total Referred Clients</th>
                        <th class="f-12 f-w-700 text-end">Profile</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($agents as $agent)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 36px; height: 36px; background: rgba(99, 98, 231, 0.12); color: #6362e7; font-weight: 700; font-size: 13px;">
                                        {{ strtoupper(substr($agent->duser->name ?? 'A', 0, 1)) }}
                                    </div>
                                    <div class="f-w-700 text-dark f-14">
                                        {{ $agent->duser->name ?? 'Agent #' . $agent->id }}
                                    </div>
                                </div>
                            </td>
                            <td class="f-13 text-muted">
                                {{ $agent->duser->email ?? 'N/A' }}
                            </td>
                            <td>
                                <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-3 py-1 f-12 f-w-600">
                                    <i class="fa-solid fa-users me-1"></i> {{ $agent->total_refered ?? 0 }} Clients
                                </span>
                            </td>
                            <td class="text-end">
                                @if(isset($agent->duser))
                                    <a href="{{ route('viewuser', $agent->duser->id) }}" class="btn btn-light btn-sm rounded-pill px-3 py-1 f-12 f-w-600">
                                        <i class="fa-solid fa-user me-1 text-primary"></i> View Details
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-5 text-muted">
                                <i class="fa-solid fa-handshake-slash f-32 mb-2 d-block text-muted opacity-50"></i>
                                No conversion or affiliate agents recorded yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
