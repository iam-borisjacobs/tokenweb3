@extends('home.ecx.layout')

@section('title', 'About Us - ' . ($settings->site_name ?? 'ECX Groups'))

@section('content')
  <!-- ===============>> Page Header Start <<================= -->
  <section class="page-header">
    <div class="container">
      <div class="page-header__content" data-aos="fade-right" data-aos-duration="900">
        <div class="d-inline-flex align-items-center gap-2 px-3 py-1 mb-3 rounded-pill" style="background: rgba(0, 245, 155, 0.1); border: 1px solid rgba(0, 245, 155, 0.25); font-size: 12px; color: #00f59b; font-weight: 700;">
          <span style="width: 8px; height: 8px; border-radius: 50%; background: #00f59b; box-shadow: 0 0 10px #00f59b;"></span>
          Institutional Digital Asset Infrastructure
        </div>
        <h2>Pioneering <span style="color: #00f59b;">Algorithmic Precision</span> &amp; Capital Safety</h2>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">About Us</li>
          </ol>
        </nav>
      </div>
    </div>
  </section>
  <!-- ===============>> Page Header End <<================= -->

  <!-- ===============>> Narrative & Executive Story Section <<================= -->
  <section class="py-5" style="background-color: #070b14; position: relative;">
    <div class="container py-4">
      <div class="row g-5 align-items-center">
        
        <!-- Left Image & Floating Counter -->
        <div class="col-12 col-lg-6" data-aos="fade-right" data-aos-duration="1000">
          <div class="position-relative pe-lg-4">
            <div style="border-radius: 24px; overflow: hidden; border: 1px solid rgba(255, 255, 255, 0.1); box-shadow: 0 20px 50px rgba(0, 0, 0, 0.6);">
              <img src="{{ asset('themes/ecx/assets/images/about/1.png') }}" alt="About {{ $settings->site_name }}" class="w-100 h-auto object-fit-cover" style="min-height: 380px;">
            </div>

            <!-- Floating Pill 1: Experience -->
            <div class="position-absolute d-none d-sm-flex align-items-center gap-3 p-3 rounded-4" style="top: 25px; left: -15px; background: rgba(13, 22, 42, 0.9); backdrop-filter: blur(16px); border: 1px solid rgba(0, 245, 155, 0.3); box-shadow: 0 10px 30px rgba(0,0,0,0.5);">
              <div style="width: 46px; height: 46px; border-radius: 12px; background: rgba(0, 245, 155, 0.15); display: flex; align-items: center; justify-content: center; color: #00f59b; font-size: 20px;">
                <i class="fas fa-award"></i>
              </div>
              <div>
                <div class="fw-bold text-white fs-5">10+ Years</div>
                <div class="text-white-50 small">Quant Arbitrage Experience</div>
              </div>
            </div>

            <!-- Floating Pill 2: Solvency -->
            <div class="position-absolute d-none d-sm-flex align-items-center gap-3 p-3 rounded-4" style="bottom: 25px; right: 10px; background: rgba(13, 22, 42, 0.9); backdrop-filter: blur(16px); border: 1px solid rgba(14, 165, 233, 0.3); box-shadow: 0 10px 30px rgba(0,0,0,0.5);">
              <div style="width: 46px; height: 46px; border-radius: 12px; background: rgba(14, 165, 233, 0.15); display: flex; align-items: center; justify-content: center; color: #0ea5e9; font-size: 20px;">
                <i class="fas fa-shield-check"></i>
              </div>
              <div>
                <div class="fw-bold text-white fs-5">100% Backed</div>
                <div class="text-white-50 small">Segregated Cold Storage</div>
              </div>
            </div>
          </div>
        </div>

        <!-- Right Story & Ethos -->
        <div class="col-12 col-lg-6" data-aos="fade-left" data-aos-duration="1000">
          <div class="d-inline-flex align-items-center gap-2 px-3 py-1 mb-3 rounded-pill" style="background: rgba(0, 245, 155, 0.1); border: 1px solid rgba(0, 245, 155, 0.25); font-size: 11px; color: #00f59b; font-weight: 700; text-transform: uppercase; letter-spacing: 1px;">
            The Foundation Story
          </div>
          <h2 class="text-white fw-bold mb-3" style="font-size: 34px; letter-spacing: -0.5px;">
            When Centralized Trust Collapsed, We Built <span style="color: #00f59b;">Mathematical Certainty</span>
          </h2>
          <p style="color: #cbd5e1; font-size: 15px; line-height: 1.75; margin-bottom: 18px;">
            {{ $settings->site_name ?? 'ECX Groups' }} was established with a singular, non-negotiable imperative: absolute asset protection combined with disciplined, automated yield generation. The cryptocurrency landscape has repeatedly demonstrated the catastrophic flaws of opaque custodians commingling customer deposits with directional trading desks.
          </p>
          <p style="color: #94a3b8; font-size: 14.5px; line-height: 1.7; margin-bottom: 24px;">
            We replaced speculation with high-frequency statistical arbitrage. By capturing sub-millisecond price discrepancies across 25+ tier-1 global exchanges, our algorithms extract risk-neutral yields without exposing deposited capital to market downturns.
          </p>

          <div class="row g-3 pt-2">
            <div class="col-sm-6">
              <div class="d-flex align-items-center gap-2">
                <i class="fas fa-check-circle text-success fs-5"></i>
                <span class="text-white fw-semibold small">Zero Fund Rehypothecation</span>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="d-flex align-items-center gap-2">
                <i class="fas fa-check-circle text-success fs-5"></i>
                <span class="text-white fw-semibold small">Market-Neutral Delta Hedge</span>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="d-flex align-items-center gap-2">
                <i class="fas fa-check-circle text-success fs-5"></i>
                <span class="text-white fw-semibold small">24/7 Live Cold Vault Proof</span>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="d-flex align-items-center gap-2">
                <i class="fas fa-check-circle text-success fs-5"></i>
                <span class="text-white fw-semibold small">Automated Daily Distribution</span>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- ===============>> Operational Metrics Counter Bar <<================= -->
  <section class="py-4" style="background: rgba(13, 22, 42, 0.6); border-top: 1px solid rgba(255, 255, 255, 0.05); border-bottom: 1px solid rgba(255, 255, 255, 0.05);">
    <div class="container">
      <div class="row g-4 text-center">
        <div class="col-6 col-md-3">
          <div class="p-3">
            <div class="fw-bold fs-2 text-white mb-1" style="font-family: 'Space Grotesk', sans-serif;">$180M+</div>
            <div class="text-white-50 small text-uppercase tracking-wider">Trading Volume Processed</div>
          </div>
        </div>
        <div class="col-6 col-md-3">
          <div class="p-3">
            <div class="fw-bold fs-2 text-success mb-1" style="font-family: 'Space Grotesk', sans-serif;">100%</div>
            <div class="text-white-50 small text-uppercase tracking-wider">Reserve Ratio Backing</div>
          </div>
        </div>
        <div class="col-6 col-md-3">
          <div class="p-3">
            <div class="fw-bold fs-2 text-info mb-1" style="font-family: 'Space Grotesk', sans-serif;">25K+</div>
            <div class="text-white-50 small text-uppercase tracking-wider">Global Investors</div>
          </div>
        </div>
        <div class="col-6 col-md-3">
          <div class="p-3">
            <div class="fw-bold fs-2 text-warning mb-1" style="font-family: 'Space Grotesk', sans-serif;">0.00%</div>
            <div class="text-white-50 small text-uppercase tracking-wider">Historical Breaches</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ===============>> 4 Security Pillars Grid <<================= -->
  <section class="py-5" style="background-color: #070b14;">
    <div class="container py-4">
      <div class="text-center mb-5" data-aos="fade-up" data-aos-duration="800">
        <div class="d-inline-flex align-items-center gap-2 px-3 py-1 mb-2 rounded-pill" style="background: rgba(0, 245, 155, 0.1); border: 1px solid rgba(0, 245, 155, 0.25); font-size: 11px; color: #00f59b; font-weight: 700; text-transform: uppercase; letter-spacing: 1px;">
          Institutional Standards
        </div>
        <h2 class="text-white fw-bold">The Four Foundational Pillars</h2>
        <p class="text-white-50 mx-auto" style="max-width: 620px; font-size: 14.5px;">
          How our platform protects principal capital while generating predictable daily yields across any market condition.
        </p>
      </div>

      <div class="row g-4">
        <!-- Pillar 1 -->
        <div class="col-12 col-md-6 col-xl-3" data-aos="fade-up" data-aos-duration="800">
          <div class="ecx-glass-card h-100 d-flex flex-column" style="border-top: 3px solid #f59e0b;">
            <div class="fs-1 mb-3 text-warning"><i class="fas fa-lock-alt"></i></div>
            <h5 class="text-white fw-bold mb-2">Zero Rehypothecation</h5>
            <p style="font-size: 13.5px; color: #94a3b8; line-height: 1.6; margin-bottom: 0;">
              Your deposited capital is strictly ring-fenced. We never lend, leverage, or loan assets to third parties or speculative hedge funds.
            </p>
          </div>
        </div>

        <!-- Pillar 2 -->
        <div class="col-12 col-md-6 col-xl-3" data-aos="fade-up" data-aos-duration="900">
          <div class="ecx-glass-card h-100 d-flex flex-column" style="border-top: 3px solid #00f59b;">
            <div class="fs-1 mb-3 text-success"><i class="fas fa-chart-network"></i></div>
            <h5 class="text-white fw-bold mb-2">Market-Neutral Yield</h5>
            <p style="font-size: 13.5px; color: #94a3b8; line-height: 1.6; margin-bottom: 0;">
              Profits are harvested exclusively from cross-exchange orderbook spreads. Whether crypto pumps or dumps, arbitrage spreads remain active.
            </p>
          </div>
        </div>

        <!-- Pillar 3 -->
        <div class="col-12 col-md-6 col-xl-3" data-aos="fade-up" data-aos-duration="1000">
          <div class="ecx-glass-card h-100 d-flex flex-column" style="border-top: 3px solid #0ea5e9;">
            <div class="fs-1 mb-3 text-info"><i class="fas fa-key-skeleton"></i></div>
            <h5 class="text-white fw-bold mb-2">Multi-Sig Cold Storage</h5>
            <p style="font-size: 13.5px; color: #94a3b8; line-height: 1.6; margin-bottom: 0;">
              Over 95% of digital balances reside in air-gapped, geographically distributed HSM vaults requiring m-of-n cryptographic quorum.
            </p>
          </div>
        </div>

        <!-- Pillar 4 -->
        <div class="col-12 col-md-6 col-xl-3" data-aos="fade-up" data-aos-duration="1100">
          <div class="ecx-glass-card h-100 d-flex flex-column" style="border-top: 3px solid #a855f7;">
            <div class="fs-1 mb-3" style="color: #c084fc;"><i class="fas fa-file-contract"></i></div>
            <h5 class="text-white fw-bold mb-2">Continuous Solvency</h5>
            <p style="font-size: 13.5px; color: #94a3b8; line-height: 1.6; margin-bottom: 0;">
              Every user balance is tracked against verifiable on-chain collateral, giving investors guaranteed liquidity for immediate withdrawals.
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ===============>> 6-Phase Strategic Roadmap Section <<================= -->
  <section class="py-5" style="background: rgba(13, 22, 42, 0.35); border-top: 1px solid rgba(255, 255, 255, 0.05); border-bottom: 1px solid rgba(255, 255, 255, 0.05);">
    <div class="container py-4">
      <div class="text-center mb-5" data-aos="fade-up" data-aos-duration="800">
        <div class="d-inline-flex align-items-center gap-2 px-3 py-1 mb-2 rounded-pill" style="background: rgba(0, 245, 155, 0.1); border: 1px solid rgba(0, 245, 155, 0.25); font-size: 11px; color: #00f59b; font-weight: 700; text-transform: uppercase; letter-spacing: 1px;">
          Execution Timeline
        </div>
        <h2 class="text-white fw-bold">Platform &amp; Architectural Roadmap</h2>
        <p class="text-white-50 mx-auto" style="max-width: 600px; font-size: 14.5px;">
          Our progressive milestones toward autonomous, multi-chain quantitative finance.
        </p>
      </div>

      <div class="row g-4">
        <!-- P1 -->
        <div class="col-12 col-md-6" data-aos="fade-up" data-aos-duration="800">
          <div class="ecx-glass-card h-100 p-4">
            <div class="d-flex justify-content-between align-items-center mb-2">
              <span class="badge" style="background: rgba(0, 245, 155, 0.15); color: #00f59b; border: 1px solid rgba(0, 245, 155, 0.3); font-size: 12px; font-weight: 700;">PHASE 01</span>
              <span class="text-success small fw-bold"><i class="fas fa-check-circle me-1"></i> Completed</span>
            </div>
            <h5 class="text-white fw-bold mb-2">Strategic Quantitative Modeling</h5>
            <p class="text-white-50 small mb-0" style="line-height: 1.6;">
              In-depth research and mathematical modeling of cross-exchange orderbook latency, fee structures, and slippage thresholds across major liquidity pools.
            </p>
          </div>
        </div>

        <!-- P2 -->
        <div class="col-12 col-md-6" data-aos="fade-up" data-aos-duration="900">
          <div class="ecx-glass-card h-100 p-4">
            <div class="d-flex justify-content-between align-items-center mb-2">
              <span class="badge" style="background: rgba(0, 245, 155, 0.15); color: #00f59b; border: 1px solid rgba(0, 245, 155, 0.3); font-size: 12px; font-weight: 700;">PHASE 02</span>
              <span class="text-success small fw-bold"><i class="fas fa-check-circle me-1"></i> Completed</span>
            </div>
            <h5 class="text-white fw-bold mb-2">High-Frequency Core Engine</h5>
            <p class="text-white-50 small mb-0" style="line-height: 1.6;">
              Deployment of ultra-low latency co-located server clusters executing sub-millisecond automated arbitrage transactions with zero human intervention.
            </p>
          </div>
        </div>

        <!-- P3 -->
        <div class="col-12 col-md-6" data-aos="fade-up" data-aos-duration="1000">
          <div class="ecx-glass-card h-100 p-4">
            <div class="d-flex justify-content-between align-items-center mb-2">
              <span class="badge" style="background: rgba(0, 245, 155, 0.15); color: #00f59b; border: 1px solid rgba(0, 245, 155, 0.3); font-size: 12px; font-weight: 700;">PHASE 03</span>
              <span class="text-success small fw-bold"><i class="fas fa-check-circle me-1"></i> Completed</span>
            </div>
            <h5 class="text-white fw-bold mb-2">Multi-Tier Yield Architecture</h5>
            <p class="text-white-50 small mb-0" style="line-height: 1.6;">
              Rollout of Bronze, Silver, Gold, and Diamond tiers enabling both retail participants and institutional treasuries to scale capital allocations.
            </p>
          </div>
        </div>

        <!-- P4 -->
        <div class="col-12 col-md-6" data-aos="fade-up" data-aos-duration="1100">
          <div class="ecx-glass-card h-100 p-4" style="border-color: rgba(0, 245, 155, 0.4);">
            <div class="d-flex justify-content-between align-items-center mb-2">
              <span class="badge" style="background: rgba(14, 165, 233, 0.2); color: #38bdf8; border: 1px solid rgba(14, 165, 233, 0.4); font-size: 12px; font-weight: 700;">PHASE 04</span>
              <span class="badge bg-success bg-opacity-25 text-success small fw-bold"><i class="fas fa-spinner fa-spin me-1"></i> Active Live</span>
            </div>
            <h5 class="text-white fw-bold mb-2">Global Licensing &amp; Institutional Expansion</h5>
            <p class="text-white-50 small mb-0" style="line-height: 1.6;">
              Expanding corporate and institutional onboarding portals, real-time automated KYC clearance, and 24/7 multi-lingual trading desks worldwide.
            </p>
          </div>
        </div>

        <!-- P5 -->
        <div class="col-12 col-md-6" data-aos="fade-up" data-aos-duration="1200">
          <div class="ecx-glass-card h-100 p-4">
            <div class="d-flex justify-content-between align-items-center mb-2">
              <span class="badge bg-secondary bg-opacity-30 text-white-50 font-monospace" style="font-size: 12px;">PHASE 05</span>
              <span class="text-white-50 small">Upcoming Q4</span>
            </div>
            <h5 class="text-white fw-bold mb-2">Autonomous Neural Network Arbitrage</h5>
            <p class="text-white-50 small mb-0" style="line-height: 1.6;">
              Integration of deep learning predictive models for anticipatory liquidity routing across decentralised automated market makers (AMMs).
            </p>
          </div>
        </div>

        <!-- P6 -->
        <div class="col-12 col-md-6" data-aos="fade-up" data-aos-duration="1300">
          <div class="ecx-glass-card h-100 p-4">
            <div class="d-flex justify-content-between align-items-center mb-2">
              <span class="badge bg-secondary bg-opacity-30 text-white-50 font-monospace" style="font-size: 12px;">PHASE 06</span>
              <span class="text-white-50 small">Planned 2027</span>
            </div>
            <h5 class="text-white fw-bold mb-2">Cross-Chain Institutional Custody Bridges</h5>
            <p class="text-white-50 small mb-0" style="line-height: 1.6;">
              Direct native settlements bridging Layer-1 blockchains directly into tier-1 traditional banking rails with zero counterparty friction.
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ===============>> CTA Call To Action Banner <<================= -->
  <section class="py-5" style="background-color: #070b14;">
    <div class="container py-4">
      <div class="ecx-glass-card text-center p-5 position-relative overflow-hidden" style="border: 1px solid rgba(0, 245, 155, 0.3);">
        <div class="position-relative" style="z-index: 2;">
          <h2 class="text-white fw-bold mb-3">Begin Your Institutional Capital Journey</h2>
          <p class="text-white-50 mx-auto mb-4" style="max-width: 580px; font-size: 15px;">
            Join over 25,000 satisfied investors securing predictable daily yields with automated algorithmic execution.
          </p>
          <div class="d-flex justify-content-center gap-3 flex-wrap">
            @auth
              <a href="{{ url('/dashboard') }}" class="trk-btn trk-btn--primary trk-btn--arrow py-3 px-4">
                <span>Go to Client Dashboard</span>
              </a>
              <a href="{{ route('services') }}" class="trk-btn trk-btn--border trk-btn--primary py-3 px-4">
                <span>View 4-Tier Yields</span>
              </a>
            @else
              <a href="{{ route('register') }}" class="trk-btn trk-btn--primary trk-btn--arrow py-3 px-4">
                <span>Open Protected Account</span>
              </a>
              <a href="{{ route('login') }}" class="trk-btn trk-btn--border trk-btn--primary py-3 px-4">
                <span>Client Access Portal</span>
              </a>
            @endauth
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
