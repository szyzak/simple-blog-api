<?php

namespace App\Modules\v1\Users\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\v1\Auth\Requests\LoginRequest;
use App\Modules\v1\Auth\Requests\RegisterRequest;
use App\Modules\v1\Users\Models\User;
use App\Modules\v1\Users\Requests\UpdateUserRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\UnauthorizedException;

class UsersController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth:api', ['except' => ['login', 'register']]);
	}

	public function update(UpdateUserRequest $request)
	{

	}
}
