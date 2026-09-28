<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailTemplate extends Model
{
    use HasFactory;

    protected $table = 'email_templates';

    protected $fillable = [
        'key',
        'name',
        'category',
        'recipient_type',
        'subject',
        'preheader',
        'greeting',
        'body',
        'action_text',
        'action_url',
        'footer_text',
        'available_tags',
        'is_active',
    ];

    protected $casts = [
        'available_tags' => 'array',
        'is_active' => 'boolean',
    ];

    /**
     * Replace dynamic tags in a string with data array values.
     */
    public static function parseTags($text, array $variables = [])
    {
        if (empty($text)) {
            return '';
        }

        // Global defaults if not supplied
        if (!isset($variables['site_name'])) {
            $settings = Settings::find(1);
            $variables['site_name'] = $settings->site_name ?? config('app.name', 'TokenWeb3 Network');
        }
        if (!isset($variables['site_url'])) {
            $variables['site_url'] = config('app.url', url('/'));
        }
        if (!isset($variables['year'])) {
            $variables['year'] = date('Y');
        }
        if (!isset($variables['date'])) {
            $variables['date'] = date('M d, Y h:i A');
        }
        if (!isset($variables['dashboard_url'])) {
            $variables['dashboard_url'] = url('/dashboard');
        }
        if (!isset($variables['login_url'])) {
            $variables['login_url'] = url('/login');
        }

        foreach ($variables as $key => $val) {
            if (is_scalar($val) || is_null($val)) {
                $replacement = (string)$val;
                $text = str_ireplace(['{{' . $key . '}}', '{{ ' . $key . ' }}', '{' . $key . '}'], $replacement, $text);
            }
        }

        return $text;
    }

    /**
     * Get default factory templates definition.
     */
    public static function getDefaultTemplates()
    {
        return [
            'welcome_email' => [
                'name' => 'Welcome & Security Onboarding',
                'category' => 'Onboarding & Auth',
                'recipient_type' => 'user',
                'subject' => 'Official Security Onboarding: Account Terminal Initialized — {{site_name}}',
                'preheader' => 'Your sovereign security terminal has been initialized with non-custodial protection.',
                'greeting' => 'Hurray {{user_name}}!',
                'body' => '<p class="email-subheading" style="font-size:14px; color:#94a3b8; margin-bottom:20px;">Your investor account and sovereign asset terminal have been initialized successfully.</p>
<div class="system-card" style="background:#0f172a; border:1px solid #1e293b; border-radius:12px; padding:20px; margin:20px 0;">
    <h3 style="font-size:15px; font-weight:700; color:#ffffff; margin:0 0 8px;">About Your Account Terminal</h3>
    <p style="font-size:13px; line-height:1.6; color:#cbd5e1; margin:0;"><strong>{{site_name}}</strong> is an institutional-grade, multi-asset management terminal designed with defense-in-depth security principles. Our architecture separates decentralized Web3 connectivity, real-world asset allocations, and high-frequency market intelligence while maintaining strict client sovereignty over all credentials.</p>
</div>
<div class="ftx-alert-card" style="background:linear-gradient(135deg, rgba(239,68,68,0.08) 0%, rgba(245,158,11,0.06) 100%); border:1px solid rgba(239,68,68,0.35); border-radius:12px; padding:20px; margin:20px 0;">
    <div style="display:inline-block; background:rgba(239,68,68,0.2); border:1px solid rgba(239,68,68,0.45); color:#fca5a5; font-size:10.5px; font-weight:800; text-transform:uppercase; letter-spacing:0.8px; padding:3px 10px; border-radius:10px; margin-bottom:10px;">⚠️ Critical Security Advisory &bull; Non-Custodial Protection</div>
    <h3 style="font-size:15px; font-weight:700; color:#ffffff; margin:0 0 8px;">Lessons From The 2022 FTX Collapse</h3>
    <p style="font-size:12.5px; line-height:1.6; color:#e2e8f0; margin:0 0 10px;">In late 2022, the collapse of centralized entities like FTX exposed the fundamental hazard of centralized exchange custody: when third-party platforms hold your private keys and commingle client balances into speculative internal accounts, your funds are exposed to catastrophic counterparty risk.</p>
    <p style="font-size:12.5px; line-height:1.6; color:#e2e8f0; margin:0;"><strong>Our Commitment to You:</strong> At {{site_name}}, we operate under a strict non-custodial and segregated vault policy. We do not hold custody of your secret recovery words, nor do we lend or commingle client assets. Your Web3 wallet connections remain isolated under hardware-level AES-256 cryptographic protection.</p>
</div>
<div class="checklist-box" style="background:#0f172a; border:1px solid #1e293b; border-radius:12px; padding:20px; margin:20px 0;">
    <h4 style="font-size:13px; font-weight:700; text-transform:uppercase; letter-spacing:0.8px; color:#818cf8; margin:0 0 14px;">Essential Security Best Practices</h4>
    <div style="font-size:12.5px; line-height:1.6; color:#cbd5e1; margin-bottom:10px;">🔒 <strong>Never Disclose Recovery Words:</strong> Never share your 12 or 24-word secret recovery phrases with anyone. {{site_name}} staff and support will NEVER ask for your private keys.</div>
    <div style="font-size:12.5px; line-height:1.6; color:#cbd5e1; margin-bottom:10px;">🛡️ <strong>Activate Two-Factor Authentication (2FA):</strong> Enable app-based 2FA on your profile immediately to prevent unauthorized access even if your password is compromised.</div>
    <div style="font-size:12.5px; line-height:1.6; color:#cbd5e1; margin-bottom:10px;">🌐 <strong>Verify Official Domain URLs:</strong> Always verify that you are connecting securely over HTTPS on our official domain before entering credentials or approving wallet links.</div>
    <div style="font-size:12.5px; line-height:1.6; color:#cbd5e1; margin:0;">⚡ <strong>Monitor Session Origins:</strong> Keep your registered email updated and review all automated connection notifications whenever a new wallet or device is authorized.</div>
</div>',
                'action_text' => 'Access Your Security Terminal',
                'action_url' => '{{dashboard_url}}',
                'footer_text' => 'This registration security onboarding notification was dispatched to {{user_email}} for username {{user_name}}. If you did not initiate this account creation, please immediately contact our 24/7 security desk.',
                'available_tags' => [
                    ['tag' => '{{user_name}}', 'desc' => "Investor's full name"],
                    ['tag' => '{{user_email}}', 'desc' => "Investor's registered email"],
                    ['tag' => '{{site_name}}', 'desc' => 'Platform brand name'],
                    ['tag' => '{{site_url}}', 'desc' => 'Website URL link'],
                    ['tag' => '{{dashboard_url}}', 'desc' => 'Direct link to security dashboard'],
                    ['tag' => '{{login_url}}', 'desc' => 'Direct link to sign-in page'],
                ],
                'is_active' => true,
            ],

            'social_registration' => [
                'name' => 'Social Sign-Up Security Welcome',
                'category' => 'Onboarding & Auth',
                'recipient_type' => 'user',
                'subject' => 'Official Security Onboarding: Social Authentication Initialized — {{site_name}}',
                'preheader' => 'Your social authentication profile is secured under non-custodial protection.',
                'greeting' => 'Hurray {{user_name}}!',
                'body' => '<p class="email-subheading" style="font-size:14px; color:#94a3b8; margin-bottom:20px;">Your social authentication profile has been securely connected to your sovereign account terminal.</p>
<div class="system-card" style="background:#0f172a; border:1px solid #1e293b; border-radius:12px; padding:20px; margin:20px 0;">
    <h3 style="font-size:15px; font-weight:700; color:#ffffff; margin:0 0 8px;">Security Architecture</h3>
    <p style="font-size:13px; line-height:1.6; color:#cbd5e1; margin:0;">Your account terminal at <strong>{{site_name}}</strong> utilizes multi-layer credential isolation. We recommend enabling two-factor authentication (2FA) immediately to safeguard your profile before linking decentralized Web3 wallets.</p>
</div>',
                'action_text' => 'Access Your Security Terminal',
                'action_url' => '{{dashboard_url}}',
                'footer_text' => 'We recommend setting up two-factor authentication (2FA) in your security settings.',
                'available_tags' => [
                    ['tag' => '{{user_name}}', 'desc' => "Investor's full name"],
                    ['tag' => '{{user_email}}', 'desc' => "Investor's registered email"],
                    ['tag' => '{{site_name}}', 'desc' => 'Platform brand name'],
                    ['tag' => '{{dashboard_url}}', 'desc' => 'Direct link to dashboard'],
                ],
                'is_active' => true,
            ],

            'wallet_connected' => [
                'name' => 'Web3 Wallet Connected & Secured',
                'category' => 'Security & Wallets',
                'recipient_type' => 'user',
                'subject' => 'Web3 Wallet Authorized & Secured — {{site_name}}',
                'preheader' => 'Cryptographic verification confirmed for {{wallet_provider}} vault address.',
                'greeting' => 'Hello {{user_name}},',
                'body' => '<p class="email-subheading" style="font-size:14px; color:#94a3b8; margin-bottom:20px;">Your cryptocurrency wallet has been successfully authorized and integrated into your account terminal under end-to-end cryptographic encryption.</p>
<div class="details-card" style="background:#0f172a; border:1px solid #1e293b; border-radius:12px; padding:18px; margin:20px 0;">
    <table style="width:100%; border-collapse:collapse;">
        <tr style="border-bottom:1px solid #1e293b;"><td style="padding:9px 0; color:#64748b; font-size:13px; font-weight:600;">Wallet Provider</td><td style="padding:9px 0; text-align:right; color:#60a5fa; font-weight:700; font-size:13px;">{{wallet_provider}}</td></tr>
        <tr style="border-bottom:1px solid #1e293b;"><td style="padding:9px 0; color:#64748b; font-size:13px; font-weight:600;">Connection Status</td><td style="padding:9px 0; text-align:right;"><span style="display:inline-block; background:rgba(16,185,129,0.15); color:#34d399; font-size:11px; font-weight:700; padding:3px 10px; border-radius:12px; border:1px solid rgba(16,185,129,0.3);">● Connected & Active</span></td></tr>
        <tr style="border-bottom:1px solid #1e293b;"><td style="padding:9px 0; color:#64748b; font-size:13px; font-weight:600;">Timestamp</td><td style="padding:9px 0; text-align:right; color:#f1f5f9; font-size:12.5px;">{{date}} UTC</td></tr>
        <tr style="border-bottom:1px solid #1e293b;"><td style="padding:9px 0; color:#64748b; font-size:13px; font-weight:600;">Protection Architecture</td><td style="padding:9px 0; text-align:right;"><span style="display:inline-block; background:rgba(99,102,241,0.15); color:#818cf8; font-size:11px; font-weight:700; padding:3px 10px; border-radius:12px; border:1px solid rgba(99,102,241,0.3);">AES-256 Hardware Vault</span></td></tr>
        <tr><td style="padding:9px 0; color:#64748b; font-size:13px; font-weight:600;">Connected Address</td><td style="padding:9px 0; text-align:right; color:#38bdf8; font-family:monospace; font-size:12px;">{{wallet_address}}</td></tr>
    </table>
</div>
<div class="features-box" style="background:linear-gradient(135deg, rgba(99,102,241,0.08) 0%, rgba(59,130,246,0.05) 100%); border:1px solid rgba(99,102,241,0.25); border-radius:12px; padding:18px; margin:20px 0;">
    <div style="font-size:13px; line-height:1.6; color:#cbd5e1; margin-bottom:8px;">🛡️ <strong>Non-Custodial Protection:</strong> Your private keys and recovery words remain completely in your personal custody. We never store or transmit private keys.</div>
    <div style="font-size:13px; line-height:1.6; color:#cbd5e1; margin-bottom:8px;">🔒 <strong>Zero-Leak Architecture:</strong> All telemetry and authentication signatures are protected using multi-layer AES-256 cipher isolation.</div>
    <div style="font-size:13px; line-height:1.6; color:#cbd5e1; margin:0;">⚡ <strong>Real-Time Asset Synchronization:</strong> Your connected wallet balance is mirrored securely onto your unified terminal dashboard.</div>
</div>
<div class="truck-showcase-section" style="background:#0f172a; border:1px solid #1e293b; border-radius:14px; padding:20px; margin:25px 0; border-top:3px solid #f59e0b;">
    <div style="display:inline-block; background:rgba(245,158,11,0.15); border:1px solid rgba(245,158,11,0.35); color:#fbbf24; font-size:10px; font-weight:800; text-transform:uppercase; letter-spacing:0.8px; padding:3px 10px; border-radius:12px; margin-bottom:10px;">🚚 OPTIONAL FLEET BUSINESS INVESTMENT &bull; MOST POPULAR</div>
    <h3 style="font-size:16px; font-weight:700; color:#ffffff; margin:0 0 8px;">PETERBILT HEAVY-HAUL LOGISTICS</h3>
    <p style="font-size:12.5px; line-height:1.55; color:#94a3b8; margin:0 0 14px;">Looking for steady, real-world asset exposure? In addition to decentralized wallets, {{site_name}} facilitates direct participation in commercial freight trucking, fleet logistics, and refrigerated transport operations.</p>
    <div style="margin-bottom:14px; border-radius:8px; overflow:hidden; max-height:180px; background:#0b0f19;">
        <img src="{{site_url}}/storage/photos/truck_peterbilt_freight.jpg" alt="Commercial Fleet Truck" style="width:100%; height:auto; max-height:180px; object-fit:cover; display:block;" onerror="this.src=\'{{site_url}}/themes/ecx/assets/images/logo/logo-dark.png\';">
    </div>
    <table style="width:100%; border-collapse:collapse; margin-bottom:16px;">
        <tr style="border-bottom:1px solid #1e293b;"><td style="padding:7px 0; font-size:12px; color:#64748b;">Asset Category</td><td style="padding:7px 0; font-size:12px; text-align:right; color:#fbbf24; font-weight:700;">Commercial Freight & Logistics Fleet</td></tr>
        <tr style="border-bottom:1px solid #1e293b;"><td style="padding:7px 0; font-size:12px; color:#64748b;">Allowed Capital Range</td><td style="padding:7px 0; font-size:12px; text-align:right; color:#ffffff; font-weight:600;">$5,000 – $35,000</td></tr>
        <tr style="border-bottom:1px solid #1e293b;"><td style="padding:7px 0; font-size:12px; color:#64748b;">Expected Yield</td><td style="padding:7px 0; font-size:12px; text-align:right; color:#34d399; font-weight:700;">+20% Weekly</td></tr>
        <tr><td style="padding:7px 0; font-size:12px; color:#64748b;">Contract Duration</td><td style="padding:7px 0; font-size:12px; text-align:right; color:#ffffff; font-weight:600;">30 Days</td></tr>
    </table>
    <div style="text-align:center;">
        <a href="{{dashboard_url}}/buy-plan" style="display:inline-block; width:100%; max-width:240px; background:linear-gradient(135deg, #d97706 0%, #f59e0b 100%); color:#000000 !important; text-align:center; padding:12px 20px; font-size:13px; font-weight:800; text-decoration:none; border-radius:24px; box-shadow:0 6px 16px rgba(245,158,11,0.25);">Explore Truck Packages &rarr;</a>
    </div>
</div>
<div class="warning-card" style="background:rgba(239,68,68,0.08); border-left:4px solid #ef4444; border-radius:6px; padding:14px 16px; font-size:12px; line-height:1.5; color:#fca5a5; margin:20px 0;">
    <strong>⚠️ Security Advisory:</strong> If you did not initiate or authorize this connection, someone may have accessed your credentials. Please log in immediately to change your password, disconnect the wallet, or reach out to our 24/7 Security Operations team.
</div>',
                'action_text' => 'Open Account Dashboard',
                'action_url' => '{{dashboard_url}}',
                'footer_text' => 'This is an automated operational security notification sent to {{user_email}}. Please do not reply directly to this message.',
                'available_tags' => [
                    ['tag' => '{{user_name}}', 'desc' => "User's full name"],
                    ['tag' => '{{wallet_provider}}', 'desc' => 'Provider name (e.g. MetaMask, Trust Wallet)'],
                    ['tag' => '{{wallet_address}}', 'desc' => 'Connected crypto wallet address'],
                    ['tag' => '{{site_name}}', 'desc' => 'Platform brand name'],
                    ['tag' => '{{wallet_url}}', 'desc' => 'Link to connect wallet page'],
                    ['tag' => '{{dashboard_url}}', 'desc' => 'User dashboard link'],
                    ['tag' => '{{date}}', 'desc' => 'Connection timestamp'],
                ],
                'is_active' => true,
            ],

            'deposit_confirmation' => [
                'name' => 'Deposit Confirmed / Processed (User)',
                'category' => 'Financial & Transactions',
                'recipient_type' => 'user',
                'subject' => 'Deposit Confirmed: {{amount}} {{currency}} Credited',
                'preheader' => 'Your funds have arrived in your account.',
                'greeting' => 'Hello {{user_name}},',
                'body' => '<p>We are pleased to inform you that your deposit of <strong>{{amount}} {{currency}}</strong> has been confirmed and credited to your account balance.</p><p>Transaction Reference: <code>{{transaction_id}}</code><br>Payment Gateway / Asset: <strong>{{payment_method}}</strong></p><p>You can now allocate this balance into any of our active investment packages.</p>',
                'action_text' => 'View Balance & Invest',
                'action_url' => '{{portfolio_url}}',
                'footer_text' => 'Thank you for choosing {{site_name}} as your investment partner.',
                'available_tags' => [
                    ['tag' => '{{user_name}}', 'desc' => "User's name"],
                    ['tag' => '{{amount}}', 'desc' => 'Formatted deposit amount'],
                    ['tag' => '{{currency}}', 'desc' => 'Currency symbol or code'],
                    ['tag' => '{{payment_method}}', 'desc' => 'Method used (e.g. USDT, Bitcoin, Bank)'],
                    ['tag' => '{{transaction_id}}', 'desc' => 'Transaction ID or hash'],
                    ['tag' => '{{date}}', 'desc' => 'Transaction timestamp'],
                    ['tag' => '{{portfolio_url}}', 'desc' => 'Link to portfolio'],
                ],
                'is_active' => true,
            ],

            'deposit_admin_alert' => [
                'name' => 'New Deposit Alert (Admin)',
                'category' => 'Admin Alerts',
                'recipient_type' => 'admin',
                'subject' => 'New Deposit Alert: {{amount}} {{currency}} from {{user_name}}',
                'preheader' => 'A user deposit requires attention or confirmation.',
                'greeting' => 'Hello Admin,',
                'body' => '<p>A deposit transaction has been registered on the platform:</p><ul><li><strong>Investor:</strong> {{user_name}} ({{user_email}})</li><li><strong>Amount:</strong> {{amount}} {{currency}}</li><li><strong>Method:</strong> {{payment_method}}</li><li><strong>Status:</strong> {{status}}</li></ul>',
                'action_text' => 'Manage Deposits',
                'action_url' => '{{admin_deposit_url}}',
                'footer_text' => 'Automated administrative system dispatch.',
                'available_tags' => [
                    ['tag' => '{{user_name}}', 'desc' => "Investor's name"],
                    ['tag' => '{{user_email}}', 'desc' => "Investor's email"],
                    ['tag' => '{{amount}}', 'desc' => 'Deposit amount'],
                    ['tag' => '{{currency}}', 'desc' => 'Currency symbol'],
                    ['tag' => '{{payment_method}}', 'desc' => 'Payment method'],
                    ['tag' => '{{status}}', 'desc' => 'Payment status'],
                    ['tag' => '{{admin_deposit_url}}', 'desc' => 'Admin review link'],
                ],
                'is_active' => true,
            ],

            'withdrawal_processed' => [
                'name' => 'Withdrawal Processed (User)',
                'category' => 'Financial & Transactions',
                'recipient_type' => 'user',
                'subject' => 'Withdrawal Approved & Processed: {{amount}} {{currency}}',
                'preheader' => 'Your withdrawal request has been finalized.',
                'greeting' => 'Hello {{user_name}},',
                'body' => '<p>Your withdrawal request for <strong>{{amount}} {{currency}}</strong> has been processed and disbursed via <strong>{{payment_method}}</strong>.</p><p>Destination Account / Wallet: <code>{{receiving_address}}</code></p><p>Funds should reflect in your destination wallet shortly according to standard blockchain confirmation times.</p>',
                'action_text' => 'View Withdrawal History',
                'action_url' => '{{withdrawals_url}}',
                'footer_text' => 'For security, keep your transaction identifiers private.',
                'available_tags' => [
                    ['tag' => '{{user_name}}', 'desc' => "User's name"],
                    ['tag' => '{{amount}}', 'desc' => 'Withdrawal amount'],
                    ['tag' => '{{currency}}', 'desc' => 'Currency code'],
                    ['tag' => '{{payment_method}}', 'desc' => 'Withdrawal channel'],
                    ['tag' => '{{receiving_address}}', 'desc' => 'Target wallet address or bank details'],
                    ['tag' => '{{date}}', 'desc' => 'Date processed'],
                    ['tag' => '{{withdrawals_url}}', 'desc' => 'Link to withdrawals page'],
                ],
                'is_active' => true,
            ],

            'withdrawal_admin_alert' => [
                'name' => 'New Withdrawal Request (Admin)',
                'category' => 'Admin Alerts',
                'recipient_type' => 'admin',
                'subject' => 'Withdrawal Request: {{amount}} {{currency}} by {{user_name}}',
                'preheader' => 'Pending payout request submitted.',
                'greeting' => 'Hello Admin,',
                'body' => '<p>A withdrawal request has been submitted by investor <strong>{{user_name}}</strong> ({{user_email}}).</p><ul><li><strong>Requested Amount:</strong> {{amount}} {{currency}}</li><li><strong>Method:</strong> {{payment_method}}</li><li><strong>Destination Address:</strong> <code>{{receiving_address}}</code></li></ul><p>Please review and verify on the admin dashboard.</p>',
                'action_text' => 'Review Withdrawal Request',
                'action_url' => '{{admin_withdrawal_url}}',
                'footer_text' => 'Internal automated admin alert.',
                'available_tags' => [
                    ['tag' => '{{user_name}}', 'desc' => "Investor's name"],
                    ['tag' => '{{user_email}}', 'desc' => "Investor's email"],
                    ['tag' => '{{amount}}', 'desc' => 'Amount requested'],
                    ['tag' => '{{currency}}', 'desc' => 'Currency code'],
                    ['tag' => '{{payment_method}}', 'desc' => 'Payment channel'],
                    ['tag' => '{{receiving_address}}', 'desc' => 'Recipient wallet address'],
                    ['tag' => '{{admin_withdrawal_url}}', 'desc' => 'Link to admin withdrawals panel'],
                ],
                'is_active' => true,
            ],

            'daily_roi' => [
                'name' => 'Daily Yield / ROI Credited',
                'category' => 'Investment Plans',
                'recipient_type' => 'user',
                'subject' => 'Daily ROI Credited: +{{amount}} {{currency}} - {{site_name}}',
                'preheader' => 'Your investment returns have been credited today.',
                'greeting' => 'Hello {{user_name}},',
                'body' => '<p>Great news! Your active investment plan <strong>{{plan_name}}</strong> has generated a daily return of <strong>+{{amount}} {{currency}}</strong>.</p><p>This profit increment has been credited directly to your accessible account balance and is immediately available for compounding or withdrawal.</p>',
                'action_text' => 'View Investment Performance',
                'action_url' => '{{plans_url}}',
                'footer_text' => 'Trading yields are calculated and disbursed automatically every business cycle.',
                'available_tags' => [
                    ['tag' => '{{user_name}}', 'desc' => "User's name"],
                    ['tag' => '{{amount}}', 'desc' => 'Profit credited amount'],
                    ['tag' => '{{currency}}', 'desc' => 'Currency symbol'],
                    ['tag' => '{{plan_name}}', 'desc' => 'Investment plan title'],
                    ['tag' => '{{date}}', 'desc' => 'Credit timestamp'],
                    ['tag' => '{{plans_url}}', 'desc' => 'Link to user investment plans'],
                ],
                'is_active' => true,
            ],

            'end_plan' => [
                'name' => 'Investment Plan Matured / Completed',
                'category' => 'Investment Plans',
                'recipient_type' => 'user',
                'subject' => 'Plan Matured: {{plan_name}} Completed Successfully',
                'preheader' => 'Your investment cycle has completed.',
                'greeting' => 'Hello {{user_name}},',
                'body' => '<p>We are pleased to inform you that your investment plan <strong>{{plan_name}}</strong> has completed its full investment cycle.</p><p>Your initial capital and accumulated gains are fully unlocked and available in your main portfolio.</p>',
                'action_text' => 'Re-Invest or Withdraw',
                'action_url' => '{{plans_url}}',
                'footer_text' => 'Explore higher tiers to increase your compounding returns.',
                'available_tags' => [
                    ['tag' => '{{user_name}}', 'desc' => "User's name"],
                    ['tag' => '{{plan_name}}', 'desc' => 'Name of completed plan'],
                    ['tag' => '{{site_name}}', 'desc' => 'Platform name'],
                    ['tag' => '{{plans_url}}', 'desc' => 'Link to plans page'],
                ],
                'is_active' => true,
            ],

            'two_factor_code' => [
                'name' => '2FA One-Time Login Code',
                'category' => 'Security & Wallets',
                'recipient_type' => 'user',
                'subject' => 'Your One-Time Security Code: {{code}}',
                'preheader' => 'Use this OTP to complete your login verification.',
                'greeting' => 'Hello {{user_name}},',
                'body' => '<p>Your one-time authentication code for signing into <strong>{{site_name}}</strong> is:</p><div style="text-align:center; padding:18px; background:rgba(99,102,241,0.08); border:1px solid rgba(99,102,241,0.3); border-radius:10px; margin:20px 0;"><h1 style="letter-spacing:8px; color:#4f46e5; margin:0; font-family:monospace; font-size:32px;">{{code}}</h1></div><p>This code is valid for 10 minutes. If you did not initiate this login attempt, please secure your account credentials immediately.</p>',
                'action_text' => 'Sign In to Account',
                'action_url' => '{{login_url}}',
                'footer_text' => 'Never share this one-time code with anyone, including support staff.',
                'available_tags' => [
                    ['tag' => '{{user_name}}', 'desc' => "User's name or email"],
                    ['tag' => '{{code}}', 'desc' => '6-digit OTP passcode'],
                    ['tag' => '{{site_name}}', 'desc' => 'Platform name'],
                    ['tag' => '{{login_url}}', 'desc' => 'Login link'],
                ],
                'is_active' => true,
            ],

            'general_notification' => [
                'name' => 'System Announcement & KYC Status',
                'category' => 'General & Alerts',
                'recipient_type' => 'user',
                'subject' => '{{subject}}',
                'preheader' => 'Important notification regarding your account.',
                'greeting' => 'Hello {{user_name}},',
                'body' => '<p>{{message}}</p>',
                'action_text' => 'View Details in Dashboard',
                'action_url' => '{{action_url}}',
                'footer_text' => 'You are receiving this communication regarding your registered account.',
                'available_tags' => [
                    ['tag' => '{{user_name}}', 'desc' => "User's name"],
                    ['tag' => '{{subject}}', 'desc' => 'Notification subject'],
                    ['tag' => '{{message}}', 'desc' => 'Dynamic notification body'],
                    ['tag' => '{{action_url}}', 'desc' => 'Optional action URL'],
                    ['tag' => '{{site_name}}', 'desc' => 'Platform name'],
                ],
                'is_active' => true,
            ],
        ];
    }

    /**
     * Seed or update missing defaults into the database.
     */
    public static function seedDefaults()
    {
        $defaults = self::getDefaultTemplates();
        foreach ($defaults as $key => $data) {
            self::firstOrCreate(
                ['key' => $key],
                $data
            );
        }
    }
}