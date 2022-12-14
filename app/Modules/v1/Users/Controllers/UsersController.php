<?php

namespace App\Modules\v1\Users\Controllers;

use App\Contracts\PaginationServiceInterface;
use App\Http\Controllers\Controller;
use App\Modules\v1\Users\Contracts\UserRepositoryInterface;
use App\Modules\v1\Users\Requests\UserRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UsersController extends Controller
{
	public function index(
		UserRepositoryInterface $repository, PaginationServiceInterface $paginationService
	): JsonResponse
	{
		$users = $repository->getAllWithPagination($paginationService->getLimit(), $paginationService->getCurrentPage());
		return response()->json($users);
	}

	public function show(int $userId, UserRepositoryInterface $repository): JsonResponse
	{
		$user = $repository->getById($userId);

		if (!$user) {
			throw new ModelNotFoundException();
		}

		return response()->json($user);
	}

	public function store(UserRequest $request, UserRepositoryInterface $repository): JsonResponse
	{
		$user = $repository->insert($request->validated());

		return response()->json($user);
	}

	public function update(int $userId, UserRequest $request, UserRepositoryInterface $repository): JsonResponse
	{
		$user = $repository->getById($userId);

		if (!$user) {
			throw new ModelNotFoundException();
		}

		$updatedUser = $repository->update($user->id, $request->validated());

		return response()->json($updatedUser);
	}

	public function destroy(int $userId, UserRepositoryInterface $repository): JsonResponse
	{
		$user = $repository->getById($userId);

		if (!$user) {
			throw new ModelNotFoundException();
		}

		$repository->delete($user->id);

		return response()->json([], Response::HTTP_NO_CONTENT);
	}
}
