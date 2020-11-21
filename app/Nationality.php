<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Nationality extends Model
{
    protected $fillable = ['nationality', 'history_link', 'flag'];

    public function author ()
    {
        return $this->hasOne('App\Author');
    }

    public static function get_all_nationalities()
    {
    	return DB::table('nationalities')
				->select('id', 'nationality', 'flag', 'history_link')
                ->orderBy('nationality', 'asc')
				->get();
    }

    public static function get_nationality_with_history_link_and_flag( $id)
    {
        return DB::table('nationalities')
                ->leftJoin('authors', 'authors.nationality', '=', 'nationalities.id')
                ->select('nationalities.id as nationality_id', 'nationalities.nationality', 'nationalities.history_link', 'nationalities.flag','authors.first_name', 'authors.last_name', 'authors.id as author_id')
                ->where('nationalities.id', '=', $id)
                ->get();
    }

    public static function delete_nationality ($nationality_id)
    {
        return DB::table('nationalities')
                ->where('id', '=', $nationality_id)
                ->delete();
    }
}
