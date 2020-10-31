<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name',  'role', 'image', 'logged', 'email', 'password',
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
}
