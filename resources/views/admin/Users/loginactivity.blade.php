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
                <i class="fa-solid fa-clock-rotate-left text-primary me-2"></i> {{ $user->name }}'s Login Activity Log
            </h3>
            <p class="text-muted mb-0 f-13">Security audit trail of IP addresses, devices, and sessions for this account.</p>
        </div>
        <div class="col-md-auto d-flex align-items-center gap-2">
            @if (count($activities) > 0)
                <a class="btn btn-outline-danger rounded-pill px-3 py-2 f-12 f-w-600 shadow-sm" href="{{ route('clearactivity', $user->id) }}" onclick="return confirm('Are you sure you want to clear all login activity logs for this user?');">
                    <i class="fa-solid fa-trash-can me-1"></i> Clear Activity Log
                </a>
            @endif
        </div>
    </div>

    <!-- Login Activity Table Card -->
    <div class="card p-4 shadow-sm border-0 rounded-3 mb-5">
        <div class="d-flex align-items-center justify-content-between pb-3 mb-3 border-bottom">
            <h5 class="f-w-700 text-dark mb-0">Session History</h5>
            <span class="badge bg-light-primary text-primary rounded-pill px-3 py-1 f-12 f-w-600">
                {{ count($activities) }} Recorded Session{{ count($activities) === 1 ? '' : 's' }}
            </span>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th class="f-12 f-w-700">IP Address</th>
                        <th class="f-12 f-w-700">Device</th>
                        <th class="f-12 f-w-700">Operating System</th>
                        <th class="f-12 f-w-700">Browser</th>
                        <th class="f-12 f-w-700 text-end">Login Timestamp</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($activities as $activity)
                        <tr>
                            <td>
                                <span class="badge bg-light text-dark border font-monospace px-2 py-1 rounded-pill f-12">
                                    <i class="fa-solid fa-network-wired text-primary me-1"></i> {{ $activity->ip_address }}
                                </span>
                            </td>
                            <td>
                                <div class="f-w-600 text-dark f-13">
                                    <i class="fa-solid fa-laptop text-secondary me-1"></i> {{ $activity->device ?? 'Desktop' }}
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle rounded-pill px-2 py-1 f-11">
                                    {{ $activity->os ?? 'Unknown OS' }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-info-subtle text-info border border-info-subtle rounded-pill px-2 py-1 f-11">
                                    <i class="fa-brands fa-chrome me-1"></i> {{ $activity->browser ?? 'Browser' }}
                                </span>
                            </td>
                            <td class="text-end text-muted f-12 text-nowrap">
                                {{ $activity->created_at ? \Carbon\Carbon::parse($activity->created_at)->format('M d, Y • h:i A') : 'N/A' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                <i class="fa-solid fa-shield-halved f-32 mb-2 d-block text-muted opacity-50"></i>
                                No login activity records logged for this user yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
