@extends('home.ecx.layout')

@section('title', 'Services & Investment Proposals - ' . ($settings->site_name ?? 'ECX Groups'))

@section('content')
  <!-- ===============>> Page Header Start <<================= -->
  <section class="page-header">
    <div class="container">
      <div class="page-header__content" data-aos="fade-right" data-aos-duration="900">
        <div class="d-inline-flex align-items-center gap-2 px-3 py-1 mb-3 rounded-pill" style="background: rgba(0, 245, 155, 0.1); border: 1px solid rgba(0, 245, 155, 0.25); font-size: 12px; color: #00f59b; font-weight: 700;">
          <span style="width: 8px; height: 8px; border-radius: 50%; background: #00f59b; box-shadow: 0 0 10px #00f59b;"></span>
          Institutional Yield &amp; Digital Custody Solutions
        </div>
        <h2>Enterprise <span style="color: #00f59b;">Trading Services</span> &amp; Investment Proposals</h2>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Services</li>
          </ol>
        </nav>
      </div>
    </div>
  </section>
  <!-- ===============>> Page Header End <<================= -->

  <!-- ===============>> 6 Core Services Capabilities Grid <<================= -->
  <section class="py-5" style="background-color: #070b14;">
    <div class="container py-4">
      <div class="text-center mb-5" data-aos="fade-up" data-aos-duration="800">
        <div class="d-inline-flex align-items-center gap-2 px-3 py-1 mb-2 rounded-pill" style="background: rgba(0, 245, 155, 0.1); border: 1px solid rgba(0, 245, 155, 0.25); font-size: 11px; color: #00f59b; font-weight: 700; text-transform: uppercase; letter-spacing: 1px;">
          Core Capabilities
        </div>
        <h2 class="text-white fw-bold">Comprehensive Digital Asset Services</h2>
        <p class="text-white-50 mx-auto" style="max-width: 620px; font-size: 14.5px;">
          Engineered for institutional capital allocators, high-net-worth individuals, and active retail participants seeking market-neutral yields.
        </p>
      </div>

      <div class="row g-4">
        <!-- Service 1 -->
        <div class="col-12 col-md-6 col-lg-4" data-aos="fade-up" data-aos-duration="800">
          <div class="ecx-glass-card h-100 d-flex flex-column" style="border-top: 3px solid #00f59b;">
            <div class="d-flex align-items-center justify-content-between mb-3">
              <div style="width: 52px; height: 52px; border-radius: 12px; background: rgba(0, 245, 155, 0.1); border: 1px solid rgba(0, 245, 155, 0.25); display: flex; align-items: center; justify-content: center; color: #00f59b; font-size: 22px;">
                <i class="fas fa-chart-line"></i>
              </div>
              <span class="badge bg-success bg-opacity-10 text-success small">Algorithmic</span>
            </div>
            <h5 class="text-white fw-bold mb-2">Pro Quantitative Trading</h5>
            <p style="font-size: 13.5px; color: #94a3b8; line-height: 1.65; margin-bottom: 20px;">
              Smart order routing connecting directly into NASDAQ, CME crypto futures, and top 25 centralized exchanges to exploit high-frequency bid-ask imbalances.
            </p>
            <div class="mt-auto pt-2">
              <span class="text-success small fw-semibold d-inline-flex align-items-center gap-1">
                <span>Sub-millisecond execution</span>
                <i class="fas fa-check-circle f-12"></i>
              </span>
            </div>
          </div>
        </div>

        <!-- Service 2 -->
        <div class="col-12 col-md-6 col-lg-4" data-aos="fade-up" data-aos-duration="900">
          <div class="ecx-glass-card h-100 d-flex flex-column" style="border-top: 3px solid #0ea5e9;">
            <div class="d-flex align-items-center justify-content-between mb-3">
              <div style="width: 52px; height: 52px; border-radius: 12px; background: rgba(14, 165, 233, 0.1); border: 1px solid rgba(14, 165, 233, 0.25); display: flex; align-items: center; justify-content: center; color: #0ea5e9; font-size: 22px;">
                <i class="fas fa-robot"></i>
              </div>
              <span class="badge bg-info bg-opacity-10 text-info small">Autonomous</span>
            </div>
            <h5 class="text-white fw-bold mb-2">Neural Arbitrage Bot (Maxi Bot)</h5>
            <p style="font-size: 13.5px; color: #94a3b8; line-height: 1.65; margin-bottom: 20px;">
              Continuous autonomous scanning engine that identifies and executes simultaneous buy-and-sell pairs across disparate global liquidity pools with zero directional risk.
            </p>
            <div class="mt-auto pt-2">
              <span class="text-info small fw-semibold d-inline-flex align-items-center gap-1">
                <span>24/7/365 active harvesting</span>
                <i class="fas fa-check-circle f-12"></i>
              </span>
            </div>
          </div>
        </div>

        <!-- Service 3 -->
        <div class="col-12 col-md-6 col-lg-4" data-aos="fade-up" data-aos-duration="1000">
          <div class="ecx-glass-card h-100 d-flex flex-column" style="border-top: 3px solid #f59e0b;">
            <div class="d-flex align-items-center justify-content-between mb-3">
              <div style="width: 52px; height: 52px; border-radius: 12px; background: rgba(245, 158, 11, 0.1); border: 1px solid rgba(245, 158, 11, 0.25); display: flex; align-items: center; justify-content: center; color: #f59e0b; font-size: 22px;">
                <i class="fas fa-shield-alt"></i>
              </div>
              <span class="badge bg-warning bg-opacity-10 text-warning small">Custodial</span>
            </div>
            <h5 class="text-white fw-bold mb-2">Multi-Sig Cold Vault Custody</h5>
            <p style="font-size: 13.5px; color: #94a3b8; line-height: 1.65; margin-bottom: 20px;">
              Segregated institutional hardware security modules (HSM) with m-of-n multi-party computation. All customer deposits remain strictly ring-fenced and verifiable.
            </p>
            <div class="mt-auto pt-2">
              <span class="text-warning small fw-semibold d-inline-flex align-items-center gap-1">
                <span>Zero fund rehypothecation</span>
                <i class="fas fa-check-circle f-12"></i>
              </span>
            </div>
          </div>
        </div>

        <!-- Service 4 -->
        <div class="col-12 col-md-6 col-lg-4" data-aos="fade-up" data-aos-duration="800">
          <div class="ecx-glass-card h-100 d-flex flex-column" style="border-top: 3px solid #a855f7;">
            <div class="d-flex align-items-center justify-content-between mb-3">
              <div style="width: 52px; height: 52px; border-radius: 12px; background: rgba(168, 85, 247, 0.1); border: 1px solid rgba(168, 85, 247, 0.25); display: flex; align-items: center; justify-content: center; color: #c084fc; font-size: 22px;">
                <i class="fas fa-briefcase"></i>
              </div>
              <span class="badge bg-purple bg-opacity-10 text-white-50 small">Yield Mgmt</span>
            </div>
            <h5 class="text-white fw-bold mb-2">Portfolio Yield Optimization</h5>
            <p style="font-size: 13.5px; color: #94a3b8; line-height: 1.65; margin-bottom: 20px;">
              Automated daily profit distribution directly into client balances with compound growth options and instant liquidity access whenever withdrawals are requested.
            </p>
            <div class="mt-auto pt-2">
              <span class="text-white-50 small fw-semibold d-inline-flex align-items-center gap-1">
                <span>Daily automated credit</span>
                <i class="fas fa-check-circle f-12"></i>
              </span>
            </div>
          </div>
        </div>

        <!-- Service 5 -->
        <div class="col-12 col-md-6 col-lg-4" data-aos="fade-up" data-aos-duration="900">
          <div class="ecx-glass-card h-100 d-flex flex-column" style="border-top: 3px solid #10b981;">
            <div class="d-flex align-items-center justify-content-between mb-3">
              <div style="width: 52px; height: 52px; border-radius: 12px; background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.25); display: flex; align-items: center; justify-content: center; color: #10b981; font-size: 22px;">
                <i class="fas fa-credit-card"></i>
              </div>
              <span class="badge bg-success bg-opacity-10 text-success small">On-Ramp</span>
            </div>
            <h5 class="text-white fw-bold mb-2">Instant Fiat &amp; Card Gateway</h5>
            <p style="font-size: 13.5px; color: #94a3b8; line-height: 1.65; margin-bottom: 20px;">
              Frictionless fiat liquidity onboarding through Visa, Mastercard, SEPA, and international wire transfers, instantly converted into protected yield-bearing assets.
            </p>
            <div class="mt-auto pt-2">
              <span class="text-success small fw-semibold d-inline-flex align-items-center gap-1">
                <span>Multi-currency support</span>
                <i class="fas fa-check-circle f-12"></i>
              </span>
            </div>
          </div>
        </div>

        <!-- Service 6 -->
        <div class="col-12 col-md-6 col-lg-4" data-aos="fade-up" data-aos-duration="1000">
          <div class="ecx-glass-card h-100 d-flex flex-column" style="border-top: 3px solid #38bdf8;">
            <div class="d-flex align-items-center justify-content-between mb-3">
              <div style="width: 52px; height: 52px; border-radius: 12px; background: rgba(56, 189, 248, 0.1); border: 1px solid rgba(56, 189, 248, 0.25); display: flex; align-items: center; justify-content: center; color: #38bdf8; font-size: 22px;">
                <i class="fas fa-layer-group"></i>
              </div>
              <span class="badge bg-info bg-opacity-10 text-info small">Liquidity</span>
            </div>
            <h5 class="text-white fw-bold mb-2">Market Making &amp; Liquidity Depth</h5>
            <p style="font-size: 13.5px; color: #94a3b8; line-height: 1.65; margin-bottom: 20px;">
              Institutional liquidity provisioning tightening bid-ask spreads across illiquid cryptocurrency corridors, earning steady market maker spreads with zero directional holding.
            </p>
            <div class="mt-auto pt-2">
              <span class="text-info small fw-semibold d-inline-flex align-items-center gap-1">
                <span>Delta-neutral hedge</span>
                <i class="fas fa-check-circle f-12"></i>
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ===============>> Live 4-Tier Investment Proposals Section <<================= -->
  <section class="py-5" style="background: rgba(13, 22, 42, 0.4); border-top: 1px solid rgba(255, 255, 255, 0.05); border-bottom: 1px solid rgba(255, 255, 255, 0.05);">
    <div class="container py-4">
      <div class="text-center mb-5" data-aos="fade-up" data-aos-duration="800">
        <div class="d-inline-flex align-items-center gap-2 px-3 py-1 mb-2 rounded-pill" style="background: rgba(0, 245, 155, 0.1); border: 1px solid rgba(0, 245, 155, 0.25); font-size: 11px; color: #00f59b; font-weight: 700; text-transform: uppercase; letter-spacing: 1px;">
          Live Proposals
        </div>
        <h2 class="text-white fw-bold">Institutional Investment Tiers</h2>
        <p class="text-white-50 mx-auto" style="max-width: 600px; font-size: 14.5px;">
          Select the optimal yield tier matching your investment horizon. Returns accrue daily with full capital return upon cycle completion.
        </p>
      </div>

      <!-- 4 Plan Cards Grid -->
      <div class="row g-4 justify-content-center">
        
        <!-- Bronze Plan -->
        <div class="col-12 col-md-6 col-xl-3" data-aos="fade-up" data-aos-duration="800">
          <div class="ecx-glass-card h-100 p-0 overflow-hidden d-flex flex-column" style="border: 1px solid rgba(205, 127, 50, 0.35);">
            <div style="width: 100%; aspect-ratio: 16/9; overflow: hidden; position: relative;">
              <img src="{{ asset('themes/ecx/assets/images/plans/plan_bronze_ecx.jpg') }}" alt="Bronze Tier" class="w-100 h-100" style="object-fit: cover;" onerror="this.src='{{ asset('themes/ecx/assets/images/banner/home4/tier_bronze_widescreen.png') }}';">
              <span class="position-absolute top-0 end-0 m-2 badge px-2 py-1" style="background: rgba(205, 127, 50, 0.85); font-size: 10px; font-weight: 700;">BRONZE TIER</span>
            </div>
            <div class="p-4 d-flex flex-column flex-grow-1">
              <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="text-white fw-bold mb-0">Bronze Plan</h5>
                <span class="fs-4 fw-bold" style="color: #cd7f32;">20% <small class="text-white-50 fs-6">/ Daily</small></span>
              </div>
              <ul class="list-unstyled d-flex flex-column gap-2 mb-4" style="font-size: 13.5px; color: #cbd5e1;">
                <li class="d-flex justify-content-between"><span>Min Deposit:</span> <strong class="text-white">{{ $settings->currency ?? '$' }}100</strong></li>
                <li class="d-flex justify-content-between"><span>Max Deposit:</span> <strong class="text-white">{{ $settings->currency ?? '$' }}4,999</strong></li>
                <li class="d-flex justify-content-between"><span>Duration:</span> <strong class="text-white">7 Days</strong></li>
                <li class="d-flex justify-content-between"><span>Capital Return:</span> <strong class="text-success">Yes, 100%</strong></li>
                <li class="d-flex justify-content-between"><span>Support Desk:</span> <strong class="text-white">24/7 Standard</strong></li>
              </ul>
              <div class="mt-auto">
                <a href="{{ auth()->check() ? url('/dashboard/mplans') : route('register') }}" class="trk-btn trk-btn--border trk-btn--primary w-100 text-center py-2">
                  <span>Allocate Bronze</span>
                </a>
              </div>
            </div>
          </div>
        </div>

        <!-- Silver Plan -->
        <div class="col-12 col-md-6 col-xl-3" data-aos="fade-up" data-aos-duration="900">
          <div class="ecx-glass-card h-100 p-0 overflow-hidden d-flex flex-column" style="border: 1px solid rgba(148, 163, 184, 0.45);">
            <div style="width: 100%; aspect-ratio: 16/9; overflow: hidden; position: relative;">
              <img src="{{ asset('themes/ecx/assets/images/plans/plan_silver_ecx.jpg') }}" alt="Silver Tier" class="w-100 h-100" style="object-fit: cover;" onerror="this.src='{{ asset('themes/ecx/assets/images/banner/home4/tier_silver_widescreen.png') }}';">
              <span class="position-absolute top-0 end-0 m-2 badge px-2 py-1" style="background: rgba(148, 163, 184, 0.9); font-size: 10px; font-weight: 700; color: #0f172a;">SILVER TIER</span>
            </div>
            <div class="p-4 d-flex flex-column flex-grow-1">
              <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="text-white fw-bold mb-0">Silver Plan</h5>
                <span class="fs-4 fw-bold" style="color: #94a3b8;">40% <small class="text-white-50 fs-6">/ Daily</small></span>
              </div>
              <ul class="list-unstyled d-flex flex-column gap-2 mb-4" style="font-size: 13.5px; color: #cbd5e1;">
                <li class="d-flex justify-content-between"><span>Min Deposit:</span> <strong class="text-white">{{ $settings->currency ?? '$' }}5,000</strong></li>
                <li class="d-flex justify-content-between"><span>Max Deposit:</span> <strong class="text-white">{{ $settings->currency ?? '$' }}24,999</strong></li>
                <li class="d-flex justify-content-between"><span>Duration:</span> <strong class="text-white">14 Days</strong></li>
                <li class="d-flex justify-content-between"><span>Capital Return:</span> <strong class="text-success">Yes, 100%</strong></li>
                <li class="d-flex justify-content-between"><span>Support Desk:</span> <strong class="text-info">Dedicated Mgr</strong></li>
              </ul>
              <div class="mt-auto">
                <a href="{{ auth()->check() ? url('/dashboard/mplans') : route('register') }}" class="trk-btn trk-btn--primary trk-btn--arrow w-100 text-center py-2">
                  <span>Allocate Silver</span>
                </a>
              </div>
            </div>
          </div>
        </div>

        <!-- Gold Plan (Featured) -->
        <div class="col-12 col-md-6 col-xl-3" data-aos="fade-up" data-aos-duration="1000">
          <div class="ecx-glass-card h-100 p-0 overflow-hidden d-flex flex-column position-relative" style="border: 2px solid rgba(245, 158, 11, 0.6); box-shadow: 0 0 25px rgba(245, 158, 11, 0.2);">
            <span class="position-absolute top-0 start-50 translate-middle badge rounded-pill px-3 py-1" style="background: #f59e0b; color: #000; font-size: 11px; font-weight: 800; z-index: 5;">
              MOST POPULAR
            </span>
            <div style="width: 100%; aspect-ratio: 16/9; overflow: hidden; position: relative;">
              <img src="{{ asset('themes/ecx/assets/images/plans/plan_gold_ecx.jpg') }}" alt="Gold Tier" class="w-100 h-100" style="object-fit: cover;" onerror="this.src='{{ asset('themes/ecx/assets/images/banner/home4/tier_gold_widescreen.png') }}';">
              <span class="position-absolute top-0 end-0 m-2 badge px-2 py-1" style="background: rgba(245, 158, 11, 0.95); color: #000; font-size: 10px; font-weight: 800;">GOLD TIER</span>
            </div>
            <div class="p-4 d-flex flex-column flex-grow-1">
              <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="text-white fw-bold mb-0">Gold Plan</h5>
                <span class="fs-4 fw-bold" style="color: #f59e0b;">60% <small class="text-white-50 fs-6">/ Daily</small></span>
              </div>
              <ul class="list-unstyled d-flex flex-column gap-2 mb-4" style="font-size: 13.5px; color: #cbd5e1;">
                <li class="d-flex justify-content-between"><span>Min Deposit:</span> <strong class="text-white">{{ $settings->currency ?? '$' }}25,000</strong></li>
                <li class="d-flex justify-content-between"><span>Max Deposit:</span> <strong class="text-white">{{ $settings->currency ?? '$' }}49,999</strong></li>
                <li class="d-flex justify-content-between"><span>Duration:</span> <strong class="text-white">21 Days</strong></li>
                <li class="d-flex justify-content-between"><span>Capital Return:</span> <strong class="text-success">Yes, 100%</strong></li>
                <li class="d-flex justify-content-between"><span>Support Desk:</span> <strong class="text-warning">VIP Priority</strong></li>
              </ul>
              <div class="mt-auto">
                <a href="{{ auth()->check() ? url('/dashboard/mplans') : route('register') }}" class="trk-btn trk-btn--primary trk-btn--arrow w-100 text-center py-2" style="background: #f59e0b; border-color: #f59e0b; color: #000; font-weight: 800;">
                  <span>Allocate Gold</span>
                </a>
              </div>
            </div>
          </div>
        </div>

        <!-- Diamond Plan -->
        <div class="col-12 col-md-6 col-xl-3" data-aos="fade-up" data-aos-duration="1100">
          <div class="ecx-glass-card h-100 p-0 overflow-hidden d-flex flex-column" style="border: 1px solid rgba(0, 245, 155, 0.4);">
            <div style="width: 100%; aspect-ratio: 16/9; overflow: hidden; position: relative;">
              <img src="{{ asset('themes/ecx/assets/images/plans/plan_diamond_ecx.jpg') }}" alt="Diamond Tier" class="w-100 h-100" style="object-fit: cover;" onerror="this.src='{{ asset('themes/ecx/assets/images/banner/home4/tier_diamond_widescreen.png') }}';">
              <span class="position-absolute top-0 end-0 m-2 badge px-2 py-1" style="background: rgba(0, 245, 155, 0.9); color: #000; font-size: 10px; font-weight: 800;">DIAMOND TIER</span>
            </div>
            <div class="p-4 d-flex flex-column flex-grow-1">
              <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="text-white fw-bold mb-0">Diamond Plan</h5>
                <span class="fs-4 fw-bold" style="color: #00f59b;">100% <small class="text-white-50 fs-6">/ Daily</small></span>
              </div>
              <ul class="list-unstyled d-flex flex-column gap-2 mb-4" style="font-size: 13.5px; color: #cbd5e1;">
                <li class="d-flex justify-content-between"><span>Min Deposit:</span> <strong class="text-white">{{ $settings->currency ?? '$' }}50,000</strong></li>
                <li class="d-flex justify-content-between"><span>Max Deposit:</span> <strong class="text-white">{{ $settings->currency ?? '$' }}150,000</strong></li>
                <li class="d-flex justify-content-between"><span>Duration:</span> <strong class="text-white">30 Days</strong></li>
                <li class="d-flex justify-content-between"><span>Capital Return:</span> <strong class="text-success">Yes, 100%</strong></li>
                <li class="d-flex justify-content-between"><span>Support Desk:</span> <strong class="text-success">Institutional SLA</strong></li>
              </ul>
              <div class="mt-auto">
                <a href="{{ auth()->check() ? url('/dashboard/mplans') : route('register') }}" class="trk-btn trk-btn--border trk-btn--primary w-100 text-center py-2">
                  <span>Allocate Diamond</span>
                </a>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- ===============>> 4-Step Operational Pipeline <<================= -->
  <section class="py-5" style="background-color: #070b14;">
    <div class="container py-4">
      <div class="text-center mb-5" data-aos="fade-up" data-aos-duration="800">
        <div class="d-inline-flex align-items-center gap-2 px-3 py-1 mb-2 rounded-pill" style="background: rgba(0, 245, 155, 0.1); border: 1px solid rgba(0, 245, 155, 0.25); font-size: 11px; color: #00f59b; font-weight: 700; text-transform: uppercase; letter-spacing: 1px;">
          Workflow
        </div>
        <h2 class="text-white fw-bold">How The Arbitrage Engine Operates</h2>
        <p class="text-white-50 mx-auto" style="max-width: 580px; font-size: 14.5px;">
          From capital allocation to automated profit distribution in four transparent steps.
        </p>
      </div>

      <div class="row g-4">
        <div class="col-12 col-md-6 col-lg-3" data-aos="fade-up" data-aos-duration="800">
          <div class="ecx-glass-card h-100 text-center p-4">
            <div class="mx-auto mb-3" style="width: 54px; height: 54px; border-radius: 50%; background: rgba(0, 245, 155, 0.15); border: 1px solid #00f59b; color: #00f59b; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 20px;">
              01
            </div>
            <h5 class="text-white fw-bold mb-2">Create Account</h5>
            <p class="text-white-50 small mb-0" style="line-height: 1.6;">
              Sign up in under 60 seconds with encrypted two-factor credentials and instant KYC clearance.
            </p>
          </div>
        </div>

        <div class="col-12 col-md-6 col-lg-3" data-aos="fade-up" data-aos-duration="900">
          <div class="ecx-glass-card h-100 text-center p-4">
            <div class="mx-auto mb-3" style="width: 54px; height: 54px; border-radius: 50%; background: rgba(14, 165, 233, 0.15); border: 1px solid #0ea5e9; color: #0ea5e9; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 20px;">
              02
            </div>
            <h5 class="text-white fw-bold mb-2">Allocate Capital</h5>
            <p class="text-white-50 small mb-0" style="line-height: 1.6;">
              Select Bronze, Silver, Gold, or Diamond and fund your vault using BTC, ETH, USDT, or Credit Card.
            </p>
          </div>
        </div>

        <div class="col-12 col-md-6 col-lg-3" data-aos="fade-up" data-aos-duration="1000">
          <div class="ecx-glass-card h-100 text-center p-4">
            <div class="mx-auto mb-3" style="width: 54px; height: 54px; border-radius: 50%; background: rgba(245, 158, 11, 0.15); border: 1px solid #f59e0b; color: #f59e0b; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 20px;">
              03
            </div>
            <h5 class="text-white fw-bold mb-2">Automated Yields</h5>
            <p class="text-white-50 small mb-0" style="line-height: 1.6;">
              Our AI arbitrage engines execute thousands of market-neutral trades daily, crediting yields every 24 hours.
            </p>
          </div>
        </div>

        <div class="col-12 col-md-6 col-lg-3" data-aos="fade-up" data-aos-duration="1100">
          <div class="ecx-glass-card h-100 text-center p-4">
            <div class="mx-auto mb-3" style="width: 54px; height: 54px; border-radius: 50%; background: rgba(168, 85, 247, 0.15); border: 1px solid #a855f7; color: #c084fc; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 20px;">
              04
            </div>
            <h5 class="text-white fw-bold mb-2">Withdraw Anytime</h5>
            <p class="text-white-50 small mb-0" style="line-height: 1.6;">
              Request automated payouts directly into your external wallet with zero locking penalties after maturity.
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ===============>> CTA Call To Action Banner <<================= -->
  <section class="py-5" style="background: rgba(13, 22, 42, 0.4);">
    <div class="container py-4">
      <div class="ecx-glass-card text-center p-5 position-relative overflow-hidden" style="border: 1px solid rgba(0, 245, 155, 0.3);">
        <div class="position-relative" style="z-index: 2;">
          <h2 class="text-white fw-bold mb-3">Ready to Deploy Capital into Algorithmic Yield?</h2>
          <p class="text-white-50 mx-auto mb-4" style="max-width: 580px; font-size: 15px;">
            Start trading today with as little as {{ $settings->currency ?? '$' }}100 or connect with our institutional desk for corporate allocations.
          </p>
          <div class="d-flex justify-content-center gap-3 flex-wrap">
            @auth
              <a href="{{ url('/dashboard/mplans') }}" class="trk-btn trk-btn--primary trk-btn--arrow py-3 px-4">
                <span>View Dashboard Plans</span>
              </a>
            @else
              <a href="{{ route('register') }}" class="trk-btn trk-btn--primary trk-btn--arrow py-3 px-4">
                <span>Open Protected Account</span>
              </a>
              <a href="{{ route('contact') }}" class="trk-btn trk-btn--border trk-btn--primary py-3 px-4">
                <span>Speak to Desk</span>
              </a>
            @endauth
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
