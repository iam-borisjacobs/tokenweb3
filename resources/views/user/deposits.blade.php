@extends('layouts.dash')
@section('title', $title ?? 'Deposit Funds')

@section('content')
    <!-- Scoped Theme Tokens & Styling -->
    <style>
        .deposits-view .it-title {
            color: #0f172a !important;
            transition: color 0.2s ease;
        }
        body.dark-only .deposits-view .it-title {
            color: #ffffff !important;
        }

        .deposits-view .it-text {
            color: #334155 !important;
            transition: color 0.2s ease;
        }
        body.dark-only .deposits-view .it-text {
            color: #f1f5f9 !important;
        }

        .deposits-view .it-muted {
            color: #64748b !important;
            transition: color 0.2s ease;
        }
        body.dark-only .deposits-view .it-muted {
            color: #94a3b8 !important;
        }

        .deposits-view .step-pill {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.5px;
            padding: 3px 8px;
            border-radius: 6px;
            text-transform: uppercase;
        }

        .deposits-view .terminal-card {
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            transition: all 0.25s ease;
        }
        body.dark-only .deposits-view .terminal-card {
            background-color: #1a2238;
            border-color: rgba(255, 255, 255, 0.08);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }

        .deposits-view .method-select-card {
            background-color: #f8fafc;
            border: 1.5px solid #e2e8f0;
            border-radius: 12px;
            padding: 16px 18px;
            cursor: pointer;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .deposits-view .method-select-card:hover {
            transform: translateY(-2px);
            border-color: #6362e7;
            box-shadow: 0 6px 16px rgba(99, 98, 231, 0.12);
        }
        .deposits-view .method-select-card.active {
            background-color: rgba(99, 98, 231, 0.05);
            border-color: #6362e7;
            box-shadow: 0 0 0 1px #6362e7, 0 6px 16px rgba(99, 98, 231, 0.15);
        }
        body.dark-only .deposits-view .method-select-card {
            background-color: #151c30;
            border-color: rgba(255, 255, 255, 0.08);
        }
        body.dark-only .deposits-view .method-select-card:hover {
            border-color: rgba(99, 98, 231, 0.6);
            background-color: #182038;
        }
        body.dark-only .deposits-view .method-select-card.active {
            background-color: rgba(99, 98, 231, 0.12);
            border-color: #6362e7;
            box-shadow: 0 0 0 1px #6362e7, 0 6px 20px rgba(99, 98, 231, 0.2);
        }

        .deposits-view .quick-deposit-btn {
            background-color: #f1f5f9;
            color: #334155;
            border: 1.5px solid #cbd5e1;
            border-radius: 8px;
            padding: 6px 14px;
            font-size: 13px;
            font-weight: 600;
            transition: all 0.2s ease;
        }
        .deposits-view .quick-deposit-btn:hover {
            background-color: #e2e8f0;
            color: #0f172a;
            border-color: #94a3b8;
            transform: translateY(-1px);
        }
        body.dark-only .deposits-view .quick-deposit-btn {
            background-color: #151c30;
            color: #cbd5e1;
            border-color: rgba(255, 255, 255, 0.1);
        }
        body.dark-only .deposits-view .quick-deposit-btn:hover {
            background-color: #1d263f;
            color: #ffffff;
            border-color: rgba(99, 98, 231, 0.4);
        }

        .deposits-view .custom-deposit-input {
            height: 52px;
            font-size: 1.25rem;
            font-weight: 700;
            border-radius: 0 10px 10px 0;
            background-color: #ffffff;
            color: #0f172a;
            border: 1.5px solid #cbd5e1;
            padding-left: 14px;
        }
        body.dark-only .deposits-view .custom-deposit-input {
            background-color: #121829;
            color: #ffffff;
            border-color: rgba(255, 255, 255, 0.14);
        }
        .deposits-view .custom-deposit-input:focus {
            border-color: #6362e7;
            box-shadow: 0 0 0 3px rgba(99, 98, 231, 0.25);
        }

        .deposits-view .input-currency-addon {
            background-color: #f1f5f9;
            color: #475569;
            border: 1.5px solid #cbd5e1;
            border-right: none;
            border-radius: 10px 0 0 10px;
            font-weight: 700;
            font-size: 1rem;
            padding: 0 16px;
        }
        body.dark-only .deposits-view .input-currency-addon {
            background-color: #1d253d;
            color: #a5b4fc;
            border-color: rgba(255, 255, 255, 0.14);
        }

        .deposits-view .sticky-summary {
            position: sticky;
            top: 85px;
            z-index: 10;
        }

        .deposits-view .info-box {
            background: rgba(99, 98, 231, 0.06);
            border: 1px solid rgba(99, 98, 231, 0.2);
            border-radius: 10px;
            padding: 14px 16px;
        }
        body.dark-only .deposits-view .info-box {
            background: rgba(99, 98, 231, 0.12);
            border-color: rgba(99, 98, 231, 0.25);
        }
    </style>

    <div class="deposits-view">
        <!-- Page Header -->
        <div class="page-title mb-4">
            <div class="row align-items-center justify-content-between g-3">
                <div class="col-md-7">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-1 p-0 bg-transparent f-12">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="it-muted text-decoration-none">Dashboard</a></li>
                            <li class="breadcrumb-item it-muted">Wallet & Funds</li>
                            <li class="breadcrumb-item active text-primary" aria-current="page">Deposit Funds</li>
                        </ol>
                    </nav>
                    <h4 class="mb-1 it-title f-w-700">Fund Your Account Balance</h4>
                    <p class="mb-0 it-muted f-13">Instantly fund your account using fast, decentralized cryptocurrency payment gateways.</p>
                </div>
                <div class="col-md-5">
                    <div class="d-flex align-items-center justify-content-md-end gap-2 flex-wrap">
                        <!-- Available Balance Chip -->
                        <div class="d-inline-flex align-items-center gap-2 px-3 py-2 rounded-3 terminal-card">
                            <div class="metric-icon-circle primary" style="width: 30px; height: 30px; font-size: 13px;">
                                <i class="fa-solid fa-wallet"></i>
                            </div>
                            <div class="text-start">
                                <span class="d-block it-muted f-10 text-uppercase f-w-600" style="letter-spacing: 0.5px;">Account Balance</span>
                                <span class="d-block it-title f-13 f-w-700">{{ $settings->currency }}{{ number_format(Auth::user()->account_bal, 2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <x-danger-alert />
        <x-success-alert />

        <div class="row g-4">
            <!-- Left Column: Deposit Form -->
            <div class="col-xl-8 col-lg-7">
                <div class="terminal-card p-4 mb-4">
                    <form action="javascript:;" method="post" id="submitpaymentform">
                        @csrf
                        <input type="hidden" name="payment_method" id="paymethod">
                        <input type="hidden" id="lastchosen" value="0">

                        <!-- STEP 1: Enter Capital Amount -->
                        <div class="section-block mb-4 pb-4 border-bottom border-light-subtle">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <div class="d-flex align-items-center gap-2">
                                    <span class="step-pill bg-primary-subtle text-primary border border-primary-subtle">Step 1</span>
                                    <h6 class="mb-0 it-title f-w-700 f-15">Enter Deposit Amount</h6>
                                </div>
                                <span class="it-muted f-12">Min Deposit: <strong class="it-title">{{ $settings->currency }}{{ number_format($moresettings->minamt ?? 10) }}</strong></span>
                            </div>
                            <p class="it-muted f-12 mb-3">Choose a quick preset or enter your custom deposit amount.</p>

                            <!-- Quick Deposit Presets -->
                            <div class="d-flex flex-wrap gap-2 mb-3">
                                @foreach ([100, 250, 500, 1000, 2500, 5000, 10000] as $preset)
                                    <button type="button" class="quick-deposit-btn" onclick="setDepositAmount({{ $preset }})">
                                        {{ $settings->currency }}{{ number_format($preset) }}
                                    </button>
                                @endforeach
                            </div>

                            <!-- Custom Amount Input -->
                            <div class="input-group">
                                <span class="input-group-text input-currency-addon">
                                    <i class="fa-solid fa-dollar-sign me-1"></i>USD
                                </span>
                                <input class="form-control custom-deposit-input"
                                       placeholder="Enter amount (e.g. 1000)"
                                       min="{{ $moresettings->minamt }}"
                                       type="number"
                                       name="amount"
                                       id="depositAmountInput"
                                       required>
                            </div>
                        </div>

                        <!-- STEP 2: Choose Payment Gateway -->
                        <div class="section-block mb-4">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="d-flex align-items-center gap-2">
                                    <span class="step-pill bg-primary-subtle text-primary border border-primary-subtle">Step 2</span>
                                    <h6 class="mb-0 it-title f-w-700 f-15">Choose Payment Gateway</h6>
                                </div>
                                <span class="badge bg-secondary-subtle it-muted rounded-pill f-11">
                                    {{ count($dmethods) }} Channels Active
                                </span>
                            </div>

                            <div class="row g-3">
                                @forelse ($dmethods as $method)
                                    <div class="col-md-6 col-12">
                                        <a style="cursor: pointer;" data-method="{{ $method->name }}"
                                           id="{{ $method->id }}" class="text-decoration-none d-block h-100"
                                           onclick="checkpamethd(this.id)">
                                            <div class="method-select-card h-100" id="method-card-{{ $method->id }}">
                                                <div class="d-flex align-items-center gap-3">
                                                    @if (!empty($method->img_url))
                                                        <img src="{{ $method->img_url }}" alt="{{ $method->name }}"
                                                             style="width: 32px; height: 32px; object-fit: contain;">
                                                    @else
                                                        <div class="metric-icon-circle primary" style="width: 32px; height: 32px; font-size: 14px;">
                                                            <i class="fa-brands fa-bitcoin"></i>
                                                        </div>
                                                    @endif
                                                    <div>
                                                        <h6 class="mb-0 it-title f-w-700 f-14">{{ $method->name }}</h6>
                                                        <span class="it-muted f-11 d-block"><i class="fa-solid fa-bolt text-warning me-1"></i>Instant Confirmation</span>
                                                    </div>
                                                </div>
                                                <div>
                                                    <input type="radio" id="{{ $method->id }}customCheck1" name="methodRadio" class="form-check-input" style="cursor: pointer;" readonly>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @empty
                                    <div class="col-12">
                                        <div class="p-4 rounded-3 text-center bg-card-header border">
                                            <p class="it-muted mb-0">No payment methods currently enabled. Please contact support for assistance.</p>
                                        </div>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        <!-- STEP 3: Proceed Action -->
                        @if (count($dmethods) > 0)
                            <div class="pt-2">
                                <button type="submit" class="btn btn-primary btn-lg w-100 py-3 f-w-600 shadow-sm d-flex align-items-center justify-content-center gap-2 text-white"
                                        style="background: linear-gradient(135deg, #6362e7 0%, #4f46e5 100%); border: none; color: #ffffff !important;">
                                    <i class="fa-solid fa-shield-halved text-white"></i>
                                    <span class="text-white">Proceed to Secure Payment</span>
                                </button>
                            </div>
                        @endif

                    </form>
                </div>
            </div>

            <!-- Right Column: Deposit Summary -->
            <div class="col-xl-4 col-lg-5">
                <div class="terminal-card sticky-summary p-4 shadow-sm">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h6 class="mb-0 it-title f-w-700 f-16">Deposit Summary</h6>
                        <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2.5 py-1 f-11">
                            <i class="fa-solid fa-shield-check me-1"></i>Secure Gateway
                        </span>
                    </div>

                    <!-- Total Deposited Lifetime Card -->
                    <div class="info-box mb-3">
                        <span class="it-muted f-11 text-uppercase f-w-600 d-block mb-1">Total Lifetime Deposited</span>
                        <div class="d-flex align-items-baseline gap-2">
                            <h4 class="mb-0 text-success f-w-800">{{ $settings->currency }}{{ number_format($deposited, 2, '.', ',') }}</h4>
                            <span class="it-muted f-11">USD</span>
                        </div>
                    </div>

                    <!-- Guarantee Strip -->
                    <div class="mb-4">
                        <div class="d-flex align-items-start gap-2 mb-2 f-12 it-text">
                            <i class="fa-solid fa-circle-check text-success mt-1"></i>
                            <span>Zero deposit fees on crypto payment channels</span>
                        </div>
                        <div class="d-flex align-items-start gap-2 mb-2 f-12 it-text">
                            <i class="fa-solid fa-circle-check text-success mt-1"></i>
                            <span>Automated network confirmations (1 - 3 block confirmations)</span>
                        </div>
                        <div class="d-flex align-items-start gap-2 f-12 it-text">
                            <i class="fa-solid fa-circle-check text-success mt-1"></i>
                            <span>Direct ledger credit to your account balance</span>
                        </div>
                    </div>

                    <!-- History CTA Link -->
                    <a href="{{ route('accounthistory') }}" class="btn btn-outline-secondary w-100 py-2.5 d-flex align-items-center justify-content-center gap-2 f-13">
                        <i class="fa-solid fa-clock-rotate-left text-primary"></i>
                        <span>View Deposit Transaction History</span>
                    </a>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    @parent
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- Bootstrap Notify -->
    <script src="{{ asset('dash2/libs/bootstrap-notify/bootstrap-notify.min.js') }} "></script>

    @include('user.script')

    <script>
        function setDepositAmount(val) {
            var input = document.getElementById('depositAmountInput');
            if (input) {
                input.value = val;
                input.focus();
            }
        }

        // Highlight selected payment card visually
        var originalCheckpamethd = window.checkpamethd;
        window.checkpamethd = function(id) {
            document.querySelectorAll('.method-select-card').forEach(function(card) {
                card.classList.remove('active');
            });
            var chosenCard = document.getElementById('method-card-' + id);
            if (chosenCard) {
                chosenCard.classList.add('active');
            }
            if (typeof originalCheckpamethd === 'function') {
                originalCheckpamethd(id);
            }
        };
    </script>
@endsection
