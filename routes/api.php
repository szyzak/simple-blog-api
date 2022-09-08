<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



//todo: automatic discovery?
Route::prefix('v1')->group(base_path('app/Modules/v1/Auth/Routes/auth.php'));
Route::prefix('v1')->group(base_path('app/Modules/v1/Users/Routes/users.php'));

