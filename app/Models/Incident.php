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

    public function department(){
        return $this->belongsTo(Department::class);
    }
}
