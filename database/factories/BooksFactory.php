<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Book;
use App\User;
use App\Genre;
use App\Author;
use Faker\Generator as Faker;

$factory->define(Book::class, function (Faker $faker) {
    return [
            'title'  => $faker->words(5, true),
            'isbn' => $faker->isbn13,
            'pages' => $faker->numberBetween(100, 800 ),
            'short_content' => $faker->paragraphs(3, true),
            'author' => Author::all()->random()->id,
            'edition' => $faker->numberBetween(1, 12),
            'genre' => Genre::all()->random()->id,
            'file_path' => $faker->sentences(1, true),
            'added_by'  => User::all()->random()->id
    ];
});
