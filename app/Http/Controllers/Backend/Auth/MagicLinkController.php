<?php

namespace App\Http\Controllers\Backend\Auth;

use Carbon\Carbon;
use MagicLoginLink;
use App\Models\User;
use App\Models\MagicLink;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class MagicLinkController extends Controller
{

    public function magiLinkView()
    {
        return view('auth.magic-link');
    }
    // Send Magic Link to User's Email
    public function sendMagicLink(Request $request)

    {

        $request->validate([
            'email' => 'required|email',
        ]);

        $email = $request->input('email');

        $token = Str::random(60);  // Generate a random token

        $expiresAt = Carbon::now()->addMinutes(15);  // Token expiration time
        // dd($expiresAt);
        // Store the magic link token in the database
        MagicLink::create([
            'email' => $email,
            'token' => $token,
            'expires_at' => $expiresAt,
        ]);

        $user = User::where('email', $email)->first();

        // If the user exists
        if ($user) {
            // Create the magic link URL
            $magicLinkUrl = route('magic-link.login', ['token' => $token]);

            // Send the magic link via email
            Mail::send('auth.magic_link_email', ['magicLinkUrl' => $magicLinkUrl], function ($message) use ($email) {
                $message->to($email)->subject('Your Login Link');
            });

            return redirect()->back()->with('success', 'Login link sent successfully to your email.');
        } else {
            // If user doesn't exist, create a new user with the provided email
            $user = User::create([
                'email' => $email,
            ]);

            // Create the magic link URL
            $magicLinkUrl = route('magic-link.login', ['token' => $token]);

            // Send the magic link via email
            Mail::send('auth.magic_link_email', ['magicLinkUrl' => $magicLinkUrl], function ($message) use ($email) {
                $message->to($email)->subject('Your Login Link');
            });

            return redirect()->back()->with('success', 'Login link sent successfully to your email.');
        }
    }

    // Handle User Login via Magic Link
    public function loginWithMagicLink($token)
    {
        $magicLink = MagicLink::where('token', $token)->first();

        if (!$magicLink || $magicLink->expires_at < Carbon::now()) {
            return redirect('/')->withErrors(['token' => 'This link has expired or is invalid.']);
        }

        // Find the user associated with the magic link
        $user = User::where('email', $magicLink->email)->first();

        if (!$user) {
            return redirect('/')->withErrors(['user' => 'User not found.']);
        }

        // Log the user in
        auth()->login($user);

        // Delete the token after use
        $magicLink->delete();

        return redirect('/');  // Redirect to the home page or any protected route
    }

    // logout
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('status', 'You have been successfully logged out.');
    }
    public function login()
    {
        if (auth()->check()) {
            return redirect()->route('home'); // Replace 'dashboard' with your actual route name
        }
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
