@extends('layouts.guest')

@section('title', 'Forgot Password | ' . ($settings->site_name ?? 'ECX Groups'))

@section('styles')
    @parent
@endsection

@section('content')
<section class="auth-container">
    <div class="auth-card">
        <div class="row no-gutters">
            <!-- Left Branding Showcase Rail -->
            <div class="col-lg-6 d-none d-lg-flex auth-showcase">
                <div>
                    <!-- Pill Tag -->
                    <div class="mb-4">
                        <span class="auth-pill-badge">
                            <span class="auth-pulse-dot"></span> Secure Identity Recovery
                        </span>
                    </div>

                    <!-- Title & Tagline -->
                    <h2 class="font-weight-bold mb-3" style="font-size: 28px; line-height: 1.25; letter-spacing: -0.02em;">
                        Encrypted Credential & Access Recovery
                    </h2>
                    <p class="text-white-50 mb-4" style="font-size: 14px; line-height: 1.6;">
                        Safely restore access to your institutional trading accounts, segregated asset vaults, and automated contract portfolios with end-to-end cryptographic verification.
                    </p>

                    <!-- Feature Bullet Points -->
                    <div class="mt-4 pt-2">
                        <div class="auth-feature-item">
                            <div class="auth-feature-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                    <polyline points="22,6 12,13 2,6"></polyline>
                                </svg>
                            </div>
                            <div>
                                <h6 class="font-weight-bold text-white mb-1" style="font-size: 14px;">Cryptographic Email Tokens</h6>
                                <p class="text-white-50 mb-0" style="font-size: 12.5px;">Signed, time-sensitive verification tokens dispatched directly to your registered primary email address.</p>
                            </div>
                        </div>

                        <div class="auth-feature-item">
                            <div class="auth-feature-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                </svg>
                            </div>
                            <div>
                                <h6 class="font-weight-bold text-white mb-1" style="font-size: 14px;">Isolated Cold Vault Safeguards</h6>
                                <p class="text-white-50 mb-0" style="font-size: 12.5px;">Your investment assets remain untouched and earn yield continuously while access is restored.</p>
                            </div>
                        </div>

                        <div class="auth-feature-item mb-0">
                            <div class="auth-feature-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                                    <polyline points="9 12 11 14 15 10"></polyline>
                                </svg>
                            </div>
                            <div>
                                <h6 class="font-weight-bold text-white mb-1" style="font-size: 14px;">Anti-Brute Force Protection</h6>
                                <p class="text-white-50 mb-0" style="font-size: 12.5px;">Active rate-limiting and device fingerprinting to prevent unauthorized reset attempts.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bottom System Health Metric -->
                <div class="pt-4 mt-4" style="border-top: 1px solid rgba(255, 255, 255, 0.1);">
                    <div class="d-flex align-items-center justify-content-between text-white-50" style="font-size: 12px;">
                        <span>
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="mr-1" style="vertical-align: -2px;">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                                <polyline points="9 12 11 14 15 10"></polyline>
                            </svg>Encrypted Dispatch
                        </span>
                        <span>
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#38bdf8" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="mr-1" style="vertical-align: -2px;">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 14 14"></polyline>
                            </svg>15-Min Token Expiry
                        </span>
                    </div>
                </div>
            </div>

            <!-- Right Form Panel -->
            <div class="col-12 col-lg-6 auth-form-panel d-flex flex-column justify-content-center">
                <!-- Brand Logo Header -->
                <div class="text-center mb-4">
                    <a href="/" class="d-inline-block">
                        @php
                            $hasCustomLogo = !empty($settings->logo) && file_exists(base_path('storage/app/public/' . $settings->logo));
                            $lightLogo = $hasCustomLogo ? asset('storage/app/public/' . $settings->logo) : asset('volkovdesign/img/logo.svg');
                            $hasCustomDarkLogo = !empty($settings->dark_logo) && file_exists(base_path('storage/app/public/' . $settings->dark_logo));
                            $darkLogo = $hasCustomDarkLogo ? asset('storage/app/public/' . $settings->dark_logo) : $lightLogo;
                        @endphp
                        <img src="{{ $darkLogo }}" 
                             alt="{{ $settings->site_name }}" 
                             class="auth-logo-dark img-fluid"
                             style="max-height: 40px; width: auto;"
                             @if(empty($settings->dark_logo)) style="max-height: 40px; width: auto; filter: brightness(0.2);" @endif>
                        <img src="{{ $lightLogo }}" 
                             alt="{{ $settings->site_name }}" 
                             class="auth-logo-light img-fluid"
                             style="max-height: 40px; width: auto;">
                    </a>
                    <h4 class="auth-title mt-3 mb-1" style="font-size: 22px;">Password Recovery</h4>
                    <p class="auth-subtitle mb-0" style="font-size: 13.5px;">Enter your registered account email to receive your recovery link.</p>
                </div>

                <!-- Notifications & Errors -->
                @if (Session::has('message'))
                    <div class="alert alert-danger alert-dismissible fade show p-3 rounded-10 mb-3" role="alert" style="font-size: 13px;">
                        <i class="mdi mdi-alert-circle-outline mr-1"></i>{{ Session::get('message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show p-3 rounded-10 mb-3" role="alert" style="font-size: 13px;">
                        <i class="mdi mdi-check-circle-outline mr-1"></i>{{ session('status') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if (isset($errors) && $errors->any())
                    <div class="alert alert-danger p-3 rounded mb-3" style="font-size: 13px;">
                        <ul class="mb-0 pl-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}" class="mt-2">
                    @csrf

                    <!-- Email Input -->
                    <div class="form-group mb-4">
                        <label class="font-weight-600 mb-2" style="font-size: 13px;">
                            Email Address <span class="text-danger">*</span>
                        </label>
                        <div class="auth-input-wrap">
                            <span class="auth-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                    <polyline points="22,6 12,13 2,6"></polyline>
                                </svg>
                            </span>
                            <input type="email" class="form-control auth-input" name="email" value="{{ old('email') }}" id="email" placeholder="name@example.com" required autofocus autocomplete="email">
                        </div>
                    </div>

                    <!-- Submit CTA -->
                    <button class="btn btn-auth-primary btn-block w-100 mb-3" type="submit">
                        <span>Send Recovery Link</span>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="ml-2">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </button>

                    <!-- Back to Login -->
                    <div class="text-center mt-4">
                        <span class="text-muted" style="font-size: 13.5px;">Remember your credentials?</span>
                        <a href="{{ route('login') }}" class="font-weight-bold text-primary ml-1 text-decoration-none" style="font-size: 13.5px;">
                            Sign In
                        </a>
                    </div>
                </form>

                <!-- Footer Copyright -->
                <div class="text-center mt-4 pt-2">
                    <small class="text-muted" style="font-size: 11.5px;">
                        &copy; {{ date('Y') }} {{ $settings->site_name }}. All rights reserved.
                    </small>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection