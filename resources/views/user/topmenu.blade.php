<!-- Admiro User Top Navigation Bar -->
<header class="page-header row align-items-center">
    <div class="logo-wrapper d-flex align-items-center col-auto">
        <a class="close-btn toggle-sidebar me-2" href="javascript:void(0)" id="sidebar-toggle-btn" title="Toggle Sidebar">
            <svg class="svg-color" style="width: 20px; height: 20px;">
                <use href="{{ asset('admiro/assets/svg/iconly-sprite.svg#Category') }}"></use>
            </svg>
        </a>
        <a href="{{ route('dashboard') }}" class="d-flex align-items-center gap-2 text-decoration-none header-logo-link">
            {{-- 1. Dark/Colored Logo (for Light Mode against white navbar) --}}
            @if(!empty($settings->dark_logo))
                <img class="admin-brand-colored dark-logo img-fluid" src="{{ asset('storage/app/public/' . $settings->dark_logo) }}" alt="{{ $settings->site_name ?? 'Logo' }}" />
            @elseif(!empty($settings->logo))
                <img class="admin-brand-colored dark-logo img-fluid" src="{{ asset('storage/app/public/' . $settings->logo) }}" alt="{{ $settings->site_name ?? 'Logo' }}" style="filter: brightness(0.2);" />
            @endif

            {{-- 2. White/Light Logo (for Dark Mode against dark navbar) --}}
            @if(!empty($settings->logo))
                <img class="admin-brand-white light-logo img-fluid" src="{{ asset('storage/app/public/' . $settings->logo) }}" alt="{{ $settings->site_name ?? 'Logo' }}" />
            @elseif(!empty($settings->dark_logo))
                <img class="admin-brand-white light-logo img-fluid" src="{{ asset('storage/app/public/' . $settings->dark_logo) }}" alt="{{ $settings->site_name ?? 'Logo' }}" />
            @endif

            @if(empty($settings->logo) && empty($settings->dark_logo))
                <span class="f-w-800 f-16 text-primary">{{ $settings->site_name ?? 'WebberFx-Pro' }}</span>
            @endif
        </a>
    </div>

    <div class="page-main-header col d-flex align-items-center justify-content-between">
        <div class="header-left d-flex align-items-center gap-3">
            <!-- Live Crypto Market Ticker Pill -->
            <div class="wb-live-ticker-pill d-none d-md-inline-flex" id="wb-live-ticker">
                <span class="wb-live-dot"></span>
                <span class="text-success f-w-700">LIVE</span>
                <span class="text-muted">|</span>
                <span class="text-muted">BTC: <strong class="text-success" id="wb-ticker-btc">$66,850</strong></span>
                <span class="text-muted">ETH: <strong class="text-success" id="wb-ticker-eth">$3,320</strong></span>
            </div>

            <!-- Center Account Balance Capsule -->
            <div class="wb-balance-header-pill d-none d-lg-block">
                <div class="wb-balance-header-title">Account Balance</div>
                <div class="wb-balance-header-val">
                    {{ $settings->currency }}{{ number_format(Auth::user()->account_bal, 2, '.', ',') }}
                </div>
            </div>
        </div>

        <div class="nav-right ms-auto">
            <ul class="header-right d-flex align-items-center mb-0 list-unstyled" style="gap: 10px;">
                <!-- Quick Trade Dropdown -->
                <li class="custom-dropdown position-relative d-none d-sm-block">
                    <button class="btn btn-outline-primary btn-sm rounded-pill d-inline-flex align-items-center px-3" type="button" id="quickTradeBtn" data-bs-toggle="dropdown" aria-expanded="false" style="height: 36px; font-size: 13px; font-weight: 600;">
                        <i class="fa fa-bolt me-1 text-warning"></i> Quick Trade <i class="fa fa-chevron-down ms-1 f-10"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end shadow-lg rounded-3 p-2 mt-2" aria-labelledby="quickTradeBtn" id="quickTradeMenu" style="min-width: 200px;">
                        <a class="dropdown-item py-2 rounded" href="{{ route('dashboard') }}#wb-market-section">
                            <i class="fa fa-chart-line text-primary me-2"></i> Instant Trade
                        </a>
                        <a class="dropdown-item py-2 rounded" href="{{ route('deposits') }}">
                            <i class="fa fa-wallet text-success me-2"></i> Fund Account
                        </a>
                        <a class="dropdown-item py-2 rounded" href="{{ route('mplans') }}">
                            <i class="fa fa-layer-group text-info me-2"></i> Investment Plans
                        </a>
                    </div>
                </li>

                <!-- Notification Bell -->
                @php
                    $authUserId = Auth::id();
                    $topNotifs = \App\Models\Notification::where(function($q) use ($authUserId) {
                        $q->where('user_id', $authUserId)->orWhereNull('user_id');
                    })->orderBy('created_at', 'desc')->take(6)->get();

                    $topUnreadCount = \App\Models\Notification::where(function($q) use ($authUserId) {
                        $q->where('user_id', $authUserId)->orWhereNull('user_id');
                    })->where('is_read', false)->count();
                @endphp
                <li class="custom-dropdown position-relative">
                    <a href="javascript:void(0)" class="text-muted d-flex align-items-center justify-content-center rounded-circle border hover-bg position-relative" id="notifBtn" data-bs-toggle="dropdown" aria-expanded="false" title="Notifications" style="width: 38px; height: 38px; text-decoration: none;">
                        <svg class="svg-color" style="width: 18px; height: 18px;">
                            <use href="{{ asset('admiro/assets/svg/iconly-sprite.svg#notification') }}"></use>
                        </svg>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger {{ $topUnreadCount > 0 ? '' : 'd-none' }}" id="notifBadgeCount" style="font-size: 9px; padding: 2px 5px;">
                            {{ $topUnreadCount > 99 ? '99+' : $topUnreadCount }}
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end shadow-lg rounded-3 p-3 mt-2" aria-labelledby="notifBtn" id="notifMenu" style="width: 320px; max-width: 92vw;">
                        <div class="d-flex align-items-center justify-content-between mb-2 pb-1 border-bottom">
                            <h6 class="m-0 f-w-700 f-13 text-dark">
                                <i class="fa-solid fa-bell text-primary me-1"></i> Notifications
                            </h6>
                            <span class="badge bg-primary rounded-pill f-10 {{ $topUnreadCount > 0 ? '' : 'd-none' }}" id="notifNewBadge">
                                {{ $topUnreadCount }} New
                            </span>
                        </div>

                        <div class="notif-items-list" style="max-height: 280px; overflow-y: auto;">
                            @forelse($topNotifs as $notif)
                                <div class="py-2 border-bottom notif-item-row {{ !$notif->is_read ? 'unread-item' : '' }}" style="{{ !$notif->is_read ? 'background-color: rgba(99, 98, 231, 0.05); border-radius: 6px; padding: 6px 8px !important; margin-bottom: 4px;' : '' }}">
                                    <div class="d-flex align-items-start gap-2">
                                        <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0 mt-1" style="width: 26px; height: 26px; font-size: 11px; {{ $notif->type === 'success' ? 'background: rgba(16, 185, 129, 0.15); color: #10b981;' : ($notif->type === 'warning' ? 'background: rgba(245, 158, 11, 0.15); color: #d97706;' : ($notif->type === 'danger' ? 'background: rgba(239, 68, 68, 0.15); color: #ef4444;' : 'background: rgba(99, 98, 231, 0.15); color: #6362e7;')) }}">
                                            <i class="fa-solid {{ $notif->getTypeIcon() }}"></i>
                                        </div>
                                        <div class="flex-grow-1" style="min-width: 0;">
                                            <div class="d-flex align-items-center justify-content-between gap-1">
                                                <span class="f-w-700 f-12 text-dark text-truncate d-block">{{ $notif->title ?? 'Notification' }}</span>
                                                <small class="text-muted f-10 text-nowrap">{{ $notif->created_at->diffForHumans(null, true) }}</small>
                                            </div>
                                            <p class="f-11 text-muted mb-0 text-truncate" style="line-height: 1.4;">
                                                {{ $notif->message }}
                                            </p>
                                            @if(!empty($notif->action_url))
                                                <a href="{{ $notif->action_url }}" class="f-10 text-primary f-w-600 text-decoration-none mt-1 d-inline-block">
                                                    Action Link <i class="fa-solid fa-arrow-right f-9"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="py-4 text-center text-muted">
                                    <i class="fa-regular fa-bell-slash f-20 mb-2 text-muted opacity-50 d-block"></i>
                                    <span class="f-12">No notifications right now</span>
                                </div>
                            @endforelse
                        </div>

                        <div class="d-flex align-items-center justify-content-between pt-2 mt-1 border-top">
                            <button type="button" class="btn btn-link p-0 text-muted f-11 text-decoration-none {{ $topUnreadCount > 0 ? '' : 'd-none' }}" id="topMenuMarkReadBtn" onclick="topMenuMarkAllRead(event)">
                                <i class="fa-solid fa-check-double me-1"></i> Mark all read
                            </button>
                            <a href="{{ route('notification') }}" class="f-11 text-primary f-w-700 text-decoration-none ms-auto">
                                View All <i class="fa-solid fa-chevron-right f-10 ms-1"></i>
                            </a>
                        </div>
                    </div>
                </li>

                <script>
                    function topMenuMarkAllRead(e) {
                        if (e) e.preventDefault();
                        fetch('{{ route("notification.markallread") }}', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json',
                                'Content-Type': 'application/json'
                            }
                        }).then(function(res) {
                            return res.json();
                        }).then(function(data) {
                            var badge = document.getElementById('notifBadgeCount');
                            var newBadge = document.getElementById('notifNewBadge');
                            var markBtn = document.getElementById('topMenuMarkReadBtn');
                            if (badge) badge.classList.add('d-none');
                            if (newBadge) newBadge.classList.add('d-none');
                            if (markBtn) markBtn.classList.add('d-none');

                            var unreadRows = document.querySelectorAll('.notif-item-row.unread-item');
                            unreadRows.forEach(function(row) {
                                row.classList.remove('unread-item');
                                row.style.backgroundColor = '';
                                row.style.padding = '';
                                row.style.margin = '';
                            });
                        }).catch(function(err) {
                            console.error(err);
                        });
                    }
                </script>

                <!-- Dark / Light Mode Toggle -->
                <li>
                    <a class="dark-mode d-flex align-items-center justify-content-center rounded-circle border hover-bg text-dark" href="javascript:void(0)" title="Toggle Dark / Light Mode" id="themeToggleBtn" style="width: 38px; height: 38px; text-decoration: none;">
                        <svg style="width: 18px; height: 18px;">
                            <use href="{{ asset('admiro/assets/svg/iconly-sprite.svg#moondark') }}"></use>
                        </svg>
                    </a>
                </li>

                <!-- User Profile Capsule Dropdown -->
                <li class="profile-nav custom-dropdown position-relative">
                    <div class="user-wrap d-flex align-items-center gap-2 cursor-pointer p-1 rounded-pill border ps-1 pe-3 hover-bg" id="profileDropdownBtn" data-bs-toggle="dropdown" aria-expanded="false" style="height: 42px;">
                        <div class="user-img">
                            @if(!empty(Auth::user()->profile_photo_path))
                                <img class="rounded-circle" src="{{ asset('storage/app/public/' . Auth::user()->profile_photo_path) }}" alt="{{ Auth::user()->name }}" style="width: 32px; height: 32px; object-fit: cover;" />
                            @else
                                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center f-w-700 f-13" style="width: 32px; height: 32px;">
                                    {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
                                </div>
                            @endif
                        </div>
                        <div class="user-content d-none d-sm-block text-start">
                            <h6 class="f-12 f-w-700 mb-0 text-dark">{{ Str::limit(Auth::user()->name, 14) }}</h6>
                            <small class="text-muted f-10">Trading Account</small>
                        </div>
                        <i class="fa fa-angle-down f-12 text-muted ms-1"></i>
                    </div>

                    <div class="dropdown-menu dropdown-menu-end shadow-lg rounded-3 p-2 mt-2" aria-labelledby="profileDropdownBtn" id="profileMenu" style="min-width: 220px;">
                        <div class="px-3 py-2 border-bottom mb-2">
                            <h6 class="f-w-700 mb-0 f-13 text-dark">{{ Auth::user()->name }}</h6>
                            <small class="text-muted f-11">{{ Auth::user()->email }}</small>
                        </div>
                        <a class="dropdown-item py-2 rounded" href="{{ route('profile') }}">
                            <i class="fa fa-user text-primary me-2 f-12"></i> My Profile
                        </a>
                        <a class="dropdown-item py-2 rounded" href="{{ route('account.verify') }}">
                            <i class="fa fa-shield-alt text-success me-2 f-12"></i> Identity Verification
                        </a>
                        <a class="dropdown-item py-2 rounded" href="{{ route('twofa') }}">
                            <i class="fa fa-key text-warning me-2 f-12"></i> Account Security
                        </a>
                        <div class="dropdown-divider my-2"></div>
                        <a class="dropdown-item py-2 rounded text-danger" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out-alt me-2 f-12"></i> Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</header>

<!-- Live Real-Time Crypto Price Streamer -->
<script>
    (function() {
        var btcEl = document.getElementById('wb-ticker-btc');
        var ethEl = document.getElementById('wb-ticker-eth');
        if (!btcEl || !ethEl) return;

        var lastBtc = null;
        var lastEth = null;

        function formatUSD(val) {
            if (!val || isNaN(val)) return null;
            return '$' + Math.round(parseFloat(val)).toLocaleString('en-US');
        }

        function updateTick(el, newPrice, lastPrice, isPositiveTrend) {
            if (!el || !newPrice) return;
            el.textContent = formatUSD(newPrice);
            var isUp = (isPositiveTrend !== null && isPositiveTrend !== undefined)
                ? isPositiveTrend
                : (lastPrice ? (newPrice >= lastPrice) : true);

            el.classList.remove('text-success', 'text-danger');
            el.classList.add(isUp ? 'text-success' : 'text-danger');
        }

        // 1. High-frequency WebSocket stream from Binance for second-by-second live ticks
        var wsConnected = false;
        try {
            var ws = new WebSocket('wss://stream.binance.com:9443/ws/btcusdt@miniTicker/ethusdt@miniTicker');
            ws.onopen = function() { wsConnected = true; };
            ws.onmessage = function(event) {
                try {
                    var data = JSON.parse(event.data);
                    if (data && data.s === 'BTCUSDT') {
                        var p = parseFloat(data.c);
                        var isUp = data.o ? (p >= parseFloat(data.o)) : true;
                        updateTick(btcEl, p, lastBtc, isUp);
                        lastBtc = p;
                    } else if (data && data.s === 'ETHUSDT') {
                        var pEth = parseFloat(data.c);
                        var isUpEth = data.o ? (pEth >= parseFloat(data.o)) : true;
                        updateTick(ethEl, pEth, lastEth, isUpEth);
                        lastEth = pEth;
                    }
                } catch(e) {}
            };
            ws.onerror = function() { wsConnected = false; };
            ws.onclose = function() { wsConnected = false; };
        } catch(e) {
            wsConnected = false;
        }

        // 2. Multi-source REST Polling Fallback (Binance -> CoinGecko -> CryptoCompare)
        async function fetchREST() {
            // Source A: Binance REST API
            try {
                var res = await fetch('https://api.binance.com/api/v3/ticker/24hr?symbols=%5B%22BTCUSDT%22,%22ETHUSDT%22%5D', { cache: 'no-store' });
                if (res.ok) {
                    var items = await res.json();
                    var btc = items.find(function(i) { return i.symbol === 'BTCUSDT'; });
                    var eth = items.find(function(i) { return i.symbol === 'ETHUSDT'; });
                    if (btc && eth) {
                        var bp = parseFloat(btc.lastPrice);
                        var ep = parseFloat(eth.lastPrice);
                        updateTick(btcEl, bp, lastBtc, parseFloat(btc.priceChangePercent) >= 0);
                        updateTick(ethEl, ep, lastEth, parseFloat(eth.priceChangePercent) >= 0);
                        lastBtc = bp;
                        lastEth = ep;
                        return;
                    }
                }
            } catch(e) {}

            // Source B: CoinGecko API
            try {
                var cgRes = await fetch('https://api.coingecko.com/api/v3/simple/price?ids=bitcoin,ethereum&vs_currencies=usd&include_24hr_change=true', { cache: 'no-store' });
                if (cgRes.ok) {
                    var cg = await cgRes.json();
                    if (cg.bitcoin && cg.ethereum) {
                        var bp2 = cg.bitcoin.usd;
                        var ep2 = cg.ethereum.usd;
                        updateTick(btcEl, bp2, lastBtc, cg.bitcoin.usd_24h_change >= 0);
                        updateTick(ethEl, ep2, lastEth, cg.ethereum.usd_24h_change >= 0);
                        lastBtc = bp2;
                        lastEth = ep2;
                        return;
                    }
                }
            } catch(e) {}

            // Source C: CryptoCompare API
            try {
                var ccRes = await fetch('https://min-api.cryptocompare.com/data/pricemultifull?fsyms=BTC,ETH&tsyms=USD', { cache: 'no-store' });
                if (ccRes.ok) {
                    var cc = await ccRes.json();
                    if (cc.RAW && cc.RAW.BTC && cc.RAW.ETH) {
                        var bp3 = cc.RAW.BTC.USD.PRICE;
                        var ep3 = cc.RAW.ETH.USD.PRICE;
                        updateTick(btcEl, bp3, lastBtc, cc.RAW.BTC.USD.CHANGEPCT24HOUR >= 0);
                        updateTick(ethEl, ep3, lastEth, cc.RAW.ETH.USD.CHANGEPCT24HOUR >= 0);
                        lastBtc = bp3;
                        lastEth = ep3;
                        return;
                    }
                }
            } catch(e) {}
        }

        // Fetch immediately upon load
        fetchREST();

        // Continuous refresh every 10 seconds if WebSocket is offline
        setInterval(function() {
            if (!wsConnected) {
                fetchREST();
            }
        }, 10000);
    })();
</script>
