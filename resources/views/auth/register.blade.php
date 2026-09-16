@extends('layouts.guest')

@section('title', 'Create Account | ' . ($settings->site_name ?? 'ECX Groups'))

@section('styles')
    @parent
@endsection

@section('content')
<section class="auth-container">
    <div class="auth-card auth-card--register">
        <div class="row no-gutters">
            <!-- Left Branding Showcase Rail -->
            <div class="col-lg-5 d-none d-lg-flex auth-showcase">
                <div>
                    <!-- Pill Tag -->
                    <div class="mb-4">
                        <span class="auth-pill-badge">
                            <span class="auth-pulse-dot"></span> Institutional Onboarding
                        </span>
                    </div>

                    <!-- Title & Tagline -->
                    <h2 class="font-weight-bold mb-3" style="font-size: 28px; line-height: 1.25; letter-spacing: -0.02em;">
                        Join 45,000+ Global Investors
                    </h2>
                    <p class="text-white-50 mb-4" style="font-size: 14px; line-height: 1.6;">
                        Establish your verified account in minutes to start accessing automated yield drop contracts, deep crypto liquidity, and seamless fund transfers.
                    </p>

                    <!-- Feature Steps -->
                    <div class="mt-4 pt-2">
                        <div class="auth-feature-item">
                            <div class="auth-feature-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="8.5" cy="7" r="4"></circle>
                                    <line x1="20" y1="8" x2="20" y2="14"></line>
                                    <line x1="23" y1="11" x2="17" y2="11"></line>
                                </svg>
                            </div>
                            <div>
                                <h6 class="font-weight-bold text-white mb-1" style="font-size: 14px;">1. Instant Registration</h6>
                                <p class="text-white-50 mb-0" style="font-size: 12.5px;">Quick onboarding with zero initial deposit requirement or unnecessary delays.</p>
                            </div>
                        </div>

                        <div class="auth-feature-item">
                            <div class="auth-feature-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
                                    <line x1="1" y1="10" x2="23" y2="10"></line>
                                </svg>
                            </div>
                            <div>
                                <h6 class="font-weight-bold text-white mb-1" style="font-size: 14px;">2. Multi-Channel Funding</h6>
                                <p class="text-white-50 mb-0" style="font-size: 12.5px;">Fund your portfolio using Bitcoin, Ethereum, USDT, or direct Bank Wire.</p>
                            </div>
                        </div>

                        <div class="auth-feature-item mb-0">
                            <div class="auth-feature-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                                    <polyline points="17 6 23 6 23 12"></polyline>
                                </svg>
                            </div>
                            <div>
                                <h6 class="font-weight-bold text-white mb-1" style="font-size: 14px;">3. Earn Automated Daily ROI</h6>
                                <p class="text-white-50 mb-0" style="font-size: 12.5px;">Select verified investment plans with automated yield drops credited to your wallet.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bottom Trust Metrics -->
                <div class="pt-4 mt-4" style="border-top: 1px solid rgba(255, 255, 255, 0.1);">
                    <div class="d-flex align-items-center justify-content-between text-white-50" style="font-size: 12px;">
                        <span>
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="mr-1" style="vertical-align: -2px;">
                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                            </svg>256-Bit SSL Encryption
                        </span>
                        <span>
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#38bdf8" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="mr-1" style="vertical-align: -2px;">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                                <polyline points="9 12 11 14 15 10"></polyline>
                            </svg>Segregated Custody
                        </span>
                    </div>
                </div>
            </div>

            <!-- Right Registration Form Panel -->
            <div class="col-12 col-lg-7 auth-form-panel">
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
                    <h4 class="auth-title mt-3 mb-1" style="font-size: 21px;">Create Your Account</h4>
                    <p class="auth-subtitle mb-0" style="font-size: 13px;">It takes only two minutes to set up your institutional trading account.</p>
                </div>

                @if (Session::has('status'))
                    <div class="alert alert-danger alert-dismissible fade show p-3 rounded-10 mb-3" role="alert" style="font-size: 13px;">
                        <i class="mdi mdi-alert-circle-outline mr-1"></i>{{ session('status') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}" class="mt-3 login-form">
                    @csrf
                    <div class="form-row">
                        <!-- Username -->
                        <div class="col-md-6 mb-3">
                            <div class="form-group mb-0">
                                <label class="font-weight-600 mb-1" style="font-size: 12.5px;">
                                    Username <span class="text-danger">*</span>
                                </label>
                                <div class="auth-input-wrap">
                                    <span class="auth-icon">
                                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                            <circle cx="12" cy="7" r="4"></circle>
                                        </svg>
                                    </span>
                                    <input type="text" class="form-control auth-input" name="username" id="input1" value="{{ old('username') }}" placeholder="Unique Username" required autocomplete="username">
                                </div>
                                @if (isset($errors) && $errors->has('username'))
                                    <small class="text-danger d-block mt-1 font-weight-500">{{ $errors->first('username') }}</small>
                                @endif
                            </div>
                        </div>

                        <!-- Full Name -->
                        <div class="col-md-6 mb-3">
                            <div class="form-group mb-0">
                                <label class="font-weight-600 mb-1" style="font-size: 12.5px;">
                                    Full Name <span class="text-danger">*</span>
                                </label>
                                <div class="auth-input-wrap">
                                    <span class="auth-icon">
                                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                            <circle cx="8.5" cy="7" r="4"></circle>
                                            <polyline points="17 11 19 13 23 9"></polyline>
                                        </svg>
                                    </span>
                                    <input type="text" class="form-control auth-input" name="name" value="{{ old('name') }}" id="f_name" placeholder="John Doe" required autocomplete="name">
                                </div>
                                @if (isset($errors) && $errors->has('name'))
                                    <small class="text-danger d-block mt-1 font-weight-500">{{ $errors->first('name') }}</small>
                                @endif
                            </div>
                        </div>

                        <!-- Email Address -->
                        <div class="col-md-6 mb-3">
                            <div class="form-group mb-0">
                                <label class="font-weight-600 mb-1" style="font-size: 12.5px;">
                                    Email Address <span class="text-danger">*</span>
                                </label>
                                <div class="auth-input-wrap">
                                    <span class="auth-icon">
                                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                            <polyline points="22,6 12,13 2,6"></polyline>
                                        </svg>
                                    </span>
                                    <input type="email" class="form-control auth-input" name="email" value="{{ old('email') }}" id="email" placeholder="name@example.com" required autocomplete="email">
                                </div>
                                @if (isset($errors) && $errors->has('email'))
                                    <small class="text-danger d-block mt-1 font-weight-500">{{ $errors->first('email') }}</small>
                                @endif
                            </div>
                        </div>

                        <!-- Phone Number -->
                        <div class="col-md-6 mb-3">
                            <div class="form-group mb-0">
                                <label class="font-weight-600 mb-1" style="font-size: 12.5px;">
                                    Phone Number <span class="text-danger">*</span>
                                </label>
                                <div class="auth-input-wrap">
                                    <span class="auth-icon">
                                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                        </svg>
                                    </span>
                                    <input type="text" class="form-control auth-input" name="phone" value="{{ old('phone') }}" id="phone" placeholder="+1 (555) 000-0000" required autocomplete="tel">
                                </div>
                                @if (isset($errors) && $errors->has('phone'))
                                    <small class="text-danger d-block mt-1 font-weight-500">{{ $errors->first('phone') }}</small>
                                @endif
                            </div>
                        </div>

                        <!-- Country -->
                        <div class="col-md-6 mb-3">
                            <div class="form-group mb-0">
                                <label class="font-weight-600 mb-1" style="font-size: 12.5px;">
                                    Country <span class="text-danger">*</span>
                                </label>
                                <div class="auth-input-wrap">
                                    <span class="auth-icon">
                                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <line x1="2" y1="12" x2="22" y2="12"></line>
                                            <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                                        </svg>
                                    </span>
                                    <select class="form-control auth-input" name="country" id="country" required>
                                        <option selected disabled value="">Choose Country</option>
                                        @include('auth.countries')
                                    </select>
                                </div>
                                @if (isset($errors) && $errors->has('country'))
                                    <small class="text-danger d-block mt-1 font-weight-500">{{ $errors->first('country') }}</small>
                                @endif
                            </div>
                        </div>

                        <!-- Referral ID -->
                        <div class="col-md-6 mb-3">
                            <div class="form-group mb-0">
                                <label class="font-weight-600 mb-1 d-flex justify-content-between" style="font-size: 12.5px;">
                                    <span>Referral Code</span>
                                    <span class="text-muted font-weight-normal">Optional</span>
                                </label>
                                <div class="auth-input-wrap">
                                    <span class="auth-icon">
                                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                            <circle cx="9" cy="7" r="4"></circle>
                                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                        </svg>
                                    </span>
                                    @if (Session::has('ref_by'))
                                        <input type="text" class="form-control auth-input" value="{{ session('ref_by') }}" name="ref_by" placeholder="Referral code" readonly>
                                    @else
                                        <input type="text" class="form-control auth-input" name="ref_by" value="{{ old('ref_by') }}" placeholder="Referral code (if any)">
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="col-md-6 mb-3">
                            <div class="form-group mb-0">
                                <label class="font-weight-600 mb-1" style="font-size: 12.5px;">
                                    Password <span class="text-danger">*</span>
                                </label>
                                <div class="auth-input-wrap">
                                    <span class="auth-icon">
                                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                        </svg>
                                    </span>
                                    <input type="password" class="form-control auth-input has-eye" name="password" id="reg_password" placeholder="Create Password" required autocomplete="new-password">
                                    <button type="button" class="auth-eye-btn" onclick="togglePasswordVisibility('reg_password', this)" title="Toggle password visibility">
                                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                            <circle cx="12" cy="12" r="3"></circle>
                                        </svg>
                                    </button>
                                </div>
                                @if (isset($errors) && $errors->has('password'))
                                    <small class="text-danger d-block mt-1 font-weight-500">{{ $errors->first('password') }}</small>
                                @endif
                            </div>
                        </div>

                        <!-- Confirm Password -->
                        <div class="col-md-6 mb-3">
                            <div class="form-group mb-0">
                                <label class="font-weight-600 mb-1" style="font-size: 12.5px;">
                                    Confirm Password <span class="text-danger">*</span>
                                </label>
                                <div class="auth-input-wrap">
                                    <span class="auth-icon">
                                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                        </svg>
                                    </span>
                                    <input type="password" class="form-control auth-input has-eye" name="password_confirmation" id="confirm-password" value="{{ old('password_confirmation') }}" placeholder="Confirm Password" required autocomplete="new-password">
                                    <button type="button" class="auth-eye-btn" onclick="togglePasswordVisibility('confirm-password', this)" title="Toggle password visibility">
                                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                            <circle cx="12" cy="12" r="3"></circle>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Captcha if enabled -->
                        @if ($settings->captcha == 'true')
                            <div class="col-12 mb-3">
                                <div class="form-group mb-0 {{ isset($errors) && $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                                    <label class="font-weight-600 mb-1" style="font-size: 12.5px;">Security Check <span class="text-danger">*</span></label>
                                    <div>
                                        {!! NoCaptcha::display() !!}
                                        @if (isset($errors) && $errors->has('g-recaptcha-response'))
                                            <small class="text-danger d-block mt-1 font-weight-500">
                                                 <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                            </small>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Terms & Privacy -->
                        @if (isset($terms) && $terms->useterms == 'yes')
                            <div class="col-12 mb-3 mt-1">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck1" required>
                                    <label class="custom-control-label text-muted" for="customCheck1" style="font-size: 12.5px; cursor: pointer;">
                                        I accept the <a href="{{ route('privacy') }}" class="text-primary font-weight-600 text-decoration-none" target="_blank">Terms of Service</a> & <a href="{{ route('privacy') }}" class="text-primary font-weight-600 text-decoration-none" target="_blank">Privacy Policy</a>
                                    </label>
                                </div>
                            </div>
                        @endif

                        <!-- Submit CTA -->
                        <div class="col-12 mt-2 mb-2">
                            <button class="btn btn-auth-primary btn-block w-100 shadow-sm" type="submit">
                                <span>Create Account</span>
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="ml-2">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                    <polyline points="12 5 19 12 12 19"></polyline>
                                </svg>
                            </button>
                        </div>

                        <!-- Social Login if enabled -->
                        @if ($settings->enable_social_login == 'yes')
                            <div class="col-12 my-2 text-center">
                                <div class="d-flex align-items-center my-2">
                                    <div class="auth-divider-line"></div>
                                    <span class="px-2 text-muted text-uppercase" style="font-size: 11px; letter-spacing: 0.05em;">Or register with</span>
                                    <div class="auth-divider-line"></div>
                                </div>
                                <a href="{{ route('social.redirect', ['social' => 'google']) }}" class="login-with-google-custom shadow-xs mt-2">
                                    <svg width="18" height="18" viewBox="0 0 24 24" class="mr-2">
                                        <path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.665-5.17 3.665-9.17z"/>
                                        <path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.26v3.15C3.26 21.36 7.33 24 12 24z"/>
                                        <path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.26C.46 8.16 0 9.98 0 12s.46 3.84 1.26 5.42l4.02-3.15z"/>
                                        <path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.33 0 3.26 2.64 1.26 6.58l4.02 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/>
                                    </svg>
                                    Sign up with Google
                                </a>
                            </div>
                        @endif

                        <!-- Sign In Link -->
                        <div class="col-12 text-center mt-3">
                            <span class="text-muted" style="font-size: 13px;">Already have an account?</span>
                            <a href="{{ route('login') }}" class="font-weight-bold text-primary ml-1 text-decoration-none" style="font-size: 13px;">
                                Sign In
                            </a>
                        </div>
                    </div>
                </form>

                <!-- Footer Copyright -->
                <div class="text-center mt-4 pt-1">
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
        $('#input1').on('keypress', function(e) {
            return e.which !== 32;
        });

        function togglePasswordVisibility(inputId, btn) {
            var input = document.getElementById(inputId);
            if (!input) return;
            if (input.type === 'password') {
                input.type = 'text';
                btn.innerHTML = '<svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line></svg>';
            } else {
                input.type = 'password';
                btn.innerHTML = '<svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>';
            }
        }
    </script>
@endsection
