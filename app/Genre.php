<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $fillable = ['genre', 'description'];

    public function book ()
    {
        return $this->hasMany('App\Book');
    }

    public static function get_all_genres ()
    {
    	return DB::table('genres')
    				->select('id', 'genre')
    				->get();
    }
}
