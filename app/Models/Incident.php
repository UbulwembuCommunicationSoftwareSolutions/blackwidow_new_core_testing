<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Incident extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
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
