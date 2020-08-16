<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\IssueLog;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(IssueLog::class, function (Faker $faker) {
    return [
        'user_id' => random_int(1, 5),
        'admin_id' => random_int(1, 5),
        'book_id' => random_int(1, 20),
        'returned_at' => (random_int(0, 1)) ? Carbon::now()->addDays(random_int(5, 27)) : null
    ];
});
