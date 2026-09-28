<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $subject ?? 'Notification' }}</title>
    <style type="text/css">
        /* Reset Styles */
        body, table, td, a { -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }
        table, td { mso-table-lspace: 0pt; mso-table-rspace: 0pt; }
        img { -ms-interpolation-mode: bicubic; border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none; }
        body { margin: 0; padding: 0; width: 100% !important; height: 100% !important; background-color: #0c101d; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; color: #cbd5e1; }
        
        /* Container Layout */
        .wrapper { width: 100%; background-color: #0c101d; padding: 32px 12px; }
        .main-card { max-width: 600px; margin: 0 auto; background-color: #141b2d; border: 1px solid #1e293b; border-radius: 16px; overflow: hidden; box-shadow: 0 10px 35px rgba(0, 0, 0, 0.45); }
        
        /* Header */
        .email-header { background: linear-gradient(135deg, #192038 0%, #0f172a 100%); padding: 32px 28px 24px; text-align: center; border-bottom: 1px solid #27334d; }
        .brand-logo-img { max-height: 44px; max-width: 200px; display: inline-block; vertical-align: middle; }
        .brand-text { font-size: 22px; font-weight: 800; color: #ffffff; letter-spacing: 0.5px; margin: 0; }
        .category-pill { display: inline-block; margin-top: 10px; background: rgba(99, 98, 231, 0.15); border: 1px solid rgba(99, 98, 231, 0.35); color: #a5b4fc; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.8px; padding: 4px 12px; border-radius: 50px; }
        
        /* Content Area */
        .email-body { padding: 32px 28px; font-size: 14.5px; line-height: 1.65; color: #cbd5e1; }
        .email-greeting { font-size: 18px; font-weight: 700; color: #ffffff; margin-bottom: 18px; }
        .email-body p { margin-top: 0; margin-bottom: 16px; }
        .email-body strong { color: #f8fafc; }
        .email-body code { background: #0f172a; border: 1px solid #334155; padding: 2px 7px; border-radius: 5px; color: #38bdf8; font-family: monospace; font-size: 13.5px; }
        .email-body ul, .email-body ol { margin: 12px 0 18px 20px; padding: 0; }
        .email-body li { margin-bottom: 8px; }
        
        /* Action Button */
        .action-container { text-align: center; margin: 28px 0 20px; }
        .btn-cta { display: inline-block; background: linear-gradient(135deg, #4f46e5 0%, #3b82f6 100%); color: #ffffff !important; font-size: 14px; font-weight: 700; text-decoration: none; padding: 14px 32px; border-radius: 30px; box-shadow: 0 4px 18px rgba(79, 70, 229, 0.4); letter-spacing: 0.3px; }
        
        /* Footer */
        .email-footer { background-color: #0b0f19; padding: 24px 28px; text-align: center; border-top: 1px solid #1e293b; font-size: 12px; color: #64748b; line-height: 1.6; }
        .footer-links a { color: #94a3b8; text-decoration: none; margin: 0 8px; }
        .footer-note { margin-top: 10px; font-size: 11px; color: #475569; }

        /* Responsive Mobile */
        @media only screen and (max-width: 620px) {
            .wrapper { padding: 16px 8px !important; }
            .email-header { padding: 24px 18px 18px !important; }
            .email-body { padding: 24px 18px !important; font-size: 14px !important; }
            .email-footer { padding: 20px 18px !important; }
            .btn-cta { width: 100% !important; box-sizing: border-box !important; padding: 14px 20px !important; }
        }
    </style>
</head>
<body>
    @if(!empty($preheader))
    <!-- Hidden Preheader Preview Text -->
    <div style="display: none; font-size: 1px; color: #0c101d; line-height: 1px; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;">
        {{ $preheader }}
    </div>
    @endif

    <div class="wrapper">
        <div class="main-card">
            <!-- Header -->
            <div class="email-header">
                @php
                    $siteName = $settings->site_name ?? config('app.name', 'TokenWeb3');
                    $logo = !empty($settings->dark_logo) ? asset('storage/' . $settings->dark_logo) : (!empty($settings->logo) ? asset('storage/' . $settings->logo) : null);
                @endphp
                @if($logo)
                    <img src="{{ $logo }}" alt="{{ $siteName }}" class="brand-logo-img">
                @else
                    <h1 class="brand-text">{{ $siteName }}</h1>
                @endif

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
                    <p style="margin-bottom: 12px; color: #94a3b8;">{{ $footer_text }}</p>
                @endif

                <div>
                    &copy; {{ date('Y') }} <strong>{{ $siteName }}</strong>. All rights reserved.
                </div>
                <div class="footer-note">
                    This is an automated system email. For questions or support, please visit your account dashboard.
                </div>
            </div>
        </div>
    </div>
</body>
</html>
