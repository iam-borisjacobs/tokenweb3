@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <x-danger-alert />
    <x-success-alert />

    <!-- Top Header -->
    <div class="row mb-4 align-items-center justify-content-between g-3">
        <div class="col-md-7">
            <div class="d-flex align-items-center gap-2 mb-1">
                <a href="{{ route('agents') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3 py-1 f-12">
                    <i class="fa-solid fa-arrow-left me-1"></i> Back to Agents
                </a>
            </div>
            <h3 class="f-w-800 text-dark mb-1">
                <i class="fa-solid fa-user-group text-primary me-2"></i> Agent Clients: {{ $agent->name }}
            </h3>
            <p class="text-muted mb-0 f-13">Direct client referrals registered under affiliate agent {{ $agent->name }}.</p>
        </div>
        <div class="col-md-auto">
            <span class="badge bg-light-primary text-primary rounded-pill px-3 py-2 f-12 f-w-600">
                <i class="fa-solid fa-users me-1"></i> {{ count($ag_r) }} Total Client{{ count($ag_r) === 1 ? '' : 's' }}
            </span>
        </div>
    </div>

    <!-- Table Card -->
    <div class="card p-4 shadow-sm border-0 rounded-3 mb-5">
        <div class="d-flex align-items-center justify-content-between pb-3 mb-3 border-bottom">
            <h5 class="f-w-700 text-dark mb-0">Referred Clients Directory</h5>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th class="f-12 f-w-700">Client Name</th>
                        <th class="f-12 f-w-700">Investment Plan</th>
                        <th class="f-12 f-w-700">Account Balance</th>
                        <th class="f-12 f-w-700">Status</th>
                        <th class="f-12 f-w-700 text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($ag_r as $client)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 36px; height: 36px; background: rgba(99, 98, 231, 0.12); color: #6362e7; font-weight: 700; font-size: 13px;">
                                        {{ strtoupper(substr($client->name ?? 'C', 0, 1)) }}
                                    </div>
                                    <div class="f-w-700 text-dark f-14">
                                        {{ $client->name }}
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if (isset($client->dplan->name))
                                    <span class="badge bg-light text-dark border px-2 py-1 rounded-pill f-12">
                                        {{ $client->dplan->name }}
                                    </span>
                                @else
                                    <span class="text-muted f-12">None</span>
                                @endif
                            </td>
                            <td>
                                <span class="f-w-800 text-primary f-14">${{ number_format($client->account_bal, 2) }}</span>
                            </td>
                            <td>
                                <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2 py-1 f-11">
                                    {{ $client->status ?? 'Active' }}
                                </span>
                            </td>
                            <td class="text-end">
                                <a href="{{ route('viewuser', $client->id) }}" class="btn btn-light btn-sm rounded-pill px-3 py-1 f-12 f-w-600">
                                    <i class="fa-solid fa-user me-1 text-primary"></i> View Profile
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                <i class="fa-solid fa-user-xmark f-32 mb-2 d-block text-muted opacity-50"></i>
                                No clients referred by this agent yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
