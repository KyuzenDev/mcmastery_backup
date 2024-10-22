<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\Seller\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SellerReportController;
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

    Route::middleware(['auth', 'role:admin'])->group(function () {
        Route::controller(AdminController::class)->group(function () {
            Route::get('/dashboard', 'adminDashboard')->name('dashboard');
            Route::get('/logout', 'AdminLogout')->name('logout');
            Route::get('/profile', 'AdminProfile')->name('profile');
            Route::get('/users', 'AdminUsers');
            Route::post('/profile/update', 'AdminProfileUpdate')->name('update');
            Route::delete('/delete/{id}', 'deleteUser')->name('delete');
            Route::get('/seller-reports', [AdminController::class, 'sellerReports'])->name('sellerReports');
            Route::get('/seller-details/{id}', [AdminController::class, 'sellerDetails'])->name('sellerDetails');
            Route::patch('/users/{id}/role', [AdminController::class, 'updateRole'])->name('updateRole');
            Route::patch('/users/{id}/status', [AdminController::class, 'updateStatus'])->name('updateStatus');

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

    Route::middleware(['auth', 'role:user'])->group(function () {
        Route::controller(UserController::class)->group(function () {
            Route::get('/dashboard', 'userDashboard')->name('dashboard');
            Route::get('/products', [ProductController::class, 'indexs'])->name('products.index');
            Route::get('/logout', 'logoutHandler')->name('logout');
            Route::get('/profile', 'UserProfile')->name('profile');
            Route::post('/profile/update', 'UserProfileUpdate')->name('update');
            Route::get('/transactions', [ProductController::class, 'viewTransactions'])->name('transactions.index');
            Route::get('/products/checkout/{id}', [ProductController::class, 'checkout'])->name('products.checkout');
            Route::post('/products/purchase/{id}', [ProductController::class, 'purchase'])->name('products.purchase');
            Route::post('/reports', [SellerReportController::class, 'store'])->name('reports.store');


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

    Route::middleware(['auth', 'role:seller'])->group(function () {
        Route::controller(SellerController::class)->group(function () {
            Route::get('/dashboard', 'SellerDashboard')->name('dashboard');
            Route::get('/logout', 'logoutHandler')->name('logout');
            Route::get('/profile', 'SellerProfile')->name('profile');
            Route::post('/profile/update', 'SellerProfileUpdate')->name('update');
            Route::get('/products', [ProductController::class, 'index'])->name('products.manage');
            Route::get('/products', [ProductController::class, 'manageProducts'])->name('products.manage');
            Route::get('/products/add', [ProductController::class, 'create'])->name('products.create');
            Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
            Route::get('/products/edit/{id}', [ProductController::class, 'edit'])->name('products.edit');
            Route::post('/products/update/{id}', [ProductController::class, 'update'])->name('products.update');
            Route::delete('/products/delete/{id}', [ProductController::class, 'destroy'])->name('products.delete');
            Route::get('/commission', [ProductController::class, 'showSellerCommission'])->name('commission');
        });
    });
});

Route::get('/', function () {
    return redirect()->route('user.login');
});
