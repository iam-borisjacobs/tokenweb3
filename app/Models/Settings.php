<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'return_capital' => 'boolean',
        'should_cancel_plan' => 'boolean',
        'modules' => 'array',
        'welcome_popup_slides' => 'array',
        'trading_lock_enabled' => 'boolean',
        'require_wallet_for_investment' => 'boolean',
        'min_trading_balance' => 'float',
        'maintenance_mode' => 'boolean',
        'maintenance_until' => 'datetime',
    ];

    /**
     * Get the combined qualified trading balance for a user
     * (Account balance + Connected Web3 Wallets balance)
     */
    public static function getUserTotalTradingBalance($user)
    {
        if (!$user) {
            return 0.00;
        }

        $accountBal = floatval($user->account_bal ?? 0);
        $walletsBal = 0.00;

        if (class_exists(\App\Models\UserWallet::class)) {
            try {
                $walletsBal = floatval(\App\Models\UserWallet::where('user_id', $user->id)->sum('balance') ?? 0);
            } catch (\Throwable $e) {
                $walletsBal = 0.00;
            }
        }

        return $accountBal + $walletsBal;
    }

    /**
     * Check whether trading features and execution are locked for the user
     */
    public function isTradingLockedForUser($user)
    {
        if (!$this->trading_lock_enabled) {
            return false;
        }

        $threshold = floatval($this->min_trading_balance ?? 100000.00);
        if ($threshold <= 0) {
            return false;
        }

        $totalBalance = self::getUserTotalTradingBalance($user);

        return $totalBalance < $threshold;
    }

    /**
     * Resolve the public web asset URL for a slide image.
     */
    public static function getSlideImageUrl($imagePath)
    {
        if (empty($imagePath)) {
            return null;
        }

        if (str_starts_with($imagePath, 'http://') || str_starts_with($imagePath, 'https://')) {
            return $imagePath;
        }

        $cleanPath = ltrim($imagePath, '/');

        if (str_starts_with($cleanPath, 'storage/app/public/')) {
            return asset($cleanPath);
        }

        if (str_starts_with($cleanPath, 'storage/')) {
            $subPath = substr($cleanPath, 8);
            if (file_exists(public_path('storage/' . $subPath))) {
                return asset('storage/' . $subPath);
            }
            return asset('storage/app/public/' . $subPath);
        }

        if (file_exists(public_path('storage/' . $cleanPath))) {
            return asset('storage/' . $cleanPath);
        }

        return asset('storage/app/public/' . $cleanPath);
    }

    /**
     * Retrieve structured welcome & onboarding slides with robust institutional defaults.
     */
    public function getWelcomeSlides()
    {
        if (!empty($this->welcome_popup_slides) && is_array($this->welcome_popup_slides) && count($this->welcome_popup_slides) > 0) {
            $slides = $this->welcome_popup_slides;
        } else {
            $slides = [
                [
                    'step' => '1',
                    'is_active' => 'yes',
                    'image' => null,
                    'badge' => 'Account Clearance',
                    'icon' => 'fa-shield-halved',
                    'title' => 'Welcome to Your ECX Trading Portal',
                    'message' => 'Your institutional investor profile and credentials have been verified. You now have full access to high-yield liquidity pools, automated yield distributions, and encrypted asset custody.',
                    'highlight' => 'Institutional Grade 256-Bit SSL Security',
                    'button_text' => '',
                    'button_url' => '',
                ],
                [
                    'step' => '2',
                    'is_active' => 'yes',
                    'image' => null,
                    'badge' => 'Decentralized Vault',
                    'icon' => 'fa-wallet',
                    'title' => 'Connect Your Cryptocurrency Wallet',
                    'message' => 'Link your Web3 crypto wallet (MetaMask, TrustWallet, Coinbase, Ledger, etc.) to activate seamless automated payouts and link your on-chain assets with zero transaction friction.',
                    'highlight' => 'Compatible with 10+ Web3 Wallets & Networks',
                    'button_text' => 'Connect Wallet Now',
                    'button_url' => '/dashboard/connect-wallet',
                ],
                [
                    'step' => '3',
                    'is_active' => 'yes',
                    'image' => null,
                    'badge' => 'Yield Compounding',
                    'icon' => 'fa-chart-line',
                    'title' => 'Activate Daily Yield Distributions',
                    'message' => 'Deposit capital or enroll in our automated investment packages to earn daily returns credited directly to your connected wallet and account balance.',
                    'highlight' => 'Daily Automated Payouts & Principal Return',
                    'button_text' => 'Explore Investment Plans',
                    'button_url' => '/dashboard/buy-plan',
                ],
            ];
        }

        foreach ($slides as &$slide) {
            $slide['image_url'] = self::getSlideImageUrl($slide['image'] ?? null);
        }
        unset($slide);

        return $slides;
    }

    /**
     * Get official WhatsApp Support URL
     */
    public function getWhatsAppUrl($customMessage = null)
    {
        $raw = trim($this->whatsapp_number ?? '');

        // Fallback to WhatsApp setting admin_number or general phone
        if (empty($raw) && class_exists(\App\Models\WhatsAppSetting::class)) {
            try {
                $waSet = \App\Models\WhatsAppSetting::getSettings();
                $raw = trim($waSet->admin_number ?? '');
            } catch (\Throwable $e) {
                $raw = '';
            }
        }

        if (empty($raw)) {
            $raw = trim($this->phone ?? '');
        }

        $defaultMsg = 'Hello, I need assistance with my account on ' . ($this->site_name ?? 'ECX Groups') . '.';
        $msg = $customMessage ? urlencode($customMessage) : urlencode($defaultMsg);

        if (empty($raw)) {
            return "https://api.whatsapp.com/send?text={$msg}";
        }

        // If admin entered a full URL
        if (str_starts_with($raw, 'http://') || str_starts_with($raw, 'https://')) {
            return $raw;
        }

        // Clean number (keep only digits)
        $clean = preg_replace('/[^0-9]/', '', $raw);
        if (empty($clean)) {
            return "https://api.whatsapp.com/send?text={$msg}";
        }

        return "https://wa.me/{$clean}?text={$msg}";
    }

    /**
     * Get official Telegram Support URL
     */
    public function getTelegramUrl()
    {
        $raw = trim($this->telegram_username ?? '');
        if (empty($raw)) {
            return 'https://t.me/ecxgroups';
        }

        if (str_starts_with($raw, 'http://') || str_starts_with($raw, 'https://')) {
            return $raw;
        }

        $username = ltrim($raw, '@');
        return "https://t.me/{$username}";
    }
}