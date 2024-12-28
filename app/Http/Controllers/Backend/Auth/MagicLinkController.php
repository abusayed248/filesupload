<?php

namespace App\Http\Controllers\Backend\Auth;

use MagicLoginLink;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class MagicLinkController extends Controller
{
    public function login()
    {
        return view('auth.magic-link');
    }

    public function loginWithToken($token)
    {
        // Find the user with the given token
        $user = User::where('login_token', $token)->first();

        if (!$user) {
            return redirect()->route('login')->withErrors(['token' => 'Invalid or expired token']);
        }

        // Log the user in
        Auth::login($user);

        // Clear the token from the database
        $user->login_token = null;
        $user->save();

        return redirect()->route('dashboard'); // Redirect to a protected page, e.g., dashboard
    }

    public function sendLoginLink(Request $request)
    {
        // Validate the email address
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        // Find the user by email
        $user = User::where('email', $request->email)->first();

        // Generate a unique token
        $token = Str::random(64);

        // Save the token in the database
        $user->login_token = $token;
        $user->save();

        // Send the magic login link via email
        Mail::to($user->email)->send(new MagicLoginLink($user, $token));

        return back()->with('status', 'We have sent you a login link. Please check your email!');
    }
}
