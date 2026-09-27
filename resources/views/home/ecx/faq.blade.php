@extends('home.ecx.layout')

@section('title', 'Frequently Asked Questions - ' . ($settings->site_name ?? 'ECX Groups'))

@section('content')
  <!-- ===============>> Page Header Start <<================= -->
  <section class="page-header">
    <div class="container">
      <div class="page-header__content" data-aos="fade-right" data-aos-duration="900">
        <div class="d-inline-flex align-items-center gap-2 px-3 py-1 mb-3 rounded-pill" style="background: rgba(0, 245, 155, 0.1); border: 1px solid rgba(0, 245, 155, 0.25); font-size: 12px; color: #00f59b; font-weight: 700;">
          <span style="width: 8px; height: 8px; border-radius: 50%; background: #00f59b; box-shadow: 0 0 10px #00f59b;"></span>
          Investor Knowledge Base &amp; Protocol Clarifications
        </div>
        <h2>Frequently <span style="color: #00f59b;">Asked Questions</span></h2>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">FAQs</li>
          </ol>
        </nav>
      </div>
    </div>
  </section>
  <!-- ===============>> Page Header End <<================= -->

  <!-- ===============>> FAQ Main Section Start <<================= -->
  <section class="py-5" style="background-color: #070b14;">
    <div class="container py-4">
      
      <!-- Section Intro -->
      <div class="text-center mb-5" data-aos="fade-up" data-aos-duration="800">
        <h2 class="text-white fw-bold mb-2">Everything You Need to Know</h2>
        <p class="text-white-50 mx-auto" style="max-width: 620px; font-size: 14.5px;">
          Find answers regarding our quantitative arbitrage architecture, cold vault custody, yield distributions, and withdrawal mechanics.
        </p>
      </div>

      <div class="row justify-content-center">
        <div class="col-12 col-lg-10">

          <!-- Dynamic FAQs from Admin Database (if any) -->
          @if(isset($faqs) && $faqs->count() > 0)
            <div class="mb-5" data-aos="fade-up" data-aos-duration="800">
              <div class="d-inline-flex align-items-center gap-2 px-3 py-1 mb-3 rounded-pill" style="background: rgba(0, 245, 155, 0.1); border: 1px solid rgba(0, 245, 155, 0.25); font-size: 11px; color: #00f59b; font-weight: 700; text-transform: uppercase; letter-spacing: 1px;">
                Platform Updates &amp; Custom FAQs
              </div>
              <div class="accordion custom-faq-accordion d-flex flex-column gap-3" id="dynamicFaqAccordion">
                @foreach($faqs as $index => $faq)
                  <div class="ecx-glass-card p-0 overflow-hidden border-0">
                    <div class="accordion-item bg-transparent border-0">
                      <h2 class="accordion-header" id="dynHeading{{ $faq->id ?? $index }}">
                        <button class="accordion-button collapsed px-4 py-3 bg-transparent text-white fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#dynCollapse{{ $faq->id ?? $index }}" aria-expanded="false" aria-controls="dynCollapse{{ $faq->id ?? $index }}" style="box-shadow: none; font-size: 15.5px;">
                          <span class="me-3 text-success"><i class="fas fa-question-circle"></i></span>
                          {{ $faq->question }}
                        </button>
                      </h2>
                      <div id="dynCollapse{{ $faq->id ?? $index }}" class="accordion-collapse collapse" aria-labelledby="dynHeading{{ $faq->id ?? $index }}" data-bs-parent="#dynamicFaqAccordion">
                        <div class="accordion-body px-4 pb-4 pt-0 text-white-50" style="font-size: 14px; line-height: 1.7; border-top: 1px solid rgba(255,255,255,0.05); padding-top: 16px !important;">
                          {!! nl2br(e($faq->answer)) !!}
                        </div>
                      </div>
                    </div>
                  </div>
                @endforeach
              </div>
            </div>
          @endif

          <!-- Group 1: General & Algorithmic Yield -->
          <div class="mb-5" data-aos="fade-up" data-aos-duration="900">
            <div class="d-inline-flex align-items-center gap-2 px-3 py-1 mb-3 rounded-pill" style="background: rgba(14, 165, 233, 0.1); border: 1px solid rgba(14, 165, 233, 0.25); font-size: 11px; color: #38bdf8; font-weight: 700; text-transform: uppercase; letter-spacing: 1px;">
              General &amp; Arbitrage Architecture
            </div>

            <div class="accordion custom-faq-accordion d-flex flex-column gap-3" id="generalFaqAccordion">
              
              <!-- Item 1 -->
              <div class="ecx-glass-card p-0 overflow-hidden border-0">
                <div class="accordion-item bg-transparent border-0">
                  <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button collapsed px-4 py-3 bg-transparent text-white fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne" style="box-shadow: none; font-size: 15.5px;">
                      <span class="me-3 text-info"><i class="fas fa-chart-network"></i></span>
                      How does {{ $settings->site_name ?? 'ECX Groups' }} generate consistent daily returns?
                    </button>
                  </h2>
                  <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#generalFaqAccordion">
                    <div class="accordion-body px-4 pb-4 pt-0 text-white-50" style="font-size: 14px; line-height: 1.7; border-top: 1px solid rgba(255,255,255,0.05); padding-top: 16px !important;">
                      Our yields are powered exclusively by cross-exchange statistical arbitrage and automated market making. By deploying low-latency algorithmic nodes co-located with 25+ global cryptocurrency exchanges, our system identifies instantaneous price variations for the same digital asset across different venues, simultaneously buying at the lower quote and selling at the higher quote. This generates delta-neutral profits with zero directional market risk.
                    </div>
                  </div>
                </div>
              </div>

              <!-- Item 2 -->
              <div class="ecx-glass-card p-0 overflow-hidden border-0">
                <div class="accordion-item bg-transparent border-0">
                  <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed px-4 py-3 bg-transparent text-white fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" style="box-shadow: none; font-size: 15.5px;">
                      <span class="me-3 text-info"><i class="fas fa-coins"></i></span>
                      What are the available investment tiers and minimum deposits?
                    </button>
                  </h2>
                  <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#generalFaqAccordion">
                    <div class="accordion-body px-4 pb-4 pt-0 text-white-50" style="font-size: 14px; line-height: 1.7; border-top: 1px solid rgba(255,255,255,0.05); padding-top: 16px !important;">
                      We offer four distinct institutional investment tiers designed to suit varying capital sizes:
                      <ul class="mt-2 mb-0 ps-3">
                        <li><strong>Bronze Plan:</strong> {{ $settings->currency ?? '$' }}100 – {{ $settings->currency ?? '$' }}4,999 (20% Daily for 7 Days)</li>
                        <li><strong>Silver Plan:</strong> {{ $settings->currency ?? '$' }}5,000 – {{ $settings->currency ?? '$' }}24,999 (40% Daily for 14 Days)</li>
                        <li><strong>Gold Plan:</strong> {{ $settings->currency ?? '$' }}25,000 – {{ $settings->currency ?? '$' }}49,999 (60% Daily for 21 Days)</li>
                        <li><strong>Diamond Plan:</strong> {{ $settings->currency ?? '$' }}50,000 – {{ $settings->currency ?? '$' }}150,000 (100% Daily for 30 Days)</li>
                      </ul>
                      All plans include 100% principal capital return at cycle completion.
                    </div>
                  </div>
                </div>
              </div>

              <!-- Item 3 -->
              <div class="ecx-glass-card p-0 overflow-hidden border-0">
                <div class="accordion-item bg-transparent border-0">
                  <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed px-4 py-3 bg-transparent text-white fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree" style="box-shadow: none; font-size: 15.5px;">
                      <span class="me-3 text-info"><i class="fas fa-calendar-check"></i></span>
                      When are daily profits credited to my account?
                    </button>
                  </h2>
                  <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#generalFaqAccordion">
                    <div class="accordion-body px-4 pb-4 pt-0 text-white-50" style="font-size: 14px; line-height: 1.7; border-top: 1px solid rgba(255,255,255,0.05); padding-top: 16px !important;">
                      Yields are automatically calculated and credited to your client dashboard every 24 hours from the exact timestamp your investment plan was activated. You can track your daily accruals in real time under your dashboard transactions ledger.
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>

          <!-- Group 2: Custody & Security -->
          <div class="mb-5" data-aos="fade-up" data-aos-duration="900">
            <div class="d-inline-flex align-items-center gap-2 px-3 py-1 mb-3 rounded-pill" style="background: rgba(245, 158, 11, 0.1); border: 1px solid rgba(245, 158, 11, 0.25); font-size: 11px; color: #f59e0b; font-weight: 700; text-transform: uppercase; letter-spacing: 1px;">
              Cold Vault Custody &amp; Safety
            </div>

            <div class="accordion custom-faq-accordion d-flex flex-column gap-3" id="securityFaqAccordion">
              
              <!-- Item 4 -->
              <div class="ecx-glass-card p-0 overflow-hidden border-0">
                <div class="accordion-item bg-transparent border-0">
                  <h2 class="accordion-header" id="headingFour">
                    <button class="accordion-button collapsed px-4 py-3 bg-transparent text-white fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour" style="box-shadow: none; font-size: 15.5px;">
                      <span class="me-3 text-warning"><i class="fas fa-shield-alt"></i></span>
                      How are my assets protected against exchange collapses (e.g. FTX)?
                    </button>
                  </h2>
                  <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#securityFaqAccordion">
                    <div class="accordion-body px-4 pb-4 pt-0 text-white-50" style="font-size: 14px; line-height: 1.7; border-top: 1px solid rgba(255,255,255,0.05); padding-top: 16px !important;">
                      {{ $settings->site_name ?? 'ECX Groups' }} enforces strict zero-rehypothecation. Deposited funds are never lent, pledged, or commingled with trading desks. 95%+ of client balances are maintained in segregated multi-signature cold storage hardware modules (HSMs). Only the minimum collateral required for immediate active arbitrage execution is deployed into segregated API sub-accounts, protected by institutional loss-stop triggers.
                    </div>
                  </div>
                </div>
              </div>

              <!-- Item 5 -->
              <div class="ecx-glass-card p-0 overflow-hidden border-0">
                <div class="accordion-item bg-transparent border-0">
                  <h2 class="accordion-header" id="headingFive">
                    <button class="accordion-button collapsed px-4 py-3 bg-transparent text-white fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive" style="box-shadow: none; font-size: 15.5px;">
                      <span class="me-3 text-warning"><i class="fas fa-user-lock"></i></span>
                      Is two-factor authentication (2FA) and KYC mandatory?
                    </button>
                  </h2>
                  <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#securityFaqAccordion">
                    <div class="accordion-body px-4 pb-4 pt-0 text-white-50" style="font-size: 14px; line-height: 1.7; border-top: 1px solid rgba(255,255,255,0.05); padding-top: 16px !important;">
                      Yes. In compliance with international anti-money laundering (AML) and counter-terrorist financing (CTF) regulations, all accounts undergo automated KYC identity verification. We strongly mandate two-factor authentication (Google Authenticator) on all account withdrawals and security changes.
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>

          <!-- Group 3: Deposits & Withdrawals -->
          <div class="mb-5" data-aos="fade-up" data-aos-duration="900">
            <div class="d-inline-flex align-items-center gap-2 px-3 py-1 mb-3 rounded-pill" style="background: rgba(0, 245, 155, 0.1); border: 1px solid rgba(0, 245, 155, 0.25); font-size: 11px; color: #00f59b; font-weight: 700; text-transform: uppercase; letter-spacing: 1px;">
              Deposits &amp; Withdrawals
            </div>

            <div class="accordion custom-faq-accordion d-flex flex-column gap-3" id="fundingFaqAccordion">
              
              <!-- Item 6 -->
              <div class="ecx-glass-card p-0 overflow-hidden border-0">
                <div class="accordion-item bg-transparent border-0">
                  <h2 class="accordion-header" id="headingSix">
                    <button class="accordion-button collapsed px-4 py-3 bg-transparent text-white fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix" style="box-shadow: none; font-size: 15.5px;">
                      <span class="me-3 text-success"><i class="fas fa-wallet"></i></span>
                      What currencies and payment methods can I deposit with?
                    </button>
                  </h2>
                  <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#fundingFaqAccordion">
                    <div class="accordion-body px-4 pb-4 pt-0 text-white-50" style="font-size: 14px; line-height: 1.7; border-top: 1px solid rgba(255,255,255,0.05); padding-top: 16px !important;">
                      We support major cryptocurrencies including Bitcoin (BTC), Ethereum (ETH), Tether (USDT TRC20 &amp; ERC20), USD Coin (USDC), BNB, and Solana (SOL). In addition, users can fund accounts directly via Credit/Debit Cards (Visa &amp; Mastercard) or bank wire transfers through our verified gateway partners.
                    </div>
                  </div>
                </div>
              </div>

              <!-- Item 7 -->
              <div class="ecx-glass-card p-0 overflow-hidden border-0">
                <div class="accordion-item bg-transparent border-0">
                  <h2 class="accordion-header" id="headingSeven">
                    <button class="accordion-button collapsed px-4 py-3 bg-transparent text-white fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven" style="box-shadow: none; font-size: 15.5px;">
                      <span class="me-3 text-success"><i class="fas fa-paper-plane"></i></span>
                      How long does it take to process a withdrawal?
                    </button>
                  </h2>
                  <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven" data-bs-parent="#fundingFaqAccordion">
                    <div class="accordion-body px-4 pb-4 pt-0 text-white-50" style="font-size: 14px; line-height: 1.7; border-top: 1px solid rgba(255,255,255,0.05); padding-top: 16px !important;">
                      Cryptocurrency withdrawals are processed through automated smart liquidity rails once verified by our multi-signature security layer. Standard withdrawals typically broadcast to the blockchain within 5 to 30 minutes. There are zero withdrawal fee markups charged by {{ $settings->site_name ?? 'ECX Groups' }}—only standard blockchain network miner fees apply.
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>

        </div>
      </div>

      <!-- Bottom Assistance Banner -->
      <div class="row justify-content-center mt-4" data-aos="fade-up" data-aos-duration="1000">
        <div class="col-12 col-lg-10">
          <div class="ecx-glass-card text-center p-4 p-md-5" style="border: 1px solid rgba(0, 245, 155, 0.3);">
            <div class="fs-1 text-success mb-3"><i class="fas fa-headset"></i></div>
            <h3 class="text-white fw-bold mb-2">Still Have Unanswered Questions?</h3>
            <p class="text-white-50 mx-auto mb-4" style="max-width: 540px; font-size: 14.5px;">
              Our institutional client desk is available 24 hours a day, 7 days a week to provide customized consultation and technical support.
            </p>
            <div class="d-flex justify-content-center gap-3 flex-wrap">
              <a href="{{ route('contact') }}" class="trk-btn trk-btn--primary trk-btn--arrow py-3 px-4">
                <span>Contact Global Desk</span>
              </a>
              @if(!empty($settings->phone))
                @php
                  $cleanPhone = preg_replace('/[^0-9]/', '', $settings->phone);
                @endphp
                @if(!empty($cleanPhone))
                  <a href="https://wa.me/{{ $cleanPhone }}" target="_blank" class="trk-btn trk-btn--border trk-btn--primary py-3 px-4" style="border-color: #25D366; color: #25D366;">
                    <i class="fab fa-whatsapp me-2"></i> WhatsApp Support
                  </a>
                @endif
              @endif
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>
  <!-- ===============>> FAQ Main Section End <<================= -->
@endsection
