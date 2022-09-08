<?php

namespace App\Modules\v1\Users\Contracts;

use App\Modules\v1\Users\Models\User;

interface UserRepositoryInterface
{
	public function insert(array $attributes): User;
}
