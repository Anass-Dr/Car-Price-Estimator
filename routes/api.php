<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


# - Authentication :
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('jwt.auth')->group(function () {
    Route::middleware('auth')->group(function () {
        # - Manage User :
        Route::get('/users', [UserController::class, 'index']);
        Route::post('/users', [UserController::class, 'store']);
        Route::put('/users/{id}', [UserController::class, 'update']);
        Route::delete('/users/{id}', [UserController::class, 'destroy']);
    });

    # - Manage Car :
    Route::get('/cars/search', [CarController::class, 'search']);
    Route::get('/cars/estimate', [CarController::class, 'estimatePrice']);
});
