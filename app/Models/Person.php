<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Person extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;


    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

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

    public function incidents()
    {
        return $this->belongsToMany(Incident::class, 'incident_people');
    }

    public function interest_groups(){
        return $this->belongsToMany(InterestGroup::class, 'interest_group_people');
    }

    public function auditSync(string $relation, array $ids, $detaching = true)
    {
        // store the original IDs
        $originalIds = $this->$relation->pluck('id')->toArray();

        // perform the sync operation

        // get the added and removed IDs
        $addedIds = array_diff($ids, $originalIds);
        $removedIds = array_diff($originalIds, $ids);

        // audit the added IDs
        foreach ($addedIds as $id) {
            $this->auditAttach($relation, $this->$relation()->getRelated()->find($id));
        }

        // audit the removed IDs
        if ($detaching) {
            foreach ($removedIds as $id) {
                $this->auditDetach($relation, $this->$relation()->getRelated()->find($id));
            }
        }
    }



}
