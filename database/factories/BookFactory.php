<?php

namespace Database\Factories;

use App\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{

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
        $names = [
            'The Great Gatsby',
            'The Lord of the Rings',
            'The Hobbit',
            'The Catcher in the Rye',
            'The Lord of the Flies',
            'The Grapes of Wrath',
            'Java Script: The Good Parts',
            'Java Script: The Definitive Guide',
            'The C Programming Language',
            'The C Programming Language (2nd Edition)',
            'The C Programming Language (3rd Edition)',
            'C++ Primer',
            'Networking for the World Wide Web',
            'SQL for the World Wide Web',
            'Systems Programming with C',
            'System Analysis and Design',
            'Test Driven Development',
            'The C Programming Language (4th Edition)',
        ];
        return [
            'title' => $this->faker->unique()->randomElement($names),
            'isbn' => $this->faker->unique()->isbn10,
            'count' => $this->faker->numberBetween(0, 18),
        ];
    }
}
