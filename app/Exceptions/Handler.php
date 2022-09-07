<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Validation\UnauthorizedException;
use Illuminate\Validation\ValidationException;
use Psr\Log\LogLevel;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
	/**
	 * A list of exception types with their corresponding custom log levels.
	 *
	 * @var array<class-string<Throwable>, LogLevel::*>
	 */
	protected $levels = [
		//
	];

	/**
	 * A list of the exception types that are not reported.
	 *
	 * @var array<int, class-string<Throwable>>
	 */
	protected $dontReport = [
		//
	];

	/**
	 * A list of the inputs that are never flashed to the session on validation exceptions.
	 *
	 * @var array<int, string>
	 */
	protected $dontFlash = [
		'current_password',
		'password',
		'password_confirmation',
	];

	/**
	 * Register the exception handling callbacks for the application.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->renderable(function (MethodNotAllowedHttpException $e) {
			return response()->json(['message' => $e->getMessage()], Response::HTTP_METHOD_NOT_ALLOWED);
		});

		$this->renderable(function (UnauthorizedException $e) {
			return response()->json(['message' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
		});

		$this->renderable(function (ValidationException $e) {
			return response()->json(['message' => $e->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
		});

		$this->renderable(function (NotFoundHttpException $e) {
			return response()->json(['message' => 'Not found'], Response::HTTP_NOT_FOUND);
		});
	}

	/**
	 * Convert an authentication exception into a response.
	 *
	 * @param Request $request
	 * @param AuthenticationException|UnauthorizedException $exception
	 * @return Response
	 */
	protected function unauthenticated($request, AuthenticationException|UnauthorizedException $exception): Response
	{
		return response()->json(['message' => $exception->getMessage()], Response::HTTP_UNAUTHORIZED);
	}
}
