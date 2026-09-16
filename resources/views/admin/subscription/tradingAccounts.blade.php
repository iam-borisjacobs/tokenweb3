@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <x-danger-alert />
    <x-success-alert />

    <!-- Top Header -->
    <div class="row mb-4 align-items-center justify-content-between g-3">
        <div class="col-md-7">
            <h3 class="f-w-800 text-dark mb-1">
                <i class="fa-solid fa-satellite-dish text-primary me-2"></i> Connected Trading Accounts
            </h3>
            <p class="text-muted mb-0 f-13">MT4/MT5 client accounts connected to the Master Trading provider.</p>
        </div>
        <div class="col-md-auto d-flex align-items-center gap-2">
            <button class="btn btn-primary rounded-pill px-4 py-2 f-13 f-w-700 shadow-sm" data-bs-toggle="modal" data-bs-target="#addccount">
                <i class="fa-solid fa-plus me-1"></i> Add Account
            </button>
        </div>
    </div>

    <!-- Alert / Policy Banner -->
    <div class="alert alert-light border border-info-subtle shadow-sm rounded-3 p-3 mb-4 d-flex align-items-center gap-3">
        <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 40px; height: 40px; background: rgba(14, 165, 233, 0.12); color: #0284c7; font-size: 18px;">
            <i class="fa-solid fa-circle-info"></i>
        </div>
        <div class="f-13 text-muted">
            <strong class="text-dark">Connection Guidelines:</strong>
            Accounts not renewed within 10 days of expiration are automatically scheduled for removal. Un-deployed accounts will not execute trades even when CopyTrade is active.
        </div>
    </div>

    <!-- Navigation Tabs & Table Card -->
    <div class="card p-4 shadow-sm border-0 rounded-3 mb-5">
        <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-3 pb-3 mb-3 border-bottom">
            <ul class="nav nav-pills gap-1">
                <li class="nav-item">
                    <a href="{{ route('msubtrade') }}" class="nav-link rounded-pill px-3 py-2 f-13">
                        <i class="fa-solid fa-inbox me-1"></i> Submitted Accounts
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('tacnts') }}" class="nav-link active rounded-pill px-3 py-2 f-13 f-w-600">
                        <i class="fa-solid fa-link me-1"></i> Connected Accounts
                    </a>
                </li>
            </ul>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th class="f-12 f-w-700">Account ID</th>
                        <th class="f-12 f-w-700">Account Name</th>
                        <th class="f-12 f-w-700">Type / Server</th>
                        <th class="f-12 f-w-700">Credentials</th>
                        <th class="f-12 f-w-700">Duration</th>
                        <th class="f-12 f-w-700">Deployment</th>
                        <th class="f-12 f-w-700 text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data['data'] as $item)
                        <tr>
                            <td>
                                <span class="badge bg-light text-dark border font-monospace px-2 py-1 rounded-pill f-12">
                                    #{{ $item['login'] }}
                                </span>
                            </td>
                            <td>
                                <div class="f-w-700 text-dark f-14">{{ $item['account_name'] }}</div>
                            </td>
                            <td>
                                <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle rounded-pill px-2 py-1 f-11">
                                    {{ $item['account_type'] }}
                                </span>
                                <small class="text-muted d-block f-11 mt-1">{{ $item['server'] }}</small>
                            </td>
                            <td>
                                <div class="f-12 font-monospace text-muted">
                                    Pass: <span class="text-dark f-w-600">{{ $item['password'] }}</span>
                                </div>
                            </td>
                            <td>
                                <div class="f-12 text-muted">
                                    <div><i class="fa-solid fa-play f-10 text-success me-1"></i> {{ \Carbon\Carbon::parse($item['start_date'])->format('M d, Y') }}</div>
                                    @if (now()->greaterThanOrEqualTo(\Carbon\Carbon::parse($item['end_date'])))
                                        <div class="text-danger f-w-600">
                                            <i class="fa-solid fa-hourglass-end f-10 text-danger me-1"></i> Expired: {{ \Carbon\Carbon::parse($item['end_date'])->format('M d, Y') }}
                                        </div>
                                    @else
                                        <div><i class="fa-solid fa-flag-checkered f-10 text-muted me-1"></i> {{ \Carbon\Carbon::parse($item['end_date'])->format('M d, Y') }}</div>
                                    @endif
                                </div>
                            </td>
                            <td>
                                @if ($item['deployment_status'] == 'Deployed')
                                    <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2 py-1 f-11 f-w-600 mb-1 d-inline-block">
                                        <i class="fa-solid fa-circle-check me-1"></i> Deployed
                                    </span>
                                    <div>
                                        <a href="{{ route('acnt.deployment', ['id' => $item['id'], 'deployment' => 'Undeploy']) }}" class="btn btn-outline-warning btn-sm rounded-pill px-2 py-0 f-11">
                                            Undeploy
                                        </a>
                                    </div>
                                @else
                                    <span class="badge bg-warning-subtle text-warning border border-warning-subtle rounded-pill px-2 py-1 f-11 f-w-600 mb-1 d-inline-block">
                                        <i class="fa-solid fa-clock me-1"></i> Pending Deploy
                                    </span>
                                    @if (!now()->greaterThanOrEqualTo(\Carbon\Carbon::parse($item['end_date'])))
                                        <div>
                                            <a href="{{ route('acnt.deployment', ['id' => $item['id'], 'deployment' => 'Deploy']) }}" class="btn btn-outline-success btn-sm rounded-pill px-2 py-0 f-11">
                                                Deploy Now
                                            </a>
                                        </div>
                                    @endif
                                @endif
                            </td>
                            <td class="text-end">
                                <div class="d-flex align-items-center justify-content-end gap-1 flex-wrap">
                                    @if (now()->greaterThanOrEqualTo(\Carbon\Carbon::parse($item['end_date'])))
                                        <button class="btn btn-info btn-sm rounded-pill px-2 py-1 f-11 text-white" data-bs-target="#renewModal{{ $item['id'] }}" data-bs-toggle="modal">
                                            <i class="fa-solid fa-rotate me-1"></i> Renew
                                        </button>
                                    @endif

                                    @if (!$item['started_copy_trade'])
                                        <button class="btn btn-outline-primary btn-sm rounded-pill px-2 py-1 f-11" data-bs-toggle="modal" data-bs-target="#copytrade{{ $item['id'] }}">
                                            <i class="fa-solid fa-copy me-1"></i> CopyTrade
                                        </button>
                                        @include('admin.subscription.subscriber.copytrade')
                                    @else
                                        <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2 py-1 f-11" title="Provider: {{ $item['provider'] }}">
                                            <i class="fa-solid fa-circle-nodes me-1"></i> Copying ({{ Str::limit($item['provider'], 10) }})
                                        </span>
                                    @endif

                                    <button class="btn btn-outline-danger btn-sm rounded-pill px-2 py-1 f-11" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $item['id'] }}" title="Delete Account">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </div>

                                <!-- Unique Delete Modal per item -->
                                <div class="modal fade" id="deleteModal{{ $item['id'] }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-sm">
                                        <div class="modal-content border-0 shadow-lg text-center p-3">
                                            <div class="modal-body pt-4">
                                                <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 56px; height: 56px; background: rgba(239, 68, 68, 0.12); color: #ef4444; font-size: 24px;">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </div>
                                                <h5 class="f-w-700 text-dark mb-2">Delete Account?</h5>
                                                <p class="text-muted f-13 mb-4">
                                                    Are you sure you want to delete trading account <strong>#{{ $item['login'] }}</strong>?
                                                </p>
                                                <div class="d-flex gap-2">
                                                    <button type="button" class="btn btn-light rounded-pill w-100 py-2 f-13" data-bs-dismiss="modal">Cancel</button>
                                                    <a href="{{ route('del.sub', ['id' => $item['id']]) }}" class="btn btn-danger rounded-pill w-100 py-2 f-13 f-w-700">
                                                        Yes Delete
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Renew Modal -->
                                <div class="modal fade" id="renewModal{{ $item['id'] }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-sm">
                                        <div class="modal-content border-0 shadow-lg text-center p-3">
                                            <div class="modal-body pt-4">
                                                <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 56px; height: 56px; background: rgba(99, 98, 231, 0.12); color: #6362e7; font-size: 24px;">
                                                    <i class="fa-solid fa-rotate"></i>
                                                </div>
                                                <h5 class="f-w-700 text-dark mb-2">Renew Account</h5>
                                                <p class="text-muted f-13 mb-4">
                                                    You will be charged <strong>${{ $amountPerSlot }}</strong> to renew this trading account slot.
                                                </p>
                                                <form action="{{ route('renew.acnt') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="account_id" value="{{ $item['id'] }}">
                                                    <div class="d-flex gap-2">
                                                        <button type="button" class="btn btn-light rounded-pill w-100 py-2 f-13" data-bs-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-primary rounded-pill w-100 py-2 f-13 f-w-700">
                                                            Yes Proceed
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="fa-solid fa-server f-32 mb-2 d-block text-muted opacity-50"></i>
                                No connected trading accounts available. Click "Add Account" above to connect one.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Account Modal -->
