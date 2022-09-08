<?php

namespace App\Modules\v1\Posts\Models;

use Database\Factories\PostFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $label
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
		'thumbnail_id',
	];

	protected static function newFactory(): PostFactory
	{
		return PostFactory::new();
	}
}
