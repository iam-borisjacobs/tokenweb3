<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\KycApplicationRequest;
use App\Mail\NewNotification;
use App\Models\Kyc;
use App\Models\Settings;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class VerifyController extends Controller
{
    public function verifyaccount(KycApplicationRequest $request)
    {
        $user = Auth::user();

        // Ensure files are present and valid
        if (!$request->hasFile('frontimg') || !$request->file('frontimg')->isValid() ||
            !$request->hasFile('backimg') || !$request->file('backimg')->isValid()) {
            return redirect()->back()
                ->withInput()
                ->with('message', 'One or both document files failed to upload properly. Please re-select the files and try again.');
        }

        $frontimg = $request->file('frontimg');
        $backimg = $request->file('backimg');

        $whitelist = ['jpeg', 'jpg', 'png', 'webp', 'pdf', 'heic', 'heif'];
        $frontExt = strtolower($frontimg->getClientOriginalExtension() ?: $frontimg->extension());
        $backExt = strtolower($backimg->getClientOriginalExtension() ?: $backimg->extension());

        if (!in_array($frontExt, $whitelist) || !in_array($backExt, $whitelist)) {
            return redirect()->back()
                ->withInput()
                ->with('message', 'Unaccepted image or document format. Please upload valid JPG, PNG, WEBP, or PDF files.');
        }

        // Upload documents to storage
        $frontimgPath = $frontimg->store('uploads', 'public');
        $backimgPath = $backimg->store('uploads', 'public');

        // Check for existing KYC record to update (handles resubmission / corrections)
        $kyc = Kyc::where('user_id', $user->id)->first();
        if ($kyc) {
            // Delete previous files to prevent orphaned disk usage
            if ($kyc->frontimg && Storage::disk('public')->exists($kyc->frontimg)) {
                Storage::disk('public')->delete($kyc->frontimg);
            }
            if ($kyc->backimg && Storage::disk('public')->exists($kyc->backimg)) {
                Storage::disk('public')->delete($kyc->backimg);
            }
        } else {
            $kyc = new Kyc();
            $kyc->user_id = $user->id;
        }

        $kyc->first_name = $request->first_name;
        $kyc->last_name = $request->last_name;
        $kyc->email = $request->email;
        $kyc->phone_number = $request->phone_number;
        $kyc->dob = $request->dob;
        $kyc->social_media = $request->social_media ?? 'N/A';
        $kyc->address = $request->address;
        $kyc->city = $request->city;
        $kyc->state = $request->state;
        $kyc->country = $request->country;
        $kyc->document_type = $request->document_type;
        $kyc->frontimg = $frontimgPath;
        $kyc->backimg = $backimgPath;
        $kyc->status = 'Under review';
        $kyc->save();

        // Update user KYC status
        User::where('id', $user->id)->update([
            'kyc_id' => $kyc->id,
            'account_verify' => 'Under review',
        ]);

        // Notify Admin safely
        $settings = Settings::find(1);
        $url = config('app.url') . '/admin/dashboard/kyc';

        if ($settings && !empty($settings->contact_email)) {
            $message = "This is to inform you that {$user->name} just submitted a request for KYC (identity verification). Please log in to your admin dashboard to review and take action.";
            $subject = "Identity Verification Request from {$user->name}";
            try {
                Mail::to($settings->contact_email)->send(new NewNotification($message, $subject, 'Admin', $url));
            } catch (\Throwable $e) {
                Log::warning('Could not send KYC admin email notification: ' . $e->getMessage());
            }
        }

        // Dispatch WhatsApp real-time notification
        try {
            \App\Services\WhatsAppService::sendNotification('on_kyc_submit', 'KYC Documents Submitted', [
                'User' => $user->name . ' (' . $user->email . ')',
                'Document Type' => $kyc->document_type ?? 'Government ID',
                'Status' => 'Under Review',
                'Review URL' => $url,
            ]);
        } catch (\Throwable $th) {
            // Silently continue if WhatsApp service is unconfigured
        }

        return redirect()->route('account.verify')->with('success', 'Your verification documents have been submitted successfully! Our compliance team will review your application shortly.');
    }
}