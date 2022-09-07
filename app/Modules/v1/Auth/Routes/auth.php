<?php

use App\Modules\v1\Auth\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
	Route::post('login', [AuthController::class, 'login']);
});


Route::get('me', [AuthController::class, 'me']);
