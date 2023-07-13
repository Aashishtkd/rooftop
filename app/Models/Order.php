<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderItem;

class Order extends Model
{
    use HasFactory;
    protected $table = "orders";
    protected $fillable = ["name", "phone", "location","status"];

    public function listitem(){
        return $this->hasMany(OrderItem::class, 'id', 'order_id');
    }
}
