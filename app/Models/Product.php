<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 * 
 * @property int $id
 * @property string $product_name
 * @property float $price
 * @property string|null $description
 * @property int $stock
 * @property string|null $photo
 * @property string $owner_name
 * @property int $category_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Category $category
 *
 * @package App\Models
 */
class Product extends Model
{
	protected $table = 'products';

	protected $casts = [
		'price' => 'float',
		'stock' => 'int',
		'category_id' => 'int'
	];

	protected $fillable = [
		'product_name',
		'price',
		'description',
		'stock',
		'photo',
		'owner_name',
		'category_id'
	];

	public function category()
	{
		return $this->belongsTo(Category::class);
	}

	public function orderItems()
	{
		return $this->hasMany(OrderItem::class);
	}
}
