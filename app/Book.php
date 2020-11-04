<?php

namespace App;

use Illuminate\Support\Facades\DB;
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

    public static function get_all_books_with_authors_and_genres ()
    {
        return DB::table('books')
                    ->join('authors', 'books.author', '=', 'authors.id')
                    ->join('genres', 'books.genre', '=', 'genres.id')
                    ->select('books.id', 'books.title', 'books.short_content', 'books.isbn', 'books.pages', 'books.edition', 'genres.genre','books.genre as genre_id', 'books.author', 'authors.first_name', 'authors.last_name')
                    ->get();
    }

    public static function get_all_books_with_authors_genres_and_sort($sort_by, $sort_order)
    {
        return DB::table('books')
                     ->join('authors', 'books.author', '=', 'authors.id')
                    ->join('genres', 'books.genre', '=', 'genres.id')
                    ->select('books.id', 'books.title', 'books.short_content', 'books.isbn', 'books.pages', 'books.edition', 'genres.genre','books.genre as genre_id', 'books.author', 'authors.first_name', 'authors.last_name')
                    ->orderBy($sort_by, $sort_order)
                    ->get();
    }

    public static function get_all_books_with_authors_genres_and_filter($filter)
    {
        return DB::table('books')
                     ->join('authors', 'books.author', '=', 'authors.id')
                    ->join('genres', 'books.genre', '=', 'genres.id')
                    ->select('books.id', 'books.title', 'books.short_content', 'books.isbn', 'books.pages', 'books.edition', 'genres.genre','books.genre as genre_id', 'books.author', 'authors.first_name', 'authors.last_name')
                    ->where('title', 'LIKE', '%'.$filter.'%')
                    ->get();
    }

    public static function get_all_books_with_authors_genres_filter_and_sort($filter, $sort_by, $sort_order)
    {
        return DB::table('books')
                     ->join('authors', 'books.author', '=', 'authors.id')
                    ->join('genres', 'books.genre', '=', 'genres.id')
                    ->select('books.id', 'books.title', 'books.short_content', 'books.isbn', 'books.pages', 'books.edition', 'genres.genre','books.genre as genre_id', 'books.author', 'authors.first_name', 'authors.last_name')
                    ->where('title', 'LIKE', '%'.$filter.'%')
                    ->orderBy($sort_by, $sort_order)
                    ->get();
    }
}
