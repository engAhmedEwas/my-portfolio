<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UsesUuid;

class SupportTicket extends Model
{
    use HasFactory, UsesUuid;

    protected $fillable = [
        'client_id',
        'project_id',
        'subject',
        'description',
        'priority',
        'status',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
