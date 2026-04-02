<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UsesUuid;

class Client extends Model
{
    use HasFactory, UsesUuid;

    protected $fillable = ['user_id', 'company_name', 'vat_number', 'phone', 'email', 'contact_person', 'address'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
