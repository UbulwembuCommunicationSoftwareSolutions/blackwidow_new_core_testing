<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
    use HasFactory;
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function people(){
        return $this->belongsToMany(Person::class, 'incident_people');
    }
    public function incident_category(){
        return $this->belongsTo(IncidentCategory::class);
    }

    public function incident_sub_category(){
        return $this->belongsTo(IncidentSubCategory::class);
    }

    public function incident_activities(){
        return $this->hasMany(IncidentActivity::class);
    }

    public function incident_notes(){
        return $this->hasMany(IncidentNote::class);
    }

    public function incident_sub_sub_category(){
        return $this->belongsTo(IncidentSubSubCategory::class);
    }

    public function department(){
        return $this->belongsTo(Department::class);
    }
}
