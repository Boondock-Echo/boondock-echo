<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use App\Models\User;
use App\Models\Account;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class InvitationController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users',
        ]);

        $invitation = Invitation::create([
            'email' => $request->email,
            'token' => bin2hex(random_bytes(32)),
            'status' => 'pending',
        ]);

        // Send email to the invited user
        // Include the invitation token in the URL
        // Redirect back to the home page
    }

    public function sendInvitation(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|unique:invitations,email',
            'company' => 'required|string'
        ]);

        $account_id = Auth::user()->company;
        $account = Account::find($account_id);

        // Create an invitation token and store it in the database
        $invitation = Invitation::create([
            'email' => $request->email,
            'company' => $request->company,// add the company field to the invitation
            'account' => $account->name, // add the account_id field to the invitation
            'token' => sha1(time().$request->email.$request->company),
        ]);

        // Send the invitation email to the user
        Mail::send('emails.invitation', [
            'invitation' => $invitation,
            'account_name' => $account->account_name, // pass the account to the email template
            'company' => $request->company // add the company information to the data array
        ], function ($message) use ($invitation) {
            $message->to($invitation->email)->subject('Invitation to join our platform');
        });

        return redirect()->back()->with('success', 'Invitation sent successfully');
    }

    public function showRegistrationForm(Request $request, $token)
{
    $invitation = Invitation::where('token', $token)->firstOrFail();

    $user = User::where('email', $invitation->email)->first();

    if ($user) {
        // Update the company details of the existing user
        $user->company = $invitation->company;
        $user->save();
        return Redirect::route('login')->with('success', 'Company details updated successfully. Please login.');
    }

    return view('invite.register', [
        'token' => $token,
        'email' => $invitation->email,
        'company' => $invitation->company,
    ]);
}
    public function register(Request $request, $token)
    {
        $invitation = Invitation::where('token', $token)->first();

        if (!$invitation || $invitation->status === 'accepted') {
            return redirect()->route('inbox')->withErrors(['Invalid invitation']);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $invitation->email,
            'company' => $invitation->company,
            'password' => $request->password,
        ]);
        $user->email_verified_at = now();
        $user->save();

        $invitation->status = 'accepted';
        $invitation->save();

        auth()->login($user);

        return redirect()->route('inbox');
    }
}
