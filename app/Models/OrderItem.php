<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = ["dish", "quantity","user_id","amt","order_id"];

    public function dish(){
        return $this->belongsTo(Dish::class);
    }
}
