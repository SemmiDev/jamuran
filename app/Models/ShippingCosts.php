<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingCosts extends Model
{
    use HasFactory;

    protected $table = 'shipping_costs';

    protected $fillable = [
        'kota',
        'shipping_cost'
    ];
}
