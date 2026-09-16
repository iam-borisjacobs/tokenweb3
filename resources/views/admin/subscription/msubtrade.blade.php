@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <x-danger-alert />
    <x-success-alert />

    <!-- Top Header -->
    <div class="row mb-4 align-items-center justify-content-between g-3">
        <div class="col-md-7">
            <h3 class="f-w-800 text-dark mb-1">
                <i class="fa-solid fa-inbox text-primary me-2"></i> Submitted Trading Accounts
            </h3>
            <p class="text-muted mb-0 f-13">Review client-submitted MT4/MT5 accounts awaiting connection to master trading.</p>
        </div>
    </div>

    <!-- Navigation Tabs & Table Card -->
    <div class="card p-4 shadow-sm border-0 rounded-3 mb-5">
        <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-3 pb-3 mb-3 border-bottom">
            <ul class="nav nav-pills gap-1">
                <li class="nav-item">
                    <a href="{{ route('msubtrade') }}" class="nav-link active rounded-pill px-3 py-2 f-13 f-w-600">
                        <i class="fa-solid fa-inbox me-1"></i> Submitted Accounts
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('tacnts') }}" class="nav-link rounded-pill px-3 py-2 f-13">
                        <i class="fa-solid fa-link me-1"></i> Connected Accounts
                    </a>
                </li>
            </ul>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th class="f-12 f-w-700">Client / User</th>
                        <th class="f-12 f-w-700">Account ID</th>
                        <th class="f-12 f-w-700">Type / Server</th>
                        <th class="f-12 f-w-700">Credentials</th>
                        <th class="f-12 f-w-700">Leverage / Curr.</th>
                        <th class="f-12 f-w-700">Status</th>
                        <th class="f-12 f-w-700">Dates</th>
                        <th class="f-12 f-w-700 text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($subscriptions as $sub)
                        <tr>
                            <td>
                                <div class="f-w-700 text-dark f-14">
                                    {{ $sub->tuser->name ?? 'User' }} {{ $sub->tuser->l_name ?? '' }}
                                </div>
                                <small class="text-muted f-11">{{ $sub->account_name }}</small>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border font-monospace px-2 py-1 rounded-pill f-12">
                                    #{{ $sub->mt4_id }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle rounded-pill px-2 py-1 f-11">
                                    {{ $sub->account_type }}
                                </span>
                                <small class="text-muted d-block f-11 mt-1">{{ $sub->server }}</small>
                            </td>
                            <td>
                                <div class="font-monospace f-12 text-muted">
                                    Pass: <span class="text-dark f-w-600">{{ $sub->mt4_password }}</span>
                                </div>
                            </td>
                            <td>
                                <div class="f-12 text-muted">
                                    <span class="badge bg-info-subtle text-info border border-info-subtle rounded-pill px-2 py-0 f-11">{{ $sub->currency }}</span>
                                    <span class="ms-1 f-w-600 text-dark">{{ $sub->leverage }}</span>
                                </div>
                            </td>
                            <td>
                                @if ($sub->status == 'Pending')
                                    <span class="badge bg-warning-subtle text-warning border border-warning-subtle rounded-pill px-2 py-1 f-11 f-w-600">
                                        <i class="fa-solid fa-clock me-1"></i> Pending
                                    </span>
                                @else
                                    <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2 py-1 f-11 f-w-600">
                                        <i class="fa-solid fa-circle-check me-1"></i> {{ $sub->status }}
                                    </span>
                                @endif
                            </td>
                            <td>
                                <div class="f-11 text-muted">
                                    <div>Submitted: {{ $sub->created_at ? $sub->created_at->format('M d, Y') : 'N/A' }}</div>
                                    @if (!empty($sub->start_date))
                                        <div>Active: {{ $sub->start_date->format('M d, Y') }}</div>
                                    @endif
                                </div>
                            </td>
                            <td class="text-end">
                                <div class="d-flex align-items-center justify-content-end gap-1">
                                    @if ($sub->status == 'Pending')
                                        <form action="{{ route('create.sub') }}" method="post" class="d-inline">
                                            @csrf
                                            <input type="hidden" name="login" value="{{ $sub->mt4_id }}">
                                            <input type="hidden" name="password" value="{{ $sub->mt4_password }}">
                                            <input type="hidden" name="serverName" value="{{ $sub->server }}">
                                            <input type="hidden" name="acntype" value="{{ $sub->account_type }}">
                                            <input type="hidden" name="leverage" value="{{ $sub->leverage }}">
                                            <input type="hidden" name="currency" value="{{ $sub->currency }}">
                                            <input type="hidden" name="name" value="{{ $sub->account_name }}">
                                            <input type="hidden" name="mt4id" value="{{ $sub->id }}">
                                            <button type="submit" class="btn btn-primary btn-sm rounded-pill px-3 py-1 f-11 f-w-600">
                                                <i class="fa-solid fa-check me-1"></i> Process
                                            </button>
                                        </form>
                                    @endif

                                    <a href="{{ url('admin/dashboard/delsub') }}/{{ $sub->id }}" class="btn btn-outline-danger btn-sm rounded-pill px-2 py-1 f-11" onclick="return confirm('Are you sure you want to delete this submitted account?');" title="Delete">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-5 text-muted">
                                <i class="fa-solid fa-inbox f-32 mb-2 d-block text-muted opacity-50"></i>
                                No submitted accounts pending connection.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($subscriptions->hasPages())
            <div class="mt-4 d-flex justify-content-end">
                {{ $subscriptions->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
