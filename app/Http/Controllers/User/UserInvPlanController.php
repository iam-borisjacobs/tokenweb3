<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Tp_Transaction;
use Illuminate\Support\Facades\Auth;
use App\Mail\NewNotification;
use App\Models\User_plans;
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\DB;

class UserInvPlanController extends Controller
{
    public function cancelPlan($planId)
    {
        $user = Auth::user();

        // Enforce strict ownership and check that the plan is currently active (IDOR & Replay protection)
        $plan = User_plans::where('id', $planId)
            ->where('user', $user->id)
            ->where('active', 'yes')
            ->first();

        if (!$plan) {
            return back()->with('message', 'Unable to cancel this investment plan, or it has already been cancelled.');
        }

        DB::transaction(function () use ($plan, $user) {
            $plan->active = 'cancelled';
            $plan->save();

            // Credit the user capital atomically
            User::where('id', $user->id)->increment('account_bal', $plan->amount);

            // Save to transaction history
            $th = new Tp_Transaction();
            $th->plan = $plan->dplan->name ?? 'Investment Plan';
            $th->user = $user->id;
            $th->amount = $plan->amount;
            $th->type = "Investment capital for cancelled plan";
            $th->save();
        });

        // Send confirmation email
        $planName = $plan->dplan->name ?? 'Investment Plan';
        $message = "You have successfully cancelled your $planName plan and your investment capital has been credited back to your account. If this was a mistake, please contact support immediately.";
        try {
            Mail::to($user->email)->send(new NewNotification($message, 'Investment Plan Cancelled', $user->name));
        } catch (\Throwable $e) {
            // Mail failure should not revert the cancellation
        }

        return back()->with('success', 'Plan cancelled successfully and capital returned to your balance.');
    }
}