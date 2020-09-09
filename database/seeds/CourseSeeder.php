<?php

namespace Database\Seeders;

use App\Course;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now()->toDateString();
        Course::insert([
            ['name' => 'BCA 1st', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'BCA 2nd', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'BCA 3rd', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'BA 1st',  'created_at' => $now, 'updated_at' => $now],
            ['name' => 'BA 2nd', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'BA 3rd', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
