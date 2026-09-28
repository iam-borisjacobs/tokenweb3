<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Twofa extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @var Demo
     */

    public $demo;

    public function __construct($demo)
    {
        $this->demo = $demo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $template = \App\Models\EmailTemplate::where('key', 'two_factor_code')->first();
        if ($template && $template->is_active) {
            $settings = \App\Models\Settings::find(1);
            $vars = [
                'code' => $this->demo->message ?? '',
                'user_name' => 'Administrator',
                'site_name' => $this->demo->sender ?? ($settings->site_name ?? config('app.name')),
                'login_url' => url('/admin/login'),
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
                    'settings' => $settings,
                ]);
        }

        return $this->markdown('emails.2fa')->subject($this->demo->subject);
    }
}
