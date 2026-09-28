<?php

namespace App\Mail;

use App\Models\Deposit;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DepositStatus extends Mailable
{
    use Queueable, SerializesModels;
    public $deposit, $subject, $user;
    public $foramin;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Deposit $deposit, User $user, $subject, $foramin = false)
    {
        $this->deposit = $deposit;
        $this->user = $user;
        $this->foramin = $foramin;
        $this->subject = $subject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $settings = \App\Models\Settings::find(1);
        $key = $this->foramin ? 'deposit_admin_alert' : 'deposit_confirmation';
        $template = \App\Models\EmailTemplate::where('key', $key)->first();

        if ($template && $template->is_active) {
            $vars = [
                'user_name' => $this->user->name ?? 'User',
                'user_email' => $this->user->email ?? '',
                'amount' => number_format((float)($this->deposit->amount ?? 0), 2),
                'currency' => $settings->currency ?? '$',
                'payment_method' => $this->deposit->payment_mode ?? 'Crypto',
                'transaction_id' => $this->deposit->txn_id ?? ($this->deposit->id ?? 'N/A'),
                'status' => $this->deposit->status ?? 'Processed',
                'date' => $this->deposit->created_at ? $this->deposit->created_at->format('M d, Y h:i A') : date('M d, Y h:i A'),
                'portfolio_url' => url('/dashboard/deposits'),
                'admin_deposit_url' => url('/admin/dashboard/mdeposits'),
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

        return $this->markdown('emails.success-deposit')->subject($this->subject);
    }
}
