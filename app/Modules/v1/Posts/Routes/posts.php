<?php

use App\Modules\v1\Posts\Controllers\PostsController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:api'])->apiResource('posts', PostsController::class);
