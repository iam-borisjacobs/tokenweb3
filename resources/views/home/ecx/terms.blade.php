@extends('home.ecx.layout')

@section('title', 'Terms and Conditions of Service - ' . ($settings->site_name ?? 'ECX Groups'))

@section('content')
  <!-- ===============>> Page Header Start <<================= -->
  <section class="page-header">
    <div class="container">
      <div class="page-header__content" data-aos="fade-right" data-aos-duration="900">
        <div class="d-inline-flex align-items-center gap-2 px-3 py-1 mb-3 rounded-pill" style="background: rgba(0, 245, 155, 0.1); border: 1px solid rgba(0, 245, 155, 0.25); font-size: 12px; color: #00f59b; font-weight: 700;">
          <span style="width: 8px; height: 8px; border-radius: 50%; background: #00f59b; box-shadow: 0 0 10px #00f59b;"></span>
          Legal &amp; Compliance Framework
        </div>
        <h2>Terms &amp; Conditions <span style="color: #00f59b;">of Service</span></h2>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Terms</li>
          </ol>
        </nav>
      </div>
    </div>
  </section>
  <!-- ===============>> Page Header End <<================= -->

  <!-- ===============>> Legal Content Start <<================= -->
  <section class="py-5" style="background-color: #070b14;">
    <div class="container py-4">
      <div class="row g-5">
        
        <!-- Left Sticky Navigation -->
        <div class="col-12 col-lg-4 d-none d-lg-block">
          <div class="ecx-glass-card sticky-top" style="top: 100px;">
            <h5 class="text-white fw-bold mb-3 pb-2 border-bottom border-white border-opacity-10">
              <i class="fas fa-gavel text-success me-2"></i> Document Sections
            </h5>
            <nav class="d-flex flex-column gap-2" style="font-size: 13.5px;">
              <a href="#section-1" class="text-white-50 text-decoration-none py-1 hover-green">1. Acceptance of Terms</a>
              <a href="#section-2" class="text-white-50 text-decoration-none py-1 hover-green">2. Eligibility &amp; KYC Compliance</a>
              <a href="#section-3" class="text-white-50 text-decoration-none py-1 hover-green">3. Custody &amp; Digital Assets</a>
              <a href="#section-4" class="text-white-50 text-decoration-none py-1 hover-green">4. Yield Mechanics &amp; Distribution</a>
              <a href="#section-5" class="text-white-50 text-decoration-none py-1 hover-green">5. Deposits &amp; Withdrawal Execution</a>
              <a href="#section-6" class="text-white-50 text-decoration-none py-1 hover-green">6. Risk Disclosures &amp; Disclaimers</a>
              <a href="#section-7" class="text-white-50 text-decoration-none py-1 hover-green">7. Anti-Money Laundering (AML)</a>
              <a href="#section-8" class="text-white-50 text-decoration-none py-1 hover-green">8. Governing Law &amp; Jurisdiction</a>
            </nav>

            <div class="mt-4 pt-3 border-top border-white border-opacity-10">
              <span class="text-white-50 small d-block mb-2">Questions regarding terms?</span>
              <a href="mailto:{{ $settings->contact_email ?? 'support@' . request()->getHost() }}" class="d-inline-flex align-items-center gap-2 small text-success text-decoration-none fw-semibold">
                <i class="fas fa-envelope"></i>
                <span>{{ $settings->contact_email ?? 'support@' . request()->getHost() }}</span>
              </a>
            </div>
          </div>
        </div>

        <!-- Right Legal Clauses -->
        <div class="col-12 col-lg-8">
          <div class="ecx-glass-card p-4 p-md-5" style="line-height: 1.8; color: #cbd5e1; font-size: 14.5px;">
            
            <div class="mb-4 pb-3 border-bottom border-white border-opacity-10">
              <span class="badge bg-success bg-opacity-20 text-success mb-2 px-3 py-1">Effective Revision: 2026</span>
              <h3 class="text-white fw-bold mb-2">Master Client Service Agreement</h3>
              <p class="text-white-50 small mb-0">
                These Terms of Service govern your access to and use of {{ $settings->site_name ?? 'ECX Groups' }}'s platform, client portal, automated quantitative arbitrage tools, and digital custodial architecture.
              </p>
            </div>

            <!-- Section 1 -->
            <div id="section-1" class="mb-5">
              <h5 class="text-white fw-bold mb-2 d-flex align-items-center gap-2">
                <span class="text-success">1.</span> Acceptance of Terms &amp; Conditions
              </h5>
              <p>
                By creating an account, depositing capital, or accessing any service on {{ $settings->site_name ?? 'ECX Groups' }}, you acknowledge that you have read, understood, and unequivocally agree to be legally bound by these terms. If you do not accept these terms in their entirety, you must immediately cease using the platform and refrain from depositing any assets.
              </p>
            </div>

            <!-- Section 2 -->
            <div id="section-2" class="mb-5">
              <h5 class="text-white fw-bold mb-2 d-flex align-items-center gap-2">
                <span class="text-success">2.</span> Eligibility &amp; KYC Compliance
              </h5>
              <p>
                You represent and warrant that you are of legal age under the jurisdiction of your residence (at least 18 years old or the applicable age of legal capacity) and are not subject to economic or financial sanctions administered by the United Nations, United States Office of Foreign Assets Control (OFAC), European Union, or United Kingdom Treasury. We reserve the absolute right to mandate identity verification documents (Know Your Customer) at any stage of account activity.
              </p>
            </div>

            <!-- Section 3 -->
            <div id="section-3" class="mb-5">
              <h5 class="text-white fw-bold mb-2 d-flex align-items-center gap-2">
                <span class="text-success">3.</span> Custody &amp; Digital Asset Storage
              </h5>
              <p>
                All digital assets deposited on {{ $settings->site_name ?? 'ECX Groups' }} are held in segregated, multi-signature cold storage vaults. We enforce a strict zero-rehypothecation policy: client assets are never lent, leveraged, re-pledged, or commingled with corporate operational funds. Users acknowledge that digital asset transactions on blockchain networks are mathematically irreversible once confirmed by network consensus.
              </p>
            </div>

            <!-- Section 4 -->
            <div id="section-4" class="mb-5">
              <h5 class="text-white fw-bold mb-2 d-flex align-items-center gap-2">
                <span class="text-success">4.</span> Yield Mechanics &amp; Daily Distributions
              </h5>
              <p>
                Returns displayed on {{ $settings->site_name ?? 'ECX Groups' }} represent the output of our market-neutral statistical arbitrage and automated high-frequency algorithmic liquidity engine. Daily profits are credited every 24 hours to your internal balance ledger according to the parameters of your chosen tier (Bronze, Silver, Gold, or Diamond). Principal capital is returned 100% in full upon completion of the contractual plan duration.
              </p>
            </div>

            <!-- Section 5 -->
            <div id="section-5" class="mb-5">
              <h5 class="text-white fw-bold mb-2 d-flex align-items-center gap-2">
                <span class="text-success">5.</span> Deposits &amp; Withdrawal Execution
              </h5>
              <p>
                Users are solely responsible for ensuring the accuracy of recipient blockchain wallet addresses and selecting the corresponding transfer network (e.g. TRC-20, ERC-20, Native BTC). {{ $settings->site_name ?? 'ECX Groups' }} bears no liability for assets transferred to incorrect destination addresses or incompatible networks. Withdrawal requests are processed in accordance with our institutional multi-signature authorization protocols, with typical settlement broadcast within 5 to 30 minutes.
              </p>
            </div>

            <!-- Section 6 -->
            <div id="section-6" class="mb-5">
              <h5 class="text-white fw-bold mb-2 d-flex align-items-center gap-2">
                <span class="text-success">6.</span> Risk Disclosures &amp; Market Volatility
              </h5>
              <p>
                Trading and transacting in digital cryptocurrencies carries inherent technological and market risks. While {{ $settings->site_name ?? 'ECX Groups' }} implements delta-neutral algorithmic hedging to mitigate market volatility, unforeseen events such as hard forks, network congestion, sudden regulatory actions, or global blockchain disruption may affect settlement velocity. You should only allocate capital that aligns with your individual financial capacity.
              </p>
            </div>

            <!-- Section 7 -->
            <div id="section-7" class="mb-5">
              <h5 class="text-white fw-bold mb-2 d-flex align-items-center gap-2">
                <span class="text-success">7.</span> Anti-Money Laundering (AML) &amp; Fraud Prevention
              </h5>
              <p>
                {{ $settings->site_name ?? 'ECX Groups' }} maintains a zero-tolerance policy regarding illicit financial activities, money laundering, and terrorist financing. We employ real-time blockchain analytics and forensics to monitor incoming and outgoing transactions. Any deposits originating from known darknet markets, mixer services, sanctioned smart contracts, or fraudulent sources will be immediately frozen and reported to relevant regulatory authorities.
              </p>
            </div>

            <!-- Section 8 -->
            <div id="section-8" class="mb-0">
              <h5 class="text-white fw-bold mb-2 d-flex align-items-center gap-2">
                <span class="text-success">8.</span> Governing Law &amp; Dispute Resolution
              </h5>
              <p>
                These Terms of Service shall be governed by and construed in accordance with the laws of the jurisdiction in which {{ $settings->site_name ?? 'ECX Groups' }} maintains its principal corporate registration, without giving effect to any principles of conflicts of law. Any dispute, controversy, or claim arising out of or relating to these terms shall be settled through confidential, binding institutional arbitration.
              </p>
            </div>

          </div>
        </div>

      </div>
    </div>
  </section>
  <!-- ===============>> Legal Content End <<================= -->
@endsection
