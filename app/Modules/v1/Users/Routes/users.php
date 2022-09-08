<?php

use App\Modules\v1\Users\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->apiResource('users', UsersController::class);
