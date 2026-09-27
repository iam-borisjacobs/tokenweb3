@extends('home.ecx.layout')

@section('title', 'Privacy & Data Protection Policy - ' . ($settings->site_name ?? 'ECX Groups'))

@section('content')
  <!-- ===============>> Page Header Start <<================= -->
  <section class="page-header">
    <div class="container">
      <div class="page-header__content" data-aos="fade-right" data-aos-duration="900">
        <div class="d-inline-flex align-items-center gap-2 px-3 py-1 mb-3 rounded-pill" style="background: rgba(0, 245, 155, 0.1); border: 1px solid rgba(0, 245, 155, 0.25); font-size: 12px; color: #00f59b; font-weight: 700;">
          <span style="width: 8px; height: 8px; border-radius: 50%; background: #00f59b; box-shadow: 0 0 10px #00f59b;"></span>
          Global Data Privacy &amp; Cryptographic Confidentiality
        </div>
        <h2>Privacy &amp; <span style="color: #00f59b;">Data Protection</span> Policy</h2>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Privacy Policy</li>
          </ol>
        </nav>
      </div>
    </div>
  </section>
  <!-- ===============>> Page Header End <<================= -->

  <!-- ===============>> Policy Content Start <<================= -->
  <section class="py-5" style="background-color: #070b14;">
    <div class="container py-4">
      <div class="row g-5">
        
        <!-- Left Sticky Navigation -->
        <div class="col-12 col-lg-4 d-none d-lg-block">
          <div class="ecx-glass-card sticky-top" style="top: 100px;">
            <h5 class="text-white fw-bold mb-3 pb-2 border-bottom border-white border-opacity-10">
              <i class="fas fa-user-shield text-info me-2"></i> Privacy Clauses
            </h5>
            <nav class="d-flex flex-column gap-2" style="font-size: 13.5px;">
              <a href="#section-1" class="text-white-50 text-decoration-none py-1 hover-green">1. Scope &amp; Commitment</a>
              <a href="#section-2" class="text-white-50 text-decoration-none py-1 hover-green">2. Information Collection</a>
              <a href="#section-3" class="text-white-50 text-decoration-none py-1 hover-green">3. 256-Bit TLS &amp; HSM Security</a>
              <a href="#section-4" class="text-white-50 text-decoration-none py-1 hover-green">4. Blockchain Ledger Privacy</a>
              <a href="#section-5" class="text-white-50 text-decoration-none py-1 hover-green">5. Zero Monetization Guarantee</a>
              <a href="#section-6" class="text-white-50 text-decoration-none py-1 hover-green">6. GDPR &amp; CCPA User Rights</a>
              <a href="#section-7" class="text-white-50 text-decoration-none py-1 hover-green">7. Cookie &amp; Session Analytics</a>
              <a href="#section-8" class="text-white-50 text-decoration-none py-1 hover-green">8. Contact Protection Officer</a>
            </nav>

            <div class="mt-4 pt-3 border-top border-white border-opacity-10">
              <span class="text-white-50 small d-block mb-2">Data Protection Officer:</span>
              <a href="mailto:{{ $settings->contact_email ?? 'support@' . request()->getHost() }}" class="d-inline-flex align-items-center gap-2 small text-info text-decoration-none fw-semibold">
                <i class="fas fa-envelope"></i>
                <span>{{ $settings->contact_email ?? 'support@' . request()->getHost() }}</span>
              </a>
            </div>
          </div>
        </div>

        <!-- Right Policy Text -->
        <div class="col-12 col-lg-8">
          <div class="ecx-glass-card p-4 p-md-5" style="line-height: 1.8; color: #cbd5e1; font-size: 14.5px;">
            
            <div class="mb-4 pb-3 border-bottom border-white border-opacity-10">
              <span class="badge bg-info bg-opacity-20 text-info mb-2 px-3 py-1">ISO 27001 &amp; SOC 2 Compliant</span>
              <h3 class="text-white fw-bold mb-2">Institutional Privacy Framework</h3>
              <p class="text-white-50 small mb-0">
                At {{ $settings->site_name ?? 'ECX Groups' }}, your operational privacy and financial confidentiality are core engineering principles.
              </p>
            </div>

            <!-- Section 1 -->
            <div id="section-1" class="mb-5">
              <h5 class="text-white fw-bold mb-2 d-flex align-items-center gap-2">
                <span class="text-info">1.</span> Scope &amp; Commitment to Confidentiality
              </h5>
              <p>
                This Privacy Policy describes how {{ $settings->site_name ?? 'ECX Groups' }} ("we", "us", or "our") handles personal, financial, and technical information collected when you access our platforms, utilize our API endpoints, connect institutional wallets, or participate in our investment plans. We adhere to the highest international data protection benchmarks, including the General Data Protection Regulation (GDPR) and California Consumer Privacy Act (CCPA).
              </p>
            </div>

            <!-- Section 2 -->
            <div id="section-2" class="mb-5">
              <h5 class="text-white fw-bold mb-2 d-flex align-items-center gap-2">
                <span class="text-info">2.</span> Categories of Information We Collect
              </h5>
              <p>
                To provide secure digital asset custody and satisfy international regulatory standards, we process the following categories of information:
              </p>
              <ul class="mb-0 ps-3">
                <li><strong>Identity &amp; Profile Data:</strong> Full legal name, date of birth, government-issued photo ID, tax residency, and proof of address for verified accounts.</li>
                <li><strong>Contact Data:</strong> Primary email address, telephone contact, and encrypted Telegram / messaging handles.</li>
                <li><strong>Financial &amp; Blockchain Telemetry:</strong> Public destination wallet addresses, transaction hashes (TXIDs), deposit receipts, and plan allocations.</li>
                <li><strong>Technical Diagnostics:</strong> IP addresses, browser fingerprinting, two-factor authentication logs, and device session markers used strictly for fraud prevention.</li>
              </ul>
            </div>

            <!-- Section 3 -->
            <div id="section-3" class="mb-5">
              <h5 class="text-white fw-bold mb-2 d-flex align-items-center gap-2">
                <span class="text-info">3.</span> 256-Bit TLS &amp; Hardware Security Modules (HSM)
              </h5>
              <p>
                All data transmission between your browser and our platform is encrypted via 256-bit Transport Layer Security (TLS 1.3). Sensitive records are stored in AES-256 encrypted databases behind isolated cloud security groups. Cryptographic private keys and multi-signature authorization quorums are safeguarded within FIPS 140-2 Level 3 certified Hardware Security Modules (HSMs) with zero internet exposure.
              </p>
            </div>

            <!-- Section 4 -->
            <div id="section-4" class="mb-5">
              <h5 class="text-white fw-bold mb-2 d-flex align-items-center gap-2">
                <span class="text-info">4.</span> Blockchain &amp; Public Ledger Transparency
              </h5>
              <p>
                Digital asset transactions conducted on public distributed ledger networks (such as Bitcoin, Ethereum, and Tron) are inherently public and immutable. While transaction hashes and wallet balances are broadcast to public mempools to ensure decentralized consensus, {{ $settings->site_name ?? 'ECX Groups' }} does not publicly bind your off-chain legal identity or profile to your on-chain deposit addresses.
              </p>
            </div>

            <!-- Section 5 -->
            <div id="section-5" class="mb-5">
              <h5 class="text-white fw-bold mb-2 d-flex align-items-center gap-2">
                <span class="text-info">5.</span> Zero Commercial Data Monetization Guarantee
              </h5>
              <p>
                We maintain an absolute, unequivocal policy: <strong>We do not sell, rent, lease, or monetize your personal or financial data to advertising networks, third-party brokers, or marketers</strong> under any circumstances. Information is only shared with verified institutional infrastructure partners (e.g. KYC verification services, AML analytics providers, tier-1 custodial banks) strictly as necessary to execute requested operations.
              </p>
            </div>

            <!-- Section 6 -->
            <div id="section-6" class="mb-5">
              <h5 class="text-white fw-bold mb-2 d-flex align-items-center gap-2">
                <span class="text-info">6.</span> User Rights Under GDPR &amp; CCPA
              </h5>
              <p>
                Regardless of your physical location, {{ $settings->site_name ?? 'ECX Groups' }} grants you comprehensive data autonomy:
              </p>
              <ul class="mb-0 ps-3">
                <li><strong>Right of Access:</strong> You may request an exported copy of all personal records maintained in our systems.</li>
                <li><strong>Right to Rectification:</strong> You may request prompt correction of outdated or inaccurate personal details.</li>
                <li><strong>Right to Erasure ("Right to be Forgotten"):</strong> You may request the deletion of account records, subject to mandatory statutory AML retention requirements (typically 5 years).</li>
              </ul>
            </div>

            <!-- Section 7 -->
            <div id="section-7" class="mb-5">
              <h5 class="text-white fw-bold mb-2 d-flex align-items-center gap-2">
                <span class="text-info">7.</span> Cookies &amp; Session Management
              </h5>
              <p>
                We utilize essential HTTP cookies and local session tokens strictly necessary for secure authentication, CSRF token validation, and maintaining active portal sessions. We do not deploy invasive third-party cross-site behavioral tracking scripts.
              </p>
            </div>

            <!-- Section 8 -->
            <div id="section-8" class="mb-0">
              <h5 class="text-white fw-bold mb-2 d-flex align-items-center gap-2">
                <span class="text-info">8.</span> Contact the Data Protection Officer
              </h5>
              <p>
                If you have inquiries, audit requests, or wish to exercise your statutory privacy rights, contact our Data Protection and Compliance Officer directly at:
              </p>
              <div class="p-3 rounded-3" style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.06);">
                <div class="fw-bold text-white">{{ $settings->site_name ?? 'ECX Groups' }} Compliance &amp; Legal Division</div>
                <div class="text-info">{{ $settings->contact_email ?? 'support@' . request()->getHost() }}</div>
                <div class="text-white-50 small">{{ $settings->location ?? 'One Canada Square, Canary Wharf, London E14 5AB, United Kingdom' }}</div>
              </div>
            </div>

          </div>
        </div>

      </div>
    </div>
  </section>
  <!-- ===============>> Policy Content End <<================= -->
@endsection
