<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex, nofollow, noarchive, nosnippet, noimageindex">
    <meta name="googlebot" content="noindex, nofollow, noarchive, nosnippet, noimageindex">
    <title>{{ $settings->site_name }} | @yield('title', 'Dashboard')</title>
    <link rel="icon" href="{{ asset('storage/app/public/' . $settings->favicon) }}" type="image/png" />

    <!-- Google font (Nunito Sans) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:opsz,wght@6..12,200;6..12,300;6..12,400;6..12,500;6..12,600;6..12,700;6..12,800;6..12,900;6..12,1000&display=swap" rel="stylesheet">

    <!-- Flag icon css -->
    <link rel="stylesheet" href="{{ asset('admiro/assets/css/vendors/flag-icon.css') }}">
    <!-- Iconly and Themify icons -->
    <link rel="stylesheet" href="{{ asset('admiro/assets/css/iconly-icon.css') }}">
    <link rel="stylesheet" href="{{ asset('admiro/assets/css/bulk-style.css') }}">
    <link rel="stylesheet" href="{{ asset('admiro/assets/css/themify.css') }}">
    <!-- Scrollbar css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('admiro/assets/css/vendors/scrollbar.css') }}">
    <!-- Admiro Main App css -->
    <link rel="stylesheet" href="{{ asset('admiro/assets/css/style.css') }}">

    <!-- FontAwesome 6 Free (Full Official CDN loaded AFTER Admiro style so all FA6 icons render reliably) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- DataTables & Select2 & SweetAlert -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.5/b-2.2.2/r-2.2.9/datatables.min.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- Admiro Theme Custom Accent & Dark Mode Early Initialization -->
    <style id="admiro-theme-vars">
        /* Bulletproof FontAwesome 6 Rendering */
        .fa, .fas, .fa-solid {
            font-family: "Font Awesome 6 Free" !important;
            font-weight: 900 !important;
            display: inline-block;
        }
        .far, .fa-regular {
            font-family: "Font Awesome 6 Free" !important;
            font-weight: 400 !important;
            display: inline-block;
        }
        .fab, .fa-brands {
            font-family: "Font Awesome 6 Brands" !important;
            font-weight: 400 !important;
            display: inline-block;
        }

        /* Subtle Badge & Pill styling with high contrast in both light & dark mode */
        .badge-subtle-neutral {
            background-color: #f1f5f9 !important;
            color: #334155 !important;
            border: 1px solid #e2e8f0 !important;
        }
        body.dark-only .badge-subtle-neutral {
            background-color: #222736 !important;
            color: #cbd5e1 !important;
            border-color: #334155 !important;
        }

        /* Metric card icon containers with rich, high-contrast tinted circles */
        .metric-icon-circle {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
            flex-shrink: 0;
            transition: all 0.2s ease;
        }
        .metric-icon-circle.primary {
            background: rgba(99, 98, 231, 0.12) !important;
            color: #6362e7 !important;
            border: 1px solid rgba(99, 98, 231, 0.25) !important;
        }
        .metric-icon-circle.success {
            background: rgba(16, 185, 129, 0.12) !important;
            color: #10b981 !important;
            border: 1px solid rgba(16, 185, 129, 0.25) !important;
        }
        .metric-icon-circle.info {
            background: rgba(14, 165, 233, 0.12) !important;
            color: #0284c7 !important;
            border: 1px solid rgba(14, 165, 233, 0.25) !important;
        }
        .metric-icon-circle.warning {
            background: rgba(245, 158, 11, 0.12) !important;
            color: #d97706 !important;
            border: 1px solid rgba(245, 158, 11, 0.25) !important;
        }
        body.dark-only .metric-icon-circle.primary {
            background: rgba(99, 98, 231, 0.25) !important;
            color: #a5b4fc !important;
            border-color: rgba(99, 98, 231, 0.4) !important;
        }
        body.dark-only .metric-icon-circle.success {
            background: rgba(16, 185, 129, 0.25) !important;
            color: #6ee7b7 !important;
            border-color: rgba(16, 185, 129, 0.4) !important;
        }
        body.dark-only .metric-icon-circle.info {
            background: rgba(14, 165, 233, 0.25) !important;
            color: #7dd3fc !important;
            border-color: rgba(14, 165, 233, 0.4) !important;
        }
        body.dark-only .metric-icon-circle.warning {
            background: rgba(245, 158, 11, 0.25) !important;
            color: #fcd34d !important;
            border-color: rgba(245, 158, 11, 0.4) !important;
        }
        @php
            $siteAccent = !empty($settings->site_accent_color) ? $settings->site_accent_color : '#D61C4E';
            $siteSecondary = !empty($settings->site_secondary_color) ? $settings->site_secondary_color : '#9F1239';
        @endphp
        :root {
            --theme-default: {{ $siteAccent }};
            --theme-primary: {{ $siteAccent }};
            --theme-secondary: {{ $siteSecondary }};
            --theme-gradient: linear-gradient(135deg, {{ $siteAccent }} 0%, {{ $siteSecondary }} 100%);
            --theme-gradient-hover: linear-gradient(135deg, {{ $siteSecondary }} 0%, {{ $siteAccent }} 100%);
        }
        html, body {
            height: 100%;
        }
        .page-wrapper {
            display: flex !important;
            flex-direction: column !important;
            min-height: 100vh !important;
        }
        .page-body-wrapper {
            display: flex !important;
            flex-direction: column !important;
            flex: 1 0 auto !important;
            min-height: calc(100vh - 70px) !important;
        }
        .page-wrapper .page-body-wrapper .page-body,
        .page-body {
            flex: 1 0 auto !important;
            min-height: auto !important;
            padding: 24px 24px 40px 24px !important;
            background-color: #f6f8fb !important;
            transition: background-color 0.3s ease !important;
        }
        body.dark-only .page-wrapper .page-body-wrapper .page-body,
        body.dark-only .page-body {
            background-color: #1a1e2b !important;
        }
        footer.footer {
            margin-top: auto !important;
            flex-shrink: 0 !important;
            background-color: #ffffff !important;
            border-top: 1px solid #e8ecf2 !important;
            padding: 16px 24px !important;
            width: 100% !important;
        }
        body.dark-only footer.footer {
            background-color: #191f2d !important;
            border-top: 1px solid #252d3d !important;
        }

        /* Desktop Sidebar Transitions & Margins */
        @media (min-width: 992px) {
            .page-wrapper.compact-wrapper:not(.sidebar-open) .page-body-wrapper {
                margin-left: 253px !important;
                transition: margin-left 0.3s ease !important;
            }
            .page-wrapper.compact-wrapper.sidebar-open .page-body-wrapper {
                margin-left: 0 !important;
                transition: margin-left 0.3s ease !important;
            }
        }

        /* Mobile Header & Content Layout (< 992px) */
        @media (max-width: 991.98px) {
            .page-wrapper .page-body-wrapper {
                margin-top: 70px !important;
            }
            .page-wrapper .page-body-wrapper .page-body,
            .page-body {
                padding: 20px 14px 40px 14px !important;
            }
            .page-header {
                position: fixed !important;
                top: 0 !important;
                left: 0 !important;
                right: 0 !important;
                z-index: 1060 !important;
                flex-wrap: nowrap !important;
                margin: 0 !important;
                padding: 0 10px !important;
            }
            .page-header .logo-wrapper {
                padding: 10px 4px !important;
                width: auto !important;
                display: flex !important;
                align-items: center !important;
                gap: 8px !important;
            }
            .page-header .logo-wrapper .close-btn {
                margin-left: 0 !important;
                flex-shrink: 0 !important;
            }
            .page-wrapper.mobile-sidebar-open #sidebar-toggle-btn {
                background-color: var(--theme-default, #6362e7) !important;
            }
            .page-wrapper.mobile-sidebar-open #sidebar-toggle-btn .svg-color {
                stroke: #ffffff !important;
            }
        }

        /* Logo Display Rules Across All Screens */
        .page-header .logo-wrapper a.header-logo-link,
        .page-header .logo-wrapper a {
            display: inline-flex !important;
            align-items: center !important;
        }
        .page-header .logo-wrapper img,
        .sidebar-mobile-header img {
            display: inline-block !important;
            max-height: 32px !important;
            max-width: 130px !important;
            width: auto !important;
            object-fit: contain !important;
        }
        @media (max-width: 991.98px) {
            .page-header .logo-wrapper img,
            .sidebar-mobile-header img {
                display: inline-block !important;
                max-height: 28px !important;
                max-width: 110px !important;
            }
        }
        @media (max-width: 420px) {
            .page-header .logo-wrapper img,
            .sidebar-mobile-header img {
                display: inline-block !important; /* Critical override for Admiro @media <= 420px display: none */
                max-height: 26px !important;
                max-width: 95px !important;
            }
        }

        /* Dark / Light Logo Switch */
        body.dark-only .page-header .logo-wrapper .dark-logo,
        body.dark-only .sidebar-mobile-header .dark-logo {
            display: none !important;
        }
        body.dark-only .page-header .logo-wrapper .light-logo,
        body.dark-only .sidebar-mobile-header .light-logo {
            display: inline-block !important;
        }
        body:not(.dark-only) .page-header .logo-wrapper .light-logo,
        body:not(.dark-only) .sidebar-mobile-header .light-logo {
            display: none !important;
        }
        body:not(.dark-only) .page-header .logo-wrapper .dark-logo,
        body:not(.dark-only) .sidebar-mobile-header .dark-logo {
            display: inline-block !important;
        }

        /* Mobile Sidebar Backdrop Overlay */
        .sidebar-backdrop {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(2px);
            z-index: 1085;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        .page-wrapper.mobile-sidebar-open .sidebar-backdrop {
            display: block !important;
            opacity: 1 !important;
        }
        body.mobile-sidebar-active {
            overflow: hidden !important;
        }
        body.dark-only .btn-close {
            filter: invert(1) grayscale(100%) brightness(200%);
        }

        /* User Topbar Live Ticker & Account Pill */
        .wb-live-ticker-pill {
            background: #ffffff;
            border: 1px solid #e8ecf2;
            border-radius: 999px;
            padding: 4px 12px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 12px;
            font-weight: 600;
        }
        body.dark-only .wb-live-ticker-pill {
            background: #222736;
            border-color: rgba(255, 255, 255, 0.1);
            color: #e2e8f0;
        }
        .wb-live-dot {
            width: 8px;
            height: 8px;
            background-color: #10b981;
            border-radius: 50%;
            box-shadow: 0 0 8px #10b981;
            animation: pulse-dot 2s infinite;
        }
        @keyframes pulse-dot {
            0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7); }
            70% { transform: scale(1); box-shadow: 0 0 0 6px rgba(16, 185, 129, 0); }
            100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
        }

        .wb-balance-header-pill {
            background: linear-gradient(180deg, rgba(99, 98, 231, 0.1) 0%, rgba(99, 98, 231, 0.03) 100%);
            border: 1px solid rgba(99, 98, 231, 0.35);
            border-radius: 10px;
            padding: 4px 16px;
            text-align: center;
        }
        body.dark-only .wb-balance-header-pill {
            background: linear-gradient(180deg, rgba(99, 98, 231, 0.2) 0%, rgba(99, 98, 231, 0.05) 100%);
            border-color: rgba(99, 98, 231, 0.4);
        }
        .wb-balance-header-title {
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: #64748b;
            font-weight: 700;
        }
        body.dark-only .wb-balance-header-title {
            color: #94a3b8;
        }
        .wb-balance-header-val {
            font-size: 16px;
            font-weight: 800;
            color: var(--theme-default, #6362e7);
        }

        /* Admiro Card Styles */
        .card {
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
            border: 1px solid rgba(0, 0, 0, 0.06);
            transition: all 0.25s ease;
        }
        body.dark-only .card {
            background-color: #222736 !important;
            border-color: rgba(255, 255, 255, 0.06) !important;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            color: #e2e8f0 !important;
        }
        body.dark-only .card .text-dark {
            color: #f8fafc !important;
        }

        /* Pill Badges in Sidebar */
        .wb-pill-badge {
            font-size: 10px;
            font-weight: 700;
            padding: 2px 7px;
            border-radius: 999px;
            line-height: 1.2;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }
        .wb-pill-badge.green {
            background: rgba(16, 185, 129, 0.15);
            color: #10b981;
            border: 1px solid rgba(16, 185, 129, 0.3);
        }
        .wb-pill-badge.red {
            background: rgba(239, 68, 68, 0.15);
            color: #ef4444;
            border: 1px solid rgba(239, 68, 68, 0.3);
        }
        .wb-pill-badge.purple {
            background: rgba(139, 92, 246, 0.18);
            color: #8b5cf6;
            border: 1px solid rgba(139, 92, 246, 0.3);
        }
        .wb-pill-badge.blue {
            background: rgba(59, 130, 246, 0.18);
            color: #3b82f6;
            border: 1px solid rgba(59, 130, 246, 0.3);
        }
        .wb-pill-badge.amber {
            background: rgba(245, 158, 11, 0.18);
            color: #f59e0b;
            border: 1px solid rgba(245, 158, 11, 0.3);
        }

        /* Dropdown styling */
        #profileMenu, #quickTradeMenu, #notifMenu {
            background-color: #ffffff !important;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08) !important;
            border: 1px solid rgba(0, 0, 0, 0.06) !important;
            z-index: 1070 !important;
        }
        body.dark-only #profileMenu,
        body.dark-only #quickTradeMenu,
        body.dark-only #notifMenu {
            background-color: #222736 !important;
            border-color: rgba(255, 255, 255, 0.12) !important;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5) !important;
            color: #e2e8f0 !important;
        }

        /* ==========================================================================
           MODERN ACCOUNT SETTINGS & SECURITY CARDS (Both Light & Dark Modes)
           ========================================================================== */
        
        /* Modern Segmented Navigation Pills */
        .profile-nav-pills {
            background-color: #f1f5f9;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 6px;
            gap: 6px;
            display: flex;
            flex-wrap: wrap;
        }
        body.dark-only .profile-nav-pills {
            background-color: #171b26 !important;
            border-color: rgba(255, 255, 255, 0.08) !important;
        }
        .profile-nav-pills .nav-item {
            margin: 0;
        }
        .profile-nav-pills .nav-link {
            border-radius: 10px !important;
            font-size: 13.5px !important;
            font-weight: 600 !important;
            color: #475569 !important;
            padding: 10px 18px !important;
            display: inline-flex !important;
            align-items: center !important;
            gap: 8px !important;
            border: none !important;
            background: transparent !important;
            transition: all 0.2s ease !important;
            cursor: pointer !important;
        }
        body.dark-only .profile-nav-pills .nav-link {
            color: #94a3b8 !important;
        }
        .profile-nav-pills .nav-link:hover {
            color: #0f172a !important;
            background: rgba(0, 0, 0, 0.04) !important;
        }
        body.dark-only .profile-nav-pills .nav-link:hover {
            color: #f8fafc !important;
            background: rgba(255, 255, 255, 0.05) !important;
        }
        .profile-nav-pills .nav-link.active {
            background: linear-gradient(135deg, #2563eb 0%, #4f46e5 100%) !important;
            color: #ffffff !important;
            box-shadow: 0 4px 14px rgba(37, 99, 235, 0.35) !important;
        }
        body.dark-only .profile-nav-pills .nav-link.active {
            background: linear-gradient(135deg, #3b82f6 0%, #6366f1 100%) !important;
            color: #ffffff !important;
            box-shadow: 0 4px 16px rgba(59, 130, 246, 0.4) !important;
        }

        /* Form Controls in Account Settings */
        .form-label-custom {
            font-size: 12.5px !important;
            font-weight: 700 !important;
            text-transform: uppercase !important;
            letter-spacing: 0.5px !important;
            color: #64748b !important;
            margin-bottom: 8px !important;
            display: block !important;
        }
        body.dark-only .form-label-custom {
            color: #94a3b8 !important;
        }

        .input-group-custom {
            position: relative;
        }
        .input-group-custom .input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 14px;
            pointer-events: none;
            z-index: 4;
        }
        .input-group-custom .form-control-custom {
            padding-left: 42px !important;
        }

        .form-control-custom {
            height: 48px;
            border-radius: 12px !important;
            border: 1px solid #cbd5e1 !important;
            background-color: #ffffff !important;
            color: #0f172a !important;
            font-size: 14px !important;
            font-weight: 500 !important;
            transition: all 0.2s ease !important;
            padding: 10px 16px;
        }
        body.dark-only .form-control-custom {
            background-color: #171b26 !important;
            border-color: rgba(255, 255, 255, 0.12) !important;
            color: #f8fafc !important;
        }
        .form-control-custom:focus {
            border-color: #3b82f6 !important;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2) !important;
            outline: none !important;
        }
        .form-control-custom[readonly] {
            background-color: #f8fafc !important;
            color: #64748b !important;
            border-color: #e2e8f0 !important;
            cursor: not-allowed !important;
        }
        body.dark-only .form-control-custom[readonly] {
            background-color: rgba(255, 255, 255, 0.03) !important;
            color: #94a3b8 !important;
            border-color: rgba(255, 255, 255, 0.06) !important;
        }

        textarea.form-control-custom {
            height: auto !important;
            min-height: 90px !important;
            padding-left: 16px !important;
        }

        /* Settings Sub-Cards (Withdrawals, Preferences, etc.) */
        .settings-subcard {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 24px;
            margin-bottom: 24px;
            box-shadow: 0 2px 10px rgba(15, 23, 42, 0.02);
            transition: all 0.2s ease;
        }
        body.dark-only .settings-subcard {
            background: #171b26 !important;
            border-color: rgba(255, 255, 255, 0.08) !important;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2) !important;
        }
        .settings-subcard-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
            padding-bottom: 14px;
            border-bottom: 1px solid #f1f5f9;
        }
        body.dark-only .settings-subcard-header {
            border-bottom-color: rgba(255, 255, 255, 0.06) !important;
        }
        .settings-subcard-title {
            font-size: 15px;
            font-weight: 700;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* Select Group / Pill Radios */
        .custom-radio-card {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px;
            border-radius: 12px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            margin-bottom: 14px;
            transition: all 0.2s ease;
        }
        body.dark-only .custom-radio-card {
            background: #171b26;
            border-color: rgba(255, 255, 255, 0.08);
        }
        .custom-radio-card:hover {
            border-color: #3b82f6;
        }

        /* Institutional Security Cards (profile/show.blade.php) */
        .security-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 28px;
            margin-bottom: 24px;
            box-shadow: 0 4px 16px rgba(15, 23, 42, 0.03);
            text-align: left !important;
            transition: all 0.2s ease;
        }
        body.dark-only .security-card {
            background: #222736 !important;
            border-color: rgba(255, 255, 255, 0.08) !important;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.35) !important;
        }
        .security-card.danger-zone {
            border-color: rgba(239, 68, 68, 0.35) !important;
            background: rgba(239, 68, 68, 0.02) !important;
        }
        body.dark-only .security-card.danger-zone {
            border-color: rgba(239, 68, 68, 0.35) !important;
            background: rgba(239, 68, 68, 0.03) !important;
        }
        .security-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
            flex-wrap: wrap;
            gap: 12px;
        }
        .security-card-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            flex-shrink: 0;
        }
        .security-card-title {
            font-size: 18px;
            font-weight: 800;
            margin-bottom: 4px;
            letter-spacing: -0.2px;
        }
        .security-card-desc {
            font-size: 13.5px;
            line-height: 1.6;
            color: #64748b;
            margin-bottom: 20px;
        }
        body.dark-only .security-card-desc {
            color: #94a3b8;
        }

        .session-device-row {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 16px;
            border-radius: 12px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            margin-bottom: 16px;
        }
        body.dark-only .session-device-row {
            background: #171b26;
            border-color: rgba(255, 255, 255, 0.08);
        }

        /* Jetstream Modal styling in dash layout */
        [x-cloak],
        .jetstream-modal[style*="display: none"],
        .jetstream-modal[style*="display:none"],
        .jetstream-modal [style*="display: none"],
        .jetstream-modal [style*="display:none"] {
            display: none !important;
        }

        .jetstream-modal {
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            right: 0 !important;
            bottom: 0 !important;
            z-index: 9999 !important;
            padding: 20px !important;
            overflow-y: auto !important;
        }

        .jetstream-modal:not([style*="display: none"]):not([style*="display:none"]) {
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
        }

        .jetstream-modal > div:last-child {
            background: #ffffff !important;
            color: #1e293b !important;
            border-radius: 16px !important;
            max-width: 520px !important;
            width: 100% !important;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3) !important;
            border: 1px solid #e2e8f0 !important;
            overflow: hidden !important;
            position: relative !important;
            z-index: 10000 !important;
            margin: auto !important;
        }
        body.dark-only .jetstream-modal > div:last-child {
            background: #222736 !important;
            color: #f8fafc !important;
            border-color: rgba(255, 255, 255, 0.12) !important;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.6) !important;
        }
        .jetstream-modal .bg-gray-100 {
            background-color: #f8fafc !important;
            border-top: 1px solid #e2e8f0 !important;
        }
        body.dark-only .jetstream-modal .bg-gray-100 {
            background-color: #1a1e2b !important;
            border-top-color: rgba(255, 255, 255, 0.08) !important;
        }
        .jetstream-modal .bg-gray-500 {
            background-color: rgba(15, 23, 42, 0.75) !important;
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            right: 0 !important;
            bottom: 0 !important;
            backdrop-filter: blur(4px) !important;
        }

        /* Ensure Bootstrap Modals sit above mobile fixed header (z-index: 1060) */
        .modal {
            z-index: 1075 !important;
        }
        .modal-backdrop {
            z-index: 1070 !important;
        }

        /* Subtle Badges for Bootstrap 5 in Dash */
        .bg-primary-subtle {
            background-color: rgba(99, 98, 231, 0.12) !important;
        }
        .border-primary-subtle {
            border-color: rgba(99, 98, 231, 0.25) !important;
        }
        .text-primary {
            color: #6362e7 !important;
        }
        .bg-success-subtle {
            background-color: rgba(16, 185, 129, 0.12) !important;
        }
        .border-success-subtle {
            border-color: rgba(16, 185, 129, 0.25) !important;
        }
        .text-success {
            color: #10b981 !important;
        }
        .bg-warning-subtle {
            background-color: rgba(245, 158, 11, 0.12) !important;
        }
        .border-warning-subtle {
            border-color: rgba(245, 158, 11, 0.25) !important;
        }
        .text-warning {
            color: #d97706 !important;
        }
        body.dark-only .text-warning {
            color: #fcd34d !important;
        }
        .bg-info-subtle {
            background-color: rgba(14, 165, 233, 0.12) !important;
        }
        .border-info-subtle {
            border-color: rgba(14, 165, 233, 0.25) !important;
        }
        .text-info {
            color: #0284c7 !important;
        }
        body.dark-only .text-info {
            color: #38bdf8 !important;
        }
        .bg-danger-subtle {
            background-color: rgba(239, 68, 68, 0.12) !important;
        }
        .border-danger-subtle {
            border-color: rgba(239, 68, 68, 0.25) !important;
        }
        .text-danger {
            color: #ef4444 !important;
        }
        .bg-secondary-subtle {
            background-color: rgba(100, 116, 139, 0.12) !important;
        }
        .border-secondary-subtle {
            border-color: rgba(100, 116, 139, 0.25) !important;
        }
        .text-secondary {
            color: #64748b !important;
        }
        body.dark-only .text-secondary {
            color: #94a3b8 !important;
        }
    </style>

    <script>
        (function() {
            function getPreferredTheme() {
                var userOverride = localStorage.getItem('mode_user_override');
                if (userOverride === 'true') {
                    var saved = localStorage.getItem('mode');
                    if (saved === 'dark-only' || saved === 'light') {
                        return saved;
                    }
                }
                var prefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
                return prefersDark ? 'dark-only' : 'light';
            }
            var theme = getPreferredTheme();
            if (theme === 'dark-only') {
                document.documentElement.classList.add('dark-only');
            } else {
                document.documentElement.classList.remove('dark-only');
            }
            var dbAccent = "{{ $siteAccent }}";
            var dbSecondary = "{{ $siteSecondary }}";
            document.documentElement.style.setProperty('--theme-default', dbAccent);
            document.documentElement.style.setProperty('--theme-primary', dbAccent);
            document.documentElement.style.setProperty('--theme-secondary', dbSecondary);
            document.documentElement.style.setProperty('--theme-gradient', 'linear-gradient(135deg, ' + dbAccent + ' 0%, ' + dbSecondary + ' 100%)');
            document.documentElement.style.setProperty('--theme-gradient-hover', 'linear-gradient(135deg, ' + dbSecondary + ' 0%, ' + dbAccent + ' 100%)');
        })();
    </script>

    @section('styles')
    @show
    @livewireStyles
    <!-- Alpine.js for Jetstream Modals and Interactivity -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
