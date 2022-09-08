<?php

namespace App\Modules\v1\Posts\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
	public function authorize(): bool
	{
		return TRUE;
	}

	public function rules(): array
	{
		return [
			'title' => ['required'],
			'content' => ['required'],
			'image' => ['sometimes', 'image', 'max:4096'],
		];
	}
}
