<?php

namespace App\Modules\v1\Posts\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdatePostRequest extends FormRequest
{
	public function authorize(): bool
	{
		return Gate::allows('posts_update');
	}

	public function rules(): array
	{
		return [
			'title' => ['required'],
			'content' => ['required']
		];
	}
}
