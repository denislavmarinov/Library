<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $fillable = ['first_name', 'last_name', 'date_of_birth', 'date_of_death', 'nationality', 'biographic', 'image'];

    public function nationality ()
    {
        return $this->belongsTo('App\Nationality');
    }

    public function books ()
    {
        return $this->hasMany('App\Book');
    }

    public static function get_all_authors()
    {
    	return DB::select(DB::raw("SELECT authors.id, CONCAT(`first_name`, ' ' , `last_name`) as `author_name`, authors.date_of_birth as `date_of_birth`, authors.nationality, nationalities.nationality as nationality_name FROM `authors` JOIN `nationalities` ON nationalities.id = authors.nationality ORDER BY `author_name` ASC"));
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

    public static function select_authors_with_nationality_and_count_of_books($nationality)
    {
        return DB::select(DB::raw("SELECT COUNT(*) as 'book_count', authors.`id` as 'author', authors.first_name, authors.last_name FROM authors LEFT JOIN books ON books.author = authors.id JOIN nationalities on authors.nationality = nationalities.id WHERE authors.nationality = :nationality GROUP BY authors.id, authors.first_name, authors.last_name  ORDER BY book_count DESC, first_name ASC, last_name ASC"), ['nationality' => $nationality]);
    }
    public static function delete_author ($id)
    {
        return DB::table('authors')
                ->where('id', '=', $id)
                ->delete();
    }
    public static function select_authors_books ($id)
    {
        return DB::table('books')
                ->select('id', 'title')
                ->where('author', '=', $id)
                ->get();
    }
}
