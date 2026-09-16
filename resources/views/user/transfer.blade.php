@extends('layouts.dash')
@section('styles')
    @parent
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* Scoped theme typography tokens */
        .it-title {
            color: #0f172a !important;
        }
        body.dark-only .it-title {
            color: #ffffff !important;
        }

        .it-text {
            color: #334155 !important;
        }
        body.dark-only .it-text {
            color: #f1f5f9 !important;
        }

        .it-muted {
            color: #64748b !important;
        }
        body.dark-only .it-muted {
            color: #94a3b8 !important;
        }

        .it-card {
            background: #ffffff !important;
            border: 1px solid #e2e8f0 !important;
            border-radius: 16px !important;
            transition: all 0.2s ease;
        }
        body.dark-only .it-card {
            background: #151c2c !important;
            border: 1px solid #242f48 !important;
        }

        .it-inner-card {
            background: #f8fafc !important;
            border: 1px solid #e2e8f0 !important;
            border-radius: 12px !important;
        }
        body.dark-only .it-inner-card {
            background: #0d1322 !important;
            border: 1px solid #1e293b !important;
        }

        /* Preset buttons */
        .btn-preset-transfer {
            background: #f1f5f9;
            color: #1e293b !important;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            padding: 6px 14px;
            transition: all 0.15s ease;
            cursor: pointer;
        }
        body.dark-only .btn-preset-transfer {
            background: #1e293b;
            color: #f8fafc !important;
            border-color: #334155;
        }
        .btn-preset-transfer:hover {
            background: #6362e7 !important;
            color: #ffffff !important;
            border-color: #6362e7 !important;
            transform: translateY(-1px);
        }

        /* Inputs */
        .transfer-input {
            height: 48px;
            border-radius: 10px;
            font-size: 14.5px;
            border: 1.5px solid #cbd5e1;
            background: #ffffff;
            color: #0f172a;
            padding-left: 14px;
            transition: all 0.2s ease;
        }
        body.dark-only .transfer-input {
            background: #0f172a;
            border-color: #2a3854;
            color: #ffffff;
        }
        .transfer-input:focus {
            border-color: #6362e7;
            box-shadow: 0 0 0 3px rgba(99, 98, 231, 0.15);
            background: #ffffff;
            color: #0f172a;
        }
        body.dark-only .transfer-input:focus {
            background: #0f172a;
            color: #ffffff;
            border-color: #6362e7;
        }

        .input-group-addon-custom {
            background: #f1f5f9;
            border: 1.5px solid #cbd5e1;
            border-right: none;
            border-top-left-radius: 10px;
            border-bottom-left-radius: 10px;
            color: #64748b;
            font-weight: 600;
            font-size: 13.5px;
            padding: 0 16px;
            display: flex;
            align-items: center;
        }
        body.dark-only .input-group-addon-custom {
            background: #1e293b;
            border-color: #2a3854;
            color: #94a3b8;
        }

        /* Submit Button */
        .btn-transfer-submit {
            background: #6362e7 !important;
            border-color: #6362e7 !important;
            color: #ffffff !important;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 700;
            letter-spacing: 0.01em;
            padding: 14px;
            transition: all 0.2s ease;
        }
        .btn-transfer-submit:hover:not(:disabled) {
            background: #4f46e5 !important;
            border-color: #4f46e5 !important;
            box-shadow: 0 8px 20px rgba(99, 98, 231, 0.35);
            transform: translateY(-1px);
        }
    </style>
@endsection

@section('title', $title)

