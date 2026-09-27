@extends('home.ecx.layout')

@section('title', 'Contact & Institutional Support - ' . ($settings->site_name ?? 'ECX Groups'))

@section('content')
  <!-- ===============>> Page Header Start <<================= -->
  <section class="page-header">
    <div class="container">
      <div class="page-header__content" data-aos="fade-right" data-aos-duration="900">
        <div class="d-inline-flex align-items-center gap-2 px-3 py-1 mb-3 rounded-pill" style="background: rgba(0, 245, 155, 0.1); border: 1px solid rgba(0, 245, 155, 0.25); font-size: 12px; color: #00f59b; font-weight: 700;">
          <span style="width: 8px; height: 8px; border-radius: 50%; background: #00f59b; box-shadow: 0 0 10px #00f59b;"></span>
          Institutional Support Desk • 24/7 Global Coverage
        </div>
        <h2>Connect With Our <span style="color: #00f59b;">Global Team</span></h2>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
          </ol>
        </nav>
      </div>
    </div>
  </section>
  <!-- ===============>> Page Header End <<================= -->

  <!-- ===============>> Contact Main Section Start <<================= -->
  <section class="contact-section py-5" style="background-color: #070b14; position: relative;">
    <div class="container py-4">

      <!-- Alert Flash Messages -->
      @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4 border-0" role="alert" style="background: rgba(0, 245, 155, 0.15); border: 1px solid #00f59b !important; color: #00f59b; border-radius: 12px; padding: 18px 24px;">
          <div class="d-flex align-items-center gap-2">
            <i class="fas fa-check-circle" style="font-size: 20px;"></i>
            <div>
              <strong>Inquiry Transmitted Successfully!</strong>
              <div>{{ session('success') }}</div>
            </div>
          </div>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

      @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show mb-4 border-0" role="alert" style="background: rgba(239, 68, 68, 0.15); border: 1px solid #ef4444 !important; color: #fca5a5; border-radius: 12px; padding: 18px 24px;">
          <div class="d-flex align-items-center gap-2">
            <i class="fas fa-exclamation-triangle" style="font-size: 20px;"></i>
            <div>
              <strong>Transmission Alert:</strong>
              <div>{{ session('error') }}</div>
            </div>
          </div>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

      @if(isset($errors) && $errors->any())
        <div class="alert alert-warning alert-dismissible fade show mb-4 border-0" role="alert" style="background: rgba(245, 158, 11, 0.15); border: 1px solid #f59e0b !important; color: #fde68a; border-radius: 12px; padding: 18px 24px;">
          <strong>Please resolve the following fields:</strong>
          <ul class="mb-0 mt-2 ps-3">
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

      <!-- Top Contact Info Cards Row -->
      <div class="row g-4 mb-5">
        <!-- Card 1: Official Email -->
        <div class="col-12 col-md-4" data-aos="fade-up" data-aos-duration="800">
          <div class="ecx-glass-card h-100 d-flex flex-column" style="border-left: 3px solid #00f59b;">
            <div class="d-flex align-items-center gap-3 mb-3">
              <div style="width: 52px; height: 52px; border-radius: 12px; background: rgba(0, 245, 155, 0.1); border: 1px solid rgba(0, 245, 155, 0.25); display: flex; align-items: center; justify-content: center; color: #00f59b; font-size: 22px;">
                <i class="fas fa-envelope-open-text"></i>
              </div>
              <div>
                <span style="font-size: 11px; text-transform: uppercase; letter-spacing: 1px; color: #94a3b8; font-weight: 700;">Direct Dispatch</span>
                <h5 class="text-white mb-0" style="font-size: 17px; font-weight: 700;">Email Communication</h5>
              </div>
            </div>
            <p style="font-size: 13.5px; color: #94a3b8; line-height: 1.6; margin-bottom: 16px;">
              Direct line to our institutional execution and account compliance team.
            </p>
            <div class="mt-auto">
              <a href="mailto:{{ $settings->contact_email ?? 'support@' . request()->getHost() }}" class="d-inline-flex align-items-center gap-2 fw-semibold" style="color: #00f59b; text-decoration: none; word-break: break-all; font-size: 14.5px;">
                <span>{{ $settings->contact_email ?? 'support@' . request()->getHost() }}</span>
                <i class="fas fa-arrow-right f-12"></i>
              </a>
            </div>
          </div>
        </div>

        <!-- Card 2: Phone & WhatsApp -->
        <div class="col-12 col-md-4" data-aos="fade-up" data-aos-duration="900">
          <div class="ecx-glass-card h-100 d-flex flex-column" style="border-left: 3px solid #0ea5e9;">
            <div class="d-flex align-items-center gap-3 mb-3">
              <div style="width: 52px; height: 52px; border-radius: 12px; background: rgba(14, 165, 233, 0.1); border: 1px solid rgba(14, 165, 233, 0.25); display: flex; align-items: center; justify-content: center; color: #0ea5e9; font-size: 22px;">
                <i class="fas fa-phone-alt"></i>
              </div>
              <div>
                <span style="font-size: 11px; text-transform: uppercase; letter-spacing: 1px; color: #94a3b8; font-weight: 700;">Direct Telephone</span>
                <h5 class="text-white mb-0" style="font-size: 17px; font-weight: 700;">Telephone & Telegram</h5>
              </div>
            </div>
            <p style="font-size: 13.5px; color: #94a3b8; line-height: 1.6; margin-bottom: 16px;">
              Immediate trading desk connectivity & encrypted mobile messaging.
            </p>
            <div class="mt-auto d-flex flex-column gap-2">
              @if(!empty($settings->phone))
                <a href="tel:{{ $settings->phone }}" class="d-inline-flex align-items-center gap-2 fw-semibold" style="color: #0ea5e9; text-decoration: none; font-size: 14.5px;">
                  <i class="fas fa-phone-volume f-12"></i>
                  <span>{{ $settings->phone }}</span>
                </a>
              @endif
              @php
                $tgUrl = $settings->getTelegramUrl() ?: 'https://t.me/' . ($settings->telegram_username ?: 'ecxgroups');
              @endphp
              <a href="{{ $tgUrl }}" target="_blank" rel="noopener noreferrer" class="d-inline-flex align-items-center gap-2 fw-semibold" style="color: #229ED9; text-decoration: none; font-size: 13.5px;">
                <i class="fab fa-telegram-plane f-14"></i>
                <span>Connect on Telegram</span>
              </a>
            </div>
          </div>
        </div>

        <!-- Card 3: Physical Headquarters -->
        <div class="col-12 col-md-4" data-aos="fade-up" data-aos-duration="1000">
          <div class="ecx-glass-card h-100 d-flex flex-column" style="border-left: 3px solid #f59e0b;">
            <div class="d-flex align-items-center gap-3 mb-3">
              <div style="width: 52px; height: 52px; border-radius: 12px; background: rgba(245, 158, 11, 0.1); border: 1px solid rgba(245, 158, 11, 0.25); display: flex; align-items: center; justify-content: center; color: #f59e0b; font-size: 22px;">
                <i class="fas fa-map-marker-alt"></i>
              </div>
              <div>
                <span style="font-size: 11px; text-transform: uppercase; letter-spacing: 1px; color: #94a3b8; font-weight: 700;">Global Presence</span>
                <h5 class="text-white mb-0" style="font-size: 17px; font-weight: 700;">Registered Office</h5>
              </div>
            </div>
            <p style="font-size: 13.5px; color: #94a3b8; line-height: 1.6; margin-bottom: 16px;">
              {{ $settings->location ?? 'One Canada Square, Canary Wharf, London E14 5AB, United Kingdom' }}
            </p>
            <div class="mt-auto">
              <span class="badge" style="background: rgba(245, 158, 11, 0.15); border: 1px solid rgba(245, 158, 11, 0.3); color: #f59e0b; font-size: 11.5px; padding: 6px 12px; border-radius: 6px;">
                <i class="fas fa-building me-1"></i> Corporate Headquarters
              </span>
            </div>
          </div>
        </div>
      </div>

      <!-- Main Form & Detail Grid -->
      <div class="row g-5 align-items-stretch mb-5">
        
        <!-- Left: Contact Form Column -->
        <div class="col-12 col-lg-7" data-aos="fade-right" data-aos-duration="1000">
          <div class="ecx-glass-card h-100">
            <div class="mb-4">
              <div class="d-inline-flex align-items-center gap-2 px-3 py-1 mb-2 rounded-pill" style="background: rgba(0, 245, 155, 0.1); border: 1px solid rgba(0, 245, 155, 0.25); font-size: 11px; color: #00f59b; font-weight: 700; text-transform: uppercase; letter-spacing: 1px;">
                Inquiry Dispatch
              </div>
              <h3 class="text-white fw-bold mb-2">Send an Institutional Inquiry</h3>
              <p style="color: #94a3b8; font-size: 14px; margin-bottom: 0;">
                Our global team monitors inbound dispatches 24/7. Average response turnaround is under 15 minutes.
              </p>
            </div>

            <form action="{{ route('contact.send') }}" method="POST">
              @csrf
              <div class="row g-3">
                <div class="col-md-6">
                  <label for="contact_name" class="form-label text-white-50 small fw-bold">YOUR NAME <span class="text-danger">*</span></label>
                  <input type="text" name="name" id="contact_name" class="form-control ecx-input" placeholder="e.g. Alexander Vance" value="{{ old('name') }}" required>
                </div>
                <div class="col-md-6">
                  <label for="contact_email" class="form-label text-white-50 small fw-bold">WORK EMAIL <span class="text-danger">*</span></label>
                  <input type="email" name="email" id="contact_email" class="form-control ecx-input" placeholder="e.g. alexander@institution.com" value="{{ old('email') }}" required>
                </div>
                <div class="col-12">
                  <label for="contact_subject" class="form-label text-white-50 small fw-bold">SUBJECT / DEPARTMENT <span class="text-danger">*</span></label>
                  <input type="text" name="subject" id="contact_subject" class="form-control ecx-input" placeholder="e.g. Inquiry regarding Gold Tier Allocation" value="{{ old('subject') }}" required>
                </div>
                <div class="col-12">
                  <label for="contact_message" class="form-label text-white-50 small fw-bold">MESSAGE DETAILS <span class="text-danger">*</span></label>
                  <textarea name="message" id="contact_message" rows="5" class="form-control ecx-input" placeholder="Describe your inquiry, requested capital allocation, or technical requirements..." required>{{ old('message') }}</textarea>
                </div>
                <div class="col-12 pt-2">
                  <button type="submit" class="trk-btn trk-btn--primary trk-btn--arrow w-100 py-3" style="font-size: 15px; font-weight: 700; border-radius: 10px;">
                    <span>Transmit Message to Desk</span>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>

        <!-- Right: Departmental Matrix & SLA Column -->
        <div class="col-12 col-lg-5" data-aos="fade-left" data-aos-duration="1000">
          <div class="d-flex flex-column gap-4 h-100">
            
            <!-- Box 1: Support SLA Guarantee -->
            <div class="ecx-glass-card" style="border-left: 3px solid #00f59b;">
              <h5 class="text-white fw-bold mb-3 d-flex align-items-center gap-2">
                <i class="fas fa-shield-alt text-success"></i>
                <span>Institutional SLA Commitments</span>
              </h5>
              <div class="d-flex flex-column gap-3">
                <div class="d-flex justify-content-between align-items-center pb-2 border-bottom border-secondary border-opacity-25">
                  <span style="font-size: 13.5px; color: #94a3b8;">Trading Desk Availability</span>
                  <span class="badge bg-success bg-opacity-20 text-success fw-bold">24/7/365 Non-Stop</span>
                </div>
                <div class="d-flex justify-content-between align-items-center pb-2 border-bottom border-secondary border-opacity-25">
                  <span style="font-size: 13.5px; color: #94a3b8;">Average Response Time</span>
                  <span class="text-white fw-bold">&lt; 15 Minutes</span>
                </div>
                <div class="d-flex justify-content-between align-items-center pb-2 border-bottom border-secondary border-opacity-25">
                  <span style="font-size: 13.5px; color: #94a3b8;">Cold Vault Verification</span>
                  <span class="text-white fw-bold">Automated 1:1 Live</span>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                  <span style="font-size: 13.5px; color: #94a3b8;">Emergency Withdrawal Desk</span>
                  <span class="badge bg-info bg-opacity-20 text-info fw-bold">Priority Channel</span>
                </div>
              </div>
            </div>

            <!-- Box 2: Department Contacts -->
            <div class="ecx-glass-card flex-grow-1">
              <h5 class="text-white fw-bold mb-3 d-flex align-items-center gap-2">
                <i class="fas fa-network-wired text-info"></i>
                <span>Department Routing</span>
              </h5>
              
              <div class="d-flex flex-column gap-3">
                <!-- Dept 1 -->
                <div class="p-3 rounded-3" style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.06);">
                  <div class="d-flex justify-content-between align-items-center mb-1">
                    <span class="fw-bold text-white" style="font-size: 14px;">Capital Allocations & VIP</span>
                    <span class="badge bg-warning bg-opacity-20 text-warning" style="font-size: 10px;">High Priority</span>
                  </div>
                  <div style="font-size: 12.5px; color: #94a3b8;">For investments exceeding $50,000 or custom treasury setups.</div>
                </div>

                <!-- Dept 2 -->
                <div class="p-3 rounded-3" style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.06);">
                  <div class="d-flex justify-content-between align-items-center mb-1">
                    <span class="fw-bold text-white" style="font-size: 14px;">Compliance & AML Audits</span>
                    <span class="badge bg-secondary bg-opacity-30 text-white-50" style="font-size: 10px;">Regulated</span>
                  </div>
                  <div style="font-size: 12.5px; color: #94a3b8;">Identity verification, corporate onboarding & legal certifications.</div>
                </div>

                <!-- Dept 3 -->
                <div class="p-3 rounded-3" style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.06);">
                  <div class="d-flex justify-content-between align-items-center mb-1">
                    <span class="fw-bold text-white" style="font-size: 14px;">Technical Trading Operations</span>
                    <span class="badge bg-success bg-opacity-20 text-success" style="font-size: 10px;">Live Ops</span>
                  </div>
                  <div style="font-size: 12.5px; color: #94a3b8;">API endpoints, sub-account routing, and arbitrage surveillance.</div>
                </div>
              </div>

            </div>

          </div>
        </div>

      </div>

      <!-- Google Map Section (Full Admin Alignment) -->
      <div class="row" data-aos="fade-up" data-aos-duration="1000">
        <div class="col-12">
          <div class="ecx-glass-card p-2" style="overflow: hidden; border-radius: 20px;">
            <div class="p-3 d-flex justify-content-between align-items-center border-bottom border-white border-opacity-10 mb-2">
              <div class="d-flex align-items-center gap-2">
                <i class="fas fa-map-marked-alt text-success"></i>
                <span class="text-white fw-bold" style="font-size: 14px;">Global Custodial & Corporate Hub</span>
              </div>
              <span class="text-white-50 small">{{ $settings->location ?? 'One Canada Square, Canary Wharf, London E14 5AB, UK' }}</span>
            </div>
            
            <div style="width: 100%; height: 380px; border-radius: 14px; overflow: hidden;">
              @if(!empty($settings->map_iframe))
                {!! $settings->map_iframe !!}
              @else
                @php
                  $addressQuery = urlencode($settings->location ?? 'One Canada Square, Canary Wharf, London E14 5AB, UK');
                @endphp
                <iframe 
                  src="https://maps.google.com/maps?q={{ $addressQuery }}&t=&z=13&ie=UTF8&iwloc=&output=embed" 
                  width="100%" 
                  height="100%" 
                  style="border:0; filter: invert(90%) hue-rotate(180deg) brightness(85%) contrast(120%);" 
                  allowfullscreen="" 
                  loading="lazy" 
                  referrerpolicy="no-referrer-when-downgrade">
                </iframe>
              @endif
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>
  <!-- ===============>> Contact Main Section End <<================= -->
@endsection
