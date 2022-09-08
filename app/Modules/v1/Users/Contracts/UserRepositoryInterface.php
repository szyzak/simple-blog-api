<?php

namespace App\Modules\v1\Users\Contracts;

use App\Modules\v1\Users\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

interface UserRepositoryInterface
{
	public function insert(array $attributes): User;
	public function getAllWithPagination(int $perPage, int $page): LengthAwarePaginator;
	public function getById(int $userId): ?User;
	public function update(int $userId, array $attributes): User;
	public function delete(int $userId): void;
}
