@php
    $welcomeSlides = $settings->getWelcomeSlides();
    $activeSlides = array_values(array_filter($welcomeSlides, function($s) {
        return ($s['is_active'] ?? 'yes') !== 'no';
    }));
    $totalSlides = count($activeSlides);
    $isPopupEnabled = (($settings->enable_welcome_popup ?? 'yes') === 'yes') && ($totalSlides > 0);
@endphp

@if($isPopupEnabled)
<!-- Institutional Multi-Slide Welcome & Wallet Connect Onboarding Modal -->
<div class="modal fade welcome-onboarding-modal" id="welcomeOnboardingModal" tabindex="-1" aria-labelledby="welcomeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg welcome-modal-dialog">
        <div class="modal-content border-0 shadow-lg welcome-modal-content position-relative overflow-hidden">
            
            <!-- Top Gradient Accent Rail -->
            <div class="welcome-top-rail" style="height: 4px; background: linear-gradient(90deg, #2563eb 0%, #4f46e5 45%, #06b6d4 75%, #10b981 100%);"></div>

            <!-- Modal Header -->
            <div class="modal-header border-0 pb-0 pt-3 pt-md-4 px-3 px-md-5 d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-2">
                    @if($totalSlides > 1)
                        <span class="badge welcome-step-badge rounded-pill px-2 px-md-3 py-1 py-md-2 f-11 f-md-12 f-w-700" id="welcomeModalStepPill">
                            <span class="pulse-dot me-1"></span> Step <span id="welcomeCurrentStepNum">1</span> of {{ $totalSlides }}
                        </span>
                        <span class="text-muted f-12 d-none d-sm-inline-block fw-semibold">• Investor Onboarding</span>
                    @else
                        <span class="badge welcome-step-badge rounded-pill px-2 px-md-3 py-1 py-md-2 f-11 f-md-12 f-w-700" id="welcomeModalStepPill">
                            <i class="fa-solid fa-circle-info text-primary me-1"></i> Important Notice
                        </span>
                        <span class="text-muted f-12 d-none d-sm-inline-block fw-semibold">• Investor Portal</span>
                    @endif
                </div>
                <button type="button" class="welcome-close-btn shadow-sm" data-bs-dismiss="modal" aria-label="Close" onclick="onWelcomeModalClose()" title="Close popup">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            @if($totalSlides > 1)
            <!-- Progress Step Indicators -->
            <div class="px-3 px-md-5 pt-2 pb-1">
                <div class="welcome-stepper-track d-flex gap-2">
                    @for($i = 0; $i < $totalSlides; $i++)
                        <div class="welcome-step-bar flex-fill {{ $i === 0 ? 'active' : '' }}" id="stepBar{{ $i }}" onclick="goToWelcomeSlide({{ $i }})" title="{{ $activeSlides[$i]['badge'] ?? ('Step ' . ($i + 1)) }}"></div>
                    @endfor
                </div>
            </div>
            @endif

            <!-- Modal Body: Slides Carousel Track -->
            <div class="modal-body p-0 overflow-hidden">
                <div class="welcome-slides-wrapper" id="welcomeSlidesTrack" style="width: {{ $totalSlides * 100 }}%;">
                    @foreach($activeSlides as $index => $slide)
                        @php
                            $slideIcon = $slide['icon'] ?? 'fa-shield-halved';
                            $slideBadge = $slide['badge'] ?? ('Step ' . ($index + 1));
                            $slideTitle = $slide['title'] ?? '';
                            $slideMsg = $slide['message'] ?? '';
                            $slideImg = $slide['image'] ?? null;
                            $slideBtnText = $slide['button_text'] ?? null;
                            $slideBtnUrl = $slide['button_url'] ?? null;
                            $slideHighlight = $slide['highlight'] ?? null;

                            // Accent colors based on icon or intent
                            $isWallet = str_contains($slideIcon, 'wallet') || str_contains(strtolower($slideTitle), 'wallet');
                            $isEarn = str_contains($slideIcon, 'chart') || str_contains(strtolower($slideTitle), 'distribution') || str_contains(strtolower($slideTitle), 'earn');
                            
                            $emblemBg = $isWallet ? 'rgba(14, 165, 233, 0.1)' : ($isEarn ? 'rgba(16, 185, 129, 0.1)' : 'rgba(79, 70, 229, 0.1)');
                            $emblemBorder = $isWallet ? 'rgba(14, 165, 233, 0.25)' : ($isEarn ? 'rgba(16, 185, 129, 0.25)' : 'rgba(79, 70, 229, 0.25)');
                            $emblemColor = $isWallet ? '#0284c7' : ($isEarn ? '#10b981' : '#4f46e5');
                            $badgeClass = $isWallet ? 'bg-info bg-opacity-10 text-info' : ($isEarn ? 'bg-success bg-opacity-10 text-success' : 'bg-primary bg-opacity-10 text-primary');
                        @endphp

                        <div class="welcome-slide-panel px-3 px-md-5 py-3 py-md-4 text-center" style="width: {{ 100 / $totalSlides }}%;">
                            @php
                                $resolvedImg = $slide['image_url'] ?? (!empty($slideImg) ? \App\Models\Settings::getSlideImageUrl($slideImg) : null);
                            @endphp

                            @if(!empty($resolvedImg))
                                <div class="welcome-slide-image-wrapper mx-auto mb-2 mb-md-3">
                                    <img src="{{ $resolvedImg }}" alt="{{ $slideTitle }}" class="img-fluid rounded-3 shadow-sm welcome-slide-img" onerror="this.parentElement.style.display='none'; var fb = this.parentElement.nextElementSibling; if(fb && fb.classList.contains('welcome-icon-emblem')) fb.classList.remove('d-none');">
                                </div>
                                <div class="welcome-icon-emblem mx-auto mb-2 mb-md-3 d-none" style="background: {{ $emblemBg }}; border: 2px solid {{ $emblemBorder }}; color: {{ $emblemColor }};">
                                    <i class="fa-solid {{ $slideIcon }} f-24 f-md-28"></i>
                                </div>
                            @else
                                <div class="welcome-icon-emblem mx-auto mb-2 mb-md-3" style="background: {{ $emblemBg }}; border: 2px solid {{ $emblemBorder }}; color: {{ $emblemColor }};">
                                    <i class="fa-solid {{ $slideIcon }} f-24 f-md-28"></i>
                                </div>
                            @endif

                            @if(!empty($slideBadge))
                                <span class="badge {{ $badgeClass }} rounded-pill px-3 py-1 f-11 f-md-12 f-w-700 mb-2">
                                    {{ $slideBadge }}
                                </span>
                            @endif

                            <h4 class="welcome-slide-title f-w-800 mb-2 text-dark">
                                {{ $slideTitle }}
                            </h4>

                            <p class="welcome-slide-desc text-muted f-13 f-md-14 mx-auto mb-3" style="max-width: 540px; line-height: 1.6;">
                                {{ $slideMsg }}
                            </p>

                            @if($isWallet)
                                <!-- Supported Wallets Grid -->
                                <div class="d-flex flex-wrap justify-content-center align-items-center gap-1 gap-md-2 mb-3 mb-md-4">
                                    <span class="welcome-wallet-chip px-2 px-md-3 py-1 rounded-pill border f-10 f-md-11 f-w-600">
                                        <i class="fa-solid fa-shield text-warning me-1"></i> MetaMask
                                    </span>
                                    <span class="welcome-wallet-chip px-2 px-md-3 py-1 rounded-pill border f-10 f-md-11 f-w-600">
                                        <i class="fa-solid fa-shield text-primary me-1"></i> TrustWallet
                                    </span>
                                    <span class="welcome-wallet-chip px-2 px-md-3 py-1 rounded-pill border f-10 f-md-11 f-w-600">
                                        <i class="fa-solid fa-circle text-info me-1"></i> Coinbase
                                    </span>
                                    <span class="welcome-wallet-chip px-2 px-md-3 py-1 rounded-pill border f-10 f-md-11 f-w-600">
                                        <i class="fa-solid fa-microchip text-secondary me-1"></i> Ledger
                                    </span>
                                    <span class="welcome-wallet-chip px-2 px-md-3 py-1 rounded-pill border f-10 f-md-11 f-w-600">
                                        <i class="fa-solid fa-network-wired text-success me-1"></i> 10+ Wallets
                                    </span>
                                </div>
                            @elseif($isEarn)
                                <!-- Daily Yield Summary Card -->
                                <div class="welcome-yield-box p-2 p-md-3 rounded-3 border mx-auto mb-3 mb-md-4" style="max-width: 440px;">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <span class="f-11 f-md-12 text-muted fw-semibold">Target Earning Rate:</span>
                                        <span class="badge bg-success text-white px-2 py-1 rounded-pill f-10 f-md-11 f-w-700">Up to 20% Daily</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="f-11 f-md-12 text-muted fw-semibold">Settlement Frequency:</span>
                                        <span class="f-11 f-md-12 f-w-700 text-dark">Every 24 Hours • Automated</span>
                                    </div>
                                </div>
                            @endif

                            @if(!empty($slideBtnText) && !empty($slideBtnUrl))
                                <div class="mb-2">
                                    <a href="{{ $slideBtnUrl }}" class="btn {{ $isEarn ? 'btn-success' : 'btn-primary' }} btn-lg rounded-pill px-4 px-md-5 py-2 py-md-3 f-13 f-md-14 f-w-700 shadow-lg welcome-cta-pulse d-inline-flex align-items-center gap-2">
                                        <i class="fa-solid {{ $isWallet ? 'fa-link' : ($isEarn ? 'fa-rocket' : 'fa-arrow-right') }} me-1"></i> {{ $slideBtnText }}
                                        <i class="fa-solid fa-arrow-right f-11 f-md-12 ms-1"></i>
                                    </a>
                                </div>
                                @if($isWallet)
                                    <small class="text-muted f-10 f-md-11 d-block mt-1 mt-md-2">
                                        <i class="fa-solid fa-shield-halved text-success me-1"></i> Non-custodial 256-bit handshake • No deposit required
                                    </small>
                                @elseif($isEarn)
                                    <small class="text-muted f-10 f-md-11 d-block mt-1 mt-md-2">
                                        <i class="fa-solid fa-check text-success me-1"></i> Principal capital returned upon contract maturity
                                    </small>
                                @endif
                            @endif

                            @if(!empty($slideHighlight))
                                <div class="mt-2">
                                    <span class="badge bg-light text-muted border f-10 f-md-11 py-1 px-3 rounded-pill">
                                        <i class="fa-solid fa-check-double text-success me-1"></i> {{ $slideHighlight }}
                                    </span>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Modal Footer: Navigation Controls & Dismiss -->
            <div class="modal-footer border-top pt-2 pb-2 pt-md-3 pb-md-3 px-3 px-md-5 d-flex align-items-center justify-content-between flex-wrap gap-2">
                <div class="form-check mb-0">
                    <input class="form-check-input" type="checkbox" id="welcomeDismissCheck" checked>
                    <label class="form-check-label f-11 f-md-12 text-muted" for="welcomeDismissCheck">
                        Don't show this again
                    </label>
                </div>

                <div class="d-flex align-items-center gap-2">
                    <button type="button" class="btn btn-outline-secondary btn-sm rounded-pill px-3 py-1 py-md-2 f-11 f-md-12 f-w-600" data-bs-dismiss="modal" onclick="onWelcomeModalClose()">
                        <i class="fa-solid fa-xmark me-1"></i> Dismiss
                    </button>

                    @if($totalSlides > 1)
                        <button type="button" class="btn btn-outline-primary btn-sm rounded-pill px-3 py-1 py-md-2 f-11 f-md-12 f-w-600 d-none" id="welcomePrevBtn" onclick="prevWelcomeSlide()">
                            <i class="fa-solid fa-chevron-left me-1"></i> Back
                        </button>
                        <button type="button" class="btn btn-primary btn-sm rounded-pill px-3 px-md-4 py-1 py-md-2 f-11 f-md-12 f-w-700" id="welcomeNextBtn" onclick="nextWelcomeSlide()">
                            Next <i class="fa-solid fa-chevron-right ms-1"></i>
                        </button>
                        <button type="button" class="btn btn-primary btn-sm rounded-pill px-3 px-md-4 py-1 py-md-2 f-11 f-md-12 f-w-700 d-none" id="welcomeFinishBtn" data-bs-dismiss="modal" onclick="onWelcomeModalClose()">
                            <i class="fa-solid fa-check me-1"></i> Got It
                        </button>
                    @else
                        <button type="button" class="btn btn-primary btn-sm rounded-pill px-4 py-1 py-md-2 f-11 f-md-12 f-w-700" data-bs-dismiss="modal" onclick="onWelcomeModalClose()">
                            <i class="fa-solid fa-check me-1"></i> Got It
                        </button>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Scoped Styles for Welcome Onboarding Modal -->
