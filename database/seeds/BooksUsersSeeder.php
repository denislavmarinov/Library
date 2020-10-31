<?php

use App\Book;
use App\User;
use App\Model;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BooksUsersSeeder extends Seeder
{

    public function books_users (Faker $faker)
    {
        $book = Book::all()->random();
        $book_id = $book->id;
        $book_pages = $book->pages;

        if ($faker->boolean(50))
        {
            $up_to_page = $book_pages;
            $ended_to_read = now();
            $read = true;
        }
        else
        {
            $up_to_page = $faker->numberBetween(0, $book_pages);
            $ended_to_read = null;
            $read = false;
        }

        return [
                'book'  => $book_id,
                'user'  => User::all()->random()->id,
                'up_to_page'    => $up_to_page,
                'started_to_read'   => $faker->date('Y-m-d', now()),
                'ended_to_read' => $ended_to_read,
                'read'  => $read
        ];
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run($num = 500, Faker $faker)
    {
        for ($i = 0; $i < $num; $i++)
        {
                DB::table('books_users')->insert($this->books_users($faker));
        }
    }
}
