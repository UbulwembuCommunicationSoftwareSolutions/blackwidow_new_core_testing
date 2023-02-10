<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncidentCategory extends Model
{
    use HasFactory;
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function department(){
        return $this->belongsTo(Department::class);
    }

    public function incidents(){
        return $this->hasMany(Incident::class);
    }

    public function referrals()
    {
        return $this->morphMany(AutoReferral::class, 'referrable');
    }

}
