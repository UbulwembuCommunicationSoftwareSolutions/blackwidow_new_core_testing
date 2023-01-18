<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    use HasFactory;

    protected $fillable = ['institution_id','id','user_id','description'];

    public function people()
    {
        return $this->hasMany(Person::class, 'institution_people');
    }
    public function departments()
    {
        return $this->hasMany(Department::class);
    }
}
