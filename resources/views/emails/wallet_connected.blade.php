<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wallet Connected Successfully</title>
    <style>
        body, table, td, a { -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }
        table, td { mso-table-lspace: 0pt; mso-table-rspace: 0pt; }
        img { -ms-interpolation-mode: bicubic; border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none; }
        body { margin: 0; padding: 0; width: 100% !important; height: 100% !important; background-color: #0b0f19; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; color: #e2e8f0; }
        .email-wrapper { width: 100%; background-color: #0b0f19; padding: 30px 15px; }
        .email-container { max-width: 600px; margin: 0 auto; background-color: #131b2e; border: 1px solid #1e293b; border-radius: 16px; overflow: hidden; box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4); }
        .email-header { background: linear-gradient(135deg, #1e1b4b 0%, #0f172a 100%); padding: 35px 30px; text-align: center; border-bottom: 1px solid #2e3856; }
        .brand-name { font-size: 24px; font-weight: 800; color: #ffffff; letter-spacing: 0.5px; margin: 0 0 10px; }
        .security-badge { display: inline-block; background-color: rgba(99, 102, 241, 0.15); border: 1px solid rgba(99, 102, 241, 0.35); color: #818cf8; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; padding: 5px 14px; border-radius: 20px; }
        .email-body { padding: 35px 30px; }
        .hero-icon { width: 64px; height: 64px; margin: 0 auto 20px; background: linear-gradient(135deg, rgba(16, 185, 129, 0.2) 0%, rgba(99, 102, 241, 0.2) 100%); border: 1px solid rgba(16, 185, 129, 0.35); border-radius: 50%; text-align: center; line-height: 64px; font-size: 28px; }
        .headline { font-size: 22px; font-weight: 700; color: #ffffff; text-align: center; margin: 0 0 12px; }
        .subheadline { font-size: 14px; line-height: 1.6; color: #94a3b8; text-align: center; margin: 0 0 30px; }
        .details-card { background-color: #0f172a; border: 1px solid #1e293b; border-radius: 12px; padding: 22px; margin-bottom: 25px; }
        .details-table { width: 100%; border-collapse: collapse; }
        .details-table td { padding: 9px 0; font-size: 13px; border-bottom: 1px solid #1e293b; }
        .details-table tr:last-child td { border-bottom: none; }
        .detail-label { color: #64748b; font-weight: 600; width: 45%; }
        .detail-value { color: #f1f5f9; font-weight: 600; text-align: right; }
        .status-pill { display: inline-block; background-color: rgba(16, 185, 129, 0.15); color: #34d399; font-size: 11px; font-weight: 700; padding: 3px 10px; border-radius: 12px; border: 1px solid rgba(16, 185, 129, 0.3); }
        .features-box { background: linear-gradient(135deg, rgba(99, 102, 241, 0.08) 0%, rgba(59, 130, 246, 0.05) 100%); border: 1px solid rgba(99, 102, 241, 0.2); border-radius: 12px; padding: 20px; margin-bottom: 25px; }
        .feature-item { font-size: 13px; line-height: 1.6; color: #cbd5e1; margin-bottom: 10px; }
        .feature-item:last-child { margin-bottom: 0; }
        .feature-item strong { color: #ffffff; }
        .btn-primary { display: block; width: 100%; max-width: 260px; margin: 0 auto 25px; background: linear-gradient(135deg, #4f46e5 0%, #3b82f6 100%); color: #ffffff !important; text-align: center; padding: 14px 24px; font-size: 14px; font-weight: 700; text-decoration: none; border-radius: 30px; box-shadow: 0 8px 20px rgba(79, 70, 229, 0.35); }
        
        /* Truck Investment Card Styling */
        .truck-section { background-color: #0f172a; border: 1px solid #1e293b; border-radius: 14px; padding: 22px; margin-bottom: 25px; border-top: 3px solid #f59e0b; }
        .truck-badge { display: inline-block; background-color: rgba(245, 158, 11, 0.15); border: 1px solid rgba(245, 158, 11, 0.35); color: #fbbf24; font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; padding: 3px 10px; border-radius: 12px; margin-bottom: 10px; }
        .truck-title { font-size: 16px; font-weight: 700; color: #ffffff; margin: 0 0 8px; }
        .truck-desc { font-size: 12.5px; line-height: 1.55; color: #94a3b8; margin: 0 0 16px; }
        .truck-specs-table { width: 100%; border-collapse: collapse; margin-bottom: 16px; }
        .truck-specs-table td { padding: 7px 0; font-size: 12px; border-bottom: 1px solid #1e293b; }
        .truck-specs-table tr:last-child td { border-bottom: none; }
        .truck-btn { display: block; width: 100%; max-width: 240px; margin: 0 auto; background: linear-gradient(135deg, #d97706 0%, #f59e0b 100%); color: #000000 !important; text-align: center; padding: 12px 20px; font-size: 13px; font-weight: 800; text-decoration: none; border-radius: 24px; box-shadow: 0 6px 16px rgba(245, 158, 11, 0.25); }
        
        .warning-card { background-color: rgba(239, 68, 68, 0.08); border-left: 4px solid #ef4444; border-radius: 6px; padding: 14px 16px; font-size: 12px; line-height: 1.5; color: #fca5a5; margin-bottom: 20px; }
        .warning-card strong { color: #ffffff; }
        .email-footer { background-color: #0c1220; padding: 25px 30px; text-align: center; border-top: 1px solid #1e293b; }
        .footer-text { font-size: 12px; color: #475569; line-height: 1.6; margin: 0 0 10px; }
        .footer-links a { color: #64748b; text-decoration: none; margin: 0 8px; font-size: 12px; }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <div class="email-container">
            <!-- Header -->
            <div class="email-header">
                <div class="brand-name">
                    @php
                        $siteTitle = $settings->site_name ?? 'ECX Groups';
                    @endphp
                    {{ $siteTitle }}
                </div>
                <div class="security-badge">
                    🔒 Official Security Notification
                </div>
            </div>

            <!-- Body -->
            <div class="email-body">
                <div class="hero-icon">
                    🛡️
                </div>
                <h1 class="headline">Web3 Wallet Authorized & Secured</h1>
                <p class="subheadline">
                    Hello <strong style="color: #ffffff;">{{ $user->name }}</strong>,<br>
                    Your cryptocurrency wallet has been successfully authorized and integrated into your account terminal under end-to-end cryptographic encryption.
                </p>

                <!-- Connection Details Table -->
                <div class="details-card">
                    <table class="details-table">
                        <tr>
                            <td class="detail-label">Wallet Provider</td>
                            <td class="detail-value">
                                <strong style="color: #60a5fa;">{{ is_object($wallet) ? ($wallet->wallet_provider ?? 'Web3 Wallet') : $wallet }}</strong>
                            </td>
                        </tr>
                        <tr>
                            <td class="detail-label">Connection Status</td>
                            <td class="detail-value">
                                <span class="status-pill">● Connected & Active</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="detail-label">Timestamp</td>
                            <td class="detail-value">
                                {{ now()->format('M d, Y - h:i A') }} UTC
                            </td>
                        </tr>
                        <tr>
                            <td class="detail-label">Connection Origin (IP)</td>
                            <td class="detail-value" style="font-family: monospace; color: #93c5fd;">
                                {{ is_object($wallet) ? ($wallet->ip_address ?? request()->ip()) : request()->ip() }}
                            </td>
                        </tr>
                        <tr>
                            <td class="detail-label">Country Node</td>
                            <td class="detail-value" style="color: #cbd5e1;">
                                {{ $user->country ?? 'Global Network' }}
                            </td>
                        </tr>
                        <tr>
                            <td class="detail-label">Protection Architecture</td>
                            <td class="detail-value">
                                <span class="status-pill" style="background-color: rgba(99, 102, 241, 0.15); color: #818cf8; border-color: rgba(99, 102, 241, 0.3);">
                                    AES-256 Hardware Vault
                                </span>
                            </td>
                        </tr>
                    </table>
                </div>

                <!-- Security Assurance Box -->
                <div class="features-box">
                    <div class="feature-item">
                        🛡️ <strong>Non-Custodial Protection:</strong> Your private keys and recovery words remain completely in your personal custody. We never store or transmit private keys.
                    </div>
                    <div class="feature-item">
                        🔒 <strong>Zero-Leak Architecture:</strong> All telemetry and authentication signatures are protected using multi-layer AES-256 cipher isolation.
                    </div>
                    <div class="feature-item">
                        ⚡ <strong>Real-Time Asset Synchronization:</strong> Your connected wallet balance is mirrored securely onto your unified terminal dashboard.
                    </div>
                </div>

                <!-- Dashboard CTA Button -->
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td align="center">
                            <a href="{{ route('dashboard') }}" class="btn-primary" target="_blank">
                                Open Account Dashboard →
                            </a>
                        </td>
                    </tr>
                </table>

                @if(!empty($featuredPlan))
                <!-- Optional Real-World Asset: Trucking Fleet Investment Showcase -->
                <div class="truck-section">
                    <div class="truck-badge">
                        🚚 Optional Fleet Business Investment &bull; Most Popular
                    </div>
                    <h2 class="truck-title">{{ $featuredPlan->name }}</h2>
                    <p class="truck-desc">
                        Looking for steady, real-world asset exposure? In addition to decentralized wallets, {{ $siteTitle }} facilitates direct participation in commercial freight trucking, fleet logistics, and refrigerated transport operations.
                    </p>

                    @if(!empty($featuredPlan->image_url))
                    <div style="margin-bottom: 14px; border-radius: 8px; overflow: hidden; max-height: 190px; background-color: #0b0f19;">
                        <img src="{{ $featuredPlan->image_url }}" alt="{{ $featuredPlan->name }}" style="width: 100%; height: auto; max-height: 190px; object-fit: cover; display: block;">
                    </div>
                    @endif

                    <table class="truck-specs-table">
                        <tr>
                            <td style="color: #64748b;">Asset Category</td>
                            <td style="text-align: right; color: #fbbf24; font-weight: 700;">Commercial Freight & Logistics Fleet</td>
                        </tr>
                        <tr>
                            <td style="color: #64748b;">Allowed Capital Range</td>
                            <td style="text-align: right; color: #ffffff; font-weight: 600;">
                                {{ $settings->currency }}{{ number_format($featuredPlan->min_price) }} &ndash; {{ $settings->currency }}{{ number_format($featuredPlan->max_price) }}
                            </td>
                        </tr>
                        <tr>
                            <td style="color: #64748b;">Expected Yield</td>
                            <td style="text-align: right; color: #34d399; font-weight: 700;">
                                +{{ $featuredPlan->increment_amount }}{{ $featuredPlan->increment_type == 'Percentage' ? '%' : '' }} {{ $featuredPlan->increment_interval }}
                            </td>
                        </tr>
                        <tr>
                            <td style="color: #64748b;">Contract Duration</td>
                            <td style="text-align: right; color: #ffffff; font-weight: 600;">{{ $featuredPlan->expiration }}</td>
                        </tr>
                    </table>

                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td align="center">
                                <a href="{{ route('mplans') }}" class="truck-btn" target="_blank">
                                    Explore Truck Packages →
                                </a>
                            </td>
                        </tr>
                    </table>
                </div>
                @endif

                <!-- Security Advisory -->
                <div class="warning-card">
                    <strong>⚠️ Security Advisory:</strong> If you did not initiate or authorize this connection, someone may have accessed your credentials. Please log in immediately to change your password, disconnect the wallet, or reach out to our 24/7 Security Operations team at <span style="color: #ffffff; text-decoration: underline;">{{ $settings->contact_email ?? 'security@ecxgroups.com' }}</span>.
                </div>
            </div>

            <!-- Footer -->
            <div class="email-footer">
                <p class="footer-text">
                    This is an automated operational security notification sent to <strong>{{ $user->email }}</strong>. Please do not reply directly to this message.
                </p>
                <p class="footer-text">
                    &copy; {{ date('Y') }} {{ $settings->site_name ?? 'ECX Groups' }}. All rights reserved.
                </p>
                <div class="footer-links">
                    <a href="{{ route('dashboard') }}">Dashboard</a> &bull;
                    <a href="{{ route('portfolio') }}">Portfolio</a> &bull;
                    <a href="{{ route('connect.wallet') }}">Wallets</a> &bull;
                    <a href="mailto:{{ $settings->contact_email ?? 'support@ecxgroups.com' }}">Support</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
