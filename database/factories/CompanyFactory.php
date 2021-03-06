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
    public function definition(): array
    {
        return [
            'uuid' => $this->faker->uuid(),
            'name' => $this->faker->company(),
            'contact' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->email,
            'info' => [
                "address" => $this->faker->address()
            ],
            'debtor_limit' => $this->faker->numberBetween(1000, 100000),
            'status' => $this->faker->numberBetween(1, 0),
        ];
    }
}
