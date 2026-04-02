<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UsesUuid;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Invoice extends Model implements HasMedia
{
    use HasFactory, UsesUuid, InteractsWithMedia;

    protected $fillable = [
        'project_id',
        'total_amount',
        'status',
        'issue_date',
        'due_date',
    ];

    protected $casts = [
        'issue_date' => 'date',
        'due_date' => 'date',
        'total_amount' => 'decimal:2',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function payments()
    {
        return $this->hasMany(InvoicePayment::class);
    }

    // Payment calculation accessors
    public function getAmountPaidAttribute()
    {
        return $this->payments()->sum('amount');
    }

    public function getAmountDueAttribute()
    {
        return $this->total_amount - $this->getAmountPaidAttribute();
    }

    public function getIsFullyPaidAttribute()
    {
        return $this->getAmountDueAttribute() <= 0;
    }
}
