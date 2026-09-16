<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex, nofollow, noarchive, nosnippet, noimageindex">
    <meta name="googlebot" content="noindex, nofollow, noarchive, nosnippet, noimageindex">
    <title>{{ $settings->site_name }} | @yield('title')</title>

    <link rel="icon" href="{{ asset('storage/app/public/'.$settings->favicon) }}" type="image/png"/>

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

    <!-- Google Font: Manrope -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tabler Icons -->
    <link rel="stylesheet" href="{{ asset('volkovdesign/webfont/tabler-icons.min.css') }}">

    @section('styles')
        <link href="{{ asset('temp/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('temp/css/materialdesignicons.min.css') }}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="{{ asset('temp/css/line.css') }}">
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        
        @php
            $theme = $settings->website_theme == 'purpose.css' ? 'default.css' : $settings->website_theme;
        @endphp
        <link href="{{ asset('temp/css/style.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('temp/css/colors/'.$theme) }}" rel="stylesheet">

        <!-- Modern Auth Theme (Dark & Light Mode) -->
        <link rel="stylesheet" href="{{ asset('volkovdesign/css/auth-theme.css') }}?v={{ file_exists(base_path('volkovdesign/css/auth-theme.css')) ? filemtime(base_path('volkovdesign/css/auth-theme.css')) : time() }}">

        @php
            $siteAccent = !empty($settings->site_accent_color) ? $settings->site_accent_color : '#D61C4E';
            $siteSecondary = !empty($settings->site_secondary_color) ? $settings->site_secondary_color : '#9F1239';
        @endphp
        <style id="dynamic-auth-theme-vars">
            :root {
                --auth-accent: {{ $siteAccent }} !important;
                --auth-accent-hover: {{ $siteSecondary }} !important;
                --auth-input-focus-border: {{ $siteAccent }} !important;
                --theme-primary: {{ $siteAccent }} !important;
                --theme-secondary: {{ $siteSecondary }} !important;
                --theme-gradient: linear-gradient(135deg, {{ $siteAccent }} 0%, {{ $siteSecondary }} 100%) !important;
                --theme-gradient-hover: linear-gradient(135deg, {{ $siteSecondary }} 0%, {{ $siteAccent }} 100%) !important;
            }
        </style>
    @show
</head>
<body class="bg-soft-primary">
    <!-- Top Floating Auth Navigation -->
    <header class="auth-navbar">
        <div class="auth-navbar-inner">
            <a href="{{ url('/') }}" class="auth-nav-back">
                <i class="ti ti-arrow-left"></i>
                <span>Back to Website</span>
            </a>

            <!-- Theme Switcher (Light / Dark / System Auto) -->
            <div class="dropdown theme-switcher-dropdown">
                <button class="theme-toggle-btn" type="button" id="themeToggleBtn" aria-haspopup="true" aria-expanded="false" title="Switch Theme (Light / Dark / System Auto)">
                    <i class="ti ti-moon" id="themeIconActive"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right theme-switcher-menu shadow-lg" aria-labelledby="themeToggleBtn">
                    <button type="button" class="dropdown-item theme-option-btn d-flex align-items-center" data-theme-choice="light">
                        <i class="ti ti-sun text-warning mr-2"></i> Light
                        <i class="ti ti-check ml-auto theme-check-icon d-none" data-check="light"></i>
                    </button>
                    <button type="button" class="dropdown-item theme-option-btn d-flex align-items-center" data-theme-choice="dark">
                        <i class="ti ti-moon text-info mr-2"></i> Dark
                        <i class="ti ti-check ml-auto theme-check-icon d-none" data-check="dark"></i>
                    </button>
                    <button type="button" class="dropdown-item theme-option-btn d-flex align-items-center" data-theme-choice="system">
                        <i class="ti ti-device-desktop text-secondary mr-2"></i> System Auto
                        <i class="ti ti-check ml-auto theme-check-icon d-none" data-check="system"></i>
                    </button>
                </div>
            </div>
        </div>
    </header>

    @yield('content')

    @section('scripts')
        <script src="{{ asset('temp/js/jquery-3.5.1.min.js') }}"></script>
        <script src="{{ asset('temp/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('temp/js/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('temp/js/owl.init.js') }}"></script>
        <script src="{{ asset('temp/js/feather.min.js') }}"></script>
        <script src="{{ asset('temp/js/bundle.js') }}"></script>
        <script src="{{ asset('temp/js/app.js') }}"></script>
        <script src="{{ asset('temp/js/widget.js') }}"></script>

        <!-- Theme Engine (Light / Dark / System Auto Detector) -->
        <script>
            (function() {
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
                        // Close dropdown menu
                        var dropdownMenu = document.querySelector('.theme-switcher-menu');
                        if (dropdownMenu) dropdownMenu.classList.remove('show');
                    });
                });

                // Dropdown click handler fallback
                var toggleBtn = document.getElementById('themeToggleBtn');
                var dropdownMenu = document.querySelector('.theme-switcher-menu');
                if (toggleBtn && dropdownMenu) {
                    toggleBtn.addEventListener('click', function(e) {
                        e.stopPropagation();
                        dropdownMenu.classList.toggle('show');
                    });
                    document.addEventListener('click', function(e) {
                        if (!dropdownMenu.contains(e.target) && !toggleBtn.contains(e.target)) {
                            dropdownMenu.classList.remove('show');
                        }
                    });
                }

                mediaQuery.addEventListener('change', function(e) {
                    if ((localStorage.getItem('ecx_theme') || 'system') === 'system') {
                        updateUI('system', e.matches);
                    }
                });
            })();
        </script>
    @show

    @livewireScripts
    <script src="https://cdn.jsdelivr.net/gh/livewire/turbolinks@v0.1.4/dist/livewire-turbolinks.js" data-turbolinks-eval="false" data-turbo-eval="false"></script>
</body>
</html>
