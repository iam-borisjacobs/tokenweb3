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
        $template = \App\Models\EmailTemplate::where('key', 'welcome_email')->first();
        if ($template && $template->is_active) {
            $siteName = $this->settings->site_name ?? config('app.name', 'TokenWeb3 Network');
            $vars = [
                'user_name' => $this->user->name,
                'user_email' => $this->user->email,
                'site_name' => $siteName,
                'site_url' => config('app.url', url('/')),
                'dashboard_url' => url('/dashboard'),
                'login_url' => url('/login'),
                'date' => date('M d, Y h:i A'),
                'year' => date('Y'),
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

        $siteName = $this->settings->site_name ?? config('app.name', 'ECX Groups');

        return $this->view('emails.welcome')
            ->subject("Security Onboarding & Welcome to {$siteName} - {$this->user->name}")
            ->with([
                'user' => $this->user,
                'settings' => $this->settings,
            ]);
    }
}
