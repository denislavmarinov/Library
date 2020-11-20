<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $fillable = ['first_name', 'last_name', 'date_of_birth', 'date_of_death', 'nationality', 'biographic', 'image', 'user_id'];

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
    	return DB::select(DB::raw("SELECT authors.id, CONCAT(`first_name`, ' ' , `last_name`) as `author_name`, authors.date_of_birth as `date_of_birth`, authors.nationality, nationalities.nationality as nationality_name FROM `authors` JOIN `nationalities` ON nationalities.id = authors.nationality"));
    }

    public static function select_author($id)
    {
        return DB::select(DB::raw("SELECT authors.id, first_name, last_name, CONCAT(`first_name`, ' ' , `last_name`) as `author_name`, authors.date_of_birth as `date_of_birth`, `date_of_death`, `biographic`, `image`, authors.nationality, nationalities.nationality as nationality_name FROM `authors` JOIN `nationalities` ON nationalities.id = authors.nationality WHERE authors.`id` = :id"), ['id' => $id]);

    }

    public static function insert_author($data)
    {
        return DB::table('authors')->insert($data);
    } 

    public static function update_author($data, $id)
    {
        return DB::table('authors')
                ->where('id', '=', $id)
                ->update($data);
    }

    public static function select_author_with_count_of_books($id)
    {
        return DB::select(DB::raw("SELECT COUNT(*) as 'book_count' FROM authors LEFT JOIN books ON books.author = authors.id WHERE authors.id = :id"), ['id' => $id]);
    }
}
