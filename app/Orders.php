<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $fillable = [
        'product_name', 'quantity', 'price', 'total_value',
    ];
}
