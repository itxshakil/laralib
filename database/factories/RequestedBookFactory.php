<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\RequestedBook;
use Faker\Generator as Faker;

$factory->define(RequestedBook::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'author' => $faker->name,
        'isbn' => $faker->optional()->isbn13,
        'publisher' => $faker->optional()->name,
        'year' => $faker->optional()->year,
        'message' => $faker->optional()->paragraph(),
        'status' => $faker->optional()->boolean,
    ];
});
