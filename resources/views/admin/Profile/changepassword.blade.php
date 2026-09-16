@extends('layouts.app')

@section('content')
<div class="container-fluid py-2">
    <!-- Header Section -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <div class="d-flex align-items-center gap-2 mb-1 flex-wrap">
                <span class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25 px-2.5 py-1 rounded-pill f-11 f-w-700">
                    <i class="fa-solid fa-shield-halved me-1"></i> Security Protocol
                </span>
                <span class="text-muted f-12">• Credential Management</span>
            </div>
            <h3 class="f-w-800 text-dark mb-1 f-20 f-md-24">Change Administrator Password</h3>
            <p class="text-muted mb-0 f-12 f-md-13">Enforce a strong, unpredictable password to secure master access and administrative controls.</p>
        </div>
        <div class="d-flex align-items-center gap-2">
            <a href="{{ route('adminprofile') }}" class="btn btn-outline-secondary rounded-pill px-3 py-2 f-12 f-w-600 d-inline-flex align-items-center gap-2 shadow-sm">
                <i class="fa-solid fa-arrow-left f-11"></i>
                <span>Back to Profile</span>
            </a>
        </div>
    </div>

    <x-danger-alert />
    <x-success-alert />

    @if (session('message'))
        <div class="alert alert-danger alert-dismissible fade show rounded-3 shadow-sm mb-4" role="alert">
            <div class="d-flex align-items-center gap-2">
                <i class="fa-solid fa-circle-exclamation f-16"></i>
                <span class="f-13 f-w-600">{{ session('message') }}</span>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row g-3 g-md-4">
        <!-- Left Column: Password Security Advisory Card -->
        <div class="col-lg-4">
            <div class="card border shadow-sm mb-3" style="border-radius: 16px; overflow: hidden;">
                <div class="card-header border-0 py-4 text-center position-relative" style="background: linear-gradient(135deg, rgba(245, 158, 11, 0.12) 0%, rgba(239, 68, 68, 0.08) 100%);">
                    <div class="rounded-circle bg-warning bg-opacity-20 text-warning d-inline-flex align-items-center justify-content-center shadow-sm" style="width: 72px; height: 72px; font-size: 28px;">
                        <i class="fa-solid fa-key"></i>
                    </div>
                    <h5 class="f-w-800 text-dark mb-0 mt-3 f-16">Password Standards</h5>
                    <p class="text-muted f-12 mb-0">System Security Guidelines</p>
                </div>
                <div class="card-body p-3 border-top">
                    <ul class="list-unstyled mb-0 d-flex flex-column gap-2.5">
                        <li class="d-flex align-items-start gap-2 f-12 text-muted">
                            <i class="fa-solid fa-circle-check text-success mt-1 f-12 flex-shrink-0"></i>
                            <span>At least <strong>8 characters</strong> in length.</span>
                        </li>
                        <li class="d-flex align-items-start gap-2 f-12 text-muted">
                            <i class="fa-solid fa-circle-check text-success mt-1 f-12 flex-shrink-0"></i>
                            <span>Include uppercase and lowercase letters.</span>
                        </li>
                        <li class="d-flex align-items-start gap-2 f-12 text-muted">
                            <i class="fa-solid fa-circle-check text-success mt-1 f-12 flex-shrink-0"></i>
                            <span>Include at least one digit (0-9) & symbol (@#$%).</span>
                        </li>
                        <li class="d-flex align-items-start gap-2 f-12 text-muted">
                            <i class="fa-solid fa-circle-check text-success mt-1 f-12 flex-shrink-0"></i>
                            <span>Avoid reusing old or personal passwords.</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Two-Factor Reminder -->
            <div class="card border shadow-sm p-3" style="border-radius: 14px; background: rgba(14, 165, 233, 0.04); border-color: rgba(14, 165, 233, 0.2) !important;">
                <div class="d-flex align-items-start gap-2.5">
                    <div class="rounded-circle bg-info bg-opacity-20 text-info d-flex align-items-center justify-content-center flex-shrink-0 mt-1" style="width: 28px; height: 28px; font-size: 11px;">
                        <i class="fa-solid fa-shield-halved"></i>
                    </div>
                    <div>
                        <h6 class="f-w-700 f-12 mb-1 text-dark">Enhanced Protection</h6>
                        <p class="text-muted f-11 mb-2">Combine your strong password with Two-Factor Authentication for complete account safety.</p>
                        <a href="{{ route('adminprofile') }}" class="btn btn-sm btn-outline-info rounded-pill py-1 px-3 f-11 f-w-600">
                            Configure 2FA
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column: Password Update Form Card -->
        <div class="col-lg-8">
            <div class="card border shadow-sm" style="border-radius: 16px; overflow: hidden;">
                <div class="card-header border-bottom py-3 px-4" style="background: transparent;">
                    <div class="d-flex align-items-center gap-2">
                        <div class="rounded-circle bg-warning bg-opacity-10 text-warning d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; font-size: 13px;">
                            <i class="fa-solid fa-lock"></i>
                        </div>
                        <div>
                            <h5 class="f-w-700 text-dark mb-0 f-15">Update Password</h5>
                            <small class="text-muted f-11">Verify current credentials before setting your new password.</small>
                        </div>
                    </div>
                </div>

                <div class="card-body p-3 p-md-4">
                    <form method="POST" action="{{ route('adminupdatepass') }}" id="adminPasswordForm">
                        @csrf
                        <input type="hidden" name="id" value="{{ Auth('admin')->User()->id }}">
                        <input type="hidden" name="current_password" value="{{ Auth('admin')->User()->password }}">

                        <!-- 1. Old / Current Password -->
                        <div class="mb-3">
                            <label class="form-label f-12 f-w-700 text-dark mb-1.5">
                                Current Password <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-transparent border-end-0 text-muted f-13">
                                    <i class="fa-solid fa-lock"></i>
                                </span>
                                <input type="password" name="old_password" id="oldPasswordInput" 
                                       class="form-control border-start-0 border-end-0 py-2 px-2 f-13" 
                                       required placeholder="Enter your current password" />
                                <button type="button" class="btn btn-outline-secondary border-start-0 text-muted" 
                                        onclick="togglePasswordVisibility('oldPasswordInput', this)" title="Show/Hide">
                                    <i class="fa-regular fa-eye f-13"></i>
                                </button>
                            </div>
                        </div>

                        <hr class="my-4 text-muted opacity-25">

                        <!-- 2. New Password -->
                        <div class="mb-3">
                            <label class="form-label f-12 f-w-700 text-dark mb-1.5">
                                New Password <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-transparent border-end-0 text-muted f-13">
                                    <i class="fa-solid fa-shield-keyhole fa-key"></i>
                                </span>
                                <input type="password" name="password" id="newPasswordInput" 
                                       class="form-control border-start-0 border-end-0 py-2 px-2 f-13" 
                                       required minlength="8" placeholder="Create a strong new password" 
                                       onkeyup="checkPasswordStrength(this.value)" />
                                <button type="button" class="btn btn-outline-secondary border-start-0 text-muted" 
                                        onclick="togglePasswordVisibility('newPasswordInput', this)" title="Show/Hide">
                                    <i class="fa-regular fa-eye f-13"></i>
                                </button>
                            </div>
                            <!-- Live Strength Progress Bar -->
                            <div class="mt-2">
                                <div class="progress" style="height: 4px; border-radius: 4px; background: rgba(0,0,0,0.06);">
                                    <div class="progress-bar" id="passwordStrengthBar" role="progressbar" style="width: 0%; transition: all 0.3s ease;"></div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mt-1">
                                    <small class="text-muted f-10" id="passwordStrengthLabel">Minimum 8 characters required</small>
                                    <small class="f-10 f-w-700 text-muted" id="passwordStrengthText"></small>
                                </div>
                            </div>
                        </div>

                        <!-- 3. Confirm New Password -->
                        <div class="mb-4">
                            <label class="form-label f-12 f-w-700 text-dark mb-1.5">
                                Confirm New Password <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-transparent border-end-0 text-muted f-13">
                                    <i class="fa-solid fa-check-double"></i>
                                </span>
                                <input type="password" name="password_confirmation" id="confirmPasswordInput" 
                                       class="form-control border-start-0 border-end-0 py-2 px-2 f-13" 
                                       required minlength="8" placeholder="Repeat your new password" 
                                       onkeyup="checkPasswordMatch()" />
                                <button type="button" class="btn btn-outline-secondary border-start-0 text-muted" 
                                        onclick="togglePasswordVisibility('confirmPasswordInput', this)" title="Show/Hide">
                                    <i class="fa-regular fa-eye f-13"></i>
                                </button>
                            </div>
                            <small class="f-10 d-block mt-1" id="passwordMatchFeedback"></small>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-flex align-items-center justify-content-end gap-2 pt-2 border-top">
                            <button type="submit" class="btn btn-primary rounded-pill px-4 py-2 f-13 f-w-700 shadow-sm d-inline-flex align-items-center gap-2" id="submitPasswordBtn">
                                <i class="fa-solid fa-lock"></i>
                                <span>Update Password</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function togglePasswordVisibility(inputId, btn) {
        var input = document.getElementById(inputId);
        var icon = btn.querySelector('i');
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }

    function checkPasswordStrength(password) {
        var bar = document.getElementById('passwordStrengthBar');
        var text = document.getElementById('passwordStrengthText');
        var score = 0;

        if (!password) {
            bar.style.width = '0%';
            text.innerText = '';
            return;
        }

        if (password.length >= 8) score += 25;
        if (password.match(/[a-z]/) && password.match(/[A-Z]/)) score += 25;
        if (password.match(/[0-9]/)) score += 25;
        if (password.match(/[^a-zA-Z0-9]/)) score += 25;

        bar.style.width = score + '%';

        if (score <= 25) {
            bar.className = 'progress-bar bg-danger';
            text.innerText = 'Weak';
            text.className = 'f-10 f-w-700 text-danger';
        } else if (score <= 75) {
            bar.className = 'progress-bar bg-warning';
            text.innerText = 'Medium';
            text.className = 'f-10 f-w-700 text-warning';
        } else {
            bar.className = 'progress-bar bg-success';
            text.innerText = 'Strong';
            text.className = 'f-10 f-w-700 text-success';
        }

        checkPasswordMatch();
    }

    function checkPasswordMatch() {
        var p1 = document.getElementById('newPasswordInput').value;
        var p2 = document.getElementById('confirmPasswordInput').value;
        var feedback = document.getElementById('passwordMatchFeedback');

        if (!p2) {
            feedback.innerText = '';
            return;
        }

        if (p1 === p2) {
            feedback.innerHTML = '<span class="text-success"><i class="fa-solid fa-circle-check me-1"></i> Passwords match perfectly</span>';
        } else {
            feedback.innerHTML = '<span class="text-danger"><i class="fa-solid fa-circle-xmark me-1"></i> Passwords do not match</span>';
        }
    }
</script>
@endsection
