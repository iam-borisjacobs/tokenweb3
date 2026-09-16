@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <x-danger-alert />
    <x-success-alert />

    <!-- Page Header & Action Bar -->
    <div class="row mb-4">
        <div class="col-12 d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3">
            <div>
                <h3 class="f-w-700 mb-1">
                    <i class="fa fa-user-plus text-primary me-2"></i> Manage Leads
                </h3>
                <p class="text-muted mb-0 f-13">Leads are newly registered clients who have not yet funded their accounts.</p>
            </div>
            <div class="d-flex align-items-center gap-2">
                <button type="button" class="btn btn-primary btn-sm rounded-pill px-4 py-2 f-w-600 shadow-sm"
                    data-bs-toggle="modal" data-bs-target="#assignModal">
                    <i class="fa fa-user-tag me-1"></i> Assign Leads
                </button>
            </div>
        </div>
    </div>

    <!-- Excel Import Banner Card -->
    <div class="card p-4 shadow-sm mb-4 border-0">
        <div class="row align-items-center g-3">
            <div class="col-lg-5">
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-circle bg-light-success text-success d-flex align-items-center justify-content-center flex-shrink-0" style="width: 44px; height: 44px; font-size: 18px;">
                        <i class="fa fa-file-excel-o"></i>
                    </div>
                    <div>
                        <h6 class="f-w-700 mb-1 text-dark">Batch Import Leads via Excel</h6>
                        <p class="text-muted f-12 mb-0">Upload a spreadsheet (.xlsx, .csv) with bulk lead data.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <form action="{{ route('fileImport') }}" method="POST" enctype="multipart/form-data" class="d-flex flex-column flex-sm-row align-items-sm-center gap-2 justify-content-lg-end">
                    @csrf
                    <div class="flex-grow-1" style="max-width: 380px;">
                        <input name="file" class="form-control form-control-sm" type="file" accept=".xlsx,.xls,.csv" required>
                    </div>
                    <button class="btn btn-primary btn-sm rounded-pill px-4 text-nowrap" type="submit">
                        <i class="fa fa-upload me-1"></i> Import
                    </button>
                    <a href="{{ route('downlddoc') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3 text-nowrap" title="Download Sample Document">
                        <i class="fa fa-download me-1"></i> Sample Template
                    </a>
                </form>
            </div>
        </div>
    </div>

    <!-- Leads Table Card -->
    <div class="card p-4 shadow-sm border-0">
        <div class="d-flex align-items-center justify-content-between mb-3 pb-2 border-bottom">
            <h5 class="f-w-700 text-dark mb-0">
                <i class="fa fa-list-ul text-primary me-2"></i> Registered Leads Directory
            </h5>
            <span class="badge bg-light-primary text-primary px-3 py-2 rounded-pill f-12 f-w-600">
                Total: {{ count($users) }} Leads
            </span>
        </div>

        <div class="table-responsive">
            <table id="ShipTable" class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="f-12 f-w-700">Lead Name</th>
                        <th class="f-12 f-w-700">Email Address</th>
                        <th class="f-12 f-w-700">Phone Number</th>
                        <th class="f-12 f-w-700">Status</th>
                        <th class="f-12 f-w-700">Date Registered</th>
                        <th class="f-12 f-w-700">Assigned To</th>
                        <th class="f-12 f-w-700 text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $list)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="rounded-circle bg-light-primary text-primary d-flex align-items-center justify-content-center f-12 f-w-700" style="width: 32px; height: 32px; flex-shrink: 0;">
                                        {{ strtoupper(substr($list->name ?? 'U', 0, 1)) }}
                                    </div>
                                    <div>
                                        <span class="f-w-600 text-dark f-13">{{ $list->name }} {{ $list->l_name ?? '' }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="f-13">{{ $list->email }}</td>
                            <td class="f-13">{{ $list->phone ?? 'N/A' }}</td>
                            <td>
                                @if ($list->status == 'active')
                                    <span class="badge bg-light-success text-success px-2 py-1 rounded-pill f-11">
                                        <i class="fa fa-check-circle me-1"></i> Active
                                    </span>
                                @else
                                    <span class="badge bg-light-danger text-danger px-2 py-1 rounded-pill f-11">
                                        <i class="fa fa-times-circle me-1"></i> Inactive
                                    </span>
                                @endif
                            </td>
                            <td class="f-12 text-muted">
                                {{ $list->created_at->toDayDateTimeString() }}
                            </td>
                            <td>
                                @if ($list->tuser && $list->tuser->firstName)
                                    <span class="badge bg-light-info text-info px-2 py-1 rounded-pill f-11">
                                        <i class="fa fa-user-check me-1"></i> {{ $list->tuser->firstName }} {{ $list->tuser->lastName }}
                                    </span>
                                @else
                                    <span class="badge bg-light-secondary text-muted px-2 py-1 rounded-pill f-11">
                                        Not assigned yet
                                    </span>
                                @endif
                            </td>
                            <td class="text-end">
                                <button type="button" class="btn btn-outline-primary btn-sm rounded-pill px-3"
                                    data-bs-toggle="modal" data-bs-target="#editModal{{ $list->id }}">
                                    <i class="fa fa-edit me-1"></i> Status
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="fa fa-users f-32 mb-2 d-block opacity-50"></i>
                                No leads registered at this time.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Assign Leads Modal -->
<div id="assignModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header">
                <h5 class="modal-title f-w-700">
                    <i class="fa fa-user-tag text-primary me-2"></i> Assign Lead to Admin/Agent
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form role="form" method="post" action="{{ route('assignuser') }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label f-w-600 f-13">Select User / Lead <span class="text-danger">*</span></label>
                        <select name="user_name" class="form-select select2-modal" style="width: 100%;" required>
                            <option value="">-- Choose User --</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }} {{ $user->l_name }} ({{ $user->email }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label f-w-600 f-13">Select Admin / Agent to Assign <span class="text-danger">*</span></label>
                        <select name="admin" class="form-select" required>
                            <option value="">-- Choose Staff Member --</option>
                            @foreach ($admin as $adm)
                                <option value="{{ $adm->id }}">{{ $adm->firstName }} {{ $adm->lastName }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fa fa-check me-1"></i> Assign Now
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Status Modals for Each Lead -->
@foreach ($users as $list)
    <div id="editModal{{ $list->id }}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header">
                    <h5 class="modal-title f-w-700">
                        <i class="fa fa-notes-medical text-primary me-2"></i> Update Lead Status: {{ $list->name }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="{{ route('updateuser') }}">
                    @csrf
                    <input type="hidden" name="id" value="{{ $list->id }}">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label f-w-600 f-13">Follow-up Notes / Status Update <span class="text-danger">*</span></label>
                            <textarea name="userupdate" rows="5" class="form-control" placeholder="Enter follow-up details, client feedback, or contact notes..." required>{{ $list->userupdate }}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fa fa-save me-1"></i> Save Status
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof $ !== 'undefined' && $.fn.select2) {
            $('.select2-modal').select2({
                dropdownParent: $('#assignModal')
            });
        }
    });
</script>
@endpush
@endsection
