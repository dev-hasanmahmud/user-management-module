<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {dd(11);
        // Check if the user is authenticated and already logged in
        if (Auth::check()) {
            return redirect('/dashboard');  // Redirect to dashboard if already logged in
        }

        return $next($request);
    }
}
