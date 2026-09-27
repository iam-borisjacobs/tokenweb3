<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Settings;
use Illuminate\Support\Facades\Auth;

class CheckMaintenanceMode
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // 1. Admin routes are strictly exempt (admin can always log in and manage the site)
        if ($request->is('admin*') || $request->is('login/admin*')) {
            return $next($request);
        }

        // 2. Fetch platform settings
        try {
            $settings = Settings::first();
        } catch (\Throwable $e) {
            return $next($request);
        }

        if (!$settings || !$settings->maintenance_mode) {
            return $next($request);
        }

        // 3. Authenticated administrators can browse the public site freely
        if (Auth::guard('admin')->check()) {
            return $next($request);
        }

        // 4. Secret passkey bypass for authorized team/VIP access
        $bypassSecret = $settings->maintenance_secret;
        if (!empty($bypassSecret)) {
            if ($request->query('bypass') === $bypassSecret) {
                session(['maintenance_bypassed' => true]);
                return $next($request);
            }
            if (session('maintenance_bypassed') === true) {
                return $next($request);
            }
        }

        // 5. Exclude payment webhooks
        if ($request->is('paystack/callback*') || $request->is('coinpayment/ipn*') || $request->is('stripe/webhook*') || $request->is('webhook*')) {
            return $next($request);
        }

        // 6. Return high-conversion institutional Under Maintenance page
        return response()->view('errors.maintenance', [
            'settings' => $settings,
        ], 503);
    }
}
