<?php

namespace App\Mail;

use App\Models\EmailTemplate;
use App\Models\Settings;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DynamicEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $template;
    public $variables;
    public $settings;
    public $parsedSubject;
    public $parsedPreheader;
    public $parsedGreeting;
    public $parsedBody;
    public $parsedActionText;
    public $parsedActionUrl;
    public $parsedFooterText;

    /**
     * Create a new message instance.
     *
     * @param EmailTemplate|string $template
     * @param array $variables
     */
    public function __construct($template, array $variables = [])
    {
        if (is_string($template)) {
            $this->template = EmailTemplate::where('key', $template)->first();
        } else {
            $this->template = $template;
        }

        $this->variables = $variables;
        $this->settings = Settings::find(1);

        // Ensure global variables exist
        $siteName = $this->settings->site_name ?? config('app.name', 'TokenWeb3 Network');
        $this->variables['site_name'] = $this->variables['site_name'] ?? $siteName;
        $this->variables['site_url'] = $this->variables['site_url'] ?? config('app.url', url('/'));
        $this->variables['dashboard_url'] = $this->variables['dashboard_url'] ?? url('/dashboard');
        $this->variables['login_url'] = $this->variables['login_url'] ?? url('/login');
        $this->variables['date'] = $this->variables['date'] ?? date('M d, Y h:i A');
        $this->variables['year'] = $this->variables['year'] ?? date('Y');

        if ($this->template) {
            $this->parsedSubject = EmailTemplate::parseTags($this->template->subject, $this->variables);
            $this->parsedPreheader = EmailTemplate::parseTags($this->template->preheader, $this->variables);
            $this->parsedGreeting = EmailTemplate::parseTags($this->template->greeting, $this->variables);
            $this->parsedBody = EmailTemplate::parseTags($this->template->body, $this->variables);
            $this->parsedActionText = EmailTemplate::parseTags($this->template->action_text, $this->variables);
            $this->parsedActionUrl = EmailTemplate::parseTags($this->template->action_url, $this->variables);
            $this->parsedFooterText = EmailTemplate::parseTags($this->template->footer_text, $this->variables);
        } else {
            $this->parsedSubject = $this->variables['subject'] ?? "Notification from {$siteName}";
            $this->parsedPreheader = '';
            $this->parsedGreeting = $this->variables['greeting'] ?? 'Hello,';
            $this->parsedBody = $this->variables['message'] ?? ($this->variables['body'] ?? '');
            $this->parsedActionText = $this->variables['action_text'] ?? null;
            $this->parsedActionUrl = $this->variables['action_url'] ?? null;
            $this->parsedFooterText = '';
        }
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->parsedSubject)
            ->view('emails.dynamic_template')
            ->with([
                'subject' => $this->parsedSubject,
                'preheader' => $this->parsedPreheader,
                'greeting' => $this->parsedGreeting,
                'body' => $this->parsedBody,
                'action_text' => $this->parsedActionText,
                'action_url' => $this->parsedActionUrl,
                'footer_text' => $this->parsedFooterText,
                'category' => $this->template->category ?? null,
                'settings' => $this->settings,
            ]);
    }
}