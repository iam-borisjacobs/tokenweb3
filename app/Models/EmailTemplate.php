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
                'name' => 'Welcome & Account Onboarding',
                'category' => 'Onboarding & Auth',
                'recipient_type' => 'user',
                'subject' => 'Welcome to {{site_name}} - {{user_name}}',
                'preheader' => 'Your trading account has been created and secured.',
                'greeting' => 'Hello {{user_name}},',
                'body' => '<p>Welcome to <strong>{{site_name}}</strong>! Your account has been successfully initialized and connected to our multi-asset institutional trading ecosystem.</p><p>You can now deposit capital, explore our quantitative investment packages, track automated daily yields, and link your decentralized Web3 wallet for seamless payouts.</p>',
                'action_text' => 'Access Your Trading Dashboard',
                'action_url' => '{{dashboard_url}}',
                'footer_text' => 'If you did not create this account, please immediately contact our 24/7 security desk.',
                'available_tags' => [
                    ['tag' => '{{user_name}}', 'desc' => "Investor's full name"],
                    ['tag' => '{{user_email}}', 'desc' => "Investor's registered email"],
                    ['tag' => '{{site_name}}', 'desc' => 'Platform brand name'],
                    ['tag' => '{{site_url}}', 'desc' => 'Website URL link'],
                    ['tag' => '{{dashboard_url}}', 'desc' => 'Direct link to user dashboard'],
                    ['tag' => '{{login_url}}', 'desc' => 'Direct link to sign-in page'],
                ],
                'is_active' => true,
            ],

            'social_registration' => [
                'name' => 'Social Sign-Up Welcome',
                'category' => 'Onboarding & Auth',
                'recipient_type' => 'user',
                'subject' => 'Welcome to {{site_name}} via Social Login',
                'preheader' => 'Your social profile is now authenticated.',
                'greeting' => 'Hello {{user_name}},',
                'body' => '<p>Your social account has been successfully linked with <strong>{{site_name}}</strong>. Your personal trading portal is now active and ready for your first deposit.</p>',
                'action_text' => 'Go to Dashboard',
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
                'name' => 'Web3 Wallet Connected Confirmation',
                'category' => 'Security & Wallets',
                'recipient_type' => 'user',
                'subject' => 'Security Confirmation: {{wallet_provider}} Connected - {{site_name}}',
                'preheader' => 'Your decentralized wallet address has been verified.',
                'greeting' => 'Hello {{user_name}},',
                'body' => '<p>This security confirmation is to notify you that your <strong>{{wallet_provider}}</strong> address (<code>{{wallet_address}}</code>) has been successfully verified and attached to your trading profile.</p><p>All future automated earnings distributions, principal redemptions, and crypto yields can now be routed directly to this verified vault address.</p>',
                'action_text' => 'View Connected Wallets',
                'action_url' => '{{wallet_url}}',
                'footer_text' => 'If you did not authorize this connection, please disconnect the wallet immediately in your dashboard settings.',
                'available_tags' => [
                    ['tag' => '{{user_name}}', 'desc' => "User's full name"],
                    ['tag' => '{{wallet_provider}}', 'desc' => 'Provider name (e.g. MetaMask, Trust Wallet)'],
                    ['tag' => '{{wallet_address}}', 'desc' => 'Connected crypto wallet address'],
                    ['tag' => '{{site_name}}', 'desc' => 'Platform brand name'],
                    ['tag' => '{{wallet_url}}', 'desc' => 'Link to connect wallet page'],
                    ['tag' => '{{dashboard_url}}', 'desc' => 'User dashboard link'],
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