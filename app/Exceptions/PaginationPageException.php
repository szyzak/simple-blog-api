<?php

namespace App\Exceptions;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class PaginationPageException extends PaginationException
{
	public function render(): JsonResponse
	{
		return response()->json(
			['message' => 'Page must be greater than 0.'],
			Response::HTTP_BAD_REQUEST
		);
	}
}
