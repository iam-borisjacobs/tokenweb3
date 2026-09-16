<form action="javascript:void(0)" method="POST" id="emailform">
    @csrf
    @method('PUT')

    <div class="row g-4">
        <!-- Section 1: Mail Server Engine -->
        <div class="col-12">
            <div class="settings-card-section">
                <div class="d-flex align-items-center justify-content-between mb-3 pb-2 border-bottom">
                    <div class="d-flex align-items-center gap-2">
                        <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                            <i class="fa fa-envelope f-16"></i>
                        </div>
                        <div>
                            <h6 class="f-w-700 mb-0">Outbound Mail Dispatch Engine</h6>
                            <small class="text-muted">Configure how transactional emails, OTPs, and notifications are sent to users.</small>
                        </div>
                    </div>
                </div>

                <div class="row g-3">
                    <!-- Mail Server Mode -->
                    <div class="col-12 mb-2">
                        <label class="form-label f-w-600 f-13 d-block mb-2">Mail Protocol / Driver</label>
                        <div class="selectgroup">
                            <label class="selectgroup-item">
                                <input type="radio" name="server" id="sendmailserver" value="sendmail" class="selectgroup-input" {{ $settings->mail_server == 'sendmail' ? 'checked' : '' }}>
                                <span class="selectgroup-button"><i class="fa fa-paper-plane me-1"></i> PHP Sendmail</span>
                            </label>
                            <label class="selectgroup-item">
                                <input type="radio" name="server" id="smtpserver" value="smtp" class="selectgroup-input" {{ $settings->mail_server != 'sendmail' ? 'checked' : '' }}>
                                <span class="selectgroup-button"><i class="fa fa-server me-1"></i> SMTP Server</span>
                            </label>
                        </div>
                        <small class="text-muted d-block mt-1 f-11">Choose SMTP for reliable deliverability and anti-spam authentication.</small>
                    </div>

                    <!-- Email From & Sender Name -->
                    <div class="col-md-6">
                        <label class="form-label f-w-600 f-13">System Sender Email <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa fa-at text-muted"></i></span>
                            <input type="email" name="emailfrom" class="form-control" value="{{ $settings->emailfrom }}" placeholder="no-reply@yoursite.com" required>
                        </div>
                        <small class="text-muted f-11">The 'From' email address clients see on incoming messages.</small>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label f-w-600 f-13">Sender Display Name <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa fa-user text-muted"></i></span>
                            <input type="text" name="emailfromname" class="form-control" value="{{ $settings->emailfromname }}" placeholder="e.g. ECX Groups Notifications" required>
                        </div>
                        <small class="text-muted f-11">Display name visible in client email inboxes.</small>
                    </div>

                    <!-- SMTP Details (conditionally visible) -->
                    <div class="col-12 smtp {{ $settings->mail_server == 'sendmail' ? 'd-none' : '' }}">
                        <div class="settings-subcard p-4 mt-2">
                            <h6 class="f-w-700 text-primary mb-3 f-13">
                                <i class="fa fa-lock me-1"></i> SMTP Server Authentication Credentials
                            </h6>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label f-w-600 f-13">SMTP Host</label>
                                    <input type="text" name="smtp_host" class="form-control smtpinput" value="{{ $settings->smtp_host }}" placeholder="e.g. smtp.mailgun.org or mail.yourdomain.com">
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label f-w-600 f-13">SMTP Port</label>
                                    <input type="number" name="smtp_port" class="form-control smtpinput" value="{{ $settings->smtp_port }}" placeholder="e.g. 465 or 587">
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label f-w-600 f-13">Encryption</label>
                                    <select name="smtp_encrypt" class="form-select smtpinput">
                                        <option value="ssl" {{ strtolower($settings->smtp_encrypt) == 'ssl' ? 'selected' : '' }}>SSL (Port 465)</option>
                                        <option value="tls" {{ strtolower($settings->smtp_encrypt) == 'tls' ? 'selected' : '' }}>TLS (Port 587)</option>
                                        <option value="" {{ empty($settings->smtp_encrypt) ? 'selected' : '' }}>None</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label f-w-600 f-13">SMTP Username / Email</label>
                                    <input type="text" name="smtp_user" class="form-control smtpinput" value="{{ $settings->smtp_user }}" placeholder="username or email">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label f-w-600 f-13">SMTP Password</label>
                                    <div class="input-group">
                                        <input type="password" name="smtp_password" id="smtp_pass_field" class="form-control smtpinput font-monospace" value="{{ $settings->smtp_password }}" placeholder="SMTP Account Password">
                                        <button class="btn btn-outline-secondary" type="button" onclick="togglePasswordVisibility('smtp_pass_field', this)">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section 2: Google OAuth Social Login -->
        <div class="col-12">
            <div class="settings-card-section">
                <div class="d-flex align-items-center justify-content-between mb-3 pb-2 border-bottom">
                    <div class="d-flex align-items-center gap-2">
                        <div class="rounded-circle bg-danger bg-opacity-10 text-danger d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                            <i class="fab fa-google f-16"></i>
                        </div>
                        <div>
                            <h6 class="f-w-700 mb-0">Google OAuth 2.0 Login Integration</h6>
                            <small class="text-muted">Allow investors to log in and register seamlessly using their Google accounts.</small>
                        </div>
                    </div>
                    <a href="https://console.cloud.google.com/apis/credentials" target="_blank" class="btn btn-outline-secondary btn-sm rounded-pill px-3 f-12">
                        <i class="fa fa-external-link-alt me-1"></i> Google Console
                    </a>
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label f-w-600 f-13">Google Client ID</label>
                        <input type="text" name="google_id" class="form-control font-monospace" value="{{ $settings->google_id }}" placeholder="e.g. 123456789-xxx.apps.googleusercontent.com">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label f-w-600 f-13">Google Client Secret</label>
                        <input type="password" name="google_secret" class="form-control font-monospace" value="{{ $settings->google_secret }}" placeholder="GOCSPX-...">
                    </div>

                    <div class="col-12">
                        <label class="form-label f-w-600 f-13">Authorized Redirect URI (Callback)</label>
                        <div class="input-group">
                            <input type="text" id="googleRedirectUri" name="google_redirect" class="form-control font-monospace" value="{{ $settings->google_redirect ?: url('/auth/google/callback') }}">
                            <button type="button" class="btn btn-outline-primary px-3" onclick="copyToClipboard('googleRedirectUri', this)">
                                <i class="fa fa-copy me-1"></i> Copy URI
                            </button>
                        </div>
                        <small class="text-muted f-11">Paste this exact Authorized redirect URI in your Google Cloud Console credentials page.</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section 3: Google reCAPTCHA v2 / v3 -->
        <div class="col-12">
            <div class="settings-card-section">
                <div class="d-flex align-items-center justify-content-between mb-3 pb-2 border-bottom">
                    <div class="d-flex align-items-center gap-2">
                        <div class="rounded-circle bg-info bg-opacity-10 text-info d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                            <i class="fa fa-shield-alt f-16"></i>
                        </div>
                        <div>
                            <h6 class="f-w-700 mb-0">Google reCAPTCHA Anti-Bot Protection</h6>
                            <small class="text-muted">Guard login and registration endpoints against brute-force attacks and automated bots.</small>
                        </div>
                    </div>
                    <a href="https://www.google.com/recaptcha/admin/create" target="_blank" class="btn btn-outline-secondary btn-sm rounded-pill px-3 f-12">
                        <i class="fa fa-external-link-alt me-1"></i> reCAPTCHA Admin
                    </a>
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label f-w-600 f-13">reCAPTCHA Site Key (Public)</label>
                        <input type="text" name="capt_sitekey" class="form-control font-monospace" value="{{ $settings->capt_sitekey }}" placeholder="Paste your Google reCAPTCHA Site Key">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label f-w-600 f-13">reCAPTCHA Secret Key (Private)</label>
                        <input type="password" name="capt_secret" class="form-control font-monospace" value="{{ $settings->capt_secret }}" placeholder="Paste your Google reCAPTCHA Secret Key">
                    </div>
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="col-12 text-end pt-2">
            <button type="submit" class="btn btn-primary rounded-pill px-5 py-2 f-w-600 shadow-sm" id="emailSaveBtn">
                <i class="fa fa-save me-2"></i> Save Email & Authentication Settings
            </button>
        </div>
    </div>
</form>

<script>
    function togglePasswordVisibility(inputId, btn) {
        var input = document.getElementById(inputId);
        if (input) {
            if (input.type === 'password') {
                input.type = 'text';
                btn.innerHTML = '<i class="fa fa-eye-slash"></i>';
            } else {
                input.type = 'password';
                btn.innerHTML = '<i class="fa fa-eye"></i>';
            }
        }
    }

    function copyToClipboard(inputId, btn) {
        var input = document.getElementById(inputId);
        if (input) {
            input.select();
            input.setSelectionRange(0, 99999);
            navigator.clipboard.writeText(input.value);
            var orig = btn.innerHTML;
            btn.innerHTML = '<i class="fa fa-check me-1"></i> Copied!';
            setTimeout(function() {
                btn.innerHTML = orig;
            }, 2000);
        }
    }

    // Toggle SMTP inputs on mail server radio change
    document.querySelectorAll('input[name="server"]').forEach(function(radio) {
        radio.addEventListener('change', function() {
            var smtpContainer = document.querySelector('.smtp');
            if (this.value === 'smtp') {
                if (smtpContainer) smtpContainer.classList.remove('d-none');
            } else {
                if (smtpContainer) smtpContainer.classList.add('d-none');
            }
        });
    });
</script>
