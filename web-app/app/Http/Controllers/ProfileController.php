<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Account;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    public function index()
    {
        $account = auth()->user()->company;
        $account = Account::find($account);
        $accountName = '';
        $accountId = '';
        if ($account) {
            $accountName = $account->account_name;
            $accountId = $account->id;
        }
        return view('profile', compact('accountName','accountId'));

    }

    public function update(User $user, Request $request)
    {
        // $user = Auth::user();

        // Validate the request data
        $request->validate([
            // 'name' => 'required',
            // 'email' => 'required|email|unique:users,email,' . $user->id,
            'profile_picture' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $user->update([
            'name' => $request->name,
            // 'email' => $request->email,
            'last_name' => $request->last_name,
            // 'company' => $request->company,
            // 'profile_picture' => $request->profile_picture,
            'nick_name' => $request->nick_name,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'zip' => $request->zip,
            'timezone' => $request->timezone,
            'updated_at' => now(),


        ]);


    if ($request->hasFile('profile_picture')) {
        $path = $request->file('profile_picture')->store('public/profile_pictures');
        $user->update(['profile_picture' => $path]);

    }


        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
}
