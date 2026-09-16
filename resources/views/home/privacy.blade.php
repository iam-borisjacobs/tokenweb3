@php
    if ($settings->redirect_url != null || !empty($settings->redirect_url)) {
        header("Location: $settings->redirect_url", true, 301);
        exit();
    }
@endphp
@extends('layouts.base')

@section('title', 'Privacy Policy – Data Protection & Encryption Standards')

@section('content')
    <!-- ==================== HERO SECTION ==================== -->
    <section class="section section--head page-hero-section">
        <div class="container pt-4 pb-2">
            <div class="row justify-content-center text-center">
                <div class="col-12 col-xl-8">
                    <div class="hero-pill-badge mx-auto mb-3">
                        <i class="ti ti-shield-check text-info"></i> Legal Governance &amp; Compliance
                    </div>
                    <h1 class="page-hero-title">
                        Privacy <span class="text-gradient-cyan">Policy</span>
                    </h1>
                    <p class="page-hero-text">
                        How {{ $settings->site_name }} protects your personal identity, cryptographic records, and communications under global privacy regulations.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== LEGAL CONTENT ==================== -->
    <section class="section pt-3 pb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-10">
                    <div class="page-modern-card p-4 p-md-5">
                        <div class="text-adaptive-muted" style="line-height: 1.8; font-size: 14.5px;">
                            {!! $terms->description !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
