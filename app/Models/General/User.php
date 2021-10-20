<?php

namespace App\Models\General;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Nova\Actions\Actionable;
use Laravel\Nova\Fields\Searchable;
use Tymon\JWTAuth\Contracts\JWTSubject;


class User extends Authenticatable implements JWTSubject
{
    use searchable, actionable, Notifiable;

    protected $table = 'users';
    public $timestamps = true;

    protected $fillable = array('name', 'username', 'email', 'email_verified_at', 'remember_token', 'password', 'avatar', 'phone', 'reset_code', 'api_token', 'fcm_token', 'active', 'type');
//    protected $visible = array('provider', 'provider_id', 'name', 'userable_id', 'userable_type', 'email', 'email_verified_at', 'remember_token', 'avatar', 'birth_date', 'gender', 'default_lang', 'phone', 'city_id', 'area_id', 'zone_id', 'reset_code', 'national_id', 'api_token', 'fcm_token', 'active', 'type', 'country_id');
    protected $hidden = array('password', 'api_token');

    public function routeNotificationForFcm()
    {
        return $this->fcm_token;
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function allowedLocale()
    {
        return $this->allowedAllLocale() || $this->locale[app()->getLocale()];
    }

    public static function allNokhpahMembers($pos = NULL)
    {


        $users = User::leftJoin('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
            ->leftJoin('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->Where('users.active', 1)
            ->where('roles.name', 'super-admin')
            ->select("users.*");

//        if (!is_null($pos)) {
//                    $users->where('users.id', '<>', $exceptId);
//        }
        $users->orderBy('users.name', 'asc');

        return $users->get();
    }

    public static function allProcurementMembers($pos = NULL)
    {

        $users = User::leftJoin('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
            ->leftJoin('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->Where('users.active', 1)
            ->where('roles.name', 'super-admin');
//        if (!is_null($pos)) {
//                    $users->where('users.id', '<>', $exceptId);
//        }
        $users->orderBy('users.name', 'asc')->groupBy('users.id');

        return $users->get();
    }



}
