<?php

namespace Database\Seeders;

use App\RequestedBook;
use Illuminate\Database\Seeder;

class RequestedBookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RequestedBook::factory()->count(12)->create();
    }
}
