@if(!empty($from_layout))
<header class="page-header row align-items-center">
    <div class="logo-wrapper d-flex align-items-center col-auto">
        <a href="{{ route('admin.dashboard') }}" class="admin-brand-link d-inline-flex align-items-center text-decoration-none">
            {{-- 1. Colored Logo (for Light Mode against white navbar) --}}
            @if(!empty($settings->dark_logo))
                <img class="admin-brand-colored img-fluid" src="{{ asset('storage/app/public/' . $settings->dark_logo) }}" alt="{{ $settings->site_name ?? 'Logo' }}" />
            @elseif(!empty($settings->logo))
                <img class="admin-brand-colored img-fluid" src="{{ asset('storage/app/public/' . $settings->logo) }}" alt="{{ $settings->site_name ?? 'Logo' }}" />
            @endif

            {{-- 2. White Logo (for Dark Mode against dark navbar) --}}
            @if(!empty($settings->logo))
                <img class="admin-brand-white img-fluid" src="{{ asset('storage/app/public/' . $settings->logo) }}" alt="{{ $settings->site_name ?? 'Logo' }}" />
            @elseif(!empty($settings->dark_logo))
                <img class="admin-brand-white img-fluid" src="{{ asset('storage/app/public/' . $settings->dark_logo) }}" alt="{{ $settings->site_name ?? 'Logo' }}" />
            @endif

            @if(empty($settings->logo) && empty($settings->dark_logo))
                <span class="f-w-800 f-18 text-primary">{{ $settings->site_name }}</span>
            @endif
        </a>
        <a class="close-btn toggle-sidebar ms-2 ms-md-3" href="javascript:void(0)" id="sidebar-toggle-btn" title="Toggle Navigation">
            <svg class="svg-color" style="width: 22px; height: 22px;">
                <use href="{{ asset('admiro/assets/svg/iconly-sprite.svg#Category') }}"></use>
            </svg>
        </a>
    </div>

    <div class="page-main-header col d-flex align-items-center justify-content-between">
        <div class="header-left">
            <form class="form-inline search-full d-none d-lg-block mb-0" action="{{ route('manageusers') }}" method="get">
                <div class="position-relative d-flex align-items-center" style="width: 280px;">
                    <input class="form-control form-control-sm rounded-pill ps-4 py-2" type="text" placeholder="Search users by name, email..." name="search" style="font-size: 13px;" />
                    <button type="submit" class="btn btn-sm text-muted position-absolute end-0 me-2 p-0 border-0 bg-transparent">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </form>
        </div>

        <div class="nav-right ms-auto">
            <ul class="header-right d-flex align-items-center mb-0 list-unstyled" style="gap: 10px;">
                <!-- Color Theme Accent Dropdown -->
                <li class="custom-dropdown position-relative" style="width: auto; height: auto;">
                    <a href="javascript:void(0)" class="text-muted d-flex align-items-center justify-content-center rounded-circle border hover-bg" title="Accent Color Palette" id="paletteBtn" style="width: 38px; height: 38px; text-decoration: none;">
                        <i class="fa fa-palette f-16"></i>
                    </a>
                    <div class="custom-menu p-3 shadow-lg rounded-3 position-absolute end-0 mt-2" style="min-width: 220px; z-index: 1070;" id="paletteMenu">
                        <h6 class="dropdown-title f-w-700 mb-2 f-13">Accent Color</h6>
                        <div class="d-flex gap-2 justify-content-between my-2">
                            <button class="btn btn-sm rounded-circle p-0 theme-color-btn border-2" data-color="#6362e7" style="width: 28px; height: 28px; background-color: #6362e7;" title="Purple / Indigo (Default)"></button>
                            <button class="btn btn-sm rounded-circle p-0 theme-color-btn border-2" data-color="#308e87" style="width: 28px; height: 28px; background-color: #308e87;" title="Emerald Green"></button>
                            <button class="btn btn-sm rounded-circle p-0 theme-color-btn border-2" data-color="#3b4cb8" style="width: 28px; height: 28px; background-color: #3b4cb8;" title="Navy Blue"></button>
                            <button class="btn btn-sm rounded-circle p-0 theme-color-btn border-2" data-color="#f59e0b" style="width: 28px; height: 28px; background-color: #f59e0b;" title="Amber"></button>
                            <button class="btn btn-sm rounded-circle p-0 theme-color-btn border-2" data-color="#e11d48" style="width: 28px; height: 28px; background-color: #e11d48;" title="Crimson"></button>
                        </div>
                    </div>
                </li>

                <!-- Dark Mode Toggle Button -->
                <li style="width: auto; height: auto;">
                    <a class="dark-mode d-flex align-items-center justify-content-center rounded-circle border hover-bg text-dark" href="javascript:void(0)" title="Toggle Dark / Light Mode" id="themeToggleBtn" style="width: 38px; height: 38px; text-decoration: none;">
                        <svg style="width: 18px; height: 18px;">
                            <use href="{{ asset('admiro/assets/svg/iconly-sprite.svg#moondark') }}"></use>
                        </svg>
                    </a>
                </li>

                <!-- Fullscreen Toggle -->
                <li class="d-none d-sm-block" style="width: auto; height: auto;">
                    <a class="full-screen d-flex align-items-center justify-content-center rounded-circle border hover-bg text-dark" href="javascript:void(0)" id="fullScreenBtn" title="Full Screen" style="width: 38px; height: 38px; text-decoration: none;">
                        <svg style="width: 18px; height: 18px;">
                            <use href="{{ asset('admiro/assets/svg/iconly-sprite.svg#scanfull') }}"></use>
                        </svg>
                    </a>
                </li>

                <!-- Visit Site -->
                <li class="d-none d-md-block" style="width: auto; height: auto;">
                    <a href="{{ url('/') }}" target="_blank" class="btn btn-outline-primary btn-sm rounded-pill d-inline-flex align-items-center px-3" style="height: 36px; font-size: 12px; font-weight: 600; white-space: nowrap !important; text-decoration: none;">
                        <i class="fa fa-external-link-alt me-1 f-12"></i> Visit Site
                    </a>
                </li>

                <!-- Admin Profile Dropdown -->
                <li class="profile-nav custom-dropdown position-relative" style="width: auto; height: auto;">
                    <div class="user-wrap d-flex align-items-center gap-2 cursor-pointer p-1 rounded-pill border ps-1 pe-3 hover-bg" id="profileDropdownBtn" style="height: 42px;">
                        <div class="user-img">
                            <img class="rounded-circle" src="{{ asset('admiro/assets/images/profile.png') }}" alt="Admin" style="width: 32px; height: 32px; object-fit: cover;" />
                        </div>
                        <div class="user-content d-none d-md-block text-start" style="line-height: 1.2;">
                            <h6 class="mb-0 f-12 f-w-700 text-dark">{{ Auth('admin')->User()->firstName }} {{ Auth('admin')->User()->lastName }}</h6>
                            <p class="mb-0 text-muted f-10">{{ Auth('admin')->User()->type }} <i class="fa-solid fa-chevron-down ms-1 f-9"></i></p>
                        </div>
                    </div>
                    <div class="custom-menu admin-profile-dropdown-panel overflow-hidden position-absolute end-0 mt-2 shadow-lg rounded-3 py-0" style="min-width: 250px; z-index: 1070; border: 1px solid rgba(0,0,0,0.08);" id="profileMenu">
                        <!-- Profile Header -->
                        <div class="px-3 py-3 border-bottom d-flex align-items-center gap-2.5" style="background: rgba(99, 98, 231, 0.04);">
                            <img class="rounded-circle flex-shrink-0" src="{{ asset('admiro/assets/images/profile.png') }}" alt="Admin" style="width: 38px; height: 38px; object-fit: cover; border: 2px solid var(--theme-default, #6362e7);" />
                            <div style="line-height: 1.25; min-width: 0;">
                                <h6 class="f-13 f-w-700 mb-0 text-dark text-truncate">{{ Auth('admin')->User()->firstName }} {{ Auth('admin')->User()->lastName }}</h6>
                                <small class="text-muted f-11 d-block text-truncate">{{ Auth('admin')->User()->email }}</small>
                                <span class="badge bg-primary bg-opacity-10 text-primary px-2 py-0.5 rounded-pill f-9 f-w-700 mt-1 d-inline-block">{{ Auth('admin')->User()->type ?? 'Super Admin' }}</span>
                            </div>
                        </div>

                        <!-- Menu Actions -->
                        <ul class="admin-profile-menu list-unstyled mb-0 p-2">
                            <li>
                                <a class="admin-menu-item py-2 px-2.5 rounded-2 d-flex align-items-center gap-2.5 text-decoration-none transition" href="{{ route('adminprofile') }}">
                                    <div class="menu-icon-bubble rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 30px; height: 30px; background: rgba(99, 98, 231, 0.1); color: var(--theme-default, #6362e7);">
                                        <i class="fa-solid fa-user-gear f-12"></i>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <span class="f-12 f-w-600 text-dark menu-label">Account Settings</span>
                                        <small class="text-muted f-10">Personal info & security</small>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a class="admin-menu-item py-2 px-2.5 rounded-2 d-flex align-items-center gap-2.5 text-decoration-none transition" href="{{ url('admin/dashboard/adminchangepassword') }}">
                                    <div class="menu-icon-bubble rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 30px; height: 30px; background: rgba(14, 165, 233, 0.1); color: #0284c7;">
                                        <i class="fa-solid fa-shield-keyhole f-12 fa-key"></i>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <span class="f-12 f-w-600 text-dark menu-label">Change Password</span>
                                        <small class="text-muted f-10">Update master credentials</small>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a class="admin-menu-item py-2 px-2.5 rounded-2 d-flex align-items-center gap-2.5 text-decoration-none transition" href="{{ route('appsettingshow') }}">
                                    <div class="menu-icon-bubble rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 30px; height: 30px; background: rgba(245, 158, 11, 0.1); color: #d97706;">
                                        <i class="fa-solid fa-sliders f-12 fa-cog"></i>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <span class="f-12 f-w-600 text-dark menu-label">System Settings</span>
                                        <small class="text-muted f-10">Branding, emails, wallets</small>
                                    </div>
                                </a>
                            </li>
                            <li class="admin-menu-divider my-1 border-top"></li>
                            <li>
                                <a class="admin-menu-item py-2 px-2.5 rounded-2 d-flex align-items-center gap-2.5 text-decoration-none text-danger transition" href="{{ route('adminlogout') }}" onclick="event.preventDefault(); document.getElementById('admin-logout-form').submit();">
                                    <div class="menu-icon-bubble rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 30px; height: 30px; background: rgba(239, 68, 68, 0.1); color: #dc2626;">
                                        <i class="fa-solid fa-arrow-right-from-bracket f-12 fa-sign-out-alt"></i>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <span class="f-12 f-w-700 text-danger menu-label">Sign Out</span>
                                        <small class="text-muted f-10">End current session</small>
                                    </div>
                                </a>
                                <form id="admin-logout-form" action="{{ route('adminlogout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</header>
@endif
