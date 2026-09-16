<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Settings;
use App\Models\SettingsCont;
use App\Models\Wdmethod;
use App\Models\WalletType;
use App\Models\WhatsAppSetting;
use App\Services\WhatsAppService;
use Illuminate\Support\Facades\Storage;

class AppSettingsController extends Controller
{

    // Return view
    public function appsettingshow()
    {
        $live_timezones = timezone_identifiers_list();
        include __DIR__ . '/currencies.php';
        return view('admin.Settings.AppSettings.show', [
            'title' => 'Website information settings',
            'timezones' => $live_timezones,
            'currencies' => $currencies,
            'timezone' => config('app.timezone'),
            'settings' => Settings::where('id', '=', '1')->first(),
            'cryptoMethods' => Wdmethod::where('methodtype', 'crypto')->orderByDesc('id')->get(),
            'walletTypes' => WalletType::orderBy('name', 'asc')->get(),
            'whatsappSettings' => WhatsAppSetting::getSettings(),
        ]);
    }

    // for front end content management
    function RandomStringGenerator($n)
    {
        $generated_string = "";
        $domain = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
        $len = strlen($domain);
        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, $len - 1);
            $generated_string = $generated_string . $domain[$index];
        }
        // Return the random generated string 
        return $generated_string;
    }


    // update wensite information
    public function updatewebinfo(Request $request)
    {
        $this->validate($request, [
            'logo' => 'nullable|mimes:jpg,jpeg,png,svg,webp|max:3072',
            'dark_logo' => 'nullable|mimes:jpg,jpeg,png,svg,webp|max:3072',
            'favicon' => 'nullable|mimes:jpg,jpeg,png,ico,svg|max:2048',
        ]);

        $settings = Settings::where('id', '=', '1')->first();

        if ($request->hasfile('logo')) {
            $file = $request->file('logo');
            Storage::disk('public')->delete($settings->logo);
            $path = $file->store('photos', 'public');
        } else {
            $path  = $settings->logo;
        }

        if ($request->hasfile('dark_logo')) {
            $darkfile = $request->file('dark_logo');
            if (!empty($settings->dark_logo)) {
                Storage::disk('public')->delete($settings->dark_logo);
            }
            $pathdark = $darkfile->store('photos', 'public');
        } else {
            $pathdark = $settings->dark_logo;
        }

        if ($request->hasfile('favicon')) {
            $favfile = $request->file('favicon');
            Storage::disk('public')->delete($settings->favicon);
            $pathfav = $favfile->store('photos', 'public');
        } else {
            $pathfav = $settings->favicon;
        }

        $updateFields = [
            'newupdate' => $request['update'],
            'site_name' => $request['site_name'],
            'description' => $request['description'],
            'keywords' => $request['keywords'],
            'timezone' => $request['timezone'],
            'site_title' => $request['site_title'],
            'install_type' => $request['install_type'],
            'logo' => $path,
            'dark_logo' => $pathdark,
            'merchant_key' => $request->merchant_key,
            'favicon' => $pathfav,
            'tawk_to' => strip_tags($request['tawk_to']),
            'site_address' => $request['site_address'],
            'welcome_message' => $request->welcome_message,
        ];

        if ($request->has('enable_welcome_popup')) {
            $updateFields['enable_welcome_popup'] = $request->enable_welcome_popup == 'yes' ? 'yes' : 'no';
        }

        if ($request->has('popup_slides') && is_array($request->popup_slides)) {
            $slides = [];
            foreach ($request->popup_slides as $i => $s) {
                $imagePath = $s['existing_image'] ?? null;
                if (!empty($s['remove_image']) && $s['remove_image'] == '1') {
                    if (!empty($imagePath)) {
                        \Illuminate\Support\Facades\Storage::disk('public')->delete($imagePath);
                    }
                    $imagePath = null;
                }
                if ($request->hasFile("slide_images.$i")) {
                    $file = $request->file("slide_images.$i");
                    if ($file && $file->isValid()) {
                        if (!empty($imagePath)) {
                            \Illuminate\Support\Facades\Storage::disk('public')->delete($imagePath);
                        }
                        $imagePath = $file->store('photos', 'public');
                    }
                }

                $slides[] = [
                    'step' => (string) ($i + 1),
                    'is_active' => ($s['is_active'] ?? 'yes') === 'no' ? 'no' : 'yes',
                    'image' => $imagePath,
                    'badge' => trim($s['badge'] ?? ('Step ' . ($i + 1))),
                    'icon' => trim($s['icon'] ?? ($i === 1 ? 'fa-wallet' : ($i === 2 ? 'fa-chart-line' : 'fa-shield-halved'))),
                    'title' => trim($s['title'] ?? ''),
                    'message' => trim($s['message'] ?? ''),
                    'highlight' => trim($s['highlight'] ?? ''),
                    'button_text' => trim($s['button_text'] ?? ''),
                    'button_url' => trim($s['button_url'] ?? ''),
                ];
            }
            $updateFields['welcome_popup_slides'] = json_encode($slides);
        }

        Settings::where('id', '1')->update($updateFields);

        $moreset = SettingsCont::find(1);
        $moreset->purchase_code = $request->purchase_code;
        $moreset->save();

        return redirect()->back()->with('success', 'Settings Saved successfully');
    }



    public function updatepreference(Request $request)
    {

        if ($request->return_capital == 'true') {
            $return_capital = true;
        } else {
            $return_capital = false;
        }

        Settings::where('id', 1)->update([
            'contact_email' => $request['contact_email'],
            'phone' => $request['phone'],
            'location' => $request['location'],
            'map_iframe' => $request['map_iframe'],
            'currency' => $request['currency'],
            's_currency' => $request['s_currency'],
            'weekend_trade' => $request['weekend_trade'],
            'trade_mode' => $request['trade_mode'],
            'enable_verification' => $request['enail_verify'],
            'google_translate' => $request['googlet'],
            'enable_kyc' => $request['enable_kyc'],
            'enable_kyc_registration' => $request['enable_kyc_registration'],
            'captcha' => $request['captcha'],
            'enable_with' => $request['withdraw'],
            'return_capital' => $return_capital,
            'enable_social_login' => $request['social'],
            'enable_annoc' => $request['annouc'],
            'redirect_url' => $request->redirect_url,
            'should_cancel_plan' => $request->should_cancel_plan,
            'trading_lock_enabled' => $request->has('trading_lock_enabled') ? ($request->trading_lock_enabled == '1' || $request->trading_lock_enabled == 'on' || $request->trading_lock_enabled === true) : true,
            'min_trading_balance' => $request->has('min_trading_balance') ? floatval($request->min_trading_balance) : 100000.00,
        ]);
        return response()->json(['status' => 200, 'success' => 'Settings Saved successfully']);
    }

    // Update email preference
    public function updateemail(Request $request)
    {
        Settings::where('id', ' 1')
            ->update([
                'mail_server' => $request['server'],
                'emailfrom' => $request['emailfrom'],
                'emailfromname' => $request['emailfromname'],
                'smtp_host' => $request['smtp_host'],
                'smtp_port' => $request['smtp_port'],
                'smtp_encrypt' => $request['smtp_encrypt'],
                'smtp_user' => $request['smtp_user'],
                'smtp_password' => $request['smtp_password'],
                'google_id' => $request['google_id'],
                'google_secret' => $request['google_secret'],
                'google_redirect' => $request['google_redirect'],
                'capt_secret' => $request['capt_secret'],
                'capt_sitekey' => $request['capt_sitekey'],
            ]);
        return response()->json(['status' => 200, 'success' => 'Settings Saved successfully']);
        //return redirect()->back()->with('message', 'Action Sucessful');
    }

    /**
     * Add a new Connect Wallet provider with custom icon
     */
    public function addWalletType(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:191|unique:wallet_types,name',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:3072',
            'status' => 'nullable|string|in:enabled,disabled',
        ]);

        $iconFilename = 'generic.png';

        if ($request->hasFile('icon')) {
            $file = $request->file('icon');
            $iconFilename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $targetDir = base_path('assets/wallet-types/icons');
            if (!file_exists($targetDir)) {
                @mkdir($targetDir, 0777, true);
            }
            $file->move($targetDir, $iconFilename);
        }

        WalletType::create([
            'name' => trim($request->name),
            'icon' => $iconFilename,
            'status' => $request->status ?? 'enabled',
            'sort_order' => (WalletType::max('sort_order') ?? 0) + 1,
        ]);

        return redirect()->to(route('appsettingshow') . '#wallet-types')->with('success', 'Connect wallet provider "' . $request->name . '" created successfully.');
    }

    /**
     * Delete a Connect Wallet provider
     */
    public function deleteWalletType($id)
    {
        $wallet = WalletType::findOrFail($id);
        $name = $wallet->name;
        $wallet->delete();

        return redirect()->to(route('appsettingshow') . '#wallet-types')->with('success', 'Connect wallet provider "' . $name . '" deleted successfully.');
    }

    /**
     * Toggle a Connect Wallet provider enabled/disabled status
     */
    public function toggleWalletType($id)
    {
        $wallet = WalletType::findOrFail($id);
        $wallet->status = ($wallet->status === 'enabled') ? 'disabled' : 'enabled';
        $wallet->save();

        return redirect()->to(route('appsettingshow') . '#wallet-types')->with('success', 'Status for "' . $wallet->name . '" updated to ' . $wallet->status . '.');
    }

    /**
     * Update WhatsApp notification settings
     */
    public function updateWhatsApp(Request $request)
    {
        $settings = WhatsAppSetting::getSettings();

        $notifications = [
            'on_deposit' => $request->has('notif_on_deposit'),
            'on_withdrawal' => $request->has('notif_on_withdrawal'),
            'on_plan_purchase' => $request->has('notif_on_plan_purchase'),
            'on_wallet_connect' => $request->has('notif_on_wallet_connect'),
            'on_registration' => $request->has('notif_on_registration'),
            'on_kyc_submit' => $request->has('notif_on_kyc_submit'),
            'on_contact_message' => $request->has('notif_on_contact_message'),
            'on_transfer' => $request->has('notif_on_transfer'),
        ];

        $settings->update([
            'enabled' => $request->has('enabled') && ($request->enabled == '1' || $request->enabled == 'true' || $request->enabled == 'on'),
            'provider' => in_array($request->provider, ['ultramsg', 'green_api']) ? $request->provider : 'ultramsg',
            'instance_id' => trim($request->instance_id ?? ''),
            'token' => trim($request->token ?? ''),
            'admin_number' => trim($request->admin_number ?? ''),
            'notifications' => $notifications,
        ]);

        return response()->json([
            'status' => 200,
            'success' => 'WhatsApp notification preferences saved successfully!'
        ]);
    }

    /**
     * Dispatch a test WhatsApp message to verify connection
     */
    public function testWhatsApp(Request $request)
    {
        $provider = in_array($request->provider, ['ultramsg', 'green_api']) ? $request->provider : 'ultramsg';
        $instanceId = trim($request->instance_id ?? '');
        $token = trim($request->token ?? '');
        $adminNumber = trim($request->admin_number ?? '');

        if (empty($instanceId) || empty($token) || empty($adminNumber)) {
            return response()->json([
                'status' => 400,
                'success' => false,
                'message' => 'Please fill in the Instance ID, Token, and Admin Phone Number before testing.'
            ]);
        }

        $res = WhatsAppService::sendTestMessage($provider, $instanceId, $token, $adminNumber);

        return response()->json([
            'status' => $res['success'] ? 200 : 400,
            'success' => $res['success'],
            'message' => $res['message']
        ]);
    }
}