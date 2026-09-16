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
    <title>{{ $settings->site_name }} | {{ $title ?? 'Admin' }}</title>
    <link rel="icon" href="{{ asset('storage/app/public/' . $settings->favicon) }}" type="image/png" />

    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:opsz,wght@6..12,200;6..12,300;6..12,400;6..12,500;6..12,600;6..12,700;6..12,800;6..12,900;6..12,1000&display=swap" rel="stylesheet">

    <!-- Flag icon css -->
    <link rel="stylesheet" href="{{ asset('admiro/assets/css/vendors/flag-icon.css') }}">
    <!-- Iconly and Themify icons -->
    <link rel="stylesheet" href="{{ asset('admiro/assets/css/iconly-icon.css') }}">
    <link rel="stylesheet" href="{{ asset('admiro/assets/css/bulk-style.css') }}">
    <link rel="stylesheet" href="{{ asset('admiro/assets/css/themify.css') }}">
    <!-- FontAwesome 6 Free -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('admiro/assets/css/fontawesome-min.css') }}">
    <!-- Scrollbar css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('admiro/assets/css/vendors/scrollbar.css') }}">
    <!-- Admiro Main App css -->
    <link rel="stylesheet" href="{{ asset('admiro/assets/css/style.css') }}">

    <!-- DataTables & Select2 & SweetAlert -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.5/b-2.2.2/r-2.2.9/datatables.min.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    @php
        $siteAccent = $settings->site_accent_color ?? '#D61C4E';
        $siteSecondary = $settings->site_secondary_color ?? '#9F1239';
    @endphp
    <!-- Theme Custom Accent & Dark Mode Early Initialization -->
    <style id="admiro-theme-vars">
        :root {
            --theme-default: {{ $siteAccent }};
            --theme-primary: {{ $siteAccent }};
            --theme-secondary: {{ $siteSecondary }};
            --theme-gradient: linear-gradient(135deg, {{ $siteAccent }} 0%, {{ $siteSecondary }} 100%);
            --theme-gradient-hover: linear-gradient(135deg, {{ $siteSecondary }} 0%, {{ $siteAccent }} 100%);
        }
    </style>
    <script>
        (function() {
            var primary = @json($siteAccent);
            var secondary = @json($siteSecondary);
            document.documentElement.style.setProperty('--theme-default', primary);
            document.documentElement.style.setProperty('--theme-primary', primary);
            document.documentElement.style.setProperty('--theme-secondary', secondary);
            document.documentElement.style.setProperty('--theme-gradient', 'linear-gradient(135deg, ' + primary + ' 0%, ' + secondary + ' 100%)');
            document.documentElement.style.setProperty('--theme-gradient-hover', 'linear-gradient(135deg, ' + secondary + ' 0%, ' + primary + ' 100%)');
        })();
    </script>
    <style id="admiro-theme-layout">
        /* Sticky Footer Architecture */
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
            padding: 26px 24px 40px 24px !important;
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

        /* Segmented Button Switch (.selectgroup) */
        .selectgroup {
            display: inline-flex;
            align-items: center;
            border-radius: 8px;
            background-color: #f1f5f9;
            padding: 3px;
            border: 1px solid #e2e8f0;
        }
        body.dark-only .selectgroup {
            background-color: #1a202c;
            border-color: rgba(255, 255, 255, 0.12);
        }
        .selectgroup-item {
            margin: 0;
            position: relative;
            cursor: pointer;
        }
        .selectgroup-input {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }
        .selectgroup-button {
            display: inline-block;
            padding: 6px 16px;
            font-size: 13px;
            font-weight: 600;
            color: #64748b;
            border-radius: 6px;
            transition: all 0.2s ease;
            user-select: none;
            cursor: pointer;
        }
        .selectgroup-input:checked + .selectgroup-button {
            background-color: var(--theme-default, #6362e7);
            color: #ffffff;
            box-shadow: 0 2px 6px rgba(99, 98, 231, 0.25);
        }
        body.dark-only .selectgroup-button {
            color: #94a3b8;
        }
        body.dark-only .selectgroup-input:checked + .selectgroup-button {
            background-color: var(--theme-default, #6362e7);
            color: #ffffff;
        }

        .main-panel {
            width: 100% !important;
            padding: 0 !important;
            margin: 0 !important;
            background: transparent !important;
        }

        /* Desktop Sidebar Transitions & Margins */
        @media (min-width: 1200px) {
            .page-wrapper.compact-wrapper:not(.sidebar-open) .page-body-wrapper {
                margin-left: 253px !important;
                transition: margin-left 0.3s ease !important;
            }
            .page-wrapper.compact-wrapper.sidebar-open .page-body-wrapper {
                margin-left: 0 !important;
                transition: margin-left 0.3s ease !important;
            }
        }
        .cursor-pointer {
            cursor: pointer;
        }
        .hover-bg:hover {
            background-color: rgba(99, 98, 231, 0.08);
        }
        body.dark-only .hover-bg:hover {
            background-color: rgba(255, 255, 255, 0.08);
        }
        .card {
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
            border: 1px solid rgba(0, 0, 0, 0.06);
            transition: all 0.25s ease;
        }
        body.dark-only .card {
            background-color: #222736;
            border-color: rgba(255, 255, 255, 0.06);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }
        body.dark-only .card .text-dark {
            color: #f8fafc !important;
        }
        body.dark-only .card .badge.bg-light {
            background-color: rgba(255, 255, 255, 0.08) !important;
            color: #e2e8f0 !important;
            border-color: rgba(255, 255, 255, 0.1) !important;
        }
        body.dark-only .card .border-bottom,
        body.dark-only .card .border-top {
            border-color: rgba(255, 255, 255, 0.08) !important;
        }
        .hover-card-tile {
            transition: all 0.25s ease !important;
        }
        .hover-card-tile:hover {
            transform: translateX(4px) !important;
            border-color: var(--theme-default, #6362e7) !important;
            box-shadow: 0 4px 15px rgba(99, 98, 231, 0.12) !important;
        }
        body.dark-only .hover-card-tile {
            background-color: #222736 !important;
            border-color: rgba(255, 255, 255, 0.08) !important;
        }
        body.dark-only .hover-card-tile:hover {
            background-color: #272d3f !important;
            border-color: var(--theme-default, #6362e7) !important;
        }
        .table > :not(caption) > * > * {
            padding: 12px 14px;
        }

        /* High-Contrast Table and Information Styling */
        .table {
            border-color: #f1f5f9;
        }
        .table th,
        .table td {
            color: #1e293b !important;
            vertical-align: middle;
        }
        body.dark-only .table th,
        body.dark-only .table td {
            color: #f1f5f9 !important;
            border-color: #252d3d !important;
        }
        .table thead th,
        thead.table-light th,
        .table-light th {
            background-color: #f8fafc !important;
            color: #475569 !important;
            font-size: 11.5px !important;
            font-weight: 700 !important;
            text-transform: uppercase !important;
            letter-spacing: 0.5px !important;
            border-bottom: 1px solid #e2e8f0 !important;
        }
        body.dark-only .table thead,
        body.dark-only .table thead th,
        body.dark-only thead.table-light,
        body.dark-only thead.table-light th,
        body.dark-only .table-light,
        body.dark-only .table-light th {
            background-color: #191f2d !important;
            color: #94a3b8 !important;
            border-bottom: 1px solid #252d3d !important;
        }
        body.dark-only .table-hover > tbody > tr:hover > * {
            background-color: rgba(255, 255, 255, 0.02) !important;
            color: #f1f5f9 !important;
        }

        /* DataTables Controls & Dark Mode */
        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter,
        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_paginate {
            font-size: 12px;
            color: #64748b;
            padding: 10px 0;
        }
        .dataTables_wrapper .dataTables_length select {
            border-radius: 8px !important;
            padding: 4px 28px 4px 10px !important;
            font-size: 12px !important;
            border: 1px solid #e2e8f0 !important;
            background-color: #ffffff;
            color: #1e293b;
        }
        .dataTables_wrapper .dataTables_filter input {
            border-radius: 20px !important;
            padding: 6px 16px !important;
            font-size: 12px !important;
            border: 1px solid #e2e8f0 !important;
            background-color: #ffffff;
            color: #1e293b;
            outline: none !important;
            transition: all 0.2s ease;
        }
        .dataTables_wrapper .dataTables_filter input:focus {
            border-color: var(--theme-default, #6362e7) !important;
            box-shadow: 0 0 0 3px rgba(99, 98, 231, 0.15) !important;
        }
        body.dark-only .dataTables_wrapper .dataTables_length,
        body.dark-only .dataTables_wrapper .dataTables_filter,
        body.dark-only .dataTables_wrapper .dataTables_info,
        body.dark-only .dataTables_wrapper .dataTables_paginate {
            color: #94a3b8 !important;
        }
        body.dark-only .dataTables_wrapper .dataTables_length select {
            background-color: #191f2d !important;
            border-color: #252d3d !important;
            color: #f1f5f9 !important;
        }
        body.dark-only .dataTables_wrapper .dataTables_filter input {
            background-color: #191f2d !important;
            border-color: #252d3d !important;
            color: #f1f5f9 !important;
        }
        body.dark-only .dataTables_wrapper .dataTables_paginate .paginate_button {
            color: #94a3b8 !important;
            border-radius: 6px !important;
            border: 1px solid transparent !important;
        }
        body.dark-only .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: #252d3d !important;
            color: #ffffff !important;
            border-color: #252d3d !important;
        }
        body.dark-only .dataTables_wrapper .dataTables_paginate .paginate_button.current,
        body.dark-only .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
            background: var(--theme-default, #6362e7) !important;
            color: #ffffff !important;
            border-color: var(--theme-default, #6362e7) !important;
        }
        body.dark-only .dataTables_wrapper .dataTables_paginate .paginate_button.disabled,
        body.dark-only .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover {
            color: #475569 !important;
            background: transparent !important;
            border-color: transparent !important;
        }
        .user-info-table th.user-info-label {
            color: #334155 !important;
            background-color: #f8fafc !important;
            font-weight: 700 !important;
            font-size: 13px !important;
            letter-spacing: 0.3px;
            border-color: #e2e8f0 !important;
        }
        .user-info-table td.user-info-value {
            color: #0f172a !important;
            font-weight: 600 !important;
            font-size: 14px !important;
            border-color: #e2e8f0 !important;
        }
        body.dark-only .user-info-table th.user-info-label {
            color: #94a3b8 !important;
            background-color: #1a202c !important;
            border-color: rgba(255, 255, 255, 0.08) !important;
        }
        body.dark-only .user-info-table td.user-info-value {
            color: #f8fafc !important;
            border-color: rgba(255, 255, 255, 0.08) !important;
        }
        /* Override Admiro's .bg-light white-text bug for subtle/light backgrounds in light mode */
        body:not(.dark-only) .bg-light,
        body:not(.dark-only) [class*="bg-light"],
        body:not(.dark-only) [class*="bg-opacity"] {
            color: #1e293b !important;
        }
        body:not(.dark-only) .bg-light h1,
        body:not(.dark-only) .bg-light h2,
        body:not(.dark-only) .bg-light h3,
        body:not(.dark-only) .bg-light h4,
        body:not(.dark-only) .bg-light h5,
        body:not(.dark-only) .bg-light h6,
        body:not(.dark-only) [class*="bg-light"] h1,
        body:not(.dark-only) [class*="bg-light"] h2,
        body:not(.dark-only) [class*="bg-light"] h3,
        body:not(.dark-only) [class*="bg-light"] h4,
        body:not(.dark-only) [class*="bg-light"] h5,
        body:not(.dark-only) [class*="bg-light"] h6 {
            color: #0f172a !important;
        }
        body:not(.dark-only) .bg-light p,
        body:not(.dark-only) .bg-light small,
        body:not(.dark-only) [class*="bg-light"] p,
        body:not(.dark-only) [class*="bg-light"] small {
            color: #475569 !important;
        }
        body:not(.dark-only) .table [class*="bg-light"],
        body:not(.dark-only) .table [class*="bg-opacity"] {
            color: #1e293b !important;
        }

        /* Desktop & Universal Header & Logo Styling */
        .page-header {
            background-color: #ffffff !important;
            border-bottom: 1px solid #e8ecf2 !important;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.04) !important;
            transition: background-color 0.3s ease !important;
        }
        body.dark-only .page-header {
            background-color: #191f2d !important;
            border-bottom: 1px solid #252d3d !important;
            box-shadow: none !important;
        }
        .page-header .logo-wrapper {
            background-color: transparent !important;
            display: flex !important;
            align-items: center !important;
            gap: 12px !important;
        }
        @media (min-width: 992px) {
            .page-header .logo-wrapper {
                width: 253px !important;
                padding: 12px 20px !important;
                box-sizing: border-box !important;
            }
        }
        .page-header .logo-wrapper img,
        header .logo-wrapper img,
        .page-header .logo-wrapper a img {
            display: inline-block !important;
            max-height: 34px !important;
            max-width: 140px !important;
            width: auto !important;
            object-fit: contain !important;
        }
        body:not(.dark-only) .page-header .logo-wrapper .light-logo {
            display: none !important;
        }
        body:not(.dark-only) .page-header .logo-wrapper .dark-logo {
            display: inline-block !important;
        }
        body.dark-only .page-header .logo-wrapper .dark-logo {
            display: none !important;
        }
        body.dark-only .page-header .logo-wrapper .light-logo {
            display: inline-block !important;
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
                padding: 12px 6px !important;
                width: auto !important;
            }
            .page-header .logo-wrapper img,
            header .logo-wrapper img,
            .page-header .logo-wrapper a img {
                max-height: 30px !important;
                max-width: 110px !important;
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
        @media (max-width: 767.98px) {
            .page-wrapper .page-body-wrapper {
                margin-top: 67px !important;
            }
        }
        /* Admin Header Custom Dropdowns (Profile & Palette) */
        #profileMenu,
        #paletteMenu {
            background-color: #ffffff !important;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08) !important;
            border: 1px solid rgba(0, 0, 0, 0.06) !important;
            z-index: 1070 !important;
        }
        #profileMenu .dropdown-item:hover,
        #profileMenu .dropdown-item:focus {
            background-color: #f8fafc;
            color: #1e293b;
        }
        #profileMenu .dropdown-item.text-danger:hover {
            background-color: #fef2f2;
            color: #dc2626;
        }

        /* Dark Mode Header Dropdowns & Icons */
        body.dark-only #profileMenu,
        body.dark-only #paletteMenu,
        body.dark-only .custom-menu {
            background-color: #222736 !important;
            border: 1px solid rgba(255, 255, 255, 0.12) !important;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5) !important;
            color: #e2e8f0 !important;
        }
        body.dark-only #profileMenu h6,
        body.dark-only #paletteMenu h6 {
            color: #ffffff !important;
        }
        body.dark-only #profileMenu small {
            color: #94a3b8 !important;
        }
        body.dark-only #profileMenu .dropdown-item {
            color: #cbd5e1 !important;
        }
        /* Admin Profile Dropdown Panel & Items (Overrides Admiro default borders & width) */
        .admin-profile-dropdown-panel {
            background-color: #ffffff !important;
            border-radius: 14px !important;
            box-shadow: 0 14px 40px rgba(0, 0, 0, 0.12) !important;
            border: 1px solid #e8ecf2 !important;
        }
        body.dark-only .admin-profile-dropdown-panel {
            background-color: #1e2536 !important;
            border-color: #2b3648 !important;
            box-shadow: 0 14px 40px rgba(0, 0, 0, 0.4) !important;
        }
        body.dark-only .admin-profile-dropdown-panel .border-bottom {
            border-color: #2b3648 !important;
            background: rgba(255, 255, 255, 0.03) !important;
        }
        body.dark-only .admin-profile-dropdown-panel .admin-menu-divider {
            border-color: #2b3648 !important;
        }
        header ul[class*=header-] > li.profile-nav .custom-menu .profile-body,
        .admin-profile-menu {
            width: 100% !important;
            padding: 6px !important;
            margin: 0 !important;
        }
        header ul[class*=header-] > li.profile-nav .custom-menu .profile-body li,
        .admin-profile-menu li {
            padding: 2px 0 !important;
            border-top: none !important;
        }
        header ul[class*=header-] > li.profile-nav .custom-menu .profile-body li + li,
        .admin-profile-menu li + li {
            border-top: none !important;
        }
        .admin-menu-item {
            transition: all 0.2s ease !important;
            border-radius: 8px !important;
            cursor: pointer;
        }
        .admin-menu-item:hover {
            background-color: rgba(99, 98, 231, 0.08) !important;
        }
        body.dark-only .admin-menu-item:hover {
            background-color: rgba(255, 255, 255, 0.06) !important;
        }
        body.dark-only .admin-menu-item .menu-label {
            color: #f1f5f9 !important;
        }
        .admin-menu-item.text-danger:hover {
            background-color: rgba(239, 68, 68, 0.1) !important;
        }
        body.dark-only .admin-menu-item.text-danger:hover {
            background-color: rgba(239, 68, 68, 0.15) !important;
        }
        body.dark-only #profileDropdownBtn {
            border-color: rgba(255, 255, 255, 0.15) !important;
        }
        body.dark-only #profileDropdownBtn .text-dark {
            color: #e2e8f0 !important;
        }
        body.dark-only #paletteBtn,
        body.dark-only #themeToggleBtn,
        body.dark-only #fullScreenBtn {
            border-color: rgba(255, 255, 255, 0.15) !important;
            color: #e2e8f0 !important;
        }
        body.dark-only #themeToggleBtn svg,
        body.dark-only #fullScreenBtn svg {
            stroke: #e2e8f0 !important;
            fill: #e2e8f0 !important;
        }
        body.dark-only #paletteBtn i {
            color: #e2e8f0 !important;
        }

        /* ==========================================================
           Admin Brand Logo Display & Responsive Rules
           Overrides Admiro max-width:420px image-hiding bugs
        ========================================================== */
        .page-header .logo-wrapper {
            display: flex !important;
            align-items: center !important;
            background-color: transparent !important;
        }
        .page-header .logo-wrapper .admin-brand-link {
            display: inline-flex !important;
            align-items: center !important;
            text-decoration: none !important;
        }
        .page-header .logo-wrapper img.admin-brand-colored,
        .page-header .logo-wrapper img.admin-brand-white {
            max-height: 38px !important;
            width: auto !important;
            max-width: 150px !important;
            object-fit: contain !important;
            vertical-align: middle !important;
            transition: opacity 0.2s ease !important;
        }

        /* Default / Light Mode: Show Colored Logo ($settings->dark_logo), Hide White Logo */
        body:not(.dark-only) .page-header .logo-wrapper img.admin-brand-colored,
        body:not(.dark-only) .sidebar-mobile-header img.admin-brand-colored {
            display: inline-block !important;
        }
        body:not(.dark-only) .page-header .logo-wrapper img.admin-brand-white,
        body:not(.dark-only) .sidebar-mobile-header img.admin-brand-white {
            display: none !important;
        }

        /* Dark Mode: Show White Logo ($settings->logo), Hide Colored Logo */
        body.dark-only .page-header .logo-wrapper img.admin-brand-colored,
        body.dark-only .sidebar-mobile-header img.admin-brand-colored {
            display: none !important;
        }
        body.dark-only .page-header .logo-wrapper img.admin-brand-white,
        body.dark-only .sidebar-mobile-header img.admin-brand-white {
            display: inline-block !important;
        }

        /* Mobile Screens (<= 576px, including <= 420px iPhones) */
        @media (max-width: 575.98px) {
            .page-header .logo-wrapper {
                width: auto !important;
                padding: 6px 8px !important;
            }
            .page-header .logo-wrapper img.admin-brand-colored,
            .page-header .logo-wrapper img.admin-brand-white {
                max-height: 30px !important;
                max-width: 115px !important;
            }
            body:not(.dark-only) .page-header .logo-wrapper img.admin-brand-colored {
                display: inline-block !important;
            }
            body:not(.dark-only) .page-header .logo-wrapper img.admin-brand-white {
                display: none !important;
            }
            body.dark-only .page-header .logo-wrapper img.admin-brand-colored {
                display: none !important;
            }
            body.dark-only .page-header .logo-wrapper img.admin-brand-white {
                display: inline-block !important;
            }
            .page-header .logo-wrapper .close-btn {
                width: 32px !important;
                height: 32px !important;
                margin-left: 8px !important;
            }
            .page-header .logo-wrapper .close-btn svg {
                width: 18px !important;
                height: 18px !important;
            }
        }
    </style>

    <script>
        (function() {
            var storedMode = localStorage.getItem('mode');
            var prefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
            if (storedMode === 'dark-only' || (!storedMode && prefersDark)) {
                document.documentElement.classList.add('dark-only');
            } else {
                document.documentElement.classList.remove('dark-only');
            }
            var savedColor = localStorage.getItem('admiro_accent_color');
            if (savedColor) {
                document.documentElement.style.setProperty('--theme-default', savedColor);
            }
        })();
    </script>

    @section('styles')
    @show
    @livewireStyles
