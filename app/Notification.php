<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = ['notification', 'description', 'book'];

    public function book ()
    {
        return $this->hasOne('App\Book');
    }

    public function user ()
    {
        return $this->hasMany('App\User');
    }
}
