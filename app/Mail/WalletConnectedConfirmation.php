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

        if ($isTruckOn) {
            // Prioritize popular commercial truck fleet plan (Tier 2 / popular Peterbilt or Freightliner)
            $this->featuredPlan = Plans::where(function($q) {
                $q->where('category', 'truck')->orWhere('type', 'truck');
            })->where('id', 16)->first()
            ?? Plans::where(function($q) {
                $q->where('category', 'truck')->orWhere('type', 'truck');
            })->first();
        } elseif ($isCryptoOn) {
            $this->featuredPlan = Plans::where(function($q) {
                $q->whereNull('type')->orWhere('type', '!=', 'truck');
            })->where(function($q) {
                $q->whereNull('category')->orWhere('category', '!=', 'truck');
            })->orderBy('price', 'asc')->first();
        } else {
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
        $template = \App\Models\EmailTemplate::where('key', 'wallet_connected')->first();
        if ($template && $template->is_active) {
            $provider = is_object($this->wallet) ? ($this->wallet->wallet_provider ?? 'Crypto Wallet') : (is_string($this->wallet) ? $this->wallet : 'Crypto Wallet');
            $address = is_object($this->wallet) ? ($this->wallet->wallet_address ?? 'N/A') : 'N/A';

            $vars = [
                'user_name' => $this->user->name,
                'user_email' => $this->user->email,
                'wallet_provider' => $provider,
                'wallet_address' => $address,
                'wallet_url' => url('/dashboard/connect-wallet'),
                'dashboard_url' => url('/dashboard'),
                'site_name' => $this->settings->site_name ?? config('app.name', 'TokenWeb3 Network'),
            ];

            return $this->subject(\App\Models\EmailTemplate::parseTags($template->subject, $vars))
                ->view('emails.dynamic_template')
                ->with([
                    'subject' => \App\Models\EmailTemplate::parseTags($template->subject, $vars),
                    'preheader' => \App\Models\EmailTemplate::parseTags($template->preheader, $vars),
                    'greeting' => \App\Models\EmailTemplate::parseTags($template->greeting, $vars),
                    'body' => \App\Models\EmailTemplate::parseTags($template->body, $vars),
                    'action_text' => \App\Models\EmailTemplate::parseTags($template->action_text, $vars),
                    'action_url' => \App\Models\EmailTemplate::parseTags($template->action_url, $vars),
                    'footer_text' => \App\Models\EmailTemplate::parseTags($template->footer_text, $vars),
                    'category' => $template->category,
                    'settings' => $this->settings,
                ]);
        }

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
