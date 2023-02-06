<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Laravel\Sanctum\HasApiTokens;
use OwenIt\Auditing\Contracts\Auditable;

class User extends Authenticatable implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasApiTokens, HasFactory, Notifiable;

    protected $auditInclude = [
        'departments',
        'name',
        'email',
        'password',
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

    public function roles()
    {
        return $this->belongsToMany(UserRole::class, 'user_role_user');
    }
    public function permissions()
    {
        return $this->belongsToMany(UserPermission::class, 'user_permission_user');
    }

    public function departments()
    {
        return $this->belongsToMany(Department::class, 'department_user');
    }

    public function incidents()
    {
        return $this->hasMany(Incident::class, 'department_user');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
        'uid',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin(){
        $admin = 0;
        foreach((Auth::user()->roles) as $role){
            if($role->description == "system_administrator"){
               return true;
            }
        }
        if($admin == 0){
            return  false;
        }
    }

    public function getPermissions(){
        $permissions = array();
        foreach(Auth::user()->permissions as $permission){
            $permissions[] = $permission->permission_object."_".$permission->permission_action;
        }
        return $permissions;
    }
}
