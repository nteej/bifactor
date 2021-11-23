<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'uuid' => $this->faker->uuid(),
            'invoice_id' => $this->faker->randomNumber(3),
            'state' => $this->faker->randomElement(['credit','debit']),
            'amount' => $this->faker->numberBetween(1000,10000),
            'info' => [
                "items" => $this->faker->sentence()
            ],
            'status' => $this->faker->numberBetween(1,0),
        ];
    }
}
