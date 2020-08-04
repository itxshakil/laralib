<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\IssueLog;
use Faker\Generator as Faker;

$factory->define(IssueLog::class, function (Faker $faker) {
    return [
        'user_id' => random_int(1, 5),
        'admin_id' => random_int(1, 5),
        'book_id' => random_int(1, 20),
    ];
});
