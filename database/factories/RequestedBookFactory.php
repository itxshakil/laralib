<?php

namespace Database\Factories;

use App\RequestedBook;
use Illuminate\Database\Eloquent\Factories\Factory;

class RequestedBookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RequestedBook::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'author' => $this->faker->name,
            'isbn' => $this->faker->optional()->isbn13,
            'publisher' => $this->faker->optional()->name,
            'year' => $this->faker->optional()->year,
            'message' => $this->faker->optional()->paragraph(),
            'status' => $this->faker->optional()->boolean,
        ];
    }
}
