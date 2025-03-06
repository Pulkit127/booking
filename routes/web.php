<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;  

Route::prefix('admin')->group(function () {

    // Authentication Routes
    Route::get('/login', [AuthController::class, 'loginPage'])->name('login-view-page');
    Route::get('/register', [AuthController::class, 'registerPage'])->name('register-view-page');
    Route::get('/forgot-password', [AuthController::class, 'forgotPassword'])->name('forgot-password');
    Route::get('/reset-password/{resetlink?}', [AuthController::class, 'resetPassword'])->name('reset-password');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/register', [AuthController::class, 'register'])->name('register');

    // Password Reset Routes
    Route::post('/forgot-password', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::post('/reset-password', [AuthController::class, 'changePassword'])->name('change-password');

    // Protected Routes (Only for Authenticated Admins)
    Route::middleware(['auth.admin'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/users/list', [UserController::class, 'index'])->name('user.index');
        Route::get('/users/delete', [UserController::class, 'delete'])->name('user.delete');
        Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    });
});
