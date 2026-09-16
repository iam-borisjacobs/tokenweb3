<form action="javascript:void(0)" method="POST" id="whatsappform">
    @csrf
    @method('PUT')

    @php
        $notifs = is_array($whatsappSettings->notifications) 
            ? $whatsappSettings->notifications 
            : json_decode($whatsappSettings->notifications ?? '[]', true);
    @endphp

    <div class="row g-4">
        <!-- Section 1: WhatsApp Gateway Credentials -->
        <div class="col-12">
            <div class="settings-card-section">
                <div class="d-flex align-items-center justify-content-between mb-3 pb-3 border-bottom flex-wrap gap-2">
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 42px; height: 42px; background: rgba(37, 211, 102, 0.15); color: #25D366;">
                            <i class="fa fa-whatsapp f-22"></i>
                        </div>
                        <div>
                            <h6 class="f-w-700 mb-0">WhatsApp Real-Time Administrator Alerts</h6>
                            <small class="text-muted">Receive automated push alerts on your WhatsApp whenever users perform actions on the platform.</small>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge {{ $whatsappSettings->enabled ? 'bg-success' : 'bg-secondary' }} px-3 py-2 rounded-pill f-12" id="whatsapp-status-badge">
                            <i class="fa {{ $whatsappSettings->enabled ? 'fa-check-circle' : 'fa-power-off' }} me-1"></i>
                            {{ $whatsappSettings->enabled ? 'Alerts Active' : 'Alerts Disabled' }}
                        </span>
                    </div>
                </div>

                <!-- Master On/Off Switch & Provider -->
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label f-w-600 f-13 d-block">WhatsApp Alerts Master Switch</label>
                        <div class="selectgroup">
                            <label class="selectgroup-item">
                                <input type="radio" name="enabled" value="1" class="selectgroup-input" {{ $whatsappSettings->enabled ? 'checked' : '' }} onchange="toggleWhatsAppStatusBadge(true)">
                                <span class="selectgroup-button"><i class="fa fa-check me-1 text-success"></i> Enabled</span>
                            </label>
                            <label class="selectgroup-item">
                                <input type="radio" name="enabled" value="0" class="selectgroup-input" {{ !$whatsappSettings->enabled ? 'checked' : '' }} onchange="toggleWhatsAppStatusBadge(false)">
                                <span class="selectgroup-button"><i class="fa fa-times me-1 text-danger"></i> Disabled</span>
                            </label>
                        </div>
                        <small class="text-muted d-block mt-1 f-11">When disabled, no WhatsApp notifications will be sent.</small>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label f-w-600 f-13">Gateway Provider <span class="text-danger">*</span></label>
                        <select name="provider" id="whatsapp_provider" class="form-select" onchange="updateProviderHint()">
                            <option value="ultramsg" {{ $whatsappSettings->provider == 'ultramsg' ? 'selected' : '' }}>UltraMsg (api.ultramsg.com) - Recommended</option>
                            <option value="green_api" {{ $whatsappSettings->provider == 'green_api' ? 'selected' : '' }}>Green-API (api.green-api.com)</option>
                        </select>
                        <small class="text-muted f-11" id="provider_hint">UltraMsg: Uses standard instance ID (e.g. instance101234) and token.</small>
                    </div>
                </div>

                <!-- API Credentials -->
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label f-w-600 f-13">Instance ID <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa fa-hashtag text-muted"></i></span>
                            <input type="text" name="instance_id" id="whatsapp_instance_id" class="form-control" value="{{ $whatsappSettings->instance_id }}" placeholder="e.g. instance105423" required>
                        </div>
                        <small class="text-muted f-11">Your UltraMsg Instance ID or Green-API IdInstance.</small>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label f-w-600 f-13">API Token / Secret <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa fa-key text-muted"></i></span>
                            <input type="password" name="token" id="whatsapp_token" class="form-control" value="{{ $whatsappSettings->token }}" placeholder="Enter API Token" required>
                            <button class="btn btn-outline-secondary" type="button" onclick="toggleWhatsAppTokenVisibility(this)">
                                <i class="fa fa-eye"></i>
                            </button>
                        </div>
                        <small class="text-muted f-11">Authentication token from your gateway console.</small>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label f-w-600 f-13">Admin WhatsApp Number <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa fa-phone text-muted"></i></span>
                            <input type="text" name="admin_number" id="whatsapp_admin_number" class="form-control" value="{{ $whatsappSettings->admin_number }}" placeholder="e.g. +1234567890" required>
                        </div>
                        <small class="text-muted f-11">Include country code (e.g. <code>+1...</code> or <code>+44...</code> or <code>+234...</code>).</small>
                    </div>
                </div>

                <!-- Provider Quick Setup Help -->
                <div class="alert alert-light border mt-4 mb-0 py-3 px-3 rounded-3">
                    <div class="d-flex align-items-start gap-2">
                        <i class="fa fa-info-circle text-primary f-18 mt-1"></i>
                        <div class="f-12">
                            <strong class="text-dark d-block mb-1">Quick 2-Minute Gateway Setup:</strong>
                            <ol class="mb-0 ps-3 text-muted">
                                <li>Create a free account on <a href="https://ultramsg.com" target="_blank" class="fw-bold text-primary">UltraMsg.com</a> or <a href="https://green-api.com" target="_blank" class="fw-bold text-primary">Green-API.com</a>.</li>
                                <li>Open WhatsApp on your mobile phone &rarr; <em>Linked Devices</em> &rarr; scan the QR code displayed on your gateway console.</li>
                                <li>Copy your <strong>Instance ID</strong> and <strong>Token</strong> into the fields above, enter your WhatsApp phone number, and click <strong>"Send Test Message"</strong> below!</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section 2: Event Notification Toggles -->
        <div class="col-12">
            <div class="settings-card-section">
                <div class="d-flex align-items-center justify-content-between mb-3 pb-2 border-bottom flex-wrap gap-2">
                    <div>
                        <h6 class="f-w-700 mb-0">Individual Event Alert Toggles</h6>
                        <small class="text-muted">Select exactly which platform activities trigger an instant WhatsApp notification to your phone.</small>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-outline-primary btn-sm rounded-pill px-3 f-12" onclick="toggleAllWhatsAppEvents(true)">
                            <i class="fa fa-check-square-o me-1"></i> Enable All
                        </button>
                        <button type="button" class="btn btn-outline-secondary btn-sm rounded-pill px-3 f-12" onclick="toggleAllWhatsAppEvents(false)">
                            <i class="fa fa-square-o me-1"></i> Disable All
                        </button>
                    </div>
                </div>

                <div class="row g-3">
                    <!-- Deposit Alert -->
                    <div class="col-md-6 col-lg-3">
                        <div class="p-3 border rounded-3 h-100 bg-light bg-opacity-25 d-flex flex-column justify-content-between">
                            <div>
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <div class="rounded-circle bg-success bg-opacity-10 text-success d-flex align-items-center justify-content-center" style="width: 34px; height: 34px;">
                                        <i class="fa fa-arrow-down f-14"></i>
                                    </div>
                                    <div class="form-check form-switch m-0">
                                        <input class="form-check-input notif-event-switch" type="checkbox" name="notif_on_deposit" id="notif_on_deposit" {{ !empty($notifs['on_deposit']) ? 'checked' : '' }} style="cursor: pointer;">
                                    </div>
                                </div>
                                <h6 class="f-w-700 f-13 mb-1">New Deposit</h6>
                                <p class="text-muted f-11 mb-0">Dispatched when a user creates a deposit or uploads payment receipt proof.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Withdrawal Alert -->
                    <div class="col-md-6 col-lg-3">
                        <div class="p-3 border rounded-3 h-100 bg-light bg-opacity-25 d-flex flex-column justify-content-between">
                            <div>
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <div class="rounded-circle bg-danger bg-opacity-10 text-danger d-flex align-items-center justify-content-center" style="width: 34px; height: 34px;">
                                        <i class="fa fa-arrow-up f-14"></i>
                                    </div>
                                    <div class="form-check form-switch m-0">
                                        <input class="form-check-input notif-event-switch" type="checkbox" name="notif_on_withdrawal" id="notif_on_withdrawal" {{ !empty($notifs['on_withdrawal']) ? 'checked' : '' }} style="cursor: pointer;">
                                    </div>
                                </div>
                                <h6 class="f-w-700 f-13 mb-1">Withdrawal Request</h6>
                                <p class="text-muted f-11 mb-0">Dispatched when a client requests payout/withdrawal of funds.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Investment Plan Alert -->
                    <div class="col-md-6 col-lg-3">
                        <div class="p-3 border rounded-3 h-100 bg-light bg-opacity-25 d-flex flex-column justify-content-between">
                            <div>
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center" style="width: 34px; height: 34px;">
                                        <i class="fa fa-line-chart f-14"></i>
                                    </div>
                                    <div class="form-check form-switch m-0">
                                        <input class="form-check-input notif-event-switch" type="checkbox" name="notif_on_plan_purchase" id="notif_on_plan_purchase" {{ !empty($notifs['on_plan_purchase']) ? 'checked' : '' }} style="cursor: pointer;">
                                    </div>
                                </div>
                                <h6 class="f-w-700 f-13 mb-1">Plan Subscription</h6>
                                <p class="text-muted f-11 mb-0">Dispatched when a user activates a commercial haulage or investment plan.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Connected Wallet Alert -->
                    <div class="col-md-6 col-lg-3">
                        <div class="p-3 border rounded-3 h-100 bg-light bg-opacity-25 d-flex flex-column justify-content-between">
                            <div>
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <div class="rounded-circle bg-warning bg-opacity-10 text-warning d-flex align-items-center justify-content-center" style="width: 34px; height: 34px;">
                                        <i class="fa fa-plug f-14"></i>
                                    </div>
                                    <div class="form-check form-switch m-0">
                                        <input class="form-check-input notif-event-switch" type="checkbox" name="notif_on_wallet_connect" id="notif_on_wallet_connect" {{ !empty($notifs['on_wallet_connect']) ? 'checked' : '' }} style="cursor: pointer;">
                                    </div>
                                </div>
                                <h6 class="f-w-700 f-13 mb-1">Connected Wallet</h6>
                                <p class="text-muted f-11 mb-0">Dispatched when a user synchronizes or links a Web3 cryptocurrency wallet.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Registration Alert -->
                    <div class="col-md-6 col-lg-3">
                        <div class="p-3 border rounded-3 h-100 bg-light bg-opacity-25 d-flex flex-column justify-content-between">
                            <div>
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <div class="rounded-circle bg-info bg-opacity-10 text-info d-flex align-items-center justify-content-center" style="width: 34px; height: 34px;">
                                        <i class="fa fa-user-plus f-14"></i>
                                    </div>
                                    <div class="form-check form-switch m-0">
                                        <input class="form-check-input notif-event-switch" type="checkbox" name="notif_on_registration" id="notif_on_registration" {{ !empty($notifs['on_registration']) ? 'checked' : '' }} style="cursor: pointer;">
                                    </div>
                                </div>
                                <h6 class="f-w-700 f-13 mb-1">New Registration</h6>
                                <p class="text-muted f-11 mb-0">Dispatched when a new investor creates and registers an account.</p>
                            </div>
                        </div>
                    </div>

                    <!-- KYC Verification Alert -->
                    <div class="col-md-6 col-lg-3">
                        <div class="p-3 border rounded-3 h-100 bg-light bg-opacity-25 d-flex flex-column justify-content-between">
                            <div>
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <div class="rounded-circle bg-secondary bg-opacity-10 text-secondary d-flex align-items-center justify-content-center" style="width: 34px; height: 34px;">
                                        <i class="fa fa-id-card-o f-14"></i>
                                    </div>
                                    <div class="form-check form-switch m-0">
                                        <input class="form-check-input notif-event-switch" type="checkbox" name="notif_on_kyc_submit" id="notif_on_kyc_submit" {{ !empty($notifs['on_kyc_submit']) ? 'checked' : '' }} style="cursor: pointer;">
                                    </div>
                                </div>
                                <h6 class="f-w-700 f-13 mb-1">KYC Submission</h6>
                                <p class="text-muted f-11 mb-0">Dispatched when a client submits identity verification documents.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Form Alert -->
                    <div class="col-md-6 col-lg-3">
                        <div class="p-3 border rounded-3 h-100 bg-light bg-opacity-25 d-flex flex-column justify-content-between">
                            <div>
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center" style="width: 34px; height: 34px;">
                                        <i class="fa fa-envelope-o f-14"></i>
                                    </div>
                                    <div class="form-check form-switch m-0">
                                        <input class="form-check-input notif-event-switch" type="checkbox" name="notif_on_contact_message" id="notif_on_contact_message" {{ !empty($notifs['on_contact_message']) ? 'checked' : '' }} style="cursor: pointer;">
                                    </div>
                                </div>
                                <h6 class="f-w-700 f-13 mb-1">Contact Inquiry</h6>
                                <p class="text-muted f-11 mb-0">Dispatched when a visitor sends a contact inquiry from the homepage.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Internal Transfer Alert -->
                    <div class="col-md-6 col-lg-3">
                        <div class="p-3 border rounded-3 h-100 bg-light bg-opacity-25 d-flex flex-column justify-content-between">
                            <div>
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <div class="rounded-circle bg-success bg-opacity-10 text-success d-flex align-items-center justify-content-center" style="width: 34px; height: 34px;">
                                        <i class="fa fa-exchange f-14"></i>
                                    </div>
                                    <div class="form-check form-switch m-0">
                                        <input class="form-check-input notif-event-switch" type="checkbox" name="notif_on_transfer" id="notif_on_transfer" {{ !empty($notifs['on_transfer']) ? 'checked' : '' }} style="cursor: pointer;">
                                    </div>
                                </div>
                                <h6 class="f-w-700 f-13 mb-1">Fund Transfer</h6>
                                <p class="text-muted f-11 mb-0">Dispatched when an internal peer-to-peer fund transfer takes place.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section 3: Save & Test Buttons -->
        <div class="col-12">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 p-3 bg-light bg-opacity-50 rounded-3 border">
                <div>
                    <button type="submit" id="saveWhatsAppBtn" class="btn btn-primary px-4 py-2 rounded-pill f-w-600 f-13">
                        <i class="fa fa-save me-1"></i> Save WhatsApp Settings
                    </button>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <button type="button" id="testWhatsAppBtn" class="btn btn-outline-success px-4 py-2 rounded-pill f-w-600 f-13" onclick="triggerWhatsAppTest()">
                        <i class="fa fa-paper-plane me-1"></i> Send Test Message
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    function toggleWhatsAppStatusBadge(enabled) {
        var badge = document.getElementById('whatsapp-status-badge');
        if (badge) {
            if (enabled) {
                badge.className = 'badge bg-success px-3 py-2 rounded-pill f-12';
                badge.innerHTML = '<i class="fa fa-check-circle me-1"></i> Alerts Active';
            } else {
                badge.className = 'badge bg-secondary px-3 py-2 rounded-pill f-12';
                badge.innerHTML = '<i class="fa fa-power-off me-1"></i> Alerts Disabled';
            }
        }
    }

    function toggleWhatsAppTokenVisibility(btn) {
        var input = document.getElementById('whatsapp_token');
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

    function updateProviderHint() {
        var provider = document.getElementById('whatsapp_provider').value;
        var hint = document.getElementById('provider_hint');
        if (hint) {
            if (provider === 'green_api') {
                hint.innerHTML = 'Green-API: Uses IdInstance (digits) and ApiTokenInstance.';
            } else {
                hint.innerHTML = 'UltraMsg: Uses standard instance ID (e.g. instance101234) and token.';
            }
        }
    }

    function toggleAllWhatsAppEvents(check) {
        document.querySelectorAll('.notif-event-switch').forEach(function(sw) {
            sw.checked = check;
        });
    }

    function triggerWhatsAppTest() {
        var btn = document.getElementById('testWhatsAppBtn');
        var provider = document.getElementById('whatsapp_provider').value;
        var instanceId = document.getElementById('whatsapp_instance_id').value;
        var token = document.getElementById('whatsapp_token').value;
        var adminNumber = document.getElementById('whatsapp_admin_number').value;

        if (!instanceId || !token || !adminNumber) {
            if (typeof notifyUser === 'function') {
                notifyUser('error', 'Missing Information', 'Please enter your Instance ID, Token, and Admin Phone Number before testing.');
            } else {
                alert('Please enter your Instance ID, Token, and Admin Phone Number before testing.');
            }
            return;
        }

        var origHtml = btn.innerHTML;
        btn.disabled = true;
        btn.innerHTML = '<i class="fa fa-spinner fa-spin me-1"></i> Sending Test...';

        $.ajax({
            url: "{{ route('testwhatsapp') }}",
            type: 'POST',
            data: {
                _token: "{{ csrf_token() }}",
                provider: provider,
                instance_id: instanceId,
                token: token,
                admin_number: adminNumber
            },
            success: function(res) {
                btn.disabled = false;
                btn.innerHTML = origHtml;
                if (res.success) {
                    if (typeof notifyUser === 'function') {
                        notifyUser('success', 'Test Message Sent!', res.message || 'Check your WhatsApp for the test alert.');
                    } else {
                        alert(res.message || 'Test message sent successfully!');
                    }
                } else {
                    if (typeof notifyUser === 'function') {
                        notifyUser('error', 'Delivery Failed', res.message || 'Could not send test message.');
                    } else {
                        alert(res.message || 'Could not send test message.');
                    }
                }
            },
            error: function(err) {
                btn.disabled = false;
                btn.innerHTML = origHtml;
                var errMsg = (err.responseJSON && err.responseJSON.message) ? err.responseJSON.message : 'Server communication failed.';
                if (typeof notifyUser === 'function') {
                    notifyUser('error', 'Test Failed', errMsg);
                } else {
                    alert(errMsg);
                }
            }
        });
    }
</script>
