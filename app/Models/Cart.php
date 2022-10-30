<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Menu;

class Cart extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function menus(){
        return $this->belongsTo(Menu::class,'prod_id','id');
    }
}
