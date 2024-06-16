<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    
    public $guarded = [];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'orders_products');
    }

    public function orders_products()
    {
        return $this->hasMany(OrderProduct::class);
    }
    
    public function price()
    {
        return $this->products()->sum('price');
    }
}
