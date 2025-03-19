<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\Admin\VideoController;

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

        Route::get('/category/list', [CategoryController::class, 'index'])->name('category.index');
        Route::get('/category/delete', [CategoryController::class, 'delete'])->name('category.delete');
        Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
        Route::post('/category/create', [CategoryController::class, 'store'])->name('category.store');

        Route::get('/image/list', [ImageController::class, 'index'])->name('image.index');
        Route::get('/image/delete', [ImageController::class, 'delete'])->name('image.delete');
        Route::get('/image/create', [ImageController::class, 'create'])->name('image.create');
        Route::post('/image/create', [ImageController::class, 'store'])->name('image.store');

        Route::get('/video/list', [VideoController::class, 'index'])->name('video.index');
        Route::get('/video/delete', [VideoController::class, 'delete'])->name('video.delete');
        Route::get('/video/create', [VideoController::class, 'create'])->name('video.create');
        Route::post('/video/create', [VideoController::class, 'store'])->name('video.store');


        Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    });
});
