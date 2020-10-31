<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['title', 'isbn', 'pages', 'short_content', 'author', 'edition', 'genre', 'file_path', 'added_by'];

    public function genre ()
    {
        return $this->hasOne('App\Genre');
    }

    public function user ()
    {
        return $this->hasMany('App\User');
    }

    public function author ()
    {
        return $this->hasOne('App\Author');
    }

    public function notification ()
    {
        return $this->hasMany('App\Notification');
    }

    public function wishlist ()
    {
        return $this->hasMany('App\Wishlist');
    }
}
