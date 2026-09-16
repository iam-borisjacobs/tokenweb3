<?php

namespace App\Actions\Fortify;

use App\Mail\WelcomeEmail;
use App\Models\User;
use App\Models\Settings;
use App\Models\Agent;
use App\Models\CryptoAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Throwable;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        $settings = Settings::where('id', '1')->first();
        $request = request();
        if ($settings && $settings->captcha == "true") {
            Validator::make($input, [
                'name' => ['required', 'string', 'max:255'],
                'username' => ['required', 'unique:users,username'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => $this->passwordRules(),
                'g-recaptcha-response' => 'required|captcha',
                'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
            ])->validate();
        } else {
            Validator::make($input, [
                'name' => ['required', 'string', 'max:255'],
                'username' => ['required', 'unique:users,username'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => $this->passwordRules(),
                'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
            ])->validate();
        }

        $ref_by_id = null;
        if (session('ref_by')) {
            $ref_by = session('ref_by');
            $referrer = User::where('username', $ref_by)->first();
            $ref_by_id = $referrer ? $referrer->id : null;
        } elseif (!empty($input['ref_by'])) {
            $sponsor = User::where('username', $input['ref_by'])->first();
            $ref_by_id = $sponsor ? $sponsor->id : null;
        }

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'phone' => $input['phone'] ?? null,
            'username' => $input['username'],
            'country' => $input['country'] ?? null,
            'ref_by' => $ref_by_id,
            'status' => 'active',
            'password' => Hash::make($input['password']),
            'account_bal' => 0,
            'bonus' => 0,
            'roi' => 0,
            'ref_bonus' => 0,
        ]);

        $cryptoaccnt = new CryptoAccount();
        $cryptoaccnt->user_id = $user->id;
        $cryptoaccnt->save();
        $request->session()->forget('ref_by');
        $request->session()->forget('url.intended');
        $request->session()->flash('newly_registered', true);

        try {
            Mail::to($user->email)->send(new WelcomeEmail($user));
        } catch (\Throwable $e) {
            Log::error('Error sending welcome email on registration: ' . $e->getMessage());
        }

        // Dispatch WhatsApp real-time notification
        \App\Services\WhatsAppService::sendNotification('on_registration', 'New User Registered', [
            'Name' => $user->name,
            'Email' => $user->email,
            'Username' => $user->username,
            'Phone' => $user->phone ?? 'N/A',
            'Country' => $user->country ?? 'N/A',
            'User ID' => '#' . $user->id,
        ]);

        return $user;
    }
}