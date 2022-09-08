<?php

namespace Database\Factories;

use App\Modules\v1\Posts\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class PostFactory extends Factory
{
	protected $model = Post::class;

	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition()
	{
		return [
			'title' => fake()->title(),
			'content' => fake()->paragraph(),
		];
	}
}
