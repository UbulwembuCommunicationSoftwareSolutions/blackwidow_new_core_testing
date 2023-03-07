<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class IncidentActivity extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
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
