<?php

namespace Database\Factories;

use App\Author;
use Illuminate\Database\Eloquent\Factories\Factory;

class AuthorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Author::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'introduction' => $this->faker->optional()->paragraph(6),
            'email' => $this->faker->optional(0.3)->safeEmail
        ];
    }
}
