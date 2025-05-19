<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticatedUser
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            // Redirect user to their dashboard based on role
            return match (Auth::user()->role) {
                'admin' => redirect('/admin/dashboard'),
                'pwd' => redirect('/pwd/dashboard'),
                'aics' => redirect('/aics/dashboard'),
                'senior' => redirect('/senior/dashboard'),
                'solo_parent' => redirect('/solo/dashboard'),
                default => redirect('/'),
            };
        }

        return $next($request);
    }
}
