<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Genre;
use Faker\Generator as Faker;

$factory->define(Genre::class, function (Faker $faker) {
    return [
        'genre'         => $faker->words(3, true),
        'description'   => $faker->sentences(3, true)
    ];
});
