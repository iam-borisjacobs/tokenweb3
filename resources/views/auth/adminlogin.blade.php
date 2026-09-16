@extends('layouts.guest')
@section('title', 'Administrative Terminal Sign In | ' . ($settings->site_name ?? 'ECX Groups'))

@section('styles')
@parent
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
<style>
    body {
        background-color: #0b0f19 !important;
        background-image: 
            radial-gradient(circle at 12% 18%, rgba(99, 98, 231, 0.16) 0%, transparent 45%),
            radial-gradient(circle at 88% 82%, rgba(14, 165, 233, 0.12) 0%, transparent 45%),
            radial-gradient(circle at 50% 50%, rgba(245, 158, 11, 0.04) 0%, transparent 60%);
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        color: #0f172a;
        margin: 0;
        min-height: 100vh;
    }

    .admin-auth-wrapper {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 30px 15px;
    }

    .admin-auth-card {
        background: #ffffff;
        border-radius: 24px;
        box-shadow: 0 25px 60px -15px rgba(0, 0, 0, 0.5), 0 0 0 1px rgba(255, 255, 255, 0.08);
        overflow: hidden;
        width: 100%;
        max-width: 1060px;
    }

    /* Left Showcase Panel */
    .admin-showcase {
        background: linear-gradient(145deg, #090d18 0%, #0f172a 50%, #0a0f1d 100%);
        color: #ffffff;
        padding: 48px 40px !important;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        position: relative;
        overflow: hidden;
    }

    .admin-showcase::before {
        content: '';
        position: absolute;
        top: -120px;
        right: -120px;
        width: 260px;
        height: 260px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(99, 98, 231, 0.28) 0%, rgba(99, 98, 231, 0) 70%);
        pointer-events: none;
    }

    .admin-showcase::after {
        content: '';
        position: absolute;
        bottom: -100px;
        left: -100px;
        width: 240px;
        height: 240px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(245, 158, 11, 0.15) 0%, rgba(245, 158, 11, 0) 70%);
        pointer-events: none;
    }

    .admin-pill-badge {
        display: inline-flex;
        align-items: center;
        background: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.15);
        border-radius: 30px;
        padding: 6px 14px;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.06em;
        text-transform: uppercase;
        color: #f1f5f9;
        backdrop-filter: blur(6px);
    }

    .admin-pulse-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #10b981;
        margin-right: 8px;
        box-shadow: 0 0 10px #10b981;
        animation: pulseLive 2s infinite ease-in-out;
    }

    @keyframes pulseLive {
        0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7); }
        70% { transform: scale(1); box-shadow: 0 0 0 8px rgba(16, 185, 129, 0); }
        100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
    }

    .admin-feature-item {
        display: flex;
        align-items: flex-start;
        margin-bottom: 22px;
    }

    .admin-feature-icon {
        width: 38px;
        height: 38px;
        border-radius: 12px;
        background: rgba(255, 255, 255, 0.06);
        border: 1px solid rgba(255, 255, 255, 0.12);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #818cf8;
        font-size: 15px;
        margin-right: 15px;
        flex-shrink: 0;
    }

    /* Right Form Panel */
    .admin-form-panel {
        padding: 48px 44px !important;
        background: #ffffff;
    }

    @media (max-width: 991.98px) {
        .admin-form-panel {
            padding: 36px 24px !important;
        }
    }

    .admin-icon-badge {
        width: 54px;
        height: 54px;
        border-radius: 16px;
        background: linear-gradient(135deg, rgba(99, 98, 231, 0.1) 0%, rgba(99, 98, 231, 0.2) 100%);
        border: 1px solid rgba(99, 98, 231, 0.25);
        color: #6362e7;
        font-size: 22px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 16px;
    }

    .admin-input-wrap {
        position: relative;
        display: flex;
        align-items: center;
    }

    .admin-input-icon {
        position: absolute;
        left: 16px;
        color: #94a3b8;
        font-size: 15px;
        pointer-events: none;
        transition: color 0.2s ease;
        z-index: 2;
    }

    .admin-input {
        width: 100%;
        height: 48px;
        padding-left: 46px !important;
        padding-right: 46px !important;
        border-radius: 12px !important;
        border: 1.5px solid #e2e8f0 !important;
        font-size: 14px !important;
        font-weight: 500 !important;
        color: #0f172a !important;
        background-color: #f8fafc !important;
        transition: all 0.2s ease !important;
        box-shadow: none !important;
    }

    .admin-input:focus {
        background-color: #ffffff !important;
        border-color: #6362e7 !important;
        box-shadow: 0 0 0 4px rgba(99, 98, 231, 0.12) !important;
    }

    .admin-input:focus + .admin-input-icon,
    .admin-input-wrap:focus-within .admin-input-icon {
        color: #6362e7 !important;
    }

    .admin-eye-btn {
        position: absolute;
        right: 14px;
        background: transparent;
        border: none;
        color: #94a3b8;
        cursor: pointer;
        padding: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        transition: color 0.2s ease;
        z-index: 3;
    }

    .admin-eye-btn:hover {
        color: #475569;
    }

    .admin-eye-btn.active {
        color: #6362e7;
    }

    .btn-admin-submit {
        height: 48px;
        background: linear-gradient(135deg, #6362e7 0%, #4338ca 100%);
        border: none;
        border-radius: 12px;
        color: #ffffff;
        font-size: 14.5px;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        box-shadow: 0 4px 15px rgba(99, 98, 231, 0.35);
        transition: all 0.25s ease;
        cursor: pointer;
    }

    .btn-admin-submit:hover {
        background: linear-gradient(135deg, #5250e4 0%, #3730a3 100%);
        box-shadow: 0 8px 22px rgba(99, 98, 231, 0.45);
        transform: translateY(-1px);
        color: #ffffff;
    }

    .btn-admin-submit:active {
        transform: translateY(1px);
    }
</style>
@endsection

@section('content')
<div class="admin-auth-wrapper">
    <div class="admin-auth-card">
        <div class="row no-gutters g-0">
            <!-- Left Command Terminal Showcase -->
            <div class="col-12 col-lg-6 admin-showcase d-none d-lg-flex">
                <div>
                    <!-- Top Logo & Clearance Pill -->
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <a href="/" class="d-inline-block">
                            @php
                                $logo = !empty($settings->logo) ? asset('storage/app/public/' . $settings->logo) : null;
                            @endphp
                            @if ($logo)
                                <img src="{{ $logo }}" 
                                     alt="{{ $settings->site_name }}" 
                                     style="max-height: 38px; width: auto;" 
                                     class="img-fluid"
                                     onerror="this.style.display='none'; this.nextElementSibling.style.display='inline-flex';">
                                <div class="d-none align-items-center">
                                    <div class="mr-2 d-flex align-items-center justify-content-center rounded-circle" style="width: 34px; height: 34px; background: #6362e7; color: #fff;">
                                        <i class="fa-solid fa-shield-halved"></i>
                                    </div>
                                    <span class="font-weight-bold" style="font-size: 19px; letter-spacing: -0.02em; color: #ffffff;">{{ $settings->site_name ?? 'ECX GROUPS' }}</span>
                                </div>
                            @else
                                <div class="d-inline-flex align-items-center">
                                    <div class="mr-2 d-flex align-items-center justify-content-center rounded-circle" style="width: 34px; height: 34px; background: #6362e7; color: #fff;">
                                        <i class="fa-solid fa-shield-halved"></i>
                                    </div>
                                    <span class="font-weight-bold" style="font-size: 19px; letter-spacing: -0.02em; color: #ffffff;">{{ $settings->site_name ?? 'ECX GROUPS' }}</span>
                                </div>
                            @endif
                        </a>
                        <div class="admin-pill-badge">
                            <span class="admin-pulse-dot"></span> SECURE GATEWAY
                        </div>
                    </div>

                    <!-- Main Hero Typography -->
                    <h2 class="font-weight-bold text-white mb-2" style="font-size: 26px; line-height: 1.35; letter-spacing: -0.02em;">
                        Institutional Operations & Command Portal
                    </h2>
                    <p class="text-white-50 mb-4" style="font-size: 13.5px; line-height: 1.6;">
                        High-privilege administrative gateway for real-time asset settlement, client KYC oversight, algorithmic bot risk controls, and cold liquidity management.
                    </p>

                    <!-- Feature Capabilities -->
                    <div class="admin-feature-item">
                        <div class="admin-feature-icon">
                            <i class="fa-solid fa-shield-halved"></i>
                        </div>
                        <div>
                            <h6 class="text-white font-weight-bold mb-1" style="font-size: 14px;">Cryptographic Multi-Factor Session</h6>
                            <small class="text-white-50" style="font-size: 12px; line-height: 1.5; display: block;">
                                Hardware-backed token encryption with continuous biometric and IP perimeter validation.
                            </small>
                        </div>
                    </div>

                    <div class="admin-feature-item">
                        <div class="admin-feature-icon" style="color: #38bdf8;">
                            <i class="fa-solid fa-satellite-dish"></i>
                        </div>
                        <div>
                            <h6 class="text-white font-weight-bold mb-1" style="font-size: 14px;">Real-Time Audit Telemetry</h6>
                            <small class="text-white-50" style="font-size: 12px; line-height: 1.5; display: block;">
                                Immutable ledger recording all managerial authorizations, deposits, and withdrawal approvals.
                            </small>
                        </div>
                    </div>

                    <div class="admin-feature-item mb-0">
                        <div class="admin-feature-icon" style="color: #fbbf24;">
                            <i class="fa-solid fa-vault"></i>
                        </div>
                        <div>
                            <h6 class="text-white font-weight-bold mb-1" style="font-size: 14px;">Tiered Liquidity Separation</h6>
                            <small class="text-white-50" style="font-size: 12px; line-height: 1.5; display: block;">
                                Air-gapped cold custody routing with automated trading threshold circuit breakers.
                            </small>
                        </div>
                    </div>
                </div>

                <!-- Bottom System Telemetry Ribbon -->
                <div class="pt-4 border-top" style="border-color: rgba(255, 255, 255, 0.1) !important;">
                    <div class="d-flex align-items-center justify-content-between text-white-50" style="font-size: 11.5px;">
                        <span><i class="fa-solid fa-circle-check text-success mr-1"></i> Core Engine: v4.8 Active</span>
                        <span>TLS 1.3 Strict</span>
                        <span>Latency: 1.2ms</span>
                    </div>
                </div>
            </div>

            <!-- Right Login Form Panel -->
            <div class="col-12 col-lg-6 admin-form-panel d-flex flex-column justify-content-center">
                <!-- Mobile Logo (shown only on small screens) -->
                <div class="d-lg-none text-center mb-4">
                    <a href="/" class="d-inline-block">
                        @if ($logo)
                            <img src="{{ $logo }}" alt="{{ $settings->site_name }}" style="max-height: 38px; width: auto;" class="img-fluid">
                        @else
                            <h4 class="font-weight-bold text-dark mb-0">{{ $settings->site_name }}</h4>
                        @endif
                    </a>
                </div>

                <!-- Form Title & Badge -->
                <div class="text-center mb-4">
                    <div class="admin-icon-badge">
                        <i class="fa-solid fa-user-shield"></i>
                    </div>
                    <h4 class="font-weight-bold text-dark mb-1" style="font-size: 23px; letter-spacing: -0.02em;">
                        Manager Sign In
                    </h4>
                    <p class="text-muted mb-0" style="font-size: 13.5px;">
                        Enter your authorized security credentials to access the administrative terminal.
                    </p>
                </div>

                <x-danger-alert />
                <x-success-alert />

                @if (isset($errors) && $errors->any())
                    <div class="alert alert-danger p-3 rounded mb-3" style="font-size: 13px;">
                        <ul class="mb-0 pl-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('adminlogin') }}" class="mt-2">
                    @csrf

                    <!-- Email Input -->
                    <div class="form-group mb-3">
                        <label class="font-weight-bold mb-2 text-uppercase" style="font-size: 11.5px; color: #475569; letter-spacing: 0.04em;">
                            Administrator Email <span class="text-danger">*</span>
                        </label>
                        <div class="admin-input-wrap">
                            <i class="fa-solid fa-envelope admin-input-icon"></i>
                            <input type="email" 
                                   class="form-control admin-input" 
                                   name="email" 
                                   value="{{ old('email') }}" 
                                   id="email" 
                                   placeholder="admin@ecxgroups.com" 
                                   required 
                                   autofocus 
                                   autocomplete="email">
                        </div>
                    </div>

                    <!-- Password Input -->
                    <div class="form-group mb-3">
                        <label class="font-weight-bold mb-2 text-uppercase" style="font-size: 11.5px; color: #475569; letter-spacing: 0.04em;">
                            Security Password <span class="text-danger">*</span>
                        </label>
                        <div class="admin-input-wrap">
                            <i class="fa-solid fa-lock admin-input-icon"></i>
                            <input type="password" 
                                   class="form-control admin-input" 
                                   name="password" 
                                   id="admin_password" 
                                   placeholder="••••••••••••" 
                                   required 
                                   autocomplete="current-password">
                            <button type="button" class="admin-eye-btn" onclick="toggleAdminPassword('admin_password', this)" title="Toggle password visibility">
                                <i class="fa-regular fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Remember & Forgot Password -->
                    <div class="d-flex align-items-center justify-content-between mb-4 mt-2">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="adminRemember" name="remember">
                            <label class="custom-control-label font-weight-500 text-muted" for="adminRemember" style="font-size: 13px; cursor: pointer;">
                                Remember device
                            </label>
                        </div>
                        <a href="{{ route('admin.forgetpassword') }}" class="font-weight-bold text-primary text-decoration-none" style="font-size: 13px;">
                            Forgot password?
                        </a>
                    </div>

                    <!-- Submit CTA -->
                    <button class="btn-admin-submit w-100 mb-3" type="submit">
                        <i class="fa-solid fa-right-to-bracket"></i>
                        <span>Authenticate to Console</span>
                    </button>

                    <!-- Security Disclaimer -->
                    <div class="p-3 rounded-3 mb-3 text-center" style="background: #f8fafc; border: 1px solid #e2e8f0;">
                        <small class="text-muted" style="font-size: 11.5px; line-height: 1.5; display: block;">
                            <i class="fa-solid fa-shield-halved text-success mr-1"></i>
                            End-to-end encrypted session. All unauthorized access attempts are logged with IP & browser telemetry.
                        </small>
                    </div>

                    <!-- Return Link & Copyright -->
                    <div class="text-center mt-3">
                        <a href="/" class="text-muted text-decoration-none font-weight-500 d-inline-flex align-items-center gap-1" style="font-size: 12.5px;">
                            <i class="fa-solid fa-arrow-left mr-1"></i> Return to Main Website
                        </a>
                        <p class="text-muted mt-3 mb-0" style="font-size: 11px;">
                            &copy; {{ date('Y') }} {{ $settings->site_name }}. All Rights Reserved.
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleAdminPassword(inputId, btn) {
        var input = document.getElementById(inputId);
        var icon = btn.querySelector('i');
        if (input.type === 'password') {
            input.type = 'text';
            icon.className = 'fa-regular fa-eye-slash';
            btn.classList.add('active');
        } else {
            input.type = 'password';
            icon.className = 'fa-regular fa-eye';
            btn.classList.remove('active');
        }
    }
</script>
@endsection