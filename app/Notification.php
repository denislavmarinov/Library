<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = ['notification', 'description', 'book'];

    public function books ()
    {
        return $this->hasOne('App\Book');
    }

    public function users ()
    {
        return $this->hasMany('App\User');
    }
}
