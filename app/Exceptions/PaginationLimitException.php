<?php

namespace App\Exceptions;

use App\Contracts\PaginationServiceInterface;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class PaginationLimitException extends PaginationException
{
	public function render(): JsonResponse
	{
		/** @var PaginationServiceInterface $paginationService */
		$paginationService = app(PaginationServiceInterface::class);
		$maxLimit = $paginationService->getMaxLimit();

		return response()->json(
			['message' => "Limit must be greater than 0 and smaller than {$maxLimit}."],
			Response::HTTP_BAD_REQUEST
		);
	}
}
