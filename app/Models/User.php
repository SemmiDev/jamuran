<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
	use HasFactory, Notifiable;

	protected $table = 'users';

	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
		'name',
		'username',
		'role',
		'email',
		'password',
		'phone_number',
		'address',
		'photo',
		'remember_token'
	];

	public function orders()
	{
		return $this->hasMany(Order::class, 'buyer_id');
	}

	const ROLE_ADMIN = 'Admin';
	const ROLE_USER = 'User';

	public function addresses()
	{
		return $this->hasMany(Address::class);
	}
}
