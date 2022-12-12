<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShortVideo extends Model
{
    use HasFactory;

    protected $fillable = [
        "link",
        "cate_id",
    ];

    protected $casts = [
        'like_id' => 'array'
    ];
}
