<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    use HasFactory;

    protected $fillable = ['institution_id','id','user_id','description'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_role_user');
    }
    public function people()
    {
        return $this->belongsToMany(Person::class, 'institution_people');
    }
    public function departments()
    {
        return $this->belongsToMany(Department::class, 'department_institution');
    }
}
