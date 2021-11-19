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
            'order_no' => $this->faker->randomNumber(3),
            'order_date' => $this->faker->date(),
            'company_id' => $this->faker->numberBetween(1,10),
            'invoice_id' => $this->faker->numberBetween(1,10),
            'status' => $this->faker->numberBetween(1,0),
        ];
    }
}
