<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Department extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;
    protected $auditInclude = [
        'departments',
        'institution_id',
        'description'
    ];
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

    public function users(){
        return $this->hasMany(User::class);
    }
}
