<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = [
        'dish',
        'quantity',
        'device_id',
    ];
    public function dishes(){
        return $this->belongsTo(Dish::class, "dish");
    }
}