@section('content')
<div class="container-fluid px-0 px-md-3">
    <!-- Page Header -->
    <div class="row align-items-center justify-content-between mb-4 mt-2">
        <div class="col-12 col-md-7 mb-3 mb-md-0">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent p-0 mb-1" style="font-size: 12.5px;">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="it-muted text-decoration-none">Dashboard</a></li>
                    <li class="breadcrumb-item"><span class="it-muted">Wallet & Funds</span></li>
                    <li class="breadcrumb-item active text-primary font-weight-600" aria-current="page">Transfer Funds</li>
                </ol>
            </nav>
            <h4 class="it-title font-weight-bold mb-1" style="font-size: 22px; letter-spacing: -0.02em;">Internal P2P Fund Transfer</h4>
            <p class="it-muted mb-0" style="font-size: 13.5px;">Instant, zero-friction capital transfer to another ECX account holder with zero network delay.</p>
        </div>
        <div class="col-12 col-md-auto">
            <div class="d-flex align-items-center p-2 px-3 rounded-pill shadow-sm" style="background: rgba(99, 98, 231, 0.08); border: 1px solid rgba(99, 98, 231, 0.22);">
                <div class="mr-2 text-primary d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; border-radius: 50%; background: rgba(99, 98, 231, 0.18);">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="2" y="4" width="20" height="16" rx="2"></rect>
                        <line x1="2" y1="10" x2="22" y2="10"></line>
                    </svg>
                </div>
                <div>
                    <div class="text-uppercase font-weight-bold" style="font-size: 10px; letter-spacing: 0.06em; color: #6362e7;">Available Balance</div>
                    <div class="it-title font-weight-bold" style="font-size: 16px; line-height: 1.1;">{{ $settings->currency }}{{ number_format(Auth::user()->account_bal, 2, '.', ',') }}</div>
                </div>
            </div>
        </div>
    </div>

    <x-danger-alert />
    <x-success-alert />

    <!-- Main Content Grid -->
    <div class="row">
        <!-- Transfer Form Terminal (Left Column) -->
        <div class="col-12 col-lg-8 mb-4">
            <div class="it-card p-4 p-md-5 shadow-sm">
                <!-- Terminal Header Badge -->
                <div class="d-flex align-items-center justify-content-between pb-3 mb-4" style="border-bottom: 1px solid rgba(148, 163, 184, 0.2);">
                    <div class="d-flex align-items-center">
                        <div class="d-inline-flex align-items-center justify-content-center mr-2 rounded-circle" style="width: 32px; height: 32px; background: rgba(99, 98, 231, 0.12); color: #6362e7;">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="22" y1="2" x2="11" y2="13"></line>
                                <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                            </svg>
                        </div>
                        <div>
                            <h5 class="it-title font-weight-bold mb-0" style="font-size: 16px;">Direct Account Transfer</h5>
                            <span class="it-muted" style="font-size: 12px;">P2P Instant Ledger Settlement</span>
                        </div>
                    </div>
                    <span class="badge badge-success px-2 py-1 font-weight-600" style="font-size: 11px; letter-spacing: 0.03em;">
                        <span class="d-inline-block rounded-circle bg-white mr-1" style="width: 5px; height: 5px; vertical-align: middle;"></span>INSTANT DISPATCH
                    </span>
                </div>

                <form method="post" action="javascript:void(0)" id="transferform">
                    @csrf

                    <!-- Step 1: Recipient Identifier -->
                    <div class="form-group mb-4">
                        <label class="it-title font-weight-600 mb-2 d-flex align-items-center justify-content-between" style="font-size: 13.5px;">
                            <span>Recipient Identifier <span class="text-danger">*</span></span>
                            <span class="it-muted font-weight-normal" style="font-size: 12px;">Email or Username</span>
                        </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-addon-custom">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                </span>
                            </div>
                            <input type="text" name="email" id="recipient_email" class="form-control transfer-input" placeholder="e.g. username or trader@example.com" required autocomplete="off" style="border-top-left-radius: 0; border-bottom-left-radius: 0;">
                        </div>
                        <small class="it-muted d-block mt-1" style="font-size: 12px;">Enter the exact registered ECX Groups username or email address of the receiver.</small>
                    </div>

                    <!-- Step 2: Transfer Amount -->
                    <div class="form-group mb-4">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <label class="it-title font-weight-600 mb-0" style="font-size: 13.5px;">
                                Amount to Send <span class="text-danger">*</span>
                            </label>
                            <span class="it-muted" style="font-size: 12.5px;">
                                Available: <strong class="text-success">{{ $settings->currency }}{{ number_format(Auth::user()->account_bal, 2, '.', ',') }}</strong>
                            </span>
                        </div>

                        <!-- Quick Presets -->
                        <div class="d-flex flex-wrap gap-2 mb-2">
                            <button type="button" class="btn-preset-transfer mr-2 mb-2" onclick="setTransferAmount(50)">$50</button>
                            <button type="button" class="btn-preset-transfer mr-2 mb-2" onclick="setTransferAmount(100)">$100</button>
                            <button type="button" class="btn-preset-transfer mr-2 mb-2" onclick="setTransferAmount(250)">$250</button>
                            <button type="button" class="btn-preset-transfer mr-2 mb-2" onclick="setTransferAmount(500)">$500</button>
                            <button type="button" class="btn-preset-transfer mr-2 mb-2" onclick="setTransferAmount(1000)">$1,000</button>
                            <button type="button" class="btn-preset-transfer mr-2 mb-2" onclick="setTransferAmount('max')" style="background: rgba(99, 98, 231, 0.15); color: #6362e7 !important; border-color: rgba(99, 98, 231, 0.3);">MAX</button>
                        </div>

                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-addon-custom">{{ $settings->currency }} USD</span>
                            </div>
                            <input type="number" step="any" min="{{ $moresettings->min_transfer ?? 5 }}" name="amount" id="transfer_amount" placeholder="0.00" class="form-control transfer-input" required style="border-top-left-radius: 0; border-bottom-left-radius: 0; font-weight: 700; font-size: 16px;">
                        </div>
                        <div class="d-flex justify-content-between it-muted mt-1" style="font-size: 12px;">
                            <span>Minimum Transfer: {{ $settings->currency }}{{ number_format($moresettings->min_transfer ?? 5, 2) }}</span>
                            <span>Fee Rate: <strong class="text-info">{{ $moresettings->transfer_charges }}%</strong></span>
                        </div>
                    </div>

                    <!-- Live Breakdown Widget -->
                    <div class="it-inner-card p-3 mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-2" style="font-size: 13px;">
                            <span class="it-muted">Principal Transfer Amount:</span>
                            <span class="it-title font-weight-600" id="calc_principal">$0.00</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-2" style="font-size: 13px;">
                            <span class="it-muted">Transfer Fee ({{ $moresettings->transfer_charges }}%):</span>
                            <span class="text-danger font-weight-600" id="calc_fee">$0.00</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center pt-2" style="border-top: 1px dashed rgba(148, 163, 184, 0.3); font-size: 14px;">
                            <span class="it-title font-weight-bold">Total Deducted from Balance:</span>
                            <span class="text-primary font-weight-bold" style="font-size: 16px;" id="calc_total">$0.00</span>
                        </div>
                    </div>

                    <!-- Hidden Password input used by SweetAlert -->
                    <input type="hidden" name="password" id="acntpass">

                    <!-- Submit CTA -->
                    <button type="submit" id="subbtn" class="btn btn-transfer-submit btn-block w-100 shadow-sm">
                        <span>Proceed to Transfer</span>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="ml-1" style="vertical-align: -2px;">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </button>

                    <div class="text-center mt-3 it-muted" style="font-size: 12.5px;">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" class="mr-1" style="vertical-align: -2px;">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                            <polyline points="9 12 11 14 15 10"></polyline>
                        </svg>
                        Multi-factor password authorization required on next step.
                    </div>
                </form>
            </div>
        </div>

        <!-- Right Column: Protocol Guidelines & Activity -->
        <div class="col-12 col-lg-4">
            <!-- Balance & Limits Summary -->
            <div class="it-card p-4 mb-4 shadow-sm">
                <h6 class="it-title font-weight-bold mb-3 d-flex align-items-center" style="font-size: 14.5px;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#6362e7" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="16" x2="12" y2="12"></line>
                        <line x1="12" y1="8" x2="12.01" y2="8"></line>
                    </svg>
                    Transfer Parameters
                </h6>

                <div class="mb-3">
                    <div class="d-flex justify-content-between mb-2" style="font-size: 13px;">
                        <span class="it-muted">Minimum Transfer</span>
                        <span class="it-title font-weight-bold">{{ $settings->currency }}{{ number_format($moresettings->min_transfer ?? 5, 2) }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2" style="font-size: 13px;">
                        <span class="it-muted">Network / Transfer Fee</span>
                        <span class="it-title font-weight-bold">{{ $moresettings->transfer_charges }}%</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2" style="font-size: 13px;">
                        <span class="it-muted">Settlement Time</span>
                        <span class="text-success font-weight-bold">Instant (< 1s)</span>
                    </div>
                    <div class="d-flex justify-content-between" style="font-size: 13px;">
                        <span class="it-muted">Routing Method</span>
                        <span class="it-title font-weight-bold">Internal Ledger</span>
                    </div>
                </div>
            </div>

            <!-- Transfer Rules & Security Assurance -->
            <div class="it-card p-4 mb-4 shadow-sm">
                <h6 class="it-title font-weight-bold mb-3 d-flex align-items-center" style="font-size: 14.5px;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                    </svg>
                    Safety & Execution Rules
                </h6>

                <div class="mb-3 d-flex align-items-start" style="font-size: 13px;">
                    <div class="text-success mr-2 mt-1">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                    </div>
                    <div class="it-text">
                        <strong>Instant Ledger Credit:</strong> Receiver gets immediate access to the funds with no confirmation blocks.
                    </div>
                </div>

                <div class="mb-3 d-flex align-items-start" style="font-size: 13px;">
                    <div class="text-success mr-2 mt-1">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                    </div>
                    <div class="it-text">
                        <strong>Irreversible Execution:</strong> Please verify the username or email carefully; internal P2P transfers cannot be reversed once processed.
                    </div>
                </div>

                <div class="d-flex align-items-start" style="font-size: 13px;">
                    <div class="text-success mr-2 mt-1">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                    </div>
                    <div class="it-text">
                        <strong>Multi-Factor Security:</strong> You will be prompted to enter your account password before any funds are moved.
                    </div>
                </div>
            </div>

            <!-- Quick Action Shortcut -->
            <div class="it-card p-4 shadow-sm text-center">
                <div class="it-title font-weight-bold mb-1" style="font-size: 14px;">Recent Account Statements</div>
                <p class="it-muted mb-3" style="font-size: 12.5px;">Track your complete transaction history, deposit logs, and previous transfers.</p>
                <a href="{{ route('accounthistory') }}" class="btn btn-outline-primary btn-sm btn-block w-100 py-2 font-weight-600" style="border-radius: 8px;">
                    <i class="mdi mdi-history mr-1"></i>View Transaction History
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    @parent
    <script>
        // Preset amount buttons
        function setTransferAmount(val) {
            var bal = {{ Auth::user()->account_bal }};
            if (val === 'max') {
                $('#transfer_amount').val(bal).trigger('input');
            } else {
                $('#transfer_amount').val(val).trigger('input');
            }
        }

        // Live calculation of fee and total
        $('#transfer_amount').on('input', function() {
            var amt = parseFloat($(this).val()) || 0;
            var rate = {{ $moresettings->transfer_charges ?? 0 }};
            var fee = amt * rate / 100;
            var total = amt + fee;
            $('#calc_principal').text('$' + amt.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
            $('#calc_fee').text('$' + fee.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
            $('#calc_total').text('$' + total.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
        });

        // Submit and password verification
        $('#transferform').on('submit', function(e) {
            e.preventDefault();
            (async () => {
                const { value: password } = await Swal.fire({
                    title: 'Security Verification',
                    input: 'password',
                    inputLabel: 'Enter your account password to authorize transfer',
                    inputPlaceholder: 'Enter your password',
                    showCancelButton: true,
                    confirmButtonColor: '#6362e7',
                    cancelButtonColor: '#94a3b8',
                    confirmButtonText: 'Authorize & Transfer',
                    cancelButtonText: 'Cancel',
                    inputAttributes: {
                        autocapitalize: 'off',
                        autocorrect: 'off'
                    },
                    customClass: {
                        popup: 'rounded-16 shadow-lg'
                    }
                });

                if (password) {
                    document.getElementById('acntpass').value = password;
                    $("#subbtn").attr("disabled", "disabled").html('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>Processing Transfer...');
                    $.ajax({
                        url: "{{ route('transfertouser') }}",
                        type: 'POST',
                        data: $('#transferform').serialize(),
                        success: function(response) {
                            if (response.status === 200) {
                                Swal.fire({
                                    title: 'Transfer Completed!',
                                    text: response.message,
                                    icon: 'success',
                                    confirmButtonColor: '#6362e7',
                                    confirmButtonText: 'Done'
                                });
                                $("#subbtn").removeAttr("disabled").html('Proceed to Transfer <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="ml-1" style="vertical-align: -2px;"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>');
                                setTimeout(() => {
                                    let url = "{{ url('/dashboard/transfer-funds') }}";
                                    window.location.href = url;
                                }, 2500);
                            } else {
                                $("#subbtn").removeAttr("disabled").html('Proceed to Transfer <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="ml-1" style="vertical-align: -2px;"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>');
                                Swal.fire({
                                    title: 'Transfer Failed',
                                    text: response.message,
                                    icon: 'error',
                                    confirmButtonColor: '#dc2626'
                                });
                            }
                        },
                        error: function(error) {
                            console.log(error);
                            $("#subbtn").removeAttr("disabled").html('Proceed to Transfer <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="ml-1" style="vertical-align: -2px;"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>');
                            Swal.fire({
                                title: 'System Error',
                                text: 'An unexpected error occurred while communicating with the server.',
                                icon: 'error',
                                confirmButtonColor: '#dc2626'
                            });
                        },
                    });
                } else if (password === '') {
                    Swal.fire({
                        title: 'Password Required',
                        text: 'Account password is required to authorize the transfer.',
                        icon: 'warning',
                        confirmButtonColor: '#6362e7'
                    });
                }
            })();
        });
    </script>
@endsection
