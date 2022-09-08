<?php

namespace Database\Seeders;

use App\Enums\Role;
use App\Modules\v1\Users\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 *
	 * @return void
	 */
	public function run()
	{
		 User::factory()->create([
		     'name' => 'Test User',
		     'email' => 'test@example.com',
			 'role' => Role::User->value,
		 ]);

		User::factory()->create([
			'name' => 'Editor User',
			'email' => 'editor@example.com',
			'role' => Role::Editor->value,
		]);

		User::factory()->create([
			'name' => 'Admin User',
			'email' => 'admin@example.com',
			'role' => Role::Admin->value,
		]);
	}
}
