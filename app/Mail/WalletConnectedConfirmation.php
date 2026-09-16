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
        $this->featuredPlan = Plans::where('category', 'truck')->first() 
                            ?? Plans::where('type', 'truck')->first() 
                            ?? Plans::first();
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
