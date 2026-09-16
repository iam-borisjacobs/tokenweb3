@extends('layouts.app')

@section('content')
<div class="container-fluid py-2">
    <!-- Header Section -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <div class="d-flex align-items-center gap-2 mb-1 flex-wrap">
                <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 px-2.5 py-1 rounded-pill f-11 f-w-700">
                    <i class="fa-solid fa-user-shield me-1"></i> Identity & Access
                </span>
                <span class="text-muted f-12">• Administrator Console</span>
            </div>
            <h3 class="f-w-800 text-dark mb-1 f-20 f-md-24">Account Settings & Profile</h3>
            <p class="text-muted mb-0 f-12 f-md-13">Manage your primary administrative credentials, contact details, and authentication security.</p>
        </div>
        <div class="d-flex align-items-center gap-2">
            <a href="{{ url('admin/dashboard/adminchangepassword') }}" class="btn btn-outline-primary rounded-pill px-3 py-2 f-12 f-w-600 d-inline-flex align-items-center gap-2 shadow-sm">
                <i class="fa-solid fa-key f-11"></i>
                <span>Change Password</span>
            </a>
        </div>
    </div>

    <x-danger-alert />
    <x-success-alert />

    @php
        $admin = Auth('admin')->User();
        $is2FaEnabled = ($admin->enable_2fa === 'enabled');
    @endphp

    <div class="row g-3 g-md-4">
        <!-- Left Column: Admin Identity Card & Security Summary -->
        <div class="col-lg-4">
            <!-- 1. Identity Card -->
            <div class="card border shadow-sm mb-3" style="border-radius: 16px; overflow: hidden;">
                <div class="card-header border-0 py-4 text-center position-relative" style="background: linear-gradient(135deg, rgba(99, 98, 231, 0.15) 0%, rgba(14, 165, 233, 0.15) 100%);">
                    <div class="position-relative d-inline-block">
                        <img class="rounded-circle shadow-md border border-3 border-white" 
                             src="{{ asset('admiro/assets/images/profile.png') }}" 
                             alt="Admin Avatar" 
                             style="width: 80px; height: 80px; object-fit: cover;" />
                        <span class="position-absolute bottom-0 end-0 bg-success border border-2 border-white rounded-circle p-1.5" title="Active Administrator"></span>
                    </div>
                    <h5 class="f-w-800 text-dark mb-0 mt-3 f-16">{{ $admin->firstName }} {{ $admin->lastName }}</h5>
                    <p class="text-muted f-12 mb-2">{{ $admin->email }}</p>
                    <span class="badge bg-primary text-white px-3 py-1 rounded-pill f-10 f-w-700 shadow-sm">
                        {{ $admin->type ?? 'Super Administrator' }}
                    </span>
                </div>
                <div class="card-body p-3 border-top">
                    <div class="d-flex align-items-center justify-content-between py-2 border-bottom">
                        <span class="text-muted f-12"><i class="fa-solid fa-shield-halved text-primary me-2"></i> Role Level</span>
                        <span class="f-w-700 f-12 text-dark">Master Console</span>
                    </div>
                    <div class="d-flex align-items-center justify-content-between py-2 border-bottom">
                        <span class="text-muted f-12"><i class="fa-solid fa-lock text-info me-2"></i> 2FA Status</span>
                        @if($is2FaEnabled)
                            <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-2 py-0.5 rounded-pill f-10 f-w-700">
                                <i class="fa-solid fa-circle-check me-1"></i> Active
                            </span>
                        @else
                            <span class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25 px-2 py-0.5 rounded-pill f-10 f-w-700">
                                <i class="fa-solid fa-triangle-exclamation me-1"></i> Disabled
                            </span>
                        @endif
                    </div>
                    <div class="d-flex align-items-center justify-content-between py-2">
                        <span class="text-muted f-12"><i class="fa-regular fa-calendar-check text-secondary me-2"></i> Member Since</span>
                        <span class="f-w-600 f-12 text-dark">{{ $admin->created_at ? \Carbon\Carbon::parse($admin->created_at)->format('M d, Y') : 'Active' }}</span>
                    </div>
                </div>
            </div>

            <!-- 2. Security Advisory Box -->
            <div class="card border shadow-sm p-3" style="border-radius: 14px; background: rgba(99, 98, 231, 0.03); border-color: rgba(99, 98, 231, 0.15) !important;">
                <div class="d-flex align-items-start gap-2.5">
                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center flex-shrink-0 mt-1" style="width: 28px; height: 28px; font-size: 11px;">
                        <i class="fa-solid fa-info"></i>
                    </div>
                    <div>
                        <h6 class="f-w-700 f-12 mb-1 text-dark">Security Best Practice</h6>
                        <p class="text-muted f-11 mb-0" style="line-height: 1.4;">Enable Two-Factor Authentication to enforce verification tokens whenever logging into the administrative console.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column: Settings Form -->
        <div class="col-lg-8">
            <div class="card border shadow-sm" style="border-radius: 16px; overflow: hidden;">
                <div class="card-header border-bottom py-3 px-4" style="background: transparent;">
                    <div class="d-flex align-items-center gap-2">
                        <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; font-size: 13px;">
                            <i class="fa-solid fa-user-pen"></i>
                        </div>
                        <div>
                            <h5 class="f-w-700 text-dark mb-0 f-15">Personal Profile Details</h5>
                            <small class="text-muted f-11">Update your administrative account information.</small>
                        </div>
                    </div>
                </div>

                <div class="card-body p-3 p-md-4">
                    <form role="form" method="POST" action="{{ route('upadprofile') }}">
                        @csrf

                        <!-- Row 1: First and Last Name -->
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label f-12 f-w-700 text-dark mb-1.5">
                                    <i class="fa-regular fa-user text-muted me-1"></i> First Name <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="name" class="form-control rounded-3 py-2 px-3 f-13" 
                                       value="{{ old('name', $admin->firstName) }}" required placeholder="Enter first name" />
                            </div>
                            <div class="col-md-6">
                                <label class="form-label f-12 f-w-700 text-dark mb-1.5">
                                    <i class="fa-regular fa-user text-muted me-1"></i> Last Name <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="lname" class="form-control rounded-3 py-2 px-3 f-13" 
                                       value="{{ old('lname', $admin->lastName) }}" required placeholder="Enter last name" />
                            </div>
                        </div>

                        <!-- Row 2: Email and Phone -->
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label f-12 f-w-700 text-dark mb-1.5">
                                    <i class="fa-regular fa-envelope text-muted me-1"></i> Email Address
                                </label>
                                <div class="input-group">
                                    <input type="email" class="form-control rounded-start-3 py-2 px-3 f-13 bg-light text-muted" 
                                           value="{{ $admin->email }}" readonly disabled />
                                    <span class="input-group-text bg-light border-start-0 text-muted f-11 px-2.5" title="Managed by Root System">
                                        <i class="fa-solid fa-lock"></i>
                                    </span>
                                </div>
                                <small class="text-muted f-10 mt-1 d-block">Primary console login identifier (Protected).</small>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label f-12 f-w-700 text-dark mb-1.5">
                                    <i class="fa-solid fa-phone text-muted me-1"></i> Contact Phone
                                </label>
                                <input type="text" name="phone" class="form-control rounded-3 py-2 px-3 f-13" 
                                       value="{{ old('phone', $admin->phone) }}" placeholder="+1 (555) 000-0000" />
                                <small class="text-muted f-10 mt-1 d-block">For administrative security dispatches.</small>
                            </div>
                        </div>

                        <!-- Section: Two-Factor Authentication -->
                        <div class="p-3 rounded-3 border mb-4" style="background: rgba(99, 98, 231, 0.02); border-color: rgba(99, 98, 231, 0.12) !important;">
                            <div class="d-flex align-items-center justify-content-between mb-2 flex-wrap gap-2">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center" style="width: 28px; height: 28px; font-size: 12px;">
                                        <i class="fa-solid fa-shield-halved"></i>
                                    </div>
                                    <div>
                                        <h6 class="f-w-700 f-13 mb-0 text-dark">Two-Factor Authentication (2FA)</h6>
                                        <small class="text-muted f-11">Enforce second-factor security checks upon administrator login.</small>
                                    </div>
                                </div>
                                <div>
                                    @if($is2FaEnabled)
                                        <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-2.5 py-1 rounded-pill f-11 f-w-700">
                                            <i class="fa-solid fa-check me-1"></i> Currently Enabled
                                        </span>
                                    @else
                                        <span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary border-opacity-25 px-2.5 py-1 rounded-pill f-11 f-w-700">
                                            <i class="fa-solid fa-xmark me-1"></i> Currently Disabled
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="mt-3">
                                <label class="form-label f-11 f-w-700 text-muted text-uppercase mb-1">Set Authentication Policy</label>
                                <select class="form-select rounded-3 py-2 px-3 f-13" name="token" style="max-width: 320px;">
                                    <option value="enabled" {{ $admin->enable_2fa === 'enabled' ? 'selected' : '' }}>
                                        🛡️ Enabled — Require 2FA on every login
                                    </option>
                                    <option value="disabled" {{ $admin->enable_2fa !== 'enabled' ? 'selected' : '' }}>
                                        🔓 Disabled — Standard username & password
                                    </option>
                                </select>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-flex align-items-center justify-content-end gap-2 pt-2 border-top">
                            <button type="submit" class="btn btn-primary rounded-pill px-4 py-2 f-13 f-w-700 shadow-sm d-inline-flex align-items-center gap-2">
                                <i class="fa-solid fa-floppy-disk"></i>
                                <span>Save Changes</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
