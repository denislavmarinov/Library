<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Notification extends Model
{
    protected $fillable = ['notification', 'description', 'book'];

    public function book ()
    {
        return $this->hasOne('App\Book');
    }

    public function user ()
    {
        return $this->hasMany('App\User');
    }

    public static function get_all_unreaded_notifiactions_for_user ($user_id)
    {
    	return DB::table('notifications')
				->join('notifications_users', 'notifications.id', '=', 'notifications_users.notification_id')
				->join('books', 'notifications.book', '=', 'books.id')
				->join('authors', 'books.author', '=', 'authors.id')
				->join('genres', 'books.genre', '=', 'genres.id')
				->select('notifications.id', 'notifications.notification', 'notifications.description', 'books.title', 'authors.first_name', 'authors.last_name', 'genres.genre', 'books.id as book_id', 'authors.id as author_id', 'genres.id as genre_id')
				->where([
					['notifications_users.user_id', '=', $user_id],
					['notifications_users.seen', '=', '0']
				])
				->get();
    }

    public static function notification_mark_as_seen ($data_to_update, $notification_id, $user_id)
    {
        return DB::table('notifications_users')
                ->where([
                    ['user_id', '=', $user_id],
                    ['notification_id', '=', $notification_id]
                ])
                ->update($data_to_update);
    }

    public static function mark_all_notifications_as_seen ($data_to_update, $user_id)
    {
        return DB::table('notifications_users')
                ->where('user_id', '=', $user_id)
                ->update($data_to_update);
    }
}
