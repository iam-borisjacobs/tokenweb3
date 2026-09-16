@extends('layouts.app')

@section('styles')
    @parent
    <style>
        .payout-detail-box {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 16px 20px;
        }
        body.dark-only .payout-detail-box {
            background-color: #1a202c;
            border-color: rgba(255, 255, 255, 0.08);
        }
        .copy-btn-feedback {
            transition: all 0.2s ease;
        }
    </style>
@endsection

@section('content')
<div class="container-fluid">
    <x-danger-alert />
    <x-success-alert />

    <!-- Top Header -->
    <div class="row mb-4 align-items-center justify-content-between g-3">
        <div class="col-md-7">
            <div class="d-flex align-items-center gap-2 mb-1">
                <a href="{{ route('mwithdrawals') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3 py-1 f-12">
                    <i class="fa-solid fa-arrow-left me-1"></i> Back to Withdrawals
                </a>
                @if($withdrawal->status == 'Processed')
                    <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-1 rounded-pill f-12 f-w-600">
                        <i class="fa-solid fa-circle-check me-1"></i> Completed / Paid
                    </span>
                @else
                    <span class="badge bg-warning-subtle text-warning border border-warning-subtle px-3 py-1 rounded-pill f-12 f-w-600">
                        <i class="fa-solid fa-clock me-1"></i> Awaiting Processing
                    </span>
                @endif
            </div>
            <h3 class="f-w-800 text-dark mb-1">Review & Process Withdrawal</h3>
            <p class="text-muted mb-0 f-13">Verify client payout destination details and execute payment or refund.</p>
        </div>

        <div class="col-md-auto">
            <a href="{{ route('viewuser', $user->id) }}" class="btn btn-light rounded-pill px-3 py-2 f-12 f-w-600 shadow-sm">
                <i class="fa-solid fa-user me-1 text-primary"></i> View User Profile
            </a>
        </div>
    </div>

    <div class="row g-4 mb-5">
        <!-- Left Column: Client & Payout Details -->
        <div class="col-lg-7">
            <!-- Client Overview Card -->
            <div class="card p-4 shadow-sm border-0 mb-4 rounded-3">
                <div class="d-flex align-items-center justify-content-between pb-3 mb-3 border-bottom">
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 48px; height: 48px; background: rgba(99, 98, 231, 0.12); color: #6362e7; font-size: 20px; font-weight: 700;">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <div>
                            <h5 class="f-w-700 text-dark mb-0">{{ $user->name }}</h5>
                            <div class="text-muted f-12">{{ $user->email }}</div>
                        </div>
                    </div>
                    <div class="text-end">
                        <span class="text-muted f-11 d-block">Current Balance</span>
                        <span class="f-w-800 text-dark f-15">{{ $settings->currency }}{{ number_format($user->account_bal, 2) }}</span>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-sm-6">
                        <div class="payout-detail-box">
                            <span class="text-muted f-11 f-w-600 text-uppercase d-block mb-1">Requested Amount</span>
                            <h4 class="f-w-800 text-primary mb-0">{{ $settings->currency }}{{ number_format($withdrawal->amount, 2) }}</h4>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="payout-detail-box">
                            <span class="text-muted f-11 f-w-600 text-uppercase d-block mb-1">Deduction / Charges</span>
                            <h4 class="f-w-800 text-danger mb-0">
                                {{ $withdrawal->to_deduct ? $settings->currency . number_format($withdrawal->to_deduct, 2) : 'Free' }}
                            </h4>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="payout-detail-box">
                            <span class="text-muted f-11 f-w-600 text-uppercase d-block mb-1">Payout Method</span>
                            <div class="f-w-700 text-dark f-14 d-flex align-items-center gap-1">
                                <i class="fa-solid fa-credit-card text-primary me-1"></i> {{ $withdrawal->payment_mode }}
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="payout-detail-box">
                            <span class="text-muted f-11 f-w-600 text-uppercase d-block mb-1">Requested Date</span>
                            <div class="f-w-600 text-dark f-13">
                                {{ $withdrawal->created_at ? $withdrawal->created_at->format('M d, Y • h:i A') : 'N/A' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Destination Details Card -->
            <div class="card p-4 shadow-sm border-0 rounded-3">
                <div class="d-flex align-items-center justify-content-between pb-3 mb-3 border-bottom">
                    <h5 class="f-w-700 text-dark mb-0">
                        <i class="fa-solid fa-wallet text-primary me-2"></i> Payout Destination Details
                    </h5>
                    <span class="badge bg-light-primary text-primary rounded-pill px-3 py-1 f-11 f-w-600">
                        {{ $withdrawal->payment_mode }}
                    </span>
                </div>

                @php
                    $destAddress = '';
                @endphp

                @if(isset($method) && $method->defaultpay == 'yes')
                    @if ($withdrawal->payment_mode == 'Bitcoin')
                        @php $destAddress = $withdrawal->duser->btc_address ?? ''; @endphp
                        <div class="mb-3">
                            <label class="form-label f-w-600 f-12 text-muted">Bitcoin (BTC) Destination Address</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="fa-brands fa-bitcoin text-warning"></i></span>
                                <input type="text" class="form-control font-monospace" id="copyTargetAddr" value="{{ $destAddress }}" readonly>
                                <button class="btn btn-outline-secondary" type="button" onclick="copyAddressText('copyTargetAddr', this)">
                                    <i class="fa-regular fa-copy me-1"></i> Copy
                                </button>
                            </div>
                        </div>
                    @elseif($withdrawal->payment_mode == 'Ethereum')
                        @php $destAddress = $withdrawal->duser->eth_address ?? ''; @endphp
                        <div class="mb-3">
                            <label class="form-label f-w-600 f-12 text-muted">Ethereum (ETH) Destination Address</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="fa-brands fa-ethereum text-info"></i></span>
                                <input type="text" class="form-control font-monospace" id="copyTargetAddr" value="{{ $destAddress }}" readonly>
                                <button class="btn btn-outline-secondary" type="button" onclick="copyAddressText('copyTargetAddr', this)">
                                    <i class="fa-regular fa-copy me-1"></i> Copy
                                </button>
                            </div>
                        </div>
                    @elseif($withdrawal->payment_mode == 'Litecoin')
                        @php $destAddress = $withdrawal->duser->ltc_address ?? ''; @endphp
                        <div class="mb-3">
                            <label class="form-label f-w-600 f-12 text-muted">Litecoin (LTC) Destination Address</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="fa-solid fa-coins text-secondary"></i></span>
                                <input type="text" class="form-control font-monospace" id="copyTargetAddr" value="{{ $destAddress }}" readonly>
                                <button class="btn btn-outline-secondary" type="button" onclick="copyAddressText('copyTargetAddr', this)">
                                    <i class="fa-regular fa-copy me-1"></i> Copy
                                </button>
                            </div>
                        </div>
                    @elseif ($withdrawal->payment_mode == 'USDT')
                        @php $destAddress = $withdrawal->duser->usdt_address ?? ''; @endphp
                        <div class="mb-3">
                            <label class="form-label f-w-600 f-12 text-muted">USDT (TRC20/ERC20) Address</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="fa-solid fa-dollar-sign text-success"></i></span>
                                <input type="text" class="form-control font-monospace" id="copyTargetAddr" value="{{ $destAddress }}" readonly>
                                <button class="btn btn-outline-secondary" type="button" onclick="copyAddressText('copyTargetAddr', this)">
                                    <i class="fa-regular fa-copy me-1"></i> Copy
                                </button>
                            </div>
                        </div>
                    @elseif ($withdrawal->payment_mode == 'BUSD')
                        @php $destAddress = $withdrawal->paydetails ?? ''; @endphp
                        <div class="mb-3">
                            <label class="form-label f-w-600 f-12 text-muted">BUSD Destination Address</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="fa-solid fa-dollar-sign text-warning"></i></span>
                                <input type="text" class="form-control font-monospace" id="copyTargetAddr" value="{{ $destAddress }}" readonly>
                                <button class="btn btn-outline-secondary" type="button" onclick="copyAddressText('copyTargetAddr', this)">
                                    <i class="fa-regular fa-copy me-1"></i> Copy
                                </button>
                            </div>
                        </div>
                    @elseif($withdrawal->payment_mode == 'Bank Transfer')
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <tbody>
                                    <tr>
                                        <th class="table-light f-13" style="width: 35%;">Bank Name</th>
                                        <td class="f-w-600">{{ $withdrawal->duser->bank_name ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="table-light f-13">Account Name</th>
                                        <td class="f-w-600">{{ $withdrawal->duser->account_name ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="table-light f-13">Account Number</th>
                                        <td class="f-w-700 font-monospace">
                                            {{ $withdrawal->duser->account_number ?? 'N/A' }}
                                        </td>
                                    </tr>
                                    @if (!empty($withdrawal->duser->swift_code))
                                        <tr>
                                            <th class="table-light f-13">SWIFT / BIC Code</th>
                                            <td class="f-w-600 font-monospace">{{ $withdrawal->duser->swift_code }}</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    @endif
                @else
                    @php $destAddress = $withdrawal->paydetails ?? ''; @endphp
                    <div class="mb-3">
                        <label class="form-label f-w-600 f-12 text-muted">{{ $withdrawal->payment_mode }} Payment Details</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fa-solid fa-receipt text-primary"></i></span>
                            <input type="text" class="form-control font-monospace" id="copyTargetAddr" value="{{ $destAddress }}" readonly>
                            @if(!empty($destAddress))
                                <button class="btn btn-outline-secondary" type="button" onclick="copyAddressText('copyTargetAddr', this)">
                                    <i class="fa-regular fa-copy me-1"></i> Copy
                                </button>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Right Column: Decision / Action Panel -->
        <div class="col-lg-5">
            <div class="card p-4 shadow-sm border-0 rounded-3">
                <div class="d-flex align-items-center gap-2 pb-3 mb-3 border-bottom">
                    <span class="rounded-circle d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; background: rgba(99, 98, 231, 0.12); color: #6362e7;">
                        <i class="fa-solid fa-gavel"></i>
                    </span>
                    <h5 class="f-w-700 text-dark mb-0">Processing Decision</h5>
                </div>

                @if ($withdrawal->status == 'Processed')
                    <div class="text-center py-4">
                        <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 64px; height: 64px; background: rgba(16, 185, 129, 0.12); color: #10b981; font-size: 28px;">
                            <i class="fa-solid fa-check-double"></i>
                        </div>
                        <h5 class="f-w-700 text-dark mb-1">Withdrawal Completed</h5>
                        <p class="text-muted f-13 mb-3">
                            This withdrawal request has already been marked as paid and processed to the user's account.
                        </p>
                        <a href="{{ route('mwithdrawals') }}" class="btn btn-primary rounded-pill px-4 py-2 f-13 f-w-600 shadow-sm">
                            Return to Withdrawals
                        </a>
                    </div>
                @else
                    <form action="{{ route('pwithdrawal') }}" method="POST" id="processWithdrawalForm">
                        @csrf
                        <input type="hidden" name="id" value="{{ $withdrawal->id }}">

                        <div class="mb-4">
                            <label class="form-label f-w-600 f-13">Choose Action <span class="text-danger">*</span></label>
                            <select name="action" id="action" class="form-select form-control py-2 f-14 f-w-600" onchange="toggleActionFields(this.value)">
                                <option value="Paid">Mark as Paid (Complete Payout)</option>
                                <option value="Reject">Reject & Refund Request</option>
                            </select>
                            <small class="text-muted f-11 mt-1 d-block" id="actionHelperText">
                                Selecting "Paid" approves this transaction and notifies the client.
                            </small>
                        </div>

                        <!-- Reject Details (Only shown when action == 'Reject') -->
                        <div id="rejectSection" style="display: none;" class="p-3 bg-light rounded-3 mb-4 border border-warning-subtle">
                            <div class="mb-3">
                                <label class="form-label f-w-600 f-13 text-dark">Send Notification Email</label>
                                <div class="selectgroup w-100">
                                    <label class="selectgroup-item flex-fill text-center">
                                        <input type="radio" name="emailsend" id="dontsend" value="false" class="selectgroup-input" checked onchange="toggleRejectEmail(false)">
                                        <span class="selectgroup-button w-100">Don't Send Email</span>
                                    </label>
                                    <label class="selectgroup-item flex-fill text-center">
                                        <input type="radio" name="emailsend" id="sendemail" value="true" class="selectgroup-input" onchange="toggleRejectEmail(true)">
                                        <span class="selectgroup-button w-100">Send Email</span>
                                    </label>
                                </div>
                            </div>

                            <div id="emailFields" style="display: none;">
                                <div class="mb-3">
                                    <label class="form-label f-w-600 f-12 text-muted">Email Subject</label>
                                    <input type="text" name="subject" id="subject" class="form-control" placeholder="e.g. Withdrawal Request Rejected">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label f-w-600 f-12 text-muted">Reason for Rejection</label>
                                    <textarea class="form-control" rows="3" placeholder="Provide clear reason for rejection so the user can rectify..." name="reason" id="message"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid pt-2">
                            <button type="submit" class="btn btn-primary rounded-pill py-2 f-13 f-w-700 shadow-sm" id="btnSubmitWithdrawal">
                                <i class="fa-solid fa-check me-1"></i> Confirm & Process
                            </button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    function copyAddressText(elementId, btn) {
        var copyText = document.getElementById(elementId);
        if (!copyText || !copyText.value) return;

        navigator.clipboard.writeText(copyText.value).then(function() {
            var originalHtml = btn.innerHTML;
            btn.innerHTML = '<i class="fa-solid fa-check text-success me-1"></i> Copied!';
            btn.classList.add('btn-success', 'text-white');
            btn.classList.remove('btn-outline-secondary');
            setTimeout(function() {
                btn.innerHTML = originalHtml;
                btn.classList.remove('btn-success', 'text-white');
                btn.classList.add('btn-outline-secondary');
            }, 2000);
        }).catch(function(err) {
            console.error('Could not copy text: ', err);
        });
    }

    function toggleActionFields(val) {
        var rejectSection = document.getElementById('rejectSection');
        var helperText = document.getElementById('actionHelperText');
        var submitBtn = document.getElementById('btnSubmitWithdrawal');

        if (val === 'Reject') {
            rejectSection.style.display = 'block';
            helperText.innerText = 'Rejecting will decline this withdrawal and reverse funds if configured.';
            if (submitBtn) {
                submitBtn.className = 'btn btn-danger rounded-pill py-2 f-13 f-w-700 shadow-sm';
                submitBtn.innerHTML = '<i class="fa-solid fa-xmark me-1"></i> Reject & Refund';
            }
        } else {
            rejectSection.style.display = 'none';
            helperText.innerText = 'Selecting "Paid" approves this transaction and notifies the client.';
            if (submitBtn) {
                submitBtn.className = 'btn btn-primary rounded-pill py-2 f-13 f-w-700 shadow-sm';
                submitBtn.innerHTML = '<i class="fa-solid fa-check me-1"></i> Confirm & Process';
            }
            document.getElementById('dontsend').checked = true;
            toggleRejectEmail(false);
        }
    }

    function toggleRejectEmail(send) {
        var emailFields = document.getElementById('emailFields');
        var subject = document.getElementById('subject');
        var message = document.getElementById('message');

        if (send) {
            emailFields.style.display = 'block';
            subject.setAttribute('required', 'required');
            message.setAttribute('required', 'required');
        } else {
            emailFields.style.display = 'none';
            subject.removeAttribute('required');
            message.removeAttribute('required');
        }
    }
</script>
@endsection
