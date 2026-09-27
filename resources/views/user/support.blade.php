@extends('layouts.dash')
@section('title', $title ?? '24/7 Customer Support')

@section('content')
    <!-- Scoped Styling for Modern Support Page -->
    <style>
        .support-view .support-card {
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 24px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.03);
            transition: all 0.25s ease;
            position: relative;
        }
        .support-view .support-card:hover {
            border-color: #cbd5e1;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.06);
            transform: translateY(-2px);
        }

        body.dark-only .support-view .support-card {
            background-color: #19202f !important;
            border-color: #273142 !important;
            box-shadow: none !important;
        }
        body.dark-only .support-view .support-card:hover {
            border-color: #3b485d !important;
        }

        .support-view .channel-action-card {
            display: flex;
            flex-direction: column;
            height: 100%;
            border-radius: 14px;
            padding: 22px;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02);
            transition: all 0.25s ease;
        }
        .support-view .channel-action-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.07);
        }
        body.dark-only .support-view .channel-action-card {
            background: #19202f !important;
            border-color: #273142 !important;
            box-shadow: none !important;
        }
        body.dark-only .support-view .channel-action-card:hover {
            border-color: #3b485d !important;
        }

        .support-view .it-title {
            color: #0f172a !important;
            font-weight: 700;
            transition: color 0.2s ease;
        }
        body.dark-only .support-view .it-title {
            color: #ffffff !important;
        }

        .support-view .it-muted {
            color: #64748b !important;
            transition: color 0.2s ease;
        }
        body.dark-only .support-view .it-muted {
            color: #94a3b8 !important;
        }

        .support-view .form-label {
            font-size: 13px;
            font-weight: 600;
            color: #334155;
            margin-bottom: 6px;
        }
        body.dark-only .support-view .form-label {
            color: #e2e8f0;
        }

        .support-view .form-control,
        .support-view .form-select {
            border: 1px solid #cbd5e1;
            border-radius: 10px;
            font-size: 13.5px;
            padding: 10px 14px;
            color: #0f172a;
            background-color: #ffffff;
            transition: all 0.2s ease;
        }
        .support-view .form-control:focus,
        .support-view .form-select:focus {
            border-color: var(--theme-default, #6362e7);
            box-shadow: 0 0 0 3px rgba(99, 98, 231, 0.15);
            background-color: #ffffff;
        }
        body.dark-only .support-view .form-control,
        body.dark-only .support-view .form-select {
            background-color: #111827 !important;
            border-color: #334155 !important;
            color: #f1f5f9 !important;
        }
        body.dark-only .support-view .form-control:focus,
        body.dark-only .support-view .form-select:focus {
            background-color: #0f172a !important;
            border-color: var(--theme-default, #6362e7) !important;
        }

        .support-view .btn-channel-wa {
            background-color: #25D366 !important;
            border-color: #22bf5b !important;
            color: #ffffff !important;
            font-weight: 700;
            box-shadow: 0 2px 8px rgba(37, 211, 102, 0.35);
        }
        .support-view .btn-channel-wa:hover {
            background-color: #1ebc59 !important;
            color: #ffffff !important;
            transform: translateY(-1px);
        }

        .support-view .btn-channel-tg {
            background-color: #229ED9 !important;
            border-color: #1f8ec4 !important;
            color: #ffffff !important;
            font-weight: 700;
            box-shadow: 0 2px 8px rgba(34, 158, 217, 0.35);
        }
        .support-view .btn-channel-tg:hover {
            background-color: #1b8ec3 !important;
            color: #ffffff !important;
            transform: translateY(-1px);
        }

        .support-view .btn-channel-mail {
            background-color: #4f46e5 !important;
            border-color: #4338ca !important;
            color: #ffffff !important;
            font-weight: 700;
            box-shadow: 0 2px 8px rgba(79, 70, 229, 0.35);
        }
        .support-view .btn-channel-mail:hover {
            background-color: #4338ca !important;
            color: #ffffff !important;
            transform: translateY(-1px);
        }
    </style>

    @php
        $waUrl = $settings->getWhatsAppUrl("Hello, I need assistance regarding my account on {$settings->site_name}.");
        $tgUrl = $settings->getTelegramUrl();
    @endphp

    <div class="support-view container-fluid py-2">
        <x-danger-alert />
        <x-success-alert />

        <!-- Page Header -->
        <div class="row mb-4">
            <div class="col-12 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                <div>
                    <h3 class="it-title mb-1 f-24">24/7 Client Concierge & Support</h3>
                    <p class="it-muted mb-0 f-13">Direct access to our priority trading operations, compliance department, and dedicated account managers.</p>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-3 py-2 rounded-pill f-12 d-inline-flex align-items-center" style="gap: 6px;">
                        <span class="rounded-circle bg-success" style="width: 7px; height: 7px; display: inline-block;"></span>
                        <span>Help Desk Online • Avg Response: &lt; 15 mins</span>
                    </span>
                </div>
            </div>
        </div>

        

        <!-- Section 2: Support Ticket Submission Form -->
        <div class="row">
            <div class="col-12 col-xl-10 offset-xl-1">
                <div class="support-card p-4 p-md-5">
                    <div class="d-flex align-items-center gap-3 mb-4 pb-3 border-bottom border-light-subtle">
                        <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center flex-shrink-0" style="width: 44px; height: 44px;">
                            <i class="fa-solid fa-ticket-simple f-18"></i>
                        </div>
                        <div>
                            <h5 class="it-title f-18 mb-0">Submit an Official Inquiry Ticket</h5>
                            <small class="it-muted f-12">Submit your request directly to our queue. You will receive an automated ticket ID and email confirmation.</small>
                        </div>
                    </div>

                    <form method="post" action="{{ route('enquiry') }}">
                        @csrf
                        <input type="hidden" name="name" value="{{ Auth::user()->name }}">
                        <input type="hidden" name="email" value="{{ Auth::user()->email }}">

                        <div class="row g-3">
                            <!-- Pre-filled User Profile Info -->
                            <div class="col-md-6">
                                <label class="form-label">Client Name</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-muted border-end-0"><i class="fa-solid fa-user"></i></span>
                                    <input type="text" class="form-control border-start-0" value="{{ Auth::user()->name }}" readonly disabled style="opacity: 0.85;">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Registered Email</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-muted border-end-0"><i class="fa-solid fa-envelope"></i></span>
                                    <input type="text" class="form-control border-start-0" value="{{ Auth::user()->email }}" readonly disabled style="opacity: 0.85;">
                                </div>
                            </div>

                            <!-- Category & Priority -->
                            <div class="col-md-7">
                                <label class="form-label">Inquiry Category <span class="text-danger">*</span></label>
                                <select name="category" class="form-select" required>
                                    <option value="Withdrawal & Payout Processing" selected>Withdrawal & Payout Processing</option>
                                    <option value="Institutional Wallet Clearance">Institutional Wallet Clearance</option>
                                    <option value="Deposit & Capital Credit">Deposit & Capital Credit</option>
                                    <option value="Investment Package & Yield Compounding">Investment Package & Yield Compounding</option>
                                    <option value="KYC & Identity Verification">KYC & Identity Verification</option>
                                    <option value="Account Security & 2FA">Account Security & 2FA</option>
                                    <option value="General Support Inquiry">General Support Inquiry</option>
                                </select>
                            </div>

                            <div class="col-md-5">
                                <label class="form-label">Priority Level</label>
                                <select name="priority" class="form-select">
                                    <option value="Normal">Normal Priority</option>
                                    <option value="High" selected>High Priority (Expedited)</option>
                                    <option value="Urgent">Urgent (Immediate Review)</option>
                                </select>
                            </div>

                            <!-- Message Body -->
                            <div class="col-12">
                                <label class="form-label">Detailed Message <span class="text-danger">*</span></label>
                                <textarea name="message" class="form-control" rows="6" placeholder="Describe your request in detail. Please provide any wallet addresses, transaction hashes, or reference codes for expedited resolution..." required></textarea>
                                <small class="it-muted f-11 mt-1 d-block">
                                    <i class="fa-solid fa-circle-info text-info me-1"></i> For withdrawal clearance, please indicate your connected wallet address and requested payout amount.
                                </small>
                            </div>

                            <!-- Submit Action -->
                            <div class="col-12 d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-3 pt-3 border-top border-light-subtle">
                                <div class="d-flex align-items-center gap-2 it-muted f-12">
                                    <i class="fa-solid fa-shield-halved text-success f-14"></i>
                                    <span>256-bit Encrypted Client Transmission</span>
                                </div>
                                <button type="submit" class="btn btn-primary rounded-pill px-5 py-2.5 f-w-700 shadow-sm d-inline-flex align-items-center justify-content-center gap-2 text-white">
                                    <i class="fa-solid fa-paper-plane text-white"></i>
                                    <span>Submit Support Ticket</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
