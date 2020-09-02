<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CourseSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(BookSeeder::class);
        $this->call(AuthorSeeder::class);
        // $this->call(RatingSeeder::class);
    }
}
