<?php

namespace App\Modules\v1\Users\Models;

use App\Enums\Role;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

/**
 * @property string $role
 */
class User extends Authenticatable implements JWTSubject
{
	use HasFactory, Notifiable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $fillable = [
		'name',
		'email',
		'password',
	];

	/**
	 * The attributes that should be hidden for serialization.
	 *
	 * @var array<int, string>
	 */
	protected $hidden = [
		'password',
	];

	#region JWT

	public function getJWTIdentifier()
	{
		return $this->getKey();
	}

	public function getJWTCustomClaims(): array
	{
		return [];
	}

	#endregion JWT

	#region Mutators

	public function setPasswordAttribute(string $password): void
	{
		$this->attributes['password'] = Hash::make($password);
	}

	#endregion Mutators

	public function isEditor(): bool
	{
		return $this->role === Role::Editor->value;
	}

	public function isAdmin(): bool
	{
		return $this->role === Role::Admin->value;
	}

	public function isRegularUser(): bool
	{
		return $this->role === Role::User->value;
	}

	protected static function newFactory(): UserFactory
	{
		return UserFactory::new();
	}
}
