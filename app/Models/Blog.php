<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Blog extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'content',
        'image',
        'author',
        'addedBy',
    ];
    function admin()
    {
        return $this->belongsTo(User::class, 'addedBy', 'id');
    }
}
