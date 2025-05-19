<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
public function store(Request $request): RedirectResponse
{
    $request->validate([
        'username' => 'required|string',
        'password' => 'required|string',
    ]);

    if (Auth::attempt($request->only('username', 'password'), $request->boolean('remember'))) {
        $request->session()->regenerate();

        // ✅ Only call Auth::user() after successful login
        return match (Auth::user()->role) {
            'admin' => redirect()->intended('/admin/dashboard'),
            'pwd' => redirect()->intended('/pwd/dashboard'),
            'aics' => redirect()->intended('/aics/dashboard'),
            'senior' => redirect()->intended('/senior/dashboard'),
            'solo_parent' => redirect()->intended('/solo/dashboard'),
            default => redirect('/login'),
        };
    }

    // ⛔️ Don't call Auth::user() here — the user is not logged in yet
    return back()->withErrors([
        'username' => 'Invalid username or password.',
    ]);
}


    




    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
{
    Auth::guard('web')->logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/login'); // 👈 THIS LINE controls where to go after logout
}
}
