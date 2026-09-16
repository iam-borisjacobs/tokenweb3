<?php

namespace App\Mail;

use App\Models\Settings;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    public $settings;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
        $this->settings = Settings::find(1);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $siteName = $this->settings->site_name ?? config('app.name', 'ECX Groups');

        return $this->view('emails.welcome')
            ->subject("Security Onboarding & Welcome to {$siteName} - {$this->user->name}")
            ->with([
                'user' => $this->user,
                'settings' => $this->settings,
            ]);
    }
}
