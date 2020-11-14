<?php

namespace App;

use App\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name',  'role_id', 'image', 'logged', 'email', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function notification ()
    {
        return $this->hasMany('App\Notification');
    }

    public function book ()
    {
        return $this->hasMany('App\Book');
    }

    public function role ()
    {
        return $this->hasOne('App\Role');
    }


    public function user_speed ()
    {
        return $this->hasMany('App\User_speed');
    }

    public function wishlist ()
    {
        return $this->hasMany('App\Wishlist');
    }

    public static function change_user_role ($user_id, $role_id)
    {
        return DB::table('users')
                ->where('id', $user_id)
                ->update(['role_id' => $role_id]);
    }

    public static function get_all_users_with_roles ()
    {
        return DB::table('users')
                ->join('roles', 'users.role_id', '=', 'roles.id')
                ->leftJoin('required_password_change', 'users.id', '=', 'required_password_change.user_id')
                ->select('users.id as id', 'users.first_name', 'users.last_name', 'users.email', 'users.created_at', 'users.updated_at', 'roles.role', 'required_password_change.change')
                ->orderBy('users.updated_at', 'ASC')
                ->get();
    }
    public static function logged_field_to_false ($user_id)
    {
        return DB::table('users')
                ->where('id', '=', $user_id)
                ->update(['logged' => '0']);
    }
    public static function logged_field_to_true ($user_id)
    {
        return DB::table('users')
                ->where('id', '=', $user_id)
                ->update(['logged' => '1']);
    }
    public static function check_if_user_is_logged_in ($email)
    {
        return DB::table('users')
                ->select('logged')
                ->where('email', '=', $email)
                ->get();
    }
    public static function check_if_email_exist ($email)
    {
        return DB::table('users')
                ->select('email')
                ->where('email', '=', $email)
                ->get();
    }

    public static function require_change_password ($data)
    {
        return DB::table('required_password_change')
                ->insert($data);
    }

    public static function check_if_required_to_change_password ($user_id)
    {
        return DB::table('required_password_change')
                ->select('change')
                ->where('user_id', '=', $user_id)
                ->get();
    }

    public static function update_user_password ($id, $password)
    {
        return DB::table('users')
                ->where('id', '=', $id)
                ->update(['password' => $password, 'updated_at' => now()]);
    }

    public static function remove_from_password_reset_table ($id)
    {
        return DB::table('required_password_change')
                ->where('user_id', '=', $id)
                ->delete();
    }
}
