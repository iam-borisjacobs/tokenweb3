<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class endplan extends Mailable
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
        $template = \App\Models\EmailTemplate::where('key', 'end_plan')->first();
        if ($template && $template->is_active) {
            $settings = \App\Models\Settings::find(1);
            $vars = [
                'user_name' => $this->demo->receiver_name ?? 'Investor',
                'plan_name' => $this->demo->receiver_plan ?? 'Trading Plan',
                'amount' => $this->demo->received_amount ?? '',
                'date' => $this->demo->date ?? date('M d, Y'),
                'plans_url' => url('/dashboard/buy-plan'),
                'site_name' => $this->demo->sender ?? ($settings->site_name ?? config('app.name')),
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

        return $this->markdown('emails.endplan')->subject($this->demo->subject);
    }
}
