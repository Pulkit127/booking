<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Public Routes (Register & Login)
Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth.api')->controller(AuthController::class)->group(function () {
    Route::get('/getUser', 'getUser');
    Route::post('/addCategory', 'addCategory');
    Route::get('/getCategory', 'getCategory');
    Route::post('/deleteCategory', 'deleteCategory');
    Route::post('/addVideo', 'addVideo');
    Route::get('/getVideo', 'getVideo');
    Route::post('/deleteVideo', 'deleteVideo');
    Route::get('/logout', 'logout');
});
