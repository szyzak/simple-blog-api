<?php

namespace App\Modules\v1\Auth\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\v1\Auth\Requests\ForgotPasswordRequest;
use App\Modules\v1\Auth\Requests\PasswordResetRequest;
use App\Modules\v1\Users\Contracts\UserRepositoryInterface;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Password;
use Symfony\Component\HttpFoundation\Response;

class ResetPasswordController extends Controller
{
	public function forgotPassword(ForgotPasswordRequest $request): JsonResponse
	{
		$status = Password::sendResetLink($request->only('email'));

		return $status === Password::RESET_LINK_SENT
			? response()->json(['message' => 'Success'])
			: response()->json(['message' => 'Error'], Response::HTTP_BAD_REQUEST);
	}

	public function postReset(PasswordResetRequest $request, UserRepositoryInterface $repository)
	{
		$status = Password::reset(
			$request->only('email', 'password', 'password_confirmation', 'token'),
			function ($user, $password) use ($repository) {
				$repository->update($user->id, ['password' => $password]);

				event(new PasswordReset($user));
			}
		);

		return $status === Password::PASSWORD_RESET
			? response()->json(['message' => 'Success'])
			: response()->json(['message' => 'Error'], Response::HTTP_BAD_REQUEST);
	}

}