<div class="modal fade" id="addccount" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header border-bottom pb-3">
                <h5 class="modal-title f-w-700 text-dark">
                    <i class="fa-solid fa-plus text-primary me-2"></i> Connect Trading Account
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form method="POST" action="{{ route('create.sub') }}">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label f-w-600 f-12">Login / MT4 ID <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="login" placeholder="e.g. 1029384" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label f-w-600 f-12">Account Password <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="password" placeholder="Account password" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label f-w-600 f-12">Account Name <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="name" placeholder="e.g. John's MT4" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label f-w-600 f-12">Server Name <span class="text-danger">*</span></label>
                            <input class="form-control" placeholder="e.g. HantecGlobal-Live" type="text" name="serverName" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label f-w-600 f-12">Account Type <span class="text-danger">*</span></label>
                            <input class="form-control" placeholder="e.g. Standard" type="text" name="acntype" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label f-w-600 f-12">Leverage <span class="text-danger">*</span></label>
                            <input class="form-control" placeholder="e.g. 1:500" type="text" name="leverage" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label f-w-600 f-12">Account Currency <span class="text-danger">*</span></label>
                            <input class="form-control" placeholder="e.g. USD" type="text" name="currency" required>
                        </div>
                    </div>
                    <div class="modal-footer border-top pt-3 mt-4 px-0 pb-0">
                        <button type="button" class="btn btn-light rounded-pill px-3 py-2 f-13" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary rounded-pill px-4 py-2 f-13 f-w-700 shadow-sm">
                            <i class="fa-solid fa-link me-1"></i> Connect Account
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
