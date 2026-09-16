@php
    if ($settings->redirect_url != null || !empty($settings->redirect_url)) {
        header("Location: $settings->redirect_url", true, 301);
        exit();
    }
@endphp
@extends('layouts.base')

@section('title', 'About Us – Asset Protection & Institutional Governance')

@section('styles')
    @parent
    <style>
        /* Scoped About Page Component Styles */
        .comparison-box {
            background: rgba(16, 22, 34, 0.88);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 20px;
            padding: 28px;
            box-shadow: 0 14px 40px rgba(0, 0, 0, 0.4);
            backdrop-filter: blur(16px);
        }
        [data-theme="light"] .comparison-box {
            background: #ffffff !important;
            border: 1px solid #e2e8f0 !important;
            box-shadow: 0 14px 40px rgba(15, 23, 42, 0.06) !important;
        }
        .comparison-box-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            padding-bottom: 16px;
            margin-bottom: 22px;
        }
        [data-theme="light"] .comparison-box-header {
            border-bottom-color: #e2e8f0 !important;
        }
        .comparison-box-title {
            font-size: 17px;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 0;
        }
        [data-theme="light"] .comparison-box-title {
            color: #0f172a !important;
        }
        .comp-row-bad {
            background: rgba(239, 68, 68, 0.08);
            border-left: 3px solid #ef4444;
            border-radius: 10px;
            padding: 12px 16px;
            margin-bottom: 8px;
            font-size: 13.5px;
            font-weight: 600;
            color: #f87171;
            display: flex;
            align-items: center;
        }
        [data-theme="light"] .comp-row-bad {
            background: #fef2f2 !important;
            border-left-color: #dc2626 !important;
            color: #991b1b !important;
        }
        .comp-row-good {
            background: rgba(16, 185, 129, 0.08);
            border-left: 3px solid #10b981;
            border-radius: 10px;
            padding: 12px 16px;
            font-size: 13.5px;
            font-weight: 600;
            color: #34d399;
            display: flex;
            align-items: center;
        }
        [data-theme="light"] .comp-row-good {
            background: #ecfdf5 !important;
            border-left-color: #059669 !important;
            color: #065f46 !important;
        }
        .comp-badge-pill {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.04em;
            padding: 4px 10px;
            border-radius: 20px;
            background: rgba(2, 132, 199, 0.15);
            color: #38bdf8;
            border: 1px solid rgba(2, 132, 199, 0.3);
        }
        [data-theme="light"] .comp-badge-pill {
            background: rgba(2, 132, 199, 0.08) !important;
            color: #0284c7 !important;
            border-color: rgba(2, 132, 199, 0.25) !important;
        }
        .pillar-card-box {
            background: rgba(16, 22, 34, 0.75);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 18px;
            padding: 30px 24px;
            height: 100%;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            display: flex;
            flex-direction: column;
        }
        .pillar-card-box:hover {
            transform: translateY(-4px);
            border-color: rgba(0, 229, 255, 0.35);
            box-shadow: 0 16px 40px rgba(0, 229, 255, 0.12);
        }
        [data-theme="light"] .pillar-card-box {
            background: #ffffff !important;
            border: 1px solid #e2e8f0 !important;
            box-shadow: 0 6px 20px rgba(15, 23, 42, 0.04) !important;
        }
        [data-theme="light"] .pillar-card-box:hover {
            border-color: rgba(2, 132, 199, 0.35) !important;
            box-shadow: 0 16px 36px rgba(15, 23, 42, 0.08) !important;
            transform: translateY(-4px);
        }
        .pillar-card-box .icon-wrap {
            width: 50px;
            height: 50px;
            border-radius: 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin-bottom: 20px;
        }
        .pillar-card-box .title {
            font-size: 18px;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 10px;
        }
        [data-theme="light"] .pillar-card-box .title {
            color: #0f172a !important;
        }
        .pillar-card-box .desc {
            font-size: 14px;
            line-height: 1.65;
            color: #94a3b8;
            margin-bottom: 0;
        }
        [data-theme="light"] .pillar-card-box .desc {
            color: #475569 !important;
        }
        .metrics-strip-box {
            background: rgba(16, 22, 34, 0.65);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 20px;
            padding: 26px 20px;
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
        }
        [data-theme="light"] .metrics-strip-box {
            background: #ffffff !important;
            border: 1px solid #e2e8f0 !important;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.04) !important;
        }
        .metrics-strip-box .val {
            font-size: 2.1rem;
            font-weight: 800;
            line-height: 1.1;
            margin-bottom: 6px;
            letter-spacing: -0.02em;
        }
        .metrics-strip-box .lbl {
            font-size: 13px;
            font-weight: 600;
            color: #94a3b8;
            margin-bottom: 0;
        }
        [data-theme="light"] .metrics-strip-box .lbl {
            color: #64748b !important;
        }
        .executive-cta-box {
            background: linear-gradient(135deg, rgba(16, 22, 34, 0.95) 0%, rgba(10, 14, 23, 0.98) 100%);
            border: 1px solid rgba(0, 229, 255, 0.2);
            border-radius: 24px;
            padding: 48px 32px;
            text-align: center;
            box-shadow: 0 16px 40px rgba(0, 0, 0, 0.4);
            position: relative;
            overflow: hidden;
        }
        [data-theme="light"] .executive-cta-box {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%) !important;
            border: 1px solid rgba(2, 132, 199, 0.25) !important;
            box-shadow: 0 20px 45px rgba(15, 23, 42, 0.12) !important;
        }
        .executive-cta-box h2 {
            color: #ffffff !important;
            font-weight: 800;
        }
        .executive-cta-box p {
            color: rgba(255, 255, 255, 0.75) !important;
        }
    </style>
