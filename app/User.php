<?php

namespace App;

use App\Models\Role;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password',
    ];

    public function hasPermission($route){
        $routes = $this->routes();
        return in_array($route,$routes) ? true : false;
    }

    // cacs route ddax dduowcj gans cho nguowif dungf nayf
    public function routes(){
        $data = [];
        foreach($this->getRoles as $role){
            $permission = json_decode($role->permissions);
            foreach($permission as $per){
                if(!in_array($per,$data)){
                    array_push($data,$per);
                }
            }
        }

        return $data;
    }

    public function getRoles(){
        return $this->belongsToMany('App\Models\Role','user_roles','user_id','role_id');
    }

}
