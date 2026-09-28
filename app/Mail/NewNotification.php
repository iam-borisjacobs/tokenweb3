<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $url, $attachment, $body, $subject, $recipient, $salutaion;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($body, $subject, $recipient, $url = null, $attachment = null, $salutaion= null)
    {
        $this->url =  $url;
        $this->attachment = $attachment;
        $this->body =  $body;
        $this->subject = $subject;
        $this->recipient = $recipient;
        $this->salutaion = $salutaion;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $template = \App\Models\EmailTemplate::where('key', 'general_notification')->first();
        if ($template && $template->is_active) {
            $settings = \App\Models\Settings::find(1);
            $vars = [
                'user_name' => $this->recipient ?? 'Investor',
                'subject' => $this->subject,
                'message' => $this->body,
                'action_url' => $this->url ?? url('/dashboard'),
                'site_name' => $settings->site_name ?? config('app.name', 'TokenWeb3 Network'),
            ];

            $mail = $this->subject(\App\Models\EmailTemplate::parseTags($template->subject, $vars))
                ->view('emails.dynamic_template')
                ->with([
                    'subject' => \App\Models\EmailTemplate::parseTags($template->subject, $vars),
                    'preheader' => \App\Models\EmailTemplate::parseTags($template->preheader, $vars),
                    'greeting' => $this->salutaion ? $this->salutaion : \App\Models\EmailTemplate::parseTags($template->greeting, $vars),
                    'body' => \App\Models\EmailTemplate::parseTags($template->body, $vars),
                    'action_text' => $this->url ? \App\Models\EmailTemplate::parseTags($template->action_text, $vars) : null,
                    'action_url' => $this->url ? \App\Models\EmailTemplate::parseTags($template->action_url, $vars) : null,
                    'footer_text' => \App\Models\EmailTemplate::parseTags($template->footer_text, $vars),
                    'category' => $template->category,
                    'settings' => $settings,
                ]);

            if ($this->attachment) {
                $mail->attach($this->attachment);
            }
            return $mail;
        }

        $mail = $this->markdown('emails.NewNotification',[
            'url' => $this->url,
            'attachment' => $this->attachment,
            'body' => $this->body,
            'recipient' => $this->recipient,
        ])
        ->subject($this->subject);

        if ($this->attachment) {
            $mail->attach($this->attachment);
        }
        return $mail;
    }
}
