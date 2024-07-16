<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
	protected $table = 'addresses';

	protected $fillable = [
		'address',
		'user_id',
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
