@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <x-danger-alert />
    <x-success-alert />

    <!-- Top Header -->
    <div class="row mb-4 align-items-center justify-content-between g-3">
        <div class="col-md-7">
            <h3 class="f-w-800 text-dark mb-1">
                <i class="fa-solid fa-users text-primary me-2"></i> Trade Signals Subscribers
            </h3>
            <p class="text-muted mb-0 f-13">Active and expired user subscriptions to premium trade signals.</p>
        </div>
        <div class="col-md-auto d-flex align-items-center gap-2">
            <a href="{{ route('signals') }}" class="btn btn-outline-secondary rounded-pill px-3 py-2 f-13 f-w-600">
                <i class="fa-solid fa-arrow-left me-1"></i> Back to Signals
            </a>
            <a href="{{ route('signal.settings') }}" class="btn btn-light rounded-pill px-3 py-2 f-13 f-w-600 shadow-sm">
                <i class="fa-solid fa-gear me-1"></i> Signal Settings
            </a>
        </div>
    </div>

    <!-- Subscribers Table Card -->
    <div class="card p-4 shadow-sm border-0 rounded-3 mb-5">
        <div class="d-flex align-items-center justify-content-between pb-3 mb-3 border-bottom">
            <h5 class="f-w-700 text-dark mb-0">Subscriber List</h5>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th class="f-12 f-w-700">Client / Subscriber</th>
                        <th class="f-12 f-w-700">Subscription Plan</th>
                        <th class="f-12 f-w-700">Amount Paid</th>
                        <th class="f-12 f-w-700">Started Date</th>
                        <th class="f-12 f-w-700">Expiration Status</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $list = isset($subscribers->data) ? $subscribers->data : $subscribers;
                    @endphp
                    @forelse ($list as $subscriber)
                        @php
                            $subUser = \App\Models\User::find($subscriber->client_id);
                        @endphp
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 36px; height: 36px; background: rgba(99, 98, 231, 0.12); color: #6362e7; font-weight: 700; font-size: 13px;">
                                        {{ strtoupper(substr($subUser->name ?? 'U', 0, 1)) }}
                                    </div>
                                    <div>
                                        @if($subUser)
                                            <a href="{{ route('viewuser', $subUser->id) }}" class="f-w-700 text-dark f-13 text-decoration-none">
                                                {{ $subUser->name }}
                                            </a>
                                            <small class="text-muted d-block f-11">{{ $subUser->email }}</small>
                                        @else
                                            <span class="text-muted f-13">User #{{ $subscriber->client_id }}</span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-3 py-1 f-12 f-w-600">
                                    <i class="fa-solid fa-bell me-1"></i> {{ $subscriber->subscription }}
                                </span>
                            </td>
                            <td>
                                <span class="f-w-800 text-primary f-14">
                                    {{ $settings->currency }}{{ number_format($subscriber->amount_paid, 2) }}
                                </span>
                            </td>
                            <td class="text-muted f-12 text-nowrap">
                                {{ $subscriber->created_at ? \Carbon\Carbon::parse($subscriber->created_at)->format('M d, Y • h:i A') : 'N/A' }}
                            </td>
                            <td>
                                @if (now()->greaterThanOrEqualTo($subscriber->expired_at))
                                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill px-2 py-1 f-11">
                                        <i class="fa-solid fa-circle-xmark me-1"></i> Expired: {{ \Carbon\Carbon::parse($subscriber->expired_at)->format('M d, Y') }}
                                    </span>
                                @else
                                    <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2 py-1 f-11">
                                        <i class="fa-solid fa-circle-check me-1"></i> Active until {{ \Carbon\Carbon::parse($subscriber->expired_at)->format('M d, Y') }}
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                <i class="fa-solid fa-user-xmark f-32 mb-2 d-block text-muted opacity-50"></i>
                                No active or past trade signal subscribers found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
