<?php

namespace Database\Seeders;

use App\Rating;
use Illuminate\Database\Seeder;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Rating::factory()->count(10)->create();
    }
}
