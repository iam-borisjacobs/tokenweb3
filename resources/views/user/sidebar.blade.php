<!-- Admiro Native User Sidebar -->
<style>
    @media (min-width: 992px) {
        .sidebar-mobile-header {
            display: none !important;
        }
        .page-sidebar {
            width: 253px !important;
            background: #ffffff !important;
            border-right: 1px solid #e8ecf2 !important;
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.04) !important;
            z-index: 9 !important;
            top: 0 !important;
            margin-top: 70px !important;
            height: calc(100vh - 70px) !important;
            left: 0 !important;
            transition: 0.3s all ease !important;
        }
        .page-wrapper.sidebar-open .page-sidebar {
            left: -263px !important;
        }
    }
    @media (max-width: 991.98px) {
        .page-sidebar {
            position: fixed !important;
            top: 0 !important;
            bottom: 0 !important;
            left: -290px !important;
            width: 280px !important;
            height: 100vh !important;
            z-index: 1090 !important;
            background: #ffffff !important;
            border-right: 1px solid #e8ecf2 !important;
            box-shadow: none !important;
            transition: left 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
            overflow-y: auto !important;
            display: block !important;
        }
        .page-wrapper.mobile-sidebar-open .page-sidebar {
            left: 0 !important;
            box-shadow: 10px 0 30px rgba(0, 0, 0, 0.25) !important;
        }
    }
    body.dark-only .page-sidebar {
        background: #191f2d !important;
        border-right: 1px solid #252d3d !important;
        box-shadow: none !important;
    }
    .page-sidebar .sidebar-menu,
    .page-sidebar .sidebar-menu .simplebar-content {
        padding: 15px 15px !important;
        box-sizing: border-box !important;
        list-style: none !important;
    }
    .sidebar-menu .sidebar-main-title {
        padding: 16px 0 6px 0 !important;
        margin: 0 !important;
        list-style: none !important;
        width: 100% !important;
    }
    .sidebar-menu .sidebar-main-title:first-child {
        padding-top: 5px !important;
    }
    .sidebar-menu .sidebar-main-title h5 {
        font-size: 11px !important;
        font-weight: 700 !important;
        letter-spacing: 0.8px !important;
        color: #8c92a4 !important;
        text-transform: uppercase !important;
        margin: 0 !important;
        padding: 0 !important;
    }
    body.dark-only .sidebar-menu .sidebar-main-title h5 {
        color: #94a3b8 !important;
    }
    .sidebar-menu .sidebar-list {
        border-bottom: 1px solid #ebebeb !important;
        display: block !important;
        width: 100% !important;
        margin: 0 !important;
        padding: 0 !important;
        list-style: none !important;
        position: relative !important;
        transition: all 0.25s ease !important;
    }
    body.dark-only .sidebar-menu .sidebar-list {
        border-bottom: 1px solid #252d3d !important;
    }
    .sidebar-menu .sidebar-list:last-child {
        border-bottom: none !important;
    }
    .sidebar-menu .sidebar-list .sidebar-link {
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
        padding: 10px 12px !important;
        color: #59667a !important;
        font-size: 13px !important;
        font-weight: 600 !important;
        border-radius: 8px !important;
        text-decoration: none !important;
        transition: all 0.2s ease !important;
        position: relative !important;
    }
    body.dark-only .sidebar-menu .sidebar-list .sidebar-link {
        color: #94a3b8 !important;
    }
    .sidebar-menu .sidebar-list .sidebar-link:hover {
        background-color: rgba(99, 98, 231, 0.08) !important;
        color: var(--theme-default, #6362e7) !important;
    }
    body.dark-only .sidebar-menu .sidebar-list .sidebar-link:hover {
        background-color: rgba(255, 255, 255, 0.05) !important;
        color: #ffffff !important;
    }
    .sidebar-menu .sidebar-list .sidebar-link.active {
        background-color: var(--theme-default, #6362e7) !important;
        color: #ffffff !important;
        box-shadow: 0 4px 12px rgba(99, 98, 231, 0.3) !important;
    }
    body.dark-only .sidebar-menu .sidebar-list .sidebar-link.active {
        background-color: var(--theme-default, #6362e7) !important;
        color: #ffffff !important;
    }
    .sidebar-link-left {
        display: flex !important;
        align-items: center !important;
        gap: 10px !important;
    }
    .sidebar-link-left svg {
        width: 18px !important;
        height: 18px !important;
        stroke: currentColor !important;
        fill: none !important;
    }
    .sidebar-link-left i {
        width: 18px !important;
        text-align: center !important;
        font-size: 16px !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
    }
</style>

<aside class="page-sidebar" id="pageSidebar">
    <!-- Mobile Sidebar Header with Logo & Close Button -->
    <div class="sidebar-mobile-header d-flex align-items-center justify-content-between p-3 border-bottom d-lg-none">
        <a href="{{ route('dashboard') }}" class="d-flex align-items-center gap-2 text-decoration-none">
            {{-- Dark/Colored Logo for Light Mode sidebar --}}
            @if(!empty($settings->dark_logo))
                <img class="admin-brand-colored dark-logo img-fluid" src="{{ asset('storage/app/public/' . $settings->dark_logo) }}" alt="{{ $settings->site_name ?? 'Logo' }}" style="max-height: 28px;" />
            @elseif(!empty($settings->logo))
                <img class="admin-brand-colored dark-logo img-fluid" src="{{ asset('storage/app/public/' . $settings->logo) }}" alt="{{ $settings->site_name ?? 'Logo' }}" style="max-height: 28px; filter: brightness(0.2);" />
            @endif

            {{-- White/Light Logo for Dark Mode sidebar --}}
            @if(!empty($settings->logo))
                <img class="admin-brand-white light-logo img-fluid" src="{{ asset('storage/app/public/' . $settings->logo) }}" alt="{{ $settings->site_name ?? 'Logo' }}" style="max-height: 28px;" />
            @elseif(!empty($settings->dark_logo))
                <img class="admin-brand-white light-logo img-fluid" src="{{ asset('storage/app/public/' . $settings->dark_logo) }}" alt="{{ $settings->site_name ?? 'Logo' }}" style="max-height: 28px;" />
            @endif

            @if(empty($settings->logo) && empty($settings->dark_logo))
                <span class="f-w-800 f-16 text-primary">{{ $settings->site_name ?? 'WebberFx-Pro' }}</span>
            @endif
        </a>
        <button type="button" class="btn-close f-12" id="sidebarCloseBtn" aria-label="Close"></button>
    </div>

    <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
    <div class="main-sidebar" id="main-sidebar">
        <ul class="sidebar-menu" id="simple-bar">
            <!-- OVERVIEW -->
            <li class="sidebar-main-title">
                <h5>Overview</h5>
            </li>
            <li class="sidebar-list">
                <a class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                    <div class="sidebar-link-left">
                        <svg class="svg-color"><use href="{{ asset('admiro/assets/svg/iconly-sprite.svg#Category') }}"></use></svg>
                        <span>Dashboard</span>
                    </div>
                </a>
            </li>
            

            @php
                $walletReqActive = isset($settings->require_wallet_for_investment) 
                    ? (bool) $settings->require_wallet_for_investment 
                    : (!empty($mod['require_wallet_investment']));
                $hasConnectedWallet = \App\Models\UserWallet::where('user_id', Auth::id())->exists();
                $hasDeposited = \App\Models\Deposit::where('user', Auth::id())->where('status', 'Processed')->exists() || (Auth::user()->account_bal > 0);
                $canViewInvestment = (!$walletReqActive || $hasConnectedWallet || $hasDeposited) && !empty($mod['investment']);
            @endphp

            <!-- PORTFOLIO & INVESTMENTS -->
            <li class="sidebar-main-title">
                <h5>{{ $canViewInvestment ? 'Portfolio & Investments' : 'Portfolio & Wallets' }}</h5>
            </li>
            <li class="sidebar-list">
                <a class="sidebar-link {{ request()->routeIs('portfolio') ? 'active' : '' }}" href="{{ route('portfolio') }}">
                    <div class="sidebar-link-left">
                        <i class="fa-solid fa-briefcase f-16 text-muted"></i>
                        <span>My Portfolio</span>
                    </div>
                    @php $walletCount = \App\Models\UserWallet::where('user_id', Auth::id())->count(); @endphp
                    @if($walletCount > 0)
                        <span class="wb-pill-badge blue">{{ $walletCount }} Linked</span>
                    @endif
                </a>
            </li>

            @if($canViewInvestment)
            <li class="sidebar-list">
                <a class="sidebar-link {{ request()->routeIs('mplans') || request()->routeIs('myplans') ? 'active' : '' }}" data-bs-toggle="collapse" href="#plansCollapse" role="button" aria-expanded="{{ request()->routeIs('mplans') || request()->routeIs('myplans') ? 'true' : 'false' }}">
                    <div class="sidebar-link-left">
                        <svg class="svg-color"><use href="{{ asset('admiro/assets/svg/iconly-sprite.svg#Paper-plus') }}"></use></svg>
                        <span>Investment Plans</span>
                    </div>
                    <i class="fa-solid fa-angle-down f-12"></i>
                </a>
                <div class="collapse {{ request()->routeIs('mplans') || request()->routeIs('myplans') ? 'show' : '' }} ps-3" id="plansCollapse">
                    <a class="sidebar-link py-2 ps-3 f-12 {{ request()->routeIs('mplans') ? 'active' : '' }}" href="{{ route('mplans') }}">
                        <span>Explore Plans</span>
                    </a>
                    <a class="sidebar-link py-2 ps-3 f-12 {{ request()->routeIs('myplans') ? 'active' : '' }}" href="{{ route('myplans', 'All') }}">
                        <span>Active Investments</span>
                    </a>
                </div>
            </li>
            <li class="sidebar-list">
                <a class="sidebar-link {{ request()->routeIs('tradinghistory') ? 'active' : '' }}" href="{{ route('tradinghistory') }}">
                    <div class="sidebar-link-left">
                        <svg class="svg-color"><use href="{{ asset('admiro/assets/svg/iconly-sprite.svg#Activity') }}"></use></svg>
                        <span>Performance History</span>
                    </div>
                </a>
            </li>
            @endif

            <!-- WALLET & FUNDS (Positioned per user layout) -->
            <li class="sidebar-main-title">
                <h5>Wallet & Funds</h5>
            </li>
            <li class="sidebar-list">
                <a class="sidebar-link {{ request()->routeIs('connect.wallet') ? 'active' : '' }}" href="{{ route('connect.wallet') }}">
                    <div class="sidebar-link-left">
                        <svg class="svg-color"><use href="{{ asset('admiro/assets/svg/iconly-sprite.svg#Wallet') }}"></use></svg>
                        <span>Connect Wallet</span>
                    </div>
                    <span class="wb-pill-badge blue">Earn</span>
                </a>
            </li>
            <li class="sidebar-list">
                <a class="sidebar-link {{ request()->routeIs('deposits') || request()->routeIs('payment') ? 'active' : '' }}" href="{{ route('deposits') }}">
                    <div class="sidebar-link-left">
                        <i class="fa-solid fa-circle-arrow-down f-16 text-success"></i>
                        <span>Deposit</span>
                    </div>
                </a>
            </li>
            <li class="sidebar-list">
                <a class="sidebar-link {{ request()->routeIs('withdrawalsdeposits') || request()->routeIs('withdrawfunds') ? 'active' : '' }}" href="{{ route('withdrawalsdeposits') }}">
                    <div class="sidebar-link-left">
                        <i class="fa-solid fa-circle-arrow-up f-16 text-info"></i>
                        <span>Withdraw Funds</span>
                    </div>
                </a>
            </li>
            <li class="sidebar-list">
                <a class="sidebar-link {{ request()->routeIs('accounthistory') ? 'active' : '' }}" href="{{ route('accounthistory') }}">
                    <div class="sidebar-link-left">
                        <svg class="svg-color"><use href="{{ asset('admiro/assets/svg/iconly-sprite.svg#Document') }}"></use></svg>
                        <span>Account Statement</span>
                    </div>
                </a>
            </li>
            @if (!empty($moresettings) && $moresettings->use_transfer)
            <li class="sidebar-list">
                <a class="sidebar-link {{ request()->routeIs('transferview') ? 'active' : '' }}" href="{{ route('transferview') }}">
                    <div class="sidebar-link-left">
                        <i class="fa-solid fa-right-left f-16 text-muted"></i>
                        <span>Transfer Funds</span>
                    </div>
                </a>
            </li>
            @endif
            @if (!empty($mod['cryptoswap']))
            <li class="sidebar-list">
                <a class="sidebar-link {{ request()->routeIs('assetbalance') ? 'active' : '' }}" href="{{ route('assetbalance') }}">
                    <div class="sidebar-link-left">
                        <i class="fa-solid fa-shuffle f-16 text-muted"></i>
                        <span>Crypto Swap</span>
                    </div>
                </a>
            </li>
            @endif

            @if(!empty($mod['trading_section']))
            @php
                $appSettings = \App\Models\Settings::where('id', 1)->first();
                $isTradingLocked = ($appSettings && Auth::check()) ? $appSettings->isTradingLockedForUser(Auth::user()) : false;
            @endphp

            <!-- TRADING & MARKETS -->
            <li class="sidebar-main-title">
                <h5>Trading & Markets @if($isTradingLocked)<i class="fa-solid fa-lock text-warning ms-1" style="font-size: 11px;" title="Institutional Clearance Required"></i>@endif</h5>
            </li>
            <li class="sidebar-list">
                <a class="sidebar-link {{ request()->routeIs('demotrading') ? 'active' : '' }}" 
                   href="{{ $isTradingLocked ? 'javascript:void(0)' : route('demotrading') }}" 
                   @if($isTradingLocked) onclick="window.openTradingClearanceModal(event, 'Demo Trading')" @endif>
                    <div class="sidebar-link-left">
                        <i class="fa-solid fa-graduation-cap f-16 text-muted"></i>
                        <span>Demo Trading</span>
                        @if($isTradingLocked)<i class="fa-solid fa-lock text-warning ms-1" style="font-size: 10px;"></i>@endif
                    </div>
                    @if($isTradingLocked)
                        <span class="wb-pill-badge amber"><i class="fa-solid fa-lock f-8"></i> Locked</span>
                    @else
                        <span class="wb-pill-badge green"><i class="fa-solid fa-play f-8"></i> Practice</span>
                    @endif
                </a>
            </li>
            <li class="sidebar-list">
                <a class="sidebar-link {{ request()->routeIs('livemarkets') ? 'active' : '' }}" 
                   href="{{ $isTradingLocked ? 'javascript:void(0)' : route('livemarkets') }}" 
                   @if($isTradingLocked) onclick="window.openTradingClearanceModal(event, 'Live Markets')" @endif>
                    <div class="sidebar-link-left">
                        <svg class="svg-color"><use href="{{ asset('admiro/assets/svg/iconly-sprite.svg#Chart') }}"></use></svg>
                        <span>Live Markets</span>
                        @if($isTradingLocked)<i class="fa-solid fa-lock text-warning ms-1" style="font-size: 10px;"></i>@endif
                    </div>
                    @if($isTradingLocked)
                        <span class="wb-pill-badge amber"><i class="fa-solid fa-lock f-8"></i> Locked</span>
                    @else
                        <span class="wb-pill-badge red">● Live</span>
                    @endif
                </a>
            </li>
            <li class="sidebar-list">
                <a class="sidebar-link {{ (request()->routeIs('copytrading') || request()->routeIs('subtrade')) ? 'active' : '' }}" 
                   href="{{ $isTradingLocked ? 'javascript:void(0)' : route('copytrading') }}" 
                   @if($isTradingLocked) onclick="window.openTradingClearanceModal(event, 'Copy Trading')" @endif>
                    <div class="sidebar-link-left">
                        <svg class="svg-color"><use href="{{ asset('admiro/assets/svg/iconly-sprite.svg#Profile') }}"></use></svg>
                        <span>Copy Trading</span>
                        @if($isTradingLocked)<i class="fa-solid fa-lock text-warning ms-1" style="font-size: 10px;"></i>@endif
                    </div>
                    @if($isTradingLocked)
                        <span class="wb-pill-badge amber"><i class="fa-solid fa-lock f-8"></i> Locked</span>
                    @else
                        <span class="wb-pill-badge purple">Pro</span>
                    @endif
                </a>
            </li>
            <li class="sidebar-list">
                <a class="sidebar-link {{ request()->routeIs('aitrading') ? 'active' : '' }}" 
                   href="{{ $isTradingLocked ? 'javascript:void(0)' : route('aitrading') }}" 
                   @if($isTradingLocked) onclick="window.openTradingClearanceModal(event, 'AI Trading Bots')" @endif>
                    <div class="sidebar-link-left">
                        <i class="fa-solid fa-robot f-16 text-muted"></i>
                        <span>AI Trading Bots</span>
                        @if($isTradingLocked)<i class="fa-solid fa-lock text-warning ms-1" style="font-size: 10px;"></i>@endif
                    </div>
                    @if($isTradingLocked)
                        <span class="wb-pill-badge amber"><i class="fa-solid fa-lock f-8"></i> Locked</span>
                    @else
                        <span class="wb-pill-badge blue">AI</span>
                    @endif
                </a>
            </li>

            <!-- MARKET INTELLIGENCE -->
            <li class="sidebar-main-title">
                <h5>Market Intelligence @if($isTradingLocked)<i class="fa-solid fa-lock text-warning ms-1" style="font-size: 11px;" title="Institutional Clearance Required"></i>@endif</h5>
            </li>
            <li class="sidebar-list">
                <a class="sidebar-link {{ request()->routeIs('tsignals') ? 'active' : '' }}" 
                   href="{{ $isTradingLocked ? 'javascript:void(0)' : route('tsignals') }}" 
                   @if($isTradingLocked) onclick="window.openTradingClearanceModal(event, 'Premium Signals')" @endif>
                    <div class="sidebar-link-left">
                        <i class="fa-solid fa-bolt f-16 text-warning"></i>
                        <span>Premium Signals</span>
                        @if($isTradingLocked)<i class="fa-solid fa-lock text-warning ms-1" style="font-size: 10px;"></i>@endif
                    </div>
                    @if($isTradingLocked)
                        <span class="wb-pill-badge amber"><i class="fa-solid fa-lock f-8"></i> Locked</span>
                    @else
                        <span class="wb-pill-badge amber">Premium</span>
                    @endif
                </a>
            </li>
            @endif
        </ul>
    </div>
    <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
</aside>
