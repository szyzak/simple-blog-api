<?php

namespace App\Modules\v1\Posts\Models;

use Database\Factories\PostFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

/**
 * @property int $id
 * @property string $label
 * @property string $image_name
 * @property string $image_url
 */
class Post extends Model
{
	use HasFactory;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $fillable = [
		'title',
		'content',
		'image_name',
	];

	protected $appends = ['image_url'];

	/** @noinspection PhpUnused */
	public function getImageUrlAttribute(): string
	{
		return Storage::disk('images')->url("posts/{$this->id}/{$this->image_name}");
	}

	public function getImageDirectory(): string
	{
		return public_path("images/posts/{$this->id}");
	}

	protected static function newFactory(): PostFactory
	{
		return PostFactory::new();
	}
}
