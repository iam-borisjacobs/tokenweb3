@extends('layouts.guest')

@section('title', 'Account Login | ' . ($settings->site_name ?? 'ECX Groups'))

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
                            <span class="auth-pulse-dot"></span> Institutional Trading Gateway
                        </span>
                    </div>

                    <!-- Title & Tagline -->
                    <h2 class="font-weight-bold mb-3" style="font-size: 28px; line-height: 1.25; letter-spacing: -0.02em;">
                        Automated Liquidity & Intelligent Asset Growth
                    </h2>
                    <p class="text-white-50 mb-4" style="font-size: 14px; line-height: 1.6;">
                        Sign in to access real-time market depth, monitor your active investment packages, and manage instant ledger transfers with institutional precision.
                    </p>

                    <!-- Feature Bullet Points -->
                    <div class="mt-4 pt-2">
                        <div class="auth-feature-item">
                            <div class="auth-feature-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                                    <polyline points="9 12 11 14 15 10"></polyline>
                                </svg>
                            </div>
                            <div>
                                <h6 class="font-weight-bold text-white mb-1" style="font-size: 14px;">Bank-Grade Cryptographic Security</h6>
                                <p class="text-white-50 mb-0" style="font-size: 12.5px;">Multi-Party Computation (MPC) vault infrastructure with password-guarded withdrawals.</p>
                            </div>
                        </div>

                        <div class="auth-feature-item">
                            <div class="auth-feature-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="12" y1="1" x2="12" y2="23"></line>
                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                                </svg>
                            </div>
                            <div>
                                <h6 class="font-weight-bold text-white mb-1" style="font-size: 14px;">Automated Daily ROI Drops</h6>
                                <p class="text-white-50 mb-0" style="font-size: 12.5px;">Programmatic yield disbursement credited directly to your accessible account balance.</p>
                            </div>
                        </div>

                        <div class="auth-feature-item mb-0">
                            <div class="auth-feature-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <polyline points="12 6 12 12 16 14"></polyline>
                                </svg>
                            </div>
                            <div>
                                <h6 class="font-weight-bold text-white mb-1" style="font-size: 14px;">Zero-Latency P2P Ledger Settlement</h6>
                                <p class="text-white-50 mb-0" style="font-size: 12.5px;">Move capital across internal accounts instantly with 0% network transaction fees.</p>
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
                            </svg>SOC-2 Type II Certified
                        </span>
                        <span>
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#38bdf8" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="mr-1" style="vertical-align: -2px;">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 14 14"></polyline>
                            </svg>99.99% Node Uptime
                        </span>
                    </div>
                </div>
            </div>

            <!-- Right Login Form Panel -->
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
                    <h4 class="auth-title mt-3 mb-1" style="font-size: 22px;">Account Sign In</h4>
                    <p class="auth-subtitle mb-0" style="font-size: 13.5px;">Enter your registered credentials to access your trading portfolio.</p>
                </div>

                <!-- Notifications & Errors -->
                @if (Session::has('status'))
                    <div class="alert alert-danger alert-dismissible fade show p-3 rounded-10 mb-3" role="alert" style="font-size: 13px;">
                        <i class="mdi mdi-alert-circle-outline mr-1"></i>{{ session('status') }}
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

                <form method="POST" action="{{ route('login') }}" class="mt-2">
                    @csrf

                    <!-- Email Input -->
                    <div class="form-group mb-3">
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

                    <!-- Password Input -->
                    <div class="form-group mb-3">
                        <label class="font-weight-600 mb-2" style="font-size: 13px;">
                            Account Password <span class="text-danger">*</span>
                        </label>
                        <div class="auth-input-wrap">
                            <span class="auth-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                </svg>
                            </span>
                            <input type="password" class="form-control auth-input" name="password" id="login_password" placeholder="Enter your password" required autocomplete="current-password">
                            <button type="button" class="auth-eye-btn" onclick="togglePasswordVisibility('login_password', this)" title="Toggle password visibility">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="d-flex align-items-center justify-content-between mb-4 mt-2">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="customCheck1" name="remember">
                            <label class="custom-control-label font-weight-500" for="customCheck1" style="font-size: 13px; cursor: pointer;">
                                Keep me signed in
                            </label>
                        </div>
                        <a href="{{ route('password.request') }}" class="font-weight-600 text-primary text-decoration-none" style="font-size: 13px;">
                            Forgot Password?
                        </a>
                    </div>

                    <!-- Submit CTA -->
                    <button class="btn btn-auth-primary btn-block w-100 mb-3" type="submit">
                        <span>Sign In to Terminal</span>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="ml-2">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </button>

                    <!-- Google Social Login if enabled -->
                    @if ($settings->enable_social_login == 'yes')
                        <div class="text-center my-3">
                            <div class="d-flex align-items-center my-2">
                                <div class="auth-divider-line"></div>
                                <span class="px-2 text-muted text-uppercase" style="font-size: 11px; letter-spacing: 0.05em;">Or continue with</span>
                                <div class="auth-divider-line"></div>
                            </div>
                            <a href="{{ route('social.redirect', ['social' => 'google']) }}" class="login-with-google-custom shadow-xs mt-2">
                                <svg width="18" height="18" viewBox="0 0 24 24" class="mr-2">
                                    <path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.665-5.17 3.665-9.17z"/>
                                    <path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.26v3.15C3.26 21.36 7.33 24 12 24z"/>
                                    <path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.26C.46 8.16 0 9.98 0 12s.46 3.84 1.26 5.42l4.02-3.15z"/>
                                    <path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.33 0 3.26 2.64 1.26 6.58l4.02 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/>
                                </svg>
                                Sign in with Google
                            </a>
                        </div>
                    @endif

                    <!-- Sign Up Switcher -->
                    <div class="text-center mt-4">
                        <span class="text-muted" style="font-size: 13.5px;">New to {{ $settings->site_name }}?</span>
                        <a href="{{ route('register') }}" class="font-weight-bold text-primary ml-1 text-decoration-none" style="font-size: 13.5px;">
                            Create an Account
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

@section('scripts')
    @parent
    <script>
        function togglePasswordVisibility(inputId, btn) {
            var input = document.getElementById(inputId);
            if (!input) return;
            if (input.type === 'password') {
                input.type = 'text';
                btn.innerHTML = '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line></svg>';
            } else {
                input.type = 'password';
                btn.innerHTML = '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>';
            }
        }
    </script>
@endsection
