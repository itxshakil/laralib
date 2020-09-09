<?php

namespace Database\Factories;

use App\IssueLog;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class IssueLogFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = IssueLog::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => random_int(1, 5),
            'admin_id' => random_int(1, 5),
            'book_id' => random_int(1, 20),
            'returned_at' => (random_int(0, 1)) ? Carbon::now()->addDays(random_int(5, 27)) : null
        ];
    }
}
