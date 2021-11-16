<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    /*
     * The name of the corresponding model
     * */
    protected $model = Company::class;

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
            'address' => $this->faker->address(),
            'reg_no' => $this->faker->postcode(),
            'br_no' => $this->faker->randomNumber(8),
            'debtor_limit' => $this->faker->randomNumber(6),
            'status' => 0
        ];
    }
}
