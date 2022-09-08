<?php

namespace App\Modules\v1\Posts\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StorePostRequest extends FormRequest
{
	public function authorize(): bool
	{
		return TRUE;
	}

	public function rules(): array
	{
		return [
			'title' => ['required'],
			'content' => ['required']
		];
	}
}
