<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UsesUuid;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class PortfolioItem extends Model implements HasMedia
{
    use HasFactory, UsesUuid, InteractsWithMedia;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'live_url',
        'repo_url',
    ];
}
