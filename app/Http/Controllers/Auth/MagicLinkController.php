<?php

// app/Http/Controllers/Auth/MagicLinkController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\MagicLink;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class MagicLinkController extends Controller
{
    public function contactView (){
        return view(('contact'));
    }
    public function magiLinkView (){
        return view(('auth.magic-link'));
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
        User::create([
            'email' => $email,
        ]);
        // Create the magic link URL
        $magicLinkUrl = route('magic-link.login', ['token' => $token]);

        // Send the magic link via email
        Mail::send('auth.magic_link_email', ['magicLinkUrl' => $magicLinkUrl], function ($message) use ($email) {
            $message->to($email)->subject('Your Magic Login Link');
        });

        return response()->json(['message' => 'Magic link sent to your email.']);
    }

    // Handle User Login via Magic Link
    public function loginWithMagicLink($token)
    {
        $magicLink = MagicLink::where('token', $token)->first();

        if (!$magicLink || $magicLink->expires_at < Carbon::now()) {
            return redirect('/')->withErrors(['token' => 'This magic link has expired or is invalid.']);
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

  public function destroy(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
