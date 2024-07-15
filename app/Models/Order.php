<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Order
 * 
 * @property int $id
 * @property string $address
 * @property int $buyer_id
 * @property int $total_qty
 * @property float $total_price
 * @property string $status
 * @property string|null $payment_proof
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property User $user
 *
 * @package App\Models
 */
class Order extends Model
{
	protected $table = 'orders';

	protected $casts = [
		'buyer_id' => 'int',
		'total_qty' => 'int',
		'total_price' => 'float'
	];

	protected $fillable = [
		'address',
		'buyer_id',
		'total_qty',
		'total_price',
		'status',
		'payment_proof'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'buyer_id');
	}
}
