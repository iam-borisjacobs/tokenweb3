<form method="POST" action="javascript:void(0)" id="updatepreference">
    @csrf
    @method('PUT')
    <input name="s_currency" value="{{ $settings->s_currency }}" id="s_c" type="hidden">
    <input type="hidden" value="{{ $settings->site_preference }}" name="site_preference">

    <div class="row g-4">
        <!-- Section 1: Financial & Trading Automation -->
        <div class="col-12">
            <div class="settings-card-section">
                <div class="d-flex align-items-center gap-2 mb-3 pb-2 border-bottom">
                    <div class="rounded-circle bg-success bg-opacity-10 text-success d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                        <i class="fa fa-chart-line f-16"></i>
                    </div>
                    <div>
                        <h6 class="f-w-700 mb-0">Financial & Trading Operations</h6>
                        <small class="text-muted">Configure investment returns, capital refunds, weekend profits, and withdrawal requests.</small>
                    </div>
                </div>

                <div class="row g-3">
                    <!-- Return Capital Switch -->
                    <div class="col-md-6 col-xl-4">
                        <div class="settings-subcard p-3 h-100">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label class="form-label f-w-600 f-13 mb-0">Return Capital on Expiry</label>
                                <div class="selectgroup">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="return_capital" value="true" class="selectgroup-input" {{ $settings->return_capital ? 'checked' : '' }}>
                                        <span class="selectgroup-button">Yes</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="return_capital" value="false" class="selectgroup-input" {{ !$settings->return_capital ? 'checked' : '' }}>
                                        <span class="selectgroup-button">No</span>
                                    </label>
                                </div>
                            </div>
                            <small class="text-muted f-11">Automatically refunds the initial investment principal when a package matures.</small>
                        </div>
                    </div>

                    <!-- Plan Cancellation Switch -->
                    <div class="col-md-6 col-xl-4">
                        <div class="settings-subcard p-3 h-100">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label class="form-label f-w-600 f-13 mb-0">Plan Early Cancellation</label>
                                <div class="selectgroup">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="should_cancel_plan" value="1" class="selectgroup-input" {{ $settings->should_cancel_plan ? 'checked' : '' }}>
                                        <span class="selectgroup-button">On</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="should_cancel_plan" value="0" class="selectgroup-input" {{ !$settings->should_cancel_plan ? 'checked' : '' }}>
                                        <span class="selectgroup-button">Off</span>
                                    </label>
                                </div>
                            </div>
                            <small class="text-muted f-11">Allows investors to abort active investments early and receive remaining capital back.</small>
                        </div>
                    </div>

                    <!-- Weekend Trade Switch -->
                    <div class="col-md-6 col-xl-4">
                        <div class="settings-subcard p-3 h-100">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label class="form-label f-w-600 f-13 mb-0">Weekend Trade ROI</label>
                                <div class="selectgroup">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="weekend_trade" value="on" class="selectgroup-input" {{ $settings->weekend_trade == 'on' ? 'checked' : '' }}>
                                        <span class="selectgroup-button">On</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="weekend_trade" value="off" class="selectgroup-input" {{ $settings->weekend_trade != 'on' ? 'checked' : '' }}>
                                        <span class="selectgroup-button">Off</span>
                                    </label>
                                </div>
                            </div>
                            <small class="text-muted f-11">If turned off, users do not receive profit earnings on Saturday and Sunday.</small>
                        </div>
                    </div>

                    <!-- User Withdrawals Switch -->
                    <div class="col-md-6 col-xl-4">
                        <div class="settings-subcard p-3 h-100">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label class="form-label f-w-600 f-13 mb-0">Client Withdrawals</label>
                                <div class="selectgroup">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="withdraw" value="true" class="selectgroup-input" {{ $settings->enable_with == 'true' ? 'checked' : '' }}>
                                        <span class="selectgroup-button">Enable</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="withdraw" value="false" class="selectgroup-input" {{ $settings->enable_with != 'true' ? 'checked' : '' }}>
                                        <span class="selectgroup-button">Disable</span>
                                    </label>
                                </div>
                            </div>
                            <small class="text-muted f-11">Master kill-switch for client withdrawal requests across the platform.</small>
                        </div>
                    </div>

                    <!-- Global Trade Mode Switch -->
                    <div class="col-md-6 col-xl-4">
                        <div class="settings-subcard p-3 h-100">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label class="form-label f-w-600 f-13 mb-0">Global Trade ROI Engine</label>
                                <div class="selectgroup">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="trade_mode" value="on" class="selectgroup-input" {{ $settings->trade_mode == 'on' ? 'checked' : '' }}>
                                        <span class="selectgroup-button">On</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="trade_mode" value="off" class="selectgroup-input" {{ $settings->trade_mode != 'on' ? 'checked' : '' }}>
                                        <span class="selectgroup-button">Off</span>
                                    </label>
                                </div>
                            </div>
                            <small class="text-muted f-11">Pause or resume the automated investment cron profit distribution engine.</small>
                        </div>
                    </div>

                    <!-- Trading Clearance & Padlock Switch -->
                    <div class="col-md-6 col-xl-4">
                        <div class="settings-subcard p-3 h-100">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label class="form-label f-w-600 f-13 mb-0">Trading Clearance Lock</label>
                                <div class="selectgroup">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="trading_lock_enabled" value="1" class="selectgroup-input" {{ $settings->trading_lock_enabled ? 'checked' : '' }}>
                                        <span class="selectgroup-button">Lock Active</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="trading_lock_enabled" value="0" class="selectgroup-input" {{ !$settings->trading_lock_enabled ? 'checked' : '' }}>
                                        <span class="selectgroup-button">Disabled</span>
                                    </label>
                                </div>
                            </div>
                            <small class="text-muted f-11">Enforces minimum balance qualification to access Trading & Markets, Bots, Signals, and Quick Trade.</small>
                        </div>
                    </div>

                    <!-- Require Connected Wallet for Investments Switch -->
                    <div class="col-md-6 col-xl-4">
                        <div class="settings-subcard p-3 h-100">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label class="form-label f-w-600 f-13 mb-0">Require Wallet for Plans</label>
                                <div class="selectgroup">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="require_wallet_for_investment" value="1" class="selectgroup-input" {{ ($settings->require_wallet_for_investment ?? true) ? 'checked' : '' }}>
                                        <span class="selectgroup-button">Required</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="require_wallet_for_investment" value="0" class="selectgroup-input" {{ !($settings->require_wallet_for_investment ?? true) ? 'checked' : '' }}>
                                        <span class="selectgroup-button">Show to All</span>
                                    </label>
                                </div>
                            </div>
                            <small class="text-muted f-11">When enabled, clients must connect a wallet to view and access Investment Plans. When disabled, plans are visible to all clients.</small>
                        </div>
                    </div>

                    <!-- Minimum Trading Balance Input -->
                    <div class="col-md-6 col-xl-4">
                        <div class="settings-subcard p-3 h-100">
                            <label class="form-label f-w-600 f-13 mb-1">Min Balance for Trading</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">{{ $settings->currency ?? '$' }}</span>
                                <input type="number" step="100" min="0" name="min_trading_balance" class="form-control border-start-0" value="{{ $settings->min_trading_balance ?? 100000.00 }}" placeholder="100000.00" required>
                            </div>
                            <small class="text-muted f-11 mt-1 d-block">Threshold required in combined account or wallet balance to unlock live trading execution.</small>
                        </div>
                    </div>

                    <!-- Broadcast Announcement Switch -->
                    <div class="col-md-6 col-xl-4">
                        <div class="settings-subcard p-3 h-100">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label class="form-label f-w-600 f-13 mb-0">Show Announcement</label>
                                <div class="selectgroup">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="annouc" value="on" class="selectgroup-input" {{ $settings->enable_annoc == 'on' ? 'checked' : '' }}>
                                        <span class="selectgroup-button">On</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="annouc" value="off" class="selectgroup-input" {{ $settings->enable_annoc != 'on' ? 'checked' : '' }}>
                                        <span class="selectgroup-button">Off</span>
                                    </label>
                                </div>
                            </div>
                            <small class="text-muted f-11">Controls visibility of the top broadcast banner on user dashboards.</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section 2: Security, Access & Compliance -->
        <div class="col-12">
            <div class="settings-card-section">
                <div class="d-flex align-items-center gap-2 mb-3 pb-2 border-bottom">
                    <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                        <i class="fa fa-shield-alt f-16"></i>
                    </div>
                    <div>
                        <h6 class="f-w-700 mb-0">Security, KYC & Authentication</h6>
                        <small class="text-muted">Identity verification policies, anti-bot challenges, and member onboarding barriers.</small>
                    </div>
                </div>

                <div class="row g-3">
                    <!-- Mandatory KYC on Registration -->
                    <div class="col-md-6 col-xl-4">
                        <div class="settings-subcard p-3 h-100">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label class="form-label f-w-600 f-13 mb-0">KYC on Sign-up</label>
                                <div class="selectgroup">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="enable_kyc_registration" value="yes" class="selectgroup-input" {{ $settings->enable_kyc_registration == 'yes' ? 'checked' : '' }}>
                                        <span class="selectgroup-button">On</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="enable_kyc_registration" value="no" class="selectgroup-input" {{ $settings->enable_kyc_registration != 'yes' ? 'checked' : '' }}>
                                        <span class="selectgroup-button">Off</span>
                                    </label>
                                </div>
                            </div>
                            <small class="text-muted f-11">Forces new users to submit identity verification immediately during account sign-up.</small>
                        </div>
                    </div>

                    <!-- KYC for Withdrawals -->
                    <div class="col-md-6 col-xl-4">
                        <div class="settings-subcard p-3 h-100">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label class="form-label f-w-600 f-13 mb-0">KYC for Withdrawals</label>
                                <div class="selectgroup">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="enable_kyc" value="yes" class="selectgroup-input" {{ $settings->enable_kyc == 'yes' ? 'checked' : '' }}>
                                        <span class="selectgroup-button">On</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="enable_kyc" value="no" class="selectgroup-input" {{ $settings->enable_kyc != 'yes' ? 'checked' : '' }}>
                                        <span class="selectgroup-button">Off</span>
                                    </label>
                                </div>
                            </div>
                            <small class="text-muted f-11">Blocks clients from requesting withdrawals until their KYC status is marked as Approved.</small>
                        </div>
                    </div>

                    <!-- Mandatory Email Verification -->
                    <div class="col-md-6 col-xl-4">
                        <div class="settings-subcard p-3 h-100">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label class="form-label f-w-600 f-13 mb-0">Email Verification</label>
                                <div class="selectgroup">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="enail_verify" value="true" class="selectgroup-input" {{ $settings->enable_verification == 'true' ? 'checked' : '' }}>
                                        <span class="selectgroup-button">Enable</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="enail_verify" value="false" class="selectgroup-input" {{ $settings->enable_verification != 'true' ? 'checked' : '' }}>
                                        <span class="selectgroup-button">Disable</span>
                                    </label>
                                </div>
                            </div>
                            <small class="text-muted f-11">Requires investors to confirm their email address via activation link before login.</small>
                        </div>
                    </div>

                    <!-- Google reCAPTCHA Anti-Bot -->
                    <div class="col-md-6 col-xl-4">
                        <div class="settings-subcard p-3 h-100">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label class="form-label f-w-600 f-13 mb-0">Google Captcha</label>
                                <div class="selectgroup">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="captcha" value="true" class="selectgroup-input" {{ $settings->captcha == 'true' ? 'checked' : '' }}>
                                        <span class="selectgroup-button">On</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="captcha" value="false" class="selectgroup-input" {{ $settings->captcha != 'true' ? 'checked' : '' }}>
                                        <span class="selectgroup-button">Off</span>
                                    </label>
                                </div>
                            </div>
                            <small class="text-muted f-11">Activates Google reCAPTCHA widget on public login, register, and password reset forms.</small>
                        </div>
                    </div>

                    <!-- Google Social Login Switch -->
                    <div class="col-md-6 col-xl-4">
                        <div class="settings-subcard p-3 h-100">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label class="form-label f-w-600 f-13 mb-0">Google Social Login</label>
                                <div class="selectgroup">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="social" value="yes" class="selectgroup-input" {{ $settings->enable_social_login == 'yes' ? 'checked' : '' }}>
                                        <span class="selectgroup-button">On</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="social" value="no" class="selectgroup-input" {{ $settings->enable_social_login != 'yes' ? 'checked' : '' }}>
                                        <span class="selectgroup-button">Off</span>
                                    </label>
                                </div>
                            </div>
                            <small class="text-muted f-11">Enables the 'Sign in with Google' button on login and registration pages.</small>
                        </div>
                    </div>

                    <!-- Google Translation Bar -->
                    <div class="col-md-6 col-xl-4">
                        <div class="settings-subcard p-3 h-100">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label class="form-label f-w-600 f-13 mb-0">Google Translator</label>
                                <div class="selectgroup">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="googlet" value="on" class="selectgroup-input" {{ $settings->google_translate == 'on' ? 'checked' : '' }}>
                                        <span class="selectgroup-button">On</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="googlet" value="off" class="selectgroup-input" {{ $settings->google_translate != 'on' ? 'checked' : '' }}>
                                        <span class="selectgroup-button">Off</span>
                                    </label>
                                </div>
                            </div>
                            <small class="text-muted f-11">Renders the multilingual language dropdown switcher in the footer/header.</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section 3: Localization, Currency & Contact Channels -->
        <div class="col-12">
            <div class="settings-card-section">
                <div class="d-flex align-items-center gap-2 mb-3 pb-2 border-bottom">
                    <div class="rounded-circle bg-warning bg-opacity-10 text-warning d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                        <i class="fa fa-address-book f-16"></i>
                    </div>
                    <div>
                        <h6 class="f-w-700 mb-0">Contact Channels, Physical Office & Map</h6>
                        <small class="text-muted">Directly displayed on the public Contact Us page, email notifications, and footer.</small>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label f-w-600 f-13">Official Contact Email <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa fa-envelope text-muted"></i></span>
                            <input type="email" class="form-control" name="contact_email" value="{{ $settings->contact_email }}" placeholder="support@ecxgroups.com" required>
                        </div>
                        <small class="text-muted f-11">Primary support email displayed to investors and linked on the Contact Us page.</small>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label f-w-600 f-13">Support Phone Number / Hotline</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa fa-phone text-muted"></i></span>
                            <input type="text" class="form-control" name="phone" value="{{ $settings->phone }}" placeholder="e.g. +1 (800) 555-0199 or +44 20 7946 0912">
                        </div>
                        <small class="text-muted f-11">Hotline phone number clickable on mobile devices via tel: link.</small>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label f-w-600 f-13">Official WhatsApp Support Number / Chat Link</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-brands fa-whatsapp text-success"></i></span>
                            <input type="text" class="form-control" name="whatsapp_number" value="{{ $settings->whatsapp_number }}" placeholder="e.g. +14155552671 or https://wa.me/14155552671">
                        </div>
                        <small class="text-muted f-11">Direct WhatsApp support link used on withdrawal notice modals and client support options.</small>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label f-w-600 f-13">Official Telegram Support Handle / Link</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-brands fa-telegram text-info"></i></span>
                            <input type="text" class="form-control" name="telegram_username" value="{{ $settings->telegram_username }}" placeholder="e.g. @ecxsupport or https://t.me/ecxsupport">
                        </div>
                        <small class="text-muted f-11">Telegram handle or direct channel link for instant investor communication.</small>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label f-w-600 f-13">Headquarters / Physical Address</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa fa-map-marker-alt text-muted"></i></span>
                            <input type="text" class="form-control" name="location" value="{{ $settings->location }}" placeholder="e.g. 25 Bank Street, Canary Wharf, London, E14 5JP, UK">
                        </div>
                        <small class="text-muted f-11">Physical office address displayed on the Contact Us page.</small>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label f-w-600 f-13">Default Platform Currency <span class="text-danger">*</span></label>
                        <select name="currency" id="select_c" class="form-select select2" onchange="changecurr()" style="width: 100%">
                            <option value="<?php echo htmlentities($settings->currency); ?>">{{ $settings->currency }} (Current)</option>
                            @foreach ($currencies as $key => $currency)
                                <option id="{{ $key }}" value="<?php echo html_entity_decode($currency); ?>">
                                    {{ $key . ' (' . html_entity_decode($currency) . ')' }}
                                </option>
                            @endforeach
                        </select>
                        <small class="text-muted f-11">Base currency symbol attached to client investment figures and account balances.</small>
                    </div>

                    <div class="col-12">
                        <label class="form-label f-w-600 f-13">Google Map Embed Code or URL (Optional)</label>
                        <textarea class="form-control font-monospace f-12" name="map_iframe" rows="3" placeholder="Paste full <iframe>...</iframe> or embed link from Google Maps (leave blank to auto-generate from Headquarters address)">{{ $settings->map_iframe }}</textarea>
                        <small class="text-muted f-11"><i class="fa fa-info-circle text-info me-1"></i> If left empty, the Contact page automatically generates an interactive map querying your Headquarters address.</small>
                    </div>

                    <div class="col-12">
                        <label class="form-label f-w-600 f-13">Custom HomePage Redirection URL (Optional)</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa fa-external-link-alt text-muted"></i></span>
                            <input type="text" class="form-control" name="redirect_url" placeholder="e.g. https://mycustomhomepage.com" value="{{ $settings->redirect_url }}">
                        </div>
                        <small class="text-muted f-11">If you run an external landing page, enter its full URL here to forward root traffic. Leave blank to use our built-in portal homepage.</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="col-12 text-end pt-2">
            <button type="submit" class="btn btn-primary rounded-pill px-5 py-2 f-w-600 shadow-sm" id="prefSaveBtn">
                <i class="fa fa-save me-1"></i> Save Platform Preferences
            </button>
        </div>
    </div>
</form>
