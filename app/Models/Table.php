<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;

    public $guarded = [];

    public $table = 'tables';
    
    public function tableOrder()
    {
        return $this->belongsTo(TableOrder::class, 'active_table_order_id');
    }
}