</head>

<body>
    <script>
        (function() {
            var storedMode = localStorage.getItem('mode');
            var prefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
            if (storedMode === 'dark-only' || (!storedMode && prefersDark)) {
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
        <!-- Header -->
        @include('admin.topmenu', ['from_layout' => true])

        <!-- Page Body Wrapper Start -->
        <div class="page-body-wrapper">
            <!-- Sidebar -->
            @include('admin.sidebar', ['from_layout' => true])

            <!-- Mobile Sidebar Backdrop Overlay -->
            <div class="sidebar-backdrop" id="sidebarBackdrop"></div>

            <!-- Page Body Content -->
            <div class="page-body">
                @yield('content')
            </div>

            <!-- Footer -->
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
    <!-- Page Wrapper End -->

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

    <!-- Admiro Theme Interaction Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Dark / Light Mode Toggle
            var themeBtn = document.getElementById('themeToggleBtn');
            if (themeBtn) {
                themeBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    var isDark = document.body.classList.contains('dark-only');
                    if (isDark) {
                        document.body.classList.remove('dark-only');
                        document.body.classList.add('light');
                        document.documentElement.classList.remove('dark-only');
                        localStorage.setItem('mode', 'light');
                    } else {
                        document.body.classList.add('dark-only');
                        document.body.classList.remove('light');
                        document.documentElement.classList.add('dark-only');
                        localStorage.setItem('mode', 'dark-only');
                    }
                });
            }

            // Listen to OS System Theme Changes if user hasn't explicitly set a preference
            if (window.matchMedia) {
                window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', function(e) {
                    if (!localStorage.getItem('mode')) {
                        if (e.matches) {
                            document.body.classList.add('dark-only');
                            document.body.classList.remove('light');
                            document.documentElement.classList.add('dark-only');
                        } else {
                            document.body.classList.add('light');
                            document.body.classList.remove('dark-only');
                            document.documentElement.classList.remove('dark-only');
                        }
                    }
                });
            }

            // Accent Color Buttons
            document.querySelectorAll('.theme-color-btn').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    var color = this.getAttribute('data-color');
                    if (color) {
                        document.documentElement.style.setProperty('--theme-default', color);
                        localStorage.setItem('admiro_accent_color', color);
                        // Close palette menu
                        var menu = document.getElementById('paletteMenu');
                        if (menu) menu.classList.remove('show');
                    }
                });
            });

            // Toggle Palette Dropdown
            var paletteBtn = document.getElementById('paletteBtn');
            var paletteMenu = document.getElementById('paletteMenu');
            if (paletteBtn && paletteMenu) {
                paletteBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    paletteMenu.classList.toggle('show');
                });
            }

            // Toggle Profile Dropdown
            var profileBtn = document.getElementById('profileDropdownBtn');
            var profileMenu = document.getElementById('profileMenu');
            if (profileBtn && profileMenu) {
                profileBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    profileMenu.classList.toggle('show');
                });
            }

            // Close custom dropdowns on outside click
            document.addEventListener('click', function(e) {
                if (paletteMenu && !paletteMenu.contains(e.target) && e.target !== paletteBtn) {
                    paletteMenu.classList.remove('show');
                }
                if (profileMenu && !profileMenu.contains(e.target) && !profileBtn.contains(e.target)) {
                    profileMenu.classList.remove('show');
                }
            });

            // Fullscreen Toggle
            var fullScreenBtn = document.getElementById('fullScreenBtn');
            if (fullScreenBtn) {
                fullScreenBtn.addEventListener('click', function() {
                    if (!document.fullscreenElement) {
                        document.documentElement.requestFullscreen();
                    } else {
                        if (document.exitFullscreen) {
                            document.exitFullscreen();
                        }
                    }
                });
            }

            // Initialize feather icons
            if (window.feather) {
                feather.replace();
            }

            // Initialize generic DataTables if present
            if ($.fn.DataTable && $('#ShipTable').length) {
                $('#ShipTable').DataTable({
                    responsive: false,
                    scrollX: true,
                    pageLength: 10,
                    language: {
                        search: "_INPUT_",
                        searchPlaceholder: "Search records..."
                    }
                });
            }

            // Mobile Responsive Sidebar (< 992px)
            var pageWrapper = document.getElementById('pageWrapper');
            var sidebarBackdrop = document.getElementById('sidebarBackdrop');
            var toggleBtns = document.querySelectorAll('.toggle-sidebar, #sidebar-toggle-btn');

            toggleBtns.forEach(function(btn) {
                btn.addEventListener('click', function(e) {
                    if (window.innerWidth < 992 && pageWrapper) {
                        e.preventDefault();
                        e.stopPropagation();
                        pageWrapper.classList.toggle('mobile-sidebar-open');
                    }
                });
            });

            if (sidebarBackdrop) {
                sidebarBackdrop.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    if (pageWrapper) {
                        pageWrapper.classList.remove('mobile-sidebar-open');
                    }
                });
            }

            // Close mobile sidebar when clicking outside or pressing Escape
            document.addEventListener('click', function(e) {
                if (window.innerWidth < 992 && pageWrapper && pageWrapper.classList.contains('mobile-sidebar-open')) {
                    var sidebar = document.querySelector('.page-sidebar');
                    var isInsideSidebar = sidebar && sidebar.contains(e.target);
                    var isToggleBtn = false;
                    toggleBtns.forEach(function(btn) {
                        if (btn && btn.contains(e.target)) isToggleBtn = true;
                    });
                    if (!isInsideSidebar && !isToggleBtn) {
                        pageWrapper.classList.remove('mobile-sidebar-open');
                    }
                }
            });

            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && pageWrapper && pageWrapper.classList.contains('mobile-sidebar-open')) {
                    pageWrapper.classList.remove('mobile-sidebar-open');
                }
            });

            // Close on link click for internal navigation on mobile
            document.querySelectorAll('.page-sidebar .sidebar-link:not(.sidebar-title), .page-sidebar .sidebar-submenu a').forEach(function(link) {
                link.addEventListener('click', function() {
                    if (window.innerWidth < 992 && pageWrapper) {
                        pageWrapper.classList.remove('mobile-sidebar-open');
                    }
                });
            });

            // Clean up on desktop resize
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 992 && pageWrapper && pageWrapper.classList.contains('mobile-sidebar-open')) {
                    pageWrapper.classList.remove('mobile-sidebar-open');
                }
            });

            // Bootstrap 4 -> Bootstrap 5 Compatibility Bridge for Legacy Views
            $(document).on('click', '[data-toggle="dropdown"]', function(e) {
                if (!this.hasAttribute('data-bs-toggle')) {
                    e.preventDefault();
                    e.stopPropagation();
                    if (window.bootstrap && window.bootstrap.Dropdown) {
                        var dropdown = bootstrap.Dropdown.getOrCreateInstance(this);
                        dropdown.toggle();
                    }
                }
            });

            $(document).on('click', '[data-toggle="modal"]', function(e) {
                if (!this.hasAttribute('data-bs-toggle')) {
                    e.preventDefault();
                    var target = $(this).attr('data-target') || $(this).attr('href');
                    if (target && target.startsWith('#')) {
                        var modalEl = document.querySelector(target);
                        if (modalEl && window.bootstrap && window.bootstrap.Modal) {
                            var modal = bootstrap.Modal.getOrCreateInstance(modalEl);
                            modal.show();
                        }
                    }
                }
            });

            $(document).on('click', '[data-dismiss="modal"]', function(e) {
                if (!this.hasAttribute('data-bs-dismiss')) {
                    e.preventDefault();
                    var modalEl = $(this).closest('.modal')[0];
                    if (modalEl && window.bootstrap && window.bootstrap.Modal) {
                        var modal = bootstrap.Modal.getOrCreateInstance(modalEl);
                        modal.hide();
                    }
                }
            });

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

    @livewireScripts
    @section('scripts')
    @show
</body>

</html>
