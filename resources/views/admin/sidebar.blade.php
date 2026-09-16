@if(!empty($from_layout))
@php 
    $pending_deposits_count = \Illuminate\Support\Facades\DB::table('deposits')->where('status', 'Pending')->count();
    $pending_withdrawals_count = \Illuminate\Support\Facades\DB::table('withdrawals')->where('status', 'Pending')->count();
    $pending_kyc_count = \App\Models\Kyc::where('status', 'Pending')->count();
    $adminUser = Auth('admin')->User();
@endphp

<style>
    /* 100% Admiro Native Centered Sidebar Design */
    .page-sidebar {
        width: 253px !important;
        background: #ffffff !important;
        border-right: 1px solid #e8ecf2 !important;
        box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.04) !important;
        z-index: 9 !important;
        transition: 0.5s all !important;
    }
    body.dark-only .page-sidebar {
        background: #191f2d !important;
        border-right: 1px solid #252d3d !important;
        box-shadow: none !important;
    }

    /* Centering Container: Symmetrical 30px Left & Right Gutters (this where the sidebar content are  ) */
    .page-sidebar .sidebar-menu,
    .page-sidebar .sidebar-menu .simplebar-content {
        padding: 15px 15px !important;
        box-sizing: border-box !important;
        list-style: none !important;
    }

    /* Category Main Titles */
    .sidebar-menu .sidebar-main-title {
        padding: 16px 0 6px 0 !important;
        margin: 0 !important;
        list-style: none !important;
        width: 100% !important;
    }
    .sidebar-menu .sidebar-main-title:first-child {
        padding-top: 5px !important;
    }
    .sidebar-menu .sidebar-main-title h5,
    .sidebar-menu .sidebar-main-title .sidebar-title {
        font-size: 11px !important;
        font-weight: 700 !important;
        letter-spacing: 0.8px !important;
        color: #8c92a4 !important;
        text-transform: uppercase !important;
        margin: 0 !important;
        padding: 0 !important;
    }
    body.dark-only .sidebar-menu .sidebar-main-title h5,
    body.dark-only .sidebar-menu .sidebar-main-title .sidebar-title {
        color: #94a3b8 !important;
    }

    /* Each Row with native horizontal divider line */
    .sidebar-menu .sidebar-list {
        border-bottom: 1px solid #ebebeb !important;
        display: block !important;
        width: 100% !important;
        margin: 0 !important;
        padding: 0 !important;
        list-style: none !important;
        position: relative !important;
        transition: all 0.25s ease !important;
        box-sizing: border-box !important;
    }
    body.dark-only .sidebar-menu .sidebar-list {
        border-bottom: 1px solid #252d3d !important;
    }
    .sidebar-menu .sidebar-list:last-child {
        border-bottom: none !important;
    }

    /* Link filling full row width between 25px gutters */
    .sidebar-menu .sidebar-list .sidebar-link {
        display: flex !important;
        align-items: center !important;
        width: 100% !important;
        padding: 11px 12px !important;
        border-radius: 6px !important;
        text-decoration: none !important;
        color: #2b2b2b !important;
        font-size: 14px !important;
        font-weight: 600 !important;
        transition: all 0.2s ease !important;
        gap: 12px !important;
        box-sizing: border-box !important;
        position: relative !important;
    }
    body.dark-only .sidebar-menu .sidebar-list .sidebar-link {
        color: #e2e8f0 !important;
    }

    /* Item text */
    .sidebar-menu .sidebar-list .sidebar-link h6 {
        font-size: 14px !important;
        font-weight: 600 !important;
        margin: 0 !important;
        color: inherit !important;
        letter-spacing: normal !important;
        text-transform: none !important;
        white-space: nowrap !important;
    }

    /* Icons */
    .sidebar-menu .sidebar-link .stroke-icon,
    .sidebar-menu .sidebar-link svg {
        width: 18px !important;
        height: 18px !important;
        stroke: #64748b !important;
        fill: none !important;
        flex-shrink: 0 !important;
        transition: 0.2s all !important;
    }
    .sidebar-menu .sidebar-link i:not(.iconly-Arrow-Right-2):not(.fa-thumbtack) {
        width: 18px !important;
        text-align: center !important;
        font-size: 15px !important;
        color: #64748b !important;
        flex-shrink: 0 !important;
    }
    body.dark-only .sidebar-menu .sidebar-link .stroke-icon,
    body.dark-only .sidebar-menu .sidebar-link svg {
        stroke: #94a3b8 !important;
    }
    body.dark-only .sidebar-menu .sidebar-link i:not(.iconly-Arrow-Right-2):not(.fa-thumbtack) {
        color: #94a3b8 !important;
    }

    /* Hover & Active States - Full width row pill */
    .sidebar-menu .sidebar-list:hover > .sidebar-link,
    .sidebar-menu .sidebar-list.active > .sidebar-link,
    .sidebar-menu .sidebar-link.active {
        background-color: rgba(99, 98, 231, 0.12) !important;
        color: var(--theme-default, #6362e7) !important;
        border-radius: 6px !important;
    }
    body.dark-only .sidebar-menu .sidebar-list:hover > .sidebar-link,
    body.dark-only .sidebar-menu .sidebar-list.active > .sidebar-link,
    body.dark-only .sidebar-menu .sidebar-link.active {
        background-color: rgba(255, 255, 255, 0.08) !important;
        color: #ffffff !important;
    }
    .sidebar-menu .sidebar-list:hover > .sidebar-link .stroke-icon,
    .sidebar-menu .sidebar-list.active > .sidebar-link .stroke-icon,
    .sidebar-menu .sidebar-link.active .stroke-icon {
        stroke: var(--theme-default, #6362e7) !important;
    }
    body.dark-only .sidebar-menu .sidebar-list.active > .sidebar-link .stroke-icon,
    body.dark-only .sidebar-menu .sidebar-link.active .stroke-icon {
        stroke: #ffffff !important;
    }
    .sidebar-menu .sidebar-list:hover > .sidebar-link i:not(.iconly-Arrow-Right-2):not(.fa-thumbtack),
    .sidebar-menu .sidebar-list.active > .sidebar-link i:not(.iconly-Arrow-Right-2):not(.fa-thumbtack),
    .sidebar-menu .sidebar-link.active i:not(.iconly-Arrow-Right-2):not(.fa-thumbtack) {
        color: var(--theme-default, #6362e7) !important;
    }
    body.dark-only .sidebar-menu .sidebar-list.active > .sidebar-link i:not(.iconly-Arrow-Right-2):not(.fa-thumbtack),
    body.dark-only .sidebar-menu .sidebar-link.active i:not(.iconly-Arrow-Right-2):not(.fa-thumbtack) {
        color: #ffffff !important;
    }

    /* Badges */
    .sidebar-menu .sidebar-list .badge {
        font-size: 11px !important;
        font-weight: 700 !important;
        padding: 3px 8px !important;
        border-radius: 12px !important;
        margin-left: auto !important;
        line-height: 1 !important;
    }

    /* Chevron Arrows */
    .sidebar-menu .sidebar-list .iconly-Arrow-Right-2 {
        margin-left: auto !important;
        font-size: 14px !important;
        color: #8b96a5 !important;
        transition: transform 0.25s ease, color 0.25s ease !important;
        transform: rotate(0deg) !important;
        line-height: 1 !important;
        flex-shrink: 0 !important;
    }
    /* When a link has both a badge and a chevron */
    .sidebar-menu .sidebar-list .badge + .iconly-Arrow-Right-2 {
        margin-left: 8px !important;
    }
    .sidebar-menu .sidebar-list.active > .sidebar-link .iconly-Arrow-Right-2,
    .sidebar-menu .sidebar-link.active .iconly-Arrow-Right-2 {
        transform: rotate(90deg) !important;
        color: var(--theme-default, #6362e7) !important;
    }

    /* Submenus */
    .sidebar-menu .sidebar-submenu {
        margin: 6px 0 8px 16px !important;
        padding: 4px 0 4px 12px !important;
        border-left: 2px solid var(--theme-default, #6362e7) !important;
        list-style: none !important;
    }
    body.dark-only .sidebar-menu .sidebar-submenu {
        border-left-color: rgba(255, 255, 255, 0.2) !important;
    }
    .sidebar-menu .sidebar-submenu li {
        margin: 3px 0 !important;
        padding: 0 !important;
        list-style: none !important;
    }
    .sidebar-menu .sidebar-submenu a {
        display: block !important;
        padding: 6px 10px !important;
        font-size: 13.5px !important;
        font-weight: 500 !important;
        color: #64748b !important;
        border-radius: 6px !important;
        text-decoration: none !important;
        transition: all 0.2s ease !important;
    }
    body.dark-only .sidebar-menu .sidebar-submenu a {
        color: #94a3b8 !important;
    }
    .sidebar-menu .sidebar-submenu a:hover {
        color: var(--theme-default, #6362e7) !important;
        background: rgba(99, 98, 231, 0.08) !important;
    }
    .sidebar-menu .sidebar-submenu a.active {
        color: var(--theme-default, #6362e7) !important;
        font-weight: 700 !important;
        background: rgba(99, 98, 231, 0.1) !important;
    }

    /* SimpleBar vertical scrollbar */
    .page-sidebar .simplebar-track.simplebar-vertical {
        right: 2px !important;
        width: 5px !important;
    }
    .page-sidebar .simplebar-track.simplebar-vertical .simplebar-scrollbar:before {
        background: #8b96a5 !important;
        border-radius: 6px !important;
    }

    /* Mobile Off-Canvas Sidebar (< 992px) */
    @media (max-width: 991.98px) {
        .page-sidebar {
            position: fixed !important;
            top: 0 !important;
            left: -270px !important;
            height: calc(100vh - 70px) !important;
            margin-top: 70px !important;
            z-index: 1050 !important;
            box-shadow: none !important;
            transition: left 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
        }
        .page-wrapper.mobile-sidebar-open .page-sidebar {
            left: 0 !important;
            box-shadow: 6px 0 30px rgba(0, 0, 0, 0.25) !important;
        }
        .sidebar-backdrop {
            display: none;
            position: fixed;
            top: 70px;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1040;
            opacity: 0;
            transition: opacity 0.3s ease;
            backdrop-filter: blur(2px);
            -webkit-backdrop-filter: blur(2px);
            cursor: pointer;
            touch-action: manipulation;
        }
        .page-wrapper.mobile-sidebar-open .sidebar-backdrop {
            display: block !important;
            opacity: 1 !important;
        }
    }
    @media (max-width: 767.98px) {
        .page-sidebar {
            height: calc(100vh - 67px) !important;
            margin-top: 67px !important;
        }
        .sidebar-backdrop {
            top: 67px !important;
        }
    }
    @media (max-width: 575.98px) {
        .page-sidebar {
            height: calc(100vh - 63px) !important;
            margin-top: 63px !important;
        }
        .sidebar-backdrop {
            top: 63px !important;
        }
    }
</style>

<aside class="page-sidebar">
    <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
    <div class="main-sidebar" id="main-sidebar">
        <ul class="sidebar-menu" id="simple-bar">
            <!-- MAIN MENU -->
            <li class="sidebar-main-title">
                <div>
                    <h5>Main Menu</h5>
                </div>
            </li>

            <!-- Dashboard -->
            <li class="sidebar-list {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <a class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ url('/admin/dashboard') }}">
                    <svg class="stroke-icon">
                        <use href="{{ asset('admiro/assets/svg/iconly-sprite.svg#Home-dashboard') }}"></use>
                    </svg>
                    <h6>Dashboard</h6>
                </a>
            </li>

            @if ($adminUser->type == 'Super Admin' || $adminUser->type == 'Admin')
                <!-- INVESTMENT -->
                @php
                    $isInvestActive = request()->routeIs('plans') || request()->routeIs('newplan') || request()->routeIs('editplan') || request()->routeIs('activeinvestments');
                @endphp
                <li class="sidebar-list {{ $isInvestActive ? 'active' : '' }}">
                    <a class="sidebar-link sidebar-title {{ $isInvestActive ? 'active' : '' }}" href="javascript:void(0)">
                        <svg class="stroke-icon">
                            <use href="{{ asset('admiro/assets/svg/iconly-sprite.svg#Pie') }}"></use>
                        </svg>
                        <h6>Investment</h6>
                        <i class="iconly-Arrow-Right-2 icli ms-auto"></i>
                    </a>
                    <ul class="sidebar-submenu" style="{{ $isInvestActive ? 'display: block;' : '' }}">
                        <li>
                            <a href="{{ url('/admin/dashboard/plans') }}" class="{{ request()->routeIs('plans') || request()->routeIs('newplan') || request()->routeIs('editplan') ? 'active text-primary' : '' }}">
                                <i class="fa fa-circle f-8 me-2"></i> Investment Plans
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/admin/dashboard/active-investments') }}" class="{{ request()->routeIs('activeinvestments') ? 'active text-primary' : '' }}">
                                <i class="fa fa-circle f-8 me-2"></i> Active Investments
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- USERS & IDENTITY -->
                <li class="sidebar-main-title">
                    <div>
                        <h5>Users & Identity</h5>
                    </div>
                </li>

                <li class="sidebar-list {{ request()->routeIs('manageusers') || request()->routeIs('loginactivity') || request()->routeIs('user.plans') || request()->routeIs('viewuser') ? 'active' : '' }}">
                    <a class="sidebar-link {{ request()->routeIs('manageusers') ? 'active' : '' }}" href="{{ url('/admin/dashboard/manageusers') }}">
                        <svg class="stroke-icon">
                            <use href="{{ asset('admiro/assets/svg/iconly-sprite.svg#Profile') }}"></use>
                        </svg>
                        <h6>Manage Users</h6>
                    </a>
                </li>

                <li class="sidebar-list {{ request()->routeIs('emailservices') ? 'active' : '' }}">
                    <a class="sidebar-link {{ request()->routeIs('emailservices') ? 'active' : '' }}" href="{{ route('emailservices') }}">
                        <svg class="stroke-icon">
                            <use href="{{ asset('admiro/assets/svg/iconly-sprite.svg#Message') }}"></use>
                        </svg>
                        <h6>Email Services</h6>
                    </a>
                </li>

                <li class="sidebar-list {{ request()->routeIs('admin.notifications*') ? 'active' : '' }}">
                    <a class="sidebar-link {{ request()->routeIs('admin.notifications*') ? 'active' : '' }}" href="{{ route('admin.notifications') }}">
                        <svg class="stroke-icon">
                            <use href="{{ asset('admiro/assets/svg/iconly-sprite.svg#notification') }}"></use>
                        </svg>
                        <h6>Broadcast & Alerts</h6>
                    </a>
                </li>

                <li class="sidebar-list {{ request()->routeIs('kyc') || request()->routeIs('viewkyc') ? 'active' : '' }}">
                    <a class="sidebar-link {{ request()->routeIs('kyc') ? 'active' : '' }}" href="{{ route('kyc') }}">
                        <svg class="stroke-icon">
                            <use href="{{ asset('admiro/assets/svg/iconly-sprite.svg#Document') }}"></use>
                        </svg>
                        <h6>KYC Applications</h6>
                        @if($pending_kyc_count > 0)
                            <span class="badge bg-info rounded-pill ms-auto">{{ $pending_kyc_count }}</span>
                        @endif
                    </a>
                </li>

                @if(isset($mod['bank_link']) && ($mod['bank_link'] === true || $mod['bank_link'] === 'true' || $mod['bank_link'] === 1 || $mod['bank_link'] === '1'))
                <li class="sidebar-list {{ request()->routeIs('admin.bank.index') ? 'active' : '' }}">
                    <a class="sidebar-link {{ request()->routeIs('admin.bank.index') ? 'active' : '' }}" href="{{ route('admin.bank.index') }}">
                        <svg class="stroke-icon">
                            <use href="{{ asset('admiro/assets/svg/iconly-sprite.svg#Paper') }}"></use>
                        </svg>
                        <h6>Linked Banks</h6>
                    </a>
                </li>
                @endif

                <!-- FINANCE -->
                <li class="sidebar-main-title">
                    <div>
                        <h5>Finance</h5>
                    </div>
                </li>

                <li class="sidebar-list {{ request()->routeIs('mdeposits') || request()->routeIs('viewdepositimage') ? 'active' : '' }}">
                    <a class="sidebar-link {{ request()->routeIs('mdeposits') ? 'active' : '' }}" href="{{ url('/admin/dashboard/mdeposits') }}">
                        <svg class="stroke-icon">
                            <use href="{{ asset('admiro/assets/svg/iconly-sprite.svg#Wallet') }}"></use>
                        </svg>
                        <h6>Manage Deposits</h6>
                        @if($pending_deposits_count > 0)
                            <span class="badge bg-warning text-dark rounded-pill ms-auto">{{ $pending_deposits_count }}</span>
                        @endif
                    </a>
                </li>

                <li class="sidebar-list {{ request()->routeIs('mwithdrawals') || request()->routeIs('processwithdraw') ? 'active' : '' }}">
                    <a class="sidebar-link {{ request()->routeIs('mwithdrawals') ? 'active' : '' }}" href="{{ url('/admin/dashboard/mwithdrawals') }}">
                        <svg class="stroke-icon">
                            <use href="{{ asset('admiro/assets/svg/iconly-sprite.svg#Bag') }}"></use>
                        </svg>
                        <h6>Manage Withdrawals</h6>
                        @if($pending_withdrawals_count > 0)
                            <span class="badge bg-danger rounded-pill ms-auto">{{ $pending_withdrawals_count }}</span>
                        @endif
                    </a>
                </li>

                <!-- TRADING & SIGNALS -->
                <li class="sidebar-main-title">
                    <div>
                        <h5>Trading & Signals</h5>
                    </div>
                </li>

                @php
                    $isMgAcntActive = request()->routeIs('msubtrade') || request()->routeIs('tsettings') || request()->routeIs('tacnts');
                @endphp
                <li class="sidebar-list {{ $isMgAcntActive ? 'active' : '' }}">
                    <a class="sidebar-link sidebar-title {{ $isMgAcntActive ? 'active' : '' }}" href="javascript:void(0)">
                        <i class="fa fa-sync-alt f-16 me-2 text-muted"></i>
                        <h6>Manage Accounts</h6>
                        <i class="iconly-Arrow-Right-2 icli ms-auto"></i>
                    </a>
                    <ul class="sidebar-submenu" style="{{ $isMgAcntActive ? 'display: block;' : '' }}">
                        <li>
                            <a href="{{ route('msubtrade') }}" class="{{ request()->routeIs('msubtrade') ? 'active text-primary' : '' }}">
                                <i class="fa fa-circle f-8 me-2"></i> Trading Accounts
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('tsettings') }}" class="{{ request()->routeIs('tsettings') ? 'active text-primary' : '' }}">
                                <i class="fa fa-circle f-8 me-2"></i> Trading Settings
                            </a>
                        </li>
                    </ul>
                </li>

                @php
                    $isSignalsActive = request()->routeIs('signals') || request()->routeIs('signal.settings') || request()->routeIs('signal.subs');
                @endphp
                <li class="sidebar-list {{ $isSignalsActive ? 'active' : '' }}">
                    <a class="sidebar-link sidebar-title {{ $isSignalsActive ? 'active' : '' }}" href="javascript:void(0)">
                        <i class="fa fa-signal f-16 me-2 text-muted"></i>
                        <h6>Signal Provider</h6>
                        <i class="iconly-Arrow-Right-2 icli ms-auto"></i>
                    </a>
                    <ul class="sidebar-submenu" style="{{ $isSignalsActive ? 'display: block;' : '' }}">
                        <li>
                            <a href="{{ route('signals') }}" class="{{ request()->routeIs('signals') ? 'active text-primary' : '' }}">
                                <i class="fa fa-circle f-8 me-2"></i> Trade Signals
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('signal.subs') }}" class="{{ request()->routeIs('signal.subs') ? 'active text-primary' : '' }}">
                                <i class="fa fa-circle f-8 me-2"></i> Subscribers
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('signal.settings') }}" class="{{ request()->routeIs('signal.settings') ? 'active text-primary' : '' }}">
                                <i class="fa fa-circle f-8 me-2"></i> Settings
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- MEMBERSHIP -->
                @php
                    $isMembershipActive = request()->routeIs('categories') || request()->routeIs('courses') || request()->routeIs('lessons') || request()->routeIs('less.nocourse');
                @endphp
                <li class="sidebar-list {{ $isMembershipActive ? 'active' : '' }}">
                    <a class="sidebar-link sidebar-title {{ $isMembershipActive ? 'active' : '' }}" href="javascript:void(0)">
                        <i class="fa fa-book-reader f-16 me-2 text-muted"></i>
                        <h6>Membership</h6>
                        <i class="iconly-Arrow-Right-2 icli ms-auto"></i>
                    </a>
                    <ul class="sidebar-submenu" style="{{ $isMembershipActive ? 'display: block;' : '' }}">
                        <li>
                            <a href="{{ route('categories') }}" class="{{ request()->routeIs('categories') ? 'active text-primary' : '' }}">
                                <i class="fa fa-circle f-8 me-2"></i> Categories
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('courses') }}" class="{{ request()->routeIs('courses') ? 'active text-primary' : '' }}">
                                <i class="fa fa-circle f-8 me-2"></i> Courses
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('less.nocourse') }}" class="{{ request()->routeIs('less.nocourse') ? 'active text-primary' : '' }}">
                                <i class="fa fa-circle f-8 me-2"></i> Lessons
                            </a>
                        </li>
                    </ul>
                </li>
            @endif

            <!-- TASKS -->
            @php
                $isTaskActive = request()->routeIs('task') || request()->routeIs('mtask') || request()->routeIs('viewtask');
            @endphp
            <li class="sidebar-list {{ $isTaskActive ? 'active' : '' }}">
                <a class="sidebar-link sidebar-title {{ $isTaskActive ? 'active' : '' }}" href="javascript:void(0)">
                    <i class="fa fa-tasks f-16 me-2 text-muted"></i>
                    <h6>Tasks</h6>
                    <i class="iconly-Arrow-Right-2 icli ms-auto"></i>
                </a>
                <ul class="sidebar-submenu" style="{{ $isTaskActive ? 'display: block;' : '' }}">
                    @if ($adminUser->type == 'Super Admin')
                        <li>
                            <a href="{{ url('/admin/dashboard/task') }}" class="{{ request()->routeIs('task') ? 'active text-primary' : '' }}">
                                <i class="fa fa-circle f-8 me-2"></i> Create Task
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/admin/dashboard/mtask') }}" class="{{ request()->routeIs('mtask') ? 'active text-primary' : '' }}">
                                <i class="fa fa-circle f-8 me-2"></i> Manage Tasks
                            </a>
                        </li>
                    @else
                        <li>
                            <a href="{{ url('/admin/dashboard/viewtask') }}" class="{{ request()->routeIs('viewtask') ? 'active text-primary' : '' }}">
                                <i class="fa fa-circle f-8 me-2"></i> View My Tasks
                            </a>
                        </li>
                    @endif
                </ul>
            </li>

            <!-- LEADS -->
            @if ($adminUser->type == 'Super Admin' || $adminUser->type == 'Admin')
                <li class="sidebar-list {{ request()->routeIs('leads') ? 'active' : '' }}">
                    <a class="sidebar-link {{ request()->routeIs('leads') ? 'active' : '' }}" href="{{ url('/admin/dashboard/leads') }}">
                        <i class="fa fa-user-slash f-16 me-2 text-muted"></i>
                        <h6>Leads</h6>
                    </a>
                </li>
            @endif

            @if ($adminUser->type == 'Rentention Agent' || $adminUser->type == 'Conversion Agent')
                <li class="sidebar-list {{ request()->routeIs('leadsassign') ? 'active' : '' }}">
                    <a class="sidebar-link {{ request()->routeIs('leadsassign') ? 'active' : '' }}" href="{{ url('/admin/dashboard/leadsassign') }}">
                        <i class="fa fa-user-slash f-16 me-2 text-muted"></i>
                        <h6>My Leads</h6>
                    </a>
                </li>
            @endif

            <!-- SUPER ADMIN CONTROLS -->
            @if ($adminUser->type == 'Super Admin')
                <li class="sidebar-main-title">
                    <div>
                        <h5>Administration & Settings</h5>
                    </div>
                </li>

                <!-- Administrators -->
                @php
                    $isAdmActive = request()->routeIs('addmanager') || request()->routeIs('madmin');
                @endphp
                <li class="sidebar-list {{ $isAdmActive ? 'active' : '' }}">
                    <a class="sidebar-link sidebar-title {{ $isAdmActive ? 'active' : '' }}" href="javascript:void(0)">
                        <i class="fa fa-user-shield f-16 me-2 text-muted"></i>
                        <h6>Administrator(s)</h6>
                        <i class="iconly-Arrow-Right-2 icli ms-auto"></i>
                    </a>
                    <ul class="sidebar-submenu" style="{{ $isAdmActive ? 'display: block;' : '' }}">
                        <li>
                            <a href="{{ url('/admin/dashboard/addmanager') }}" class="{{ request()->routeIs('addmanager') ? 'active text-primary' : '' }}">
                                <i class="fa fa-circle f-8 me-2"></i> Add Manager
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/admin/dashboard/madmin') }}" class="{{ request()->routeIs('madmin') ? 'active text-primary' : '' }}">
                                <i class="fa fa-circle f-8 me-2"></i> Manage Admins
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Settings -->
                @php
                    $isSettingsActive = request()->routeIs('appsettingshow') || request()->routeIs('termspolicy') || request()->routeIs('refsetshow') || request()->routeIs('paymentview') || request()->routeIs('subview') || request()->routeIs('frontpage') || request()->routeIs('allipaddress') || request()->routeIs('ipaddress') || request()->routeIs('editpaymethod') || request()->routeIs('managecryptoasset');
                @endphp
                <li class="sidebar-list {{ $isSettingsActive ? 'active' : '' }}">
                    <a class="sidebar-link sidebar-title {{ $isSettingsActive ? 'active' : '' }}" href="javascript:void(0)">
                        <svg class="stroke-icon">
                            <use href="{{ asset('admiro/assets/svg/iconly-sprite.svg#Setting') }}"></use>
                        </svg>
                        <h6>Settings</h6>
                        <i class="iconly-Arrow-Right-2 icli ms-auto"></i>
                    </a>
                    <ul class="sidebar-submenu" style="{{ $isSettingsActive ? 'display: block;' : '' }}">
                        <li>
                            <a href="{{ route('appsettingshow') }}" class="{{ request()->routeIs('appsettingshow') ? 'active text-primary' : '' }}">
                                <i class="fa fa-circle f-8 me-2"></i> App Settings
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('refsetshow') }}" class="{{ request()->routeIs('refsetshow') ? 'active text-primary' : '' }}">
                                <i class="fa fa-circle f-8 me-2"></i> Referral & Bonus
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('managecryptoasset') }}" class="{{ request()->routeIs('managecryptoasset') ? 'active text-primary' : '' }}">
                                <i class="fa fa-circle f-8 me-2"></i> Swap Settings
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('subview') }}" class="{{ request()->routeIs('subview') ? 'active text-primary' : '' }}">
                                <i class="fa fa-circle f-8 me-2"></i> Subscription Settings
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/admin/dashboard/frontpage') }}" class="{{ request()->routeIs('frontpage') ? 'active text-primary' : '' }}">
                                <i class="fa fa-circle f-8 me-2"></i> Frontend Settings
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('termspolicy') }}" class="{{ request()->routeIs('termspolicy') ? 'active text-primary' : '' }}">
                                <i class="fa fa-circle f-8 me-2"></i> Terms and Privacy
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/admin/dashboard/ipaddress') }}" class="{{ request()->routeIs('ipaddress') || request()->routeIs('allipaddress') ? 'active text-primary' : '' }}">
                                <i class="fa fa-circle f-8 me-2"></i> IP Address
                            </a>
                        </li>
                    </ul>
                </li>
            @endif

            <!-- ABOUT -->
            @if ($adminUser->type != 'Conversion Agent')
                <li class="sidebar-list {{ request()->routeIs('aboutonlinetrade') ? 'active' : '' }}">
                    <a class="sidebar-link {{ request()->routeIs('aboutonlinetrade') ? 'active' : '' }}" href="{{ url('/admin/dashboard/about') }}">
                        <i class="fa fa-info-circle f-16 me-2 text-muted"></i>
                        <h6>About Onlinetrader</h6>
                    </a>
                </li>
            @endif
        </ul>
    </div>
    <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
</aside>
@endif
