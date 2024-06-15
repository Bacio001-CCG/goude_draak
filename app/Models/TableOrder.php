<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TableOrder extends Model
{
    use HasFactory;
    
    public $guarded = [];

    public function customers()
    {
        return $this->hasMany(Customer::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    
    public function round()
    {
        $maxRound = $this->order->orders_products->max('round');

        return $maxRound ?? 0;
    }
    
    public function table()
    {
        return $this->belongsTo(Table::class);
    }
}
