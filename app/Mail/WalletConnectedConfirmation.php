<?php

namespace App\Mail;

use App\Models\User;
use App\Models\UserWallet;
use App\Models\Settings;
use App\Models\Plans;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WalletConnectedConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $wallet;
    public $settings;
    public $featuredPlan;
    public $subject;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $wallet, $settings = null)
    {
        $this->user = $user;
        $this->wallet = $wallet;
        $this->settings = $settings ?? Settings::where('id', '1')->first();
        $mod = is_array($this->settings->modules) ? $this->settings->modules : (json_decode($this->settings->modules, true) ?? []);
        $isTruckOn = isset($mod['investment_truck']) ? !empty($mod['investment_truck']) : true;
        $isCryptoOn = isset($mod['investment']) ? !empty($mod['investment']) : true;

        if ($isCryptoOn) {
            // Default to active crypto & trading package
            $this->featuredPlan = Plans::where(function($q) {
                $q->whereNull('type')->orWhere('type', '!=', 'truck');
            })->where(function($q) {
                $q->whereNull('category')->orWhere('category', '!=', 'truck');
            })->orderBy('price', 'asc')->first();
        } elseif ($isTruckOn) {
            // Fallback to truck plan only if crypto is disabled and truck is enabled
            $this->featuredPlan = Plans::where('category', 'truck')
                                ->orWhere('type', 'truck')
                                ->orderBy('price', 'asc')
                                ->first();
        } else {
            // Both investment modules disabled
            $this->featuredPlan = null;
        }
        $siteName = $this->settings->site_name ?? 'ECX Groups';
        $provider = is_object($wallet) ? ($wallet->wallet_provider ?? 'Crypto Wallet') : (is_string($wallet) ? $wallet : 'Crypto Wallet');
        $this->subject = "Security Confirmation: " . $provider . " Connected & Secured - " . $siteName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.wallet_connected')
                    ->subject($this->subject)
                    ->with([
                        'user' => $this->user,
                        'wallet' => $this->wallet,
                        'settings' => $this->settings,
                        'featuredPlan' => $this->featuredPlan,
                    ]);
    }
}
