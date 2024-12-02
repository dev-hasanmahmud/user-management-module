<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Get the current user
        $user = auth()->user();
        // dd(11);
        // Check if user is logged in
        if (!$user) {
            return redirect()->route('login');
        }

        // Get the requested menu based on route (or slug)
        $slug = $request->route()->getName(); // Assuming the menu is linked to the route name (slug)
        $menu = \App\Models\Menu::where('slug', $slug)->first();

        if (!$menu) {
            // If no menu is found for the route, proceed without access control
            return $next($request);
        }

        // Check if the user has any role that has access to this menu
        $hasAccess = $user->roles->pluck('menus')->contains($menu);

        if ($hasAccess) {
            return $next($request);
        }

        // If user doesn't have access, redirect them or return an error
        return redirect()->route('home')->with('error', 'You do not have access to this menu.');
    }
}
