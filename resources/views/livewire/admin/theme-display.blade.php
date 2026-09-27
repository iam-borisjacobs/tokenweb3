<div>
    <!-- Section 1: Admin Dashboard Appearance & Accent Colors -->
    <div class="row g-4 mb-4">
        <!-- Global Platform Accent & Gradient Palette Manager -->
        <div class="col-lg-7">
            <div class="card h-100 border p-4 shadow-sm">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div>
                        <h5 class="f-w-700 mb-1 d-flex align-items-center gap-2">
                            <i class="fa fa-palette text-primary"></i> Platform Accent &amp; Gradient Palette
                        </h5>
                        <p class="text-muted f-13 mb-0">Select your preferred primary color and secondary gradient tone. Persists in the database and powers the Welcome Page, User Dashboard banners, Auth Pages, and Admin Panel.</p>
                    </div>
                </div>

                <!-- Live Gradient Preview Bar -->
                <div class="p-3 rounded-3 border mb-3" style="background: #f8fafc;">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="f-w-600 f-11 text-muted text-uppercase letter-spacing-1">Live Palette &amp; Gradient Preview</span>
                        <span class="badge bg-white text-dark border px-2 py-1 f-11 font-monospace" id="liveGradientHex">
                            {{ $site_accent_color }} &rarr; {{ $site_secondary_color }}
                        </span>
                    </div>
                    <div class="p-3 rounded-3 d-flex flex-wrap align-items-center justify-content-between gap-3 shadow-sm" id="liveGradientPreviewBox" style="background: linear-gradient(135deg, {{ $site_accent_color }} 0%, {{ $site_secondary_color }} 100%); transition: all 0.3s ease;">
                        <div class="d-flex align-items-center gap-2 text-white">
                            <i class="fa fa-shield-halved f-20"></i>
                            <div>
                                <div class="f-w-700 f-13" id="livePreviewTitle">Connect Your Wallet to Start Earning</div>
                                <div class="f-11 text-white text-opacity-80">Universal Theme Gradient Applied</div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <button type="button" class="btn btn-light btn-sm rounded-pill px-3 py-1 f-12 f-w-700 shadow-sm" style="color: {{ $site_accent_color }};">
                                Action Button &rarr;
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Preset Palettes -->
                <div class="p-3 bg-light bg-opacity-50 rounded-3 border mb-3">
                    <label class="form-label f-w-600 f-12 mb-2 text-muted text-uppercase">Dual-Color Preset Palettes</label>
                    <div class="d-flex flex-wrap align-items-center gap-2">
                        <!-- Crimson Ember (User's Current Red Choice) -->
                        <button type="button" class="btn btn-sm btn-outline-secondary d-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-white shadow-sm border"
                                wire:click="setPalettePreset('#D61C4E', '#9F1239')"
                                onclick="updateLocalPaletteSim('#D61C4E', '#9F1239')">
                            <span class="rounded-circle border" style="width: 16px; height: 16px; background: linear-gradient(135deg, #D61C4E 50%, #9F1239 50%); display: inline-block;"></span>
                            <span class="f-12 f-w-600">Crimson Red</span>
                        </button>

                        <!-- Cyber Cyan (Electric Blue) -->
                        <button type="button" class="btn btn-sm btn-outline-secondary d-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-white shadow-sm border"
                                wire:click="setPalettePreset('#00E5FF', '#0070F3')"
                                onclick="updateLocalPaletteSim('#00E5FF', '#0070F3')">
                            <span class="rounded-circle border" style="width: 16px; height: 16px; background: linear-gradient(135deg, #00E5FF 50%, #0070F3 50%); display: inline-block;"></span>
                            <span class="f-12 f-w-600">Cyber Cyan</span>
                        </button>

                        <!-- Deep Royal Blue -->
                        <button type="button" class="btn btn-sm btn-outline-secondary d-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-white shadow-sm border"
                                wire:click="setPalettePreset('#2563EB', '#1E40AF')"
                                onclick="updateLocalPaletteSim('#2563EB', '#1E40AF')">
                            <span class="rounded-circle border" style="width: 16px; height: 16px; background: linear-gradient(135deg, #2563EB 50%, #1E40AF 50%); display: inline-block;"></span>
                            <span class="f-12 f-w-600">Royal Blue</span>
                        </button>

                        <!-- Royal Indigo -->
                        <button type="button" class="btn btn-sm btn-outline-secondary d-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-white shadow-sm border"
                                wire:click="setPalettePreset('#6366F1', '#4338CA')"
                                onclick="updateLocalPaletteSim('#6366F1', '#4338CA')">
                            <span class="rounded-circle border" style="width: 16px; height: 16px; background: linear-gradient(135deg, #6366F1 50%, #4338CA 50%); display: inline-block;"></span>
                            <span class="f-12 f-w-600">Royal Indigo</span>
                        </button>

                        <!-- Emerald Growth -->
                        <button type="button" class="btn btn-sm btn-outline-secondary d-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-white shadow-sm border"
                                wire:click="setPalettePreset('#10B981', '#047857')"
                                onclick="updateLocalPaletteSim('#10B981', '#047857')">
                            <span class="rounded-circle border" style="width: 16px; height: 16px; background: linear-gradient(135deg, #10B981 50%, #047857 50%); display: inline-block;"></span>
                            <span class="f-12 f-w-600">Emerald Green</span>
                        </button>

                        <!-- Sunset Amber -->
                        <button type="button" class="btn btn-sm btn-outline-secondary d-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-white shadow-sm border"
                                wire:click="setPalettePreset('#F59E0B', '#D97706')"
                                onclick="updateLocalPaletteSim('#F59E0B', '#D97706')">
                            <span class="rounded-circle border" style="width: 16px; height: 16px; background: linear-gradient(135deg, #F59E0B 50%, #D97706 50%); display: inline-block;"></span>
                            <span class="f-12 f-w-600">Sunset Gold</span>
                        </button>
                    </div>
                </div>

                <!-- Custom Dual Color Pickers -->
                <div class="row g-2 align-items-center">
                    <div class="col-sm-5">
                        <label class="f-w-600 f-12 text-muted mb-1 d-block">Primary Color:</label>
                        <div class="input-group input-group-sm">
                            <input type="color" wire:model="site_accent_color" id="siteAccentPicker" class="form-control form-control-color border" style="width: 44px; height: 34px; cursor: pointer;">
                            <input type="text" wire:model="site_accent_color" id="siteAccentHex" class="form-control font-monospace f-12" placeholder="#D61C4E">
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <label class="f-w-600 f-12 text-muted mb-1 d-block">Secondary Gradient:</label>
                        <div class="input-group input-group-sm">
                            <input type="color" wire:model="site_secondary_color" id="siteSecondaryPicker" class="form-control form-control-color border" style="width: 44px; height: 34px; cursor: pointer;">
                            <input type="text" wire:model="site_secondary_color" id="siteSecondaryHex" class="form-control font-monospace f-12" placeholder="#9F1239">
                        </div>
                    </div>
                    <div class="col-sm-2 text-end pt-3">
                        <button type="button" class="btn btn-primary btn-sm w-100 rounded-pill py-2 f-12 f-w-700 shadow-sm" wire:click="saveSitePalette" id="saveSitePaletteBtn">
                            <i class="fa fa-save me-1"></i> Save
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Admin Theme Mode Switcher Card -->
        <div class="col-lg-5">
            <div class="card h-100 border p-4 shadow-sm">
                <div class="mb-3">
                    <h5 class="f-w-700 mb-1 d-flex align-items-center gap-2">
                        <i class="fa fa-adjust text-primary"></i> Admin Display Mode
                    </h5>
                    <p class="text-muted f-13 mb-0">Switch between crisp Light Mode and high-contrast Dark Mode.</p>
                </div>

                <div class="row g-2 mt-1">
                    <div class="col-4">
                        <div class="p-3 border rounded-3 text-center cursor-pointer hover-card-tile h-100" id="adminLightModeCard" onclick="switchAdminMode('light')">
                            <div class="mb-2">
                                <i class="fa fa-sun text-warning f-22"></i>
                            </div>
                            <h6 class="f-w-700 mb-0 f-13">Light</h6>
                            <small class="text-muted f-10 d-block mt-1">Clean & Crisp</small>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="p-3 border rounded-3 text-center cursor-pointer hover-card-tile h-100" id="adminDarkModeCard" onclick="switchAdminMode('dark-only')">
                            <div class="mb-2">
                                <i class="fa fa-moon text-info f-22"></i>
                            </div>
                            <h6 class="f-w-700 mb-0 f-13">Dark</h6>
                            <small class="text-muted f-10 d-block mt-1">Deep Midnight</small>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="p-3 border rounded-3 text-center cursor-pointer hover-card-tile h-100" id="adminAutoModeCard" onclick="switchAdminMode('auto')">
                            <div class="mb-2">
                                <i class="fa fa-laptop text-primary f-22"></i>
                            </div>
                            <h6 class="f-w-700 mb-0 f-13">Auto</h6>
                            <small class="text-muted f-10 d-block mt-1">System Match</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Section: Front-End Landing Page Template Manager -->
    <div class="card border p-4 shadow-sm mb-4">
        @if (session()->has('template_message'))
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                <i class="fa fa-check-circle me-1"></i> {{ session('template_message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2 mb-4">
            <div>
                <h5 class="f-w-700 mb-1 d-flex align-items-center gap-2">
                    <i class="fa fa-layer-group text-primary"></i> Front-End Landing Page Template Manager
                </h5>
                <p class="text-muted f-13 mb-0">Switch between modular website landing page templates with 1 click. All logos, company name, contact info, and investment plans are automatically shared across templates.</p>
            </div>
            <div class="d-flex align-items-center gap-2">
                <span class="badge bg-light-primary text-primary px-3 py-2 rounded-pill f-12 border">
                    Active Template: <strong class="text-uppercase">{{ $frontend_template }}</strong>
                </span>
                <a href="{{ route('home') }}" target="_blank" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                    <i class="fa fa-external-link me-1"></i> View Live Site
                </a>
            </div>
        </div>

        <div class="row g-4">
            <!-- Template 1: Default / Institutional Arbitrage -->
            <div class="col-lg-6">
                <div class="card h-100 border {{ $frontend_template == 'default' ? 'border-primary border-2 shadow' : 'border' }} p-3 rounded-4 cursor-pointer hover-card-tile position-relative"
                     wire:click="setFrontendTemplate('default')">
                    @if ($frontend_template == 'default')
                        <div class="position-absolute top-0 end-0 m-3 z-2">
                            <span class="badge bg-primary rounded-pill px-3 py-1 f-12 shadow-sm">
                                <i class="fa fa-check me-1"></i> Currently Active
                            </span>
                        </div>
                    @endif
                    <div class="rounded-3 overflow-hidden border mb-3 position-relative text-center d-flex align-items-center justify-content-center" 
                         style="height: 180px; background: linear-gradient(135deg, #0b1329 0%, #111d3d 100%);">
                        <div class="p-3 text-center">
                            <span class="badge bg-primary text-white rounded-pill px-3 py-1 mb-2 f-11">Institutional Arbitrage</span>
                            <h5 class="text-white f-w-800 mb-1">Capital, composed.</h5>
                            <small class="text-muted f-11">Classic high-conviction welcome portal with live price tickers &amp; ambient lighting</small>
                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-between pt-2">
                        <div>
                            <h6 class="f-w-700 mb-1 f-14">Classic Arbitrage Template</h6>
                            <small class="text-muted f-12">Institutional Dark &bull; Ambient Glow &bull; Live Market Roller</small>
                        </div>
                        <button type="button" class="btn btn-sm {{ $frontend_template == 'default' ? 'btn-primary' : 'btn-outline-primary' }} rounded-pill px-4 shadow-sm">
                            {{ $frontend_template == 'default' ? 'Selected' : 'Activate' }}
                        </button>
                    </div>
                </div>
            </div>

            <!-- Template 2: ECX Groups Crypto Investment Template -->
            <div class="col-lg-6">
                <div class="card h-100 border {{ $frontend_template == 'ecx' ? 'border-primary border-2 shadow' : 'border' }} p-3 rounded-4 cursor-pointer hover-card-tile position-relative"
                     wire:click="setFrontendTemplate('ecx')">
                    @if ($frontend_template == 'ecx')
                        <div class="position-absolute top-0 end-0 m-3 z-2">
                            <span class="badge bg-success rounded-pill px-3 py-1 f-12 shadow-sm">
                                <i class="fa fa-check me-1"></i> Currently Active
                            </span>
                        </div>
                    @endif
                    <div class="rounded-3 overflow-hidden border mb-3 position-relative text-center d-flex align-items-center justify-content-center" 
                         style="height: 180px; background: linear-gradient(135deg, #090e1a 0%, #151f38 100%); background-image: url('{{ asset('themes/ecx/assets/images/banner/home4/1.png') }}'); background-size: cover; background-position: center;">
                        <div class="position-absolute w-100 h-100 top-0 start-0" style="background: rgba(9, 14, 26, 0.75);"></div>
                        <div class="p-3 text-center position-relative z-1">
                            <span class="badge bg-warning text-dark rounded-pill px-3 py-1 mb-2 f-11">ECX GROUPS THEME</span>
                            <h5 class="text-white f-w-800 mb-1">Deposit, Invest, Withdraw</h5>
                            <small class="text-white text-opacity-75 f-11">TradingView Ticker Tape &bull; Crypto Heatmap &bull; Swiper Sliders</small>
                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-between pt-2">
                        <div>
                            <h6 class="f-w-700 mb-1 f-14">ECX Groups Crypto Template</h6>
                            <small class="text-muted f-12">New Detachable Theme &bull; Services &bull; Roadmap &bull; Swiper Plans</small>
                        </div>
                        <button type="button" class="btn btn-sm {{ $frontend_template == 'ecx' ? 'btn-success' : 'btn-outline-primary' }} rounded-pill px-4 shadow-sm">
                            {{ $frontend_template == 'ecx' ? 'Selected' : 'Activate' }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Section 2: User Dashboard / Frontend Theme Selection -->
    <div class="card border p-4 shadow-sm mb-4">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2 mb-4">
            <div>
                <h5 class="f-w-700 mb-1 d-flex align-items-center gap-2">
                    <i class="fa fa-desktop text-primary"></i> User Portal & Trading Theme
                </h5>
                <p class="text-muted f-13 mb-0">Choose the active stylesheet and color aesthetic for client investor dashboards. Click any card to switch.</p>
            </div>
            <div>
                <span class="badge bg-light-primary text-primary px-3 py-2 rounded-pill f-12">
                    Current: <strong>{{ $settings->website_theme }}</strong>
                </span>
            </div>
        </div>

        <div class="row g-4">
            <!-- Theme: Purpose -->
            <div class="col-xl-4 col-md-6">
                <div class="card h-100 border {{ $settings->website_theme == 'purpose.css' ? 'border-primary border-2 shadow' : 'border' }} p-3 rounded-3 cursor-pointer hover-card-tile position-relative"
                     wire:click="setTheme('purpose.css')">
                    @if ($settings->website_theme == 'purpose.css')
                        <div class="position-absolute top-0 end-0 m-2">
                            <span class="badge bg-primary rounded-pill px-2 py-1 f-11">
                                <i class="fa fa-check me-1"></i> Active
                            </span>
                        </div>
                    @endif
                    <div class="rounded-3 overflow-hidden border mb-3 bg-light text-center" style="height: 140px;">
                        <img src="{{ asset('dash/images/purpose.png') }}" alt="Purpose Theme" class="img-fluid h-100 w-100" style="object-fit: cover;">
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="f-w-700 mb-1 f-14">Purpose Theme</h6>
                            <small class="text-muted f-12">purpose.css &bull; Minimalist Clean</small>
                        </div>
                        <button type="button" class="btn btn-sm {{ $settings->website_theme == 'purpose.css' ? 'btn-primary' : 'btn-outline-primary' }} rounded-pill px-3">
                            {{ $settings->website_theme == 'purpose.css' ? 'Selected' : 'Activate' }}
                        </button>
                    </div>
                </div>
            </div>

            <!-- Theme: Blue -->
            <div class="col-xl-4 col-md-6">
                <div class="card h-100 border {{ $settings->website_theme == 'blue.css' ? 'border-primary border-2 shadow' : 'border' }} p-3 rounded-3 cursor-pointer hover-card-tile position-relative"
                     wire:click="setTheme('blue.css')">
                    @if ($settings->website_theme == 'blue.css')
                        <div class="position-absolute top-0 end-0 m-2">
                            <span class="badge bg-primary rounded-pill px-2 py-1 f-11">
                                <i class="fa fa-check me-1"></i> Active
                            </span>
                        </div>
                    @endif
                    <div class="rounded-3 overflow-hidden border mb-3 bg-light text-center" style="height: 140px;">
                        <img src="{{ asset('dash/images/blue.png') }}" alt="Blue Theme" class="img-fluid h-100 w-100" style="object-fit: cover;">
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="f-w-700 mb-1 f-14">Ocean Blue Theme</h6>
                            <small class="text-muted f-12">blue.css &bull; Corporate Sapphire</small>
                        </div>
                        <button type="button" class="btn btn-sm {{ $settings->website_theme == 'blue.css' ? 'btn-primary' : 'btn-outline-primary' }} rounded-pill px-3">
                            {{ $settings->website_theme == 'blue.css' ? 'Selected' : 'Activate' }}
                        </button>
                    </div>
                </div>
            </div>

            <!-- Theme: Green -->
            <div class="col-xl-4 col-md-6">
                <div class="card h-100 border {{ $settings->website_theme == 'green.css' ? 'border-primary border-2 shadow' : 'border' }} p-3 rounded-3 cursor-pointer hover-card-tile position-relative"
                     wire:click="setTheme('green.css')">
                    @if ($settings->website_theme == 'green.css')
                        <div class="position-absolute top-0 end-0 m-2">
                            <span class="badge bg-primary rounded-pill px-2 py-1 f-11">
                                <i class="fa fa-check me-1"></i> Active
                            </span>
                        </div>
                    @endif
                    <div class="rounded-3 overflow-hidden border mb-3 bg-light text-center" style="height: 140px;">
                        <img src="{{ asset('dash/images/green.png') }}" alt="Green Theme" class="img-fluid h-100 w-100" style="object-fit: cover;">
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="f-w-700 mb-1 f-14">Emerald Green Theme</h6>
                            <small class="text-muted f-12">green.css &bull; Financial Growth</small>
                        </div>
                        <button type="button" class="btn btn-sm {{ $settings->website_theme == 'green.css' ? 'btn-primary' : 'btn-outline-primary' }} rounded-pill px-3">
                            {{ $settings->website_theme == 'green.css' ? 'Selected' : 'Activate' }}
                        </button>
                    </div>
                </div>
            </div>

            <!-- Theme: Brown -->
            <div class="col-xl-4 col-md-6">
                <div class="card h-100 border {{ $settings->website_theme == 'brown.css' ? 'border-primary border-2 shadow' : 'border' }} p-3 rounded-3 cursor-pointer hover-card-tile position-relative"
                     wire:click="setTheme('brown.css')">
                    @if ($settings->website_theme == 'brown.css')
                        <div class="position-absolute top-0 end-0 m-2">
                            <span class="badge bg-primary rounded-pill px-2 py-1 f-11">
                                <i class="fa fa-check me-1"></i> Active
                            </span>
                        </div>
                    @endif
                    <div class="rounded-3 overflow-hidden border mb-3 bg-light text-center" style="height: 140px;">
                        <img src="{{ asset('dash/images/brown.png') }}" alt="Brown Theme" class="img-fluid h-100 w-100" style="object-fit: cover;">
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="f-w-700 mb-1 f-14">Gold / Bronze Theme</h6>
                            <small class="text-muted f-12">brown.css &bull; Prestige & Luxury</small>
                        </div>
                        <button type="button" class="btn btn-sm {{ $settings->website_theme == 'brown.css' ? 'btn-primary' : 'btn-outline-primary' }} rounded-pill px-3">
                            {{ $settings->website_theme == 'brown.css' ? 'Selected' : 'Activate' }}
                        </button>
                    </div>
                </div>
            </div>

            <!-- Theme: Dark -->
            <div class="col-xl-4 col-md-6">
                <div class="card h-100 border {{ $settings->website_theme == 'dark.css' ? 'border-primary border-2 shadow' : 'border' }} p-3 rounded-3 cursor-pointer hover-card-tile position-relative"
                     wire:click="setTheme('dark.css')">
                    @if ($settings->website_theme == 'dark.css')
                        <div class="position-absolute top-0 end-0 m-2">
                            <span class="badge bg-primary rounded-pill px-2 py-1 f-11">
                                <i class="fa fa-check me-1"></i> Active
                            </span>
                        </div>
                    @endif
                    <div class="rounded-3 overflow-hidden border mb-3 bg-light text-center" style="height: 140px;">
                        <img src="{{ asset('dash/images/dark.png') }}" alt="Dark Theme" class="img-fluid h-100 w-100" style="object-fit: cover;">
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="f-w-700 mb-1 f-14">Midnight Dark Theme</h6>
                            <small class="text-muted f-12">dark.css &bull; Crypto Night Mode</small>
                        </div>
                        <button type="button" class="btn btn-sm {{ $settings->website_theme == 'dark.css' ? 'btn-primary' : 'btn-outline-primary' }} rounded-pill px-3">
                            {{ $settings->website_theme == 'dark.css' ? 'Selected' : 'Activate' }}
                        </button>
                    </div>
                </div>
        </div>
    </div>

    <!-- Section 3: Homepage Hero Ambient & Particle Color Grading -->
    <div class="card border p-4 shadow-sm mb-4">
        @if (session()->has('hero_color_message'))
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                <i class="fa fa-check-circle me-1"></i> {{ session('hero_color_message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2 mb-4">
            <div>
                <h5 class="f-w-700 mb-1 d-flex align-items-center gap-2">
                    <i class="fa fa-magic text-warning"></i> Hero Ambient & Particle Color Grading
                </h5>
                <p class="text-muted f-13 mb-0">Configure the glowing ambient light orbs and rising floating bubbles/particles in the homepage Hero section.</p>
            </div>
            <div>
                <span class="badge bg-light-warning text-dark px-3 py-2 rounded-pill f-12 border">
                    <i class="fa fa-sun-o text-warning me-1"></i> Live Color Grading
                </span>
            </div>
        </div>

        <div class="row g-4 align-items-center">
            <!-- Left Column: Live Visual Simulator Preview -->
            <div class="col-lg-5">
                <div class="p-4 rounded-4 position-relative overflow-hidden text-center" 
                     style="background: #090d16; border: 1px solid rgba(255,255,255,0.1); min-height: 220px; box-shadow: 0 10px 30px rgba(0,0,0,0.5);">
                    
                    <!-- Ambient Glow Orb Simulator -->
                    <div id="heroPreviewOrb" style="position: absolute; top: -20px; right: -20px; width: 140px; height: 140px; border-radius: 50%; background: radial-gradient(circle, {{ $hero_accent_color }} 0%, {{ $hero_secondary_color }} 70%, transparent 100%); filter: blur(35px); opacity: 0.6; pointer-events: none; transition: all 0.3s ease;"></div>
                    <div id="heroPreviewOrb2" style="position: absolute; bottom: -30px; left: -20px; width: 120px; height: 120px; border-radius: 50%; background: radial-gradient(circle, {{ $hero_secondary_color }} 0%, transparent 70%); filter: blur(30px); opacity: 0.4; pointer-events: none; transition: all 0.3s ease;"></div>

                    <!-- Floating Dots Simulator -->
                    <div class="position-relative z-1 py-3">
                        <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill mb-2" style="background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.12); font-size: 11px; color: #cbd5e1;">
                            <span class="rounded-circle" id="heroDotIndicator" style="width: 8px; height: 8px; background-color: {{ $hero_accent_color }}; box-shadow: 0 0 8px {{ $hero_accent_color }};"></span>
                            Live Simulation
                        </div>
                        <h6 class="text-white f-w-800 mb-1" style="font-size: 18px; letter-spacing: -0.3px;">
                            Capital, <span id="heroTextAccent" style="color: {{ $hero_accent_color }}; transition: color 0.3s ease;">composed.</span>
                        </h6>
                        <small class="text-muted d-block mb-3" style="font-size: 11px;">Ambient Glow &amp; Floating Particles Preview</small>

                        <!-- Visual Palette Swatch Display -->
                        <div class="d-inline-flex align-items-center gap-2 px-3 py-2 rounded-3" style="background: rgba(0,0,0,0.4); border: 1px solid rgba(255,255,255,0.08);">
                            <span class="text-muted f-11">Gradient:</span>
                            <div class="rounded-circle" id="swatchPrimary" style="width: 18px; height: 18px; background: {{ $hero_accent_color }}; border: 2px solid #fff; box-shadow: 0 0 8px {{ $hero_accent_color }};"></div>
                            <i class="fa fa-arrow-right text-muted f-10"></i>
                            <div class="rounded-circle" id="swatchSecondary" style="width: 18px; height: 18px; background: {{ $hero_secondary_color }}; border: 2px solid #fff; box-shadow: 0 0 8px {{ $hero_secondary_color }};"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Color Pickers & Presets -->
            <div class="col-lg-7">
                <div class="row g-3">
                    <!-- Primary Accent Picker -->
                    <div class="col-md-6">
                        <label class="form-label f-w-600 f-13 text-muted mb-1">
                            Primary Accent (Glow &amp; Rising Bubbles)
                        </label>
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <input type="color" wire:model.defer="hero_accent_color" id="heroAccentInput" class="form-control form-control-color border" value="{{ $hero_accent_color }}" style="width: 48px; height: 40px; cursor: pointer;">
                            <input type="text" wire:model.defer="hero_accent_color" id="heroAccentText" class="form-control text-uppercase font-monospace f-13" value="{{ $hero_accent_color }}" placeholder="#F59E0B">
                        </div>
                        <!-- Presets for Primary -->
                        <div class="d-flex flex-wrap gap-2 pt-1">
                            <button type="button" class="btn btn-xs rounded-pill border px-2 py-1 f-11 d-flex align-items-center gap-1" onclick="setHeroPreset('#F59E0B', '#D97706')" style="background: rgba(245, 158, 11, 0.1); color: #d97706;">
                                <span class="rounded-circle" style="width: 8px; height: 8px; background: #F59E0B;"></span> Warm Gold
                            </button>
                            <button type="button" class="btn btn-xs rounded-pill border px-2 py-1 f-11 d-flex align-items-center gap-1" onclick="setHeroPreset('#00E5FF', '#0284C7')" style="background: rgba(0, 229, 255, 0.1); color: #0284c7;">
                                <span class="rounded-circle" style="width: 8px; height: 8px; background: #00E5FF;"></span> Cyber Cyan
                            </button>
                            <button type="button" class="btn btn-xs rounded-pill border px-2 py-1 f-11 d-flex align-items-center gap-1" onclick="setHeroPreset('#10B981', '#059669')" style="background: rgba(16, 185, 129, 0.1); color: #059669;">
                                <span class="rounded-circle" style="width: 8px; height: 8px; background: #10B981;"></span> Emerald
                            </button>
                            <button type="button" class="btn btn-xs rounded-pill border px-2 py-1 f-11 d-flex align-items-center gap-1" onclick="setHeroPreset('#8B5CF6', '#6D28D9')" style="background: rgba(139, 92, 246, 0.1); color: #6d28d9;">
                                <span class="rounded-circle" style="width: 8px; height: 8px; background: #8B5CF6;"></span> Violet
                            </button>
                            <button type="button" class="btn btn-xs rounded-pill border px-2 py-1 f-11 d-flex align-items-center gap-1" onclick="setHeroPreset('#EF4444', '#DC2626')" style="background: rgba(239, 68, 68, 0.1); color: #dc2626;">
                                <span class="rounded-circle" style="width: 8px; height: 8px; background: #EF4444;"></span> Crimson
                            </button>
                        </div>
                    </div>

                    <!-- Secondary Gradient Color Picker -->
                    <div class="col-md-6">
                        <label class="form-label f-w-600 f-13 text-muted mb-1">
                            Secondary Gradient (Color Grading Tone)
                        </label>
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <input type="color" wire:model.defer="hero_secondary_color" id="heroSecondaryInput" class="form-control form-control-color border" value="{{ $hero_secondary_color }}" style="width: 48px; height: 40px; cursor: pointer;">
                            <input type="text" wire:model.defer="hero_secondary_color" id="heroSecondaryText" class="form-control text-uppercase font-monospace f-13" value="{{ $hero_secondary_color }}" placeholder="#D97706">
                        </div>
                        <small class="text-muted f-11 d-block">
                            Blends with the primary accent to create deep gradient shading and dual-tone ambient lighting.
                        </small>
                    </div>

                    <!-- Action Buttons -->
                    <div class="col-12 pt-3 border-top d-flex align-items-center justify-content-between">
                        <div class="text-muted f-12">
                            <i class="fa fa-info-circle me-1"></i> Changes apply immediately to the homepage.
                        </div>
                        <button type="button" wire:click="saveHeroColors" wire:loading.attr="disabled" class="btn btn-primary rounded-pill px-4">
                            <span wire:loading.remove wire:target="saveHeroColors">
                                <i class="fa fa-save me-1"></i> Save Hero Colors
                            </span>
                            <span wire:loading wire:target="saveHeroColors">
                                <i class="fa fa-spinner fa-spin me-1"></i> Saving...
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    (function() {
        function updateThemePickerActiveState() {
            var currentColor = localStorage.getItem('admiro_accent_color') || '#6362e7';
            document.querySelectorAll('#themeSettingColors .theme-color-btn').forEach(function(btn) {
                if (btn.getAttribute('data-color').toLowerCase() === currentColor.toLowerCase()) {
                    btn.style.boxShadow = '0 0 0 3px #ffffff, 0 0 0 5px ' + currentColor;
                } else {
                    btn.style.boxShadow = 'none';
                }
            });
            var customPicker = document.getElementById('customAccentPicker');
            if (customPicker) {
                customPicker.value = currentColor;
            }

            // Update mode cards active style
            var storedMode = localStorage.getItem('mode');
            var lightCard = document.getElementById('adminLightModeCard');
            var darkCard = document.getElementById('adminDarkModeCard');
            var autoCard = document.getElementById('adminAutoModeCard');

            [lightCard, darkCard, autoCard].forEach(function(card) {
                if (card) {
                    card.classList.remove('border-primary', 'shadow', 'bg-primary', 'bg-opacity-10');
                    card.classList.add('border');
                }
            });

            if (!storedMode) {
                if (autoCard) {
                    autoCard.classList.add('border-primary', 'shadow', 'bg-primary', 'bg-opacity-10');
                    autoCard.classList.remove('border');
                }
            } else if (storedMode === 'dark-only') {
                if (darkCard) {
                    darkCard.classList.add('border-primary', 'shadow', 'bg-primary', 'bg-opacity-10');
                    darkCard.classList.remove('border');
                }
            } else if (storedMode === 'light') {
                if (lightCard) {
                    lightCard.classList.add('border-primary', 'shadow', 'bg-primary', 'bg-opacity-10');
                    lightCard.classList.remove('border');
                }
            }
        }

        // Custom Color Apply
        var customBtn = document.getElementById('applyCustomColorBtn');
        if (customBtn) {
            customBtn.addEventListener('click', function() {
                var picker = document.getElementById('customAccentPicker');
                if (picker && picker.value) {
                    var color = picker.value;
                    document.documentElement.style.setProperty('--theme-default', color);
                    localStorage.setItem('admiro_accent_color', color);
                    updateThemePickerActiveState();
                    if (window.Swal) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Accent Color Updated',
                            text: 'Dashboard accent color set to ' + color,
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }
                }
            });
        }

        // Mode switch function
        window.switchAdminMode = function(mode) {
            if (mode === 'dark-only') {
                document.body.classList.add('dark-only');
                document.body.classList.remove('light');
                document.documentElement.classList.add('dark-only');
                localStorage.setItem('mode', 'dark-only');
                if (window.Swal) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Dark Mode Enabled',
                        text: 'Dashboard appearance set to permanent Dark Mode.',
                        timer: 1800,
                        showConfirmButton: false
                    });
                }
            } else if (mode === 'light') {
                document.body.classList.add('light');
                document.body.classList.remove('dark-only');
                document.documentElement.classList.remove('dark-only');
                localStorage.setItem('mode', 'light');
                if (window.Swal) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Light Mode Enabled',
                        text: 'Dashboard appearance set to permanent Light Mode.',
                        timer: 1800,
                        showConfirmButton: false
                    });
                }
            } else if (mode === 'auto') {
                localStorage.removeItem('mode');
                var prefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
                if (prefersDark) {
                    document.body.classList.add('dark-only');
                    document.body.classList.remove('light');
                    document.documentElement.classList.add('dark-only');
                } else {
                    document.body.classList.add('light');
                    document.body.classList.remove('dark-only');
                    document.documentElement.classList.remove('dark-only');
                }
                if (window.Swal) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Auto System Match Enabled',
                        text: 'Dashboard will now automatically follow your computer or phone theme.',
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
            }
            updateThemePickerActiveState();
        };

        // Wire color buttons inside this tab
        document.querySelectorAll('#themeSettingColors .theme-color-btn').forEach(function(btn) {
            btn.addEventListener('click', function() {
                var color = this.getAttribute('data-color');
                if (color) {
                    document.documentElement.style.setProperty('--theme-default', color);
                    localStorage.setItem('admiro_accent_color', color);
                    updateThemePickerActiveState();
                    if (window.Swal) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Accent Color Updated',
                            text: 'Dashboard accent color has been applied!',
                            timer: 1800,
                            showConfirmButton: false
                        });
                    }
                }
            });
        });

        // Hero Colors Dynamic Live Preview & Presets
        window.setHeroPreset = function(accent, secondary) {
            var accInput = document.getElementById('heroAccentInput');
            var accText = document.getElementById('heroAccentText');
            var secInput = document.getElementById('heroSecondaryInput');
            var secText = document.getElementById('heroSecondaryText');

            if (accInput) { accInput.value = accent; accInput.dispatchEvent(new Event('input')); }
            if (accText) { accText.value = accent; accText.dispatchEvent(new Event('input')); }
            if (secInput) { secInput.value = secondary; secInput.dispatchEvent(new Event('input')); }
            if (secText) { secText.value = secondary; secText.dispatchEvent(new Event('input')); }

            updateHeroSimulator(accent, secondary);
        };

        function updateHeroSimulator(accent, secondary) {
            var orb = document.getElementById('heroPreviewOrb');
            var orb2 = document.getElementById('heroPreviewOrb2');
            var text = document.getElementById('heroTextAccent');
            var dot = document.getElementById('heroDotIndicator');
            var sw1 = document.getElementById('swatchPrimary');
            var sw2 = document.getElementById('swatchSecondary');

            if (orb) orb.style.background = 'radial-gradient(circle, ' + accent + ' 0%, ' + secondary + ' 70%, transparent 100%)';
            if (orb2) orb2.style.background = 'radial-gradient(circle, ' + secondary + ' 0%, transparent 70%)';
            if (text) text.style.color = accent;
            if (dot) {
                dot.style.backgroundColor = accent;
                dot.style.boxShadow = '0 0 8px ' + accent;
            }
            if (sw1) {
                sw1.style.background = accent;
                sw1.style.boxShadow = '0 0 8px ' + accent;
            }
            if (sw2) {
                sw2.style.background = secondary;
                sw2.style.boxShadow = '0 0 8px ' + secondary;
            }
        }

        // Bind input listeners for live instant preview
        ['heroAccentInput', 'heroAccentText'].forEach(function(id) {
            var el = document.getElementById(id);
            if (el) {
                el.addEventListener('input', function() {
                    var acc = this.value;
                    var sec = document.getElementById('heroSecondaryInput') ? document.getElementById('heroSecondaryInput').value : '#D97706';
                    if (id === 'heroAccentInput' && document.getElementById('heroAccentText')) document.getElementById('heroAccentText').value = acc;
                    if (id === 'heroAccentText' && document.getElementById('heroAccentInput')) document.getElementById('heroAccentInput').value = acc;
                    updateHeroSimulator(acc, sec);
                });
            }
        });

        ['heroSecondaryInput', 'heroSecondaryText'].forEach(function(id) {
            var el = document.getElementById(id);
            if (el) {
                el.addEventListener('input', function() {
                    var sec = this.value;
                    var acc = document.getElementById('heroAccentInput') ? document.getElementById('heroAccentInput').value : '#F59E0B';
                    if (id === 'heroSecondaryInput' && document.getElementById('heroSecondaryText')) document.getElementById('heroSecondaryText').value = sec;
                    if (id === 'heroSecondaryText' && document.getElementById('heroSecondaryInput')) document.getElementById('heroSecondaryInput').value = sec;
                    updateHeroSimulator(acc, sec);
                });
            }
        });

        window.updateLocalPaletteSim = function(primary, secondary) {
            var box = document.getElementById('liveGradientPreviewBox');
            var hex = document.getElementById('liveGradientHex');
            var pPick = document.getElementById('siteAccentPicker');
            var pHex = document.getElementById('siteAccentHex');
            var sPick = document.getElementById('siteSecondaryPicker');
            var sHex = document.getElementById('siteSecondaryHex');

            if (box) box.style.background = 'linear-gradient(135deg, ' + primary + ' 0%, ' + secondary + ' 100%)';
            if (hex) hex.textContent = primary + ' \u2192 ' + secondary;
            if (pPick) pPick.value = primary;
            if (pHex) pHex.value = primary;
            if (sPick) sPick.value = secondary;
            if (sHex) sHex.value = secondary;

            document.documentElement.style.setProperty('--theme-default', primary);
            document.documentElement.style.setProperty('--theme-primary', primary);
            document.documentElement.style.setProperty('--theme-secondary', secondary);
            localStorage.setItem('admiro_accent_color', primary);
        };

        // Live input sync for custom pickers
        ['siteAccentPicker', 'siteAccentHex'].forEach(function(id) {
            var el = document.getElementById(id);
            if (el) {
                el.addEventListener('input', function() {
                    var p = this.value;
                    var s = document.getElementById('siteSecondaryHex') ? document.getElementById('siteSecondaryHex').value : '#9F1239';
                    if (id === 'siteAccentPicker' && document.getElementById('siteAccentHex')) document.getElementById('siteAccentHex').value = p;
                    if (id === 'siteAccentHex' && document.getElementById('siteAccentPicker')) document.getElementById('siteAccentPicker').value = p;
                    window.updateLocalPaletteSim(p, s);
                });
            }
        });

        ['siteSecondaryPicker', 'siteSecondaryHex'].forEach(function(id) {
            var el = document.getElementById(id);
            if (el) {
                el.addEventListener('input', function() {
                    var s = this.value;
                    var p = document.getElementById('siteAccentHex') ? document.getElementById('siteAccentHex').value : '#D61C4E';
                    if (id === 'siteSecondaryPicker' && document.getElementById('siteSecondaryHex')) document.getElementById('siteSecondaryHex').value = s;
                    if (id === 'siteSecondaryHex' && document.getElementById('siteSecondaryPicker')) document.getElementById('siteSecondaryPicker').value = s;
                    window.updateLocalPaletteSim(p, s);
                });
            }
        });

        window.addEventListener('site-palette-saved', function(event) {
            var p = event.detail.primary;
            var s = event.detail.secondary;
            window.updateLocalPaletteSim(p, s);
            if (window.Swal) {
                Swal.fire({
                    icon: 'success',
                    title: 'Platform Palette Saved!',
                    text: 'Universal colors and gradient have been committed to the database and updated across all dashboards & pages.',
                    timer: 2400,
                    showConfirmButton: false
                });
            }
        });

        window.addEventListener('hero-colors-saved', function(event) {
            if (window.Swal) {
                Swal.fire({
                    icon: 'success',
                    title: 'Hero Colors Saved!',
                    text: 'Homepage ambient glow & particles now updated with your custom color grading.',
                    timer: 2200,
                    showConfirmButton: false
                });
            }
        });

        // Initialize state on load
        updateThemePickerActiveState();
    })();
</script>
</div>
