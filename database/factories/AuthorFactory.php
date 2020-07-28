<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Author;
use Faker\Generator as Faker;

$factory->define(Author::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'introduction' => $faker->optional()->paragraph,
        'email' => $faker->optional(0.3)->safeEmail
    ];
});
