<?php

use App\Modules\v1\Users\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:api', 'can:manage-users'])->apiResource('users', UsersController::class);
