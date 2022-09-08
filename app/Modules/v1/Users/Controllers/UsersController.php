<?php

namespace App\Modules\v1\Users\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\v1\Users\Contracts\UserRepositoryInterface;
use App\Modules\v1\Users\Requests\UpdateUserRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;

class UsersController extends Controller
{
	public function update(int $userId, UpdateUserRequest $request, UserRepositoryInterface $repository): JsonResponse
	{
		$user = $repository->getById($userId);

		if (!$user) {
			throw new ModelNotFoundException();
		}
		$updatedUser = $repository->update($user->id, $request->validated());

		return response()->json($updatedUser->toArray());
	}
}
