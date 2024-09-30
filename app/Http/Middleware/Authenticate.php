<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Route;

class Authenticate extends Middleware
{
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            // Sesuaikan rute redirection berdasarkan rute yang diakses
            if (Route::is('admin.*')) {
                return route('admin.login');
            } elseif (Route::is('user.*')) {
                return route('login');
            } elseif (Route::is('seller.*')) {
                return route('login');
            }
        }
    }
}
