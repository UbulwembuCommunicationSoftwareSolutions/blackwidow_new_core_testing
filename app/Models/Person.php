<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $fillable = [
        'institution_id',
        'id',
        'user_id',
        'profile_picture',
        'first_name',
        'surname',
        'maiden_name',
        'nickname',
        'gender',
        'race',
        'marital_status',
        'weight',
        'length',
        'birth_place',
        'date_of_birth',
        'age',
        'nationality',
        'language_spoken',
        'religion',
        'uid',];
    public function institutions()
    {
        return $this->belongsToMany(Institution::class, 'institution_people');
    }
}
