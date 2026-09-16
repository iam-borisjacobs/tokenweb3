@php
    if ($settings->redirect_url != null || !empty($settings->redirect_url)) {
        header("Location: $settings->redirect_url", true, 301);
        exit();
    }
@endphp
@extends('layouts.base')

@section('title', 'Asset Defense & Vault Security Architecture')

@section('styles')
    @parent
    <style>
        /* Scoped Security Page Modern Styles with 100% Light/Dark Parity */
        .security-layer-card {
            background: rgba(16, 22, 34, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-top: 3px solid var(--accent-cyan, #00e5ff);
            border-radius: 18px;
            padding: 32px 26px;
            height: 100%;
            display: flex;
            flex-direction: column;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }
        .security-layer-card--emerald {
            border-top-color: #10b981;
        }
        .security-layer-card--purple {
            border-top-color: #8b5cf6;
        }
        .security-layer-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 40px rgba(0, 229, 255, 0.12);
        }
        [data-theme="light"] .security-layer-card {
            background: #ffffff !important;
            border-color: #e2e8f0 !important;
            border-top: 3px solid #0284c7 !important;
            box-shadow: 0 8px 25px rgba(15, 23, 42, 0.05) !important;
        }
        [data-theme="light"] .security-layer-card--emerald {
            border-top-color: #059669 !important;
        }
        [data-theme="light"] .security-layer-card--purple {
            border-top-color: #7c3aed !important;
        }
        [data-theme="light"] .security-layer-card:hover {
            box-shadow: 0 16px 36px rgba(15, 23, 42, 0.08) !important;
            transform: translateY(-4px);
        }
        .security-layer-card .title {
            font-size: 19px;
            font-weight: 800;
            color: #ffffff;
            margin-bottom: 12px;
        }
        [data-theme="light"] .security-layer-card .title {
            color: #0f172a !important;
        }
        .security-layer-card .desc {
            font-size: 14px;
            line-height: 1.7;
            color: #94a3b8;
            margin-bottom: 20px;
        }
        [data-theme="light"] .security-layer-card .desc {
            color: #475569 !important;
        }
        .security-layer-card .bullets-wrap {
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            padding-top: 18px;
            margin-top: auto;
        }
        [data-theme="light"] .security-layer-card .bullets-wrap {
            border-top-color: #f1f5f9 !important;
        }
        .security-layer-card .bullets-wrap li {
            font-size: 13px;
            color: #cbd5e1;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
        }
        [data-theme="light"] .security-layer-card .bullets-wrap li {
            color: #334155 !important;
        }

        /* Audit Certificate Box (Red Box 2) */
        .audit-cert-box {
            background: rgba(7, 9, 14, 0.7);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 18px;
            padding: 30px 24px;
            text-align: center;
            transition: all 0.3s ease;
        }
        [data-theme="light"] .audit-cert-box {
            background: #ffffff !important;
            border: 1px solid #e2e8f0 !important;
            box-shadow: 0 8px 24px rgba(15, 23, 42, 0.05) !important;
        }
        .audit-cert-box .cert-title {
            font-size: 17px;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 6px;
        }
        [data-theme="light"] .audit-cert-box .cert-title {
            color: #0f172a !important;
        }
        .audit-cert-box .cert-desc {
            font-size: 13px;
            color: #94a3b8;
            line-height: 1.6;
            margin-bottom: 16px;
        }
        [data-theme="light"] .audit-cert-box .cert-desc {
            color: #475569 !important;
        }

        /* Bottom CTA Executive Banner (Red Arrow) */
        .security-cta-banner {
            background: linear-gradient(135deg, rgba(16, 22, 34, 0.95) 0%, rgba(10, 14, 23, 0.98) 100%);
            border: 1px solid rgba(0, 229, 255, 0.25);
            border-radius: 22px;
            padding: 50px 32px;
            text-align: center;
            box-shadow: 0 16px 45px rgba(0, 0, 0, 0.4);
            position: relative;
            overflow: hidden;
        }
        [data-theme="light"] .security-cta-banner {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%) !important;
            border: 1px solid rgba(2, 132, 199, 0.3) !important;
            box-shadow: 0 20px 45px rgba(15, 23, 42, 0.12) !important;
        }
        .security-cta-banner .cta-title {
            color: #ffffff !important;
            font-size: 2.2rem;
            font-weight: 800;
            letter-spacing: -0.02em;
            margin-bottom: 12px;
        }
        .security-cta-banner .cta-desc {
            color: rgba(255, 255, 255, 0.75) !important;
            font-size: 15px;
            line-height: 1.6;
            max-width: 620px;
            margin: 0 auto 26px auto;
        }
    </style>
