<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'order_id'];

    /**
     * The orders that belong to the product.
     */
    public function order()
    {
        return $this->belongsToMany(Order::class);
    }
}
