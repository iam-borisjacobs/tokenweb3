<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\NewNotification;
use App\Models\Kyc;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class KycController extends Controller
{

    public function processKyc(Request $request)
    {
        $application = Kyc::find($request->kyc_id);
        $user = User::where('id', $application->user_id)->first();

        // If associated user exists, update user status and send email notification
        if ($user) {
            if ($request->action == 'Accept') {
                $user->update([
                    'account_verify' => 'Verified',
                ]);
                $application->status = "Verified";
                $application->save();
            } else {
                if ($application->frontimg && Storage::disk('public')->exists($application->frontimg)) {
                    Storage::disk('public')->delete($application->frontimg);
                }
                if ($application->backimg && Storage::disk('public')->exists($application->backimg)) {
                    Storage::disk('public')->delete($application->backimg);
                }

                $user->update([
                    'account_verify' => 'Rejected',
                ]);
                $application->delete();
            }

            if (!empty($user->email)) {
                try {
                    Mail::to($user->email)->send(new NewNotification($request->message, $request->subject, $user->name));
                } catch (\Throwable $th) {
                    // Ignore mail error if SMTP is unconfigured
                }
            }
        } else {
            // Orphaned KYC record handling
            if ($request->action == 'Accept') {
                $application->status = "Verified";
                $application->save();
            } else {
                if ($application->frontimg && Storage::disk('public')->exists($application->frontimg)) {
                    Storage::disk('public')->delete($application->frontimg);
                }
                if ($application->backimg && Storage::disk('public')->exists($application->backimg)) {
                    Storage::disk('public')->delete($application->backimg);
                }
                $application->delete();
            }
        }

        return redirect()->route('kyc')->with('success', 'Action Successful!');
    }
}