<form method="POST" action="{{ route('updatewebinfo') }}" id="appinfoform" enctype="multipart/form-data">
    @method('PUT')
    @csrf

    <div class="row g-4">
        <!-- Section 1: Brand Identity & Domain Configuration -->
        <div class="col-12">
            <div class="settings-card-section">
                <div class="d-flex align-items-center gap-2 mb-3 pb-2 border-bottom">
                    <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                        <i class="fa fa-globe f-16"></i>
                    </div>
                    <div>
                        <h6 class="f-w-700 mb-0">Brand Identity & SEO Details</h6>
                        <small class="text-muted">Core business names, public domain URLs, and search engine metadata.</small>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label f-w-600 f-13">Website / Brand Name <span class="text-danger">*</span></label>
                        <input type="text" name="site_name" class="form-control form-control-lg f-w-600" value="{{ $settings->site_name }}" placeholder="e.g. ECX Groups" required>
                        <small class="text-muted f-11">Appears across email templates, invoices, and browser tab titles.</small>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label f-w-600 f-13">Website Title & Tagline <span class="text-danger">*</span></label>
                        <input type="text" name="site_title" class="form-control form-control-lg f-w-600" value="{{ $settings->site_title }}" placeholder="e.g. Premium Crypto & Forex Trading Platform" required>
                        <small class="text-muted f-11">Displayed as the primary search engine title.</small>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label f-w-600 f-13">Website Domain URL <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa fa-link text-muted"></i></span>
                            <input type="url" name="site_address" class="form-control" value="{{ $settings->site_address }}" placeholder="https://app.ecxgroups.com" required>
                        </div>
                        <small class="text-muted f-11">Include https:// without a trailing slash.</small>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label f-w-600 f-13">SEO Keywords (Comma Separated) <span class="text-danger">*</span></label>
                        <input type="text" name="keywords" class="form-control" value="{{ $settings->keywords }}" placeholder="crypto, trading, forex, investment, stocks" required>
                        <small class="text-muted f-11">Helps search engine web crawlers index your application.</small>
                    </div>

                    <div class="col-12">
                        <label class="form-label f-w-600 f-13">Website Meta Description</label>
                        <textarea name="description" class="form-control" rows="3" placeholder="Brief summary of your platform services...">{{ $settings->description }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section 2: Visual Assets (Logo & Favicon) with Previews -->
        <div class="col-12">
            <div class="settings-card-section">
                <div class="d-flex align-items-center gap-2 mb-3 pb-2 border-bottom">
                    <div class="rounded-circle bg-success bg-opacity-10 text-success d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                        <i class="fa fa-image f-16"></i>
                    </div>
                    <div>
                        <h6 class="f-w-700 mb-0">Visual Assets & Branding Media</h6>
                        <small class="text-muted">Upload high-resolution logos and browser tab favicon graphics.</small>
                    </div>
                </div>

                <div class="row g-4">
                    <!-- 1. Light Logo (For Dark Theme & Dark Backgrounds) -->
                    <div class="col-lg-4 col-md-6">
                        <div class="settings-subcard p-4 h-100">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <label class="form-label f-w-700 f-13 mb-0">
                                    <i class="fa fa-moon-o text-warning me-1"></i> Light Logo (For Dark Mode)
                                </label>
                                <span class="badge bg-dark text-light border px-2 py-1 rounded f-10">Dark Theme</span>
                            </div>
                            <small class="text-muted d-block mb-3 f-11">Bright/white logo graphic used against dark headers and dark theme layouts.</small>

                            <!-- Dark Preview Card -->
                            <div class="d-flex align-items-center gap-3 mb-3 p-3 rounded-3 border" style="background: #0B0E14;">
                                <div class="rounded-2 p-2 border border-secondary d-flex align-items-center justify-content-center" style="width: 130px; height: 65px; background: rgba(255,255,255,0.04);">
                                    @if ($settings->logo)
                                        <img src="{{ asset('storage/app/public/' . $settings->logo) }}" alt="Light Logo Preview" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                                    @else
                                        <img src="{{ asset('volkovdesign/img/logo.svg') }}" alt="Default Logo" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                                    @endif
                                </div>
                                <div>
                                    <span class="badge bg-success bg-opacity-10 text-success px-2 py-1 rounded-pill f-11 mb-1">Active Preview</span>
                                    <p class="text-muted f-11 mb-0">Transparent PNG, SVG, or WEBP.</p>
                                </div>
                            </div>
                            <input name="logo" class="form-control" type="file" accept="image/png,image/jpeg,image/svg+xml,image/webp">
                        </div>
                    </div>

                    <!-- 2. Dark Logo (For Light Theme & White Backgrounds) -->
                    <div class="col-lg-4 col-md-6">
                        <div class="settings-subcard p-4 h-100">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <label class="form-label f-w-700 f-13 mb-0">
                                    <i class="fa fa-sun-o text-warning me-1"></i> Dark Logo (For Light Mode)
                                </label>
                                <span class="badge bg-light text-dark border px-2 py-1 rounded f-10">Light Theme</span>
                            </div>
                            <small class="text-muted d-block mb-3 f-11">Dark/black logo graphic used against crisp white backgrounds and Light Mode.</small>

                            <!-- Light Preview Card -->
                            <div class="d-flex align-items-center gap-3 mb-3 p-3 rounded-3 border bg-white" style="box-shadow: inset 0 0 0 1px rgba(0,0,0,0.05);">
                                <div class="rounded-2 p-2 border border-light-subtle d-flex align-items-center justify-content-center bg-light" style="width: 130px; height: 65px;">
                                    @if ($settings->dark_logo)
                                        <img src="{{ asset('storage/app/public/' . $settings->dark_logo) }}" alt="Dark Logo Preview" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                                    @elseif($settings->logo)
                                        <img src="{{ asset('storage/app/public/' . $settings->logo) }}" alt="Fallback Preview" style="max-width: 100%; max-height: 100%; object-fit: contain; filter: brightness(0.2);">
                                    @else
                                        <span class="text-muted f-11">Auto-derived</span>
                                    @endif
                                </div>
                                <div>
                                    <span class="badge bg-primary bg-opacity-10 text-primary px-2 py-1 rounded-pill f-11 mb-1">{{ $settings->dark_logo ? 'Custom File' : 'Auto Fallback' }}</span>
                                    <p class="text-muted f-11 mb-0">Transparent PNG, SVG, or WEBP.</p>
                                </div>
                            </div>
                            <input name="dark_logo" class="form-control" type="file" accept="image/png,image/jpeg,image/svg+xml,image/webp">
                        </div>
                    </div>

                    <!-- 3. Favicon Upload & Preview -->
                    <div class="col-lg-4 col-md-12">
                        <div class="settings-subcard p-4 h-100">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <label class="form-label f-w-700 f-13 mb-0">Browser Tab Favicon</label>
                                <span class="badge bg-secondary bg-opacity-10 text-secondary border px-2 py-1 rounded f-10">Tab Icon</span>
                            </div>
                            <small class="text-muted d-block mb-3 f-11">Icon displayed on browser tabs, bookmarks, and shortcuts.</small>

                            <div class="d-flex align-items-center gap-3 mb-3 p-3 bg-white rounded-3 border" style="background: repeating-conic-gradient(#f8f9fa 0% 25%, #fff 0% 50%) 50% / 16px 16px;">
                                <div class="rounded-2 p-2 bg-white border d-flex align-items-center justify-content-center shadow-xs" style="width: 65px; height: 65px;">
                                    @if ($settings->favicon)
                                        <img src="{{ asset('storage/app/public/' . $settings->favicon) }}" alt="Favicon Preview" style="max-width: 32px; max-height: 32px; object-fit: contain;">
                                    @else
                                        <span class="text-muted f-12">None</span>
                                    @endif
                                </div>
                                <div>
                                    <span class="badge bg-light-primary text-primary px-2 py-1 rounded-pill f-11 mb-1">Current Icon</span>
                                    <p class="text-muted f-11 mb-0">Square 32&times;32px or 64&times;64px PNG/ICO.</p>
                                </div>
                            </div>
                            <input name="favicon" class="form-control" type="file" accept="image/png,image/jpeg,image/x-icon">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section 3: Live Support & Custom Scripts -->
        <div class="col-12">
            <div class="settings-card-section">
                <div class="d-flex align-items-center gap-2 mb-3 pb-2 border-bottom">
                    <div class="rounded-circle bg-info bg-opacity-10 text-info d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                        <i class="fa fa-comments f-16"></i>
                    </div>
                    <div>
                        <h6 class="f-w-700 mb-0">Live Chat & Support Integrations</h6>
                        <small class="text-muted">Directly embed customer support widgets like Tawk.to, Provixchat, Crisp, or Zendesk.</small>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label f-w-600 f-13">Live Chat Widget Embed Code</label>
                        <textarea name="tawk_to" class="form-control font-monospace f-12" rows="3" placeholder="<!-- Paste your live chat widget snippet, e.g. <script src='...'></script> -->">{{ $settings->tawk_to }}</textarea>
                        <small class="text-muted f-11">Automatically rendered across all public pages and user dashboards.</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section 4: Welcome Messaging & Announcements -->
        <div class="col-12">
            <div class="settings-card-section">
                <div class="d-flex align-items-center gap-2 mb-3 pb-2 border-bottom">
                    <div class="rounded-circle bg-warning bg-opacity-10 text-warning d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                        <i class="fa fa-bullhorn f-16"></i>
                    </div>
                    <div>
                        <h6 class="f-w-700 mb-0">Announcements & Investor Messaging</h6>
                        <small class="text-muted">Broadcast notices and personalized welcome notes for newly registered investors.</small>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label f-w-600 f-13">Global Broadcast Announcement Banner</label>
                        <textarea name="update" class="form-control" rows="2" placeholder="e.g. Scheduled system maintenance on Sunday at 02:00 UTC...">{{ $settings->newupdate }}</textarea>
                        <small class="text-muted f-11">When announcement is toggled ON in Preferences, this message displays at the top of client dashboards.</small>
                    </div>

                    <div class="col-12">
                        <label class="form-label f-w-600 f-13">New Member Welcome Message</label>
                        <textarea name="welcome_message" class="form-control" rows="2" placeholder="e.g. Welcome to ECX Groups! Please complete your KYC verification to get started.">{{ $settings->welcome_message }}</textarea>
                        <small class="text-muted f-11"><i class="fa fa-info-circle me-1 text-primary"></i> Prominently displayed to investors whose registration date is less than or equal to 3 days.</small>
                    </div>
                </div>
            </div>
        </div>

        @php
            $welcomeSlides = $settings->getWelcomeSlides();
            $slide1 = $welcomeSlides[0] ?? [];
            $slide2 = $welcomeSlides[1] ?? [];
            $slide3 = $welcomeSlides[2] ?? [];
        @endphp

        <!-- Section 5: Welcome & Wallet Connect Onboarding Popup (Interactive Slider Tour) -->
        <div class="col-12" id="welcome_popup_section">
            <div class="settings-card-section" style="border-left: 4px solid #4f46e5;">
                <div class="d-flex align-items-center justify-content-between mb-3 pb-2 border-bottom flex-wrap gap-2">
                    <div class="d-flex align-items-center gap-2">
                        <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center" style="width: 38px; height: 38px;">
                            <i class="fa fa-sliders f-16"></i>
                        </div>
                        <div>
                            <h6 class="f-w-700 mb-0">Client Onboarding & Welcome Popup Tour</h6>
                            <small class="text-muted">Interactive multi-slide modal displayed to newly registered & logged-in users to guide them and link their crypto wallet.</small>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <span class="f-12 f-w-600 text-muted">Modal Status:</span>
                        <div class="selectgroup selectgroup-pills">
                            <label class="selectgroup-item">
                                <input type="radio" name="enable_welcome_popup" value="yes" class="selectgroup-input" {{ ($settings->enable_welcome_popup ?? 'yes') == 'yes' ? 'checked' : '' }}>
                                <span class="selectgroup-button selectgroup-button-icon px-3 py-1"><i class="fa fa-check me-1 text-success"></i> Enabled</span>
                            </label>
                            <label class="selectgroup-item">
                                <input type="radio" name="enable_welcome_popup" value="no" class="selectgroup-input" {{ ($settings->enable_welcome_popup ?? 'yes') == 'no' ? 'checked' : '' }}>
                                <span class="selectgroup-button selectgroup-button-icon px-3 py-1"><i class="fa fa-times me-1 text-danger"></i> Disabled</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="alert alert-light border d-flex align-items-center gap-3 py-2 px-3 mb-4 rounded-3">
                    <i class="fa fa-info-circle text-primary f-18"></i>
                    <div class="f-12 text-muted">
                        Investors see this interactive walkthrough when they log in. You can customize the sentences, titles, and CTA actions for each slide below.
                    </div>
                </div>

                <!-- 3 Interactive Slide Configuration Cards -->
                <div class="row g-3">
                    <!-- Slide 1: Welcome & Activation -->
                    <div class="col-lg-4">
                        <div class="p-3 border rounded-3 h-100 slide-config-card shadow-sm" style="border-top: 3px solid #6366f1 !important;">
                            <div class="d-flex align-items-center justify-content-between mb-3 pb-2 border-bottom flex-wrap gap-1">
                                <div class="d-flex align-items-center gap-2">
                                    <span class="badge bg-primary px-2 py-1 f-11 f-w-700">Slide 1: Welcome</span>
                                    <i class="fa fa-shield-halved text-primary f-14"></i>
                                </div>
                                <div class="d-flex align-items-center gap-1">
                                    <span class="f-11 f-w-600 text-muted me-1">Status:</span>
                                    <div class="selectgroup selectgroup-pills">
                                        <label class="selectgroup-item">
                                            <input type="radio" name="popup_slides[0][is_active]" value="yes" class="selectgroup-input" {{ ($slide1['is_active'] ?? 'yes') != 'no' ? 'checked' : '' }}>
                                            <span class="selectgroup-button py-1 px-2 f-11"><i class="fa fa-eye text-success me-1"></i> Show</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="radio" name="popup_slides[0][is_active]" value="no" class="selectgroup-input" {{ ($slide1['is_active'] ?? 'yes') == 'no' ? 'checked' : '' }}>
                                            <span class="selectgroup-button py-1 px-2 f-11"><i class="fa fa-eye-slash text-danger me-1"></i> Hide</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="popup_slides[0][icon]" value="{{ $slide1['icon'] ?? 'fa-shield-halved' }}">
                            <div class="mb-2">
                                <label class="form-label f-w-600 f-12 mb-1 d-flex justify-content-between align-items-center">
                                    <span>Slide Photo / Graphic</span>
                                    <small class="text-muted">Optional</small>
                                </label>
                                <input type="file" name="slide_images[0]" class="form-control form-control-sm" accept="image/*">
                                <input type="hidden" name="popup_slides[0][existing_image]" value="{{ $slide1['image'] ?? '' }}">
                                @if(!empty($slide1['image']))
                                    <div class="d-flex align-items-center justify-content-between mt-2 p-2 border rounded slide-preview-box">
                                        <div class="d-flex align-items-center gap-2">
                                            <img src="{{ $slide1['image_url'] ?? \App\Models\Settings::getSlideImageUrl($slide1['image']) }}" alt="Slide Graphic" style="height: 36px; width: 52px; object-fit: cover; border-radius: 4px;" class="border">
                                            <span class="f-11 text-muted text-truncate" style="max-width: 140px;">Custom graphic active</span>
                                        </div>
                                        <div class="form-check form-check-inline mb-0">
                                            <input class="form-check-input" type="checkbox" name="popup_slides[0][remove_image]" value="1" id="removeImg0">
                                            <label class="form-check-label f-11 text-danger cursor-pointer" for="removeImg0">Remove</label>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="mb-2">
                                <label class="form-label f-w-600 f-12 mb-1">Badge Tag</label>
                                <input type="text" name="popup_slides[0][badge]" class="form-control form-control-sm" value="{{ $slide1['badge'] ?? 'Account Clearance' }}" placeholder="e.g. Account Clearance">
                            </div>
                            <div class="mb-2">
                                <label class="form-label f-w-600 f-12 mb-1">Slide Title</label>
                                <input type="text" name="popup_slides[0][title]" class="form-control form-control-sm f-w-600" value="{{ $slide1['title'] ?? 'Welcome to Your ECX Trading Portal' }}" placeholder="Slide Title">
                            </div>
                            <div class="mb-2">
                                <label class="form-label f-w-600 f-12 mb-1">Slide Sentences / Message</label>
                                <textarea name="popup_slides[0][message]" class="form-control form-control-sm" rows="3" placeholder="Welcome sentences for the investor...">{{ $slide1['message'] ?? 'Your institutional investor profile and credentials have been verified. You now have full access to high-yield liquidity pools, automated yield distributions, and encrypted asset custody.' }}</textarea>
                            </div>
                            <div class="mb-0">
                                <label class="form-label f-w-600 f-12 mb-1">Security / Feature Note</label>
                                <input type="text" name="popup_slides[0][highlight]" class="form-control form-control-sm" value="{{ $slide1['highlight'] ?? 'Institutional Grade 256-Bit SSL Security' }}" placeholder="Feature highlight note">
                            </div>
                        </div>
                    </div>

                    <!-- Slide 2: Connect Crypto Wallet -->
                    <div class="col-lg-4">
                        <div class="p-3 border rounded-3 h-100 slide-config-card shadow-sm" style="border-top: 3px solid #0ea5e9 !important;">
                            <div class="d-flex align-items-center justify-content-between mb-3 pb-2 border-bottom flex-wrap gap-1">
                                <div class="d-flex align-items-center gap-2">
                                    <span class="badge bg-info text-white px-2 py-1 f-11 f-w-700">Slide 2: Connect Wallet</span>
                                    <i class="fa fa-wallet text-info f-14"></i>
                                </div>
                                <div class="d-flex align-items-center gap-1">
                                    <span class="f-11 f-w-600 text-muted me-1">Status:</span>
                                    <div class="selectgroup selectgroup-pills">
                                        <label class="selectgroup-item">
                                            <input type="radio" name="popup_slides[1][is_active]" value="yes" class="selectgroup-input" {{ ($slide2['is_active'] ?? 'yes') != 'no' ? 'checked' : '' }}>
                                            <span class="selectgroup-button py-1 px-2 f-11"><i class="fa fa-eye text-success me-1"></i> Show</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="radio" name="popup_slides[1][is_active]" value="no" class="selectgroup-input" {{ ($slide2['is_active'] ?? 'yes') == 'no' ? 'checked' : '' }}>
                                            <span class="selectgroup-button py-1 px-2 f-11"><i class="fa fa-eye-slash text-danger me-1"></i> Hide</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="popup_slides[1][icon]" value="{{ $slide2['icon'] ?? 'fa-wallet' }}">
                            <div class="mb-2">
                                <label class="form-label f-w-600 f-12 mb-1 d-flex justify-content-between align-items-center">
                                    <span>Slide Photo / Graphic</span>
                                    <small class="text-muted">Optional</small>
                                </label>
                                <input type="file" name="slide_images[1]" class="form-control form-control-sm" accept="image/*">
                                <input type="hidden" name="popup_slides[1][existing_image]" value="{{ $slide2['image'] ?? '' }}">
                                @if(!empty($slide2['image']))
                                    <div class="d-flex align-items-center justify-content-between mt-2 p-2 border rounded slide-preview-box">
                                        <div class="d-flex align-items-center gap-2">
                                            <img src="{{ $slide2['image_url'] ?? \App\Models\Settings::getSlideImageUrl($slide2['image']) }}" alt="Slide Graphic" style="height: 36px; width: 52px; object-fit: cover; border-radius: 4px;" class="border">
                                            <span class="f-11 text-muted text-truncate" style="max-width: 140px;">Custom graphic active</span>
                                        </div>
                                        <div class="form-check form-check-inline mb-0">
                                            <input class="form-check-input" type="checkbox" name="popup_slides[1][remove_image]" value="1" id="removeImg1">
                                            <label class="form-check-label f-11 text-danger cursor-pointer" for="removeImg1">Remove</label>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="mb-2">
                                <label class="form-label f-w-600 f-12 mb-1">Badge Tag</label>
                                <input type="text" name="popup_slides[1][badge]" class="form-control form-control-sm" value="{{ $slide2['badge'] ?? 'Decentralized Vault' }}" placeholder="e.g. Decentralized Vault">
                            </div>
                            <div class="mb-2">
                                <label class="form-label f-w-600 f-12 mb-1">Slide Title</label>
                                <input type="text" name="popup_slides[1][title]" class="form-control form-control-sm f-w-600" value="{{ $slide2['title'] ?? 'Connect Your Cryptocurrency Wallet' }}" placeholder="Slide Title">
                            </div>
                            <div class="mb-2">
                                <label class="form-label f-w-600 f-12 mb-1">Slide Sentences / Message</label>
                                <textarea name="popup_slides[1][message]" class="form-control form-control-sm" rows="3" placeholder="Message explaining wallet connection...">{{ $slide2['message'] ?? 'Link your Web3 crypto wallet (MetaMask, TrustWallet, Coinbase, Ledger, etc.) to activate seamless automated payouts and link your on-chain assets with zero transaction friction.' }}</textarea>
                            </div>
                            <div class="mb-2">
                                <label class="form-label f-w-600 f-12 mb-1">Connect Wallet Button Text</label>
                                <input type="text" name="popup_slides[1][button_text]" class="form-control form-control-sm f-w-700 text-primary" value="{{ $slide2['button_text'] ?? 'Connect Wallet Now' }}" placeholder="Button Label">
                            </div>
                            <div class="mb-0">
                                <label class="form-label f-w-600 f-12 mb-1">Destination URL</label>
                                <input type="text" name="popup_slides[1][button_url]" class="form-control form-control-sm" value="{{ $slide2['button_url'] ?? '/dashboard/connect-wallet' }}" placeholder="/dashboard/connect-wallet">
                            </div>
                        </div>
                    </div>

                    <!-- Slide 3: Yield Compounding & Plans -->
                    <div class="col-lg-4">
                        <div class="p-3 border rounded-3 h-100 slide-config-card shadow-sm" style="border-top: 3px solid #10b981 !important;">
                            <div class="d-flex align-items-center justify-content-between mb-3 pb-2 border-bottom flex-wrap gap-1">
                                <div class="d-flex align-items-center gap-2">
                                    <span class="badge bg-success px-2 py-1 f-11 f-w-700">Slide 3: Start Earning</span>
                                    <i class="fa fa-chart-line text-success f-14"></i>
                                </div>
                                <div class="d-flex align-items-center gap-1">
                                    <span class="f-11 f-w-600 text-muted me-1">Status:</span>
                                    <div class="selectgroup selectgroup-pills">
                                        <label class="selectgroup-item">
                                            <input type="radio" name="popup_slides[2][is_active]" value="yes" class="selectgroup-input" {{ ($slide3['is_active'] ?? 'yes') != 'no' ? 'checked' : '' }}>
                                            <span class="selectgroup-button py-1 px-2 f-11"><i class="fa fa-eye text-success me-1"></i> Show</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="radio" name="popup_slides[2][is_active]" value="no" class="selectgroup-input" {{ ($slide3['is_active'] ?? 'yes') == 'no' ? 'checked' : '' }}>
                                            <span class="selectgroup-button py-1 px-2 f-11"><i class="fa fa-eye-slash text-danger me-1"></i> Hide</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="popup_slides[2][icon]" value="{{ $slide3['icon'] ?? 'fa-chart-line' }}">
                            <div class="mb-2">
                                <label class="form-label f-w-600 f-12 mb-1 d-flex justify-content-between align-items-center">
                                    <span>Slide Photo / Graphic</span>
                                    <small class="text-muted">Optional</small>
                                </label>
                                <input type="file" name="slide_images[2]" class="form-control form-control-sm" accept="image/*">
                                <input type="hidden" name="popup_slides[2][existing_image]" value="{{ $slide3['image'] ?? '' }}">
                                @if(!empty($slide3['image']))
                                    <div class="d-flex align-items-center justify-content-between mt-2 p-2 border rounded slide-preview-box">
                                        <div class="d-flex align-items-center gap-2">
                                            <img src="{{ $slide3['image_url'] ?? \App\Models\Settings::getSlideImageUrl($slide3['image']) }}" alt="Slide Graphic" style="height: 36px; width: 52px; object-fit: cover; border-radius: 4px;" class="border">
                                            <span class="f-11 text-muted text-truncate" style="max-width: 140px;">Custom graphic active</span>
                                        </div>
                                        <div class="form-check form-check-inline mb-0">
                                            <input class="form-check-input" type="checkbox" name="popup_slides[2][remove_image]" value="1" id="removeImg2">
                                            <label class="form-check-label f-11 text-danger cursor-pointer" for="removeImg2">Remove</label>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="mb-2">
                                <label class="form-label f-w-600 f-12 mb-1">Badge Tag</label>
                                <input type="text" name="popup_slides[2][badge]" class="form-control form-control-sm" value="{{ $slide3['badge'] ?? 'Yield Compounding' }}" placeholder="e.g. Yield Compounding">
                            </div>
                            <div class="mb-2">
                                <label class="form-label f-w-600 f-12 mb-1">Slide Title</label>
                                <input type="text" name="popup_slides[2][title]" class="form-control form-control-sm f-w-600" value="{{ $slide3['title'] ?? 'Activate Daily Yield Distributions' }}" placeholder="Slide Title">
                            </div>
                            <div class="mb-2">
                                <label class="form-label f-w-600 f-12 mb-1">Slide Sentences / Message</label>
                                <textarea name="popup_slides[2][message]" class="form-control form-control-sm" rows="3" placeholder="Message explaining investment packages...">{{ $slide3['message'] ?? 'Deposit capital or enroll in our automated investment packages to earn daily returns credited directly to your connected wallet and account balance.' }}</textarea>
                            </div>
                            <div class="mb-2">
                                <label class="form-label f-w-600 f-12 mb-1">Action Button Text</label>
                                <input type="text" name="popup_slides[2][button_text]" class="form-control form-control-sm f-w-700 text-success" value="{{ $slide3['button_text'] ?? 'Explore Investment Plans' }}" placeholder="Button Label">
                            </div>
                            <div class="mb-0">
                                <label class="form-label f-w-600 f-12 mb-1">Destination URL</label>
                                <input type="text" name="popup_slides[2][button_url]" class="form-control form-control-sm" value="{{ $slide3['button_url'] ?? '/dashboard/buy-plan' }}" placeholder="/dashboard/buy-plan">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section 6: Localization, Server & License Configuration -->
        <div class="col-12">
            <div class="settings-card-section">
                <div class="d-flex align-items-center gap-2 mb-3 pb-2 border-bottom">
                    <div class="rounded-circle bg-secondary bg-opacity-10 text-secondary d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                        <i class="fa fa-cogs f-16"></i>
                    </div>
                    <div>
                        <h6 class="f-w-700 mb-0">Infrastructure, Timezone & License</h6>
                        <small class="text-muted">System environment variables, time calculation base, and license tokens.</small>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label f-w-600 f-13">System Timezone</label>
                        <select name="timezone" class="form-select select2">
                            <option value="{{ $settings->timezone }}">{{ $settings->timezone }} (Current)</option>
                            @foreach ($timezones as $list)
                                <option value="{{ $list }}">{{ $list }}</option>
                            @endforeach
                        </select>
                        <small class="text-muted f-11">Controls trade ROI calculation clocks and transaction timestamps.</small>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label f-w-600 f-13">Installation Architecture</label>
                        <select name="install_type" class="form-select">
                            <option value="Main-Domain" {{ $settings->install_type == 'Main-Domain' ? 'selected' : '' }}>Main-Domain (e.g. domain.com)</option>
                            <option value="Sub-Domain" {{ $settings->install_type == 'Sub-Domain' ? 'selected' : '' }}>Sub-Domain (e.g. app.domain.com)</option>
                            <option value="Sub-Folder" {{ $settings->install_type == 'Sub-Folder' ? 'selected' : '' }}>Sub-Folder (e.g. domain.com/app)</option>
                        </select>
                        <small class="text-muted f-11">Routing mode configuration for assets and links.</small>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label f-w-600 f-13">Purchase / License Code</label>
                        <input name="purchase_code" class="form-control font-monospace" type="text" value="{{ $moresettings->purchase_code }}" placeholder="Enter codecanyon/license key">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label f-w-600 f-13">Personal Access Token / Merchant Key</label>
                        <input name="merchant_key" class="form-control font-monospace" type="text" value="{{ $settings->merchant_key }}" placeholder="Personal merchant key">
                    </div>
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="col-12 text-end pt-2">
            <button type="submit" class="btn btn-primary rounded-pill px-5 py-2 f-w-600 shadow-sm" id="webInfoSubmitBtn">
                <i class="fa fa-save me-2"></i> Update Website Information
            </button>
        </div>
    </div>
</form>
