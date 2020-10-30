<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    prtected $fillable = ['title', 'isbn', 'pages', 'short_content', 'author', 'edition', 'genre', 'file_path', 'added_by'];

    public function genres ()
    {
        return $this->hasOne('App\Genre');
    }

    public function users ()
    {
        return $this->hasMany('App\User');
    }
}
