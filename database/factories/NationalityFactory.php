<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Nationality;
use Faker\Generator as Faker;

$factory->define(Nationality::class, function (Faker $faker) {
    return [
                'nationality'   =>$faker->country,
                'history_link'  =>$faker->url,
                'flag'             =>$faker->image( 'storage',  40,  40)
    ];
});