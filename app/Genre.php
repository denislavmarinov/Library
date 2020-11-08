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

    public static function get_genre_with_authors_end_books( $id)
    {
        return DB::table('books')
                    ->join('authors', 'books.author', '=', 'authors.id')
                    ->join('genres', 'books.genre', '=', 'genres.id')
                    ->select('books.id as book_id', 'books.title', 'books.short_content', 'books.isbn', 'books.pages', 'books.edition', 'genres.genre','books.genre as genre_id', 'books.author', 'authors.first_name', 'authors.last_name', 'genres.description')
                    ->where('books.genre', '=', $id)
                    ->get();
    }

}
