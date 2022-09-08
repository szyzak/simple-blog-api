<?php

namespace App\Modules\v1\Users\Providers;

use App\Modules\v1\Users\Contracts\UserRepositoryInterface;
use App\Modules\v1\Users\Repositories\EloquentUserRepository;
use Illuminate\Support\ServiceProvider;

class UsersRepositoryServiceProvider extends ServiceProvider
{
	public function register()
	{
		$this->app->bind(
			UserRepositoryInterface::class,
			EloquentUserRepository::class
		);
	}
}