</head>

<body>
    <script>
        (function() {
            function getPreferredTheme() {
                var userOverride = localStorage.getItem('mode_user_override');
                if (userOverride === 'true') {
                    var saved = localStorage.getItem('mode');
                    if (saved === 'dark-only' || saved === 'light') {
                        return saved;
                    }
                }
                var prefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
                return prefersDark ? 'dark-only' : 'light';
            }
            var theme = getPreferredTheme();
            if (theme === 'dark-only') {
                document.body.classList.add('dark-only');
                document.body.classList.remove('light');
            } else {
                document.body.classList.add('light');
                document.body.classList.remove('dark-only');
            }
        })();
    </script>

    <!-- Page Wrapper Start -->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        <!-- Admiro User Top Header -->
        @include('user.topmenu', ['from_layout' => true])

        <!-- Page Body Wrapper Start -->
        <div class="page-body-wrapper">
            <!-- Admiro User Sidebar -->
            @include('user.sidebar', ['from_layout' => true])

            <!-- Mobile Sidebar Backdrop Overlay -->
            <div class="sidebar-backdrop" id="sidebarBackdrop"></div>

            <!-- Page Body Content -->
            <div class="page-body">
                <x-danger-alert />
                <x-success-alert />

                @yield('content')
            </div>

            <!-- Admiro Footer -->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-md-6 footer-copyright">
                            <p class="mb-0 text-muted f-13">All Rights Reserved &copy; {{ $settings->site_name }} {{ date('Y') }}</p>
                        </div>
                        <div class="col-md-6 text-md-end text-center">
                            @if ($settings->google_translate == 'on')
                                <div id="google_translate_element"></div>
                            @endif
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <!-- Page Body Wrapper End -->
    </div>
    <!-- Global Trading Clearance Modal -->
    @include('user.components.trading_clearance_modal')

    <!-- Core Scripts -->
    <script src="{{ asset('admiro/assets/js/vendors/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admiro/assets/js/vendors/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admiro/assets/js/vendors/feather-icon/feather.min.js') }}"></script>
    <script src="{{ asset('admiro/assets/js/vendors/feather-icon/custom-script.js') }}"></script>
    <script src="{{ asset('admiro/assets/js/sidebar.js') }}"></script>
    <script src="{{ asset('admiro/assets/js/scrollbar/simplebar.js') }}"></script>
    <script src="{{ asset('admiro/assets/js/scrollbar/custom.js') }}"></script>

    <!-- Plugins -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.5/b-2.2.2/r-2.2.9/datatables.min.js"></script>

    @if ($settings->google_translate == 'on')
        <script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
        <script type="text/javascript">
            function googleTranslateElementInit() {
                new google.translate.TranslateElement({ pageLanguage: 'en' }, 'google_translate_element');
            }
        </script>
    @endif

    <!-- Admiro Theme & Live Crypto Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Apply Theme Mode Function
            function applyTheme(isDark, isManualClick) {
                if (isDark) {
                    document.body.classList.add('dark-only');
                    document.body.classList.remove('light');
                    document.documentElement.classList.add('dark-only');
                    localStorage.setItem('mode', 'dark-only');
                } else {
                    document.body.classList.add('light');
                    document.body.classList.remove('dark-only');
                    document.documentElement.classList.remove('dark-only');
                    localStorage.setItem('mode', 'light');
                }
                if (isManualClick) {
                    localStorage.setItem('mode_user_override', 'true');
                }
            }

            // Dark / Light Mode Toggle Button
            var themeBtn = document.getElementById('themeToggleBtn');
            if (themeBtn) {
                themeBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    var currentlyDark = document.body.classList.contains('dark-only');
                    applyTheme(!currentlyDark, true);
                });
            }

            // Auto-detect dynamic system preference change:
            if (window.matchMedia) {
                var mediaQuery = window.matchMedia('(prefers-color-scheme: dark)');
                mediaQuery.addEventListener('change', function(e) {
                    // When device changes OS mode, update instantly
                    applyTheme(e.matches, false);
                });
            }

            // Mobile Responsive Sidebar Controller (< 992px)
            var pageWrapper = document.getElementById('pageWrapper');
            var sidebar = document.getElementById('pageSidebar');
            var sidebarBackdrop = document.getElementById('sidebarBackdrop');
            var toggleBtns = document.querySelectorAll('.toggle-sidebar, #sidebar-toggle-btn');
            var closeBtn = document.getElementById('sidebarCloseBtn');

            function openMobileSidebar() {
                if (pageWrapper) pageWrapper.classList.add('mobile-sidebar-open');
                document.body.classList.add('mobile-sidebar-active');
            }

            function closeMobileSidebar() {
                if (pageWrapper) pageWrapper.classList.remove('mobile-sidebar-open');
                document.body.classList.remove('mobile-sidebar-active');
            }

            function toggleMobileSidebar() {
                if (pageWrapper && pageWrapper.classList.contains('mobile-sidebar-open')) {
                    closeMobileSidebar();
                } else {
                    openMobileSidebar();
                }
            }

            toggleBtns.forEach(function(btn) {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    if (window.innerWidth < 992) {
                        toggleMobileSidebar();
                    } else {
                        if (pageWrapper) pageWrapper.classList.toggle('sidebar-open');
                    }
                });
            });

            if (closeBtn) {
                closeBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    closeMobileSidebar();
                });
            }

            if (sidebarBackdrop) {
                sidebarBackdrop.addEventListener('click', function(e) {
                    e.preventDefault();
                    closeMobileSidebar();
                });
            }

            // Close on outside click on mobile
            document.addEventListener('click', function(e) {
                if (window.innerWidth < 992 && pageWrapper && pageWrapper.classList.contains('mobile-sidebar-open')) {
                    var isInsideSidebar = sidebar && sidebar.contains(e.target);
                    var isToggleBtn = false;
                    toggleBtns.forEach(function(btn) {
                        if (btn && btn.contains(e.target)) isToggleBtn = true;
                    });
                    if (!isInsideSidebar && !isToggleBtn) {
                        closeMobileSidebar();
                    }
                }
            });

            // Close on Escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && window.innerWidth < 992) {
                    closeMobileSidebar();
                }
            });

            // Close on mobile when navigating via internal sidebar links
            if (sidebar) {
                sidebar.querySelectorAll('.sidebar-link:not([data-bs-toggle="collapse"])').forEach(function(link) {
                    link.addEventListener('click', function() {
                        if (window.innerWidth < 992) {
                            closeMobileSidebar();
                        }
                    });
                });
            }

            // Live Crypto Ticker fetcher
            function fetchCryptoPrices() {
                fetch('https://api.coingecko.com/api/v3/simple/price?ids=bitcoin,ethereum&vs_currencies=usd')
                    .then(response => response.json())
                    .then(data => {
                        if (data.bitcoin && data.bitcoin.usd) {
                            var btcElem = document.getElementById('wb-ticker-btc');
                            if (btcElem) btcElem.textContent = '$' + Number(data.bitcoin.usd).toLocaleString();
                        }
                        if (data.ethereum && data.ethereum.usd) {
                            var ethElem = document.getElementById('wb-ticker-eth');
                            if (ethElem) ethElem.textContent = '$' + Number(data.ethereum.usd).toLocaleString();
                        }
                    })
                    .catch(function() {});
            }
            // Universal Tab Bridge (Bootstrap 4 to 5)
            $(document).on('click', '[data-toggle="tab"], [data-toggle="pill"]', function(e) {
                if (!this.hasAttribute('data-bs-toggle')) {
                    e.preventDefault();
                    if (window.bootstrap && window.bootstrap.Tab) {
                        var tab = bootstrap.Tab.getOrCreateInstance(this);
                        tab.show();
                    }
                }
            });
        });
    </script>

    @section('scripts')
    @show
    @livewireScripts
</body>

</html>
