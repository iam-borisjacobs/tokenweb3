@extends('layouts.app')

@section('styles')
    @parent
    <style>
        /* App Settings Specific Polished UI */
        /* Left-Rail Categorized Navigation for Desktop */
        .settings-nav-card {
            background: #ffffff;
            border: 1px solid #e8ecf2;
            border-radius: 14px;
            padding: 16px;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.03);
            position: sticky;
            top: 86px;
            max-height: calc(100vh - 100px);
            overflow-y: auto;
        }
        body.dark-only .settings-nav-card {
            background: #19202f !important;
            border-color: #273142 !important;
            box-shadow: none !important;
        }
        .settings-nav-card::-webkit-scrollbar {
            width: 4px;
        }
        .settings-nav-card::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }
        body.dark-only .settings-nav-card::-webkit-scrollbar-thumb {
            background: #374151;
        }

        .settings-category-header {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            color: #94a3b8;
            padding: 12px 10px 6px 10px;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        body.dark-only .settings-category-header {
            color: #64748b;
        }

        .settings-rail-btn {
            display: flex;
            align-items: center;
            width: 100%;
            padding: 10px 12px;
            border-radius: 10px;
            border: 1px solid transparent;
            background: transparent;
            color: #475569;
            text-align: left;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            gap: 12px;
            margin-bottom: 3px;
            cursor: pointer;
            text-decoration: none;
        }
        body.dark-only .settings-rail-btn {
            color: #cbd5e1;
        }
        .settings-rail-btn:hover {
            background: #f1f5f9;
            color: #0f172a;
        }
        body.dark-only .settings-rail-btn:hover {
            background: rgba(255, 255, 255, 0.05);
            color: #ffffff;
        }
        .settings-rail-btn.active {
            background: rgba(99, 98, 231, 0.08) !important;
            border-color: rgba(99, 98, 231, 0.25) !important;
            color: var(--theme-default, #6362e7) !important;
            font-weight: 700;
        }
        body.dark-only .settings-rail-btn.active {
            background: rgba(99, 98, 231, 0.18) !important;
            border-color: rgba(99, 98, 231, 0.4) !important;
            color: #a5b4fc !important;
        }

        .settings-rail-icon {
            width: 34px;
            height: 34px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
            flex-shrink: 0;
            background: #f1f5f9;
            color: #64748b;
            transition: all 0.2s ease;
        }
        body.dark-only .settings-rail-icon {
            background: #111827;
            color: #94a3b8;
        }
        .settings-rail-btn.active .settings-rail-icon {
            background: var(--theme-default, #6362e7) !important;
            color: #ffffff !important;
            box-shadow: 0 4px 10px rgba(99, 98, 231, 0.35);
        }
        .settings-rail-title {
            font-size: 13.5px;
            line-height: 1.25;
            display: block;
        }
        .settings-rail-desc {
            font-size: 11px;
            color: #94a3b8;
            display: block;
            margin-top: 2px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        body.dark-only .settings-rail-desc {
            color: #64748b;
        }

        /* Mobile Settings Navigation Hub (< 992px) */
        .mobile-settings-hub {
            background: #ffffff;
            border: 1px solid #e8ecf2;
            border-radius: 14px;
            padding: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            margin-bottom: 20px;
        }
        body.dark-only .mobile-settings-hub {
            background: #19202f !important;
            border-color: #273142 !important;
            box-shadow: none !important;
        }

        /* Mobile Swipe Carousel */
        .mobile-settings-carousel {
            display: flex;
            overflow-x: auto;
            flex-wrap: nowrap;
            gap: 8px;
            padding-bottom: 4px;
            margin-top: 10px;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none;
        }
        .mobile-settings-carousel::-webkit-scrollbar {
            display: none;
        }
        .mobile-settings-carousel .nav-link {
            flex: 0 0 auto;
            white-space: nowrap;
            padding: 8px 14px;
            font-size: 12.5px;
            font-weight: 600;
            border-radius: 50rem;
            background: #f1f5f9;
            color: #64748b;
            border: 1px solid #e2e8f0;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.2s ease;
        }
        body.dark-only .mobile-settings-carousel .nav-link {
            background: #111827;
            border-color: #273142;
            color: #94a3b8;
        }
        .mobile-settings-carousel .nav-link.active {
            background: var(--theme-default, #6362e7) !important;
            color: #ffffff !important;
            border-color: var(--theme-default, #6362e7) !important;
            box-shadow: 0 3px 8px rgba(99, 98, 231, 0.35);
        }

        /* Mobile Dropdown Trigger */
        .mobile-active-trigger {
            width: 100%;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 10px 14px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            color: #0f172a;
            font-weight: 600;
            font-size: 13.5px;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        body.dark-only .mobile-active-trigger {
            background: #111827;
            border-color: #273142;
            color: #f1f5f9;
        }
        .mobile-active-trigger:focus,
        .mobile-active-trigger:active {
            border-color: var(--theme-default, #6362e7);
        }

        /* Mobile Dropdown Menu */
        .mobile-settings-dropdown-menu {
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.12);
            border: 1px solid #e2e8f0;
            padding: 8px;
            max-height: 380px;
            overflow-y: auto;
        }
        body.dark-only .mobile-settings-dropdown-menu {
            background: #19202f !important;
            border-color: #273142 !important;
            box-shadow: 0 10px 30px rgba(0,0,0,0.4) !important;
        }
        .mobile-settings-dropdown-menu .dropdown-header {
            font-size: 10.5px;
            font-weight: 700;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            color: #94a3b8;
            padding: 8px 10px 4px 10px;
        }
        body.dark-only .mobile-settings-dropdown-menu .dropdown-header {
            color: #64748b;
        }
        .mobile-settings-dropdown-menu .dropdown-item {
            border-radius: 8px;
            padding: 8px 12px;
            font-size: 13px;
            font-weight: 600;
            color: #334155;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        body.dark-only .mobile-settings-dropdown-menu .dropdown-item {
            color: #cbd5e1;
        }
        .mobile-settings-dropdown-menu .dropdown-item:hover,
        .mobile-settings-dropdown-menu .dropdown-item:focus {
            background: #f1f5f9;
            color: #0f172a;
        }
        body.dark-only .mobile-settings-dropdown-menu .dropdown-item:hover,
        body.dark-only .mobile-settings-dropdown-menu .dropdown-item:focus {
            background: rgba(255, 255, 255, 0.05);
            color: #ffffff;
        }
        .mobile-settings-dropdown-menu .dropdown-item.active {
            background: rgba(99, 98, 231, 0.1) !important;
            color: var(--theme-default, #6362e7) !important;
        }
        body.dark-only .mobile-settings-dropdown-menu .dropdown-item.active {
            background: rgba(99, 98, 231, 0.25) !important;
            color: #a5b4fc !important;
        }

        /* Card Panels & Containers */
        .settings-card-section {
            background: #ffffff;
            border: 1px solid #e8ecf2;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.02);
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }
        .settings-card-section:hover {
            border-color: #cbd5e1;
            box-shadow: 0 4px 12px rgba(0,0,0,0.04);
        }
        body.dark-only .settings-card-section {
            background: #19202f !important;
            border-color: #273142 !important;
            box-shadow: none !important;
        }
        body.dark-only .settings-card-section:hover {
            border-color: #3b485d !important;
        }

        /* Sub cards */
        .settings-subcard {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
        }
        body.dark-only .settings-subcard {
            background: #111827 !important;
            border-color: #2b3648 !important;
        }

        /* Inputs in Settings */
        .settings-card-section .form-label {
            font-size: 13px;
            font-weight: 600;
            color: #334155;
            margin-bottom: 6px;
        }
        body.dark-only .settings-card-section .form-label {
            color: #e2e8f0;
        }
        .settings-card-section .form-control,
        .settings-card-section .form-select {
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 13.5px;
            padding: 8px 12px;
            transition: all 0.2s ease;
        }
        .settings-card-section .form-control:focus,
        .settings-card-section .form-select:focus {
            border-color: var(--theme-default, #6362e7);
            box-shadow: 0 0 0 3px rgba(99, 98, 231, 0.15);
        }
        body.dark-only .settings-card-section .form-control,
        body.dark-only .settings-card-section .form-select {
            background-color: #0f172a !important;
            border-color: #334155 !important;
            color: #f1f5f9 !important;
        }

        /* Selectgroup pill radio toggles */
        .selectgroup {
            display: inline-flex;
            background: #f1f5f9;
            border-radius: 50rem;
            padding: 3px;
            gap: 2px;
            border: 1px solid #e2e8f0;
        }
        body.dark-only .selectgroup {
            background: #0f172a;
            border-color: #334155;
        }
        .selectgroup-item {
            position: relative;
            margin: 0;
            cursor: pointer;
        }
        .selectgroup-input {
            position: absolute;
            opacity: 0;
            z-index: -1;
        }
        .selectgroup-button {
            display: block;
            padding: 4px 14px;
            font-size: 12px;
            font-weight: 600;
            color: #64748b;
            border-radius: 50rem;
            transition: all 0.2s ease;
            user-select: none;
        }
        .selectgroup-input:checked + .selectgroup-button {
            background: var(--theme-default, #6362e7);
            color: #ffffff;
            box-shadow: 0 2px 6px rgba(99, 98, 231, 0.35);
        }
        body.dark-only .selectgroup-button {
            color: #94a3b8;
        }
        body.dark-only .selectgroup-input:checked + .selectgroup-button {
            color: #ffffff;
        }

        /* Slide Config Cards & Dark Mode Adjustments */
        .slide-config-card {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            transition: all 0.2s ease;
        }
        body.dark-only .slide-config-card {
            background-color: #141b2b !important;
            border-color: #273142 !important;
        }
        body.dark-only .slide-config-card .form-control,
        body.dark-only .slide-config-card .form-select {
            background-color: #0c121e !important;
            border-color: #273142 !important;
            color: #f8fafc !important;
        }
        body.dark-only .slide-config-card .form-control:focus,
        body.dark-only .slide-config-card .form-select:focus {
            border-color: #6366f1 !important;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2) !important;
        }
        body.dark-only .slide-config-card .form-label {
            color: #cbd5e1 !important;
        }
        body.dark-only .slide-config-card .text-muted {
            color: #94a3b8 !important;
        }
        body.dark-only .slide-preview-box {
            background-color: #0c121e !important;
            border-color: #273142 !important;
        }
        body.dark-only .alert-light {
            background-color: #141b2b !important;
            border-color: #273142 !important;
            color: #cbd5e1 !important;
        }
        body.dark-only .alert-light .text-muted {
            color: #94a3b8 !important;
        }
    </style>
@endsection

@section('content')
<div class="container-fluid">
    <x-danger-alert />
    <x-success-alert />

    @if (!empty($errors) && $errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)
                    <li><i class="fa fa-warning me-1"></i> {{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-12 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <div>
                <h3 class="f-w-700 mb-1">App Settings</h3>
                <p class="text-muted mb-0 f-14">Configure platform modules, website information, trading preferences, email servers, and theme displays.</p>
            </div>
            <div class="d-flex align-items-center gap-2">
                <span class="badge bg-light-primary text-primary px-3 py-2 rounded-pill f-12">
                    <i class="fa fa-cogs me-1"></i> System Configuration
                </span>
            </div>
        </div>
    </div>

    <!-- Mobile Settings Navigation Hub (< 992px) -->
    <div class="row mb-3 d-lg-none">
        <div class="col-12">
            <div class="mobile-settings-hub">
                <!-- Dropdown Section Picker -->
                <div class="dropdown">
                    <button class="mobile-active-trigger" type="button" id="mobileSettingsDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="d-flex align-items-center gap-2">
                            <i class="fa fa-cubes text-primary" id="mobileActiveIcon"></i>
                            <span id="mobileActiveLabel">Feature Modules</span>
                        </div>
                        <span class="badge bg-primary bg-opacity-10 text-primary f-11 rounded-pill px-3 py-1">
                            Switch Section <i class="fa fa-chevron-down ms-1 f-9"></i>
                        </span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end w-100 mobile-settings-dropdown-menu shadow-lg" aria-labelledby="mobileSettingsDropdown">
                        <li class="dropdown-header">Platform & System</li>
                        <li><button type="button" class="dropdown-item active" data-target-tab="#module"><i class="fa fa-cubes text-primary"></i> Feature Modules</button></li>
                        <li><button type="button" class="dropdown-item" data-target-tab="#maintenance"><i class="fa fa-wrench text-warning"></i> Maintenance Mode</button></li>
                        
                        <li><hr class="dropdown-divider my-1"></li>
                        <li class="dropdown-header">Branding & Design</li>
                        <li><button type="button" class="dropdown-item" data-target-tab="#info"><i class="fa fa-globe text-info"></i> Website Information</button></li>
                        <li><button type="button" class="dropdown-item" data-target-tab="#display"><i class="fa fa-paint-brush text-primary"></i> Theme & Display</button></li>
                        <li><button type="button" class="dropdown-item" data-target-tab="#pref"><i class="fa fa-sliders text-secondary"></i> Preferences</button></li>
                        
                        <li><hr class="dropdown-divider my-1"></li>
                        <li class="dropdown-header">Payments & Wallets</li>
                        <li><button type="button" class="dropdown-item" data-target-tab="#wallets"><i class="fa fa-wallet text-success"></i> Crypto Deposit Wallets</button></li>
                        <li><button type="button" class="dropdown-item" data-target-tab="#wallet-types"><i class="fa fa-plug text-info"></i> Connect Wallet Icons</button></li>
                        
                        <li><hr class="dropdown-divider my-1"></li>
                        <li class="dropdown-header">Comms & Auth</li>
                        <li><button type="button" class="dropdown-item" data-target-tab="#email"><i class="fa fa-envelope text-warning"></i> Email & Google Captcha</button></li>
                        <li><button type="button" class="dropdown-item" data-target-tab="#whatsapp"><i class="fa fa-whatsapp text-success"></i> WhatsApp Alerts</button></li>
                    </ul>
                </div>

                <!-- Touch Swipe Pill Carousel -->
                <ul class="nav mobile-settings-carousel" id="mobileCarouselTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" data-bs-toggle="pill" data-bs-target="#module" type="button" role="tab">
                            <i class="fa fa-cubes"></i> Modules
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" data-bs-toggle="pill" data-bs-target="#maintenance" type="button" role="tab">
                            <i class="fa fa-wrench"></i> Maintenance
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" data-bs-toggle="pill" data-bs-target="#info" type="button" role="tab">
                            <i class="fa fa-globe"></i> Web Info
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" data-bs-toggle="pill" data-bs-target="#display" type="button" role="tab">
                            <i class="fa fa-paint-brush"></i> Theme
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" data-bs-toggle="pill" data-bs-target="#pref" type="button" role="tab">
                            <i class="fa fa-sliders"></i> Preferences
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" data-bs-toggle="pill" data-bs-target="#wallets" type="button" role="tab">
                            <i class="fa fa-wallet"></i> Wallets
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" data-bs-toggle="pill" data-bs-target="#wallet-types" type="button" role="tab">
                            <i class="fa fa-plug"></i> Web3 Icons
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" data-bs-toggle="pill" data-bs-target="#email" type="button" role="tab">
                            <i class="fa fa-envelope"></i> Email/Auth
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" data-bs-toggle="pill" data-bs-target="#whatsapp" type="button" role="tab">
                            <i class="fa fa-whatsapp"></i> WhatsApp
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Main Settings Layout: Left-Rail Sidebar on Desktop + Workspace -->
    <div class="row g-4 mb-5">
        <!-- Left-Rail Categorized Sidebar (Desktop >= 992px) -->
        <div class="col-lg-4 col-xl-3 d-none d-lg-block">
            <div class="settings-nav-card">
                <div class="d-flex align-items-center justify-content-between pb-3 mb-2 border-bottom">
                    <div>
                        <h6 class="f-w-700 mb-0">Configuration Hub</h6>
                        <small class="text-muted f-11">Manage platform settings</small>
                    </div>
                    <span class="badge bg-light-primary text-primary rounded-pill f-10">9 Sections</span>
                </div>

                <div class="nav flex-column" id="desktopSettingsTabs" role="tablist">
                    <!-- Section Group 1 -->
                    <div class="settings-category-header">
                        <i class="fa fa-server f-10"></i> Platform & System
                    </div>
                    <button class="settings-rail-btn active" data-bs-toggle="pill" data-bs-target="#module" type="button" role="tab" id="rail-module-tab">
                        <div class="settings-rail-icon"><i class="fa fa-cubes"></i></div>
                        <div class="flex-grow-1">
                            <span class="settings-rail-title">Feature Modules</span>
                            <span class="settings-rail-desc">Trading, trucks & swap toggles</span>
                        </div>
                    </button>
                    <button class="settings-rail-btn" data-bs-toggle="pill" data-bs-target="#maintenance" type="button" role="tab" id="rail-maintenance-tab">
                        <div class="settings-rail-icon"><i class="fa fa-wrench"></i></div>
                        <div class="flex-grow-1">
                            <div class="d-flex align-items-center justify-content-between">
                                <span class="settings-rail-title">Maintenance Mode</span>
                                @if(!empty($settings->maintenance_mode))
                                    <span class="badge bg-danger rounded-pill f-9 px-2">ACTIVE</span>
                                @endif
                            </div>
                            <span class="settings-rail-desc">Live site emergency lockdown</span>
                        </div>
                    </button>

                    <!-- Section Group 2 -->
                    <div class="settings-category-header mt-2">
                        <i class="fa fa-paint-brush f-10"></i> Branding & Design
                    </div>
                    <button class="settings-rail-btn" data-bs-toggle="pill" data-bs-target="#info" type="button" role="tab" id="rail-info-tab">
                        <div class="settings-rail-icon"><i class="fa fa-globe"></i></div>
                        <div class="flex-grow-1">
                            <span class="settings-rail-title">Website Information</span>
                            <span class="settings-rail-desc">Brand name, logos & SEO tags</span>
                        </div>
                    </button>
                    <button class="settings-rail-btn" data-bs-toggle="pill" data-bs-target="#display" type="button" role="tab" id="rail-display-tab">
                        <div class="settings-rail-icon"><i class="fa fa-paint-brush"></i></div>
                        <div class="flex-grow-1">
                            <span class="settings-rail-title">Theme & Display</span>
                            <span class="settings-rail-desc">Colors, dark mode & layout</span>
                        </div>
                    </button>
                    <button class="settings-rail-btn" data-bs-toggle="pill" data-bs-target="#pref" type="button" role="tab" id="rail-pref-tab">
                        <div class="settings-rail-icon"><i class="fa fa-sliders"></i></div>
                        <div class="flex-grow-1">
                            <span class="settings-rail-title">Preferences</span>
                            <span class="settings-rail-desc">Currencies, fees & defaults</span>
                        </div>
                    </button>

                    <!-- Section Group 3 -->
                    <div class="settings-category-header mt-2">
                        <i class="fa fa-wallet f-10"></i> Payments & Wallets
                    </div>
                    <button class="settings-rail-btn" data-bs-toggle="pill" data-bs-target="#wallets" type="button" role="tab" id="rail-wallets-tab">
                        <div class="settings-rail-icon"><i class="fa fa-wallet"></i></div>
                        <div class="flex-grow-1">
                            <span class="settings-rail-title">Deposit Wallets</span>
                            <span class="settings-rail-desc">USDT, BTC & ETH addresses</span>
                        </div>
                    </button>
                    <button class="settings-rail-btn" data-bs-toggle="pill" data-bs-target="#wallet-types" type="button" role="tab" id="rail-wallet-types-tab">
                        <div class="settings-rail-icon"><i class="fa fa-plug"></i></div>
                        <div class="flex-grow-1">
                            <span class="settings-rail-title">Supported Wallets</span>
                            <span class="settings-rail-desc">Web3 connection providers</span>
                        </div>
                    </button>

                    <!-- Section Group 4 -->
                    <div class="settings-category-header mt-2">
                        <i class="fa fa-shield f-10"></i> Comms & Auth
                    </div>
                    <button class="settings-rail-btn" data-bs-toggle="pill" data-bs-target="#email" type="button" role="tab" id="rail-email-tab">
                        <div class="settings-rail-icon"><i class="fa fa-envelope"></i></div>
                        <div class="flex-grow-1">
                            <span class="settings-rail-title">Email & Auth</span>
                            <span class="settings-rail-desc">SMTP, OAuth & reCAPTCHA</span>
                        </div>
                    </button>
                    <button class="settings-rail-btn" data-bs-toggle="pill" data-bs-target="#whatsapp" type="button" role="tab" id="rail-whatsapp-tab">
                        <div class="settings-rail-icon"><i class="fa fa-whatsapp text-success"></i></div>
                        <div class="flex-grow-1">
                            <span class="settings-rail-title">WhatsApp Alerts</span>
                            <span class="settings-rail-desc">Automated message alerts</span>
                        </div>
                    </button>
                </div>
            </div>
        </div>

        <!-- Right Workspace: Main Settings Panels -->
        <div class="col-lg-8 col-xl-9 col-12">
            <div class="card p-3 p-md-4 shadow-sm border" style="border-radius: 14px;">
                <!-- Tab Panes -->
                <div class="tab-content" id="appSettingsTabContent">
                    <div class="tab-pane fade show active" id="module" role="tabpanel" aria-labelledby="module-tab">
                        <livewire:admin.software-module />
                    </div>
                    <div class="tab-pane fade" id="info" role="tabpanel" aria-labelledby="info-tab">
                        @include('admin.Settings.AppSettings.webinfo')
                    </div>
                    <div class="tab-pane fade" id="pref" role="tabpanel" aria-labelledby="pref-tab">
                        @include('admin.Settings.AppSettings.webpreference')
                    </div>
                    <div class="tab-pane fade" id="email" role="tabpanel" aria-labelledby="email-tab">
                        @include('admin.Settings.AppSettings.email')
                    </div>
                    <div class="tab-pane fade" id="display" role="tabpanel" aria-labelledby="display-tab">
                        <livewire:admin.theme-display />
                    </div>
                    <div class="tab-pane fade" id="wallets" role="tabpanel" aria-labelledby="wallets-tab">
                        @include('admin.Settings.AppSettings.wallet_addresses')
                    </div>
                    <div class="tab-pane fade" id="wallet-types" role="tabpanel" aria-labelledby="wallet-types-tab">
                        @include('admin.Settings.AppSettings.wallet_types')
                    </div>
                    <div class="tab-pane fade" id="whatsapp" role="tabpanel" aria-labelledby="whatsapp-tab">
                        @include('admin.Settings.AppSettings.whatsapp')
                    </div>
                    <div class="tab-pane fade" id="maintenance" role="tabpanel" aria-labelledby="maintenance-tab">
                        @include('admin.Settings.AppSettings.maintenance')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    @parent
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Select2 if present
            if (window.$ && $.fn.select2) {
                $('.select2').select2({ width: '100%' });
            }

            // Tab Metadata Dictionary for Mobile Hub & Status
            var tabMeta = {
                '#module': { label: 'Feature Modules', icon: 'fa-cubes', color: 'text-primary' },
                '#maintenance': { label: 'Maintenance Mode', icon: 'fa-wrench', color: 'text-warning' },
                '#info': { label: 'Website Information', icon: 'fa-globe', color: 'text-info' },
                '#display': { label: 'Theme & Display', icon: 'fa-paint-brush', color: 'text-primary' },
                '#pref': { label: 'Preferences', icon: 'fa-sliders', color: 'text-secondary' },
                '#wallets': { label: 'Crypto Deposit Wallets', icon: 'fa-wallet', color: 'text-success' },
                '#wallet-types': { label: 'Supported Wallets', icon: 'fa-plug', color: 'text-info' },
                '#email': { label: 'Email & Authentication', icon: 'fa-envelope', color: 'text-warning' },
                '#whatsapp': { label: 'WhatsApp Alerts', icon: 'fa-whatsapp', color: 'text-success' }
            };

            // Unified Tab Activation Controller
            window.activateAppSettingsTab = function(target) {
                if (!target || !tabMeta[target]) return;

                // 1. Show Bootstrap Tab Pane
                var targetTrigger = document.querySelector('button[data-bs-target="' + target + '"]');
                if (targetTrigger && window.bootstrap && window.bootstrap.Tab) {
                    var tabInstance = bootstrap.Tab.getOrCreateInstance(targetTrigger);
                    tabInstance.show();
                }

                // 2. Synchronize all buttons targeting this tab (Desktop Left-Rail + Mobile Carousel)
                document.querySelectorAll('[data-bs-target]').forEach(function(btn) {
                    if (btn.getAttribute('data-bs-target') === target) {
                        btn.classList.add('active');
                    } else if (btn.getAttribute('data-bs-target') && btn.getAttribute('data-bs-target').startsWith('#')) {
                        btn.classList.remove('active');
                    }
                });

                // 3. Update Mobile Dropdown Header & Active item
                var meta = tabMeta[target];
                var iconEl = document.getElementById('mobileActiveIcon');
                var labelEl = document.getElementById('mobileActiveLabel');
                if (iconEl) iconEl.className = 'fa ' + meta.icon + ' ' + meta.color;
                if (labelEl) labelEl.textContent = meta.label;

                // 4. Update dropdown menu items active state
                document.querySelectorAll('.mobile-settings-dropdown-menu .dropdown-item').forEach(function(item) {
                    if (item.getAttribute('data-target-tab') === target) {
                        item.classList.add('active');
                    } else {
                        item.classList.remove('active');
                    }
                });

                // 5. Scroll active carousel chip into center view smoothly on mobile
                var activeCarouselBtn = document.querySelector('#mobileCarouselTabs [data-bs-target="' + target + '"]');
                if (activeCarouselBtn) {
                    activeCarouselBtn.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
                }

                // 6. Update URL hash cleanly
                history.replaceState(null, null, target);
            };

            // Handle Mobile Dropdown Clicks
            document.querySelectorAll('.mobile-settings-dropdown-menu .dropdown-item').forEach(function(item) {
                item.addEventListener('click', function(e) {
                    e.preventDefault();
                    var target = this.getAttribute('data-target-tab');
                    if (target) {
                        activateAppSettingsTab(target);
                    }
                });
            });

            // Handle Pill button clicks (Desktop and Mobile)
            document.querySelectorAll('[data-bs-toggle="pill"]').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    var target = this.getAttribute('data-bs-target');
                    if (target) {
                        activateAppSettingsTab(target);
                    }
                });
            });

            // URL Hash Support for direct tab linking (e.g. #info, #wallets, #pref)
            var hash = window.location.hash;
            if (hash && tabMeta[hash]) {
                activateAppSettingsTab(hash);
            }

            // Notification Helper using SweetAlert2
            function notifyUser(type, title, message) {
                if (window.Swal) {
                    Swal.fire({
                        icon: type,
                        title: title,
                        text: message,
                        timer: 2500,
                        showConfirmButton: false
                    });
                } else {
                    alert(message);
                }
            }

            // Currency Change handler
            window.changecurr = function() {
                var e = document.getElementById("select_c");
                if (e) {
                    var selected = e.options[e.selectedIndex].id;
                    var s_c = document.getElementById("s_c");
                    if (s_c) s_c.value = selected;
                }
            };

            // Submit Preference Form via AJAX
            $('#updatepreference').on('submit', function(e) {
                e.preventDefault();
                var form = $(this);
                var submitBtn = form.find('input[type="submit"], button[type="submit"]');
                submitBtn.prop('disabled', true);

                $.ajax({
                    url: "{{ route('updatepreference') }}",
                    type: 'POST',
                    data: form.serialize(),
                    success: function(response) {
                        submitBtn.prop('disabled', false);
                        notifyUser('success', 'Preferences Updated', response.success || 'Platform preferences have been saved.');
                    },
                    error: function(err) {
                        submitBtn.prop('disabled', false);
                        var errMsg = (err.responseJSON && err.responseJSON.message) ? err.responseJSON.message : 'Could not update preferences.';
                        notifyUser('error', 'Update Failed', errMsg);
                    }
                });
            });

            // Mail Server Switcher Logic
            var sendmailRadio = document.querySelector('#sendmailserver');
            var smtpRadio = document.querySelector('#smtpserver');
            var smtpFields = document.querySelectorAll('.smtp');

            function syncMailServerUI() {
                if (smtpRadio && smtpRadio.checked) {
                    smtpFields.forEach(function(el) {
                        el.classList.remove('d-none');
                    });
                } else {
                    smtpFields.forEach(function(el) {
                        el.classList.add('d-none');
                    });
                }
            }

            if (sendmailRadio) sendmailRadio.addEventListener('change', syncMailServerUI);
            if (smtpRadio) smtpRadio.addEventListener('change', syncMailServerUI);
            syncMailServerUI();

            // Submit Email Configuration Form via AJAX
            $('#emailform').on('submit', function(e) {
                e.preventDefault();
                var form = $(this);
                var submitBtn = form.find('input[type="submit"], button[type="submit"]');
                submitBtn.prop('disabled', true);

                $.ajax({
                    url: "{{ route('updateemailpreference') }}",
                    type: 'POST',
                    data: form.serialize(),
                    success: function(response) {
                        submitBtn.prop('disabled', false);
                        notifyUser('success', 'Email Settings Saved', response.success || 'Email and authentication settings have been updated.');
                    },
                    error: function(err) {
                        submitBtn.prop('disabled', false);
                        var errMsg = (err.responseJSON && err.responseJSON.message) ? err.responseJSON.message : 'Could not update email settings.';
                        notifyUser('error', 'Update Failed', errMsg);
                    }
                });
            });

            // Submit WhatsApp Configuration Form via AJAX
            $('#whatsappform').on('submit', function(e) {
                e.preventDefault();
                var form = $(this);
                var submitBtn = $('#saveWhatsAppBtn');
                var origText = submitBtn.html();
                submitBtn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin me-1"></i> Saving...');

                $.ajax({
                    url: "{{ route('updatewhatsapp') }}",
                    type: 'POST',
                    data: form.serialize(),
                    success: function(response) {
                        submitBtn.prop('disabled', false).html(origText);
                        notifyUser('success', 'WhatsApp Settings Saved', response.success || 'Your WhatsApp alert configuration has been updated.');
                    },
                    error: function(err) {
                        submitBtn.prop('disabled', false).html(origText);
                        var errMsg = (err.responseJSON && err.responseJSON.message) ? err.responseJSON.message : 'Could not update WhatsApp settings.';
                        notifyUser('error', 'Update Failed', errMsg);
                    }
                });
            });
        });
    </script>
@endsection
