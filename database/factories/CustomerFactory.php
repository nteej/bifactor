<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
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
            'name' => $this->faker->company(),
            'contact' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->email,
            'info' => [
                "address" => $this->faker->address()
            ],
            'credit_limit' => $this->faker->numberBetween(1000, 100000),
            'status' => $this->faker->numberBetween(1, 0),
        ];
    }
}
