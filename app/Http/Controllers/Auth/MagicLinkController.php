<?php

// app/Http/Controllers/Auth/MagicLinkController.php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Models\User;
use App\Models\MagicLink;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class MagicLinkController extends Controller
{
    public function dmca (){
        return view('dmca');
    }
    public function magiLinkView (){
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


}
