<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Contracts\Auth\Middleware\AuthenticatesRequests;

class Authenticate implements AuthenticatesRequests
{
	/**
	 * Create a new middleware instance.
	 *
	 * @param Auth $auth
	 * @return void
	 */
	public function __construct(protected Auth $auth)
	{
	}

	/**
	 * @throws AuthenticationException
	 */
	public function handle($request, Closure $next, $guard = NULL)
	{
		if ($this->auth->guard($guard)->guest()) {
			throw new AuthenticationException('Unauthorized.');
		}

		return $next($request);
	}
}
