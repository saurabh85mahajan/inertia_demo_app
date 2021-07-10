<?php

namespace Database\Factories;

use App\Models\AggregateSale;
use Illuminate\Database\Eloquent\Factories\Factory;

class AggregateSaleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AggregateSale::class;

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
            'total_sales' => $this->faker->randomNumber(3),
        ];
    }
}
