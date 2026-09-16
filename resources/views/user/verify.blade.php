@extends('layouts.dash')
@section('title', 'Identity Verification')

@section('content')
<div class="container-fluid py-4">
    <!-- Breadcrumb & Header -->
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h3 class="f-w-800 text-dark mb-1">Identity Verification</h3>
            <p class="text-muted f-13 mb-0">Compliance, KYC status, and security verification details</p>
        </div>
        <div>
            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary rounded-pill px-3 py-2 f-12 f-w-600">
                <i class="fa-solid fa-arrow-left me-1"></i> Back to Dashboard
            </a>
        </div>
    </div>

    <x-danger-alert/>
    <x-success-alert/>

    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10 col-12">
            @if (Auth::user()->account_verify == 'Verified')
                <!-- VERIFIED STATE -->
                <div class="card border shadow-sm mb-4" style="border-radius: 16px;">
                    <div class="card-body p-4 p-md-5 text-center">
                        <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3" style="width: 80px; height: 80px; background: rgba(16, 185, 129, 0.12); color: #10b981; border: 2px solid rgba(16, 185, 129, 0.3);">
                            <i class="fa-solid fa-circle-check" style="font-size: 42px;"></i>
                        </div>
                        <h4 class="f-w-800 text-dark mb-2">Identity Verification Completed</h4>
                        <p class="text-muted f-14 mb-4 mx-auto" style="max-width: 500px;">
                            Your trading account has met all regulatory requirements and is fully verified under international KYC / AML standards.
                        </p>

                        <div class="p-3 rounded-3 mb-4 text-start border bg-light bg-opacity-50">
                            <div class="row g-3">
                                <div class="col-sm-6">
                                    <small class="text-muted f-11 text-uppercase f-w-700 d-block">Account Holder</small>
                                    <span class="f-w-700 text-dark f-14">{{ Auth::user()->name }}</span>
                                </div>
                                <div class="col-sm-6">
                                    <small class="text-muted f-11 text-uppercase f-w-700 d-block">Registered Email</small>
                                    <span class="f-w-700 text-dark f-14">{{ Auth::user()->email }}</span>
                                </div>
                                <div class="col-sm-6">
                                    <small class="text-muted f-11 text-uppercase f-w-700 d-block">Verification Status</small>
                                    <span class="badge bg-light-success text-success rounded-pill px-3 py-1 f-12 f-w-700 mt-1">
                                        <i class="fa-solid fa-shield-check me-1"></i> Verified & Approved
                                    </span>
                                </div>
                                <div class="col-sm-6">
                                    <small class="text-muted f-11 text-uppercase f-w-700 d-block">Trading & Limit Tier</small>
                                    <span class="badge bg-light-primary text-primary rounded-pill px-3 py-1 f-12 f-w-700 mt-1">
                                        Tier 2 (Full Access & Max Limits)
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Unlocked Capabilities List -->
                        <div class="text-start mb-4 p-3 rounded-3 border" style="background: rgba(99, 102, 241, 0.04);">
                            <h6 class="f-w-700 text-dark mb-3 f-13 text-uppercase" style="letter-spacing: 0.04em;">
                                <i class="fa-solid fa-circle-nodes text-primary me-2"></i> Enabled Features on Your Account
                            </h6>
                            <div class="row g-2">
                                <div class="col-sm-6 d-flex align-items-center gap-2 f-13 text-muted">
                                    <i class="fa-solid fa-circle-check text-success"></i> Unlimited deposits & trading volume
                                </div>
                                <div class="col-sm-6 d-flex align-items-center gap-2 f-13 text-muted">
                                    <i class="fa-solid fa-circle-check text-success"></i> Maximum withdrawal tier enabled
                                </div>
                                <div class="col-sm-6 d-flex align-items-center gap-2 f-13 text-muted">
                                    <i class="fa-solid fa-circle-check text-success"></i> Multi-chain Web3 wallet synchronization
                                </div>
                                <div class="col-sm-6 d-flex align-items-center gap-2 f-13 text-muted">
                                    <i class="fa-solid fa-circle-check text-success"></i> Priority 24/7 dedicated support
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('dashboard') }}" class="btn btn-primary rounded-pill px-4 py-2 f-13 f-w-600 shadow-sm">
                                <i class="fa-solid fa-house me-1"></i> Return to Dashboard
                            </a>
                            <a href="{{ route('support') }}" class="btn btn-outline-secondary rounded-pill px-4 py-2 f-13 f-w-600">
                                <i class="fa-solid fa-headset me-1"></i> Need Help?
                            </a>
                        </div>
                    </div>
                </div>

            @elseif (Auth::user()->account_verify == 'Under review')
                <!-- UNDER REVIEW STATE -->
                <div class="card border shadow-sm mb-4" style="border-radius: 16px;">
                    <div class="card-body p-4 p-md-5 text-center">
                        <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3" style="width: 80px; height: 80px; background: rgba(245, 158, 11, 0.12); color: #f59e0b; border: 2px solid rgba(245, 158, 11, 0.3);">
                            <i class="fa-solid fa-clock-rotate-left" style="font-size: 38px;"></i>
                        </div>
                        <h4 class="f-w-800 text-dark mb-2">KYC Application Under Review</h4>
                        <p class="text-muted f-14 mb-4 mx-auto" style="max-width: 500px;">
                            We have received your verification documents. Our compliance team is currently reviewing your application. You will be notified once complete.
                        </p>

                        <div class="mb-4">
                            <span class="badge bg-light-warning text-warning rounded-pill px-3 py-2 f-12 f-w-700">
                                <span class="pulse-beacon me-1" style="background-color: #f59e0b;"></span> Review in Progress
                            </span>
                        </div>

                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('dashboard') }}" class="btn btn-primary rounded-pill px-4 py-2 f-13 f-w-600">
                                Return to Dashboard
                            </a>
                            <a href="{{ route('support') }}" class="btn btn-outline-secondary rounded-pill px-4 py-2 f-13 f-w-600">
                                Contact Support
                            </a>
                        </div>
                    </div>
                </div>

            @else
                <!-- UNVERIFIED STATE -->
                <div class="card border shadow-sm mb-4" style="border-radius: 16px;">
                    <div class="card-body p-4 p-md-5 text-center">
                        <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3" style="width: 80px; height: 80px; background: rgba(99, 102, 241, 0.12); color: #6366f1; border: 2px solid rgba(99, 102, 241, 0.3);">
                            <i class="fa-solid fa-id-card" style="font-size: 38px;"></i>
                        </div>
                        <h4 class="f-w-800 text-dark mb-2">Begin Your Identity Verification</h4>
                        <p class="text-muted f-14 mb-4 mx-auto" style="max-width: 520px;">
                            To comply with international financial security standards (KYC/AML), please verify your identity to unlock all platform trading features, higher withdrawal limits, and automated yields.
                        </p>

                        <div class="row g-3 mb-4 text-start">
                            <div class="col-md-4">
                                <div class="p-3 border rounded-3 text-center h-100 bg-light bg-opacity-25">
                                    <div class="f-w-800 text-primary f-18 mb-1">01</div>
                                    <div class="f-w-700 text-dark f-13 mb-1">Personal Details</div>
                                    <small class="text-muted f-11">Provide legal name, address & phone number</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="p-3 border rounded-3 text-center h-100 bg-light bg-opacity-25">
                                    <div class="f-w-800 text-primary f-18 mb-1">02</div>
                                    <div class="f-w-700 text-dark f-13 mb-1">Government ID</div>
                                    <small class="text-muted f-11">Upload photo of Passport, Driver's License or ID</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="p-3 border rounded-3 text-center h-100 bg-light bg-opacity-25">
                                    <div class="f-w-800 text-primary f-18 mb-1">03</div>
                                    <div class="f-w-700 text-dark f-13 mb-1">Instant Activation</div>
                                    <small class="text-muted f-11">Fast review by compliance system</small>
                                </div>
                            </div>
                        </div>

                        <div>
                            <a href="{{ route('kycform') }}" class="btn btn-primary rounded-pill px-4 py-2 f-14 f-w-700 shadow-sm">
                                Start KYC Verification Now <i class="fa-solid fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Help / Support Footer -->
            <div class="card border shadow-sm" style="border-radius: 14px;">
                <div class="card-body p-4 d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-circle d-flex align-items-center justify-content-center text-primary" style="width: 44px; height: 44px; font-size: 20px; background: rgba(99, 102, 241, 0.1);">
                            <i class="fa-solid fa-headset"></i>
                        </div>
                        <div>
                            <h6 class="f-w-700 text-dark mb-0 f-14">Need Assistance with Verification?</h6>
                            <small class="text-muted f-12">Our compliance and security team is available 24/7 to assist you.</small>
                        </div>
                    </div>
                    <div>
                        <a href="{{ route('support') }}" class="btn btn-outline-primary rounded-pill px-3 py-2 f-12 f-w-600">
                            Contact Support
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
