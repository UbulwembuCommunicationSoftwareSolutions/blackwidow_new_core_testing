<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class InterestGroup extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;


    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    protected $fillable = [
        'description',
        'gps_lat',
        'gps_lng',
        'address'
    ];
    public function people()
    {
        return $this->belongsToMany(Institution::class, 'interest_group_people');
    }




}
