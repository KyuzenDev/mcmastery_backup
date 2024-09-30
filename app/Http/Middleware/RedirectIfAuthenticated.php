<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $guard = null): Response
    {
        if (Auth::guard($guard)->check()) {
            $user = Auth::user();

            // Redirect pengguna ke dashboard sesuai dengan peran (role)
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role === 'user') {
                return redirect()->route('user.dashboard');
            } elseif ($user->role === 'seller') {
                return redirect()->route('seller.dashboard');
            } else {
                // Logout dan redirect jika role tidak dikenali
                Auth::logout();
                return redirect()->route('login')->with('fail', 'Unknown role. Please contact support.');
            }
        }

        return $next($request);
    }
}
