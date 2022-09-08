<?php

namespace App;

use App\Modules\v1\Users\Models\User;

class Policy
{
	public function before(User $user)
	{
		if ($user->isAdmin()) {
			return TRUE;
		}
	}
}
