@php
    if ($settings->redirect_url != null || !empty($settings->redirect_url)) {
        header("Location: $settings->redirect_url", true, 301);
        exit();
    }
@endphp
@extends('layouts.base')

@section('title', 'Frequently Asked Questions – Institutional Knowledge Base')

@section('styles')
    @parent
    <style>
        .faq-accordion-item {
            background: rgba(16, 22, 34, 0.75) !important;
            border: 1px solid rgba(255, 255, 255, 0.08) !important;
            border-radius: 14px !important;
            margin-bottom: 12px;
            overflow: hidden;
            transition: all 0.2s ease;
        }
        [data-theme="light"] .faq-accordion-item {
            background: #ffffff !important;
            border-color: #e2e8f0 !important;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
        }
        .faq-accordion-button {
            background: transparent !important;
            color: #ffffff !important;
            font-size: 15px !important;
            font-weight: 700 !important;
            padding: 18px 22px !important;
            box-shadow: none !important;
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            border: none;
            text-align: left;
            transition: color 0.2s ease;
        }
        [data-theme="light"] .faq-accordion-button {
            color: #0f172a !important;
        }
        .faq-accordion-button:not(.collapsed) {
            color: var(--accent-cyan, #00e5ff) !important;
        }
        .faq-accordion-button::after {
            filter: invert(1);
            transition: transform 0.2s ease;
        }
        [data-theme="light"] .faq-accordion-button::after {
            filter: none;
        }
        .faq-accordion-body {
            color: #94a3b8 !important;
            font-size: 14px !important;
            line-height: 1.7 !important;
            padding: 0 22px 20px 22px !important;
        }
        [data-theme="light"] .faq-accordion-body {
            color: #475569 !important;
        }
    </style>
@endsection

@section('content')
    <!-- ==================== HERO SECTION ==================== -->
    <section class="section section--head page-hero-section">
        <div class="container pt-4 pb-2">
            <div class="row justify-content-center text-center">
                <div class="col-12 col-xl-8">
                    <div class="hero-pill-badge mx-auto mb-3">
                        <i class="ti ti-help text-info"></i> Knowledge Base &amp; Documentation
                    </div>
                    <h1 class="page-hero-title">
                        Frequently Asked <span class="text-gradient-cyan">Questions</span>
                    </h1>
                    <p class="page-hero-text">
                        Find quick, detailed answers regarding our segregated custody, zero-directional arbitrage strategies, account verification, and profit payouts.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== FAQ ACCORDION SECTION ==================== -->
    <section class="section pt-3 pb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-10">
                    <div class="accordion" id="faqMainAccordion">
                        @if($faqs && count($faqs) > 0)
                            <!-- Dynamic FAQs from Admin Database -->
                            @foreach($faqs as $index => $faq)
                                <div class="faq-accordion-item">
                                    <h2 class="accordion-header" id="headingDb{{ $faq->id }}">
                                        <button class="accordion-button faq-accordion-button {{ $index !== 0 ? 'collapsed' : '' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDb{{ $faq->id }}" aria-expanded="{{ $index === 0 ? 'true' : 'false' }}" aria-controls="collapseDb{{ $faq->id }}">
                                            <span class="d-flex align-items-center gap-2">
                                                <i class="ti ti-help-circle text-info f-18"></i>
                                                {{ $faq->question }}
                                            </span>
                                        </button>
                                    </h2>
                                    <div id="collapseDb{{ $faq->id }}" class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}" aria-labelledby="headingDb{{ $faq->id }}" data-bs-parent="#faqMainAccordion">
                                        <div class="accordion-body faq-accordion-body">
                                            {!! nl2br(e($faq->answer)) !!}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <!-- Institutional Curated FAQs -->
                            <!-- Q1 -->
                            <div class="faq-accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button faq-accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <span class="d-flex align-items-center gap-2">
                                            <i class="ti ti-shield-lock text-info f-18"></i>
                                            How does {{ $settings->site_name }} protect client capital from exchange insolvency?
                                        </span>
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#faqMainAccordion">
                                    <div class="accordion-body faq-accordion-body">
                                        Unlike typical centralized exchanges that co-mingle customer balances in proprietary hot wallets, {{ $settings->site_name }} enforces strict 1:1 segregated custody. Your assets reside in isolated offline multi-signature cold vaults secured by Hardware Security Modules (HSM). We never lend, rehypothecate, or leverage client deposits for directional trading bets.
                                    </div>
                                </div>
                            </div>

                            <!-- Q2 -->
                            <div class="faq-accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button faq-accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        <span class="d-flex align-items-center gap-2">
                                            <i class="ti ti-arrows-cross text-success f-18"></i>
                                            What is market-neutral arbitrage, and how are returns generated?
                                        </span>
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqMainAccordion">
                                    <div class="accordion-body faq-accordion-body">
                                        Market-neutral arbitrage exploits microsecond price discrepancies for the same digital asset across different liquidity venues (such as Binance, Coinbase, Kraken, and Bybit). By buying at the lower exchange and simultaneously selling at the higher venue, profit is locked in instantaneously with zero directional market risk, regardless of whether crypto prices surge or plunge.
                                    </div>
                                </div>
                            </div>

                            <!-- Q3 -->
                            <div class="faq-accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button faq-accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        <span class="d-flex align-items-center gap-2">
                                            <i class="ti ti-wallet text-warning f-18"></i>
                                            Can I connect my decentralized Web3 wallet?
                                        </span>
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqMainAccordion">
                                    <div class="accordion-body faq-accordion-body">
                                        Yes. Our portal natively integrates with over 10+ leading Web3 wallets including MetaMask, Trust Wallet, Coinbase Wallet, Phantom, and WalletConnect protocols. Linking your wallet allows automated yield distribution and on-chain verification without custodial delays.
                                    </div>
                                </div>
                            </div>

                            <!-- Q4 -->
                            <div class="faq-accordion-item">
                                <h2 class="accordion-header" id="headingFour">
                                    <button class="accordion-button faq-accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                        <span class="d-flex align-items-center gap-2">
                                            <i class="ti ti-file-certificate text-primary f-18"></i>
                                            What is the Proof of Reserves (PoR) verification protocol?
                                        </span>
                                    </button>
                                </h2>
                                <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#faqMainAccordion">
                                    <div class="accordion-body faq-accordion-body">
                                        Proof of Reserves is a cryptographic auditing standard utilizing Merkle trees. It enables any account holder to independently verify that their account balance is accounted for within our on-chain cold vault reserves, guaranteeing that 100% of platform liabilities are fully collateralized at all times.
                                    </div>
                                </div>
                            </div>

                            <!-- Q5 -->
                            <div class="faq-accordion-item">
                                <h2 class="accordion-header" id="headingFive">
                                    <button class="accordion-button faq-accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                        <span class="d-flex align-items-center gap-2">
                                            <i class="ti ti-cash-banknote text-info f-18"></i>
                                            How quickly are withdrawal requests processed?
                                        </span>
                                    </button>
                                </h2>
                                <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#faqMainAccordion">
                                    <div class="accordion-body faq-accordion-body">
                                        Withdrawals undergo automated multi-factor cryptographic security checks. Standard cryptocurrency payouts are broadcasted to the blockchain within 15–30 minutes. Bank wire settlements are initiated next-business-day according to SWIFT/SEPA clearing protocols.
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== BOTTOM CONTACT PROMPT ==================== -->
    <section class="section pt-3 pb-5">
        <div class="container">
            <div class="page-modern-card p-4 p-md-5 text-center">
                <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 52px; height: 52px; background: rgba(0, 229, 255, 0.12); color: #00E5FF; font-size: 24px;">
                    <i class="ti ti-messages"></i>
                </div>
                <h4 class="text-adaptive-primary f-w-800 mb-2">Still Have Questions?</h4>
                <p class="text-adaptive-muted mx-auto mb-4" style="max-width: 520px; font-size: 14.5px; line-height: 1.6;">
                    Our senior account representatives and risk desk are available 24/7 to discuss custody setup, API integration, and institutional liquidity.
                </p>
                <div>
                    <a href="{{ url('/contact') }}" class="btn-hero-primary d-inline-flex">
                        <i class="ti ti-headset me-1" style="font-size: 18px;"></i>
                        <span>Contact Our Support Desk</span>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
