<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class InvoiceFactory extends Factory
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
            'invoice_no' => $this->faker->randomNumber(3),
            'due_date' => $this->faker->date(),
            'company_id' => $this->faker->numberBetween(1,10),
            'customer_id' => $this->faker->numberBetween(1,10),
            'total_amount' => $this->faker->numberBetween(1000,10000),
            'status' => $this->faker->numberBetween(1,0),
        ];
    }
}
