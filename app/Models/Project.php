<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UsesUuid;

class Project extends Model
{
    use HasFactory, UsesUuid;
    use \Laravel\Scout\Searchable;

    protected $fillable = [
        'client_id',
        'title',
        'description',
        'budget',
        'status',
        'cancelled_by',
        'cancellation_date',
        'forfeit_amount',
    ];

    public function toSearchableArray()
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status,
        ];
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