@endsection

@section('content')
    <!-- ==================== HERO SECTION ==================== -->
    <section class="section section--head page-hero-section">
        <div class="container pt-4 pb-2">
            <div class="row align-items-center justify-content-center text-center">
                <div class="col-12 col-xl-10">
                    <div class="hero-pill-badge mx-auto mb-3">
                        <i class="ti ti-shield-lock text-info"></i> Comprehensive Asset Defense Architecture
                    </div>
                    <h1 class="page-hero-title">
                        Engineered to Eliminate <span class="text-gradient-cyan">Counterparty &amp; Insolvency</span> Risk
                    </h1>
                    <p class="page-hero-text">
                        In digital finance, security isn't an afterthought—it is the foundational prerequisite. Explore the multi-signature vaults, hardware security modules, and cryptographic reserve protocols protecting every dollar on {{ $settings->site_name }}.
                    </p>

                    <div class="d-flex align-items-center justify-content-center gap-3 flex-wrap">
                        <a href="{{ url('/register') }}" class="btn-hero-primary">
                            <i class="ti ti-shield-check" style="font-size: 20px;"></i>
                            <span>Create Protected Account</span>
                        </a>
                        <a href="{{ url('/contact') }}" class="btn-hero-secondary">
                            <i class="ti ti-headset" style="font-size: 20px; color: var(--accent-cyan);"></i>
                            <span>Consult Security Specialist</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== 3 CORE DEFENSE LAYERS (RED BOX 1 FIX) ==================== -->
    <section class="section pt-3 pb-5">
        <div class="container">
            <div class="row g-4">
                <!-- Layer 1 -->
                <div class="col-12 col-lg-4">
                    <div class="security-layer-card">
                        <div class="icon-wrap mb-3 rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 52px; height: 52px; background: rgba(0, 229, 255, 0.12); color: #00E5FF; font-size: 24px;">
                            <i class="ti ti-vault"></i>
                        </div>
                        <h4 class="title">1. Segregated Cold Vaults</h4>
                        <p class="desc">
                            Over 98% of all digital reserves are kept in air-gapped, offline multi-signature cold storage. Private keys are split via Shamir's Secret Sharing (SSS) and held across multiple secure geographical jurisdictions.
                        </p>
                        <div class="bullets-wrap">
                            <ul class="list-unstyled mb-0 d-flex flex-column gap-2">
                                <li><i class="ti ti-circle-check text-info me-2 f-16"></i> Multi-Sig Authorization (3 of 5 quorum)</li>
                                <li><i class="ti ti-circle-check text-info me-2 f-16"></i> FIPS 140-2 Level 3 Certified HSMs</li>
                                <li><i class="ti ti-circle-check text-info me-2 f-16"></i> Strict 1:1 reserve allocation ratio</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Layer 2 -->
                <div class="col-12 col-lg-4">
                    <div class="security-layer-card security-layer-card--emerald">
                        <div class="icon-wrap mb-3 rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 52px; height: 52px; background: rgba(16, 185, 129, 0.12); color: #10B981; font-size: 24px;">
                            <i class="ti ti-binary-tree"></i>
                        </div>
                        <h4 class="title">2. Cryptographic Proof of Reserves</h4>
                        <p class="desc">
                            We believe in cryptographic mathematical proof over corporate promises. Our Merkle tree auditing allows any client to verify that their balance is included in the liabilities tree and collateralized by on-chain reserves.
                        </p>
                        <div class="bullets-wrap">
                            <ul class="list-unstyled mb-0 d-flex flex-column gap-2">
                                <li><i class="ti ti-circle-check text-success me-2 f-16"></i> Transparent On-Chain Verification</li>
                                <li><i class="ti ti-circle-check text-success me-2 f-16"></i> Zero Fractional Reserve Lending</li>
                                <li><i class="ti ti-circle-check text-success me-2 f-16"></i> Continuous Automated Solvency Checks</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Layer 3 -->
                <div class="col-12 col-lg-4">
                    <div class="security-layer-card security-layer-card--purple">
                        <div class="icon-wrap mb-3 rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 52px; height: 52px; background: rgba(139, 92, 246, 0.12); color: #8B5CF6; font-size: 24px;">
                            <i class="ti ti-wallet"></i>
                        </div>
                        <h4 class="title">3. Web3 Non-Custodial Sync</h4>
                        <p class="desc">
                            Seamlessly connect your self-custody wallets (MetaMask, Trust Wallet, Ledger via WalletConnect) to receive automated profit distributions directly to your private blockchain keys without third-party holds.
                        </p>
                        <div class="bullets-wrap">
                            <ul class="list-unstyled mb-0 d-flex flex-column gap-2">
                                <li><i class="ti ti-circle-check text-primary me-2 f-16"></i> Compatible with 10+ Web3 Wallets</li>
                                <li><i class="ti ti-circle-check text-primary me-2 f-16"></i> Instant Automated On-Chain Payouts</li>
                                <li><i class="ti ti-circle-check text-primary me-2 f-16"></i> Client Maintains Key Sovereignty</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== MARKET-NEUTRAL ARBITRAGE EXPLAINER ==================== -->
    <section class="section pt-3 pb-5">
        <div class="container">
            <div class="page-modern-card p-4 p-md-5">
                <div class="row align-items-center g-4">
                    <div class="col-12 col-lg-7">
                        <div class="hero-pill-badge mb-2">
                            <i class="ti ti-arrows-cross text-success"></i> Market-Neutral Intelligence
                        </div>
                        <h3 class="page-section-heading">
                            Zero Directional Exposure: How Arbitrage Yields Are Generated
                        </h3>
                        <p class="page-section-desc mb-3">
                            Traditional hedge funds and crypto traders bet on whether Bitcoin or Ethereum will rise or fall. When markets crash, they suffer massive drawdowns.
                        </p>
                        <p class="page-section-desc mb-4">
                            {{ $settings->site_name }}’s algorithmic engine does not care about market direction. It identifies fractional price disparities between major exchanges (e.g. BTC at $68,400 on Exchange A vs $68,520 on Exchange B). Our automated bot buys on Exchange A and sells simultaneously on Exchange B within microseconds, locking in guaranteed spread margin with zero exposure to future price movement.
                        </p>
                        <div class="d-flex align-items-center gap-4 flex-wrap">
                            <div>
                                <span class="display-6 f-w-800 text-gradient-cyan d-block">15+</span>
                                <small class="text-adaptive-muted f-12">Tier-1 Venues Scanned</small>
                            </div>
                            <div>
                                <span class="display-6 f-w-800 text-adaptive-primary d-block">&lt; 8ms</span>
                                <small class="text-adaptive-muted f-12">Average Route Execution</small>
                            </div>
                            <div>
                                <span class="display-6 f-w-800 text-success d-block">100%</span>
                                <small class="text-adaptive-muted f-12">Delta-Neutral Coverage</small>
                            </div>
                        </div>
                    </div>

                    <!-- RED BOX 2 FIX: Institutional Audit Certificate -->
                    <div class="col-12 col-lg-5">
                        <div class="audit-cert-box">
                            <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px; background: rgba(16, 185, 129, 0.12); color: #10B981; font-size: 28px;">
                                <i class="ti ti-shield-check"></i>
                            </div>
                            <h5 class="cert-title">Institutional Audit Certificate</h5>
                            <p class="cert-desc">Audited by independent top-tier cybersecurity and smart-contract verification firms.</p>
                            <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill f-12 f-w-700 border border-success border-opacity-25">
                                <i class="ti ti-lock-check me-1"></i> Continuous Monitoring Active
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== CTA BANNER (RED ARROW FIX) ==================== -->
    <section class="section pt-3 pb-5">
        <div class="container">
            <div class="security-cta-banner">
                <h3 class="cta-title">Experience Institutional Capital Defense</h3>
                <p class="cta-desc">
                    Join thousands of high-net-worth investors benefiting from isolated multi-signature cold custody and risk-free arbitrage returns.
                </p>
                <div class="d-flex align-items-center justify-content-center gap-3 flex-wrap">
                    <a href="{{ url('/register') }}" class="btn-hero-primary">
                        <i class="ti ti-user-plus me-1" style="font-size: 18px;"></i>
                        <span>Create Protected Account</span>
                    </a>
                    <a href="{{ url('/contact') }}" class="btn-hero-secondary">
                        <i class="ti ti-mail me-1" style="font-size: 18px; color: var(--accent-cyan);"></i>
                        <span>Inquire with Security Desk</span>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
