<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UsesUuid;

class Post extends Model
{
    use HasFactory, UsesUuid;

    protected $fillable = ['title', 'body', 'published_at'];

    protected $casts = [
        'published_at' => 'datetime',
    ];
}
