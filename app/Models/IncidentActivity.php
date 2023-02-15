<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncidentActivity extends Model
{
    use HasFactory;
    protected $casts = [
        'created_at' ,
        'updated_at' ,
    ];

    protected $fillable = [
        'id' ,
        'note' ,
        'user_id' ,
        'incident_id' ,
        'to_user_id' ,
        'from_user_id' ,
        'message' ,
        'description' ,
        'incident_category' ,
        'incident_sub_category' ,
    ];
    public function incident(){
        return $this->belongsTo(Incident::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

}
