<?php

namespace App\Mail;

use App\Models\Tp_Transaction;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewRoi extends Mailable
{
    use Queueable, SerializesModels;
    
    /**
     * Create a new message instance.
     *
     * @var Demo
     */
    public $plan, $amount, $plandate, $user, $subject;

    public function __construct(User $user, $plan, $amount, $plandate, $subject)
    {
        $this->plan = $plan;
        $this->user = $user;
        $this->subject = $subject;
        $this->amount = $amount;
        $this->plandate = $plandate;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $template = \App\Models\EmailTemplate::where('key', 'daily_roi')->first();
        if ($template && $template->is_active) {
            $settings = \App\Models\Settings::find(1);
            $vars = [
                'user_name' => $this->user->name ?? 'Investor',
                'amount' => $this->amount,
                'currency' => $settings->currency ?? '$',
                'plan_name' => $this->plan,
                'date' => $this->plandate,
                'plans_url' => url('/dashboard/trading-history'),
                'site_name' => $settings->site_name ?? config('app.name', 'TokenWeb3 Network'),
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

        return $this->markdown('emails.newroi')->subject($this->subject);
    }
}
