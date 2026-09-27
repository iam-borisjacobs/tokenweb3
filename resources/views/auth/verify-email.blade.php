@extends('layouts.guest')

@section('title', 'Verify Your Email Address')

@section('styles')
    @parent
@endsection

@section('content')
    <section class="auth py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">

                    <!-- Alert Messages -->
                    @if (session('success') || session('status') == 'verification-link-sent')
                        <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm mb-4" role="alert">
                            <div class="d-flex align-items-center">
                                <i class="fa-solid fa-circle-check me-2 f-18"></i>
                                <div>
                                    A fresh verification link has been sent to your email address (<strong>{{ Auth::user()->email ?? 'your email' }}</strong>).
                                </div>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @elseif (session('message'))
                        <div class="alert alert-info alert-dismissible fade show rounded-3 shadow-sm mb-4" role="alert">
                            <div class="d-flex align-items-center">
                                <i class="fa-solid fa-circle-info me-2 f-18"></i>
                                <div>{{ session('message') }}</div>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @else
                        <div class="alert alert-primary alert-dismissible fade show rounded-3 shadow-sm mb-4" role="alert">
                            <div class="d-flex align-items-center">
                                <i class="fa-solid fa-envelope me-2 f-18"></i>
                                <div>
                                    Please verify your email address to access your trading dashboard and start investing.
                                </div>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- Card Body -->
                    <div class="card border-0 shadow-sm rounded-4 text-center p-4 p-md-5">
                        <div class="mb-4">
                            <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3" style="width: 72px; height: 72px; background: rgba(99, 102, 241, 0.12); color: #6366f1;">
                                <i class="fa-solid fa-envelope-open-text" style="font-size: 32px;"></i>
                            </div>
                            <h4 class="f-w-800 text-dark mb-2">Check Your Inbox</h4>
                            <p class="text-muted f-13 mx-auto mb-0" style="max-width: 380px;">
                                We sent a verification link to <strong>{{ Auth::user()->email ?? 'your email address' }}</strong>. Click the link in that email to activate your account.
                            </p>
                        </div>

                        <div class="p-3 rounded-3 mb-4 text-start border bg-light bg-opacity-50">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <i class="fa-solid fa-lightbulb text-warning f-14"></i>
                                <span class="f-w-700 text-dark f-12">Can't find the email?</span>
                            </div>
                            <small class="text-muted f-11 d-block">
                                Be sure to check your <strong>Spam / Junk</strong> folder, or click the button below to request a new verification email.
                            </small>
                        </div>

                        <!-- Resend Form -->
                        <form method="POST" action="{{ route('verification.send') }}" class="mb-3">
                            @csrf
                            <button class="btn btn-primary rounded-pill w-100 py-2.5 f-13 f-w-700 shadow-sm" type="submit">
                                <i class="fa-solid fa-paper-plane me-1"></i> Resend Verification Email
                            </button>
                        </form>

                        <!-- Logout Form -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-outline-secondary rounded-pill w-100 py-2 f-12 f-w-600">
                                <i class="fa-solid fa-right-from-bracket me-1"></i> Log Out
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    @parent
@endsection
