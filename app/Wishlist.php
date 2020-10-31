<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    protected $fillable = ['book_id', 'user_id', 'deleted_at'];

    public function user ()
    {
        return $this->hasMany('App\User');
    }

    public function book ()
    {
        return $this->hasMany('App\Book');
    }
}
