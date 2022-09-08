<?php

namespace App\Modules\v1\Users\Repositories;

use App\Modules\v1\Users\Contracts\UserRepositoryInterface;
use App\Modules\v1\Users\Models\User;

class EloquentUserRepository implements UserRepositoryInterface
{
	public function insert(array $attributes): User
	{
		/** @var User $user */
		$user = User::query()->create($attributes);

		return $user;
	}
}
