<?php

namespace App\Modules\v1\Users\Contracts;

use App\Modules\v1\Users\Models\User;

interface UserRepositoryInterface
{
	public function insert(array $attributes): User;
	public function getById(int $userId): ?User;
	public function update(int $userId, array $attributes): User;
}
