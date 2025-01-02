<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ContactAccessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Ensure the user is authenticated
        if (!Auth::check() && Auth::user()->role == 'admin') {
            return redirect()->route('update.contact.info')->with('error', 'You are not a super admin.');
        }

        $user = Auth::user();
        if ($user->role !== 'admin') {
            return redirect()->route('contact');
        }

        return $next($request); 
    }
}
