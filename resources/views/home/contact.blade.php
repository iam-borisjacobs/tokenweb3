@php
    if ($settings->redirect_url != null || !empty($settings->redirect_url)) {
        header("Location: $settings->redirect_url", true, 301);
        exit();
    }
@endphp
@extends('layouts.base')

@section('title', 'Contact Us – 24/7 Institutional Support & Inquiries')

@section('styles')
    @parent
    <style>
        /* Strict Mobile View Alignment & Anti-Overspreading */
        .contact-page-wrapper {
            width: 100% !important;
            max-width: 100% !important;
            overflow-x: hidden !important;
            box-sizing: border-box !important;
        }
        .contact-card-box {
            background: rgba(16, 22, 34, 0.75);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 18px;
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            transition: all 0.3s ease;
            box-sizing: border-box;
            max-width: 100%;
        }
        [data-theme="light"] .contact-card-box {
            background: #ffffff !important;
            border-color: #e2e8f0 !important;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.04) !important;
        }
        .contact-card-box:hover {
            border-color: rgba(0, 229, 255, 0.35);
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(0, 229, 255, 0.12);
        }
        [data-theme="light"] .contact-card-box:hover {
            border-color: rgba(2, 132, 199, 0.35) !important;
            box-shadow: 0 12px 35px rgba(15, 23, 42, 0.08) !important;
        }
        .contact-input-group {
            position: relative;
            width: 100%;
        }
        .contact-input-icon {
            position: absolute;
            top: 50%;
            left: 16px;
            transform: translateY(-50%);
            color: var(--text-muted, #94a3b8);
            font-size: 18px;
            pointer-events: none;
            z-index: 4;
        }
        .contact-textarea-icon {
            position: absolute;
            top: 16px;
            left: 16px;
            color: var(--text-muted, #94a3b8);
            font-size: 18px;
            pointer-events: none;
            z-index: 4;
        }
        .contact-form-control {
            width: 100% !important;
            max-width: 100% !important;
            box-sizing: border-box !important;
            background: rgba(7, 9, 14, 0.6) !important;
            border: 1px solid rgba(255, 255, 255, 0.12) !important;
            border-radius: 12px !important;
            color: #ffffff !important;
            padding: 12px 16px 12px 46px !important;
            font-size: 14px !important;
            transition: all 0.2s ease !important;
        }
        [data-theme="light"] .contact-form-control {
            background: #f8fafc !important;
            border-color: #cbd5e1 !important;
            color: #0f172a !important;
        }
        .contact-form-control:focus {
            border-color: var(--accent-cyan, #00e5ff) !important;
            box-shadow: 0 0 0 3px rgba(0, 229, 255, 0.15) !important;
            outline: none !important;
        }
        [data-theme="light"] .contact-form-control:focus {
            border-color: #0284c7 !important;
            box-shadow: 0 0 0 3px rgba(2, 132, 199, 0.15) !important;
        }
        .contact-form-control::placeholder {
            color: #64748b !important;
        }
        [data-theme="light"] .contact-form-control::placeholder {
            color: #94a3b8 !important;
        }
        .map-container-frame {
            width: 100% !important;
            max-width: 100% !important;
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.1);
            background: #0f172a;
            position: relative;
            min-height: 280px;
        }
        [data-theme="light"] .map-container-frame {
            border-color: #e2e8f0;
            background: #f1f5f9;
        }
        .map-container-frame iframe {
            width: 100% !important;
            height: 100% !important;
            min-height: 280px;
            border: 0;
            display: block;
        }
        @media (max-width: 576px) {
            .contact-form-control {
                font-size: 13px !important;
                padding-left: 42px !important;
            }
            .map-container-frame {
                min-height: 230px;
            }
            .map-container-frame iframe {
                min-height: 230px;
            }
        }
    </style>
@endsection

@section('content')
<div class="contact-page-wrapper">
    <!-- ==================== HERO SECTION ==================== -->
    <section class="section section--head page-hero-section">
        <div class="container pt-4 pb-2">
            <div class="row justify-content-center text-center">
                <div class="col-12 col-xl-9">
                    <div class="hero-pill-badge mx-auto mb-3">
                        <i class="ti ti-headset text-info"></i> 24/7 Global Trading &amp; Security Desk
                    </div>
                    <h1 class="page-hero-title">
                        Get in Touch with Our <span class="text-gradient-cyan">Advisory Team</span>
                    </h1>
                    <p class="page-hero-text">
                        Have questions about segregated vault custody, institutional arbitrage liquidity, or partnership onboarding? Our specialists are available around the clock.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== 3 CONTACT INFO CARDS ==================== -->
    <section class="section pt-3 pb-4">
        <div class="container">
            <div class="row g-3 g-md-4">
                <!-- 1. Email Channel -->
                <div class="col-12 col-md-4">
                    <div class="contact-card-box p-4 h-100 d-flex flex-column justify-content-between">
                        <div>
                            <div class="rounded-3 d-inline-flex align-items-center justify-content-center mb-3" style="width: 48px; height: 48px; background: rgba(0, 229, 255, 0.12); color: #00E5FF; font-size: 22px;">
                                <i class="ti ti-mail"></i>
                            </div>
                            <h6 class="text-adaptive-primary f-w-700 mb-1">Official Support Email</h6>
                            <p class="text-adaptive-muted f-12 mb-3">Guaranteed response within 2 business hours.</p>
                        </div>
                        <div>
                            <a href="mailto:{{ $settings->contact_email ?? 'support@' . request()->getHost() }}" class="text-info f-w-700 f-14 text-decoration-none text-break d-inline-flex align-items-center gap-1">
                                <span>{{ $settings->contact_email ?? 'support@' . request()->getHost() }}</span>
                                <i class="ti ti-arrow-up-right f-14"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- 2. Telephone Channel -->
                <div class="col-12 col-md-4">
                    <div class="contact-card-box p-4 h-100 d-flex flex-column justify-content-between">
                        <div>
                            <div class="rounded-3 d-inline-flex align-items-center justify-content-center mb-3" style="width: 48px; height: 48px; background: rgba(16, 185, 129, 0.12); color: #10B981; font-size: 22px;">
                                <i class="ti ti-phone-call"></i>
                            </div>
                            <h6 class="text-adaptive-primary f-w-700 mb-1">Direct Trading Hotline</h6>
                            <p class="text-adaptive-muted f-12 mb-3">Instant connection to global trading operations.</p>
                        </div>
                        <div>
                            @php
                                $phoneNum = !empty($settings->phone) ? $settings->phone : '+1 (800) 552-0199';
                                $phoneClean = preg_replace('/[^0-9+]/', '', $phoneNum);
                            @endphp
                            <a href="tel:{{ $phoneClean }}" class="text-success f-w-700 f-14 text-decoration-none d-inline-flex align-items-center gap-1">
                                <span>{{ $phoneNum }}</span>
                                <i class="ti ti-arrow-up-right f-14"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- 3. Physical Office / Location -->
                <div class="col-12 col-md-4">
                    <div class="contact-card-box p-4 h-100 d-flex flex-column justify-content-between">
                        <div>
                            <div class="rounded-3 d-inline-flex align-items-center justify-content-center mb-3" style="width: 48px; height: 48px; background: rgba(139, 92, 246, 0.12); color: #8B5CF6; font-size: 22px;">
                                <i class="ti ti-map-pin"></i>
                            </div>
                            <h6 class="text-adaptive-primary f-w-700 mb-1">Global Headquarters</h6>
                            <p class="text-adaptive-muted f-12 mb-3">Institutional custody operations &amp; engineering.</p>
                        </div>
                        <div>
                            <span class="text-adaptive-primary f-13" style="line-height: 1.5;">
                                {{ $settings->location ?? '25 Bank Street, Canary Wharf, London, E14 5JP, UK' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== MAIN FORM + INTERACTIVE MAP SECTION ==================== -->
    <section class="section pt-3 pb-5">
        <div class="container">
            <div class="row g-4 align-items-stretch">
                <!-- Left Column: Inquiry Form -->
                <div class="col-12 col-lg-7">
                    <div class="contact-card-box p-4 p-sm-4 p-md-5 h-100">
                        <div class="mb-4">
                            <h4 class="text-adaptive-primary f-w-800 mb-1">Send an Official Inquiry</h4>
                            <p class="text-adaptive-muted f-13 mb-0">Fill out your details below and an institutional risk officer will respond promptly.</p>
                        </div>

                        <x-danger-alert />
                        <x-success-alert />

                        <form method="POST" action="{{ route('enquiry') }}" class="w-100">
                            @csrf
                            <div class="row g-3">
                                <div class="col-12 col-sm-6">
                                    <label class="form-label text-adaptive-primary f-13 f-w-600 mb-1">Your Full Name <span class="text-danger">*</span></label>
                                    <div class="contact-input-group">
                                        <i class="ti ti-user contact-input-icon"></i>
                                        <input type="text" name="name" class="contact-form-control" placeholder="e.g. Jonathan Vance" required>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-6">
                                    <label class="form-label text-adaptive-primary f-13 f-w-600 mb-1">Your Email Address <span class="text-danger">*</span></label>
                                    <div class="contact-input-group">
                                        <i class="ti ti-mail contact-input-icon"></i>
                                        <input type="email" name="email" class="contact-form-control" placeholder="e.g. jvance@domain.com" required>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label class="form-label text-adaptive-primary f-13 f-w-600 mb-1">Subject / Department <span class="text-danger">*</span></label>
                                    <div class="contact-input-group">
                                        <i class="ti ti-briefcase contact-input-icon"></i>
                                        <input type="text" name="subject" class="contact-form-control" placeholder="e.g. Institutional Liquidity & Vault Custody Inquiry" required>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label class="form-label text-adaptive-primary f-13 f-w-600 mb-1">Message Content <span class="text-danger">*</span></label>
                                    <div class="contact-input-group">
                                        <i class="ti ti-message-2 contact-textarea-icon"></i>
                                        <textarea name="message" rows="5" class="contact-form-control" placeholder="Describe your inquiry, portfolio questions, or partnership proposal..." required></textarea>
                                    </div>
                                </div>

                                <div class="col-12 pt-2">
                                    <button type="submit" class="btn-hero-primary w-100 justify-content-center py-3">
                                        <i class="ti ti-send me-1" style="font-size: 18px;"></i>
                                        <span>Dispatch Message to Support Desk</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Right Column: Interactive Map & Operational Security Status -->
                <div class="col-12 col-lg-5 d-flex flex-column gap-4">
                    <!-- Google Map Embed Card -->
                    <div class="contact-card-box p-4 flex-grow-1 d-flex flex-column">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="d-flex align-items-center gap-2">
                                <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; background: rgba(0, 229, 255, 0.12); color: #00E5FF;">
                                    <i class="ti ti-map-2 f-16"></i>
                                </div>
                                <h6 class="text-adaptive-primary f-w-700 mb-0">Office Location Map</h6>
                            </div>
                            <span class="badge bg-light-primary text-info border border-info border-opacity-25 px-2 py-1 rounded f-11">
                                Verified Address
                            </span>
                        </div>

                        <!-- Map Frame -->
                        <div class="map-container-frame flex-grow-1">
                            @if (!empty($settings->map_iframe) && str_contains($settings->map_iframe, '<iframe'))
                                {!! $settings->map_iframe !!}
                            @else
                                @php
                                    $mapQuery = urlencode($settings->location ?? '25 Bank Street, Canary Wharf, London, E14 5JP');
                                @endphp
                                <iframe 
                                    src="https://maps.google.com/maps?q={{ $mapQuery }}&t=&z=14&ie=UTF8&iwloc=&output=embed" 
                                    frameborder="0" 
                                    scrolling="no" 
                                    marginheight="0" 
                                    marginwidth="0" 
                                    allowfullscreen 
                                    loading="lazy"
                                    title="Google Map Location">
                                </iframe>
                            @endif
                        </div>
                    </div>

                    <!-- Security Desk Verification Badge -->
                    <div class="contact-card-box p-4" style="background: rgba(16, 185, 129, 0.05); border-color: rgba(16, 185, 129, 0.2);">
                        <div class="d-flex align-items-center gap-3 mb-2">
                            <span class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center flex-shrink-0" style="width: 34px; height: 34px;">
                                <i class="ti ti-shield-check f-18"></i>
                            </span>
                            <div>
                                <h6 class="text-adaptive-primary f-w-700 mb-0">SOC 2 Type II Certified Facilities</h6>
                                <small class="text-success f-11">Encrypted 256-Bit SSL Message Transmission</small>
                            </div>
                        </div>
                        <p class="text-adaptive-muted f-12 mb-0" style="line-height: 1.6;">
                            All inbound communications and investor queries are encrypted in transit. Account specifics are verified against multi-factor authorization.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
