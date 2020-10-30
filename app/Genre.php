<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $fillable = ['genre', 'description'];

    public function books ()
    {
        return $this->hasMany('App\Book');
    }
}
