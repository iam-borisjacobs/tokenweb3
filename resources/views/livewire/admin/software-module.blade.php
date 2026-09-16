<div>
    <style>
        /* Scoped High-Contrast Styling for Software Modules */
        .module-banner-header {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 18px 22px;
            margin-bottom: 24px;
        }
        .module-banner-header .module-main-title {
            color: #0f172a !important;
            font-weight: 700 !important;
            font-size: 16px;
            margin-bottom: 4px;
        }
        .module-banner-header .module-subtitle {
            color: #475569 !important;
            font-size: 13.5px;
            line-height: 1.5;
            margin-bottom: 0;
        }

        .module-feature-card {
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 24px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.03);
            transition: all 0.25s ease;
            position: relative;
            display: flex;
            flex-direction: column;
            height: 100%;
        }
        .module-feature-card:hover {
            border-color: #cbd5e1;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.06);
            transform: translateY(-2px);
        }

        .module-feature-card .module-card-title {
            color: #0f172a !important;
            font-weight: 700 !important;
            font-size: 16px !important;
            margin-top: 10px;
            margin-bottom: 6px;
            letter-spacing: -0.2px;
        }
        .module-feature-card .module-card-desc {
            color: #475569 !important;
            font-size: 13.5px !important;
            line-height: 1.55;
            flex-grow: 1;
            margin-bottom: 18px;
        }

        /* Module Status Badges */
        .module-badge-active {
            background-color: rgba(16, 185, 129, 0.12) !important;
            color: #047857 !important;
            border: 1px solid rgba(16, 185, 129, 0.3) !important;
            font-weight: 700 !important;
            font-size: 12px !important;
            padding: 4px 12px !important;
            border-radius: 50rem !important;
        }
        .module-badge-disabled {
            background-color: rgba(100, 116, 139, 0.12) !important;
            color: #475569 !important;
            border: 1px solid rgba(100, 116, 139, 0.25) !important;
            font-weight: 600 !important;
            font-size: 12px !important;
            padding: 4px 12px !important;
            border-radius: 50rem !important;
        }
        .module-badge-pro {
            background-color: rgba(99, 102, 241, 0.12) !important;
            color: #4f46e5 !important;
            border: 1px solid rgba(99, 102, 241, 0.3) !important;
            font-weight: 700 !important;
            font-size: 11px !important;
            padding: 3px 10px !important;
            border-radius: 50rem !important;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Toggle Switches */
        .module-selectgroup {
            display: flex;
            width: 100%;
            background-color: #f1f5f9;
            border-radius: 50rem;
            padding: 4px;
            gap: 3px;
            border: 1px solid #e2e8f0;
        }
        .module-selectgroup-item {
            flex: 1 1 0%;
            margin: 0;
            position: relative;
            cursor: pointer;
            text-align: center;
        }
        .module-selectgroup-input {
            position: absolute;
            opacity: 0;
            z-index: -1;
            pointer-events: none;
        }
        .module-selectgroup-btn {
            display: block;
            width: 100%;
            padding: 6px 12px;
            font-size: 12.5px;
            font-weight: 600;
            color: #64748b;
            border-radius: 50rem;
            transition: all 0.2s ease;
            user-select: none;
            cursor: pointer;
        }
        .module-selectgroup-input:checked + .module-selectgroup-btn {
            background-color: var(--theme-default, #6362e7) !important;
            color: #ffffff !important;
            box-shadow: 0 2px 8px rgba(99, 98, 231, 0.35);
        }

        /* Dark Mode Theme Support */
        body.dark-only .module-banner-header {
            background-color: #111827 !important;
            border-color: #2b3648 !important;
        }
        body.dark-only .module-banner-header .module-main-title {
            color: #f8fafc !important;
        }
        body.dark-only .module-banner-header .module-subtitle {
            color: #94a3b8 !important;
        }

        body.dark-only .module-feature-card {
            background-color: #19202f !important;
            border-color: #273142 !important;
            box-shadow: none !important;
        }
        body.dark-only .module-feature-card:hover {
            border-color: #3b485d !important;
        }
        body.dark-only .module-feature-card .module-card-title {
            color: #f8fafc !important;
        }
        body.dark-only .module-feature-card .module-card-desc {
            color: #94a3b8 !important;
        }

        body.dark-only .module-badge-disabled {
            background-color: rgba(148, 163, 184, 0.15) !important;
            color: #94a3b8 !important;
            border-color: rgba(148, 163, 184, 0.2) !important;
        }

        body.dark-only .module-selectgroup {
            background-color: #0f172a !important;
            border-color: #334155 !important;
        }
        body.dark-only .module-selectgroup-btn {
            color: #94a3b8;
        }
    </style>

    @php
        $isInvestmentActive   = !empty($mod['investment']);
        $isCryptoInvestActive = isset($mod['investment_crypto']) ? !empty($mod['investment_crypto']) : $isInvestmentActive;
        $isTruckInvestActive  = isset($mod['investment_truck']) ? !empty($mod['investment_truck']) : true;
        $isCryptoSwapActive   = !empty($mod['cryptoswap']);
        $isSubscriptionActive = !empty($mod['subscription']);
        $isMembershipActive   = !empty($mod['membership']);
        $isSignalActive       = !empty($mod['signal']);
        $isTradingSectionActive = !empty($mod['trading_section']);
    @endphp

    <!-- Top Banner Header -->
    <div class="module-banner-header">
        <div class="d-flex align-items-center gap-2 mb-1">
            <i class="fa fa-cubes text-primary f-20"></i>
            <h5 class="module-main-title">Platform Feature Modules</h5>
        </div>
        <p class="module-subtitle">Toggle which primary product verticals and services are exposed on your client portal. Disabling a module cleanly hides its corresponding navigation menus and functionality.</p>
    </div>

    <div class="row g-4">
        <!-- Module 1: Crypto Investment Packages -->
        <div class="col-md-6 col-xl-4">
            <div class="module-feature-card">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                        <i class="fa fa-coins f-18"></i>
                    </div>
                    <span class="{{ $isCryptoInvestActive ? 'module-badge-active' : 'module-badge-disabled' }}">
                        {{ $isCryptoInvestActive ? 'Active' : 'Disabled' }}
                    </span>
                </div>

                <h6 class="module-card-title">Crypto Investment Plans</h6>
                <p class="module-card-desc">Allows clients to enroll in digital asset trading packages, fixed-term crypto yield pools, and automated portfolio compounding.</p>

                <div class="pt-3 border-top mt-auto">
                    <div class="module-selectgroup">
                        <label class="module-selectgroup-item">
                            <input type="radio" class="module-selectgroup-input" name="investment_crypto" wire:click="updateModule('investment_crypto','true')" {{ $isCryptoInvestActive ? 'checked' : '' }}>
                            <span class="module-selectgroup-btn">Enabled</span>
                        </label>
                        <label class="module-selectgroup-item">
                            <input type="radio" class="module-selectgroup-input" name="investment_crypto" wire:click="updateModule('investment_crypto','false')" {{ !$isCryptoInvestActive ? 'checked' : '' }}>
                            <span class="module-selectgroup-btn">Disabled</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Module 2: Truck & Asset Investment Packages -->
        <div class="col-md-6 col-xl-4">
            <div class="module-feature-card" style="border-top: 3px solid #f59e0b !important;">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <div class="rounded-circle bg-warning bg-opacity-10 text-warning d-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                        <i class="fa fa-truck f-18"></i>
                    </div>
                    <span class="{{ $isTruckInvestActive ? 'module-badge-active' : 'module-badge-disabled' }}">
                        {{ $isTruckInvestActive ? 'Active' : 'Disabled' }}
                    </span>
                </div>

                <h6 class="module-card-title">Truck & Asset Investments</h6>
                <p class="module-card-desc">Exposes asset-backed investments (commercial trucking fleets, freight haulage, vehicles, and equipment) with custom picture attachments.</p>

                <div class="pt-3 border-top mt-auto">
                    <div class="module-selectgroup">
                        <label class="module-selectgroup-item">
                            <input type="radio" class="module-selectgroup-input" name="investment_truck" wire:click="updateModule('investment_truck','true')" {{ $isTruckInvestActive ? 'checked' : '' }}>
                            <span class="module-selectgroup-btn">Enabled</span>
                        </label>
                        <label class="module-selectgroup-item">
                            <input type="radio" class="module-selectgroup-input" name="investment_truck" wire:click="updateModule('investment_truck','false')" {{ !$isTruckInvestActive ? 'checked' : '' }}>
                            <span class="module-selectgroup-btn">Disabled</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Module 2: Crypto Swap -->
        <div class="col-md-6 col-xl-4">
            <div class="module-feature-card">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <div class="rounded-circle bg-warning bg-opacity-10 text-warning d-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                        <i class="fa fa-sync-alt f-18"></i>
                    </div>
                    <span class="{{ $isCryptoSwapActive ? 'module-badge-active' : 'module-badge-disabled' }}">
                        {{ $isCryptoSwapActive ? 'Active' : 'Disabled' }}
                    </span>
                </div>

                <h6 class="module-card-title">Crypto Swap</h6>
                <p class="module-card-desc">Enables the instant token swap interface for seamless conversions between Bitcoin, Ethereum, USDT, and other supported assets.</p>

                <div class="pt-3 border-top mt-auto">
                    <div class="module-selectgroup">
                        <label class="module-selectgroup-item">
                            <input type="radio" class="module-selectgroup-input" name="cryptoswap" wire:click="updateModule('cryptoswap','true')" {{ $isCryptoSwapActive ? 'checked' : '' }}>
                            <span class="module-selectgroup-btn">Enabled</span>
                        </label>
                        <label class="module-selectgroup-item">
                            <input type="radio" class="module-selectgroup-input" name="cryptoswap" wire:click="updateModule('cryptoswap','false')" {{ !$isCryptoSwapActive ? 'checked' : '' }}>
                            <span class="module-selectgroup-btn">Disabled</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Module 3: CopyTrade / MT4 Subscription -->
        <div class="col-md-6 col-xl-4">
            <div class="module-feature-card">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <div class="rounded-circle bg-info bg-opacity-10 text-info d-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                        <i class="fa fa-robot f-18"></i>
                    </div>
                    <div class="d-flex gap-1 align-items-center">
                        <span class="module-badge-pro">Pro</span>
                        <span class="{{ $isSubscriptionActive ? 'module-badge-active' : 'module-badge-disabled' }}">
                            {{ $isSubscriptionActive ? 'Active' : 'Disabled' }}
                        </span>
                    </div>
                </div>

                <h6 class="module-card-title">CopyTrading & MT4/5</h6>
                <p class="module-card-desc">Provides access to automated MetaTrader account provisioning, master signal subscriptions, and periodic billing.</p>

                <div class="pt-3 border-top mt-auto">
                    <div class="module-selectgroup">
                        <label class="module-selectgroup-item">
                            <input type="radio" class="module-selectgroup-input" name="subscription" wire:click="updateModule('subscription','true')" {{ $isSubscriptionActive ? 'checked' : '' }}>
                            <span class="module-selectgroup-btn">Enabled</span>
                        </label>
                        <label class="module-selectgroup-item">
                            <input type="radio" class="module-selectgroup-input" name="subscription" wire:click="updateModule('subscription','false')" {{ !$isSubscriptionActive ? 'checked' : '' }}>
                            <span class="module-selectgroup-btn">Disabled</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Module 4: Membership Courses -->
        <div class="col-md-6 col-xl-4">
            <div class="module-feature-card">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <div class="rounded-circle bg-purple bg-opacity-10 text-purple d-flex align-items-center justify-content-center" style="width: 44px; height: 44px; background-color: rgba(147, 51, 234, 0.1); color: #9333ea;">
                        <i class="fa fa-graduation-cap f-18"></i>
                    </div>
                    <div class="d-flex gap-1 align-items-center">
                        <span class="module-badge-pro">Pro</span>
                        <span class="{{ $isMembershipActive ? 'module-badge-active' : 'module-badge-disabled' }}">
                            {{ $isMembershipActive ? 'Active' : 'Disabled' }}
                        </span>
                    </div>
                </div>

                <h6 class="module-card-title">Membership & Courses</h6>
                <p class="module-card-desc">Unlocks trading academy video courses, education modules, and premium community tiers for subscribed members.</p>

                <div class="pt-3 border-top mt-auto">
                    <div class="module-selectgroup">
                        <label class="module-selectgroup-item">
                            <input type="radio" class="module-selectgroup-input" name="membership" wire:click="updateModule('membership','true')" {{ $isMembershipActive ? 'checked' : '' }}>
                            <span class="module-selectgroup-btn">Enabled</span>
                        </label>
                        <label class="module-selectgroup-item">
                            <input type="radio" class="module-selectgroup-input" name="membership" wire:click="updateModule('membership','false')" {{ !$isMembershipActive ? 'checked' : '' }}>
                            <span class="module-selectgroup-btn">Disabled</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Module 5: Signal Provider -->
        <div class="col-md-6 col-xl-4">
            <div class="module-feature-card">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <div class="rounded-circle bg-danger bg-opacity-10 text-danger d-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                        <i class="fa fa-broadcast-tower f-18"></i>
                    </div>
                    <div class="d-flex gap-1 align-items-center">
                        <span class="module-badge-pro">Pro</span>
                        <span class="{{ $isSignalActive ? 'module-badge-active' : 'module-badge-disabled' }}">
                            {{ $isSignalActive ? 'Active' : 'Disabled' }}
                        </span>
                    </div>
                </div>

                <h6 class="module-card-title">Signal Provision</h6>
                <p class="module-card-desc">Distributes real-time trade signals, entry/exit targets, and market analysis broadcasts directly to user feeds.</p>

                <div class="pt-3 border-top mt-auto">
                    <div class="module-selectgroup">
                        <label class="module-selectgroup-item">
                            <input type="radio" class="module-selectgroup-input" name="signal" wire:click="updateModule('signal','true')" {{ $isSignalActive ? 'checked' : '' }}>
                            <span class="module-selectgroup-btn">Enabled</span>
                        </label>
                        <label class="module-selectgroup-item">
                            <input type="radio" class="module-selectgroup-input" name="signal" wire:click="updateModule('signal','false')" {{ !$isSignalActive ? 'checked' : '' }}>
                            <span class="module-selectgroup-btn">Disabled</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Module 6: Client Bank Linking -->
        @php
            $isBankLinkActive = isset($mod['bank_link']) && ($mod['bank_link'] === true || $mod['bank_link'] === 'true' || $mod['bank_link'] === 1 || $mod['bank_link'] === '1');
        @endphp
        <div class="col-md-6 col-xl-4">
            <div class="module-feature-card">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                        <i class="fa-solid fa-building-columns f-18"></i>
                    </div>
                    <div class="d-flex gap-1 align-items-center">
                        <span class="module-badge-pro">Optional</span>
                        <span class="{{ $isBankLinkActive ? 'module-badge-active' : 'module-badge-disabled' }}">
                            {{ $isBankLinkActive ? 'Active' : 'Disabled' }}
                        </span>
                    </div>
                </div>

                <h6 class="module-card-title">Client Bank Linking</h6>
                <p class="module-card-desc">Allows clients to link external banking profiles. Keep disabled by default to prevent crawlers and scanners from detecting banking integration routes.</p>

                <div class="pt-3 border-top mt-auto">
                    <div class="module-selectgroup">
                        <label class="module-selectgroup-item">
                            <input type="radio" class="module-selectgroup-input" name="bank_link" wire:click="updateModule('bank_link','true')" {{ $isBankLinkActive ? 'checked' : '' }}>
                            <span class="module-selectgroup-btn">Enabled</span>
                        </label>
                        <label class="module-selectgroup-item">
                            <input type="radio" class="module-selectgroup-input" name="bank_link" wire:click="updateModule('bank_link','false')" {{ !$isBankLinkActive ? 'checked' : '' }}>
                            <span class="module-selectgroup-btn">Disabled</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Module 7: Trading & Market Intelligence Workspaces -->
        <div class="col-md-6 col-xl-4">
            <div class="module-feature-card" style="border-top: 3px solid #6366f1 !important;">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                        <i class="fa fa-chart-line f-18"></i>
                    </div>
                    <span class="{{ $isTradingSectionActive ? 'module-badge-active' : 'module-badge-disabled' }}">
                        {{ $isTradingSectionActive ? 'Active' : 'Disabled (Dormant)' }}
                    </span>
                </div>

                <h6 class="module-card-title">Trading & Market Intelligence</h6>
                <p class="module-card-desc">Controls visibility of Demo Trading, Live Markets, CopyTrading, AI Bots, and Market Signals. When disabled, all trading sections remain completely dormant and invisible to users.</p>

                <div class="pt-3 border-top mt-auto">
                    <div class="module-selectgroup">
                        <label class="module-selectgroup-item">
                            <input type="radio" class="module-selectgroup-input" name="trading_section" wire:click="updateModule('trading_section','true')" {{ $isTradingSectionActive ? 'checked' : '' }}>
                            <span class="module-selectgroup-btn">Enabled</span>
                        </label>
                        <label class="module-selectgroup-item">
                            <input type="radio" class="module-selectgroup-input" name="trading_section" wire:click="updateModule('trading_section','false')" {{ !$isTradingSectionActive ? 'checked' : '' }}>
                            <span class="module-selectgroup-btn">Disabled</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
