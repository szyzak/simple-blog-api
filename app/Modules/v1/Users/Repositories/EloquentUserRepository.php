<?php

namespace App\Modules\v1\Users\Repositories;

use App\Modules\v1\Users\Contracts\UserRepositoryInterface;
use App\Modules\v1\Users\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class EloquentUserRepository implements UserRepositoryInterface
{
	public function insert(array $attributes): User
	{
		/** @var User $user */
		$user = User::query()->create($attributes);

		return $user;
	}

	public function getAllWithPagination(int $perPage, int $page): LengthAwarePaginator
	{
		return User::query()->paginate($perPage, ['*'], 'page', $page);
	}

	public function getById(int $userId): ?User
	{
		/** @var User $user */
		$user = User::query()->find($userId);

		return $user;
	}

	public function update(int $userId, array $attributes): User
	{
		User::query()->whereKey($userId)->update($attributes);

		return $this->getById($userId);
	}

	public function delete(int $userId): void
	{
		User::query()->whereKey($userId)->delete();
	}
}
