<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\NewNotification;
use App\Models\Settings;
use App\Models\SettingsCont;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Tp_Transaction;
use App\Traits\PingServer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TransferController extends Controller
{
    use PingServer;

    public function transfertouser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric|min:0.01|max:10000000',
            'email' => 'required|string|max:255',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'message' => $validator->errors()->first(),
            ]);
        }

        $sender = Auth::user();
        $receiver = User::where('email', $request->email)->orWhere('username', $request->email)->first();
        $settingss = SettingsCont::find(1);
        $transferChargePct = $settingss ? (float)$settingss->transfer_charges : 0;
        $amount = (float)$request->amount;
        $charges = ($amount * $transferChargePct) / 100;
        $todeduct = $amount + $charges;

        if (!Hash::check($request->password, $sender->password)) {
            return response()->json([
                'status' => 419,
                'message' => 'Incorrect Password',
            ]);
        }

        if (($request->email == $sender->email) || ($request->email == $sender->username) || ($receiver && $receiver->id === $sender->id)) {
            return response()->json([
                'status' => 419,
                'message' => 'You cannot send funds to yourself',
            ]);
        }
        if (!$receiver) {
            return response()->json([
                'status' => 419,
                'message' => 'No user with this email or username exists',
            ]);
        }

        if ($sender->account_bal < $todeduct) {
            return response()->json([
                'status' => 419,
                'message' => 'Insufficient Funds',
            ]);
        }

        DB::transaction(function () use ($sender, $receiver, $amount, $todeduct) {
            // Deduct from sender
            User::where('id', $sender->id)->decrement('account_bal', $todeduct);

            // Credit receiver
            User::where('id', $receiver->id)->increment('account_bal', $amount);

            // Create history for sender
            Tp_Transaction::create([
                'user' => $sender->id,
                'plan' => "Transferred to $receiver->name",
                'amount' => $amount,
                'type' => "Fund Transfer",
            ]);

            // Create history for receiver
            Tp_Transaction::create([
                'user' => $receiver->id,
                'plan' => "Received from $sender->name",
                'amount' => $amount,
                'type' => "Fund Transfer",
            ]);
        });

        //create history
        Tp_Transaction::create([
            'user' => $sender->id,
            'plan' => "Transfered to $receiver->name",
            'amount' => $request->amount,
            'type' => "Fund Transfer",
        ]);

        //create history for receiver
        Tp_Transaction::create([
            'user' => $receiver->id,
            'plan' => "Received from $sender->name",
            'amount' => $request->amount,
            'type' => "Fund Transfer",
        ]);


        $message = "You just received $settings->currency$request->amount from $sender->name and your account balance is now $settings->currency$receiver->account_bal";

        Mail::to($receiver->email)->send(new NewNotification($message, 'Credit Alert', $receiver->name));

        // Dispatch WhatsApp real-time notification
        \App\Services\WhatsAppService::sendNotification('on_transfer', 'Internal Fund Transfer', [
            'Sender' => $sender->name . ' (' . $sender->email . ')',
            'Recipient' => $receiver->name . ' (' . $receiver->email . ')',
            'Amount' => ($settings->currency ?? '$') . number_format($request->amount, 2),
            'Sender Remaining Bal' => ($settings->currency ?? '$') . number_format($sender->account_bal, 2),
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Transfer Completed, Refreshing page',
        ]);
    }


    public function renewSignalSub()
    {
        $user = User::find(Auth::user()->id);
        $response = $this->fetctApi('/subscription', [
            'id' => auth()->user()->id
        ]);
        $res = json_decode($response);
        $sub = $res->data;

        $responseSt = $this->fetctApi('/signal-settings');
        $info = json_decode($responseSt);
        $settings = $info->data->settings;

        if ($sub->subscription == 'Monthly') {
            $amount = $settings->signal_monthly_fee;
        } elseif ($sub->subscription == 'Quarterly') {
            $amount = $settings->signal_quartly_fee;
        } else {
            $amount = $settings->signal_yearly_fee;
        }

        if ($user->account_bal <  floatval($amount)) {
            return redirect()->back()->with('message', 'Your have insufficient funds in your account balance to perform this operation');
        }

        $renew =  $this->fetctApi('/renew-subscription', [
            'id' => $user->id,
        ], 'POST');

        if ($renew->successful()) {
            $user->account_bal = $user->account_bal - floatval($amount);
            $user->save();
            return redirect()->back()->with('success', 'Your subscription have been renewed successfully.');
        }
        return redirect()->back()->with('Something went wrong');
    }
}