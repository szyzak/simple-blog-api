<?php

namespace App\Modules\v1\Posts\Repositories;

use App\Modules\v1\Posts\Contracts\PostRepositoryInterface;
use App\Modules\v1\Posts\Models\Post;
use Illuminate\Pagination\LengthAwarePaginator;

class EloquentPostRepository implements PostRepositoryInterface
{
	public function insert(array $attributes): Post
	{
		/** @var Post $post */
		$post = Post::query()->create($attributes);

		return $post;
	}

	public function getAllWithPagination(int $perPage, int $page): LengthAwarePaginator
	{
		return Post::query()->paginate($perPage, ['*'], 'page', $page);
	}

	public function getById(int $postId): ?Post
	{
		/** @var Post $post */
		$post = Post::query()->find($postId);

		return $post;
	}

	public function update(int $postId, array $attributes): Post
	{
		Post::query()->whereKey($postId)->update($attributes);

		return $this->getById($postId);
	}

	public function delete(int $postId): void
	{
		Post::query()->whereKey($postId)->delete();
	}
}
