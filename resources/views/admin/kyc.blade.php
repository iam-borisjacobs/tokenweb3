@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <x-danger-alert />
    <x-success-alert />

    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-12 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <div>
                <h3 class="f-w-700 mb-1">KYC Applications</h3>
                <p class="text-muted mb-0 f-14">Review client identity verification submissions and approve or reject documents.</p>
            </div>
            <div class="d-flex flex-wrap gap-2">
                <span class="badge bg-light-primary text-primary px-3 py-2 rounded-pill f-12">
                    <i class="fa fa-id-card me-1"></i> Total: {{ count($kycs) }}
                </span>
                <span class="badge bg-light-warning text-warning px-3 py-2 rounded-pill f-12">
                    <i class="fa fa-clock-o me-1"></i> Pending: {{ $kycs->where('status', 'Under review')->count() }}
                </span>
                <span class="badge bg-light-success text-success px-3 py-2 rounded-pill f-12">
                    <i class="fa fa-check-circle me-1"></i> Verified: {{ $kycs->where('status', 'Verified')->count() }}
                </span>
            </div>
        </div>
    </div>

    <!-- KYC Table Card -->
    <div class="row">
        <div class="col-12">
            <div class="card p-4">
                <div class="table-responsive">
                    <table id="ShipTable" class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="f-w-600 f-13">ID</th>
                                <th class="f-w-600 f-13">Client / Applicant</th>
                                <th class="f-w-600 f-13">Document Type</th>
                                <th class="f-w-600 f-13">Submitted Date</th>
                                <th class="f-w-600 f-13">KYC Status</th>
                                <th class="f-w-600 f-13 text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($kycs as $list)
                                @php
                                    $clientName = $list->user ? $list->user->name : ($list->first_name ? $list->first_name . ' ' . $list->last_name : 'Applicant #' . $list->id);
                                    $clientEmail = $list->user ? $list->user->email : ($list->email ?? 'No email provided');
                                    $initial = strtoupper(substr($clientName, 0, 1));
                                @endphp
                                <tr>
                                    <td>
                                        <span class="text-muted f-12 f-w-600">#{{ $list->id }}</span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="rounded-circle bg-light-primary text-primary d-flex align-items-center justify-content-center f-12 f-w-700" style="width: 34px; height: 34px; flex-shrink: 0;">
                                                {{ $initial }}
                                            </div>
                                            <div>
                                                <h6 class="mb-0 f-13 f-w-700 text-dark">{{ $clientName }}</h6>
                                                <small class="text-muted f-11">{{ $clientEmail }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark border px-2 py-1 f-12">
                                            <i class="fa fa-id-badge me-1 text-primary"></i> {{ $list->document_type ?? 'Identification Document' }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="text-muted f-12">
                                            {{ \Carbon\Carbon::parse($list->created_at)->toFormattedDateString() }}
                                            <small class="d-block text-muted f-11">{{ \Carbon\Carbon::parse($list->created_at)->format('g:i A') }}</small>
                                        </span>
                                    </td>
                                    <td>
                                        @if ($list->status == 'Verified')
                                            <span class="badge bg-light-success text-success px-3 py-1 rounded-pill f-12">
                                                <i class="fa fa-check-circle me-1"></i> Verified
                                            </span>
                                        @elseif ($list->status == 'Under review')
                                            <span class="badge bg-light-warning text-warning px-3 py-1 rounded-pill f-12">
                                                <i class="fa fa-clock-o me-1"></i> Under Review
                                            </span>
                                        @else
                                            <span class="badge bg-light-danger text-danger px-3 py-1 rounded-pill f-12">
                                                <i class="fa fa-times-circle me-1"></i> {{ $list->status }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        <a href="{{ route('viewkyc', $list->id) }}" class="btn btn-outline-primary btn-sm rounded-pill px-3 py-1 f-12">
                                            <i class="fa fa-eye me-1"></i> Review
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5">
                                        <div class="text-muted">
                                            <i class="fa fa-id-card-o f-40 mb-3 d-block"></i>
                                            <p class="mb-0">No KYC applications submitted yet.</p>
                                        </div>
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
@endsection
