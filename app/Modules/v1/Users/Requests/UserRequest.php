<?php

namespace App\Modules\v1\Users\Requests;

use App\Enums\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
	public function rules(): array
	{
		return [
			//todo: some more strict rules? or admin should do anything?
			//fixme: reuse rules from registration?
			'name' => ['required'],
			'email' => ['required', 'email'],
			'role' => ['required', Rule::in(array_column(Role::cases(), 'value'))],
			'password' => ['required'],
		];
	}
}
