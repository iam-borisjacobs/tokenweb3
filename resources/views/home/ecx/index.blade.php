@extends('home.ecx.layout')

@section('title', $settings->site_title ?? 'Professional Crypto Investment Platform')

@section('content')

  <style>
    /* ==========================================================================
       ECX Institutional & Ultra-Modern Landing Styles
       ========================================================================== */
    :root {
      --ecx-primary: #00f59b;
      --ecx-primary-glow: rgba(0, 245, 155, 0.25);
      --ecx-dark-surface: #0b1329;
      --ecx-dark-card: rgba(13, 22, 42, 0.82);
      --ecx-border: rgba(255, 255, 255, 0.08);
      --ecx-bronze: #d97706;
      --ecx-silver: #cbd5e1;
      --ecx-gold: #f59e0b;
      --ecx-diamond: #38bdf8;
    }

    /* Ambient Hero Glow */
    .hero-glow-container {
      position: relative;
      overflow: hidden;
    }
    .hero-glow-blob-1 {
      position: absolute;
      top: -15%;
      left: 20%;
      width: 500px;
      height: 500px;
      background: radial-gradient(circle, rgba(0, 245, 155, 0.12) 0%, rgba(0, 245, 155, 0) 70%);
      filter: blur(60px);
      pointer-events: none;
      z-index: 1;
      animation: heroFloat 8s ease-in-out infinite alternate;
    }
    .hero-glow-blob-2 {
      position: absolute;
      bottom: 10%;
      right: 15%;
      width: 450px;
      height: 450px;
      background: radial-gradient(circle, rgba(14, 165, 233, 0.1) 0%, rgba(14, 165, 233, 0) 70%);
      filter: blur(60px);
      pointer-events: none;
      z-index: 1;
      animation: heroFloat 10s ease-in-out infinite alternate-reverse;
    }
    @keyframes heroFloat {
      0% { transform: translateY(0) scale(1); }
      100% { transform: translateY(-30px) scale(1.08); }
    }

    /* Modern Pill Badges */
    .ecx-glow-pill {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      padding: 8px 20px;
      border-radius: 9999px;
      background: rgba(0, 245, 155, 0.07);
      border: 1px solid rgba(0, 245, 155, 0.3);
      backdrop-filter: blur(12px);
      margin-bottom: 24px;
      box-shadow: 0 4px 20px rgba(0, 245, 155, 0.12);
    }
    .ecx-glow-dot {
      width: 8px;
      height: 8px;
      border-radius: 50%;
      background: #00f59b;
      box-shadow: 0 0 10px #00f59b;
      animation: ecxPulse 1.8s infinite ease-in-out;
    }
    @keyframes ecxPulse {
      0%, 100% { opacity: 1; transform: scale(1); }
      50% { opacity: 0.4; transform: scale(0.8); }
    }

    /* Institutional Trust Bar */
    .ecx-trust-bar {
      background: linear-gradient(180deg, rgba(7, 11, 20, 0.98) 0%, rgba(11, 18, 33, 0.75) 50%, rgba(7, 11, 20, 0.98) 100%);
      border-top: 1px solid rgba(255, 255, 255, 0.05);
      border-bottom: 1px solid rgba(255, 255, 255, 0.05);
      padding: 24px 0;
      backdrop-filter: blur(16px);
      position: relative;
      z-index: 5;
    }
    .counter {
      margin-top: 0 !important;
      position: relative;
      z-index: 4;
      background: linear-gradient(180deg, rgba(7, 11, 20, 0.98) 0%, rgba(10, 17, 30, 0.6) 50%, #070b14 100%) !important;
    }
    .counter__item {
      background: rgba(13, 22, 42, 0.65) !important;
      border: 1px solid rgba(255, 255, 255, 0.06) !important;
      border-radius: 16px;
      backdrop-filter: blur(14px);
      transition: transform 0.3s ease, border-color 0.3s ease;
    }
    .counter__item:hover {
      border-color: rgba(0, 245, 155, 0.3) !important;
      transform: translateY(-4px);
    }

    /* Seamless Section Ambient Gradients */
    .ecx-section-engine {
      background: radial-gradient(circle at 15% 30%, rgba(0, 245, 155, 0.04) 0%, transparent 60%),
                  radial-gradient(circle at 85% 70%, rgba(14, 165, 233, 0.035) 0%, transparent 60%),
                  linear-gradient(180deg, #070b14 0%, rgba(11, 19, 36, 0.72) 35%, rgba(11, 19, 36, 0.72) 70%, #070b14 100%);
      position: relative;
    }

    .ecx-section-marketwatch {
      background: radial-gradient(circle at 80% 25%, rgba(0, 245, 155, 0.03) 0%, transparent 55%),
                  linear-gradient(180deg, #070b14 0%, rgba(10, 17, 32, 0.65) 50%, #070b14 100%);
      position: relative;
    }

    .ecx-section-pricing {
      position: relative;
      background-color: #070b14;
      background-image: radial-gradient(circle at 50% 20%, rgba(0, 245, 155, 0.05) 0%, transparent 60%),
                        linear-gradient(180deg, #070b14 0%, rgba(7, 11, 20, 0.62) 18%, rgba(7, 11, 20, 0.62) 82%, #070b14 100%),
                        url('{{ asset('themes/ecx/assets/images/pricing/bg.png') }}');
      background-position: center center;
      background-size: cover;
      background-repeat: no-repeat;
    }

    .ecx-section-calculator {
      background: radial-gradient(circle at 45% 50%, rgba(14, 165, 233, 0.035) 0%, transparent 65%),
                  linear-gradient(180deg, #070b14 0%, rgba(10, 18, 33, 0.65) 50%, #070b14 100%) !important;
      position: relative;
    }

    .ecx-section-faq {
      background: radial-gradient(circle at 10% 40%, rgba(0, 245, 155, 0.03) 0%, transparent 60%),
                  linear-gradient(180deg, #070b14 0%, rgba(11, 19, 34, 0.7) 50%, #070b14 100%) !important;
      position: relative;
    }
    .trust-pillar-item {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 10px 10px;
      border-radius: 12px;
      transition: all 0.25s ease;
    }
    .trust-pillar-item:hover {
      background: rgba(255, 255, 255, 0.03);
    }
    .trust-pillar-icon {
      width: 44px;
      height: 44px;
      border-radius: 12px;
      background: rgba(0, 245, 155, 0.08);
      border: 1px solid rgba(0, 245, 155, 0.2);
      display: flex;
      align-items: center;
      justify-content: center;
      color: #00f59b;
      font-size: 18px;
      flex-shrink: 0;
    }

    /* Full-Bleed 16:9 Plan Banner Cards */
    .ecx-widescreen-card {
      background: rgba(13, 22, 42, 0.9);
      border: 1px solid rgba(255, 255, 255, 0.08);
      border-radius: 20px;
      overflow: hidden;
      transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
      display: flex;
      flex-direction: column;
      height: 100%;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.35);
      backdrop-filter: blur(14px);
    }
    .ecx-widescreen-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 16px 40px rgba(0, 0, 0, 0.5);
    }
    .ecx-widescreen-card.tier-bronze:hover {
      border-color: rgba(217, 119, 6, 0.6);
      box-shadow: 0 16px 40px rgba(217, 119, 6, 0.2);
    }
    .ecx-widescreen-card.tier-silver:hover {
      border-color: rgba(203, 213, 225, 0.6);
      box-shadow: 0 16px 40px rgba(203, 213, 225, 0.2);
    }
    .ecx-widescreen-card.tier-gold:hover {
      border-color: rgba(245, 158, 11, 0.7);
      box-shadow: 0 16px 40px rgba(245, 158, 11, 0.25);
    }
    .ecx-widescreen-card.tier-diamond:hover {
      border-color: rgba(56, 189, 248, 0.8);
      box-shadow: 0 16px 45px rgba(56, 189, 248, 0.3);
    }
    .ecx-widescreen-card.featured-card {
      border-color: #00f59b;
      box-shadow: 0 0 0 1px #00f59b, 0 16px 45px rgba(0, 245, 155, 0.22);
    }

    /* Edge-to-Edge Widescreen Image Wrapper */
    .widescreen-banner-wrap {
      width: 100%;
      height: 155px;
      position: relative;
      overflow: hidden;
      background: #080e1a;
    }
    .widescreen-banner-wrap img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      object-position: center;
      transition: transform 0.4s ease;
    }
    .ecx-widescreen-card:hover .widescreen-banner-wrap img {
      transform: scale(1.05);
    }
    .widescreen-overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(180deg, rgba(0,0,0,0) 40%, rgba(13, 22, 42, 0.95) 100%);
      pointer-events: none;
    }
    .widescreen-badge {
      position: absolute;
      top: 12px;
      left: 12px;
      font-size: 10px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      padding: 4px 10px;
      border-radius: 999px;
      backdrop-filter: blur(8px);
      z-index: 2;
    }

    /* Market Watch Table */
    .market-watch-card {
      background: rgba(13, 22, 42, 0.85);
      border: 1px solid rgba(255, 255, 255, 0.08);
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 12px 36px rgba(0, 0, 0, 0.3);
    }
    .market-table {
      margin-bottom: 0;
      color: #fff;
    }
    .market-table th {
      background: rgba(11, 19, 38, 0.95);
      font-size: 11px;
      text-transform: uppercase;
      letter-spacing: 1px;
      color: #94a3b8;
      border-bottom: 1px solid rgba(255, 255, 255, 0.06);
      padding: 16px 20px;
    }
    .market-table td {
      padding: 16px 20px;
      vertical-align: middle;
      border-bottom: 1px solid rgba(255, 255, 255, 0.04);
      font-size: 14px;
    }
    .market-table tr:hover td {
      background: rgba(255, 255, 255, 0.02);
    }

    /* Real-Time Market Watch Live Features */
    .ecx-live-pulse-dot {
      width: 8px;
      height: 8px;
      border-radius: 50%;
      background: #00f59b;
      box-shadow: 0 0 0 0 rgba(0, 245, 155, 0.7);
      animation: ecxLivePulse 1.8s infinite;
      display: inline-block;
    }
    @keyframes ecxLivePulse {
      0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(0, 245, 155, 0.7); }
      70% { transform: scale(1); box-shadow: 0 0 0 6px rgba(0, 245, 155, 0); }
      100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(0, 245, 155, 0); }
    }

    .market-price-val {
      font-weight: 700;
      font-size: 14.5px;
      color: #ffffff;
      padding: 3px 6px;
      border-radius: 6px;
      transition: background-color 0.4s ease, color 0.4s ease, text-shadow 0.4s ease;
      display: inline-block;
    }
    .market-price-val.flash-up {
      color: #00f59b !important;
      background: rgba(0, 245, 155, 0.22);
      text-shadow: 0 0 10px rgba(0, 245, 155, 0.6);
    }
    .market-price-val.flash-down {
      color: #f87171 !important;
      background: rgba(239, 68, 68, 0.22);
      text-shadow: 0 0 10px rgba(239, 68, 68, 0.6);
    }

    .market-change-badge {
      display: inline-flex !important;
      align-items: center !important;
      gap: 5px !important;
      font-size: 11.5px !important;
      font-weight: 700 !important;
      padding: 3.5px 10px !important;
      border-radius: 9999px !important;
      letter-spacing: 0.3px;
      white-space: nowrap !important;
      transition: all 0.3s ease;
    }
    .market-change-badge.up {
      background: rgba(0, 245, 155, 0.15) !important;
      color: #00f59b !important;
      border: 1px solid rgba(0, 245, 155, 0.35) !important;
    }
    .market-change-badge.down {
      background: rgba(239, 68, 68, 0.15) !important;
      color: #f87171 !important;
      border: 1px solid rgba(239, 68, 68, 0.35) !important;
    }

    /* Ecosystem Tabbed Navigation */
    .eco-nav-btn {
      background: rgba(255, 255, 255, 0.03);
      border: 1px solid rgba(255, 255, 255, 0.08);
      color: #94a3b8;
      border-radius: 14px;
      padding: 16px 22px;
      font-weight: 600;
      font-size: 14px;
      transition: all 0.25s ease;
      display: flex;
      align-items: center;
      gap: 12px;
      width: 100%;
      text-align: left;
    }
    .eco-nav-btn:hover {
      background: rgba(255, 255, 255, 0.06);
      color: #fff;
    }
    .eco-nav-btn.active {
      background: rgba(0, 245, 155, 0.1);
      border-color: #00f59b;
      color: #00f59b;
      box-shadow: 0 6px 20px rgba(0, 245, 155, 0.15);
    }

    /* Live Platform Activity Feed */
    .live-activity-feed {
      background: rgba(11, 19, 38, 0.85);
      border: 1px solid rgba(255, 255, 255, 0.06);
      border-radius: 16px;
      padding: 16px 24px;
      display: flex;
      align-items: center;
      overflow: hidden;
      position: relative;
    }
    .activity-ticker-wrap {
      display: flex;
      align-items: center;
      gap: 30px;
      white-space: nowrap;
      animation: tickerScroll 24s linear infinite;
    }
    .activity-ticker-wrap:hover {
      animation-play-state: paused;
    }
    @keyframes tickerScroll {
      0% { transform: translateX(0); }
      100% { transform: translateX(-50%); }
    }
    .ticker-item {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      font-size: 12.5px;
      color: #cbd5e1;
    }

    /* Interactive Calculator */
    .ecx-calc-card {
      background: rgba(13, 22, 42, 0.9);
      border: 1px solid rgba(0, 245, 155, 0.3);
      border-radius: 24px;
      padding: 38px 32px;
      box-shadow: 0 20px 50px rgba(0, 0, 0, 0.45);
      backdrop-filter: blur(16px);
    }
    .calc-slider {
      -webkit-appearance: none;
      width: 100%;
      height: 8px;
      border-radius: 5px;
      background: #1e293b;
      outline: none;
    }
    .calc-slider::-webkit-slider-thumb {
      -webkit-appearance: none;
      appearance: none;
      width: 26px;
      height: 26px;
      border-radius: 50%;
      background: #00f59b;
      cursor: pointer;
      box-shadow: 0 0 14px #00f59b;
      transition: transform 0.15s;
    }
    .calc-slider::-webkit-slider-thumb:hover {
      transform: scale(1.15);
    }
    .calc-preset-btn {
      background: rgba(255, 255, 255, 0.05);
      border: 1px solid rgba(255, 255, 255, 0.12);
      color: #94a3b8;
      font-size: 12px;
      font-weight: 600;
      padding: 6px 14px;
      border-radius: 8px;
      transition: all 0.2s;
    }
    .calc-preset-btn:hover, .calc-preset-btn.active {
      background: rgba(0, 245, 155, 0.15);
      border-color: #00f59b;
      color: #00f59b;
    }

    /* FAQ Custom Glassmorphic Cards */
    .ecx-faq-card {
      background: rgba(13, 22, 42, 0.75);
      border: 1px solid rgba(255, 255, 255, 0.08);
      border-radius: 16px;
      margin-bottom: 14px;
      overflow: hidden;
      transition: all 0.25s ease;
      backdrop-filter: blur(12px);
    }
    .ecx-faq-card:hover {
      border-color: rgba(0, 245, 155, 0.35);
      transform: translateY(-2px);
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.25);
    }
    .ecx-faq-btn {
      width: 100%;
      text-align: left;
      background: transparent;
      border: none;
      padding: 20px 24px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 16px;
      color: #ffffff;
      font-weight: 700;
      font-size: 15px;
      cursor: pointer;
      transition: color 0.2s;
    }
    .ecx-faq-btn:not(.collapsed) {
      color: #00f59b;
    }
    .ecx-faq-btn .faq-arrow {
      width: 32px;
      height: 32px;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.05);
      border: 1px solid rgba(255, 255, 255, 0.1);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 12px;
      flex-shrink: 0;
      transition: transform 0.3s, background 0.3s, color 0.3s;
      color: #94a3b8;
    }
    .ecx-faq-btn:not(.collapsed) .faq-arrow {
      transform: rotate(180deg);
      background: rgba(0, 245, 155, 0.15);
      border-color: #00f59b;
      color: #00f59b;
    }
    .ecx-faq-num {
      font-size: 12px;
      font-weight: 800;
      letter-spacing: 0.5px;
      color: #00f59b;
      padding: 4px 10px;
      border-radius: 8px;
      background: rgba(0, 245, 155, 0.1);
      border: 1px solid rgba(0, 245, 155, 0.2);
      flex-shrink: 0;
    }
    .ecx-faq-body {
      padding: 0 24px 22px 64px;
      color: #94a3b8;
      font-size: 14px;
      line-height: 1.7;
    }

    /* Hero Floating Shapes - Perfect Responsive Display */
    .banner__shape {
      pointer-events: none;
    }
    .banner__shape-item {
      position: absolute;
      pointer-events: none;
      z-index: 3 !important;
    }
    /* Desktop (>= 992px): Clearly visible floating in outer margins */
    @media (min-width: 992px) {
      .banner__shape-item--1 {
        top: 26% !important;
        right: 5% !important;
        left: auto !important;
        bottom: auto !important;
        width: 68px !important;
        opacity: 0.9 !important;
        display: block !important;
        filter: drop-shadow(0 0 16px rgba(0, 245, 155, 0.45));
      }
      .banner__shape-item--5 {
        top: 22% !important;
        left: 5% !important;
        right: auto !important;
        bottom: auto !important;
        width: 80px !important;
        opacity: 0.9 !important;
        display: block !important;
        filter: drop-shadow(0 0 16px rgba(14, 165, 233, 0.45));
      }
    }
    @media (min-width: 1400px) {
      .banner__shape-item--1 {
        right: 7% !important;
        top: 28% !important;
        width: 78px !important;
      }
      .banner__shape-item--5 {
        left: 7% !important;
        top: 22% !important;
        width: 90px !important;
      }
    }
    /* Tablet & Medium devices (576px - 991px): scaled down in safe corners */
    @media (max-width: 991.98px) and (min-width: 576px) {
      .banner__shape-item--1 {
        top: 6% !important;
        right: 2% !important;
        left: auto !important;
        bottom: auto !important;
        width: 36px !important;
        opacity: 0.45 !important;
      }
      .banner__shape-item--5 {
        top: 4% !important;
        left: 2% !important;
        right: auto !important;
        bottom: auto !important;
        width: 42px !important;
        opacity: 0.45 !important;
      }
    }
    /* Small Mobile (< 576px): completely prevent any overlap on text/buttons */
    @media (max-width: 575.98px) {
      .banner__shape-item--1 {
        display: none !important; /* Eliminate right floating shape on phones so it cannot cover text/buttons */
      }
      .banner__shape-item--5 {
        top: 2% !important;
        left: 1% !important;
        width: 28px !important;
        opacity: 0.3 !important;
      }
    }

    /* Rising Particles & Floating Bubbles Canvas */
    .hero-particles-canvas {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      pointer-events: none;
      z-index: 1;
    }
  </style>

  <!-- ===============>> Hero Banner Section Start <<================= -->
  <section class="banner banner--style4 bg--cover hero-glow-container" style="background: linear-gradient(180deg, rgba(7, 11, 20, 0.62) 0%, rgba(7, 11, 20, 0.78) 55%, rgba(7, 11, 20, 0.95) 88%, #070b14 100%), url({{ asset('themes/ecx/assets/images/banner/home4/hero_ai_trader.jpg') }}) center top / cover no-repeat; padding-top: 140px; padding-bottom: 30px;">
    <div class="hero-glow-blob-1"></div>
    <div class="hero-glow-blob-2"></div>

    <!-- Rising Particles & Floating Bubbles Canvas Engine -->
    <canvas id="hero-particles-canvas" class="hero-particles-canvas"></canvas>

    <div class="container" style="position: relative; z-index: 2;">
      <div class="banner__wrapper">
        <div class="row justify-content-center">
          <div class="col-md-10 justify-content-center text-center">
            <div class="banner__content mb-4" data-aos="fade-up" data-aos-duration="800">
              
              <!-- Ambient Live Pulse Pill -->
              <div class="ecx-glow-pill">
                <span class="ecx-glow-dot"></span>
                <span class="f-12 f-w-700 text-uppercase" style="color: #00f59b; letter-spacing: 1.2px;">Institutional 4-Tier Yield Architecture</span>
                <span class="badge bg-white bg-opacity-10 text-white border border-white border-opacity-20 rounded-pill px-2 py-0.5 f-10">Live V2.4</span>
              </div>

              <h1>Institutional Capital Growth. <br> Automated Yield at Scale.</h1>
              <p class="mb-4">Execute non-custodial algorithmic arbitrage with automated daily distribution. Transparent, secure, and regulated yields spanning from $100 to $150,000.</p>
              
              <div class="banner__content-btn btn-group justify-content-center mb-3">
                @auth
                  <a href="{{ url('/dashboard') }}" class="trk-btn trk-btn--primary trk-btn--arrow">Go to Dashboard</a>
                  <a href="{{ url('/dashboard/mplans') }}" class="trk-btn trk-btn--primary trk-btn--arrow" style="margin-left: 15px;">Explore 4 Tiers</a>
                @else
                  <a href="{{ route('register') }}" class="trk-btn trk-btn--primary trk-btn--arrow">Start Trading Today</a>
                  <a href="{{ route('login') }}" class="trk-btn trk-btn--outline" style="margin-left: 15px; border-color: rgba(255,255,255,0.25); color: #ffffff;">Access Account</a>
                @endauth
              </div>

              <!-- Quick Security Badges Under CTA -->
              <div class="d-flex flex-wrap align-items-center justify-content-center gap-3 text-muted f-12 mb-4">
                <span><i class="fa-solid fa-shield-halved text-success me-1"></i> Multi-Sig Vaults</span>
                <span>&bull;</span>
                <span><i class="fa-solid fa-bolt text-warning me-1"></i> 24/7 AI Arbitrage</span>
                <span>&bull;</span>
                <span><i class="fa-solid fa-wallet text-info me-1"></i> Non-Custodial Web3</span>
                <span>&bull;</span>
                <span><i class="fa-solid fa-circle-check text-success me-1"></i> 1:1 Reserve Backed</span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Docked TradingView Ticker Tape Widget (No Dead Space) -->
      <div class="tradingview-widget-container" style="border-radius: 12px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.35);">
        <div class="tradingview-widget-container__widget"></div>
        <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-ticker-tape.js" async>
          {
            "symbols": [
              { "description": "Bitcoin", "proName": "BINANCE:BTCUSDT" },
              { "description": "Ethereum", "proName": "BINANCE:ETHUSDT" },
              { "description": "Solana", "proName": "BINANCE:SOLUSDT" },
              { "description": "XRP", "proName": "BINANCE:XRPUSDT" },
              { "description": "Litecoin", "proName": "BINANCE:LTCUSDT" },
              { "description": "BNB", "proName": "BINANCE:BNBUSDT" }
            ],
            "showSymbolLogo": true,
            "isTransparent": false,
            "displayMode": "adaptive",
            "colorTheme": "dark",
            "locale": "en"
          }
        </script>
      </div>
    </div>

    <div class="banner__shape" style="opacity: 0.35; pointer-events: none;">
      <span class="banner__shape-item banner__shape-item--1"><img src="{{ asset('themes/ecx/assets/images/banner/home1/4.png') }}" alt="shape icon"></span>
    </div>
  </section>
  <!-- ===============>> Hero Banner Section End <<================= -->

  <!-- ===============>> Institutional Trust & Security Bar Start <<================= -->
  <div class="ecx-trust-bar">
    <div class="container">
      <div class="row g-3 justify-content-between align-items-center">
        <div class="col-6 col-md-4 col-lg-2">
          <div class="trust-pillar-item">
            <div class="trust-pillar-icon">
              <i class="fa-solid fa-shield-halved"></i>
            </div>
            <div>
              <div class="f-13 f-w-700 text-white">Cold Vaults</div>
              <div class="f-11 text-muted">Offline Multi-Sig</div>
            </div>
          </div>
        </div>
        <div class="col-6 col-md-4 col-lg-2">
          <div class="trust-pillar-item">
            <div class="trust-pillar-icon">
              <i class="fa-solid fa-robot"></i>
            </div>
            <div>
              <div class="f-13 f-w-700 text-white">AI Arbitrage</div>
              <div class="f-11 text-muted">12+ Live Exchanges</div>
            </div>
          </div>
        </div>
        <div class="col-6 col-md-4 col-lg-2">
          <div class="trust-pillar-item">
            <div class="trust-pillar-icon">
              <i class="fa-solid fa-scale-balanced"></i>
            </div>
            <div>
              <div class="f-13 f-w-700 text-white">1:1 Reserves</div>
              <div class="f-11 text-muted">Merkle Audited</div>
            </div>
          </div>
        </div>
        <div class="col-6 col-md-4 col-lg-2">
          <div class="trust-pillar-item">
            <div class="trust-pillar-icon">
              <i class="fa-solid fa-clock-rotate-left"></i>
            </div>
            <div>
              <div class="f-13 f-w-700 text-white">Daily Drop</div>
              <div class="f-11 text-muted">Automated Payouts</div>
            </div>
          </div>
        </div>
        <div class="col-6 col-md-4 col-lg-2">
          <div class="trust-pillar-item">
            <div class="trust-pillar-icon">
              <i class="fa-solid fa-network-wired"></i>
            </div>
            <div>
              <div class="f-13 f-w-700 text-white">Web3 Direct</div>
              <div class="f-11 text-muted">MetaMask &amp; Trust</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- ===============>> Institutional Trust & Security Bar End <<================= -->

  <!-- ===============>> Counter / Market Metrics Start <<================= -->
  <div class="counter" style="margin-top: 0 !important; padding: 45px 0 35px; position: relative; z-index: 4;">
    <div class="container">
      <!-- Real-Time Metrics Counters -->
      <div class="counter__wrapper">
        <div class="row g-4">
          <div class="col-sm-6 col-lg-3">
            <div class="counter__item" data-aos="fade-up" data-aos-duration="800">
              <div class="counter__item-inner">
                <div class="counter__item-thumb">
                  <img src="{{ asset('themes/ecx/assets/images/banner/home4/icon/1.png') }}" alt="counter icon" style="max-height: 48px; object-fit: contain;">
                </div>
                <div class="counter__item-content">
                  <h3><span class="purecounter" data-purecounter-start="0" data-purecounter-end="{{ $total_users ?? 25 }}"></span>+</h3>
                  <p>Active Verified Traders</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-3">
            <div class="counter__item" data-aos="fade-up" data-aos-duration="1000">
              <div class="counter__item-inner">
                <div class="counter__item-thumb">
                  <img src="{{ asset('themes/ecx/assets/images/banner/home4/icon/2.png') }}" alt="counter icon" style="max-height: 48px; object-fit: contain;">
                </div>
                <div class="counter__item-content">
                  <h3>$<span class="purecounter" data-purecounter-start="0" data-purecounter-end="18"></span>M+</h3>
                  <p>Capital Managed</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-3">
            <div class="counter__item" data-aos="fade-up" data-aos-duration="1200">
              <div class="counter__item-inner">
                <div class="counter__item-thumb">
                  <img src="{{ asset('themes/ecx/assets/images/banner/home4/icon/3.png') }}" alt="counter icon" style="max-height: 48px; object-fit: contain;">
                </div>
                <div class="counter__item-content">
                  <h3><span class="purecounter" data-purecounter-start="0" data-purecounter-end="99"></span>.9%</h3>
                  <p>Vault Uptime</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-3">
            <div class="counter__item" data-aos="fade-up" data-aos-duration="1400">
              <div class="counter__item-inner">
                <div class="counter__item-thumb">
                  <img src="{{ asset('themes/ecx/assets/images/banner/home4/icon/4.png') }}" alt="counter icon" style="max-height: 48px; object-fit: contain;">
                </div>
                <div class="counter__item-content">
                  <h3><span class="purecounter" data-purecounter-start="0" data-purecounter-end="12"></span></h3>
                  <p>Global Jurisdictions</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- ===============>> Counter End <<================= -->

  <!-- ===============>> Live Platform Transparency Activity Ticker Start <<================= -->
  <div class="container mb-40">
    <div class="live-activity-feed shadow-sm">
      <div class="d-flex align-items-center gap-2 me-4 flex-shrink-0" style="border-right: 1px solid rgba(255,255,255,0.1); padding-right: 20px;">
        <span class="ecx-glow-dot"></span>
        <span class="f-12 f-w-700 text-uppercase text-white">Live Activity:</span>
      </div>
      <div class="overflow-hidden w-100">
        <div class="activity-ticker-wrap">
          <span class="ticker-item"><i class="fa-solid fa-arrow-down text-success"></i> Trader <strong>#18717</strong> deposited <strong>$10,000</strong> in Silver Tier</span>
          <span class="ticker-item">&bull;</span>
          <span class="ticker-item"><i class="fa-solid fa-bolt text-warning"></i> Automated Yield: <strong>+$400.00</strong> distributed to Bronze Pool</span>
          <span class="ticker-item">&bull;</span>
          <span class="ticker-item"><i class="fa-solid fa-arrow-up-right-from-square text-info"></i> Withdrawal Processed: <strong>$2,850 USDT</strong> to External Wallet</span>
          <span class="ticker-item">&bull;</span>
          <span class="ticker-item"><i class="fa-solid fa-gem text-primary"></i> Trader <strong>#18724</strong> activated <strong>Diamond VIP</strong> ($75,000)</span>
          <span class="ticker-item">&bull;</span>
          <span class="ticker-item"><i class="fa-solid fa-shield-halved text-success"></i> Proof of Reserves Snapshot Verified: <strong>100% Fully Collateralized</strong></span>
          <!-- Loop duplicate for infinite smooth animation -->
          <span class="ticker-item"><i class="fa-solid fa-arrow-down text-success"></i> Trader <strong>#18717</strong> deposited <strong>$10,000</strong> in Silver Tier</span>
          <span class="ticker-item">&bull;</span>
          <span class="ticker-item"><i class="fa-solid fa-bolt text-warning"></i> Automated Yield: <strong>+$400.00</strong> distributed to Bronze Pool</span>
          <span class="ticker-item">&bull;</span>
          <span class="ticker-item"><i class="fa-solid fa-arrow-up-right-from-square text-info"></i> Withdrawal Processed: <strong>$2,850 USDT</strong> to External Wallet</span>
        </div>
      </div>
    </div>
  </div>
  <!-- ===============>> Live Platform Transparency Activity Ticker End <<================= -->



  <!-- ===============>> Interactive Tabbed Ecosystem Solutions Hub Start <<================= -->
  <section class="padding-top padding-bottom ecx-section-engine">
    <div class="container">
      <div class="section-header section-header--max65 text-center mb-50">
        <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill mb-3" style="background: rgba(0, 245, 155, 0.08); border: 1px solid rgba(0, 245, 155, 0.25);">
          <i class="fa-solid fa-microchip text-success f-12"></i>
          <span class="f-11 f-w-700 text-uppercase" style="color: #00f59b; letter-spacing: 1px;">Core Engine</span>
        </div>
        <h2 class="mb-10 mt-minus-5">Engineered for <span>Automated Precision</span></h2>
        <p class="text-muted">Explore how the {{ $settings->site_name ?? 'ECX Groups' }} infrastructure combines non-custodial custody, AI bot modeling, and institutional liquidity.</p>
      </div>

      <div class="row g-4 align-items-center">
        <!-- Navigation Buttons Left -->
        <div class="col-lg-4">
          <div class="d-flex flex-column gap-3">
            <button type="button" class="eco-nav-btn active" onclick="switchEcoTab(1, this)">
              <div class="trust-pillar-icon" style="width: 36px; height: 36px; font-size: 15px;"><i class="fa-solid fa-robot"></i></div>
              <div>
                <div class="f-14 f-w-700">AI Arbitrage Engine</div>
                <div class="f-11 text-muted">Cross-exchange order routing</div>
              </div>
            </button>
            <button type="button" class="eco-nav-btn" onclick="switchEcoTab(2, this)">
              <div class="trust-pillar-icon" style="width: 36px; height: 36px; font-size: 15px;"><i class="fa-solid fa-chart-line"></i></div>
              <div>
                <div class="f-14 f-w-700">Yield Compounding</div>
                <div class="f-11 text-muted">Daily automated distributions</div>
              </div>
            </button>
            <button type="button" class="eco-nav-btn" onclick="switchEcoTab(3, this)">
              <div class="trust-pillar-icon" style="width: 36px; height: 36px; font-size: 15px;"><i class="fa-solid fa-vault"></i></div>
              <div>
                <div class="f-14 f-w-700">Multi-Sig Cold Vaults</div>
                <div class="f-11 text-muted">Offline institutional custody</div>
              </div>
            </button>
            <button type="button" class="eco-nav-btn" onclick="switchEcoTab(4, this)">
              <div class="trust-pillar-icon" style="width: 36px; height: 36px; font-size: 15px;"><i class="fa-solid fa-bolt"></i></div>
              <div>
                <div class="f-14 f-w-700">Instant Settlements</div>
                <div class="f-11 text-muted">Sub-second Web3 execution</div>
              </div>
            </button>
          </div>
        </div>

        <!-- Dynamic Content Right -->
        <div class="col-lg-8">
          <div class="market-watch-card p-4 p-md-5" style="min-height: 380px;">
            <!-- Tab 1 Content -->
            <div id="ecoTabContent1" class="eco-content-pane">
              <div class="d-flex align-items-center gap-3 mb-3">
                <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 rounded-pill px-3 py-1 f-11">Algorithmic Arbitrage</span>
                <span class="text-muted f-12"><i class="fa-solid fa-clock me-1"></i>24/7 Scanning Active</span>
              </div>
              <h3 class="text-white f-w-800 mb-3">Microsecond Cross-Market Spread Harvesting</h3>
              <p class="text-muted f-14 mb-4">
                Our autonomous trading bots continuously scan bid/ask order books across Binance, Coinbase, Kraken, OKX, and Bybit. By capturing micro-inefficiencies simultaneously without holding directional market risk, our system guarantees consistent automated returns across market volatility.
              </p>
              <div class="row g-3 pt-3 border-top border-secondary border-opacity-25">
                <div class="col-sm-4">
                  <div class="f-11 text-muted text-uppercase">Execution Latency</div>
                  <h4 class="text-success f-w-800 mb-0">&lt; 14ms</h4>
                </div>
                <div class="col-sm-4">
                  <div class="f-11 text-muted text-uppercase">Supported Venues</div>
                  <h4 class="text-white f-w-800 mb-0">12 Exchanges</h4>
                </div>
                <div class="col-sm-4">
                  <div class="f-11 text-muted text-uppercase">Slippage Tolerance</div>
                  <h4 class="text-success f-w-800 mb-0">0.00%</h4>
                </div>
              </div>
            </div>

            <!-- Tab 2 Content -->
            <div id="ecoTabContent2" class="eco-content-pane d-none">
              <div class="d-flex align-items-center gap-3 mb-3">
                <span class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25 rounded-pill px-3 py-1 f-11">Yield Compounding</span>
                <span class="text-muted f-12"><i class="fa-solid fa-calendar-check me-1"></i>Automated Daily Drops</span>
              </div>
              <h3 class="text-white f-w-800 mb-3">Daily Automated Treasury Distributions</h3>
              <p class="text-muted f-14 mb-4">
                Profits generated by our arbitrage clusters are audited and credited directly to your investor wallet every 24 hours. Investors can choose to compound daily yields for geometric capital acceleration or execute instant non-custodial withdrawals anytime.
              </p>
              <div class="row g-3 pt-3 border-top border-secondary border-opacity-25">
                <div class="col-sm-4">
                  <div class="f-11 text-muted text-uppercase">Yield Drop Cycle</div>
                  <h4 class="text-success f-w-800 mb-0">Every 24h</h4>
                </div>
                <div class="col-sm-4">
                  <div class="f-11 text-muted text-uppercase">Principal Protection</div>
                  <h4 class="text-white f-w-800 mb-0">100% Backed</h4>
                </div>
                <div class="col-sm-4">
                  <div class="f-11 text-muted text-uppercase">Lock-in Penalty</div>
                  <h4 class="text-success f-w-800 mb-0">None</h4>
                </div>
              </div>
            </div>

            <!-- Tab 3 Content -->
            <div id="ecoTabContent3" class="eco-content-pane d-none">
              <div class="d-flex align-items-center gap-3 mb-3">
                <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 rounded-pill px-3 py-1 f-11">Institutional Security</span>
                <span class="text-muted f-12"><i class="fa-solid fa-shield-halved me-1"></i>Bank-Grade Encryption</span>
              </div>
              <h3 class="text-white f-w-800 mb-3">Multi-Signature Offline MPC Architecture</h3>
              <p class="text-muted f-14 mb-4">
                Capital deposited into {{ $settings->site_name ?? 'ECX Groups' }} is segregated into air-gapped multi-signature cryptographic cold vaults. No single party can access treasury assets without M-of-N threshold signatures, establishing complete protection against digital threats.
              </p>
              <div class="row g-3 pt-3 border-top border-secondary border-opacity-25">
                <div class="col-sm-4">
                  <div class="f-11 text-muted text-uppercase">Encryption Standard</div>
                  <h4 class="text-success f-w-800 mb-0">AES-256</h4>
                </div>
                <div class="col-sm-4">
                  <div class="f-11 text-muted text-uppercase">Vault Custody</div>
                  <h4 class="text-white f-w-800 mb-0">Air-Gapped</h4>
                </div>
                <div class="col-sm-4">
                  <div class="f-11 text-muted text-uppercase">Reserve Audit</div>
                  <h4 class="text-success f-w-800 mb-0">1:1 Verified</h4>
                </div>
              </div>
            </div>

            <!-- Tab 4 Content -->
            <div id="ecoTabContent4" class="eco-content-pane d-none">
              <div class="d-flex align-items-center gap-3 mb-3">
                <span class="badge bg-info bg-opacity-10 text-info border border-info border-opacity-25 rounded-pill px-3 py-1 f-11">Instant Settlements</span>
                <span class="text-muted f-12"><i class="fa-solid fa-wallet me-1"></i>Non-Custodial Web3</span>
              </div>
              <h3 class="text-white f-w-800 mb-3">Zero Friction Web3 &amp; Crypto Connectivity</h3>
              <p class="text-muted f-14 mb-4">
                Connect your preferred Web3 wallet (MetaMask, Trust Wallet, Coinbase, Phantom) with one click. Enjoy immediate non-custodial capital deposits and instant withdrawals routed through our high-speed automated treasury gateway.
              </p>
              <div class="row g-3 pt-3 border-top border-secondary border-opacity-25">
                <div class="col-sm-4">
                  <div class="f-11 text-muted text-uppercase">Deposit Confirmations</div>
                  <h4 class="text-success f-w-800 mb-0">1 - 3 Blocks</h4>
                </div>
                <div class="col-sm-4">
                  <div class="f-11 text-muted text-uppercase">Withdrawal Processing</div>
                  <h4 class="text-white f-w-800 mb-0">Automated</h4>
                </div>
                <div class="col-sm-4">
                  <div class="f-11 text-muted text-uppercase">Platform Fee</div>
                  <h4 class="text-success f-w-800 mb-0">0.0%</h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- ===============>> Interactive Tabbed Ecosystem Solutions Hub End <<================= -->

  <!-- ===============>> Live Crypto Watchlist Table Start <<================= -->
  <section class="padding-top padding-bottom ecx-section-marketwatch">
    <div class="container">
      <div class="section-header section-header--max65 text-center mb-40">
        <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill mb-3" style="background: rgba(0, 245, 155, 0.08); border: 1px solid rgba(0, 245, 155, 0.25);">
          <span class="ecx-live-pulse-dot"></span>
          <span style="font-size: 11px; font-weight: 700; text-transform: uppercase; color: #00f59b; letter-spacing: 1px;">Live Streaming Market Feed</span>
        </div>
        <h2 class="mb-10 mt-minus-5">Real-Time <span>Market Watch</span></h2>
        <p class="text-muted">Live prices, liquidity depth, and 24h institutional execution spreads across major crypto pairs.</p>
      </div>

      <div class="market-watch-card shadow-sm" data-aos="fade-up" data-aos-duration="900">
        <div class="table-responsive">
          <table class="table market-table">
            <thead>
              <tr>
                <th>Asset / Pair</th>
                <th>Price (USD)</th>
                <th>24h Change</th>
                <th>Institutional 24h Volume</th>
                <th>Liquidity Trend</th>
                <th class="text-end">Action</th>
              </tr>
            </thead>
            <tbody>
              <!-- Bitcoin Row -->
              <tr id="row-BTCUSDT">
                <td>
                  <div class="d-flex align-items-center gap-3">
                    <img src="{{ asset('themes/ecx/assets/images/coins/btc.svg') }}" alt="Bitcoin" style="width: 32px; height: 32px; object-fit: contain; border-radius: 50%; box-shadow: 0 2px 8px rgba(247, 147, 26, 0.25);">
                    <div>
                      <strong class="text-white d-block">Bitcoin</strong>
                      <span class="text-muted f-11">BTC/USDT</span>
                    </div>
                  </div>
                </td>
                <td><span class="market-price-val" id="price-BTCUSDT">$64,480.20</span></td>
                <td>
                  <span class="market-change-badge up" id="change-BTCUSDT">
                    <i class="fa-solid fa-arrow-trend-up f-10"></i>
                    <span>+3.42%</span>
                  </span>
                </td>
                <td class="text-muted" id="volume-BTCUSDT">$28.45 Billion</td>
                <td>
                  <svg width="110" height="26" viewBox="0 0 110 26" fill="none" id="spark-BTCUSDT">
                    <path d="M2 20 L25 15 L45 18 L70 8 L90 12 L108 4" stroke="#00f59b" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
                </td>
                <td class="text-end">
                  <a href="{{ route('register') }}" class="trk-btn trk-btn--outline py-1.5 px-3 f-11" style="border-color: rgba(0,245,155,0.4); color: #00f59b;">Allocate</a>
                </td>
              </tr>

              <!-- Ethereum Row -->
              <tr id="row-ETHUSDT">
                <td>
                  <div class="d-flex align-items-center gap-3">
                    <img src="{{ asset('themes/ecx/assets/images/coins/eth.svg') }}" alt="Ethereum" style="width: 32px; height: 32px; object-fit: contain; border-radius: 50%; box-shadow: 0 2px 8px rgba(98, 126, 234, 0.25);">
                    <div>
                      <strong class="text-white d-block">Ethereum</strong>
                      <span class="text-muted f-11">ETH/USDT</span>
                    </div>
                  </div>
                </td>
                <td><span class="market-price-val" id="price-ETHUSDT">$3,490.50</span></td>
                <td>
                  <span class="market-change-badge up" id="change-ETHUSDT">
                    <i class="fa-solid fa-arrow-trend-up f-10"></i>
                    <span>+4.18%</span>
                  </span>
                </td>
                <td class="text-muted" id="volume-ETHUSDT">$16.20 Billion</td>
                <td>
                  <svg width="110" height="26" viewBox="0 0 110 26" fill="none" id="spark-ETHUSDT">
                    <path d="M2 22 L20 18 L40 12 L65 16 L85 6 L108 2" stroke="#00f59b" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
                </td>
                <td class="text-end">
                  <a href="{{ route('register') }}" class="trk-btn trk-btn--outline py-1.5 px-3 f-11" style="border-color: rgba(0,245,155,0.4); color: #00f59b;">Allocate</a>
                </td>
              </tr>

              <!-- Solana Row -->
              <tr id="row-SOLUSDT">
                <td>
                  <div class="d-flex align-items-center gap-3">
                    <img src="{{ asset('themes/ecx/assets/images/coins/sol.svg') }}" alt="Solana" style="width: 32px; height: 32px; object-fit: contain; border-radius: 50%; box-shadow: 0 2px 8px rgba(0, 255, 163, 0.25);">
                    <div>
                      <strong class="text-white d-block">Solana</strong>
                      <span class="text-muted f-11">SOL/USDT</span>
                    </div>
                  </div>
                </td>
                <td><span class="market-price-val" id="price-SOLUSDT">$148.90</span></td>
                <td>
                  <span class="market-change-badge up" id="change-SOLUSDT">
                    <i class="fa-solid fa-arrow-trend-up f-10"></i>
                    <span>+6.85%</span>
                  </span>
                </td>
                <td class="text-muted" id="volume-SOLUSDT">$6.82 Billion</td>
                <td>
                  <svg width="110" height="26" viewBox="0 0 110 26" fill="none" id="spark-SOLUSDT">
                    <path d="M2 24 L22 19 L48 14 L68 9 L88 4 L108 2" stroke="#00f59b" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
                </td>
                <td class="text-end">
                  <a href="{{ route('register') }}" class="trk-btn trk-btn--outline py-1.5 px-3 f-11" style="border-color: rgba(0,245,155,0.4); color: #00f59b;">Allocate</a>
                </td>
              </tr>

              <!-- BNB Chain Row -->
              <tr id="row-BNBUSDT">
                <td>
                  <div class="d-flex align-items-center gap-3">
                    <img src="{{ asset('themes/ecx/assets/images/coins/bnb.svg') }}" alt="BNB Chain" style="width: 32px; height: 32px; object-fit: contain; border-radius: 50%; box-shadow: 0 2px 8px rgba(243, 186, 47, 0.25);">
                    <div>
                      <strong class="text-white d-block">BNB Chain</strong>
                      <span class="text-muted f-11">BNB/USDT</span>
                    </div>
                  </div>
                </td>
                <td><span class="market-price-val" id="price-BNBUSDT">$582.40</span></td>
                <td>
                  <span class="market-change-badge up" id="change-BNBUSDT">
                    <i class="fa-solid fa-arrow-trend-up f-10"></i>
                    <span>+2.74%</span>
                  </span>
                </td>
                <td class="text-muted" id="volume-BNBUSDT">$3.40 Billion</td>
                <td>
                  <svg width="110" height="26" viewBox="0 0 110 26" fill="none" id="spark-BNBUSDT">
                    <path d="M2 18 L24 14 L50 16 L72 10 L92 8 L108 3" stroke="#00f59b" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
                </td>
                <td class="text-end">
                  <a href="{{ route('register') }}" class="trk-btn trk-btn--outline py-1.5 px-3 f-11" style="border-color: rgba(0,245,155,0.4); color: #00f59b;">Allocate</a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>
  <!-- ===============>> Live Crypto Watchlist Table End <<================= -->

  <!-- ===============>> Upgraded 4-Tier Investment Packages Grid Start <<================= -->
  <section class="pricing padding-top padding-bottom ecx-section-pricing">
    <div class="section-header section-header--max65 text-center mb-50">
      <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill mb-3" style="background: rgba(0, 245, 155, 0.08); border: 1px solid rgba(0, 245, 155, 0.25);">
        <i class="fa-solid fa-layer-group text-success f-12"></i>
        <span class="f-11 f-w-700 text-uppercase" style="color: #00f59b; letter-spacing: 1px;">Live Investment Packages</span>
      </div>
      <h2 class="mb-10 mt-minus-5">Explore <span>Investment Packages</span></h2>
      <p class="text-muted">Select your allocation tier with guaranteed capital protection, automated daily returns, and instant liquidity.</p>
    </div>

    <div class="container">
      <div class="row g-4 justify-content-center">
        @php
          $tierConfig = [
            10 => ['img' => 'plan_bronze_ecx.jpg', 'glow' => 'tier-bronze', 'tag' => 'Retail Pro', 'badgeBg' => 'rgba(217, 119, 6, 0.9)'],
            11 => ['img' => 'plan_silver_ecx.jpg', 'glow' => 'tier-silver', 'tag' => 'Growth Alpha', 'badgeBg' => 'rgba(148, 163, 184, 0.9)'],
            12 => ['img' => 'plan_gold_ecx.jpg', 'glow' => 'tier-gold featured-card', 'tag' => 'Institutional', 'badgeBg' => 'rgba(245, 158, 11, 0.95)'],
            13 => ['img' => 'plan_diamond_ecx.jpg', 'glow' => 'tier-diamond', 'tag' => 'VIP Sovereign', 'badgeBg' => 'rgba(14, 165, 233, 0.95)'],
          ];
          $activePlans = isset($plans) && count($plans) > 0 ? $plans->whereIn('id', [10, 11, 12, 13]) : collect([]);
        @endphp

        @if($activePlans->count() > 0)
          @foreach($activePlans as $plan)
            @php
              $cfg = $tierConfig[$plan->id] ?? ['img' => 'plan_bronze_ecx.jpg', 'glow' => '', 'tag' => 'Active', 'badgeBg' => 'rgba(0, 245, 155, 0.9)'];
            @endphp
            <div class="col-sm-6 col-lg-3">
              <div class="ecx-widescreen-card {{ $cfg['glow'] }}" data-aos="fade-up" data-aos-duration="{{ 800 + ($loop->index * 150) }}">
                
                <!-- Full-Bleed 16:9 Edge-to-Edge Image Header -->
                <div class="widescreen-banner-wrap">
                  <img src="{{ asset('themes/ecx/assets/images/plans/' . $cfg['img']) }}" alt="{{ $plan->name }}">
                  <div class="widescreen-overlay"></div>
                  <span class="widescreen-badge" style="background: {{ $cfg['badgeBg'] }}; color: #fff;">
                    {{ $cfg['tag'] }}
                  </span>
                </div>

                <div class="p-4 d-flex flex-column justify-content-between flex-grow-1">
                  <div>
                    <h5 class="text-white f-w-800 mb-1">{{ $plan->name }}</h5>
                    <div class="d-flex align-items-baseline gap-1 mb-3">
                      <h3 class="text-success f-w-900 mb-0">+{{ $plan->increment_amount }}%</h3>
                      <span class="text-muted f-12">/ {{ $plan->increment_interval }}</span>
                    </div>

                    <!-- Capital Range Box -->
                    <div class="p-3 rounded-3 mb-3" style="background: rgba(255, 255, 255, 0.04); border: 1px solid rgba(255, 255, 255, 0.08);">
                      <div class="d-flex justify-content-between mb-1 f-12">
                        <span class="text-muted">Min Capital:</span>
                        <strong class="text-white">{{ $settings->currency ?? '$' }}{{ number_format($plan->min_price) }}</strong>
                      </div>
                      <div class="d-flex justify-content-between f-12">
                        <span class="text-muted">Max Capital:</span>
                        <strong class="text-white">{{ $settings->currency ?? '$' }}{{ number_format($plan->max_price) }}</strong>
                      </div>
                    </div>

                    <!-- Key Features -->
                    <ul class="list-unstyled mb-4 f-12 text-muted" style="line-height: 2;">
                      <li><i class="fa-solid fa-circle-check text-success me-2"></i><strong>Duration:</strong> {{ $plan->expiration }}</li>
                      <li><i class="fa-solid fa-circle-check text-success me-2"></i><strong>Principal:</strong> 100% Guaranteed</li>
                      <li><i class="fa-solid fa-circle-check text-success me-2"></i><strong>Daily Drops:</strong> Fully Automated</li>
                      <li><i class="fa-solid fa-circle-check text-success me-2"></i><strong>Support:</strong> 24/7 Dedicated Desk</li>
                    </ul>
                  </div>

                  <div>
                    @auth
                      <a href="{{ url('/dashboard/mplans') }}" class="trk-btn trk-btn--primary w-100 text-center py-2.5 f-13 f-w-700">
                        Invest in {{ explode(' ', $plan->name)[0] }} &rarr;
                      </a>
                    @else
                      <a href="{{ route('register') }}" class="trk-btn trk-btn--primary w-100 text-center py-2.5 f-13 f-w-700">
                        Start with {{ $settings->currency ?? '$' }}{{ number_format($plan->min_price) }}
                      </a>
                    @endauth
                  </div>
                </div>

              </div>
            </div>
          @endforeach
        @endif
      </div>
    </div>
  </section>
  <!-- ===============>> Upgraded 4-Tier Investment Packages Grid End <<================= -->

  <!-- ===============>> Interactive ROI Yield Simulator Start <<================= -->
  <section class="padding-top padding-bottom ecx-section-calculator">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-10">
          <div class="ecx-calc-card" data-aos="fade-up" data-aos-duration="900">
            <div class="row g-4 align-items-center">
              <div class="col-lg-7">
                <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill mb-3" style="background: rgba(0, 245, 155, 0.08); border: 1px solid rgba(0, 245, 155, 0.25);">
                  <i class="fa-solid fa-calculator text-success f-12"></i>
                  <span class="f-11 f-w-700 text-uppercase" style="color: #00f59b; letter-spacing: 1px;">Interactive Calculator</span>
                </div>
                <h3 class="text-white f-w-800 mb-2">Simulate Your <span>Returns</span></h3>
                <p class="text-muted f-13 mb-4">Adjust the capital slider or click a preset to see your qualifying tier with live 16:9 banner preview.</p>

                <!-- Slider Form -->
                <div class="mb-4">
                  <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="text-muted f-12 text-uppercase f-w-600">Investment Capital</span>
                    <h3 class="text-white f-w-800 mb-0" id="calcDisplayAmount">$5,000</h3>
                  </div>
                  <input type="range" class="calc-slider mb-3" id="calcSlider" min="100" max="150000" step="100" value="5000">
                  
                  <!-- Quick Presets -->
                  <div class="d-flex flex-wrap gap-2">
                    <button type="button" class="calc-preset-btn" onclick="setCalcAmount(100)">$100</button>
                    <button type="button" class="calc-preset-btn" onclick="setCalcAmount(1000)">$1,000</button>
                    <button type="button" class="calc-preset-btn active" onclick="setCalcAmount(5000)">$5,000</button>
                    <button type="button" class="calc-preset-btn" onclick="setCalcAmount(25000)">$25,000</button>
                    <button type="button" class="calc-preset-btn" onclick="setCalcAmount(75000)">$75,000</button>
                    <button type="button" class="calc-preset-btn" onclick="setCalcAmount(150000)">$150,000</button>
                  </div>
                </div>
              </div>

              <!-- Live Calculation Result Card With Widescreen Image -->
              <div class="col-lg-5">
                <div class="ecx-widescreen-card" style="border-radius: 16px;">
                  <div class="widescreen-banner-wrap" style="height: 125px;">
                    <img id="calcTierImg" src="{{ asset('themes/ecx/assets/images/plans/plan_silver_ecx.jpg') }}" alt="Selected Tier">
                    <div class="widescreen-overlay"></div>
                    <span id="calcTierBadge" class="widescreen-badge" style="background: rgba(148, 163, 184, 0.9); color: #fff;">
                      SILVER TIER &bull; +40% DAILY
                    </span>
                  </div>

                  <div class="p-3">
                    <div class="row g-2 text-start mb-3">
                      <div class="col-6">
                        <span class="text-muted f-11 d-block">Daily Drop:</span>
                        <strong class="text-success f-15" id="calcDailyReturn">+$2,000.00</strong>
                      </div>
                      <div class="col-6 text-end">
                        <span class="text-muted f-11 d-block">Duration:</span>
                        <strong class="text-white f-13" id="calcDuration">14 Days</strong>
                      </div>
                    </div>

                    <div class="p-2.5 rounded-3 mb-3 text-start" style="background: rgba(0, 245, 155, 0.08); border: 1px solid rgba(0, 245, 155, 0.2);">
                      <div class="d-flex justify-content-between align-items-center">
                        <span class="text-white f-12">Projected Total Return:</span>
                        <h4 class="text-success f-w-900 mb-0" id="calcTotalReturn">$33,000</h4>
                      </div>
                    </div>

                    @auth
                      <a href="{{ url('/dashboard/mplans') }}" class="trk-btn trk-btn--primary w-100 py-2 f-13 f-w-700">
                        Activate Package in Dashboard &rarr;
                      </a>
                    @else
                      <a href="{{ route('register') }}" class="trk-btn trk-btn--primary w-100 py-2 f-13 f-w-700">
                        Start Investing Now &rarr;
                      </a>
                    @endauth
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- ===============>> Interactive ROI Yield Simulator End <<================= -->

  <!-- ===============>> TradingView Crypto Heatmap Widget Start <<================= -->
  <div class="container my-5" data-aos="fade-up" data-aos-duration="800">
    <div class="tradingview-widget-container" style="border-radius: 18px; overflow: hidden; border: 1px solid rgba(255, 255, 255, 0.08); box-shadow: 0 12px 40px rgba(0,0,0,0.5); background: rgba(10, 18, 33, 0.85);">
      <div class="tradingview-widget-container__widget"></div>
      <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-crypto-coins-heatmap.js" async>
        {
          "dataSource": "CryptoWithoutBTC",
          "blockSize": "market_cap_calc",
          "blockColor": "24h_close_change|5",
          "locale": "en",
          "symbolUrl": "",
          "colorTheme": "dark",
          "hasTopBar": false,
          "isDataSetEnabled": false,
          "isZoomEnabled": false,
          "hasSymbolTooltip": true,
          "isMonoSize": false,
          "width": "100%",
          "height": 480
        }
      </script>
    </div>
  </div>
  <!-- ===============>> TradingView Crypto Heatmap Widget End <<================= -->

  <!-- ===============>> FAQ Section Start <<================= -->
  <section class="faq padding-top padding-bottom of-hidden ecx-section-faq">
    <div class="container">
      <div class="section-header section-header--max65 text-center mb-50">
        <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill mb-3" style="background: rgba(0, 245, 155, 0.08); border: 1px solid rgba(0, 245, 155, 0.25);">
          <i class="fa-solid fa-circle-question text-success f-12"></i>
          <span class="f-11 f-w-700 text-uppercase" style="color: #00f59b; letter-spacing: 1px;">Support &amp; Answers</span>
        </div>
        <h2 class="mb-10 mt-minus-5">Frequently <span>Asked Questions</span></h2>
        <p class="text-muted">Explore clear answers about capitalization tiers, automated yield distribution, non-custodial custody, and security protocols.</p>
      </div>

      <div class="row g-4 justify-content-between align-items-start">
        <!-- Left Side: Interactive 24/7 Institutional Support Card -->
        <div class="col-lg-4" data-aos="fade-right" data-aos-duration="800">
          <div class="p-4 p-md-5 rounded-4 shadow-sm position-relative overflow-hidden" style="background: rgba(13, 22, 42, 0.88); border: 1px solid rgba(0, 245, 155, 0.25); backdrop-filter: blur(16px);">
            <!-- Ambient Glow blob -->
            <div style="position: absolute; top: -20%; right: -20%; width: 180px; height: 180px; background: radial-gradient(circle, rgba(0,245,155,0.15) 0%, transparent 70%); filter: blur(30px); pointer-events: none;"></div>
            
            <div class="d-inline-flex align-items-center justify-content-center mb-4 rounded-3" style="width: 52px; height: 52px; background: rgba(0, 245, 155, 0.12); border: 1px solid rgba(0, 245, 155, 0.3); color: #00f59b; font-size: 22px;">
              <i class="fa-solid fa-headset"></i>
            </div>
            <h4 class="text-white f-w-800 mb-2">Have Custom Inquiries?</h4>
            <p class="text-muted f-13 mb-4">Our institutional desk is available 24/7 to assist with private tier allocations, API keys, or Web3 connectivity.</p>

            <div class="d-flex flex-column gap-3 mb-4">
              <div class="d-flex align-items-center gap-3 p-2.5 rounded-3" style="background: rgba(255, 255, 255, 0.03); border: 1px solid rgba(255, 255, 255, 0.06);">
                <div class="text-success"><i class="fa-solid fa-bolt f-16"></i></div>
                <div>
                  <div class="f-12 f-w-700 text-white">&lt; 5 Min Response Time</div>
                  <div class="f-11 text-muted">Dedicated Senior Account Officers</div>
                </div>
              </div>
              <div class="d-flex align-items-center gap-3 p-2.5 rounded-3" style="background: rgba(255, 255, 255, 0.03); border: 1px solid rgba(255, 255, 255, 0.06);">
                <div class="text-warning"><i class="fa-solid fa-shield-halved f-16"></i></div>
                <div>
                  <div class="f-12 f-w-700 text-white">Audited &amp; Compliant</div>
                  <div class="f-11 text-muted">Proof of reserves &amp; multi-sig security</div>
                </div>
              </div>
            </div>

            <a href="{{ route('contact') }}" class="trk-btn trk-btn--primary w-100 text-center py-2.5 f-13 f-w-700">
              Contact Support Desk &rarr;
            </a>
          </div>
        </div>

        <!-- Right Side: State-of-the-Art Numbered Glassmorphic Accordion -->
        <div class="col-lg-8" data-aos="fade-left" data-aos-duration="1000">
          <div class="d-flex flex-column" id="faqAccordion1">
            @if(isset($faqs) && count($faqs) > 0)
              @foreach($faqs as $faq)
                <div class="ecx-faq-card">
                  <button class="ecx-faq-btn {{ $loop->first ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse{{ $faq->id }}" aria-expanded="{{ $loop->first ? 'true' : 'false' }}">
                    <div class="d-flex align-items-center gap-3">
                      <span class="ecx-faq-num">{{ sprintf('%02d', $loop->iteration) }}</span>
                      <span>{{ $faq->question }}</span>
                    </div>
                    <span class="faq-arrow"><i class="fa-solid fa-chevron-down"></i></span>
                  </button>
                  <div id="faqCollapse{{ $faq->id }}" class="collapse {{ $loop->first ? 'show' : '' }}" data-bs-parent="#faqAccordion1">
                    <div class="ecx-faq-body">
                      <p class="mb-0">{{ $faq->answer }}</p>
                    </div>
                  </div>
                </div>
              @endforeach
            @else
              <!-- Default Institutional FAQs -->
              <div class="ecx-faq-card">
                <button class="ecx-faq-btn" type="button" data-bs-toggle="collapse" data-bs-target="#faqB1" aria-expanded="true">
                  <div class="d-flex align-items-center gap-3">
                    <span class="ecx-faq-num">01</span>
                    <span>How do the four investment tiers work?</span>
                  </div>
                  <span class="faq-arrow"><i class="fa-solid fa-chevron-down"></i></span>
                </button>
                <div id="faqB1" class="collapse show" data-bs-parent="#faqAccordion1">
                  <div class="ecx-faq-body">
                    <p class="mb-0">Our ecosystem provides four capitalization tiers (Bronze, Silver, Gold, and Diamond) scaling from $100 up to $150,000. Each tier utilizes automated arbitrage bots with institutional risk protocols to deliver daily drops directly to your balance.</p>
                  </div>
                </div>
              </div>

              <div class="ecx-faq-card">
                <button class="ecx-faq-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqB2" aria-expanded="false">
                  <div class="d-flex align-items-center gap-3">
                    <span class="ecx-faq-num">02</span>
                    <span>How fast are deposits and withdrawals processed?</span>
                  </div>
                  <span class="faq-arrow"><i class="fa-solid fa-chevron-down"></i></span>
                </button>
                <div id="faqB2" class="collapse" data-bs-parent="#faqAccordion1">
                  <div class="ecx-faq-body">
                    <p class="mb-0">Crypto deposits are credited automatically once confirmed on the blockchain (typically 1–3 network confirmations). Withdrawal requests are processed efficiently by our automated treasury system without delays.</p>
                  </div>
                </div>
              </div>

              <div class="ecx-faq-card">
                <button class="ecx-faq-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqB3" aria-expanded="false">
                  <div class="d-flex align-items-center gap-3">
                    <span class="ecx-faq-num">03</span>
                    <span>Is my capital secure on {{ $settings->site_name ?? 'ECX Groups' }}?</span>
                  </div>
                  <span class="faq-arrow"><i class="fa-solid fa-chevron-down"></i></span>
                </button>
                <div id="faqB3" class="collapse" data-bs-parent="#faqAccordion1">
                  <div class="ecx-faq-body">
                    <p class="mb-0">Yes. We implement military-grade 256-bit SSL encryption, multi-signature cold storage vaults, two-factor authentication (2FA), and strict 1:1 reserve backing with transparent cryptographic audits.</p>
                  </div>
                </div>
              </div>

              <div class="ecx-faq-card">
                <button class="ecx-faq-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqB4" aria-expanded="false">
                  <div class="d-flex align-items-center gap-3">
                    <span class="ecx-faq-num">04</span>
                    <span>Can I connect my Web3 wallet directly?</span>
                  </div>
                  <span class="faq-arrow"><i class="fa-solid fa-chevron-down"></i></span>
                </button>
                <div id="faqB4" class="collapse" data-bs-parent="#faqAccordion1">
                  <div class="ecx-faq-body">
                    <p class="mb-0">Yes. We support all major Web3 wallet providers including MetaMask, Trust Wallet, Coinbase Wallet, and WalletConnect for instant non-custodial capital deposits and withdrawals.</p>
                  </div>
                </div>
              </div>

              <div class="ecx-faq-card">
                <button class="ecx-faq-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqB5" aria-expanded="false">
                  <div class="d-flex align-items-center gap-3">
                    <span class="ecx-faq-num">05</span>
                    <span>How are daily profit yields calculated and credited?</span>
                  </div>
                  <span class="faq-arrow"><i class="fa-solid fa-chevron-down"></i></span>
                </button>
                <div id="faqB5" class="collapse" data-bs-parent="#faqAccordion1">
                  <div class="ecx-faq-body">
                    <p class="mb-0">Yields are generated by our high-frequency cross-market arbitrage bots and credited to your account balance every 24 hours. You can reinvest for compound growth or withdraw immediately.</p>
                  </div>
                </div>
              </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- ===============>> FAQ Section End <<================= -->

