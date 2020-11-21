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

    public static function add_new_book ($book)
    {
        return DB::table('books')
                ->insert($book);
    }

    public static function get_book_to_show ($id)
    {
        return DB::table('books')
                ->join('authors', 'books.author', '=', 'authors.id')
                ->join('genres', 'books.genre', '=', 'genres.id')
                ->select('books.id', 'books.title', 'books.short_content', 'books.isbn', 'books.pages', 'books.edition', 'genres.genre','books.genre as genre_id', 'books.author', 'authors.first_name', 'authors.last_name', 'authors.user_id as author_id')
                ->where('books.id', '=', $id)
                ->get();
    }

    public static function select_book_to_update ($id)
    {
        return DB::table('books')
               ->select('id', 'title', 'isbn', 'pages', 'short_content', 'author', 'edition', 'genre')
               ->where('id', '=', $id)
               ->get();
    }

    public static function update_book($id, $new_book)
    {
        return DB::table('books')
                ->where('id', '=', $id)
                ->update($new_book);
    }

    public static function delete_book ($id)
    {
        return DB::table('books')
                ->where('id', '=', $id)
                ->delete();
    }

    public static function add_book_to_readlist ($data)
    {
        return DB::table('books_users')
                    ->insert($data);
    }
    public static function get_all_books_with_authors_genres_that_user_read ($user_id)
    {
        return DB::table('books_users')
                    ->join('books', 'books_users.book', '=', 'books.id')
                    ->join('authors', 'books.author', '=', 'authors.id')
                    ->join('genres', 'books.genre', '=', 'genres.id')
                    ->select('books.id', 'books.title', 'books.short_content', 'books.isbn', 'books.pages', 'books.edition', 'genres.genre','books.genre as genre_id', 'books.author', 'authors.first_name', 'authors.last_name', 'up_to_page', 'started_to_read', 'ended_to_read', 'read',)
                    ->where('books_users.user', '=', $user_id)
                    ->get();
    }

    public static function delete_book_from_user_read_list ($user, $book)
    {
        return DB::table('books_users')
                    ->where('book', '=', $book, 'AND', 'user', '=', $user)
                    ->delete();
    }

    public static function check_if_book_is_already_in_readlist ($book_id, $user_id)
    {
         return DB::select(DB::raw('SELECT `id` FROM books_users WHERE `book` = :book_id AND `user` = :user_id'), ['book_id' => $book_id, 'user_id' => $user_id ]);
    }
}
