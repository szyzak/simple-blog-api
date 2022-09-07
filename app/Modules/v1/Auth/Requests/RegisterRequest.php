<?php

namespace App\Modules\v1\Auth\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
	public function authorized(): bool
	{
		return TRUE;
	}

	public function rules(): array
	{
		return [
			'name' => ['required', 'between:3,15'],
			'email' => ['required', 'email', 'unique:users'],
			//todo: stronger password policy?
			'password' => ['required', 'min:8'],
		];
	}
}
