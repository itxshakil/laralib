<?php

namespace Database\Factories;

use App\Rating;
use Illuminate\Database\Eloquent\Factories\Factory;

class RatingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Rating::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'score' => rand(1, 5),
            'comment' => $this->faker->optional()->sentence(18),
            'user_id' => rand(1, 12),
            'book_id' => rand(1, 60),
        ];
    }
}
