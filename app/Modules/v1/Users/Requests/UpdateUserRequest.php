<?php

namespace App\Modules\v1\Users\Requests;

use App\Enums\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
	public function authorize(): bool
	{
		return Gate::allows('users_update');
	}

	public function rules(): array
	{
		return [
			//todo: some more strict rules? or admin should do anything?
			'name' => ['sometimes'],
			'role' => ['sometimes', Rule::in(array_column(Role::cases(), 'value'))]
		];
	}
}
