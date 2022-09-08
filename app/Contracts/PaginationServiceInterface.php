<?php

namespace App\Contracts;

interface PaginationServiceInterface
{
	public function getLimit(): int;
	public function getCurrentPage(): int;
	public function getMaxLimit(): int;
}
