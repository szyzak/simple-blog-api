<?php

namespace App\Providers;

use App\Contracts\PaginationServiceInterface;
use App\Services\ApiPaginationService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind(PaginationServiceInterface::class, ApiPaginationService::class);
	}

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		//
	}
}
