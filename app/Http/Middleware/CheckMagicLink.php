<?php

// app/Http/Middleware/CheckMagicLink.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\MagicLink;
use App\Models\User;

class CheckMagicLink
{
// In the middleware
public function handle(Request $request, Closure $next)
{
    // Retrieve the token from the URL parameter
    $token = $request->route('token');
    
    // Find the magic link record based on the token
    $magicLink = MagicLink::where('token', $token)->first();

    if (!$magicLink) {
        return redirect('/')->with('error', 'Invalid or expired magic link.');
    }

    // Check if the magic link has expired
    if ($magicLink->isExpired()) {
        $magicLink->delete();
        return redirect('/')->with('error', 'This magic link has expired.');
    }

    // Find the user associated with the magic link email
    $user = User::where('email', $magicLink->email)->first();

    if (!$user) {
        return redirect('/')->with('error', 'User not found.');
    }

    // Log the user in automatically
    auth()->login($user);

    // Delete the used magic link token
    $magicLink->delete();

    // Redirect the user to a protected route
    return redirect()->route('contact'); // Or any route you want to redirect after successful login
}

}
