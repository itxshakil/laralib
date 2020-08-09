<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Rating;
use Faker\Generator as Faker;

$factory->define(Rating::class, function (Faker $faker) {
    return [
        'score' => rand(1, 5),
        'comment' => $faker->optional()->sentence(18),
        'user_id' => rand(1, 5),
        'book_id' => rand(1, 20),
    ];
});
