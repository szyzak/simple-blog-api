<?php

namespace App\Modules\v1\Posts\Contracts;

use App\Modules\v1\Posts\Models\Post;
use Illuminate\Pagination\LengthAwarePaginator;

interface PostRepositoryInterface
{
	public function insert(array $attributes): Post;
	public function getAllWithPagination(int $perPage, int $page): LengthAwarePaginator;
	public function getById(int $userId): ?Post;
	public function update(int $userId, array $attributes): Post;
	public function delete(int $userId): void;
}