@endsection

@section('content')
    <!-- ==================== ABOUT HERO ==================== -->
    <section class="section section--head page-hero-section">
        <div class="container pt-4 pb-2">
            <div class="row align-items-center justify-content-center text-center">
                <div class="col-12 col-xl-10">
                    <div class="hero-pill-badge mx-auto mb-3">
                        <i class="ti ti-building-bank text-info"></i> Institutional Governance &amp; Asset Defense
                    </div>
                    <h1 class="page-hero-title">
                        Pioneering <span class="text-gradient-cyan">Segregated Custody</span> &amp; Market-Neutral Intelligence
                    </h1>
                    <p class="page-hero-text">
                        {{ $settings->site_name }} was engineered on an uncompromised principle: client capital must remain 100% isolated, cryptographically verifiable, and immune to exchange counterparty speculation.
                    </p>

                    <div class="d-flex align-items-center justify-content-center gap-3 flex-wrap">
                        <a href="{{ url('/register') }}" class="btn-hero-primary">
                            <i class="ti ti-shield-check" style="font-size: 20px;"></i>
                            <span>Open Protected Account</span>
                        </a>
                        <a href="{{ url('/contact') }}" class="btn-hero-secondary">
                            <i class="ti ti-mail" style="font-size: 20px; color: var(--accent-cyan);"></i>
                            <span>Speak to an Advisor</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== THE FOUNDING STORY & FTX LESSON ==================== -->
    <section class="section pt-3 pb-5">
        <div class="container">
            <div class="row g-4 align-items-center">
                <div class="col-12 col-lg-6">
                    <div class="pe-lg-3">
                        <div class="badge bg-danger bg-opacity-10 text-danger px-3 py-2 rounded-pill f-12 f-w-700 mb-3 border border-danger border-opacity-25">
                            <i class="ti ti-alert-triangle me-1"></i> The Post-FTX Imperative
                        </div>
                        <h2 class="page-section-heading">
                            Why Traditional Crypto Exchanges Fail Their Users
                        </h2>
                        <p class="page-section-desc mb-3">
                            The catastrophic collapse of major centralized exchanges exposed a fatal flaw in the cryptocurrency ecosystem: platforms co-mingling client deposits, using customer assets for directional speculative trading, and maintaining fractional reserve deficits.
                        </p>
                        <p class="page-section-desc mb-4">
                            At <strong>{{ $settings->site_name }}</strong>, we fundamentally rejected this model. We built an isolated custody infrastructure where investor balances are segregated into multi-signature cold vaults with automated, zero-directional-risk arbitrage algorithms that profit strictly from market inefficiencies.
                        </p>

                        <div class="d-flex flex-column gap-3">
                            <div class="d-flex align-items-start gap-3">
                                <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 40px; height: 40px; background: rgba(0, 229, 255, 0.12); color: #00E5FF;">
                                    <i class="ti ti-lock-check" style="font-size: 20px;"></i>
                                </div>
                                <div>
                                    <h6 class="text-adaptive-primary f-w-700 mb-1">Strict 1:1 Reserve Segregation</h6>
                                    <small class="text-adaptive-muted">Your funds are never loaned, pledged as collateral, or used for proprietary directional bets.</small>
                                </div>
                            </div>

                            <div class="d-flex align-items-start gap-3">
                                <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 40px; height: 40px; background: rgba(16, 185, 129, 0.12); color: #10B981;">
                                    <i class="ti ti-arrows-cross" style="font-size: 20px;"></i>
                                </div>
                                <div>
                                    <h6 class="text-adaptive-primary f-w-700 mb-1">Market-Neutral Execution</h6>
                                    <small class="text-adaptive-muted">Arbitrage bots capture inter-exchange spreads simultaneously across top order books with zero exposure to market crashes.</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-6">
                    <div class="comparison-box">
                        <div class="comparison-box-header">
                            <h5 class="comparison-box-title">Architecture Comparison</h5>
                            <span class="comp-badge-pill">Industry Standard</span>
                        </div>

                        <!-- Row 1: Custody -->
                        <div class="mb-4">
                            <div class="d-flex justify-content-between text-adaptive-muted f-12 mb-1">
                                <span>Custody Framework</span>
                            </div>
                            <div class="comp-row-bad">
                                <i class="ti ti-x me-2 f-16"></i> Typical Exchanges: Co-mingled Hot Wallets
                            </div>
                            <div class="comp-row-good">
                                <i class="ti ti-check me-2 f-16"></i> {{ $settings->site_name }}: 100% Segregated Cold Vaults
                            </div>
                        </div>

                        <!-- Row 2: Trading Model -->
                        <div class="mb-4">
                            <div class="d-flex justify-content-between text-adaptive-muted f-12 mb-1">
                                <span>Capital Exposure</span>
                            </div>
                            <div class="comp-row-bad">
                                <i class="ti ti-x me-2 f-16"></i> Typical Exchanges: Speculative Directional Bets
                            </div>
                            <div class="comp-row-good">
                                <i class="ti ti-check me-2 f-16"></i> {{ $settings->site_name }}: Delta-Neutral Spatial Arbitrage
                            </div>
                        </div>

                        <!-- Row 3: Solvency -->
                        <div>
                            <div class="d-flex justify-content-between text-adaptive-muted f-12 mb-1">
                                <span>Solvency Verification</span>
                            </div>
                            <div class="comp-row-bad">
                                <i class="ti ti-x me-2 f-16"></i> Typical Exchanges: Opaque Internal Ledgers
                            </div>
                            <div class="comp-row-good">
                                <i class="ti ti-check me-2 f-16"></i> {{ $settings->site_name }}: Cryptographic Proof of Reserves
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== 4 CORE PILLARS ==================== -->
    <section class="section pt-4 pb-5 position-relative">
        <div class="container">
            <div class="text-center mb-5">
                <div class="hero-pill-badge mx-auto mb-2">
                    <i class="ti ti-cube-send text-primary"></i> Operating Philosophy
                </div>
                <h2 class="page-section-heading">Our Four Pillars of Resilience</h2>
                <p class="page-section-desc mx-auto" style="max-width: 620px;">
                    Engineered from the ground up for high-net-worth clients, family offices, and forward-thinking digital asset investors.
                </p>
            </div>

            <div class="row g-4">
                <!-- Pillar 1 -->
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="pillar-card-box">
                        <div class="icon-wrap" style="background: rgba(0, 229, 255, 0.12); color: #00E5FF;">
                            <i class="ti ti-shield-lock"></i>
                        </div>
                        <h5 class="title">Cold Vault Isolation</h5>
                        <p class="desc">
                            98%+ of client reserves reside in multi-signature offline cold vaults with Hardware Security Modules (HSM) and distributed geographic key shards.
                        </p>
                    </div>
                </div>

                <!-- Pillar 2 -->
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="pillar-card-box">
                        <div class="icon-wrap" style="background: rgba(16, 185, 129, 0.12); color: #10B981;">
                            <i class="ti ti-cpu"></i>
                        </div>
                        <h5 class="title">Microsecond Execution</h5>
                        <p class="desc">
                            Sub-millisecond low-latency cross-exchange arbitrage routes scan 15+ order books to extract risk-free spread margins around the clock.
                        </p>
                    </div>
                </div>

                <!-- Pillar 3 -->
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="pillar-card-box">
                        <div class="icon-wrap" style="background: rgba(139, 92, 246, 0.12); color: #8B5CF6;">
                            <i class="ti ti-file-certificate"></i>
                        </div>
                        <h5 class="title">Proof of Reserves</h5>
                        <p class="desc">
                            Automated Merkle-tree cryptographic audits assure investors that account liabilities are matched by verifiable on-chain vault balances in real time.
                        </p>
                    </div>
                </div>

                <!-- Pillar 4 -->
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="pillar-card-box">
                        <div class="icon-wrap" style="background: rgba(245, 158, 11, 0.12); color: #F59E0B;">
                            <i class="ti ti-headset"></i>
                        </div>
                        <h5 class="title">Institutional Advisory</h5>
                        <p class="desc">
                            Direct access to dedicated wealth managers, real-time portfolio analytics, tailored liquidity tranches, and 24/7 technical incident response.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== KEY METRICS STRIP ==================== -->
    <section class="section pt-3 pb-5">
        <div class="container">
            <div class="metrics-strip-box">
                <div class="row g-4 text-center">
                    <div class="col-6 col-md-3">
                        <div class="val text-gradient-cyan">$1.4B+</div>
                        <p class="lbl">Total Protected Volume</p>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="val text-adaptive-primary">100%</div>
                        <p class="lbl">Reserve Backing Ratio</p>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="val text-adaptive-primary">99.99%</div>
                        <p class="lbl">Execution Redundancy</p>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="val" style="color: #10B981;">0</div>
                        <p class="lbl">Liquidation / Loss Events</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== CTA SECTION ==================== -->
    <section class="section pt-3 pb-5">
        <div class="container">
            <div class="executive-cta-box">
                <div class="position-relative" style="z-index: 2;">
                    <h2 class="display-6 f-w-800 mb-2">Join the Future of Resilient Digital Wealth</h2>
                    <p class="mx-auto mb-4" style="max-width: 620px; font-size: 15px;">
                        Open your protected custody account today or connect with our institutional operations desk to learn more about our automated arbitrage yields.
                    </p>
                    <div class="d-flex align-items-center justify-content-center gap-3 flex-wrap">
                        <a href="{{ url('/register') }}" class="btn-hero-primary">
                            <i class="ti ti-rocket me-1" style="font-size: 18px;"></i>
                            <span>Open an Account</span>
                        </a>
                        <a href="{{ url('/contact') }}" class="btn-hero-secondary">
                            <i class="ti ti-headset me-1" style="font-size: 18px; color: var(--accent-cyan);"></i>
                            <span>Contact Support</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
