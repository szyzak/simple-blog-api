<?php

namespace App\Modules\v1\Auth\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ForgotPasswordRequest extends FormRequest
{
	public function authorize(): bool
	{
		return TRUE;
	}

	public function rules(): array
	{
		return [
			'email' => 'required|email',
		];
	}
}
