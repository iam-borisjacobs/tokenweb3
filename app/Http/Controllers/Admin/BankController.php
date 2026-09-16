<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BankController extends Controller
{
    public function index()
    {
        $banks = \App\Models\BankLink::with('user')->latest()->get();
        return view('admin.bank.index', [
            'banks' => $banks,
            'title' => 'User Linked Banks',
        ]);
    }

    public function destroy($id)
    {
        $bank = \App\Models\BankLink::findOrFail($id);
        $bank->delete();

        return redirect()->route('admin.bank.index')->with('success', 'Linked bank record deleted successfully.');
    }
}
