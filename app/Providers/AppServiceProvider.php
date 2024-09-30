<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Session;
use Illuminate\Auth\Middleware\RedirectIfAuthenticated;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
        RedirectIfAuthenticated::redirectUsing(function () {
            $user = Auth::user();

            if ($user) {
                if ($user->role === 'admin') {
                    return route('admin.dashboard');
                } elseif ($user->role === 'user') {
                    return route('user.dashboard');
                } elseif ($user->role === 'seller') {
                    return route('seller.dashboard');
                }
            }

            return route('user.login');
        });

        Authenticate::redirectUsing(function () {
            Session::flash('error', 'You must be logged in to access. Please login to continue.');
            return route('user.login');
        });
    }

}
