<?php

namespace Database\Factories;

use App\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    const MAX_AUTHOR_PER_BOOK = 2;
    const MAX_AUTHOR = 12;

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Book::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->text(40),
            'isbn' => $this->faker->unique()->isbn10,
            'count' => $this->faker->numberBetween(0, 18),
        ];
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterMaking(function (Book $book) {
            //
        })->afterCreating(function (Book $book) {
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
