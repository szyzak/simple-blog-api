<?php

namespace App\Modules\v1\Users\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class IndexUsersRequest extends FormRequest
{
	public function authorize(): bool
	{
		return Gate::allows('users_index');
	}

	public function rules(): array
	{
		return [];
	}
}
