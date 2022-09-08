<?php

namespace App\Modules\v1\Posts\Controllers;

use App\Contracts\PaginationServiceInterface;
use App\Http\Controllers\Controller;
use App\Modules\v1\Posts\Contracts\PostRepositoryInterface;
use App\Modules\v1\Posts\Requests\PostRequest;
use App\Services\ImagesService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\UploadedFile;
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

	public function store(PostRequest $request, PostRepositoryInterface $repository, ImagesService $imagesService): JsonResponse
	{
		$post = $repository->insert($request->validated());

		/** @var UploadedFile $uploadedImage */
		$uploadedImage = $request->image;

		$imageName = $imagesService->storeImage($uploadedImage, $post->getImageDirectory());
		$post = $repository->update($post->id, ['image_name' => $imageName]);

		return response()->json($post);
	}

	public function update(
		int $postId, PostRequest $request, PostRepositoryInterface $repository, ImagesService $imagesService
	): JsonResponse
	{
		$post = $repository->getById($postId);

		if (!$post) {
			throw new ModelNotFoundException();
		}

		/** @var UploadedFile $uploadedImage */
		$uploadedImage = $request->image;
		$request->offsetUnset('image');

		$imageName = $post->image_name;

		if ($uploadedImage) {
			$imageName = $imagesService->storeImage($uploadedImage, $post->getImageDirectory());
		}

		//fixme: get rid of uploadedFile in more elegant way
		$attributes = array_diff_key($request->validated(), ['image' => '']);
		$updatedPost = $repository->update($post->id, array_merge($attributes, ['image_name' => $imageName]));

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
