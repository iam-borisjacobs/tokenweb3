<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\NewNotification;
use App\Models\Admin;
use App\Models\Notification;
use App\Models\Settings;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class NotificationController extends Controller
{
    /**
     * Display notification management and compose view
     */
    public function index()
    {
        $adminUser = Auth::guard('admin')->user();
        $settings = Settings::first();
        
        $notifications = Notification::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(25);

        $users = User::select('id', 'name', 'email', 'status')
            ->orderBy('name', 'asc')
            ->get();

        $stats = [
            'total_sent' => Notification::count(),
            'broadcast_count' => Notification::whereNull('user_id')->count(),
            'user_specific_count' => Notification::whereNotNull('user_id')->count(),
            'unread_count' => Notification::where('is_read', false)->count(),
        ];

        return view('admin.Notifications.index', [
            'title' => 'Broadcast & User Notifications',
            'adminUser' => $adminUser,
            'settings' => $settings,
            'notifications' => $notifications,
            'users' => $users,
            'stats' => $stats,
        ]);
    }

    /**
     * Send notification to All Users or Specific Selected Users
     */
    public function send(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'type' => 'required|in:info,success,warning,danger',
            'recipient_type' => 'required|in:all,selected',
            'users' => 'required_if:recipient_type,selected|array',
            'action_url' => 'nullable|string|max:255',
        ]);

        $title = $request->title;
        $message = $request->message;
        $type = $request->type;
        $actionUrl = $request->action_url;
        $sendEmail = $request->has('send_email');

        $recipientCount = 0;

        if ($request->recipient_type === 'all') {
            // Broadcast to all active users
            $allUsers = User::all();
            foreach ($allUsers as $user) {
                Notification::create([
                    'user_id' => $user->id,
                    'title' => $title,
                    'type' => $type,
                    'message' => $message,
                    'action_url' => $actionUrl,
                    'is_read' => false,
                ]);
                $recipientCount++;

                if ($sendEmail && !empty($user->email)) {
                    try {
                        Mail::to($user->email)->send(new NewNotification($message, $title, $user->name));
                    } catch (\Exception $e) {
                        Log::warning("Email notification failed for user {$user->id}: " . $e->getMessage());
                    }
                }
            }
            $statusMsg = "Broadcast notification successfully delivered to all {$recipientCount} users!";
        } else {
            // Target specific selected users
            $selectedUserIds = $request->users ?? [];
            $selectedUsers = User::whereIn('id', $selectedUserIds)->get();

            foreach ($selectedUsers as $user) {
                Notification::create([
                    'user_id' => $user->id,
                    'title' => $title,
                    'type' => $type,
                    'message' => $message,
                    'action_url' => $actionUrl,
                    'is_read' => false,
                ]);
                $recipientCount++;

                if ($sendEmail && !empty($user->email)) {
                    try {
                        Mail::to($user->email)->send(new NewNotification($message, $title, $user->name));
                    } catch (\Exception $e) {
                        Log::warning("Email notification failed for user {$user->id}: " . $e->getMessage());
                    }
                }
            }
            $statusMsg = "Notification successfully sent to {$recipientCount} selected user(s)!";
        }

        return redirect()->back()->with('success', $statusMsg);
    }

    /**
     * Delete a notification record
     */
    public function delete($id)
    {
        $notif = Notification::findOrFail($id);
        $notif->delete();

        return redirect()->back()->with('success', 'Notification deleted successfully!');
    }

    /**
     * Bulk delete notifications
     */
    public function bulkDelete(Request $request)
    {
        $ids = $request->input('selected_ids', []);
        if (!empty($ids)) {
            Notification::whereIn('id', $ids)->delete();
            return redirect()->back()->with('success', count($ids) . ' notifications deleted successfully!');
        }

        return redirect()->back()->with('message', 'No notifications selected for deletion.');
    }
}
