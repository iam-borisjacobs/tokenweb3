<?php

namespace App\Mail;

use App\Models\User;
use App\Models\Withdrawal;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WithdrawalStatus extends Mailable
{
    use Queueable, SerializesModels;
    public $withdrawal, $subject, $user;
    public $foramin;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Withdrawal $withdrawal, User $user, $subject, $foramin = false)
    {
        $this->withdrawal = $withdrawal;
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
        $key = $this->foramin ? 'withdrawal_admin_alert' : 'withdrawal_processed';
        $template = \App\Models\EmailTemplate::where('key', $key)->first();

        if ($template && $template->is_active) {
            $vars = [
                'user_name' => $this->user->name ?? 'User',
                'user_email' => $this->user->email ?? '',
                'amount' => number_format((float)($this->withdrawal->amount ?? 0), 2),
                'currency' => $settings->currency ?? '$',
                'payment_method' => $this->withdrawal->payment_mode ?? 'Crypto',
                'receiving_address' => $this->withdrawal->paydetails ?? ($this->withdrawal->account_no ?? 'N/A'),
                'date' => $this->withdrawal->created_at ? $this->withdrawal->created_at->format('M d, Y h:i A') : date('M d, Y h:i A'),
                'withdrawals_url' => url('/dashboard/withdrawals'),
                'admin_withdrawal_url' => url('/admin/dashboard/mwithdrawals'),
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

        return $this->markdown('emails.withdrawal-status')->subject($this->subject);
    }
}
