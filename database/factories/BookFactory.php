<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Book;
use Faker\Generator as Faker;

$factory->define(Book::class, function (Faker $faker) {
    return [
        'title' => $faker->text(40),
        'isbn' => $faker->unique()->isbn10,
        'count' => $faker->numberBetween(0,999),
    ];
});
