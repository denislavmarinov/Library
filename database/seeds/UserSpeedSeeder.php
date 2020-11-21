<?php

use App\User;
use App\Model;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSpeedSeeder extends Seeder
{
    public function user_speed (Faker $faker)
    {
        $monday = $faker->numberBetween(0, 300);
        $tuesday = $faker->numberBetween(0, 300);
        $wednsday = $faker->numberBetween(0, 300);
        $thursday = $faker->numberBetween(0, 300);
        $friday = $faker->numberBetween(0, 300);
        $saturday = $faker->numberBetween(0, 300);
        $sunday = $faker->numberBetween(0, 300);
        return [
                'monday' => $monday,
                'tuesday' => $tuesday,
                'wednesday' => $wednsday,
                'thursday' => $thursday,
                'friday' => $friday,
                'saturday' => $saturday,
                'sunday' => $sunday,
                'week_num' => $faker->numberBetween(0, 52),
                'user' => User::all()->random()->id
        ];
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run($num = 100, Faker $faker)
    {
        for ($i = 0; $i < $num; $i++)
        {
                DB::table('user_speeds')->insert($this->user_speed($faker));
        }
    }
}
