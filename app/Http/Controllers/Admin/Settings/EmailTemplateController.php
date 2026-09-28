<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Models\EmailTemplate;
use App\Models\Settings;
use App\Mail\DynamicEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class EmailTemplateController extends Controller
{
    /**
     * Get all email templates.
     */
    public function index()
    {
        EmailTemplate::seedDefaults();
        $templates = EmailTemplate::orderBy('category', 'asc')->orderBy('name', 'asc')->get();
        return response()->json([
            'status' => 200,
            'templates' => $templates,
        ]);
    }

    /**
     * Retrieve single template details.
     */
    public function show($id)
    {
        $template = EmailTemplate::findOrFail($id);
        $sampleVariables = $this->getSampleVariables($template);

        return response()->json([
            'status' => 200,
            'template' => $template,
            'sample_variables' => $sampleVariables,
        ]);
    }

    /**
     * Update an email template.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'preheader' => 'nullable|string|max:500',
            'greeting' => 'nullable|string|max:255',
            'body' => 'required|string',
            'action_text' => 'nullable|string|max:100',
            'action_url' => 'nullable|string|max:255',
            'footer_text' => 'nullable|string|max:500',
            'is_active' => 'nullable',
        ]);

        $template = EmailTemplate::findOrFail($id);
        $isActive = $request->has('is_active') ? ($request->is_active == '1' || $request->is_active === true || $request->is_active == 'true') : true;

        $template->update([
            'subject' => trim($request->subject),
            'preheader' => trim($request->preheader ?? ''),
            'greeting' => trim($request->greeting ?? ''),
            'body' => $request->body,
            'action_text' => trim($request->action_text ?? ''),
            'action_url' => trim($request->action_url ?? ''),
            'footer_text' => trim($request->footer_text ?? ''),
            'is_active' => $isActive,
        ]);

        return response()->json([
            'status' => 200,
            'success' => true,
            'message' => "'{$template->name}' template updated successfully!",
            'template' => $template,
        ]);
    }

    /**
     * Quick toggle template active status.
     */
    public function toggleActive($id)
    {
        $template = EmailTemplate::findOrFail($id);
        $template->is_active = !$template->is_active;
        $template->save();

        return response()->json([
            'status' => 200,
            'success' => true,
            'is_active' => $template->is_active,
            'message' => "Template status set to " . ($template->is_active ? 'Active' : 'Disabled'),
        ]);
    }

    /**
     * Reset a template to system factory default.
     */
    public function reset($id)
    {
        $template = EmailTemplate::findOrFail($id);
        $defaults = EmailTemplate::getDefaultTemplates();

        if (isset($defaults[$template->key])) {
            $def = $defaults[$template->key];
            $template->update([
                'subject' => $def['subject'],
                'preheader' => $def['preheader'],
                'greeting' => $def['greeting'],
                'body' => $def['body'],
                'action_text' => $def['action_text'],
                'action_url' => $def['action_url'],
                'footer_text' => $def['footer_text'],
                'is_active' => true,
            ]);

            return response()->json([
                'status' => 200,
                'success' => true,
                'message' => "'{$template->name}' has been restored to factory default!",
                'template' => $template,
            ]);
        }

        return response()->json([
            'status' => 404,
            'success' => false,
            'message' => 'Default preset for this template was not found.',
        ]);
    }

    /**
     * Render a real-time live HTML preview of the email with sample data.
     */
    public function preview(Request $request, $id)
    {
        $template = EmailTemplate::findOrFail($id);
        $settings = Settings::find(1);
        $sampleData = $this->getSampleVariables($template);

        // Allow live preview of form edits before saving
        $subject = $request->filled('subject') ? $request->subject : $template->subject;
        $preheader = $request->has('preheader') ? $request->preheader : $template->preheader;
        $greeting = $request->has('greeting') ? $request->greeting : $template->greeting;
        $body = $request->filled('body') ? $request->body : $template->body;
        $actionText = $request->has('action_text') ? $request->action_text : $template->action_text;
        $actionUrl = $request->has('action_url') ? $request->action_url : $template->action_url;
        $footerText = $request->has('footer_text') ? $request->footer_text : $template->footer_text;

        return view('emails.dynamic_template', [
            'subject' => EmailTemplate::parseTags($subject, $sampleData),
            'preheader' => EmailTemplate::parseTags($preheader, $sampleData),
            'greeting' => EmailTemplate::parseTags($greeting, $sampleData),
            'body' => EmailTemplate::parseTags($body, $sampleData),
            'action_text' => EmailTemplate::parseTags($actionText, $sampleData),
            'action_url' => EmailTemplate::parseTags($actionUrl, $sampleData),
            'footer_text' => EmailTemplate::parseTags($footerText, $sampleData),
            'category' => $template->category,
            'settings' => $settings,
        ]);
    }

    /**
     * Send a real test email to the administrator's designated email address.
     */
    public function sendTest(Request $request, $id)
    {
        $request->validate([
            'test_email' => 'required|email',
        ]);

        $template = EmailTemplate::findOrFail($id);
        $sampleData = $this->getSampleVariables($template);
        $sampleData['user_email'] = $request->test_email;

        // Overlay any currently submitted edits from editor form
        $customTemplate = clone $template;
        if ($request->filled('subject')) $customTemplate->subject = $request->subject;
        if ($request->has('preheader')) $customTemplate->preheader = $request->preheader;
        if ($request->has('greeting')) $customTemplate->greeting = $request->greeting;
        if ($request->filled('body')) $customTemplate->body = $request->body;
        if ($request->has('action_text')) $customTemplate->action_text = $request->action_text;
        if ($request->has('action_url')) $customTemplate->action_url = $request->action_url;
        if ($request->has('footer_text')) $customTemplate->footer_text = $request->footer_text;

        try {
            Mail::to($request->test_email)->send(new DynamicEmail($customTemplate, $sampleData));

            return response()->json([
                'status' => 200,
                'success' => true,
                'message' => "Live test email for '{$template->name}' was successfully dispatched to {$request->test_email}!",
            ]);
        } catch (\Throwable $e) {
            Log::error('Test Email Dispatch Error: ' . $e->getMessage());

            return response()->json([
                'status' => 500,
                'success' => false,
                'message' => "Unable to send email: " . $e->getMessage() . ". Please check your Outbound Mail settings under the 'Email & Auth' tab.",
            ]);
        }
    }

    /**
     * Provide realistic sample data for previews and test dispatches.
     */
    private function getSampleVariables(EmailTemplate $template)
    {
        $settings = Settings::find(1);
        $siteName = $settings->site_name ?? config('app.name', 'TokenWeb3 Network');
        $currency = $settings->currency ?? '$';

        return [
            'site_name' => $siteName,
            'site_url' => config('app.url', url('/')),
            'dashboard_url' => url('/dashboard'),
            'login_url' => url('/login'),
            'portfolio_url' => url('/dashboard/portfolio'),
            'plans_url' => url('/dashboard/buy-plan'),
            'withdrawals_url' => url('/dashboard/withdrawals'),
            'wallet_url' => url('/dashboard/connect-wallet'),
            'admin_deposit_url' => url('/admin/dashboard/mdeposits'),
            'admin_withdrawal_url' => url('/admin/dashboard/mwithdrawals'),
            'user_name' => 'Alexander Wright',
            'user_email' => 'alex.wright@example.com',
            'amount' => number_format(5250.00, 2),
            'invested_amount' => number_format(15000.00, 2),
            'currency' => $currency,
            'payment_method' => 'Tether USDT (TRC-20)',
            'transaction_id' => 'TXN-' . strtoupper(substr(md5(uniqid()), 0, 10)),
            'receiving_address' => '0x71C...b49D',
            'wallet_provider' => 'MetaMask Decentralized Vault',
            'wallet_address' => '0x38F6b27...c588E',
            'plan_name' => 'Institutional Arbitrage Tier III',
            'code' => '849201',
            'subject' => 'Quarterly Institutional Market Update',
            'message' => 'Your account verification tier has been successfully upgraded to Level 2. Maximum single withdrawal limits have been expanded.',
            'action_url' => url('/dashboard'),
            'status' => 'Processed & Verified',
            'date' => date('M d, Y h:i A'),
            'year' => date('Y'),
        ];
    }
}