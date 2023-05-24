<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    use HasFactory;

    protected $fillable = ["name", "price", "image", "dish_category_id","feature"];

    public function category(){
        return $this->belongsTo(DishCategory::class, "dish_category_id");
    }
}
