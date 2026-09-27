<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $settings->site_name ?? 'ECX Groups' }} - @yield('title', $settings->site_title ?? 'Professional Crypto Investment Platform')</title>
    <meta name="description" content="{{ $settings->description ?? 'Secure, fast, and reliable institutional trading and crypto investment solutions.' }}">
    <meta name="keywords" content="{{ $settings->keywords ?? 'Crypto, Forex, Stocks, Trading, Investment, Arbitrage' }}">
    <meta name="author" content="{{ $settings->site_name ?? 'ECX Groups' }}">

    <!-- Open Graph -->
    <meta property="og:title" content="{{ $settings->site_name ?? 'ECX Groups' }} - {{ $settings->site_title ?? 'Investment Platform' }}">
    <meta property="og:site_name" content="{{ $settings->site_name ?? 'ECX Groups' }}">
    <meta property="og:description" content="{{ $settings->description ?? 'Welcome to ECX Groups, the premier cryptocurrency and investment management platform.' }}">
    <meta property="og:type" content="website">

    <!-- Favicon -->
    @if(!empty($settings->favicon))
        <link rel="shortcut icon" href="{{ asset('storage/app/public/' . $settings->favicon) }}" type="image/x-icon">
        <link rel="apple-touch-icon" href="{{ asset('storage/app/public/' . $settings->favicon) }}">
    @else
        <link rel="shortcut icon" href="{{ asset('themes/ecx/assets/images/favicon.png') }}" type="image/x-icon">
    @endif

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('themes/ecx/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/ecx/assets/css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/ecx/assets/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/ecx/assets/css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/ecx/assets/css/style.css') }}?v={{ time() }}">

    <style>
        /* Unified Canvas Background */
        body.home-4 {
            background-color: #070b14 !important;
            color: #94a3b8;
            overflow-x: hidden;
        }

        /* Breadcrumb Divider & Item Clean Styling */
        .breadcrumb-item + .breadcrumb-item::before {
            content: var(--bs-breadcrumb-divider, "/") !important;
            color: #64748b !important;
            padding-right: 0.5rem;
            padding-left: 0.5rem;
        }

        /* Institutional Footer Styling */
        .ecx-footer {
            background: linear-gradient(180deg, #070b14 0%, #050810 100%) !important;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            position: relative;
            overflow: hidden;
        }
        .ecx-footer-title {
            color: #ffffff;
            font-size: 15px;
            font-weight: 700;
            margin-bottom: 22px;
            letter-spacing: 0.5px;
            position: relative;
            display: inline-block;
        }
        .ecx-footer-title::after {
            content: '';
            position: absolute;
            bottom: -6px;
            left: 0;
            width: 28px;
            height: 2px;
            background: #00f59b;
            border-radius: 2px;
        }
        .ecx-footer-links {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .ecx-footer-links li {
            margin-bottom: 11px;
        }
        .ecx-footer-links a {
            color: #94a3b8;
            font-size: 13.5px;
            text-decoration: none;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .ecx-footer-links a:hover {
            color: #00f59b;
            transform: translateX(4px);
        }
        .ecx-social-btn {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #94a3b8;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            transition: all 0.25s ease;
            text-decoration: none;
        }
        .ecx-social-btn:hover {
            background: rgba(0, 245, 155, 0.15);
            border-color: #00f59b;
            color: #00f59b;
            transform: translateY(-3px);
            box-shadow: 0 4px 15px rgba(0, 245, 155, 0.2);
        }
        .ecx-trust-badge-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px 12px;
            border-radius: 6px;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.08);
            font-size: 11px;
            color: #cbd5e1;
            font-weight: 600;
        }
        .ecx-footer-status-box {
            background: rgba(0, 245, 155, 0.04);
            border: 1px solid rgba(0, 245, 155, 0.2);
            border-radius: 12px;
            padding: 14px 18px;
        }

        /* Unified Inner Page Header */
        .page-header {
            padding: 155px 0 65px;
            position: relative;
            background: linear-gradient(180deg, rgba(7, 11, 20, 0.82) 0%, rgba(7, 11, 20, 0.96) 75%, #070b14 100%), url({{ asset('themes/ecx/assets/images/header/1.png') }}) center/cover no-repeat;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            overflow: hidden;
        }
        .page-header::before {
            content: '';
            position: absolute;
            top: -60px;
            right: 12%;
            width: 480px;
            height: 480px;
            background: radial-gradient(circle, rgba(0, 245, 155, 0.12) 0%, transparent 70%);
            filter: blur(55px);
            pointer-events: none;
        }
        .page-header h2 {
            font-size: 38px;
            font-weight: 800;
            color: #ffffff;
            letter-spacing: -0.5px;
            margin-bottom: 12px;
        }
        .page-header .breadcrumb {
            background: transparent;
            padding: 0;
            margin: 0;
        }
        .page-header .breadcrumb-item,
        .page-header .breadcrumb-item a {
            color: #94a3b8;
            font-size: 14px;
            text-decoration: none;
            transition: color 0.2s ease;
        }
        .page-header .breadcrumb-item a:hover {
            color: #00f59b;
        }
        .page-header .breadcrumb-item.active {
            color: #00f59b;
            font-weight: 600;
        }

        /* Glassmorphic Container & Form Styles */
        .ecx-glass-card {
            background: rgba(13, 22, 42, 0.65);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border: 1px solid rgba(255, 255, 255, 0.07);
            border-radius: 18px;
            padding: 30px;
            transition: all 0.3s ease;
        }
        .ecx-glass-card:hover {
            border-color: rgba(0, 245, 155, 0.25);
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.4);
        }
        .form-control.ecx-input,
        .ecx-form-input {
            background: rgba(13, 22, 42, 0.7) !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            color: #ffffff !important;
            border-radius: 10px !important;
            padding: 12px 18px !important;
            font-size: 14px !important;
            transition: all 0.2s ease;
        }
        .form-control.ecx-input:focus,
        .ecx-form-input:focus {
            border-color: #00f59b !important;
            box-shadow: 0 0 15px rgba(0, 245, 155, 0.2) !important;
            background: rgba(13, 22, 42, 0.9) !important;
        }
    </style>

    @yield('styles')
</head>

<body class="home-4">

    <!-- Preloader -->
    <div class="preloader">
        @if(!empty($settings->favicon))
            <img src="{{ asset('storage/app/public/' . $settings->favicon) }}" alt="preloader icon" style="max-height: 60px;">
        @else
            <img src="{{ asset('themes/ecx/assets/images/logo/preloader.png') }}" alt="preloader icon">
        @endif
    </div>

    <!-- Header Section -->
    <header class="header-section header-section--style4">
        <div class="header-bottom">
            <div class="container">
                <div class="header-wrapper">
                    <div class="logo">
                        <a href="{{ route('home') }}">
                            @if(!empty($settings->logo))
                                <img src="{{ asset('storage/app/public/' . $settings->logo) }}" alt="{{ $settings->site_name }}" style="max-height: 48px; object-fit: contain;">
                            @else
                                <img src="{{ asset('themes/ecx/assets/images/logo/logo-dark.png') }}" alt="{{ $settings->site_name ?? 'ECX Groups' }}" style="max-height: 48px;">
                            @endif
                        </a>
                    </div>
                    <div class="menu-area">
                        <ul class="menu menu--style2">
                            <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
                            <li><a href="{{ route('services') }}" class="{{ request()->routeIs('services') ? 'active' : '' }}">Services</a></li>
                            <li><a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About</a></li>
                            <li><a href="{{ route('faq') }}" class="{{ request()->routeIs('faq') ? 'active' : '' }}">FAQs</a></li>
                            <li><a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">Contact Us</a></li>
                            @auth
                                <li><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                            @else
                                <li><a href="{{ route('login') }}">Login</a></li>
                            @endauth
                        </ul>
                    </div>
                    <div class="header-action">
                        <div class="menu-area">
                            <div class="header-btn">
                                @auth
                                    <a href="{{ url('/dashboard') }}" class="trk-btn trk-btn--border trk-btn--primary">
                                        <span>Dashboard</span>
                                    </a>
                                @else
                                    <a href="{{ route('register') }}" class="trk-btn trk-btn--border trk-btn--primary">
                                        <span>Get Started</span>
                                    </a>
                                @endauth
                            </div>

                            <!-- Mobile Toggle -->
                            <div class="header-bar d-lg-none header-bar--style2">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Page Content -->
    @yield('content')

    <!-- ===============>> Pre-Footer Floating Newsletter / Advisory Card <<================= -->
    <div class="container" style="margin-bottom: -50px; position: relative; z-index: 10;">
        <div class="p-4 p-md-5 rounded-4 shadow-lg" style="background: rgba(13, 22, 42, 0.96); border: 1px solid rgba(0, 245, 155, 0.28); backdrop-filter: blur(20px); box-shadow: 0 20px 50px rgba(0,0,0,0.55);">
            <div class="row g-4 align-items-center justify-content-between">
                <div class="col-lg-7">
                    <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill mb-2" style="background: rgba(0, 245, 155, 0.1); border: 1px solid rgba(0, 245, 155, 0.25);">
                        <span style="width: 7px; height: 7px; background: #00f59b; border-radius: 50%; box-shadow: 0 0 8px #00f59b; display: inline-block;"></span>
                        <span class="f-11 f-w-700 text-uppercase" style="color: #00f59b; letter-spacing: 1px;">Institutional Intelligence Desk</span>
                    </div>
                    <h3 class="text-white f-w-800 mb-2">Automated Yield &amp; Market Intelligence</h3>
                    <p class="text-muted f-13 mb-0">Join over 25+ verified traders receiving daily arbitrage updates, APY performance reports, and reserve audit snapshots.</p>
                </div>
                <div class="col-lg-5">
                    <form onsubmit="event.preventDefault(); alert('Subscribed successfully to institutional market updates!');" class="d-flex flex-column flex-sm-row gap-2">
                        <input type="email" placeholder="Enter your business email" required class="form-control" style="background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.12); color: #fff; border-radius: 10px; padding: 12px 18px; font-size: 13px;">
                        <button type="submit" class="trk-btn trk-btn--primary px-4 py-2.5 flex-shrink-0 text-nowrap" style="border-radius: 10px; font-weight: 700; font-size: 13px;">
                            Subscribe &rarr;
                        </button>
                    </form>
                    <div class="f-11 text-muted mt-2 d-flex align-items-center gap-2">
                        <i class="fa-solid fa-lock text-success"></i> 100% Non-Custodial &amp; Zero Spam Guarantee.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ===============>> State-of-the-Art Institutional Footer <<================= -->
    <footer class="footer ecx-footer" style="padding-top: 100px; padding-bottom: 30px;">
        <div class="container">
            <div class="row g-4 justify-content-between mb-5">
                <!-- Column 1: Brand & Trust -->
                <div class="col-xl-4 col-lg-4 col-md-12">
                    <a href="{{ route('home') }}" class="mb-3 d-inline-block">
                        @if(!empty($settings->logo))
                            <img src="{{ asset('storage/app/public/' . $settings->logo) }}" alt="{{ $settings->site_name }}" style="max-height: 46px; object-fit: contain;">
                        @else
                            <img src="{{ asset('themes/ecx/assets/images/logo/logo-dark.png') }}" alt="{{ $settings->site_name ?? 'ECX Groups' }}" style="max-height: 46px;">
                        @endif
                    </a>
                    <p class="text-muted f-13 mb-4" style="line-height: 1.8;">
                        {{ $settings->description ?? 'Institutional digital asset algorithmic trading and asset management. Regulated arbitrage, non-custodial custody, and automated daily distributions.' }}
                    </p>
                    
                    <!-- Trust Badges -->
                    <div class="d-flex flex-wrap gap-2 mb-3">
                        <span class="ecx-trust-badge-pill">
                            <i class="fa-solid fa-shield-halved text-success"></i> AES-256 Bit SSL
                        </span>
                        <span class="ecx-trust-badge-pill">
                            <i class="fa-solid fa-vault text-warning"></i> Multi-Sig Cold Vaults
                        </span>
                        <span class="ecx-trust-badge-pill">
                            <i class="fa-solid fa-scale-balanced text-info"></i> 1:1 Audited Reserves
                        </span>
                    </div>
                </div>

                <!-- Column 2: Investment Solutions -->
                <div class="col-xl-2 col-lg-2 col-sm-6 col-6">
                    <div class="ecx-footer-title">Investment Plans</div>
                    <ul class="ecx-footer-links">
                        <li><a href="{{ route('home') }}#plans"><i class="fa-solid fa-chevron-right f-10 text-success"></i> Bronze Tier ($100+)</a></li>
                        <li><a href="{{ route('home') }}#plans"><i class="fa-solid fa-chevron-right f-10 text-success"></i> Silver Tier ($5K+)</a></li>
                        <li><a href="{{ route('home') }}#plans"><i class="fa-solid fa-chevron-right f-10 text-success"></i> Gold Tier ($25K+)</a></li>
                        <li><a href="{{ route('home') }}#plans"><i class="fa-solid fa-chevron-right f-10 text-success"></i> Diamond Tier ($75K+)</a></li>
                        <li><a href="{{ route('home') }}#calculator"><i class="fa-solid fa-calculator f-10 text-warning"></i> ROI Calculator</a></li>
                    </ul>
                </div>

                <!-- Column 3: Platform & Legal -->
                <div class="col-xl-2 col-lg-2 col-sm-6 col-6">
                    <div class="ecx-footer-title">Platform &amp; Legal</div>
                    <ul class="ecx-footer-links">
                        <li><a href="{{ route('about') }}">About Us</a></li>
                        <li><a href="{{ route('services') }}">Services &amp; Engine</a></li>
                        <li><a href="{{ route('faq') }}">FAQ Knowledgebase</a></li>
                        <li><a href="{{ route('terms') }}">Terms of Service</a></li>
                        <li><a href="{{ route('privacy') }}">Privacy Policy</a></li>
                    </ul>
                </div>

                <!-- Column 4: Global Desk & Infrastructure Status -->
                <div class="col-xl-4 col-lg-4 col-md-12">
                    <div class="ecx-footer-title">Global Desk &amp; Status</div>
                    
                    <div class="d-flex flex-column gap-2 mb-3 f-13">
                        @if(!empty($settings->location ?? $settings->address))
                            <div class="d-flex align-items-center gap-2 text-muted">
                                <i class="fa-solid fa-location-dot text-success"></i>
                                <span>{{ $settings->location ?? $settings->address }}</span>
                            </div>
                        @endif
                        @if(!empty($settings->contact_email))
                            <div class="d-flex align-items-center gap-2 text-muted">
                                <i class="fa-solid fa-envelope text-success"></i>
                                <a href="mailto:{{ $settings->contact_email }}" class="text-white text-opacity-80 text-decoration-none">{{ $settings->contact_email }}</a>
                            </div>
                        @endif
                        @if(!empty($settings->phone))
                            <div class="d-flex align-items-center gap-2 text-muted">
                                <i class="fa-solid fa-phone text-success"></i>
                                <span class="text-white text-opacity-80">{{ $settings->phone }}</span>
                            </div>
                        @endif
                    </div>

                    <!-- Live System Status Card -->
                    <div class="ecx-footer-status-box">
                        <div class="d-flex align-items-center justify-content-between mb-1">
                            <div class="d-flex align-items-center gap-2">
                                <span style="width: 8px; height: 8px; background: #00f59b; border-radius: 50%; box-shadow: 0 0 8px #00f59b; display: inline-block;"></span>
                                <span class="f-12 f-w-700 text-white">All Systems Operational</span>
                            </div>
                            <span class="badge bg-success bg-opacity-20 text-success border border-success border-opacity-30 f-10">99.98%</span>
                        </div>
                        <div class="f-11 text-muted">High-frequency AI arbitrage &amp; daily treasury drops active.</div>
                    </div>
                </div>
            </div>

            <!-- Risk Warning Box -->
            <div class="p-3 rounded-3 mb-4" style="background: rgba(255, 255, 255, 0.02); border: 1px solid rgba(255, 255, 255, 0.05);">
                <p class="text-muted f-11 mb-0" style="line-height: 1.7;">
                    <strong>Risk Warning:</strong> Digital asset trading and algorithmic arbitrage yield generation involve substantial risk of volatility and may not be suitable for all investors. Capital allocated into algorithmic strategies is protected by smart-contract treasury reserves. Past performance does not guarantee future results.
                </p>
            </div>

            <!-- Footer Bottom Bar -->
            <div class="pt-4 d-flex flex-column flex-md-row justify-content-between align-items-center gap-3" style="border-top: 1px solid rgba(255, 255, 255, 0.06);">
                <div class="f-12 text-muted">
                    &copy; {{ date('Y') }} {{ $settings->site_name ?? 'ECX Groups' }}. All rights reserved.
                </div>

                <!-- Social Links -->
                <div class="d-flex align-items-center gap-2">
                    <a href="#" class="ecx-social-btn" title="Twitter"><i class="fa-brands fa-x-twitter"></i></a>
                    <a href="#" class="ecx-social-btn" title="Telegram"><i class="fa-brands fa-telegram"></i></a>
                    <a href="#" class="ecx-social-btn" title="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
                    <a href="#" class="ecx-social-btn" title="Instagram"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#" class="ecx-social-btn" title="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                </div>

                <!-- Quick Policy Links -->
                <div class="d-flex align-items-center gap-3 f-12 text-muted">
                    <a href="{{ route('terms') }}" class="text-muted text-decoration-none hover-white">Terms</a>
                    <span>&bull;</span>
                    <a href="{{ route('privacy') }}" class="text-muted text-decoration-none hover-white">Privacy</a>
                    <span>&bull;</span>
                    <a href="{{ route('faq') }}" class="text-muted text-decoration-none hover-white">FAQ</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scroll to Top -->
    <a href="javascript:void(0)" onclick="window.scrollTo({top: 0, behavior: 'smooth'}); return false;" class="scrollToTop scrollToTop--style1" aria-label="Scroll to top"><i class="fa-solid fa-arrow-up"></i></a>

    <!-- Scripts -->
    <script src="{{ asset('themes/ecx/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('themes/ecx/assets/js/all.min.js') }}"></script>
    <script src="{{ asset('themes/ecx/assets/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('themes/ecx/assets/js/aos.js') }}"></script>
    <script src="{{ asset('themes/ecx/assets/js/fslightbox.js') }}"></script>
    <script src="{{ asset('themes/ecx/assets/js/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('themes/ecx/assets/js/custom.js') }}"></script>

    @yield('scripts')
</body>
</html>
