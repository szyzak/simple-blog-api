<?php

namespace App\Modules\v1\Posts\Providers;

use App\Modules\v1\Posts\Contracts\PostRepositoryInterface;
use App\Modules\v1\Posts\Repositories\EloquentPostRepository;
use Illuminate\Support\ServiceProvider;

class PostsRepositoryServiceProvider extends ServiceProvider
{
	public function register()
	{
		$this->app->bind(
			PostRepositoryInterface::class,
			EloquentPostRepository::class
		);
	}
}
