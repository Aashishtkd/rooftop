<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $fillable = [
        'email',
        'phone',
        'mobile',
        'map',
        'facebook',
        'insta',
        'youtube',
        'tiktok',
        'twitter',
        'address',
        'copyright',
        'aboutus',
        'defoultPass',
        'updatedBy',
    ];
    function admin()
    {
        return $this->belongsTo(User::class, 'updatedBy', 'id');
    }
}
