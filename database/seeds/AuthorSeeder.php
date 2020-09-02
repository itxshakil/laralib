<?php

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
        factory(Author::class, 30)->create()->each(function ($author) {
            $author->books()->createMany(factory(Book::class, 3)->make()->only('title', 'isbn', 'count'));
        });
    }
}
