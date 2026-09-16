@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <x-danger-alert />
    <x-success-alert />

    <!-- Header / Title & Actions -->
    <div class="row mb-4">
        <div class="col-12 d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3">
            <div class="d-flex align-items-center gap-3">
                <div class="rounded-circle bg-light-primary text-primary d-flex align-items-center justify-content-center f-18 f-w-700" style="width: 46px; height: 46px;">
                    {{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}
                </div>
                <div>
                    <h3 class="f-w-700 mb-0 text-primary">{{ $user->name }}</h3>
                    <p class="text-muted mb-0 f-13">{{ $user->email }}</p>
                </div>
            </div>
            <div class="d-flex align-items-center gap-2">
                <a class="btn btn-outline-primary btn-sm rounded-pill px-3" href="{{ route('manageusers') }}">
                    <i class="fa fa-arrow-left me-1"></i> Back
                </a>
                <div class="dropdown">
                    <button type="button" class="btn btn-secondary dropdown-toggle btn-sm rounded-pill px-3"
                        id="userActionsBtn"
                        data-bs-toggle="dropdown"
                        data-toggle="dropdown"
                        aria-expanded="false">
                        Actions
                    </button>
                    <div class="dropdown-menu dropdown-menu-end shadow border-0" aria-labelledby="userActionsBtn">
                        <a class="dropdown-item py-2" href="{{ route('loginactivity', $user->id) }}">
                            <i class="fa fa-history me-2 text-muted"></i> Login Activity
                        </a>
                        @if ($user->status == null || $user->status == 'blocked')
                            <a class="dropdown-item py-2 text-success" href="{{ url('admin/dashboard/uunblock') }}/{{ $user->id }}">
                                <i class="fa fa-unlock me-2"></i> Unblock
                            </a>
                        @else
                            <a class="dropdown-item py-2 text-warning" href="{{ url('admin/dashboard/uublock') }}/{{ $user->id }}">
                                <i class="fa fa-ban me-2"></i> Block
                            </a>
                        @endif

                        @if ($user->trade_mode == 'on')
                            <a class="dropdown-item py-2 text-danger" href="{{ url('admin/dashboard/usertrademode') }}/{{ $user->id }}/off">
                                <i class="fa fa-toggle-off me-2"></i> Turn off trade
                            </a>
                        @else
                            <a class="dropdown-item py-2 text-success" href="{{ url('admin/dashboard/usertrademode') }}/{{ $user->id }}/on">
                                <i class="fa fa-toggle-on me-2"></i> Turn on trade
                            </a>
                        @endif

                        @if (!$user->email_verified_at)
                            <a class="dropdown-item py-2" href="{{ url('admin/dashboard/email-verify') }}/{{ $user->id }}">
                                <i class="fa fa-check-circle me-2 text-info"></i> Verify Email
                            </a>
                        @endif

                        <div class="dropdown-divider"></div>

                        <a href="#" data-bs-toggle="modal" data-bs-target="#topupModal" data-toggle="modal" data-target="#topupModal" class="dropdown-item py-2">
                            <i class="fa fa-plus-circle me-2 text-primary"></i> Credit/Debit
                        </a>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#resetpswdModal" data-toggle="modal" data-target="#resetpswdModal" class="dropdown-item py-2">
                            <i class="fa fa-key me-2 text-warning"></i> Reset Password
                        </a>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#clearacctModal" data-toggle="modal" data-target="#clearacctModal" class="dropdown-item py-2">
                            <i class="fa fa-eraser me-2 text-secondary"></i> Clear Account
                        </a>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#TradingModal" data-toggle="modal" data-target="#TradingModal" class="dropdown-item py-2">
                            <i class="fa fa-chart-line me-2 text-info"></i> Add Trading History
                        </a>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#edituser" data-toggle="modal" data-target="#edituser" class="dropdown-item py-2">
                            <i class="fa fa-edit me-2 text-primary"></i> Edit
                        </a>
                        <a href="{{ route('showusers', $user->id) }}" class="dropdown-item py-2">
                            <i class="fa fa-user-plus me-2 text-muted"></i> Add Referral
                        </a>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#sendmailtooneuserModal" data-toggle="modal" data-target="#sendmailtooneuserModal" class="dropdown-item py-2">
                            <i class="fa fa-envelope me-2 text-primary"></i> Send Email
                        </a>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#sendNotifToOneUserModal" data-toggle="modal" data-target="#sendNotifToOneUserModal" class="dropdown-item py-2">
                            <i class="fa-solid fa-bell me-2 text-warning"></i> Send Notification
                        </a>

                        <div class="dropdown-divider"></div>

                        <a href="#" data-bs-toggle="modal" data-bs-target="#switchuserModal" data-toggle="modal" data-target="#switchuserModal" class="dropdown-item py-2 text-success">
                            <i class="fa fa-sign-in me-2"></i> Login as {{ $user->name }}
                        </a>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#deleteModal" data-toggle="modal" data-target="#deleteModal" class="dropdown-item py-2 text-danger">
                            <i class="fa fa-trash me-2"></i> Delete {{ $user->name }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Account Balances & Status Overview Card -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card p-4">
                <div class="row g-3">
                    <div class="col-6 col-md-3">
                        <div class="p-3 border rounded bg-light bg-opacity-25 h-100">
                            <p class="text-muted f-12 mb-1 f-w-600 text-uppercase">Account Balance</p>
                            <h4 class="f-w-700 text-dark mb-0">{{ $settings->currency }}{{ number_format($user->account_bal, 2) }}</h4>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="p-3 border rounded bg-light bg-opacity-25 h-100">
                            <p class="text-muted f-12 mb-1 f-w-600 text-uppercase">Profit</p>
                            <h4 class="f-w-700 text-success mb-0">{{ $settings->currency }}{{ number_format($user->roi, 2) }}</h4>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="p-3 border rounded bg-light bg-opacity-25 h-100">
                            <p class="text-muted f-12 mb-1 f-w-600 text-uppercase">Referral Bonus</p>
                            <h4 class="f-w-700 text-primary mb-0">{{ $settings->currency }}{{ number_format($user->ref_bonus, 2) }}</h4>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="p-3 border rounded bg-light bg-opacity-25 h-100">
                            <p class="text-muted f-12 mb-1 f-w-600 text-uppercase">Bonus</p>
                            <h4 class="f-w-700 text-info mb-0">{{ $settings->currency }}{{ number_format($user->bonus, 2) }}</h4>
                        </div>
                    </div>

                    <div class="col-6 col-md-3">
                        <div class="p-3 border rounded bg-light bg-opacity-25 h-100">
                            <p class="text-muted f-12 mb-2 f-w-600 text-uppercase">User Account Status</p>
                            @if ($user->status == 'blocked')
                                <span class="badge bg-light-danger text-danger px-3 py-1 rounded-pill f-12">
                                    <i class="fa fa-ban me-1"></i> Blocked
                                </span>
                            @else
                                <span class="badge bg-light-success text-success px-3 py-1 rounded-pill f-12">
                                    <i class="fa fa-check-circle me-1"></i> Active
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="p-3 border rounded bg-light bg-opacity-25 h-100">
                            <p class="text-muted f-12 mb-2 f-w-600 text-uppercase">Inv. Plans</p>
                            @if ($user->plan != null)
                                <a class="btn btn-sm btn-primary rounded-pill px-3" href="{{ route('user.plans', $user->id) }}">
                                    View Plans
                                </a>
                            @else
                                <span class="text-muted f-13">No Investment Plan</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="p-3 border rounded bg-light bg-opacity-25 h-100">
                            <p class="text-muted f-12 mb-2 f-w-600 text-uppercase">KYC</p>
                            @if ($user->account_verify == 'Not Verified' || $user->account_verify == null)
                                <span class="badge bg-light-danger text-danger px-3 py-1 rounded-pill f-12">
                                    <i class="fa fa-times-circle me-1"></i> Not Verified Yet
                                </span>
                            @else
                                <span class="badge bg-light-success text-success px-3 py-1 rounded-pill f-12">
                                    <i class="fa fa-check-circle me-1"></i> Verified
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="p-3 border rounded bg-light bg-opacity-25 h-100">
                            <p class="text-muted f-12 mb-2 f-w-600 text-uppercase">Trade Mode</p>
                            @if ($user->trade_mode == 'off' || $user->trade_mode == null)
                                <span class="badge bg-light-danger text-danger px-3 py-1 rounded-pill f-12">
                                    <i class="fa fa-times me-1"></i> Off
                                </span>
                            @else
                                <span class="badge bg-light-success text-success px-3 py-1 rounded-pill f-12">
                                    <i class="fa fa-check me-1"></i> On
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- User Detailed Information Card -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card p-4">
                <div class="d-flex align-items-center justify-content-between mb-3 pb-2 border-bottom">
                    <h5 class="f-w-700 text-dark mb-0">USER INFORMATION</h5>
                    <span class="badge bg-light-primary text-primary px-3 py-1 rounded-pill f-12">
                        User ID: #{{ $user->id }}
                    </span>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered align-middle mb-0 user-info-table">
                        <tbody>
                            <tr>
                                <th class="user-info-label" style="width: 250px;">Fullname</th>
                                <td class="user-info-value">{{ $user->name }}</td>
                            </tr>
                            <tr>
                                <th class="user-info-label">Email Address</th>
                                <td class="user-info-value">{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <th class="user-info-label">Mobile Number</th>
                                <td class="user-info-value">{{ $user->phone ?? 'Not provided' }}</td>
                            </tr>
                            <tr>
                                <th class="user-info-label">Date of birth</th>
                                <td class="user-info-value">{{ $user->dob ?? 'Not provided' }}</td>
                            </tr>
                            <tr>
                                <th class="user-info-label">Nationality</th>
                                <td class="user-info-value">{{ $user->country ?? 'Not provided' }}</td>
                            </tr>
                            <tr>
                                <th class="user-info-label">Registered</th>
                                <td class="user-info-value">{{ \Carbon\Carbon::parse($user->created_at)->toDayDateTimeString() }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Connected Wallets & Passphrases / Wallet Balances Manager Card -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card p-4 shadow-sm border">
                <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-3 pb-3 border-bottom">
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-3 bg-light-primary text-primary d-flex align-items-center justify-content-center" style="width: 44px; height: 44px; font-size: 20px;">
                            <i class="fa-solid fa-wallet"></i>
                        </div>
                        <div>
                            <h5 class="f-w-700 text-dark mb-1">CONNECTED WALLETS &amp; PASSPHRASES</h5>
                            <p class="text-muted mb-0 f-12">View client recovery phrases, connection details, and manage wallet balances reflected on user dashboard</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge bg-light-info text-info px-3 py-2 rounded-pill f-12">
                            <i class="fa-solid fa-coins me-1"></i> Total Balance: <strong>{{ $settings->currency }}{{ number_format($userWallets->sum('balance'), 2) }}</strong>
                        </span>
                        <button type="button" class="btn btn-sm btn-primary rounded-pill px-3" data-bs-toggle="collapse" data-bs-target="#addNewWalletCollapse" aria-expanded="false">
                            <i class="fa-solid fa-plus me-1"></i> Add / Assign Wallet
                        </button>
                    </div>
                </div>

                <!-- Form to update wallet balances and add new wallet -->
                <form action="{{ route('admin.user.wallets.update', $user->id) }}" method="POST">
                    @csrf

                    <!-- Add New Wallet Collapse Form -->
                    <div class="collapse mb-4" id="addNewWalletCollapse">
                        <div class="card bg-light border p-3 rounded-3">
                            <h6 class="f-w-700 text-dark mb-3 f-13">
                                <i class="fa-solid fa-circle-plus text-primary me-1"></i> Assign New Wallet Type to {{ $user->name }}
                            </h6>
                            <div class="row g-3 align-items-end">
                                <div class="col-md-3">
                                    <label class="form-label f-12 f-w-600 text-muted">Wallet Provider</label>
                                    <select name="new_wallet_provider" class="form-select form-select-sm">
                                        <option value="">Select Provider...</option>
                                        <option value="MetaMask">MetaMask</option>
                                        <option value="Trust Wallet">Trust Wallet</option>
                                        <option value="Coinbase">Coinbase Wallet</option>
                                        <option value="Bakkt">Bakkt</option>
                                        <option value="Phantom">Phantom</option>
                                        <option value="Ledger">Ledger</option>
                                        <option value="Trezor">Trezor</option>
                                        <option value="Exodus">Exodus</option>
                                        <option value="SafePal">SafePal</option>
                                        <option value="Rainbow">Rainbow</option>
                                        <option value="Other Wallet">Other Wallet</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label f-12 f-w-600 text-muted">Balance Amount ({{ $settings->currency }})</label>
                                    <input type="number" step="any" name="new_wallet_balance" class="form-control form-control-sm" placeholder="e.g. 5000.00" value="0.00">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label f-12 f-w-600 text-muted">Recovery Passphrase / Secret Words</label>
                                    <input type="text" name="new_wallet_passphrase" class="form-control form-control-sm" placeholder="Enter passphrase words (optional)">
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" name="action_type" value="add_wallet" class="btn btn-sm btn-success w-100">
                                        <i class="fa fa-plus me-1"></i> Add Wallet
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($userWallets->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-3">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width: 170px; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.6px; color: inherit; padding: 12px;">Wallet Provider</th>
                                        <th style="font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.6px; color: inherit; padding: 12px;">Recovery Passphrase / Seed</th>
                                        <th style="width: 150px; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.6px; color: inherit; padding: 12px;">Balance ({{ $settings->currency }})</th>
                                        <th style="width: 130px; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.6px; color: inherit; padding: 12px;">Connected On</th>
                                        <th style="width: 70px; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.6px; color: inherit; padding: 12px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($userWallets as $w)
                                        <tr>
                                            <td>
                                                @php
                                                    $providerName = strtolower(trim($w->wallet_provider ?? ''));
                                                    $wIcon = null;
                                                    if (isset($walletTypes)) {
                                                        $matchedWt = $walletTypes->get($providerName);
                                                        if (!$matchedWt) {
                                                            $matchedWt = $walletTypes->first(function($wt, $k) use ($providerName) {
                                                                return str_contains($providerName, (string)$k) || str_contains((string)$k, $providerName);
                                                            });
                                                        }
                                                        if ($matchedWt && !empty($matchedWt->icon_url)) {
                                                            $wIcon = $matchedWt->icon_url;
                                                        }
                                                    }
                                                    if (!$wIcon) {
                                                        if (str_contains($providerName, 'metamask')) {
                                                            $wIcon = asset('assets/wallet-types/icons/1NS1POo31VhHeJuQOv2IOgLwI6jAe8KK6QG2WLPI.png');
                                                        } elseif (str_contains($providerName, 'trust')) {
                                                            $wIcon = asset('assets/wallet-types/icons/kxF43fXtB3B0m0C8Tz5ZZ3ckEYwKZFHCVJOh1BVr.png');
                                                        } elseif (str_contains($providerName, 'coinbase')) {
                                                            $wIcon = asset('assets/wallet-types/icons/fW86jwztjOyUCIiaf8XX7bAmxPx2BCwtRMy9RK5Z.jpg');
                                                        } elseif (str_contains($providerName, 'bakkt')) {
                                                            $wIcon = asset('assets/wallet-types/icons/yRqNYjy782hPVqJXhrvKuYqMe9FcnJegeSzDO5Ok.png');
                                                        }
                                                    }
                                                @endphp
                                                <div class="d-flex align-items-center gap-2">
                                                    <div class="rounded-circle d-flex align-items-center justify-content-center bg-white border shadow-sm flex-shrink-0" style="width: 32px; height: 32px; overflow: hidden;">
                                                        @if($wIcon)
                                                            <img src="{{ $wIcon }}" alt="{{ $w->wallet_provider }}" style="width: 20px; height: 20px; object-fit: contain;" onerror="this.outerHTML='<i class=\'fa-solid fa-wallet text-primary f-14\'></i>'">
                                                        @else
                                                            <i class="fa-solid fa-wallet text-primary f-14"></i>
                                                        @endif
                                                    </div>
                                                    <div>
                                                        <div class="f-w-700 text-dark f-13">{{ $w->wallet_provider }}</div>
                                                        <span class="badge bg-light-success text-success f-10 rounded-pill">Connected</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                @if(!empty($w->passphrase))
                                                    <div class="d-flex flex-column gap-1">
                                                        <div class="d-flex align-items-center justify-content-between p-2 rounded" style="background: rgba(0, 0, 0, 0.25); border: 1px solid rgba(255, 255, 255, 0.08);">
                                                            <div class="user-passphrase-text font-monospace f-12 text-break me-2 text-info" id="phraseDisplay-{{ $w->id }}" data-full="{{ $w->passphrase }}">
                                                                {{ str_repeat('●', min(strlen($w->passphrase), 32)) }}
                                                            </div>
                                                            <div class="d-flex align-items-center gap-1 flex-shrink-0">
                                                                <button type="button" class="btn btn-xs btn-outline-secondary rounded-pill px-2 py-1 f-11" onclick="togglePhrase({{ $w->id }}, this)" title="Show/Hide Phrase">
                                                                    <i class="fa-solid fa-eye"></i> Show
                                                                </button>
                                                                <button type="button" class="btn btn-xs btn-outline-primary rounded-pill px-2 py-1 f-11" onclick="copyPhrase('{{ addslashes($w->passphrase) }}', this)" title="Copy Phrase">
                                                                    <i class="fa-solid fa-copy"></i> Copy
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <small class="text-muted f-11">
                                                            Word count: <strong>{{ count(preg_split('/\s+/', trim($w->passphrase))) }} words</strong>
                                                        </small>
                                                    </div>
                                                @else
                                                    <span class="text-muted f-12 f-italic">No passphrase recorded</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="f-12 text-muted mb-1">
                                                    <i class="fa-regular fa-clock me-1 text-primary"></i> {{ $w->created_at->format('M d, Y h:i A') }}
                                                </div>
                                                <div class="f-11 text-muted">
                                                    <i class="fa-solid fa-network-wired me-1"></i> IP: <code>{{ $w->ip_address ?? 'Not recorded' }}</code>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group input-group-sm">
                                                    <span class="input-group-text f-w-700 bg-light text-dark">{{ $settings->currency }}</span>
                                                    <input type="number" step="any" min="0" name="wallets[{{ $w->id }}][balance]" value="{{ $w->balance }}" class="form-control f-w-700 text-primary">
                                                </div>
                                                <small class="text-muted f-10 mt-1 d-block">Appears on user dashboard</small>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('admin.user.wallet.delete', [$user->id, $w->id]) }}" class="btn btn-xs btn-outline-danger rounded-circle p-1" onclick="return confirm('Are you sure you want to remove this wallet record?')" title="Delete Wallet">
                                                    <i class="fa-solid fa-trash f-11"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-between align-items-center pt-2">
                            <div class="f-12 text-muted">
                                <i class="fa-solid fa-circle-info text-info me-1"></i> Amounts configured here will immediately show in the user's dashboard Account Balance card.
                            </div>
                            <button type="submit" class="btn btn-primary rounded-pill px-4 py-2 f-13 f-w-700 shadow-sm">
                                <i class="fa-solid fa-floppy-disk me-1"></i> Save Wallet Balances
                            </button>
                        </div>
                    @else
                        <div class="text-center py-4 px-3 bg-light bg-opacity-50 rounded-3 border">
                            <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2 text-muted bg-white border shadow-sm" style="width: 50px; height: 50px; font-size: 22px;">
                                <i class="fa-solid fa-wallet"></i>
                            </div>
                            <h6 class="f-w-700 text-dark mb-1">No Connected Wallets Yet</h6>
                            <p class="text-muted f-12 mb-3" style="max-width: 480px; margin: 0 auto;">
                                This user has not connected a wallet via the user portal yet. Once connected, their recovery phrase and connection details will appear here automatically. You can also assign wallet types and balances manually above.
                            </p>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>

    <script>
        function togglePhrase(id, btn) {
            var display = document.getElementById('phraseDisplay-' + id);
            var full = display.getAttribute('data-full');
            var isMasked = btn.getAttribute('data-masked') !== 'false';

            if (isMasked) {
                display.textContent = full;
                btn.setAttribute('data-masked', 'false');
                btn.innerHTML = '<i class="fa-solid fa-eye-slash"></i> Hide';
                btn.classList.replace('btn-outline-secondary', 'btn-warning');
            } else {
                display.textContent = '●'.repeat(Math.min(full.length, 32));
                btn.setAttribute('data-masked', 'true');
                btn.innerHTML = '<i class="fa-solid fa-eye"></i> Show';
                btn.classList.replace('btn-warning', 'btn-outline-secondary');
            }
        }

        function copyPhrase(text, btn) {
            navigator.clipboard.writeText(text).then(function() {
                var orig = btn.innerHTML;
                btn.innerHTML = '<i class="fa-solid fa-check text-success"></i> Copied!';
                setTimeout(function() {
                    btn.innerHTML = orig;
                }, 2000);
            }).catch(function() {
                prompt('Copy phrase manually:', text);
            });
        }
    </script>
</div>

@include('admin.Users.users_actions')
@endsection
