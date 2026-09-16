<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome & Security Onboarding</title>
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
        .hero-icon { width: 64px; height: 64px; margin: 0 auto 20px; background: linear-gradient(135deg, rgba(99, 102, 241, 0.2) 0%, rgba(59, 130, 246, 0.2) 100%); border: 1px solid rgba(99, 102, 241, 0.35); border-radius: 50%; text-align: center; line-height: 64px; font-size: 28px; }
        .headline { font-size: 22px; font-weight: 700; color: #ffffff; text-align: center; margin: 0 0 12px; }
        .subheadline { font-size: 14px; line-height: 1.6; color: #94a3b8; text-align: center; margin: 0 0 26px; }
        
        /* Intro Card */
        .system-card { background-color: #0f172a; border: 1px solid #1e293b; border-radius: 12px; padding: 22px; margin-bottom: 25px; }
        .system-title { font-size: 15px; font-weight: 700; color: #ffffff; margin: 0 0 8px; }
        .system-text { font-size: 13px; line-height: 1.6; color: #cbd5e1; margin: 0; }
        
        /* FTX Security Advisory Box */
        .ftx-alert-card { background: linear-gradient(135deg, rgba(239, 68, 68, 0.08) 0%, rgba(245, 158, 11, 0.06) 100%); border: 1px solid rgba(239, 68, 68, 0.3); border-radius: 12px; padding: 22px; margin-bottom: 25px; }
        .ftx-badge { display: inline-block; background-color: rgba(239, 68, 68, 0.18); border: 1px solid rgba(239, 68, 68, 0.4); color: #fca5a5; font-size: 10px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px; padding: 3px 10px; border-radius: 10px; margin-bottom: 10px; }
        .ftx-title { font-size: 15px; font-weight: 700; color: #ffffff; margin: 0 0 10px; }
        .ftx-text { font-size: 12.5px; line-height: 1.6; color: #e2e8f0; margin: 0 0 12px; }
        .ftx-text:last-child { margin-bottom: 0; }
        
        /* Checklist Box */
        .checklist-box { background-color: #0f172a; border: 1px solid #1e293b; border-radius: 12px; padding: 20px; margin-bottom: 28px; }
        .checklist-title { font-size: 13px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; color: #818cf8; margin: 0 0 14px; }
        .check-item { font-size: 12.5px; line-height: 1.55; color: #cbd5e1; margin-bottom: 12px; padding-left: 24px; position: relative; }
        .check-item:last-child { margin-bottom: 0; }
        .check-icon { position: absolute; left: 0; top: 0; }
        .check-item strong { color: #ffffff; }

        .btn-primary { display: block; width: 100%; max-width: 290px; margin: 0 auto 20px; background: linear-gradient(135deg, #4f46e5 0%, #3b82f6 100%); color: #ffffff !important; text-align: center; padding: 15px 24px; font-size: 14px; font-weight: 700; text-decoration: none; border-radius: 30px; box-shadow: 0 8px 20px rgba(79, 70, 229, 0.35); }
        .alt-login { font-size: 12px; color: #64748b; text-align: center; margin: 0 0 25px; }
        .alt-login a { color: #60a5fa; text-decoration: underline; word-break: break-all; }

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
                    🔒 Official Security Onboarding
                </div>
            </div>

            <!-- Body -->
            <div class="email-body">
                <div class="hero-icon">
                    🛡️
                </div>
                <h1 class="headline">Welcome to {{ $siteTitle }}</h1>
                <p class="subheadline">
                    Hurray <strong style="color: #ffffff;">{{ $user->name }}</strong>!<br>
                    Your investor account and sovereign asset terminal have been initialized successfully.
                </p>

                <!-- What The System Is All About -->
                <div class="system-card">
                    <h2 class="system-title">About Your Account Terminal</h2>
                    <p class="system-text">
                        <strong>{{ $siteTitle }}</strong> is an institutional-grade, multi-asset management terminal designed with defense-in-depth security principles. Our architecture separates decentralized Web3 connectivity, real-world asset allocations, and high-frequency market intelligence while maintaining strict client sovereignty over all credentials.
                    </p>
                </div>

                <!-- The FTX 2022 Lesson Advisory -->
                <div class="ftx-alert-card">
                    <div class="ftx-badge">
                        ⚠️ Critical Security Advisory &bull; Non-Custodial Protection
                    </div>
                    <h2 class="ftx-title">Lessons From The 2022 FTX Collapse</h2>
                    <p class="ftx-text">
                        In late 2022, the collapse of centralized entities like FTX exposed the fundamental hazard of centralized exchange custody: when third-party platforms hold your private keys and commingle client balances into speculative internal accounts, your funds are exposed to catastrophic counterparty risk.
                    </p>
                    <p class="ftx-text">
                        <strong>Our Commitment to You:</strong> At {{ $siteTitle }}, we operate under a strict non-custodial and segregated vault policy. We do not hold custody of your secret recovery words, nor do we lend or commingle client assets. Your Web3 wallet connections remain isolated under hardware-level AES-256 cryptographic protection.
                    </p>
                </div>

                <!-- Essential Security Hygiene Checklist -->
                <div class="checklist-box">
                    <div class="checklist-title">Essential Security Best Practices</div>
                    <div class="check-item">
                        <span class="check-icon">🔒</span>
                        <strong>Never Disclose Recovery Words:</strong> Never share your 12 or 24-word secret recovery phrases with anyone. {{ $siteTitle }} staff and support will NEVER ask for your private keys.
                    </div>
                    <div class="check-item">
                        <span class="check-icon">🛡️</span>
                        <strong>Activate Two-Factor Authentication (2FA):</strong> Enable app-based 2FA on your profile immediately to prevent unauthorized access even if your password is compromised.
                    </div>
                    <div class="check-item">
                        <span class="check-icon">🌐</span>
                        <strong>Verify Official Domain URLs:</strong> Always verify that you are connecting securely over HTTPS on our official domain before entering credentials or approving wallet links.
                    </div>
                    <div class="check-item">
                        <span class="check-icon">⚡</span>
                        <strong>Monitor Session Origins:</strong> Keep your registered email updated and review all automated connection notifications whenever a new wallet or device is authorized.
                    </div>
                </div>

                <!-- Action Button -->
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td align="center">
                            <a href="{{ route('dashboard') }}" class="btn-primary" target="_blank">
                                Access Your Security Terminal →
                            </a>
                        </td>
                    </tr>
                </table>

                <div class="alt-login">
                    Direct terminal access link:<br>
                    <a href="{{ route('dashboard') }}" target="_blank">{{ route('dashboard') }}</a>
                </div>
            </div>

            <!-- Footer -->
            <div class="email-footer">
                <p class="footer-text">
                    This registration security onboarding notification was dispatched to <strong>{{ $user->email }}</strong> for username <strong>{{ $user->username }}</strong>.
                </p>
                <p class="footer-text">
                    &copy; {{ date('Y') }} {{ $siteTitle }}. All rights reserved.
                </p>
                <div class="footer-links">
                    <a href="{{ route('dashboard') }}">Dashboard</a> &bull;
                    <a href="{{ route('portfolio') }}">My Portfolio</a> &bull;
                    <a href="{{ route('connect.wallet') }}">Connect Wallet</a> &bull;
                    <a href="mailto:{{ $settings->contact_email ?? 'security@ecxgroups.com' }}">Security Team</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
