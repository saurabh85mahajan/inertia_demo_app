<?php

namespace Database\Factories;

use App\Models\AggregateTraffic;
use Illuminate\Database\Eloquent\Factories\Factory;

class AggregateTrafficFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AggregateTraffic::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'date' => $this->faker->date(),
            'total_hits' => $this->faker->randomNumber(3),
        ];
    }
}
