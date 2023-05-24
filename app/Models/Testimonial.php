<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;
    protected $fillable = [
        'author',
        'content',
        'image',
        'addedBy',
    ];
    function admin()
    {
        return $this->belongsTo(User::class, 'addedBy', 'id');
    }
}
