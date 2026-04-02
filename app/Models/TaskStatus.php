<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UsesUuid;

class TaskStatus extends Model
{
    use HasFactory, UsesUuid;

    protected $fillable = ['name', 'color_hex', 'is_final_status'];

    protected $casts = [
        'is_final_status' => 'boolean',
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class, 'status_id');
    }
}
