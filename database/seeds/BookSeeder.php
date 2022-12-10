<?php

namespace Database\Seeders;

use App\Book;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    const MAX_AUTHOR_PER_BOOK = 2;
    const MAX_AUTHOR = 12;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Book::factory()->count(12)->create()->each(function ($book) {
            $book->authors()->toggle($this->randomAuthorIds());
        });
    }

    private function randomAuthorIds()
    {
        $ids = collect();
        for ($i = 0; $i < rand(1, self::MAX_AUTHOR_PER_BOOK); $i++) {
            $ids->push(random_int(1, self::MAX_AUTHOR));
        }
        return $ids;
    }
}
