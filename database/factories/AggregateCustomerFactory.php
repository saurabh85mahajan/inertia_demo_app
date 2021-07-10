<?php

namespace Database\Factories;

use App\Models\AggregateCustomer;
use Illuminate\Database\Eloquent\Factories\Factory;

class AggregateCustomerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AggregateCustomer::class;

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
            'total_customers' => $this->faker->randomNumber(5),
        ];
    }
}
