<?php

use App\User;
use App\Role;
use App\Genre;
use Illuminate\Database\Seeder;


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

        $usersQuantity = 50;
        $genresQuantity = 50;


        $this->call(RolesSeeder::class);
        factory(User::class, $usersQuantity)->create();
        factory(Genre::class, $genresQuantity)->create();
    }
}
