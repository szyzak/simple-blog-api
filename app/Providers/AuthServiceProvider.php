<?php

namespace App\Providers;

use App\Modules\v1\Users\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
	/**
	 * The model to policy mappings for the application.
	 *
	 * @var array<class-string, class-string>
	 */
	protected $policies = [
	];

	/**
	 * Register any authentication / authorization services.
	 *
	 * @return void
	 * @noinspection PhpInconsistentReturnPointsInspection
	 */
	public function boot()
	{
		$this->registerPolicies();

		Gate::before(function (User $user) {
			if($user->isAdmin()) {
				return TRUE;
			}
		});

		Gate::define('login', fn(User $user) => $user->isEditor());
		Gate::define('manage-posts', fn(User $user) => $user->isEditor());
	}
}
