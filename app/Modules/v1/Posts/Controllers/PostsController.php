<?php

namespace App\Modules\v1\Posts\Controllers;

use App\Contracts\PaginationServiceInterface;
use App\Http\Controllers\Controller;
use App\Modules\v1\Posts\Contracts\PostRepositoryInterface;
use App\Modules\v1\Posts\Requests\StorePostRequest;
use App\Modules\v1\Posts\Requests\UpdatePostRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class PostsController extends Controller
{
	public function __construct()
	{
		$this->middleware('can:manage-posts', ['except' => 'index']);
	}

	public function index(
		PostRepositoryInterface $repository, PaginationServiceInterface $paginationService
	): JsonResponse
	{
		$posts = $repository->getAllWithPagination($paginationService->getLimit(), $paginationService->getCurrentPage());
		return response()->json($posts);
	}

	public function show(int $postId, PostRepositoryInterface $repository): JsonResponse
	{
		$post = $repository->getById($postId);

		if (!$post) {
			throw new ModelNotFoundException();
		}

		return response()->json($post);
	}

	public function store(StorePostRequest $request, PostRepositoryInterface $repository): JsonResponse
	{
		$post = $repository->insert($request->validated() + ['thumbnail_id' => 1]);

		//todo: handle image upload

		return response()->json($post);
	}

	public function update(int $postId, UpdatePostRequest $request, PostRepositoryInterface $repository): JsonResponse
	{
		$post = $repository->getById($postId);

		if (!$post) {
			throw new ModelNotFoundException();
		}

		$updatedPost = $repository->update($post->id, $request->validated());

		return response()->json($updatedPost);
	}

	public function destroy(int $postId, PostRepositoryInterface $repository): JsonResponse
	{
		$post = $repository->getById($postId);

		if (!$post) {
			throw new ModelNotFoundException();
		}

		$repository->delete($post->id);

		return response()->json([], Response::HTTP_NO_CONTENT);
	}
}
