<?php


namespace Database\Seeders;

use App\Author;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    const BOOK_COUNT = 120;
    const MAX_BOOK_PER_AUTHOR = 8;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Author::class, 30)->create()->each(function ($author) {
            $author->books()->toggle($this->randomBookIds());
        });
    }

    private function randomBookIds()
    {
        $ids = collect();
        for ($i = 0; $i < rand(1, self::MAX_BOOK_PER_AUTHOR); $i++) {
            $ids->push(random_int(1, self::BOOK_COUNT));
        }
        return $ids;
    }
}
