@extends('layouts.guest')

@section('title', 'Confirm Password Security Verification')

@section('styles')
@parent
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@7.2.96/css/materialdesignicons.min.css">
<style>
    .confirm-security-card {
        background-color: #ffffff;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        border: 1px solid #e2e8f0;
        padding: 40px 32px;
        max-width: 460px;
        width: 100%;
        margin: 0 auto;
    }
    .confirm-security-icon {
        width: 64px;
        height: 64px;
        border-radius: 50%;
        background: rgba(99, 98, 231, 0.12);
        color: #6362e7;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        margin-bottom: 20px;
        border: 1px solid rgba(99, 98, 231, 0.25);
    }
    .confirm-input-wrap {
        position: relative;
    }
    .confirm-input-wrap input {
        height: 50px;
        border-radius: 10px;
        border: 1.5px solid #cbd5e1;
        font-size: 15px;
        padding-left: 45px;
        transition: all 0.2s ease;
    }
    .confirm-input-wrap input:focus {
        border-color: #6362e7;
        box-shadow: 0 0 0 3px rgba(99, 98, 231, 0.2);
    }
    .confirm-input-wrap .input-icon {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
        font-size: 16px;
    }
    .btn-confirm-submit {
        height: 48px;
        border-radius: 10px;
        font-weight: 700;
        font-size: 15px;
        background: linear-gradient(135deg, #6362e7 0%, #4f46e5 100%);
        border: none;
        color: #ffffff !important;
        transition: all 0.2s ease;
    }
    .btn-confirm-submit:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(99, 98, 231, 0.35);
        color: #ffffff !important;
    }
</style>
@endsection

@section('content')
<section class="auth d-flex align-items-center justify-content-center" style="min-height: 100vh; padding: 40px 15px; background: #f8fafc;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="confirm-security-card text-center">
                    
                    <!-- Shield Icon -->
                    <div class="confirm-security-icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#6362e7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                            <path d="M12 11v4"></path>
                            <circle cx="12" cy="9" r="1"></circle>
                        </svg>
                    </div>

                    <h4 class="font-weight-bold text-dark mb-2" style="font-size: 20px;">Security Verification</h4>
                    <p class="text-muted mb-4" style="font-size: 13.5px; line-height: 1.5;">
                        This is a protected area of your account. Please enter your account password to confirm your identity and proceed.
                    </p>

                    <form method="POST" action="{{ route('password.confirm') }}" class="text-left">
                        @csrf
                        <div class="form-group mb-3">
                            <label class="font-weight-600 text-dark mb-2" style="font-size: 13px;">
                                Account Password <span class="text-danger">*</span>
                            </label>
                            <div class="confirm-input-wrap">
                                <svg class="input-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #94a3b8; pointer-events: none;">
                                    <circle cx="7.5" cy="15.5" r="5.5"></circle>
                                    <path d="M11.5 11.5L22 1"></path>
                                    <path d="M18 5l3 3"></path>
                                    <path d="M15 8l2 2"></path>
                                </svg>
                                <input type="password" class="form-control" name="password" placeholder="Enter your password" required autocomplete="current-password" autofocus>
                            </div>
                        </div>

                        @if (isset($errors) && $errors->any())
                            <div class="alert alert-danger p-2 px-3 rounded mb-3" style="font-size: 12.5px;">
                                @foreach ($errors->all() as $error)
                                    <div>{{ $error }}</div>
                                @endforeach
                            </div>
                        @endif

                        <div class="mt-4 mb-3">
                            <button class="btn btn-confirm-submit btn-block w-100 shadow-sm" type="submit">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" class="mr-2" style="vertical-align: -3px; display: inline-block;">
                                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                    <path d="M7 11V7a5 5 0 0 1 9.9-1"></path>
                                </svg>Confirm & Continue
                            </button>
                        </div>

                        <div class="text-center mt-3">
                            <a href="{{ route('dashboard') }}" class="text-muted text-decoration-none" style="font-size: 13px;">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1" style="vertical-align: -2px; display: inline-block;">
                                    <line x1="19" y1="12" x2="5" y2="12"></line>
                                    <polyline points="12 19 5 12 12 5"></polyline>
                                </svg>Return to Dashboard
                            </a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection