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
    
    public function table()
    {
        return $this->belongsTo(Table::class);
    }
}
