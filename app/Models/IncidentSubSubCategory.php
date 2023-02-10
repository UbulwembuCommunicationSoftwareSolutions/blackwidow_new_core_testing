<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncidentSubSubCategory extends Model
{
    use HasFactory;
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];
    public function incident_sub_category(){
        return $this->belongsTo(IncidentSubCategory::class);
    }
    public function referrals()
    {
        return $this->morphMany(AutoReferral::class, 'referrable');
    }
}
