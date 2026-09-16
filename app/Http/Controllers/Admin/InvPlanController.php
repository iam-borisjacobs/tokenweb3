<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Plans;
use App\Models\User_plans;

use Illuminate\Support\Facades\Storage;

class InvPlanController extends Controller
{
    // Add plan request
    public function addplan(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'min_price' => 'required',
            'max_price' => 'required',
            'minr' => 'required',
            'maxr' => 'required',
            'expiration' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:10240',
        ]);

        $plan = new Plans();
        $plan->name = $request['name'];
        $plan->price = $request['price'];
        $plan->min_price = $request['min_price'];
        $plan->max_price = $request['max_price'];
        $plan->minr = $request['minr'];
        $plan->maxr = $request['maxr'];
        $plan->gift = $request['gift'] ?? 0;
        $plan->expected_return = $request['return'];
        $plan->increment_type = $request['t_type'];
        $plan->increment_interval = $request['t_interval'];
        $plan->increment_amount = $request['t_amount'];
        $plan->expiration = $request['expiration'];
        $plan->type = 'Main';
        $plan->category = $request->input('category', 'crypto');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            if ($file && $file->isValid()) {
                $plan->image = $file->store('photos', 'public');
            }
        }

        $plan->save();
        return redirect()->route('plans')->with('success', 'Plan created successfully!');
    }

    // Update plan
    public function updateplan(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'name' => 'required',
            'price' => 'required',
            'min_price' => 'required',
            'max_price' => 'required',
            'minr' => 'required',
            'maxr' => 'required',
            'expiration' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:10240',
        ]);

        $plan = Plans::findOrFail($request['id']);

        // Handle image removal if requested
        if (!empty($request['remove_image']) && $request['remove_image'] == '1') {
            if (!empty($plan->image)) {
                Storage::disk('public')->delete($plan->image);
            }
            $plan->image = null;
        }

        // Handle new image upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            if ($file && $file->isValid()) {
                if (!empty($plan->image)) {
                    Storage::disk('public')->delete($plan->image);
                }
                $plan->image = $file->store('photos', 'public');
            }
        }

        $plan->name = $request['name'];
        $plan->price = $request['price'];
        $plan->min_price = $request['min_price'];
        $plan->max_price = $request['max_price'];
        $plan->minr = $request['minr'];
        $plan->maxr = $request['maxr'];
        $plan->gift = $request['gift'] ?? 0;
        $plan->expected_return = $request['return'];
        $plan->increment_type = $request['t_type'];
        $plan->increment_amount = $request['t_amount'];
        $plan->increment_interval = $request['t_interval'];
        $plan->expiration = $request['expiration'];
        $plan->category = $request->input('category', $plan->category ?? 'crypto');
        $plan->save();

        return redirect()->back()->with('success', 'Plan Successfully Updated');
    }

    // Trash Plans route
    public function trashplan($id)
    {
        $plan = Plans::find($id);
        if ($plan && !empty($plan->image)) {
            Storage::disk('public')->delete($plan->image);
        }

        // Delete this plan from every user account that has bought this plan
        $usersplan = User_plans::where('plan', $id)->get();
        if (count($usersplan) > 0) {
            foreach ($usersplan as $plns) {
                User_plans::where('id', $plns->id)->delete();
            }
        }

        // Remove users from the plan before deleting
        $users = User::where('plan', $id)->get();
        foreach ($users as $user) {
            User::where('id', $user->id)->update([
                'plan' => 0,
            ]);
        }

        if ($plan) {
            $plan->delete();
        }

        return redirect()->back()->with('success', 'Investment Plan deleted Successfully!');
    }
}
