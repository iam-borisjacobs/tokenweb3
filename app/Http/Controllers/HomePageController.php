<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Settings;
use App\Models\Plans;
use App\Models\Faq;
use App\Models\Testimony;
use App\Models\Deposit;
use App\Models\Withdrawal;
use App\Models\TermsPrivacy;
use Illuminate\Support\Facades\DB;
use App\Mail\NewNotification;
use Illuminate\Support\Facades\Mail;

class HomePageController extends Controller
{
    /**
     * Resolve the active front-end template view.
     */
    protected function getThemeView(string $page, $settings): string
    {
        $theme = strtolower($settings->frontend_template ?? $settings->frontend_theme ?? 'default');
        if ($theme === 'ecx' || $theme === 'eglines') {
            $viewName = 'home.ecx.' . $page;
            if (view()->exists($viewName)) {
                return $viewName;
            }
        }
        return 'home.' . $page;
    }

    public function index()
    {
        $settings = Settings::where('id', '=', '1')->first();
        //sum total deposited
        $total_deposits = DB::table('deposits')->select(DB::raw("SUM(amount) as total"))->where('status', 'Processed')->get();

        //sum total withdrawals
        $total_withdrawals = DB::table('withdrawals')->select(DB::raw("SUM(amount) as total"))->where('status', 'Processed')->get();

        $view = $this->getThemeView('index', $settings);

        return view($view)->with(array(
            'settings' => $settings,
            'total_users' => User::count(),
            'plans' => Plans::all(),
            'total_deposits' => $total_deposits,
            'total_withdrawals' => $total_withdrawals,
            'faqs' => Faq::orderby('id', 'desc')->get(),
            'test' => Testimony::orderby('id', 'desc')->get(),
            'withdrawals' => Withdrawal::orderby('id', 'DESC')->take(7)->get(),
            'deposits' => Deposit::orderby('id', 'DESC')->take(7)->get(),
            'title' => $settings->site_title,
            'mplans' => Plans::where('type', 'Main')->get(),
            'pplans' => Plans::where('type', 'Promo')->get(),
        ));
    }

    //Licensing and registration route
    public function licensing()
    {
        $settings = Settings::where('id', '=', '1')->first();
        $view = $this->getThemeView('licensing', $settings);

        return view($view)
            ->with(array(
                'mplans' => Plans::where('type', 'Main')->get(),
                'pplans' => Plans::where('type', 'Promo')->get(),
                'title' => 'Licensing, regulation and registration',
                'settings' => $settings,
            ));
    }

    //Terms of service route
    public function terms()
    {
        $settings = Settings::where('id', '=', '1')->first();
        $view = $this->getThemeView('terms', $settings);

        return view($view)
            ->with(array(
                'mplans' => Plans::where('type', 'Main')->get(),
                'title' => 'Terms of Service',
                'settings' => $settings,
            ));
    }

    //Privacy policy route
    public function privacy()
    {
        $settings = Settings::where('id', '=', '1')->first();
        $terms = TermsPrivacy::find(1);
        if ($terms && $terms->useterms == 'no') {
            return redirect()->back();
        }

        $view = $this->getThemeView('privacy', $settings);

        return view($view)
            ->with(array(
                'mplans' => Plans::where('type', 'Main')->get(),
                'title' => 'Privacy Policy',
                'settings' => $settings,
                'terms' => $terms,
            ));
    }

    //FAQ route
    public function faq()
    {
        $settings = Settings::where('id', '=', '1')->first();
        $view = $this->getThemeView('faq', $settings);

        return view($view)
            ->with(array(
                'title' => 'FAQs',
                'faqs' => Faq::orderby('id', 'desc')->get(),
                'settings' => $settings,
            ));
    }

    //about route
    public function about()
    {
        $settings = Settings::where('id', '=', '1')->first();
        $view = $this->getThemeView('about', $settings);

        return view($view)
            ->with(array(
                'mplans' => Plans::where('type', 'Main')->get(),
                'title' => 'About',
                'settings' => $settings,
            ));
    }

    //Services route
    public function services()
    {
        $settings = Settings::where('id', '=', '1')->first();
        $view = $this->getThemeView('services', $settings);

        return view($view)
            ->with(array(
                'mplans' => Plans::where('type', 'Main')->get(),
                'pplans' => Plans::where('type', 'Promo')->get(),
                'title' => 'Services',
                'settings' => $settings,
            ));
    }

    //Contact route
    public function contact()
    {
        $settings = Settings::where('id', '=', '1')->first();
        $view = $this->getThemeView('contact', $settings);

        return view($view)
            ->with(array(
                'mplans' => Plans::where('type', 'Main')->get(),
                'pplans' => Plans::where('type', 'Promo')->get(),
                'title' => 'Contact',
                'settings' => $settings,
            ));
    }

    //Security & Asset Protection route
    public function security()
    {
        $settings = Settings::where('id', '=', '1')->first();
        $view = $this->getThemeView('security', $settings);

        return view($view)
            ->with(array(
                'mplans' => Plans::where('type', 'Main')->get(),
                'title' => 'Asset Defense & Vault Security Architecture',
                'settings' => $settings,
            ));
    }



    //send contact message to admin email
    public function sendcontact(Request $request)
    {
        $settings = Settings::where('id', '1')->first();
        $message = substr(wordwrap($request['message'] ?? '', 70), 0, 350);
        $subject = ($request->subject ?? 'New Inquiry') . ", my email " . ($request->email ?? 'N/A');

        try {
            if (!empty($settings->contact_email)) {
                Mail::to($settings->contact_email)->send(new NewNotification($message, $subject, 'Admin'));
            }
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::error('Contact mail dispatch notice: ' . $e->getMessage());
        }

        // Dispatch WhatsApp real-time notification
        try {
            \App\Services\WhatsAppService::sendNotification('on_contact_message', 'New Contact Inquiry', [
                'Name' => $request->name ?? 'Website Visitor',
                'Email' => $request->email ?? 'N/A',
                'Subject' => $request->subject ?? 'General Inquiry',
                'Message Snippet' => substr($request->message ?? '', 0, 150) . (strlen($request->message ?? '') > 150 ? '...' : ''),
            ]);
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::error('Contact WhatsApp dispatch notice: ' . $e->getMessage());
        }

        return redirect()->back()
            ->with('success', 'Your inquiry has been transmitted successfully! Our team will respond shortly.');
    }
}