@extends('layouts.base')

@section('title', 'Asset Protection & Institutional Arbitrage')

@section('content')
    <!-- ==================== HERO SECTION ==================== -->
    <section class="hero">
        <!-- Ambient Glowing Light Orbs -->
        <div class="hero-ambient-orb hero-ambient-orb--top-right"></div>
        <div class="hero-ambient-orb hero-ambient-orb--top-left"></div>

        <!-- Rising Particles & Floating Bubbles Canvas -->
        <canvas id="hero-particles-canvas" class="hero-particles-canvas"></canvas>

        <div class="container">
            <!-- Top Live Price Roller / Ticker Marquee -->
            <div class="hero-ticker-wrapper">
                <div class="hero-ticker-box">
                    <div class="hero-ticker-track">
                        <!-- Set 1 -->
                        <div class="hero-ticker-item">
                            <span class="ticker-pair">BTC/USD</span>
                            <span class="ticker-price">$91,428.50</span>
                            <span class="ticker-change up"><i class="ti ti-arrow-up-right"></i>+2.14%</span>
                        </div>
                        <div class="hero-ticker-item">
                            <span class="ticker-pair">ETH/USD</span>
                            <span class="ticker-price">$3,452.10</span>
                            <span class="ticker-change up"><i class="ti ti-arrow-up-right"></i>+1.85%</span>
                        </div>
                        <div class="hero-ticker-item">
                            <span class="ticker-pair">EUR/USD</span>
                            <span class="ticker-price">1.0894</span>
                            <span class="ticker-change up"><i class="ti ti-arrow-up-right"></i>+0.12%</span>
                        </div>
                        <div class="hero-ticker-item">
                            <span class="ticker-pair">SOL/USD</span>
                            <span class="ticker-price">$154.20</span>
                            <span class="ticker-change up"><i class="ti ti-arrow-up-right"></i>+3.45%</span>
                        </div>
                        <div class="hero-ticker-item">
                            <span class="ticker-pair">GBP/USD</span>
                            <span class="ticker-price">1.2945</span>
                            <span class="ticker-change up"><i class="ti ti-arrow-up-right"></i>+0.22%</span>
                        </div>
                        <div class="hero-ticker-item">
                            <span class="ticker-pair">XAU/USD</span>
                            <span class="ticker-price">$2,648.80</span>
                            <span class="ticker-change up"><i class="ti ti-arrow-up-right"></i>+0.65%</span>
                        </div>
                        <div class="hero-ticker-item">
                            <span class="ticker-pair">USD/JPY</span>
                            <span class="ticker-price">154.12</span>
                            <span class="ticker-change down"><i class="ti ti-arrow-down-right"></i>-0.18%</span>
                        </div>
                        <div class="hero-ticker-item">
                            <span class="ticker-pair">BNB/USD</span>
                            <span class="ticker-price">$578.30</span>
                            <span class="ticker-change up"><i class="ti ti-arrow-up-right"></i>+0.95%</span>
                        </div>
                        <div class="hero-ticker-item">
                            <span class="ticker-pair">NASDAQ</span>
                            <span class="ticker-price">18,245.80</span>
                            <span class="ticker-change up"><i class="ti ti-arrow-up-right"></i>+0.72%</span>
                        </div>
                        <div class="hero-ticker-item">
                            <span class="ticker-pair">S&P 500</span>
                            <span class="ticker-price">5,862.10</span>
                            <span class="ticker-change up"><i class="ti ti-arrow-up-right"></i>+0.48%</span>
                        </div>

                        <!-- Duplicate Set for Seamless Infinite Marquee Loop -->
                        <div class="hero-ticker-item" aria-hidden="true">
                            <span class="ticker-pair">BTC/USD</span>
                            <span class="ticker-price">$91,428.50</span>
                            <span class="ticker-change up"><i class="ti ti-arrow-up-right"></i>+2.14%</span>
                        </div>
                        <div class="hero-ticker-item" aria-hidden="true">
                            <span class="ticker-pair">ETH/USD</span>
                            <span class="ticker-price">$3,452.10</span>
                            <span class="ticker-change up"><i class="ti ti-arrow-up-right"></i>+1.85%</span>
                        </div>
                        <div class="hero-ticker-item" aria-hidden="true">
                            <span class="ticker-pair">EUR/USD</span>
                            <span class="ticker-price">1.0894</span>
                            <span class="ticker-change up"><i class="ti ti-arrow-up-right"></i>+0.12%</span>
                        </div>
                        <div class="hero-ticker-item" aria-hidden="true">
                            <span class="ticker-pair">SOL/USD</span>
                            <span class="ticker-price">$154.20</span>
                            <span class="ticker-change up"><i class="ti ti-arrow-up-right"></i>+3.45%</span>
                        </div>
                        <div class="hero-ticker-item" aria-hidden="true">
                            <span class="ticker-pair">GBP/USD</span>
                            <span class="ticker-price">1.2945</span>
                            <span class="ticker-change up"><i class="ti ti-arrow-up-right"></i>+0.22%</span>
                        </div>
                        <div class="hero-ticker-item" aria-hidden="true">
                            <span class="ticker-pair">XAU/USD</span>
                            <span class="ticker-price">$2,648.80</span>
                            <span class="ticker-change up"><i class="ti ti-arrow-up-right"></i>+0.65%</span>
                        </div>
                        <div class="hero-ticker-item" aria-hidden="true">
                            <span class="ticker-pair">USD/JPY</span>
                            <span class="ticker-price">154.12</span>
                            <span class="ticker-change down"><i class="ti ti-arrow-down-right"></i>-0.18%</span>
                        </div>
                        <div class="hero-ticker-item" aria-hidden="true">
                            <span class="ticker-pair">BNB/USD</span>
                            <span class="ticker-price">$578.30</span>
                            <span class="ticker-change up"><i class="ti ti-arrow-up-right"></i>+0.95%</span>
                        </div>
                        <div class="hero-ticker-item" aria-hidden="true">
                            <span class="ticker-pair">NASDAQ</span>
                            <span class="ticker-price">18,245.80</span>
                            <span class="ticker-change up"><i class="ti ti-arrow-up-right"></i>+0.72%</span>
                        </div>
                        <div class="hero-ticker-item" aria-hidden="true">
                            <span class="ticker-pair">S&P 500</span>
                            <span class="ticker-price">5,862.10</span>
                            <span class="ticker-change up"><i class="ti ti-arrow-up-right"></i>+0.48%</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row align-items-lg-start align-items-center">
                <!-- Left Column: Hero Content -->
                <div class="col-12 col-lg-7">
                    <div class="hero__content hero__content--first">
                        <div class="hero-pill-badge">
                            <i class="ti ti-shield-lock"></i> Next-Gen Asset Defense & Arbitrage
                        </div>

                        <h1 class="hero__title">
                            Protecting Your Assets Through <span class="text-gradient-cyan" style="display: inline-block; padding-right: 0.12em;">Market-Neutral</span> Intelligence
                        </h1>

                        <p class="hero__text">
                            Shield your capital from exchange insolvency, counterparty speculation, and extreme market volatility.
                        </p>

                        <!-- Action Buttons -->
                        <div class="hero__btns">
                            <a href="{{ url('/register') }}" class="btn-hero-primary">
                                <i class="ti ti-shield-check" style="font-size: 20px;"></i>
                                <span>Open Protected Account</span>
                            </a>
                            <a href="#security" class="btn-hero-secondary">
                                <i class="ti ti-alert-triangle" style="font-size: 20px; color: #EF4444;"></i>
                                <span>Why We Started (The FTX Lesson)</span>
                            </a>
                        </div>

                        <!-- Micro Trust Highlights -->
                        <div class="row mt-4 pt-3 g-3">
                            <div class="col-12 col-sm-4">
                                <div class="hero-micro-card">
                                    <div class="icon-box" style="background: rgba(var(--theme-primary-rgb, 214, 28, 78), 0.1); color: var(--theme-primary, #D61C4E); border: 1px solid rgba(var(--theme-primary-rgb, 214, 28, 78), 0.25);">
                                        <i class="ti ti-lock"></i>
                                    </div>
                                    <div>
                                        <div class="hero-micro-title">100% Segregated</div>
                                        <div class="hero-micro-desc">Isolated Cold Vaults</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="hero-micro-card">
                                    <div class="icon-box" style="background: rgba(16, 185, 129, 0.1); color: #10B981; border: 1px solid rgba(16, 185, 129, 0.25);">
                                        <i class="ti ti-chart-arrows-vertical"></i>
                                    </div>
                                    <div>
                                        <div class="hero-micro-title">Market-Neutral</div>
                                        <div class="hero-micro-desc">Zero Directional Risk</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="hero-micro-card">
                                    <div class="icon-box" style="background: rgba(245, 158, 11, 0.1); color: #F59E0B; border: 1px solid rgba(245, 158, 11, 0.25);">
                                        <i class="ti ti-certificate"></i>
                                    </div>
                                    <div>
                                        <div class="hero-micro-title">Live Solvency</div>
                                        <div class="hero-micro-desc">Audited 1:1 Reserves</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Modern Telemetry HUD Card -->
                <div class="col-12 col-lg-5 mt-4 mt-lg-0">
                    <div class="sentinel-hud-card">
                        <!-- Top HUD Bar -->
                        <div class="hud-top-bar">
                            <div class="hud-status-live">
                                <span class="pulse-dot"></span>
                                <span>DEFENSE SENTINEL: ARMED</span>
                            </div>
                            <span class="hud-badge-tech">TLS 1.3 | AES-256</span>
                        </div>

                        <div style="margin-bottom: 12px;">
                            <h3 style="font-size: 21px; font-weight: 800; margin-bottom: 6px; letter-spacing: -0.3px;">
                                Asset Defense Sentinel
                            </h3>
                            <p style="font-size: 13.5px; line-height: 1.6; margin: 0;">
                                Continuous algorithmic surveillance of cross-exchange order books and counterparty liquidity to preserve capital.
                            </p>
                        </div>

                        <!-- Subtle 3D Holographic Cryptographic Core -->
                        <div id="hero-3d-emblem" style="width: 100%; height: 185px; position: relative; display: flex; align-items: center; justify-content: center; overflow: hidden; margin: 6px 0 14px 0;"></div>

                        <!-- 4 High-Tech Metrics Grid -->
                        <div class="hud-metric-row">
                            <div class="hud-metric-box">
                                <div class="val" style="color: #10B981;">100% Backed</div>
                                <div class="label">Vault Reserve Ratio</div>
                            </div>
                            <div class="hud-metric-box">
                                <div class="val" style="color: #00E5FF;">99.8% Neutral</div>
                                <div class="label">Delta Market Hedge</div>
                            </div>
                            <div class="hud-metric-box">
                                <div class="val">24 / 24 Online</div>
                                <div class="label">Active Arbitrage Nodes</div>
                            </div>
                            <div class="hud-metric-box">
                                <div class="val" style="color: #F59E0B;">0.00% Breaches</div>
                                <div class="label">Historical Solvency</div>
                            </div>
                        </div>

                        <!-- Animated Live Reserve Bar -->
                        <div class="hud-reserve-box" style="border-radius: 12px; padding: 14px; margin-bottom: 20px;">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                                <span class="hud-reserve-title" style="font-size: 12px; font-weight: 600;">Audited Reserve Pool Balance</span>
                                <span style="font-size: 12px; font-weight: 700; color: #10B981;">1:1 Segregated</span>
                            </div>
                            <div class="track" style="height: 8px; border-radius: 4px; overflow: hidden;">
                                <div style="width: 100%; height: 100%; background: linear-gradient(90deg, #10B981 0%, #00E5FF 100%); border-radius: 4px; box-shadow: 0 0 12px rgba(0, 229, 255, 0.5);"></div>
                            </div>
                            <div style="display: flex; justify-content: space-between; font-size: 11px; margin-top: 6px;">
                                <span class="text-adaptive-muted">Proof: 0x7e8b...4f91 (Verified)</span>
                                <span style="color: #10B981; font-weight: 600;">Zero Custodial Leverage</span>
                            </div>
                        </div>

                        <!-- Card Action -->
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <i class="ti ti-fingerprint" style="font-size: 26px; color: #00E5FF;"></i>
                                <div>
                                    <div class="hud-vault-text" style="font-size: 12.5px; font-weight: 700;">Biometric Vault Access</div>
                                    <div class="text-adaptive-muted" style="font-size: 11px;">Multi-Sig Hardware Key</div>
                                </div>
                            </div>
                            <a href="{{ url('/register') }}" class="btn-getstarted-modern" style="padding: 10px 20px; font-size: 13px;">
                                <span>Activate Defense</span>
                                <i class="ti ti-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ==================== END HERO SECTION ==================== -->


    <!-- ==================== FTX COLLAPSE STORYLINE & FOUNDING REASON ==================== -->
    <section class="section" id="security" style="padding-top: 60px;">
        <div class="container">
            <!-- Section Header -->
            <div class="row">
                <div class="col-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2">
                    <div class="section__title text-center">
                        <div class="hero-pill-badge" style="background: rgba(239, 68, 68, 0.12); border-color: rgba(239, 68, 68, 0.4); color: #EF4444; margin-bottom: 16px;">
                            <i class="ti ti-alert-triangle"></i> The Defining Turning Point
                        </div>
                        <h2>The FTX Collapse & <span class="text-gradient-crimson">Why We Started</span></h2>
                        <p>How the greatest crisis in cryptocurrency history inspired our non-negotiable mission: uncompromised asset protection and transparent, market-neutral investing.</p>
                    </div>
                </div>
            </div>

            <!-- Narrative Card -->
            <div class="row row--relative mt-2">
                <div class="col-12">
                    <div class="ftx-story-card">
                        <div class="row align-items-center">
                            <!-- Story Narrative Left -->
                            <div class="col-12 col-lg-7">
                                <div class="d-inline-flex align-items-center gap-2 px-3 py-1 mb-3 rounded-pill" style="background: rgba(239, 68, 68, 0.15); border: 1px solid rgba(239, 68, 68, 0.35); font-size: 12px; color: #EF4444; font-weight: 700;">
                                    <i class="ti ti-calendar-event"></i> November 2022 Crisis Dossier
                                </div>

                                <h3 style="font-size: 26px; font-weight: 800; margin-bottom: 18px; letter-spacing: -0.4px;">
                                    When Centralized Trust Failed, We Built Verifiable Security
                                </h3>

                                <p class="about__text" style="font-size: 15.5px; line-height: 1.75; margin-bottom: 16px;">
                                    In November 2022, the crypto world witnessed the catastrophic fall of FTX. In less than 72 hours, over <strong style="color: #EF4444;">$8 Billion</strong> in innocent user capital vanished. Customers were locked out, life savings were wiped clean, and millions learned the devastating lesson of centralized counterparty risk.
                                </p>

                                <p class="about__text" style="font-size: 15px; line-height: 1.75; margin-bottom: 16px;">
                                    The root cause was not blockchain technology—it was unchecked human greed, commingling client deposits with speculative hedge funds (Alameda Research), and reckless directional gambles conducted behind closed doors.
                                </p>

                                <p class="about__text" style="font-size: 15px; line-height: 1.75;">
                                    <strong>{{ $settings->site_name }} was conceived in direct response to this disaster.</strong> We asked a fundamental question: <em>Why should investors risk their hard-earned assets with black-box custodians when mathematical arbitrage and non-custodial risk controls can deliver secure, predictable yields without directional market exposure?</em>
                                </p>

                                <div class="mt-4 pt-2">
                                    <div style="display: flex; align-items: center; gap: 16px; flex-wrap: wrap;">
                                        <div style="display: flex; align-items: center; color: #10B981; font-weight: 700; font-size: 14px;">
                                            <i class="ti ti-circle-check me-1" style="font-size: 19px;"></i> No Fund Commingling
                                        </div>
                                        <div style="display: flex; align-items: center; color: #10B981; font-weight: 700; font-size: 14px;">
                                            <i class="ti ti-circle-check me-1" style="font-size: 19px;"></i> Zero Directional Gambling
                                        </div>
                                        <div style="display: flex; align-items: center; color: #10B981; font-weight: 700; font-size: 14px;">
                                            <i class="ti ti-circle-check me-1" style="font-size: 19px;"></i> Pure Arbitrage Discipline
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Comparison Box Right -->
                            <div class="col-12 col-lg-5 mt-4 mt-lg-0">
                                <div class="ftx-contrast-box">
                                    <!-- The Opaque Exchange Flaw -->
                                    <div class="ftx-flaw-box mb-3">
                                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                                            <span style="color: #EF4444; font-weight: 800; font-size: 13.5px; text-transform: uppercase; letter-spacing: 0.5px;">
                                                <i class="ti ti-alert-triangle me-1"></i> The Opaque Model (FTX, Celsius)
                                            </span>
                                            <span style="font-size: 11px; color: #EF4444; background: rgba(239, 68, 68, 0.12); padding: 3px 8px; border-radius: 6px; font-weight: 700;">Fatal Flaw</span>
                                        </div>
                                        <ul style="list-style: none; padding: 0; margin: 0; font-size: 13.5px; line-height: 1.6;">
                                            <li class="mb-2" style="display: flex; align-items: flex-start;">
                                                <i class="ti ti-ban text-danger me-2" style="font-size: 17px; margin-top: 1px;"></i> Customer funds secretly used as collateral
                                            </li>
                                            <li class="mb-2" style="display: flex; align-items: flex-start;">
                                                <i class="ti ti-ban text-danger me-2" style="font-size: 17px; margin-top: 1px;"></i> Speculative trading desks gambling on market direction
                                            </li>
                                            <li style="display: flex; align-items: flex-start;">
                                                <i class="ti ti-ban text-danger me-2" style="font-size: 17px; margin-top: 1px;"></i> Sudden withdrawal freezes when panic strikes
                                            </li>
                                        </ul>
                                    </div>

                                    <!-- The New Paradigm -->
                                    <div class="ftx-paradigm-box">
                                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                                            <span style="color: #10B981; font-weight: 800; font-size: 13.5px; text-transform: uppercase; letter-spacing: 0.5px;">
                                                <i class="ti ti-shield-check me-1"></i> The {{ $settings->site_name }} Paradigm
                                            </span>
                                            <span style="font-size: 11px; color: #10B981; background: rgba(16, 185, 129, 0.12); padding: 3px 8px; border-radius: 6px; font-weight: 700;">Zero-Trust</span>
                                        </div>
                                        <ul style="list-style: none; padding: 0; margin: 0; font-size: 13.5px; line-height: 1.6;">
                                            <li class="mb-2" style="display: flex; align-items: flex-start;">
                                                <i class="ti ti-shield-check text-success me-2" style="font-size: 17px; margin-top: 1px;"></i> Strict 1:1 asset backing in segregated cold vaults
                                            </li>
                                            <li class="mb-2" style="display: flex; align-items: flex-start;">
                                                <i class="ti ti-shield-check text-success me-2" style="font-size: 17px; margin-top: 1px;"></i> Market-neutral algorithmic arbitrage (never directional)
                                            </li>
                                            <li style="display: flex; align-items: flex-start;">
                                                <i class="ti ti-shield-check text-success me-2" style="font-size: 17px; margin-top: 1px;"></i> Real-time verifiable liquidity and continuous withdrawals
                                            </li>
                                        </ul>
                                    </div>

                                    <!-- Subtle 3D Gyroscopic Vault Core -->
                                    <div class="mt-3 pt-3" style="border-top: 1px solid rgba(255, 255, 255, 0.08); text-align: center;">
                                        <div style="font-size: 11px; text-transform: uppercase; letter-spacing: 0.8px; color: #10B981; font-weight: 700; margin-bottom: 6px;">
                                            <i class="ti ti-shield-lock me-1"></i> Live Cryptographic Vault Node
                                        </div>
                                        <div id="security-3d-vault" style="width: 100%; height: 180px; position: relative; display: flex; align-items: center; justify-content: center; overflow: hidden;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 4 Founding Security Pillars Grid -->
                        <div class="row mt-4 pt-3 border-top" style="border-color: rgba(255,255,255,0.08) !important;">
                            <div class="col-12 col-md-6 col-xl-3 mt-3">
                                <div class="ftx-pillar-box" style="border-radius: 14px; padding: 22px; height: 100%; transition: transform 0.3s ease;">
                                    <div style="color: #F59E0B; font-size: 28px; margin-bottom: 12px;"><i class="ti ti-lock-access"></i></div>
                                    <h4 style="font-size: 16.5px; font-weight: 700; margin-bottom: 8px;">Zero Rehypothecation</h4>
                                    <p style="font-size: 13.5px; margin: 0; line-height: 1.65;">Your assets are never lent, leveraged, or loaned to third parties. Your deposited capital remains strictly ring-fenced.</p>
                                </div>
                            </div>

                            <div class="col-12 col-md-6 col-xl-3 mt-3">
                                <div class="ftx-pillar-box" style="border-radius: 14px; padding: 22px; height: 100%; transition: transform 0.3s ease;">
                                    <div style="color: #10B981; font-size: 28px; margin-bottom: 12px;"><i class="ti ti-arrows-cross"></i></div>
                                    <h4 style="font-size: 16.5px; font-weight: 700; margin-bottom: 8px;">Market-Neutral Yield</h4>
                                    <p style="font-size: 13.5px; margin: 0; line-height: 1.65;">Returns are calculated purely from cross-exchange orderbook price discrepancies—not speculative coin pumps or dumps.</p>
                                </div>
                            </div>

                            <div class="col-12 col-md-6 col-xl-3 mt-3">
                                <div class="ftx-pillar-box" style="border-radius: 14px; padding: 22px; height: 100%; transition: transform 0.3s ease;">
                                    <div style="color: #00E5FF; font-size: 28px; margin-bottom: 12px;"><i class="ti ti-file-certificate"></i></div>
                                    <h4 style="font-size: 16.5px; font-weight: 700; margin-bottom: 8px;">Cryptographic Solvency</h4>
                                    <p style="font-size: 13.5px; margin: 0; line-height: 1.65;">Audited balance proofs and automated ledger monitoring guarantee total transparency and solvency across all reserves.</p>
                                </div>
                            </div>

                            <div class="col-12 col-md-6 col-xl-3 mt-3">
                                <div class="ftx-pillar-box" style="border-radius: 14px; padding: 22px; height: 100%; transition: transform 0.3s ease;">
                                    <div style="color: #A855F7; font-size: 28px; margin-bottom: 12px;"><i class="ti ti-shield-lock"></i></div>
                                    <h4 style="font-size: 16.5px; font-weight: 700; margin-bottom: 8px;">Instant Liquidity Access</h4>
                                    <p style="font-size: 13.5px; margin: 0; line-height: 1.65;">Maintain sovereignty over your wealth. Automated payout pipelines ensure you can withdraw capital without artificial delays.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ==================== END FTX STORYLINE ==================== -->


    <!-- ==================== PERFORMANCE & SECURITY STATISTICS ==================== -->
    <div class="section pt-0 pb-4">
        <div class="container">
            <div class="row g-3">
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="stats">
                        <span class="stats__value">1,840+</span>
                        <p class="stats__name">Days Operating Securely</p>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="stats">
                        <span class="stats__value">{{ number_format($total_users ?? 5812) }}+</span>
                        <p class="stats__name">Protected Investors</p>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="stats">
                        <span class="stats__value">{{ !empty($total_deposits[0]->total) ? '$' . number_format($total_deposits[0]->total) : '$1.36B+' }}</span>
                        <p class="stats__name">Secured Volume Executed</p>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="stats">
                        <span class="stats__value" style="color: #10B981 !important; -webkit-text-fill-color: #10B981 !important;">0.00%</span>
                        <p class="stats__name">Historical Asset Losses</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ==================== END STATISTICS ==================== -->


    <!-- ==================== ASSET PROTECTION PILLARS ==================== -->
    <section class="section" id="features">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2">
                    <div class="section__title text-center">
                        <div class="hero-pill-badge" style="margin-bottom: 16px;">
                            <i class="ti ti-shield-check"></i> Non-Custodial Core
                        </div>
                        <h2>Institutional Asset Protection</h2>
                        <p>Our architecture replaces blind faith with deterministic algorithms, ensuring your capital is protected against both external market crashes and internal custodian insolvency.</p>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                <!-- Feature 1: Safety & Isolation -->
                <div class="col-12 col-lg-4">
                    <div class="feature h-100 p-4">
                        <div class="neon-feature-icon neon-feature-icon--cyan">
                            <i class="ti ti-shield-dollar"></i>
                        </div>
                        <h3 class="feature__title" style="font-size: 20px; font-weight: 700; margin-bottom: 12px;">Non-Custodial Isolation</h3>
                        <p class="feature__text" style="font-size: 14.5px; line-height: 1.7; margin: 0;">Your capital is isolated in multi-signature vault architecture with biometric access layers. We never hold unilateral access to liquidate or freeze your assets.</p>
                    </div>
                </div>

                <!-- Feature 2: Automatization -->
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="feature h-100 p-4">
                        <div class="neon-feature-icon neon-feature-icon--emerald">
                            <i class="ti ti-cpu"></i>
                        </div>
                        <h3 class="feature__title" style="font-size: 20px; font-weight: 700; margin-bottom: 12px;">Sub-Millisecond Arbitrage</h3>
                        <p class="feature__text" style="font-size: 14.5px; line-height: 1.7; margin: 0;">Our neural trading nodes simultaneously scan order books across 15+ tier-1 exchanges, executing instantaneous spread trades with zero overnight holding risk.</p>
                    </div>
                </div>

                <!-- Feature 3: Real-Time Solvency -->
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="feature h-100 p-4">
                        <div class="neon-feature-icon neon-feature-icon--blue">
                            <i class="ti ti-chart-histogram"></i>
                        </div>
                        <h3 class="feature__title" style="font-size: 20px; font-weight: 700; margin-bottom: 12px;">Continuous Auditability</h3>
                        <p class="feature__text" style="font-size: 14.5px; line-height: 1.7; margin: 0;">Every trade and reserve balance is cryptographically logged in real time. Experience total transparency with full visibility into how your capital performs.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ==================== END ASSET PROTECTION PILLARS ==================== -->


    <!-- ==================== LIVE ARBITRAGE ENGINE & RECENT DEALS ==================== -->
    <section class="section" id="arbitrage">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2">
                    <div class="section__title text-center">
                        <div class="hero-pill-badge" style="background: rgba(16, 185, 129, 0.1); border-color: rgba(16, 185, 129, 0.35); color: #10B981; margin-bottom: 16px;">
                            <i class="ti ti-activity"></i> Real-Time Telemetry
                        </div>
                        <h2>Live Arbitrage Execution Engine</h2>
                        <p>Witness real-time arbitrage deals closed across global exchanges. Yield is captured from cross-venue price spreads rather than speculative token holding.</p>
                    </div>
                </div>

                <!-- Deals Table Wrap -->
                <div class="col-12">
                    <div class="deals p-3 p-md-4">
                        <!-- Mobile View Switcher & Live Header (Visible on mobile < 768px) -->
                        <div class="d-flex d-md-none justify-content-between align-items-center mb-3 pb-2 border-bottom" style="border-color: rgba(255,255,255,0.08) !important;">
                            <div class="d-flex align-items-center gap-2">
                                <span class="pulse-dot" style="width: 8px; height: 8px;"></span>
                                <span style="font-size: 11.5px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;" class="text-adaptive-secondary">Live Telemetry</span>
                            </div>
                            <div class="deals-view-switch">
                                <button type="button" class="deals-view-btn active" id="btnViewCards" onclick="toggleDealsView('cards')">
                                    <i class="ti ti-layout-cards me-1"></i> Cards
                                </button>
                                <button type="button" class="deals-view-btn" id="btnViewTable" onclick="toggleDealsView('table')">
                                    <i class="ti ti-table me-1"></i> Table
                                </button>
                            </div>
                        </div>

                        <!-- Mobile Cards View (Default on Mobile) -->
                        <div id="dealsMobileCards" class="d-block d-md-none">
                            <!-- Card 1 -->
                            <div class="deal-mobile-card">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="deal-mobile-pair">BTC/USDT</span>
                                        <span class="badge" style="background: rgba(16, 185, 129, 0.15); color: #10B981; border: 1px solid rgba(16, 185, 129, 0.3); font-size: 10.5px; padding: 3px 7px;">Executed</span>
                                    </div>
                                    <span class="deal-mobile-time"><i class="ti ti-clock me-1"></i>Just now</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <div class="deals__exchange">
                                        <span class="badge" style="background: rgba(243, 186, 47, 0.15); color: #F3BA2F; border: 1px solid rgba(243, 186, 47, 0.3); font-size: 11px; padding: 4px 8px;">Binance</span>
                                        <i class="ti ti-arrow-right mx-1 text-muted"></i>
                                        <span class="badge" style="background: rgba(142, 68, 173, 0.15); color: #C084FC; border: 1px solid rgba(142, 68, 173, 0.3); font-size: 11px; padding: 4px 8px;">Kraken</span>
                                    </div>
                                    <span class="deal-mobile-spread">+0.29%</span>
                                </div>
                                <div class="deal-mobile-stats">
                                    <div>
                                        <span class="deal-stat-label">Buy Venue</span>
                                        <span class="deal-stat-val text-buy">$64,120.50</span>
                                    </div>
                                    <div>
                                        <span class="deal-stat-label">Sell Venue</span>
                                        <span class="deal-stat-val text-sell">$64,310.80</span>
                                    </div>
                                    <div>
                                        <span class="deal-stat-label">Protected Vol</span>
                                        <span class="deal-stat-val">$14,250</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Card 2 -->
                            <div class="deal-mobile-card">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="deal-mobile-pair">ETH/USDT</span>
                                        <span class="badge" style="background: rgba(16, 185, 129, 0.15); color: #10B981; border: 1px solid rgba(16, 185, 129, 0.3); font-size: 10.5px; padding: 3px 7px;">Executed</span>
                                    </div>
                                    <span class="deal-mobile-time"><i class="ti ti-clock me-1"></i>1 min ago</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <div class="deals__exchange">
                                        <span class="badge" style="background: rgba(47, 128, 237, 0.15); color: #2F80ED; border: 1px solid rgba(47, 128, 237, 0.3); font-size: 11px; padding: 4px 8px;">OKX</span>
                                        <i class="ti ti-arrow-right mx-1 text-muted"></i>
                                        <span class="badge" style="background: rgba(0, 82, 255, 0.15); color: #38BDF8; border: 1px solid rgba(0, 82, 255, 0.3); font-size: 11px; padding: 4px 8px;">Coinbase</span>
                                    </div>
                                    <span class="deal-mobile-spread">+0.34%</span>
                                </div>
                                <div class="deal-mobile-stats">
                                    <div>
                                        <span class="deal-stat-label">Buy Venue</span>
                                        <span class="deal-stat-val text-buy">$3,452.10</span>
                                    </div>
                                    <div>
                                        <span class="deal-stat-label">Sell Venue</span>
                                        <span class="deal-stat-val text-sell">$3,463.80</span>
                                    </div>
                                    <div>
                                        <span class="deal-stat-label">Protected Vol</span>
                                        <span class="deal-stat-val">$8,900</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Card 3 -->
                            <div class="deal-mobile-card">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="deal-mobile-pair">SOL/USDT</span>
                                        <span class="badge" style="background: rgba(16, 185, 129, 0.15); color: #10B981; border: 1px solid rgba(16, 185, 129, 0.3); font-size: 10.5px; padding: 3px 7px;">Executed</span>
                                    </div>
                                    <span class="deal-mobile-time"><i class="ti ti-clock me-1"></i>3 mins ago</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <div class="deals__exchange">
                                        <span class="badge" style="background: rgba(16, 185, 129, 0.15); color: #10B981; border: 1px solid rgba(16, 185, 129, 0.3); font-size: 11px; padding: 4px 8px;">Bitfinex</span>
                                        <i class="ti ti-arrow-right mx-1 text-muted"></i>
                                        <span class="badge" style="background: rgba(243, 186, 47, 0.15); color: #F3BA2F; border: 1px solid rgba(243, 186, 47, 0.3); font-size: 11px; padding: 4px 8px;">Binance</span>
                                    </div>
                                    <span class="deal-mobile-spread">+0.42%</span>
                                </div>
                                <div class="deal-mobile-stats">
                                    <div>
                                        <span class="deal-stat-label">Buy Venue</span>
                                        <span class="deal-stat-val text-buy">$152.30</span>
                                    </div>
                                    <div>
                                        <span class="deal-stat-label">Sell Venue</span>
                                        <span class="deal-stat-val text-sell">$152.95</span>
                                    </div>
                                    <div>
                                        <span class="deal-stat-label">Protected Vol</span>
                                        <span class="deal-stat-val">$5,620</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Card 4 -->
                            <div class="deal-mobile-card">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="deal-mobile-pair">BNB/USDT</span>
                                        <span class="badge" style="background: rgba(16, 185, 129, 0.15); color: #10B981; border: 1px solid rgba(16, 185, 129, 0.3); font-size: 10.5px; padding: 3px 7px;">Executed</span>
                                    </div>
                                    <span class="deal-mobile-time"><i class="ti ti-clock me-1"></i>5 mins ago</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <div class="deals__exchange">
                                        <span class="badge" style="background: rgba(235, 87, 87, 0.15); color: #F87171; border: 1px solid rgba(235, 87, 87, 0.3); font-size: 11px; padding: 4px 8px;">Gate.io</span>
                                        <i class="ti ti-arrow-right mx-1 text-muted"></i>
                                        <span class="badge" style="background: rgba(0, 229, 255, 0.15); color: #00E5FF; border: 1px solid rgba(0, 229, 255, 0.3); font-size: 11px; padding: 4px 8px;">Bitget</span>
                                    </div>
                                    <span class="deal-mobile-spread">+0.24%</span>
                                </div>
                                <div class="deal-mobile-stats">
                                    <div>
                                        <span class="deal-stat-label">Buy Venue</span>
                                        <span class="deal-stat-val text-buy">$574.80</span>
                                    </div>
                                    <div>
                                        <span class="deal-stat-label">Sell Venue</span>
                                        <span class="deal-stat-val text-sell">$576.20</span>
                                    </div>
                                    <div>
                                        <span class="deal-stat-label">Protected Vol</span>
                                        <span class="deal-stat-val">$6,100</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Full Desktop / Scrollable Mobile Table -->
                        <div class="deals__table-wrap d-none d-md-block" id="dealsTableWrap">
                            <div class="d-md-none text-center mb-3 py-1 px-2 rounded" style="background: rgba(0, 229, 255, 0.06); border: 1px dashed rgba(0, 229, 255, 0.25); font-size: 11.5px; color: #00E5FF;">
                                <i class="ti ti-arrows-left-right me-1"></i> Swipe horizontally to view all 8 telemetry metrics
                            </div>
                            <table class="deals__table">
                                <thead>
                                    <tr>
                                        <th>Trading Pair</th>
                                        <th>Arbitrage Route</th>
                                        <th>Timestamp</th>
                                        <th>Buy Venue</th>
                                        <th>Sell Venue</th>
                                        <th>Protected Volume</th>
                                        <th>Net Spread</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><div class="deals__text font-weight-bold" style="font-weight: 700;">BTC/USDT</div></td>
                                        <td>
                                             <div class="deals__exchange">
                                                <span class="badge" style="background: rgba(243, 186, 47, 0.15); color: #F3BA2F; border: 1px solid rgba(243, 186, 47, 0.3); font-size: 12px; padding: 4px 8px;">Binance</span>
                                                <i class="ti ti-arrow-right mx-1 text-muted"></i>
                                                <span class="badge" style="background: rgba(142, 68, 173, 0.15); color: #C084FC; border: 1px solid rgba(142, 68, 173, 0.3); font-size: 12px; padding: 4px 8px;">Kraken</span>
                                            </div>
                                        </td>
                                        <td><div class="deals__text text-adaptive-muted">Just now</div></td>
                                        <td><div class="deals__text deals__text--buy" style="font-weight: 600;">$64,120.50</div></td>
                                        <td><div class="deals__text deals__text--sell" style="font-weight: 600;">$64,310.80</div></td>
                                        <td><div class="deals__text font-weight-bold">$14,250</div></td>
                                        <td><div class="deals__text deals__text--green" style="font-weight: 700;">+0.29%</div></td>
                                        <td><span class="badge" style="background: rgba(16, 185, 129, 0.15); color: #10B981; border: 1px solid rgba(16, 185, 129, 0.3); font-size: 11px; padding: 4px 8px;">Executed</span></td>
                                    </tr>

                                    <tr>
                                        <td><div class="deals__text font-weight-bold" style="font-weight: 700;">ETH/USDT</div></td>
                                        <td>
                                            <div class="deals__exchange">
                                                <span class="badge" style="background: rgba(47, 128, 237, 0.15); color: #2F80ED; border: 1px solid rgba(47, 128, 237, 0.3); font-size: 12px; padding: 4px 8px;">OKX</span>
                                                <i class="ti ti-arrow-right mx-1 text-muted"></i>
                                                <span class="badge" style="background: rgba(0, 82, 255, 0.15); color: #38BDF8; border: 1px solid rgba(0, 82, 255, 0.3); font-size: 12px; padding: 4px 8px;">Coinbase</span>
                                            </div>
                                        </td>
                                        <td><div class="deals__text text-adaptive-muted">1 min ago</div></td>
                                        <td><div class="deals__text deals__text--buy" style="font-weight: 600;">$3,452.10</div></td>
                                        <td><div class="deals__text deals__text--sell" style="font-weight: 600;">$3,463.80</div></td>
                                        <td><div class="deals__text font-weight-bold">$8,900</div></td>
                                        <td><div class="deals__text deals__text--green" style="font-weight: 700;">+0.34%</div></td>
                                        <td><span class="badge" style="background: rgba(16, 185, 129, 0.15); color: #10B981; border: 1px solid rgba(16, 185, 129, 0.3); font-size: 11px; padding: 4px 8px;">Executed</span></td>
                                    </tr>

                                    <tr>
                                        <td><div class="deals__text font-weight-bold" style="font-weight: 700;">SOL/USDT</div></td>
                                        <td>
                                            <div class="deals__exchange">
                                                <span class="badge" style="background: rgba(16, 185, 129, 0.15); color: #10B981; border: 1px solid rgba(16, 185, 129, 0.3); font-size: 12px; padding: 4px 8px;">Bitfinex</span>
                                                <i class="ti ti-arrow-right mx-1 text-muted"></i>
                                                <span class="badge" style="background: rgba(243, 186, 47, 0.15); color: #F3BA2F; border: 1px solid rgba(243, 186, 47, 0.3); font-size: 12px; padding: 4px 8px;">Binance</span>
                                            </div>
                                        </td>
                                        <td><div class="deals__text text-adaptive-muted">3 mins ago</div></td>
                                        <td><div class="deals__text deals__text--buy" style="font-weight: 600;">$152.30</div></td>
                                        <td><div class="deals__text deals__text--sell" style="font-weight: 600;">$152.95</div></td>
                                        <td><div class="deals__text font-weight-bold">$5,620</div></td>
                                        <td><div class="deals__text deals__text--green" style="font-weight: 700;">+0.42%</div></td>
                                        <td><span class="badge" style="background: rgba(16, 185, 129, 0.15); color: #10B981; border: 1px solid rgba(16, 185, 129, 0.3); font-size: 11px; padding: 4px 8px;">Executed</span></td>
                                    </tr>

                                    <tr>
                                        <td><div class="deals__text font-weight-bold" style="font-weight: 700;">BNB/USDT</div></td>
                                        <td>
                                            <div class="deals__exchange">
                                                <span class="badge" style="background: rgba(235, 87, 87, 0.15); color: #F87171; border: 1px solid rgba(235, 87, 87, 0.3); font-size: 12px; padding: 4px 8px;">Gate.io</span>
                                                <i class="ti ti-arrow-right mx-1 text-muted"></i>
                                                <span class="badge" style="background: rgba(0, 229, 255, 0.15); color: #00E5FF; border: 1px solid rgba(0, 229, 255, 0.3); font-size: 12px; padding: 4px 8px;">Bitget</span>
                                            </div>
                                        </td>
                                        <td><div class="deals__text text-adaptive-muted">5 mins ago</div></td>
                                        <td><div class="deals__text deals__text--buy" style="font-weight: 600;">$574.80</div></td>
                                        <td><div class="deals__text deals__text--sell" style="font-weight: 600;">$576.20</div></td>
                                        <td><div class="deals__text font-weight-bold">$6,100</div></td>
                                        <td><div class="deals__text deals__text--green" style="font-weight: 700;">+0.24%</div></td>
                                        <td><span class="badge" style="background: rgba(16, 185, 129, 0.15); color: #10B981; border: 1px solid rgba(16, 185, 129, 0.3); font-size: 11px; padding: 4px 8px;">Executed</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-12 mt-4 text-center">
                    <a href="{{ url('/register') }}" class="btn-primary-modern">
                        <i class="ti ti-lock-access me-1"></i> Allocate Capital to Arbitrage Engine
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- ==================== END LIVE ARBITRAGE ENGINE ==================== -->


    <!-- ==================== HOW INVESTMENTS WORK (NO HOME PRICING CARDS) ==================== -->
    <section class="section" style="padding-top: 50px;">
        <div class="container">
            <div class="row g-4">
                <!-- Investment Approach Card -->
                <div class="col-12 col-lg-6">
                    <div class="invest h-100 p-4 p-md-5">
                        <div class="neon-feature-icon neon-feature-icon--cyan">
                            <i class="ti ti-database-dollar"></i>
                        </div>

                        <h3 style="font-size: 24px; font-weight: 800; margin-bottom: 16px;">
                            Market-Neutral Investment Strategy
                        </h3>

                        <p style="font-size: 15px; line-height: 1.7; margin-bottom: 24px;">
                            Unlike speculative buy-and-hold funds that crash when the cryptocurrency market enters a bear cycle, our investment portfolios are mathematically hedged for continuous capital preservation:
                        </p>

                        <div class="d-flex flex-column gap-3 mb-4">
                            <div class="d-flex align-items-start gap-3">
                                <i class="ti ti-checks text-success" style="font-size: 20px; margin-top: 2px;"></i>
                                <div>
                                    <strong style="font-size: 14.5px;">Simultaneous Order Execution:</strong>
                                    <p style="font-size: 13.5px; margin: 2px 0 0 0;">Buying and selling occur simultaneously within milliseconds, eliminating open market exposure duration.</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-start gap-3">
                                <i class="ti ti-checks text-success" style="font-size: 20px; margin-top: 2px;"></i>
                                <div>
                                    <strong style="font-size: 14.5px;">Automated Compounding Architecture:</strong>
                                    <p style="font-size: 13.5px; margin: 2px 0 0 0;">Daily realized arbitrage profits can be automatically reinvested into active high-frequency liquidity pools.</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-start gap-3">
                                <i class="ti ti-checks text-success" style="font-size: 20px; margin-top: 2px;"></i>
                                <div>
                                    <strong style="font-size: 14.5px;">Zero Rehypothecation Guarantee:</strong>
                                    <p style="font-size: 13.5px; margin: 2px 0 0 0;">Strict stop-loss parameters and ring-fenced cold reserves ensure your principal is shielded from counterparty failure.</p>
                                </div>
                            </div>
                        </div>

                        <div class="pt-3 border-top" style="border-color: rgba(255,255,255,0.08) !important;">
                            <a href="{{ url('/login') }}" class="btn-secondary-modern w-100">
                                View Investment Portfolios in Client Portal <i class="ti ti-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Risk Management Architecture -->
                <div class="col-12 col-lg-6">
                    <div class="invest h-100 p-4 p-md-5">
                        <div class="neon-feature-icon neon-feature-icon--emerald">
                            <i class="ti ti-shield-check"></i>
                        </div>

                        <h3 style="font-size: 24px; font-weight: 800; margin-bottom: 16px;">
                            Real-Time Solvency & Capital Shield
                        </h3>

                        <p style="font-size: 15px; line-height: 1.7; margin-bottom: 24px;">
                            Continuous surveillance and audited reserves ensure total insulation from centralized exchange insolvencies and black-swan crashes:
                        </p>

                        <!-- High Tech Reserve Meters -->
                        <div class="d-flex flex-column gap-3 mb-4">
                            <div class="invest-meter-box" style="border-radius: 14px; padding: 16px;">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="invest-meter-title" style="font-size: 13px; font-weight: 700;">Primary Vault Reserve Backing</span>
                                    <span style="font-size: 13px; font-weight: 700; color: #10B981;">100% (1:1 Ratio)</span>
                                </div>
                                <div class="invest-meter-track" style="height: 8px; border-radius: 4px; overflow: hidden;">
                                    <div style="width: 100%; height: 100%; background: linear-gradient(90deg, #10B981 0%, #00E5FF 100%); border-radius: 4px;"></div>
                                </div>
                            </div>

                            <div class="invest-meter-box" style="border-radius: 14px; padding: 16px;">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="invest-meter-title" style="font-size: 13px; font-weight: 700;">Market Delta Risk Insulation</span>
                                    <span style="font-size: 13px; font-weight: 700; color: #00E5FF;">99.8% Neutral</span>
                                </div>
                                <div class="invest-meter-track" style="height: 8px; border-radius: 4px; overflow: hidden;">
                                    <div style="width: 99.8%; height: 100%; background: linear-gradient(90deg, #00E5FF 0%, #2F80ED 100%); border-radius: 4px;"></div>
                                </div>
                            </div>

                            <div class="invest-solvency-pill d-flex justify-content-between align-items-center px-3 py-2 rounded">
                                <span style="font-size: 12.5px;"><i class="ti ti-certificate me-1 text-success"></i> Solvency Proof: 0x7e8b...4f91</span>
                                <span style="font-size: 11.5px; color: #10B981; font-weight: 700;">Verified Active</span>
                            </div>
                        </div>

                        <div class="pt-3 border-top" style="border-color: rgba(255,255,255,0.08) !important;">
                            <a href="{{ url('/register') }}" class="btn-primary-modern w-100">
                                Create Account to Access Portfolios <i class="ti ti-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ==================== END HOW INVESTMENTS WORK ==================== -->


    <!-- ==================== HOW TO GET STARTED (STEPS) ==================== -->
    <section class="section" id="how-it-works">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2">
                    <div class="section__title text-center">
                        <div class="hero-pill-badge" style="margin-bottom: 16px;">
                            <i class="ti ti-route"></i> Seamless Onboarding
                        </div>
                        <h2>How To Get Started</h2>
                        <p>Begin protecting your cryptocurrency capital and earning market-neutral yield in four straightforward steps.</p>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                <!-- Step 1 -->
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="step h-100">
                        <div class="step-number-badge">01</div>
                        <h3 class="step__title">Create Account</h3>
                        <p class="step__text">Register a private account on our secure platform. Activate 2FA hardware or authenticator app verification for uncompromised security.</p>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="step h-100">
                        <div class="step-number-badge">02</div>
                        <h3 class="step__title">Choose Allocation</h3>
                        <p class="step__text">Inside your private dashboard, explore institutional investment tiers and allocate capital to your preferred arbitrage strategy.</p>
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="step h-100">
                        <div class="step-number-badge">03</div>
                        <h3 class="step__title">Vault Protection</h3>
                        <p class="step__text">Your capital is safely placed into segregated cold storage vaults while neural algorithms execute non-directional arbitrage across order books.</p>
                    </div>
                </div>

                <!-- Step 4 -->
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="step h-100">
                        <div class="step-number-badge">04</div>
                        <h3 class="step__title">Realize Yield</h3>
                        <p class="step__text">Monitor real-time returns and daily arbitrage performance. Enjoy instant, unrestricted liquidity and automated fast withdrawals.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ==================== END HOW TO GET STARTED ==================== -->


    <!-- ==================== SUPPORTED EXCHANGES & LIQUIDITY ==================== -->
    <section class="section pt-0">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2">
                    <div class="section__title text-center">
                        <div class="hero-pill-badge" style="margin-bottom: 16px;">
                            <i class="ti ti-arrows-exchange"></i> Multi-Venue Liquidity
                        </div>
                        <h2>Global Liquidity Venues</h2>
                        <p>Our algorithms continuously execute across premier Tier-1 global exchanges and liquidity networks to exploit microsecond price inefficiencies.</p>
                    </div>
                </div>
            </div>

            <div class="row g-3">
                <div class="col-6 col-md-3">
                    <div class="partner text-center">
                        <img src="{{ asset('volkovdesign/img/partners/logo1.svg') }}" alt="Binance">
                        <p>Binance Liquidity</p>
                        <span style="font-size: 11px; color: #10B981; font-weight: 600;"><i class="ti ti-circle-filled" style="font-size: 7px;"></i> &lt; 1.2ms Latency</span>
                    </div>
                </div>

                <div class="col-6 col-md-3">
                    <div class="partner text-center">
                        <img src="{{ asset('volkovdesign/img/partners/logo2.svg') }}" alt="Coinbase">
                        <p>Coinbase Institutional</p>
                        <span style="font-size: 11px; color: #10B981; font-weight: 600;"><i class="ti ti-circle-filled" style="font-size: 7px;"></i> &lt; 1.8ms Latency</span>
                    </div>
                </div>

                <div class="col-6 col-md-3">
                    <div class="partner text-center">
                        <img src="{{ asset('volkovdesign/img/partners/logo3.svg') }}" alt="Kraken">
                        <p>Kraken Global</p>
                        <span style="font-size: 11px; color: #10B981; font-weight: 600;"><i class="ti ti-circle-filled" style="font-size: 7px;"></i> &lt; 1.5ms Latency</span>
                    </div>
                </div>

                <div class="col-6 col-md-3">
                    <div class="partner text-center">
                        <img src="{{ asset('volkovdesign/img/partners/logo4.svg') }}" alt="OKX">
                        <p>OKX Engine</p>
                        <span style="font-size: 11px; color: #10B981; font-weight: 600;"><i class="ti ti-circle-filled" style="font-size: 7px;"></i> &lt; 1.3ms Latency</span>
                    </div>
                </div>
            </div><br>

            <div class="row mt-4">
                <div class="col-12 text-center">
                    <p class="partner-disclaimer" style="font-size: 12px; max-width: 800px; margin: 0 auto;">
                        <i class="ti ti-info-circle me-1"></i> <em>Liquidity Disclaimer: All exchange logos and trademarks are property of their respective holders. Connectivity refers to external public API market routing and liquidity order book execution.</em>
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- ==================== END SUPPORTED EXCHANGES ==================== -->


    <!-- ==================== FREQUENTLY ASKED QUESTIONS ==================== -->
    <section class="section" id="faq">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2">
                    <div class="section__title text-center">
                        <div class="hero-pill-badge" style="margin-bottom: 16px;">
                            <i class="ti ti-help"></i> Transparency
                        </div>
                        <h2>Asset Security & FAQ</h2>
                        <p>Transparent answers about our post-FTX protection architecture, withdrawal liquidity, and investment mechanics.</p>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-12 col-lg-10">
                    <div class="accordion" id="accordionFaq">
                        <!-- FAQ 1 -->
                        <div class="accordion__card mb-3">
                            <button class="collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-1" aria-expanded="false" aria-controls="faq-1">
                                <span>How does {{ $settings->site_name }} prevent disasters like the FTX collapse?</span>
                                <i class="ti ti-chevron-down ms-2"></i>
                            </button>
                            <div id="faq-1" class="collapse" data-bs-parent="#accordionFaq">
                                <p>
                                    FTX collapsed because customer deposits were illegally commingled with Alameda Research and gambled on speculative directional trades. {{ $settings->site_name }} was specifically architected with a <strong>Zero-Trust policy</strong>: client capital is segregated in isolated multi-sig vaults, never rehypothecated or lent out, and trades are strictly market-neutral arbitrage with no directional risk.
                                </p>
                            </div>
                        </div>

                        <!-- FAQ 2 -->
                        <div class="accordion__card mb-3">
                            <button class="collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-2" aria-expanded="false" aria-controls="faq-2">
                                <span>Where can I view and purchase available investment plans?</span>
                                <i class="ti ti-chevron-down ms-2"></i>
                            </button>
                            <div id="faq-2" class="collapse" data-bs-parent="#accordionFaq">
                                <p>
                                    To safeguard investor confidentiality and tailor risk controls, all active investment packages, arbitrage pool tiers, and personalized capital allocation tools are located securely inside the <strong>authenticated client dashboard</strong>. Once you register and log in, navigate to <em>Buy Plan / Invest</em> to configure your portfolio.
                                </p>
                            </div>
                        </div>

                        <!-- FAQ 3 -->
                        <div class="accordion__card mb-3">
                            <button class="collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-3" aria-expanded="false" aria-controls="faq-3">
                                <span>How does arbitrage make a profit if the cryptocurrency market crashes?</span>
                                <i class="ti ti-chevron-down ms-2"></i>
                            </button>
                            <div id="faq-3" class="collapse" data-bs-parent="#accordionFaq">
                                <p>
                                    Arbitrage does not depend on whether Bitcoin or Ethereum is going up or down. Our algorithms simultaneously buy an asset on Exchange A (where price is temporarily lower) and sell it on Exchange B (where price is temporarily higher). Market volatility actually increases price discrepancies, often creating <em>higher</em> arbitrage yields during turbulent periods.
                                </p>
                            </div>
                        </div>

                        <!-- FAQ 4 -->
                        <div class="accordion__card mb-3">
                            <button class="collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-4" aria-expanded="false" aria-controls="faq-4">
                                <span>Are my withdrawal requests processed automatically?</span>
                                <i class="ti ti-chevron-down ms-2"></i>
                            </button>
                            <div id="faq-4" class="collapse" data-bs-parent="#accordionFaq">
                                <p>
                                    Yes. Because your funds are backed 1:1 and never locked up in illiquid directional positions, withdrawal requests are processed rapidly through our automated payout rails directly to your designated crypto wallet.
                                </p>
                            </div>
                        </div>

                        <!-- FAQ 5 -->
                        <div class="accordion__card mb-3">
                            <button class="collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-5" aria-expanded="false" aria-controls="faq-5">
                                <span>Is my personal data and account protected against cyber attacks?</span>
                                <i class="ti ti-chevron-down ms-2"></i>
                            </button>
                            <div id="faq-5" class="collapse" data-bs-parent="#accordionFaq">
                                <p>
                                    We enforce AES-256 bit database encryption, mandatory two-factor authentication (2FA), DDoS mitigation, and continuous penetration testing. All sensitive operations require multi-step cryptographic verification.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center gap-3 mt-4 flex-wrap">
                        <a href="{{ url('/faq') }}" class="btn-secondary-modern">
                            <i class="ti ti-book me-1"></i> View Full FAQ Knowledgebase
                        </a>
                        <a href="{{ url('/contact') }}" class="btn-primary-modern">
                            <i class="ti ti-headset me-1"></i> Contact Institutional Support
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ==================== END FREQUENTLY ASKED QUESTIONS ==================== -->


    <!-- ==================== COMPANY REGISTRATION & COMPLIANCE ==================== -->
    <section class="section pt-0">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="company p-4 p-md-5">
                        <div class="neon-feature-icon neon-feature-icon--amber">
                            <i class="ti ti-certificate-2"></i>
                        </div>

                        <h2 style="font-size: 26px; font-weight: 800; margin-bottom: 18px;">
                            Corporate Transparency & Institutional Standards
                        </h2>

                        <div class="row g-4">
                            <div class="col-12 col-xl-7">
                                <p style="font-size: 15px; line-height: 1.75; margin-bottom: 16px;">
                                    Integrity, verified solvency, and strict risk discipline are the bedrock of {{ $settings->site_name }}. Born out of an era of broken trust, we adhere to the highest institutional standards so our global clients can invest with absolute peace of mind.
                                </p>
                                <p style="font-size: 14px; margin: 0;">
                                    Entity Registration & Regulatory Good Standing: <strong class="text-success"><i class="ti ti-circle-check"></i> Verified & Active</strong>
                                </p>
                            </div>

                            <div class="col-12 col-xl-4 offset-xl-1">
                                <h4 style="font-size: 14px; text-transform: uppercase; letter-spacing: 0.8px; color: #00E5FF; font-weight: 700; margin-bottom: 12px;">Asset Security Protocols:</h4>
                                <ul style="list-style: none; padding: 0; margin: 0; font-size: 14px; line-height: 1.8;">
                                    <li><i class="ti ti-check text-success me-2"></i> Cold Storage Hardware Custody</li>
                                    <li><i class="ti ti-check text-success me-2"></i> Zero Counterparty Rehypothecation</li>
                                    <li><i class="ti ti-check text-success me-2"></i> Delta-Hedged Algorithmic Arbitrage</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ==================== END COMPANY REGISTRATION ==================== -->


    <!-- ==================== FINAL CALL TO ACTION ==================== -->
    <section class="section pt-0 pb-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="cta-card-modern">
                        <div class="hero-pill-badge mb-3">
                            <i class="ti ti-lock-access"></i> Institutional Asset Defense
                        </div>
                        <h2 style="font-size: 36px; font-weight: 800; margin-bottom: 16px; letter-spacing: -0.5px;">
                            Experience True Cryptocurrency Asset Protection
                        </h2>
                        <p style="font-size: 16px; max-width: 680px; margin: 0 auto 30px; line-height: 1.7;">
                            Join thousands of individual and institutional investors who protect their wealth through market-neutral arbitrage intelligence. No directional gambling. No commingled risk.
                        </p>
                        <div class="d-flex justify-content-center gap-3 flex-wrap">
                            <a href="{{ url('/register') }}" class="btn-hero-primary">
                                <i class="ti ti-shield-check" style="font-size: 20px;"></i> Open Free Protected Account
                            </a>
                            <a href="{{ url('/login') }}" class="btn-hero-secondary">
                                <i class="ti ti-login" style="font-size: 20px;"></i> Sign In to Dashboard
                            </a>
                        </div>
                        <div class="mt-4 pt-3 border-top d-flex justify-content-center gap-4 flex-wrap" style="border-color: rgba(255, 255, 255, 0.15) !important; font-size: 12.5px; opacity: 0.9;">
                            <span><i class="ti ti-check text-success me-1"></i> 100% Backed Reserves</span>
                            <span><i class="ti ti-check text-success me-1"></i> Zero Rehypothecation</span>
                            <span><i class="ti ti-check text-success me-1"></i> Instant Automated Withdrawals</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ==================== END FINAL CALL TO ACTION ==================== -->

    <script>
        function toggleDealsView(view) {
            var cards = document.getElementById('dealsMobileCards');
            var tableWrap = document.getElementById('dealsTableWrap');
            var btnCards = document.getElementById('btnViewCards');
            var btnTable = document.getElementById('btnViewTable');
            if (!cards || !tableWrap) return;

            if (view === 'cards') {
                cards.style.setProperty('display', 'block', 'important');
                tableWrap.classList.add('d-none');
                tableWrap.classList.remove('d-block');
                if (btnCards) btnCards.classList.add('active');
                if (btnTable) btnTable.classList.remove('active');
            } else {
                cards.style.setProperty('display', 'none', 'important');
                tableWrap.classList.remove('d-none');
                tableWrap.classList.add('d-block');
                if (btnTable) btnTable.classList.add('active');
                if (btnCards) btnCards.classList.remove('active');
            }
        }

        /* High-Performance Rising Particles & Floating Bubbles Canvas Engine */
        (function() {
            var canvas = document.getElementById('hero-particles-canvas');
            if (!canvas) return;

            var ctx = canvas.getContext('2d');
            if (!ctx) return;

            var particles = [];
            var animationFrameId = null;
            var isRunning = true;
            var width = 0;
            var height = 0;

            function hexToRgb(hex) {
                hex = (hex || '#F59E0B').trim().replace('#', '');
                if (hex.length === 3) {
                    hex = hex[0] + hex[0] + hex[1] + hex[1] + hex[2] + hex[2];
                }
                var num = parseInt(hex, 16);
                return {
                    r: (num >> 16) & 255,
                    g: (num >> 8) & 255,
                    b: num & 255
                };
            }

            function getThemeColors() {
                var computed = getComputedStyle(document.documentElement);
                var accent = computed.getPropertyValue('--hero-accent').trim() || '#F59E0B';
                var secondary = computed.getPropertyValue('--hero-secondary').trim() || '#D97706';
                return {
                    accentRgb: hexToRgb(accent),
                    secondaryRgb: hexToRgb(secondary)
                };
            }

            function resize() {
                var hero = canvas.parentElement;
                if (!hero) return;
                var rect = hero.getBoundingClientRect();
                var dpr = Math.min(window.devicePixelRatio || 1, 2);
                width = rect.width;
                height = rect.height;

                canvas.width = width * dpr;
                canvas.height = height * dpr;
                ctx.scale(dpr, dpr);

                initParticles();
            }

            function initParticles() {
                particles = [];
                // Density scaled to screen size: around 30 on mobile, 52 on desktop
                var count = Math.floor(Math.min(Math.max(width / 26, 26), 55));
                var colors = getThemeColors();

                for (var i = 0; i < count; i++) {
                    particles.push(createParticle(colors, true));
                }
            }

            function createParticle(colors, randomizeY) {
                var isBubble = Math.random() > 0.45; // ~55% hollow bubbles, ~45% solid glowing dots
                var isSecondary = Math.random() > 0.70;
                var rgb = isSecondary ? colors.secondaryRgb : colors.accentRgb;
                var radius = isBubble ? (Math.random() * 2.8 + 2.0) : (Math.random() * 2.2 + 1.2);

                return {
                    x: Math.random() * width,
                    y: randomizeY ? (Math.random() * height) : (height + Math.random() * 30),
                    radius: radius,
                    speedY: Math.random() * 0.75 + 0.35,
                    driftAngle: Math.random() * Math.PI * 2,
                    driftSpeed: Math.random() * 0.02 + 0.01,
                    driftAmp: Math.random() * 0.6 + 0.2,
                    baseAlpha: Math.random() * 0.55 + 0.25,
                    alpha: 0,
                    isBubble: isBubble,
                    rgb: rgb
                };
            }

            function updateAndDraw() {
                ctx.clearRect(0, 0, width, height);
                var colors = getThemeColors();

                for (var i = 0; i < particles.length; i++) {
                    var p = particles[i];

                    // Movement: Rise upwards
                    p.y -= p.speedY;
                    p.driftAngle += p.driftSpeed;
                    p.x += Math.sin(p.driftAngle) * p.driftAmp;

                    // Fade in when entering from bottom, fade out near top
                    var distFromTop = p.y;
                    var distFromBottom = height - p.y;

                    if (distFromBottom < 40) {
                        p.alpha = Math.min(p.baseAlpha, (distFromBottom / 40) * p.baseAlpha);
                    } else if (distFromTop < 70) {
                        p.alpha = Math.max(0, (distFromTop / 70) * p.baseAlpha);
                    } else {
                        p.alpha = p.baseAlpha;
                    }

                    // Reset when off the top
                    if (p.y < -15 || p.x < -20 || p.x > width + 20) {
                        particles[i] = createParticle(colors, false);
                        continue;
                    }

                    // Draw
                    ctx.save();
                    if (p.isBubble) {
                        // Hollow glowing micro-bubble
                        ctx.beginPath();
                        ctx.arc(p.x, p.y, p.radius, 0, Math.PI * 2);
                        ctx.lineWidth = 1.2;
                        ctx.strokeStyle = 'rgba(' + p.rgb.r + ',' + p.rgb.g + ',' + p.rgb.b + ',' + p.alpha + ')';
                        ctx.stroke();

                        // Soft interior glow
                        ctx.fillStyle = 'rgba(' + p.rgb.r + ',' + p.rgb.g + ',' + p.rgb.b + ',' + (p.alpha * 0.18) + ')';
                        ctx.fill();
                    } else {
                        // Solid glowing dot with subtle halo
                        ctx.shadowColor = 'rgba(' + p.rgb.r + ',' + p.rgb.g + ',' + p.rgb.b + ', ' + (p.alpha * 0.8) + ')';
                        ctx.shadowBlur = 6;

                        ctx.beginPath();
                        ctx.arc(p.x, p.y, p.radius, 0, Math.PI * 2);
                        ctx.fillStyle = 'rgba(' + p.rgb.r + ',' + p.rgb.g + ',' + p.rgb.b + ',' + p.alpha + ')';
                        ctx.fill();
                    }
                    ctx.restore();
                }

                if (isRunning) {
                    animationFrameId = requestAnimationFrame(updateAndDraw);
                }
            }

            // Efficient IntersectionObserver: Pause when hero is scrolled out of view
            if ('IntersectionObserver' in window) {
                var observer = new IntersectionObserver(function(entries) {
                    entries.forEach(function(entry) {
                        if (entry.isIntersecting) {
                            if (!isRunning) {
                                isRunning = true;
                                animationFrameId = requestAnimationFrame(updateAndDraw);
                            }
                        } else {
                            isRunning = false;
                            if (animationFrameId) {
                                cancelAnimationFrame(animationFrameId);
                            }
                        }
                    });
                }, { threshold: 0.05 });

                var heroSection = canvas.closest('.hero');
                if (heroSection) {
                    observer.observe(heroSection);
                }
            }

            // Window resize debouncing
            var resizeTimer;
            window.addEventListener('resize', function() {
                clearTimeout(resizeTimer);
                resizeTimer = setTimeout(resize, 150);
            });

            // Initial setup
            resize();
            animationFrameId = requestAnimationFrame(updateAndDraw);
        })();
    </script>
@endsection
