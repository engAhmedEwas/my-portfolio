<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UsesUuid;

class Expense extends Model
{
    use HasFactory, UsesUuid;

    protected $fillable = ['amount', 'category', 'date'];

    protected $casts = [
        'amount' => 'decimal:2',
        'date' => 'date',
    ];
}
