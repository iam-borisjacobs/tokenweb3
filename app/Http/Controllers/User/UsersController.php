<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Settings;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Mail\NewNotification;
use Illuminate\Support\Facades\Mail;

class UsersController extends Controller
{

  public function verifyemail()
  {
    return view('auth.verify-email', [
      'title' => 'Verify Your email address',
    ]);
  }
  public function addusername(Request $request)
  {
    Validator::make($request, [
      'username' => ['required', 'unique:users,username'],
    ])->validate();

    User::where('id', Auth::user()->id)->update([
      'username' => $request['username'],
    ]);
    return redirect()->route('dashboard');
  }

  //send contact message to admin email
  public function sendcontact(Request $request)
  {

    $settings = Settings::where('id', '1')->first();

    $category = $request->filled('category') ? "[{$request->category}] " : "";
    $priority = $request->filled('priority') ? " [Priority: {$request->priority}]" : "";
    $subject = "{$category}Support Ticket from {$request->name}{$priority}";

    $messageContent = "";
    if ($request->filled('category')) {
      $messageContent .= "Category: {$request->category}\n";
    }
    if ($request->filled('priority')) {
      $messageContent .= "Priority: {$request->priority}\n";
    }
    $messageContent .= "\nMessage:\n" . ($request->message ?? '');

    try {
      Mail::to($settings->contact_email)->send(new NewNotification($messageContent, $subject, 'Admin'));
    } catch (\Throwable $e) {
      // Fallback logging if SMTP is unconfigured locally
      \Log::error('Support ticket email failed: ' . $e->getMessage());
    }

    return redirect()->back()
      ->with('success', 'Your support inquiry has been submitted successfully! An official representative will review and respond shortly.');
  }


  //Get downlines level
  public function getdownlines($array, $parent = 0, $level = 0)
  {
    $referedMembers = '';
    foreach ($array as $entry) {
      if ($entry->ref_by == $parent) {

        if ($level == 0) {
          $levelQuote = "Direct referral";
        } else {
          $levelQuote = "Indirect referral level $level";
        }

        $referedMembers .= "
                  <tr>
                  <td> $entry->name $entry->l_name </td> 
                  <td> $levelQuote </td>" .
          '<td>' . $this->getUserParent($entry->id) . '</td>' .
          '<td>' . $this->getUserStatus($entry->id) . '</td>
                  <td>' . $this->getUserRegDate($entry->id) . '</td>
                  </tr>';

        $referedMembers .= $this->getdownlines($array, $entry->id, $level + 1);
      }

      if ($level == 6) {
        break;
      }
    }
    return $referedMembers;
  }

  //Get user Parent
  function getUserParent($id)
  {
    $user = User::where('id', $id)->first();
    $parent = User::where('id', $user->ref_by)->first();
    if ($parent) {
      return "$parent->name $parent->l_name";
    } else {
      return "null";
    }
  }

  //Get user status
  function getUserStatus($id)
  {
    $user = User::where('id', $id)->first();

    return $user->status;
  }

  //Get User Registration Date
  function getUserRegDate($id)
  {
    $user = User::where('id', $id)->first();

    return $user->created_at;
  }
}