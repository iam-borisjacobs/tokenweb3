<div class="email-templates-wrapper">
    <!-- Top Header & Category Filter Bar -->
    <div class="row g-3 align-items-center mb-4 pb-3 border-bottom">
        <div class="col-12 col-md-6">
            <div class="d-flex align-items-center gap-2">
                <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center" style="width: 42px; height: 42px; font-size: 18px;">
                    <i class="fa fa-envelope-open-text"></i>
                </div>
                <div>
                    <h5 class="f-w-700 mb-0">Outgoing Email Templates</h5>
                    <small class="text-muted">Customize notification subjects, email copy, CTA buttons & preview in real-time.</small>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="d-flex flex-wrap align-items-center justify-content-md-end gap-2">
                <!-- Mobile Editor / Preview Switcher (< 992px) -->
                <div class="d-lg-none w-100 mb-2">
                    <div class="btn-group w-100 shadow-sm" role="group" id="mobileEmailViewToggle">
                        <button type="button" class="btn btn-primary active w-50 py-2 f-13 f-w-600" id="btnShowEditor">
                            <i class="fa fa-pencil me-1"></i> Edit Template
                        </button>
                        <button type="button" class="btn btn-outline-primary w-50 py-2 f-13 f-w-600" id="btnShowPreview">
                            <i class="fa fa-eye me-1"></i> Live Preview
                        </button>
                    </div>
                </div>

                <!-- Template Selector Dropdown -->
                <div class="w-100 w-sm-auto flex-grow-1" style="max-width: 320px;">
                    <select class="form-select f-13 f-w-600 shadow-sm" id="emailTemplatePicker">
                        @foreach($emailTemplates as $tmpl)
                            <option value="{{ $tmpl->id }}" data-category="{{ $tmpl->category }}" data-key="{{ $tmpl->key }}" {{ $loop->first ? 'selected' : '' }}>
                                {{ $tmpl->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- Category Pill Filter Chips -->
    <div class="mb-4 d-flex flex-wrap gap-2 align-items-center" id="templateCategoryChips">
        <span class="f-12 f-w-600 text-muted me-1"><i class="fa fa-filter me-1"></i> Category:</span>
        <button type="button" class="btn btn-sm btn-primary rounded-pill px-3 py-1 f-12 active category-filter-btn" data-cat="all">
            All ({{ count($emailTemplates) }})
        </button>
        <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 py-1 f-12 category-filter-btn" data-cat="Onboarding & Auth">
            Onboarding & Auth
        </button>
        <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 py-1 f-12 category-filter-btn" data-cat="Financial & Transactions">
            Financial & Transactions
        </button>
        <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 py-1 f-12 category-filter-btn" data-cat="Investment Plans">
            Investment Plans
        </button>
        <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 py-1 f-12 category-filter-btn" data-cat="Security & Wallets">
            Security & Wallets
        </button>
        <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 py-1 f-12 category-filter-btn" data-cat="Admin Alerts">
            Admin Alerts
        </button>
    </div>

    <!-- Active Template Status & Meta Banner -->
    <div class="p-3 mb-4 rounded-3 border d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3 bg-light-subtle" id="templateMetaBanner">
        <div class="d-flex align-items-center gap-3">
            <span class="badge bg-primary px-3 py-2 rounded-pill f-12 f-w-600" id="tmplBadgeCategory">Onboarding & Auth</span>
            <div>
                <h6 class="f-w-700 mb-0" id="tmplHeaderName">Welcome & Account Onboarding</h6>
                <small class="text-muted">Internal Key: <code id="tmplHeaderKey">welcome_email</code></small>
            </div>
        </div>
        <div class="d-flex align-items-center flex-wrap gap-2">
            <!-- Active Toggle -->
            <div class="form-check form-switch mb-0 d-flex align-items-center gap-2">
                <input class="form-check-input" type="checkbox" id="tmplActiveToggle" role="switch" checked style="cursor: pointer; width: 44px; height: 22px;">
                <label class="form-check-label f-13 f-w-600 mb-0" for="tmplActiveToggle" id="tmplActiveLabel">Active (Sending)</label>
            </div>
            <!-- Reset Button -->
            <button type="button" class="btn btn-outline-secondary btn-sm rounded-pill px-3" id="btnResetTemplate" title="Reset this template to factory default">
                <i class="fa fa-undo me-1"></i> Restore Default
            </button>
        </div>
    </div>

    <!-- Main Workspace Grid: Side-by-Side Editor & Live Preview -->
    <div class="row g-4 align-items-start">
        <!-- Column 1: Editor Form Panel -->
        <div class="col-12 col-lg-6" id="editorColumn">
            <div class="settings-card-section p-3 p-md-4 shadow-sm">
                <form id="emailTemplateForm" action="javascript:void(0)">
                    @csrf
                    <input type="hidden" id="currentTemplateId" value="{{ $emailTemplates->first()->id ?? 1 }}">

                    <!-- Subject Line -->
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <label class="form-label f-w-600 f-13 mb-0">Email Subject Line <span class="text-danger">*</span></label>
                            <span class="f-11 text-muted"><span id="subjectCharCount">0</span> chars</span>
                        </div>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa fa-heading text-muted"></i></span>
                            <input type="text" class="form-control f-13" id="tmplSubject" name="subject" placeholder="e.g. Welcome to @{{site_name}} - @{{user_name}}" required>
                        </div>
                        <small class="text-muted f-11">The email subject displayed in the user's inbox.</small>
                    </div>

                    <!-- Preheader Preview Text -->
                    <div class="mb-3">
                        <label class="form-label f-w-600 f-13 mb-1">Inbox Preheader (Preview Snippet)</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa fa-eye text-muted"></i></span>
                            <input type="text" class="form-control f-13" id="tmplPreheader" name="preheader" placeholder="Brief 1-line teaser visible next to subject in inboxes">
                        </div>
                        <small class="text-muted f-11">Summary text shown next to the subject in mobile and web inboxes.</small>
                    </div>

                    <!-- Greeting Line -->
                    <div class="mb-3">
                        <label class="form-label f-w-600 f-13 mb-1">Salutation / Greeting</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa fa-user-circle text-muted"></i></span>
                            <input type="text" class="form-control f-13" id="tmplGreeting" name="greeting" placeholder="e.g. Hello @{{user_name}},">
                        </div>
                    </div>

                    <!-- Available Tag Cloud Chips -->
                    <div class="mb-3 p-3 rounded-3 border bg-light-subtle">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <label class="form-label f-w-600 f-12 mb-0 text-primary">
                                <i class="fa fa-tags me-1"></i> Available Variable Placeholders:
                            </label>
                            <small class="text-muted f-10">Click to insert tag into message body</small>
                        </div>
                        <div class="d-flex flex-wrap gap-1" id="availableTagsList">
                            <!-- Dynamic Tag Badges populated by JS -->
                        </div>
                    </div>

                    <!-- Main Body HTML Content -->
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <label class="form-label f-w-600 f-13 mb-0">Message Content (HTML Allowed) <span class="text-danger">*</span></label>
                            <div class="d-flex gap-1" id="editorQuickTools">
                                <button type="button" class="btn btn-outline-secondary btn-xs py-0 px-2 f-11" onclick="insertHtmlTag('strong')"><b>B</b></button>
                                <button type="button" class="btn btn-outline-secondary btn-xs py-0 px-2 f-11" onclick="insertHtmlTag('em')"><i>I</i></button>
                                <button type="button" class="btn btn-outline-secondary btn-xs py-0 px-2 f-11" onclick="insertHtmlTag('code')">&lt;/&gt;</button>
                                <button type="button" class="btn btn-outline-secondary btn-xs py-0 px-2 f-11" onclick="insertHtmlTag('p')">&para;</button>
                            </div>
                        </div>
                        <textarea class="form-control f-13 font-monospace" id="tmplBody" name="body" rows="9" placeholder="Enter notification copy here. HTML paragraphs and markup supported." required style="line-height: 1.5;"></textarea>
                        <small class="text-muted f-11">HTML tags like <code>&lt;p&gt;</code>, <code>&lt;strong&gt;</code>, <code>&lt;code&gt;</code>, and <code>&lt;ul&gt;</code> are supported.</small>
                    </div>

                    <!-- Call To Action Button -->
                    <div class="mb-3 p-3 rounded-3 border">
                        <h6 class="f-w-700 f-13 text-primary mb-2">
                            <i class="fa fa-mouse-pointer me-1"></i> Action Button (CTA)
                        </h6>
                        <div class="row g-2">
                            <div class="col-12 col-md-6">
                                <label class="form-label f-12 f-w-600 mb-1">Button Text</label>
                                <input type="text" class="form-control f-13" id="tmplActionText" name="action_text" placeholder="e.g. Access Your Dashboard">
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label f-12 f-w-600 mb-1">Target URL</label>
                                <input type="text" class="form-control f-13" id="tmplActionUrl" name="action_url" placeholder="e.g. @{{dashboard_url}}">
                            </div>
                        </div>
                        <small class="text-muted f-11 mt-1 d-block">Leave blank if this email does not require a call-to-action button.</small>
                    </div>

                    <!-- Footer Note / Disclaimer -->
                    <div class="mb-4">
                        <label class="form-label f-w-600 f-13 mb-1">Security / Footer Disclaimer</label>
                        <textarea class="form-control f-13" id="tmplFooterText" name="footer_text" rows="2" placeholder="e.g. If you did not authorize this action, contact support immediately."></textarea>
                    </div>

                    <!-- Action Toolbar: Save & Reset -->
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 pt-2 border-top">
                        <button type="submit" class="btn btn-primary px-4 py-2 f-13 f-w-600 rounded-pill shadow-sm" id="btnSaveTemplate">
                            <i class="fa fa-save me-1"></i> Save Changes
                        </button>
                        <span class="f-11 text-success d-none" id="saveSuccessIndicator">
                            <i class="fa fa-check-circle me-1"></i> Saved!
                        </span>
                    </div>
                </form>

                <!-- Section: Live Test Email Dispatcher -->
                <div class="mt-4 pt-4 border-top">
                    <div class="p-3 rounded-3 border bg-light-subtle">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <div class="rounded-circle bg-warning bg-opacity-10 text-warning d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                                <i class="fa fa-paper-plane f-13"></i>
                            </div>
                            <div>
                                <h6 class="f-w-700 f-13 mb-0">Send Live Test Email</h6>
                                <small class="text-muted">Dispatches this template with real test formatting directly to your inbox.</small>
                            </div>
                        </div>

                        <div class="row g-2 align-items-center">
                            <div class="col-12 col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-envelope text-muted"></i></span>
                                    <input type="email" class="form-control f-13" id="testEmailRecipient" placeholder="your-email@example.com" value="{{ $settings->contact_email ?? '' }}">
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <button type="button" class="btn btn-warning w-100 py-2 f-13 f-w-700 rounded-pill text-dark shadow-sm" id="btnSendTestEmail">
                                    <i class="fa fa-paper-plane me-1"></i> Send Test
                                </button>
                            </div>
                        </div>

                        <div id="testEmailFeedback" class="mt-2 f-12 d-none"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Column 2: Live Real-Time Interactive Preview Panel -->
        <div class="col-12 col-lg-6" id="previewColumn">
            <div class="preview-sticky-card">
                <!-- Device Viewport Switcher Toolbar -->
                <div class="d-flex flex-wrap align-items-center justify-content-between p-3 border rounded-top bg-light-subtle gap-2">
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-2 py-1 f-11">
                            <i class="fa fa-circle f-8 me-1 animate-pulse"></i> LIVE PREVIEW
                        </span>
                        <small class="text-muted f-11 d-none d-sm-inline">Updates in real-time as you type</small>
                    </div>

                    <!-- Toolbar: Inbox Theme & Viewport Toggles -->
                    <div class="d-flex align-items-center gap-2">
                        <!-- Theme Toggle: Dark vs Light Inbox -->
                        <div class="btn-group btn-group-sm" role="group" id="previewThemeToggle" title="Toggle Inbox Theme Preview">
                            <button type="button" class="btn btn-outline-secondary active px-2 px-sm-3" data-theme="dark" title="Dark Mode Inbox View">
                                <i class="fa fa-moon-o me-1"></i> Dark
                            </button>
                            <button type="button" class="btn btn-outline-secondary px-2 px-sm-3" data-theme="light" title="Light Mode Inbox View">
                                <i class="fa fa-sun-o me-1 text-warning"></i> Light
                            </button>
                        </div>

                        <!-- Viewport Toggle: Desktop vs Mobile -->
                        <div class="btn-group btn-group-sm" role="group" id="previewDeviceToggle">
                            <button type="button" class="btn btn-outline-secondary active px-2 px-sm-3" data-device="desktop" title="Desktop Email View">
                                <i class="fa fa-desktop me-1"></i> Desktop
                            </button>
                            <button type="button" class="btn btn-outline-secondary px-2 px-sm-3" data-device="mobile" title="Mobile Phone View">
                                <i class="fa fa-mobile me-1"></i> Phone
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Simulated Mail Client Window Frame -->
                <div class="mail-client-window border border-top-0 rounded-bottom p-3 p-sm-4" id="mailClientFrame">
                    <!-- Client Meta Header -->
                    <div class="mail-client-meta mb-3 pb-3 border-bottom">
                        <div class="d-flex align-items-center justify-content-between mb-1">
                            <span class="f-11 text-muted"><strong>From:</strong> {{ $settings->emailfromname ?? 'TokenWeb3 Network' }} &lt;{{ $settings->emailfrom ?? 'no-reply@tokenweb3network.com' }}&gt;</span>
                            <span class="badge bg-secondary bg-opacity-10 text-muted f-10 rounded-pill">Inbox</span>
                        </div>
                        <div class="f-11 text-muted mb-1"><strong>To:</strong> Alexander Wright &lt;alex.wright@example.com&gt;</div>
                        <div class="f-13 f-w-700 text-primary mt-1" id="previewSubjectText">Welcome to {{ $settings->site_name ?? 'TokenWeb3 Network' }} - Alexander Wright</div>
                        <div class="f-11 text-muted text-truncate mt-1" id="previewPreheaderText">Your trading account has been created and secured.</div>
                    </div>

                    <!-- Simulated Email Canvas Container -->
                    <div class="preview-canvas-wrapper" id="previewCanvasWrapper">
                        <div class="email-mockup-card shadow-sm" id="emailMockupCard">
                            <!-- Email Header -->
                            <div class="mockup-header text-center">
                                @php
                                    $siteTitle = $settings->site_name ?? 'TokenWeb3 Network';
                                    $darkLogoUrl = !empty($settings->dark_logo) ? asset('storage/' . $settings->dark_logo) : null;
                                    $lightLogoUrl = !empty($settings->logo) ? asset('storage/' . $settings->logo) : null;
                                    $themeLogo = asset('themes/standard/assets/images/logo.png');
                                    $initialLogo = $darkLogoUrl ?: ($lightLogoUrl ?: $themeLogo);
                                @endphp
                                <div class="mockup-logo-wrapper" id="mockupLogoWrapper">
                                    <img src="{{ $initialLogo }}" alt="{{ $siteTitle }}" class="mockup-logo" id="mockupLogoImg"
                                         data-dark-src="{{ $darkLogoUrl ?: ($lightLogoUrl ?: $themeLogo) }}"
                                         data-light-src="{{ $lightLogoUrl ?: ($darkLogoUrl ?: $themeLogo) }}"
                                         onerror="this.onerror=null; this.src='{{ $themeLogo }}'; this.onerror=function(){ this.style.display='none'; document.getElementById('mockupSvgLogo').style.display='inline-flex'; };">
                                    <div id="mockupSvgLogo" style="display: none; align-items: center; justify-content: center; gap: 8px;">
                                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12 2L3 7V12C3 17.52 6.84 22.74 12 24C17.16 22.74 21 17.52 21 12V7L12 2Z" fill="#6362e7"/>
                                            <path d="M12 6L6 9.5V13C6 16.5 8.5 20.5 12 21.5C15.5 20.5 18 16.5 18 13V9.5L12 6Z" fill="#4338ca"/>
                                            <path d="M10 12.5L8.5 11L7.5 12L10 14.5L16.5 8L15.5 7L10 12.5Z" fill="#ffffff"/>
                                        </svg>
                                        <h4 class="mockup-brand-title mb-0" id="mockupSvgTitle">{{ $siteTitle }}</h4>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <span class="mockup-badge" id="previewCategoryBadge">Onboarding & Auth</span>
                                </div>
                            </div>

                            <!-- Email Body -->
                            <div class="mockup-body">
                                <h5 class="mockup-greeting f-w-700" id="previewGreetingText">Hello Alexander Wright,</h5>

                                <div class="mockup-content" id="previewBodyContent">
                                    <!-- Rendered HTML content goes here -->
                                </div>

                                <div class="mockup-action text-center mt-4 mb-3" id="previewActionContainer">
                                    <a href="javascript:void(0)" class="mockup-btn" id="previewActionBtn">
                                        <span id="previewActionBtnText">Access Your Trading Dashboard</span> &rarr;
                                    </a>
                                </div>
                            </div>

                            <!-- Email Footer -->
                            <div class="mockup-footer text-center">
                                <p class="mb-2 f-12" id="previewFooterDisclaimer">If you did not create this account, please immediately contact our 24/7 security desk.</p>
                                <div class="f-11">
                                    &copy; {{ date('Y') }} <strong>{{ $siteTitle }}</strong>. All rights reserved.
                                </div>
                                <div class="f-10 mt-1 opacity-75">
                                    Automated dispatch sent to alex.wright@example.com
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scoped Styles for Email Templates & Dark Mode Integration -->
<style>
    /* Light Mode Variables & Elements */
    .email-templates-wrapper {
        color: #334155;
    }
    .preview-sticky-card {
        position: sticky;
        top: 90px;
    }
    .mail-client-window {
        background-color: #f1f5f9;
        transition: all 0.3s ease;
        overflow-x: hidden;
    }
    .mail-client-meta {
        background: #ffffff;
        border-radius: 8px;
        padding: 10px 14px;
        border: 1px solid #e2e8f0;
    }

    /* Email Mockup Container */
    .preview-canvas-wrapper {
        display: flex;
        justify-content: center;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .email-mockup-card {
        width: 100%;
        max-width: 540px;
        background-color: #141b2d;
        border: 1px solid #232d42;
        border-radius: 14px;
        overflow: hidden;
        color: #cbd5e1;
        transition: max-width 0.3s ease;
    }

    /* Mobile Phone Viewport Simulation */
    .mail-client-window.is-phone-mode .email-mockup-card {
        max-width: 340px;
        border-radius: 28px;
        border: 7px solid #273142;
        box-shadow: 0 15px 35px rgba(0,0,0,0.5);
    }
    .mail-client-window.is-phone-mode .mockup-header {
        padding: 20px 16px;
    }
    .mail-client-window.is-phone-mode .mockup-body {
        padding: 20px 16px;
        font-size: 13px;
    }
    .mail-client-window.is-phone-mode .mockup-btn {
        width: 100%;
        box-sizing: border-box;
        padding: 12px 14px;
        font-size: 13px;
    }

    /* Email Component Internals */
    .mockup-header {
        background: linear-gradient(135deg, #192038 0%, #0f172a 100%);
        padding: 26px 24px 20px;
        border-bottom: 1px solid #27334d;
    }
    .mockup-logo {
        max-height: 38px;
        max-width: 180px;
    }
    .mockup-brand-title {
        color: #ffffff;
        font-weight: 800;
        font-size: 20px;
        letter-spacing: 0.5px;
    }
    .mockup-badge {
        display: inline-block;
        background: rgba(99, 98, 231, 0.15);
        border: 1px solid rgba(99, 98, 231, 0.35);
        color: #a5b4fc;
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        padding: 3px 10px;
        border-radius: 50px;
    }
    .mockup-body {
        padding: 26px 24px;
        font-size: 14px;
        line-height: 1.6;
        color: #cbd5e1;
    }
    .mockup-greeting {
        color: #ffffff;
        font-size: 17px;
        margin-bottom: 16px;
    }
    .mockup-content p {
        margin-bottom: 14px;
    }
    .mockup-content strong {
        color: #f8fafc;
    }
    .mockup-content code {
        background: #0f172a;
        border: 1px solid #334155;
        color: #38bdf8;
        padding: 2px 6px;
        border-radius: 4px;
        font-size: 12.5px;
    }
    .mockup-content ul, .mockup-content ol {
        padding-left: 20px;
        margin-bottom: 14px;
    }
    .mockup-content li {
        margin-bottom: 6px;
    }
    .mockup-btn {
        display: inline-block;
        background: linear-gradient(135deg, #4f46e5 0%, #3b82f6 100%);
        color: #ffffff !important;
        font-size: 13.5px;
        font-weight: 700;
        text-decoration: none;
        padding: 12px 28px;
        border-radius: 30px;
        box-shadow: 0 4px 15px rgba(79, 70, 229, 0.4);
        transition: transform 0.2s ease;
    }
    .mockup-btn:hover {
        transform: translateY(-1px);
        color: #ffffff;
    }
    .mockup-footer {
        background-color: #0b0f19;
        padding: 20px 24px;
        border-top: 1px solid #1e293b;
        color: #94a3b8;
    }
    .mockup-footer p {
        color: #94a3b8 !important;
    }
    .mockup-footer div {
        color: #64748b !important;
    }
    .mockup-logo-wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 40px;
    }

    /* Light Mode Inbox Simulation Styles */
    .mail-client-window.is-light-email {
        background-color: #e2e8f0;
    }
    .mail-client-window.is-light-email .mail-client-meta {
        background: #ffffff;
        border-color: #cbd5e1;
        color: #1e293b;
    }
    .mail-client-window.is-light-email .mail-client-meta .text-muted {
        color: #64748b !important;
    }
    .mail-client-window.is-light-email .email-mockup-card {
        background-color: #ffffff !important;
        border-color: #cbd5e1 !important;
        color: #334155 !important;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08) !important;
    }
    .mail-client-window.is-light-email .mockup-header {
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%) !important;
        border-bottom: 1px solid #e2e8f0 !important;
    }
    .mail-client-window.is-light-email .mockup-brand-title {
        color: #0f172a !important;
    }
    .mail-client-window.is-light-email .mockup-badge {
        background: #eef2ff !important;
        border-color: #c7d2fe !important;
        color: #4338ca !important;
    }
    .mail-client-window.is-light-email .mockup-body {
        color: #334155 !important;
    }
    .mail-client-window.is-light-email .mockup-greeting {
        color: #0f172a !important;
    }
    .mail-client-window.is-light-email .mockup-content p {
        color: #334155 !important;
    }
    .mail-client-window.is-light-email .mockup-content strong {
        color: #0f172a !important;
    }
    .mail-client-window.is-light-email .mockup-content code {
        background: #f1f5f9 !important;
        border-color: #cbd5e1 !important;
        color: #0284c7 !important;
    }
    .mail-client-window.is-light-email .mockup-content table {
        border-color: #e2e8f0 !important;
        background-color: #ffffff !important;
        color: #334155 !important;
    }
    .mail-client-window.is-light-email .mockup-content table td,
    .mail-client-window.is-light-email .mockup-content table th {
        border-color: #e2e8f0 !important;
        color: #334155 !important;
    }
    .mail-client-window.is-light-email .mockup-footer {
        background-color: #f8fafc !important;
        border-top: 1px solid #e2e8f0 !important;
        color: #64748b !important;
    }
    .mail-client-window.is-light-email .mockup-footer p {
        color: #64748b !important;
    }
    .mail-client-window.is-light-email .mockup-footer div {
        color: #94a3b8 !important;
    }

    /* Tag Chip Badges */
    .tag-insert-chip {
        cursor: pointer;
        background: #eef2ff;
        border: 1px solid #c7d2fe;
        color: #4338ca;
        font-size: 11.5px;
        font-weight: 600;
        padding: 3px 8px;
        border-radius: 6px;
        transition: all 0.15s ease;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        user-select: none;
    }
    .tag-insert-chip:hover {
        background: #4338ca;
        color: #ffffff;
        border-color: #4338ca;
    }

    /* DARK MODE STYLES (`body.dark-only`) */
    body.dark-only .email-templates-wrapper {
        color: #e2e8f0;
    }
    body.dark-only .mail-client-window {
        background-color: #0b0f19;
        border-color: #273142 !important;
    }
    body.dark-only .mail-client-meta {
        background: #141b2d;
        border-color: #273142;
        color: #cbd5e1;
    }
    body.dark-only .bg-light-subtle {
        background-color: #141b2d !important;
        border-color: #273142 !important;
        color: #f1f5f9 !important;
    }
    body.dark-only .tag-insert-chip {
        background: rgba(99, 98, 231, 0.18);
        border-color: rgba(99, 98, 231, 0.4);
        color: #a5b4fc;
    }
    body.dark-only .tag-insert-chip:hover {
        background: #6362e7;
        color: #ffffff;
    }
    body.dark-only .email-mockup-card {
        border-color: #334155;
    }
    body.dark-only .mail-client-window.is-phone-mode .email-mockup-card {
        border-color: #1e293b;
    }
    body.dark-only .form-control,
    body.dark-only .form-select {
        background-color: #0f172a !important;
        border-color: #334155 !important;
        color: #f8fafc !important;
    }
    body.dark-only .form-control:focus,
    body.dark-only .form-select:focus {
        border-color: #6362e7 !important;
        box-shadow: 0 0 0 3px rgba(99, 98, 231, 0.25) !important;
    }
    body.dark-only .input-group-text {
        background-color: #1e293b !important;
        border-color: #334155 !important;
        color: #94a3b8 !important;
    }

    /* Animation pulse */
    .animate-pulse {
        animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }
    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: .4; }
    }
</style>

<!-- Script Controller for Live Preview, Real-Time Editing & Test Dispatch -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Cache DOM elements
        var picker = document.getElementById('emailTemplatePicker');
        var form = document.getElementById('emailTemplateForm');
        var tmplIdInput = document.getElementById('currentTemplateId');
        var subjectInput = document.getElementById('tmplSubject');
        var preheaderInput = document.getElementById('tmplPreheader');
        var greetingInput = document.getElementById('tmplGreeting');
        var bodyInput = document.getElementById('tmplBody');
        var actionTextInput = document.getElementById('tmplActionText');
        var actionUrlInput = document.getElementById('tmplActionUrl');
        var footerTextInput = document.getElementById('tmplFooterText');
        var activeToggle = document.getElementById('tmplActiveToggle');
        var activeLabel = document.getElementById('tmplActiveLabel');
        var tagsContainer = document.getElementById('availableTagsList');
        var subjectCharCount = document.getElementById('subjectCharCount');
        var btnSave = document.getElementById('btnSaveTemplate');
        var btnReset = document.getElementById('btnResetTemplate');
        var btnSendTest = document.getElementById('btnSendTestEmail');
        var testEmailRecipient = document.getElementById('testEmailRecipient');
        var testEmailFeedback = document.getElementById('testEmailFeedback');

        // Preview DOM elements
        var prevSubject = document.getElementById('previewSubjectText');
        var prevPreheader = document.getElementById('previewPreheaderText');
        var prevGreeting = document.getElementById('previewGreetingText');
        var prevBody = document.getElementById('previewBodyContent');
        var prevActionContainer = document.getElementById('previewActionContainer');
        var prevActionBtn = document.getElementById('previewActionBtn');
        var prevActionBtnText = document.getElementById('previewActionBtnText');
        var prevFooterDisclaimer = document.getElementById('previewFooterDisclaimer');
        var prevCategoryBadge = document.getElementById('previewCategoryBadge');
        var tmplBadgeCategory = document.getElementById('tmplBadgeCategory');
        var tmplHeaderName = document.getElementById('tmplHeaderName');
        var tmplHeaderKey = document.getElementById('tmplHeaderKey');
        var mailClientFrame = document.getElementById('mailClientFrame');

        // Sample data dictionary for live client-side preview interpolation
        var sampleData = {
            'site_name': '{{ $settings->site_name ?? "TokenWeb3 Network" }}',
            'site_url': '{{ config("app.url", url("/")) }}',
            'dashboard_url': '{{ url("/dashboard") }}',
            'login_url': '{{ url("/login") }}',
            'portfolio_url': '{{ url("/dashboard/portfolio") }}',
            'plans_url': '{{ url("/dashboard/buy-plan") }}',
            'withdrawals_url': '{{ url("/dashboard/withdrawals") }}',
            'wallet_url': '{{ url("/dashboard/connect-wallet") }}',
            'admin_deposit_url': '{{ url("/admin/dashboard/mdeposits") }}',
            'admin_withdrawal_url': '{{ url("/admin/dashboard/mwithdrawals") }}',
            'user_name': 'Alexander Wright',
            'user_email': 'alex.wright@example.com',
            'amount': '{{ $settings->currency ?? "$" }}5,250.00',
            'invested_amount': '{{ $settings->currency ?? "$" }}15,000.00',
            'currency': '{{ $settings->currency ?? "$" }}',
            'payment_method': 'Tether USDT (TRC-20)',
            'transaction_id': 'TXN-84F9B283A1',
            'receiving_address': '0x71C...b49D',
            'wallet_provider': 'MetaMask Decentralized Vault',
            'wallet_address': '0x38F6b27...c588E',
            'plan_name': 'Institutional Arbitrage Tier III',
            'code': '849201',
            'subject': 'Quarterly Institutional Market Update',
            'message': 'Your account verification tier has been successfully upgraded to Level 2. Maximum single withdrawal limits have been expanded.',
            'action_url': '{{ url("/dashboard") }}',
            'status': 'Processed & Verified',
            'date': 'Sep 27, 2026 04:30 PM',
            'year': '{{ date("Y") }}'
        };

        // Helper: Replace all tags in string using sampleData
        function parseSampleTags(str) {
            if (!str) return '';
            var result = str;
            for (var key in sampleData) {
                var regex = new RegExp('\\{\\{\\s*' + key + '\\s*\\}\\}', 'gi');
                result = result.replace(regex, sampleData[key]);
            }
            return result;
        }

        // Live Preview Renderer: executes on every keystroke
        function updateLivePreview() {
            var subjectVal = subjectInput.value || '';
            var preheaderVal = preheaderInput.value || '';
            var greetingVal = greetingInput.value || '';
            var bodyVal = bodyInput.value || '';
            var actionTextVal = actionTextInput.value || '';
            var actionUrlVal = actionUrlInput.value || '';
            var footerVal = footerTextInput.value || '';

            // Update subject & counter
            subjectCharCount.textContent = subjectVal.length;
            prevSubject.textContent = parseSampleTags(subjectVal) || '(No Subject Line)';
            prevPreheader.textContent = parseSampleTags(preheaderVal) || '(No preheader)';

            // Update Greeting
            if (greetingVal.trim() !== '') {
                prevGreeting.style.display = 'block';
                prevGreeting.textContent = parseSampleTags(greetingVal);
            } else {
                prevGreeting.style.display = 'none';
            }

            // Update Body HTML
            prevBody.innerHTML = parseSampleTags(bodyVal);

            // Update Call to Action Button
            if (actionTextVal.trim() !== '') {
                prevActionContainer.style.display = 'block';
                prevActionBtnText.textContent = parseSampleTags(actionTextVal);
                prevActionBtn.href = parseSampleTags(actionUrlVal) || '#';
            } else {
                prevActionContainer.style.display = 'none';
            }

            // Update Footer Disclaimer
            prevFooterDisclaimer.textContent = parseSampleTags(footerVal);
        }

        // Attach live input listeners to all form controls
        [subjectInput, preheaderInput, greetingInput, bodyInput, actionTextInput, actionUrlInput, footerTextInput].forEach(function(el) {
            el.addEventListener('input', updateLivePreview);
            el.addEventListener('change', updateLivePreview);
        });

        // Load template details via AJAX
        window.loadTemplateData = function(id) {
            var url = '{{ url("admin/dashboard/email-templates") }}/' + id;
            fetch(url, {
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(function(r) { return r.json(); })
            .then(function(data) {
                if (data.status === 200 && data.template) {
                    var t = data.template;
                    tmplIdInput.value = t.id;
                    subjectInput.value = t.subject || '';
                    preheaderInput.value = t.preheader || '';
                    greetingInput.value = t.greeting || '';
                    bodyInput.value = t.body || '';
                    actionTextInput.value = t.action_text || '';
                    actionUrlInput.value = t.action_url || '';
                    footerTextInput.value = t.footer_text || '';

                    // Active Toggle
                    activeToggle.checked = !!t.is_active;
                    activeLabel.textContent = t.is_active ? 'Active (Sending)' : 'Disabled (Paused)';

                    // Header Meta
                    tmplHeaderName.textContent = t.name;
                    tmplHeaderKey.textContent = t.key;
                    tmplBadgeCategory.textContent = t.category;
                    prevCategoryBadge.textContent = t.category;

                    // Populate Tag Chips
                    tagsContainer.innerHTML = '';
                    var tags = t.available_tags || [];
                    if (tags.length === 0) {
                        tags = [
                            { tag: '@{{user_name}}', desc: "User's full name" },
                            { tag: '@{{site_name}}', desc: "Brand name" },
                            { tag: '@{{dashboard_url}}', desc: "Dashboard URL" }
                        ];
                    }
                    tags.forEach(function(item) {
                        var chip = document.createElement('span');
                        chip.className = 'tag-insert-chip';
                        chip.innerHTML = '<i class="fa fa-plus-circle f-10"></i> ' + item.tag;
                        chip.title = item.desc || item.tag;
                        chip.addEventListener('click', function() {
                            insertAtCursor(bodyInput, item.tag);
                            updateLivePreview();
                        });
                        tagsContainer.appendChild(chip);
                    });

                    // Update live preview
                    updateLivePreview();
                }
            })
            .catch(function(err) {
                console.error('Error fetching template:', err);
            });
        };

        // Helper: Insert text at current cursor position in a textarea
        function insertAtCursor(myField, myValue) {
            if (document.selection) {
                myField.focus();
                var sel = document.selection.createRange();
                sel.text = myValue;
            } else if (myField.selectionStart || myField.selectionStart == '0') {
                var startPos = myField.selectionStart;
                var endPos = myField.selectionEnd;
                myField.value = myField.value.substring(0, startPos) + myValue + myField.value.substring(endPos, myField.value.length);
                myField.selectionStart = startPos + myValue.length;
                myField.selectionEnd = startPos + myValue.length;
                myField.focus();
            } else {
                myField.value += myValue;
                myField.focus();
            }
        }

        // Quick HTML tag insertion helper
        window.insertHtmlTag = function(tag) {
            var selected = bodyInput.value.substring(bodyInput.selectionStart, bodyInput.selectionEnd);
            var replacement = '<' + tag + '>' + (selected || 'text') + '</' + tag + '>';
            insertAtCursor(bodyInput, replacement);
            updateLivePreview();
        };

        // Template Picker dropdown change
        picker.addEventListener('change', function() {
            loadTemplateData(this.value);
        });

        // Category filter chips
        document.querySelectorAll('.category-filter-btn').forEach(function(btn) {
            btn.addEventListener('click', function() {
                var cat = this.getAttribute('data-cat');
                document.querySelectorAll('.category-filter-btn').forEach(function(b) {
                    b.classList.remove('btn-primary', 'active');
                    b.classList.add('btn-outline-secondary');
                });
                this.classList.remove('btn-outline-secondary');
                this.classList.add('btn-primary', 'active');

                // Filter options in picker
                var firstVisibleId = null;
                Array.from(picker.options).forEach(function(opt) {
                    if (cat === 'all' || opt.getAttribute('data-category') === cat) {
                        opt.style.display = 'block';
                        if (!firstVisibleId) firstVisibleId = opt.value;
                    } else {
                        opt.style.display = 'none';
                    }
                });

                if (firstVisibleId && picker.value !== firstVisibleId) {
                    picker.value = firstVisibleId;
                    loadTemplateData(firstVisibleId);
                }
            });
        });

        // Active Toggle Switch change
        activeToggle.addEventListener('change', function() {
            var id = tmplIdInput.value;
            activeLabel.textContent = this.checked ? 'Active (Sending)' : 'Disabled (Paused)';

            fetch('{{ url("admin/dashboard/email-templates") }}/' + id + '/toggle', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            })
            .then(function(r) { return r.json(); })
            .then(function(data) {
                if (data.status === 200 && window.toastr) {
                    toastr.success(data.message);
                }
            });
        });

        // Save Template Form submission
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            var id = tmplIdInput.value;
            btnSave.disabled = true;
            btnSave.innerHTML = '<i class="fa fa-spinner fa-spin me-1"></i> Saving...';

            var payload = {
                subject: subjectInput.value,
                preheader: preheaderInput.value,
                greeting: greetingInput.value,
                body: bodyInput.value,
                action_text: actionTextInput.value,
                action_url: actionUrlInput.value,
                footer_text: footerTextInput.value,
                is_active: activeToggle.checked ? 1 : 0
            };

            fetch('{{ url("admin/dashboard/email-templates") }}/' + id, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(payload)
            })
            .then(function(r) { return r.json(); })
            .then(function(data) {
                btnSave.disabled = false;
                btnSave.innerHTML = '<i class="fa fa-save me-1"></i> Save Changes';

                if (data.status === 200) {
                    var indicator = document.getElementById('saveSuccessIndicator');
                    if (indicator) {
                        indicator.classList.remove('d-none');
                        setTimeout(function() { indicator.classList.add('d-none'); }, 3000);
                    }
                    if (window.toastr) {
                        toastr.success(data.message || 'Template updated successfully!');
                    }
                } else {
                    alert(data.message || 'Could not save template changes.');
                }
            })
            .catch(function(err) {
                btnSave.disabled = false;
                btnSave.innerHTML = '<i class="fa fa-save me-1"></i> Save Changes';
                console.error(err);
                alert('An error occurred while saving the template.');
            });
        });

        // Restore Factory Default
        btnReset.addEventListener('click', function() {
            var id = tmplIdInput.value;
            if (!confirm('Are you sure you want to reset this template to its original system default? Any custom edits will be replaced.')) {
                return;
            }

            btnReset.disabled = true;
            btnReset.innerHTML = '<i class="fa fa-spinner fa-spin me-1"></i> Resetting...';

            fetch('{{ url("admin/dashboard/email-templates") }}/' + id + '/reset', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            })
            .then(function(r) { return r.json(); })
            .then(function(data) {
                btnReset.disabled = false;
                btnReset.innerHTML = '<i class="fa fa-undo me-1"></i> Restore Default';

                if (data.status === 200) {
                    loadTemplateData(id);
                    if (window.toastr) toastr.info(data.message);
                } else {
                    alert(data.message || 'Failed to reset template.');
                }
            })
            .catch(function(err) {
                btnReset.disabled = false;
                btnReset.innerHTML = '<i class="fa fa-undo me-1"></i> Restore Default';
                console.error(err);
            });
        });

        // Send Test Email Dispatcher
        btnSendTest.addEventListener('click', function() {
            var recipient = testEmailRecipient.value.trim();
            if (!recipient) {
                alert('Please enter a recipient email address to send the test message.');
                testEmailRecipient.focus();
                return;
            }

            var id = tmplIdInput.value;
            btnSendTest.disabled = true;
            btnSendTest.innerHTML = '<i class="fa fa-spinner fa-spin me-1"></i> Sending...';
            testEmailFeedback.className = 'mt-2 f-12 text-muted';
            testEmailFeedback.innerHTML = '<i class="fa fa-circle-o-notch fa-spin me-1"></i> Dispatching test email via server...';
            testEmailFeedback.classList.remove('d-none');

            var payload = {
                test_email: recipient,
                subject: subjectInput.value,
                preheader: preheaderInput.value,
                greeting: greetingInput.value,
                body: bodyInput.value,
                action_text: actionTextInput.value,
                action_url: actionUrlInput.value,
                footer_text: footerTextInput.value
            };

            fetch('{{ url("admin/dashboard/email-templates") }}/' + id + '/test', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(payload)
            })
            .then(function(r) { return r.json(); })
            .then(function(data) {
                btnSendTest.disabled = false;
                btnSendTest.innerHTML = '<i class="fa fa-paper-plane me-1"></i> Send Test';

                if (data.status === 200 && data.success) {
                    testEmailFeedback.className = 'mt-2 f-12 text-success';
                    testEmailFeedback.innerHTML = '<i class="fa fa-check-circle me-1"></i> ' + data.message;
                    if (window.toastr) toastr.success(data.message);
                } else {
                    testEmailFeedback.className = 'mt-2 f-12 text-danger';
                    testEmailFeedback.innerHTML = '<i class="fa fa-exclamation-triangle me-1"></i> ' + (data.message || 'Failed to dispatch email.');
                }
            })
            .catch(function(err) {
                btnSendTest.disabled = false;
                btnSendTest.innerHTML = '<i class="fa fa-paper-plane me-1"></i> Send Test';
                testEmailFeedback.className = 'mt-2 f-12 text-danger';
                testEmailFeedback.innerHTML = '<i class="fa fa-exclamation-triangle me-1"></i> Network error while dispatching test email.';
                console.error(err);
            });
        });

        // Inbox Theme Toggle (Dark vs Light Inbox)
        document.querySelectorAll('#previewThemeToggle button').forEach(function(btn) {
            btn.addEventListener('click', function() {
                var theme = this.getAttribute('data-theme');
                document.querySelectorAll('#previewThemeToggle button').forEach(function(b) {
                    b.classList.remove('active', 'btn-primary');
                    b.classList.add('btn-outline-secondary');
                });
                this.classList.remove('btn-outline-secondary');
                this.classList.add('active', 'btn-primary');

                var logoImg = document.getElementById('mockupLogoImg');
                if (theme === 'light') {
                    mailClientFrame.classList.add('is-light-email');
                    if (logoImg && logoImg.getAttribute('data-light-src')) {
                        logoImg.src = logoImg.getAttribute('data-light-src');
                    }
                } else {
                    mailClientFrame.classList.remove('is-light-email');
                    if (logoImg && logoImg.getAttribute('data-dark-src')) {
                        logoImg.src = logoImg.getAttribute('data-dark-src');
                    }
                }
            });
        });

        // Device Viewport Toggle (Desktop vs Phone)
        document.querySelectorAll('#previewDeviceToggle button').forEach(function(btn) {
            btn.addEventListener('click', function() {
                var device = this.getAttribute('data-device');
                document.querySelectorAll('#previewDeviceToggle button').forEach(function(b) {
                    b.classList.remove('active', 'btn-primary');
                    b.classList.add('btn-outline-secondary');
                });
                this.classList.remove('btn-outline-secondary');
                this.classList.add('active', 'btn-primary');

                if (device === 'mobile') {
                    mailClientFrame.classList.add('is-phone-mode');
                } else {
                    mailClientFrame.classList.remove('is-phone-mode');
                }
            });
        });

        // Mobile View Switcher (< 992px)
        var btnShowEditor = document.getElementById('btnShowEditor');
        var btnShowPreview = document.getElementById('btnShowPreview');
        var editorCol = document.getElementById('editorColumn');
        var previewCol = document.getElementById('previewColumn');

        if (btnShowEditor && btnShowPreview) {
            btnShowEditor.addEventListener('click', function() {
                this.classList.add('btn-primary', 'active');
                this.classList.remove('btn-outline-primary');
                btnShowPreview.classList.add('btn-outline-primary');
                btnShowPreview.classList.remove('btn-primary', 'active');

                editorCol.classList.remove('d-none');
                previewCol.classList.add('d-none');
            });

            btnShowPreview.addEventListener('click', function() {
                this.classList.add('btn-primary', 'active');
                this.classList.remove('btn-outline-primary');
                btnShowEditor.classList.add('btn-outline-primary');
                btnShowEditor.classList.remove('btn-primary', 'active');

                editorCol.classList.add('d-none');
                previewCol.classList.remove('d-none');
                updateLivePreview();
            });

            // Adjust on window resize
            function handleResize() {
                if (window.innerWidth >= 992) {
                    editorCol.classList.remove('d-none');
                    previewCol.classList.remove('d-none');
                } else {
                    if (btnShowEditor.classList.contains('active')) {
                        editorCol.classList.remove('d-none');
                        previewCol.classList.add('d-none');
                    } else {
                        editorCol.classList.add('d-none');
                        previewCol.classList.remove('d-none');
                    }
                }
            }
            window.addEventListener('resize', handleResize);
            handleResize();
        }

        // Initial load of the first template
        if (picker.value) {
            loadTemplateData(picker.value);
        }
    });
</script>
