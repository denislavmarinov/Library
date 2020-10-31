<?php

use App\Book;
use App\Role;
use App\User;
use App\Genre;
use App\Author;
use App\Wishlist;
use App\User_speed;
use App\Nationality;
use App\Notification;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;



class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        Role::truncate();
        User::truncate();
        Genre::truncate();
        Nationality::truncate();
        Author::truncate();
        Book::truncate();
        DB::table('books_users')->truncate();
        User_speed::truncate();
        Notification::truncate();
        DB::table('notifications_users')->truncate();
        Wishlist::truncate();

        $usersQuantity = 50;
        $genresQuantity = 50;
        $nationalitiesQuantity = 50;
        $authorsQuantity = 150;
        $booksQuantity = 250;
        // $userSpeedQuantity = 100;
        // $notificationsQuantity = 250;
        // $wishlistQuantity = 250;

        $this->call(RolesSeeder::class);
        sleep(3);
        factory(User::class, $usersQuantity)->create();
        sleep(3);
        factory(Genre::class, $genresQuantity)->create();
        sleep(3);
        factory(Nationality::class, $nationalitiesQuantity)->create();
        sleep(3);
        factory(Author::class, $authorsQuantity)->create();
        sleep(3);
        factory(Book::class, $booksQuantity)->create();
        sleep(3);
        $this->call(BooksUsersSeeder::class);
        sleep(3);
        $this->call(UserSpeedSeeder::class);
        sleep(3);
        $this->call(NotificationsSeeder::class);
        sleep(3);
        $this->call(NotificationUsersSeeder::class);
        sleep(3);
        $this->call(WishlistSeeder::class);
        sleep(3);
    }
}