<style>
    .welcome-onboarding-modal {
        backdrop-filter: blur(8px);
        background-color: rgba(11, 19, 43, 0.72) !important;
        z-index: 1080 !important;
    }
    .welcome-onboarding-modal.modal.show {
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        padding-left: 0 !important;
        padding-right: 0 !important;
    }
    .welcome-onboarding-modal.modal:not(.show) {
        display: none !important;
    }
    .welcome-modal-dialog {
        max-width: 660px;
        width: calc(100% - 32px);
        margin: auto !important;
        transition: transform 0.3s ease-out;
    }
    .welcome-modal-content {
        border-radius: 22px !important;
        background-color: #ffffff;
        box-shadow: 0 25px 60px -15px rgba(0, 0, 0, 0.35), 0 0 0 1px rgba(255, 255, 255, 0.1) !important;
    }
    body.dark-only .welcome-modal-content {
        background-color: #1a2234 !important;
        box-shadow: 0 25px 60px -15px rgba(0, 0, 0, 0.7), 0 0 0 1px rgba(255, 255, 255, 0.08) !important;
    }

    .welcome-close-btn {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        border: 1px solid rgba(0, 0, 0, 0.08);
        background: #f1f5f9;
        color: #64748b;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.2s ease;
        padding: 0;
        flex-shrink: 0;
    }
    .welcome-close-btn:hover {
        background: #e2e8f0;
        color: #0f172a;
        transform: scale(1.06);
    }
    body.dark-only .welcome-close-btn {
        background: #232c42;
        border-color: rgba(255, 255, 255, 0.12);
        color: #94a3b8;
    }
    body.dark-only .welcome-close-btn:hover {
        background: #2e3a57;
        color: #f8fafc;
    }

    /* Mobile Compression (< 768px) */
    @media (max-width: 767.98px) {
        .welcome-onboarding-modal {
            padding: 16px 10px !important;
            z-index: 1080 !important;
        }
        .welcome-onboarding-modal.modal.show {
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            min-height: 100dvh !important;
            min-height: 100vh !important;
        }
        .welcome-onboarding-modal .welcome-modal-dialog {
            margin: auto !important;
            max-width: 360px !important;
            width: calc(100% - 16px) !important;
            min-height: auto !important;
            transform: none !important;
        }
        .welcome-onboarding-modal .welcome-modal-dialog::before {
            display: none !important;
            content: none !important;
            height: 0 !important;
        }
        .welcome-onboarding-modal .welcome-modal-content {
            border-radius: 20px !important;
            max-height: calc(100dvh - 40px) !important;
            max-height: calc(100vh - 40px);
            display: flex !important;
            flex-direction: column !important;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.6), 0 0 0 1px rgba(255, 255, 255, 0.12) !important;
            overflow: hidden !important;
        }
        .welcome-onboarding-modal .modal-header {
            padding: 14px 16px 8px 16px !important;
            flex-shrink: 0 !important;
            display: flex !important;
            align-items: center !important;
            justify-content: space-between !important;
        }
        .welcome-onboarding-modal .welcome-step-badge {
            font-size: 10.5px !important;
            padding: 3px 8px !important;
        }
        .welcome-onboarding-modal .welcome-stepper-track {
            padding: 0 16px 4px 16px !important;
            flex-shrink: 0 !important;
        }
        .welcome-onboarding-modal .modal-body {
            max-height: calc(100dvh - 170px) !important;
            max-height: calc(100vh - 170px);
            overflow-y: auto !important;
            -webkit-overflow-scrolling: touch;
            flex: 1 1 auto !important;
        }
        .welcome-slide-panel {
            padding: 6px 16px 10px 16px !important;
        }
        .welcome-slide-image-wrapper {
            max-height: 65px !important;
            margin-bottom: 6px !important;
        }
        .welcome-slide-img {
            max-height: 60px !important;
            border-radius: 8px !important;
        }
        .welcome-icon-emblem {
            width: 38px !important;
            height: 38px !important;
            margin-bottom: 6px !important;
        }
        .welcome-icon-emblem i {
            font-size: 16px !important;
        }
        .welcome-slide-title {
            font-size: 14.5px !important;
            margin-bottom: 4px !important;
            line-height: 1.25 !important;
        }
        .welcome-slide-desc {
            font-size: 11px !important;
            line-height: 1.45 !important;
            margin-bottom: 6px !important;
            max-height: 75px;
            overflow-y: auto;
        }
        .welcome-wallet-chip {
            font-size: 9px !important;
            padding: 2px 6px !important;
        }
        .welcome-yield-box {
            padding: 5px 8px !important;
            margin-bottom: 6px !important;
        }
        .welcome-slide-panel .btn-lg {
            padding: 6px 18px !important;
            font-size: 12px !important;
        }
        .welcome-onboarding-modal .modal-footer {
            padding: 8px 16px !important;
            flex-shrink: 0 !important;
        }
        .welcome-onboarding-modal .form-check-label {
            font-size: 10.5px !important;
        }
        .welcome-close-btn {
            width: 28px !important;
            height: 28px !important;
            font-size: 12px !important;
        }
    }

    .welcome-step-badge {
        background-color: rgba(79, 70, 229, 0.1) !important;
        color: #4f46e5 !important;
        border: 1px solid rgba(79, 70, 229, 0.25) !important;
    }
    body.dark-only .welcome-step-badge {
        background-color: rgba(99, 102, 241, 0.18) !important;
        color: #a5b4fc !important;
        border-color: rgba(99, 102, 241, 0.35) !important;
    }

    .pulse-dot {
        display: inline-block;
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background-color: #4f46e5;
        box-shadow: 0 0 0 0 rgba(79, 70, 229, 0.7);
        animation: welcomePulse 1.8s infinite;
        vertical-align: middle;
    }
    @keyframes welcomePulse {
        0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(79, 70, 229, 0.7); }
        70% { transform: scale(1); box-shadow: 0 0 0 6px rgba(79, 70, 229, 0); }
        100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(79, 70, 229, 0); }
    }

    .welcome-step-bar {
        height: 5px;
        border-radius: 999px;
        background-color: #e2e8f0;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    body.dark-only .welcome-step-bar {
        background-color: #2b354d;
    }
    .welcome-step-bar.active {
        background: linear-gradient(90deg, #2563eb, #4f46e5);
        box-shadow: 0 0 8px rgba(79, 70, 229, 0.4);
    }
    .welcome-step-bar.completed {
        background-color: #10b981;
    }

    .welcome-slides-wrapper {
        display: flex;
        transition: transform 0.42s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .welcome-slide-panel {
        flex-shrink: 0;
        box-sizing: border-box;
    }

    .welcome-slide-image-wrapper {
        max-height: 170px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .welcome-slide-img {
        max-height: 160px;
        max-width: 100%;
        object-fit: contain;
        border-radius: 12px;
    }

    .welcome-icon-emblem {
        width: 68px;
        height: 68px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: transform 0.3s ease;
    }
    .welcome-icon-emblem:hover {
        transform: scale(1.06);
    }

    .welcome-feature-card, .welcome-yield-box {
        background-color: #f8fafc;
        border-color: #e2e8f0 !important;
        transition: all 0.2s ease;
    }
    body.dark-only .welcome-feature-card, body.dark-only .welcome-yield-box {
        background-color: #141b2b !important;
        border-color: #2b354d !important;
    }

    .welcome-wallet-chip {
        background-color: #ffffff;
        color: #334155;
        border-color: #e2e8f0 !important;
    }
    body.dark-only .welcome-wallet-chip {
        background-color: #141b2b;
        color: #cbd5e1;
        border-color: #2b354d !important;
    }

    .welcome-cta-pulse {
        background: linear-gradient(135deg, #2563eb 0%, #4f46e5 100%) !important;
        border: none !important;
        transition: all 0.25s ease;
    }
    .welcome-cta-pulse:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px -5px rgba(79, 70, 229, 0.5) !important;
    }

    body.dark-only .welcome-slide-title {
        color: #f8fafc !important;
    }
    body.dark-only .text-dark {
        color: #f1f5f9 !important;
    }
</style>

<!-- Welcome Modal Logic -->
<script>
    (function() {
        var currentSlide = 0;
        var totalSlides = {{ $totalSlides }};
        var userId = {{ Auth::check() ? Auth::user()->id : 0 }};
        var storageKey = 'ecx_welcome_onboarding_dismissed_' + userId;

        function updateSlideUI() {
            var track = document.getElementById('welcomeSlidesTrack');
            if (track && totalSlides > 0) {
                track.style.transform = 'translateX(-' + (currentSlide * (100 / totalSlides)) + '%)';
            }

            var stepNumElem = document.getElementById('welcomeCurrentStepNum');
            if (stepNumElem) stepNumElem.textContent = (currentSlide + 1);

            for (var i = 0; i < totalSlides; i++) {
                var bar = document.getElementById('stepBar' + i);
                if (bar) {
                    bar.classList.remove('active', 'completed');
                    if (i === currentSlide) {
                        bar.classList.add('active');
                    } else if (i < currentSlide) {
                        bar.classList.add('completed');
                    }
                }
            }

            var prevBtn = document.getElementById('welcomePrevBtn');
            var nextBtn = document.getElementById('welcomeNextBtn');
            var finishBtn = document.getElementById('welcomeFinishBtn');

            if (prevBtn) {
                if (currentSlide > 0) {
                    prevBtn.classList.remove('d-none');
                } else {
                    prevBtn.classList.add('d-none');
                }
            }

            if (nextBtn && finishBtn) {
                if (currentSlide === totalSlides - 1) {
                    nextBtn.classList.add('d-none');
                    finishBtn.classList.remove('d-none');
                } else {
                    nextBtn.classList.remove('d-none');
                    finishBtn.classList.add('d-none');
                }
            }
        }

        window.goToWelcomeSlide = function(index) {
            if (index >= 0 && index < totalSlides) {
                currentSlide = index;
                updateSlideUI();
            }
        };

        window.nextWelcomeSlide = function() {
            if (currentSlide < totalSlides - 1) {
                currentSlide++;
                updateSlideUI();
            }
        };

        window.prevWelcomeSlide = function() {
            if (currentSlide > 0) {
                currentSlide--;
                updateSlideUI();
            }
        };

        window.onWelcomeModalClose = function() {
            var check = document.getElementById('welcomeDismissCheck');
            if (check && check.checked && userId) {
                localStorage.setItem(storageKey, 'true');
            }
        };

        window.openWelcomeOnboardingTour = function(forceReset, initialSlide) {
            if (forceReset && userId) {
                try { localStorage.removeItem(storageKey); } catch(e) {}
            }
            if (typeof initialSlide === 'number' && initialSlide >= 0 && initialSlide < totalSlides) {
                currentSlide = initialSlide;
            } else {
                currentSlide = 0;
            }
            updateSlideUI();
            var modalEl = document.getElementById('welcomeOnboardingModal');
            if (modalEl) {
                var showModal = function() {
                    if (window.bootstrap && bootstrap.Modal) {
                        var modal = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
                        modal.show();
                    } else if (window.$ && $.fn.modal) {
                        $(modalEl).modal('show');
                    }
                };
                if ((window.bootstrap && bootstrap.Modal) || (window.$ && $.fn.modal)) {
                    showModal();
                } else {
                    var attempts = 0;
                    var interval = setInterval(function() {
                        attempts++;
                        if ((window.bootstrap && bootstrap.Modal) || (window.$ && $.fn.modal) || attempts > 20) {
                            clearInterval(interval);
                            showModal();
                        }
                    }, 25);
                }
            }
        };

        var isNewlyRegistered = {{ session('newly_registered') ? 'true' : 'false' }};
        if (isNewlyRegistered && userId) {
            try {
                localStorage.removeItem(storageKey);
            } catch(e) {}
        }

        function triggerModalImmediately() {
            if (!userId) return;
            var dismissed = localStorage.getItem(storageKey);
            if (isNewlyRegistered || !dismissed) {
                window.openWelcomeOnboardingTour(isNewlyRegistered ? true : false);
            }
        }

        if (document.readyState === 'complete' || document.readyState === 'interactive') {
            triggerModalImmediately();
        } else {
            document.addEventListener('DOMContentLoaded', triggerModalImmediately);
        }
    })();
</script>
@endif
