<?php

namespace App;

use App\Book;
use App\User;
use App\Author;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    protected $fillable = ['book_id', 'user_id', 'deleted_at'];

    public function user ()
    {
        return $this->hasMany('App\User');
    }

    public function book ()
    {
        return $this->hasMany('App\Book');
    }

    public static function get_all_for_user ($user_id)
    {
    	return DB::table('wishlists')
    				->join('books', 'wishlists.book_id', '=', 'books.id')
    				->join('authors', 'books.author', '=', 'authors.id')
    				->select('books.id', 'authors.id as author', 'books.title', 'authors.first_name', 'authors.last_name')
    				->where('wishlists.user_id', '=', $user_id)
    				->get();
    }
}