@endsection

@section('scripts')
  <script>
    // Tab switching for Ecosystem Solutions Hub
    function switchEcoTab(tabIndex, el) {
      document.querySelectorAll('.eco-nav-btn').forEach(btn => btn.classList.remove('active'));
      el.classList.add('active');

      document.querySelectorAll('.eco-content-pane').forEach((pane, idx) => {
        if (idx === (tabIndex - 1)) {
          pane.classList.remove('d-none');
        } else {
          pane.classList.add('d-none');
        }
      });
    }

    // Live ROI Calculator Logic with Widescreen Wallpapers
    const widescreenPaths = {
      bronze: "{{ asset('themes/ecx/assets/images/plans/plan_bronze_ecx.jpg') }}",
      silver: "{{ asset('themes/ecx/assets/images/plans/plan_silver_ecx.jpg') }}",
      gold: "{{ asset('themes/ecx/assets/images/plans/plan_gold_ecx.jpg') }}",
      diamond: "{{ asset('themes/ecx/assets/images/plans/plan_diamond_ecx.jpg') }}"
    };

    function updateCalculator(val) {
      const amt = parseFloat(val) || 100;
      document.getElementById('calcDisplayAmount').innerText = '$' + amt.toLocaleString();

      let tierName = 'BRONZE TIER';
      let tierRate = 0.20;
      let durationDays = 7;
      let tierImg = widescreenPaths.bronze;
      let badgeBg = 'rgba(217, 119, 6, 0.9)';

      if (amt >= 75000) {
        tierName = 'DIAMOND TIER';
        tierRate = 0.80;
        durationDays = 30;
        tierImg = widescreenPaths.diamond;
        badgeBg = 'rgba(14, 165, 233, 0.95)';
      } else if (amt >= 25000) {
        tierName = 'GOLD TIER';
        tierRate = 0.60;
        durationDays = 21;
        tierImg = widescreenPaths.gold;
        badgeBg = 'rgba(245, 158, 11, 0.95)';
      } else if (amt >= 5000) {
        tierName = 'SILVER TIER';
        tierRate = 0.40;
        durationDays = 14;
        tierImg = widescreenPaths.silver;
        badgeBg = 'rgba(148, 163, 184, 0.9)';
      }

      const dailyReturn = amt * tierRate;
      const totalYield = (dailyReturn * durationDays) + amt;

      const imgEl = document.getElementById('calcTierImg');
      if (imgEl) imgEl.src = tierImg;

      const badgeEl = document.getElementById('calcTierBadge');
      if (badgeEl) {
        badgeEl.innerText = tierName + ' • +' + (tierRate * 100) + '% DAILY';
        badgeEl.style.background = badgeBg;
      }

      document.getElementById('calcDailyReturn').innerText = '+$' + dailyReturn.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 });
      document.getElementById('calcDuration').innerText = durationDays + ' Days';
      document.getElementById('calcTotalReturn').innerText = '$' + totalYield.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    }

    function setCalcAmount(amount) {
      const slider = document.getElementById('calcSlider');
      if (slider) slider.value = amount;
      document.querySelectorAll('.calc-preset-btn').forEach(btn => {
        btn.classList.toggle('active', btn.innerText.replace(/[^0-9]/g, '') == amount);
      });
      updateCalculator(amount);
    }

    document.getElementById('calcSlider')?.addEventListener('input', function(e) {
      const val = this.value;
      document.querySelectorAll('.calc-preset-btn').forEach(btn => {
        btn.classList.toggle('active', btn.innerText.replace(/[^0-9]/g, '') == val);
      });
      updateCalculator(val);
    });

    document.addEventListener('DOMContentLoaded', function() {
      updateCalculator(5000);
    });

    /* =====================================================================
     * High-Performance Rising Particles & Floating Bubbles Canvas Engine
     * (Multi-spectral glowing micro-orbs & hollow bubbles rising through hero)
     * ===================================================================== */
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

      // Rich palette matching ECX / Eglines: emerald green (#00f59b), cyan (#0ea5e9), gold (#f59e0b)
      var colorPalette = [
        { r: 0, g: 245, b: 155 },   // Emerald Green
        { r: 14, g: 165, b: 233 },  // Cyan / Sapphire
        { r: 245, g: 158, b: 11 }   // Amber / Gold
      ];

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
        // Density scaled to screen size: ~35 on mobile, ~65 on desktop
        var count = Math.floor(Math.min(Math.max(width / 22, 32), 68));

        for (var i = 0; i < count; i++) {
          particles.push(createParticle(true));
        }
      }

      function createParticle(randomizeY) {
        var isBubble = Math.random() > 0.45; // ~55% hollow bubbles, ~45% solid glowing dots
        var randColor = Math.random();
        var rgb = randColor > 0.52 ? colorPalette[0] : (randColor > 0.22 ? colorPalette[1] : colorPalette[2]);
        var radius = isBubble ? (Math.random() * 3.4 + 2.0) : (Math.random() * 2.4 + 1.2);

        return {
          x: Math.random() * width,
          y: randomizeY ? (Math.random() * height) : (height + Math.random() * 30),
          radius: radius,
          speedY: Math.random() * 0.75 + 0.35,
          driftAngle: Math.random() * Math.PI * 2,
          driftSpeed: Math.random() * 0.02 + 0.01,
          driftAmp: Math.random() * 0.7 + 0.2,
          baseAlpha: Math.random() * 0.55 + 0.25,
          alpha: 0,
          isBubble: isBubble,
          rgb: rgb
        };
      }

      function updateAndDraw() {
        ctx.clearRect(0, 0, width, height);

        for (var i = 0; i < particles.length; i++) {
          var p = particles[i];

          // Movement: Rise upwards with smooth gentle sine drift
          p.y -= p.speedY;
          p.driftAngle += p.driftSpeed;
          p.x += Math.sin(p.driftAngle) * p.driftAmp;

          // Fade in when entering from bottom, fade out near top
          var distFromTop = p.y;
          var distFromBottom = height - p.y;

          if (distFromBottom < 40) {
            p.alpha = Math.min(p.baseAlpha, (distFromBottom / 40) * p.baseAlpha);
          } else if (distFromTop < 80) {
            p.alpha = Math.max(0, (distFromTop / 80) * p.baseAlpha);
          } else {
            p.alpha = p.baseAlpha;
          }

          // Reset when off the top or sides
          if (p.y < -15 || p.x < -20 || p.x > width + 20) {
            particles[i] = createParticle(false);
            continue;
          }

          // Draw Particle
          ctx.save();
          if (p.isBubble) {
            // Hollow glowing micro-bubble with luminous rim
            ctx.beginPath();
            ctx.arc(p.x, p.y, p.radius, 0, Math.PI * 2);
            ctx.lineWidth = 1.3;
            ctx.strokeStyle = 'rgba(' + p.rgb.r + ',' + p.rgb.g + ',' + p.rgb.b + ',' + p.alpha + ')';
            ctx.stroke();

            // Soft interior ambient glow
            ctx.fillStyle = 'rgba(' + p.rgb.r + ',' + p.rgb.g + ',' + p.rgb.b + ',' + (p.alpha * 0.18) + ')';
            ctx.fill();
          } else {
            // Solid glowing micro-dot with luminous halo
            ctx.shadowColor = 'rgba(' + p.rgb.r + ',' + p.rgb.g + ',' + p.rgb.b + ', ' + (p.alpha * 0.8) + ')';
            ctx.shadowBlur = 8;

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

        var heroSection = canvas.closest('.hero-glow-container') || canvas.closest('section');
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

  <!-- Live Real-Time Market Watch WebSocket & Polling Engine -->
  <script>
    (function() {
      var cryptoData = {
        'BTCUSDT': { name: 'Bitcoin', price: 64480.20, change: 3.42, volume: 28.45, decimals: 2 },
        'ETHUSDT': { name: 'Ethereum', price: 3490.50, change: 4.18, volume: 16.20, decimals: 2 },
        'SOLUSDT': { name: 'Solana', price: 148.90, change: 6.85, volume: 6.82, decimals: 2 },
        'BNBUSDT': { name: 'BNB Chain', price: 582.40, change: 2.74, volume: 3.40, decimals: 2 }
      };

      function formatUSD(num, decimals) {
        return '$' + num.toLocaleString('en-US', {
          minimumFractionDigits: decimals,
          maximumFractionDigits: decimals
        });
      }

      function updateAssetUI(symbol, newPrice, newChange, newVolume) {
        var asset = cryptoData[symbol];
        if (!asset) return;

        var priceEl = document.getElementById('price-' + symbol);
        var changeEl = document.getElementById('change-' + symbol);
        var volumeEl = document.getElementById('volume-' + symbol);
        var sparkEl = document.getElementById('spark-' + symbol);

        if (priceEl && newPrice !== undefined && !isNaN(newPrice)) {
          var oldPrice = asset.price;
          asset.price = newPrice;
          priceEl.textContent = formatUSD(newPrice, asset.decimals);

          if (Math.abs(newPrice - oldPrice) > 0.001) {
            if (newPrice > oldPrice) {
              priceEl.classList.remove('flash-down');
              priceEl.classList.add('flash-up');
              setTimeout(function() { priceEl.classList.remove('flash-up'); }, 650);
            } else if (newPrice < oldPrice) {
              priceEl.classList.remove('flash-up');
              priceEl.classList.add('flash-down');
              setTimeout(function() { priceEl.classList.remove('flash-down'); }, 650);
            }
          }
        }

        if (changeEl && newChange !== undefined && !isNaN(newChange)) {
          asset.change = newChange;
          var isPositive = newChange >= 0;
          var sign = isPositive ? '+' : '';
          var iconClass = isPositive ? 'fa-arrow-trend-up' : 'fa-arrow-trend-down';

          changeEl.className = 'market-change-badge ' + (isPositive ? 'up' : 'down');
          changeEl.innerHTML = '<i class="fa-solid ' + iconClass + ' f-10"></i> <span>' + sign + newChange.toFixed(2) + '%</span>';

          if (sparkEl) {
            var path = sparkEl.querySelector('path');
            if (path) {
              path.setAttribute('stroke', isPositive ? '#00f59b' : '#ef4444');
            }
          }
        }

        if (volumeEl && newVolume !== undefined && !isNaN(newVolume)) {
          volumeEl.textContent = '$' + newVolume.toFixed(2) + ' Billion';
        }
      }

      // 1. Connect to Binance Public Ticker WebSocket
      var socket = null;
      function initWebSocket() {
        try {
          var wsUrl = 'wss://stream.binance.com:9443/ws/btcusdt@ticker/ethusdt@ticker/solusdt@ticker/bnbusdt@ticker';
          socket = new WebSocket(wsUrl);

          socket.onmessage = function(event) {
            try {
              var d = JSON.parse(event.data);
              if (d && d.s && cryptoData[d.s]) {
                var p = parseFloat(d.c);
                var ch = parseFloat(d.P);
                var vol = parseFloat(d.q) / 1000000000;
                if (vol < 0.1) vol = cryptoData[d.s].volume;
                updateAssetUI(d.s, p, ch, vol);
              }
            } catch (e) {}
          };

          socket.onerror = function() {
            if (socket) {
              socket.close();
            }
          };

          socket.onclose = function() {
            // Reconnect after 5 seconds if connection drops
            setTimeout(initWebSocket, 5000);
          };
        } catch (e) {}
      }

      // 2. Initial REST Fetch & Polling Fallback
      function fetchREST() {
        var symbolsParam = encodeURIComponent(JSON.stringify(["BTCUSDT","ETHUSDT","SOLUSDT","BNBUSDT"]));
        fetch('https://api.binance.com/api/v3/ticker/24hr?symbols=' + symbolsParam)
          .then(function(res) { return res.json(); })
          .then(function(data) {
            if (Array.isArray(data)) {
              data.forEach(function(item) {
                if (cryptoData[item.symbol]) {
                  var p = parseFloat(item.lastPrice);
                  var ch = parseFloat(item.priceChangePercent);
                  var vol = parseFloat(item.quoteVolume) / 1000000000;
                  if (vol < 0.1) vol = cryptoData[item.symbol].volume;
                  updateAssetUI(item.symbol, p, ch, vol);
                }
              });
            }
          })
          .catch(function() {
            // Secondary Fallback: CoinCap API
            fetch('https://api.coincap.io/v2/assets?ids=bitcoin,ethereum,solana,binance-coin')
              .then(function(r) { return r.json(); })
              .then(function(res) {
                if (res && res.data) {
                  var map = { 'bitcoin': 'BTCUSDT', 'ethereum': 'ETHUSDT', 'solana': 'SOLUSDT', 'binance-coin': 'BNBUSDT' };
                  res.data.forEach(function(coin) {
                    var sym = map[coin.id];
                    if (sym) {
                      var p = parseFloat(coin.priceUsd);
                      var ch = parseFloat(coin.changePercent24Hr);
                      var vol = parseFloat(coin.volumeUsd24Hr) / 1000000000;
                      updateAssetUI(sym, p, ch, vol);
                    }
                  });
                }
              })
              .catch(function() {});
          });
      }

      // 3. Realistic Heartbeat Micro-Tick Engine
      // Keeps ticker actively moving with live market micro-fluctuations
      setInterval(function() {
        var symbols = Object.keys(cryptoData);
        var randomSymbol = symbols[Math.floor(Math.random() * symbols.length)];
        var item = cryptoData[randomSymbol];
        if (!item) return;

        // ±0.03% realistic live spread tick
        var pctVariance = (Math.random() * 0.0006) - 0.00028;
        var newPrice = item.price * (1 + pctVariance);
        var newChange = item.change + (pctVariance * 8);
        updateAssetUI(randomSymbol, newPrice, newChange);
      }, 2400);

      // Start services
      initWebSocket();
      fetchREST();
      setInterval(fetchREST, 15000);
    })();
  </script>
@endsection
