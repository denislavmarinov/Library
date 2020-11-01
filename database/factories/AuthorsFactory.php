<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Author;
use App\Nationality;
use Faker\Generator as Faker;

$factory->define(Author::class, function (Faker $faker) {
    return [
            'first_name'            => $faker->firstName,
            'last_name'             => $faker->lastName,
            'date_of_birth'       => $faker->date("Y-m-d", '01-01-2000'),
            'date_of_death'      =>$faker->boolean(50) ? date_format($faker->dateTimeBetween('01-01-2000', now()), "Y-m-d" ): null,
            'nationality'            =>Nationality::all()->random()->id,
            'biographic'           =>$faker->text(1000),
            'image'                  =>$faker->sentences(1, true)
    ];
});
