<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['role'];

    public function user ()
    {
        return $this->hasMany('App\User');
    }

    public static function show_roles_with_users (Role $role)
    {
        return DB::table('roles')
                    ->join('users', 'roles.id', '=', 'users.role_id')
                    ->select('roles.*', 'users.*')
                    ->where('users.role_id', '=', $role->id)
                    ->get();
    }
}
