<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Support\Facades\Auth;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $role)
    {
        // Cek jika user tidak login atau tidak sesuai dengan role yang diminta
        if (!Auth::check() || Auth::user()->role !== $role) {
            // Redirect berdasarkan role mereka saat ini
            switch (Auth::user()->role) {
                case 'admin':
                    return redirect()->route('admin.dashboard');
                case 'user':
                    return redirect()->route('user.dashboard');
                case 'seller':
                    return redirect()->route('seller.dashboard');
                default:
                    return redirect()->route('dashboard');
            }
        }

        return $next($request);
    }
}
