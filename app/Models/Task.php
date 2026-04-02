<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UsesUuid;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Task extends Model implements HasMedia
{
    use HasFactory, UsesUuid, InteractsWithMedia;

    protected $fillable = [
        'project_id',
        'assigned_to_id',
        'status_id',
        'title',
        'description',
        'due_date',
        'is_billable',
    ];

    protected $casts = [
        'due_date' => 'date',
        'is_billable' => 'boolean',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to_id');
    }

    public function status()
    {
        return $this->belongsTo(TaskStatus::class, 'status_id');
    }

    public function timeLogs()
    {
        return $this->hasMany(TimeLog::class);
    }
}
