<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UsesUuid;

class TimeLog extends Model
{
    use HasFactory, UsesUuid;

    protected $fillable = ['task_id', 'start_time', 'end_time', 'duration'];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
