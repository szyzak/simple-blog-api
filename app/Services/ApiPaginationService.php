<?php

namespace App\Services;

use App\Contracts\PaginationServiceInterface;
use App\Exceptions\PaginationException;
use App\Exceptions\PaginationLimitException;
use App\Exceptions\PaginationPageException;
use Illuminate\Support\Facades\Request;

class ApiPaginationService implements PaginationServiceInterface
{
	protected int $defaultLimit;
	protected int $maxLimit;

	public function __construct()
	{
		$this->defaultLimit = config('pagination.default_limit');
		$this->maxLimit = config('pagination.max_limit');
	}

	/**
	 * @throws PaginationException
	 */
	public function getLimit(): int
	{
		$limit = filter_var(Request::input('limit', $this->defaultLimit));

		if ($limit > 0 && $limit <= $this->maxLimit) {
			return $limit;
		}

		throw new PaginationLimitException();
	}

	/**
	 * @throws PaginationException
	 */
	public function getCurrentPage(): int
	{
		$page = filter_var(Request::input('page', 1));

		if ($page > 0) {
			return $page;
		}

		throw new PaginationPageException();
	}

	public function getMaxLimit(): int
	{
		return $this->maxLimit;
	}
}
