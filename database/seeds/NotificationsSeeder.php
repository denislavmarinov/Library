<?php

use App\Book;
use App\Notification;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class NotificationsSeeder extends Seeder
{

    public function notifications (Faker $faker)
    {
            return [
                'notification' => $faker->words(5, true),
                'description' => $faker->paragraphs(3, true),
                'book' => Book::all()->random()->id
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
            DB::table('notifications')->insert($this->notifications($faker));
        }
    }
}
