<?php

use App\User;
use App\Model;
use App\Notification;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class NotificationUsersSeeder extends Seeder
{
    public function notifications_users (Faker $faker)
    {
        return [
               'notification_id' => Notification::all()->random()->id,
               'user_id' => User::all()->random()->id,
               'seen' => $faker->boolean(50)
        ];
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run($num = 750, Faker $faker)
    {
        for ($i = 0; $i < $num; $i++)
        {
                DB::table('notifications_users')->insert($this->notifications_users($faker));
        }
    }
}
