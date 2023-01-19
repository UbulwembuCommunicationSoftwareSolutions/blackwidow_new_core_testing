<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'institution_id',
        'description'
    ];
    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }

    public function incidents(){
        return $this->hasMany(Incident::class);
    }
}
