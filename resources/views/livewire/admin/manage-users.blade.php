<div>
    <!-- Page Header & Action Bar -->
    <div class="row mb-3 mb-md-4">
        <div class="col-12 d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-3">
            <div>
                <h3 class="f-w-800 text-dark mb-1 f-20 f-md-24">
                    <i class="fa fa-users text-primary me-2"></i> {{ $settings->site_name }} Users Directory
                </h3>
                <p class="text-muted mb-0 f-12 f-md-13">Browse, search, manage, and perform administrative operations on client accounts.</p>
            </div>
            <div class="d-flex align-items-center gap-2 flex-wrap w-100 w-sm-auto">
                <button class="btn btn-primary btn-sm rounded-pill px-3 py-2 f-w-600 shadow-sm flex-fill flex-sm-grow-0" type="button"
                    data-bs-toggle="modal" data-bs-target="#adduser">
                    <i class="fa fa-user-plus me-1"></i> Add New User
                </button>
                <a class="btn btn-outline-secondary btn-sm rounded-pill px-3 py-2 f-w-600 flex-fill flex-sm-grow-0 text-center" href="{{ route('emailservices') }}">
                    <i class="fa fa-envelope me-1"></i> Send Broadcast
                </a>
            </div>
        </div>
    </div>

    <x-danger-alert />
    <x-success-alert />

    <!-- Users Table Card -->
    <div class="card p-3 p-sm-4 shadow-sm border-0 mb-4">
        <!-- Search and Bulk Action Toolbar -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4 pb-3 border-bottom">
            <div class="flex-grow-1" style="max-width: 400px;">
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0">
                        <i class="fa fa-search text-muted"></i>
                    </span>
                    <input wire:model.debounce.500ms="searchvalue"
                        class="form-control border-start-0 ps-0"
                        type="search" placeholder="Search by name, username, or email..."
                        aria-label="Search users" />
                </div>
            </div>

            <div>
                @if ($checkrecord)
                    <div class="d-flex align-items-center gap-2 flex-wrap">
                        <span class="badge bg-light-primary text-primary px-3 py-2 rounded-pill f-12 f-w-600">
                            {{ count($checkrecord) }} selected
                        </span>
                        <select wire:model="action" class="form-select form-select-sm" style="width: auto;">
                            <option value="Delete">Delete</option>
                            <option value="Clear">Clear Account</option>
                        </select>
                        <button class="btn btn-danger btn-sm rounded-pill px-3"
                            wire:click="delsystemuser" type="button">
                            Apply
                        </button>
                        <button class="btn btn-info btn-sm text-white rounded-pill px-3" data-bs-toggle="modal"
                            data-bs-target="#TradingModal" type="button">
                            <i class="fa fa-coins me-1"></i> Add ROI
                        </button>
                        <button class="btn btn-warning btn-sm text-dark rounded-pill px-3" data-bs-toggle="modal"
                            data-bs-target="#topupModal" type="button">
                            <i class="fa fa-plus me-1"></i> Topup
                        </button>
                    </div>
                @endif
            </div>
        </div>

        <!-- Table Responsive -->
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width: 40px;">
                            <input type="checkbox" class="form-check-input" wire:model="selectPage" />
                        </th>
                        <th class="f-12 f-w-700">Client Name</th>
                        <th class="f-12 f-w-700">Username</th>
                        <th class="f-12 f-w-700">Email</th>
                        <th class="f-12 f-w-700">Phone</th>
                        <th class="f-12 f-w-700">Status</th>
                        <th class="f-12 f-w-700">Registered</th>
                        <th class="f-12 f-w-700 text-end">Action</th>
                    </tr>
                </thead>
                <tbody id="userslisttbl">
                    @forelse ($users as $user)
                        <tr>
                            <td>
                                <input type="checkbox" class="form-check-input" wire:model="checkrecord"
                                    value="{{ $user->id }}" />
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="rounded-circle bg-light-primary text-primary d-flex align-items-center justify-content-center f-12 f-w-700" style="width: 34px; height: 34px; flex-shrink: 0;">
                                        {{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}
                                    </div>
                                    <div>
                                        <a href="{{ route('viewuser', $user->id) }}" class="f-w-600 text-dark text-decoration-none f-13">
                                            {{ $user->name }}
                                        </a>
                                    </div>
                                </div>
                            </td>
                            <td class="f-13">{{ $user->username }}</td>
                            <td class="f-13">{{ $user->email }}</td>
                            <td class="f-13">{{ $user->phone ?? 'N/A' }}</td>
                            <td>
                                @if ($user->status == 'active')
                                    <span class="badge bg-light-success text-success px-2 py-1 rounded-pill f-11">
                                        <i class="fa fa-check-circle me-1"></i> Active
                                    </span>
                                @else
                                    <span class="badge bg-light-danger text-danger px-2 py-1 rounded-pill f-11">
                                        <i class="fa fa-times-circle me-1"></i> {{ $user->status ?? 'Inactive' }}
                                    </span>
                                @endif
                            </td>
                            <td class="f-12 text-muted text-nowrap">
                                {{ $user->created_at->diffForHumans() }}
                            </td>
                            <td class="text-end">
                                <a class="btn btn-outline-primary btn-sm rounded-pill px-3"
                                    href="{{ route('viewuser', $user->id) }}">
                                    <i class="fa fa-sliders me-1"></i> Manage
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-5 text-muted">
                                <i class="fa fa-users-slash f-32 mb-2 d-block opacity-50"></i>
                                No users matched your search criteria.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Table Footer Pagination and Sorting -->
        <div class="row align-items-center justify-content-between mt-4 pt-3 border-top g-3">
            <div class="col-sm-auto d-flex align-items-center gap-2">
                <span class="text-muted f-12">Show:</span>
                <select wire:model="pagenum" class="form-select form-select-sm" style="width: auto;">
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                    <option value="200">200</option>
                </select>
                <span class="text-muted f-12 ms-2">Order by:</span>
                <select wire:model="orderby" class="form-select form-select-sm" style="width: auto;">
                    <option value="id">ID</option>
                    <option value="name">Name</option>
                    <option value="email">Email</option>
                    <option value="created_at">Sign up date</option>
                </select>
                <select wire:model="orderdirection" class="form-select form-select-sm" style="width: auto;">
                    <option value="desc">Descending</option>
                    <option value="asc">Ascending</option>
                </select>
            </div>
            <div class="col-sm-auto">
                {!! $users->links() !!}
            </div>
        </div>
    </div>

    <!-- Add User Modal -->
    <div wire:ignore.self class="modal fade" id="adduser" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header">
                    <h5 class="modal-title f-w-700" id="addUserModalLabel">
                        <i class="fa fa-user-plus text-primary me-2"></i> Add New Client User
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" wire:submit.prevent="saveUser">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label f-w-600 f-13">Username <span class="text-danger">*</span></label>
                            <input type="text" id="usernameinput" class="form-control" name="username"
                                wire:model.defer="username" placeholder="e.g. jdoe_crypto" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label f-w-600 f-13">Full Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name"
                                wire:model.defer="fullname" placeholder="e.g. John Doe" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label f-w-600 f-13">Email Address <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" name="email"
                                wire:model.defer="email" placeholder="e.g. john@example.com" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label f-w-600 f-13">Initial Password <span class="text-danger">*</span></label>
                            <input type="text" class="form-control font-monospace" name="password"
                                wire:model.defer="password" placeholder="Create secure password" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fa fa-check me-1"></i> Add User
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Trading History / ROI Modal -->
    <div wire:ignore.self id="TradingModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header">
                    <h5 class="modal-title f-w-700">
                        <i class="fa fa-coins text-info me-2"></i> Add ROI to Selected User(s)
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form role="form" method="post" wire:submit.prevent="addRoi">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label f-w-600 f-13">Select Investment Plan <span class="text-danger">*</span></label>
                            <select class="form-select" name="plan" wire:model.defer="plan" required>
                                <option value="">-- Choose Investment Plan --</option>
                                @foreach ($plans as $plan)
                                    <option value="{{ $plan->id }}">{{ $plan->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label f-w-600 f-13">Effective Date <span class="text-danger">*</span></label>
                            <input type="date" wire:model.defer="datecreated" class="form-control" required>
                        </div>
                        <div class="p-3 bg-light rounded-3 text-muted f-12">
                            <i class="fa fa-info-circle text-info me-1"></i>
                            The system will automatically calculate the ROI based on the selected users' active investment amounts and the ROI percentage configured in the plan settings.
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-info text-white px-4">
                            <i class="fa fa-check me-1"></i> Apply ROI
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Top Up Modal -->
    <div wire:ignore.self id="topupModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header">
                    <h5 class="modal-title f-w-700">
                        <i class="fa fa-credit-card text-warning me-2"></i> Credit / Debit Selected Account(s)
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" wire:submit.prevent="topup">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label f-w-600 f-13">Amount ({{ $settings->currency }}) <span class="text-danger">*</span></label>
                            <input class="form-control" placeholder="e.g. 500.00" type="number" step="any"
                                name="amount" wire:model.defer="topamount" required>
                            @if(!empty($topamount))
                                <small class="text-muted d-block mt-1">Entered: {{ $settings->currency }}{{ number_format((float)$topamount, 2) }}</small>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label class="form-label f-w-600 f-13">Destination Account Column <span class="text-danger">*</span></label>
                            <select class="form-select" wire:model.defer="topcolumn" name="type" required>
                                <option value="" selected disabled>-- Select Column --</option>
                                <option value="Bonus">Bonus</option>
                                <option value="balance">Account Balance</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label f-w-600 f-13">Operation Type <span class="text-danger">*</span></label>
                            <select class="form-select" wire:model.defer="toptype" name="t_type" required>
                                <option value="">-- Select Operation --</option>
                                <option value="Credit">Credit (Add Funds)</option>
                                <option value="Debit">Debit (Deduct Funds)</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fa fa-save me-1"></i> Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
