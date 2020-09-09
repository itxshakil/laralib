<?php

namespace Database\Seeders;

use App\Author;
use App\Book;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Author::factory()->has(Book::factory()->count(3), 'books')->count(30)->create();
    }
}
