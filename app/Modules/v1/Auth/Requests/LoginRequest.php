<?php

namespace App\Modules\v1\Auth\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
	public function rules(): array
	{
		return [
			'email' => 'required',
			'password' => 'required',
		];
	}

	public function authorize(): bool
	{
		// User is not accessible yet to check for role.
		return TRUE;
	}
}
