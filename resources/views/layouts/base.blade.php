<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="robots" content="noindex, nofollow, noarchive, nosnippet, noimageindex">
    <meta name="googlebot" content="noindex, nofollow, noarchive, nosnippet, noimageindex">

    <title>{{ $settings->site_name }} – @yield('title', $settings->site_title)</title>
    <meta name="description" content="{{ $settings->description }}">
    <meta name="keywords" content="crypto, asset protection, arbitrage, investment, trading, portfolio security">
    <meta name="author" content="{{ $settings->site_name }}">

    <!-- Open Graph / Meta -->
    <meta property="og:title" content="{{ $settings->site_name }} – {{ $settings->site_title }}">
    <meta property="og:description" content="{{ $settings->description }}">
    <meta property="og:image" content="{{ asset('temp/images/meta.png') }}">

    <!-- Favicons -->
    @if(!empty($settings->favicon))
        <link rel="icon" type="image/png" href="{{ asset('storage/app/public/' . $settings->favicon) }}" sizes="32x32">
        <link rel="apple-touch-icon" href="{{ asset('storage/app/public/' . $settings->favicon) }}">
    @else
        <link rel="icon" type="image/png" href="{{ asset('volkovdesign/icon/favicon-32x32.png') }}" sizes="32x32">
        <link rel="apple-touch-icon" href="{{ asset('volkovdesign/icon/favicon-32x32.png') }}">
    @endif

    <!-- Google Font: Manrope -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('volkovdesign/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('volkovdesign/css/splide.min.css') }}">
    <link rel="stylesheet" href="{{ asset('volkovdesign/css/main.css') }}">

    <!-- Tabler Icons -->
    <link rel="stylesheet" href="{{ asset('volkovdesign/webfont/tabler-icons.min.css') }}">

    <!-- Modern Web3 / Fintech Design System Overrides -->
    <link rel="stylesheet" href="{{ asset('volkovdesign/css/modern-custom.css') }}?v={{ file_exists(base_path('volkovdesign/css/modern-custom.css')) ? filemtime(base_path('volkovdesign/css/modern-custom.css')) : time() }}">

    <!-- Dynamic Hero Accent & Color Grading Variables from Settings -->
    <style>
        :root {
            --hero-accent: {{ $settings->hero_accent_color ?? '#F59E0B' }};
            --hero-secondary: {{ $settings->hero_secondary_color ?? '#D97706' }};
        }
    </style>

    <!-- Instant Anti-Flicker Theme Initializer -->
    <script>
        (function() {
            var stored = localStorage.getItem('ecx_theme') || 'system';
            var prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            var isDark = stored === 'dark' || (stored === 'system' && prefersDark);
            var mode = isDark ? 'dark' : 'light';
            document.documentElement.setAttribute('data-theme', mode);
            document.documentElement.setAttribute('data-theme-setting', stored);
            if (document.body) {
                document.body.setAttribute('data-theme', mode);
            }
        })();
    </script>

    @php
        $siteAccent = !empty($settings->site_accent_color) ? $settings->site_accent_color : '#D61C4E';
        $siteSecondary = !empty($settings->site_secondary_color) ? $settings->site_secondary_color : '#9F1239';
        $parseRgb = function($hex) {
            $hex = ltrim($hex, '#');
            if (strlen($hex) === 3) {
                $hex = $hex[0].$hex[0].$hex[1].$hex[1].$hex[2].$hex[2];
            }
            if (strlen($hex) !== 6) {
                return '214, 28, 78';
            }
            return hexdec(substr($hex, 0, 2)) . ', ' . hexdec(substr($hex, 2, 2)) . ', ' . hexdec(substr($hex, 4, 2));
        };
        $primaryRgb = $parseRgb($siteAccent);
        $secondaryRgb = $parseRgb($siteSecondary);
    @endphp
    <style id="dynamic-site-palette">
        :root {
            --theme-primary: {{ $siteAccent }} !important;
            --theme-secondary: {{ $siteSecondary }} !important;
            --theme-primary-rgb: {{ $primaryRgb }} !important;
            --theme-secondary-rgb: {{ $secondaryRgb }} !important;
            --theme-gradient: linear-gradient(135deg, {{ $siteAccent }} 0%, {{ $siteSecondary }} 100%) !important;
            --theme-gradient-hover: linear-gradient(135deg, {{ $siteSecondary }} 0%, {{ $siteAccent }} 100%) !important;
            --accent-cyan: {{ $siteAccent }} !important;
            --accent-blue: {{ $siteSecondary }} !important;
            --border-glow-cyan: rgba({{ $primaryRgb }}, 0.35) !important;
        }
    </style>

    @yield('styles')
</head>

<body class="body body--home">
    <!-- Live Chat Widget if configured -->
    @if(!empty($settings->tawk_to))
        {!! $settings->tawk_to !!}
    @endif

    <!-- Mobile Drawer Backdrop Overlay (Precedes Header for Natural Stacking) -->
    <div class="mobile-nav-overlay" id="mobileNavOverlay"></div>

    <!-- Modern Header -->
    <header class="header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="header__content">
                        <!-- Logo (Left) -->
                        <a href="{{ url('/') }}" class="header__logo">
                            @php
                                $hasCustomLogo = !empty($settings->logo) && file_exists(base_path('storage/app/public/' . $settings->logo));
                                $lightLogo = $hasCustomLogo ? asset('storage/app/public/' . $settings->logo) : asset('volkovdesign/img/logo.svg');
                                $hasCustomDarkLogo = !empty($settings->dark_logo) && file_exists(base_path('storage/app/public/' . $settings->dark_logo));
                                $darkLogo = $hasCustomDarkLogo ? asset('storage/app/public/' . $settings->dark_logo) : $lightLogo;
                            @endphp
                            <img class="logo-light" src="{{ $lightLogo }}" alt="{{ $settings->site_name }}">
                            <img class="logo-dark" src="{{ $darkLogo }}" alt="{{ $settings->site_name }}" @if(empty($settings->dark_logo)) style="filter: brightness(0.2);" @endif>
                        </a>
                        <!-- End Logo -->

                        <!-- Navigation (Aligned towards Right) -->
                        <ul class="header__nav" id="header__nav">
                            <!-- Mobile Drawer Top Header -->
                            <li class="mobile-drawer-header d-lg-none">
                                <div class="mobile-drawer-brand">
                                    <img class="logo-light" src="{{ $lightLogo }}" alt="{{ $settings->site_name }}">
                                    <img class="logo-dark" src="{{ $darkLogo }}" alt="{{ $settings->site_name }}" @if(empty($settings->dark_logo)) style="filter: brightness(0.2);" @endif>
                                </div>
                                <button type="button" class="mobile-drawer-close" id="mobileDrawerCloseBtn" aria-label="Close navigation">
                                    <i class="ti ti-x"></i>
                                </button>
                            </li>

                            <li>
                                <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">
                                    <i class="ti ti-home mobile-nav-icon d-lg-none"></i>
                                    <span>Home</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/#features') }}">
                                    <i class="ti ti-shield-check mobile-nav-icon d-lg-none"></i>
                                    <span>Asset Defense</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/#arbitrage') }}">
                                    <i class="ti ti-arrows-exchange mobile-nav-icon d-lg-none"></i>
                                    <span>Arbitrage</span>
                                </a>
                            </li>

                            <!-- About with FTX Submenu Dropdown -->
                            <li class="header__nav-item--dropdown">
                                <a href="javascript:void(0)" class="header__nav-link--dropdown {{ request()->is('about*') || request()->is('security*') ? 'active' : '' }}" role="button">
                                    <i class="ti ti-building-bank mobile-nav-icon d-lg-none"></i>
                                    <span>About</span>
                                    <i class="ti ti-chevron-down ms-auto dropdown-chevron"></i>
                                </a>
                                <ul class="header__sub-menu">
                                    <li>
                                        <a href="{{ url('/about') }}" class="sub-menu__link">
                                            <div class="sub-menu__icon-box"><i class="ti ti-building-bank"></i></div>
                                            <div class="sub-menu__text">
                                                <span class="sub-menu__title">About {{ $settings->site_name }}</span>
                                                <small class="sub-menu__desc">Institutional governance & cold storage</small>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/security') }}" class="sub-menu__link">
                                            <div class="sub-menu__icon-box" style="background: rgba(16, 185, 129, 0.12); color: #10b981;"><i class="ti ti-shield-lock"></i></div>
                                            <div class="sub-menu__text">
                                                <span class="sub-menu__title">Asset Defense &amp; Vaults</span>
                                                <small class="sub-menu__desc">Multi-sig isolation &amp; Proof of Reserves</small>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/#security') }}" class="sub-menu__link">
                                            <div class="sub-menu__icon-box sub-menu__icon-box--warning"><i class="ti ti-history"></i></div>
                                            <div class="sub-menu__text">
                                                <span class="sub-menu__title">Founding Story (FTX Lesson)</span>
                                                <small class="sub-menu__desc">Why we engineered 1:1 segregated vaults</small>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li>
                                <a href="{{ url('/faq') }}" class="{{ request()->is('faq*') ? 'active' : '' }}">
                                    <i class="ti ti-help-circle mobile-nav-icon d-lg-none"></i>
                                    <span>FAQ</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/contact') }}" class="{{ request()->is('contact*') ? 'active' : '' }}">
                                    <i class="ti ti-mail mobile-nav-icon d-lg-none"></i>
                                    <span>Contact</span>
                                </a>
                            </li>

                            <!-- Mobile view direct auth links -->
                            <li class="d-lg-none mt-auto pt-3 border-top mobile-auth-section">
                                <a href="{{ url('/login') }}" class="btn-signin-modern w-100 justify-content-center mb-2">
                                    <i class="ti ti-user-circle me-2"></i> Sign In
                                </a>
                                <a href="{{ url('/register') }}" class="btn-getstarted-modern w-100 justify-content-center">
                                    <i class="ti ti-shield-check me-2"></i> Get Started
                                </a>
                            </li>
                        </ul>
                        <!-- End Navigation -->

                        <!-- Actions (Right: Theme Toggle + Auth Buttons + Mobile Hamburger) -->
                        <div class="header__actions">
                            <!-- Theme Switcher (Light / Dark / System Auto) -->
                            <div class="dropdown theme-switcher-dropdown">
                                <button class="theme-toggle-btn" type="button" id="themeToggleBtn" data-bs-toggle="dropdown" aria-expanded="false" title="Switch Theme (Light / Dark / System Auto)">
                                    <i class="ti ti-moon" id="themeIconActive"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end theme-switcher-menu shadow-lg" aria-labelledby="themeToggleBtn">
                                    <li>
                                        <button type="button" class="dropdown-item theme-option-btn d-flex align-items-center" data-theme-choice="light">
                                            <i class="ti ti-sun me-2 text-warning"></i> Light
                                            <i class="ti ti-check ms-auto theme-check-icon d-none" data-check="light"></i>
                                        </button>
                                    </li>
                                    <li>
                                        <button type="button" class="dropdown-item theme-option-btn d-flex align-items-center" data-theme-choice="dark">
                                            <i class="ti ti-moon me-2 text-info"></i> Dark
                                            <i class="ti ti-check ms-auto theme-check-icon d-none" data-check="dark"></i>
                                        </button>
                                    </li>
                                    <li>
                                        <button type="button" class="dropdown-item theme-option-btn d-flex align-items-center" data-theme-choice="system">
                                            <i class="ti ti-device-desktop me-2 text-secondary"></i> System Auto
                                            <i class="ti ti-check ms-auto theme-check-icon d-none" data-check="system"></i>
                                        </button>
                                    </li>
                                </ul>
                            </div>

                            <div class="d-none d-lg-flex nav-auth-group">
                                <a href="{{ url('/login') }}" class="btn-signin-modern">
                                    <i class="ti ti-user-circle me-1" style="font-size: 16px;"></i> Sign In
                                </a>

                                <a href="{{ url('/register') }}" class="btn-getstarted-modern">
                                    <i class="ti ti-shield-check me-1" style="font-size: 16px;"></i> Get Started
                                </a>
                            </div>

                            <!-- Mobile Hamburger Menu Button (Right-Hand Side) -->
                            <button class="header__btn-modern d-lg-none" type="button" id="mobileMenuBtn" aria-label="Toggle navigation">
                                <i class="ti ti-menu-2" id="mobileMenuIcon"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- End Header -->

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>
    <!-- End Main Content -->

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-8 col-md-6 col-lg-6 col-xl-4 order-1 order-lg-4 order-xl-1">
                    <!-- Footer Logo -->
                    <div class="footer__logo">
                        <a href="{{ url('/') }}">
                            <img class="logo-light" src="{{ $lightLogo }}" alt="{{ $settings->site_name }}">
                            <img class="logo-dark" src="{{ $darkLogo }}" alt="{{ $settings->site_name }}" @if(empty($settings->dark_logo)) style="filter: brightness(0.2);" @endif>
                        </a>
                    </div>
                    <!-- End Footer Logo -->

                    <!-- Footer Tagline -->
                    <p class="footer__tagline">
                        Built in the post-FTX era with one primary imperative: absolute asset protection. Combining non-custodial risk controls, segregated vaults, and automated algorithmic arbitrage for steady capital growth.
                    </p>
                    <!-- End Footer Tagline -->

                    <!-- Supported Cryptocurrencies -->
                    <div class="footer__currencies">
                        <i class="ti ti-currency-bitcoin" title="Bitcoin"></i>
                        <i class="ti ti-currency-ethereum" title="Ethereum"></i>
                        <i class="ti ti-currency-solana" title="Solana"></i>
                        <i class="ti ti-currency-litecoin" title="Litecoin"></i>
                        <i class="ti ti-currency-dogecoin" title="Dogecoin"></i>
                    </div>
                    <!-- End Footer Currencies -->
                </div>

                <!-- Navigation Column 1 -->
                <div class="col-6 col-md-4 col-lg-3 col-xl-2 order-3 order-md-2 order-lg-2 order-xl-3 offset-md-2 offset-lg-0">
                    <h6 class="footer__title">Company</h6>
                    <div class="footer__nav">
                        <a href="{{ url('/about') }}">About {{ $settings->site_name }}</a>
                        <a href="{{ url('/security') }}">Asset Defense Model</a>
                        <a href="{{ url('/about') }}">Institutional Standards</a>
                        <a href="{{ url('/contact') }}">Contact &amp; Support</a>
                    </div>
                </div>

                <!-- Navigation Column 2 -->
                <div class="col-12 col-md-8 col-lg-6 col-xl-4 order-2 order-md-3 order-lg-1 order-xl-2">
                    <div class="row">
                        <div class="col-12">
                            <h6 class="footer__title">Asset Security &amp; Tech</h6>
                        </div>

                        <div class="col-6">
                            <div class="footer__nav">
                                <a href="{{ url('/security') }}">Vault Segregation</a>
                                <a href="{{ url('/security') }}">Proof of Reserves</a>
                                <a href="{{ url('/security') }}">Cold Storage Protocols</a>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="footer__nav">
                                <a href="{{ url('/#arbitrage') }}">Live Arbitrage Engine</a>
                                <a href="{{ url('/#how-it-works') }}">Security Workflow</a>
                                <a href="{{ url('/dashboard') }}">Client Dashboard</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Navigation Column 3 -->
                <div class="col-6 col-md-4 col-lg-3 col-xl-2 order-4 order-md-4 order-lg-3 order-xl-4">
                    <h6 class="footer__title">Legal &amp; Security</h6>
                    <div class="footer__nav">
                        <a href="{{ url('/security') }}">Security Architecture</a>
                        <a href="{{ url('/faq') }}">Security FAQ</a>
                        <a href="{{ url('/privacy') }}">Privacy Policy</a>
                        <a href="{{ url('/terms') }}">Terms &amp; Conditions</a>
                        <a href="{{ url('/login') }}">Institutional Portal</a>
                    </div>
                </div>
            </div>

            <!-- Regulatory Disclaimer Card Row -->
            <div class="row mt-4 pt-2">
                <div class="col-12">
                    <div class="footer-legal-card">
                        <p class="mb-2">
                            <strong>Regulatory &amp; Trademark Notice:</strong> {{ $settings->site_name }} operates as an independent cryptographic arbitrage trading software and digital wealth management platform. All third-party product names, logos, trademarks, and registered trademarks (including Binance, Coinbase, Kraken, OKX, and others) displayed on this platform are property of their respective owners. Mention or display of such trademarks does not constitute or imply any affiliation, sponsorship, endorsement, or recommendation by their respective owners.
                        </p>
                        <p class="mb-0">
                            <strong>Risk Disclosure:</strong> Digital asset trading and algorithmic arbitrage involve substantial risk and volatility. Past performance does not guarantee future results. Capital may fluctuate; do not deposit funds you cannot afford to risk.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Bottom Bar: Copyright & Socials -->
            <div class="row">
                <div class="col-12">
                    <div class="footer-bottom-bar">
                        <small class="footer__copyright">© {{ date('Y') }} {{ $settings->site_name }}. All Rights Reserved. Protected by Multi-Layer Cryptographic Vaults.</small>
                        <div class="footer__social">
                            <a href="#" target="_blank" rel="noopener noreferrer" aria-label="X"><i class="ti ti-brand-x"></i></a>
                            <a href="#" target="_blank" rel="noopener noreferrer" aria-label="Telegram"><i class="ti ti-brand-telegram"></i></a>
                            <a href="#" target="_blank" rel="noopener noreferrer" aria-label="Discord"><i class="ti ti-brand-discord"></i></a>
                            <a href="#" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn"><i class="ti ti-brand-linkedin"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Design Screws -->
        <span class="screw screw--footer screw--footer-bl"></span>
        <span class="screw screw--footer screw--footer-br"></span>
        <span class="screw screw--footer screw--footer-tr"></span>
        <span class="screw screw--footer screw--footer-tl"></span>
    </footer>
    <!-- End Footer -->

    <!-- Back to Top / Bottom to Top Floating Button -->
    <button type="button" class="btn-scroll-top" id="scrollTopBtn" aria-label="Scroll to top" title="Back to top">
        <i class="ti ti-arrow-up"></i>
    </button>

    <!-- Core Scripts -->
    <script src="{{ asset('volkovdesign/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('volkovdesign/js/smooth-scrollbar.js') }}"></script>
    <script src="{{ asset('volkovdesign/js/splide.min.js') }}"></script>
    <script src="{{ asset('volkovdesign/js/three.min.js') }}"></script>
    <script src="{{ asset('volkovdesign/js/vanta.fog.min.js') }}"></script>
    <script src="{{ asset('volkovdesign/js/main.js') }}"></script>
    <script src="{{ asset('volkovdesign/js/glowing-3d.js') }}"></script>

    <!-- Mobile Drawer Interaction Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var mobileBtn = document.getElementById('mobileMenuBtn');
            var mobileIcon = document.getElementById('mobileMenuIcon');
            var drawerCloseBtn = document.getElementById('mobileDrawerCloseBtn');
            var overlay = document.getElementById('mobileNavOverlay');
            var nav = document.getElementById('header__nav');
            var header = document.querySelector('.header');

            function openMobileMenu() {
                if (nav) nav.classList.add('header__nav--active');
                if (overlay) overlay.classList.add('mobile-nav-overlay--active');
                document.body.classList.add('mobile-menu-open');
                if (mobileIcon) mobileIcon.className = 'ti ti-x';
                if (header) header.classList.add('header--active');
            }

            function closeMobileMenu() {
                if (nav) nav.classList.remove('header__nav--active');
                if (overlay) overlay.classList.remove('mobile-nav-overlay--active');
                document.body.classList.remove('mobile-menu-open');
                if (mobileIcon) mobileIcon.className = 'ti ti-menu-2';
                if (header) header.classList.remove('header--active');
            }

            if (mobileBtn) {
                mobileBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    if (nav && nav.classList.contains('header__nav--active')) {
                        closeMobileMenu();
                    } else {
                        openMobileMenu();
                    }
                });
            }

            if (drawerCloseBtn) {
                drawerCloseBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    closeMobileMenu();
                });
            }

            if (overlay) {
                overlay.addEventListener('click', function(e) {
                    e.stopPropagation();
                    closeMobileMenu();
                });
            }

            // Submenu Interaction (Mobile Accordion & Desktop Dropdown)
            var dropdownItems = document.querySelectorAll('.header__nav-item--dropdown');
            dropdownItems.forEach(function(item) {
                var trigger = item.querySelector('.header__nav-link--dropdown');
                if (trigger) {
                    trigger.addEventListener('click', function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        item.classList.toggle('header__nav-item--open');
                    });
                }
            });

            // Close mobile drawer ONLY when clicking genuine navigation links
            // (Excludes dropdown triggers like "About" and non-navigating anchor triggers)
            if (nav) {
                var navLinks = nav.querySelectorAll('a:not(.header__nav-link--dropdown)');
                navLinks.forEach(function(link) {
                    link.addEventListener('click', function(e) {
                        var href = link.getAttribute('href');
                        if (!href || href === '#' || href.startsWith('javascript:')) {
                            return;
                        }
                        if (window.innerWidth < 1200) {
                            closeMobileMenu();
                        }
                    });
                });
            }

            // Close dropdowns on desktop when clicking outside
            document.addEventListener('click', function(e) {
                if (window.innerWidth >= 1200) {
                    dropdownItems.forEach(function(item) {
                        if (!item.contains(e.target)) {
                            item.classList.remove('header__nav-item--open');
                        }
                    });
                }
            });

            // Theme Engine (Light / Dark / System Auto Detector)
            function initThemeEngine() {
                var mediaQuery = window.matchMedia('(prefers-color-scheme: dark)');
                var iconActive = document.getElementById('themeIconActive');
                var checkIcons = document.querySelectorAll('.theme-check-icon');

                function updateUI(setting, isDark) {
                    var mode = isDark ? 'dark' : 'light';
                    document.documentElement.setAttribute('data-theme', mode);
                    document.documentElement.setAttribute('data-theme-setting', setting);
                    if (document.body) {
                        document.body.setAttribute('data-theme', mode);
                    }
                    localStorage.setItem('ecx_theme', setting);

                    if (iconActive) {
                        if (setting === 'system') {
                            iconActive.className = isDark ? 'ti ti-device-desktop text-info' : 'ti ti-device-desktop text-primary';
                        } else if (setting === 'dark') {
                            iconActive.className = 'ti ti-moon text-info';
                        } else {
                            iconActive.className = 'ti ti-sun text-warning';
                        }
                    }

                    checkIcons.forEach(function(check) {
                        var val = check.getAttribute('data-check');
                        if (val === setting) {
                            check.classList.remove('d-none');
                        } else {
                            check.classList.add('d-none');
                        }
                    });
                }

                function applyTheme(setting) {
                    var isDark = setting === 'dark' || (setting === 'system' && mediaQuery.matches);
                    updateUI(setting, isDark);
                }

                var currentSetting = localStorage.getItem('ecx_theme') || 'system';
                applyTheme(currentSetting);

                document.querySelectorAll('.theme-option-btn').forEach(function(btn) {
                    btn.addEventListener('click', function(e) {
                        e.preventDefault();
                        var choice = this.getAttribute('data-theme-choice');
                        applyTheme(choice);
                    });
                });

                mediaQuery.addEventListener('change', function(e) {
                    if ((localStorage.getItem('ecx_theme') || 'system') === 'system') {
                        updateUI('system', e.matches);
                    }
                });
            }

            initThemeEngine();

            // Bottom to Top (Scroll to Top) Animated Interaction
            var scrollTopBtn = document.getElementById('scrollTopBtn');
            if (scrollTopBtn) {
                function checkScrollPosition() {
                    var scrolled = window.pageYOffset || 
                                   window.scrollY || 
                                   (document.documentElement ? document.documentElement.scrollTop : 0) || 
                                   (document.body ? document.body.scrollTop : 0) || 0;
                    var docH = Math.max(
                        document.documentElement ? document.documentElement.scrollHeight : 0,
                        document.body ? document.body.scrollHeight : 0
                    );
                    var winH = window.innerHeight || (document.documentElement ? document.documentElement.clientHeight : 800);
                    var nearBottom = (scrolled + winH) >= (docH - 80);

                    if (scrolled > 60 || (scrolled > 20 && nearBottom)) {
                        scrollTopBtn.classList.add('btn-scroll-top--visible');
                    } else {
                        scrollTopBtn.classList.remove('btn-scroll-top--visible');
                    }
                }

                checkScrollPosition();
                window.addEventListener('scroll', checkScrollPosition, { passive: true, capture: true });
                document.addEventListener('scroll', checkScrollPosition, { passive: true, capture: true });
                if (document.body) {
                    document.body.addEventListener('scroll', checkScrollPosition, { passive: true });
                }

                function animateScrollToTop(duration) {
                    var start = window.pageYOffset || 
                                window.scrollY || 
                                (document.documentElement ? document.documentElement.scrollTop : 0) || 
                                (document.body ? document.body.scrollTop : 0) || 0;
                    if (start <= 0) return;
                    var startTime = 'now' in window.performance ? performance.now() : new Date().getTime();

                    // Smooth easeInOutCubic curve for silky deceleration
                    function easeInOutCubic(t) {
                        return t < 0.5 ? 4 * t * t * t : (t - 1) * (2 * t - 2) * (2 * t - 2) + 1;
                    }

                    function scrollStep(currentTime) {
                        var elapsed = currentTime - startTime;
                        var progress = Math.min(elapsed / duration, 1);
                        var ease = easeInOutCubic(progress);
                        var currentPos = Math.round(start * (1 - ease));

                        window.scrollTo(0, currentPos);
                        if (document.documentElement) document.documentElement.scrollTop = currentPos;
                        if (document.body) document.body.scrollTop = currentPos;

                        if (progress < 1) {
                            window.requestAnimationFrame(scrollStep);
                        } else {
                            window.scrollTo(0, 0);
                            if (document.documentElement) document.documentElement.scrollTop = 0;
                            if (document.body) document.body.scrollTop = 0;
                            checkScrollPosition();
                        }
                    }

                    window.requestAnimationFrame(scrollStep);
                }

                scrollTopBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    animateScrollToTop(550);
                });
            }
        });
    </script>

    @yield('scripts')
</body>
</html>
