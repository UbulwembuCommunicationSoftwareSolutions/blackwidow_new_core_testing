<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncidentSubCategory extends Model
{
    use HasFactory;
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];
    public function incident_category(){
        return $this->belongsTo(IncidentCategory::class);
    }

    public function referrals()
    {
        return $this->morphMany(AutoReferral::class, 'referrable');
    }
}
