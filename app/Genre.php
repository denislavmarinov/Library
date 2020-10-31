<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $fillable = ['genre', 'description'];

    public function book ()
    {
        return $this->hasMany('App\Book');
    }
}
