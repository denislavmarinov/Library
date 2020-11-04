<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $fillable = ['first_name', 'last_name', 'date_of_birth', 'date_of_death', 'nationality', 'biographic', 'image'];

    public function nationality ()
    {
        return $this->hasOne('App\Nationality');
    }

    public function book ()
    {
        return $this->hasMany('App\Book');
    }

    public static function get_all_authors()
    {
    	return DB::select(DB::raw("SELECT `id`, CONCAT(`first_name`, ' ' , `last_name`) as `author_name` FROM `authors`"));
    }
}
