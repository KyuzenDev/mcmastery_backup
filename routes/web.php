<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\UserController;

// ADMIN ROUTES

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware(['guest'])->group(function () {
        Route::controller(AuthController::class)->group(function () {
            Route::get('/login', 'loginForm')->name('login');
            Route::post('/login', 'loginHandler')->name('login_handler');
            Route::get('/forgot-password', 'forgotForm')->name('forgot');
            Route::post('/send-password-reset-link', 'sendPasswordResetLink')->name('send_password_reset_link');
            Route::get('/password/reset/{token}', 'resetForm')->name('reset_password_form');
            Route::post('/reset-password-handler', 'resetPasswordHandler')->name('reset_password_handler');
        });
    });

    Route::middleware(['auth'])->group(function () {
        Route::controller(AdminController::class)->group(function () {
            Route::get('/dashboard', 'adminDashboard')->name('dashboard');
            Route::get('/logout', 'AdminLogout')->name('logout');
            Route::get('/profile', 'AdminProfile')->name('profile');
            Route::get('/users', 'AdminUsers');
            Route::post('/profile/update', 'AdminProfileUpdate')->name('update');
            Route::delete('/delete/{id}', 'deleteUser')->name('delete');
        });
    });
});

Route::prefix('user')->name('user.')->group(function () {
    Route::middleware(['guest'])->group(function () {
        Route::controller(AuthController::class)->group(function () {
            Route::get('/login', 'loginForm')->name('login');
            Route::post('/login', 'loginHandler')->name('login_handler');
            Route::get('/register', 'regisForm')->name('register');
            Route::post('/register', 'regisHandlerUser')->name('register_handler'); // pastikan name ini sesuai
            Route::get('/forgot-password', 'forgotForm')->name('forgot');
            Route::post('/send-password-reset-link', 'sendPasswordResetLink')->name('send_password_reset_link');
            Route::get('/password/reset/{token}', 'resetForm')->name('reset_password_form');
            Route::post('/reset-password-handler', 'resetPasswordHandler')->name('reset_password_handler');
        });
    });

    Route::middleware(['auth'])->group(function () {
        Route::controller(UserController::class)->group(function () {
            Route::get('/dashboard', 'userDashboard')->name('dashboard');
            Route::get('/logout', 'logoutHandler')->name('logout');
            Route::get('/profile',  'UserProfile')->name('profile');
            Route::post('/profile/update','UserProfileUpdate')->name('update');

        });
    });
});

Route::prefix('seller')->name('seller.')->group(function () {
    Route::middleware(['guest'])->group(function () {
        Route::controller(AuthController::class)->group(function () {
            Route::get('/login', 'loginForm')->name('login');
            Route::post('/login', 'loginHandler')->name('login_handler');
            Route::get('/register', 'regisForm')->name('register');
            Route::post('/register', 'regisHandlerUser')->name('register_handler'); // pastikan name ini sesuai
            Route::get('/forgot-password', 'forgotForm')->name('forgot');
            Route::post('/send-password-reset-link', 'sendPasswordResetLink')->name('send_password_reset_link');
            Route::get('/password/reset/{token}', 'resetForm')->name('reset_password_form');
            Route::post('/reset-password-handler', 'resetPasswordHandler')->name('reset_password_handler');
        });
    });

    Route::middleware(['auth'])->group(function () {
        Route::controller(SellerController::class)->group(function () {
            Route::get('/dashboard', 'SellerDashboard')->name('dashboard');
            Route::get('/logout', 'logoutHandler')->name('logout');
            Route::get('/profile',  'SellerProfile')->name('profile');
            Route::post('/profile/update','SellerProfileUpdate')->name('update');

        });
    });
});

Route::get('/', function () {
    return redirect()->route('user.login');
});
