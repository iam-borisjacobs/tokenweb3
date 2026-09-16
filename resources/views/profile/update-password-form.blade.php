<div class="settings-subcard">
    <div class="settings-subcard-header">
        <h5 class="settings-subcard-title">
            <i class="fa-solid fa-key text-primary"></i>
            {{ __('Change Account Password') }}
        </h5>
        <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-3 py-1">
            <i class="fa-solid fa-shield-halved me-1"></i> {{ __('Credentials') }}
        </span>
    </div>

    <p class="text-muted small mb-4">
        {{ __('Ensure your account is using a long, random password to stay secure. We recommend using a mix of letters, numbers, and symbols.') }}
    </p>

    <form method="POST" action="{{ route('updateuserpass') }}">
        @csrf
        @method('PUT')

        <div class="row g-3 g-md-4">
            <div class="col-12 col-md-6">
                <label class="form-label-custom">
                    {{ __('Current Password') }} <span class="text-danger">*</span>
                </label>
                <div class="input-group-custom">
                    <i class="fa-solid fa-lock input-icon"></i>
                    <input type="password" name="current_password" id="current_password" class="form-control form-control-custom pe-5" placeholder="Enter your current password" required autocomplete="current-password">
                    <button type="button" class="btn btn-link position-absolute end-0 top-50 translate-middle-y text-muted text-decoration-none pe-3" style="z-index: 5;" onclick="togglePasswordVisibility('current_password', this)">
                        <i class="fa-regular fa-eye"></i>
                    </button>
                </div>
            </div>

            <div class="col-12 col-md-6 d-none d-md-block">
                <!-- Spacing balance on desktop -->
            </div>

            <div class="col-12 col-md-6">
                <label class="form-label-custom">
                    {{ __('New Password') }} <span class="text-danger">*</span>
                </label>
                <div class="input-group-custom">
                    <i class="fa-solid fa-lock input-icon"></i>
                    <input type="password" name="password" id="new_password" class="form-control form-control-custom pe-5" placeholder="Enter new password (min. 6 chars)" required autocomplete="new-password">
                    <button type="button" class="btn btn-link position-absolute end-0 top-50 translate-middle-y text-muted text-decoration-none pe-3" style="z-index: 5;" onclick="togglePasswordVisibility('new_password', this)">
                        <i class="fa-regular fa-eye"></i>
                    </button>
                </div>
                <div class="form-text small mt-1 text-muted">
                    <i class="fa-solid fa-info-circle me-1"></i> {{ __('Must be at least 6 characters in length.') }}
                </div>
            </div>

            <div class="col-12 col-md-6">
                <label class="form-label-custom">
                    {{ __('Confirm New Password') }} <span class="text-danger">*</span>
                </label>
                <div class="input-group-custom">
                    <i class="fa-solid fa-check-double input-icon"></i>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control form-control-custom pe-5" placeholder="Re-type your new password" required autocomplete="new-password">
                    <button type="button" class="btn btn-link position-absolute end-0 top-50 translate-middle-y text-muted text-decoration-none pe-3" style="z-index: 5;" onclick="togglePasswordVisibility('password_confirmation', this)">
                        <i class="fa-regular fa-eye"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="mt-4 pt-2 d-flex align-items-center justify-content-between flex-wrap gap-3">
            <button type="submit" class="btn btn-primary px-4 py-2 fw-semibold rounded-pill">
                <i class="fa-solid fa-shield-check me-2"></i> {{ __('Update Password') }}
            </button>

            <a href="{{ route('twofa') }}" class="btn btn-outline-secondary rounded-pill px-3 py-2 small">
                <i class="fa-solid fa-gear me-1"></i> {{ __('Advanced Security & 2FA') }} <i class="fa-solid fa-arrow-right ms-1"></i>
            </a>
        </div>
    </form>
</div>

<script>
    function togglePasswordVisibility(inputId, btn) {
        var input = document.getElementById(inputId);
        if (!input) return;
        var icon = btn.querySelector('i');
        if (input.type === 'password') {
            input.type = 'text';
            if (icon) {
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            }
        } else {
            input.type = 'password';
            if (icon) {
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    }
</script>