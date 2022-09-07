<?php

namespace App\Modules\v1\Auth\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
	public function rules()
	{
		return [
			'email' => 'required',
			'password' => 'required',
		];
	}

	public function authorize()
	{
		return TRUE;
	}
}
