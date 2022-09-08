<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class ImagesService
{
	public function storeImage(UploadedFile $uploadedImage, string $destination): string
	{
		$imageName = Str::uuid() . '.' . $uploadedImage->extension();
		$uploadedImage->move($destination . '/', $imageName);

		return $imageName;
	}
}
