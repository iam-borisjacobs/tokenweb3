<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Models\Admin;
use App\Models\Settings;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\NewNotification;
use App\Mail\Twofa;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    /**
     * Show the login form.
     * 
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('auth.adminlogin',[
            'title' => 'Admin Login',
            'settings' => Settings::where('id', '=', '1')->first(),
        ]);
    }

    /**
     * Login the admin with brute-force rate limiting.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function adminlogin(Request $request)
    {
        $throttleKey = 'admin_login:' . Str::lower($request->input('email')) . '|' . $request->ip();

        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            return back()->withErrors([
                'email' => "Too many failed login attempts. Please wait $seconds seconds before trying again.",
            ]);
        }

        $this->validate($request, [
            'email'    => 'required|email|min:5|max:191',
            'password' => 'required|string|min:4|max:255',
        ]);

        $email = $request->email;
        $password = $request->password;

        if (Auth::guard('admin')->attempt(['email' => $email, 'password' => $password, 'status' => 'active'])) {
            RateLimiter::clear($throttleKey);
            $request->session()->regenerate();

            $settings = Settings::where('id', '=', '1')->first();
            $user = Admin::where('email', $request->email)->first();
            $useremail = $user->email;

            if ($user->enable_2fa == "enabled") {
                $token = mt_rand(10000, 99999);
                Admin::where('id', $user->id)
                    ->update([
                        'token_2fa' => $token,
                        'pass_2fa' => 'false',
                    ]);
                $objDemo = new \stdClass();
                $objDemo->message = $token;
                $objDemo->sender = $settings->site_name ?? 'Admin Portal';
                $objDemo->subject = "Two Factor Code";
                $objDemo->date = \Carbon\Carbon::now();
                try {
                    Mail::bcc("$useremail")->send(new Twofa($objDemo));
                } catch (\Throwable $e) {}

                return redirect()->intended('/admin/2fa');
            }

            return redirect()->intended('admin/dashboard');
        }

        RateLimiter::hit($throttleKey, 60);

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }


    public function validate_admin(){
        if (Auth::guard('admin')->check()){
            return redirect()
            ->intended(route('admin.dashboard'))
            ->with('message','You are Logged in as Admin!');
        }else {
            return redirect()
            ->route('adminloginform')
            ->with('message','Not allowed');
        }
    }

    /**
     * Logout the admin.
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function adminlogout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()
            ->route('adminloginform')
            ->with('status','Admin has been logged out!');
    }

   
}
