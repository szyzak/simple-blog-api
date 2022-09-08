<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Modules\v1\Users\Models\User;
use App\Modules\v1\Users\Policies\UserPolicy;
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
		 User::class => UserPolicy::class,
	];

	/**
	 * Register any authentication / authorization services.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->registerPolicies();

		Gate::define('login', fn(User $user) => ($user->isEditor() || $user->isAdmin()));
	}
}
