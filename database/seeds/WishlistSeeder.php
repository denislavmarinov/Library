<?php

use App\Book;
use App\User;
use App\Wishlist;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WishlistSeeder extends Seeder
{
    public function wishlist (Faker $faker)
    {
            return [
                'book_id' => Book::all()->random()->id ,
                'user_id' => User::all()->random()->id,
                'deleted_at' => $faker->boolean(50) ? now() : null
            ];
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run($num = 250, Faker $faker)
    {
        for ($i = 0; $i < $num; $i++) {
            DB::table('wishlists')->insert($this->wishlist($faker));
        }
    }
}
