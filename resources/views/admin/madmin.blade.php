@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <x-danger-alert />
    <x-success-alert />

    <!-- Page Header & Action -->
    <div class="row mb-4 align-items-center justify-content-between g-3">
        <div class="col-md-7">
            <h3 class="f-w-800 text-dark mb-1">
                <i class="fa-solid fa-users-gear text-primary me-2"></i> System Managers & Administrators
            </h3>
            <p class="text-muted mb-0 f-13">Manage administrative users, assign permissions, reset credentials, and audit access.</p>
        </div>
        <div class="col-md-auto d-flex align-items-center gap-2">
            <a href="{{ route('addmanager') }}" class="btn btn-primary rounded-pill px-4 py-2 f-13 f-w-700 shadow-sm">
                <i class="fa-solid fa-user-plus me-1"></i> Add New Manager
            </a>
        </div>
    </div>

    <!-- Managers Table Card -->
    <div class="card p-4 shadow-sm border-0 rounded-3 mb-5">
        <div class="d-flex align-items-center justify-content-between pb-3 mb-3 border-bottom">
            <h5 class="f-w-700 text-dark mb-0">Active Management Accounts</h5>
            <span class="badge bg-light-primary text-primary rounded-pill px-3 py-1 f-12 f-w-600">
                {{ count($admins) }} Total Manager{{ count($admins) === 1 ? '' : 's' }}
            </span>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th class="f-12 f-w-700">Manager</th>
                        <th class="f-12 f-w-700">Email Address</th>
                        <th class="f-12 f-w-700">Phone</th>
                        <th class="f-12 f-w-700">Role / Type</th>
                        <th class="f-12 f-w-700">Account Status</th>
                        <th class="f-12 f-w-700 text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($admins as $admin)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 40px; height: 40px; background: rgba(99, 98, 231, 0.12); color: #6362e7; font-weight: 700; font-size: 15px;">
                                        {{ strtoupper(substr($admin->firstName ?? 'A', 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="f-w-700 text-dark f-14 mb-0">{{ $admin->firstName }} {{ $admin->lastName }}</div>
                                        <small class="text-muted f-11">UID: #{{ $admin->id }}</small>
                                    </div>
                                </div>
                            </td>
                            <td class="f-13 text-muted">{{ $admin->email }}</td>
                            <td class="f-13 text-muted">{{ $admin->phone ?? '—' }}</td>
                            <td>
                                @if($admin->type === 'Super Admin')
                                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill px-3 py-1 f-11 f-w-600">
                                        <i class="fa-solid fa-crown me-1"></i> Super Admin
                                    </span>
                                @elseif($admin->type === 'Admin')
                                    <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-3 py-1 f-11 f-w-600">
                                        <i class="fa-solid fa-shield-halved me-1"></i> Admin
                                    </span>
                                @else
                                    <span class="badge bg-info-subtle text-info border border-info-subtle rounded-pill px-3 py-1 f-11 f-w-600">
                                        <i class="fa-solid fa-user-tag me-1"></i> {{ $admin->type ?? 'Manager' }}
                                    </span>
                                @endif
                            </td>
                            <td>
                                @if ($admin->acnt_type_active == null || $admin->acnt_type_active == 'blocked')
                                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill px-2 py-1 f-11 f-w-600">
                                        <i class="fa-solid fa-ban me-1"></i> Blocked
                                    </span>
                                @else
                                    <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2 py-1 f-11 f-w-600">
                                        <i class="fa-solid fa-circle-check me-1"></i> Active
                                    </span>
                                @endif
                            </td>
                            <td class="text-end">
                                <div class="dropdown">
                                    <button class="btn btn-light btn-sm rounded-pill px-3 py-1 f-12 f-w-600 dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Actions
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 py-2">
                                        <li>
                                            <a class="dropdown-item f-13 py-2" href="#" data-bs-toggle="modal" data-bs-target="#edituser{{ $admin->id }}">
                                                <i class="fa-solid fa-pen-to-square text-primary me-2"></i> Edit Account
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item f-13 py-2" href="#" data-bs-toggle="modal" data-bs-target="#sendmailModal{{ $admin->id }}">
                                                <i class="fa-solid fa-envelope text-info me-2"></i> Send Email
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item f-13 py-2" href="#" data-bs-toggle="modal" data-bs-target="#resetpswdModal{{ $admin->id }}">
                                                <i class="fa-solid fa-key text-warning me-2"></i> Reset Password
                                            </a>
                                        </li>
                                        <li><hr class="dropdown-divider"></li>
                                        @if ($admin->acnt_type_active == null || $admin->acnt_type_active == 'blocked')
                                            <li>
                                                <a class="dropdown-item f-13 py-2 text-success" href="{{ url('admin/dashboard/unblock') }}/{{ $admin->id }}">
                                                    <i class="fa-solid fa-unlock me-2"></i> Unblock Account
                                                </a>
                                            </li>
                                        @else
                                            <li>
                                                <a class="dropdown-item f-13 py-2 text-warning" href="{{ url('admin/dashboard/ublock') }}/{{ $admin->id }}">
                                                    <i class="fa-solid fa-lock me-2"></i> Suspend / Block
                                                </a>
                                            </li>
                                        @endif
                                        <li>
                                            <a class="dropdown-item f-13 py-2 text-danger" href="#" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $admin->id }}">
                                                <i class="fa-solid fa-trash-can me-2"></i> Delete Account
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>

                        <!-- Edit Manager Modal -->
                        <div class="modal fade" id="edituser{{ $admin->id }}" tabindex="-1" aria-labelledby="editUserLabel{{ $admin->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 shadow-lg">
                                    <div class="modal-header border-bottom pb-3">
                                        <h5 class="modal-title f-w-700 text-dark" id="editUserLabel{{ $admin->id }}">
                                            <i class="fa-solid fa-pen-to-square text-primary me-2"></i> Edit Manager Profile
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form method="POST" action="{{ route('editadmin') }}">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{ $admin->id }}">
                                        <div class="modal-body p-4">
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <label class="form-label f-w-600 f-12">First Name <span class="text-danger">*</span></label>
                                                    <input class="form-control" value="{{ $admin->firstName }}" type="text" name="fname" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label f-w-600 f-12">Last Name <span class="text-danger">*</span></label>
                                                    <input class="form-control" value="{{ $admin->lastName }}" type="text" name="l_name" required>
                                                </div>
                                                <div class="col-12">
                                                    <label class="form-label f-w-600 f-12">Email Address <span class="text-danger">*</span></label>
                                                    <input class="form-control" value="{{ $admin->email }}" type="email" name="email" required>
                                                </div>
                                                <div class="col-12">
                                                    <label class="form-label f-w-600 f-12">Phone Number <span class="text-danger">*</span></label>
                                                    <input class="form-control" value="{{ $admin->phone }}" type="text" name="phone" required>
                                                </div>
                                                <div class="col-12">
                                                    <label class="form-label f-w-600 f-12">Role / Permission Type <span class="text-danger">*</span></label>
                                                    <select class="form-select form-control" name="type" required>
                                                        <option value="Super Admin" {{ $admin->type === 'Super Admin' ? 'selected' : '' }}>Super Admin</option>
                                                        <option value="Admin" {{ $admin->type === 'Admin' ? 'selected' : '' }}>Admin</option>
                                                        <option value="Conversion Agent" {{ $admin->type === 'Conversion Agent' ? 'selected' : '' }}>Conversion Agent</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer border-top pt-3">
                                            <button type="button" class="btn btn-light rounded-pill px-3" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary rounded-pill px-4">
                                                <i class="fa-solid fa-floppy-disk me-1"></i> Update Manager
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Reset Password Modal -->
                        <div class="modal fade" id="resetpswdModal{{ $admin->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-sm">
                                <div class="modal-content border-0 shadow-lg text-center p-3">
                                    <div class="modal-body pt-4">
                                        <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 56px; height: 56px; background: rgba(245, 158, 11, 0.12); color: #f59e0b; font-size: 24px;">
                                            <i class="fa-solid fa-key"></i>
                                        </div>
                                        <h5 class="f-w-700 text-dark mb-2">Reset Password?</h5>
                                        <p class="text-muted f-13 mb-3">
                                            Are you sure you want to reset password for <strong>{{ $admin->firstName }}</strong>? Password will be reset to:
                                        </p>
                                        <div class="p-2 bg-light rounded-3 font-monospace f-w-700 text-primary mb-4">
                                            admin01236
                                        </div>
                                        <div class="d-flex gap-2">
                                            <button type="button" class="btn btn-light rounded-pill w-100 py-2 f-13" data-bs-dismiss="modal">Cancel</button>
                                            <a class="btn btn-warning text-dark rounded-pill w-100 py-2 f-13 f-w-700" href="{{ url('admin/dashboard/resetadpwd') }}/{{ $admin->id }}">
                                                Reset Now
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Send Email Modal -->
                        <div class="modal fade" id="sendmailModal{{ $admin->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 shadow-lg">
                                    <div class="modal-header border-bottom pb-3">
                                        <h5 class="modal-title f-w-700 text-dark">
                                            <i class="fa-solid fa-envelope text-primary me-2"></i> Send Direct Email
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form method="POST" action="{{ route('sendmailtoadmin') }}">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{ $admin->id }}">
                                        <div class="modal-body p-4">
                                            <p class="text-muted f-13 mb-3">
                                                Message will be dispatched to <strong>{{ $admin->firstName }} {{ $admin->lastName }}</strong> ({{ $admin->email }}).
                                            </p>
                                            <div class="mb-3">
                                                <label class="form-label f-w-600 f-12">Email Subject <span class="text-danger">*</span></label>
                                                <input type="text" name="subject" class="form-control" placeholder="Enter subject line..." required>
                                            </div>
                                            <div class="mb-2">
                                                <label class="form-label f-w-600 f-12">Message Body <span class="text-danger">*</span></label>
                                                <textarea class="form-control" name="message" rows="4" placeholder="Write your message here..." required></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer border-top pt-3">
                                            <button type="button" class="btn btn-light rounded-pill px-3" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary rounded-pill px-4">
                                                <i class="fa-solid fa-paper-plane me-1"></i> Send Email
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Delete Manager Modal -->
                        <div class="modal fade" id="deleteModal{{ $admin->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-sm">
                                <div class="modal-content border-0 shadow-lg text-center p-3">
                                    <div class="modal-body pt-4">
                                        <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 56px; height: 56px; background: rgba(239, 68, 68, 0.12); color: #ef4444; font-size: 24px;">
                                            <i class="fa-solid fa-triangle-exclamation"></i>
                                        </div>
                                        <h5 class="f-w-700 text-dark mb-2">Delete Manager?</h5>
                                        <p class="text-muted f-13 mb-4">
                                            Are you sure you want to permanently delete manager account <strong>{{ $admin->firstName }} {{ $admin->lastName }}</strong>? This action cannot be undone.
                                        </p>
                                        <div class="d-flex gap-2">
                                            <button type="button" class="btn btn-light rounded-pill w-100 py-2 f-13" data-bs-dismiss="modal">Cancel</button>
                                            <a class="btn btn-danger rounded-pill w-100 py-2 f-13 f-w-700" href="{{ route('deleteadminacnt', $admin->id) }}">
                                                Delete
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">
                                <i class="fa-solid fa-users-slash f-32 mb-2 d-block text-muted opacity-50"></i>
                                No managers registered yet. Click "Add New Manager" above to create one.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
