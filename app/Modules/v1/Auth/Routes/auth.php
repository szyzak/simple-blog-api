<?php

use App\Modules\v1\Auth\Controllers\AuthController;
use App\Modules\v1\Auth\Controllers\ResetPasswordController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
	Route::post('login', [AuthController::class, 'login']);
	Route::post('register', [AuthController::class, 'register']);
});

// Password reset routes...
Route::post('forgot-password', [ResetPasswordController::class, 'forgotPassword']);
Route::post('reset-password', [ResetPasswordController::class, 'postReset'])->name('password.reset');


Route::get('me', [AuthController::class, 'me']);
