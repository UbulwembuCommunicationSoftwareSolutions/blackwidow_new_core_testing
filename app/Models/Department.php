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
