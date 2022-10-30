<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderItem;
use App\Models\Table;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $guarded = [];

    public function orderItems(){
        return $this->hasMany(OrderItem::class);
    }

    public function table(){
        return $this->belongsTo(Table::class, 'table_id', 'id');
    }
}
