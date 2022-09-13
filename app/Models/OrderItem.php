<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = ["order_id", "dish_id"];

    public function dish(){
        return $this->belongsTo(Dish::class);
    }
}
