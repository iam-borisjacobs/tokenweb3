@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <x-danger-alert />
    <x-success-alert />

    <!-- Top Header -->
    <div class="row mb-4 align-items-center justify-content-between g-3">
        <div class="col-md-7">
            <h3 class="f-w-800 text-dark mb-1">
                <i class="fa-solid fa-user-check text-primary me-2"></i> Leads Assigned to Me
            </h3>
            <p class="text-muted mb-0 f-13">New client prospects assigned to your conversion agent queue.</p>
        </div>
        <div class="col-md-auto">
            <span class="badge bg-light-primary text-primary rounded-pill px-3 py-2 f-12 f-w-600">
                <i class="fa-solid fa-clipboard-list me-1"></i> {{ count($usersAssigned) }} Assigned Lead{{ count($usersAssigned) === 1 ? '' : 's' }}
            </span>
        </div>
    </div>

    <!-- Table Card -->
    <div class="card p-4 shadow-sm border-0 rounded-3 mb-5">
        <div class="d-flex align-items-center justify-content-between pb-3 mb-3 border-bottom">
            <h5 class="f-w-700 text-dark mb-0">Assigned Prospects Queue</h5>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th class="f-12 f-w-700">Client / Prospect</th>
                        <th class="f-12 f-w-700">Balance</th>
                        <th class="f-12 f-w-700">Phone</th>
                        <th class="f-12 f-w-700">Lead Notes</th>
                        <th class="f-12 f-w-700">Conversion Status</th>
                        <th class="f-12 f-w-700">Registered</th>
                        <th class="f-12 f-w-700 text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($usersAssigned as $list)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 36px; height: 36px; background: rgba(99, 98, 231, 0.12); color: #6362e7; font-weight: 700; font-size: 13px;">
                                        {{ strtoupper(substr($list->name ?? 'P', 0, 1)) }}
                                    </div>
                                    <div>
                                        <a href="{{ route('viewuser', $list->id) }}" class="f-w-700 text-dark f-13 text-decoration-none">
                                            {{ $list->name }} {{ $list->l_name }}
                                        </a>
                                        <small class="text-muted d-block f-11">{{ $list->email }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="f-w-800 text-primary f-14">${{ number_format($list->account_bal, 2) }}</span>
                            </td>
                            <td class="f-13 text-muted">
                                {{ $list->phone_number ?? '—' }}
                            </td>
                            <td>
                                @if(!empty($list->userupdate))
                                    <span class="badge bg-light text-dark border px-2 py-1 rounded-pill f-11" title="{{ $list->userupdate }}">
                                        {{ Str::limit($list->userupdate, 25) }}
                                    </span>
                                @else
                                    <span class="text-muted f-11">No notes recorded</span>
                                @endif
                            </td>
                            <td>
                                @if ($list->cstatus == 'Customer')
                                    <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-1 f-11 f-w-600">
                                        <i class="fa-solid fa-circle-check me-1"></i> Converted
                                    </span>
                                @else
                                    <span class="badge bg-warning-subtle text-warning border border-warning-subtle rounded-pill px-3 py-1 f-11 f-w-600">
                                        <i class="fa-solid fa-clock me-1"></i> Prospect
                                    </span>
                                @endif
                            </td>
                            <td class="text-muted f-12 text-nowrap">
                                {{ $list->created_at ? \Carbon\Carbon::parse($list->created_at)->format('M d, Y') : 'N/A' }}
                            </td>
                            <td class="text-end">
                                <div class="d-flex align-items-center justify-content-end gap-1">
                                    @if ($list->cstatus != 'Customer')
                                        <a href="{{ url('admin/dashboard/convert') }}/{{ $list->id }}" class="btn btn-outline-success btn-sm rounded-pill px-3 py-1 f-11 f-w-600">
                                            <i class="fa-solid fa-check me-1"></i> Mark Converted
                                        </a>
                                    @endif

                                    <button type="button" class="btn btn-outline-primary btn-sm rounded-pill px-3 py-1 f-11" data-bs-toggle="modal" data-bs-target="#editModal{{ $list->id }}">
                                        <i class="fa-solid fa-pen-to-square me-1"></i> Update Notes
                                    </button>
                                </div>

                                <!-- Update Notes Modal -->
                                <div class="modal fade text-start" id="editModal{{ $list->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content border-0 shadow-lg">
                                            <div class="modal-header border-bottom pb-3">
                                                <h5 class="modal-title f-w-700 text-dark">
                                                    <i class="fa-solid fa-pen-to-square text-primary me-2"></i> Update Lead: {{ $list->name }}
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form method="POST" action="{{ route('updateuser') }}">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $list->id }}">
                                                <div class="modal-body p-4">
                                                    <label class="form-label f-w-600 f-13">Conversation / Lead Status Update</label>
                                                    <textarea name="userupdate" rows="5" class="form-control" placeholder="Type recent follow-up notes here..." required>{{ $list->userupdate }}</textarea>
                                                </div>
                                                <div class="modal-footer border-top pt-3">
                                                    <button type="button" class="btn btn-light rounded-pill px-3 py-2 f-13" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-primary rounded-pill px-4 py-2 f-13 f-w-700 shadow-sm">
                                                        Save Update
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="fa-solid fa-user-check f-32 mb-2 d-block text-muted opacity-50"></i>
                                No prospects currently assigned to your queue.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
