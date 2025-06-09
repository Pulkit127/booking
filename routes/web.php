<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\Admin\VideoController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\PageController;
use App\Models\Page;

Route::prefix('admin')->group(function () {

    Route::middleware(['guest.admin'])->group(function () {
        Route::get('/login', [AuthController::class, 'loginPage'])->name('login-view-page');
        Route::get('/register', [AuthController::class, 'registerPage'])->name('register-view-page');
        Route::get('/forgot-password', [AuthController::class, 'forgotPassword'])->name('forgot-password');
        Route::get('/reset-password/{resetlink?}', [AuthController::class, 'resetPassword'])->name('reset-password');
        Route::post('/login', [AuthController::class, 'login'])->name('login');
        Route::post('/register', [AuthController::class, 'register'])->name('register');
        Route::post('/forgot-password', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
        Route::post('/reset-password', [AuthController::class, 'changePassword'])->name('change-password');
    });

    // Protected Routes (Only for Authenticated Admins)
    Route::middleware(['auth.admin'])->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/users/list', [UserController::class, 'index'])->name('user.index');
        Route::get('/users/delete', [UserController::class, 'delete'])->name('user.delete');
        Route::get('/users/show', [UserController::class, 'show'])->name('user.show');
        Route::get('/users/create', [UserController::class, 'create'])->name('user.create');
        Route::post('/users/store', [UserController::class, 'store'])->name('user.store');
        Route::get('/users/edit', [UserController::class, 'edit'])->name('user.edit');
        Route::put('/users/update/{user_id}', [UserController::class, 'update'])->name('user.update');
        Route::get('/users/status/{id}/{status}', [UserController::class, 'updateStatus'])->name('user.status');


        Route::get('/category/list', [CategoryController::class, 'index'])->name('category.index');
        Route::get('/category/delete', [CategoryController::class, 'delete'])->name('category.delete');
        Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
        Route::post('/category/create', [CategoryController::class, 'store'])->name('category.store');

        Route::get('/booking/list', [BookingController::class, 'index'])->name('booking.index');
        Route::get('/booking/create', [BookingController::class, 'create'])->name('booking.create');
        Route::post('/booking/create', [BookingController::class, 'store'])->name('booking.store');
        Route::get('/booking/show', [BookingController::class, 'show'])->name('booking.show');

        Route::get('/image/list', [ImageController::class, 'index'])->name('image.index');
        Route::get('/image/delete', [ImageController::class, 'delete'])->name('image.delete');
        Route::get('/image/create', [ImageController::class, 'create'])->name('image.create');
        Route::post('/image/create', [ImageController::class, 'store'])->name('image.store');

        Route::get('/video/list', [VideoController::class, 'index'])->name('video.index');
        Route::get('/video/delete', [VideoController::class, 'delete'])->name('video.delete');
        Route::get('/video/create', [VideoController::class, 'create'])->name('video.create');
        Route::post('/video/create', [VideoController::class, 'store'])->name('video.store');

        Route::get('/room/list', [RoomController::class, 'index'])->name('room.index');
        Route::get('/room/destroy', [RoomController::class, 'destroy'])->name('room.destroy');
        Route::get('/room/create', [RoomController::class, 'create'])->name('room.create');
        Route::post('/room/create', [RoomController::class, 'store'])->name('room.store');
        Route::get('/room/show', [RoomController::class, 'show'])->name('room.show');
        Route::get('/room/edit', [RoomController::class, 'edit'])->name('room.edit');
        Route::put('/room/update/{room_id}', [RoomController::class, 'update'])->name('room.update');
        Route::post('/room/delete-image', [RoomController::class, 'deleteImage'])->name('room.deleteImage');

        Route::get('/page/list', [PageController::class, 'index'])->name('pages.index');
        Route::get('/page/create', [PageController::class, 'create'])->name('pages.create');
        Route::post('/page/create', [PageController::class, 'store'])->name('pages.store');
        Route::get('/page/edit', [PageController::class, 'edit'])->name('pages.edit');
        Route::put('/page/update/{id}', [PageController::class, 'update'])->name('pages.update');
        Route::get('/page/delete', [PageController::class, 'delete'])->name('pages.delete');

        Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    });
});
