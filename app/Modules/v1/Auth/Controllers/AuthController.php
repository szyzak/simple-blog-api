<?php

namespace App\Modules\v1\Auth\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\v1\Auth\Requests\LoginRequest;
use App\Modules\v1\Auth\Requests\RegisterRequest;
use App\Modules\v1\Users\Contracts\UserRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\UnauthorizedException;

class AuthController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth:api', ['except' => ['login', 'register']]);
	}

	public function login(LoginRequest $request): JsonResponse
	{
		$credentials = $request->only(['email', 'password']);

		if (!$token = auth()->attempt($credentials)) {
			throw new UnauthorizedException();
		}

		return $this->respondWithToken($token);
	}

	public function register(RegisterRequest $request, UserRepositoryInterface $repository): JsonResponse
	{
		$user = $repository->insert($request->validated());
		return response()->json($user->toArray());
	}

	public function me(): JsonResponse
	{
		return response()->json(auth()->user());
	}

	public function logout(): JsonResponse
	{
		auth()->logout();

		return response()->json(['message' => 'Successfully logged out']);
	}

	public function refresh(): JsonResponse
	{
		return $this->respondWithToken(auth()->refresh());
	}

	protected function respondWithToken($token): JsonResponse
	{
		return response()->json([
			'access_token' => $token,
			'token_type' => 'bearer',
			'expires_in' => auth()->factory()->getTTL() * 60,
		]);
	}
}
