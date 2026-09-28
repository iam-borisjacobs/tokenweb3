<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="color-scheme" content="light dark">
    <meta name="supported-color-schemes" content="light dark">
    <title>{{ $subject ?? 'Security Notification' }}</title>
    <style type="text/css">
        :root {
            color-scheme: light dark;
            supported-color-schemes: light dark;
        }
        /* Reset Styles */
        body, table, td, a { -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }
        table, td { mso-table-lspace: 0pt; mso-table-rspace: 0pt; }
        img { -ms-interpolation-mode: bicubic; border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none; }
        
        /* Base Defaults (Dark-First with Light Sensitivity) */
        body { 
            margin: 0; 
            padding: 0; 
            width: 100% !important; 
            height: 100% !important; 
            background-color: #0b0f19; 
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; 
            color: #cbd5e1; 
        }
        
        /* Layout Container */
        .wrapper { width: 100%; background-color: #0b0f19; padding: 32px 12px; }
        .main-card { 
            max-width: 600px; 
            margin: 0 auto; 
            background-color: #131b2e; 
            border: 1px solid #1e293b; 
            border-radius: 16px; 
            overflow: hidden; 
            box-shadow: 0 10px 35px rgba(0, 0, 0, 0.45); 
        }
        
        /* Header */
        .email-header { 
            background: linear-gradient(135deg, #192038 0%, #0f172a 100%); 
            padding: 30px 24px 22px; 
            text-align: center; 
            border-bottom: 1px solid #27334d; 
        }
        .brand-logo-img { 
            max-height: 42px; 
            max-width: 220px; 
            display: inline-block; 
            vertical-align: middle; 
        }
        .brand-text-fallback { 
            display: inline-flex; 
            align-items: center; 
            gap: 8px; 
            font-size: 20px; 
            font-weight: 800; 
            color: #ffffff; 
            letter-spacing: 0.5px; 
            margin: 0; 
            text-decoration: none; 
        }
        .category-pill { 
            display: inline-block; 
            margin-top: 10px; 
            background: rgba(99, 98, 231, 0.18); 
            border: 1px solid rgba(99, 98, 231, 0.4); 
            color: #a5b4fc; 
            font-size: 10.5px; 
            font-weight: 700; 
            text-transform: uppercase; 
            letter-spacing: 0.8px; 
            padding: 4px 14px; 
            border-radius: 50px; 
        }
        
        /* Content Area */
        .email-body { padding: 30px 26px; font-size: 14.5px; line-height: 1.65; color: #cbd5e1; }
        .email-greeting { font-size: 18px; font-weight: 700; color: #ffffff; margin-bottom: 16px; }
        .email-subheading { font-size: 13.5px; color: #94a3b8; margin-top: -8px; margin-bottom: 20px; }
        .email-body p { margin-top: 0; margin-bottom: 16px; }
        .email-body strong { color: #f8fafc; }
        .email-body code { background: #0f172a; border: 1px solid #334155; padding: 2px 7px; border-radius: 5px; color: #38bdf8; font-family: monospace; font-size: 13px; }
        .email-body ul, .email-body ol { margin: 12px 0 18px 20px; padding: 0; }
        .email-body li { margin-bottom: 8px; }
        
        /* Action Button */
        .action-container { text-align: center; margin: 28px 0 20px; }
        .btn-cta { 
            display: inline-block; 
            background: linear-gradient(135deg, #4f46e5 0%, #3b82f6 100%); 
            color: #ffffff !important; 
            font-size: 14px; 
            font-weight: 700; 
            text-decoration: none; 
            padding: 14px 32px; 
            border-radius: 30px; 
            box-shadow: 0 4px 18px rgba(79, 70, 229, 0.4); 
            letter-spacing: 0.3px; 
        }
        
        /* Footer */
        .email-footer { 
            background-color: #0c1220; 
            padding: 24px 26px; 
            text-align: center; 
            border-top: 1px solid #1e293b; 
            font-size: 12px; 
            color: #94a3b8; 
            line-height: 1.6; 
        }
        .footer-links a { color: #60a5fa; text-decoration: none; margin: 0 8px; font-weight: 500; }
        .footer-note { margin-top: 10px; font-size: 11.5px; color: #64748b; }

        /* Light-Mode Client Sensitivity */
        @media (prefers-color-scheme: light) {
            body { background-color: #f1f5f9 !important; color: #334155 !important; }
            .wrapper { background-color: #f1f5f9 !important; }
            .main-card { background-color: #ffffff !important; border-color: #e2e8f0 !important; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06) !important; color: #334155 !important; }
            .email-header { background: linear-gradient(135deg, #f8fafc 0%, #edf2f7 100%) !important; border-bottom-color: #e2e8f0 !important; }
            .brand-text-fallback { color: #0f172a !important; }
            .category-pill { background: rgba(99, 98, 231, 0.1) !important; color: #4f46e5 !important; border-color: rgba(99, 98, 231, 0.25) !important; }
            .email-greeting { color: #0f172a !important; }
            .email-subheading { color: #64748b !important; }
            .email-body { color: #334155 !important; }
            .email-body strong { color: #0f172a !important; }
            .email-body code { background: #f1f5f9 !important; border-color: #cbd5e1 !important; color: #0284c7 !important; }
            .email-footer { background-color: #f8fafc !important; border-top-color: #e2e8f0 !important; color: #64748b !important; }
            .footer-note { color: #94a3b8 !important; }
            .footer-links a { color: #4f46e5 !important; }
        }

        /* Responsive Mobile Layout (< 620px) */
        @media only screen and (max-width: 620px) {
            .wrapper { padding: 12px 6px !important; }
            .email-header { padding: 22px 16px 16px !important; }
            .email-body { padding: 22px 16px !important; font-size: 14px !important; }
            .email-footer { padding: 18px 16px !important; }
            .btn-cta { width: 100% !important; box-sizing: border-box !important; padding: 13px 20px !important; font-size: 13.5px !important; }
        }
    </style>
</head>
<body>
    @if(!empty($preheader))
    <!-- Hidden Preheader Preview Text -->
    <div style="display: none; font-size: 1px; color: #0b0f19; line-height: 1px; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden; mso-hide: all;">
        {{ $preheader }}
    </div>
    @endif

    <div class="wrapper">
        <div class="main-card">
            <!-- Header -->
            <div class="email-header">
                @php
                    $siteName = $settings->site_name ?? config('app.name', 'TokenWeb3');
                    // Smart logo resolution with fallback
                    $logoCandidates = [];
                    if (!empty($settings->dark_logo)) {
                        $logoCandidates[] = asset('storage/' . $settings->dark_logo);
                        $logoCandidates[] = asset('storage/app/public/' . $settings->dark_logo);
                    }
                    if (!empty($settings->logo)) {
                        $logoCandidates[] = asset('storage/' . $settings->logo);
                        $logoCandidates[] = asset('storage/app/public/' . $settings->logo);
                    }
                    $logoCandidates[] = asset('themes/ecx/assets/images/logo/logo-dark.png');
                    $logoCandidates[] = asset('themes/ecx/assets/images/logo/logo.png');
                    $primaryLogo = $logoCandidates[0] ?? null;
                    $fallbackLogo = $logoCandidates[2] ?? ($logoCandidates[1] ?? null);
                @endphp

                <div style="text-align: center;">
                    @if($primaryLogo)
                        <img src="{{ $primaryLogo }}" alt="{{ $siteName }}" class="brand-logo-img" onerror="this.onerror=null; this.src='{{ $fallbackLogo }}'; this.onerror=function(){ this.style.display='none'; this.nextElementSibling.style.display='inline-flex'; };">
                        <span class="brand-text-fallback" style="display: none;">
                            <span style="display: inline-block; width: 10px; height: 10px; border-radius: 50%; background: #6366f1;"></span>
                            {{ $siteName }}
                        </span>
                    @else
                        <h1 class="brand-text-fallback" style="display: inline-flex;">
                            <span style="display: inline-block; width: 10px; height: 10px; border-radius: 50%; background: #6366f1;"></span>
                            {{ $siteName }}
                        </h1>
                    @endif
                </div>

                @if(!empty($category))
                    <div>
                        <span class="category-pill">{{ $category }}</span>
                    </div>
                @endif
            </div>

            <!-- Body -->
            <div class="email-body">
                @if(!empty($greeting))
                    <div class="email-greeting">{{ $greeting }}</div>
                @endif

                <div class="email-content">
                    {!! $body !!}
                </div>

                @if(!empty($action_text) && !empty($action_url))
                    <div class="action-container">
                        <a href="{{ $action_url }}" class="btn-cta" target="_blank">
                            {{ $action_text }} &rarr;
                        </a>
                    </div>
                @endif
            </div>

            <!-- Footer -->
            <div class="email-footer">
                @if(!empty($footer_text))
                    <p style="margin-bottom: 12px; color: #94a3b8; font-size: 12.5px;">{{ $footer_text }}</p>
                @endif

                <div style="margin-bottom: 6px;">
                    &copy; {{ date('Y') }} <strong style="color: #cbd5e1;">{{ $siteName }}</strong>. All rights reserved.
                </div>
                <div class="footer-links" style="margin-top: 8px;">
                    <a href="{{ url('/dashboard') }}" target="_blank">Terminal</a> &bull;
                    <a href="{{ url('/dashboard/connect-wallet') }}" target="_blank">Wallets</a> &bull;
                    <a href="mailto:{{ $settings->contact_email ?? 'security@tokenweb3network.com' }}">Security Operations</a>
                </div>
                <div class="footer-note">
                    This is an automated operational security dispatch. Please do not share account credentials or private phrases.
                </div>
            </div>
        </div>
    </div>
</body>
</html>
