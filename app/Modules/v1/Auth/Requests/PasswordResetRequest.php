<?php

namespace App\Modules\v1\Auth\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordResetRequest extends FormRequest
{
	public function authorize(): bool
	{
		return TRUE;
	}

	public function rules(): array
	{
		return [
			'token' => 'required',
			'email' => 'required|email',
			'password' => 'required|min:8|confirmed',
		];
	}
}
