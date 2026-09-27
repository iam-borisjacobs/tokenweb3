<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ $settings->maintenance_title ?? 'System Maintenance & Infrastructure Upgrade' }} | {{ $settings->site_name ?? 'ECX Groups' }}</title>
    
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('storage/' . ($settings->favicon ?? '')) }}" type="image/x-icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@500;700&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --bg-base: #06090e;
            --bg-surface: rgba(14, 20, 31, 0.7);
            --border-subtle: rgba(255, 255, 255, 0.08);
            --border-glow: rgba(56, 189, 248, 0.25);
            --accent-cyan: #00f2fe;
            --accent-blue: #4facfe;
            --accent-amber: #f59e0b;
            --accent-emerald: #10b981;
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
            --text-dim: #64748b;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: var(--bg-base);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            overflow-x: hidden;
            position: relative;
            line-height: 1.6;
        }

        /* Ambient Glow & Grid Background */
        .ambient-bg {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 0;
            pointer-events: none;
            overflow: hidden;
        }

        .ambient-glow-1 {
            position: absolute;
            top: -15%;
            left: 50%;
            transform: translateX(-50%);
            width: 800px;
            height: 500px;
            background: radial-gradient(circle, rgba(0, 242, 254, 0.12) 0%, rgba(79, 172, 254, 0.05) 50%, transparent 70%);
            filter: blur(80px);
        }

        .ambient-glow-2 {
            position: absolute;
            bottom: -20%;
            right: 10%;
            width: 600px;
            height: 450px;
            background: radial-gradient(circle, rgba(245, 158, 11, 0.08) 0%, transparent 60%);
            filter: blur(90px);
        }

        .grid-overlay {
            position: absolute;
            inset: 0;
            background-image: 
                linear-gradient(rgba(255, 255, 255, 0.02) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, 0.02) 1px, transparent 1px);
            background-size: 60px 60px;
            mask-image: radial-gradient(ellipse at center, rgba(0,0,0,0.8) 0%, transparent 75%);
        }

        /* Content Container */
        .main-wrapper {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 1100px;
            margin: 0 auto;
            padding: 40px 24px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* Header / Brand */
        .brand-header {
            margin-bottom: 36px;
            text-align: center;
        }

        .brand-logo {
            max-height: 48px;
            width: auto;
            object-fit: contain;
        }

        .brand-text {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 26px;
            font-weight: 700;
            letter-spacing: -0.5px;
            background: linear-gradient(135deg, #ffffff 40%, var(--accent-cyan) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Status Badge */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 8px 18px;
            background: rgba(245, 158, 11, 0.1);
            border: 1px solid rgba(245, 158, 11, 0.28);
            border-radius: 9999px;
            font-size: 12.5px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: #fbbf24;
            margin-bottom: 24px;
            box-shadow: 0 0 25px rgba(245, 158, 11, 0.15);
        }

        .pulse-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background-color: var(--accent-amber);
            box-shadow: 0 0 10px var(--accent-amber);
            animation: pulse-glow 2s infinite;
        }

        @keyframes pulse-glow {
            0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(245, 158, 11, 0.7); }
            70% { transform: scale(1.1); box-shadow: 0 0 0 8px rgba(245, 158, 11, 0); }
            100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(245, 158, 11, 0); }
        }

        /* Hero Typography */
        .hero-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: clamp(28px, 5vw, 44px);
            font-weight: 700;
            line-height: 1.2;
            letter-spacing: -0.8px;
            text-align: center;
            margin-bottom: 18px;
            background: linear-gradient(180deg, #ffffff 0%, #cbd5e1 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            max-width: 850px;
        }

        .hero-desc {
            font-size: 16px;
            color: var(--text-muted);
            text-align: center;
            max-width: 720px;
            margin-bottom: 40px;
            line-height: 1.7;
        }

        /* Countdown Card */
        .countdown-container {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 16px;
            margin-bottom: 48px;
            flex-wrap: wrap;
        }

        .countdown-box {
            background: rgba(14, 20, 31, 0.85);
            border: 1px solid var(--border-subtle);
            border-radius: 16px;
            padding: 16px 20px;
            min-width: 95px;
            text-align: center;
            backdrop-filter: blur(12px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.3);
            position: relative;
            overflow: hidden;
        }

        .countdown-box::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        }

        .countdown-number {
            font-family: 'JetBrains Mono', monospace;
            font-size: 32px;
            font-weight: 700;
            color: #ffffff;
            line-height: 1.1;
            margin-bottom: 4px;
        }

        .countdown-label {
            font-size: 10.5px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: var(--text-dim);
        }

        /* Guarantee Pillars */
        .pillars-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            width: 100%;
            margin-bottom: 48px;
        }

        .pillar-card {
            background: rgba(15, 23, 42, 0.6);
            border: 1px solid var(--border-subtle);
            border-radius: 16px;
            padding: 24px;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
            position: relative;
        }

        .pillar-card:hover {
            border-color: rgba(56, 189, 248, 0.3);
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.25);
        }

        .pillar-icon-box {
            width: 42px;
            height: 42px;
            border-radius: 10px;
            background: rgba(56, 189, 248, 0.1);
            border: 1px solid rgba(56, 189, 248, 0.2);
            color: var(--accent-cyan);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            margin-bottom: 16px;
        }

        .pillar-title {
            font-size: 15px;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 8px;
        }

        .pillar-desc {
            font-size: 13px;
            color: var(--text-muted);
            line-height: 1.5;
        }

        /* Live Operational Telemetry Bar */
        .telemetry-bar {
            width: 100%;
            background: rgba(10, 15, 24, 0.7);
            border: 1px solid var(--border-subtle);
            border-radius: 12px;
            padding: 14px 20px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            gap: 16px;
            margin-bottom: 40px;
        }

        .telemetry-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 12px;
            font-family: 'JetBrains Mono', monospace;
        }

        .telemetry-label {
            color: var(--text-dim);
        }

        .telemetry-val {
            color: #38bdf8;
            font-weight: 600;
        }

        .telemetry-val.green {
            color: #34d399;
        }

        /* Support Actions */
        .support-actions {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 14px;
            flex-wrap: wrap;
            margin-bottom: 24px;
        }

        .btn-action {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 24px;
            border-radius: 12px;
            font-size: 13.5px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.25s ease;
        }

        .btn-primary-action {
            background: linear-gradient(135deg, #00f2fe 0%, #4facfe 100%);
            color: #000000;
            box-shadow: 0 4px 20px rgba(0, 242, 254, 0.3);
        }

        .btn-primary-action:hover {
            opacity: 0.95;
            transform: translateY(-2px);
            box-shadow: 0 6px 25px rgba(0, 242, 254, 0.4);
        }

        .btn-secondary-action {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--border-subtle);
            color: var(--text-main);
        }

        .btn-secondary-action:hover {
            background: rgba(255, 255, 255, 0.08);
            border-color: rgba(255, 255, 255, 0.2);
            color: #ffffff;
        }

        /* Footer */
        .page-footer {
            position: relative;
            z-index: 10;
            border-top: 1px solid var(--border-subtle);
            padding: 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 16px;
            font-size: 12px;
            color: var(--text-dim);
            width: 100%;
            max-width: 1100px;
            margin: 0 auto;
        }

        .admin-link {
            color: var(--text-dim);
            text-decoration: none;
            transition: color 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .admin-link:hover {
            color: #94a3b8;
        }
    </style>
</head>
<body>
    <div class="ambient-bg">
        <div class="ambient-glow-1"></div>
        <div class="ambient-glow-2"></div>
        <div class="grid-overlay"></div>
    </div>

    <div class="main-wrapper">
        <!-- Brand Header -->
        <div class="brand-header">
            @if(!empty($settings->logo))
                <img src="{{ asset('storage/' . $settings->logo) }}" alt="{{ $settings->site_name ?? 'ECX Groups' }}" class="brand-logo">
            @else
                <div class="brand-text">{{ $settings->site_name ?? 'ECX Groups' }}</div>
            @endif
        </div>

        <!-- Status Indicator -->
        <div class="status-badge">
            <span class="pulse-dot"></span>
            <span>Platform Optimization in Progress</span>
        </div>

        <!-- Title & Subtitle -->
        <h1 class="hero-title">
            {{ $settings->maintenance_title ?? 'System Maintenance & Infrastructure Upgrade' }}
        </h1>
        <p class="hero-desc">
            {{ $settings->maintenance_message ?? 'Our quantitative trading infrastructure is currently undergoing scheduled platform optimization and core security upgrades. All client funds, segregated cold vaults, and active investment plans remain 100% secure. Full operations will resume shortly.' }}
        </p>

        <!-- Dynamic Countdown Timer (if maintenance_until is set in future) -->
        @if(!empty($settings->maintenance_until) && \Carbon\Carbon::parse($settings->maintenance_until)->isFuture())
            <div class="countdown-container" id="maintenanceCountdown" data-target="{{ \Carbon\Carbon::parse($settings->maintenance_until)->toISOString() }}">
                <div class="countdown-box">
                    <div class="countdown-number" id="cdDays">00</div>
                    <div class="countdown-label">Days</div>
                </div>
                <div class="countdown-box">
                    <div class="countdown-number" id="cdHours">00</div>
                    <div class="countdown-label">Hours</div>
                </div>
                <div class="countdown-box">
                    <div class="countdown-number" id="cdMinutes">00</div>
                    <div class="countdown-label">Minutes</div>
                </div>
                <div class="countdown-box">
                    <div class="countdown-number" id="cdSeconds">00</div>
                    <div class="countdown-label">Seconds</div>
                </div>
            </div>
        @endif

        <!-- 4 Institutional Trust Pillars -->
        <div class="pillars-grid">
            <div class="pillar-card">
                <div class="pillar-icon-box">
                    <i class="fa-solid fa-vault"></i>
                </div>
                <div class="pillar-title">100% Segregated Cold Vaults</div>
                <div class="pillar-desc">
                    All digital assets remain strictly isolated in hardware security modules with multi-sig protection. Custody is completely untouched.
                </div>
            </div>

            <div class="pillar-card">
                <div class="pillar-icon-box">
                    <i class="fa-solid fa-chart-line"></i>
                </div>
                <div class="pillar-title">Trading Engines Running</div>
                <div class="pillar-desc">
                    Autonomous quantitative arbitrage bots continue executing micro-spread harvesting across Tier-1 liquidity venues.
                </div>
            </div>

            <div class="pillar-card">
                <div class="pillar-icon-box">
                    <i class="fa-solid fa-shield-halved"></i>
                </div>
                <div class="pillar-title">Zero Rehypothecation</div>
                <div class="pillar-desc">
                    1:1 reserve verification protocols remain active. No customer funds are lent or leveraged during database optimization.
                </div>
            </div>

            <div class="pillar-card">
                <div class="pillar-icon-box">
                    <i class="fa-solid fa-clock-rotate-left"></i>
                </div>
                <div class="pillar-title">Automated Yield Accrual</div>
                <div class="pillar-desc">
                    Contractual daily earnings calculations continue uninterrupted and will be credited to portfolios upon full portal access.
                </div>
            </div>
        </div>

        <!-- Telemetry Status Bar -->
        <div class="telemetry-bar">
            <div class="telemetry-item">
                <span class="telemetry-label">SECURITY PROTOCOL:</span>
                <span class="telemetry-val green">AES-256 ENCRYPTED</span>
            </div>
            <div class="telemetry-item">
                <span class="telemetry-label">ARBITRAGE BOT:</span>
                <span class="telemetry-val">OPERATIONAL (ACTIVE)</span>
            </div>
            <div class="telemetry-item">
                <span class="telemetry-label">DATABASE SYNC:</span>
                <span class="telemetry-val">UPDATING INDICES</span>
            </div>
            <div class="telemetry-item">
                <span class="telemetry-label">COLD STORAGE:</span>
                <span class="telemetry-val green">100% BACKED</span>
            </div>
        </div>

        <!-- Emergency Support Channels -->
        <div class="support-actions">
            @if(!empty($settings->contact_email))
                <a href="mailto:{{ $settings->contact_email }}" class="btn-action btn-primary-action">
                    <i class="fa-solid fa-envelope"></i>
                    <span>Contact Support Desk</span>
                </a>
            @endif

            @if(!empty($settings->phone))
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings->phone) }}?text=Hello%20Support%20Desk,%20inquiry%20regarding%20platform%20maintenance" target="_blank" class="btn-action btn-secondary-action">
                    <i class="fa-brands fa-whatsapp text-success"></i>
                    <span>WhatsApp Urgent Line</span>
                </a>
            @endif
        </div>
    </div>

    <!-- Page Footer -->
    <div class="page-footer">
        <div>
            &copy; {{ date('Y') }} {{ $settings->site_name ?? 'ECX Groups' }}. All rights reserved. Quantitative Digital Asset Platform.
        </div>
        <div>
            <a href="{{ route('adminloginform') }}" class="admin-link">
                <i class="fa-solid fa-lock"></i>
                <span>Admin Gateway</span>
            </a>
        </div>
    </div>

    @if(!empty($settings->maintenance_until))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('maintenanceCountdown');
            if (!container) return;

            const targetTime = new Date(container.getAttribute('data-target')).getTime();
            const daysEl = document.getElementById('cdDays');
            const hoursEl = document.getElementById('cdHours');
            const minutesEl = document.getElementById('cdMinutes');
            const secondsEl = document.getElementById('cdSeconds');

            function updateTimer() {
                const now = new Date().getTime();
                const diff = targetTime - now;

                if (diff <= 0) {
                    if (daysEl) daysEl.textContent = '00';
                    if (hoursEl) hoursEl.textContent = '00';
                    if (minutesEl) minutesEl.textContent = '00';
                    if (secondsEl) secondsEl.textContent = '00';
                    return;
                }

                const d = Math.floor(diff / (1000 * 60 * 60 * 24));
                const h = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const m = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                const s = Math.floor((diff % (1000 * 60)) / 1000);

                if (daysEl) daysEl.textContent = String(d).padStart(2, '0');
                if (hoursEl) hoursEl.textContent = String(h).padStart(2, '0');
                if (minutesEl) minutesEl.textContent = String(m).padStart(2, '0');
                if (secondsEl) secondsEl.textContent = String(s).padStart(2, '0');
            }

            updateTimer();
            setInterval(updateTimer, 1000);
        });
    </script>
    @endif
</body>
</html>
